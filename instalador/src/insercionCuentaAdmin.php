<?php
	$nombre = $_POST['nombre'];
	$mail = $_POST['mail'];
	$pass = $_POST['pass'];

	include_once '../../autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
	use src\entidades\Usuario;
	use src\entidades\Rol;
	use src\entidades\Post;

	$mbd = new ManejadorBD(Header::cargarJSON());

	# Dando por hecho que el usuario no existe en la tabla ob_usuario 
	
	# Creo un rol administrador
	$adminRol = new Rol(null, '', '');
	$adminRol->setNombre('administrador');
	$adminRol->setDescripcion('Tendr&aacute; acceso a todas las funcionalidades del post as&iacute; como a la adinistraci&oacute;n de los mismos y de los usuarios. Tambi&eacute;n podr&aacute; personalizar a su gusto el blog');
	

	# Crearemos tambien un rol usuario por defecto.
	$userRol = new Rol(null, '', '');
	$userRol->setNombre('usuario');
	$userRol->setDescripcion('Podr&aacute; publicar comentario y ver gran parte del contenido del bog, pero no podr&aacute; borrar o modificar los comentarios ni podr&aacute; 	 crear nuevos post');
	
	# Creo un usuario administrador
	$newUser = new Usuario(null, '','','', null);

	$newUser->setNombre($nombre);
	$newUser->setMail($mail);
	$newUser->setPass(md5($pass));
	$newUser->setIdRol(2);
	
	$respuesta = array();

	try {
		$mbd->createRol($userRol);
		$mbd->createRol($adminRol);
		$mbd->createUsuario($newUser);
		#	Creamos el post de bienvenida con el usuario que se acaba de crear
		addPostBienvenida($mbd);
		$respuesta['insercion'] = true;
	}catch(PDOException $e){
		$respuesta['insercion'] = false;
		$respuesta['error'] = $e->getMessage();
	}
	
	echo json_encode($respuesta);




function addPostBienvenida($mbd){
	$titulo = "Bienvenid@ a OpenBlog!";
	$texto = "Gracias por instalar la última versión de OpenBlog, disfruta de las nuevas características que hacen de OpenBlog la plataforma de bloggin de código abierto más popular.";
	$fechaCreacion = date("Y-m-d H:i:s");
	$nuevoPost = new Post();
	$nuevoPost->setIdCategoria(1);
	$nuevoPost->setIdUsuario(1);
	$nuevoPost->setFechaCreacion($fechaCreacion);
	$nuevoPost->setTexto($texto);
	$nuevoPost->setTitulo($titulo);

	$mbd->createPost($nuevoPost);
}