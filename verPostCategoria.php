<?php
	include 'autoloader.php';
	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	$mbd = new ManejadorBD(Header::cargarJSON());
        if(isset($_GET['idCategoria']))
            $idCategoria = $_GET['idCategoria'];
        else
            Header::mostrarPaginaError("Categoria Incorrecta");
		
		//Comprobamos que la categoria existe, sino existe la posicion 0 vendrá vacia
		$id = $mbd->getCategoria($idCategoria);
		if(empty($id)){
		  Header::mostrarPaginaError("La categoria no existe");	
		}  
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
			  <div class="cajaTituloCategoria">
			  <?php
				echo "<h1>";
				echo "Categoria : ";
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
					$UltimosPosts = $mbd->obtenerUltimosPost();
					
					foreach ($UltimosPosts as $post){
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
