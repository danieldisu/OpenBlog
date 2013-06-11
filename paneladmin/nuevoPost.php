<?php
/*
 * Pagina que se encargará de añadir un nuevo post a la base de datos
 * TODO:
 *	-Limpiar Post
 *	-Añadir Categoria
 *	-Mostrar Post una vez insertado
 *	-Añadir Titulo
 *	-Añadir Usuario
 */
  include '../autoloader.php';
  use src\entidades\Post;
  use src\helpers\ManejadorBD;
  use src\helpers\Header;
  
  $json = Header::cargarJSON();
  $mbd = new ManejadorBD($json);
  
  //$idUsuario = $_SESSION('usuario');
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
    // generarLinkPost($idNuevoPost);
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
