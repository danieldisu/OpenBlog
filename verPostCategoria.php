<?php
	include 'autoloader.php';
	use src\helpers\ManejadorBD;
	use src\helpers\Header;
        use src\helpers\pathGen;
  	use src\helpers\Login;	

	$mbd = new ManejadorBD(Header::cargarJSON());
        pathGen::cargarRaiz();
        if(isset($_GET['idCategoria']))
            $idCategoria = $_GET['idCategoria'];
        else
            Header::mostrarPaginaError("Categoria Incorrecta");
		
		//Comprobamos que la categoria existe, sino existe la posicion 0 vendrá vacia
		$id = $mbd->getCategoria($idCategoria);
		if(empty($id)){
		  Header::mostrarPaginaError("La categoria no existe");	
		}
	
	Header::iniciarSesion();

?>

<!DOCTYPE html>
<html lang="es">
	<?php Header::cargarHead(false/*false == no es pagina admin*/); ?>
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
			  <div class="cajaTituloCategoria">
			  <?php
				echo "<h1>";
				echo "Estás viendo los post de la categoría : ";
				echo "<span>" . $mbd->obtenerNombreCategoria($idCategoria) . "</span>" ;
				echo "</h1>";
			  ?>
			  </div>
				<?php
					$posts = $mbd->getPostsCategoria($idCategoria);
					foreach ($posts as $post){
					      include "src/templates/postEnLista.php";
					}
				?>

									
		</div>
		<div class="span3 sidebar">
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
