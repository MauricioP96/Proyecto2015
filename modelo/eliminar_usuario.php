<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("UPDATE Usuarios
				SET habilitado=0
				WHERE id=?");
$gg=array($_POST['ideliminar']);
$aux=$query->execute($gg); 
if($aux){

	header ("Location: ../controlador/controlador_listado_usuarios.php");
}
?>