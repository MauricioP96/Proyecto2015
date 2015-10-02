<?php
$mostrofallo=false;

require("../modelo/funciones1.php");
//session_start();
if (!empty($_GET['flag']) && $_GET['flag'] == 'true'){
			CerrarSesion();
		}
if(!empty($_SESSION['nombreusuario'])){

	header ("Location:backend.php");				//Chekear si tiene sesion iniciada. If true redireccionar a backend
		}

if (!empty($_POST['usuario'])){  
                                                 //verificar si se quiso iniciar sesion
	require('../modelo/chequearInicioDeSesion.php');
}


require ("../modelo/consultaConf.php");                   //consulta la configuracion y devuelve en $configuraciones
require("../modelo/setearTwig.php");      //seteo twig en $template 
if ($configuraciones['0']['habilitada']){
	//if(!$mostrofallo){                                       //si la pagina esta habilitada la muestro normalmente
   		$template = $twig->loadTemplate("index.html");
   	//}
   	//else{
   	//	$template = $twig->loadTemplate("index-fallo.html");
   	//}	
   	$template->display(array('titulo' => $configuraciones['0']['titulo'],
						'descripcion' => $configuraciones['0']['descripcion'],
						'contacto' => $configuraciones['0']['mailContacto'], 
						'fallo' => $mostrofallo
						));
}
else{                                      //si la pagina esta deshabilitada debo mostrar el mensaje......debo dejar habilitado el login???
	
}

?>

