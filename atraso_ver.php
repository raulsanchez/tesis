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
$id_atraso=$_GET['ver'];
$atraso="SELECT at_id,
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
		ON atraso.at_rut_alumno = alumno.al_rut
		WHERE atraso.at_id = '".$id_atraso."'";

$resultado=mysql_fetch_array(mysql_query($atraso,Conectar::conecta()));
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
				<li><a href="atraso_eliminar.php?ver=<?php echo $id_atraso; ?>" onclick="return confirmar('¿Está seguro que desea eliminar el atraso?')"><img src="images/delete.png" alt=""> Eliminar</a></li>
			</ul>
		</div>
	</div>
	<div id="contenido">
		<div class="perfil">
				<fieldset>
					<legend>Mensaje</legend>
					<table id="tabla_centro">
						<tr>
							<td>Alumno</td>
						</tr>
						<tr>
							<td class="grande tabla">
								<?php
									echo  $resultado['al_nombre']." ". $resultado['al_apaterno']." ". $resultado['al_amaterno'];
								?>
							</td>
						</tr>
						<tr>
							<td>Día y hora de envio:</td>
						</tr>
						<tr>
							<td class="grande tabla">
								<?php
									echo mysql_fechaentera($resultado['at_dia']).". a las ".$resultado['at_hora']." horas.";
								?>
							</td>
						</tr>
						<tr>
							<td >Motivo</td>
						</tr>
						<tr>
							<td class="grande tabla">
								<?php
								if($resultado['at_motivo']=="otro"):
									echo $resultado['at_otro'];
								else:
									echo $resultado['at_motivo'];
								endif;
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
