<?php
session_start();
require ('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: frontend_controller.php");	
}
require ('../modelo/consultaConf.php');
require ('../modelo/consultaAlumnosConMatricula.php');
require('../modelo/setearTwig.php');
  $template = $twig->loadTemplate('listadosAlumnosConMatricula.html');
  $template->display(array('titulo' => $configuraciones['0']['titulo'],
              'contacto' => $configuraciones['0']['mailContacto'],
              'tipo' => $_SESSION['rol'],
                          'alumnosConMatricula' => $alumnosConMatricula,
                          'cantpaginas' => $cantidadpaginas,
                          'paginaactual' => $pagina,
                          'datospost' => $datosprepost
              ));
?>