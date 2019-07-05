<?php
	/*
		@Funções do usuário
	
	*/

	if(!isset($_SESSION) or session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}

	function UsuarioLogado():bool
	{
		$_SESSION['Logado'] = $_SESSION['Logado'] ?? false;
		
		if(isset($_SESSION['Logado']) && $_SESSION['Logado'] === true)
		{
			
			if($_SESSION['PLogado'] === false)
			{
				if($_SESSION['sessao_limite'] < time()){
					usuario_deslogar();
					return false;
				}
			}
			return true;
		}
		return false;
	}
	
	function usuarioCargo($cargo=-1):int
	{
		if($cargo === -1)
			$_SESSION['cargo'] = $_SESSION['cargo'] ?? 0;
		else
		{
			$_SESSION['cargo'] = $cargo;
			#usuarioDbAtualizar($_SESSION['id'],'cargo',$cargo);
		}
	}
	
	function usuario_deslogar():bool
	{
		unset($_SESSION);
		return session_destroy();
	}

?>