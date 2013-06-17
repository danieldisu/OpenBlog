<?php
  include '../autoloader.php';
  use src\entidades\Categoria;
  use src\helpers\ManejadorBD;
  use src\helpers\Header;

   $json = Header::cargarJSON();
   $mbd = new ManejadorBD($json);
  
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