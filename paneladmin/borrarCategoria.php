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
    
  }  
  if($mbd->updateCategoriaPost($idCategoria) && $mbd->deleteCategoria($idCategoria)){
 	echo "<div class='cajaAlertaCorrectoCategoria alert alert-success alertaNuevoPost'>";
		echo "Se ha eliminado correctamente la categoria";
	echo "</div>";
  }else{
	  echo "<div class='cajaAlertaErrorCategoria alert alert-error alertaNuevoPost'>";
		  echo "Se ha encontrado algún error vuelva a intentarlo mas tarde";
	  echo "</div>";
  }

?>
