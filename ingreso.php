<?php
session_start();
require_once 'clases/conectar.class.php';

if(isset($_POST["enviar"])):
	$usuario	= ($_POST["usuario"]);
	$clave		= ($_POST["clave"]);
	if(empty($usuario)===true || empty($clave)===true):
		echo "ingrese rut y/o contraseña";
	else:
		$ingreso= new Login($usuario,$clave);
		if($ingreso->GetUsuario()):
			$_SESSION['ingreso']	= 1;
			$_SESSION['id_admin']	= $ingreso->id;
			$_SESSION['nombrecom']	= $ingreso->nombre;
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
