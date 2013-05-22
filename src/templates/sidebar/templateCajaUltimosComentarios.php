<div class="cajaUltimosComentarios">
 <h3> Ultimos Comentarios </h3>
 <ul>
   <?php 
       $comentarios = $mbd->obtenerUltimosComentarios();       
       foreach ($comentarios as $comentario) {
          $usuario = $mbd->getUsuario($comentario->getId());
          $userName = $usuario->getNombre();
          echo '<li>Por: <a href="#">'.$userName.'</a><br/>'.$comentario->getTexto().'</li>';
       }
   ?>    
 </ul>            
</div>