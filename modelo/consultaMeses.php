<?php 
function consulta_meses($cn){
$query = $cn->prepare("SELECT * FROM Meses");
$query->execute(); 
$meses = $query->fetchAll();
return $meses;
}
?>