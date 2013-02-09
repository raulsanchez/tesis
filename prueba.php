<?php
require_once 'clases/conectar.class.php';
// $ap_rut="algo";
// $rut="17360463-7";
// $c="INSERT INTO `apoderado_alumno`(`aa_rut_apoderado`,`aa_rut_alumno`)
// 							VALUES ('".$ap_rut."','".$rut."')";
// if(mysql_query($c,Conectar::conecta())):
// 	echo "<br />Todo Ok entre el alumno y apoderado";
// else:
// 	echo "<br />Error no está bien la consulta";
// endif;
// $consulta=mysql_query("SELECT * FROM `alumno` WHERE `al_rut`='$rut'",Conectar::conecta());
// $r=mysql_fetch_array($consulta);
// echo $r['0'];
?>
<!-- <form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="foto">
	<input type="submit" name="enviar" value"enviarrr">
</form> -->
<?php
// if($_POST['enviar']):
// $foto=$_FILES["foto"]["name"];
// $temp=$_FILES["foto"]["tmp_name"];
// $tamano=$_FILES["foto"]["size"];
// echo $tipo=$_FILES["foto"]["type"];

// endif;
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
</head>
<body>
<label for="autocomplete">Select a programming language: </label>
<input id="autocomplete">

<script>
$( "#autocomplete" ).autocomplete({
    source: [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ]
});
</script>
<form action="" method="GET">
	<input type="text" name="Desabilitado" id="" disabled="disabled">
	<input type="text" name="Hablitado" id="">
	<input type="submit" value="Enviar">
</form>


</body>
<?php
	$error[]="algo";
	$error[]="otra cosa";
	$error[]="algo mas";

	print_r($error);
	echo count($error);
 ?>
</html>

