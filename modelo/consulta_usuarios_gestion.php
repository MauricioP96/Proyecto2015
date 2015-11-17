<?php
function consultar_usuarios_gestion($cn){
	$query = $cn->prepare("SELECT id,username FROM Usuarios WHERE rol='gestion'");
	$query->execute(); 
	$consulta= $query->fetchAll();
	return $consulta;
}




?>