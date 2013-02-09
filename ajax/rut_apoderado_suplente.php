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
		document.getElementById('aps_nombre').value='<?php echo $row["ap_nombre"] ?>';
		document.getElementById('aps_apaterno').value='<?php echo $row["ap_apaterno"] ?>';
		document.getElementById('aps_amaterno').value='<?php echo $row["ap_amaterno"] ?>';
		document.getElementById('aps_fecha_nac').value='<?php echo $row["ap_fecha_nac"] ?>';
		document.getElementById('aps_direccion').value='<?php echo $row["ap_direccion"] ?>';
		document.getElementById('aps_comuna').value='<?php echo $row["ap_comuna"] ?>';
		document.getElementById('aps_correo').value='<?php echo $row["ap_correo"] ?>';
		document.getElementById('aps_celular').value='<?php echo $row["ap_celular"] ?>';
		document.getElementById('aps_celular2').value='<?php echo $row["ap_celular2"] ?>';
		document.getElementById('aps_telefono').value='<?php echo $row["ap_telefono"] ?>';
		document.getElementById('aps_telefono_t').value='<?php echo $row["ap_telefono_trabajo"] ?>';

		document.getElementById('aps_nombre').setAttribute('readonly', 'readonly');
		document.getElementById('aps_apaterno').setAttribute('readonly', 'readonly');
		document.getElementById('aps_amaterno').setAttribute('readonly', 'readonly');
		document.getElementById('aps_fecha_nac').setAttribute('readonly', 'readonly');
		document.getElementById('aps_direccion').setAttribute('readonly', 'readonly');
		document.getElementById('aps_comuna').setAttribute('readonly', 'true');
		document.getElementById('aps_correo').setAttribute('readonly', 'readonly');
		document.getElementById('aps_celular').setAttribute('readonly', 'readonly');
		document.getElementById('aps_celular2').setAttribute('readonly', 'readonly');
		document.getElementById('aps_telefono').setAttribute('readonly', 'readonly');
		document.getElementById('aps_telefono_t').setAttribute('readonly', 'readonly');

		document.getElementById('agrega').style.display='none';

	</script>
<?php
else:
	echo '<img src="images/accept.png" title="No se encuentra registrado" alt="Ok">';
?>
	<script type="text/javascript">
		document.getElementById('aps_nombre').value="";
		document.getElementById('aps_apaterno').value="";
		document.getElementById('aps_amaterno').value="";
		document.getElementById('aps_fecha_nac').value="";
		document.getElementById('aps_direccion').value="";
		document.getElementById('aps_comuna').value="";
		document.getElementById('aps_correo').value="";
		document.getElementById('aps_celular').value="";
		document.getElementById('aps_celular2').value="";
		document.getElementById('aps_telefono').value="";
		document.getElementById('aps_telefono_t').value="";

		document.getElementById('aps_nombre').removeAttribute('readonly');
		document.getElementById('aps_apaterno').removeAttribute('readonly');
		document.getElementById('aps_amaterno').removeAttribute('readonly');
		document.getElementById('aps_fecha_nac').removeAttribute('readonly');
		document.getElementById('aps_direccion').removeAttribute('readonly');
		document.getElementById('aps_comuna').removeAttribute('readonly');
		document.getElementById('aps_correo').removeAttribute('readonly');
		document.getElementById('aps_celular').removeAttribute('readonly');
		document.getElementById('aps_celular2').removeAttribute('readonly');
		document.getElementById('aps_telefono').removeAttribute('readonly');
		document.getElementById('aps_telefono_t').removeAttribute('readonly');

		document.getElementById('agrega').style.display='inline-block';
	</script>
<?php
endif;
?>

