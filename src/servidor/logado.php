<?php
/*
	@Verifica login do usuário.
*/

$_SESSION['Logado'] = $_SESSION['Logado'] ?? false;

function UsuarioLogado(){
	if($_SESSION['Logado'] === true)return true;
	return false;
}

?>