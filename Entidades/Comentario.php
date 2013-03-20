<?php
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
}

?>
