<?php

function listaCategorias($conexao){
	try{
		$q = $conexao->prepare("SELECT * FROM `categorias`");

		$q->execute();
		
		return $q->fetchAll();
	}
	catch(PDOException $e){
		return $e->getMessage();
	}
}

function buscaCategoria($conexao, $id){
    $q = $conexao->prepare("SELECT * FROM `categorias` WHERE id = :id");
	
	$q->execute( array(':id' => $id) );
	
    return $q->fetchAll();
}

function removeCategoria($conexao, $id){
	$q = $conexao->prepare("DELETE FROM `categorias` WHERE id = :id");
	
	return $q->execute( array(':id' => $id) );;
}

function alteraCategoria($conexao, $id, $nome){
    $q = $conexao->prepare("UPDATE `categorias` SET nome = :nome WHERE id = :id");
	
	$r = $q->execute( array(
		":nome" => $nome,
		":id" => $id
	);
	
    return $r;
}

function insereCategoria($conexao, $nome){
    $q = $conexao->prepare("INSERT INTO `categorias`(nome) VALUES (:nome)");
	
    return $q->execute( array(":nome" => $nome) );
}
?>
