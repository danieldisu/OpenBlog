<?php
  include '../autoloader.php';
  use src\entidades\Post;
  use src\helpers\ManejadorBD;
  use src\helpers\Header;
  
  $json = Header::cargarJSON();
  $mbd = new ManejadorBD($json);
  
  $idUsuario = 1;
  if(isset($_POST)){
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $idCategoria = $_POST['idCategoria'];
    $fechaCreacion = date("Y-m-d H:i:s");
    
    $nuevoPost = new Post();
    $nuevoPost->setIdCategoria($idCategoria);
    $nuevoPost->setIdUsuario($idUsuario);
    $nuevoPost->setFechaCreacion($fechaCreacion);
    $nuevoPost->setTexto($texto);
    $nuevoPost->setTitulo(strip_tags($titulo));
  }

  

  if($mbd->createPost($nuevoPost)){
    $idNuevoPost = $mbd->getUltimoPostDe($idUsuario)->getId();
    $linkNuevoPost = '<a href="../OpenBlog/verPost.php?id='.$idNuevoPost.'"> Ver Post </a>';    
    echo "<div class='alert alert-success alertaNuevoPost'>";
  	 echo "Se ha agregado correctamente el Post";
  	 echo "<br/>";
  	 echo $linkNuevoPost;
    echo "</div>";
  }else{
  echo "<div class='alert alert-error alertaNuevoPost'>";
	  echo "Se ha encontrado algún error vuelva a intentarlo mas tarde";
  echo "</div>";
  }

?>
