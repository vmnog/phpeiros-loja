<?php
	session_start();
	include("../bancos/conecta.php");
	#include("../bancos/pdo.conecta.php");
	include("funcoes-sessao.php");

	if($_SERVER['REQUEST_METHOD'] !== 'POST'){
		http_response_code(405);//Metodo não permitido;
		exit;
	}
	
	if(!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password'])){
		echo "<b>Acesso negado: </b>Ocorreu um erro no sistema ou você está tentando fazer algo que não devia.<br />
		Caso seja um engano, por favor, contate os administradores";
		exit;
	}

	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	
	if(!$email){
		$_SESSION['MSG'][] = "Erro! E-mail invalido. Por favor, verifique a sintaxe do e-mail";
		header('Location: ../../Login/');
		exit;
	}
	
	$Senha = cifrarSenha($_POST['password']);


	$sql = "SELECT * from `Usuario` WHERE email = '{$_POST['email']}'";
	
	$q = mysqli_query($conexao,$sql);
	
	
	if(empty($q) || mysqli_num_rows($q) <= 0){
		$_SESSION['MSG'][] = "Usuário inexistente ou senha inválido(s)!";
		header('Location: ../../Login/');
		exit;
	}
	
	$q = mysqli_fetch_assoc($q);
	
	if($q['senha'] !== $Senha){
		$_SESSION['MSG'][] = "Usuário ou senha inválido(s)!";
		header('Location: ../../Login/');
		exit;
	}
	
	$_SESSION['Logado'] = true;
	$_SESSION['nome'] = $q['nome'];
	$_SESSION['id'] = $q['id'];
	$_SESSION['imagem'] = $q['imagem'];
	$_SESSION['cargo'] = $q['cargo'];
	header('Location: ../../');
?>