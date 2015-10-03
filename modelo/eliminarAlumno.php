<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("UPDATE Alumnos
				SET eliminado=1
				WHERE id=?");
$gg=array($_POST['ideliminar']);
$aux=$query->execute($gg); 
if($aux){

	header ("Location: ../controlador/controlador_listadoAlumnos.php");
}
?>