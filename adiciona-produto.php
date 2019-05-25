<?php
    include ("cabecalho.php");
    include ("conecta.php");
    include ("banco-produto.php");
    include ("banco-categoria.php");
	include ("processa-imagem.php");

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    $categoria_id = $_POST["categoria_id"] ?? '0';
	
    if(array_key_exists('usado', $_POST)){
        $usado = 1;
    } else {
        $usado = 0;
    }
	
	if(isset($_FILES['imagem'])){
		$img = processaImagem($_FILES['imagem']);
		echo '<img src="'.$img['src'].'" width="300px" height="300px" /><br />';	
	}
	
    $conexao = mysqli_connect('localhost', 'root', '', 'loja');

    if (insereProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado,$img['name'])){ ?>
        <p class="text-success">O produto <?= $nome; ?> foi adicionado com o preço de R$<?= $preco; ?> !</p>
    <?php   }else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger"> O produto <?= $nome; ?> não foi adicionado: <?= $msg ?> </p>
    <?php
        }
    ?>

    <a href="produto-formulario.php"><button type="button" class="btn btn-primary">Voltar</button></a>
    <a href="produto-lista.php"><button type="button" class="btn btn-primary">Listar Produtos</button></a>

<?php include ("rodape.php"); ?>
