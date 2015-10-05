<?php
require("../modelo/coneccionBD.php");

	$pago= $cn->prepare("INSERT INTO Pagos (idAlumno, idCuota, fecha,fechaAlta,becado, fechaActualizado)
							 VALUES (?,?,CURRENT_TIME,CURRENT_TIME,?,CURRENT_TIME)");


	foreach ($idcuotas as $idcuota){
		//var_dump($idcuota[0]);
		$pago->execute(array($idalumno,$idcuota[0],$debobecar));
	}
	$agrego=true;
	//var_dump($dni);
	//var_dump($rows);
    //$error=$pago->errorInfo();
	//var_dump($error);
//}


?>