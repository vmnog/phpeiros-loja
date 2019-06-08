<?php
include ("../src/includes/cabecalho.2.php");
require_once("../src/bancos/global.php");

$nome = $_POST["nome"];
$preco = $_POST["preco"];
$descricao = $_POST["descricao"];
$categoria_id = $_POST["categoria_id"];
$id = $_POST["id"];

$produto = buscaProduto($pdo, $id);

$usado = isset($_POST['usado']) ? 1 : 0;


if (alteraProduto($pdo, $id, $nome, $preco, $descricao, $categoria_id, $usado)){ ?>
    <p class="text-success">O produto <?= $nome; ?> foi alterado!</p>
<?php   }else {
    $msg = mysqli_error($pdo);
    ?>
    <p class="text-danger"> O produto <?= $nome; ?> não foi alterado: <?= $msg ?> </p>
    <?php
}
?>

<a href="produto-formulario.php"><button type="button" class="btn btn-primary">Voltar</button></a>
<a href="produto-lista.php"><button type="button" class="btn btn-primary">Listar Produtos</button></a>

<?php include ("../src/includes/rodape.2.php"); ?>
