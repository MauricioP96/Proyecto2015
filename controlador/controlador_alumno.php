<?php

//$mostrofallo=false;
require("../modelo/funciones1.php");
session_start();
if (!empty($_GET['flag']) && $_GET['flag'] == 'true'){
			CerrarSesion();
		}
if(empty($_SESSION['nombreusuario'])){
	header ("Location: controlador_login.php");					//Chekear si tiene sesion iniciada. If true redireccionar a backend
		}
//echo 'dsadsa';
if (!empty($_POST['nombre'])){ 
	$nombre=$_POST['nombre']; 
	$nombre=$_POST['apellido']; 
	$nombre=$_POST['dni']; 
	$nombre=$_POST['email']; 
	$nombre=$_POST['nombre']; 
	$nombre=$_POST['fecha_nacimiento']; 
	$nombre=$_POST['fecha_egreso']; 
	$nombre=$_POST['fecha_alta']; 
	$nombre=$_POST['sexo']; 
	$nombre=$_POST['direccion'];                                             //verificar si se quiso iniciar sesion
	require('../modelo/modelo_alumno.php');
	$altaalumno=guardar_alumno($nombre);
}


require ("../modelo/consultaConf.php");                   //consulta la configuracion y devuelve en $configuraciones

require("../modelo/setearTwig.php");      //seteo twig en $template 
if ($configuraciones['0']['habilitada']){


	//if(!$mostrofallo){                                       //si la pagina esta habilitada la muestro normalmente
   		$template = $twig->loadTemplate("alta_alumnos.html");
   	//}
   	//else{
   	//	$template = $twig->loadTemplate("index-fallo.html");
   	//}	
   	$template->display(array('titulo' => $configuraciones['0']['titulo'],
						'descripcion' => $configuraciones['0']['descripcion'],
						'contacto' => $configuraciones['0']['mailContacto'],
						'tipo'=> $_SESSION['rol']
						));
}
else{                                      //si la pagina esta deshabilitada debo mostrar el mensaje......debo dejar habilitado el login???
	
}

?>