<?php
	include '../../autoloader.php';
	
	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	$mbd = new ManejadorBD(Header::cargarJSON());

	$Usuarios = $mbd->getAllUsuarios();
	$listaUsuarios = array();

	foreach ($Usuarios as $usuario) {
		$user['nombre'] = $usuario->getNombre();
		$user['id'] = $usuario->getId();
		array_push($listaUsuarios, $user);
	}
	
	echo json_encode($listaUsuarios);
?>