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

  <div class="cajaContenidoPost">
    <p><?php echo $post->getTexto(); ?></p>
  </div>

  <div class="row cajaAcciones" data-idpost="<?php echo $post->getId(); ?>">
    <div class="cajaEscribirComentarios span3 offset1">
      <button class="btn botonNuevoComentario" >Escribir Comentario</button>
    </div>
  </div>

  <div class="cajaNuevoComentario" style='display:none'>
    <?php
    if(src\helpers\Login::isLogin()){
      $userid = src\helpers\Login::getId();
      include "src/templates/plantillaNuevoComentario.php";
    }else{
      echo "<div class='alert'>";
      echo "<h5>Ha de estar logeado para poder escribir nuevos comentarios</h5>";
      echo "</div>";
    }
    /*
      if($isLoged){
        include "src/templates/plantillaNuevoComentario.php"; 
      }else{
        echo "<h4>Ha de estar logeado para poder escribir nuevos comentarios</h4>"; 
    }*/
    ?>
  </div>
  <div class="cajaComentariosUnicoPost">
    <?php 
      foreach ($comentarios as $comentario) {
        $usuario = $mbd->getUsuario($comentario->getIdUsuario());
        $userName = $usuario->getNombre();
        echo '<div class="comentario"><span class="autorComentario">'.$userName.'</span>'.'  <span class="fechaComentario">'.$comentario->getFecha().'</span> <br/>'.$comentario->getTexto().'</div>';
          
      }
    ?>
  </div>


</div>