<?php
session_start();
require_once 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	echo "<script type=''>";
		echo "window.location='entrar.php?url=";
		echo $_SERVER['REQUEST_URI']."'";
	echo "</script>";
endif;
	$id_atraso=$_GET['ver'];
    if(mysql_query("DELETE FROM `atraso` WHERE `at_id`='" . $id_atraso . "'",Conectar::conecta())):
    	echo "<script type='text/javascript'>
        	 window.location='atraso.php';
         	 </script>";
    else:
    	echo "error en la query -> ".mysql_error();
    endif;


?>