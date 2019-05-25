<?php
include ("../src/includes/cabecalho.2.php");
require_once("../src/bancos/global.php");

$id = $_POST["id"];
$nome = $_POST["nome"];

$conexao = mysqli_connect('localhost', 'root', '', 'loja');

if (alteraCategoria($conexao, $id, $nome)){ ?>
    <p class="text-success">A categoria <?= $nome; ?> foi alterada!</p>
<?php   }else {
    $msg = mysqli_error($conexao);
    ?>
    <p class="text-danger">A categoria <?= $nome; ?> não alterada!<?= $msg ?> </p>
    <?php
}
?>

<!--<a href="produto-formulario.php"><button type="button" class="btn btn-primary">Voltar</button></a>-->
<a href="categoria-lista.php"><button type="button" class="btn btn-primary">Listar Categorias</button></a>

<?php include ("../src/includes/rodape.2.php"); ?>
