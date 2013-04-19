<?php
	/*
		Para cargar los datos de prueba hace falta cambiar la contraseña en instalador y en ManejadorBD
	*/
    require_once("../Helpers/DatosPrueba.php");
    $dp = new DatosPrueba();
    $dp->resetearTablas();
    $dp->datosRapidos();
?>
