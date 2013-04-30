<?php
namespace src\helpers;

use src\helpers\ManejadorConfig;

Class Header{
	public static $json;

	public static function cargarJSON(){
		//cargamos el json
		$manejadorConfig = new ManejadorConfig();
		$json = $manejadorConfig->cargarConfig();
		return $json;
	}

	public static function cargarHojasDeEstilos(){
		self::$json = self::cargarJSON();
		$rutaCSS = self::$json["rutaCss"];
		echo '<link href="resources/css/bootstrap.css" rel="stylesheet">';
		echo '<link href="resources/css/bootstrap-responsive.css" rel="stylesheet">';
		echo '<link href="resources/css/fuentes.css" rel="stylesheet">';
		echo '<link href="'.$rutaCSS.'" rel="stylesheet">';
	}

}

?>