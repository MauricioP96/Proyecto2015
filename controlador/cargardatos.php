<?php
require ("../modelo/consulta_cargardatos_modelo.php");
  $consulta = datos1($_REQUEST['anio']);
  //var_dump($consulta);
  print json_encode($consulta);
?> 