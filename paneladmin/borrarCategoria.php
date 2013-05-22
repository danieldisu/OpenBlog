<?php
/*
 * Pagina que se encargará de añadir una nueva categoria a la base de datos
 */
  include '../autoloader.php';
  use src\entidades\Categoria;
  use src\helpers\ManejadorBD;
  
  $mbd = new ManejadorBD();
  
  //$idUsuario = $_SESSION('usuario');
  $idUsuario = 1;
  if(isset($_POST)){
	$idCategoria = $_POST['id'];
    
  }  
  if($mbd->updateCategoriaPost($idCategoria) && $mbd->deleteCategoria($idCategoria)){
 	echo "<div class='alert alert-success alertaNuevoPost'>";
		echo "Se ha eliminado correctamente la categoria";
	echo "</div>";
  }else{
	  echo "<div class='alert alert-error alertaNuevoPost'>";
		  echo "Se ha encontrado algún error vuelva a intentarlo mas tarde";
	  echo "</div>";
  }

?>
