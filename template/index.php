<?php
session_start();
if(!isset($_SESSION['id_admin'])):
	if($_SESSION['ingreso']!=1):
	echo "<script type=''>";
		echo "window.location='entrar.php?url=";
		echo $_SERVER['REQUEST_URI']."'";
	echo "</script>";
	endif;
endif;
?>
<!DOCTYPE html>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
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
			<div class="cabecera-w">Widget 1</div>
			<div class="contenido-w">
<img src="https://maps.google.com/maps/api/staticmap?center=Sedeño,Valdivia&amp;zoom=16&amp;size=400x400&amp;sensor=false" alt="Berkeley, CA" border="0">
			</div>
		</section>
		<section class="widget">
			<div class="cabecera-w">Widget 2</div>
			<div class="contenido-w">
				<table>
					<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td class="alumno">Aquiles</td>
						<td class="alumno">Bailo</td>
						<td class="alumno">Solo</td>
					</tr>
					<tr>
						<td class="alumno">Ana</td>
						<td class="alumno">Busado</td>
						<td class="alumno">de Hesa</td>
					</tr>
					</tbody>
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
