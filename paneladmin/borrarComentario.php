<?php
	include '../autoloader.php';

	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	if(!isset($_POST) || empty($_POST)){
		Header::mostrarPaginaError('Se ha encontrado un error con la peticion');
	}
	echo '<link href="../resources/css/bootstrap.css" rel="stylesheet">';

	$idComentario = $_POST['idComentario'];

	$mbd = new ManejadorBD(Header::cargarJSON());

	echo "<div style='width:90%;margin:auto;margin-top:20px; text-align:center;font-size:150%;'>";
	$referringSite = $_SERVER['HTTP_REFERER'];
	if($mbd->deleteComentario($idComentario) == 1){
		echo "<div class='alert alert-success'> Se ha eliminado el comentario </div>";
		echo "<a href='$referringSite'>Volver </a>";
	}else{
		echo "<div class='alert alert-error'> Se ha encontrado un error </div>";
		echo "<a href='$referringSite'>Volver </a>";
	}
	echo "</div>";
?>