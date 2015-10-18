<?php
session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../controlador/frontend_controller.php");	
  
}
   if (soyadmin($_SESSION['rol'])||soygestion($_SESSION['rol'])){
       $fallo=false;
      // var_dump($_POST);
       if(!empty($_POST['mes'])){
        //var_dump($_POST);
       		require('../modelo/insertarCuota.php');
       }






              require ('../modelo/consultaConf.php');
       require ('../modelo/consultaMeses.php');
       //var_dump($meses);
           //consulta la configuracion y devuelve en $configuraciones
require("../modelo/setearTwig.php");      //seteo twig en $template 
if ($configuraciones['0']['habilitada']){
	$template = $twig->loadTemplate("alta_cuota.html");
   	$template->display(array('datos' => $configuraciones['0'],
						'tipo'=>$_SESSION['rol'],
						'meses'=>$meses,
						'fallo'=>$fallo,
						'info'=>$_POST
						));
}
}   
   else {
      header ("Location: ../controlador/controlador_login.php");
  }              
?>