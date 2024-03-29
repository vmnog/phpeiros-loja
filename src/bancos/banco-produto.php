<?php
function listaProdutos($conexao){
    $produtos = [];
    $resultado = mysqli_query($conexao, "select p.*,c.nome as categoria_nome from produtos as p join categorias as c on c.id = p.categoria_id");
    while ($produto = mysqli_fetch_assoc($resultado)){
        array_push($produtos, $produto);
    }
	
    return $produtos;
}

function insereProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado,$image){
    $query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado,imagem) VALUES ('{$nome}', '{$preco}', '{$descricao}', '{$categoria_id}', '{$usado}','{$image}')";
    return mysqli_query($conexao,$query);
}

function removeProduto($conexao, $id){
	$q = "SELECT imagem FROM `produtos` WHERE id = {$id}";
	$q = mysqli_query($conexao,$q);
	$q = mysqli_fetch_row($q);
	
	if($q[0] != 'default.jpg'){
		$file = '../src/produtos/img/'.$q[0];

		if(file_exists($file))unlink($file);
	}

	$query = "delete from produtos where id = {$id}";
    return mysqli_query($conexao, $query);
}

function buscaProduto($conexao, $id){
    $query = "select * from produtos where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

function alteraProduto($conexao, $id, $nome, $preco, $descricao, $categoria_id, $usado){
    $query = "UPDATE produtos SET nome = '{$nome}', preco = '{$preco}', descricao = '{$descricao}', categoria_id = '{$categoria_id}' , usado = '{$usado}' WHERE id = '{$id}'";
    return mysqli_query($conexao,$query);
}

