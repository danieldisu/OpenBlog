<?php
    use src\helpers\pathGen;
?>
<div class="post">
	<div class="cajaTituloPost">
	  <h3><a class="enlaceTituloPost" href="<?php echo pathGen::pathVerPost($post->getId()) ?>"><?php echo $post->getTitulo(); ?></a></h3>	  	  
	</div>
	<div class="cajaInfo row">
	  <div class="cajaAutorPost span2">
              <span><?php echo "<a href='".pathGen::pathPostUsuario($post->getIdUsuario())."'>".$mbd->obtenerNombreAutor($post->getIdUsuario())."</a>" ?></span>
	  </div>
	  <div class="cajaFechaPost span2 ">
	    <span><?php echo $post->getFechaCreacion(); ?></span>
	  </div>
	  <div class="cajaCategoriaPost span2 ">
              <span><?php echo "<a href='".pathGen::pathVerCategoria($post->getIdCategoria())."'>".$mbd->obtenerNombreCategoria($post->getIdCategoria())."</a>" ?></span>
	  </div>
	  <div class="cajaNumeroComentarios span2 ">
	    <span><?php echo "Nº de comentarios: ".$mbd->obtenerNumeroComentarios($post->getId()); ?></span>
	  </div>
	</div>
</div>