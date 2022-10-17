<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-login.css" media="screen">
	<title>Login</title>
</head>
<body>

<div class="retangulo-fundo">
	<div class=titulo>
		<h1 class="titulo-1">Bem vindo!</h1>
		<h2 class="subtitulo">Acesse sua conta!</h2>
	</div>
	<form action="autenticador.php" method=post>
		<fieldset class="grupo">
			<div class="campo">
				<label for=nome><strong>Login</strong></label>
				<input type=text name=login id="login" required>
			</div>
			<div class="campo">
				<label for=senha><strong>Senha</strong></label>
				<input type=password name=senha id="senha" required>
			</div>
		</fieldset>
		<div>
			<button class="botao" type=submit name="botao" value="Entrar">Entrar</button>
		</div>
		<br>
		<div class="link">
			<a id="link-1" href="anuncios.php">Entrar sem login</a>
			<a id="link-2" href="cadUser.php">Criar Conta</a>
		</div>
	</form>
</div>
</body>
</html>