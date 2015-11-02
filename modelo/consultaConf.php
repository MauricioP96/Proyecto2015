<?php 
function consultaConf($cn){
$query = $cn->prepare("SELECT * FROM Configuracion");
$query->execute(); 
$configuraciones = $query->fetchAll();
return $configuraciones;
}
?>