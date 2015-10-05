<?php
session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: frontend_controller.php");	
  
}
   if (soyadmin($_SESSION['rol'])||soygestion($_SESSION['rol'])){
       $fallo=false;
       if(!empty($_POST['mes'])){
       		require('../modelo/insertarCuota.php');
       }






              require ('../modelo/consultaConf.php');
       require ('../modelo/consultaMeses.php');
           //consulta la configuracion y devuelve en $configuraciones
require("../modelo/setearTwig.php");      //seteo twig en $template 
if ($configuraciones['0']['habilitada']){
	$template = $twig->loadTemplate("alta_cuota.html");
   	$template->display(array('titulo' => $configuraciones['0']['titulo'],
						'descripcion' => $configuraciones['0']['descripcion'],
						'contacto' => $configuraciones['0']['mailContacto'], 
						'tipo'=>$_SESSION['rol'],
						'meses'=>$meses,
						'fallo'=>$fallo,
						'info'=>$_POST
						));
}
}   
   else {
      header ("Location: ../controlador_login.php");
  }              
?>