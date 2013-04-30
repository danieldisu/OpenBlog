<?php
	require_once("autoloader.php");

   Header::cargarHojasDeEstilos($json);

	$paginador = new Paginador();

	echo "<div class='pagination pagination-centered'>";
		echo "<ul>";
		echo $paginador->generarLinksDePaginas();
		echo "</ul>";
	echo "</div>";

?>