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

	if(isset($_POST['autor']) && isset($_POST['idPost']) && isset($_POST['textoComentario']) ){
		$autor = $_POST['autor'];
		$post = $_POST['idPost'];
		$textoComentario = $_POST['textoComentario'];

		//Validaciones
		print_r(Validador::estaVacio("a"));

	}else{
		//MOSTRAR PAGINA ERROR
		echo "No se ha agregado el comentario, hay un error con los datos";
		echo Validador::estaVacio("");
	}

?>