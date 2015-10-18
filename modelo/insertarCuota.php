<?php
	require("../modelo/coneccionBD.php");


	$cons1= $cn->prepare("SELECT id FROM Cuotas WHERE anio=? AND mes=? AND tipo=?");
	$cons1->execute(array($_POST['anio'],$_POST['mes'],$_POST['tipo']));
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
	$aux=$query->execute(array($_POST['anio'],$_POST['mes'], $_POST['numero'], $_POST['monto'],$_POST['tipo'],$_POST['comisionCob'])); 
	$error=$query->errorInfo();
	//var_dump($error);
	}

?>