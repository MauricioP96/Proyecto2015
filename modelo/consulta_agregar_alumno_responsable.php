<?php
	require("../modelo/coneccionBD.php");

	$query = $cn->prepare("INSERT INTO AlumnoResponsable (idAlumno, idResponsable) VALUES (?,?)");
	$aux=$query->execute(array($idAlumno,$idResposable)); 
	if($aux){

                    $agrego_responsable=true;
            }

?>