<?php
namespace src\helpers;

use src\helpers\ManejadorConfig;

Class Header{
	public static $json;

	public static function cargarJSON(){
		//cargamos el json
		$manejadorConfig = new ManejadorConfig();
		self::$json = $manejadorConfig->cargarConfig();
		return self::$json;
	}

	public static function cargarHojasDeEstilos(){
		// en caso de que ya hayamos cargado el JSON anteriormente usamos las opciones ya cargadas en memoría, esto pasa si cargamos antes el manejadorBD con la config del JSON
		
		if(isset(self::$json))
			self::cargarJSON();

		$rutaCSS = self::$json["rutaCss"];
		echo '<link href="resources/css/bootstrap.css" rel="stylesheet">';
		echo '<link href="resources/css/bootstrap-responsive.css" rel="stylesheet">';
		echo '<link href="resources/css/fuentes.css" rel="stylesheet">';
		echo '<link href="'.$rutaCSS.'" rel="stylesheet">';
	}

}

?>