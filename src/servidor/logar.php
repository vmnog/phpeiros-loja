<?php
	session_start();
	#include("../bancos/conecta.php");
	include("../bancos/pdo-conecta.php");
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
	$pw = $_POST['password'];
	
	if(!$email){
		$_SESSION['MSG'][] = "Erro! E-mail invalido. Por favor, verifique a sintaxe do e-mail";
		header('Location: ../../Login/');
		exit;
	}
	
	if($pw < 4){
		$_SESSION['MSG'][] = "Erro! Sua senha possui menos de 4 caracteres.";
		header('Location: ../../Login/');
		exit;		
	}
	
	$Senha = cifrarSenha($pw);

	$r = $pdo->prepare("SELECT * from `Usuario` WHERE email = :email");
	$r->bindParam(':email',$email);
	
	$r->execute();
	
	$q = $r->fetch();
	
	if(empty($q)){
		$_SESSION['MSG'][] = "Usuário inexistente ou senha inválida!";
		header('Location: ../../Login/');
		exit;
	}

	if($q['senha'] !== $Senha){
		$_SESSION['MSG'][] = "Usuário ou senha inválida!";
		header('Location: ../../Login/');
		exit;
	}
	
	$_SESSION['Logado'] = true;
	$_SESSION['nome'] = $q['nome'];
	$_SESSION['id'] = $q['id'];
	$_SESSION['imagem'] = $q['imagem'];
	$_SESSION['cargo'] = $q['cargo'] ?? 0;
	$_SESSION['PLogado'] = false;
	$_SESSION['sessao_limite']  = time() + 3600; // 1h
	
	
	if(isset($_POST['ficarLogado'])){
		$_SESSION['PLogado'] = true;
	}
	
	header('Location: ../../');
?>