<?php
	include '../../autoloader.php';

	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	if(isset($_GET) && !empty($_GET['idPost'])){
		$mbd = new ManejadorBD(Header::cargarJSON());
		$post = $mbd->getPost($_GET['idPost']);
		echo json_encode($post->getJsonData());
	}else{
		echo false;
	}

?>