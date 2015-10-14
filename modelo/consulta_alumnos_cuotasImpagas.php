<?php
require ("../modelo/coneccionBD.php");
require("../modelo/setearpagina.php");


		$query = $cn->prepare("SELECT count(*) as num from cuotas as cuotitas where NOT EXISTS (select * 
                  from alumnos inner join pagos on (pagos.idAlumno=alumnos.id) 
                  inner join cuotas on (cuotas.id=pagos.idCuota) 
                  WHERE cuotitas.id = cuotas.id and alumnos.id = ?  )");
$query->execute(array($_POST['idalumnoCarga'])); 
$consultacant = $query->fetchAll();
$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar
$offset=(($pagina-1)*$configuraciones['0']['cantElem']);
$sss=intval($configuraciones['0']['cantElem']);
$cantidadpaginas= intval(ceil($cantidadalumnos/$sss));  
$query2=$cn->prepare("SELECT * from cuotas as cuotitas where NOT EXISTS (select * 
                  from alumnos inner join pagos on (pagos.idAlumno=alumnos.id) 
                  inner join cuotas on (cuotas.id=pagos.idCuota) 
                  WHERE cuotitas.id = cuotas.id and alumnos.id = :nroidalumno  ) LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->bindValue(':nroidalumno', $_POST['idalumnoCarga']);
$query2->execute(); 




$query3 = $cn->prepare("SELECT alumnos.nombre,alumnos.apellido FROM alumnos WHERE alumnos.id = :id ");
$query3->bindValue(':id', $_POST['idalumnoCarga']);
$query3->execute();
$alumnosinffoo = $query3 -> fetchAll();
$alumnosConMatricula = $query2->fetchAll();
?>