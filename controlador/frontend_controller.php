<?php
$mostrofallo=false;
require_once ("../modelo/coneccionBD.php");
conectarBD($cn);
require("../modelo/funciones1.php");
require ("../modelo/consultaConf.php");
require("../modelo/setearTwig.php");
require('../modelo/chequearInicioDeSesion.php');
session_start();
if (!empty($_GET['flag']) && $_GET['flag'] == 'true'){
			CerrarSesion();
		}
if(!empty($_SESSION['nombreusuario'])){
	
	header ("Location:controlador_login.php");				//Chekear si tiene sesion iniciada. If true redireccionar a backend
		}

if (!empty($_POST['usuario'])){  
    $mostrofallo=iniciar_sesion($cn,$_POST["usuario"],$_POST["clave"]);                                             //verificar si se quiso iniciar sesion
	if(!$mostrofallo){
		header ("Location: controlador_login.php");
	}
}

$configuraciones=consultaConf($cn);                  //consulta la configuracion y devuelve en $configuraciones

setearTwig($loader,$twig);      //seteo twig en $template 
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
else{    

       $template = $twig->loadTemplate("frontend-desabilitado.html");
   	$template->display(array('titulo' => $configuraciones['0']['titulo'],
						'descripcion' => $configuraciones['0']['descripcion'],
						'contacto' => $configuraciones['0']['mailContacto'], 
						'mensaje' => $configuraciones['0']['textoDeshab'],
						'fallo' => $mostrofallo
						));
                            //si la pagina esta deshabilitada debo mostrar el mensaje......debo dejar habilitado el login???
}

?>