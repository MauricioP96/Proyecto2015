<?php
session_start();
require ('../modelo/funciones1.php');
require('../modelo/setearTwig.php');
require ('../modelo/coneccionBD.php');
require ('../modelo/consultaConf.php');
require('../modelo/setearpagina.php');
require ('../modelo/consultaAlumnosPropios.php');
require ('../modelo/consultaAlumnosConMatricula.php');
require ('../modelo/consultaAlumnosConMatriculaEXPORTACION.php');
require ('../modelo/setearTipoDel.php');
require ('../modelo/generarpdf.php');
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
                                'paginaactual' => $pagina,
                          'datospost' => $datosprepost
              )); 

 
}
else{
  if (!empty($_GET['pdf'])){
       $datos = consultaAlumnosConMatriculaEXPORTACION($cn,$datosprepost,$pagina,$_GET['pdf'],$cantidadpaginas,$configuraciones,$_SESSION['rol'],$_SESSION['id']);

       generarpdf($cn,$_GET['pdf'],$datos);
  } 
  else{
      $datos = consultaAlumnosConMatricula($cn,$datosprepost,$pagina,$tipodel,$cantidadpaginas,$configuraciones,$_SESSION['rol'],$_SESSION['id']);
         var_dump($tipodel);
         $template = $twig->loadTemplate('listadosAlumnosConMatricula.html');
  $template->display(array('titulo' => $configuraciones['0']['titulo'],
              'contacto' => $configuraciones['0']['mailContacto'],
              'tipo' => $_SESSION['rol'],
                          'alumnosConMatricula' => $datos,
                          'cantpaginas' => $cantidadpaginas,
                          'paginaactual' => $pagina,
                          'datospost' => $datosprepost
              ));
}}
?>