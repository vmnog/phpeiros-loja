<?php
include ("../src/includes/cabecalho.2.php");
require_once("../src/bancos/global.php");
?>

<h2>Formulário de categoria</h2>
<div class="container ">
    <form action="adiciona-categoria.php" method="post">
        <table class="table">
            <tr>
                <td>Nome</td>
                <td><input  class="form-control" type="text" name="nome" autofocus></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn btn-primary float-right" type="submit">Adicionar</button>
                </td>
            </tr>

        </table>
    </form>
</div>
<?php include ("../src/includes/rodape.2.php"); ?>

