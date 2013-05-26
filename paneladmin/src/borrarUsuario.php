<?php
    include '../../autoloader.php';
    use src\helpers\ManejadorBD;
    use src\helpers\Header;

    if(empty($_POST['idUsuario'])){
        Header::mostrarPaginaError('Se ha encontrado un error con la peticion');
    }

    $mbd = new ManejadorBD(src\helpers\Header::cargarJSON());

//$mbd->deleteUsuario($_POST['idUsuario'])
    if(true){
        echo "true";
    }else{
        echo "false";
    }