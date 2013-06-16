<?php

include '../../autoloader.php';
use src\helpers\ManejadorBD;
use src\helpers\Header;
use src\entidades\Rol;

$mbd = new ManejadorBD(Header::cargarJSON());

$nombreRol = $_POST['nombreRol'];
$descripcion = $_POST['descripcion'];

$nuevoRol = new Rol();

$nuevoRol->setNombre($nombreRol);
$nuevoRol->setDescripcion($descripcion);

if($mbd->createRol($nuevoRol)){
	echo 1;
}