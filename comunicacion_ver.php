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
$id_comunicacion=$_GET['ver'];
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
				<li><a href="comunicacion_eliminar.php?ver=<?php echo $id_comunicacion; ?>" onclick="return confirmar('¿Está seguro que desea eliminar la comunicacion?')"><img src="images/delete.png" alt=""> Eliminar</a></li>
			</ul>
		</div>
	</div>
	<div id="contenido">
		<div class="perfil">
				<fieldset>
					<legend>Mensaje</legend>
					<table id="tabla_centro">
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
			</div>
		<div class="clear"></div>

	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
</body>
</html>
