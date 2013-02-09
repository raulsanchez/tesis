<?php
// incluyo la conexion para la consulta
include '../clases/conectar.class.php';

//resivo la variable que envie por post (sugerencia)
$sugerencia = $_POST["sugerencia"];


// Hago la consulta
$query = "SELECT 	`al_rut`,
					`al_nombre`,
					`al_apaterno`,
					`al_amaterno`,
					`al_fecha_nacimiento`,
					`al_direccion`,
					`al_comuna`,
					`al_celular`,
					`al_telefono`,
					`al_correo` FROM `alumno` WHERE `al_rut`='" . $sugerencia . "' LIMIT 0 , 1";

// consulto
$result = mysql_query($query,Conectar::conecta());
// Obtengo los datos de la consulta
$row=mysql_fetch_array($result);
//consulto si llegaron datos o no
if(!empty($row)):
	//muestro una imagen (esto se ve en el div que cree)
echo '<img src="images/cancel.png" title="Ya se encuentra registrado" alt="Error">';
?>
<!-- Empieso a utilizar javascript para pasarle los datos -->
	<script type="text/javascript">
		//Una mensaje en pantalla diciendo que el alumno ya se encuentra registrado
		alert('El alumno ya se encuentra registrado');
		// ocupo javascript para darle el varlo al input con sus respectivo ID
		document.getElementById('nombre').value='<?php echo $row["al_nombre"] ?>';
		document.getElementById('apaterno').value='<?php echo $row["al_apaterno"] ?>';
		document.getElementById('amaterno').value='<?php echo $row["al_amaterno"] ?>';
		document.getElementById('fecha_nac').value='<?php echo $row["al_fecha_nacimiento"] ?>';
		document.getElementById('direccion').value='<?php echo $row["al_direccion"] ?>';
		document.getElementById('comuna').value='<?php echo $row["al_comuna"] ?>';
		document.getElementById('correo').value='<?php echo $row["al_correo"] ?>';
		document.getElementById('celular').value='<?php echo $row["al_celular"] ?>';
		document.getElementById('telefono').value='<?php echo $row["al_telefono"] ?>';
		// al input le doy atributo de solo lectura, para que no se pueda modificar
		document.getElementById('nombre').setAttribute('readonly', 'readonly');
		document.getElementById('apaterno').setAttribute('readonly', 'readonly');
		document.getElementById('amaterno').setAttribute('readonly', 'readonly');
		document.getElementById('fecha_nac').setAttribute('readonly', 'readonly');
		document.getElementById('direccion').setAttribute('readonly', 'readonly');
		document.getElementById('comuna').setAttribute('readonly', 'readonly');
		document.getElementById('correo').setAttribute('readonly', 'readonly');
		document.getElementById('celular').setAttribute('readonly', 'readonly');
		document.getElementById('telefono').setAttribute('readonly', 'readonly');

	</script>
<?php
// si no se encuentra el rut en la base de datos
else:
	//muestra la imagen
echo '<img src="images/accept.png" title="No se encuentra registrado" alt="Ok">';
?>
	<script type="text/javascript">
	//se le remueve el atributo de solo lectura al input, si este lo tenia
		document.getElementById('nombre').removeAttribute('readonly');
		document.getElementById('apaterno').removeAttribute('readonly');
		document.getElementById('amaterno').removeAttribute('readonly');
		document.getElementById('fecha_nac').removeAttribute('readonly');
		document.getElementById('direccion').removeAttribute('readonly');
		document.getElementById('comuna').removeAttribute('readonly');
		document.getElementById('correo').removeAttribute('readonly');
		document.getElementById('celular').removeAttribute('readonly');
		document.getElementById('telefono').removeAttribute('readonly');
	</script>

<?php
endif;
 ?>

