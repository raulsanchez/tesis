<?php
	$url=isset($_GET['url']) ? $_GET['url'] : null ;
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<style type="text/css">
	body{
		margin: 20px auto;
		width:400px;
		color:#fff;
		text-shadow:1px 1px 1px #666;
	}
	h3{
		color:#222;
		background: #fff;
		text-align: center;
		border-left:1px solid #ccc;
		border-right: 1px solid #ccc;

	}
	.control-group {
		width:100px;
	}
	.control-label{
		width:60px !important;
	}
	.form-horizontal{
		background:#1E5799;
		border-radius:5px;
		padding:15px 0px;
		width:350px;
	}
	.form-horizontal .controls{
margin-left:80px;
	}
	</style>
</head>
<body>
	<div id="entrar">
		<form class="form-horizontal" action="ingreso.php" method="POST">
			<h3>Ingreso</h3>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Rut</label>
				<div class="controls">
					<input type="text" id="inputEmail" placeholder="12345678-1" name="usuario">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputPassword">Clave</label>
				<div class="controls">
					<input type="password" id="inputPassword" placeholder="Clave" name="clave">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<input type="hidden" name="url" value=<?php echo $url; ?>>
					<button type="submit" class="btn" name="enviar" >Entrar</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>