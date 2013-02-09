<?php
	$url=isset($_GET['url']) ? $_GET['url'] : null ;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
</head>
<body id="fondoentrar">
		<div id="entrar">
			<form action="ingreso.php" method="post">
				<div class="login">
					<p>Ingreso</p>
					<label for="user">Rut</label>
					<input type="text" name="usuario"  id="user" size="30"/>
					<label for="pass">Contraseña</label>
					<input type="text" name="clave" id="pass" size="30"/>
					<input type="hidden" name="url" value=<?php echo $url; ?>>
				</div>
				<div class="logbtn">
					<input type="submit" name="enviar" value="Entrar!"/>
				</div>
			</form>
		</div>
</body>
</html>