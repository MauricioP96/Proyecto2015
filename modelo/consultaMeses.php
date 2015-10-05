<?php 
require ("../modelo/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Meses");
$query->execute(); 
$meses = $query->fetchAll();
?>