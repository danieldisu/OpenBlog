<?php
include '../autoloader.php';

use src\helpers\ManejadorBD;

$mbd = new ManejadorBD(src\helpers\Header::cargarJSON());

?>

<div class="cajaAdministracion row">
    <div class="cajaTituloCategoria">
        <h2>Administrar Usuarios</h2>
        <button class="botonCrearRol btn"> Crear Nuevo Rol </button>
    </div>
    <div class="cajaFormularioCrearRol">
        <div class="cajaAlertaRol alert" style="display:none"></div>
        <label>Nombre:</label>
        <input type="text" class="inputNombreRol">
        <label>Descripcion:</label>
        <input type="text" class="inputDescripcionRol">
        <button class="crearRol btn"> Crear Rol </button>
    </div>
   <div class="cajaContenidoCategoria">
      <table class="table table-bordered table-striped">
         <thead>
            <tr>
               <th class="span1">ID</th>
               <th class="span4">Nombre</th>
               <th class="span4">Mail</th>
               <th class="span4">Rol</th>
               <th class="span2">Acciones</th>
            </tr>
         </thead>   
         <tbody>
         <?php
         $usuarios = $mbd->getAllUsuarios();
         foreach ($usuarios as $usuario) {
            echo "<tr data-idusuario='".$usuario->getId()."'>";
             echo "<td>";
                echo $usuario->getId();
             echo "</td>";
             echo "<td>";
                echo $usuario->getNombre();
             echo "</td>";

             echo "<td>";
                echo $usuario->getMail();
             echo "</td>";
             echo "<td>";
             echo $usuario->getIdRol();
             echo "</td>";
             echo "<td class='columnaAcciones'>";
                echo '<a href="#myModal" class="btn btn-small btn-warning botonEditarUsuario"><i class="icon-pencil icon-white"></i></a>';
                echo '<a class="btn btn-small btn-danger botonBorrarUsuario" data-idusuario="'.$usuario->getId().'"><i class="icon-remove-sign icon-white" ></i></a>';
             echo "</td>";
            echo "</tr>";
         }
         ?>
         </tbody>
         </table>       
   </div>   
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Modal header</h3>
</div>
<div class="modal-body">
<p>One fine body…</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary">Save changes</button>
</div>
</div>