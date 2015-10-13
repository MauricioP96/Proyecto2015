<?php

session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
	header ("Location: ../contolador/frontend_controller.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}
if(soyadmin($_SESSION['rol'])){
	if(!empty($_POST['ideliminar'])){
		require('../modelo/eliminar_usuario.php');
	}	

	require("../modelo/consultaConf.php");             //consulta de configuracion
	require("../modelo/consulta_usuarios.php");
	//echo $pagina;
	require('../modelo/setearTwig.php');
	//var_dump($alumnos);
	
	$template = $twig->loadTemplate('listado_usuarios.html');
	$template->display(array('titulo' => $configuraciones['0']['titulo'],
							'contacto' => $configuraciones['0']['mailContacto'],
							'tipo' => $_SESSION['rol'],
	                        'usuarios' => $usuarios,
	                        'cantpaginas' => $cantidadpaginas,
	                        'paginaactual' => $pagina,
	                        
							));
}
else{
	header ("Location: ../controlador/controlador_login.php");
}

?>