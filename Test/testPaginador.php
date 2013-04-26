<link href="../Recursos/css/bootstrap.css" rel="stylesheet">
<link href="../Recursos/css/bootstrap-responsive.css" rel="stylesheet">
<link href="../Recursos/css/fuentes.css" rel="stylesheet">
<link href=<?php echo '../'.$json["rutaCss"] ?> rel="stylesheet">
<?php
	require_once("../autoloader.php");

	$paginador = new Paginador();

	echo "<div class='pagination'>";
		echo "<ul>";
		echo $paginador->generarLinksDePaginas();
		echo "</ul>";
	echo "</div>";

?>
