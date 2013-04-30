<div class="cajaAdministracion row">
   <div class="span12 cajaTituloCategoria">
      <h2>Administrar Usuario</h2>
   </div>
   <div class="span12 cajaContenidoCategoria">
      <table class="table table-bordered table-striped">
         <thead>
            <tr>
               <th class="span1">ID</th>
               <th class="span2">Nombre</th>
               <th class="span5">Mail</th>
               <th class="span1">Acciones</th>
            </tr>
         </thead>   
         <tbody>
            <?php
               //Por cada post ->
               $i = 0;
               while($i < 10){
                  include "../template/usuarioTemplate.php";
                  $i++;
               }
            ?>
         </tbody>
         </table>       
   </div>   
</div>