<?php
    require_once("../autoloader.php");
    $instalador = new Instalador();
    $instalador->borrarEstructuraTablas();
    $instalador->crearEstructuraTablas();

    echo "Si todo ha ido bien y ves este mensaje ya deberian estar las tablas creadas";

?>
