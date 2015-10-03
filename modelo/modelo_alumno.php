<?php

function guardar_alumno($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso,$fecha_alta){
	require("../modelo/coneccionBD.php");


	$nuevo_alumno= $cn->prepare("SELECT numeroDoc FROM Alumnos WHERE numeroDoc=?");
	$nuevo_alumno->execute(array($dni));
	//var_dump($dni);
	$rows=$nuevo_alumno->fetchAll();
	//var_dump($rows);
    $error=$nuevo_alumno->errorInfo();
	//var_dump($error);
	if (count($rows) != 0) {
		$fallo=true;
		//echo 'entre';
	}
	else{
		$fallo=false;
	$query = $cn->prepare("INSERT INTO Alumnos (nombre, apellido, numeroDoc, fechaNacimiento,
	 sexo, mail, direccion, fechaIngreso, fechaEgreso, fechaAlta) VALUES (?,?,?,?,?,?,?,?,?,?)");
	$aux=$query->execute(array($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso,$fecha_alta)); 
	}
	return $fallo;
}

	

?>