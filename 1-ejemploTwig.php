<?php 
//Si no se usa Composer descomentar las 2 lineas siguientes para usar el autoload de Twig
//require_once("vendor/twig/twig/lib/Twig/Autoloader.php");
//Twig_Autoloader::register();

//Con composer, usar el autoload de composer
require_once 'vendor/autoload.php';

$templateDir="./";
//$templateDirCompi="./templates-c";

$loader = new Twig_Loader_Filesystem($templateDir);

$twig = new Twig_Environment($loader);
//, array("cache" => $templateDirCompi,
//           ));
            
$template = $twig->loadTemplate("plantilla-1.twig.html");
//Probemos descomentando el de abajo y comentadno el de arriba
//$template = $twig->loadTemplate("pruebas.html");


$template->display(array('nombre' => 'Pedrp!','lista' => array("1","2",223,4,5, 6)
));

?>




