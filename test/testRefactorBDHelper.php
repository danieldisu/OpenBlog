<?php
	include '../autoloader.php';
	include '../ChromePhp.php';
	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	$mbd = new ManejadorBD(Header::cargarJSON());
	
	$post = $mbd->getPost(1);
	
	//print_r($post);
	
	
	echo '<pre>';
	print_r($post->getId());
	echo '</pre>';
?>