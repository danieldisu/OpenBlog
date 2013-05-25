<tr class="filaPost">
<td>
	<?php echo $post->getId(); ?>
</td>
<td>
	<a href="verPost.php?id=<?php echo $post->getId(); ?>"><?php echo $post->getTitulo(); ?></a>
</td>
<td class="tdTextoPost">
	<button class="btn btn-small botonVerTexto"> ver Texto </button><pre style="display:none"><?php echo $post->getTexto(); ?></pre> 
</td>
<td>
	<?php echo $post->getFechaCreacion(); ?>
</td>
<td>
	<?php echo $nombreCategoria ?>
</td>
<td>
	<?php echo $nombreUsuario ?>
</td>
<td>
	<?php echo $post->getModificaciones(); ?>
</td>
<td>
	<?php echo $post->getFechaModificacion(); ?>
</td>
<td class="columnaAcciones">
    <a href="#myModal" class="btn btn-warning botonEditarPost" data-idpost="<?php echo $post->getId(); ?>"><i class="icon-pencil icon-white"></i> Editar</a>
    <a class="btn btn-danger botonBorrarPost" data-idpost="<?php echo $post->getId(); ?>"><i class="icon-remove-sign icon-white" ></i> Borrar</a>
</td>
</tr>

