<?php

session_start();
require('../modelo/funciones1.php');
require_once ("../modelo/coneccionBD.php");
conectarBD($cn);
require("../modelo/consultaConf.php");
require("../modelo/setearpagina.php");
require('../modelo/setearTwig.php');
require("../modelo/consultaAlumnos.php");
require('../modelo/eliminarAlumno.php');
if(empty($_SESSION['nombreusuario'])){
	header ("Location: frontend_controller.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}
if(soyadmin($_SESSION['rol'])){
	$elimino_alumno=false;
	if(!empty($_POST['ideliminar'])){
		
		eliminarAlumno($cn,$_POST['ideliminar']);
	}	
	$pagina=setearPagina();
	$configuraciones=consultaConf($cn); //consulta de configuracion
	setearTwig($loader,$twig);    
	$alumnos=consultaAlumnos($cn,$configuraciones['0']['cantElem'],$cantidadpaginas,$pagina)  ;       
	
	//echo $pagina;
	//var_dump($alumnos);
	$funcion='listado';
	$template = $twig->loadTemplate('listado-alumnos.html');
	$template->display(array('titulo' => $configuraciones['0']['titulo'],
							'contacto' => $configuraciones['0']['mailContacto'],
							'tipo' => $_SESSION['rol'],
	                        'alumnos' => $alumnos,
                                'elimino_alumno' => $elimino_alumno,
	                        'cantpaginas' =>$cantidadpaginas ,
	                        'paginaactual' => $pagina,
	                        'funcion'=>$funcion
							));
}
else{
	header ("Location: ../controlador/controlador_login.php");
}

?>