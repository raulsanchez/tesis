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
$atraso="SELECT	at_id,
				`at_rut_alumno` ,
				`at_hora` ,
				`at_dia` ,
				`at_motivo` ,
				`at_otro` ,
				al_nombre,
				al_apaterno,
				al_amaterno
		FROM `atraso`
		INNER JOIN alumno
		ON atraso.at_rut_alumno = alumno.al_rut";

if(!$resp=mysql_query($atraso,Conectar::conecta())):
	echo "error en la consulta ".mysql_error();
endif;

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
				<li><a href="atraso_agrega.php"><img src="images/add.png" alt="nuevo"> Ingresar nuevo Atraso</a></li>
				<!-- <li><a href=""><img src="images/pencil.png" alt=""> Editar</a></li>
					<li><a href=""><img src="images/delete.png" alt=""> Eliminar</a></li> -->
			</ul>
		</div>
	</div>
	<div id="contenido">
		<div id="lista">
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
				<thead>
					<tr>
						<th>Dia</th>
						<th>Hora</th>
						<th>Alumno</th>
						<th>Motivo</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($resultado=mysql_fetch_array($resp)):
					?>
					<tr class="gradeA">
						<td><?php echo cambiarfecha_espanol($resultado['at_dia']);  ?></td>
						<td><?php echo $resultado['at_hora']; ?></td>
						<td><?php echo $resultado["al_nombre"]." ".$resultado["al_apaterno"]." ".$resultado["al_amaterno"]; ?> </td>
						<td><?php
							if($resultado['at_motivo']=="otro"):
								echo $resultado['at_otro'];
							else:
								echo $resultado['at_motivo'];
							endif;
						?></td>
						<td class="ver_perfil"> <a href="atraso_ver.php?ver=<?php echo $resultado["at_id"]; ?>">Ver</a></td>
					</tr>
					<?php
					endwhile;
					?>
				</tbody>
			</table>
		</div>
		<div class="clear"></div>
	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
</body>
</html>
