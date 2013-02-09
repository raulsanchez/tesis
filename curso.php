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

$comunicacion=mysql_query("SELECT `cu_codigo`, `cu_nombre`, `cu_anio`, `cu_descripcion` FROM `curso`",Conectar::conecta());

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
				<li><a href="curso_agrega.php"><img src="images/add.png" alt="nuevo"> Crear curso</a></li>
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
						<th>Curso</th>
						<th>Año</th>
						<th>Codigo</th>
						<th>Descripción</th>
						<th>Ver</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($resultado=mysql_fetch_array($comunicacion)):
					?>
					<tr class="gradeA">
						<td><?php echo $resultado['cu_nombre']	 ?></td>
						<td><?php echo $resultado['cu_anio']; ?></td>
						<td><?php echo $resultado['cu_codigo']	 ?></td>
						<td><?php echo $resultado['cu_descripcion']; ?></td>
						<td class="ver_perfil"> <a href="curso_ver.php?ver=<?php echo $resultado["cu_codigo"]; ?>">Ver </a> </td>
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
