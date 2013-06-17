<?php
	include_once 'autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
        use src\helpers\pathGen;
	use src\helpers\Paginador;
  	use src\helpers\Login;

	$mbd = new ManejadorBD(Header::cargarJSON());
        pathGen::cargarRaiz();

	if(isset($_GET['id']))
            $id = $_GET['id'];
        else
            Header::mostrarPaginaError("Post incorrecto");
		
        $id = $mbd->getPost($id);
        if(empty($id)){
          Header::mostrarPaginaError("Se ha encontrado un error en la peticion");	
        }

	Header::iniciarSesion();

?>
<!DOCTYPE html>
<html lang="es">
	<?php Header::cargarHead(false); ?>;
	<body>
	  <div class="container">
			<div class="row">
				<div class="span12 header">
                                    <img src="<?php echo pathGen::loadLogo() ?>">
                                    <a href="<?php echo pathGen::pathHome(); ?>"><h1><?php echo Header::$json["tituloBlog"] ?></h1></a>
				</div>
			</div><!-- /header -->

		<div class="row main">
			<div class="span9 contenido">
				<?php
					$idPost = $_REQUEST['id'];
					$post = $mbd->getPost($idPost);
          $comentarios = $mbd->getAllComentarios($idPost);
					include "src/templates/plantillaPostUnico.php";
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
   <script src="<?php echo pathGen::pathJs("jquery.js") ?>"></script>
   <script src="<?php echo pathGen::pathJs("funciones.js") ?>"></script>
   <script type="<?php echo pathGen::pathJs("bootstrap.js") ?>"></script>
</body>
</html>
