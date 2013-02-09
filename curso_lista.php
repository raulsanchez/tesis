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
$cod_curso=$_GET['ver'];
$consulta=mysql_query("	SELECT `ac_codigo_curso`, `ac_rut_alumno`,
				alumno.al_nombre, alumno.al_apaterno, alumno.al_amaterno,alumno.al_fecha_nacimiento
			FROM `alumno_curso`
			INNER JOIN alumno ON alumno.al_rut=alumno_curso.ac_rut_alumno
			WHERE `ac_codigo_curso` ='".$cod_curso."'", Conectar::conecta());

?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />



		<script type="text/javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>

		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable({
					"oLanguage": {
						 "sUrl": "js/language/es_ES.txt"
        			},
        			"bJQueryUI": true,
        			"aaSorting":[[0,"asc"]],
        			"sPaginationType": "full_numbers"
				});
			});
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
				<!-- <li><a href="curso_eliminar.php?ver=<?php echo $cod_curso; ?>" onclick="return confirmar('¿Está seguro que desea eliminar la comunicacion?')"><img src="images/delete.png" alt=""> Eliminar</a></li> -->
			</ul>
		</div>
	</div>
	<div id="contenido">

			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
				<thead>
					<tr>
						<th>Rut</th>
						<th>Nombre Alumno</th>
						<th>Fecha Nacimiento</th>
						<th>Ver</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($resultado=mysql_fetch_array($consulta)):
					?>
					<tr class="gradeA">
						<td><?php echo $resultado['ac_rut_alumno']; ?></td>
						<td><?php echo $resultado['al_nombre']." ".$resultado['al_apaterno']." ".$resultado['al_amaterno'] ?></td>
						<td><?php echo cambiarfecha_espanol($resultado['al_fecha_nacimiento']); ?> </td>
						<td class="ver_perfil"> <a href="alumno_perfil.php?ver=<?php echo $resultado["ac_rut_alumno"]; ?>">Ver Perfil</a> </td>
					</tr>
					<?php
					endwhile;
					?>
				</tbody>
			</table>
		<div class="clear"></div>

	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
</body>
</html>
