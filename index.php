<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Thiago Jourdan" />
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/sweetalert.css" />
        <link rel="stylesheet" href="css/mainStyle.css" />
        <title>Software teste de banco de dados de estoque</title>
        <script src="js/jQuery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/sweetalert.js"></script>
        <script src="js/maskedInput.js"></script>
        <script src="js/priceFormat.js"></script>
        <script src="js/js.js"></script>
        <script src="js/nav.js"></script>
        <script src="js/AJAX/AJAXManager.js"></script>
        <?php
            session_start();
            if(empty($_SESSION['usuario'])||!isset($_SESSION['usuario'])) header("location:/trabalhos/gti/bda1/login.php");
            else{
                if($_SESSION['tempo']<(time()-1000)){
                    session_unset();
                    echo
                    '<script>
                        $(document).ready(function(){
                            swal({
                                title:"Sua sessão expirou!",
                                type:"warning",
                                time:1000
                            },function(){
                                location.href="/trabalhos/gti/bda1/login.php";
                            });
                        });
                    </script>';
                }else{
                    $_SESSION['tempo']=time();
                    $usuario=$_SESSION['usuario'];
                }
            }
        ?>
    </head><!-- Head -->
    <body>
        <div class="topo">
            <span class="logOut"><?php if(isset($_SESSION['usuario']))echo "$usuario, fazer <span>logout</span>."; ?></span>
            <h1>SEFUNC BD</h1>
            <h3>Software para Exemplo de Funcionamento do Banco de Dados</h3>
        </div>
        <div class="esquerda" align="left">
            <ul>
                <li class="item navFuncionario">Funcionário
                    <ul>
                        <li class="cadastrar">Cadastrar</li>
                        <li class="buscarDados">Buscar Dados</li>
                        <li class="excluir">Excluir</li>
                    </ul>
                </li>
                <li class="item navCliente">Cliente
                    <ul>
                        <li class="cadastrar">Cadastrar</li>
                        <li class="buscarDados">Buscar Dados</li>
                        <li class="excluir">Excluir</li>
                    </ul>
                </li>
                <li class="item navFornecedor">Fornecedor
                    <ul>
                        <li class="cadastrar">Cadastrar</li>
                        <li class="buscarDados">Buscar Dados</li>
                        <li class="excluir">Excluir</li>
                    </ul>
                </li>
                <li class="item navRemessa">Remessa
                    <ul><li class="cadastrar">Cadastrar</li></ul>
                </li>
                <li class="item navProduto">Produto
                    <ul>
                        <li class="cadastrar">Cadastrar</li>
                        <li class="buscarDados">Buscar Dados</li>
                    </ul>
                </li>
                <li class="item navEstoque">Estoque
                    <ul>
                        <li class="inserir">Inserir itens</li>
                        <li class="retirar">Retirar itens</li>
                    </ul>
                </li>
            </ul>
        </div><!-- Esquerda -->
        <div class="direita">
            <form class="mainForm" autocomplete="off">
                <div class="fornecedor"><!-- Fornecedor -->
                    <h3></h3>
                    <p class="campoIdFornecedor">
                        <label for="idFornecedor">ID do Fornecedor</label><br>
                        <input class="field idFornecedor" type="text">
                    </p><p>
                        <label for="nomeFantasia">Nome Fantasia</label><br>
                        <input class="field nomeFantasia" type="text">
                    </p><p>
                        <label for="cnpj">CNPJ</label><br>
                        <input class="field cnpj" type="text">
                    </p>
                </div>
                <div class="cliente"><!-- Cliente -->
                    <h3></h3>
                    <p class="campoIdCliente">
                        <label for="idCliente">ID do Cliente</label><br>
                        <input class="field idCliente" type="text">
                    </p><p>
                        <label for="nomeCliente">Nome</label><br>
                        <input class="field nomeCliente" type="text">
                    </p><p>
                        <label for="cpfCliente">CPF</label><br>
                        <input class="field cpfCliente" type="text">
                    </p><p>
                        <label for="obsCliente">Observação</label><br>
                        <input class="field obsCliente" type="text" value="S. Obs.">
                    </p>
                </div>
                <div class="funcionario"><!-- Funcionário -->
                    <h3></h3>
                    <p class="campoIdFuncionario">
                        <label for="idFuncionario">ID do Funcionário</label><br>
                        <input class="field idFuncionario" type="text">
                    </p><p>
                        <label for="nomeFuncionario">Nome</label><br>
                        <input class="field nomeFuncionario" type="text">
                    </p><p>
                        <label for="cpfFuncionario">CPF</label><br>
                        <input class="field cpfFuncionario" type="text">
                    </p><p>
                        <label for="cargo">Cargo</label><br>
                        <input class="field cargo" type="text">
                    </p><p>
                        <label for="obsFuncionario">Observação</label><br>
                        <input class="field obsFuncionario" type="text" value="S. Obs.">
                    </p>
                </div>
                <div class="contato"><!-- Contatos -->
                    <h3>Contatos</h3>
                    <p>
                        <label for="email">E-mail</label><br>
                        <input class="field email" type="email">
                    </p><p>
                        <label for="telFixo">Telefone Fixo</label><br>
                        <input class="field telFixo" type="text">
                    </p><p>
                        <label for="telCel">Telefone Celular</label><br>
                        <input class="field telCel" type="text">
                    </p>
                </div>
                <div class="endereco"><!-- Endereço -->
                    <h3>Endereço</h3>
                    <p>
                        <label for="rua">Rua</label><br>
                        <input class="field rua" type="text">
                    </p><p>
                        <label for="numero">Número</label><br>
                        <input class="field numero" type="text">
                    </p><p>
                        <label for="complemento">Complemento</label><br>
                        <input class="field complemento" type="text" value="S. Comp.">
                    </p><p>
                        <label for="cep">CEP</label><br>
                        <input class="field cep" type="text">
                    </p><p>
                        <label for="bairro">Bairro</label><br>
                        <input class="field bairro" type="text">
                    </p><p>
                        <label for="cidade">Cidade</label><br>
                        <input class="field cidade" type="text">
                    </p><p>
                        <label for="estado">Estado (UF)</label><br>
                        <input class="field estado" type="text">
                    </p>
                </div>
                <div class="remessa"><!-- Remessa -->
                    <h3></h3>
                    <p>
                        <label for="idProdutoRem">ID do produto</label><br>
                        <input class="field idProdutoRem" type="text">
                    </p><p>
                        <label for="qtdProdRem">Quantidade do produto (un.)</label><br>
                        <input class="field qtdProdRem" type="text">
                    </p><p>
                        <label for="idFornecedorRem">ID do fornecedor</label><br>
                        <input class="field idFornecedorRem" type="text">
                    </p><p>
                        <label for="dataPedido">Data do Pedido</label><br>
                        <input class="field dataPedido" type="date">
                    </p><p>
                        <label for="dataPagamento">Data do Pagamento</label><br>
                        <input class="field dataPagamento" type="date">
                    </p><p>
                        <label for="dataEntrega">Data da Entrega</label><br>
                        <input class="field dataEntrega" type="date">
                    </p>
                </div>
                <div class="produto"><!-- Produto -->
                    <h3></h3>
                    <p class="campoIdProduto">
                        <label for="idProduto">ID do produto</label><br>
                        <input class="field idProduto" type="text">
                    </p><p>
                        <label for="idRemessa">ID da remessa</label><br>
                        <input class="field idRemessa" type="text">
                    </p><p>
                        <label for="nomeProd">Nome do produto</label><br>
                        <input class="field nomeProd" type="text">
                    </p><p>
                        <label for="descrProd">Descrição do produto</label><br>
                        <textarea class="descrProd"></textarea>
                    </p><p>
                        <label for="custoProd">Custo do produto</label><br>
                        <input class="field custoProd" type="text">
                    </p><p>
                        <label for="valorVenda">Valor de venda do produto</label><br>
                        <input class="field valorVenda" type="text">
                    </p>
                </div>
                <div class="estoque"><!-- Estoque -->
                    <h3></h3>
                    <p class="campoIdFuncEstq">
                        <label for="idFuncionarioEstq">ID do funcionário</label><br>
                        <input class="field idFuncionarioEstq" type="text">
                    </p><p>
                        <label for="idProdutoEstq">ID do produto</label><br>
                        <input class="field idProdutoEstq" type="text">
                    </p><p>
                        <label for="qtdProdEstq">Quantidade do produto (un.)</label><br>
                        <input class="field qtdProdEstq" type="text">
                    </p><p class="campoDataSaidaEstq">
                        <label for="dataSaida">Data Saída</label><br>
                        <input class="field dataSaida" type="date">
                    </p>
                </div>
                <input type="hidden" class="acao">
                <input type="hidden" class="alvo">
                <button class="goBtn" />
                <button type="reset" class="resetBtn">Limpar campos</button>
            </form>
        </div><!-- Direita -->
    </body><!-- Body -->
</html>