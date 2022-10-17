<link rel="stylesheet" type="text/css" href="styles/style-menu.css" media="screen">
<?php
if(!isset($_SESSION)) session_start();



if (@$_SESSION["usuarioNivel"] == "2"){

?>
	<header>
		<figure class="logo"><img class="perfil" onError="this.onerror=null;this.src='imagens/sem-foto.png';" alt="Sem imagem" src="uploads/<?php echo $_SESSION["fotoPerfil"]; ?>" width="50px" height="50px"></figure>
		<a class="nome">Olá <strong><?php echo $_SESSION["nomeUser"];?></strong></a>

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
} if((@$_SESSION["usuarioNivel"] == "1")){
?>

	<header>
		<figure class="logo"><img class="perfil" onError="this.onerror=null;this.src='imagens/sem-foto.png';" alt="Sem imagem" src="uploads/<?php echo $_SESSION["fotoPerfil"]; ?>" width="50px" height="50px"></figure>
		<a class="nome">Olá <strong><?php echo $_SESSION["nomeUser"];?></strong></a>

		<nav id="menu">
			<ul>
				<li><a href="anuncios.php">Todos os Anúncios</a></li>
				<li><a href="meusAnuncios.php">Meus Anúncios</a></li>
				<li><a href="cadAnuncio.php">Criar Anúncio</a></li>
				<li><a href="anuncioAtivo.php">Liberar Anúncios</a></li>
				<li><a href="cadCategoria.php">Criar Categoria</a></li>
				<li><a href="usuarios.php">Todos os usuários</a></li>
				<li><a href="cadUser.php">Criar User</a></li>
				<li class="sair"><a href="logout.php">Sair</a></li>
			</ul>
		<nav>
	</header>
<?php
}
?>