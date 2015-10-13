<?php

function guardar_responsable($tipo,$nombre,$apellido,$fecha_nacimiento,$sexo,$mail,$telefono,$direccion,$username, $password){
	require("../modelo/coneccionBD.php");
        

	$nuevo_responsable= $cn->prepare("SELECT mail FROM Responsables WHERE mail=?");
	$nuevo_responsable->execute(array($mail));
	$rows=$nuevo_responsable->fetchAll();

	if ($nuevo_responsable->rowCount() > 0) {
		return true;
	}
	else{
            


                            $query = $cn->prepare("INSERT INTO Responsables (tipo, nombre, apellido, fechaNacimiento,
                             sexo, mail, telefono, direccion) VALUES (?,?,?,?,?,?,?,?)");
                            $aux=$query->execute(array($tipo,$nombre,$apellido,$fecha_nacimiento,$sexo,$mail,$telefono,$direccion)); 
                            $fallo=false;
                            
                            
                            $query = $cn->prepare("INSERT INTO Usuarios (username, password, rol) VALUES (?,?,?)");
                            $aux=$query->execute(array($username,$password,"consulta")); 
                            $fallo=false;
                    }
                    return $fallo;
        
}

function guardar_usuario($username, $password){
                	require("../modelo/coneccionBD.php");

                $nuevo_usuario= $cn->prepare("SELECT username FROM Usuarios WHERE username=?");
                $nuevo_usuario->execute(array($username));
                $rows=$nuevo_usuario->fetchAll();

                    if ($nuevo_usuario->rowCount() > 0) {
                            return true;
                    }
                    else{
                        return false;
    
                    }
}

function obtener_responsables(){
	require("../modelo/coneccionBD.php");
	$responsables= $cn->prepare("SELECT id,nombre,apellido,mail FROM Responsables");
	$responsables->execute(array());
	return $responsables;
}

	

?>