<?php

function guardar_alumno($nombre){
	require("coneccionBD.php");
	$query = $cn->prepare("INSERT INTO Alumnos (nombre) VALUES (?)");
	$query->execute(array($nombre)); 
	
}

?>