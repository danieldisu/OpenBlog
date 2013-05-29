<?php
	include_once 'autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
        use src\helpers\pathGen;
	use src\helpers\Paginador;
  	use src\helpers\Login;

   // Iniciamos el manejador BD con las opciones del JSON
	$mbd = new ManejadorBD(Header::cargarJSON());
        pathGen::cargarRaiz();

  Header::iniciarSesion();

	if(!empty($_GET['p']))
		$pagina = $_GET['p'];
	else
		$pagina = 1;
?>
<!DOCTYPE html>
<html lang="es">
	<?php Header::cargarHead(false/*false == no es pagina admin*/); ?>
	<body>
	  <div class="container">
			<div class="row">
				<a href="<?php echo pathGen::pathHome(); ?>"><div class="span12 header">
                                        <img src="<?php echo pathGen::loadLogo() ?>">
					<h1><?php echo Header::$json["tituloBlog"] ?></h1>
				</div></a>
			</div><!-- /header -->

		<div class="row main">
			<div class="span9 contenido">
				<?php
					$posts = $mbd->getPostPagina($pagina);
					foreach ($posts as $post){
						include "src/templates/plantillaPost.php";
					}
				?>

			<div class="span9 contenido">
				<?php
					$paginador = new Paginador($mbd);
					$paginador->mostrarLinks();
				?>
			</div>
									
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
     </div><!-- /sidebar -->
   </div> <!-- /container -->

   <!-- Le javascript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="<?php echo pathGen::pathJs("jquery.js") ?>"></script>
   <script src="<?php echo pathGen::pathJs("funciones.js") ?>"></script>
   <script src="<?php echo pathGen::pathJs("bootstrap.js") ?>"></script>
</body>
</html>
