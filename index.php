<?php include("src/includes/cabecalho.php"); ?>

<?php
	define('DB_VERSAO',3); // 0 , 9999
	$drop = false;
	if(!file_exists('dev.ignore')){
		$f = fopen('dev.ignore','w');
		fwrite($f,DB_VERSAO);
		fclose($f);
		
		$drop = true;
	}
	else{
		$f = fopen('dev.ignore','r');
		$d = (int)fgets($f);
		fclose($f);
		
		$f = fopen('dev.ignore','w');
		fwrite($f,DB_VERSAO);
		fclose($f);
			
		if($d != DB_VERSAO)$drop = true;
	}

?>
<div>
    <h1 style="margin-bottom: 5%;">Bem vindo a minha loja!</h1>    
</div>

<h3 style="color: tomato; margin-bottom: 5%;"><?php include("src/bancos/conecta.php"); ?></h3>

<div>
    <h2 style="margin-bottom: 25px;">Dicas pros Devs</h2>
    <p class="text-muted">Lembre-se de dar um 'DROP DATABASE loja' antes de usar a loja para que atualize a estrutura do BD!</p>
    <p class="text-muted">Depois do DROP você pode inserir seus produtos normalmente.</p>
    <br>
    <h4 style="margin-bottom: 25px;">Se é sua primeira vez acessando e o banco não existe:</h4>
    <p class="text-muted">Aparecerão mensagens aqui em baixo confirmando a criação do banco.</p>
	<br /><br />
	<?php
	//Para quando for alterado algo no banco de dados.
		if($drop){
			$pdo->execute('DROP DATABASE loja');
			echo 'Atenção: <b>DROP DATABASE loja<b>: Automatico! <br /><a href="index.php">Atualize a página para continuar</a>';
		}
	?>

</div>
<?php include("src/includes/rodape.php"); ?>