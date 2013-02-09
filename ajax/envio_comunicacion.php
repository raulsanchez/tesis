<?php
include '../clases/conectar.class.php';
$opcion = $_POST["sugerencia"];
if($opcion == '1'):
?>
<div id="citacion">
	<h4>Citacion</h4>
		Ruego a usted concurrir al establecimiento educacional el día
			<input type="text" name="dia_citacion" id="dia_citacion" placeholder="10-10-2010">
		a las
			<input type="text" name="hora_citacion" id="hora_citacion" placeholder="00:00">
		horas, para hablar sobre
			<input type="text" name="asunto_citacion" id="asunto_citacion">
	</div>
<?php elseif($opcion =='2'): ?>
	<div id="comunicacion">
		<h4>Comunicación</h4>
		<textarea name="mensaje" id="mensaje" ></textarea>
	</div>

<?php elseif($opcion =='3'): ?>
	<h4>Reunion Apoderado</h4>
		Comunico a usted que el día
			<input type="text" name="dia_citacion" id="dia_citacion" placeholder="10-10-2010">
		a las
			<input type="text" name="hora_citacion" id="hora_citacion" placeholder="00:00">
		horas, habrá reunion de apoderado atte.
	</div>
<?php endif; ?>
<input type="submit" value="Enviar" class="btn btn-primary" >


