<div class="cajaAdministracion row">
   <div class="span12 cajaTituloCategoria">
      <h2>Administrar Entradas</h2>
   </div>
   <div class="span12 cajaContenidoCategoria">
      <table class="table table-bordered table-striped">
         <thead>
            <tr>
               <th>ID</th>
               <th>Titulo</th>
               <th>Contenido</th>
               <th>Categoria</th>
               <th>Fecha</th>
               <th>Modificado</th>
               <th>Autor</th>
               <th>Acciones</th>
            </tr>
         </thead>   
         <tbody>
            <?php
               
               $i = 0;
               while($i < 10){
                  include "../template/entradaTemplate.php";
                  $i++;
               }
            ?>
         </tbody>
         </table>      
   </div>
</div>
<div class="cajaAdministracion cajaComentarios row">
   <div class="span12 cajaTituloCategoria">
      <h2>Comentarios en el Post 5</h2>
      <table class="table table-bordered table-striped">
         <thead>
            <tr>
               <th class="span1">ID</th>
               <th class="span1">Usuario</th>
               <th class="span10">Texto</th>
               <th class="span1">Acciones</th>
            </tr>
         </thead>   
         <tbody>
            <?php
               
               $i = 0;
               while($i < 10){
                  include "../template/comentarioTemplate.php";
                  $i++;
               }
            ?>
         </tbody>
         </table>       
   </div>   
</div>