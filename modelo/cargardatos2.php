<?php
require_once ('../modelo/coneccionBD.php');
conectarBD($tt);

  $query = $tt->prepare("SELECT SUM(Cuotas.monto) as suma,Meses.nombre,cuotas.monto FROM Cuotas 
  	                     INNER JOIN Meses on (Meses.idMes=Cuotas.mes)
  	                     inner join Pagos on (Cuotas.id=Pagos.idCuota) 
  	                     where tipo='matricula' and Pagos.becado=0 GROUP BY Cuotas.mes order by Cuotas.mes");
  $query->execute(); 
  $consulta = $query->fetchAll(PDO::FETCH_ASSOC);
  print json_encode($consulta);
?>