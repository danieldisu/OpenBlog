<tr class="filaPost">
<td>
	<?php echo $post->getId(); ?>
</td>
<td>
	<a href="verPost.php?id=<?php echo $post->getId(); ?>"><?php echo $post->getTitulo(); ?></a>
</td>
<td>
	<a href="#myModal" role="button" class="btn btn-small" data-toggle="modal" data-idPost='<?php echo $post->getId(); ?>'>Ver/Modificar Texto Post</a><code class="textoPost"><?php echo $post->getTexto(); ?> </code>
</td>
<td>
	<?php echo $post->getFechaCreacion(); ?>
</td>
<td>
	<?php echo $post->getIdCategoria(); ?>
</td>
<td>
	<?php echo $post->getIdUsuario(); ?>
</td>
<td>
	<?php echo $post->getModificaciones(); ?>
</td>
<td>
	<?php echo $post->getFechaModificacion(); ?>
</td>
<td>
	Acciones
</td>
</tr>

