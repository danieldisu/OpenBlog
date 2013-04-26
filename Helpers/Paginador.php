<?php

Class Paginador{

	private $paginasTotales;
	private $postsTotales;
	private $postsPorPagina = 5;

	public function __construct(){
		$m = new ManejadorBD();
		
		$this->postsTotales = $m->getNumeroTotalPosts();

		$this->paginasTotales = ceil($this->postsTotales / $this->postsPorPagina);

		$this->generarLinksDePaginas();
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

		if($numeroUltimaPagina > 1){
			echo $this->generarLink(0);
		}else{
			echo $this->generarLink(0);
		}
	}

	private function generarLink($numPagina){
		$numPagina++;
		//$link = "<a href='../index.php?p='".$numPagina.";
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