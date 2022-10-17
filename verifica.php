<?php 

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["idUserAtivo"]) || !isset($_SESSION["login"])) 
{
echo "<script>alert('Você não é Administrador!');top.location.href='login.php';</script>";
header("Location: login.php"); 
exit; 
} 
?> 