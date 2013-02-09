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
$rut=$_GET['ver'];
//********************** Busca datos del alumno ****************************
$consulta=mysql_query("SELECT `al_rut`,`al_nombre`,`al_apaterno`,`al_amaterno`,`al_fecha_nacimiento`,`al_direccion`,al_foto
							FROM `alumno`
							WHERE `al_rut`='".$rut."'",Conectar::conecta());
//********************** Busca el rut de su apoderado **********************
$cons=mysql_query("SELECT aa_rut_apoderado FROM apoderado_alumno WHERE aa_rut_alumno='".$rut."'",Conectar::conecta());
$rut_apo=mysql_fetch_array($cons);
//********************** Busca el rut de su apoderado Suplente **********************
$consu_apo_suple=mysql_query("SELECT aa_rut_apoderado FROM apoderado_alumno WHERE aa_rut_alumno='".$rut."' AND `aa_tipo_apoderado`='1'",Conectar::conecta());
$rut_apo_suple=mysql_fetch_array($consu_apo_suple);
//********************** Busca datos Apoderado *****************************
$consult=mysql_query("SELECT `ap_rut`, `ap_nombre`, `ap_apaterno`, `ap_amaterno`, `ap_direccion`, `ap_comuna`, `ap_celular`, `ap_telefono`, `ap_telefono_trabajo`, `ap_correo`
						FROM apoderado
						WHERE ap_rut='".$rut_apo['aa_rut_apoderado']."' ",Conectar::conecta());
$resultado=mysql_fetch_array($consulta);
//********************** Busca datos Apoderado Suplente *****************************
$consulta_apo_suplente=mysql_query("SELECT `ap_rut`, `ap_nombre`, `ap_apaterno`, `ap_amaterno`, `ap_direccion`, `ap_comuna`, `ap_celular`, `ap_telefono`, `ap_telefono_trabajo`, `ap_correo`
						FROM apoderado
						WHERE ap_rut='".$rut_apo_suple['aa_rut_apoderado']."'",Conectar::conecta());
$resultado_apo_suplente=mysql_fetch_array($consulta_apo_suplente);
$resultado2=mysql_fetch_array($consult);
//********************* Busca comunicaciones *******************************
$consulta3=mysql_query("SELECT comunicacion.idComunicacion, comunicacion.cu_asunto, comunicacion.cu_mensaje
				FROM envio_comunicacion
				INNER JOIN comunicacion ON comunicacion.idComunicacion = envio_comunicacion.`ec_id_comunicacion`
				WHERE envio_comunicacion.ec_rut = '$rut'
				ORDER BY `comunicacion`.`idComunicacion` DESC
				LIMIT 0 , 10",Conectar::conecta());
//******************** Busca atrasos ****************************************************
$consulta_atraso=mysql_query("SELECT at_id,
				`at_rut_alumno` ,
				`at_hora` ,
				`at_dia` ,
				`at_motivo` ,
				`at_otro`
		FROM `atraso`
		INNER JOIN alumno
		ON atraso.at_rut_alumno = alumno.al_rut
		WHERE alumno.al_rut = '".$rut."' ",Conectar::conecta()) or die (mysql_error());
//****************** BUSCAR CITACIONES ***************************************************
$consulta_citacion=mysql_query("SELECT `ci_id` , `ci_hora` , `ci_dia` ,
										`ci_justifico` , `ci_motivo` ,ci_justificacion_apoderado
								FROM `citacion`
								INNER JOIN alumno ON alumno.al_rut = citacion.ci_rut_alumno
								WHERE al_rut = '".$rut."'")
?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
		<script language="JavaScript">
            function confirmar ( mensaje ) {
                return confirm( mensaje );
            }
        </script>
        <META HTTP-EQUIV="Expires" CONTENT="0">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
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
			<li><a href="alumno_editar.php?ver=<?php echo $resultado["al_rut"]; ?>"><img src="images/pencil.png" alt=""> Editar</a></li>
			<li><a href="alumno_eliminar.php?ver=<?php echo $resultado["al_rut"]; ?>" onclick="return confirmar('¿Está seguro que desea eliminar el alumno?')"><img src="images/delete.png" alt=""> Eliminar</a></li>
		</ul>
	</div>
	<div id="contenido">
			<div class="perfil">
				<fieldset>
					<legend>Datos Alumno</legend>
					<div id="datos_perfil">
					<table id="tabla_perfil">
						<tr>
							<td>Nombre</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['al_nombre']." ".$resultado['al_apaterno']." ".$resultado['al_amaterno']; ?></td>
						</tr>
						<tr>
							<td>Rut</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['al_rut']; ?></td>
						</tr>
						<tr>
							<td>Curso</td>
						</tr>
						<tr>
							<td class="grande">1° B</td>
						</tr>
						<tr>
							<td>Fecha Nacimiento</td>
						</tr>
						<tr>
							<td class="grande"><?php echo cambiarfecha_espanol($resultado['al_fecha_nacimiento'])." (".(date("Y-m-d")-$resultado['al_fecha_nacimiento'])." años)"; ?></td>
						</tr>
						<tr>
							<td>Direccion</td>
						</tr>
						<tr>
							<td class="grande"><?php echo $resultado['al_direccion']; ?></td>
						</tr>
					</table>
				</div>
				<div class="foto_perfil">
					<?php if($resultado['al_foto']==""): ?>
						<img src="fotos/perfil.jpg" alt="Foto perfil">
					<?php else: ?>
						<img src="fotos/<?php echo $resultado['al_foto']; ?>" alt="Foto perfil" width="150" height="150x">
					<?php endif; ?>

				</div>
				</fieldset>
			</div>
			<div class="clear"></div>
			<div class="datos_apoderado">
				<fieldset>
					<legend>Datos Apoderado</legend>
					<table>
						<tr>
							<td>Nombre</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado2['ap_nombre']." ".$resultado2['ap_apaterno']." ".$resultado2['ap_amaterno']; ?></td>
						</tr>
						<tr>
							<td>Rut</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado2['ap_rut']; ?></td>
						</tr>
						<tr>
							<td>Direccion</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado2['ap_direccion'].", ".$resultado2['ap_comuna']; ?></td>
						</tr>
						<tr>
							<td>Celular</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado2['ap_celular']; ?></td>
						</tr>
						<tr>
							<td>Telefono</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado2['ap_telefono']; ?></td>
						</tr>
						<tr>
							<td>Telefono Trabajo</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado2['ap_telefono_trabajo']; ?></td>
						</tr>
					</table>

				</fieldset>
			</div>
			<div class="datos_apoderado">
				<fieldset>
					<legend>Datos Apoderado Suplente</legend>
					<?php
					if(mysql_num_rows($consulta_apo_suplente)!='0'):
					 ?>
					<table>
						<tr>
							<td>Nombre</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado_apo_suplente['ap_nombre']." ".$resultado_apo_suplente['ap_apaterno']." ".$resultado_apo_suplente['ap_amaterno']; ?></td>
						</tr>
						<tr>
							<td>Rut</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado_apo_suplente['ap_rut']; ?></td>
						</tr>
						<tr>
							<td>Direccion</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado_apo_suplente['ap_direccion'].", ".$resultado_apo_suplente['ap_comuna']; ?></td>
						</tr>
						<tr>
							<td>Celular</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado_apo_suplente['ap_celular']; ?></td>
						</tr>
						<tr>
							<td>Telefono</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado_apo_suplente['ap_telefono']; ?></td>
						</tr>
						<tr>
							<td>Telefono Trabajo</td>
						</tr>
						<tr>
							<td class="medio"><?php echo $resultado_apo_suplente['ap_telefono_trabajo']; ?></td>
						</tr>
					</table>
					<?php
					else:
						echo "El alumno no tiene apoderado suplente registrado ";
					endif;
					 ?>

				</fieldset>
			</div>
			<div class="comunicaciones">
				<fieldset>
					<legend>Comunicaciones</legend>
					<?php
					if(mysql_num_rows($consulta3)!=0):
					 ?>
					<table class="tabla">
						<th>Asunto</th>
						<th>Mensaje</th>
						<th></th>
						<?php
						while($respuesta3=mysql_fetch_array($consulta3)):
						?>
							<tr>
								<td>
									<?php echo substr($respuesta3['cu_asunto'],0,15)."..."; ?>
								</td>
								<td>
									<?php echo substr($respuesta3['cu_mensaje'],0,30)."..."; ?>
								</td>
								<td>
									<a href="comunicacion_ver.php?ver=<?php echo $respuesta3["idComunicacion"]; ?>"> Ver </a>
								</td>
							</tr>
						<?php
						endwhile;
						?>

					</table>
					<?php
					else:
						echo "No se encuentran comunicaciones registradas";
					endif; ?>
				</fieldset>
			</div>
			<div class="comunicaciones">
				<fieldset>
					<legend>Atrasos</legend>
					<?php
					if(mysql_num_rows($consulta_atraso)!=0):
					 ?>
					<table class="tabla">
						<th>dia</th>
						<th>hora</th>
						<th>motiva</th>
						<th></th>
						<?php
						while($respuesta_atraso=mysql_fetch_array($consulta_atraso)):
						?>
							<tr>
								<td> <?php echo $respuesta_atraso['at_dia']  ?> </td>
								<td> <?php echo $respuesta_atraso['at_hora'] ?> </td>
								<td>
									<?php
									if($respuesta_atraso['at_motivo']=="otro"):
										echo $respuesta_atraso['at_otro'];
									else:
										echo $respuesta_atraso['at_motivo'];
									endif;
									?>
								</td>
								<td>
									<a href="atraso_ver.php?ver=<?php echo $respuesta_atraso["at_id"]; ?>"> Ver </a>
								</td>
							</tr>
						<?php
						endwhile;
						?>

					</table>
					<?php
					else:
						echo "No se encuentran atrasos registradas";
					endif; ?>
				</fieldset>
			</div>
			<div class="comunicaciones">
				<fieldset>
					<legend>Citaciones</legend>
					<?php
					if(mysql_num_rows($consulta_citacion)!=0):
					 ?>
					<table class="tabla">
						<th>dia</th>
						<th>hora</th>
						<th>motiva</th>
						<th></th>
						<?php
						while($respuesta_citacion=mysql_fetch_array($consulta_citacion)):
						?>
							<tr>
								<td> <?php echo $respuesta_citacion['ci_dia']  ?> </td>
								<td> <?php echo $respuesta_citacion['ci_hora'] ?> </td>
								<td>
									<?php
									if($respuesta_citacion['ci_justifico']==0):
										echo "Sin justificar";
									else:
										echo $respuesta_citacion['ci_justificacion_apoderado'];
									endif;
									?>
								</td>
								<td>
									<a href="citacion_ver.php?ver=<?php echo $respuesta_citacion["ci_id"]; ?>"> Ver </a>
								</td>
							</tr>
						<?php
						endwhile;
						?>

					</table>
					<?php
					else:
						echo "No se encuentran atrasos registradas";
					endif; ?>
				</fieldset>
			</div>

		<div class="clear"></div>
	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
</body>
</html>
