<?php
include ("../src/includescabecalho.php");
require_once("../src/bancos/global.php");

$id = $_POST['id'];
removeCategoria($pdo, $id);
header("Location: categoria-lista.php");

die();
?>
