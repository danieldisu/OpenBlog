<?php
	require_once("../autoloader.php");

	$_POST['idPost'] = 5;
	$_POST['autor'] = 1;
	$_POST['textoComentario'] = "Esto es un comentario random blablabla";

	include_once("../nuevoComentario.php");


?>