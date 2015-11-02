<?php
function eliminarAlumno($cn,$id_alumno){
$query = $cn->prepare("UPDATE Alumnos
				SET eliminado=1
				WHERE id=?");
$gg=array($id_alumno);
$aux=$query->execute($gg); 
return $aux;
/*if($aux){
        $elimino_alumno=true;
	//header ("Location: ../controlador/controlador_listadoAlumnos.php");
}*/
}
?>