<div class="post">
  <div class="cajaTituloPost">
    <h3><?php echo $post->getTitulo(); ?></h3>
  </div>
  <div class="cajaInfo row">
    <div class="cajaAutorPost span2">
      <span><?php echo $post->getIdUsuario(); ?></span>
    </div>

    <div class="cajaFechaPost span2 ">
      <span><?php echo $post->getFechaCreacion(); ?></span>
    </div>
    <div class="cajaCategoriaPost span2 ">
      <span><?php echo $post->getIdCategoria(); ?></span>
    </div>
    <div class="cajaNumeroComentarios span2 ">
      <span>{NUMERO COMENTARIOS}</span>
    </div>
  </div>

  <div class="cajaContenidoPost">
    <p>{TEXTO POST}</p>
  </div>
  <div class="row cajaAcciones">
    <div class="cajaVerComentarios span3 offset1">
      <button class="btn">Ver Comentarios</button>
    </div>
    <div class="cajaEscribirComentarios span3 offset1">
      <button class="btn">Escribir Comentario</button>
    </div>
  </div>
</div>