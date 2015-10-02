<?php
echo 'estoy en alta';
require("../utilidadesphp/coneccionBD.php");
echo 'pase require';

//Pedimos los datos ingresados en altas.php mediante POST
 
$dni = $_POST["dni"];
 
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
var_dump($nombre);

//Inserta en la tabla

$query = $cn->prepare("INSERT INTO Alumnos(nombre) VALUES (?)");
$query->execute(array($_POST["nombre"])); 

/*  
//Verificamos si los datos fueron insertados en la tabla
if($resultado)
{
//Si se insertó, mostramos un mensaje en JavaScript confirmando
echo "<script language='javascript'>alert('El registro fue guardado correctamente.')</script>";
exit;
}
else
{?>
<!--//Si no se insertó, mostramos un mensaje avisando tal error
echo " --><script language='javascript'>alert('Los Datos no fueron cargados.')</script>";
}
?>

