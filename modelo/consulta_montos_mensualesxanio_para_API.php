<?php 
require ('../modelo/coneccionBD.php');
function consultar_montos_para_API($anio){
	conectarBD($cn);
	$query=$cn->prepare('SELECT SUM(Cuotas.monto) as monto_por_mes 
						FROM Pagos INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id AND year(Pagos.fecha)=?) RIGHT JOIN Meses ON (month(Pagos.fecha)=Meses.idMes) 
						GROUP BY Meses.idMes 
						ORDER BY Meses.idMes');
	$query->execute(array($anio));
	return $query->fetchAll(PDO::FETCH_ASSOC);


}

?>