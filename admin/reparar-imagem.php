<?php
	include ("../src/includes/cabecalho.2.php");
	require_once("../src/bancos/global.php");
/*
	Procura todos os produtos que estão com a imagem em 'default.png' 
	para mudar.
*/	
?>
<style>
	tr:not(:first-child):hover{background-color:#CCC;cursor:pointer;}
	tr:not(:first-child):active{background-color:#00FF00;}
</style>

<h1>Reparar Imagens de produtos</h1>

<div class="container ">
	<table class="table">
		<tr>
			<th>Produto</th>
			<th>Imagem</th>
			<th>Produto ID</th>
			<th>Opção</th>
			<?php

				$r = $pdo->prepare("SELECT imagem,nome,id FROM `produtos` WHERE imagem = 'default.png'");
				
				$r->execute();
				
				$result = $r->fetchAll();
				
				if(empty($result)){
					echo '<p style="color:#00AAEE;">*Não há produtos sem imagens.</p>';
				}
				else
				{
					$t = $result->rowCount()-1;
					foreach($result as $c):
				?>
					<tr>
						<td><?=$c['nome'];?></td>
						<td><?=$c['imagem'];?></td>
						<td><?=$c['id'];?></td>
						<td>
							<form action="produto-imagem-reparar.php" method="POST" enctype="multipart/form-data" >
								<input type="file" required name="imagem" /> 
								<input type="hidden" name="imagemID" value="<?=$c['id'];?>" />
								<input type="hidden" name="t" value="<?=$t;?>" />
								<input type="submit" value="Alterar" />
							</form>
						</td>
						
					</tr>
				<?php endforeach;}?>

	</table>
</div>
<?php
	include ("../src/includes/rodape.2.php");
?>