<?php

include "../autoloader.php";

use src\helpers\ManejadorConfig;

$mj = new ManejadorConfig();

/*
* Ejemplo de arrayConfig, si quisiesemos cambiar uno de las opciones solo tendriamos que cargar la config, modificar el parametro deseado y volver a guardar
*/
$arrayConfig['host'] = "localhost";
$arrayConfig['user'] = "root";
$arrayConfig['pass'] = "";
$arrayConfig['nombreBd'] = "openblog";
$arrayConfig['tituloBlog'] = "OpenBlog";
$arrayConfig['descripcionBlog'] = "Esta es una descripcion de Prueba";
$arrayConfig['rutaCss'] = "resources/css/estilos.css";
$arrayConfig['numPost'] = "5"; 

$mj->guardarConfig($arrayConfig);

echo "La configuracion ha sido generada";

// Cargamos al configuracion en la variable $config
$config = $mj->cargarConfig();

// Ejemplo de como extraer el host de la configuracion
echo "<br> config[host] = ";
echo $config['host'];

// Aqui mostraria todas las variables que tiene el json
echo "<pre>";
   print_r($config);
echo "</pre>
";