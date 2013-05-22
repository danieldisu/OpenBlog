<?php
include '../autoloader.php';

use src\helpers\ManejadorBD;

$mbd = new ManejadorBD(src\helpers\Header::$json);
?>

<div class="cajaAdministracion" id="cajaAdministrarPosts">
  <div class="cajaTituloCategoria">
	<h2>Administrar Posts</h2>
  </div>
  <div class="cajaContenidoCategoria">
      <table class="table table-bordered table-striped listaPosts">
         <thead>
            <tr>
               <th class="span1">ID</th>
               <th class="span2">Titulo</th>
               <th class="span2">Texto</th>
               <th class="span2">FechaCreacion</th>
               <th class="span2">Categoria</th>
               <th class="span2">Usuario</th>
               <th class="span1">Modificaciones</th>
               <th class="span2">Ultima Modificacion</th>
               <th class="span4">Acciones</th>
            </tr>
         </thead>
			<?php
				$posts = $mbd->getAllPosts();
				foreach ($posts as $post) {
					include 'src/templates/templatePostLista.php';
				}
			?>
         <tbody>

         </tbody>
         </table>

		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="myModalLabel">Texto del Post: </h3>
		  </div>
		  <div class="modal-body">
		    
		  </div>
		  <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button class="btn botonModificarPost">Modificar</button>
		  </div>

	</div>         
  </div>
</div>