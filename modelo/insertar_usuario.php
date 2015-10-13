<?php
	require("../modelo/coneccionBD.php");


	$cons1= $cn->prepare("SELECT id FROM Usuarios WHERE username=?");
	$cons1->execute(array($_POST['nombre_usuario']));
	//var_dump($dni);
	$rows=$cons1->fetchAll();
	//var_dump($rows);
    //$error=$cons1->errorInfo();
	//var_dump($error);
	if (count($rows) != 0) {
		$fallo=true;
		//echo 'entre';
	}
	else{
		$fallo=false;
	$query = $cn->prepare("INSERT INTO Usuarios (username, password, rol) VALUES (?,?,?)");
	$aux=$query->execute(array($_POST['nombre_usuario'],$_POST['pass'], $_POST['rol'])); 
	//$error=$query->errorInfo();
	}

?>