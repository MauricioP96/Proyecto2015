<?php

session_start();

if(empty($_SESSION['nombreusuario'])){						//Chekear si tiene sesion iniciada. If false redireccionar a index
	header ("Location: index.php");
	}								
	elseif($_SESSION['rol']!='administracion' ){			//si el usuario no es administrador no darle permiso
		header ("Location: ../controlador_login.php");					
}

if(!empty($_POST['idalumnoParaModificar'])){
	require('../modelo/consultaModificaralumno.php');
	$idalu=$_POST['idalumnoParaModificar'];

}
if(!empty($_POST['idalumnoCarga'])){
	$idalu=$_POST['idalumnoCarga'];
}
require("../modelo/consultaConf.php");             //consulta de configuracion
require("../modelo/consultaAlumnoConId.php");						//traigo la informacion del alumno para modificar
require("../modelo/consultaAlumnoResponsableConId.php");
require('../modelo/setearTwig.php');
require('../modelo/modelo_responsable.php');
		$responsables=obtener_responsables();

$template = $twig->loadTemplate('modificar-alumno.html');
$template->display(array('config' => $configuraciones[0],
                        'alumno' => $alumno[0],
                        'alumno_responsable' => $alumno_responsable[0],
			'responsables' => $responsables,
                        'tipo' => $_SESSION['rol']
						));

?>