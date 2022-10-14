<!--Tela cadastro User-->
<?php session_start(); ?>

<html>

<head>
<title>Criar conta</title>
<?php 
require ('config.php');
include ('funcaoLog.php');
?>
</head>

<body>
<?php
$idUser = @$_REQUEST['idUser'];

if (@$_REQUEST['botao'] == "Excluir") {
		gravaLog($idUser, date("Y-m-d h:m:s"), 'excluiu', 'user');
		$query_excluir = "
			DELETE FROM user WHERE idUser=$idUser
		";
		$result_excluir = mysqli_query($con, $query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";
		#Ele exclue só se tiver com todos os campos na tabela preenchidos
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

<!TABELA CADASTRO USUÁRIO>

<form enctype="multipart/form-data" action="cadUser.php?botao=gravar" method="post" name="user">
<table width="200" border="1" align=center>
  <tr>
    <td colspan="2">Cadastro de Usuário</td>
  </tr>
  <tr>
    <td width="53">Cod.</td>
    <td width="131"><?php echo @$_POST['idUser']; ?>&nbsp;
  </tr>
  <tr>
    <td>Nome:</td>
    <td><input type=text name="nome" value=<?php echo @$_POST['nome']; ?> ></td>
  </tr>
  <tr>
    <td>Data de Nascimento:</td>
    <td><input type=date name="idade" value=<?php echo @$_POST['idade']; ?> ></td>
  </tr>
  <tr>
    <td>Login:</td>
    <td><input type=text name="login" value=<?php echo @$_POST['login']; ?> ></td>
  </tr>
  <tr>
    <td>Senha:</td>
    <td><input type=text name="senha" value=<?php echo @$_POST['senha']; ?>></td>
  </tr>
  <?php if (@$_SESSION["usuarioNivel"] == "1"){ ?>
  <tr>
    <td>Admin:</td>
    <td>
	<input type=radio name="admin" value="1" <?php echo (@$_POST['admin'] == "1" ? " checked" : "" );?> > Administrador<br>
	<input type=radio name="admin" value="0" <?php echo (@$_POST['admin'] == "0" ? " checked" : "" );?> > Usuário 
	</td>
  </tr>
  <?php } ?>
  <tr> <td>
    Foto: </td>
	<td><input type="file" name="userfile"/>
    </td>
  </tr>
 
    <td colspan="2" align="right"><input type=submit value="Gravar" name="botao"> - <input type=submit value="Excluir" name="botao"> - <input type='reset' value="Novo" name="novo">	<input type="hidden" name="idUser" value="<?php echo @$_POST['idUser'] ?>" />
	
</td>
    </tr>	
</table>

<br><br><br>
	
	<table width="200" border="1" align=center>
	<tr bgcolor="#9999FF">
    <th width="5%"><a 
            href="menu.php"
            >Menu</a> </th>
    
  </tr>
	</table>
	
</form>

</body>
</html>