<?php


require_once('vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php');

use Symfony\Component\ClassLoader\UniversalClassLoader;


$loader = new UniversalClassLoader();

$loader->registerNamespace("src", __DIR__);
$loader->register();

?>