<?php 
	$i++; //Variable para comprobar que es el último.
	$numPosts = $mbd->obtenerNumPostPorCategoria($categoria->getId());
	$cantidad = array(	'idCategoria' => $categoria->getId(),
						'cantidadPost' => $numPosts
					 );
	array_push($cantidades, $cantidad);
	if($i == count($categorias)){
		# Si es la ultima vuelta de bucle
		# Ordenamos el array
		$cantidad = array();
		foreach ($cantidades as $indice => $valor)
		{
		    $cantidad[$indice] = $valor['cantidadPost'];
		}
		array_multisort($cantidad, SORT_DESC, $cantidades);
		# Una vez ordenado el array, por cada posición del array
		# Asignamos una clase especifica de css a los n primeros
		# Y al resto le asignamos una clase por defecto, para la creación de la nube
		$j = 0;
		$salida = array();
		foreach ($cantidades as $cantidad) {
			# Tenemos idCategoria y cantidadPost
			# Entonces según la cantidadPost le asignaremos una clase css
			# To-Do añadir enlace a post de x categoria
			switch ($j) {
				case 0:
					$lineaSalida ='<a href="" class="categoriaMayorCantidadPost">'.$mbd->obtenerNombreCategoria($cantidad['idCategoria']).'</a> ';
					break;
				case 1:
					$lineaSalida ='<a href="" class="categoriaSecundaria">'.$mbd->obtenerNombreCategoria($cantidad['idCategoria']).'</a> ';
					break;
				case 2:
					$lineaSalida ='<a href="" class="categoriaTerciaria">'.$mbd->obtenerNombreCategoria($cantidad['idCategoria']).'</a> ';
					break;
				case 3:
					$lineaSalida ='<a href="" class="categoriaCuarta">'.$mbd->obtenerNombreCategoria($cantidad['idCategoria']).'</a> ';
					break;
				default:
					$lineaSalida ='<a href="" class="categoriaNormal">'.$mbd->obtenerNombreCategoria($cantidad['idCategoria']).'</a> ';
					break;
			}
			$j++;
			array_push($salida, $lineaSalida);
		}
		# Para mostrar la salida de forma desordenada
		# Voy a guardar la salida, en un array de strings
		# Y voy a desordenarlo con shuffle()
		shuffle($salida);
		# Una vez desordenado voy a mostrar
		foreach ($salida as $lineaSalida) {
			echo $lineaSalida;
		}
	}
?>