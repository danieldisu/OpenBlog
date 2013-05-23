<?php

namespace src\helpers;

Class Sidebar{

	public static function addCajaLogin(){
		$nombreUsuario = Login::getNombre();
		$isLoged = Login::isLogin();
		$isAdmin = Login::isAdmin();
		include "src/templates/sidebar/templateCajaLogin.php";
	}

	public static function addCajaUltimosPost($mbd){
		$posts = $mbd->obtenerUltimosPost();
		include 'src/templates/sidebar/templateCajaUltimosPost.php';
	}

	public static function addCajaUltimosComentarios($mbd){
	   	$comentarios = $mbd->obtenerUltimosComentarios();       
		include 'src/templates/sidebar/templateCajaUltimosComentarios.php';
	}

	public static function addCajaCategorias($mbd){
		//REFACTORIZAR CAJA CATEGORIAS  
		$categorias = $mbd->obtenerCategorias();
		// Lo ideal seria así como NubreCategoriasHelper::generarNube($categorias);
		include 'src/templates/sidebar/templateCajaCategorias.php';
	}
}

?>