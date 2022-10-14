<?php session_start(); ?>
<html>

<head>
<title>Criar Categoria</title>

</head>

<body>
<?php include ('config.php');
require('verifica.php');
include ('funcaoLog.php');

if ($_SESSION["usuarioNivel"] == "0") {
	echo "<script>alert('Você não é Administrador!');top.location.href='menu.php';</script>"; 
}

$idUser = @$_REQUEST['idUser'];
@$idCategoria = $_REQUEST['idCategoria'];

if (@$_REQUEST['botao'] == "Excluir") {
	
		if($idCategoria != null)
		{
			gravaLog($_SESSION["idUser"], date("Y-m-d h:m:s"), 'excluiu', 'categoria');
			$query_excluir = "
				DELETE FROM categoria WHERE idCategoria=$idCategoria
			";
			$result_excluir = mysqli_query($con, $query_excluir);
			
			if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
			else echo "<h2> Nao consegui excluir!!!</h2>";
			#Ele exclue só se tiver com todos os campos na tabela preenchidos
		} 
		else
		{
			echo "Tabela incompleta"; 
		}
}

if (@$_REQUEST['idCategoria'] and $_REQUEST['botao'] == "Editar")
{
	gravaLog($_SESSION["idUser"], date("Y-m-d h:m:s"), 'editou', 'categoria');
	$query = "
		SELECT * FROM categoria WHERE idCategoria=$idCategoria
	";
	echo $query;
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);
	//echo "<br> $query";	
	foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}
}

if (@$_REQUEST['botao'] == "Gravar") 
{
		
		if (@!$_REQUEST['idCategoria'])
		{
			gravaLog($_SESSION["idUser"], date("Y-m-d h:m:s"), 'inseriu', 'categoria');
			
			$insere = "INSERT INTO categoria (descricao) VALUES ('{$_POST['descricao']}')";
			$result_insere = mysqli_query($con, $insere);
			
			
			if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
			else echo "<h2> Nao consegui inserir!!!</h2>";
			
		} else 	
		{
			$insere = "UPDATE categoria SET 
						descricao = '{$_POST['descricao']}'
						WHERE idCategoria = '{$_REQUEST['idCategoria']}'
					";
			$result_update = mysqli_query($con, $insere);

			if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
			else echo "<h2> Nao consegui atualizar!!!</h2>";
			
		}
		
}
?>

<!TABELA CADASTRO CATEGORIA>

<form action="cadCategoria.php?botao=Gravar" method="post" name="categoria">
<br><br><br>
<table width="200" border="1" align=center>
  <tr>
    <td colspan="2" align=center>Cadastro de Categoria</td>
  </tr>
  <tr>
    <td width="53">Cod.</td>
    <td width="131"><?php echo @$_POST['idCategoria']; ?>&nbsp;
  </tr>
  <tr>
    <td>Categoria:</td>
    <td><input type=text name="descricao" value=<?php echo @$_POST['descricao']; ?> ></td>
  </tr>
 
    <td colspan="2" align="right">
	<input type=submit value="Gravar" name="botao">  
	<input type=submit value="Excluir" name="botao">  
	<input type="hidden" name="idCategoria" value="<?php echo @$_POST['idCategoria'] ?>" />
	</form>
	<form action="cadCategoria.php"><input type=submit value="Novo" name="novo"></form>
	
</td>
    </tr>	
</table>


<!Tabela para mostrar todas as categorias>

<br><br><br>

<table width="300" border="1" align=center>  
  <tr bgcolor="#9999FF">
    <th width="5%">Código Categoria</th>
    <th width="30%">Categoria</th>
  </tr>

<?php

	@$categoria = $_POST['idCategoria'];
	
	$query = "SELECT *
			  FROM categoria 
			  WHERE idCategoria > 0 ";
	$result = mysqli_query($con, $query);
	
	while ($coluna=mysqli_fetch_array($result)) 
	{
		
	?>
    
    <tr>
      <th width="5%"><?php echo $coluna['idCategoria']; ?></th>
      <th width="30%"><?php echo $coluna['descricao']; ?></th>
		<th width="5%">
        <a href="cadCategoria.php?botao=Editar&idCategoria=<?php echo $coluna['idCategoria']; ?>">
		Editar</a>
        </th>
    </tr>

    <?php
	
	} // fim while
	?>
	</table>

<br><br><br>

	
	<table width="200" border="1" align=center>
	<tr bgcolor="#9999FF">
    <th width="5%"><a 
		href="menu.php"
		>Menu</a> </th>
	</tr>
	</table>

</body>
</html>