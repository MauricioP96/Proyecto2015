<?php

require ("../modelo/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Usuarios WHERE id=?");
$query->execute(array($iduser)); 
$usuario = $query->fetchAll();




?>