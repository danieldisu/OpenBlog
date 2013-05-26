<?php
include '../../../autoloader.php';
use src\helpers\ManejadorBD;
use src\helpers\Header;

$mbd = new ManejadorBD(src\helpers\Header::cargarJSON());


if(empty($_REQUEST['idUsuario'])){
    Header::mostrarPaginaError('Se ha encontrado un error con la peticion');
}

$idUsuario = $_REQUEST['idUsuario'];

$usuario = $mbd->getUsuario($idUsuario);

$roles = $mbd->getAllRoles();

$idUsuario = $usuario->getId();
$nombre = $usuario->getNombre();
$idRol = $usuario->getIdRol();
$mail = $usuario->getMail();


echo "
<form id='formularioEditarUsuario' action='paneladmin/src/editarUsuario.php' method='POST'>
    <input type='hidden' value='$idUsuario' name='idUsuario'/>
    <label>Nombre</label><input type='text' value='$nombre' name='nombre'/>
    <label>E-Mail:</label><input type='text' value='$mail' name='mail'/>
";
echo "<label>Rol: </label><select name='idRol'>";
foreach($roles as $rol){
    $id = $rol->getId();
    $nombreRol = $rol->getNombre();
    if($id == $idRol )
        echo "<option value='$id' selected>$nombreRol</option>";
    else
        echo "<option value='$id'>$nombreRol</option>";
}
echo "</select>";
echo "</form>";