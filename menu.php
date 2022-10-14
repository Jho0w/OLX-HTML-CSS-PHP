<?php session_start(); ?>
<html>
<head>
<title>Menu</title>
</head>
<body>
<br><br><br>
<br><br><br>

<?php
require('verifica.php');

if ($_SESSION["usuarioNivel"] == "0"){

?>

	<!Início menu user>

	<table width="200" border="1" align=center>
	  <tr>
		<td colspan="2" align=center>Menu User</td>
	  </tr> 
	  <tr>
			<th width="25%">
			<a href="anuncios.php">Todos os Anúncios</a>
			</th>
			<th width="25%">
			<a href="meusAnuncios.php">Meus anúncios</a>
			</th>
			<th width="25%">
			<a href="cadAnuncio.php">Criar anúncio</a>
			</th>
			<th width="25%">
			<a href="logout.php">Sair</a>
			</th>
	  </tr>
	</table>
	 
	<br><br><br>
	<br><br><br>
<?php
} else{
?>
<!Início menu ADMIN>

<table width="200" border="1" align=center>
  <tr>
    <td colspan="2" align=center>Menu ADMIN</td>
  </tr> 
  <tr>
		<th width="50%">
        <a href="anuncios.php">Todos os Anúncios</a>
        </th>
		<th width="50%">
		<a href="meusAnuncios.php">Meus anúncios</a>
		</th>
		<th width="50%">
		<a href="cadAnuncio.php">Criar anúncio</a>
		</th>
		<th width="50%">
		<a href="cadUser.php">Criar User</a>
		</th>
		<th width="50%">
		<a href="cadCategoria.php">Criar Categoria</a>
		</th>
		<th width="50%">
		<a href="anuncioAtivo.php">Liberar Anúncios</a>
		</th>
		<th width="50%">
		<a href="logout.php">Sair</a>
		</th>
  </tr>
</table>
<?php
}
?>
</body>
</html>