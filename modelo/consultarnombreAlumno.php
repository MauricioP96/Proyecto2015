<?php

function consulta_nombre_alumno($cn,$idalumno){
	$query = $cn->prepare("SELECT nombre,apellido FROM Alumnos WHERE id=?");
	$query->execute(array($idalumno)); 
	$alumno = $query->fetchAll();
	$nombrealu=$alumno[0]['nombre']." ".$alumno[0]['apellido'];
	//echo $nombrealu;
	return $nombrealu;
}
?>