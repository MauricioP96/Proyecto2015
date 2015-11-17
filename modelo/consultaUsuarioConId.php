<?php
function consulta_usuario_con_id($cn,$iduser){
	$query = $cn->prepare("SELECT * FROM Usuarios WHERE id=?");
	$query->execute(array($iduser)); 
	$usuario = $query->fetchAll();
	return $usuario;
}


?>