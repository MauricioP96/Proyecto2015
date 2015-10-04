<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("UPDATE Alumnos
				SET numeroDoc=?,nombre=?,apellido=?,fechaNacimiento=?,sexo=?,mail=?,direccion=?,fechaIngreso=?,fechaEgreso=?
				WHERE id=?");
$gg=array($_POST['numdoc'],$_POST['nombre'],$_POST['apellido'],$_POST['fechaNac'],$_POST['sexo'],$_POST['email'],$_POST['dire'],$_POST['fechaIng'],$_POST['fechaEg'],$_POST['idalumnoParaModificar']);                                
$aux=$query->execute($gg); 

?>