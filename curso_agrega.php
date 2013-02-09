<?php
session_start();
require_once 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	if($_SESSION['ingreso']!=1):
		echo "<script type=''>";
			echo "window.location='entrar.php?url=";
			echo $_SERVER['REQUEST_URI']."'";
		echo "</script>";
	endif;
endif;
$query = "SELECT al_rut,al_nombre,al_apaterno,al_amaterno FROM  `alumno`";
$result = mysql_query($query,Conectar::conecta());


?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
		<script type="text/javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>

 		</head>
	<!-- FIN HEAD -->
<body>
	<!-- HEADER -->
		<?php include 'template/header.php';?>
			<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    		<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	<!-- FIN HEADER -->
	<!-- MENU  -->
		<?php include 'template/nav.php'; ?>
	<!-- FIN MENU -->
	<div id="submenu">
		<div class="submenu">
			<ul>
				<!-- <li><a href="atraso_agrega.php"><img src="images/add.png" alt="nuevo"> Ingresar nuevo alumno</a></li> -->
				<!-- <li><a href=""><img src="images/pencil.png" alt=""> Editar</a></li>
					<li><a href=""><img src="images/delete.png" alt=""> Eliminar</a></li> -->
			</ul>
		</div>
	</div>
	<div id="contenido">
		<div class="perfil">
			<form action="" method="POST">
				<fieldset>
				<legend>Creacion de un curso</legend>
					<table border="1">
						<tr>
							<td class="margen-der">Nombre</td>
							<td>
								<input type="text" name="curso" id="curso" required="required" size="4"placeholder="1°B">
							</td>
						</tr>
						<tr>
							<td class="margen-der">Codigo</td>
							<td>
								<input type="text" name="codigo" id="codigo" required="required" >
							</td>
						</tr>
						<tr>
							<td class="margen-der">Año</td>
							<td><input type="year" size="4" name="anio" required="required" placeholder="2012"</td>
						</tr>
						<tr>
							<td class="margen-der">Descripción</td>
							<td><textarea name="descripcion" id="" cols="30" rows="10"></textarea> </td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" value="Crear curso" name="enviar" class="btn btn-primary" ></td>
						</tr>
					</table>
			</fieldset>

			</form>

		</div>
		<div class="clear"></div>
	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
	<?php
	if(isset($_REQUEST['enviar'])):
		$curso=$_POST['curso'];
		$codigo=$_POST['codigo'];
		$anio=$_POST['anio'];
		$descripcion=$_POST['descripcion'];

		$sql="INSERT INTO `curso`(cu_codigo, `cu_nombre`, `cu_anio`, `cu_descripcion`)
					VALUES 		('$codigo','$curso','$anio','$descripcion')";

		if(!mysql_query($sql,Conectar::conecta())):
			echo "error en la consulta -> ".mysql_error();
		endif;



	endif;
	?>
</body>
</html>
