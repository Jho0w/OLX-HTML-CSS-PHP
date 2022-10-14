<?php 
// Inicia sessões 
//session_start(); 

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["idUser"]) || !isset($_SESSION["login"])) 
{
echo "<script>alert('Você não é Administrador!');top.location.href='login.php';</script>";
header("Location: login.php"); 
exit; 
} 
?> 