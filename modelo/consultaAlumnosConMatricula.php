<?php
require ("../modelo/coneccionBD.php");
require("../modelo/setearpagina.php");
//var_dump($_POST['tipodel']);

if ((empty($_POST['tipodel']))  || $_POST['tipodel'] == 1){
$query = $cn->prepare("SELECT count(*) as num FROM alumnos INNER JOIN Pagos ON (alumnos.id=pagos.idAlumno)
                                                            INNER JOIN cuotas ON (pagos.idCuota=cuotas.id) 
                                                            WHERE cuotas.tipo='matricula' and alumnos.eliminado=0 and cuotas.anio = YEAR(CURRENT_DATE())");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT alumnos.nombre, alumnos.apellido, cuotas.fechaAlta,cuotas.comisionCob,cuotas.monto FROM alumnos INNER JOIN pagos ON (alumnos.id=pagos.idAlumno)
                      INNER JOIN cuotas ON (pagos.idCuota=cuotas.id) 
                      WHERE cuotas.tipo='matricula' and alumnos.eliminado=0 and cuotas.anio = YEAR(CURRENT_DATE())  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=1;
}
else{
	if($_POST['tipodel'] == 2){
		$query = $cn->prepare("SELECT count(*) as num FROM Cuotas INNER JOIN pagos ON (Cuotas.id=pagos.idCuota) 
			                                  INNER JOIN alumnos ON (alumnos.id=pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT alumnos.apellido,alumnos.nombre,cuotas.numero,cuotas.fechaAlta,cuotas.monto,cuotas.comisionCob FROM Cuotas INNER JOIN pagos ON (Cuotas.id=pagos.idCuota) 
	                                INNER JOIN alumnos ON (alumnos.id=pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=2;
	}


}

$alumnosConMatricula=$query2->fetchAll();
?>