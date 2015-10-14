<?php
session_start();
require ('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: frontend_controller.php"); 
}
require ('../modelo/consultaConf.php');
require('../modelo/setearTwig.php');
if ($_SESSION['rol'] == "consulta"){
     require ('../modelo/consultaAlumnosPropios.php');
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
   
require ('../modelo/consultaAlumnosConMatricula.php');
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