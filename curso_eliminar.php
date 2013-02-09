<?php
session_start();
require_once 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	echo "<script type=''>";
		echo "window.location='entrar.php?url=";
		echo $_SERVER['REQUEST_URI']."'";
	echo "</script>";
endif;
	$cod_curso=$_GET['ver'];
    if(mysql_query("DELETE FROM `curso` WHERE cu_codigo ='" . $cod_curso . "'",Conectar::conecta())):
    	echo "<script type='text/javascript'>
        	 window.location='curso.php';
         	 </script>";
    else:
    	echo "error en la query -> ".mysql_error();
    endif;


?>