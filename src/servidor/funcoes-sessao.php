<?php


	function cifrarSenha($senha,$pw2='mskwqopqwekjwioq'):string{
		
		$senha .= hash('sha256',md5($senha).$pw2);
		$senha = hash('sha384',strrev($pw2.$senha));
		
		return hash("sha512", strrev($senha).md5($senha.$pw2) );
	}
?>