<?php

function guardar_responsable($tipo,$nombre,$apellido,$fecha_nacimiento,$sexo,$mail,$telefono,$direccion){
	require("../modelo/coneccionBD.php");


	$nuevo_responsable= $cn->prepare("SELECT mail FROM Responsables WHERE mail=?");
	$nuevo_responsable->execute(array($mail));
	$rows=$nuevo_responsable->fetchAll();

	if ($nuevo_responsable->rowCount() > 0) {
		$fallo=true;
	}
	else{

	$query = $cn->prepare("INSERT INTO Responsables (tipo, nombre, apellido, fechaNacimiento,
	 sexo, mail, telefono, direccion) VALUES (?,?,?,?,?,?,?,?)");
	$aux=$query->execute(array($tipo,$nombre,$apellido,$fecha_nacimiento,$sexo,$mail,$telefono,$direccion)); 
	$fallo=false;
	}
	return $fallo;
}

function obtener_responsables(){
	require("../modelo/coneccionBD.php");
	$responsables= $cn->prepare("SELECT id,nombre,apellido,mail FROM Responsables");
	$responsables->execute(array());
	return $responsables;
}

	

?>