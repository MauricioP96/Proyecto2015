<?php
function consulta_cuotas_pagas_de_alumno($cn,$idalumno){
	$query = $cn->prepare("SELECT Pagos.fecha, Cuotas.anio,Cuotas.mes,Cuotas.numero,Cuotas.monto,Cuotas.tipo,Cuotas.comisionCob,Meses.nombre,Pagos.becado
							FROM Pagos INNER JOIN Cuotas ON (Pagos.idAlumno=? AND Pagos.idCuota=Cuotas.id) INNER JOIN Meses ON (Cuotas.mes=Meses.idMes)
							WHERE Cuotas.eliminada=FALSE
							ORDER BY anio DESC, mes DESC");

	$gg=array($idalumno);                                
	$query->execute($gg); 
	//$error=$query->errorInfo();

	//var_dump($error);
	$cuotas_pagas=$query->fetchAll();
	//var_dump($cuotas);
	return $cuotas_pagas;
}
?>