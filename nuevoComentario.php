<?
	/* Pagina a la que enviará el formulario de agregar un nuevo comentario, recibirá los siguientes parametros que son necesarios para agregar un nuevo comentario en el sistema.
	Recibe por el metodo Post:
	- autor
	- idPost
	- textoComentario
	*/
	require_once("autoloader.php");
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

			//Comprobar que no se haya insertado el comentario antes
			insertarComentario($comentario);
			mostrarMensajeExito();
		}

	}else{
		//MOSTRAR PAGINA ERROR
		echo "No se ha agregado el comentario, hay un error con los datos";
		echo Validador::estaVacio("");
	}

	function mostrarError($error){
		echo $error;
	}

	/*
	*	Funcion que averigua si el comentario a insertar está ya en la base de datos, de momento solo tiene en cuenta que el usuario no haya escrito un post con el mismo texto
	*/
	function comentarioRepetido($comentario, $comentarios){
		$comentarioRepetido = false;
		foreach ($comentarios as $coment) {
			if(($coment->getIdUsuario() == $comentario->getIdUsuario()) && $coment->getTexto() == $comentario->getTexto()){
				$comentarioRepetido = true;
			}
		}

		return $comentarioRepetido;
	}

	/*
		Implementar la funcion que saque los ultimos comentarios de un usuario en un post para saber si está repetido el comentario
	*/
	function insertarComentario($comentario){
			$bd = new ManejadorBD(Header::$json);

			$comentarios = $bd->obtenerUltimosComentarios($comentario->getIdPost());
			
			if(!comentarioRepetido($comentario, $comentarios)){
				$bd->createComentario($comentario);
			}else{
				mostrarError("Comentario duplicado");
			}
	}

	function mostrarMensajeExito(){
		// Estilar el mensaje de exito al agregar un comentario
		echo "Se ha agregado correctamente el comentario a la base de datos";
		$backLink = htmlentities($_SERVER['HTTP_REFERER']);
		echo "<br/>";
		echo "<a href='$backLink'>Volver atras</a>";
	}

?>