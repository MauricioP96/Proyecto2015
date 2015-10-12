<?php
session_start();
require('../modelo/funciones1.php');
if(empty($_SESSION['nombreusuario'])){
    header ("Location: ../controlador/frontend_controller.php");	
  
}
if ((soyadmin($_SESSION['rol'])||soygestion($_SESSION['rol']))){
     if(!empty($_POST['idalumno'])||(!empty($_POST['idalumnopagar']))||(!empty($_POST['idalumnobecar']))){
         $ok=false;
         require('../modelo/condicionalumno.php');
         $agrego=false;
         //var_dump($_POST);
          if($ok&&(!empty($_POST['idcuotas']))){
              $idcuotas=$_POST['idcuotas'];
               //var_dump($idcuotas);
       		     require('../modelo/registrar_pago.php');
              //var_dump($_POST['idcuotas']);
          }
          //var_dump($_POST);

           require('../modelo/consultarnombreAlumno.php');
          require ('../modelo/consultaConf.php');
          require ('../modelo/consultaCuotasImpagasDeAlumno.php');
          require('../modelo/consultaCuotasPagasDeAlumno.php');
          //var_dump($cuotas_pagas);
           //consulta la configuracion y devuelve en $configuraciones
          require("../modelo/setearTwig.php");      //seteo twig en $template 
          if ($configuraciones['0']['habilitada']){
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
          }
          else{  //else de pagina deshabilitada
          }
    }
    else {
      header ("Location: ../controlador/controlador_registrarPagoElejirCuota.php");

}}   
   else {
      header ("Location: ../controlador/controlador_login.php");
  }              
?>