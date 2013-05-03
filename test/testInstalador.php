<?php
	require_once("../autoloader.php");
	use src\helpers\Instalador;

	$instalador = new Instalador();
	$instalador->crearBD();
	$instalador->borrarEstructuraTablas();
	$instalador->crearEstructuraTablas();
	
	

	echo "Si todo ha ido bien y ves este mensaje ya deberian estar las tablas creadas";

?>
