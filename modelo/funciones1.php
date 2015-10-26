<?php
function cerrarSesion(){

		session_unset();
		session_destroy();
		header ("Location: ../index.php");
	} 

function soyadmin($rol){
	return ($rol=='administracion');
}


function soygestion($rol){
	return ($rol=='gestion');
}

function soyconsulta($rol){
	return ($rol=='consulta');
}

?>