<?php

class ManejadorConfig {
    private $rutaConfig = "../Recursos/config.json";
    
    public function __construct() {
        
    }
    
    public function cargarConfig(){
        $fp = fopen($this->rutaConfig, 'r');

        $json = fread($fp, filesize($this->rutaConfig));

        $arrayConfig = json_decode($json);

        return $arrayConfig;
    }
    
    public function guardarConfig($arrayConfig){
       
        $fp = fopen($this->rutaConfig, 'w');
        
        $json = (json_encode($arrayConfig,JSON_PRETTY_PRINT));
        fwrite($fp, $json);
        fclose($fp);
        
    }
}

?>
