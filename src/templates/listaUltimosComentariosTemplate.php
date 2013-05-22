<?php
	$usuario = $mbd->getUsuario($comentario->getId());
	$userName = $usuario->getNombre();
	echo '<li>Por: <a href="#">'.$userName.'</a><br/>'.$comentario->getTexto().'</li>';
?>