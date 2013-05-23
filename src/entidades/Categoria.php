<?php
namespace src\entidades;
class Categoria {
    
    private $id;
    private $nombre;
    private $descripcion;
    
    public function __construct() {
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

?>
