<?php
include '../autoloader.php';

use src\helpers\ManejadorBD;

$mbd = new ManejadorBD();
?>

<div class="cajaAdministracion row" id="cajaNuevoPost">
  <div class="span12 cajaTituloCategoria">
	<h2>Nueva Entrada</h2>
  </div>
  <div class="span12 cajaContenidoCategoria">
	<form class="formNuevoPost">
      <div class="cajaTitulo">
        <label>Titulo:</label><input name="titulo" type="text" />
      </div>
     <div class="cajaEditorTexto">
      <label>Texto:</label>
		  <textarea name="texto"></textarea>
      </div>
	  <div class="cajaCategoria">
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
