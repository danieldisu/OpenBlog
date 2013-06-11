<?php
	include '../../autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
	use src\helpers\pathGen;


	
	$idPost = $_REQUEST['idPost'];
	$m = new ManejadorBD(Header::cargarJSON());
	$comentarios = $m->obtenerUltimosComentarios($idPost);
	$numPostMostrados = 0;
	if(!empty($comentarios)){
		foreach ($comentarios as $comentario) {
			$numPostMostrados ++;
			$usuario = $m->getUsuario($comentario->getIdUsuario());
			$userName = $usuario->getNombre();
			echo '<div class="comentario"><span class="autorComentario">'.$userName.'</span>'.'  <span class="fechaComentario">'.$comentario->getFecha().'</span> <br/>'.$comentario->getTexto().'</div>';
			if($numPostMostrados >= 5){
				echo '<br/><a href="'.pathGen::pathVerPost($idPost).'">Ver más comentarios...</a>';
			}
		}
	}
	else{
		echo '<br/><a href"#">¡Se el primero en comentar!</a>';	
	}
?>