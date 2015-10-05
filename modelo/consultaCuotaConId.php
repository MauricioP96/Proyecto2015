<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Cuotas WHERE id=?");
$query->execute(array($idCuota)); 
$cuota = $query->fetchAll();
//svar_dump($cuota);



?>