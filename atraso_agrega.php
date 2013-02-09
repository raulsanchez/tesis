<?php
session_start();
require_once 'clases/conectar.class.php';
require_once 'clases/class.smtp.php';
require_once 'clases/class.phpmailer.php';
if(!isset($_SESSION['id_admin'])):
	if($_SESSION['ingreso']!=1):
		echo "<script type=''>";
			echo "window.location='entrar.php?url=";
			echo $_SERVER['REQUEST_URI']."'";
		echo "</script>";
	endif;
endif;
$query = "SELECT al_rut,al_nombre,al_apaterno,al_amaterno FROM  `alumno`";
$result = mysql_query($query,Conectar::conecta());


?>
<!DOCTYPE>
<html>
	<!-- HEAD -->
		<?php include'template/head.php';?>
		<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
		<script type="text/javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" href="css/messi.css">
		<script type="text/javascript" src="js/messi.js"></script>
		<script>
		    $(function() {
		        var availableTags = [
			        <?php
				        while ($row=mysql_fetch_array($result)):
		       				echo '"'.$row['1']." ".$row['2']." ".$row['3']." | ".$row['0']." | ".'",';
				        endwhile;
			        ?>
		        ];
		        $( "#alumno" ).autocomplete({
		            source: availableTags
		        });
		    });
		    function funcion(valor){
		    	if(valor=='otro'){
		    		$("#otro").show();
		    	}
		    }
 		</script>
 		<style type="text/css">
 		    .ui-autocomplete {
				max-height: 200px;
				overflow-y: auto;
				width:250px;
    		}
			.ui-menu .ui-menu-item a{
				padding:3px;
				margin:1px;
			}
			.ui-widget{
				font-family:Lucida,Tahoma,Arial;
				font-size: 0.75em;
			}
			.ui-widget-content .ui-state-focus{
			}
			#otro{
				display:none;
			}
 		</style>
 		</head>
	<!-- FIN HEAD -->
