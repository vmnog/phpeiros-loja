<?php


	function cifrarSenha($senha):string
	{
		return hash("sha256",md5($senha));
	}
?>