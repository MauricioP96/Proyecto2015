<?php
function consulta_modificar_usuario($cn,$nombre,$pass, $rol,$idusuarioParaModificar){
$query1 = $cn->prepare("SELECT * 
				FROM Usuarios
				WHERE username=? AND NOT (id=?)");
$gg=array($_POST['nombre'],$_POST['idusuarioParaModificar']);
$query1->execute($gg); 
	$rows=$query1->fetchAll();
	//var_dump($rows);
    //$error=$cons1->errorInfo();
	//var_dump($error);
	if (count($rows) != 0) {
		$fallo=true;
		//echo 'entre';
	}
	else{
		$fallo=false;
	$query = $cn->prepare("UPDATE Usuarios
							SET username=?,password=?,rol=?
							WHERE id=?");
	$aux=$query->execute(array($nombre,$pass, $rol,$idusuarioParaModificar)); 
	//$error=$query->errorInfo();
	}
	return $fallo;
}
?>