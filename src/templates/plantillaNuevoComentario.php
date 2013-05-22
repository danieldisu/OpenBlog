 <form>
   <h3>Escribe tu comentario:</h3>
   <input type="hidden" id="idPost" value="<?php echo $post->getId(); ?>">
	<input type="hidden" id="autor" value="<?php echo $userid; ?>" disabled="disabled">
   <label>Texto</label>
   <textarea></textarea>
   <button class="btn botonEnviarComentario" id="botonEnviarComentario<?php echo $post->getId(); ?>">Enviar!</button>
 </form>