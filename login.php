<html>
	<head>
		<meta charset="utf-8" />
		<title>Login para SEFUNC BD</title>
		<script src="js/jQuery.js"></script>
		<script>
		$(document).ready(function (){
			$('body').css('opacity', '0').fadeTo(600, 1,'swing');
		});
		function mudarAcao(){
			switch($('#mudaAcao').val()){
				case "Cadastre-se":
					$('#acaoSessao').val("cadastrar");
					$('#mudaAcao').val("Fazer LogIn");
					$('button').html("Cadastrar");
					break;
				case "Fazer LogIn":
					$('#acaoSessao').val("login");
					$('#mudaAcao').val("Cadastre-se");
					$('button').html("Fazer LogIn");
					break;
			}
		}
		</script>
		<link rel="stylesheet" href="css.css" />
		<style>
			body{
				padding:2% 0;
				overflow:hidden;
				background:#CCC;
				text-align:center}
			form{
				font-size:25pt;
				color:#CCC;}
			button{
				color:#666;
				background:#CCC;}
			#mudaAcao{
				cursor:pointer;
				position:absolute;
				margin-top:110px; padding:5px;
				border:none;
				color:#666;
				background:#CCC;
				border-radius:5px;
				transition:.3s}
			#mudaAcao:hover,button:hover{
				color:#CCC;
				background:#666;
				box-shadow:0 0 15px #CCC;}
			.title{
				background:#CCC;
				color:#666;
				padding:2px 0}
		</style>
		<?php
			session_start();
			if(!empty($_SESSION['usuario'])||isset($_SESSION['usuario'])){
				header("location:/trabalhos/gti/bda1/");
			}
		?>
	</head>
	<body>
		<form class="logIn" action="/trabalhos/gti/bda1/php/sessionManager.php" method="POST" autocomplete="off">
			<p class="title">Login para SEFUNC BD</p>
			<p>
				<label for="usuario">Usuário</label><br>
				<input type="text" id="usuario" name="usuario" class="field" required>
			</p><p>
				<label for="senha">Senha</label><br>
				<input type="password" id="senha" name="senha" class="field" required>
			</p>
			<input type="hidden" id="acaoSessao" name="acaoSessao" value="login">
			<input type="button" id="mudaAcao" name="mudaAcao" onclick="mudarAcao();" value="Cadastre-se">
			<button>Fazer LogIn</button>
		</form>
	</body>
</html>