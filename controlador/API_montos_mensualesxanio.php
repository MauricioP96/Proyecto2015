<?php
require_once('../modelo/consulta_montos_mensualesxanio_para_API.php');
//$origin=$_SERVER['HTTP_ORIGIN'];
header("Access-Control-Allow-Origin:*");
if(!empty($_REQUEST['anio'])){
	$montos=consultar_montos_para_API($_REQUEST['anio']);
	//var_dump($montos);
	$arr=array_column($montos, 'monto_por_mes');
	foreach ($montos as $clave=>$valor){
		//echo $clave+1;
		//var_dump($valor);
		if(is_null($valor['monto_por_mes'])){
			$arr[$clave]=0;
		}
		else{
			$arr[$clave]=intval($valor['monto_por_mes']);
		}
	//}
}








	echo json_encode($arr);
	//echo '[{"fecha":"2015-11-17","numero":"123"},{"fecha":"2015-11-03","numero":"22"},{"fecha":"2015-11-03","numero":"345"}]';
}
else{
	echo 'no envie parametros';
}

?>