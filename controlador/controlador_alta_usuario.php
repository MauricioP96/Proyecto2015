<?php
session_start();
require('../modelo/funciones1.php');
require_once ("../modelo/coneccionBD.php");
conectarBD($cn);
require ('../modelo/consultaConf.php');
require("../modelo/setearTwig.php"); 
require('../modelo/insertar_usuario.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../frontend_controller.php");	
  
}
   if (soyadmin($_SESSION['rol'])){
       $fallo=false;
       if(!empty($_POST['nombre_usuario'])){
       		$fallo=insertarUsuario($cn,$_POST['nombre_usuario'],$_POST['pass'], $_POST['rol']);
          
       }
          $configuraciones=consultaConf($cn);       //consulta la configuracion y devuelve en $configuraciones
          setearTwig($loader,$twig);              //seteo twig en $template 
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