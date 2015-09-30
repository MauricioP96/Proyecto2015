<?php

//conection:
$db_host="localhost";
$db_user="grupo_10";
$db_pass="DCerbxcYhyEA9X4T";
$db_base="grupo_10"; 

try {
	$cn = new PDO("mysql:dbname=$db_base;host=$db_host",$db_user,$db_pass);
	
	
	$query = $cn->prepare("SELECT * FROM usuarios ");
	$query->execute(array($_POST["email"],$_POST["pass"])); 

	//display information:
	echo "<br>Variables Recibidas:";
	echo"<br>Uusuario: <strong>". $_POST["email"]."</strong>";
	echo"<br>PASS: <strong>". $_POST["pass"]."</strong>";
	
	echo "<br> El query que hicimos fue: Ver log de mysql.....";

	echo "<br> El n&uacute;mero de resultados fue " . $query->rowCount();
	
	echo "<br> <br>Objeto resultado ";
	print_r($query);
	
	echo "<br> <br>Elementos resultado ";
	
	print_r($query->fetchAll());
	
	}
catch(PDOException $e){
	echo "ERROR". $e->getMessage();
	}



?>
