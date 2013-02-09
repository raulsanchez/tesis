<header>
	<div id="logo">
		<a href="index.php"><img src="images/logo.png" alt="Logo"></a>
	</div>
	<div id="perfil">
		<a href="">
		<div id="usuario">
			<div class="foto">
					<img src="images/usuario_defecto.png"  alt="Foto usuario" />
			</div>
			<div class="datos">
				<span><?php echo $_SESSION['nombrecom']; ?></span>
			</div>
		</div>
		</a>
		<div id="salir">
			<a href="salir.php"><img src="images/salir.png" alt="Salir"  /> </a>
		</div>
	</div>
</header>