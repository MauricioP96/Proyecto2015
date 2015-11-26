<?php
session_start();
require ('../modelo/funciones1.php');
require('../modelo/setearTwig.php');
require_once ('../modelo/coneccionBD.php');
require ('../modelo/consultaConf.php');
require('../modelo/setearpagina.php');
require ('../modelo/consultaAlumnosPropios.php');
require ('../modelo/consultaAlumnosPropiosEXPORTACION.php');
require ('../modelo/consultaAlumnosConMatricula.php');
require ('../modelo/consultaAlumnosConMatriculaEXPORTACION.php');
require ('../modelo/setearTipoDel.php');
require ('../modelo/generarPDF.php');
conectarBD($cn);
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../controlador/frontend_controller.php"); 
}
$configuraciones = consultaConf($cn);
setearTwig($loader,$twig);
$pagina=setearPagina();
$tipodel=seteartipodel();
if ($_SESSION['rol'] == "consulta"){
    if (!empty($_GET['pdf'])){
       $datos = consultaAlumnosPropiosEXPORTACION($cn,$datosprepost,$pagina,$_GET['pdf'],$_SESSION['nombreusuario'],$cantidadpaginas,$configuraciones);

       generarpdfconsulta($cn,$_GET['pdf'],$datos);
  } 
    $alumnosConMatricula = consultaAlumnosPropios($cn,$datosprepost,$pagina,$tipodel,$_SESSION['nombreusuario'],$cantidadpaginas,$configuraciones);
      $template = $twig->loadTemplate('listadosAlumnosInformacionPropios.html');
  $template->display(array('titulo' => $configuraciones['0']['titulo'],
              'contacto' => $configuraciones['0']['mailContacto'],
              'tipo' => $_SESSION['rol'],
                          'alumnosConMatricula' => $alumnosConMatricula,
                                'paginaactual' => $pagina,
                          'datospost' => $datosprepost,
                          'cantpaginas' => $cantidadpaginas
              )); 

 
}
else{
  if (!empty($_GET['pdf'])){
       $datos = consultaAlumnosConMatriculaEXPORTACION($cn,$datosprepost,$pagina,$_GET['pdf'],$cantidadpaginas,$configuraciones,$_SESSION['rol'],$_SESSION['id']);

       generarpdf($cn,$_GET['pdf'],$datos);
  } 
  else{
      $datos = consultaAlumnosConMatricula($cn,$datosprepost,$pagina,$tipodel,$cantidadpaginas,$configuraciones,$_SESSION['rol'],$_SESSION['id']);
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