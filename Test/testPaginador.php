<link href="Recursos/css/bootstrap-responsive.css" rel="stylesheet">
<link href="Recursos/css/bootstrap.css" rel="stylesheet">
<link href="Recursos/css/fuentes.css" rel="stylesheet">
<link href=<?php echo '../'.$json["rutaCss"] ?> rel="stylesheet">

<?php
	require_once("../autoloader.php");

	$paginador = new Paginador();
	
	$paginador->debugInfo();

	echo "<br>";
	echo $paginador->getNumeroPrimerPostPagina(1);
	echo "<br>";
?>

<a href="">1</a>
<a href="">2</a>
<a href="">3</a>
<a href="">..</a>
<a href="">15</a>