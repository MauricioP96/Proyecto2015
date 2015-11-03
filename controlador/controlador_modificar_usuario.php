<?php

session_start();
require_once ("../modelo/coneccionBD.php");
conectarBD($cn);
require("../modelo/consultaConf.php");
require('../modelo/setearTwig.php');
require("../modelo/consultaUsuarioConId.php");
require('../modelo/consultaModificarUsuario.php');
$fallo=false;
if(empty($_SESSION['nombreusuario'])){						//Chekear si tiene sesion iniciada. If false redireccionar a index
	header ("Location: ../controlador/frontend_controller.php");
	}								
	elseif($_SESSION['rol']!='administracion' ){			//si el usuario no es administrador no darle permiso
		header ("Location: ../controlador/controlador_login.php");					
}

if(!empty($_POST['idusuarioParaModificar'])){
	
	$fallo=consulta_modificar_usuario($cn,$_POST['nombre'],$_POST['pass'], $_POST['rol'],$_POST['idusuarioParaModificar']);
	$iduser=$_POST['idusuarioParaModificar'];

}
elseif(!empty($_POST['idusuariocarga'])){
	$iduser=$_POST['idusuariocarga'];
} else{
	header ("Location: ../controlador/controlador_listado_usuarios.php");

}
$configuraciones=consultaConf($cn);              //consulta de configuracion
						
$usuario=consulta_usuario_con_id($cn,$iduser);              //traigo la informacion del alumno para modificar
setearTwig($loader,$twig);

$template = $twig->loadTemplate('modificar_usuario.html');
$template->display(array('config' => $configuraciones[0],
                        'usuario' => $usuario[0],
                        'tipo' => $_SESSION['rol'],
                        'fallo'=>$fallo
						));

?>