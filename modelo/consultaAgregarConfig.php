<?php
function actualizarconfig($cn,$titulo,$descripcion,$mailContacto,$cantElem,$habilitada,$textoDeshab){
$query = $cn->prepare("UPDATE Configuracion SET titulo = ?, descripcion = ?, mailContacto = ?, cantElem = ?, habilitada = ?, textoDeshab = ? WHERE 1");
           $query->execute(array($titulo,$descripcion,$mailContacto,$cantElem,$habilitada,$textoDeshab)); 
}
?>