<div class="post">
  <div class="cajaTituloPost">
    <h3><?php echo $post->getTitulo(); ?></h3>
  </div>
  <div class="cajaInfo row">
    <div class="cajaAutorPost span2">
      <span><?php echo $mbd->obtenerNombreAutor($post->getIdUsuario()); ?></span>
    </div>

    <div class="cajaFechaPost span2 ">
      <span><?php echo $post->getFechaCreacion(); ?></span>
    </div>
    <div class="cajaCategoriaPost span2 ">
      <span><?php echo $mbd->obtenerNombreCategoria($post->getIdCategoria()); ?></span>
    </div>
    <div class="cajaNumeroComentarios span2 ">
      <span><?php echo "Nº de comentarios: ".$mbd->obtenerNumeroComentarios($post->getId()); ?></span>
    </div>
  </div>

  <div class="cajaContenidoPost">
    <p><?php echo $post->getTexto(); ?></p>
  </div>
  <div class="row cajaAcciones">
    <div class="cajaVerComentarios span3 offset1">
      <button class="btn btnComentarios" id="<?php echo $post->getId() ?>">Ver Comentarios</button>
    </div>
    <div class="cajaEscribirComentarios span3 offset1">
      <button class="btn botonNuevoComentario" id="<?php echo $post->getId() ?>">Escribir Comentario</button>
    </div>
  </div>
  <div class="cajaComentarios oculto" id="caja<?php echo $post->getId() ?>">
  </div>
  <div class="cajaNuevoComentario oculto" id="cajaNuevoComentario<?php echo $post->getId() ?>">
    <?php # IF LOGGED IN?>
    <form>
      <h3>Escribe tu comentario:</h3>
      <input type="hidden" id="idPost" value="<?php echo $post->getId() ?>">
      <label>Autor</label><input type="text" id="autor" value="1" disabled="disabled">
      <label>Texto</label>
      <textarea></textarea>
      <button class="btn botonEnviarComentario" id="botonEnviarComentario<?php echo $post->getId() ?>">Enviar!</button>
    </form>
    <?php # IF NOT LOGGED ?>
    <h4>Ha de estar logeado para poder escribir nuevos comentarios</h4>
  </div>
</div>