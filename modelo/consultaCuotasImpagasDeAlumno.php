
<?php
function consulta_cuotas_impagas_de_alumno($cn,$cantxpagina,&$cantidadpaginas,$pagina,$idalumno){
	$query = $cn->prepare("SELECT COUNT(*) as num
					FROM Cuotas INNER JOIN Meses ON (Cuotas.mes=Meses.idMes)
					WHERE Cuotas.eliminada=FALSE AND NOT EXISTS(SELECT Pagos.id
															FROM Pagos
													WHERE (Pagos.idAlumno=? AND Pagos.idCuota = Cuotas.id))");
	$query->execute(array($idalumno));
	//var_dump($pagina) ;
	//var_dump($_POST);
	$consultacant = $query->fetchAll();
	//var_dump($consultacant);
	$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar

	//var_dump($consultacant);
	//var_dump($cantidadalumnos);
	//var_dump($pagina);

	$offset=(($pagina-1)*$cantxpagina);
	//var_dump($offset);
	$sss=intval($cantxpagina);
	$cantidadpaginas= intval(ceil($cantidadalumnos/$sss));  //calculo cuantas paginas debo mostrar
	//var_dump($cantidadpaginas);
	$query2=$cn->prepare("SELECT Cuotas.id, anio, mes, numero, monto, tipo, comisionCob, fechaAlta, nombre
					FROM Cuotas INNER JOIN Meses ON (Cuotas.mes=Meses.idMes)
					WHERE Cuotas.eliminada=FALSE AND NOT EXISTS(SELECT Pagos.id
															FROM Pagos
													WHERE (Pagos.idAlumno=:idalumno AND Pagos.idCuota = Cuotas.id))
					ORDER BY anio DESC , mes DESC LIMIT :cantidad OFFSET :offset ");
	$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
	$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
	$query2->bindValue(':idalumno', $idalumno);
	$query2->execute();
	//$error=$query2->errorInfo();
	//var_dump($error);

	$cuotas_impagas=$query2->fetchAll();
	//var_dump($alumnos);
	return $cuotas_impagas;
}
?>