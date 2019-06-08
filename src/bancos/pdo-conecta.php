<?php
/*
	@Descrição: Estabelece conexão com banco de dados e, se for o caso, o configura;
*/

define('host','127.0.0.1');
define('username','root');
define('password','');
define('dbname','loja');

try
{
	$pdo = new PDO('mysql:HOST='.host.';charset=utf8',username,password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//Criação:

	$sql = "CREATE DATABASE IF NOT EXISTS ".dbname;

	if($pdo->exec($sql) == 1)
	{
		$pdo->exec('use '.dbname);
		
		$sql = "CREATE TABLE IF NOT EXISTS Produtos (
				id int AUTO_INCREMENT PRIMARY KEY,
				nome varchar(255),
				preco decimal(10,2),
				descricao text,
				categoria_id int,
				imagem varchar(216),
				usado boolean default 0
				)";
		
		$pdo->exec($sql);
		
		$sql = "CREATE TABLE IF NOT EXISTS categorias (
			id int AUTO_INCREMENT PRIMARY KEY,
			nome varchar(255) NOT NULL
		)";
		
		$pdo->exec($sql);
		
		$sql = "CREATE TABLE IF NOT EXISTS Usuario (
			id int AUTO_INCREMENT PRIMARY KEY,
			nome varchar(50),
			email varchar(80),
			senha varchar(550),
			imagem varchar(50) default 'padrao.png',
			sobrenome varchar(50),
			genero int,
			cargo int default 1
		)";
		
		$pdo->exec($sql);
		
		echo "LOJA, PRODUTOS e CATEGORIAS criados com sucesso!";
	}
	else
		$pdo->exec('use '.dbname);

}catch(PDOException $e){
	echo "<b>Aviso!</b> Erro na conexão com banco de dados <b>MSG:</b> ".$e->getMessage();
}

?>