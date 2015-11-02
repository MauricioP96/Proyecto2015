<?php
session_start();
require ('../modelo/funciones1.php');
require('../modelo/setearTwig.php');
require ('../modelo/coneccionBD.php');
require ('../modelo/consultaConf.php');
require("../modelo/setearpagina.php");
require ('../modelo/consultaAlumnosPropios.php');
require ('../modelo/consultaAlumnosConMatricula.php');
conectarBD(&$cn);
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../controlador/frontend_controller.php"); 
}
$configuraciones = consultaConf($cn);
setearTwig(&$loader,&$twig);
$pagina = setearPagina($_GET['pag']);
if ($_SESSION['rol'] == "consulta"){
      consultaAlumnosPropios($cn,&$datosprepost,$pagina,$_REQUEST['tipodel'],$_SESSION['nombreusuario']);
      $template = $twig->loadTemplate('listadosAlumnosInformacionPropios.html');
  $template->display(array('titulo' => $configuraciones['0']['titulo'],
              'contacto' => $configuraciones['0']['mailContacto'],
              'tipo' => $_SESSION['rol'],
                          'alumnosConMatricula' => $alumnosConMatricula,
                          'cantpaginas' => $cantidadpaginas,
                          'paginaactual' => $pagina,
                          'datospost' => $datosprepost
              )); 

 
}
else{
  consultaAlumnosConMatricula($cn,&$datosprepost,$pagina,$_REQUEST['tipodel']);
  $template = $twig->loadTemplate('listadosAlumnosConMatricula.html');
  $template->display(array('titulo' => $configuraciones['0']['titulo'],
              'contacto' => $configuraciones['0']['mailContacto'],
              'tipo' => $_SESSION['rol'],
                          'alumnosConMatricula' => $alumnosConMatricula,
                          'cantpaginas' => $cantidadpaginas,
                          'paginaactual' => $pagina,
                          'datospost' => $datosprepost
              ));
}


?>