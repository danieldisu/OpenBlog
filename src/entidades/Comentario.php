<?php
namespace src\entidades;
class Comentario {
    
    private $id;
    private $texto;
    private $fecha;
    private $idUsuario;
    private $idPost;
    
    public function __construct($id, $texto, $fecha, $idUsuario, $idPost) {
        $this->id = $id;
        $this->texto = $texto;
        $this->fecha = $fecha;
        $this->idUsuario = $idUsuario;
        $this->idPost = $idPost;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getTexto(){
        return $this->texto;
    }
    
    public function getFecha(){
        return $this->fecha;
    }
    
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    
    public function getIdPost(){
        return $this->idPost;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setTexto($texto){
        $this->texto = $texto;
    }
    
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    
    public function setIdPost($idPost){
        $this->idPost = $idPost;
    }
}

?>
