<?php

function guardar_alumno($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso,$responsables){
	require("../modelo/coneccionBD.php");

	$nuevo_alumno= $cn->prepare("SELECT numeroDoc FROM Alumnos WHERE numeroDoc=?");
	$nuevo_alumno->execute(array($dni));

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
                     sexo, mail, direccion, fechaIngreso, fechaEgreso, fechaAlta) VALUES (?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)");
                    $aux=$query->execute(array($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso)); 


                    $id_alumno= $cn->prepare("SELECT id FROM Alumnos WHERE numeroDoc=?");
                    $id_alumno->execute(array($dni));
                    $idA=$id_alumno->fetchAll();
                    $idAlu=$idA[0]['id'];
                    
                    
                    $ar = $cn->prepare("INSERT INTO AlumnoResponsable (idAlumno, idResponsable) VALUES (?,?)");
         
                     foreach($responsables as $idresponsable){ 
                            $aux2=$ar->execute(array($idAlu,$idresponsable)); 
                    }


                    $fallo=false;
	}
	return $fallo;
}

	

?>