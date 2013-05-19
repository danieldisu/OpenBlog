<tr class="filaComentario">
 <td>
 	<?php echo $categoria->getId(); ?>
 </td>
 <td>
   <?php echo $categoria->getNombre();?>
 </td>
 <td>
    <?php echo $categoria->getDescripcion();?>
 </td>

 <td>
 	<?php $posts = $mbd->getPostsCategoria($categoria->getId());
 		  $cantidadPosts = count($posts);
 		  echo $cantidadPosts;
 	?>
 </td>
 <td class="acciones"> 
   <button class="botonEditarCategoria" data-idCategoria="<?php echo $categoria->getId(); ?>"><i class="icon-pencil"></i>Editar</button>
   <?php 
   	if($categoria->getId() != 0){
   		# Añadir a la base de datos categoria id = 0
   ?>
   <button class="botonBorrarCategoria" data-idCategoria="<?php echo $categoria->getId(); ?>"><i class="icon-remove"></i>Borrar</button>
   <?php }?>
</tr>