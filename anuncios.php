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

<div>
	<h1 id="cabecalho">Anúncios</h1>
</div>

<form action="anuncios.php?botao=gerar" method="post" name="form1">
	
	<div class="filtro">
		<label for="preco"><strong>Ordenar por</strong></label>
		<select  name="idCategoria">
			<option value="">Selecione</option>
			<option value="asc">Menor preço</option>
			<option value="desc">Maior preço</option>
		</select>
	
		<label class="categoria" for="categoria"><strong>Tipos de Anuncio</strong></label>
		<?php
			
			$query = "
				SELECT idCategoria, descricao
				FROM categoria
			";
			$result = mysqli_query($con, $query);
		?>

		<select  name="idCategoria">
		<option value="">Selecione</option>
		
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
	<button class="botao" type="submit" name="botao" value="Filtrar">Filtrar</button>
</form>



<div class="lista">
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
	<div class="container">
		<div id="foto"><p><img class="imagem" src="uploads/<?php echo $coluna['foto']; ?>"></p></div>
		<div id="titulo"><strong><?php echo $coluna['titulo']; ?></strong></div>
		<div id="preco"><strong class="conv-preco"><?php echo $coluna['preco']; ?></strong></div>
			
		<div id="descricao"><?php echo $coluna['descricaoAnuncio']; ?></div>
		<div id="categoria"><p><?php echo $coluna['descricao']; ?></p></div>
	</div>
	<br>
<?php 
} ?>
</div>
	<script>
		let x = document.querySelectorAll(".conv-preco");
		for (let i = 0, len = x.length; i < len; i++) {
			let num = Number(x[i].innerHTML)
					.toLocaleString('pt-BR');
			x[i].innerHTML = num;
			x[i].classList.add("currSign");
		}
	</script>
	
</body>
</html>