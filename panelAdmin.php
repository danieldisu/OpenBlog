<html>
  <head>
  	<meta charset="utf-8">
	<?php
	include 'autoloader.php';

	use src\helpers\Header;
        use src\helpers\pathGen;
	use src\helpers\ManejadorBD;
        pathGen::cargarRaiz();
	Header::cargarHojasEstilosAdmin();
	?>
  </head>
  <body>
  	<?php session_start();?>
	<div class="container">
	<div class="cajaAlertas"></div>
	  <div class="cajaMenu">	  
		<?php include 'paneladmin/menu.php'; ?>
	  </div>
	  <div class="cajaLoader">
	
	  </div> 
	</div>	

	<?php Header::cargarJsAdmin() ?>
  </body>
</html>


