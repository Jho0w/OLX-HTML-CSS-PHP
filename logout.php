<?php
session_start(); //iniciamos a sessão que foi aberta
session_unset(); //limpamos as variaveis globais das sessões
session_destroy(); //pei!!! destruimos a sessão ;)

echo "<script>alert('Até logo!');top.location.href='login.php';</script>"; /*aqui você pode por alguma coisa falando que ele saiu ou fazer como eu, coloquei redirecionar para uma certa página*/
?>