<?php
	include_once 'autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
	use src\helpers\Paginador;
  	use src\helpers\Login;

   // Iniciamos el manejador BD con las opciones del JSON
	$mbd = new ManejadorBD(Header::cargarJSON());

  Header::iniciarSesion();

?>
<!DOCTYPE html>
<html lang="es">
	<?php Header::cargarHead(false/*false == no es pagina admin*/); ?>;
	<body>
	  <div class="container">
			<div class="row">
				<div class="span12 header">
					<img src="resources/betaLogo01.png">
					<a href="index.php"><h1><?php echo Header::$json["tituloBlog"] ?></h1></a>
				</div>
			</div><!-- /header -->

		<div class="row main">
			<div class="span9 contenido">
				<?php
					$idPost = $_REQUEST['id'];
					$post = $mbd->getPost($idPost);
					include "src/templates/plantillaPost.php";
				?>
									
		</div>
		<div class="span3 sidebar"><!-- sidebar -->
      <?php
      	use src\helpers\Sidebar;

      	Sidebar::addCajaLogin();

      	Sidebar::addCajaUltimosPost($mbd);

      	Sidebar::addCajaUltimosComentarios($mbd);

      	Sidebar::addCajaCategorias($mbd);

      ?>  
       </div>
     </div>
   </div> <!-- /container -->

   <!-- Le javascript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="resources/js/jquery.js"></script>
   <script src="resources/js/funciones.js"></script>
   <script type="resources/js/bootstrap.js"></script>
</body>
</html>
