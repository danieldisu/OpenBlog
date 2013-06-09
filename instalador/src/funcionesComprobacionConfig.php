<?php


function existeConfig($mcon){
	if(!($config = $mcon->cargarConfig())){
		addEstilos();
		mostrarError('No existe o no se puede acceder al archivo config');
		mostrarMensajeSolucion(1);
		return false;
	}else{
		return $config;
	}
}

function existeRaiz($mcon, $config){
	if(isset($config['raiz'])){
		return true;
	}else{
		mostrarError('No ha indicado una ruta en el archivo config');
		return false;
	}
}

function addEstilos(){
	echo "
		<style>
		body{
			color: #333;
		}
			.cajaMensajeError{
				  padding: 8px 35px 8px 14px;
				  margin-bottom: 20px;
				  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
				  background-color: #fcf8e3;
				  border: 1px solid #fbeed5;
				  -webkit-border-radius: 4px;
				     -moz-border-radius: 4px;
				          border-radius: 4px;
				    color: #b94a48;
				  background-color: #f2dede;
				  border-color: #eed3d7;
			}
		</style>
	";
}

function mostrarError($mensajeError){
	echo "<div class='cajaMensajeError'> 
				<p>$mensajeError</p>
			</div>";
}

function mostrarMensajeSolucion($tipo){
	if($tipo == 1){
		echo "
	<div class='mensajeSolucion'>
	<h2> Posibles soluciones: </h2>
		<p>Compruebe que exista el archivo <span> config.json </span> en el directorio <span>OpenBlog/config</span></p>
		<p>Compruebe que el usuario del servidor web tenga los permisos adecuados ( escritura / lectura )</p>
	</div>
	";
	}
}