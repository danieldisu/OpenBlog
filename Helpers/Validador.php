<?php
class Validador {
    public function __construct() {
        
    }
    # Esqueleto básico por si quereis empezar a trabajar
    # TODO Rafa
    public function validarNombreUsuario($nombreUsuario){
        return true;
    }
    public function validarPass($pass){
        return true;
    }
    public function validarMail($mail){
        return true;
    }
    public function validarCategoria($categoria){
        # Validaremos si la categoria existe en la bd antes de modificarla o borrarla
        return true;
    }
    
}

?>
