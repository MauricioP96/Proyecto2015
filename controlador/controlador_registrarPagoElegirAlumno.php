<?php

session_start();
require_once ("../modelo/coneccionBD.php");
conectarBD($cn);
require('../modelo/funciones1.php');
require("../modelo/consultaAlumnos.php");
require("../modelo/consultaConf.php"); 
require('../modelo/setearTwig.php');
require("../modelo/setearpagina.php");
if(empty($_SESSION['nombreusuario'])){
	header ("Location: frontend_controller.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}
if(soygestion($_SESSION['rol'])||soyadmin($_SESSION['rol'])){
	/*if(!empty($_POST['ideliminar'])){
		require('../modelo/eliminarAlumno.php');
	}*/	

     $pagina=setearPagina();
	$configuraciones=consultaConf($cn);    //consulta de configuracion
	//echo $pagina;
	$alumnos=consultaAlumnos($cn,$configuraciones[0]['cantElem'],$cantidadpaginas,$pagina);
	//var_dump($alumnos);
	    
	setearTwig($loader,$twig);    
	$funcion='elegirpago';
	$template = $twig->loadTemplate('listado-alumnos.html');
	$template->display(array('titulo' => $configuraciones['0']['titulo'],
							'contacto' => $configuraciones['0']['mailContacto'],
							'tipo' => $_SESSION['rol'],
	                        'alumnos' => $alumnos,
	                        'cantpaginas' => $cantidadpaginas,
	                        'paginaactual' => $pagina,
	                        'funcion'=>$funcion
							));
}
else{
	header ("Location: ../controlador/controlador_login.php");
}

?>