<?php
	include_once '../autoloader.php';

	use src\helpers\Header;
	use src\helpers\ManejadorBD;
  	use src\helpers\pathGen;
	pathGen::cargarRaiz();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>OpenBlog</title>
	<link rel="shortcut icon" href="<?php echo pathGen::pathIco("favicon.ico") ?>">
	<link href="<?php echo pathGen::pathCss('fuentes.css') ?>" rel="stylesheet">
	<link href="<?php echo pathGen::pathCss('instalador.css') ?>" rel="stylesheet">
	<link href="<?php echo pathGen::pathCss('bootstrap.css') ?>" rel="stylesheet">
</head>

<body>
	<div class="contenedor">
		<div class="seccion header">
			<h1>Instalador OpenBlog</h1>
		</div><!-- /header -->

		<div class="seccion main">
				CONTENIDO
		</div>	<!-- /main Section -->

		<div class="seccion footer">
			<div class="cajaBotonesFooter">
				<button class="btn btn-big">Anterior</button>
				<button class="btn btn-big">Siguiente</button>
			</div>
			Footer
		</div><!-- /footer -->
	</div> <!-- /contenedor -->

   <!-- Le javascript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="<?php echo pathGen::pathJs("jquery.js") ?>"></script>
   <script src="<?php echo pathGen::pathJs("instalador.js") ?>"></script>
   <script src="<?php echo pathGen::pathJs("bootstrap.js") ?>"></script>
</body>
</html>

