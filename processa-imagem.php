<?php
define('PASTA_IMAGENS','src/produtos/img/',true);

function processaImagem($f):array
{
	$name = 'default.png';
	$src = PASTA_IMAGENS;
	
	$MIME_Aceitos = array( 'image/jpeg','image/png' );

	if($f['error'] !== 0) die('Erro ao processar a imagem: Num erro: '.$f['error']);
	
	if(array_search($f['type'],$MIME_Aceitos) === false){
		echo "Erro! Tipo de imagem inválida!<br />Mover Para alternativo que permite corrigir o erro!";
	}
	
	if(is_uploaded_file($f['tmp_name']) === false)die("Erro ao processar a imagem. 0x000003");
	
	if(move_uploaded_file($f['tmp_name'],$src) === true){
		$ext = explode('.',$f['name']);
		$ext = end($ext); //Obtem extensão
		
		$name = md5(random_bytes(8)).'.'. $ext;
		$src = PASTA_IMAGENS . DIRECTORY_SEPARATOR . $name ; //Cria md5 aleatório.
					
	}
	
	return array(
		"src"  => $src,
		"name" => $name,
	);
}



?>