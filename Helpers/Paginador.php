<?php

Class Paginador{

	private $paginasTotales;
	private $postsTotales;
	private $postsPorPagina = 5;

	public function __construct(){
		$m = new ManejadorBD();
		
		$this->postsTotales = $m->getNumeroTotalPosts();

		$this->paginasTotales = ceil($this->postsTotales / $this->postsPorPagina);


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

	public function generarLinksDePaginas(){
		$numeroPrimeraPagina = 1;
		$numeroUltimaPagina = $this->paginasTotales;
        $maximoLinksGenerados = 4;
        $linksPaginasGenerados = 1;

        $linksGenerados = "";

		if($numeroUltimaPagina > 1){ // Si hay mas de una pagina
            //Generamos el link a la primera pagina
			$linksGenerados = $linksGenerados . $this->generarLink($numeroPrimeraPagina);
            $linksPaginasGenerados++;
            //Generamos el link a las paginas que hayamos decidido en la variable $maximoLinksGenerados, hay que tener en cuenta que son 3 links al principio + 1 a la ultima pagina
            while( $linksPaginasGenerados < $maximoLinksGenerados ){

                if( $numeroPrimeraPagina + 1 < $numeroUltimaPagina ){

                    $linksGenerados = $linksGenerados . $this->generarLink($linksPaginasGenerados);
                    $linksPaginasGenerados++;

                }else{

                    $linksGenerados = $linksGenerados . $this->generarLink($numeroUltimaPagina);

                }                
            }
            //Ponemos los ... para que nos dejé seleccionar a que pagina queremos ir, esto es un to-do...
            $linkPuntos = "<a href=''> ... </a>";
            $linksGenerados = $linksGenerados . $linkPuntos;

            //Generamos el enlace a la ultima pagina
            $linksGenerados = $linksGenerados . $this->generarLink($this->paginasTotales);
		}else{
			echo $this->generarLink(1);
		}

        return $linksGenerados;
	}

	private function generarLink($numPagina){
		$link = '<a href="../index.php?p='.$numPagina.'">'.$numPagina.'</a>';
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