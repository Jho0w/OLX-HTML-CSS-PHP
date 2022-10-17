<?php 
session_start();
require ('config.php');
require('verifica.php');
include ('funcaoLog.php');

$idUser = $_SESSION["idUserAtivo"];
@$idAnuncio = $_REQUEST["idAnuncio"];

if (@$_REQUEST['botao'] == "Excluir") {

		gravaLog($_SESSION["idUser"], date("Y-m-d h:m:s"), 'excluiu', 'anuncio');
		$query_excluir = "
			DELETE FROM anuncio WHERE idAnuncio=$idAnuncio
		";
		$result_excluir = mysqli_query($con, $query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";
		#Ele exclue só se tiver com todos os campos na tabela preenchidos
}

if (@$_REQUEST['idAnuncio'] and @!$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM anuncio WHERE idAnuncio=$idAnuncio
	";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);
	foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}
}

if (@$_REQUEST['botao'] == "Gravar") 
{
	if ($_SESSION["usuarioNivel"] == "1"){ 
	$anuncioAtivo = $_POST['anuncioAtivo'];
	}
	else{ 
	$anuncioAtivo = 2; 
	}
	
	$uploaddir = 'uploads/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	} else {
		echo "Arquivo de imagem invalido!\n";
	}
	
	if (@!$_REQUEST['idAnuncio'])
	{
		gravaLog($_SESSION["idUser"], date("Y-m-d h:m:s"), 'inseriu', 'anuncio');
		$insere = "INSERT INTO anuncio (foto, titulo, descricaoAnuncio, preco, idCategoria, idUser, anuncioAtivo) VALUES ('{$_FILES["userfile"]["name"]}', '{$_POST['titulo']}', '{$_POST['descricaoAnuncio']}', '{$_POST['preco']}', '{$_POST['idCategoria']}', '$idUser', '$anuncioAtivo')";
		$result_insere = mysqli_query($con, $insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		gravaLog($_SESSION["idUser"], date("Y-m-d h:m:s"), 'editou', 'anuncio');
		$insere = "UPDATE anuncio SET 
					titulo = '{$_POST['titulo']}'
					, descricaoAnuncio = '{$_POST['descricaoAnuncio']}'
					, preco = '{$_POST['preco']}'
					, idCategoria = '{$_POST['idCategoria']}'
					, anuncioAtivo = '$anuncioAtivo'
					WHERE idAnuncio = '{$_REQUEST['idAnuncio']}'
				";
		$result_update = mysqli_query($con, $insere);

		if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
		else echo "<h2> Nao consegui atualizar!!!</h2>";
		
	}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-cadAnuncio.css" media="screen">
	
	<title>Cadastro de Anúncios</title>
</head>
<body>

	<?php include('menu.php'); ?>
	
	<main>
		<div>
			<h1 id="cabecalho">Crie agora seu anúncio!</h1>
		</div>	
		
		<form enctype="multipart/form-data" action="cadAnuncio.php?botao=gravar" method="post" name="anuncio">
		<div>
			<label><strong>Código</strong></label>
			<label><?php echo @$_POST['idAnuncio']; ?></label>
		</div>
		<div class="grupo">
			<label><strong>Foto</strong></label>
			<label class="foto" for="userfile">Sua melhor foto</label>
			<input type="file" name="userfile" id="userfile"/>
			</label>
		</div>
		<fieldset class="grupo">
			<div class="campo">
				<label for="titulo"><strong>Titulo</strong></label>
				<input class="campo-titulo" type="text" name="titulo" id="titulo" required value=<?php echo @$_POST['titulo'];?> >
			</div>
			<div class="campo">
				<label for="descricaoAnuncio"><strong>Descrição</strong></label>
				<input type="textarea" name="descricaoAnuncio" id="descricaoAnuncio" value=<?php echo @$_POST['descricaoAnuncio'];?> >
			</div>
			<div class="campo">
				<label for="preco"><strong>Preço</strong></label>
				<input type=text name="preco" value=<?php echo @$_POST['preco']; ?> >
			</div>
		</fieldset>	
		<div class="campo">
			<label for="categoria"><strong>Categoria</strong></label>
			<?php
				
				$query = "
					SELECT idCategoria, descricao
					FROM categoria
				";
				$result = mysqli_query($con, $query);
			?>

			<select name="idCategoria" required>
			<option selected disabled value="">Selecione</option>
			
			<?php
			while( $row = mysqli_fetch_assoc($result) )
			{	
			?>

			<option value="<?php echo $row['idCategoria'];?>">

			<?php echo @$row['descricao'] ?>

			</option>
			
			<?php
				}
			?>
			</select>
		</div>

		<?php if ($_SESSION["usuarioNivel"] == "1"){ ?>
		<div class="campo">
			<label><strong>Anúncio Ativo</strong></label>
			<label>
				<input type=radio name="anuncioAtivo" value="1" <?php echo (@$_POST['anuncioAtivo'] == "1" ? " checked" : "" );?> > Ativo
			</label>
			<label>
				<input type=radio name="anuncioAtivo" value="2"<?php echo (@$_POST['anuncioAtivo'] == "2" ? " checked" : "" );?> > Offline 
			</label>
		</div>
		<?php } ?>
		
			<button class="botao1" type="submit" name="botao" value="Gravar">Concluido</button>
			<?php if (@$_SESSION["usuarioNivel"] == "1"){ ?>
			<button class="botao2" type="image" name="botao" value="Excluir" onclick="return confirm('Tem certeza que deseja deletar este registro?')">
				<img src="imagens/icone-excluir.png" height="20px" width="20px"></button>
		
			<?php } ?>
			
			<input type="hidden" name="idAnuncio" value="<?php echo @$_POST['idAnuncio'] ?>" />
		</form>
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>