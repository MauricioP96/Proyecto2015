<?php

session_start();

if(empty($_SESSION['nombreusuario'])){
	header ("Location: index.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}

require("../modelo/consultaConf.php");             //consulta de configuracion
require("../modelo/consultaAlumnos.php");
require('../modelo/setearTwig.php');
$template = $twig->loadTemplate('listado-alumnos.html');
$template->display(array('titulo' => $configuraciones['0']['titulo'],
						'contacto' => $configuraciones['0']['mailContacto'],
						'tipo' => $_SESSION['rol'],
                        'alumnos' => $alumnos
						));

?>