<?php

session_start();

if(empty($_SESSION['nombreusuario'])){
	header ("Location: index.php");					//Chekear si tiene sesion iniciada. If false redireccionar a index
		}

require('utilidadesphp/setearTwig.php');

/*switch ($_SESSION['rol']) {
    case 'administracion':                                        
        $paraMostrar='backend-admin.html';
        break;
    case 'gestion':
        $paraMostrar='backend-gestion.html';
        break;
    case 'consulta':
        $paraMostrar='backend-consulta.html';
        break;
}*/
require("utilidadesphp/consultaConf.php");
require('utilidadesphp/setearTwig.php');
$template = $twig->loadTemplate('backend-admin.html');
$template->display(array('titulo' => $configuraciones['0']['titulo'],
						'contacto' => $configuraciones['0']['mailContacto'],
						'tipo' => $_SESSION['rol']
						));

?>