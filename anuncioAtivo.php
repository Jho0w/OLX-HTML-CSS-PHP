
<html>
<head>
<title>An&uacute;ncios Ativos</title>
<?php 
	include ('config.php'); 
?>
</head>

<body>

<form action="anuncioAtivo.php?botao=gerar" method="post" name="form1">
<table width="95%" border="1" align="center">
  <tr>
    <td colspan=4 align="center">Filtro</td>
  </tr>
  <tr>
	<td width="40%" >Anúncio Ativo:
		<!--COMBO BOX-->
		
		<td>
		<input type=radio name="idAtivo" value="1" <?php echo (@$_POST['idAtivo'] == "1" ? " checked" : "" );?> > Ativo<br>
		<input type=radio name="idAtivo" value="2" <?php echo (@$_POST['idAtivo'] == "2" ? " checked" : "" );?> > Inativo 
		</td>
		<!--FIM COMBO BOX-->
	</td>
	<td rowspan=2> <input type="submit" name="botao" value="Gerar" /> </td> 
  </tr>
  
</table>
</form>


<table width="95%" border="1" align="center">
  <tr bgcolor="#9999FF">
    <td colspan=5 align="center"><a href=anuncioAtivo.php>An&uacute;ncios</a></td>
  </tr>
  
  <tr bgcolor="#9999FF">
    <th width="5%">Produto</th>
    <th width="30%">Descrição</th>
    <th width="15%">Preço</th>
	<th width="15%">Categoria</th>
  </tr>

<?php

	@$idAtivo = $_POST['idAtivo'];
	$query = "SELECT * FROM anuncio INNER JOIN categoria ON anuncio.idCategoria = categoria.idCategoria ";
	$query .= ($idAtivo ? " WHERE anuncioAtivo = $idAtivo " : "");
	$result = mysqli_query($con, $query);


/*	echo "<pre>";
	echo $query;
	echo mysqli_error($con);
	echo "</pre>"; */

	while ($coluna=mysqli_fetch_array($result)) 
	{
		
	?>
    
    <tr>
		<th width="5%"><?php echo $coluna['titulo']; ?></th>
		<th width="30%"><?php echo $coluna['descricaoAnuncio']; ?></th>
		<th width="15%"><?php echo $coluna['preco']; ?></th>
		<th width="15%"><?php echo $coluna['descricao']; ?></th>
		<th width="5%">
			<a 
				href="cadAnuncio.php?pag=prop&idAnuncio=<?php echo $coluna['idAnuncio']; ?>"
				>Editar</a>
			</th>
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