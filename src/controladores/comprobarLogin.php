<?php
    include "../../autoloader.php";

    use src\helpers\Validador;
    use src\helpers\ManejadorBD;
    use src\entidades\Comentario;
    use src\helpers\Header;
    
    Header::cargarJSON();
    
    $usuario = $_POST["usuario"];
    $pass = md5($_POST["pass"]);
    
    if(Validador::estaVacio($usuario)){
        echo "El campo usuario no puede estar vacio";
        exit();
    }
    if(Validador::estaVacio($pass)){
        echo "El campo contraseña no puede estar vacio";
        exit();
    }
    
    $bd = new ManejadorBD(Header::$json);
    if($bd->comprobarLogin($usuario, $pass)){
        $user = $bd->getUsuarioByName($usuario);
        session_start();
        $_SESSION["usuario"]["id"] = $user->getId();
        $_SESSION["usuario"]["nombre"] = $user->getNombre();
        // LA PASS MEJOR NO PASARLA EN LA SESION!
        // $_SESSION["usuario"]["pass"] = $user->getPass();
        $_SESSION["usuario"]["mail"] = $user->getMail();
        $_SESSION["usuario"]["idRol"] = $user->getIdRol();
        echo "exito";
    }
    else {
        echo "El usuario y la contraseña no coinciden";
    }
?>