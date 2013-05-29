<?php
error_reporting(0);  //Nos aseguramos que no se muestren errores de conexión, de manera que solo los veamos si queremos nosotros

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
	$mbd = new PDO("mysql:host=$host;dbname=$bd", $user, $pass);	// nos intentamos conectar con los datos que nos ha proporcionado el usuario
}catch(PDOException $e){
	if($e->getCode() == 1049){		// Si el error que da es 1049 significa que es problema de que la BD no existe
		$mbd = conectarAPredeterminada($host, $user, $pass); 	// Nos conectamos a la DB de mysql para desde ahí crear la db original MEJORABLE
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
	$sth = $mbd->exec("CREATE DATABASE ".$bd);	// Si no hemos tenido ningun error a la hora de borrar la bd creamos una nueva
}else{
	$sth = $mbd->exec("CREATE DATABASE ".$bd);	// Si no hemos tenido ningun error a la hora de borrar la bd creamos una nueva
}

if(existeBD($mbd, $bd)){
	$respuesta['codigo'] = 2;
	$respuesta['mensaje'] = 'Se ha creado correctamente la base de datos';
}else{
	$respuesta['codigo'] = 1;
	$respuesta['mensaje'] = 'Error al crear la base de datos';
}


echo json_encode($respuesta);


function existeBD($mbd ,$bd){
	try{
		$sth = $mbd->exec("USE ".$bd);	// Si no hemos tenido ningun error a la hora de borrar la bd creamos una nueva
		return true;
	}catch(PDOException $e){
		return false;
	}	
}


/*
	Podriamos ampliar esta funcion en el futuro haciendo una query para saber las BD's a las que tiene acceso el usuario e intentandonos conectar a alguna
*/
function conectarAPredeterminada($host, $user, $pass){
	$mbd = new PDO("mysql:host=$host;dbname=mysql", $user, $pass);
	return $mbd;
}



?>
