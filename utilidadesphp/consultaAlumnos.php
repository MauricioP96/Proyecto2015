<?php
require ("utilidadesphp/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Alumnos");
$query->execute(); 
$alumnos = $query->fetchAll();




?>