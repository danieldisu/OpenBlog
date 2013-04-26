<?php

Class Header{

	public static function cargarHojasDeEstilos($json){

		$rutaCSS = $json["rutaCss"];
		echo '<link href="Recursos/css/bootstrap.css" rel="stylesheet">';
		echo '<link href="Recursos/css/bootstrap-responsive.css" rel="stylesheet">';
		echo '<link href="Recursos/css/fuentes.css" rel="stylesheet">';
		echo '<link href="'.$rutaCSS.'" rel="stylesheet">';
	}

}

?>