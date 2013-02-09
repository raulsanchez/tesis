<?php
session_start();
require_once '../clases/conectar.class.php';
if(!isset($_SESSION['id_admin2'])):
		echo "<script type=''>";
			echo "window.location='entrar.php?url=";
			echo $_SERVER['REQUEST_URI']."'";
		echo "</script>";
endif;
$rut=$_GET['rut'];
//********************** Busca datos del alumno ****************************
$consulta=mysql_query("SELECT `al_rut`,`al_nombre`,`al_apaterno`,`al_amaterno`,`al_fecha_nacimiento`,`al_direccion`,al_foto
							FROM `alumno`
							WHERE `al_rut`='".$rut."'",Conectar::conecta());
//********************** Busca el rut de su apoderado **********************
$cons=mysql_query("SELECT aa_rut_apoderado FROM apoderado_alumno WHERE aa_rut_alumno='".$rut."'",Conectar::conecta());
$resultado=mysql_fetch_array($consulta);

//********************* Busca comunicaciones *******************************
$consulta3=mysql_query("SELECT comunicacion.idComunicacion, comunicacion.cu_asunto, comunicacion.cu_mensaje
				FROM envio_comunicacion
				INNER JOIN comunicacion ON comunicacion.idComunicacion = envio_comunicacion.`ec_id_comunicacion`
				WHERE envio_comunicacion.ec_rut = '$rut'
				ORDER BY `comunicacion`.`idComunicacion` DESC
				LIMIT 0 , 10",Conectar::conecta());

?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8">
		<style type="text/css">
		.tabla{
			width:100%;
		}
		</style>
	</head>
	<body>
		<a href="index.php">Volver</a>
		<fieldset>
			<legend>Datos Alumno</legend>
			<div id="datos_perfil">
				<table id="tabla_perfil">
					<tr>
						<td>Nombre</td>
					</tr>
					<tr>
						<td class="grande"><?php echo $resultado['al_nombre']." ".$resultado['al_apaterno']." ".$resultado['al_amaterno']; ?></td>
					</tr>
					<tr>
						<td>Rut</td>
					</tr>
					<tr>
						<td class="grande"><?php echo $resultado['al_rut']; ?></td>
					</tr>
					<tr>
						<td>Curso</td>
					</tr>
					<tr>
						<td class="grande">1° B</td>
					</tr>
					<tr>
						<td>Fecha Nacimiento</td>
					</tr>
					<tr>
						<td class="grande"><?php echo $resultado['al_fecha_nacimiento']; ?></td>
					</tr>
					<tr>
						<td>Direccion</td>
					</tr>
					<tr>
						<td class="grande"><?php echo $resultado['al_direccion']; ?></td>
					</tr>
				</table>
			</div>
			<div class="foto_perfil">
				<?php if($resultado['al_foto']==null): ?>
					<img src="../fotos/perfil.jpg" alt="Foto perfil">
				<?php else: ?>
					<img src="fotos/<?php echo $resultado['al_foto']; ?>" alt="Foto perfil" width="150" height="150x">
				<?php endif; ?>

			</div>
		</fieldset>
		<div class="clear"></div>

		<div class="comunicaciones">
			<fieldset>
				<legend>Comunicaciones</legend>
				<?php
				if(mysql_num_rows($consulta3)!=0):
				 ?>
				<table class="tabla">
					<th>Asunto</th>
					<th>Mensaje</th>
					<th></th>
					<?php
					while($respuesta3=mysql_fetch_array($consulta3)):
					?>
						<tr>
							<td>
								<?php echo substr($respuesta3['cu_asunto'],0,35)."..."; ?>
							</td>
							<td>
								<?php echo substr($respuesta3['cu_mensaje'],0,70)."..."; ?>
							</td>
							<td>
								<a href="comunicacion.php?id=<?php echo $respuesta3["idComunicacion"]; ?>"> Ver </a>
							</td>
						</tr>
					<?php
					endwhile;
					?>

				</table>
				<?php
				else:
					echo "No se encuentran comunicaciones registradas";
				endif; ?>
			</fieldset>
		</div>

		<div class="clear"></div>
		</div>
	</body>
</html>