<body>
	<!-- HEADER -->
		<?php include 'template/header.php';?>
			<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    		<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	<!-- FIN HEADER -->
	<!-- MENU  -->
		<?php include 'template/nav.php'; ?>
	<!-- FIN MENU -->
	<div id="submenu">
		<div class="submenu">
			<ul>
				<!-- <li><a href="atraso_agrega.php"><img src="images/add.png" alt="nuevo"> Ingresar nuevo alumno</a></li> -->
				<!-- <li><a href=""><img src="images/pencil.png" alt=""> Editar</a></li>
					<li><a href=""><img src="images/delete.png" alt=""> Eliminar</a></li> -->
			</ul>
		</div>
	</div>
	<div id="contenido">
		<div class="perfil">
			<form action="" method="POST">
				<fieldset>
				<legend>Ingreso de atraso</legend>
					<table border="1">
						<tr>
							<td>Alumno</td>
							<td>
								<input type="text" name="alumno" id="alumno" required="required">
							</td>
						</tr>
						<tr>
							<td>Hora</td>
							<td><input type="time" name="hora" required="required" placeholder="<?php echo date("H:i"); ?>" size="5"></td>
						</tr>
						<tr>
							<td>Dia</td>
							<td><input type="date" name="dia" required="required" placeholder="<?php echo date("d-m-Y"); ?>" size="11"></td>
						</tr>
						<tr>
							<td>Motivo</td>
							<td>
								<select name="motivo" id="motivo" onchange="funcion(this.value)">
									<option value="0">Seleccion</option>
									<option value="Sin locomoción">Sin Locomoción</option>
									<option value="Quedarse Dormido">Quedarse Dormido</option>
									<option value="otro">Otros (especificar abajo)</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><textarea rows="3" name="otro" id="otro" cols="45" rows="5"></textarea></td>
						</tr>
						<tr>
							<td colspan="2" >
								<br><input type="submit" value="Agregar atraso" name="atraso" class="btn btn-primary "></td>
						</tr>
					</table>
			</fieldset>

			</form>

		</div>
		<div class="clear"></div>
	</div>
	<!-- FOOTER -->
		<?php include'template/footer.php';?>
	<!-- FIN FOOTER -->
	<?php
	if(isset($_REQUEST['atraso'])):

		$alumno	= $_POST['alumno'];
		$hora	= $_POST['hora'];
		$dia	= cambiarfecha_mysql($_POST['dia']);
		$motivo	= $_POST['motivo'];
		$otro=isset($_POST['otro']) ? $_POST['otro'] : null ;
		$cadena=explode(' | ',$alumno);
		$rut="";
		for ($i=0; $i < count($cadena)  ; $i++):
			if ($i%2==1):
				$rut=($cadena[$i]);
			endif;
		endfor;
		$consulta_datos=mysql_query("SELECT  `ap_tipo_apoderado` ,  `ap_nombre` ,  `ap_apaterno` ,  `ap_amaterno`,`ap_celular`, `ap_correo`,al_nombre,al_apaterno,al_amaterno
					FROM  `apoderado`
					INNER JOIN apoderado_alumno ON ap_rut = aa_rut_apoderado
					INNER JOIN alumno ON al_rut = aa_rut_alumno
					WHERE aa_rut_alumno =  '$rut' AND ap_tipo_apoderado='0' ",Conectar::conecta());

		$respuesta_datos=mysql_fetch_array($consulta_datos);
		setlocale(LC_ALL,"es_ES");
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		$enviocorreo='
				<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<title>Documento sin título</title>
				</head>
				<body>
					<div id="fondo">
						<table>
							<tr>
				    			<td align="center"><img src="http://www.insatvaldivia.cl/images/logocorreo.png"></td>
					    	</tr>
					    	<tr>
					    		<td align="right" class="fecha">
								 '.$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') .', Valdivia
					    		 </td>
					    	</tr>
					    	<tr>
					    		<td aling="left">
					    			<span> Señor(a):</span>
					    			<p class="para">'.$respuesta_datos["ap_nombre"].' '.$respuesta_datos["ap_apaterno"].' ' .$respuesta_datos["ap_amaterno"] .'</p>

					    			<p class="comunicado">
					    				Comunico a usted que su pupilo llegó atrasado el dia '.$dia.' a las '.$hora.'
					    				<br>
					    				<br>
					    				atte. Inspectoria General.
					    			</p>
					    		</td>
					    	</tr>

					    	<tr>
					    		<td>	    	<hr>
					    			<p class="pie">

					    				Direccion: Domeyko #398,Valdivia. <br>
					    				Telefono: 063-220451 <br>
					    				<a href="http://www.insatvaldivia.cl">www.insatvaldivia.cl</a>
					    			</p>

					    		</td>
					    	</tr>
						</table>
					</div>

				</body>
				</html>';




			$mail             = new PHPMailer(); // defaults to using php "mail()"
			//El cuerpo del mensaje
			$body             = $enviocorreo;

			//añade el remitente
			$mail->AddReplyTo("inspectoria@insatvaldivia.cl","Inspectoria Insat ");
			$mail->SetFrom('inspectoria@insatvaldivia.cl', 'Inspectoria Insat');
			//aquien va dirigido
			//			 |||||
			//			 ˅˅˅˅˅
			$address = $respuesta_datos['ap_correo'];
			$mail->AddAddress($address);
			//el asunto
			$mail->Subject    = 'Atraso Alumno';
			//envio de mensaje alternativo si no soporta HTML
			$mail->MsgHTML($body);
			//envia el mensaje
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  echo "Message sent! ";
			}
			$sms_enviar="Don/a ".$respuesta_datos['al_nombre']." ".$respuesta_datos['al_apaterno']." ha llegado atrasado el dia ".$dia." a las ".$hora." atte. inspectoria insat valdivia";
					// define('PANACEA_USER','linkin009');
					// define('PANACEA_API_KEY','5-uqy0l3vgcbwl3pd5ljt20ror46zliaix6nxtr9zvxz7rr8');
					// // SMS_SENDER_NAME es el nombre con que le llega al destinatario el SMS
					// // Tened cuidado de no pasaros con el nombre.
					// // Si os pasais el SMS se envia pero no llega.
					// // Simplemente no os paseis de los 8 caracteres.
					// define('SMS_SENDER_NAME','PRUEBA');

					// // telefono del destinatario
					// $tlf='+569'.$respuesta_datos['ap_celular']; //con prefijo (34 -> españa)
					// // texto del SMS
					// $msg=$sms_enviar;


					// $api = new PanaceaApi();

					// // autentificacion
					// $api->setUsername(PANACEA_USER);
					// $api->setPassword(PANACEA_API_KEY);

					// // enviamos el SMS
					// $result = $api->message_send($tlf, $msg, SMS_SENDER_NAME, 19, null,
					//                         null, null, -1, 1);

					// // si el mensaje se ha enviado
					// if($api->ok($result)) {
					//          "<p>SMS enviado! ID: {$result['details']}</p>";
					// } else {
					//         echo "<p>Fallo al enviar el SMS: ".$api->getError()."</p>";
					// }
		$sql="INSERT INTO `atraso`(
							`at_rut_alumno`,
							`at_hora`,
							`at_dia`,
							`at_motivo`,
							`at_otro`)
					VALUES ('".$rut."',
							'".$hora."',
							'".$dia."',
							'".$motivo."',
							'".$otro."')";
		if(!mysql_query($sql,Conectar::conecta())):
			echo mysql_error();
		else:
			?>
			<script type="text/javascript">
				new Messi(
		        	'Se ingreso y envió el atraso correctamente',
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
		endif;
	endif;
	?>
</body>
</html>
