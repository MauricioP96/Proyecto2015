<?php

session_start();
echo 'hola';
if(empty($_SESSION['nombreusuario'])){						//Chekear si tiene sesion iniciada. If false redireccionar a index
	header ("Location: index.php");
	}								
	elseif($_SESSION['rol']!='administracion' ){			//si el usuario no es administrador no darle permiso
		header ("Location: ../controlador/controlador_login.php");					
}
if(!empty($_POST['id_alumno_eliminar'])){
	$id_alumno_eliminar=$_POST['id_alumno_eliminar']; 
        $idAlumno=$_POST['id_alumno_eliminar'];
        $idResponsableEliminar=$_POST['idResponsableEliminar'];
	require('../modelo/consulta_eliminar_alumno_responsable.php');

}
if(!empty($_POST['idAlumno'])){                     //agregar responsable al alumno
	$idAlumno=$_POST['idAlumno'];
        $idResposable=$_POST['idResponsable'];
       	require('../modelo/consulta_agregar_alumno_responsable.php');
               var_dump($idResposable);
               var_dump($idAlumno);
}


require("../modelo/consultaConf.php");  
        

        require("../modelo/consulta_alumno_responsables.php"); //Consulta los alumnos-responsables y me traigo los responsables del alumno
	           //consulta de configuracion

require("../modelo/consulta_responsables.php");
require('../modelo/setearTwig.php');

$template = $twig->loadTemplate('listado_responsables.html');
	$template->display(array('titulo' => $configuraciones['0']['titulo'],
							'contacto' => $configuraciones['0']['mailContacto'],
							'tipo' => $_SESSION['rol'],
	                        'alumno_responsables' => $alumno_responsables,
                                'idAlumno' => $idAlumno,
	                        'responsables' => $responsables,
                                'agrego_responsable' => $agrego_responsable,
                                'ultimo_responsable' => $ultimo_responsable,
                                'elimino_responsable' => $elimino_responsable,
	                        'cantpaginas' => $cantidadpaginas,
	                        'paginaactual' => $pagina,
						));


?>