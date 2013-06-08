<?php
    include_once '../../autoloader.php';
    use src\helpers\Header;
    use src\helpers\ManejadorConfig;
    $mc = new ManejadorConfig();
    
    //Comprobaciones iniciales
    if(!is_writable($mc->getPrivateRutaConfig())){
        $datos["msn"] = "FATAL ERROR: ¡No se puede leer el archivo de configuración!";
        $datos["correcto"] = false;
        echo json_encode($datos);
        exit();
    }
    
    if(!isset($_POST["tipTitulo"]) || !isset($_POST["tipDescripcion"]) || !isset($_POST["tipEstilos"]) || !isset($_POST["tipLogo"])){
        $datos["msn"] = "Ha habido un error procesando los datos";
        $datos["correcto"] = false;
        echo json_encode($datos);
        exit();
    }
    
    //En caso afirmativo...
    $datos = array();
    $config = $mc->cargarConfig();
    
    $titulo = $_POST["tipTitulo"];
    $descripcion= $_POST["tipDescripcion"];
    $estilos = $_POST["tipEstilos"];
    $logo = $_POST["tipLogo"];
    
    //trim() es para quitar los espacios en blanco de un string tanto al principio como al final
    if(trim($titulo) != ""){
        $config["tituloBlog"] = $titulo;
    }else{
        $tituloPorDefecto = "OpenBlog";
        $config["tituloBlog"] = $tituloPorDefecto;
    }

    if(trim($descripcion) != ""){
        $config["descripcionBlog"] = $descripcion;
    }

    if(trim($estilos) != ""){
        $config["rutaCss"] = $estilos;
    }else{
        $rutaCssPorDefecto = "resources/css/estilos.css";
        $config["rutaCss"] = $rutaCssPorDefecto;
    }

    if(trim($logo) != ""){
        $config["logo"] = $logo;
    }else{
        $rutaLogoPorDefecto = "resources/betaLogo01.png";
        $config["logo"] = $rutaLogoPorDefecto;
    }
    
    $datos["correcto"] = true;
    
    $mc->guardarConfig($config);

    echo json_encode($datos);
?>