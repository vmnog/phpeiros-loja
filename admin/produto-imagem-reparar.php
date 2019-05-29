<?php
	include("../src/processa-imagem.php");
	include("../src/bancos/global.php");
	include ("../src/includes/cabecalho.2.php");


	if(!isset($_POST['imagemID']) or empty($_POST['imagemID']) or !is_numeric($_POST['imagemID'])){
		echo "<b>Acesso Negado!</b>: Se for um engano, por favor, entre em contato com os Administradores!";
		exit;
	}
	
	
	
	if(!isset($_FILES['imagem'])){
		echo '<b>Erro Interno</b>: O arquivo enviado não foi identificado pelo servidor.<br />
		<a href="reparar-imagem.php">Tente novamente</a>';
	}else{
		$img = processaImagem($_FILES['imagem']);
		if(!$img['ok']){
			echo '<a href="reparar-imagem.php">Tente novamente</a>';		
		}
		else{
			$sql = "UPDATE `produtos` SET imagem = '{$img['name']}' WHERE id = {$_POST['imagemID']}";
			if(mysqli_query($conexao,$sql) === true){
			
				echo ' <img src="../'.$img["src"].'" width="350px" height="350px" /><br />
				<p style="color:green">
					Imagem Alterada com sucesso!
					<br /><br /><hr />
				</p>';
			 }else{
				echo '<p style="color:red;">
					<b>Erro</b>: <?=mysqli_error($conexao);?>
					<br /><a href="reparar-imagem.php">Tente novamente</a>
					</p>';
			 }	
		}
	}

	if(isset($_POST['t']))
		echo '<a href="reparar-imagem.php">Continuar Alterando '.$_POST['t'].' imagens</a>';

	include ("../src/includes/rodape.2.php");
?>
