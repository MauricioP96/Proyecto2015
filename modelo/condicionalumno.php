<?php
if(!empty($_REQUEST['idalumno'])){
	$idalumno=$_REQUEST['idalumno'];
}
if(!empty($_POST['idalumnopagar'])){
	$idalumno=$_POST['idalumnopagar'];
	//var_dump($_POST);
	$ok=true;
}
if(!empty($_POST['idalumnobecar'])){
	$idalumno=$_POST['idalumnobecar'];
	//var_dump($_POST);
	$ok=true;
}
$debobecar=(!empty($_POST['idalumnobecar']));
//var_dump($debobecar);
?>