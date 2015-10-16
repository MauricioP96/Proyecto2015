<?php
require ("../modelo/coneccionBD.php");

$query2=$cn->prepare("SELECT idResponsable, idAlumno FROM AlumnoResponsable WHERE idAlumno='$idAlumno'");
$query2->execute();
//$error=$query2->errorInfo();
//var_dump($error);

$alumno_responsables=$query2->fetchAll();
//var_dump($responsables);

?>