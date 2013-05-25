<?php
	include "autoloader.php";

	use src\helpers\Validador;
	use src\helpers\ManejadorBD;
	use src\entidades\Comentario;
	use src\helpers\Header;

	Header::cargarJSON();

	if(isset($_POST['autor']) && isset($_POST['idPost']) && isset($_POST['textoComentario']) ){
		$autor = $_POST['autor'];
		$idPost = $_POST['idPost'];
		$textoComentario = $_POST['textoComentario'];

		//Validaciones
		if(Validador::estaVacio($textoComentario) || 
		Validador::estaVacio($autor) || Validador::estaVacio($idPost)){
			mostrarError("No puede haber ningún campo vacio");
		}else{
			$now = date("Y-m-d H:i:s");
			$comentario = new Comentario(null, $textoComentario, $now, $autor, $idPost);

			$comentario->setTexto($textoComentario);
			$comentario->setFecha($now);
			$comentario->setIdUsuario($autor);
			$comentario->setIdPost($idPost);

			//Comprobar que no se haya insertado el comentario antes NO HACE FALTA
			insertarComentario($comentario);
			mostrarMensajeExito();
		}

	}else{
		//MOSTRAR PAGINA ERROR
		echo "No se ha agregado el comentario, hay un error con los datos ";
		echo Validador::estaVacio("");
	}

	function mostrarError($error){
		echo $error;
	}
	
	/*
		Implementar la funcion que saque los ultimos comentarios de un usuario en un post para saber si está repetido el comentario
	*/
	function insertarComentario($comentario){
			$bd = new ManejadorBD(Header::$json);
			//$bd->createComentario($comentario);
	}

	function mostrarMensajeExito(){
		// Estilar el mensaje de exito al agregar un comentario
		echo "<div class='alert alert-success'>";
			echo "Se ha agregado correctamente el comentario a la base de datos";
			echo "<br/>";
			echo "<a href='#'>ver comentarios</a>";
		echo "</div>";
	}

?>