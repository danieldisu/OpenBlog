<?php
namespace src\helpers;
Class Paginador{

	private $paginasTotales;
	private $postsTotales;
	private $postsPorPagina = 5;

	public function __construct(){
		$m = new ManejadorBD();
		
		$this->postsTotales = $m->getNumeroTotalPosts();

		$this->paginasTotales = ceil($this->postsTotales / $this->postsPorPagina);
	}

    public function mostrarLinks(){
        if(isset($_GET['p'])){
            $paginaActual = $_GET['p'];
            $paginas = $this->generarLinksDePaginas($paginaActual);
        }
        else{
            $paginas = $this->generarLinksDePaginas();
        }
        echo "<div class='pagination pagination-large'>";
            echo "<ul>";
            echo $paginas;
            echo "</ul>";
        echo "</div>";
    }

	/*
		Funcion que te devuelve el numero del primer post de la pagina que le indiques 
	*/
	public function getNumeroPrimerPostPagina($numeroPagina){
		if($numeroPagina == 1){
			return 0;
		}else{
			return $this->postsPorPagina * $numeroPagina -1;
		}
		
	}

	public function generarLinksDePaginas($paginaActual = 1){
		$numeroPrimeraPagina = 1;
		$numeroUltimaPagina = $this->paginasTotales;
        $maximoLinksGenerados = 4;
        $linksPaginasGenerados = 1;
        $cabenTodos = false;

        // Si la cantidad de links generados que hemos elegido es mayor al numero de paginas que hay, se coge el numero de paginas como el numero de links a mostrar
        if($maximoLinksGenerados > $numeroUltimaPagina)
            $maximoLinksGenerados = $numeroUltimaPagina;

        // Si el maximo de links a generar es igual al numero de páginas totales se da por hecho que caben todos y no hace falta mostrar los puntos ni nada
        if($maximoLinksGenerados == $numeroUltimaPagina)
            $cabenTodos = true;

        $linksGenerados = "";

		if($numeroUltimaPagina > 1){ // Si hay mas de una pagina
            //Generamos el link a la pagina anterior
            if($paginaActual != 1)
                $linksGenerados = $linksGenerados . $this->generarLinkAnterior($paginaActual);

            //Generamos el link a la primera pagina
			$linksGenerados = $linksGenerados . $this->generarLink($numeroPrimeraPagina, $paginaActual);
            $linksPaginasGenerados++;
            //Generamos el link a las paginas que hayamos decidido en la variable $maximoLinksGenerados, hay que tener en cuenta que son 3 links al principio + 1 a la ultima pagina
            while( $linksPaginasGenerados < $maximoLinksGenerados -1 ){

                if( $numeroPrimeraPagina + 1 < $numeroUltimaPagina ){

                    $linksGenerados = $linksGenerados . $this->generarLink($linksPaginasGenerados, $paginaActual);
                    $linksPaginasGenerados++;

                }else{

                    $linksGenerados = $linksGenerados . $this->generarLink($numeroUltimaPagina, $paginaActual);

                }                
            }
            //Ponemos los ... para que nos dejé seleccionar a que pagina queremos ir, esto es un to-do...
            $linkPuntos = "<li><a href=''> ... </a></li>";
            
            //Averiguamos si el link a la pagina actual se podria considerar que está en medio ( que no se muestra en los links que se generan por defecto)
            //Y tambien si caben todos, en caso de que sea del medio y no quepan todos se muestra el link a la pagina actual entre dos ...
            if($this->paginaDelMedio($paginaActual) && !$cabenTodos){
                $linksGenerados = $linksGenerados . $linkPuntos;
                $linksGenerados = $linksGenerados . $this->generarLink($paginaActual, $paginaActual);
            }

            if(!$cabenTodos)
                $linksGenerados = $linksGenerados . $linkPuntos;

            //Generamos el enlace a la ultima pagina y penultima
            $linksGenerados = $linksGenerados . $this->generarLink($this->paginasTotales-1, $paginaActual);
            $linksGenerados = $linksGenerados . $this->generarLink($this->paginasTotales, $paginaActual);

            //Generamos el link de siguiente
            if($paginaActual != $numeroUltimaPagina)
                $linksGenerados = $linksGenerados . $this->generarLinkSiguiente($paginaActual);       

		}else{
			echo $this->generarLink(1, $paginaActual);
		}

        return $linksGenerados;
	}

    /*
        Funcion que devuelve true si la pagina actual está por la mitad y habria que mostrarla entre los ... 
    */
    private function paginaDelMedio($paginaActual){
        $numeroUltimaPagina = $this->paginasTotales;
        if($paginaActual == 1 || $paginaActual == 2 || $paginaActual == 3 || $paginaActual == $numeroUltimaPagina || $paginaActual == ($numeroUltimaPagina-1))
            return false;
        else
            return true;
    }

	private function generarLink($numPagina, $paginaActual){
        if($numPagina == $paginaActual){
            $link = '<li class="active"><a>'.$numPagina.'</a></li>';
        }else{
            $link = '<li><a href="index.php?p='.$numPagina.'">'.$numPagina.'</a></li>';
        }	
		return $link;
	}

    private function generarLinkAnterior($paginaActual){
        $numPagina = $paginaActual - 1;
        $link = '<li><a href="index.php?p='.$numPagina.'"> << </a></li>';
        return $link;
    }

    private function generarLinkSiguiente($paginaActual){ 
        $numPagina = $paginaActual+1; 
        $link = '<li><a href="index.php?p='.$numPagina.'"> >> </a></li>'; 
        return $link; 
    }

	public function debugInfo(){
		echo "Hay un total de $this->postsTotales posts";
		echo "<br/>";
		echo "Lo que hacen un total de $this->paginasTotales paginas";
		echo "<br/>";
	}




    /**
     * Gets the value of paginasTotales.
     *
     * @return mixed
     */
    public function getPaginasTotales()
    {
        return $this->paginasTotales;
    }

    /**
     * Sets the value of paginasTotales.
     *
     * @param mixed $paginasTotales the paginasTotales
     *
     * @return self
     */
    public function setPaginasTotales($paginasTotales)
    {
        $this->paginasTotales = $paginasTotales;

        return $this;
    }

    /**
     * Gets the value of postsTotales.
     *
     * @return mixed
     */
    public function getPostsTotales()
    {
        return $this->postsTotales;
    }

    /**
     * Sets the value of postsTotales.
     *
     * @param mixed $postsTotales the postsTotales
     *
     * @return self
     */
    public function setPostsTotales($postsTotales)
    {
        $this->postsTotales = $postsTotales;

        return $this;
    }

    /**
     * Gets the value of postsPorPagina.
     *
     * @return mixed
     */
    public function getPostsPorPagina()
    {
        return $this->postsPorPagina;
    }

    /**
     * Sets the value of postsPorPagina.
     *
     * @param mixed $postsPorPagina the postsPorPagina
     *
     * @return self
     */
    public function setPostsPorPagina($postsPorPagina)
    {
        $this->postsPorPagina = $postsPorPagina;

        return $this;
    }
}
	
?>