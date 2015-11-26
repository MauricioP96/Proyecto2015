<?php
$db_host="localhost";//:3306";
$db_user="grupo_10";
$db_pass="DCerbxcYhyEA9X4T";
$db_base="grupo_10"; 
	$tt = new PDO("mysql:dbname=$db_base;host=$db_host",$db_user,$db_pass);

  $query = $tt->prepare("SELECT SUM(Cuotas.monto) as suma,Meses.nombre FROM Cuotas 
  	                     INNER JOIN Pagos on (Cuotas.id=Pagos.idCuota) 
  	                     INNER JOIN Meses on (Meses.idMes=Cuotas.mes) where 1 GROUP BY Cuotas.mes order by Cuotas.mes");
  $query->execute(); 
  $consulta = $query->fetchAll(PDO::FETCH_ASSOC);
  print json_encode($consulta);
?>