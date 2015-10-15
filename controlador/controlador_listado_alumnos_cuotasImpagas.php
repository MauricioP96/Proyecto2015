<?php
session_start();
require ('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: frontend_controller.php");	
}
if (!empty($_POST['idalumnoCarga'])){
require ('../modelo/consultaConf.php'); 
require ('../modelo/consulta_alumnos_cuotasImpagas.php');
require('../modelo/setearTwig.php');
  $template = $twig->loadTemplate('listado_alumnos_cuotasImpagas.html');
  $template->display(array('titulo' => $configuraciones['0']['titulo'],
              'contacto' => $configuraciones['0']['mailContacto'],
              'tipo' => $_SESSION['rol'],
                          'alumnosConMatricula' => $alumnosConMatricula,
                          'datosalumnoooo' => $alumnosinffoo[0],
                          'cantpaginas' => $cantidadpaginas,
                          'paginaactual' => $pagina 
                           ));
  }
  else 
     header ("Location: frontend_controller.php");  
?>