<?php
require ("../modelo/coneccionBD.php");
require("../modelo/setearpagina.php");
if ((empty($_POST['tipodel']))  || $_POST['tipodel'] == 1){
$query = $cn->prepare("SELECT count(*) as num 
	                    FROM Alumnos INNER JOIN Pagos ON (Alumnos.id=Pagos.idAlumno) 
	                                 INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id) 
	                                 INNER JOIN AlumnoResponsable ON (Alumnos.id = AlumnoResponsable.idAlumno) 
	                                 INNER JOIN Responsables ON (Responsables.id= AlumnoResponsable.idResponsable) 
	                                 INNER JOIN usuarioresponsable ON (usuarioresponsable.idResponsable=responsables.id) 
	                                 INNER JOIN usuarios ON (usuarios.id=usuarioresponsable.idUsuario) 
	                    WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE()) and Usuarios.username=?");
$query->execute(array($_SESSION['nombreusuario']));
$consultacant = $query->fetchAll();
$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar
$offset=(($pagina-1)*$configuraciones['0']['cantElem']);
$sss=intval($configuraciones['0']['cantElem']);
$cantidadpaginas= intval(ceil($cantidadalumnos/$sss)); 
$query2=$cn->prepare("SELECT * 
	                    FROM Alumnos INNER JOIN Pagos ON (Alumnos.id=Pagos.idAlumno) 
	                                 INNER JOIN Cuotas ON (Pagos.idCuota=Cuotas.id) 
	                                 INNER JOIN AlumnoResponsable ON (Alumnos.id = AlumnoResponsable.idAlumno) 
	                                 INNER JOIN Responsables ON (Responsables.id= AlumnoResponsable.idResponsable) 
	                                 INNER JOIN usuarioresponsable ON (usuarioresponsable.idResponsable=responsables.id) 
	                                 INNER JOIN usuarios ON (usuarios.id=usuarioresponsable.idUsuario) 
	                    WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE()) and Usuarios.username=:user LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->bindValue(':user', $_SESSION['nombreusuario']);
$query2->execute();
$datosprepost=1;

}
else{
	if ($_POST['tipodel'] == 2){
		$query = $cn->prepare("SELECT count(*) as num FROM Cuotas 
			                         INNER JOIN pagos ON (Cuotas.id=pagos.idCuota) 
			                         INNER JOIN alumnos ON (alumnos.id=pagos.idAlumno)
                                     INNER JOIN AlumnoResponsable ON (Alumnos.id = AlumnoResponsable.idAlumno) 
	                                 INNER JOIN Responsables ON (Responsables.id= AlumnoResponsable.idResponsable) 
	                                 INNER JOIN usuarioresponsable ON (usuarioresponsable.idResponsable=responsables.id) 
	                                 INNER JOIN usuarios ON (usuarios.id=usuarioresponsable.idUsuario) 
                                     WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE()) and Usuarios.username=? ORDER BY Cuotas.fechaAlta ");


	
$query->execute(array($_SESSION['nombreusuario']));
$consultacant = $query->fetchAll();
$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar
$offset=(($pagina-1)*$configuraciones['0']['cantElem']);
$sss=intval($configuraciones['0']['cantElem']);
$cantidadpaginas= intval(ceil($cantidadalumnos/$sss)); 
$query2=$cn->prepare("SELECT * FROM Cuotas 
			                         INNER JOIN pagos ON (Cuotas.id=pagos.idCuota) 
			                         INNER JOIN alumnos ON (alumnos.id=pagos.idAlumno)
                                     INNER JOIN AlumnoResponsable ON (Alumnos.id = AlumnoResponsable.idAlumno) 
	                                 INNER JOIN Responsables ON (Responsables.id= AlumnoResponsable.idResponsable) 
	                                 INNER JOIN usuarioresponsable ON (usuarioresponsable.idResponsable=responsables.id) 
	                                 INNER JOIN usuarios ON (usuarios.id=usuarioresponsable.idUsuario) 
                                     WHERE Cuotas.tipo='matricula' and Alumnos.eliminado=0 and Cuotas.anio = YEAR(CURRENT_DATE()) and Usuarios.username=:user ORDER BY Cuotas.fechaAlta  LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->bindValue(':user', $_SESSION['nombreusuario']);
$query2->execute();
$datosprepost=2;
}
else{
	$query = $cn->prepare("SELECT count(*) as num FROM cuotas as ta1,(SELECT alumnoresponsable.idAlumno,alumnos.nombre,alumnos.apellido,alumnos.numeroDoc
 FROM usuarios  INNER JOIN usuarioresponsable ON (usuarios.id = usuarioresponsable.idUsuario) 
                INNER JOIN alumnoresponsable  ON ( usuarioresponsable.idResponsable = alumnoresponsable.idResponsable)
                INNER JOIN alumnos ON (alumnos.id = alumnoresponsable.idAlumno) 
                WHERE usuarios.username=?) as tat2 WHERE NOT EXISTS (SELECT * FROM pagos where pagos.idCuota=ta1.id and pagos.idAlumno= tat2.idAlumno)");
	
$query->execute(array($_SESSION['nombreusuario']));
$consultacant = $query->fetchAll();

$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar
$offset=(($pagina-1)*$configuraciones['0']['cantElem']);
$sss=intval($configuraciones['0']['cantElem']);
$cantidadpaginas= intval(ceil($cantidadalumnos/$sss)); 
$query2=$cn->prepare("SELECT * FROM cuotas as ta1,(SELECT alumnoresponsable.idAlumno,alumnos.nombre,alumnos.apellido,alumnos.numeroDoc
 FROM usuarios  INNER JOIN usuarioresponsable ON (usuarios.id = usuarioresponsable.idUsuario) 
                INNER JOIN alumnoresponsable  ON ( usuarioresponsable.idResponsable = alumnoresponsable.idResponsable)
                INNER JOIN alumnos ON (alumnos.id = alumnoresponsable.idAlumno) 
                WHERE usuarios.username=:user) as tat2 WHERE NOT EXISTS (SELECT * FROM pagos where pagos.idCuota=ta1.id and pagos.idAlumno= tat2.idAlumno) LIMIT :cantidad OFFSET :offset");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->bindValue(':user', $_SESSION['nombreusuario']);
$query2->execute();
$datosprepost=3;

}}

$alumnosConMatricula=$query2->fetchAll();

?>