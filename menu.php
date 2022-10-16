<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-menu.css" media="screen">
	<title>Menu</title>
</head>
<body>

<?php
session_start(); 
require('verifica.php');

if ($_SESSION["usuarioNivel"] == "0"){

?>
	<header>
    <figure class="logo"><img class="perfil" alt="Logo" src="uploads/<?php $_SESSION["avatar"]; ?>" width="70px" height="70px"></figure>

    <nav id="menu">
         <ul>
            <li><a href="anuncios.php">Todos os Anúncios</a></li>
            <li><a href="meusAnuncios.php">Meus Anúncios</a></li>
        	<li><a href="cadAnuncio.php">Criar Anúncio</a></li>
			<li class="sair"><a href="logout.php">Sair</a></li>
         </ul>
    </nav>
</header>

<?php
} else{
?>
	<header>
		<figure class="logo"><img alt="Logo" src="uploads/<?php $_SESSION["avatar"]; ?>" width="50px" height="50px"></figure>

		<nav id="menu">
			<ul>
				<li><a href="anuncios.php">Todos os Anúncios</a></li>
				<li><a href="#">Meus Anúncios</a></li>
				<li><a href="cadAnuncio.php">Criar Anúncio</a></li>
				<li><a href="cadUser.php">Criar User</a></li>
				<li><a href="cadCategoria.php">Criar Categoria</a></li>
				<li><a href="anuncioAtivo.php">Liberar Anúncios</a></li>
				<li class="sair"><a href="logout.php">Sair</a></li>
			</ul>
		<nav>
	</header>
<?php
}
?>
</body>
</html>