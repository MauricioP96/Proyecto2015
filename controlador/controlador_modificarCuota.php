<?php

session_start();
require_once ("../modelo/coneccionBD.php");
conectarBD($cn);
require("../modelo/consultaConf.php");
require('../modelo/setearTwig.php');
require('../modelo/consultaMeses.php');
require("../modelo/consultaCuotaConId.php");
require('../modelo/consultaModificarCuota.php');
//var_dump($_SESSION['rol']);
if(empty($_SESSION['nombreusuario'])){						//Chekear si tiene sesion iniciada. If false redireccionar a index
	header ("Location: ../index.php");
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
		$fallo=consulta_modificar_cuota($cn,$_POST['anio'],$_POST['mes'],$_POST['numero'],$_POST['monto'],$_POST['tipo'],$_POST['comisionCob'],$_POST['idCuotaParaModificar']);
		
		$idCuota=$_POST['idCuotaParaModificar'];
		//echo 'sakjdpsandnsaondosajn';

}
$cuota=consuta_cuota_con_id($cn,$idCuota);        
						
$configuraciones=consultaConf($cn);        //consulta de configuracion
setearTwig($loader,$twig);

$meses=consulta_meses($cn);
$template = $twig->loadTemplate('modificar-cuota.html');
$template->display(array('datos' => $configuraciones[0],
                        'cuota' => $cuota[0],
                        'tipo' => $_SESSION['rol'],
						'meses'=>$meses,
						'fallo'=>$fallo,
						'idcuota'=>$idCuota
						));

?>