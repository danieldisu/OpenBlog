<?php
namespace src\entidades;
class Usuario {
    
    private $id;
    private $nombre;
    private $pass;
    private $mail;
    private $idRol;
    
    public function __construct() {
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
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function setPass($pass){
        $this->pass = $pass;
    }
    
    public function setMail($mail){
        $this->mail = $mail;
    }
    
    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }
}

?>
