<?php
  include '../autoloader.php';
  use src\entidades\Categoria;
  use src\helpers\ManejadorBD;
  use src\helpers\Header;

   $json = Header::cargarJSON();
   $mbd = new ManejadorBD($json);
  
  //$idUsuario = $_SESSION('usuario');
  $idUsuario = 1;
  if(isset($_POST)){
  	$idCategoria = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoriaEditar = new Categoria();
    $categoriaEditar->setNombre(strip_tags($nombre));
    $categoriaEditar->setDescripcion(strip_tags($_POST['descripcion'])); # Da error si guardo descripcion en una variable.
  }  
  if($mbd->updateCategoria($idCategoria, $categoriaEditar)){
  echo "<div class='cajaAlertaCorrectoCategoria alert alert-success alertaNuevoPost'>";
		echo "Se ha modificado correctamente la categoria";
	echo "</div>";
  }else{
	  echo "<div class='cajaAlertaErrorCategoria alert alert-error alertaNuevoPost'>";
		  echo "Se ha encontrado algún error vuelva a intentarlo mas tarde";
	  echo "</div>";
  }

?>
