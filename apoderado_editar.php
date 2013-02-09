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
$consulta=mysql_query("SELECT 	`ap_rut`,
								`ap_nombre`,
								`ap_apaterno`,
								`ap_amaterno`,
								 ap_fecha_nac,
								`ap_direccion`,
								`ap_comuna`,
								`ap_celular`,
								`ap_telefono`,
								`ap_telefono_trabajo`,
								`ap_correo`
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
				<li><a href=""><img src="images/pencil.png" alt=""> Editar</a></li>
				<li><a href=""><img src="images/delete.png" alt=""> Eliminar</a></li>
			</ul>
		</div>
	</div>
	<div id="contenido">
		<div class="perfil">
			<form action="#" method="POST">
				<fieldset>
					<legend>Datos Alumno</legend>
					<table id="tabla_perfil">
						<tr>
							<td>Nombre</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="nombre" value="<?php echo $resultado['ap_nombre']; ?>">
							</td>
						</tr>

						<tr>
							<td>Apellido Paterno</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="apaterno"value="<?php echo $resultado['ap_apaterno']?>">
							</td>
						</tr>
						<tr>
							<td>Apellido Materno</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="amaterno" value="<?php echo $resultado['ap_amaterno']; ?>">
							</td>
						</tr>
						<tr>
							<td>Fecha Nacimiento</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="fnacimiento" value="<?php echo cambiarfecha_espanol($resultado['ap_fecha_nac']); ?>">
							</td>
						</tr>


						<tr>
							<td>Direccion</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="direccion" value="<?php echo $resultado['ap_direccion']; ?>">
								<!-- <textarea name="direccion" id="mensaje">

								</textarea> -->
							</td>
						</tr>
						<tr>
							<td>Comuna</td>
						</tr>
						<tr>
							<td class="grande">
								<select id="comuna" name="comuna" class="txtBox">
					                        <option value="<?php echo $resultado['ap_comuna']; ?>"><?php echo $resultado['ap_comuna']; ?></option>
					                        <option value="Corral">Corral</option>
					                        <option value="Lanco">Lanco</option>
					                        <option value="Los Lagos">Los Lagos</option>
					                        <option value="Máfil">Máfil</option>
					                        <option value="Mariquina">Mariquina</option>
					                        <option value="Paillaco">Paillaco</option>
					                        <option value="Panguipulli">Panguipulli</option>
					                        <option value="Valdivia">Valdivia</option>
				                </select>
							</td>
						</tr>
						<tr>
							<td>Celular</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="celular" value="<?php echo $resultado['ap_celular']; ?>">
							</td>
						</tr>
						<tr>
							<td>Telefono</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="telefono" value="<?php echo $resultado['ap_telefono']; ?>">
							</td>
						</tr>
						<tr>
							<td>Telefono Trabajo</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="telefono_trab" value="<?php echo $resultado['ap_telefono_trabajo']; ?>">
							</td>
						</tr>
						<tr>
							<td>Correo Electronico</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" name="correo" value="<?php echo $resultado['ap_correo']; ?>">
							</td>
						</tr>
						<tr>
							<input type="hidden" name="rut" value="<?php echo $resultado['ap_rut']; ?>">
							<td><input type="submit" value="Actualizar datos" name="actualiza" class="btn btn-primary"></td>
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
</body>
</html>
<?php
if(isset($_REQUEST['actualiza'])):
	$nombre			=	$_POST['nombre'];
	$apaterno		=	$_POST['apaterno'];
	$amaterno		=	$_POST['amaterno'];
	$fnacimiento	= 	$_POST['fnacimiento'];
	$direccion		=	$_POST['direccion'];
	$comuna			=	$_POST['comuna'];
	$celular		=	$_POST['celular'];
	$telefono		=	$_POST['telefono'];
	$telefono_trab	=	$_POST['telefono_trab'];
	$correo 		=	$_POST['correo'];
	$rut 			=	$_POST['rut'];
	$fnacimiento=cambiarfecha_mysql($fnacimiento);

	$sql="	UPDATE `apoderado`
			SET		`ap_nombre`				='".$nombre."',
					`ap_apaterno`			='".$apaterno."',
					`ap_amaterno`			='".$amaterno."',
					 ap_fecha_nac			='".$fnacimiento."',
					`ap_direccion`			='".$direccion."',
					`ap_comuna`				='".$comuna."',
					`ap_celular`			='".$celular."',
					`ap_telefono`			='".$telefono."',
					`ap_telefono_trabajo`	='".$telefono_trab."',
					`ap_correo`				='".$correo."'
			WHERE ap_rut='".$rut."'";


	if(!mysql_query($sql,Conectar::conecta())){
		echo mysql_error();
	}
	else{
		?>
			<script type="text/javascript">
				new Messi(
		        	'Se actualizó correctamente',
		        	{
		        		title: 'Éxito',
		        		modal: true,
		        		titleClass: 'success',
		        		buttons: [{id: 0, label: 'Cerrar', val: 'X'}],
		        		autoclose:'3000'
		        	}
		        );
					function redireccionarPagina() {
	 					window.location='apoderado_perfil.php?ver=<?php echo $rut ?>';
	 				}
					setTimeout("redireccionarPagina()", 3000);
			</script>
		<?php
	}
endif;
?>