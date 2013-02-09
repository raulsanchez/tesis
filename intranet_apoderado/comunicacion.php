<?php
session_start();
require_once '../clases/conectar.class.php';
if(!isset($_SESSION['id_admin2'])):
		echo "<script type=''>";
			echo "window.location='entrar.php?url=";
			echo $_SERVER['REQUEST_URI']."'";
		echo "</script>";
endif;
$id_comunicacion=$_GET['id'];
$consulta=mysql_query("	SELECT 	comunicacion.cu_asunto,
								comunicacion.cu_mensaje,
								comunicacion.cu_mensaje_celu,
								comunicacion.cu_fecha_hora,
								envio_comunicacion.ec_rut
						FROM envio_comunicacion
						INNER JOIN comunicacion
						ON comunicacion.idComunicacion = envio_comunicacion.`ec_id_comunicacion`
						WHERE comunicacion.idComunicacion ='".$id_comunicacion."'",Conectar::conecta());
$resultado=mysql_fetch_array($consulta);
$consulta2=mysql_query("	SELECT 	alumno.al_nombre,
									alumno.al_apaterno,
									alumno.al_amaterno
						FROM envio_comunicacion
						INNER JOIN comunicacion
						ON comunicacion.idComunicacion = envio_comunicacion.`ec_id_comunicacion`
						INNER JOIN alumno
						ON envio_comunicacion.ec_rut = alumno.al_rut
						WHERE comunicacion.idComunicacion ='".$id_comunicacion."'",Conectar::conecta());
$enviados="";
while ( $resultado2=mysql_fetch_array($consulta2)) {
	$enviados .= $resultado2['0']." ".$resultado2['1']." ".$resultado2['2'].", ";
}

?>
<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
	table{
		width:100%;
	}
	.tabla{
		border-collapse: collapse;
		border: 1px solid rgb(204, 204, 204);
		width: 100%;
	}
	.grande{
		font-size: 1.15em;
		padding-left: 15px;
	}
</style>
</head>
<body>
	<a href="index.php">Volver</a>
	<fieldset>
		<legend>Mensaje</legend>
		<table>
			<tr>
				<td>Enviado a:</td>
			</tr>
			<tr>
				<td class="grande tabla">
					<?php
						echo $enviados;
					?>
				</td>
			</tr>
			<tr>
				<td>Día y hora de envio:</td>
			</tr>
			<tr>
				<td class="grande tabla">
					<?php
					$tiempo=explode(" ", $resultado['cu_fecha_hora']);
						echo mysql_fechaentera($tiempo['0']).". a las ".$tiempo['1']." horas.";
					?>
				</td>
			</tr>
			<tr>
				<td >Asunto</td>
			</tr>
			<tr>
				<td class="grande tabla"><?php echo $resultado['cu_asunto']; ?></td>
			</tr>
			<tr>
				<td>Mensaje (correo electronico)</td>
			</tr>
			<tr>
				<td class="grande tabla"><?php echo $resultado['cu_mensaje']; ?></td>
			</tr>
			<tr>
				<td>Mensaje (mensaje de texto)</td>
			</tr>
			<tr>
				<td class="grande tabla"><?php echo $resultado['cu_mensaje_celu']; ?></td>
			</tr>

		</table>
	</fieldset>
</body>
</html>
