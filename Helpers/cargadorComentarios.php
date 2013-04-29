<?php
	require_once("ManejadorBD.php");
	$idPost = $_REQUEST['idPost'];
	$mbd = new ManejadorBD();
	$comentarios = $mbd->obtenerUltimosComentarios($idPost);
	foreach ($comentarios as $comentario) {
		echo '<li>Por: <a href="#">'.$comentario['nombre'].'</a><br/>'.$comentario['texto'].'</li>';
	}
		echo '<a href"#">Ver más comentarios...</a>';
?>