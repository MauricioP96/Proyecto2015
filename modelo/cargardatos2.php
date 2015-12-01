<?php
require_once ('../modelo/coneccionBD.php');
conectarBD($tt);

  $query = $tt->prepare("SELECT SUM(Cuotas.monto) as suma,Meses.nombre,Cuotas.monto 
					  	FROM Pagos inner join Meses on (month(Pagos.fecha)=Meses.idMes) LEFT JOIN Cuotas on (Cuotas.id=Pagos.idCuota)
					  	 where Cuotas.tipo != 'matricula' and Pagos.becado=0 group by month(Pagos.fecha)");
  $query->execute(); 
  $consulta = $query->fetchAll(PDO::FETCH_ASSOC);
  print json_encode($consulta);
?>