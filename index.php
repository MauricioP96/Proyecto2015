<?php

if(!empty($_SESSION['nombreusuario'])){
	header ("Location: backend.php");					//Chekear si tiene sesion iniciada. If true redireccionar a backend
		}

if (!empty($_POST['usuario'])){                                                   //verificar si se quiso iniciar sesion
	require('utilidadesphp/chequearInicioDeSesion.php');
}


require ("utilidadesphp/consultaConf.php");
require('utilidadesphp/setearTwig.php');      //seteo twig en $template 
if ($configuraciones['0']['habilitada']){
   $template = $twig->loadTemplate("index.html");
   $template->display(array('titulo' => $configuraciones['0']['titulo'],
						'descripcion' => $configuraciones['0']['descripcion'],
						'contacto' => $configuraciones['0']['mailContacto']
						));
}
else{

}

//Hacer consulta bd para datos de configuracion

//require("templates/index.html");  //esto se reemplaza x twig

