<?php

//Utilizando tratamento de erro try/catch

function listaProdutos($conexao){
	try{
		$e = $conexao->prepare("select p.*,c.nome as categoria_nome from produtos as p join categorias as c on c.id = p.categoria_id");
		$e->execute();
	
		return $e->fetchAll();
	}
	catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

function insereProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado,$imagem){
	try{
		$e = $conexao->prepare("INSERT INTO `produtos`(nome, preco, descricao, categoria_id, usado, imagem,id) VALUES (:nome, :preco, :descricao, :categoria_id, :usado,:imagem,null)");
		
		$parametros  = array(
			":nome" => $nome,
			":preco" => $preco,
			":descricao" => $descricao,
			":categoria_id" => $categoria_id,
			":usado" => $usado,
			":imagem" => $imagem,
		);
	
		return $e->execute($parametros);
	}
	catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

function removeProduto($conexao, $id){
	try{
		$e = $conexao->prepare("DELETE FROM `produtos` WHERE id = :id");
		$e = $e->execute(array( ":id" => $id ));
		
		return $e;
	}
	catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

function buscaProduto($conexao, $id){
	try{
		$e = $conexao->prepare("SELECT * FROM `produtos` WHERE id = :id");

		$e->execute(array(':id' => $id));
		
		return "Erro: ".$e->fetchAll();
	}catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

function alteraProduto($conexao, $id, $nome, $preco, $descricao, $categoria_id, $usado){
	try{
		$e = $conexao->prepare("UPDATE `produtos` SET nome = :nome, preco = :preco, descricao = :descricao, categoria_id = :categoria_id , usado = :usado WHERE id = :id");
		
		$parametros = array(
			":nome" => $nome,
			":preco" => $preco,
			":descricao" => $descricao,
			":categoria_id" => $categoria_id,
			":usado" => $usado,
			":id"=>$id
		);
		
		$r = $e->execute($parametros);
		
		return $r;
	}catch(PDOException $e){
		return "Erro: ".$e->getMessage();
	}
}

?>