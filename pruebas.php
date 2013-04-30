<?php
	//require_once("src/helpers/ManejadorConfig.php");

	//$manejador = new ManejadorConfig();
	//print_r($manejador->cargarConfig());

	require_once("autoloader.php");

	use src\helpers\ManejadorConfig;

	$manejador = new ManejadorConfig();
	print_r($manejador->cargarConfig());
?>