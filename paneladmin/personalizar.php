<?php
	include '../autoloader.php';

	use src\helpers\ManejadorBD;
	use src\helpers\Header;

	$json = Header::cargarJSON();

	$mbd = new ManejadorBD($json);
?>

<div class="cajaAdministracion row">
   <div class="span12 cajaTituloCategoria">
      <h2>Personalizacion</h2>   
   </div>
   <div class="span8">
      <h3>Titulo del Blog:</h3>
      <h5>Permite cambiar el titulo del blog</h5>
      <?php
      if(!empty($json["tituloBlog"])){
          echo "<p>Actual: ".$json["tituloBlog"]."</p>";
      }
      else{
          echo "<p>Actualmente no tienes titulo de Blog</p>";
      }
      ?>
       <div class="input-append">
           <form class="form-inline">
               <input class="span6" id="tituloBlog" type="text">
               <button type="button" class="btn"><i class="icon-edit"></i>Cambiar</button>
           </form>
       </div> 
    </div>
   <div class="span8">
      <h3>Descripcion del Blog:</h3>
      <h5>Cambia la descripcion que aparece debajo del titulo</h5>
      <?php
      if(!empty($json["descripcionBlog"])){
          echo "<p>Actual: ".$json["descripcionBlog"]."</p>";
      }
      else{
          echo "<p>Actualmente no tienes descripción del blog</p>";
      }
      ?>
       <div class="input-append">
           <form class="form-inline">
               <input class="span6" id="descripcionBlog" type="text">
               <button type="button" class="btn"><i class="icon-edit"></i>Cambiar</button>
           </form>
       </div> 
   </div> 
   <div class="span12">
      <h3>Hoja de Estilos:</h3>
      <h5>Permite cambiar la hoja de estilos que carga el blog</h5>
      <?php
      if(!empty($json["rutaCss"])){
          echo "<p>Actual: ".$json["rutaCss"]."</p>";
      }
      else{
          echo "<p>Actualmente no tienes hoja de estilos personalizada</p>";
      }
      ?>
       <div class="input-append">
           <form class="form-inline">
               <input class="span6" id="estilosBlog" type="text">
               <button type="button" class="btn"><i class="icon-edit"></i>Cambiar</button>
           </form>
       </div> 
   </div>   
   <div class="widget span7">
      <div id="cajaLogoActual">
         <h3>Logo Actual:</h3>
         <h5>Cambia el logo que preside la pagina</h5>
         <img src="<?php echo $json["logo"] ?>">
      </div>
      <div class="cajaInfoLogo input-append">
        <form class="form-inline">
            <input class="span4" id="logoBlog" type="text">
            <button type="button" class="btn"><i class="icon-edit"></i>Cambiar</button>
        </form> 
      </div>
      
   </div>   
</div>



