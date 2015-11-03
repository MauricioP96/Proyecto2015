<?php
	function insertar_cuota($cn,$anio,$mes, $numero,$monto,$tipo,$comisionCob){

		$cons1= $cn->prepare("SELECT id FROM Cuotas WHERE anio=? AND mes=? AND tipo=?");
		$cons1->execute(array($anio,$mes,$tipo));
		//var_dump($_POST);
		$rows=$cons1->fetchAll();
		//var_dump($rows);
	    $error=$cons1->errorInfo();
		//var_dump($error);
		if (count($rows) != 0) {
			$fallo=true;
			//echo 'entre';
		}
		else{
			$fallo=false;
		$query = $cn->prepare("INSERT INTO Cuotas (anio, mes, numero, monto,tipo, comisionCob, fechaAlta) VALUES (?,?,?,?,?,?,CURRENT_TIME)");
		$aux=$query->execute(array($anio,$mes, $numero, $monto,$tipo,$comisionCob)); 
		//$error=$query->errorInfo();
		//var_dump($error);
		}
		return $fallo;
}
?>