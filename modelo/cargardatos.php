<?php
$db_host="localhost";//:3306";
$db_user="grupo_10";
$db_pass="";
$db_base="grupo_10"; 
	$tt = new PDO("mysql:dbname=$db_base;host=$db_host",$db_user,$db_pass);

  $query = $tt->prepare("SELECT cuotas.id, SUM(cuotas.monto) as suma, cuotas.mes, cuotas.anio FROM cuotas 
  	                     INNER JOIN pagos on (cuotas.id=pagos.idCuota) where 1 
  	                     GROUP BY cuotas.id order by cuotas.anio ,cuotas.mes ");
  $query->execute(); 
  $consulta = $query->fetchAll();
  print json_encode($consulta);
?>