<?php

session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
	header ("Location: ../contolador/frontend_controller.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}
if(soyadmin($_SESSION['rol'])){
	if(!empty($_POST['ideliminar'])){
		//require('../modelo/eliminar_responsable.php');
	}	
        
	require("../modelo/consultaConf.php");             //consulta de configuracion
	require("../modelo/consulta_responsables.php");
        $idAlumno=$_POST['idAlumno'];
        
        require("../modelo/consulta_alumno_responsables.php"); //Consulta los alumnos-responsables y me traigo los responsables del alumno
	//echo $pagina;
	require('../modelo/setearTwig.php');
	//var_dump($alumnos);

	$template = $twig->loadTemplate('listado_responsables.html');
	$template->display(array('titulo' => $configuraciones['0']['titulo'],
							'contacto' => $configuraciones['0']['mailContacto'],
							'tipo' => $_SESSION['rol'],
	                        'alumno_responsables' => $alumno_responsables,
                                'idAlumno' => $idAlumno,
	                        'responsables' => $responsables,
	                        'cantpaginas' => $cantidadpaginas,
	                        'paginaactual' => $pagina,
	                        
							));
}
else{
	header ("Location: ../controlador/controlador_login.php");
}

?>