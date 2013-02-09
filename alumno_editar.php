<?php
session_start();
require 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	if($_SESSION['ingreso']!=1):
		echo "<script type=''>";
			echo "window.location='entrar.php?url=";
			echo $_SERVER['REQUEST_URI']."'";
		echo "</script>";
	endif;
endif;
$rut=$_GET['ver'];
$consulta=mysql_query("SELECT `al_nombre`, `al_apaterno`, `al_amaterno`, `al_fecha_nacimiento`, `al_direccion`, `al_comuna`, `al_celular`, `al_telefono`, `al_correo`, `al_foto`
							FROM `alumno`
							WHERE `al_rut`='".$rut."'",Conectar::conecta());
$resultado=mysql_fetch_array($consulta);
$consulta_apoderado=mysql_query("SELECT  `ap_rut` ,  `ap_tipo_apoderado` ,  `ap_nombre` ,  `ap_apaterno` ,  `ap_amaterno`
								FROM  `apoderado`
								INNER JOIN apoderado_alumno ON ap_rut = aa_rut_apoderado
								INNER JOIN alumno ON al_rut = aa_rut_alumno
								WHERE aa_rut_alumno =  '$rut'",Conectar::conecta());

?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
		<META HTTP-EQUIV="Expires" CONTENT="0">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
			<script language="JavaScript">
            function confirmar ( mensaje ) {
                return confirm( mensaje );
            }
        </script>
        	<style type="text/css">
				#tabla_perfil{
					width:50%;
}
			</style>
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
			<li><a href=""><img src="images/pencil.png" alt=""> Editar</a></li>
			<li><a href="alumno_eliminar.php?ver=<?php echo $resultado["al_rut"]; ?>" onclick="return confirmar('¿Está seguro que desea eliminar el alumno?')"><img src="images/delete.png" alt=""> Eliminar</a></li>
	</div>
	<div id="contenido">
			<div class="perfil">
				<form action="" method="POST" enctype="multipart/form-data">
					<fieldset>
					<legend>Datos Alumno</legend>
					<table id="tabla_perfil">
						<tr>
							<td>Nombre</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="<?php echo $resultado['al_nombre']; ?>" name="nombre" class="txtBox">
							</td>
						</tr>
						<tr>
							<td>Apellido Paterno</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="<?php echo $resultado['al_apaterno'] ; ?>" name="apaterno" class="txtBox">
							</td>
						</tr>
						<tr>
							<td>Apellido Materno</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="<?php echo $resultado['al_amaterno']; ?>" name="amaterno" class="txtBox">
							</td>
						</tr>
						<tr>
							<td>Curso</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="1° B" class="txtBox">
							</td>
						</tr>
						<tr>
							<td>Fecha Nacimiento</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="<?php echo cambiarfecha_espanol($resultado['al_fecha_nacimiento']); ?>" name="fecha_nac" class="txtBox">
							</td>
						</tr>
						<tr>
							<td>Direccion</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="<?php echo $resultado['al_direccion']; ?>" name="direccion" class="txtBox">
							</td>
						</tr>
						<tr>
							<td>Comuna</td>
						</tr>
						<tr>
							<td class="grande">
								<select id="comuna" name="comuna" class="txtBox">
					                        <option value="<?php echo $resultado['al_comuna']; ?>"><?php echo $resultado['al_comuna']; ?></option>
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
							<td>celular</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="<?php echo $resultado['al_celular']; ?>" name="celular" class="txtBox" >
							</td>
						</tr>
						<tr>
							<td>Telefono Casa</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="<?php echo $resultado['al_telefono']; ?>" name="telefono" class="txtBox">
							</td>
						</tr>
						<tr>
							<td>Correo Electronico</td>
						</tr>
						<tr>
							<td class="grande">
								<input type="text" value="<?php echo $resultado['al_correo']; ?>" name="correo" class="txtBox">
							</td>
						</tr>
						<tr>
							<td></td>
						</tr>
					</table>
					<div class="foto_perfil">
						<?php if($resultado['al_foto']==""): ?>
							<img src="fotos/perfil.jpg" alt="Foto perfil">
						<?php else: ?>
							<img src="fotos/<?php echo $resultado['al_foto']; ?>" alt="Foto perfil" width="150" height="150">
						<?php endif; ?>
						<input type="file" name="foto">
						<br>
						<br>

					</div>
					<div class="block">
						<input type="submit" value="Actualizar datos" name="actualiza" class="btn btn-primary">
					</div>

				</fieldset>
				</form>

			</div>
		<div class="clear"></div>
		<?php
		if(isset($_REQUEST['actualiza'])):
			$nombre			= $_POST['nombre'];
			$apaterno		= $_POST['apaterno'];
			$amaterno		= $_POST['amaterno'];
			$fnacimiento	= $_POST['fecha_nac'];
			$direccion		= $_POST['direccion'];
			$comuna			= $_POST['comuna'];
			$email			= $_POST['correo'];
			$celular		= $_POST['celular'];
			$telefono		= $_POST['telefono'];
			$fnacimiento=cambiarfecha_mysql($fnacimiento);

			if($_FILES["foto"]["name"]!=""):
				$foto 			= $_FILES["foto"]["name"];
				$temp 			= $_FILES["foto"]["tmp_name"];
				$tipo 			= $_FILES["foto"]["type"];
				switch ($tipo)
				{
					case 'image/jpeg':
						$ext=".jpg";
					break;
					case 'image/png':
						$ext=".png";
					break;
				}
				$nombre_foto 	= $rut;
				$nombre_foto 	= $nombre_foto.$ext;
				copy($temp,"fotos/$nombre_foto");
				if(mysql_query("UPDATE `alumno` SET `al_nombre`='$nombre',
												 `al_apaterno`='$apaterno',
												 `al_amaterno`='$amaterno',
												 `al_fecha_nacimiento`='$fnacimiento',
												 `al_direccion`='$direccion',
												 `al_comuna`='$comuna',
												 `al_celular`='$celular',
												 `al_telefono`='$telefono',
												 `al_correo`='$email',
												 `al_foto`='$nombre_foto'
												 WHERE `al_rut`='$rut'",Conectar::conecta())):
					echo"Se actualizó correctamente con foto";
				echo mysql_error();
				else:
					echo "error en la actualizacion con foto";
				endif;
			else:
				if(mysql_query("UPDATE `alumno` SET
												 `al_nombre`='$nombre',
												 `al_apaterno`='$apaterno',
												 `al_amaterno`='$amaterno',
												 `al_fecha_nacimiento`='$fnacimiento',
												 `al_direccion`='$direccion',
												 `al_comuna`='$comuna',
												 `al_celular`='$celular',
												 `al_telefono`='$telefono',
												 `al_correo`='$email'
												 WHERE `al_rut`='$rut'",Conectar::conecta())):
					echo"Se actualizó correctamente sin foto";
				echo mysql_error();
				else:
					echo "error en la actualizacion sin foto";
				endif;
			endif;
			?>
			<script>
				new Messi('Se actualizó correctamente.', {title: 'Éxito', titleClass: 'success', buttons: [{id: 0, label: 'Cerrar', val: 'X'}],autoclose:'2000'});
				// function redireccionarPagina() {
 			// 		 window.location = "alumno_editar.php?ver=<?php echo $rut; ?>";
 			// 	}
				// setTimeout("redireccionarPagina()", 3000);

			</script>
			<?php
		endif;
		?>
	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
</body>
</html>
