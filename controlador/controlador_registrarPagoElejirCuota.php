<?php
session_start();
require_once ("../modelo/coneccionBD.php");
conectarBD($cn);
require('../modelo/funciones1.php');
require ('../modelo/consultaConf.php');
require("../modelo/setearTwig.php");
require('../modelo/condicionalumno.php');
require('../modelo/registrar_pago.php');
 require('../modelo/consultarnombreAlumno.php');
 require("../modelo/setearpagina.php");
 require ('../modelo/consultaCuotasImpagasDeAlumno.php');
 require('../modelo/consultaCuotasPagasDeAlumno.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../controlador/frontend_controller.php");	
  
}
if ((soyadmin($_SESSION['rol'])||soygestion($_SESSION['rol']))){
     if(!empty($_REQUEST['idalumno'])||(!empty($_POST['idalumnopagar']))||(!empty($_POST['idalumnobecar']))){
        // var_dump($_POST);
		 $ok=false;
         $pagina=setearPagina();
         condicion_alumno($idalumno,$debobecar,$ok);
         $agrego=false;
         //var_dump($_POST);
          if($ok&&(!empty($_POST['idcuotas']))){
              $idcuotas=$_POST['idcuotas'];
               //var_dump($idcuotas);
       		     registrar_pago($cn,$idalumno,$idcuotas,$debobecar);
               
              //var_dump($_POST['idcuotas']);
          }
          //var_dump($_POST);
          $configuraciones=consultaConf($cn);
          $nombrealu=consulta_nombre_alumno($cn,$idalumno);
          $cuotas_impagas=consulta_cuotas_impagas_de_alumno($cn,$configuraciones['0']['cantElem'],$cantidadpaginas,$pagina,$idalumno);
          $cuotas_pagas=consulta_cuotas_pagas_de_alumno($cn,$idalumno);
          
          //var_dump($cuotas_pagas);
           //consulta la configuracion y devuelve en $configuraciones
                //seteo twig en $template 
          //if ($configuraciones['0']['habilitada']){
	             setearTwig($loader,$twig);
               $template = $twig->loadTemplate("elegir_cuota.html");
   	            $template->display(array('datos'=>$configuraciones['0'], 
						                  'tipo'=>$_SESSION['rol'],
						      						'agrego'=>$agrego,
						                  'cuotas_impagas'=>$cuotas_impagas,
                              'cuotas_pagas'=>$cuotas_pagas,
                              'nombrealumno'=>$nombrealu,
                              'idalumno'=>$idalumno,
                              'paginaactual'=>$pagina,
                              'cantpaginas'=>$cantidadpaginas
						                    ));
          //}
          //else{  //else de pagina deshabilitada
         // }
    }
    else {
      header ("Location: ../controlador/controlador_registrarPagoElegirAlumno.php");

}}   
   else {
      header ("Location: ../controlador/controlador_login.php");
  }              
?>