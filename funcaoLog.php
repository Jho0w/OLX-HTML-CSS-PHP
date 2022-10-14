<?php

function gravaLog($idUser, $data, $categoria, $tipo){
	include('config.php');
	$query = "INSERT INTO log(idUser, data, descricao1, descricao2) VALUES ('$idUser', '$data', '$categoria', '$tipo')";
	$result = mysqli_query($con, $query);
	
	if (!$result) echo "<h2> Nao consegui inserir!!!</h2>";
}
?>