
<?php
session_start();
require('../modelo/funciones1.php');
require ('../modelo/consultaConf.php');
require ('../modelo/coneccionBD.php');
require ('../modelo/consultaAgregarConfig.php');
require ('../modelo/setearTwig.php');
conectarBD($cn);
$configuraciones = consultaConf($cn);
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../controlador/frontend_controller.php");	
}
   if (soyadmin($_SESSION['rol'])){
       if (!empty($_POST['clave'])){
           actualizarconfig($cn,$_POST['titulo'],$_POST['descripcion'],$_POST['mailContacto'],$_POST['cantElem'],$_POST['habilitada'],$_POST['textoDeshab']);
           header ("Location: ConfigAdmin.php");
       }
       

       setearTwig($loader,$twig);
       $template = $twig->loadTemplate('ConfigAdmin.html');
       $template -> display(array('datos' => $configuraciones['0'],'tipo' => $_SESSION['rol']));
       
   }
   else {
      header ("Location: ../controlador/controlador_login.php");
  }              

?>