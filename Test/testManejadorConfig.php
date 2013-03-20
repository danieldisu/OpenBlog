<?php

include "../Helpers/ManejadorConfig.php";


$mj = new ManejadorConfig();

/*
* Ejemplo de arrayConfig 
*/
$arrayConfig['host'] = "localhost";
$arrayConfig['user'] = "root";
$arrayConfig['pass'] = "";
$arrayConfig['nombreBd'] = "openblog";
$arrayConfig['tituloBlog'] = "OpenBlog";
$arrayConfig['descripcionBlog'] = "Esta es una descripcion de Prueba";
$arrayConfig['rutaCss'] = "../Recursos/css/estilos.css";

$mj->guardarConfig($arrayConfig);

echo "La configuracion ha sido generada";

$config = $mj->cargarConfig();

echo "<pre>";
print_r($config);
echo "</pre>";