<?php
session_start();
require('../modelo/funciones1.php');
require_once ("../modelo/coneccionBD.php");
conectarBD($cn);
require('../modelo/insertarCuota.php');
require ('../modelo/consultaConf.php');
require("../modelo/setearTwig.php");
require ('../modelo/consultaMeses.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../controlador/frontend_controller.php");	
  
}
   if (soyadmin($_SESSION['rol'])||soygestion($_SESSION['rol'])){
       $fallo=false;
      // var_dump($_POST);
       if(!empty($_POST['mes'])){
        //var_dump($_POST);
          $fallo=insertar_cuota($cn,$_POST['anio'],$_POST['mes'], $_POST['numero'], $_POST['monto'],$_POST['tipo'],$_POST['comisionCob']);
       		
       }
       $configuraciones=consultaConf($cn); //consulta la configuracion y devuelve en $configuraciones        
       $meses=consulta_meses($cn);
       //var_dump($meses);
      setearTwig($loader,$twig);//seteo twig en $template 

	$template = $twig->loadTemplate("alta_cuota.html");
   	$template->display(array('datos' => $configuraciones['0'],
						'tipo'=>$_SESSION['rol'],
						'meses'=>$meses,
						'fallo'=>$fallo,
						'info'=>$_POST
						));

}   
   else {
      header ("Location: ../controlador/controlador_login.php");
  }              
?>