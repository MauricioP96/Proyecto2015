<?php
require ("../modelo/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Alumnos WHERE eliminado=FALSE");
$query->execute(); 
$alumnos = $query->fetchAll();




?>
