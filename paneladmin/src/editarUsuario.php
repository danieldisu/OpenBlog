<?php



    include '../../autoloader.php';
    use src\helpers\ManejadorBD;
    use src\helpers\Header;
    use src\entidades\Usuario;

    $mbd = new ManejadorBD(src\helpers\Header::cargarJSON());



    if(empty($_POST['idUsuario'])){
        //Header::mostrarPaginaError('Se ha encontrado un error con la peticion');
    }else{
        $idUsuario = $_POST['idUsuario'];
    }
    $antiguoUsuario = $mbd->getUsuario($idUsuario);
    $idRol = $_POST['idRol'];
    $mail = $_POST['mail'];
    $nombre = $_POST['nombre'];
    $pass = $antiguoUsuario->getPass();

    $nuevoUsuario = new Usuario();

    $nuevoUsuario->setId($idUsuario);
    $nuevoUsuario->setIdRol($idRol);
    $nuevoUsuario->setNombre($nombre);
    $nuevoUsuario->setMail($mail);
    $nuevoUsuario->setPass($pass);

    if($mbd->updateUsuario($idUsuario,$nuevoUsuario) == 1){
        echo "<div class='alert alert-success'>";
            echo "Se ha modificado correctamente el usuario";
        echo "</div>";
    }else{
         Header::mostrarPaginaError('Se ha encontrado un error con la peticion');
    }