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
$consulta_curso=mysql_query("SELECT `cu_codigo`, `cu_nombre`, `cu_anio`, `cu_descripcion`
							FROM `curso`
							WHERE `cu_anio` = '2012'",Conectar::conecta());

?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<style type="text/css">
			h3{
				line-height: 25px;
				text-align: center;
			}
			input[type="checkbox"]{
				margin: 2px 5px;
			}
			span{
				padding:5px;
				margin:2px 5px;
			}
			#atraso_show,
			#comunicacion_show,
			#dia,
			#mes,
			#semestre,
			#anio,
			#desdehasta,
			#curso,
			#generar{
				display:none;
			}
			#seleccion{
				display:inline-block;
				float:left;
			}
			#atraso_show{
				float:left;
				display:inline-block;
			}
			#dia,
			#mes,
			#semestre,
			#anio,
			#desdehasta,
			#curso,
			#generar{
				vertical-align: top;
			}
			#opciones{
				display:none;
			}
			.lista_curso{
				padding:5px;
				margin:2px 5px;
				-webkit-column-count:3;
				-moz-column-count:3;
				column-count:3;
				-webkit-column-gap:10px;
				-moz-column-gap:10px;
				column-gap:10px;
			}

		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#selecciona').change( function(){
					if ($(this).val() != "0") {
						$("#opciones").show();
			            $("#atraso_show").show();
			            $("#comunicacion_show").hide();
			        }
			        else {
			        	$("#opciones").show();
			            $("#atraso_show").hide();
			        }
				});
				$('#periodo').change( function(){
					if ($(this).val() == "1") {
						$("#dia").css('display','inline-block');
						$("#mes").css('display','none');
						$("#semestre").css('display','none');
						$("#anio").css('display','none');
						$("#desdehasta").css('display','none');

						$("#curso").css('display','none');
						$("#generar").css('display','none');

						$('#fecha').blur( function(){
							if($("#fecha").val()!=""){
								$("#curso").css('display','inline-block');
							}
							else{
								$("#curso").css('display','none');
							}
						});
			        }
			        else if($(this).val() =="2") {
			        	$("#mes").css('display','inline-block');
			        	$("#dia").css('display','none');
			        	$("#semestre").css('display','none');
			        	$("#anio").css('display','none');
			        	$("#desdehasta").css('display','none');

			        	$("#curso").css('display','none');
						$("#generar").css('display','none');

			        	$('#meses').change( function(){
			        		if($(this).val()!="0"){

			        			$("#curso").css('display','inline-block');
			        		}
			        		else{
			        			$("#curso").css('display','none');
			        		}
			        	});
			        }

			        else if($(this).val() =="3") {
			        	$("#dia").css('display','none');
			        	$("#mes").css('display','none');
			        	$("#semestre").css('display','none');
			        	$("#anio").css('display','inline-block');
			        	$("#desdehasta").css('display','none');

			        	$("#curso").css('display','none');
						$("#generar").css('display','none');

						$('#anios').change( function(){
			        		if($(this).val()!="0"){
			        			$("#curso").css('display','inline-block');
			        		}
			        		else{
			        			$("#curso").css('display','none');
			        		}
			        	});

			        }
			        else if($(this).val() =="4") {
			        	$("#dia").css('display','none');
			        	$("#mes").css('display','none');
			        	$("#semestre").css('display','none');
			        	$("#anio").css('display','none');
			        	$("#desdehasta").css('display','inline-block');

			        	$("#curso").css('display','none');
						$("#generar").css('display','none');

						$('#desde').blur( function(){
							if($("#desde").val()!="" & $("#hasta").val()!=""){
								$("#curso").css('display','inline-block');
							}
							else{
								$("#curso").css('display','none');
							}
						});
						$('#hasta').blur( function(){
							if($("#desde").val()!="" & $("#hasta").val()!=""){
								if($("#desde").val() <= $("#hasta").val()){
									$("#curso").css('display','inline-block');
								}
								else{
									alert("La fecha desde es mayor a hasta");
									$("#curso").css('display','none');
								}
							}
							else{
								$("#curso").css('display','none');
							}

						});
			        }
			        $(':checkbox').click( function(){
			        		if($(this).is(':checked')){
			        			$("#generar").css('display','inline-block');
			        		}
			        		else{
			        			$("#generar").css('display','none');
			        		}
			        });
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
				<!-- <li><a href="atraso_agrega.php"><img src="images/add.png" alt="nuevo"> Ingresar nuevo Atraso</a></li> -->
				<!-- <li><a href=""><img src="images/pencil.png" alt=""> Editar</a></li> -->
				<!-- <li><a href=""><img src="images/delete.png" alt=""> Eliminar</a></li> -->
			</ul>
		</div>
	</div>
	<div id="contenido">
		<form action="" method="POST">
			<h4>Seleccione una opcion de informe</h4>
			<div id="seleccion">
				<select name="selecciona" id="selecciona">
					<option value="0">--Seleccione--</option>
					<optgroup label="----------------------------"></optgroup>
					<option value="1">Atraso</option>
					<option value="2">Citaciones</option>
				</select>
			</div>
			<div class="clear"></div>
			<div id="opciones">
				<fieldset>
					<legend>Seleccione datos del informe</legend>
					<div id="atraso_show">
						<h4>Periodos</h4>
						<select name="periodo" id="periodo" size="6">
							<option value="1">Día</option>
							<option value="2">Mes</option>
							<option value="3">Semestre</option>
							<option value="4">Desde - Hasta</option>
						</select>
						<div id="dia">
							<span>Ingrese día: </span>
							<input type="text" name="fecha" id="fecha" size='12'>
						</div>
						<div id="mes">
							<span>Seleccione mes del 2012</span>
							<select name="mes" id="meses">
								<option value="0">--------------</option>
								<option value="1">Enero</option>
								<option value="2">Febrero</option>
								<option value="3">Marzo</option>
								<option value="4">Abril</option>
								<option value="5">Mayo</option>
								<option value="6">Junio</option>
								<option value="7">Julio</option>
								<option value="8">Agosto</option>
								<option value="9">Septiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
							</select>
						</div>
						<div id="anio">
							<span>Seleccione Semestre</span>
							<select name="anio" id="anios">
								<option value="0">----------</option>
								<option value="1">Primer semestre 2012</option>
								<option value="2">Segundo semestre 2012</option>
							</select>
						</div>
						<div id="desdehasta">
							<span>Desde :</span>  <input type="text" name="desde" id="desde"> <br />
							<span>Hasta :</span> <input type="text" name="hasta" id="hasta">
						</div>
						<div id="curso">
							<span>Seleccione Curso</span>
							<div class="lista_curso">
								<?php
									while($resultado_curso=mysql_fetch_array($consulta_curso)):
								 ?>
									<input type="checkbox" name="cursos[<?php echo $resultado_curso['cu_codigo'] ?>]" id="cursos"><?php echo $resultado_curso['cu_nombre'] ?> <br />
								<?php endwhile; ?>
							<br />
							</div>


						</div>
						<div id="generar">
							<input type="submit" value="Generar Informe" name="genera" class="btn btn-primary">
						</div>

					</div>
				</fieldset>
			</div>
		</form>
		<div class="clear"></div>
		<?php

	if(isset($_REQUEST['genera'])):
		if($_POST['selecciona']=='1'):
			$periodo=$_POST['periodo'];
			switch ($periodo) {
				case '1':
					$fecha	= cambiarfecha_mysql($_POST['fecha']);
					$curso	= $_POST['cursos'];
					$cu_nombre="";
					$cu_total="";
					$resto=0;

					$lista_curso=implode(',', array_keys($curso));
					$array_cursos=explode(',', $lista_curso);

					?>
					<h3>Informe de atrasos del día <?php echo mysql_fechaentera($fecha); ?></h3>

						<table class="tabla">
							<th>Curso</th>
							<th>Cantidad</th>
							<th>Porcentaje atraso</th>
							<th>Total</th>

					<?php

					$consulta_informe2=mysql_query("SELECT COUNT(atraso.at_rut_alumno)
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE at_dia='".$fecha."'",Conectar::conecta());
					$respuesta_informe2=mysql_fetch_array($consulta_informe2);
					foreach ($array_cursos as $cursos ) {
					$consulta_nombre_curso=mysql_query("SELECT cu_nombre FROM curso WHERE cu_codigo ='".$cursos."'");
					$respuesta_nombre_curso=mysql_fetch_array($consulta_nombre_curso);
					$consulta_informe1=mysql_query(" SELECT COUNT(atraso.at_rut_alumno),curso.cu_nombre
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE alumno_curso.ac_codigo_curso = '".$cursos."' AND at_dia='".$fecha."'",
										Conectar::conecta());
					$respuesta_informe1=mysql_fetch_array($consulta_informe1);
						if($respuesta_informe1['0']!='0'):
						$porcentaje=(($respuesta_informe1['0']*100)/$respuesta_informe2['0']);
							$cu_nombre[]=$respuesta_informe1['cu_nombre'];
							$cu_total[]= $respuesta_informe1['0'];
						?>
							<tr>
								<td><?php echo $respuesta_informe1['cu_nombre']; ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td><?php echo round($porcentaje,2)." %" ; ?></td>
								<td></td>
							</tr>
						<?php
						else:
						?>
							<tr>
								<td><? echo $respuesta_nombre_curso['cu_nombre'] ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td>0%</td>
								<td></td>

							</tr>
						<?php
						endif;
						$resto+=$respuesta_informe1['0'];
					}
					?>


					<tr>
						<td colspan="3">Total de atrasos</td>
						<td><?php echo $respuesta_informe2['0'];?></td>
					</tr>
						</table>

							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    <script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
									var data = google.visualization.arrayToDataTable([
									['Curso', 'Inasistencia']
									<?php
									$semi=$respuesta_informe2['0']-$resto;
									if(sizeof($cu_nombre)!='1'){
										for ($i=0; $i < sizeof($cu_nombre) ; $i++){
											echo ",['$cu_nombre[$i]',$cu_total[$i]]";
										}
										echo ",['Otros',$semi]";
									}
									else{
										echo ",['$cu_nombre[0]',$cu_total[0]]";
										echo ",['Otros',$semi]";
									}

									 ?>
						        ]);

						        var options = {
						          title: 'Atrasos'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						      }
						    </script>
						    <div id="chart_div" style="width:100%; height: 400px;"></div>

					<?php
					break;
// *******************************************************************************************************************
				case '2':
					$mes=$_POST['mes'];
					$curso	= $_POST['cursos'];
					$cu_nombre="";
					$cu_total="";
					$resto=0;
					$lista_curso=implode(',', array_keys($curso));
					$array_cursos=explode(',', $lista_curso);
					$meses_espanol = array(
       					'1' => 'Enero',
				        '2' => 'Febrero',
				        '3' => 'Marzo',
				        '4' => 'Abril',
				        '5' => 'Mayo',
				        '6' => 'Junio',
				        '7' => 'Julio',
				        '8' => 'Agosto',
				        '9' => 'Septiembre',
				        '10' => 'Octubre',
				        '11' => 'Noviembre',
				        '12' => 'Diciembre',
				        );
					?>
					<h3>Informe de atrasos del mes de <?php echo $meses_espanol[$mes]; ?></h3>
						<table class="tabla">
							<th>Curso</th>
							<th>Cantidad</th>
							<th>Porcentaje atraso</th>
							<th>Total</th>

					<?php

					$consulta_informe2=mysql_query("SELECT COUNT(atraso.at_rut_alumno)
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE Date_Format( at_dia, '%m' ) = '".$mes."'",
										Conectar::conecta());
					$respuesta_informe2=mysql_fetch_array($consulta_informe2);
					foreach ($array_cursos as $cursos ) {
						$consulta_informe1=mysql_query(" SELECT COUNT( atraso.at_rut_alumno ) , curso.cu_nombre
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE alumno_curso.ac_codigo_curso = '".$cursos."'
										AND Date_Format( at_dia, '%m' ) = '".$mes."'",
										Conectar::conecta());
						$respuesta_informe1=mysql_fetch_array($consulta_informe1);
						$consulta_nombre_curso=mysql_query("SELECT cu_nombre FROM curso WHERE cu_codigo ='".$cursos."'");
						$respuesta_nombre_curso=mysql_fetch_array($consulta_nombre_curso);


						$porcentaje=(($respuesta_informe1['0']*100)/$respuesta_informe2['0']);
						if($respuesta_informe1['0']!='0'):
							$cu_nombre[]=$respuesta_informe1['cu_nombre'];
							$cu_total[]= $respuesta_informe1['0'];
						?>
							<tr>
								<td><?php echo $respuesta_informe1['cu_nombre']; ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td><?php echo round($porcentaje,1)." %" ; ?></td>
								<td></td>
							</tr>
							<?php
						else:
						?>
							<tr>
								<td><? echo $respuesta_nombre_curso['cu_nombre'] ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td>0%</td>
								<td></td>
							</tr>
						<?php
						endif;
						$resto+=$respuesta_informe1['0'];
					}

					?>
					<tr>
						<td colspan="3">Total de atrasos</td>
						<td><?php echo $respuesta_informe2['0'];?></td>
					</tr>
						</table>

							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    <script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
									var data = google.visualization.arrayToDataTable([
									['Curso', 'Inasistencia']
									<?php
									$semi=$respuesta_informe2['0']-$resto;
									if(sizeof($cu_nombre)!='1'){
										for ($i=0; $i < sizeof($cu_nombre) ; $i++){
											echo ",['$cu_nombre[$i]',$cu_total[$i]]";
										}
										echo ",['Otros',$semi]";
									}
									else{
										echo ",['$cu_nombre[0]',$cu_total[0]]";
										echo ",['Otros',$semi]";
									}

									 ?>
						        ]);

						        var options = {
						          title: 'Atrasos'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						      }
						    </script>
						    <div id="chart_div" style="width:100%; height: 400px;"></div>
					<?php
					break;
				case '3':
// ****************************************************************************************************************************
					if($_POST['anio']=='1'):
						$hasta='2012-06-31';
						$desde='2012-01-01';
						$semestre="Primer semestre";
					else:
						$desde='2012-07-01';
						$hasta='2012-12-31';
						$semestre="Segundo Semestre";
					endif;
					$curso	= $_POST['cursos'];
					$cu_nombre="";
					$cu_total="";
					$resto=0;

					$lista_curso=implode(',', array_keys($curso));
					$array_cursos=explode(',', $lista_curso);

					?>
					<h3>Informe de asistencia del <?php echo $semestre; ?></h3>
						<table class="tabla">
							<th>Curso</th>
							<th>Cantidad</th>
							<th>Porcentaje atraso</th>
							<th>Total</th>

					<?php

					$consulta_informe2=mysql_query("SELECT COUNT(atraso.at_rut_alumno)
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE at_dia
										BETWEEN '".$desde."' AND '".$hasta."'",
										Conectar::conecta());
					$respuesta_informe2=mysql_fetch_array($consulta_informe2);
					foreach ($array_cursos as $cursos ) {
						$consulta_informe1=mysql_query(" SELECT COUNT(atraso.at_rut_alumno),curso.cu_nombre
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE alumno_curso.ac_codigo_curso = '".$cursos."' AND at_dia
										BETWEEN '".$desde."' AND '".$hasta."'",
										Conectar::conecta());
						$respuesta_informe1=mysql_fetch_array($consulta_informe1);
						$respuesta_informe1['0'];
						$respuesta_informe2['0'];
						if($respuesta_informe2['0']!='0'):
							$porcentaje=(($respuesta_informe1['0']*100)/$respuesta_informe2['0']);
						else:
							echo "no se encuentran datos registrado";
						 	exit();
						endif;
						if($respuesta_informe1['0']!='0'):
							$cu_nombre[]=$respuesta_informe1['cu_nombre'];
							$cu_total[]= $respuesta_informe1['0'];
						?>
							<tr>
								<td><?php echo $respuesta_informe1['cu_nombre']; ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td><?php echo round($porcentaje,1)." %" ; ?></td>
								<td></td>
							</tr>
						<?php
						endif;
						$resto+=$respuesta_informe1['0'];
					}

					?>
					<tr>
						<td colspan="3">Total de atrasos</td>
						<td><?php echo $respuesta_informe2['0'];?></td>
					</tr>
						</table>

							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    <script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
									var data = google.visualization.arrayToDataTable([
									['Curso', 'Inasistencia']
									<?php
									$semi=$respuesta_informe2['0']-$resto;
									if(sizeof($cu_nombre)!='1'){
										for ($i=0; $i < sizeof($cu_nombre) ; $i++){
											echo ",['$cu_nombre[$i]',$cu_total[$i]]";
										}
										echo ",['Otros',$semi]";
									}
									else{
										echo ",['$cu_nombre[0]',$cu_total[0]]";
										echo ",['Otros',$semi]";
									}

									 ?>
						        ]);

						        var options = {
						          title: 'Atrasos'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						      }
						    </script>
						    <div id="chart_div" style="width:100%; height: 400px;"></div>

					<?php
					break;
//  ************************************************************************************************************************
				case '4':
					$desde	= cambiarfecha_mysql($_POST['desde']);
					$hasta  = cambiarfecha_mysql($_POST['hasta']);
					$curso	= $_POST['cursos'];
					$cu_nombre="";
					$cu_total="";
					$resto=0;

					$lista_curso=implode(',', array_keys($curso));
					$array_cursos=explode(',', $lista_curso);

					?>
					<h3>Informe de atrasos entre el <?php echo cambiarfecha_espanol($desde); ?> al <?php echo cambiarfecha_espanol($hasta); ?> </h3>

						<table class="tabla">
							<th>Curso</th>
							<th>Cantidad</th>
							<th>Porcentaje atraso</th>
							<th>Total</th>

					<?php

					$consulta_informe2=mysql_query("SELECT COUNT(atraso.at_rut_alumno)
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE at_dia
										BETWEEN '".$desde."' AND '".$hasta."'",
										Conectar::conecta());
					$respuesta_informe2=mysql_fetch_array($consulta_informe2);
					foreach ($array_cursos as $cursos ) {
					$consulta_informe1=mysql_query(" SELECT COUNT(atraso.at_rut_alumno),curso.cu_nombre
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE alumno_curso.ac_codigo_curso = '".$cursos."' AND at_dia
										BETWEEN '".$desde."' AND '".$hasta."'",
										Conectar::conecta());
					$respuesta_informe1=mysql_fetch_array($consulta_informe1);
						if($respuesta_informe1['0']!='0'):
						$porcentaje=(($respuesta_informe1['0']*100)/$respuesta_informe2['0']);
							$cu_nombre[]=$respuesta_informe1['cu_nombre'];
							$cu_total[]= $respuesta_informe1['0'];
						?>
							<tr>
								<td><?php echo $respuesta_informe1['cu_nombre']; ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td><?php echo round($porcentaje,2)." %" ; ?></td>
								<td></td>
							</tr>
						<?php
						endif;
						$resto+=$respuesta_informe1['0'];
					}

					?>
					<tr>
						<td colspan="3">Total de atrasos</td>
						<td><?php echo $respuesta_informe2['0'];?></td>
					</tr>
						</table>

							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    <script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
									var data = google.visualization.arrayToDataTable([
									['Curso', 'Inasistencia']
									<?php
									$semi=$respuesta_informe2['0']-$resto;
									if(sizeof($cu_nombre)!='1'){
										for ($i=0; $i < sizeof($cu_nombre) ; $i++){
											echo ",['$cu_nombre[$i]',$cu_total[$i]]";
										}
										echo ",['Otros',$semi]";
									}
									else{
										echo ",['$cu_nombre[0]',$cu_total[0]]";
										echo ",['Otros',$semi]";
									}

									 ?>
						        ]);

						        var options = {
						          title: 'Atrasos'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						      }
						    </script>
						    <div id="chart_div" style="width:100%; height: 400px;"></div>

					<?php
					break;
			}
// *******************************************************************************************************************
//********************************************************************************************************************
//********************************************************************************************************************
		elseif($_POST['selecciona']=='2'):
			$periodo=$_POST['periodo'];
			switch ($periodo) {
				case '1':
					$fecha	= cambiarfecha_mysql($_POST['fecha']);
					$curso	= $_POST['cursos'];
					$cu_nombre="";
					$cu_total="";
					$resto=0;

					$lista_curso=implode(',', array_keys($curso));
					$array_cursos=explode(',', $lista_curso);

					?>
					<h3>Informe de citaciones del día <?php echo mysql_fechaentera($fecha); ?></h3>

						<table class="tabla">
							<th>Curso</th>
							<th>Cantidad</th>
							<th>Porcentaje Citacion apoderado</th>
							<th>Total</th>

					<?php

					$consulta_informe2=mysql_query("SELECT COUNT( `ci_rut_alumno` )
												FROM alumno_curso
												INNER JOIN citacion ON `ci_rut_alumno` = ac_rut_alumno
												INNER JOIN curso ON ac_codigo_curso = cu_codigo
												WHERE ci_dia = '".$fecha."'",Conectar::conecta()) or die (mysql_error());
					$respuesta_informe2=mysql_fetch_array($consulta_informe2);
					foreach ($array_cursos as $cursos ) {
					$consulta_nombre_curso=mysql_query("SELECT cu_nombre FROM curso WHERE cu_codigo ='".$cursos."'");
					$respuesta_nombre_curso=mysql_fetch_array($consulta_nombre_curso);
					$consulta_informe1=mysql_query(" SELECT COUNT( ci_rut_alumno ) , cu_nombre
												FROM alumno_curso
												INNER JOIN citacion ON ci_rut_alumno = ac_rut_alumno
												INNER JOIN curso ON ac_codigo_curso = cu_codigo
												WHERE ac_codigo_curso = '".$cursos."' AND ci_dia='".$fecha."'",
										Conectar::conecta());
					$respuesta_informe1=mysql_fetch_array($consulta_informe1);
						if($respuesta_informe1['0']!='0'):
						$porcentaje=(($respuesta_informe1['0']*100)/$respuesta_informe2['0']);
							$cu_nombre[]=$respuesta_informe1['cu_nombre'];
							$cu_total[]= $respuesta_informe1['0'];
						?>
							<tr>
								<td><?php echo $respuesta_informe1['cu_nombre']; ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td><?php echo round($porcentaje,2)." %" ; ?></td>
								<td></td>
							</tr>
						<?php
						else:
						?>
							<tr>
								<td><? echo $respuesta_nombre_curso['cu_nombre'] ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td>0%</td>
								<td></td>

							</tr>
						<?php
						endif;
						$resto+=$respuesta_informe1['0'];
					}
					?>


					<tr>
						<td colspan="3">Total de atrasos</td>
						<td><?php echo $respuesta_informe2['0'];?></td>
					</tr>
						</table>

							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    <script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
									var data = google.visualization.arrayToDataTable([
									['Curso', 'Inasistencia']
									<?php
									$semi=$respuesta_informe2['0']-$resto;
									if(sizeof($cu_nombre)!='1'){
										for ($i=0; $i < sizeof($cu_nombre) ; $i++){
											echo ",['$cu_nombre[$i]',$cu_total[$i]]";
										}
										echo ",['Otros',$semi]";
									}
									else{
										echo ",['$cu_nombre[0]',$cu_total[0]]";
										echo ",['Otros',$semi]";
									}

									 ?>
						        ]);

						        var options = {
						          title: 'Atrasos'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						      }
						    </script>
						    <div id="chart_div" style="width:100%; height: 400px;"></div>

					<?php
					break;
// *******************************************************************************************************************
				case '2':
					$mes=$_POST['mes'];
					$curso	= $_POST['cursos'];
					$cu_nombre="";
					$cu_total="";
					$resto=0;
					$lista_curso=implode(',', array_keys($curso));
					$array_cursos=explode(',', $lista_curso);
					$meses_espanol = array(
       					'1' => 'Enero',
				        '2' => 'Febrero',
				        '3' => 'Marzo',
				        '4' => 'Abril',
				        '5' => 'Mayo',
				        '6' => 'Junio',
				        '7' => 'Julio',
				        '8' => 'Agosto',
				        '9' => 'Septiembre',
				        '10' => 'Octubre',
				        '11' => 'Noviembre',
				        '12' => 'Diciembre',
				        );
					?>
					<h3>Informe de citaciones del mes de <?php echo $meses_espanol[$mes]; ?></h3>
						<table class="tabla">
							<th>Curso</th>
							<th>Cantidad</th>
							<th>Porcentaje citacion apoderado</th>
							<th>Total</th>

					<?php

					$consulta_informe2=mysql_query("SELECT COUNT( `ci_rut_alumno` )
										FROM alumno_curso
										INNER JOIN citacion ON `ci_rut_alumno` = ac_rut_alumno
										INNER JOIN curso ON ac_codigo_curso = cu_codigo
										WHERE Date_Format( ci_dia, '%m' ) = '".$mes."'",
										Conectar::conecta());
					$respuesta_informe2=mysql_fetch_array($consulta_informe2);
					foreach ($array_cursos as $cursos ) {
						$consulta_informe1=mysql_query(" SELECT COUNT( ci_rut_alumno ) , cu_nombre
										FROM alumno_curso
										INNER JOIN citacion ON ci_rut_alumno = ac_rut_alumno
										INNER JOIN curso ON ac_codigo_curso = cu_codigo
										WHERE alumno_curso.ac_codigo_curso = '".$cursos."'
										AND Date_Format( ci_dia, '%m' ) = '".$mes."'",
										Conectar::conecta());
						$respuesta_informe1=mysql_fetch_array($consulta_informe1);
						$consulta_nombre_curso=mysql_query("SELECT cu_nombre FROM curso WHERE cu_codigo ='".$cursos."'");
						$respuesta_nombre_curso=mysql_fetch_array($consulta_nombre_curso);

						if($respuesta_informe2['0']!=0):
							if($respuesta_informe1['0']!='0'):
								$porcentaje=(($respuesta_informe1['0']*100)/$respuesta_informe2['0']);
								$cu_nombre[]=$respuesta_informe1['cu_nombre'];
								$cu_total[]= $respuesta_informe1['0'];
							?>
								<tr>
									<td><?php echo $respuesta_informe1['cu_nombre']; ?> </td>
									<td><?php echo $respuesta_informe1['0']; ?></td>
									<td><?php echo round($porcentaje,1)." %" ; ?></td>
									<td></td>
								</tr>
								<?php
							else:
							?>
								<tr>
									<td><? echo $respuesta_nombre_curso['cu_nombre'] ?> </td>
									<td><?php echo $respuesta_informe1['0']; ?></td>
									<td>0%</td>
									<td></td>
								</tr>
							<?php
							endif;
						$resto+=$respuesta_informe1['0'];
						else:
							echo "no se encuentran datos";
						exit();
						endif;
					}

					?>
					<tr>
						<td colspan="3">Total de citaciones</td>
						<td><?php echo $respuesta_informe2['0'];?></td>
					</tr>
						</table>

							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    <script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
									var data = google.visualization.arrayToDataTable([
									['Curso', 'Inasistencia']
									<?php
									$semi=$respuesta_informe2['0']-$resto;
									if(sizeof($cu_nombre)!='1'){
										for ($i=0; $i < sizeof($cu_nombre) ; $i++){
											echo ",['$cu_nombre[$i]',$cu_total[$i]]";
										}
										echo ",['Otros',$semi]";
									}
									else{
										echo ",['$cu_nombre[0]',$cu_total[0]]";
										echo ",['Otros',$semi]";
									}

									 ?>
						        ]);

						        var options = {
						          title: 'Atrasos'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						      }
						    </script>
						    <div id="chart_div" style="width:100%; height: 400px;"></div>
					<?php
					break;
				case '3':
// ****************************************************************************************************************************
					if($_POST['anio']=='1'):
						$desde='2012-01-01';
						$hasta='2012-06-31';
						$semestre="Primer semestre";
					else:
						$desde='2012-07-01';
						$hasta='2012-12-31';
						$semestre="Segundo Semestre";
					endif;
					$curso	= $_POST['cursos'];
					$cu_nombre="";
					$cu_total="";
					$resto=0;

					$lista_curso=implode(',', array_keys($curso));
					$array_cursos=explode(',', $lista_curso);

					?>
					<h3>Informe de citaciones del <?php echo $semestre; ?></h3>
						<table class="tabla">
							<th>Curso</th>
							<th>Cantidad</th>
							<th>Porcentaje atraso</th>
							<th>Total</th>

					<?php

					$consulta_informe2=mysql_query("SELECT COUNT(atraso.at_rut_alumno)
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE Atraso.at_dia
										BETWEEN '".$desde."' AND '".$hasta."'",
										Conectar::conecta());
					$respuesta_informe2=mysql_fetch_array($consulta_informe2);
					foreach ($array_cursos as $cursos ) {
						$consulta_informe1=mysql_query(" SELECT COUNT(atraso.at_rut_alumno),curso.cu_nombre
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE alumno_curso.ac_codigo_curso = '".$cursos."' AND Atraso.at_dia
										BETWEEN '".$desde."' AND '".$hasta."'",
										Conectar::conecta());
						$respuesta_informe1=mysql_fetch_array($consulta_informe1);
						echo $respuesta_informe1['0'];
						echo $respuesta_informe2['0'];
						if($respuesta_informe2['0']!='0'):
							$porcentaje=(($respuesta_informe1['0']*100)/$respuesta_informe2['0']);
						else:
							echo "no se encuentran datos registrado";
						endif;
						if($respuesta_informe1['0']!='0'):
							$cu_nombre[]=$respuesta_informe1['cu_nombre'];
							$cu_total[]= $respuesta_informe1['0'];
						?>
							<tr>
								<td><?php echo $respuesta_informe1['cu_nombre']; ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td><?php echo round($porcentaje,1)." %" ; ?></td>
								<td></td>
							</tr>
						<?php
						endif;
						$resto+=$respuesta_informe1['0'];
					}

					?>
					<tr>
						<td colspan="3">Total de atrasos</td>
						<td><?php echo $respuesta_informe2['0'];?></td>
					</tr>
						</table>

							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    <script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
									var data = google.visualization.arrayToDataTable([
									['Curso', 'Inasistencia']
									<?php
									$semi=$respuesta_informe2['0']-$resto;
									if(sizeof($cu_nombre)!='1'){
										for ($i=0; $i < sizeof($cu_nombre) ; $i++){
											echo ",['$cu_nombre[$i]',$cu_total[$i]]";
										}
										echo ",['Otros',$semi]";
									}
									else{
										echo ",['$cu_nombre[0]',$cu_total[0]]";
										echo ",['Otros',$semi]";
									}

									 ?>
						        ]);

						        var options = {
						          title: 'Atrasos'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						      }
						    </script>
						    <div id="chart_div" style="width:100%; height: 400px;"></div>

					<?php
					break;
//  ************************************************************************************************************************
				case '4':
					$desde	= cambiarfecha_mysql($_POST['desde']);
					$hasta  = cambiarfecha_mysql($_POST['hasta']);
					$curso	= $_POST['cursos'];
					$cu_nombre="";
					$cu_total="";
					$resto=0;

					$lista_curso=implode(',', array_keys($curso));
					$array_cursos=explode(',', $lista_curso);

					?>
					<h3>Informe de citaciones entre el <?php echo cambiarfecha_espanol($desde); ?> al <?php echo cambiarfecha_espanol($hasta); ?> </h3>

						<table class="tabla">
							<th>Curso</th>
							<th>Cantidad</th>
							<th>Porcentaje atraso</th>
							<th>Total</th>

					<?php

					$consulta_informe2=mysql_query("SELECT COUNT(atraso.at_rut_alumno)
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE Atraso.at_dia
										BETWEEN '".$desde."' AND '".$hasta."'",
										Conectar::conecta());
					$respuesta_informe2=mysql_fetch_array($consulta_informe2);
					foreach ($array_cursos as $cursos ) {
					$consulta_informe1=mysql_query(" SELECT COUNT(atraso.at_rut_alumno),curso.cu_nombre
										FROM alumno_curso
										INNER JOIN atraso ON atraso.at_rut_alumno = alumno_curso.ac_rut_alumno
										INNER JOIN curso ON alumno_curso.ac_codigo_curso = curso.cu_codigo
										WHERE alumno_curso.ac_codigo_curso = '".$cursos."' AND Atraso.at_dia
										BETWEEN '".$desde."' AND '".$hasta."'",
										Conectar::conecta());
					$respuesta_informe1=mysql_fetch_array($consulta_informe1);
						if($respuesta_informe1['0']!='0'):
						$porcentaje=(($respuesta_informe1['0']*100)/$respuesta_informe2['0']);
							$cu_nombre[]=$respuesta_informe1['cu_nombre'];
							$cu_total[]= $respuesta_informe1['0'];
						?>
							<tr>
								<td><?php echo $respuesta_informe1['cu_nombre']; ?> </td>
								<td><?php echo $respuesta_informe1['0']; ?></td>
								<td><?php echo round($porcentaje,2)." %" ; ?></td>
								<td></td>
							</tr>
						<?php
						endif;
						$resto+=$respuesta_informe1['0'];
					}

					?>
					<tr>
						<td colspan="3">Total de atrasos</td>
						<td><?php echo $respuesta_informe2['0'];?></td>
					</tr>
						</table>

							<script type="text/javascript" src="https://www.google.com/jsapi"></script>
						    <script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
									var data = google.visualization.arrayToDataTable([
									['Curso', 'Inasistencia']
									<?php
									$semi=$respuesta_informe2['0']-$resto;
									if(sizeof($cu_nombre)!='1'){
										for ($i=0; $i < sizeof($cu_nombre) ; $i++){
											echo ",['$cu_nombre[$i]',$cu_total[$i]]";
										}
										echo ",['Otros',$semi]";
									}
									else{
										echo ",['$cu_nombre[0]',$cu_total[0]]";
										echo ",['Otros',$semi]";
									}

									 ?>
						        ]);

						        var options = {
						          title: 'Atrasos'
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
						        chart.draw(data, options);
						      }
						    </script>
						    <div id="chart_div" style="width:100%; height: 400px;"></div>

					<?php
					break;
			}
		endif;
	endif;

	?>
	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->

</body>
</html>
