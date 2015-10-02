<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Alumnos WHERE id=?");
$query->execute(array($_GET['idalumno'])); 
$alumno = $query->fetchAll();




?>