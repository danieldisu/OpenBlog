<?php
	
	include_once '../autoloader.php';
	use src\helpers\Header;
	use src\helpers\ManejadorBD;
	use src\entidades\Usuario;
	$mbd = new ManejadorBD(Header::cargarJSON());
	session_start();
	$nombre = $_REQUEST['nombre'];
	$mail = $_REQUEST['correo'];
	$newPass = md5($_REQUEST['nuevaPass']);
	$pass = md5($_REQUEST['adminPass']);
	//Obtener el id del usuario con ese nombre
	$idUsuario = $_REQUEST['idUsuario'];
	//$usuario = $mbd->getUsuarioByName($nombre);
	$usuario = $mbd->getUsuario($idUsuario);
	$rolUsuario = $usuario->getIdRol();
	$rol = $mbd -> getRol ($rolUsuario);

	
	$rol = $mbd->getRol($rolUsuario);
	if($rol->getNombre() == 'administrador'){
		
		$passUsuario = $usuario->getPass();
		if($pass == $passUsuario){
			
			$userToUpdate = new Usuario(null, '','','', null);
			$userToUpdate->setId($idUsuario);
			$userToUpdate->setNombre($nombre);
			$userToUpdate->setMail($mail);
			$userToUpdate->setIdRol($rolUsuario);
			
			$_SESSION['usuario']['nombre'] = $nombre;
			$_SESSION['usuario']['id'] = $idUsuario;
			$_SESSION['usuario']['mail'] = $mail;
			$_SESSION['usuario']['idRol'] = $rolUsuario;
			
			if(empty($newPass)){
				
				$userToUpdate->setPass($pass);
				$mbd-> updateUsuario($idUsuario, $userToUpdate);
				$datosArray  = array('cambio' => true ,'descripcion' => 'Cambios realizados con éxito');
			    $datos = json_encode($datosArray);
			    echo $datos;
			}else{
				
				$userToUpdate->setPass($newPass);
				$mbd-> updateUsuario($idUsuario, $userToUpdate);
				$datosArray  = array('cambio' => true ,'descripcion' => 'Cambios realizados con éxito');
			    $datos = json_encode($datosArray);
			    echo $datos;
			}
		}
		else {
			
			$datosArray  = array('cambio' => false ,'descripcion' => 'Password incorrecta');
		    $datos = json_encode($datosArray);
		    echo $datos;
		}	
	}else {
		
		$datosArray  = array('cambio' => false ,'descripcion' => 'El usuario no es administrador');
	    $datos = json_encode($datosArray);
	    echo $datos;
	}
?>
