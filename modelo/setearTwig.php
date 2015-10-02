<?php 


require_once("../vendor/twig/twig/lib/Twig/Autoloader.php");
Twig_Autoloader::register();

$templateDir="../vista";
$loader = new Twig_Loader_Filesystem($templateDir);
$twig = new Twig_Environment($loader);

?>