<?php
include 'alumno.php';
include ("alumno.php");
require 'alumno.php';
for ($i=0; $i < 10 ; $i++) {
	$arrayName[]=$i;
	echo $i;
}

print_r($arrayName);
?>