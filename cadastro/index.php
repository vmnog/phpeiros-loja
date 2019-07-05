<?php
	session_start();
	require_once('../src/servidor/usuario.php');
	
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
<h2>Cadastro</h2>
<br /><hr />
<div class="container ">
        <table class="table">
		<form action="../src/servidor/cadastrar.php" method="POST">
		<tr>
			<td>
				<label for="nome" >Nome:</label>
			</td>
			<td>
				<input type="text" name="nome" id="nome" class="form-control" required placeholder="Seu Nome" maxlength="20" autofocus />
			</td>
		</tr>
		<tr>
			<td>
				<label for="snome" >SobreNome</label>
			</td>
			<td>
				<input type="text" name="sobreNome" class="form-control" id="snome" required placeholder="Seu sobre Nome" maxlength="50" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="email" >E-mail:</label>
			</td>
			<td>
				<input type="email" name="email" class="form-control" id="email" required placeholder="Seu e-mail" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="senha" >Senha:</label>
			</td>
			<td>
				<input type="password" name="password" class="form-control" id="senha" required placeholder="Senha"/>
			</td>
		</tr>
	
		<!--<tr>
			<td><label>Repita a Senha:</label></td>
			<td><input type="password" name="password" required placeholder="Repetir a Senha"/></td>
		</tr>-->
		<tr>
			<td>Genero: </td>
			<td>
				<label for="ch_f">Homem: </label>
				<input type="radio" name="genero" id="ch_f"  value="m" required />
				<label for="ch_m">Mulher:  </label>
				<input type="radio" name="genero" id="ch_m" value="f" required />
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" class="form-control" value="Entrar"/></td>
		</tr>
	
	
</form>


<?php include("../src/includes/rodape.2.php"); ?>