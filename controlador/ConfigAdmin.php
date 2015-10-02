<?php
session_start();
if(empty($_SESSION['nombreusuario'])){
    //header ("Location: backend.php");	
  echo "algo";
}
   if (($_SESSION['rol']) == ("administracion")){
       require ('../modelo/consultaConf.php');
       if (!empty($_POST['clave'])){
           $query = $cn->prepare("UPDATE configuracion SET titulo = ?, descripcion = ?, mailContacto = ?, cantElem = ?, habilitada = ?, textoDeshab = ? WHERE 1");
           $query->execute(array($_POST['titulo'],$_POST['descripcion'],$_POST['mailContacto'],$_POST['cantElem'],$_POST['habilitada'],$_POST['textoDeshab'])); 
           header ("Location: ConfigAdmin.php");
       }
       
       require ('../modelo/setearTwig.php');
       $template = $twig->loadTemplate('ConfigAdmin.html');
       $template -> display(array('datos' => $configuraciones['0'],'tipo' => $_SESSION['rol']));
       
   }
   else {
      header ("Location: ../index.php");
  }              
?>