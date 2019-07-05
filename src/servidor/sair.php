<?php require_once('usuario.php'); ?>
<?php
	if(usuario_deslogar())
		header('Location: ../../Login/');
	else
		echo "<b>Erro ao deslogar!</b> <br />Tente recarregar a página!";
?>