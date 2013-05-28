<?php
    include "../../autoloader.php";

    use src\helpers\Validador;
    use src\helpers\ManejadorBD;
    use src\entidades\Comentario;
    use src\helpers\Header;
    
    Header::cargarJSON();
    
    $usuario = $_POST["usuario"];
    $datos = array();
    
    $bd = new ManejadorBD(Header::$json);
    if(!Validador::validarExisteNombreUsuario($usuario, $bd)){
        $datos["correcto"] = false;
        $datos["msn"] = "El nombre elegido ya existe";
    }
    else {
        $datos["correcto"] = true;
    }
    
    echo json_encode($datos);
?>