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
$id_cita=$_GET['ver'];
$citacion="SELECT  ci_id,`ci_hora` , `ci_dia` , `ci_justifico` , `ci_motivo` , ci_justificacion_apoderado,
				  `ci_hora_justificacion` , `ci_dia_justificacion`,al_nombre, al_apaterno, al_amaterno
		FROM `citacion`
		INNER JOIN alumno ON alumno.al_rut = citacion.ci_rut_alumno
		WHERE ci_id = '".$id_cita."'";
$consulta_citacion=mysql_query($citacion,Conectar::conecta());
$resultado=mysql_fetch_array($consulta_citacion) or die (error());
?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
				<link rel="stylesheet" href="css/messi.css">
		<script type="text/javascript" src="js/messi.js"></script>
		<script language="JavaScript">
            function confirmar ( mensaje ) {
                return confirm( mensaje );
            }
        </script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(':checkbox').click( function(){
			        	if($(this).is(':checked')){
			        		$("#justifica").css('display','inline-block');
			        	}
			        	else{
			        		$("#justifica").css('display','none');
			        	}
			        });
				});
		</script>
		<style type="text/css">
		#justifica{
			display:none;
		}
		</style>
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
				<!-- <li><a href="atraso_eliminar.php?ver=<?php echo $id_comunicacion; ?>" onclick="return confirmar('¿Está seguro que desea eliminar la comunicacion?')"><img src="images/delete.png" alt=""> Eliminar</a></li> -->
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
								echo $resultado['al_nombre']." ". $resultado['al_apaterno']." ". $resultado['al_amaterno'];
							?>
						</td>
					</tr>
					<tr>
						<td>Día y hora de envio:</td>
					</tr>
					<tr>
							<td class="grande tabla">
								<?php
									echo mysql_fechaentera($resultado['ci_dia'])." a las ".$resultado['ci_hora']." horas.";
								?>
							</td>
						</tr>
					<tr>
						<td >Motivo</td>
					</tr>
					<tr>
						<td class="grande tabla">
							<?php echo $resultado['ci_motivo']; ?>
						</td>
					</tr>
					<tr>
						<td>Justificacion </td>
					</tr>
					<?php
					if($resultado['ci_justificacion_apoderado']==""):
					?>
						<tr>
							<td class="grande tabla">
								<p>Sin justificación</p>
								<p>
									<input type="checkbox" name="check" id="check">
									ingresar justificación<br/>
								</p>
								<div id="justifica">
									<form action="" method="POST">
										<textarea name="justifica" style="width:100%;" ></textarea>
										<input type="hidden" name="id" value="<?php echo $id_cita ?>">
										<input type="submit" value="ingresar justificación" name="confirmar" class="btn btn-primary">

									</form>
								</div>
								<?php
					else:
					?>
					<tr>
						<td class="grande tabla"> <?php echo $resultado['ci_justificacion_apoderado']; ?>. <br>
							El dia <?php echo cambiarfecha_espanol($resultado['ci_dia_justificacion']) ?> a las <?php echo $resultado['ci_hora_justificacion'] ?>
						</td>
					</tr>
					<?php endif;?>
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
	<?php
	if(isset($_POST['confirmar'])):
		$id=$_POST['id'];
		$justificacion=$_POST['justifica'];
		$consulta="UPDATE `citacion`
					SET `ci_justificacion_apoderado`='".$justificacion."',
					ci_hora_justificacion=curtime(),
					ci_dia_justificacion=curdate(),
					ci_justifico='1'
					WHERE `ci_id`='".$id."'";

		if(mysql_query($consulta,Conectar::conecta())):
			?>
			<script type="text/javascript">
				new Messi(
		        	'Se ingreso la justificacion correctamente',
		        	{
		        		title: 'Éxito',
		        		modal: true,
		        		titleClass: 'success',
		        		buttons: [{id: 0, label: 'Cerrar', val: 'X'}],
		        		autoclose:'3000'
		        	}
		        );
					function redireccionarPagina() {
	 					window.location='citacion_ver.php?ver=<?php echo $id ?>';
	 				}
					setTimeout("redireccionarPagina()", 4000);
			</script>

		<?php
		else:

		endif;
	endif;
	?>
</body>
</html>
