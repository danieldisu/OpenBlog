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
               <th class="span4">Titulo</th>
               <th class="span5">Texto</th>
               <th class="span2">FechaCreacion</th>
               <th class="span2">Categoria</th>
               <th class="span2">Usuario</th>
               <th class="span1">Modificaciones</th>
               <th class="span2">Ultima Modificacion</th>
               <th class="span2">Acciones</th>
            </tr>
         </thead>
			<?php
				$posts = $mbd->getAllPosts();
				foreach ($posts as $post) {
          $nombreCategoria = $mbd->obtenerNombreCategoria($post->getIdCategoria());
          $nombreUsuario = $mbd->getUsuario($post->getIdUsuario())->getNombre();
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
        <button class="btn botonVolver"> Volver </button>
		    <button class="btn" data-dismiss="modal" aria-hidden="true"> Cerrar </button>
        <button class="btn botonGuardarModificaciones btn-warning" data-postentero="true">Guardar Modificaciones</button>
        <button class="btn botonGuardarTexto btn-warning"> Guardar y Volver</button>
		  </div>

	 </div>    
  
  <div class="formularioModificarPost" style="display:none">
    <input type="hidden" id="idpost">
  
    <label>Titulo:</label>
    <div>
      
    
     <input type="text" id="titulo">
    
    </div>
    <label>Categoria</label>
    <select id="categorias">
      
    </select>
    <label>Usuario:</label>
    <select id="usuarios">
      
    </select>
    <div>
      <pre id="texto">
        
      </pre>

      <a role="button" class="btn btn-info botonModificarTextoPost" data-idpost="">Modificar Texto</a>
    </div>
 

  </div>

  <script src="resources/js/listaPost.js"></script>
</div>