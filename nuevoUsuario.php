<?php
    include "autoloader.php";

    use src\helpers\Validador;
    use src\helpers\ManejadorBD;
    use src\entidades\Comentario;
    use src\helpers\Header;
    
    Header::cargarJSON();
    
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $datos = array();
    
    $bd = new ManejadorBD(Header::$json);
    
    if(Validador::validarNombreUsuario($nombre, $bd) && Validador::validarPass($pass) && Validador::validarMail($email, $bd)){
        
    }
?>