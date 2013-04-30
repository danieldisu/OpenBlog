<?php
	require_once("../autoloader.php");


	use src\helpers\ManejadorConfig;
	use src\helpers\ManejadorBD;

	$manejador = new ManejadorConfig();
	print_r($manejador->cargarConfig());

	$manejadorBD = new ManejadorBD();
	$posTT = $manejadorBD->getPost(1);
	print_r($posTT);
?>