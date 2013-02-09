<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<?php include'template/head.php';?>
	<link rel="stylesheet" href="css/messi.css">
	<script type="text/javascript" src="js/messi.js"></script>
</head>
<body>
	<?php
require_once 'clases/conectar.class.php';
require_once 'clases/class.smtp.php';
require_once 'clases/class.phpmailer.php';
require_once 'clases/panacea_api.php';

$tipo_comunicacion	= $_POST['tipo_comunicacion'];
$para				= $_POST['para'];
if($tipo_comunicacion=='1'):
	$dia_citacion		=$_POST['dia_citacion'];
	$hora_citacion		=$_POST['hora_citacion'];
	$asunto_citacion	=$_POST['asunto_citacion'];
	$array=explode('"', $para);
	$cadena=explode(' | ',$para);

	setlocale(LC_ALL,"es_ES");
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


	for ($i=0; $i < count($array)  ; $i++):
		if ($i%2==1):
			$consulta_alu="SELECT al_nombre,al_apaterno,al_amaterno FROM alumno WHERE al_rut ='".$cadena[$i]."'";
			$consulta_alu_sql=mysql_query($consulta_alu,Conectar::conecta());
			$respuesta_alu=mysql_fetch_array($consulta_alu_sql);
			$sql="SELECT `aa_rut_apoderado` FROM `apoderado_alumno` WHERE `aa_rut_alumno`='".$cadena[$i]."'";
			$resultado=mysql_query($sql,Conectar::conecta());
			$respuesta=mysql_fetch_array($resultado);
			$sql2="SELECT `ap_celular`, `ap_correo`,ap_nombre,ap_apaterno,ap_amaterno FROM `apoderado` WHERE `ap_rut` = '".$respuesta['0']."'";
			$resultado2=mysql_query($sql2,Conectar::conecta());
			$r=mysql_fetch_array($resultado2);
			$comunicado="Ruego a usted concurrir al establecimiento educacional el día $dia_citacion a las
					    				$hora_citacion horas, para hablar sobre $asunto_citacion,
					    				de don/doña ".$respuesta_alu['al_nombre']." ".$respuesta_alu['al_apaterno']." ".$respuesta_alu['al_amaterno']."";

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
					    			<p class="para">'.$r["ap_nombre"].' '.$r["ap_apaterno"].' ' .$r["ap_amaterno"] .'</p>

					    			<p class="comunicado">
					    				'.$comunicado.'
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
			$address = $r['1'];
			$mail->AddAddress($address);
			//el asunto
			$mail->Subject    = 'Citacion apoderado';
			//envio de mensaje alternativo si no soporta HTML
			$mail->MsgHTML($body);
			//envia el mensaje
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  echo "Message sent! ";
			}
			/*************************************************************************************************
		************************************* Ejemplo de envío de un mensaje *****************************
		*************************************************************************************************/
		$sms_enviar=substr("Ruego a usted concurrir al establecimiento educacional el día ".$dia_citacion." a las
				".$hora_citacion." horas, por don/doña
				".$respuesta_alu['al_nombre']." ".$respuesta_alu['al_apaterno']." ".$respuesta_alu['al_amaterno']." atte. Insat",0,160);
				/* Include PanaceaApi class */
					define('PANACEA_USER','linkin009');
					define('PANACEA_API_KEY','5-uqy0l3vgcbwl3pd5ljt20ror46zliaix6nxtr9zvxz7rr8');
					// SMS_SENDER_NAME es el nombre con que le llega al destinatario el SMS
					// Tened cuidado de no pasaros con el nombre.
					// Si os pasais el SMS se envia pero no llega.
					// Simplemente no os paseis de los 8 caracteres.
					define('SMS_SENDER_NAME','PRUEBA');

					// telefono del destinatario
					$tlf='+569'.$r['0']; //con prefijo (34 -> españa)
					// texto del SMS
					$msg=$sms_enviar;


					$api = new PanaceaApi();

					// autentificacion
					$api->setUsername(PANACEA_USER);
					$api->setPassword(PANACEA_API_KEY);

					// enviamos el SMS
					$result = $api->message_send($tlf, $msg, SMS_SENDER_NAME, 19, null,
					                        null, null, -1, 1);

					// si el mensaje se ha enviado
					if($api->ok($result)) {
					         "<p>SMS enviado! ID: {$result['details']}</p>";
					} else {
					        echo "<p>Fallo al enviar el SMS: ".$api->getError()."</p>";
					}
		## FORMA 2

		// $login = "linkin_crack@hotmail.com";
		// $apiID = "2CE52B19118331CE47B353CCF77AFAF0";

		// $phone = "+569".$r['0'] ;
		// $text = $sms_enviar;
		// $fields_string = "";

		// //Inicializamos todas las variables para poder realizar el envío
		// $url = 'http://api-sms.infoavisos.net/http/httpSend.cfm';
		// $fields = array(
		// 'login'=>urlencode($login),
		// 'apiID'=>urlencode($apiID),
		// 'phone_1'=>urlencode($phone),
		// 'text_1'=>urlencode($text)
		// );

		// //Inicializamos el string para poder hacer un POST contra api sms (formato querystring)
		// foreach($fields as $key=>$value) {
		// $fields_string .= $key.'='.$value.'&'; }
		// $fields_string = rtrim($fields_string,'&');

		// //Inicializamos la conexión (abrimos la conexión)
		// $ch = curl_init();

		// //Preparamos la URL, con el número de variables POST y todos los datos POST necesarios.
		// curl_setopt($ch,CURLOPT_URL,$url);
		// curl_setopt($ch,CURLOPT_POST,count($fields));
		// curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

		// //ejecutamos el POST previamente preparado
		// $result = curl_exec($ch);

		// //cerramos la conexión
		// curl_close($ch);

		// //Guardamos el resultado y lo mostramos.
		// echo "resultado SMS:" . $result;

		mysql_query("INSERT INTO `citacion`( `ci_rut_alumno`, `ci_hora`, `ci_dia`, `ci_motivo`)
				VALUES ('".$cadena[$i]."','".$hora_citacion."','".cambiarfecha_mysql($dia_citacion)."','".$asunto_citacion."')",Conectar::conecta());
		endif;
	endfor;
//***********************************************************************************************************************
//***********************************************************************************************************************

elseif($tipo_comunicacion=='2'):
	$comunicacion 	= $_POST['mensaje'];
	$array=explode('"', $para);
	$cadena=explode(' | ',$para);
	setlocale(LC_ALL,"es_ES");
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


	for ($i=0; $i < count($array)  ; $i++):
		if ($i%2==1):
			$consulta_alu="SELECT al_nombre,al_apaterno,al_amaterno FROM alumno WHERE al_rut ='".$cadena[$i]."'";
			$consulta_alu_sql=mysql_query($consulta_alu,Conectar::conecta());
			$respuesta_alu=mysql_fetch_array($consulta_alu_sql);
			$sql="SELECT `aa_rut_apoderado` FROM `apoderado_alumno` WHERE `aa_rut_alumno`='".$cadena[$i]."'";
			$resultado=mysql_query($sql,Conectar::conecta());
			$respuesta=mysql_fetch_array($resultado);
			$sql2="SELECT `ap_celular`, `ap_correo`,ap_nombre,ap_apaterno,ap_amaterno FROM `apoderado` WHERE `ap_rut` = '".$respuesta['0']."'";
			$resultado2=mysql_query($sql2,Conectar::conecta());
			$r=mysql_fetch_array($resultado2);

			echo $enviocorreo='
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
					    			<p class="para">'.$r["ap_nombre"].' '.$r["ap_apaterno"].' ' .$r["ap_amaterno"] .'</p>

					    			<p class="comunicado">
					    				 '.$comunicacion .'
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
			$address = $r['1'];
			$mail->AddAddress($address);
			//el asunto
			$mail->Subject    = 'Citacion apoderado';
			//envio de mensaje alternativo si no soporta HTML
			$mail->MsgHTML($body);
			//envia el mensaje
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  echo "Message sent! ";
			}
			/*************************************************************************************************
		************************************* Ejemplo de envío de un mensaje *****************************
		*************************************************************************************************/
		$sms_enviar=substr($comunicacion,0,160);
		/* Include PanaceaApi class */
					define('PANACEA_USER','linkin009');
					define('PANACEA_API_KEY','5-uqy0l3vgcbwl3pd5ljt20ror46zliaix6nxtr9zvxz7rr8');
					// SMS_SENDER_NAME es el nombre con que le llega al destinatario el SMS
					// Tened cuidado de no pasaros con el nombre.
					// Si os pasais el SMS se envia pero no llega.
					// Simplemente no os paseis de los 8 caracteres.
					define('SMS_SENDER_NAME','PRUEBA');

					// telefono del destinatario
					$tlf='+569'.$r['0']; //con prefijo (34 -> españa)
					// texto del SMS
					$msg=$sms_enviar;


					$api = new PanaceaApi();

					// autentificacion
					$api->setUsername(PANACEA_USER);
					$api->setPassword(PANACEA_API_KEY);

					// enviamos el SMS
					$result = $api->message_send($tlf, $msg, SMS_SENDER_NAME, 19, null,
					                        null, null, -1, 1);

					// si el mensaje se ha enviado
					if($api->ok($result)) {
					         "<p>SMS enviado! ID: {$result['details']}</p>";
					} else {
					        echo "<p>Fallo al enviar el SMS: ".$api->getError()."</p>";
					}

			### FORMA 2
		$sms_enviar=substr($comunicacion,0,160);
		$login = "linkin_crack@hotmail.com";
		$apiID = "2CE52B19118331CE47B353CCF77AFAF0";
		echo $r['0'];
		$phone = "+569".$r['0'] ;
		$text = $sms_enviar;
		$fields_string = "";

		//Inicializamos todas las variables para poder realizar el envío
		$url = 'http://api-sms.infoavisos.net/http/httpSend.cfm';
		$fields = array(
		'login'=>urlencode($login),
		'apiID'=>urlencode($apiID),
		'phone_1'=>urlencode($phone),
		'text_1'=>urlencode($text)
		);

		//Inicializamos el string para poder hacer un POST contra api sms (formato querystring)
		foreach($fields as $key=>$value) {
		$fields_string .= $key.'='.$value.'&'; }
		$fields_string = rtrim($fields_string,'&');

		//Inicializamos la conexión (abrimos la conexión)
		$ch = curl_init();

		//Preparamos la URL, con el número de variables POST y todos los datos POST necesarios.
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

		//ejecutamos el POST previamente preparado
		$result = curl_exec($ch);

		//cerramos la conexión
		curl_close($ch);

		//Guardamos el resultado y lo mostramos.
		echo "resultado SMS:" . $result;

		mysql_query("INSERT INTO `comunicacion`(`cu_mensaje`, `cu_mensaje_celu`)
					VALUES ('".$comunicacion."','".$sms_enviar."')",Conectar::conecta());
		mysql_query("SELECT `idComunicacion`
					FROM `comunicacion`
					ORDER BY `comunicacion`.`idComunicacion` ASC
					LIMIT 0 , 1",Conectar::conecta());
		$id=mysql_fetch_array(mysql_query("SELECT `idComunicacion`
					FROM `comunicacion`
					ORDER BY `comunicacion`.`idComunicacion` DESC
					LIMIT 0 , 1",Conectar::conecta()));
		echo $ofid=$id['0']+1;
		mysql_query("INSERT INTO `envio_comunicacion`(`ec_rut`, `ec_id_comunicacion`)
					VALUES ('".$cadena[$i]."','".$ofid."'",Conectar::conecta());
		endif;
	endfor;

elseif($tipo_comunicacion=='3'):
	$dia_citacion		=$_POST['dia_citacion'];
	$hora_citacion		=$_POST['hora_citacion'];
	$array=explode('"', $para);
	$cadena=explode(' | ',$para);
	setlocale(LC_ALL,"es_ES");
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


	for ($i=0; $i < count($array)  ; $i++):
		if ($i%2==1):
			$consulta_alu="SELECT al_nombre,al_apaterno,al_amaterno FROM alumno WHERE al_rut ='".$cadena[$i]."'";
			$consulta_alu_sql=mysql_query($consulta_alu,Conectar::conecta());
			$respuesta_alu=mysql_fetch_array($consulta_alu_sql);
			$sql="SELECT `aa_rut_apoderado` FROM `apoderado_alumno` WHERE `aa_rut_alumno`='".$cadena[$i]."'";
			$resultado=mysql_query($sql,Conectar::conecta());
			$respuesta=mysql_fetch_array($resultado);
			$sql2="SELECT `ap_celular`, `ap_correo`,ap_nombre,ap_apaterno,ap_amaterno FROM `apoderado` WHERE `ap_rut` = '".$respuesta['0']."'";
			$resultado2=mysql_query($sql2,Conectar::conecta());
			$r=mysql_fetch_array($resultado2);
			$comu="Comunico a usted que el día $dia_citacion a las horas $hora_citacion, habrá reunion de apoderado.";
			echo $enviocorreo='
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
					    			<p class="para">'.$r["ap_nombre"].' '.$r["ap_apaterno"].' ' .$r["ap_amaterno"] .'</p>

					    			<p class="comunicado">
										'.$comu.'
										<br /><br />
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
			$address = $r['1'];
			$mail->AddAddress($address);
			//el asunto
			$mail->Subject    = 'Citacion apoderado';
			//envio de mensaje alternativo si no soporta HTML
			$mail->MsgHTML($body);
			//envia el mensaje
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  echo "Message sent! ";
			}
			/*************************************************************************************************
		************************************* Ejemplo de envío de un mensaje *****************************
		*************************************************************************************************/
		$sms_enviar=substr('Comunico a usted que el día '.$dia_citacion.' a las horas '.$hora_citacion.',
								habrá reunion de apoderado. atte. Insat',0,160);
				/* Include PanaceaApi class */
					define('PANACEA_USER','linkin009');
					define('PANACEA_API_KEY','5-uqy0l3vgcbwl3pd5ljt20ror46zliaix6nxtr9zvxz7rr8');
					// SMS_SENDER_NAME es el nombre con que le llega al destinatario el SMS
					// Tened cuidado de no pasaros con el nombre.
					// Si os pasais el SMS se envia pero no llega.
					// Simplemente no os paseis de los 8 caracteres.
					define('SMS_SENDER_NAME','PRUEBA');

					// telefono del destinatario
					$tlf='+569'.$r['0']; //con prefijo (34 -> españa)
					// texto del SMS
					$msg=$sms_enviar;


					$api = new PanaceaApi();

					// autentificacion
					$api->setUsername(PANACEA_USER);
					$api->setPassword(PANACEA_API_KEY);

					// enviamos el SMS
					$result = $api->message_send($tlf, $msg, SMS_SENDER_NAME, 19, null,
					                        null, null, -1, 1);

					// si el mensaje se ha enviado
					if($api->ok($result)) {
					         "<p>SMS enviado! ID: {$result['details']}</p>";
					} else {
					        echo "<p>Fallo al enviar el SMS: ".$api->getError()."</p>";
					}
		## FORMA 2
		// $login = "linkin_crack@hotmail.com";
		// $apiID = "2CE52B19118331CE47B353CCF77AFAF0";

		// $phone = "+569".$r['0'] ;
		// $text = $sms_enviar;
		// $fields_string = "";

		// //Inicializamos todas las variables para poder realizar el envío
		// $url = 'http://api-sms.infoavisos.net/http/httpSend.cfm';
		// $fields = array(
		// 'login'=>urlencode($login),
		// 'apiID'=>urlencode($apiID),
		// 'phone_1'=>urlencode($phone),
		// 'text_1'=>urlencode($text)
		// );

		// //Inicializamos el string para poder hacer un POST contra api sms (formato querystring)
		// foreach($fields as $key=>$value) {
		// $fields_string .= $key.'='.$value.'&'; }
		// $fields_string = rtrim($fields_string,'&');

		// //Inicializamos la conexión (abrimos la conexión)
		// $ch = curl_init();

		// //Preparamos la URL, con el número de variables POST y todos los datos POST necesarios.
		// curl_setopt($ch,CURLOPT_URL,$url);
		// curl_setopt($ch,CURLOPT_POST,count($fields));
		// curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

		// //ejecutamos el POST previamente preparado
		// $result = curl_exec($ch);

		// //cerramos la conexión
		// curl_close($ch);

		// //Guardamos el resultado y lo mostramos.
		// echo "resultado SMS:" . $result;
		mysql_query("INSERT INTO `comunicacion`(`cu_mensaje`, `cu_mensaje_celu`,cu_tipo)
					VALUES ('".$comu."atte. Inspectoria General"."','".$sms_enviar."','1')",Conectar::conecta());
		mysql_query("SELECT `idComunicacion`
					FROM `comunicacion`
					ORDER BY `comunicacion`.`idComunicacion` ASC
					LIMIT 0 , 1",Conectar::conecta());
		$id=mysql_fetch_array(mysql_query("SELECT `idComunicacion`
					FROM `comunicacion`
					ORDER BY `comunicacion`.`idComunicacion` DESC
					LIMIT 0 , 1",Conectar::conecta()));
		echo $ofid=$id['0']+1;
		mysql_query("INSERT INTO `envio_comunicacion`(`ec_rut`, `ec_id_comunicacion`)
					VALUES ('".$cadena[$i]."','".$ofid."'",Conectar::conecta());
		endif;
	endfor;
	?>
	<script type="text/javascript">
				new Messi(
		        	'Se envio correctamente',
		        	{
		        		title: 'Éxito',
		        		modal: true,
		        		titleClass: 'success',
		        		buttons: [{id: 0, label: 'Cerrar', val: 'X'}],
		        		autoclose:'3000'
		        	}
		        );
					function redireccionarPagina() {
	 					window.location='comunicacion.php';
	 				}
					setTimeout("redireccionarPagina()", 4000);
			</script>
	<?php
endif;
?>
</body>
</html>
