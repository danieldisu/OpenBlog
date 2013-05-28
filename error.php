<?php 
	include 'autoloader.php';
	use src\helpers\Header;
        use src\helpers\pathGen;
        
        pathGen::cargarRaiz();
?>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo pathGen::pathCss("error.css"); ?>">
</head>
<div class="container">
	<div class="cajaError">
		<div id="cajaTipo" class="cajaContenidoError">
			<label>Tipo:</label>
			<span class="tipoError">
				<?php echo traduccionCodigosError($_GET['c']); ?>
			</span>
		</div>
		<div id="cajaMensaje" class="cajaContenidoError">
			<label>Mensaje:</label>
			<span class="tipoError">
				<?php echo $_GET['error']; ?>
			</span>
		</div>
	</div>
	<div class="cajaLinkVolver">
            <a href="<?php echo pathGen::pathHome(); ?>">Volver</a>
	</div>
</div>
<?php
	function traduccionCodigosError($cod){
		switch ($cod) {
			case 1:
				return "Error Generico";
				break;
			default:
				return "Error Generico";
				break;
		}
	}
?>