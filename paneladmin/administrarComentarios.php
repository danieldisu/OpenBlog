<?php
	include '../autoloader.php';

	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	if(!isset($_GET) || empty($_GET)){
		Header::mostrarPaginaError('Se ha encontrado un error con la peticion');
	}
	echo '<link href="../resources/css/bootstrap.css" rel="stylesheet">';
	echo '<link href="../resources/css/fuentes.css" rel="stylesheet">';

	$json = Header::cargarJSON();

	$rutaCSS = $json['rutaCss'];

	echo '<link href="../' . $rutaCSS . '" rel="stylesheet">';
	$idPost = $_GET['idPost'];

	$mbd = new ManejadorBD($json);

	$comentarios = $mbd->getAllComentarios($idPost);

	
?>


<div class='cajaAdministracionComentarios'>
   <h2> Mostrando Comentarios del Post: <a href="../verPost.php?id=<?php echo $idPost ?>"><?php
   	echo $mbd->getPost($idPost)->getTitulo();
   ?></a></h2>
   	
   <table class="table table-bordered table-striped listaPosts">
	   <thead>
	      <tr>
	         <th class="span2">Comentario</th>
	         <th class="span2">Escrito por:</th>
	         <th class="span2">Acciones</th>
	      </tr>
	   </thead>
	<?php
		foreach ($comentarios as $comentario) {
			$idComentario = $comentario->getId();
			$idPost = $comentario->getIdPost();
			echo "<tr>";
				echo "<td>";
					echo $comentario->getTexto();
				echo "</td>";
				echo "<td>";
					echo $mbd->getUsuario($comentario->getIdUsuario())->getNombre();
				echo "</td>";
				echo "<td>";
				?>	
				<form action="borrarComentario.php" method="POST">
					<input type="hidden" name="idComentario" value="<?php echo $idComentario; ?>">
					<input class="btn" type="submit" value="BorrarComentario">
				</form>	
				<?php
				echo "</td>";								
			echo "</tr>";
		}
	?>	   
   </table>

</div>