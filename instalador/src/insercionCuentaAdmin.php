<?php
	$nombre = $_POST['nombre'];
	$mail = $_POST['mail'];
	$pass = $_POST['pass'];

	include_once '../../autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
	use src\entidades\Usuario;
	use src\entidades\Rol;

	$mbd = new ManejadorBD(Header::cargarJSON());

	# Dando por hecho que el usuario no existe en la tabla ob_usuario 
	
	# Creo un rol administrador
	$adminRol = new Rol(null, '', '');
	$adminRol->setId(2); 
	$adminRol->setNombre('administrador');
	$adminRol->setDescripcion('Tendr&aacute; acceso a todas las funcionalidades del post as&iacute; como a la adinistraci&oacute;n de los mismos y de los usuarios. Tambi&eacute;n podr&aacute; personalizar a su gusto el blog');
	

	# Crearemos tambien un rol usuario por defecto.
	$userRol = new Rol(null, '', '');
	$userRol->setId(1); 
	$userRol->setNombre('usuario');
	$userRol->setDescripcion('Podr&aacute; publicar comentario y ver gran parte del contenido del bog, pero no podr&aacute; borrar o modificar los comentarios ni podr&aacute; 	 crear nuevos post');
	
	# Creo un usuario administrador
	$newUser = new Usuario(null, '','','', null);
	$newUser->setId(1);
	$newUser->setNombre($nombre);
	$newUser->setMail($mail);
	$newUser->setPass($pass);
	$newUser->setIdRol(2);
	
	$respuesta = array();

	try {
		$mbd->createRol($adminRol);
		$mbd->createRol($userRol);
		$mbd->createUsuario($newUser);
		$respuesta['insercion'] = true;
	}catch(PDOException $e){
		$respuesta['insercion'] = false;
		$respuesta['error'] = $e->getMessage();
	}
	
	echo json_encode($respuesta);
?>