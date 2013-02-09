<?php
session_start();
require_once 'clases/conectar.class.php';
if(!isset($_SESSION['id_admin'])):
	if(!isset($_SESSION['ingreso'])):
		echo "<script type=''>";
			echo "window.location='entrar.php?url=";
			echo $_SERVER['REQUEST_URI']."'";
		echo "</script>";
	endif;
endif;
$consulta_citacion=mysql_query("SELECT  `ci_hora` , `ci_dia` , `ci_justifico` , `ci_motivo` , al_nombre, al_apaterno, al_amaterno
								FROM `citacion`
								INNER JOIN alumno ON alumno.al_rut = citacion.ci_rut_alumno
								WHERE `ci_justifico`='0'
								ORDER BY `citacion`.`ci_dia` DESC",Conectar::conecta());
$consulta_cita_hoy=mysql_query("SELECT `ci_rut_alumno` , `ci_hora` , `ci_dia` , `ci_justifico` , `ci_motivo` , al_nombre, al_apaterno, al_amaterno
								FROM `citacion`
								INNER JOIN alumno ON alumno.al_rut = citacion.ci_rut_alumno
								WHERE `ci_justifico` = '0'
								AND ci_dia = CURDATE( )",Conectar::conecta()) or die (mysql_error());
$consulta_num_atrasos=mysql_query("SELECT count(at_rut_alumno) , al_nombre, al_apaterno, al_amaterno,at_rut_alumno
								FROM `atraso`
								INNER JOIN alumno ON al_rut = at_rut_alumno
								GROUP BY `atraso`.`at_rut_alumno`
								ORDER BY `count(at_rut_alumno)` DESC",Conectar::conecta()) or die (mysql_error());
?>
<!DOCTYPE html>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<link rel="stylesheet" href="css/messi.css">
		<script type="text/javascript" src="js/messi.js"></script>
		<?php
		if(mysql_num_rows($consulta_cita_hoy)!=0):
			?>
			<script type="text/javascript">
				$(document).ready(function() {
		          new Messi(
		          	'Existen alumnos con citacion de apoderado para hoy',
		          	{
		          		title: 'Alumnos con citación apoderado',
		          		modal: true,
		          		titleClass: 'anim error'
		          	});
		        });
			</script>
			<?php
		endif
		?>
		</head>
	<!-- FIN HEAD -->
<body>
	<!-- HEADER -->
		<?php include 'template/header.php';?>
	<!-- FIN HEADER -->
	<!-- MENU  -->
		<?php include 'template/nav.php'; ?>
	<!-- FIN MENU -->
	<div id="contenido">
		<section class="widget">
			<div class="cabecera-w">Citacion apoderado</div>
			<div class="contenido-w">
				<table class="tabla">
					<tr>
						<th>Alumno</th>
						<th>Fecha</th>
						<td>Hora</td>
					</tr>
				<?php

				?>
				<?php while($respuesta_citacion=mysql_fetch_array($consulta_citacion)): ?>
					<tr>
						<td><?php echo $respuesta_citacion['al_nombre']." ".$respuesta_citacion['al_apaterno']." ".$respuesta_citacion['al_amaterno'] ?> </td>
						<td><?php echo $respuesta_citacion['ci_dia'] ?> </td>
						<td><?php echo $respuesta_citacion['ci_hora'] ?></td>
					</tr>
				<?php endwhile; ?>
				</table>
			</div>
		</section>
		<section class="widget">
			<div class="cabecera-w">Alumnos con mas Atrasos</div>
			<div class="contenido-w">
				<table class="tabla">
					<tr>
						<th>Rut</th>
						<th>Nombre Alumno</th>
						<th>Numeros de atrasos</th>

					</tr>
				<?php

				?>
				<?php while($respuesta_num_alumno=mysql_fetch_array($consulta_num_atrasos)): ?>
					<tr>
						<td> <?php echo $respuesta_num_alumno['at_rut_alumno'] ?> </td>
						<td><?php echo $respuesta_num_alumno['al_nombre']." ".$respuesta_num_alumno['al_apaterno']." ".$respuesta_num_alumno['al_amaterno'] ?> </td>
						<td class="centrar"><?php echo $respuesta_num_alumno['0'] ?> </td>

					</tr>
				<?php endwhile; ?>
				</table>
			</div>
		</section>
		<div class="clear"></div>
	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
</body>
</html>
