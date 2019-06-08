<?php
/*
	Cria a conta do usuário.
*/

	session_start();
	#include("../bancos/conecta.php");
	include("../bancos/pdo-conecta.php");
	include("funcoes-sessao.php");

	if($_SERVER['REQUEST_METHOD'] !== 'POST'){
		http_response_code(405);//Metodo não permitido;
		exit;
	}
	
	if(
		!isset($_POST['email']) || empty($_POST['email']) || 
		!isset($_POST['password']) || empty($_POST['password']) ||
		!isset($_POST['nome']) || empty($_POST['nome']) ||
		!isset($_POST['sobreNome']) || empty($_POST['sobreNome']) ||
		!isset($_POST['genero']) || empty($_POST['genero'])
	
	){
		echo "<b>Acesso negado: </b>Ocorreu um erro no sistema ou você está tentando fazer algo que não devia.<br />
		Caso seja um engano, por favor, contate os administradores";
		exit;
	}

	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
	$sNome = filter_input(INPUT_POST, 'sobreNome', FILTER_SANITIZE_STRING);
	
	$genero = 0;
	if(is_numeric($_POST['genero']))
		if($_POST['genero'] >= 0 && $_POST['genero'] <= 2)
			$genero = $_POST['genero']; //masculino = 1 | feminino = 2 | Não informado = 0	

	if(!$email){
		$_SESSION['MSG'][] = "Erro! E-mail invalido. Por favor, verifique a sintaxe do e-mail";
		header('Location: ../../Cadastro/');
		exit;
	}
	
	
	//Verifica se a conta já existe
	$r = $pdo->prepare("SELECT * FROM `usuario` WHERE email = ':email'");
	
	$r->execute(array(":email", $email));
	
	$val = $r->fetchAll();
	if(count($val) > 0 ){
		$_SESSION['MSG'][] = 'Já existe um e-mail cadastrado nesta conta!<br /> Tente <a href="../Login/">Entrar</a>';
		header("Location: ../../Cadastro/");
		exit;
	}
	
	$senha = cifrarSenha($_POST['password']);
	
	try{
		$r = $pdo->prepare("INSERT INTO `usuario`(nome,email,senha,sobrenome,genero) 
		VALUES(:nome,:email,:senha,:sNome,:genero)");
		$r->bindParam(":nome",$nome);
		$r->bindParam(":email",$email);
		$r->bindParam(":senha",$senha);
		$r->bindParam(":sNome",$sNome);
		$r->bindParam(":genero",$genero);

		$q = $r->execute();
	}
	catch(PDOException $e){
		echo "<b>Erro fatal</b>:  Sua conta não pode ser criada por um erro interno em nosso sistema.<br />Por favor, contate os administradores<hr />Erro interno[BD]: ".$e->getMessage();
		exit;
	}

	header("Location: ../../login");
?>