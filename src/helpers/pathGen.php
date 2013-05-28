<?php
namespace src\helpers;
use src\helpers\Header;

class pathGen {
    
    private static $raiz;
    private static $css;
    private static $logo;
    
    /**
     * Carga los metodos estaticos con la configuración establecida por el archivo config.json
     */
    public static function cargarRaiz(){
        if(empty(self::$raiz)){
            $config = Header::cargarJSON();
            self::$raiz = $config["raiz"];
            self::$css = $config["rutaCss"];
            self::$logo = $config["logo"];
        }
    }
    
    
    public static function pathHome($p = null){
        if($p != null){
            return self::$raiz."home/".$p;
        }
        else {
            return self::$raiz."home";
        }
    }
    
    /**
     * Devuelve la ruta al archivo verPost.php?pag=$id (post/id)
     * 
     * @param {id} $id id del post de referencia 
     * @return {string} ruta al archivo
     */
    public static function pathVerPost($id){
        return self::$raiz."post/".$id;
    }
    
    public static function pathVerCategoria(){
        return self::$raiz."categoria";
    }
    
    /**
     * Devuelve la ruta al archivo registro.php (registro)
     * 
     * @return {string} ruta al archivo
     */
    public static function pathRegistro(){
        return self::$raiz."registro";
    }
    
    public static function pathAdmin(){
        return self::$raiz."administrador";
    }
    
    /**
     * Genera la ruta del archivo js que se le mande ([raiz]/resources/js/[fichero])
     * 
     * @param {string} $file nombre y extensión del fichero js
     * @return {string} ruta completa del archivo js
     */
    public static function pathJs($file){
        return self::$raiz."resources/js/".$file;
    }
    
    /**
     * Genera la ruta del archivo css que se le mande ([raiz]/resources/css/[fichero])
     * 
     * @param {string} $file nombre y extensión del fichero css
     * @return {string} ruta completa del archivo css
     */
    public static function pathCss($file){
        return self::$raiz."resources/css/".$file;
    }
    
    /**
     * Genera la ruta del archivo de imagen .ico que se le mande ([raiz]/resources/ico/[fichero])
     * 
     * @param {string} $file nombre y extensión del .ico
     * @return {string} ruta completa del archivo .ico
     */
    
    public static function pathTemplates($file){
        return self::$raiz."templates/".$file;
    }
    
    public static function pathIco($file){
        return self::$raiz."resources/ico/".$file;
    }
    
    /**
     * 
     * @return {string} ruta del archivo css elegido por el archivo config.json
     */
    public static function loadCss(){
        return self::$raiz.self::$css;
    }
    
    /**
     * 
     * @return {string} ruta del archivo de imagen del logo web elegido por el archivo config.json
     */
    public static function loadLogo(){
        return self::$raiz.self::$logo;
    }
}

?>
