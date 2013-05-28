<?php
	include '../../autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
	
	$idPost = $_REQUEST['idPost'];
	$m = new ManejadorBD(Header::cargarJSON());
	$comentarios = $m->obtenerUltimosComentarios($idPost);
	if(!empty($comentarios)){
		foreach ($comentarios as $comentario) {
			$usuario = $m->getUsuario($comentario->getIdUsuario());
			$userName = $usuario->getNombre();
			echo '<div class="comentario"><span class="autorComentario">'.$userName.'</span>'.'  <span class="fechaComentario">'.$comentario->getFecha().'</span> <br/>'.$comentario->getTexto().'<br/><a href="#">Responder...</a></div>';
		}
		echo '<br/><a href"#">Ver más comentarios...</a>';
	}
	else{
		echo '<br/><a href"#">¡Se el primero en comentar!</a>';	
	}
?>