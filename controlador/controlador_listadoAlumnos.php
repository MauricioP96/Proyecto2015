<?php

session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
	header ("Location: frontend_controller.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}
if(soyadmin($_SESSION['rol'])){
	if(!empty($_POST['ideliminar'])){
		require('../modelo/eliminarAlumno.php');
	}	

	require("../modelo/consultaConf.php");             //consulta de configuracion
	require("../modelo/consultaAlumnos.php");
	//echo $pagina;
	require('../modelo/setearTwig.php');
	//var_dump($alumnos);
	$funcion='listado';
	$template = $twig->loadTemplate('listado-alumnos.html');
	$template->display(array('titulo' => $configuraciones['0']['titulo'],
							'contacto' => $configuraciones['0']['mailContacto'],
							'tipo' => $_SESSION['rol'],
	                        'alumnos' => $alumnos,
                                'elimino_alumno' => $elimino_alumno,
	                        'cantpaginas' => $cantidadpaginas,
	                        'paginaactual' => $pagina,
	                        'funcion'=>$funcion
							));
}
else{
	header ("Location: ../controlador_login.php");
}

?>