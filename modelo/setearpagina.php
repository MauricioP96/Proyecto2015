<?php
function setearPagina(){
if(!empty($_GET['pag'])){
	return $pagina=$_GET['pag'];
	//var_dump($_GET);
	//var_dump($pagina);
}
else {
return 1;
}
}

?>