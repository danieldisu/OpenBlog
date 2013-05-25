<?php
	$post['id'] = 1;
	$post['titulo'] = 'bla';
	$post['idCategoria'] = 2;
	$post['idUsuario'] = 3;

	$post = json_encode($post);

	$_POST['post'] = $post;

	include '../paneladmin/src/modificarPostEntero.php';


?>