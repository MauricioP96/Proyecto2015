<?php
function consultaAlumnosConMatricula($cn,&$datosprepost,$pagina,$tipodel){

if ((empty($tipodel))  || $tipodel == 1){
$query = $cn->prepare("SELECT count(*) as num FROM Alumnos INNER JOIN Pagos ON (Alumnos.id=Pagos.idAlumno)
                                                            INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id) 
                                                            WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE())");
$query->execute(); 
$consultacant = $query->fetchAll();
$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar
$offset=(($pagina-1)*$configuraciones['0']['cantElem']);
$sss=intval($configuraciones['0']['cantElem']);
$cantidadpaginas= intval(ceil($cantidadalumnos/$sss));  
$query2=$cn->prepare("SELECT Alumnos.nombre, Alumnos.apellido, Cuotas.fechaAlta,Cuotas.comisionCob,Cuotas.monto FROM Alumnos INNER JOIN Pagos ON (Alumnos.id=Pagos.idAlumno)
                                                            INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id) 
                                                            WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE())  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=1;
}
else{ 
	if($tipodel == 2){
		$query = $cn->prepare("SELECT count(*) as num FROM Cuotas INNER JOIN Pagos ON (Cuotas.id=Pagos.idCuota) 
			                                  INNER JOIN Alumnos ON (Alumnos.id=Pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta");
$query->execute(); 
$consultacant = $query->fetchAll();
$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar
$offset=(($pagina-1)*$configuraciones['0']['cantElem']);
$sss=intval($configuraciones['0']['cantElem']);
$cantidadpaginas= intval(ceil($cantidadalumnos/$sss));  
$query2=$cn->prepare("SELECT Alumnos.apellido,Alumnos.nombre,Cuotas.numero,Cuotas.fechaAlta,Cuotas.monto,Cuotas.comisionCob FROM Cuotas INNER JOIN Pagos ON (Cuotas.id=Pagos.idCuota) 
			                                  INNER JOIN Alumnos ON (Alumnos.id=Pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=2;
	}
	else{
       if($tipodel == 3){
		$query = $cn->prepare("SELECT count(*) as num FROM (SELECT * FROM Cuotas WHERE Cuotas.mes < MONTH(CURRENT_DATE) AND Cuotas.anio <= year(CURRENT_DATE)) as ta1,(SELECT *
						     FROM Alumnos 
                             WHERE 1) as alu2 WHERE NOT EXISTS (SELECT * 
                                                                FROM Pagos 
                                                                where Pagos.idCuota=ta1.id and Pagos.idAlumno = alu2.id)
								                                ORDER BY ta1.anio DESC,ta1.mes DESC");
$query->execute(); 
$consultacant = $query->fetchAll();
$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar
$offset=(($pagina-1)*$configuraciones['0']['cantElem']);
$sss=intval($configuraciones['0']['cantElem']);
$cantidadpaginas= intval(ceil($cantidadalumnos/$sss));  
$query2=$cn->prepare("SELECT * FROM (SELECT * FROM Cuotas WHERE Cuotas.mes < MONTH(CURRENT_DATE) AND Cuotas.anio <= year(CURRENT_DATE)) as ta1,(SELECT *
						     FROM Alumnos 
                             WHERE 1) as alu2 WHERE NOT EXISTS (SELECT * 
                                                                FROM Pagos 
                                                                where Pagos.idCuota=ta1.id and Pagos.idAlumno = alu2.id)
								                                ORDER BY ta1.anio DESC,ta1.mes DESC  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=3;




	                              }
    }
}

$alumnosConMatricula=$query2->fetchAll();
}
?>