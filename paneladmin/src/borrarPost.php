<?php
	include '../../autoloader.php';
	use src\helpers\ManejadorBD;
	use src\helpers\Header;


	if(empty($_POST['idPost'])){
		Header::mostrarPaginaError('Se ha encontrado un error con la peticion');
	}

	$idPost = $_POST['idPost'];

	$mbd = new ManejadorBD(Header::cargarJSON());

	if($mbd->deletePost($idPost) == 1){
		echo true;
	}else{
		echo false;
	}

?>