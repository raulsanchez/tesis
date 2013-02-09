<?php
session_start();
require_once '../clases/conectar.class.php';

if(isset($_POST["enviar"])):
	$usuario	= ($_POST["usuario"]);
	$clave		= ($_POST["clave"]);
	if(empty($usuario)===true || empty($clave)===true):
		echo "ingrese rut y/o contraseña";
	else:
		$consulta=mysql_query("SELECT `ap_rut`,ap_nombre,ap_apaterno,ap_amaterno
								FROM `apoderado`
								WHERE `ap_rut` ='".$usuario."'
								AND `ap_clave`='".$clave."'",Conectar::conecta());
		if($resultado=mysql_fetch_array($consulta)):
			$_SESSION['id_admin2']	= $resultado['ap_rut'];
			$_SESSION['nombres'] = $resultado['ap_nombre']." ".$resultado['ap_apaterno']." ".$resultado['ap_amaterno'];
			echo "Exito, usted esta registrado en nuestra base de datos";
			if(($_POST['url'])!=null):
				echo "<script type=''>";
					echo "window.location='";
					echo $_POST["url"]."'";
				echo "</script>";
			else:
				echo "<script type=''>";
					echo "window.location='index.php'";
				echo "</script>";
			endif;
		else:
			echo 'usted no se encuentra en nuestra bases de datos, intentelo nuevamente ';
			echo '<a href="entrar.php">Volver</a>';
		endif;
	endif;
endif;
 ?>