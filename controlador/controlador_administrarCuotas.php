<?php

session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
	header ("Location: ../controlador/frontend_controller.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}
if(soyadmin($_SESSION['rol'])||soygestion($_SESSION['rol'])){
	if(!empty($_POST['ideliminar'])){
		//var_dump($_POST['ideliminar']);
		require('../modelo/eliminarCuota.php');
	}	

	require("../modelo/consultaConf.php");             //consulta de configuracion
	require("../modelo/consultaCuotas.php");
	
	//echo $pagina;
	require('../modelo/setearTwig.php');
	//var_dump($alumnos);
	//$funcion='listado';
	$template = $twig->loadTemplate('listado-cuotas.html');
	$template->display(array('titulo' => $configuraciones['0']['titulo'],
							'contacto' => $configuraciones['0']['mailContacto'],
							'tipo' => $_SESSION['rol'],
	                        'cuotas' => $cuotas,
	                        'cantpaginas' => $cantidadpaginas,
	                        'paginaactual' => $pagina,
							));
}
else{
	header ("Location: ../controlador/controlador_login.php");
}

?>