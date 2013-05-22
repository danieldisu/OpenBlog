<div class="cajaLogin">
<h3> Login </h3>
<?php
	if($isLoged){
		echo "<label>Bienvenido $nombreUsuario</label>";
		if($isAdmin){
			echo '<input type="button" class="btn btn-block" value="Administrar">';
		}
		echo '<input type="button" class="btn btn-block" value="Logout">';
	}else{
		include "src/templates/sidebar/templateFormLogin.php";
	}
?>
</div>