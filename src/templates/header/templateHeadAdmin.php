<?php
    use src\helpers\pathGen
?>
<head>
	<meta charset="utf-8">
	<title>OpenBlog</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="<?php echo pathGen::pathRaiz(); ?>">

	<!-- Le styles -->
	<?php src\helpers\Header::cargarHojasEstilosAdmin(); ?>	
	<!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo pathGen::pathIco("favicon.ico") ?>">
</head>