<?php
namespace src\helpers;

class Validador {
    # Esqueleto básico por si quereis empezar a trabajar
    # TODO Rafa
    public static function validarNombreUsuario($nombreUsuario, $bd){
        if(self::validarFormaNombreUsuario($nombreUsuario) && self::validarLongitudMenorNombreUsuario($nombreUsuario) && self::validarLongitudMayorNombreUsuario($nombreUsuario) && self::validarExisteNombreUsuario($nombreUsuario, $bd)){
            return true;
        }
        else {
            return false;
        }
    }
    public static function validarPass($pass){
        if(self::validarLongitudMenorPass($pass) && self::validarLongitudMayorPass($pass)){
            return true;
        }
        else {
            return false;
        }
    }
    public static function validarMail($mail, $bd){
        if(self::validarFormaMail($mail) && self::validarExisteMail($mail, $bd)){
            return true;
        }
        else {
            return false;
        }
    }
    public static function validarCategoria($categoria){
        # Validaremos si la categoria existe en la bd antes de modificarla o borrarla
        return true;
    }

    public static function estaVacio($cadena){
        if($cadena == "" || $cadena == null || $cadena == " ")
            return true;
        else
            return false;
    }
    
    # Validaciones fragmentadas para poder sacar mensajes individuales de cada una de ellas
    # nombre
    public static function validarFormaNombreUsuario($nombreUsuario){
        $expr = "/^[A-Za-zñÑ0-9_.]*$/";
        return preg_match($expr, $nombreUsuario);
    }
    
    public static function validarLongitudMenorNombreUsuario($nombreUsuario){
        if(strlen($nombreUsuario) < 6){
            return false;
        }
        else {
            return true;
        }
    }
    
    public static function validarLongitudMayorNombreUsuario($nombreUsuario){
        if(strlen($nombreUsuario) > 20){
            return false;
        }
        else {
            return true;
        }
    }
    
    public static function validarExisteNombreUsuario($nombreUsuario, $bd){
        if($bd->comprobarNombreUsuario($nombreUsuario)){
           return false; 
        }
        else {
            return true;
        }
    }
    
    # email
    public static function validarFormaMail($email){
        $expr = "/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
        return preg_match($expr, $email);
    }
    
    public static function validarExisteMail($email, $bd){
        if($bd->comprobarEmailUsuario($email)){
           return false; 
        }
        else {
            return true;
        }
    }
    
    #pass
    public static function validarLongitudMenorPass($pass){
        if(strlen($pass) < 6){
            return false;
        }
        else {
            return true;
        }
    }
    
    public static function validarLongitudMayorPass($pass){
        if(strlen($pass) > 50){
            return false;
        }
        else {
            return true;
        }
    }
}

?>
