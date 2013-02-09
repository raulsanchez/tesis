<?php
session_start();
require_once 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	echo "<script type=''>";
		echo "window.location='entrar.php?url=";
		echo $_SERVER['REQUEST_URI']."'";
	echo "</script>";
endif;
	$id_comunicacion=$_GET['ver'];
    if(mysql_query("DELETE FROM `comunicacion` WHERE `idComunicacion`='" . $id_comunicacion . "'",Conectar::conecta())):
    	echo "se ejecutó bien la query";
    	echo "<script type='text/javascript'>
        	 window.location='comunicacion.php';
         	 </script>";
    else:
    	echo "error en la query -> ".mysql_error();
    endif;


?>