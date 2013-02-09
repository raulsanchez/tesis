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
$rut_apo=$_GET['ver'];
$consulta=mysql_query("SELECT `ap_rut`, `ap_nombre`, `ap_apaterno`, `ap_amaterno`, `ap_direccion`, `ap_comuna`, `ap_celular`,`ap_celular2`, `ap_telefono`, `ap_telefono_trabajo`, `ap_correo`,ap_fecha_nac
			FROM apoderado
			WHERE ap_rut='".$rut_apo."'",Conectar::conecta());
$resultado=mysql_fetch_array($consulta);
?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
		<script language="JavaScript">
            function confirmar ( mensaje ) {
                return confirm( mensaje );
            }
        </script>
	</head>
	<!-- FIN HEAD -->
<body>
	<!-- HEADER -->
		<?php include 'template/header.php';?>
	<!-- FIN HEADER -->
	<!-- MENU  -->
		<?php include 'template/nav.php'; ?>
	<!-- FIN MENU -->
	<div id="submenu">
		<div class="submenu">
			<ul>
				<!-- <li><a href="alumno_agrega.php"><img src="images/add.png" alt="nuevo"> Ingresar nuevo alumno</a></li> -->
				<li><a href="apoderado_editar.php?ver=<?php echo $resultado["ap_rut"]; ?>"><img src="images/pencil.png" alt=""> Editar</a></li>
				<li><a href="apoderado_eliminar.php?ver=<?php echo $resultado["ap_rut"]; ?>" onclick="return confirmar('¿Está seguro que desea eliminar el apoderado?')"><img src="images/delete.png" alt=""> Eliminar</a></li>
			</ul>
		</div>
	</div>
	<div id="contenido">
		<div class="perfil">
				<fieldset>
					<legend>Datos Apoderado </legend>
					<table id="tabla_perfil">
						<tr>
							<td>Rut</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['ap_rut']; ?></td>
						</tr>
						<tr>
							<td>Nombre</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['ap_nombre']." ".$resultado['ap_apaterno']." ".$resultado['ap_amaterno']; ?></td>
						</tr>
						<tr>
							<td>Fecha Nacimiento</td>
						</tr>
						<tr>
							<td class="grande"><?php echo cambiarfecha_espanol($resultado['ap_fecha_nac']) ." (".
							(date("Y-m-d")-$resultado['ap_fecha_nac']). " años)" ?></td>
						</tr>
						<tr>
							<td>Direccion</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['ap_direccion'].", ".$resultado['ap_comuna']; ?></td>
						</tr>
						<tr>
							<td>Celular</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['ap_celular']; ?></td>
						</tr
						<tr>
							<td>Celular otro</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['ap_celular2']; ?></td>
						</tr>
						<tr>
							<td>Telefono</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['ap_telefono']; ?></td>
						</tr>
						<tr>
							<td>Telefono Trabajo</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['ap_telefono_trabajo']; ?></td>
						</tr>
						<tr>
							<td>Correo Electronico</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['ap_correo']; ?></td>
						</tr>
					</table>
				</fieldset>
			</div>
		<div class="clear"></div>

	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
</body>
</html>
