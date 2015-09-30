<?php 
require ("utilidadesphp/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Configuracion");
$query->execute(); 
?>