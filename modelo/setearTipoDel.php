<?php 
function seteartipodel(){
if (empty($_REQUEST['tipodel'])){
        return $tipodel=1;
      }
      else{
        return $_REQUEST['tipodel'];
      }
}
?>