<?php
require("../modelo/coneccionBD.php");

	$pago= $cn->prepare("INSERT INTO Pagos (idAlumno,idCuota,fecha,fechaAlta,becado,fechaActualizado)
							 VALUES (?,?,CURRENT_TIME,CURRENT_TIME,?,CURRENT_TIME)");
	//var_dump($pago);
	//var_dump($idcuotas);
	if($debobecar){
		$becar=1;
	}
	else{
		$becar=0;

	}
	foreach ($idcuotas as $idcuota){
		//var_dump($idcuota[0]);
		$aux=array($idalumno,$idcuota[0],$becar);
		//var_dump($aux);
		$pago->execute($aux);
		//$error=$pago->errorInfo();
		//var_dump($error);
	}
	$agrego=true;
	//var_dump($dni);
	//var_dump($rows);
    //$error=$pago->errorInfo();
	//var_dump($error);
//}


?>