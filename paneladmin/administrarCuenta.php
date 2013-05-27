<?php session_start();?>
<div class="cajaAdministracion row">
   <div class="span12 cajaTituloCategoria">
      <div class="cajaAdmin">
      <h2>Mi Cuenta</h2>
      <label>Usuario</label>
      <input type="text" id="adminName" value=<?php echo $_SESSION['usuario']['nombre']?>>
      <label>Cuenta de correo</label>
      <input type="text" id="adminMail" value=<?php echo $_SESSION['usuario']['mail']?>>
      <label>Nueva contraseña</label>
      <input type="password" id="adminNewPassword">
      <label>Repite la nueva contraseña</label>
      <input type="password" id="adminNewRePassword">
      <label>Contraseña actual</label>
      <input type="password" id="adminPassword">
      <div id="mensajeAdmin" class="alertaModificarUsuario">
      </div>
      <button id="botonAdministrarDatosAdmin">
         <i class="icon-ok"></i> Guardar Cambios
      </button>
      </div>
   </div>      
</div>