<?php

session_start();
//var_dump($_SESSION['rol']);
if(empty($_SESSION['nombreusuario'])){						//Chekear si tiene sesion iniciada. If false redireccionar a index
	header ("Location: index.php");
	}								
	elseif($_SESSION['rol']=='consulta'){			//si el usuario no es administrador no darle permiso
		header ("Location: ../controlador/controlador_login.php");					
}

if(empty($_POST['idCuotaParaModificar'])){
	if(empty($_POST['idCuotaCarga'])){
		
		header ("Location: ../controlador/controlador_administrarCuotas.php");
	}
	else{$idCuota=$_POST['idCuotaCarga'];
	//echo '</br></br></br></br></br></br>';
}}
	else{
		require('../modelo/consultaModificarCuota.php');
		$idCuota=$_POST['idCuotaParaModificar'];
		//echo 'sakjdpsandnsaondosajn';

}

require("../modelo/consultaConf.php");             //consulta de configuracion
require("../modelo/consultaCuotaConId.php");						//traigo la informacion del alumno para modificar
require('../modelo/setearTwig.php');
require('../modelo/consultaMeses.php');

$template = $twig->loadTemplate('modificar-cuota.html');
$template->display(array('datos' => $configuraciones[0],
                        'cuota' => $cuota[0],
                        'tipo' => $_SESSION['rol'],
						'meses'=>$meses,
						'idcuota'=>$idCuota
						));

?>