<?php
require ("../modelo/coneccionBD.php");
require("../modelo/setearpagina.php");
$query = $cn->prepare("SELECT count(*) as num FROM Usuarios WHERE habilitado=TRUE");
$query->execute(); 
$consultacant = $query->fetchAll();

$cantidadalumnos=intval($consultacant[0]['num']);   //consulto la cantidad de tuplas totales sin paginar q debo mostrar

//var_dump($consultacant);
//var_dump($cantidadalumnos);
//var_dump($pagina);

$offset=(($pagina-1)*$configuraciones['0']['cantElem']);
//var_dump($offset);
$sss=intval($configuraciones['0']['cantElem']);
$cantidadpaginas= intval(ceil($cantidadalumnos/$sss));  //calculo cuantas paginas debo mostrar
//var_dump($cantidadpaginas);
$query2=$cn->prepare("SELECT id, username,rol FROM Usuarios WHERE habilitado=TRUE ORDER BY username LIMIT :cantidad OFFSET :offset ");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
//$error=$query2->errorInfo();
//var_dump($error);

$usuarios=$query2->fetchAll();
//var_dump($usuarios);

?>
