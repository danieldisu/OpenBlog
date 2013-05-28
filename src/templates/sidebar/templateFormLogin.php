<?php
    use src\helpers\pathGen;
?>
<label>Usuario</label>
<input type="text" id="inputUsuario">
<label>Contraseña</label>
<input type="password" id="inputPassword">
<input type="button" class="btn btn-block" value="Login">
<a href="<?php echo pathGen::pathRegistro(); ?>"><input type="button" class="btn btn-block" value="Registrarse"></a>