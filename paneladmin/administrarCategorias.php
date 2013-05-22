<div class="cajaAdministracion">
   <div class=" cajaTituloCategoria">
      <h2>Administrar Categorias</h2>
   </div>
   <div class=" cajaCrearCategoria">
      <button class="botonCrearCategoria"><i class="icon-plus-sign"></i> Nueva categoría</button>
   </div>
   <div class=" cajaFormularioNuevaCategoria">
      <label>Nueva categoría: </label><input type="text" id="nombreCategoria" placeholder="Nombre ...">
      <label>Descripción: </label>
      <textarea id="descripcionCategoria"></textarea><br/>
      <button class="crearCategoria"><i class="icon-plus"></i> Añadir</button>
   </div>
   <div class=" cajaContenidoCategoria">         
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

               use src\helpers\Header;
               use src\helpers\ManejadorBD;
               # Instanciar manejador bd
               $mbd = new ManejadorBD();
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
   <div class=" cajaFormularioEditarCategoria">
      <label>Editar categoría: </label><input type="text" id="editarNombreCategoria" placeholder="Nombre ...">
      <label>Descripción: </label>
      <textarea id="editarDescripcionCategoria"></textarea><br/>
      <button class="editarCategoria"><i class="icon-pencil"></i> Editar</button>
   </div>
</div>