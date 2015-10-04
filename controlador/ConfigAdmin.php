<?php
session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: frontend_controller.php");	
  
}
   if (soyadmin($_SESSION['rol'])){
       require ('../modelo/consultaConf.php');
       if (!empty($_POST['clave'])){
           $query = $cn->prepare("UPDATE Configuracion SET titulo = ?, descripcion = ?, mailContacto = ?, cantElem = ?, habilitada = ?, textoDeshab = ? WHERE 1");
           $query->execute(array($_POST['titulo'],$_POST['descripcion'],$_POST['mailContacto'],$_POST['cantElem'],$_POST['habilitada'],$_POST['textoDeshab'])); 
           header ("Location: ConfigAdmin.php");
       }
       
       require ('../modelo/setearTwig.php');
       $template = $twig->loadTemplate('ConfigAdmin.html');
       $template -> display(array('datos' => $configuraciones['0'],'tipo' => $_SESSION['rol']));
       
   }
   else {
      header ("Location: ../controlador_login.php");
  }              
?>