<?php session_start(); 
	include('src/servidor/usuario.php');
?>
<html>
<head>
    <title>Minha Loja</title>
    <meta charset="utf-8">
    <link href="src/css/bootstrap.css" rel="stylesheet">
    <link href="src/css/loja.css" rel="stylesheet">
    <script src="src/js/produto.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-dark">
    <a class="navbar-brand text-light" href="index.php">Minha Loja</a>

    <div class="nav-pills ">
        <!-- Example single danger button -->
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Produtos
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="admin/produto-formulario.php">Adicionar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="admin/produto-lista.php">Listar</a>
            </div>
			
        </div>

        <!-- Example single danger button -->
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categorias
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="admin/categoria-formulario.php">Adicionar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="admin/categoria-lista.php">Listar</a>
            </div>
        </div>
		<div class="btn-group">
		<?php  if(UsuarioLogado() === true): ?>
		
			<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="src/user/img/<?=$_SESSION['imagem']?>" title="<?=$_SESSION['nome']?>" width="20px" />
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="minhaconta/">Minha conta</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="carrinho/">Meu carrinho</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="src/servidor/sair.php">Sair</a>
            </div>
		</div>	
		<?php else: ?>
		<div class="btn-group">
			<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Conta
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="login/">Entrar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="cadastro/">Cadastrar</a>			
			</div>
		</div>
		<?php endif; ?>
		
	
    </div>
</nav>


<div class="container">
    <div class="principal">