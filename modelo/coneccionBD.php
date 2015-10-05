<?php 

$db_host="localhost";
$db_user="grupo_10";
$db_pass="DCerbxcYhyEA9X4T";
$db_base="grupo_10"; 
try{
	$cn = new PDO("mysql:dbname=$db_base;host=$db_host",$db_user,$db_pass);
}
catch(PDOException $e){
	echo "ERROR". $e->getMessage();
}


?>