<tr class="filaPost">
<td>
	<?php echo $post->getId(); ?>
</td>
<td>
	<?php echo $post->getTitulo(); ?>
</td>
<td>
	<a href="#myModal" role="button" class="btn" data-toggle="modal" data-idPost='<?php echo $post->getId(); ?>'>Ver Texto Post</a><code class="textoPost"><?php echo $post->getTexto(); ?> </code>
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

