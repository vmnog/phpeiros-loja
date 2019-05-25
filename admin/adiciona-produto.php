<?php
    include ("../src/includes/cabecalho.2.php");
	require_once("../src/bancos/global.php");
	include ("../src/processa-imagem.php");

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    $categoria_id = $_POST["categoria_id"] ?? '0';
	
	$usado = isset($_POST['usado']) ? 1 : 0;
	
	if(isset($_FILES['imagem'])){
		$img = processaImagem($_FILES['imagem']);
		echo '<img src="../'.$img['src'].'" width="300px" height="300px" /><br />';	
	}
	
	if($img['ok'] === false)
		echo '<p><b>Atenção!</b> A imagem que você enviou não foi processada corramente.<br />
		Uma imagem temporária está visivel atualmente, clique no link para corrir a imagem
		<a href="reparar-imagem.php" target="_blank" title="Clique para corrigir a imagem">Corrigir Imagem</a></p>';
	
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

<?php include ("../src/includes/rodape.2.php"); ?>
