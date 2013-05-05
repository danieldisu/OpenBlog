<?php
	include '../../autoloader.php';
	
	use src\helpers\ManejadorBD;
	
	$idPost = $_REQUEST['idPost']; 
	$m = new ManejadorBD();
	$comentarios = $m->obtenerUltimosComentarios($idPost);
	if(!empty($comentarios)){
		foreach ($comentarios as $comentario) {
			echo '<div class="comentario"><span class="autorComentario">'.$comentario['nombre'].'</span>'.'  <span class="fechaComentario">'.$comentario['fecha'].'</span> <br/>'.$comentario['texto'].'<br/><a href="#">Responder...</a></div>';
	}
		echo '<br/><a href"#">Ver más comentarios...</a>';
	}
	else{
		echo '<br/><a href"#">¡Se el primero en comentar!</a>';	
	}
?>