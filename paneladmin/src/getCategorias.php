<?php
	include '../../autoloader.php';
	
	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	$mbd = new ManejadorBD(Header::cargarJSON());

	$categorias = $mbd->getAllCategorias();
	$listaCategorias = array();

	foreach ($categorias as $categoria) {
		array_push($listaCategorias, $categoria->getJsonData());
	}
	
	echo json_encode($listaCategorias);
?>