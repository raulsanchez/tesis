<?php
require 'conectar.class.php';

Class Alumno{
	Public function View_Alumno(){
		$sql=mysql_query('SELECT * FROM alumno',Conectar::conecta());
		while($resultado=mysql_fetch_array($sql)):
			$i=0;
			echo $i;
			echo $resultado[$i] . "algoooo";
			$i++;
		endwhile;
		echo "Inserta los datos del alumno";
		return true;
	}
}