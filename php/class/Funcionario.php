<?php
class Funcionario extends Cliente{
	private $idFuncionario;
	private $cargo;
	public function setAttrFuncionario($idFuncionario,$nome="",$cpf="",$cargo="",$obs=""){
		$this->idFuncionario=$idFuncionario;
		$this->nome=$nome;
		$this->cpf=$cpf;
		$this->cargo=$cargo;
		$this->obs=$obs;
	}
	public function cadastrarFuncionario(){
		if($this->cadastrarEndereco()===false||$this->cadastrarContato()===false) return;
		$mysqli=$this->conectar();
		$cadFuncionario=$mysqli->prepare('insert into funcionario(nome,cpf,obs,cargo,endereco,contato) values (?,?,?,?,?,?)');
		$cadFuncionario->bind_param("ssssdd",$this->nome,$this->cpf,$this->obs,$this->cargo,$this->idEndereco,$this->idContato);
		echo "$this->nome, $this->cpf, $this->obs, $this->cargo, $this->idEndereco, $this->idContato";
		if(!$cadFuncionario->execute()) echo "<span class='retorno' data-type='error'>Não foi possível cadastrar o funcionário:<p>$cadFuncionario->error<p></span>";
		else echo "<span class='retorno' data-type='success'>Cadastro do funcionário $this->nome, de ID $cadFuncionario->insert_id, finalizado com sucesso!</span>";
	}
	public function buscarDadosFuncionario(){
		if($this->verificarExistencia('funcionario','id',$this->idFuncionario)===false) return;
		$this->nome=$this->pegarValor('nome','funcionario','id',$this->idFuncionario);
		$this->cpf=$this->pegarValor('cpf','funcionario','id',$this->idFuncionario);
		$this->cargo=$this->pegarValor('cargo','funcionario','id',$this->idFuncionario);
		$this->obs=$this->pegarValor('obs','funcionario','id',$this->idFuncionario);
		$this->idEndereco=$this->pegarValor('endereco','funcionario','id',$this->idFuncionario);
		$this->idContato=$this->pegarValor('contato','funcionario','id',$this->idFuncionario);
		echo '<form id="phpForm" action="/trabalhos/gti/bda1/" method="POST">';
		echo '<input type="hidden" name="idFuncionario" value="'.$this->idFuncionario.'">';
		echo '<input type="hidden" name="nomeFunc" value="'.$this->nome.'">';
		echo '<input type="hidden" name="cpf" value="'.$this->cpf.'">';
		echo '<input type="hidden" name="cargo" value="'.$this->cargo.'">';
		echo '<input type="hidden" name="obs" value="'.$this->obs.'">';
		$this->buscarDadosEndereco();
		$this->buscarDadosContato();
		echo '</form>';
		echo '<script src="/trabalhos/gti/bda1/js/jQuery.js"></script>';
		echo "<script>$('#phpForm').submit();</script>";
	}
	public function atualizarFuncionario(){
		$this->idEndereco=$this->pegarValor('endereco','funcionario','id',$this->idFuncionario);
		$this->idContato=$this->pegarValor('contato','funcionario','id',$this->idFuncionario);
		if($this->atualizarEndereco()===false||$this->atualizarContato()===false){return;}
		$mysqli=$this->conectar();
		$updFuncionario='update funcionario set nome="'.$this->nome.'",cpf="'.$this->cpf.'",obs="'.$this->obs.'",cargo="'.$this->cargo.'" where id='.$this->idFuncionario.';';
		if(!mysqli_query($mysqli,$updFuncionario)){
			die ('
			<script>
				alert("Não foi possível atualizar o funcionário:\n\n'.mysqli_error($mysqli).'");
				location.href="/trabalhos/gti/bda1/";
			</script>');
		}else{
			echo '<script>alert("Atualização do funcionário '.$this->nome.', de ID '.$this->idFuncionario.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
	public function excluirFuncionario(){
		if($this->verificarExistencia('funcionario','id',$this->idFuncionario)===false){return;}
		$this->nome=$this->pegarValor('nome','funcionario','id',$this->idFuncionario);
		$this->idContato=$this->pegarValor('contato','funcionario','id',$this->idFuncionario);
		$this->idEndereco=$this->pegarValor('endereco','funcionario','id',$this->idFuncionario);
		if($this->excluirEndereco()===false||$this->excluirContato()===false){return;}
		$delFuncionario='delete from funcionario where id='.$this->idFuncionario.';';
		$mysqli=$this->conectar();
		if(!mysqli_query($mysqli,$delFuncionario)){
			die ('<script>alert("Não foi possível excluir o funcionário:\n\n'.mysqli_error($mysqli).'");location.href="/trabalhos/gti/bda1/";</script>');
		}else{
			echo '<script>alert("Exclusão do funcionário '.$this->nome.', de ID '.$this->idFuncionario.', finalizada com sucesso!");location.href="/trabalhos/gti/bda1/";</script>';
		}
	}
}
?>