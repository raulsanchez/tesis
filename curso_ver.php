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
$consulta="SELECT `cu_codigo`, `cu_nombre`, `cu_anio`, `cu_descripcion` FROM `curso` ";

$resultado=mysql_fetch_array(mysql_query($consulta,Conectar::conecta()));
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
				<li><a href="curso_eliminar.php?ver=<?php echo $cod_curso; ?>" onclick="return confirmar('¿Está seguro que desea eliminar la comunicacion?')"><img src="images/delete.png" alt=""> Eliminar</a></li>
				<li><a href="curso_lista.php?ver=<?php echo $cod_curso; ?>">Lista de curso</a></li>
			</ul>
		</div>
	</div>
	<div id="contenido">
		<div class="perfil">
				<fieldset>
					<legend>Curso codigo <?php echo $cod_curso; ?> </legend>
					<table id="tabla_centro">
						<tr>
							<td>Curso</td>
						</tr>
						<tr>
							<td class="grande tabla">
								<?php
									echo  $resultado['cu_nombre'];
								?>
							</td>
						</tr>
						<tr>
							<td>Año</td>
						</tr>
						<tr>
							<td class="grande tabla">
								<?php
									echo  $resultado['cu_anio'];
								?>
							</td>
						</tr>
						<tr>
							<td >Descripcion</td>
						</tr>
						<tr>
							<td class="grande tabla">
								<?php
									echo  $resultado['cu_descripcion'];
								?>
							</td>
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
