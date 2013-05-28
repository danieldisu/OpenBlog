<?php
    include '../../autoloader.php';
    use src\helpers\ManejadorBD;
    use src\helpers\Header;

    if(empty($_POST['idUsuario'])){
        Header::mostrarPaginaError('Se ha encontrado un error con la peticion');
    }

    $mbd = new ManejadorBD(Header::cargarJSON());

    if($mbd->deleteUsuario($_POST['idUsuario'])){
        echo "true";
    }else{
        echo "false";
    }