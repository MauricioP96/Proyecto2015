<?php
//var_dump($_POST);
require ("../modelo/coneccionBD.php");
$query = $cn->prepare("UPDATE Cuotas
				SET anio=?,mes=?,numero=?,monto=?,tipo=?,comisionCob=?,eliminada=false
				WHERE id=?");
$gg=array($_POST['anio'],$_POST['mes'],$_POST['numero'],$_POST['monto'],$_POST['tipo'],$_POST['comisionCob'],$_POST['idCuotaParaModificar']);                                
$query->execute($gg); 
//$aux=$query->errorInfo();
//var_dump($aux);
?>