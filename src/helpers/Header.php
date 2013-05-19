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

	$rutaCSS = self::$json["rutaCss"];
	echo '<link href="resources/css/bootstrap.css" rel="stylesheet">';
	echo '<link href="resources/css/bootstrap-responsive.css" rel="stylesheet">';
	echo '<link href="resources/css/fuentes.css" rel="stylesheet">';
	echo '<link href="' . $rutaCSS . '" rel="stylesheet">';
  }
  
  /*
   * De momento es la misma funcion que arriba, pero alomejor nos interesa cambiar algo
   */
  public static function cargarHojasEstilosAdmin(){
	if (!isset(self::$json))
	  self::cargarJSON();
	
	$rutaCSS = self::$json["rutaCss"];
	echo '<link href="resources/css/bootstrap.css" rel="stylesheet">';
	echo '<link href="resources/css/bootstrap-responsive.css" rel="stylesheet">';
	echo '<link href="resources/css/fuentes.css" rel="stylesheet">';
	echo '<link href="' . $rutaCSS . '" rel="stylesheet">';	
  }
  
  public static function cargarJsAdmin(){
	echo '<script src="resources/js/jquery.js"></script>';
	echo '<script src="resources/js/panelAdmin.js"></script>';
  }
  
  /*
   * Muestra la página de error con el mensaje de error que se le pase por parametro, el codigo de error por defecto es el 1, si quisiesemos estilar distinto algún error se le cambia el codigo
   * de error
   */
  public static function mostrarPaginaError($mensajeError, $codigoError = 1){
	$host  = $_SERVER['HTTP_HOST'];
	$uri = self::getOpenBlogDir()."/OpenBlog";
	$extra = 'error.php';
	header("Location: http://$host$uri/$extra?c=$codigoError&error=$mensajeError");
	
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
}

?>