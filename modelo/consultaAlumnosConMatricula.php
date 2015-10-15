<?php
require ("../modelo/coneccionBD.php");
require("../modelo/setearpagina.php");
//var_dump($_POST['tipodel']);

if ((empty($_REQUEST['tipodel']))  || $_REQUEST['tipodel'] == 1){
$query = $cn->prepare("SELECT count(*) as num FROM Alumnos INNER JOIN Pagos ON (Alumnos.id=Pagos.idAlumno)
                                                            INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id) 
                                                            WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE())");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT Alumnos.nombre, Alumnos.apellido, Cuotas.fechaAlta,Cuotas.comisionCob,Cuotas.monto FROM Alumnos INNER JOIN Pagos ON (Alumnos.id=Pagos.idAlumno)
                                                            INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id) 
                                                            WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE())  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=1;
}
else{
	if($_REQUEST['tipodel'] == 2){
		$query = $cn->prepare("SELECT count(*) as num FROM Cuotas INNER JOIN Pagos ON (Cuotas.id=Pagos.idCuota) 
			                                  INNER JOIN Alumnos ON (Alumnos.id=Pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT Alumnos.apellido,Alumnos.nombre,Cuotas.numero,Cuotas.fechaAlta,Cuotas.monto,Cuotas.comisionCob FROM Cuotas INNER JOIN Pagos ON (Cuotas.id=Pagos.idCuota) 
			                                  INNER JOIN Alumnos ON (Alumnos.id=Pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=2;
	}
	else{
       if($_REQUEST['tipodel'] == 3){
		$query = $cn->prepare("SELECT count(*) as num FROM Cuotas as ta1,(SELECT *
								 FROM Alumnos WHERE 1) as alu2 WHERE NOT EXISTS (SELECT * FROM Pagos where Pagos.idCuota=ta1.id and Pagos.idAlumno = alu2.id)
								          ORDER BY ta1.anio DESC,ta1.mes DESC");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT * FROM Cuotas as ta1,(SELECT *
					 FROM Alumnos WHERE 1) as alu2 WHERE NOT EXISTS (SELECT * FROM Pagos where Pagos.idCuota=ta1.id and Pagos.idAlumno = alu2.id)
					  ORDER BY ta1.anio DESC,ta1.mes DESC  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=3;




	                              }
    }
}

$alumnosConMatricula=$query2->fetchAll();
?>