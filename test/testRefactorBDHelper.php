<?php
	include '../autoloader.php';
	include '../ChromePhp.php';
	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	$mbd = new ManejadorBD(Header::cargarJSON());
	
	$post = $mbd->getPost(1);
	
	//print_r($post);
	
	$posts = $mbd->getAllPosts();
	
	echo '<pre>';
	print_r($posts);
	echo '</pre>';
?>