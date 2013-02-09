<?php
include '../clases/conectar.class.php';

$sugerencia = $_POST["sugerencia"];

$query = "SELECT `ap_rut`,
				`ap_tipo_apoderado`,
				`ap_nombre`,
				`ap_apaterno`,
				`ap_amaterno`,
				ap_fecha_nac,
				`ap_direccion`,
				`ap_comuna`,
				`ap_celular`,
				`ap_celular2`,
				`ap_telefono`,
				`ap_telefono_trabajo`,
				`ap_correo`
			FROM `apoderado`
			WHERE `ap_rut`='" . $sugerencia . "'";

$result = mysql_query($query,Conectar::conecta());
$row=mysql_fetch_array($result);
if(!empty($row)):
	echo '<img src="images/accept.png" title="De encuentra registrado" alt="Ok">';
	?>
	<script type="text/javascript">
		document.getElementById('ap_nombre').value='<?php echo $row["ap_nombre"] ?>';
		document.getElementById('ap_apaterno').value='<?php echo $row["ap_apaterno"] ?>';
		document.getElementById('ap_amaterno').value='<?php echo $row["ap_amaterno"] ?>';
		document.getElementById('ap_fecha_nac').value='<?php echo cambiarfecha_espanol($row["ap_fecha_nac"]) ?>';
		document.getElementById('ap_direccion').value='<?php echo $row["ap_direccion"] ?>';
		document.getElementById('ap_comuna').value='<?php echo $row["ap_comuna"] ?>';
		document.getElementById('ap_correo').value='<?php echo $row["ap_correo"] ?>';
		document.getElementById('ap_celular').value='<?php echo $row["ap_celular"] ?>';
		document.getElementById('ap_celular2').value='<?php echo $row["ap_celular2"] ?>';
		document.getElementById('ap_telefono').value='<?php echo $row["ap_telefono"] ?>';
		document.getElementById('ap_telefono_t').value='<?php echo $row["ap_telefono_trabajo"] ?>';

		document.getElementById('ap_nombre').setAttribute('readonly', 'readonly');
		document.getElementById('ap_apaterno').setAttribute('readonly', 'readonly');
		document.getElementById('ap_amaterno').setAttribute('readonly', 'readonly');
		document.getElementById('ap_fecha_nac').setAttribute('readonly', 'readonly');
		document.getElementById('ap_direccion').setAttribute('readonly', 'readonly');
		document.getElementById('ap_comuna').setAttribute('readonly', 'true');
		document.getElementById('ap_correo').setAttribute('readonly', 'readonly');
		document.getElementById('ap_celular').setAttribute('readonly', 'readonly');
		document.getElementById('ap_celular2').setAttribute('readonly', 'readonly');
		document.getElementById('ap_telefono').setAttribute('readonly', 'readonly');
		document.getElementById('ap_telefono_t').setAttribute('readonly', 'readonly');

		document.getElementById('agrega').style.display='none';

	</script>
<?php
else:
	echo '<img src="images/accept.png" title="No se encuentra registrado" alt="Ok">';
?>
	<script type="text/javascript">
		document.getElementById('ap_nombre').value="";
		document.getElementById('ap_apaterno').value="";
		document.getElementById('ap_amaterno').value="";
		document.getElementById('ap_fecha_nac').value="";
		document.getElementById('ap_direccion').value="";
		document.getElementById('ap_comuna').value="";
		document.getElementById('ap_correo').value="";
		document.getElementById('ap_celular').value="";
		document.getElementById('ap_celular2').value="";
		document.getElementById('ap_telefono').value="";
		document.getElementById('ap_telefono_t').value="";

		document.getElementById('ap_nombre').removeAttribute('readonly');
		document.getElementById('ap_apaterno').removeAttribute('readonly');
		document.getElementById('ap_amaterno').removeAttribute('readonly');
		document.getElementById('ap_fecha_nac').removeAttribute('readonly');
		document.getElementById('ap_direccion').removeAttribute('readonly');
		document.getElementById('ap_comuna').removeAttribute('readonly');
		document.getElementById('ap_correo').removeAttribute('readonly');
		document.getElementById('ap_celular').removeAttribute('readonly');
		document.getElementById('ap_celular2').removeAttribute('readonly');
		document.getElementById('ap_telefono').removeAttribute('readonly');
		document.getElementById('ap_telefono_t').removeAttribute('readonly');

		document.getElementById('agrega').style.display='inline-block';
	</script>
<?php
endif;
?>

