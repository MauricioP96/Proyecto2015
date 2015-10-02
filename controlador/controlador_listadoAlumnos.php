<?php

session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
	header ("Location: frontend_controller.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}
if(soyadmin($_SESSION['rol'])){
	require("../modelo/consultaConf.php");             //consulta de configuracion
	require("../modelo/consultaAlumnos.php");
	require('../modelo/setearTwig.php');
	$template = $twig->loadTemplate('listado-alumnos.html');
	$template->display(array('titulo' => $configuraciones['0']['titulo'],
							'contacto' => $configuraciones['0']['mailContacto'],
							'tipo' => $_SESSION['rol'],
	                        'alumnos' => $alumnos
							));
}
else{
	header ("Location: ../controlador_login.php");
}

?>