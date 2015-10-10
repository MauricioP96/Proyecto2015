<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("SELECT Cuotas.id, anio, mes, numero, monto, tipo, comisionCob, fechaAlta, nombre
				FROM Cuotas INNER JOIN Meses ON (Cuotas.mes=Meses.idMes)
				WHERE Cuotas.eliminada=FALSE AND NOT EXISTS(SELECT Pagos.id
														FROM Pagos
												WHERE (Pagos.idAlumno=? AND Pagos.idCuota = Cuotas.id))
				ORDER BY anio DESC , mes DESC");

$gg=array($idalumno);                                
$query->execute($gg); 
//$error=$query->errorInfo();

//var_dump($error);
$cuotas_impagas=$query->fetchAll();
//var_dump($cuotas);
?>