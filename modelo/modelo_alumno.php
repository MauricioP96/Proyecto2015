<?php

function guardar_alumno($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso,$fecha_alta){
	require("../modelo/coneccionBD.php");


	$nuevo_alumno= $cn->prepare("SELECT numeroDoc FROM Alumnos WHERE numeroDoc=?");
	$nuevo_alumno->execute(array($dni));
	$rows=$nuevo_alumno->fetchAll();

	if ($nuevo_alumno->rowCount() > 0) {
		$fallo=true;
	}
	else{

	$query = $cn->prepare("INSERT INTO Alumnos (nombre, apellido, numeroDoc, fechaNacimiento,
	 sexo, mail, direccion, fechaIngreso, fechaEgreso, fechaAlta) VALUES (?,?,?,?,?,?,?,?,?,?)");
	$aux=$query->execute(array($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso,$fecha_alta)); 
	}
	return $fallo;
}

	

?>