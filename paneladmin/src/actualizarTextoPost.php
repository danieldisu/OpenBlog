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

		
		

		$post = $mbd->getPost($idPost);

		$post->setTexto($texto);
		$modificaciones = $post->getModificaciones();
		$post->setModificaciones($modificaciones+1);
		$fechaModificacion = date("Y-m-d H:i:s");
		$post->setFechaModificacion($fechaModificacion);
		ChromePhp::log($post);
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