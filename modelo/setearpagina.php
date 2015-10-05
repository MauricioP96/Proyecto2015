<?php
$pagina=1;
if(!empty($_GET['pag'])){
	$pagina=$_GET['pag']+0;
	//var_dump($_GET);
	//var_dump($pagina);
}


?>