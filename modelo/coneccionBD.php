<?php 

$db_host="localhost";//:33060";
$db_user="root";
$db_pass="root";
$db_base="grupo_10"; 
try{
	$cn = new PDO("mysql:dbname=$db_base;host=$db_host",$db_user,$db_pass);
}
catch(PDOException $e){
	echo "ERROR". $e->getMessage();
}


?>