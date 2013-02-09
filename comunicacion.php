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

$comunicacion=mysql_query("SELECT `idComunicacion`, `cu_fecha_hora`, `cu_mensaje`, `cu_mensaje_celu`,cu_tipo FROM `comunicacion` ",Conectar::conecta());

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
				<li><a href="comunicacion_agrega.php"><img src="images/add.png" alt="nuevo"> Enviar nueva comunicacion</a></li>
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
						<th>Fecha y Hora</th>
						<th>Tipo</th>
						<th>Comunicacion</th>
						<th>Ver</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($resultado=mysql_fetch_array($comunicacion)):
					?>
					<tr class="gradeA">
						<td><?php
							$tiempo=explode(" ", $resultado['cu_fecha_hora']);
							echo cambiarfecha_espanol($tiempo['0']);
						 	echo " ".$tiempo['1'];
						 ?></td>
						<td><?php if($resultado['cu_tipo']=='0'):
									echo "Comunicación";
								else:
									echo "Reunión apoderado";
								endif;?></td>
						<td><?php echo substr($resultado['cu_mensaje'],0,65)." ..."; ?></td>
						<td class="ver_perfil"> <a href="comunicacion_ver.php?ver=<?php echo $resultado["idComunicacion"]; ?>">Ver </a> </td>
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
