<?php
    include "autoloader.php";

    use src\helpers\Validador;
    use src\helpers\ManejadorBD;
    use src\entidades\Usuario;
    use src\helpers\Header;
    
    Header::cargarJSON();
    
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    if(isset($_POST["idRol"])){
        $idRol = $_POST["idRol"];
    }
    else {
        $idRol = 1;
    }
    $datos = array();
    
    $bd = new ManejadorBD(Header::$json);
    
    if(Validador::validarNombreUsuario($nombre, $bd) && Validador::validarPass($pass) && Validador::validarMail($email, $bd)){
        $usuario = new Usuario();
        $usuario->setNombre($nombre);
        $usuario->setPass($pass);
        $usuario->setMail($email);
        $usuario->setIdRol($idRol);
        $bd->createUsuario($usuario);
    }
?>