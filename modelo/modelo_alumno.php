<?php

function guardar_alumno($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso,$responsables){
	require("../modelo/coneccionBD.php");


	$nuevo_alumno= $cn->prepare("SELECT numeroDoc FROM Alumnos WHERE numeroDoc=?");
	$nuevo_alumno->execute(array($dni));

	$rows=$nuevo_alumno->fetchAll();

	if ($nuevo_alumno->rowCount() > 0) {
		$fallo=true;
	}
	else{

	$query = $cn->prepare("INSERT INTO Alumnos (nombre, apellido, numeroDoc, fechaNacimiento,
	 sexo, mail, direccion, fechaIngreso, fechaEgreso, fechaAlta) VALUES (?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)");
	$aux=$query->execute(array($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso)); 


	$id_alumno= $cn->prepare("SELECT id FROM Alumnos WHERE numeroDoc=?");
	$id_alumno->execute(array($dni));
	$idA=$id_alumno->fetchAll();

	$idAlu=$idA[0]['id'];


	$ar = $cn->prepare("INSERT INTO AlumnoResponsable (idAlumno, idResponsable) VALUES (?,?)");
	var_dump($ar);

	 foreach($responsables as $idresponsable){ 
		$aux2=$ar->execute(array($idAlu,$idresponsable)); 
		var_dump($aux2);
	}


	$fallo=false;
	}
	return $fallo;
}

	

?>