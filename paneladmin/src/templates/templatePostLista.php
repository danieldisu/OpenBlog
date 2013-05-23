<tr class="filaPost">
<td>
	<?php echo $post->getId(); ?>
</td>
<td>
	<a href="verPost.php?id=<?php echo $post->getId(); ?>"><?php echo $post->getTitulo(); ?></a>
</td>
<td>
	<a href="#myModal" role="button" class="btn btn-info" data-toggle="modal" data-idPost='<?php echo $post->getId(); ?>'>Ver/Modificar Texto Post</a><code class="textoPost"><?php echo $post->getTexto(); ?> </code>
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
    <a href="#myModal" data-toggle="modal" class="btn btn-dangerbotonBorrarPost" data-idpost="<?php echo $post->getId(); ?>"><i class="icon-remove-sign icon-white" ></i> Borrar</a>
</td>
</tr>

