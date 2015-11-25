<?php
function generarpdf ($cn,$pdf,$datos){
     require ('../dompdf/dompdf_config.inc.php');
     if ($pdf == 1){
      $tabla="<table>";
     foreach ($datos as $fila) {
     	$tabla=$tabla."
     	<tr>
      <td>".$fila['fechaAlta']."</td>
     	<td>".$fila['nombre']."</td>
      <td>".$fila['apellido']."</td>
      <td>".$fila['monto']."</td>
      <td>".$fila['comisionCob']."%</td>
     	</tr> ";
     }
     $tabla=$tabla."</table>";
  
}
if ($pdf == 2){
      $tabla="<table>";
     foreach ($datos as $fila) {
      $tabla=$tabla."
      <tr>
      <td>".$fila['apellido']."</td>
      <td>".$fila['nombre']."</td>
      <td>".$fila['numero']."</td>
      <td>".$fila['fechaAlta']."</td>
      <td>".$fila['monto']."</td>
      <td>".$fila['comisionCob']."</td>
      <td>".$fila['becado']."</td>
      </tr> ";
     }
     $tabla=$tabla."</table>";
     
}
if ($pdf == 3){
      $tabla="<table>";
     foreach ($datos as $fila) {
      $tabla=$tabla."
      <tr>
      <td  >".$fila['numero']."</td>
       <td>".$fila['mes']."/".$fila['anio']."</td>
       <td>".$fila['nombre']."</td>
       <td>".$fila['apellido']."</td>
       <td>".$fila['monto']."</td>
       <td  >".$fila['comisionCob']."%</td>
       
      </tr> ";
     }
     $tabla=$tabla."</table>";
  
}
if ($pdf == 5){
      $tabla="<table>";
     foreach ($datos as $fila) {
      $tabla=$tabla."
      <tr>
      <td >".$fila['mes']."</td>
       <td>".$fila['ano']."</td>
       <td>".$fila['comision']."$</td>
       
      </tr> ";
     }
     $tabla=$tabla."</table>";
  
}
$prints = '<html>
<head>
    <title>Banco Alimentario</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
    <style>
   .contenedor {
        width:85%;
        margin-left:10px;
        margin-right:10px;
    }
    table {
        border:1px solid black;
        width:80%;
        padding:2%;
        margin:2%;
        max-width:50%    
    }
    table {
        border-collapse: collapse;
    }
    table, td, th {
        border: 1px solid black;
    }

    </style>
    <div class="contenedor">
        '.$tabla.'
    </div>
    </body>
</html>';
        $mipdf = new DOMPDF();
        $mipdf->set_paper("a4", "portrait");
        $mipdf->load_html(utf8_decode($prints));
        $mipdf->render();
        $mipdf->stream('file.pdf');
    }


    function generarpdfconsulta ($cn,$pdf,$datos){
     require ('../dompdf/dompdf_config.inc.php');
     if ($pdf == 1){
      $tabla="<table>";
     foreach ($datos as $fila) {
      $tabla=$tabla."
      <tr>  
      <td>".$fila['fechaAlta']."</td>
      <td>".$fila['nombre']."</td>
      <td>".$fila['apellido']."</td>
      <td>".$fila['monto']."</td>
      <td>".$fila['comisionCob']."%</td>
      </tr> ";
     }
     $tabla=$tabla."</table>";
  
}
if ($pdf == 2){
      $tabla="<table>";
     foreach ($datos as $fila) {
      $tabla=$tabla."
      <tr>
      <td>".$fila['apellido']."</td>
      <td>".$fila['nombre']."</td>
      <td>".$fila['numero']."</td>
      <td>".$fila['fechaAlta']."</td>
      <td>".$fila['monto']."</td>
      <td>".$fila['comisionCob']."</td>
      <td>".$fila['becado']."</td>
      </tr> ";
     }
     $tabla=$tabla."</table>";
     
}
if ($pdf == 3){
      $tabla="<table>";
     foreach ($datos as $fila) {
      $tabla=$tabla."
      <tr>
      <td  >".$fila['numero']."</td>
       <td>".$fila['mes']."/".$fila['anio']."</td>
       <td>".$fila['nombre']."</td>
       <td>".$fila['apellido']."</td>
       <td>".$fila['monto']."</td>
       <td  >".$fila['comisionCob']."%</td>
       
      </tr> ";
     }
     $tabla=$tabla."</table>";
  
}
if ($pdf == 5){
      $tabla="<table>";
     foreach ($datos as $fila) {
      $tabla=$tabla."
      <tr>
      <td >".$fila['mes']."</td>
       <td>".$fila['ano']."</td>
       <td>".$fila['comision']."$</td>
       
      </tr> ";
     }
     $tabla=$tabla."</table>";
  
}
$prints = '<html>
<head>
    <title>Banco Alimentario</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
    <style>
   .contenedor {
        width:85%;
        margin-left:10px;
        margin-right:10px;
    }
    table {
        border:1px solid black;
        width:80%;
        padding:2%;
        margin:2%;
        max-width:50%    
    }
    table {
        border-collapse: collapse;
    }
    table, td, th {
        border: 1px solid black;
    }

    </style>
    <div class="contenedor">
        '.$tabla.'
    </div>
    </body>
</html>';
        $mipdf = new DOMPDF();
        $mipdf->set_paper("a4", "portrait");
        $mipdf->load_html(utf8_decode($prints));
        $mipdf->render();
        $mipdf->stream('file.pdf');
    }

?>