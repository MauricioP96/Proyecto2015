<?php
session_start();
require ("utilidadesphp/coneccionBD.php");
$query = $cn->prepare("SELECT * FROM Usuarios WHERE username=? and password=?");
$query->execute(array($_POST["usuario"],$_POST["clave"])); 
$rows = $query->fetchAll();
//print_r($rows);
echo 'entro';

if($query->rowCount()==1){
   session_destroy();
   session_start();
   foreach ($rows as $row) {
   		 $_SESSION['nombreusuario'] = $row['username'];
		$_SESSION['rol'] = $row['rol'];
	echo $_SESSION['nombreusuario'];

	echo $_SESSION['rol'];
  switch ($row['rol']) {
    case 'administracion':
        header ("Location: listadoAlumnos.php");
        break;
    case 'gestion':
        //header ("Location: listadoAlumnos.php");
        echo "falta configurar la pagina de inicio de gestion en chequearInicioDeSesion.php";
        break;
    case 2:
        //header ("Location: listadoAlumnos.php");
        echo "falta configurar la pagina de inicio de consulta en chequearInicioDeSesion.php";
        break;
}
}
}
else{
   $mostrofallo=true;
}

?>