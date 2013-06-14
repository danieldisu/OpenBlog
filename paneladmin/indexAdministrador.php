<div class="cajaAdministracion row">
   <div class="span12 cajaTituloCategoria">
      <h2>Resumen</h2>
   </div>
</div>
<div class="cajaAdministracion row">
	<div class="span5">
	<?php
		include '../autoloader.php';
      use src\helpers\Sidebar;
      use src\helpers\ManejadorBD;
		use src\helpers\Header;

		$mbd = new ManejadorBD(Header::cargarJSON());

	   $comentarios = $mbd->obtenerUltimosComentarios();       
		include '../src/templates/sidebar/templateCajaUltimosComentarios.php';
	?>
	</div>
	<div class="span5">
	<?php
		$posts = $mbd->obtenerUltimosPost();
		include '../src/templates/sidebar/templateCajaUltimosPost.php';
	?>	
	</div>
</div>
<div class="cajaAdministracion row">
  <div id="chartContainer" style="height: 300px; width: 500px;display:inline-block;"></div>
</div>


