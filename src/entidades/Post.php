<?php
namespace src\entidades;
class Post {
    
    private $id;
    private $idUsuario;
    private $idCategoria;
    private $titulo;
    private $texto;
    private $fechaCreacion;
    private $fechaModificacion;
    private $modificaciones;
    
    public function __construct($id = 0, $idUsuario = null, $idCategoria = 0, $titulo = null, $texto = null, $fechaCreacion = null, $fechaModificacion = null, $modificaciones = 0) {

    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    
    public function getIdCategoria(){
        return $this->idCategoria;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function getTexto(){
        return $this->texto;
    }
    
    public function getFechaCreacion(){
        return $this->fechaCreacion;
    }
    
    public function getFechaModificacion(){
        return $this->fechaModificacion;
    }
    
    public function getModificaciones(){
        return $this->modificaciones;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    
    public function setIdCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }
    
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    
    public function setTexto($texto){
        $this->texto = $texto;
    }
    
    public function setFechaCreacion($fechaCreacion){
        $this->fechaCreacion = $fechaCreacion;
    }
    
    public function setFechaModificacion($fechaModificacion){
        $this->fechaModificacion = $fechaModificacion;
    }
    
    public function setModificaciones($modificaciones){
        $this->modificaciones = $modificaciones;
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
