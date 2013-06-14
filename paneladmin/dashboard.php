<?php
	use src\helpers\ManejadorBD;
	$json = Header::cargarJSON();
	$mbd = new ManejadorBD($json);

	print_r($mbd->getAllCategorias());
?>

<script type="text/javascript">
	<?php 
		echo "var prueba = 'prueba'";
	?>
</script>

<script src="Chart.min.js"></script>