<?php 
	include ('config.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style-anuncios.css" media="screen">

	<style>
        .currSign:before {
            content: 'R$';
        }
    </style>
	<title>Anúncios</title>
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

<!-- novo código -->
<div>
	<h1 id="cabecalho">Anúncios</h1>
</div>
<div class="tamanho-tabela">
	<table class="anuncios">
	<?php

	@$categoria = $_POST['idCategoria'];
	@$ordem = $_POST['ordem'];

	$query = "SELECT * FROM anuncio INNER JOIN categoria ON anuncio.idCategoria = categoria.idCategoria WHERE anuncioAtivo = 1";
	$query .= ($categoria ? " AND categoria.idCategoria LIKE '%$categoria%' " : "");
	$query .= ($ordem ? " ORDER BY  preco $ordem" : "");

	$result = mysqli_query($con, $query);

	while ($coluna=mysqli_fetch_array($result)) 
	{ 
	?>
		<tr class="tr-imagem">
			<td class="td-imagem" rowspan="3"><img class="imagem" src="uploads/<?php echo $coluna['foto']; ?>"</td>
		</tr>
		<tr class="tr-titulo">
			<td class="td-titulo"><strong><?php echo $coluna['titulo']; ?></strong></td>
			<td class="td-preco"><strong class="conv-preco"><?php echo $coluna['preco']; ?></strong></td>
				<script>
					let x = document.querySelectorAll(".conv-preco");
					for (let i = 0, len = x.length; i < len; i++) {
						let num = Number(x[i].innerHTML)
								.toLocaleString('en');
						x[i].innerHTML = num;
						x[i].classList.add("currSign");
					}
				</script>
		</tr>
		<tr class="tr-descricao">
			<td class="td-descricaoAnuncio"><?php echo $coluna['descricaoAnuncio']; ?></td>
			<td class="td-categoria"><?php echo $coluna['descricao']; ?></td>
		</tr>
	<?php 
	} ?>

	</table>
</div>	
	
</body>
</html>