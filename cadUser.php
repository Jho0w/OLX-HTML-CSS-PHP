<?php session_start(); 
require ('config.php');
include ('funcaoLog.php');

$idUser = @$_REQUEST['idUser'];

if (@$_REQUEST['botao'] == "Excluir") {
		gravaLog($idUser, date("Y-m-d h:m:s"), 'excluiu', 'user');
		$query_excluir = "
			DELETE FROM user WHERE idUser=$idUser
		";
		$result_excluir = mysqli_query($con, $query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";
}

if (@$_REQUEST['idUser'] and @!$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM user WHERE idUser=$idUser
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
	
	$senha = md5($_POST['senha']);
	//Upload de imagens
	$uploaddir = 'uploads/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	} else {
		echo "Arquivo de imagem invalido!\n";
	}
	
	if (@!$_REQUEST['idIser'])
	{
		gravaLog(@$_SESSION["idUser"], date("Y-m-d h:m:s"), 'inseriu', 'user');
		
		if (@$_SESSION["usuarioNivel"] == "1"){ 
			$admin = $_POST['admin'];
			}
			else{ 
			$admin = 0; 
			}

		$insere = "INSERT INTO user (nome, idade, login, senha, admin, avatar) VALUES ('{$_POST['nome']}', '{$_POST['idade']}', '{$_POST['login']}', '$senha', '$admin', '{$_FILES["userfile"]["name"]}')";
		$result_insere = mysqli_query($con, $insere);
		
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		gravaLog($_SESSION["idUser"], date("Y-m-d h:m:s"), 'editou', 'user');
		$insere = "UPDATE user SET 
					nome = '{$_POST['nome']}'
					, idade = '{$_POST['idade']}'
					, login = '{$_POST['login']}'
					, senha = '$senha'
					, admin = '{$_POST['admin']}'
					WHERE idUser = '{$_REQUEST['idUser']}'
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
	<link rel="stylesheet" type="text/css" href="style-cadUser.css" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<title>Criar conta</title>
</head>
<body>
	<div>
		<?php
		if (@!$_REQUEST['idIser']){ ?>
		<h1 id="titulo">Faça seu cadastro</h1>
		<?php } else { ?>
		<h1 id="titulo">Atualize o cadastro</h1>
		<?php } ?>
	</div>
	<form enctype="multipart/form-data" action="cadUser.php?botao=gravar" method="post" name="user">	
		<div>
			<?php echo @$_POST['idUser']; ?>
		</div>
		<fieldset class="grupo">
			<div class="campo">
				<label for="nome"><strong>Nome</strong></label>
				<input type="text" name="nome" id="nome" required value=<?php echo @$_POST['nome'];?> >
			</div>
			<div class="campo">
				<label for="idade"><strong>Data de Nascimento</strong></label>
				<input type="date" name="idade" id="idade" value=<?php echo @$_POST['idade'];?> >
			</div>
		</fieldset>	
		<div class="campo">
			<label for="login"><strong>Login</strong></label>
			<input type=text name="login" id="login" value=<?php echo @$_POST['login'];?> >
		</div>
		<div class="campo">
			<label for="senha"><strong>Senha</strong></label>
			<input type=password name="senha" id="senha" value=<?php echo @$_POST['senha'];?> >
		</div>
		<div class="campo">
			<label for="senha2"><strong>Confirme sua Senha</strong></label>
			<input type=password name="senha2" id="senha2">
		</div>

		<script>
			$('form').on('submit', function () {
			if ($('#senha').val() != $('#senha2').val()) {
				alert('Senhas diferentes');
				return false;
			}
		});
		</script>

		<?php if (@$_SESSION["usuarioNivel"] == "1"){ ?>
		<div class="campo">
			<label><strong>Nível do Usuário</strong></label>
			<label>
				<input type="radio" name="admin" value="1" <?php echo (@$_POST['admin'] == "1" ? " checked" : "" );?> > Administrador
			</label>
			<label>
				<input type="radio" name="admin" value="0" <?php echo (@$_POST['admin'] == "0" ? " checked" : "" );?> > Usuário
			</label>
		</div>
		<?php } ?>
		<div>
			<label><strong>Foto de perfil</strong></label>
			<label class="foto" for="userfile">Sua melhor foto</label>
			<input type="file" name="userfile" id="userfile"/>
			</label>
		</div>
		<div class="botao">
		<button class="botao1" type="submit" name="botao" value="Gravar">Concluido</button>
		<?php if (@$_SESSION["usuarioNivel"] == "1"){ ?>
			<button class="botao2" type="submit" name="botao" value="Gravar">Excluir</button>
		<?php } ?>
		<input type="hidden" name="idUser" value="<?php echo @$_POST['idUser'] ?>" />
		</div>
	</form>
</body>
</html>
