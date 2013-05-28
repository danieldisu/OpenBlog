<?php
    include "../../autoloader.php";

    use src\helpers\Validador;
    use src\helpers\ManejadorBD;
    use src\entidades\Comentario;
    use src\helpers\Header;
    
    Header::cargarJSON();
    
    $email = $_POST["email"];
    $datos = array();
    
    $bd = new ManejadorBD(Header::$json);
    if(!Validador::validarExisteMail($email, $bd)){
        $datos["correcto"] = false;
        $datos["msn"] = "El email elegido ya existe";
    }
    else {
        $datos["correcto"] = true;
    }
    
    echo json_encode($datos);
?>