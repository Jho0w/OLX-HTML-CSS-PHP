<?php
include ('config.php');
session_start();

if (@$_REQUEST['botao'])
{
	$login = $_POST['login'];
	$senha = md5($_POST['senha']);
	
	$query = "SELECT * FROM user WHERE login = '$login' AND senha = '$senha' ";
	
	$result = mysqli_query($con, $query);
	while ($coluna=mysqli_fetch_array($result)) 
	{
		$_SESSION["idUserAtivo"] = $coluna["idUser"]; 
		$_SESSION["login"] = $coluna["login"]; 
		$_SESSION["usuarioNivel"] = $coluna["admin"];
		$_SESSION["nomeUser"] = $coluna["nome"];
		$_SESSION["fotoPerfil"] = $coluna["avatar"];

		// caso queira direcionar para páginas diferentes
		$niv = $coluna['admin'];
		header("Location: anuncios.php"); 
		exit; 
		// ----------------------------------------------
	}
	
	include('verifica.php');
}
?>