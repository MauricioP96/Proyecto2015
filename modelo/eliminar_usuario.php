<?php
function elininar_usuario($cn,$id_usuario){
$query = $cn->prepare("UPDATE Usuarios
				SET habilitado=0
				WHERE id=?");
$gg=array($id_usuario);
$aux=$query->execute($gg); 

return $aux;/*if($aux){

	header ("Location: ../controlador/controlador_listado_usuarios.php");
}*/
  }
?>