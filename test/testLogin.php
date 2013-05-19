<?php

    include "../autoloader.php";

    use src\helpers\Validador;
    use src\helpers\ManejadorBD;
    use src\entidades\Comentario;
    use src\helpers\Header;
    
    Header::cargarJSON();

    $bd = new ManejadorBD(Header::$json);
    $user = $bd->getUsuarioByName("adonai");
    print_r($user);
?>
