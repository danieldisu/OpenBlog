<?php
include '../../autoloader.php';

use src\helpers\Header;
use src\helpers\ManejadorConfig;

$mc = new ManejadorConfig();

if(isset($_POST["dato"]) && isset($_POST["actualizar"])){
    $dato = $_POST["dato"];
    $actualizar = $_POST["actualizar"];

    $arrayConfig = $mc->cargarConfig();

    $arrayConfig[$actualizar] = $dato;
    
    $mc->guardarConfig($arrayConfig);
}
?>