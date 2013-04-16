<?php

class ManejadorConfig {
    private $rutaConfig = "Recursos/config.json";
    
    public function __construct() {
        
    }
    
    /* Carga la configuracion que se encuentra en $rutaConfig;
    */
    public function cargarConfig(){
        // Abre un stream
        $fp = fopen($this->rutaConfig, 'r');

        //Lee el stream que hemos abierto previamente, el segundo parametro le indica que tiene que leer el numero de bytes que tiene de tamaño el archivo, es decir, lo lee entero
        $json = fread($fp, filesize($this->rutaConfig));

        // convertimos el string en notacion json en un array, el segundo parametro hace que devuelva un array y no una clase std nose que
        $arrayConfig = json_decode($json,true);

        fclose($fp);

        return $arrayConfig;
    }
    
    public function guardarConfig($arrayConfig){
        // Abre el Stream
        $fp = fopen($this->rutaConfig, 'w');
        
        // Convierte a notacion JSON el array que hemos pasado por parametro, el segundo parametro hace que lo que escriba sea legible, lo "embellece"
        $json = (json_encode($arrayConfig));

        //Graba el json en el stream que hemos abierto
        fwrite($fp, $json);

        fclose($fp);
    }
}

?>