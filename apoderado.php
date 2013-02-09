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

$apoderado=mysql_query("SELECT `ap_rut`, `ap_tipo_apoderado`, `ap_nombre`, `ap_apaterno`, `ap_amaterno` FROM `apoderado`",Conectar::conecta());
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

			<ul>
				<!-- <li><a href=""><img src="images/zoom.png" alt="Buscar">Buscar</a></li> -->
				<li><img src="images/add.png" alt="nuevo"><a href="apoderado_agrega.php"> Crear nuevo apoderado</a></li>
<!-- 				<li><a href=""><img src="images/pencil.png" alt=""> Editar</a></li>
				<li><a href=""><img src="images/delete.png" alt=""> Eliminar</a></li> -->
			</ul>

	</div>
	<div id="contenido">
		<div id="lista">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
				<thead>
					<tr>
						<th>Nombre Apoderado</th>
						<th>Rut</th>

						<th>Ver</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($resultado=mysql_fetch_array($apoderado)):
					?>
					<tr class="gradeA">
						<td><?php echo $resultado['ap_nombre']." ".$resultado['ap_apaterno']." ".$resultado['ap_amaterno'] ?></td>
						<td><?php echo $resultado['ap_rut']; ?></td>

						<td class="ver_perfil"> <a href="apoderado_perfil.php?ver=<?php echo $resultado["ap_rut"]; ?>">Ver Perfil</a></td>
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
