<?php

session_start();
$fallo=false;
if(empty($_SESSION['nombreusuario'])){						//Chekear si tiene sesion iniciada. If false redireccionar a index
	header ("Location: ../controlador/frontend_controller.php");
	}								
	elseif($_SESSION['rol']!='administracion' ){			//si el usuario no es administrador no darle permiso
		header ("Location: ../controlador/controlador_login.php");					
}

if(!empty($_POST['idusuarioParaModificar'])){
	require('../modelo/consultaModificarUsuario.php');
	$iduser=$_POST['idusuarioParaModificar'];

}
elseif(!empty($_POST['idusuariocarga'])){
	$iduser=$_POST['idusuariocarga'];
} else{
	header ("Location: ../controlador/controlador_listado_usuarios.php");

}
require("../modelo/consultaConf.php");             //consulta de configuracion
require("../modelo/consultaUsuarioConId.php");						//traigo la informacion del alumno para modificar
require('../modelo/setearTwig.php');


$template = $twig->loadTemplate('modificar_usuario.html');
$template->display(array('config' => $configuraciones[0],
                        'usuario' => $usuario[0],
                        'tipo' => $_SESSION['rol'],
                        'fallo'=>$fallo
						));

?>