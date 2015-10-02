<?php

session_start();

if(empty($_SESSION['nombreusuario'])){
	header ("Location: index.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}

require('utilidadesphp/setearTwig.php');

require("utilidadesphp/consultaConf.php");             //consulta de configuracion
require("utilidadesphp/consultaAlumnos.php");
require('utilidadesphp/setearTwig.php');
$template = $twig->loadTemplate('listado-alumnos.html');
$template->display(array('titulo' => $configuraciones['0']['titulo'],
						'contacto' => $configuraciones['0']['mailContacto'],
						'tipo' => $_SESSION['rol'],
                        'alumnos' => $alumnos
						));

?>