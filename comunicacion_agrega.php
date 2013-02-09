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
$q_curso="SELECT `cu_codigo`, `cu_nombre` FROM `curso`";
$r_curso=mysql_query($q_curso,Conectar::conecta());
$query = "SELECT al_nombre,al_apaterno,al_amaterno, al_rut FROM  `alumno`";
$result = mysql_query($query,Conectar::conecta());


?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<script type="text/javascript" src="js/textext-1.3.1.js"></script>

		<script type="text/javascript">
			function Autocomplete(param){
				$("#redaccion").load("ajax/envio_comunicacion.php", {sugerencia: param});
				$("#para").show();
			};
		</script>
		<style type="text/css">
			span{
				padding-top: 0px;
			}
			#citacion{
				width:100%;
				line-height: 25px;
			}
			#dia_citacion{
				width:90px !important;
			}
			#hora_citacion{
				width:50px !important;
			}
			#asunto_citacion{
				width:300px !important;
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

	</div>
	<div id="contenido">
		<div id="comu">
			<form action="envio_smsycorreo.php" method="POST" >
				<h4>Tipo de comunicación</h4>
							<select name="tipo_comunicacion" id="tipo_comunicacion" onchange="Autocomplete(this.value)">
								<option value="0">--Seleccione--</option>
								<option value="1">Citación Apoderado</option>
								<option value="2">Comunicación</option>
								<option value="3">Reunión</option>
							</select>
				<div id="para">
					<h4>Para</h4>
					<table id="comu_tabla">
						<tr>
							<td><textarea id="textarea" class="example" rows="1" name="para" placeholder="Ingrese nombre alumno"></textarea></td>
						</tr>
					</table>
				</div>
				<div id="redaccion">

				</div>

			</form>
		</div>
	</div>
	<div class="clear"></div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
	<script type="text/javascript">
					$('#textarea')
						.textext({
							plugins : 'tags autocomplete arrow'
						})
						.bind('getSuggestions', function(e, data)
						{
							var list = [
								 <?php
								    while ($c_curso=mysql_fetch_array($r_curso)):
							    		echo trim("'".$c_curso['cu_nombre']." | ".$c_curso['cu_codigo']. " | "."',");
								    endwhile;
								?>
								 <?php
								    while ($row=mysql_fetch_array($result)):
							    		echo "'".$row['0']." ".$row['1']." ".$row['2']." | ".$row['3']. " | "."',";
								    endwhile;
								?>
								],
								textext = $(e.target).textext()[0],
								query = (data ? data.query : '') || ''
								;

							$(this).trigger(
								'setSuggestions',
								{ result : textext.itemManager().filter(list, query) }
							);
						})
						;
		$(document).ready(function() {
			$("#para").hide();
		});
	</script>
</body>
</html>
