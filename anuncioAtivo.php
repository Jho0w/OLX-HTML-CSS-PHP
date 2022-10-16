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
	<link rel="stylesheet" type="text/css" href="styles/anuncioAtivo.css" media="screen">
	
	<style>
        .currSign:before {
            content: 'R$';
        }
    </style>

	<title>Anúncios Ativos</title>
</head>
<body>

<header>
	<nav id="menu">
          <object width="100%" height="100px" data="menu.php"></object>
    </nav>
</header>

	<div>
		<h1 id="cabecalho">Anúncios Ativos</h1>
	</div>


	<form action="anuncioAtivo.php?botao=gerar" method="post" name="form1">
		<div class="filtro">
			<label><strong>Filtro</strong></label>
			<label>
				<input type=radio name="idAtivo" value="1" <?php echo (@$_POST['idAtivo'] == "1" ? " checked" : "" );?> > Ativo
			</label>
			<label>
				<input type=radio name="idAtivo" value="2" <?php echo (@$_POST['idAtivo'] == "2" ? " checked" : "" );?> > Inativo 
			</label>
			<div>
				<button class="botao-filtro" type="submit" name="botao" value="Gerar">Filtrar</button>
			</div>
		</div>
	</form>



	<div class="lista">
	<?php

	@$idAtivo = $_POST['idAtivo'];
	$query = "SELECT * FROM anuncio INNER JOIN categoria ON anuncio.idCategoria = categoria.idCategoria ";
	$query .= ($idAtivo ? " WHERE anuncioAtivo = $idAtivo " : "");
	$result = mysqli_query($con, $query);

	while ($coluna=mysqli_fetch_array($result)) 
	{ 
		?>
		<div class="editar-anuncio">
					<?php 
					if($coluna['anuncioAtivo'] == '1'){ ?>
						<div class="container">
					<?php }
					else{ ?>
						<div class="container2">
					<?php } ?>
				<div id="foto"><p><img class="imagem" src="uploads/<?php echo $coluna['foto']; ?>"></p></div>
				<div id="titulo"><strong><?php echo $coluna['titulo']; ?></strong></div>
				<div id="preco"><strong class="conv-preco"><?php echo $coluna['preco']; ?></strong></div>
					
				<div id="descricao"><?php echo $coluna['descricaoAnuncio']; ?></div>
				<div id="categoria"><p><?php echo $coluna['descricao']; ?></p></div>
				<div id="editar">
					<button class="botao" type="image" name="botao" value="Excluir">
						<a href="cadAnuncio.php?pag=prop&idAnuncio=<?php echo $coluna['idAnuncio']; ?>" > 
							<img src="imagens/icone-editar.png" height="18px" width="18px">
						</a>
					</button>
				</div>
			</div>
			
			<br>
		<div>
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