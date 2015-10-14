<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("SELECT idResponsable FROM AlumnoResponsable  WHERE idAlumno=?");
$query->execute(array($idalu)); 
$alumno_responsable = $query->fetchAll();
var_dump($alumno_responsable);

?>

