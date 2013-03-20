<?php
class Usuario {
    
    private $id;
    private $nombre;
    private $pass;
    private $mail;
    private $idRol;
    
    public function __construct($id, $nombre, $pass, $mail, $idRol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->mail = $mail;
        $this->idRol = $idRol;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getPass(){
        return $this->pass;
    }
    
    public function getMail(){
        return $this->mail;
    }
    
    public function getIdRol(){
        return $this->idRol;
    }
}

?>
