<?php
require ("../modelo/coneccionBD.php");
require("../modelo/setearpagina.php");
$query = $cn->prepare("SELECT count(*) as num FROM Cuotas INNER JOIN Meses ON (Meses.idMes=Cuotas.mes) WHERE Cuotas.eliminada=FALSE and NOT EXISTS(Select *
                                                                               FROM Pagos
                                                                               WHERE Cuotas.id=Pagos.idCuota)");
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
$query2=$cn->prepare("SELECT * FROM Cuotas INNER JOIN Meses ON (Meses.idMes=Cuotas.mes) WHERE eliminada=FALSE and 
												NOT EXISTS(Select *
                                                          FROM Pagos
                                                         WHERE Cuotas.id=Pagos.idCuota) 
               ORDER BY anio DESC,mes DESC LIMIT :cantidad OFFSET :offset ");
$query2->bindValue(':cantidad', $sss, PDO::PARAM_INT);
$query2->bindValue(':offset', $offset, PDO::PARAM_INT);
$query2->execute();
//$error=$query2->errorInfo();
//var_dump($error);

$cuotas=$query2->fetchAll();
//var_dump($alumnos);

?>