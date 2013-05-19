<?php

namespace src\helpers;

class Login {
    public static function isLogin(){
        if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] != ""){
            return true;
        }
        else {
            return false;
        }
    }
    
    public static function isAdmin(){
        if(self::isLogin()){
            if($_SESSION["usuario"]["idRol"] == 2){
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    public static function isUser(){
        if(self::isLogin()){
            if($_SESSION["usuario"]["idRol"] == 1){
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    public static function getId(){
        if(self::isLogin()){
            return $_SESSION["usuario"]["id"];
        }
    }
    
    public static function getNombre(){
        if(self::isLogin()){
            return $_SESSION["usuario"]["nombre"];
        }
    }
    
    public static function getPass(){
        if(self::isLogin()){
            return $_SESSION["usuario"]["pass"];
        }
    }
    
    public static function getMail(){
        if(self::isLogin()){
            return $_SESSION["usuario"]["mail"];
        }
    }
}

?>
