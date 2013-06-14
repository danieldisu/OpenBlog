<?php
	include '../../autoloader.php';
	
	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	$mbd = new ManejadorBD(Header::cargarJSON());

	

	$categorias = $mbd->getAllCategorias();
	$listaCategorias = array();

	$i = 0;

	foreach ($categorias as $categoria) {	
		array_push($listaCategorias, $categoria->getJsonData());
		$listaCategorias[$i]['numPosts'] = $mbd->obtenerNumPostPorCategoria($categoria->getId());
		$i++;
	}

	$listaCategorias['totalPosts'] = $mbd->getNumeroTotalPosts();
	$listaCategorias['totalCategorias'] = $i;

	echo json_encode($listaCategorias);

?>