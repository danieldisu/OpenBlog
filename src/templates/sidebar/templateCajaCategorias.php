<div class="cajaCategorias">
 <h3> Nube de categorías </h3>
 <ul>
   <?php 
     $categorias = $mbd->obtenerCategorias();
     $cantidades = array();
     $i = 0;   //Variable para comprobar en listaCategoriasTemplate que es la ultima vuelta de bucle   
     foreach ($categorias as $categoria) {
       include "src/templates/listaCategoriasTemplate.php";
     }
   ?>    
 </ul>            
</div>