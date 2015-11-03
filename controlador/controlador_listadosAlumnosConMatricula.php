<?php
session_start();
require ('../modelo/funciones1.php');
require('../modelo/setearTwig.php');
require ('../modelo/coneccionBD.php');
require ('../modelo/consultaConf.php');
require('../modelo/setearpagina.php');
require ('../modelo/consultaAlumnosPropios.php');
require ('../modelo/consultaAlumnosConMatricula.php');
require ('../modelo/setearTipoDel.php');
conectarBD($cn);
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../controlador/frontend_controller.php"); 
}
$configuraciones = consultaConf($cn);
setearTwig($loader,$twig);
$pagina=setearPagina();
$tipodel=seteartipodel();
if ($_SESSION['rol'] == "consulta"){
      
      $alumnosConMatricula = consultaAlumnosPropios($cn,$datosprepost,$pagina,$tipodel,$_SESSION['nombreusuario'],$cantidadpaginas,$configuraciones);
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
  $alumnosConMatricula = consultaAlumnosConMatricula($cn,$datosprepost,$pagina,$tipodel,$cantidadpaginas,$configuraciones);
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