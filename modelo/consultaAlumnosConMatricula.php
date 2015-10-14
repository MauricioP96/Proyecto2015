<?php
require ("../modelo/coneccionBD.php");
require("../modelo/setearpagina.php");
//var_dump($_POST['tipodel']);

<<<<<<< HEAD
if ((empty($_POST['tipodel']))  || $_POST['tipodel'] == 1){
$query = $cn->prepare("SELECT count(*) as num FROM alumnos INNER JOIN Pagos ON (alumnos.id=pagos.idAlumno)
                                                            INNER JOIN cuotas ON (pagos.idCuota=cuotas.id) 
                                                            WHERE cuotas.tipo='matricula' and alumnos.eliminado=0 and cuotas.anio = YEAR(CURRENT_DATE())");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT alumnos.nombre, alumnos.apellido, cuotas.fechaAlta,cuotas.comisionCob,cuotas.monto FROM alumnos INNER JOIN pagos ON (alumnos.id=pagos.idAlumno)
                      INNER JOIN cuotas ON (pagos.idCuota=cuotas.id) 
                      WHERE cuotas.tipo='matricula' and alumnos.eliminado=0 and cuotas.anio = YEAR(CURRENT_DATE())  LIMIT :cantidad OFFSET :offset");
=======
if ((empty($_REQUEST['tipodel']))  || $_REQUEST['tipodel'] == 1){
$query = $cn->prepare("SELECT count(*) as num FROM Alumnos INNER JOIN Pagos ON (Alumnos.id=Pagos.idAlumno)
                                                            INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id) 
                                                            WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE())");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT Alumnos.nombre, Alumnos.apellido, Cuotas.fechaAlta,Cuotas.comisionCob,Cuotas.monto FROM Alumnos INNER JOIN Pagos ON (Alumnos.id=Pagos.idAlumno)
                                                            INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id) 
                                                            WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE())  LIMIT :cantidad OFFSET :offset");
>>>>>>> a5687f8d1df5118ba0dbbd9b6cbe9f57b078d130
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=1;
}
else{
<<<<<<< HEAD
	if($_POST['tipodel'] == 2){
		$query = $cn->prepare("SELECT count(*) as num FROM Cuotas INNER JOIN pagos ON (Cuotas.id=pagos.idCuota) 
			                                  INNER JOIN alumnos ON (alumnos.id=pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT alumnos.apellido,alumnos.nombre,cuotas.numero,cuotas.fechaAlta,cuotas.monto,cuotas.comisionCob FROM Cuotas INNER JOIN pagos ON (Cuotas.id=pagos.idCuota) 
	                                INNER JOIN alumnos ON (alumnos.id=pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta  LIMIT :cantidad OFFSET :offset");
=======
	if($_REQUEST['tipodel'] == 2){
		$query = $cn->prepare("SELECT count(*) as num FROM Cuotas INNER JOIN Pagos ON (Cuotas.id=Pagos.idCuota) 
			                                  INNER JOIN Alumnos ON (Alumnos.id=Pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta");
require ("../modelo/modelo_consultas-calculos-listados.php");//calculo cuantas paginas debo mostrar
$query2=$cn->prepare("SELECT Alumnos.apellido,Alumnos.nombre,Cuotas.numero,Cuotas.fechaAlta,Cuotas.monto,Cuotas.comisionCob FROM Cuotas INNER JOIN Pagos ON (Cuotas.id=Pagos.idCuota) 
			                                  INNER JOIN Alumnos ON (Alumnos.id=Pagos.idAlumno) WHERE 1 ORDER BY Cuotas.fechaAlta  LIMIT :cantidad OFFSET :offset");
>>>>>>> a5687f8d1df5118ba0dbbd9b6cbe9f57b078d130
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
$datosprepost=2;
	}
	else{
		$query = $cn->prepare("SELECT count(*) as num FROM cuotas 
			                    WHERE cuotas.tipo = 'cuota' AND (cuotas.anio >= year(CURRENT_DATE)) AND 
			                    NOT EXISTS (SELECT * FROM pagos WHERE cuotas.id=pagos.idCuota)");
require ("../modelo/modelo_consultas-calculos-listados.php");
$query2=$cn->prepare("SELECT * FROM cuotas WHERE cuotas.tipo = 'cuota' AND (cuotas.anio >= year(CURRENT_DATE)) AND
                        NOT EXISTS (SELECT * FROM pagos WHERE cuotas.id=pagos.idCuota) LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
	$datosprepost=3;
}
}

$alumnosConMatricula=$query2->fetchAll();
?>