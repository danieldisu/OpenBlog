<?php
	error_reporting(0);

	require '../../autoloader.php';

	use src\helpers\ManejadorConfig;

	$user = $_POST['user'];
	$host = $_POST['host'];
	$pass = $_POST['pass'];

	if(empty($_POST['bd'])){
		$bd = "openblog";
	}else{
		$bd = $_POST['bd'];
		$bd = filter_var($bd,FILTER_SANITIZE_STRING);
	}


$respuesta = array();

try {
	$mbd = new PDO("mysql:host=$host;dbname=$bd", $user, $pass);	
}catch(PDOException $e){
	if($e->getCode() == 1049){		
		$mbd = conectarAPredeterminada($host, $user, $pass); 	
	}else{
		$respuesta['codigo'] = 1;		
		$respuesta['mensaje'] = $e->getMessage();
		die(json_encode($respuesta));
	}
}
$existeBD = true;


$existeBD = existeBD($mbd, $bd);

if($existeBD){
	try{
		$sth = $mbd->exec("DROP DATABASE ".$bd);
	}catch(PDOException $e){
		echo "error";
		$respuesta['codigo'] = 1;
		$respuesta['mensaje'] = 'Error al crear la base de datos';
		die(json_encode($respuesta));
	}
	crearBD($mbd, $bd, $host, $user ,$pass );	
}else{
	crearBD($mbd, $bd, $host, $user ,$pass);	
}

if(existeBD($mbd, $bd)){
	$respuesta['codigo'] = 2;
	$respuesta['mensaje'] = 'Se ha creado correctamente la base de datos';
}else{
	$respuesta['codigo'] = 1;
	$respuesta['mensaje'] = 'Error al crear la base de datos';
}


echo json_encode($respuesta);

function crearBD($mbd, $bd, $host, $user ,$pass){
	$mconfig = new ManejadorConfig();

	if(!is_writable($mconfig->getPrivateRutaConfig())){	
		$respuesta['codigo'] = 1;
		$respuesta['mensaje'] = 'Hacen falta permisos para escribir el archivo de configuración';
		die(json_encode($respuesta));
	}else{
		guardarDatosConfiguracion($mconfig, $bd, $host, $user ,$pass);
		$sth = $mbd->exec("CREATE DATABASE ".$bd);
	}
}

function existeBD($mbd ,$bd){
	try{
		$sth = $mbd->exec("USE ".$bd);	
		return true;
	}catch(PDOException $e){
		return false;
	}	
}

function guardarDatosConfiguracion($mconfig, $bd, $host, $user ,$pass){
	$configuracion = $mconfig->cargarConfig();
	$configuracion['nombreBd'] = $bd;
	$configuracion['host'] = $host;
	$configuracion['user'] = $user;
	$configuracion['pass'] = $pass;
	$mconfig->guardarConfig($configuracion);
}

function conectarAPredeterminada($host, $user, $pass){
	$mbd = new PDO("mysql:host=$host;dbname=mysql", $user, $pass);
	return $mbd;
}



?>
