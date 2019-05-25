<?php
define('PASTA_IMAGENS','src/produtos/img/',true);

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
	
	}else if(array_search($f['type'],$MIME_Aceitos) === false){
		echo "Erro! Tipo de imagem inválida!<br />";
	}
	else if(is_uploaded_file($f['tmp_name']) === false){
		echo "Erro ao processar a imagem. 0x000003<br />";
	}
	else if(move_uploaded_file($f['tmp_name'],'../'.$tmpSrc) === false){
		echo "Erro ao mover o arquivo a pasta<br />";
	
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



?>