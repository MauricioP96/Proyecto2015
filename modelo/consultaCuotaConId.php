<?php
function consuta_cuota_con_id($cn,$idCuota){
	$query = $cn->prepare("SELECT * FROM Cuotas INNER JOIN Meses ON Meses.idMes=Cuotas.mes WHERE id=?");
	$query->execute(array($idCuota)); 
	$cuota = $query->fetchAll();
	//svar_dump($cuota);
	return $cuota;
}

?>