<?php
/*
	@Verifica login do usuário.
*/


$_SESSION['Logado'] = $_SESSION['Logado'] ?? false;
$_SESSION['cargo'] = $_SESSION['cargo'] ?? 0;

function UsuarioLogado():bool{
	if($_SESSION['Logado'] === true)return true;
	return false;
}
?>