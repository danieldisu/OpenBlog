<?php
	
use src\helpers\ManejadorBD;
	
$m = new ManejadorBD();

$usuario = $m->getUsuario($comentario->getId());
$userName = $usuario->getNombre();
echo '<li>Por: <a href="#">'.$userName.'</a><br/>'.$comentario->getTexto().'</li>';
?>