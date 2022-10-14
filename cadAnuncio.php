<!--Tela cadastro Anuncio-->
<?php session_start(); ?>

<html>

<head>
<title>Criar Anúncio</title>
<?php
require ('config.php');
require('verifica.php');
include ('funcaoLog.php');
?>
</head>

<body>
<?php
$idUser = $_SESSION["idUser"];
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

<!--TABELA CADASTRO ANUNCIO-->

<form enctype="multipart/form-data" action="cadAnuncio.php?botao=gravar" method="post" name="anuncio">
<table width="200" border="1" align=center>
  <tr>
    <td colspan="2">Cadastro de Anúncios</td>
  </tr>
  <tr>
    <td width="53">Cod.</td>
    <td width="131"><?php echo @$_POST['idAnuncio']; ?>&nbsp;
  </tr>
  <tr> 
	<td>Foto: </td>
	<td><input type="file" name="userfile"/>
    </td>
  </tr>
  <tr>
    <td>Título:</td>
    <td><input type=text name="titulo" value=<?php echo @$_POST['titulo']; ?> ></td>
  </tr>
  <tr>
    <td>Descrição:</td>
    <td><input type=textarea name="descricaoAnuncio" value=<?php echo @$_POST['descricaoAnuncio']; ?> ></td>
  </tr>
  <tr>
    <td>Preço:</td>
    <td><input type=text name="preco" value=<?php echo @$_POST['preco']; ?> ></td>
  </tr>
  <tr><td>Categoria:</td>
  <td>
  <!--COMBO BOX-->
  
	<?php
			
		$query = "
			SELECT idCategoria, descricao
			FROM categoria
		";
		$result = mysqli_query($con, $query);
	?>
		<select  name="idCategoria">
		<option value=""> ..:: selecione ::.. </option>
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
  
  <!--FIM COMBO BOX-->
	</td>
  </tr>
  <!--Caso ADM liberar anuncio ativo-->
	<?php if ($_SESSION["usuarioNivel"] == "1"){ ?>
  <tr>
    <td>Anúncio Ativo:</td>
    <td>
	<input type=radio name="anuncioAtivo" value="1" <?php echo (@$_POST['anuncioAtivo'] == "1" ? " checked" : "" );?> > Ativo<br>
	<input type=radio name="anuncioAtivo" value="2"<?php echo (@$_POST['anuncioAtivo'] == "2" ? " checked" : "" );?> > Offline 
	</td>
  </tr> 
	<?php } ?>
    <td colspan="2" align="right"><input type=submit value="Gravar" name="botao"> - <input type=submit value="Excluir" name="botao"> - <input type='reset' value="Novo" name="novo">	<input type="hidden" name="idAnuncio" value="<?php echo @$_POST['idAnuncio'] ?>" />
	
</td>
    </tr>	
</table>

<br><br><br>
	
	<table width="200" border="1" align=center>
	<tr bgcolor="#9999FF">
    <th width="5%"><a 
            href="menu.php"
            >Menu</a> </th>
    
  </tr>
	</table>
	
</form>

</body>
</html>