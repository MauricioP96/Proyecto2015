<?php
function consultar_id_user_gestion($cn,$nombreusuario){
	$query = $cn->prepare("SELECT id,username FROM Usuarios WHERE username=? AND rol='gestion'");
	$query->execute(array($nombreusuario)); 
	$consulta= $query->fetchAll();
	return $consulta;


}