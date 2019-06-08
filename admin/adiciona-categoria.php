<?php
    include ("../src/includes/cabecalho.2.php");
	require_once("../src/bancos/global.php");

    $nome = $_POST["nome"];

    if (insereCategoria($pdo, $nome)){ ?>
        <p class="text-success">A categoria <?= $nome; ?> foi adicionada!</p>
    <?php   }else {
        $msg = mysqli_error($pdo);
        ?>
        <p class="text-danger">A categoria <?= $nome; ?> não foi adicionada: <?= $msg ?> </p>
    <?php
        }
    ?>

    <a href="categoria-formulario.php"><button type="button" class="btn btn-primary">Voltar</button></a>
    <a href="categoria-lista.php"><button type="button" class="btn btn-primary">Listar categorias</button></a>

<?php include ("../src/includes/rodape.2.php"); ?>
