<?php
	session_start();
	require_once('../src/servidor/logado.php');
	
	if(UsuarioLogado()){
		header('Location: ../');
		exit;
	}
	
	if(isset($_SESSION['MSG'])){
		foreach($_SESSION['MSG'] as  $c){
			echo "<b>$c</b><br />";
		}
		unset($_SESSION['MSG']);
	}
	
	include ("../src/includes/cabecalho.2.php");
?>
<h1>Cadastro</h1>
<br /><hr />
<form action="../src/servidor/cadastrar.php" method="POST">

	<label for="nome" >Nome:</label>
	<input type="text" name="nome" id="nome" required placeholder="Seu Nome" maxlength="20" autofocus />
	
	<br />

	<label for="snome" >SNome</label>
	<input type="text" name="sobreNome" id="snome" required placeholder="Seu sobre Nome" maxlength="50" />
	
	<br />

	<label for="email" >E-mail:</label>
	<input type="email" name="email" id="email" required placeholder="Seu e-mail" />
	
	<br />
	
	<label for="senha" >Senha:</label>
	<input type="password" name="password" id="senha" required placeholder="Senha"/>
	
	<!--<label>Repita a Senha:</label>
	<input type="password" name="password" required placeholder="Repetir a Senha"/>	-->
	
	<br />
	
	<h3>Genero: </h3>
	<label for="ch_f">Homem: </label>
	<input type="radio" name="genero" id="ch_f" value="m" required />
	
	<br />
	
	<label for="ch_m">Mulher:  </label>
	<input type="radio" name="genero" id="ch_m" value="f" required />
	
	
	<br />
	<br />
	
	<input type="submit" value="Entrar"/>
</form>


<?php include("../src/includes/rodape.2.php"); ?>