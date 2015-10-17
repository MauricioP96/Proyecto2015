<?php

session_start();
if(empty($_SESSION['nombreusuario'])){
	header ("Location: ../index.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}
 

switch ($_SESSION['rol']) {
    case 'administracion':                                        
        header ("Location: ../controlador/controlador_listadoAlumnos.php"); 
        break;
    case 'gestion':
        header ("Location: ../controlador/controlador_registrarPagoElegirAlumno.php"); //ver a q pagina redireccionar
        break;
    case 'consulta':
        header ("Location: ../controlador/controlador_listadosAlumnosConMatricula.php");   ///ver a q pagina redireccionar
        break;
}
/*
require("../modelo/consultaConf.php");
require("../modelo/setearTwig.php");
$template = $twig->loadTemplate('backend-admin.html');
$template->display(array('titulo' => $configuraciones['0']['titulo'],
						'contacto' => $configuraciones['0']['mailContacto'],
						'tipo' => $_SESSION['rol']
						));
*/
?>