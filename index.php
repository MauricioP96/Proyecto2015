<?php

if(!empty($_SESSION['nombreusuario'])){
	header ("Location: backend.php");					//Chekear si tiene sesion iniciada. If true redireccionar a backend
		}

if (!empty($_POST['usuario']){                                                   //verificar si se quiso iniciar sesion
	require('utilidadesphp/chequearInicioDeSesion.php');



require ("utilidadesphp/consultaConf.php");


//Hacer consulta bd para datos de configuracion

require("templates/index.html");  //esto se reemplaza x twig

