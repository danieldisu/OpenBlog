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
	<script>if (location.hostname === "192.168.1.10") { document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=2"></' + 'script>') }</script>
  </body>
</html>

