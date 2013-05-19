<?php
/*
 * Pagina que se encargará de obtener una nueva categoria de la base de datos
 * para rellenar los campos del html
 * ya que es un campo que vamos a utilizar para editar cualquier post
 */
  include '../autoloader.php';
  use src\entidades\Categoria;
  use src\helpers\ManejadorBD;
  
  $mbd = new ManejadorBD();
  
  //$idUsuario = $_SESSION('usuario');
  $idUsuario = 1;
  if(isset($_POST)){
  	$idCategoria = $_POST['id'];
    $categoria = $mbd->getCategoria($idCategoria);
    $nombre = $categoria->getNombre();
    $descripcion = $categoria->getDescripcion();
    $categoria  = array('nombre' => $nombre ,'descripcion' => $descripcion);
    $datos = json_encode($categoria);
    echo $datos;
  }
?>