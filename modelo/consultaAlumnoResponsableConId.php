<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM AlumnoResponsable  WHERE idAlumno=?");
$query->execute(array($idalu)); 
$alumno_responsable = $query->fetchAll();

?>

