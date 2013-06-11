<?php
namespace src\helpers;

class ManejadorConfig {
    private $rutaCustom; // Si da algun tipo de error con el config cambiad esta linea al directorio donde se encuentre OpenBlog
    private $rutaConfig;
    
    /*
    *   Si existe la variable $ruta busca el archivo config en esa ruta, en caso de no existir llama a la funcion que busca la ruta
    */
    public function __construct() {
        $rutaJson = "/config/config.json";
        if(isset($this->rutaCustom)){
            $this->rutaConfig = $this->rutaCustom . $rutaJson;
        }else{ 
            $this->rutaConfig = $this->getRutaConfig() . $rutaJson;
        }
    }

    /*
    *   Funcion que averigua la ruta del config basada en la ruta de este archivo
    *   BUG en el EXPLODE en WINDOWS la ruta se corta con \ y en linux con /
    */
    public function getRutaConfig(){
        $ruta = "";
        $host = $_SERVER['HTTP_HOST'];
        $dir =  __DIR__;

        $dirArray = explode( DIRECTORY_SEPARATOR, $dir);

        $i = 1;

        while($dirArray[$i] != 'src' && $i < sizeof($dirArray)){
            $ruta= $ruta . "/". $dirArray[$i];
            $i++;
        }
        return $ruta;
    }

    /* Carga la configuracion que se encuentra en $rutaConfig;
    */
    public function cargarConfig(){
        if(!file_exists($this->rutaConfig)){
            return false;
        }
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
        //QUITAR EL SEGUNDO PARAMETRO SI ESTA LINEA TIRA ERROR
        $json = (json_encode($arrayConfig));

        //Graba el json en el stream que hemos abierto
        fwrite($fp, $json);

        fclose($fp);
    }

    public function getPrivateRutaConfig(){
        return $this->rutaConfig;
    }
}

?>