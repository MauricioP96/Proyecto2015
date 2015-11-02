<?php
function setearPagina(){
$pagina=1;
if(!empty($_GET['pag'])){
	$pagina=$_GET['pag'];
	//var_dump($_GET);
	//var_dump($pagina);
}
return $pagina;
}

?>