<?php
	/*
		He creado este archivo para evitar problemas con las dependencias entre unas clases y otras que se nos podian generar y las distintas rutas desde un fichero a otro
		Solucion cutre : Cargar todos los ficheros
	*/

	/*
		Entidades
	*/
    require_once("Entidades/Categoria.php");
    require_once("Entidades/Rol.php");
    require_once("Entidades/Usuario.php");
    require_once("Entidades/Post.php");
    require_once("Entidades/Comentario.php");
    
	/*
		HELPERS
	*/
	require_once("Helpers/ManejadorConfig.php");
	$mj = new ManejadorConfig();
   $json = $mj->cargarConfig();
	require_once("Helpers/ManejadorBD.php");
	require_once("Helpers/Paginador.php");
	require_once("Helpers/Interfaz.php");
	require_once("Helpers/DatosPrueba.php");
	
	require_once("Helpers/Validador.php");
	require_once("Helpers/Instalador.php");

	/*
		Modulos que se repiten
	*/
	require_once("Header.php");
	//require_once("footer.php"); Cuando lo tengamos
	
	Header::cargarHojasDeEstilos($json);


?>