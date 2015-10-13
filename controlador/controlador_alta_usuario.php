<?php
session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../frontend_controller.php");	
  
}
   if (soyadmin($_SESSION['rol'])){
       $fallo=false;
       if(!empty($_POST['nombre_usuario'])){
       		require('../modelo/insertar_usuario.php');
       }






              require ('../modelo/consultaConf.php');
       
           //consulta la configuracion y devuelve en $configuraciones
require("../modelo/setearTwig.php");      //seteo twig en $template 
	$template = $twig->loadTemplate("alta_usuario.html");
   	$template->display(array('datos' => $configuraciones['0'],
						
						'tipo'=>$_SESSION['rol'],
						'fallo'=>$fallo,
						'info'=>$_POST
						));

}   
   else {
      header ("Location: ../controlador/controlador_login.php");
  }              
?>