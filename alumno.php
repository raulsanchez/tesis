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

$alumno=mysql_query('SELECT `alumno`.`al_nombre` , `alumno`.`al_apaterno` , `alumno`.`al_amaterno` , `alumno`.`al_rut` , `curso`.`cu_nombre`, `curso`.`cu_codigo`
					FROM `alumno_curso`
					INNER JOIN alumno ON `alumno`.`al_rut` = `alumno_curso`.`ac_rut_alumno`
					INNER JOIN curso ON `curso`.`cu_codigo` = `alumno_curso`.`ac_codigo_curso`',Conectar::conecta());

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
        			"aaSorting":[[2,"asc"]],
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
				<li><a href="alumno_agrega.php"><img src="images/add.png" alt="nuevo"> Ingresar nuevo alumno</a></li>
			<!-- 	<li><a href=""><img src="images/pencil.png" alt=""> Editar</a></li>
				<li><a href=""><img src="images/delete.png" alt=""> Eliminar</a></li> -->
			</ul>
	</div>
	<div id="contenido">
		<div id="lista">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Rut</th>
						<th>Curso</th>
						<th>Ver</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($resultado=mysql_fetch_array($alumno)):
					?>
					<tr class="gradeA">
						<td><?php echo $resultado['al_nombre']." ".$resultado['al_apaterno']." ".$resultado['al_amaterno'] ?></td>
						<td><?php echo $resultado['al_rut']; ?></td>
						<td><a href="curso_lista.php?ver=<?php echo $resultado["cu_codigo"]; ?>"><?php echo $resultado['cu_nombre']; ?> </a></td>
						<td class="ver_perfil"> <a href="alumno_perfil.php?ver=<?php echo $resultado["al_rut"]; ?>">Ver Perfil</a> </td>
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
