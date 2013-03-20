<?php
require_once("Instalador.php");

class DatosPrueba {
    private $instalador;
    
    public function __construct() {
        $this->instalador = new Instalador();
    }
}

?>
