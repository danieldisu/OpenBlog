<?php
/*
 * Pagina que se encargará de añadir una nueva categoria a la base de datos
 */
  include '../autoloader.php';
  use src\entidades\Categoria;
  use src\helpers\ManejadorBD;
  use src\helpers\Header;
  $json = Header::cargarJSON();
  $mbd = new ManejadorBD($json);
  
  //$idUsuario = $_SESSION('usuario');
  $idUsuario = 1;
  if(isset($_POST)){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    $nuevaCategoria = new Categoria();
    $nuevaCategoria->setNombre($nombre);
    $nuevaCategoria->setDescripcion($descripcion);
  }  

  if($mbd->createCategoria($nuevaCategoria)){
 	echo "<div class='cajaAlertaCorrectoCategoria alert alert-success alertaNuevoPost'>";
		echo "Se ha agregado correctamente la categoria";
	echo "</div>";
  }else{
	  echo "<div class='cajaAlertaErrorCategoria alert alert-error alertaNuevoPost'>";
		  echo "Se ha encontrado algún error vuelva a intentarlo mas tarde";
	  echo "</div>";
  }

?>
