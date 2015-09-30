<?php

require ("utilidadesphp/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Usuarios WHERE username=? and password=?");
$query->execute(array($_POST["usuario"],$_POST["password"])); 
if($query->rowCount()){


}
else{
	
}

?>