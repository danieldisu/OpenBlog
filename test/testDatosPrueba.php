<?php
	/*
	*	Para cargar los datos de prueba hace falta cambiar la contraseña en instalador y en ManejadorBD
	*/
	require_once("../autoloader.php");

	use src\helpers\DatosPrueba;

	$dp = new DatosPrueba();
	$dp->resetearTablas();
	$dp->datosRapidos();

	echo "En teoria ya deberian estar los datos insertados";
?>
