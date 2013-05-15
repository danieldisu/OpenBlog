<?php
	include_once 'autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
	use src\helpers\Paginador;

   // Iniciamos el manejador BD con las opciones del JSON
	$mbd = new ManejadorBD(Header::cargarJSON());

	if(!empty($_GET['p']))
		$pagina = $_GET['p'];
	else
		$pagina = 1;
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>OpenBlog</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Le styles -->
		<?php Header::cargarHojasDeEstilos(); ?>	

		<!-- Favicon -->
		<link rel="shortcut icon" href="../resources/ico/favicon.ico">
	</head>

	<body>
	  <div class="container">
			<div class="row">
				<div class="span12 header">
					<img src="resources/betaLogo01.png">
					<h1><?php echo Header::$json["tituloBlog"] ?></h1>
				</div>
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
					$paginador = new Paginador();
					$paginador->mostrarLinks();
				?>
			</div>
									
		</div>
		<div class="span3 sidebar">
			<div class="cajaLogin">
			  <h3> Login </h3>
			  <label>Usuario</label>
			  <input type="text" id="inputUsuario">
			  <label>Contraseña</label>
			  <input type="password" id="inputPassword">
			  <input type="button" class="btn btn-block" value="Login">
			  <input type="button" class="btn btn-block" value="Registrarse">
			</div>

			<div class="cajaUltimosPost">
			  <h3> Ultimos Post </h3>
			  <ul>
					<?php 
					$posts = $mbd->obtenerUltimosPost();
					foreach ($posts as $post){
						include "src/templates/listaUltimosPostTemplate.php";
					}
					?>
					
			  </ul>
			</div>
         <div class="cajaUltimosComentarios">
           <h3> Ultimos Comentarios </h3>
           <ul>
             <?php 
                 $comentarios = $mbd->obtenerUltimosComentarios();       
                 foreach ($comentarios as $comentario) {
                   include "src/templates/listaUltimosComentariosTemplate.php";
                 }
                 
             ?>    
           </ul>            
         </div>
         <div class="cajaCategorias">
           <h3> Nube de categorías </h3>
           <ul>
             <?php 
                 $categorias = $mbd->obtenerCategorias();
                 $cantidades = array();
                 $i = 0;   //Variable para comprobar en listaCategoriasTemplate que es la ultima vuelta de bucle   
                 foreach ($categorias as $categoria) {
                   include "src/templates/listaCategoriasTemplate.php";
                 }
                 
             ?>    
           </ul>            
         </div>
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
