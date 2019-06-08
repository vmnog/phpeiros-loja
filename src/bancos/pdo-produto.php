<?php

//Utilizando tratamento de erro try/catch

function listaProdutos($pdo){
	try{
		$e = $pdo->prepare("select p.*,c.nome as categoria_nome from produtos as p join categorias as c on c.id = p.categoria_id");
		$e->execute();
	
		return $e->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

function insereProduto($pdo, $nome, $preco, $descricao, $categoria_id, $usado,$imagem){
	try{
		$r = $pdo->prepare("INSERT INTO `produtos`(nome, preco, descricao, categoria_id, usado, imagem) VALUES (:nome, :preco, :descricao, :categoria_id, :usado,:imagem)");
		
		$r->bindParam(":nome",$nome);
		$r->bindParam(":preco",$preco);
		$r->bindParam(":descricao",$descricao);
		$r->bindParam(":categoria_id",$categoria_id);
		$r->bindParam(":usado",$usado);
		$r->bindParam(":imagem",$imagem);
	
		return $r->execute();
	}
	catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

function removeProduto($pdo, $id){
	$r = $pdo->prepare("SELECT imagem FROM `produtos` WHERE id = :id");
	
	$r->bindParam(":id",$id);

	$r->execute();

	$q = $r->fetch();
	
	if($q[0] != 'default.jpg'){
		$file = '../src/produtos/img/'.$q[0];

		if(file_exists($file))unlink($file);	
	}
	try{
		$e = $pdo->prepare("DELETE FROM `produtos` WHERE id = :id");
		$e = $e->execute(array( ":id" => $id ));
		
		return $e;
	}
	catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

function buscaProduto($pdo, $id){
	try{
		$e = $pdo->prepare("SELECT * FROM `produtos` WHERE id = :id");
		$e->bindParam(':id',$id);

		$e->execute();
		
		return $e->fetch();
	}catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

function alteraProduto($pdo, $id, $nome, $preco, $descricao, $categoria_id, $usado){
	try{
		$e = $pdo->prepare("UPDATE `produtos` SET nome = :nome, preco = :preco, descricao = :descricao, categoria_id = :categoria_id , usado = :usado WHERE id = :id");
		
		$e->bindParam(":nome",$nome);
		$e->bindParam(":preco",$preco);
		$e->bindParam(":descricao",$descricao);
		$e->bindParam(":categoria_id",$categoria_id);
		$e->bindParam(":usado",$usado);
		$e->bindParam(":id",$id);
		
		
		return $e->execute();
	}catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

?>