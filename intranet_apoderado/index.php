<?php
session_start();
require_once '../clases/conectar.class.php';
if(!isset($_SESSION['id_admin2'])):
		echo "<script type=''>";
			echo "window.location='entrar.php?url=";
			echo $_SERVER['REQUEST_URI']."'";
		echo "</script>";
endif;
$consulta=mysql_query("SELECT alumno.al_rut, alumno.al_nombre, alumno.al_apaterno, alumno.al_amaterno,apoderado_alumno.aa_tipo_apoderado
						FROM `apoderado_alumno`
						INNER JOIN alumno ON alumno.al_rut = apoderado_alumno.aa_rut_alumno
						WHERE `aa_rut_apoderado` ='".$_SESSION['id_admin2']."'AND apoderado_alumno.aa_tipo_apoderado='0'",Conectar::conecta());
$consulta_apo_suplente=mysql_query("SELECT alumno.al_rut, alumno.al_nombre, alumno.al_apaterno, alumno.al_amaterno,apoderado_alumno.aa_tipo_apoderado
						FROM `apoderado_alumno`
						INNER JOIN alumno ON alumno.al_rut = apoderado_alumno.aa_rut_alumno
						WHERE `aa_rut_apoderado` ='".$_SESSION['id_admin2']."' AND apoderado_alumno.aa_tipo_apoderado='1'",Conectar::conecta());
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="../css/estilo.css">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-dropdown.js"></script>
	<script type="text/javascript">
		$('.dropdown-toggle').dropdown()
	</script>
	<style type="text/css">
		#derecha{
			float:right
		}
	</style>
</head>
<body>
	<a href="salir.php"><img src="../images/salir.png" alt="Salir"  /> </a>
	<div id="derecha">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> <?php echo $_SESSION['nombres']; ?> </a>
			<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="apoderado_editar.php?rut=<?php echo $_SESSION["id_admin2"]; ?>"><i class="icon-pencil"></i> Edit</a></li>
			</ul>
		</div>
	</div>

	<h3>Seleccione su pupilo</h3>
	<h4>Apoderado Titular de:</h4>

	<ul>
		<?php
		if(mysql_num_rows($consulta)!=0):
			while($resultado=mysql_fetch_array($consulta)):
	 	?>
			<li><a href="alumno_perfil.php?rut=<?php echo $resultado['al_rut'] ?>"> <?php echo $resultado['al_nombre'] . " ".$resultado['al_apaterno'] ." ".$resultado['al_amaterno']?> </a></li>
		<?php
			endwhile;
		else:
			echo "<li>No se encuentra una relacion como apoderado titular con algun alumno</li>";
		endif;
		 ?>
	</ul>
	<h4>Apoderado Suplente de: </h4>
	<ul>
	<?php
		if(mysql_num_rows($consulta)!=0):
			while($resultado_apo=mysql_fetch_array($consulta_apo_suplente)):
		 ?>
			<?php if($resultado_apo['aa_tipo_apoderado']==1): ?>
					<li><a href="alumno_perfil.php?rut=<?php echo $resultado_apo['al_rut'] ?>"> <?php echo $resultado_apo['al_nombre'] . " ".$resultado_apo['al_apaterno'] ." ".$resultado_apo['al_amaterno']?> </a></li>
			<?php endif; ?>
		<?php
			endwhile;
		else:
			echo "<li>No se encuentra una relacion como apoderado titular con algun alumno</li>";
		endif;
	 ?>
	</ul>

</body>
</html>