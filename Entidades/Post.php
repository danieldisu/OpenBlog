<?php

class Post {
    
    private $id;
    private $idUsuario;
    private $idCategoria;
    private $titulo;
    private $texto;
    private $fechaCreacion;
    private $fechaModificacion;
    private $modificaciones;
    
    public function __construct($id, $idUsuario, $idCategoria, $titulo, $texto, $fechaCreacion, $fechaModificacion, $modificaciones) {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->idCategoria = $idCategoria;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaModificacion = $fechaModificacion;
        $this->modificaciones = $modificaciones;
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
}

?>
