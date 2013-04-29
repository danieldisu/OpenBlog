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
      <button class="btnComentarios" id="<?php echo $post->getId() ?>">Ver Comentarios</button>
    </div>
    <div class="cajaEscribirComentarios span3 offset1">
      <button class="btn">Escribir Comentario</button>
    </div>
  </div>
  <div class="cajaComentarios" id="caja<?php echo $post->getId() ?>">
  </div>
</div>