<?php

    require_once("../Helpers/ManejadorBD.php");
    require_once("../Entidades/Rol.php");
    require_once("../Entidades/Categoria.php");
    require_once("../Entidades/Post.php");
    require_once("../Entidades/Comentario.php");
    
    $manejador = new ManejadorBD();
    //$manejador->createRol(new Rol(null,"administrador","Descripcion del admin"));
    //$manejador->createCategoria(new Categoria(null,"python","Lenguaje python"));
    //$manejador->createComentario(new Comentario(null, "Texto del comentario", "12.12.2012", 1, 1));
    
?>
