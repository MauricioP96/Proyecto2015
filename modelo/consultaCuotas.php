<?php
function consultaCuotas($cn,$cantxpagina,&$cantidadpaginas,$pagina){
	$query = $cn->prepare("SELECT count(*) as num FROM Cuotas INNER JOIN Meses ON (Meses.idMes=Cuotas.mes) WHERE Cuotas.eliminada=FALSE ");
	$query->execute(); 
	$consultacant = $query->fetchAll();

	$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar

	//var_dump($consultacant);
	//var_dump($cantidadalumnos);
	//var_dump($pagina);

	$offset=(($pagina-1)*$cantxpagina);
	//var_dump($offset);
	$sss=intval($cantxpagina);
	$cantidadpaginas= intval(ceil($cantidadalumnos/$sss));  //calculo cuantas paginas debo mostrar
	//var_dump($cantidadpaginas);
	$query2=$cn->prepare("SELECT Cuotas.*,count(Pagos.id) as cantpagos ,Meses.nombre FROM Cuotas INNER JOIN Meses ON (Meses.idMes=Cuotas.mes) LEFT JOIN Pagos ON (Pagos.idCuota=Cuotas.id)
						WHERE eliminada=FALSE
						GROUP BY Cuotas.id		
	              		 ORDER BY anio DESC,mes DESC LIMIT :cantidad OFFSET :offset ");
	$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
	$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
	$query2->execute();
	//$error=$query2->errorInfo();
	//var_dump($error);

	$cuotas=$query2->fetchAll();
	//var_dump($alumnos);
	return $cuotas;
}
?>