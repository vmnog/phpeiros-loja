<?php
	session_start();
	require_once('../src/servidor/logado.php');
	
	if(UsuarioLogado()){
		header('Location: ../');
		exit;
	}
	
	if(isset($_SESSION['MSG'])){
		foreach($_SESSION['MSG'] as $c){
			echo "<b>$c</b><br />";	
		}
		unset($_SESSION['MSG']);
	}
	
	include ("../src/includes/cabecalho.2.php");
?>
<h1>Login</h1>
<br /><hr />
<form action="../src/servidor/logar.php" method="POST">

	<label for="email" >E-mail</label>
	<input type="email" name="email" id="email" required placeholder="Seu e-mail" autofocus />
	
	<br />
	
	<label for="pw" >Senha:</label>
	<input type="password" name="password" id="pw" required placeholder="Senha"/>
	
	<br />
	
	<input type="submit" value="Entrar"/>
</form>


<?php include("../src/includes/rodape.2.php"); ?>