<?php
include '../autoloader.php';

use src\helpers\ManejadorBD;
use src\helpers\Header;

$mbd = new ManejadorBD(Header::cargarJSON());
?>

<div class="cajaAdministracion" id="cajaNuevoPost">
  <div class="cajaTituloCategoria">
	<h2>Nueva Entrada</h2>
  </div>
  <div class="cajaContenidoCategoria">
	 <form class="formNuevoPost">
    <div class="cajaAdmin cajaTitulo">
      <label>Titulo del Post:</label><input name="titulo" type="text" />
    </div>        
    <div class="cajaAdmin">
      <label>Texto:</label>
  	   <div id="epiceditor">
  	   	
  	   </div>
    </div>
  	<div class="cajaCategoria cajaAdmin">
  		<label>Categoria: </label>
      <select name="categoria">
        <?php
        $categorias = $mbd->getAllCategorias();

        foreach ($categorias as $categoria) {
          echo "<option value='".$categoria->getId()."'>";
          echo $categoria->getNombre();
          echo "</option>";
        }

      ?>
      </select>
  	 </div>
  	
  	<input type="submit" class="btn" id="botonNuevoPost" value="Publicar Nueva Entrada">
  	<input type="reset" class="btn" value="Limpiar">
  	</form>
  </div>
</div>
