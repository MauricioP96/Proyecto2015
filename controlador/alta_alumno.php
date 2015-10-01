<?php
require("utilidadesphp/coneccionBD.php");
 echo 'dwdasd';
//Pedimos los datos ingresados en altas.php mediante POST
 
$dni = $_POST["dni"];
 
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
var_dump($apellido);
 
//Inserta en la tabla
 
//$resultado = mysql_query(”INSERT INTO Alumnos ('numeroDoc','nombre','apellido') VALUES ('$dni','$nombre','$apellido')”);
 
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

?>

