<?php 
session_start(); 
include ('config.php'); 
require('verifica.php');
$idUser = $_SESSION["idUser"];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="meusAnuncios.css" media="screen">
	<title>Meus Anúncios</title>
</head>
<body>

	<div>
		<h1 id="cabecalho">Meus Anúncios</h1>
	</div>

	<div class="lista">
	<?php

	@$categoria = $_POST['idCategoria'];
	@$ordem = $_POST['ordem'];

	$query = "SELECT * FROM anuncio INNER JOIN categoria ON anuncio.idCategoria = categoria.idCategoria WHERE idUser = $idUser";

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