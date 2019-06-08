<?php
define('PASTA_IMAGENS','src/produtos/img/');

function processaImagem($f):array
{
	$name = 'default.png';
	$src = PASTA_IMAGENS . $name;
	$ok = false;
	
	$ext = explode('.',$f['name']);
	$ext = end($ext); //Obtem extensão
	
	$tmpName = md5(random_bytes(8)).'.'. $ext;
	$tmpSrc = PASTA_IMAGENS . $tmpName ; //Cria md5 aleatório.
	
	
	$MIME_Aceitos = array( 'image/jpeg','image/png' );

	if($f['error'] !== 0) {
		echo ('<br />Erro ao processar a imagem: Num erro: '.$f['error'].'<br />');
	
	}
	else if(array_search($f['type'],$MIME_Aceitos) === false){
		echo "Erro! Tipo de imagem inválida!<br />";
	}
	else if(verificaImagem($f['tmp_name']) === false){
		echo "Erro! Imagem Inválida<br />";
	}
	else if(is_uploaded_file($f['tmp_name']) === false){
		echo "Erro ao processar a imagem. Arquivo não identificado no servidor Cod: 0x000003<br />";
	}
	else if(move_uploaded_file($f['tmp_name'],'../'.$tmpSrc) === false){
		echo "Erro ao mover o arquivo paraa pasta<br />";
	}
	else{
		$src = $tmpSrc;
		$name = $tmpName;
		$ok = true;
	}
	
	return array(
		"src"  => $src,
		"name" => $name,
		"ok" => $ok,
	);
}

function verificaImagem($file):bool
{
	try{
		if(!file_exists($file))return false;
		
		$mime = exif_imagetype($file);
		
		$img = false;
		
		switch($mime)
		{
			case IMAGETYPE_JPEG:
				$img = @imagecreatefromjpeg($file);
			break;
			case  IMAGETYPE_PNG:
				$img = @imagecreatefrompng($file);
			break;
			case IMAGETYPE_GIF:
				$img = @imagecreatefromgif($file);
			break;
			default:
				return false;
		}
		
		if($img)return true;
	}
	catch(Exception $e){
		echo "<fieldset><legend>Aviso</legend> ".$e->getMessage().'</fieldset>';
	}	
	return false;
}


?>