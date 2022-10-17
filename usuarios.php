<?php 
	session_start(); 
	include ('config.php'); 
	require('verifica.php');
	$idUser = $_SESSION["idUserAtivo"];

	function inverteData($data){
		if(count(explode("/",$data)) > 1){
			return implode("-",array_reverse(explode("/",$data)));
		}elseif(count(explode("-",$data)) > 1){
			return implode("/",array_reverse(explode("-",$data)));
		}
	}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-anuncioAtivo.css" media="screen">
	
	<style>
        .currSign:before {
            content: 'R$';
        }
    </style>

	<title>Anúncios Ativos</title>
</head>
<body>

	<?php include('menu.php'); ?>

	<main>

		<div>
			<h1 id="cabecalho">Todos os Usuários</h1>
		</div>


		<form action="usuarios.php?botao=gerar" method="post" name="form1">
			<div class="filtro">
				<label><strong>Filtro</strong></label>
				<label>
					<input type=radio name="idAdmin" value="1" <?php echo (@$_POST['idAdmin'] == "1" ? " checked" : "" );?> > Ativo
                    <?php $admin="Adm"; ?>
                </label>
				<label>
					<input type=radio name="idAdmin" value="2" <?php echo (@$_POST['idAdmin'] == "2" ? " checked" : "" );?> > Inativo 
                    <?php $admin="User"; ?>
                </label>
				<label>
					<input type=radio name="idAdmin" value=""> Todos</label>
				<div>
					<button class="botao-filtro" type="submit" name="botao" value="Gerar">Filtrar</button>
				</div>
			</div>
		</form>



		<div class="lista">
		<?php

		@$idAdmin = $_POST['idAdmin'];
		$query = "SELECT * FROM user";
		$query .= ($idAdmin ? " WHERE admin = $idAdmin " : "");
		$result = mysqli_query($con, $query);

		while ($coluna=mysqli_fetch_array($result)) 
		{ 
			?>
			<div class="editar-anuncio">
						<?php 
						if($coluna['admin'] == '1'){ 
							$admin="Adm";
							?>
							<div class="container">
						<?php }
						else{ 
							$admin="User";
							?>
							<div class="container2">
						<?php } ?>
					<div id="foto"><p><img class="imagem" src="uploads/<?php echo $coluna['avatar']; ?>"></p></div>
					<div id="titulo"><strong><?php echo $coluna['nome']; ?></strong></div>
					
					<div id="preco"><strong class="conv-data"><?php echo date('d-m-Y', strtotime($coluna['idade'])); ?></strong></div>
					<div id="descricao">
                        Login: <?php echo $coluna['login']; ?>
                    </div>
					<div id="categoria"><p><?php echo $admin ?></p></div>
					<div id="editar">
						<button class="botao" type="image" name="botao" value="Excluir">
							<a href="cadUser.php?pag=prop&idUser=<?php echo $coluna['idUser']; ?>" > 
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
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>