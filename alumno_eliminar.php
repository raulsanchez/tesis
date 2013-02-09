<?php
session_start();
require_once 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	echo "<script type=''>";
		echo "window.location='entrar.php?url=";
		echo $_SERVER['REQUEST_URI']."'";
	echo "</script>";
endif;
	$rut=$_GET['ver'];
    if(mysql_query("DELETE FROM `alumno` WHERE `al_rut`='" . $rut . "'",Conectar::conecta())):
    	echo "se ejecutó bien la query";
    	echo "<script type='text/javascript'>
        	 window.location='alumno.php';
         	 </script>";
    else:
    	echo "error en la query -> ".mysql_error();
    endif;


?>
