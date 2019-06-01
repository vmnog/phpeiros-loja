<?php

function UsuarioLogado()
{
	if(!isset($_SESSION['Logado']) && $_SESSION['Logado'] === false)return true;
	return false;
}

?>