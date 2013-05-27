<?php
	//Instanciar mbd
	include_once '../autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
	use src\entidades\Usuario;
	$mbd = new ManejadorBD(Header::cargarJSON());
	session_start();
	$nombre = $_REQUEST['nombre'];
	$mail = $_REQUEST['correo'];
	$newPass = $_REQUEST['nuevaPass'];
	$pass = $_REQUEST['adminPass'];
	//Obtener el id del usuario con ese nombre
	$usuario = $mbd->getUsuarioByName($nombre);
	$idUsuario = $usuario->getId();
	$rolUsuario = $usuario->getIdRol();
	$rol = $mbd -> getRol ($rolUsuario);

	//Comprobamos que el usuario introducido sea admin
	$rol = $mbd->getRol($rolUsuario);
	if($rol->getNombre() == 'administrador'){
		//Comprobamos que el usuario con $id tenga $pass
		$passUsuario = $usuario->getPass();
		if($pass == $passUsuario){
			//Creamos un objeto usuario que mandaremos a la funcion updateUsuario($id, Usuario $usuario)
			$userToUpdate = new Usuario(null, '','','', null);
			$userToUpdate->setId($idUsuario);
			$userToUpdate->setNombre($nombre);
			$userToUpdate->setMail($mail);
			$userToUpdate->setIdRol($rolUsuario);
			//Actualizamos la cookie de sesion
			$_SESSION['usuario']['nombre'] = $nombre;
			$_SESSION['usuario']['id'] = $idUsuario;
			$_SESSION['usuario']['mail'] = $mail;
			$_SESSION['usuario']['idRol'] = $rolUsuario;
			//Comprobamos que $newPass esté vacio o no
			if(empty($newPass)){
				//Actualizar sin cambio de pass
				$userToUpdate->setPass($pass);
				$mbd-> updateUsuario($idUsuario, $userToUpdate);
				$datosArray  = array('cambio' => true ,'descripcion' => 'Cambios realizados con éxito');
			    $datos = json_encode($datosArray);
			    echo $datos;
			}else{
				//Actualizar con cambio de pass
				$userToUpdate->setPass($newPass);
				$mbd-> updateUsuario($idUsuario, $userToUpdate);
				$datosArray  = array('cambio' => true ,'descripcion' => 'Cambios realizados con éxito');
			    $datos = json_encode($datosArray);
			    echo $datos;
			}
		}
		else {
			// Password incorrecta
			$datosArray  = array('cambio' => false ,'descripcion' => 'Password incorrecta');
		    $datos = json_encode($datosArray);
		    echo $datos;
		}	
	}else {
		// Usuario no administrador
		$datosArray  = array('cambio' => false ,'descripcion' => 'El usuario no es administrador');
	    $datos = json_encode($datosArray);
	    echo $datos;
	}
?>
