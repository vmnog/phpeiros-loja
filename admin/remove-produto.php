<?php
	session_start();
    
	include ("../src/includes/cabecalho.php");
	require_once("../src/bancos/global.php");

    if(!isset($_POST['id']) or empty($_POST['id']) or !is_numeric($_POST['id'])){
		header("Location: produto-lista.php");
		exit;
	}
	
    removeProduto($conexao, $_POST['id']);
	
    header("Location: produto-lista.php");
	$_SESSION['msg']['removido'] = true;

    die();
?>
