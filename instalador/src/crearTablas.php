<?php
	//error_reporting(1);

	include '../../autoloader.php';

	use src\helpers\Instalador;
	use src\helpers\Header;
	use src\helpers\ManejadorConfig;

	// Extraer la configuracion de una cookie o tenerla almacenada en el javascript
	$mconfig = new ManejadorConfig();
	$config = $mconfig->cargarConfig();

	try{
		$instalador = new Instalador($config);
	}catch(Exception $e){
		devolverRespuesta( 1, 'Error en la conexion con la BD' );
	}

	$instalador->borrarTablas();

	$instalador->crearTablas();
	
	if($instalador->checkTablas()){
		devolverRespuesta('2', 'Se han creado las tablas con exito');
	}else{
		devolverRespuesta('1', 'Error al crear las tablas');
	}

	function devolverRespuesta( $codigo, $mensaje ){
		$respuesta = array();
		$respuesta['codigo'] = $codigo;
		$respuesta['mensaje'] = $mensaje;
		echo json_encode($respuesta);
	}

?>