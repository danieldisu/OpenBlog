<?php
    include "../../autoloader.php";

    use src\helpers\Validador;
    use src\helpers\ManejadorBD;
    use src\entidades\Comentario;
    use src\helpers\Header;
    
    Header::cargarJSON();
    
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $emailR = $_POST["emailR"];
    $pass = $_POST["pass"];
    $passR = $_POST["passR"];
    $datos = array();
    
    $bd = new ManejadorBD(Header::$json);
    
    //NOMBRE
    if(Validador::validarNombreUsuario($nombre, $bd)){
        $datos["nombre"]["correcto"] = true;
    }
    else {
        if(!Validador::validarFormaNombreUsuario($nombre)){
            $datos["nombre"]["correcto"] = false;
            $datos["nombre"]["msn"] = "No puedes usar ni espacios ni caracteres especiales";
        }
        else if(!Validador::validarLongitudMenorNombreUsuario($nombre)){
            $datos["nombre"]["correcto"] = false;
            $datos["nombre"]["msn"] = "El nombre tiene que tener más de 6 caracteres";
        }
        else if(!Validador::validarLongitudMayorNombreUsuario($nombre)){
            $datos["nombre"]["correcto"] = false;
            $datos["nombre"]["msn"] = "El nombre tiene que tener menos de 20 caracteres";
        }
        else if(!Validador::validarExisteNombreUsuario($nombre, $bd)){
            $datos["nombre"]["correcto"] = false;
            $datos["nombre"]["msn"] = "El nombre elegido ya existe";
        }
    }
    
    //EMAIL
    if(Validador::validarMail($email, $bd)){
        $datos["email"]["correcto"] = true;
    }
    else {
        if(!Validador::validarFormaMail($email)){
            $datos["email"]["correcto"] = false;
            $datos["email"]["msn"] = "El formato de email introducido es incorrecto";
        }
        else if(!Validador::validarExisteMail($email, $bd)){
            $datos["email"]["correcto"] = false;
            $datos["email"]["msn"] = "El email elegido ya existe";
        }
    }
    
    //EMAILR
    if($email == $emailR){
        $datos["emailR"]["correcto"] = true;
    }
    else {
        $datos["emailR"]["correcto"] = false;
        $datos["emailR"]["msn"] = "El email no coincide"; 
    }
    
    //PASS
    if(Validador::validarPass($pass)){
        $datos["pass"]["correcto"] = true;
    }
    else {
        if(!Validador::validarLongitudMenorPass($pass)){
            $datos["pass"]["correcto"] = false;
            $datos["pass"]["msn"] = "La contraseña tiene que tener más de 6 caracteres"; 
        }
        else if(!Validador::validarLongitudMayorPass($pass)){
            $datos["pass"]["correcto"] = false;
            $datos["pass"]["msn"] = "La contraseña tiene que tener menos de 50 caracteres"; 
        }
    }
    
    //PASSR
    if($pass == $passR){
        $datos["passR"]["correcto"] = true;
    }
    else {
        $datos["passR"]["correcto"] = false;
        $datos["passR"]["msn"] = "Las contraseñas no coinciden";
    }
    
    echo json_encode($datos);
?>