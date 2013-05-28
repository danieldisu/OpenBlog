<div class="cajaAdministracion">
   <div class=" cajaTituloCategoria">
      <h2>Administrar Categorias</h2>
   </div>
   <div class=" cajaCrearCategoria">
      <button class="btn botonCrearCategoria"><i class="icon-plus-sign"></i> Nueva categoría</button>
   </div>
   <div id="modalNuevaCategoria" class="modal hide fade">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h3>Nueva categoría</h3>
     </div>
     <div class="modal-body">
       <div class="cajaFormularioNuevaCategoria">
         <label>Nombre categoría: </label><input type="text" id="nombreCategoria" placeholder="Nombre ...">
         <label>Descripción: </label>
         <textarea id="descripcionCategoria"></textarea><br/>
      </div>
     </div>
     <div class="modal-footer">
         <button class="btn crearCategoria"><i class="icon-plus"></i> Añadir</button>
     </div>
   </div>

   
   <div class="cajaContenidoCategoria">         
      <table class="table table-bordered table-striped">
         <thead>
            <tr>
               <th class="span1">ID</th>
               <th class="span2">Nombre</th>
               <th class="span5">Descripcion</th>
               <th class="span2">Número de post</th>
               <th class="span3">Acciones</th>
            </tr>
         </thead>   
         <tbody>
            <?php
               include '../autoloader.php';
               use src\helpers\ManejadorBD;
               use src\helpers\Header;

               $json = Header::cargarJSON();
               $mbd = new ManejadorBD($json);
               
               # Instanciar manejador bd
              
               # Consulta de categorias
               # Por cada categoria ->
               $categorias = $mbd->getAllCategorias();
               
               foreach($categorias as $categoria){
                  # Muestro una fila de tabla. 
                  include "../src/templates/categoriaTemplate.php";
               }
            ?>
         </tbody>
         </table>       
   </div>
   <div id="modalEditarCategoria" class="modal hide fade">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h3>Editar categoría</h3>
      </div>
      <div class="modal-body">
         <div class="cajaFormularioEditarCategoria">
            <label>Nombre categoría: </label><input type="text" id="editarNombreCategoria" placeholder="Nombre ...">
            <label>Descripción: </label>
            <textarea id="editarDescripcionCategoria"></textarea><br/>
         </div>
      </div>
      <div class="modal-footer">
         <button class="btn editarCategoria"><i class="icon-pencil"></i> Editar</button>
      </div>
   </div>
   
</div>