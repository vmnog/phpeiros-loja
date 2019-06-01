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
<div class="container ">
        <table class="table">
			<form action="../src/servidor/logar.php" method="POST">
			<tr>
				<td>
					<label for="email" >E-mail</label>
				</td>	
				<td>
					<input type="email" class="form-control" name="email" id="email" required placeholder="Seu e-mail" autofocus />	
				</td>
			</tr>	
			<tr>
				<td>
					<label for="pw" >Senha:</label>
				</td>
				<td>
					<input type="password" class="form-control" name="password" id="pw" required placeholder="Senha"/>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" class="form-control" value="Entrar"/></td>
			</tr>
			</form>


<?php include("../src/includes/rodape.2.php"); ?>