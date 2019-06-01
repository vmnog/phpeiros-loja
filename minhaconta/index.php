<?php
	require_once('../src/includes/cabecalho.2.php');
	
	require_once('../src/bancos/conecta.php');
	
	require_once('../src/servidor/logado.php');

	if(UsuarioLogado()){
		header("Location: ../");
	}
	session_start();

	$sql = "SELECT * FROM `usuario` WHERE id = '{$_SESSION['id']}'";
	
	$q = mysqli_query($conexao,$sql);
	
	$q = mysqli_fetch_assoc($q);
	
	if($q){
		if(count($q) === 0){
			echo '<h3 id="error">Erro! Houve um erro durante a consulta a sua conta, por favor, contate os Administradores.</h3>';
			exit;
		}
	}
	
?>
<h2>Minha conta</h2>
<div class="container ">
	<form>
        <table class="table">
            <tr>
				<td colspan="3">
					<img src="../src/user/img/<?=$q['imagem']; ?>" width="250" height="250" />
				</td>
			</tr>	
				<td>
					<label for="nome">Nome: </label>
				</td>
				<td>
					<input type="text" class="form-control" name="nome" value=<?=$q['nome'];?> />
				</td>
			</tr>
			<tr>
				<td>
					<label for="snome">Sobre nome: </label>
				</td>
				<td>
					<input type="text" class="form-control" name="snome" value=<?=$q['sobrenome'];?> />
				</td>
			</tr>
			<tr>
				<td>
					<label for="email">Email: </label>
				</td>
				<td>
					<input type="email" class="form-control" name="email" value=<?=$q['email'];?> />
				<td>
			</tr>	
			<tr>
				<td>
					<label for="senha">Senha: </label>
				</td>
				<td>
					<input type="password" class="form-control" name="senha" placeholder="Senha" />
				</td>	
			</tr>
			<tr>
				<td>
					<input type="submit" value="Enviar" />
				</td>	
			</tr>		
	</form>
</div>	
<?php require_once('../src/includes/rodape.2.php'); ?>
