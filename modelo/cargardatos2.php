<?php
require_once ('../modelo/coneccionBD.php');
conectarBD($tt);

  $query = $tt->prepare("SELECT SUM(Cuotas.monto) as suma,Meses.nombre FROM Cuotas 
  	                     INNER JOIN Pagos on (Cuotas.id=Pagos.idCuota) 
  	                     INNER JOIN Meses on (Meses.idMes=Cuotas.mes) where 1 GROUP BY Cuotas.mes order by Cuotas.mes");
  $query->execute(); 
  $consulta = $query->fetchAll(PDO::FETCH_ASSOC);
  print json_encode($consulta);
?>