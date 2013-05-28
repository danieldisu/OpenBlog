<?php
    use src\helpers\pathGen;
?>
<div class="cajaUltimosComentarios">
 <h3> Ultimos Comentarios </h3>
 <ul>
   <?php 
  
       foreach ($comentarios as $comentario) {
          $usuario = $mbd->getUsuario($comentario -> getIdUsuario());
          $userName = $usuario->getNombre();
          echo '<li>Por: <a href="'.pathGen::pathPostUsuario($comentario -> getIdUsuario()).'">'.$userName.'</a><br/>'.$comentario->getTexto().'</li>';          
       }
   ?>    
 </ul>            
</div>