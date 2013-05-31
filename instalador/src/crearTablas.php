<?php
	//error_reporting(1);

	include '../../autoloader.php';

	use src\helpers\Instalador;
	use src\helpers\Header;

	// Extraer la configuracion de una cookie o tenerla almacenada en el javascript
	$config['host'] = '127.0.0.1';
	$config['user'] = 'root';
	$config['pass'] = '';
	$config['bd']   = 'openblog';


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