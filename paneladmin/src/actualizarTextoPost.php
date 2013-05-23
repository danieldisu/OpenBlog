<?php
	include '../../autoloader.php';
	include '../../chromephp.php';

	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	$mbd = new ManejadorBD(Header::cargarJSON());

	if(!isset($_POST)){
		$json['resultado'] = false;
		echo json_encode($json);
		}	
	else{
		$texto = $_POST['texto'];
		$idPost = $_POST['idPost'];

		ChromePhp::log($idPost);
		ChromePhp::log($texto);

		$post = $mbd->getPost($idPost);

		$post->setTexto($texto);
		$modificaciones = $post->getModificaciones();
		$post->setModificaciones($modificaciones+1);

		# SETTEAR LA FECHA DE HOY A LA ULTIMA MODIFICACION!!

		if($mbd->updatePost($idPost, $post)){
			$json = $post->getJsonData();
			$json['resultado'] = true;
			echo json_encode($json);
		}else{
			$json['resultado'] = false;
			echo json_encode($json);
		}
	}
	
?>