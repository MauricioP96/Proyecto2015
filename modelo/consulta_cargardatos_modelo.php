<?php 
function datos1($anio){
	require_once ('../modelo/coneccionBD.php');
conectarBD($tt);

  $query = $tt->prepare("SELECT COALESCE(consulta.monto_por_mes,0) as monto,consulta.nombre 
  	                 from (SELECT SUM(Cuotas.monto) as monto_por_mes,Meses.nombre,year(Pagos.fecha) as anio 
  	                 	FROM Pagos INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id AND year(Pagos.fecha)=?) 
  	                 	RIGHT JOIN Meses ON (month(Pagos.fecha)=Meses.idMes) GROUP BY Meses.idMes ORDER BY Meses.idMes) as consulta");
  $query->execute(array($anio)); 
  $consulta = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>