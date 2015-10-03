<?php

require("../modelo/funciones1.php");
session_start();
if (!empty($_GET['flag']) && $_GET['flag'] == 'true'){
			CerrarSesion();
		}
if(empty($_SESSION['nombreusuario'])){
	header ("Location: controlador_login.php");					//Chekear si tiene sesion iniciada. If true redireccionar a backend
		}

if (!empty($_POST['nombre'])){ 

	$nombre=$_POST['nombre']; 
	$apellido=$_POST['apellido']; 
	$dni=$_POST['dni']; 
	$mail=$_POST['mail']; 
	$fecha_ingreso=$_POST['fecha_ingreso']; 
	$fecha_nacimiento=$_POST['fecha_nacimiento']; 
	$fecha_egreso=$_POST['fecha_egreso']; 
	$fecha_alta=$_POST['fecha_alta']; 
	$sexo=$_POST['sexo']; 
	$direccion=$_POST['direccion'];                                             //verificar si se quiso iniciar sesion
	require('../modelo/modelo_alumno.php');

	$fallo=guardar_alumno($nombre,$apellido,$dni,$fecha_nacimiento,$sexo,$mail,$direccion,$fecha_ingreso,$fecha_egreso,$fecha_alta);
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
						'tipo' => $_SESSION['rol'], 
						'fallo' => $fallo
						));
}
else{                                      //si la pagina esta deshabilitada debo mostrar el mensaje......debo dejar habilitado el login???
	
}

?>

