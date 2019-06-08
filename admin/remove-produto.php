<?php
	session_start();
    
	include ("../src/includes/cabecalho.2.php");
	require_once("../src/bancos/global.php");

    if(!isset($_POST['id']) or empty($_POST['id']) or !is_numeric($_POST['id'])){
		header("Location: produto-lista.php");
		exit;
	}
	
    removeProduto($pdo, $_POST['id']);
	
    header("Location: produto-lista.php");
	$_SESSION['msg']['removido'] = true;

    die();
?>
