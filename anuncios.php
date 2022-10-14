<html>
<head>
<title>An&uacute;ncios</title>
<?php 
	include ('config.php'); 
?>
</head>

<body>

<form action="anuncios.php?botao=gerar" method="post" name="form1">
<table width="95%" border="1" align="center">
  <tr>
    <td colspan=4 align="center">An&uacute;ncios</td>
  </tr>
  <tr>
	<td width="40%" >Ordem por preço::
	<select name=ordem>
		<option value=""> ..:: selecione ::.. </option>
		<option value="asc">Crescente</option>
		<option value="desc">Decrescente</option>
	</select>
	</td>
	<td width="40%" >Categoria: <select  name="idCategoria">
	<!--COMBO BOX-->
	<?php
			
		$query = "
			SELECT idCategoria, descricao
			FROM categoria
		";
		$result = mysqli_query($con, $query);
	?>
		<option value=""> ..:: selecione ::.. </option>
		<?php
		while( $row = mysqli_fetch_assoc($result) )
		{
	?>
			<option value="<?php echo $row['idCategoria']; ?>" ><?php echo @$row['descricao'] ?></option>
	<?php
		}
	?>
		</select>
	<!--FIM COMBO BOX-->
	</td>
<!--botão gerar-->
<td rowspan=2> <input type="submit" name="botao" value="Filtrar" /> </td> 
  </tr>
</table>
</form>


<table width="95%" border="1" align="center">
  <tr bgcolor="#9999FF">
    <td colspan=5 align="center"><a href=anuncios.php>An&uacute;ncios</a></td>
  </tr>
  
  <tr bgcolor="#9999FF">
    <th width="7%">Imagem</th>
    <th width="5%">Produto</th>
    <th width="30%">Descrição</th>
    <th width="15%">Preço</th>
	<th width="15%">Categoria</th>
  </tr>

<?php

	@$categoria = $_POST['idCategoria'];
	@$ordem = $_POST['ordem'];
	
	$query = "SELECT * FROM anuncio INNER JOIN categoria ON anuncio.idCategoria = categoria.idCategoria WHERE anuncioAtivo = 1";
	$query .= ($categoria ? " AND categoria.idCategoria LIKE '%$categoria%' " : "");
	$query .= ($ordem ? " ORDER BY  preco $ordem" : "");
	
	$result = mysqli_query($con, $query);

/*
	echo "<pre>";
	echo $query;
	echo mysql_error();
	echo "</pre>";
*/
	while ($coluna=mysqli_fetch_array($result)) 
	{
		
	?>
    
    <tr>
	<th width="7%"><img src="uploads/<?php echo $coluna['foto']; ?>" width=40 height=40></th>
      <th width="5%"><?php echo $coluna['titulo']; ?></th>
      <th width="30%"><?php echo $coluna['descricaoAnuncio']; ?></th>
      <th width="15%"><?php echo $coluna['preco']; ?></th>
      <th width="15%"><?php echo $coluna['descricao']; ?></th>
    </tr>

    <?php
	
	} // fim while
?>
	</table>
	
	<br><br><br>
	
	<table width="30%" border="1" align="center">
	<tr bgcolor="#9999FF">
    <th width="5%"><a 
            href="menu.php"
            >Menu</a> </th>
    
  </tr>
	</table>
</body>