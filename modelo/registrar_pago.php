<?php
function registrar_pago($cn,$idalumno,$idcuotas,$debobecar,$user){

	$pago= $cn->prepare("INSERT INTO Pagos (idAlumno,idCuota,fecha,fechaAlta,becado,fechaActualizado,id_user)
							 VALUES (?,?,CURRENT_TIME,CURRENT_TIME,?,CURRENT_TIME,?)");
	//var_dump($pago);
	//var_dump($idcuotas);
	if($debobecar==true){
		$becar=1;
	}
	else{
		$becar=0;

	}
	foreach ($idcuotas as $idcuota){
		//var_dump($idcuota[0]);
		$aux=array($idalumno,$idcuota,$becar,$user);
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

}
?>