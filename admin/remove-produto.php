<?php
    include ("../src/includes/cabecalho.php");
	require_once("../src/bancos/global.php");

    $id = $_POST['id'];
    removeProduto($conexao, $id);
    header("Location: produto-lista.php?removido=true");

    die();
?>
