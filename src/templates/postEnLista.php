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
</div>