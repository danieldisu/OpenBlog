<html>
  <head>
	<?php
	include 'autoloader.php';

	use src\helpers\Header;
	use src\helpers\ManejadorBD;

	Header::cargarHojasEstilosAdmin();
	?>
  </head>
  <body>
	<div class="container">
	  <div class="cajaMenu">	  
		<?php include 'paneladmin/menu.php'; ?>
	  </div>
	  <div class="cajaLoader">
	
	  </div> 
	</div>	

	<?php Header::cargarJsAdmin() ?>
  </body>
</html>

