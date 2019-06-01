<?php
/*
	Cria a conta do usuário.
*/

	session_start();
	include("../bancos/conecta.php");
	#include("../bancos/pdo.conecta.php");
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
	
	
	$genero = $_POST['genero'] == 'm'?  1 : $_POST['genero'] == "f" ? 2 : 0; //masculino = 1 | feminino = 2 | outro = 0

	if(!$email){
		$_SESSION['MSG'][] = "Erro! E-mail invalido. Por favor, verifique a sintaxe do e-mail";
		header('Location: ../../Cadastro/');
		exit;
	}
	
	$q = mysqli_query($conexao,"SELECT * FROM `usuario` WHERE email = '$email'");
	
	if(mysqli_num_rows($q) > 0 ){
		$_SESSION['MSG'][] = 'Erro na criação da conta! Talvez está conta já exista! Tente <a href="../Login/">Entrar</a>';
		header("Location: ../../Cadastro/");
		exit;
	}	
	
	$senha = cifrarSenha($_POST['password']);
	
	$sql = "INSERT INTO `usuario`(nome,email,senha,sobrenome,imagem,id,genero) VALUES('$nome','$email','$senha','$sNome','padrao.png',null,$genero)";

	$q = mysqli_query($conexao,$sql);


	header("Location: ../../login");
?>