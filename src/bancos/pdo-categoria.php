<?php

function listaCategorias($pdo){
	try{
		$q = $pdo->prepare("SELECT * FROM `categorias`");

		$q->execute();
		
		return $q->fetchAll();
	}
	catch(PDOException $e){
		return $e->getMessage();
	}
}

function buscaCategoria($pdo, $id){
    $q = $pdo->prepare("SELECT * FROM `categorias` WHERE id = :id");
	$q->bindParam(':id',$id);
	
	$q->execute();
	
    return $q->fetch();
}

function removeCategoria($pdo, $id){
	$q = $pdo->prepare("DELETE FROM `categorias` WHERE id = :id");
	
	return $q->execute( array(':id' => $id) );
}

function alteraCategoria($pdo, $id, $nome){
    $q = $pdo->prepare("UPDATE `categorias` SET nome = :nome WHERE id = :id");
	
	$r = $q->execute( array(
		":nome" => $nome,
		":id" => $id
	));
	
    return $r;
}

function insereCategoria($pdo, $nome){
    $q = $pdo->prepare("INSERT INTO `categorias`(nome) VALUES (:nome)");
	
    return $q->execute( array(":nome" => $nome) );
}
?>
