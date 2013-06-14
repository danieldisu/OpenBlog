<?php

namespace src\helpers;

use src\helpers\ManejadorConfig;


Class Header {

  public static $json;

  public static function cargarJSON() {
  	//cargamos el json
  	$manejadorConfig = new ManejadorConfig();
  	self::$json = $manejadorConfig->cargarConfig();
  	return self::$json;
  }

  public static function cargarHojasDeEstilos() {
	 // en caso de que ya hayamos cargado el JSON anteriormente usamos las opciones ya cargadas en memoría, esto pasa si cargamos antes el manejadorBD con la config del JSON
  	if (!isset(self::$json))
  	  self::cargarJSON();

  	echo '<link href="'.pathGen::pathCss("bootstrap.css").'" rel="stylesheet">';
  	echo '<link href="'.pathGen::pathCss("bootstrap-responsive.css").'" rel="stylesheet">';
  	echo '<link href="'.pathGen::pathCss("fuentes.css").'" rel="stylesheet">';
  	echo '<link href="'.pathGen::loadCss().'" rel="stylesheet">';
  }

  public static function cargarHead($admin){
    if(!$admin)
      include 'src/templates/header/templateHeadHome.php';
    else
      include 'src/templates/header/templateHeadAdmin.php';
  }
  
  /*
   * De momento es la misma funcion que arriba, pero alomejor nos interesa cambiar algo
   */
  public static function cargarHojasEstilosAdmin(){
  	if (!isset(self::$json))
  	  self::cargarJSON();
    	
  	echo '<link href="'.pathGen::pathCss("bootstrap.css").'" rel="stylesheet">';
  	echo '<link href="'.pathGen::pathCss("bootstrap-responsive.css").'" rel="stylesheet">';
  	echo '<link href="'.pathGen::pathCss("fuentes.css").'" rel="stylesheet">';
  	echo '<link href="'.pathGen::loadCss().'" rel="stylesheet">';
  }
  
  public static function cargarJsAdmin(){
	echo '<script src="'.pathGen::pathJs("jquery.js").'"></script>';
        echo '<script src="'.pathGen::pathJs("bootstrap.js").'"></script>';
        echo '<script src="'.pathGen::pathJs("epiceditor/js/toMarkdown.js").'"></script>';
        echo '<script src="'.pathGen::pathJs("epiceditor/js/epiceditor.js").'"></script>';
        echo '<script src="'.pathGen::pathJs("canvasjs.js").'"></script>';
        echo '<script src="'.pathGen::pathJs("dashboard.js").'"></script>';         
	      echo '<script src="'.pathGen::pathJs("panelAdmin.js").'"></script>';
  }
  
  /*
   * Muestra la página de error con el mensaje de error que se le pase por parametro, el codigo de error por defecto es el 1, si quisiesemos estilar distinto algún error se le cambia el codigo
   * de error
   */
  public static function mostrarPaginaError($mensajeError, $codigoError = 1){
	header("Location: ".pathGen::pathError($mensajeError, $codigoError));
	
  }
  
  public static function getOpenBlogDir(){
        $ruta = "";
        $dir =  __DIR__;
        $dirArray = explode( DIRECTORY_SEPARATOR, $dir);

        $i = 1;

        while($dirArray[$i] != 'OpenBlog' && $i < sizeof($dirArray)){
            $ruta= $ruta . "/". $dirArray[$i];
            $i++;
        }                         
        return $ruta;	
  }
  public static function getIndexDir(){
        $ruta = "";
        $index = "/OpenBlog/index.php";
        $dir =  __DIR__;
        $dirArray = explode( DIRECTORY_SEPARATOR, $dir);

        $i = 1;

        while($dirArray[$i] != 'OpenBlog' && $i < sizeof($dirArray)){
            $ruta= $ruta . "/". $dirArray[$i];
            $i++;
        }                         
        return $ruta.$index; 
  }
  public static function iniciarSesion(){
      if(!isset($_SESSION)){
          session_start();
      }
  }

  public static function getRootDirectory(){
    return $_SERVER['HTTP_HOST'].self::getOpenBlogDir()."/OpenBlog";
  }
  
  /* Funcion que comprueba si OpenBlog está instalado en el sistema
  */
  public static function isInstalled(){
    # Si no existe el JSON se da por hecho que no esta instalado
    try{      
      if(!self::cargarJSON())
        return false;
      else{
        ## Si existe el JSON pero no tiene puesto el nombre BD da por hecho que no está instalado
        if(!isset(self::$json['nombreBd']))
          return false;
      }
    }catch(Exception $e){
      return false;;
    }
    # Añadir mas comprobaciones?
    return true;
  }

}

?>