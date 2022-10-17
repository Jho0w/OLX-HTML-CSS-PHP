<?php 
session_start();
include ('config.php');
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
			gravaLog($_SESSION["idUserAtivo"], date("Y-m-d h:m:s"), 'excluiu', 'categoria');
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
	gravaLog($_SESSION["idUserAtivo"], date("Y-m-d h:m:s"), 'editou', 'categoria');
	$query = "
		SELECT * FROM categoria WHERE idCategoria=$idCategoria
	";
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
			gravaLog($_SESSION["idUserAtivo"], date("Y-m-d h:m:s"), 'inseriu', 'categoria');
			
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


<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-cadCategoria.css" media="screen">
	<title>Criar Categoria</title>
</head>
<body>
	<?php include('menu.php'); ?>

	<main>
		<div class="criar-categoria">
			<div>
				<h1 id="cabecalho">Crie aqui a categoria</h1>
			</div>
		<form action="cadCategoria.php?botao=Gravar" method="post" name="categoria">
			<fieldset class="grupo">
				<div class="campo">
					<label for="id"><strong>Código</strong></label>
					<label class="campo-id" name="id"><?php echo @$_POST['idCategoria']; ?></label>
				</div>
				<div class="campo">
					<label for="descricao"><strong>Titulo</strong></label>
					<input type=text name="descricao" required value=<?php echo @$_POST['descricao']; ?> >
				</div>
			</fieldset>
			<div class="botao">
				<button class = botao1 type=submit value="Gravar" name="botao">Concluido</button>
				<button class = botao2 type=submit value="Excluir" name="botao" 
				onclick="return confirm('Tem certeza que deseja deletar este registro?')">Excluir</button>
				<input type="hidden" name="idCategoria" value="<?php echo @$_POST['idCategoria'] ?>" />
		</form>
				<form action="cadCategoria.php"><button class = botao3 type=submit value="Novo" name="novo">Novo</button></form>
			</div>
		</div>


		<div>
			<h1 id="meio">Todas categorias</h1>
		</div>


		<!--Tabela para mostrar todas as categorias-->
		<div class="table100">
			<table>
				<thead>
					<tr>
						<th>Código</th>
						<th>Categoria</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					
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
						<th><?php echo $coluna['idCategoria'];?> </th>
						<th><?php echo $coluna['descricao'];?> </th>
						<th>
					<a href="cadCategoria.php?botao=Editar&idCategoria=<?php echo $coluna['idCategoria']; ?>" >Editar</a>
					</th>
					</tr>

					<?php } ?>
					
				</tbody>
			</table>
		</div>
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>