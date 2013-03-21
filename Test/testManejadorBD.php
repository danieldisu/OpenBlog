<?php
    //Cargamos la clase a testear
    require_once("../Helpers/ManejadorBD.php");
    //Cargamos las distintas entidades que serán usadas por ManejadorBD
    //Notar que están en el orden necesario debido a las restricciones con clave ajena
    //Ejemplo: No se puede crear un Post si antes no hay creado ningún usuario (debido a que el post necesita la id del usuario)
    require_once("../Entidades/Categoria.php");
    require_once("../Entidades/Rol.php");
    require_once("../Entidades/Usuario.php");
    require_once("../Entidades/Post.php");
    require_once("../Entidades/Comentario.php");
    
    //Creamos la clase a probar (ManejadorBD)
    $m = new ManejadorBD();
    //Creamos una categoria de prueba (notese que el null es por la id que es autoincrementable)
    $categoria = new Categoria(null, "python", "Categoria dedicada al lenguaje Python");
    $m->createCategoria($categoria);
    
    //Creamos un rol de prueba
    $rol = new Rol(null, "usuario", "La descripcion de usuario");
    $m->createRol($rol);
    
    //Creamos un usuario de prueba
    $usuario = new Usuario(null, "adonai", "adonai", "adoargu@gmail.com", 1);
    $m->createUsuario($usuario);
    
    //Creamos un post de prueba
    $post = new Post(null, 1, 1, "Ubuntu", "Dentro de poco saldrá Ubuntu 13.04", "2013-03-20 15:50:30", null, 0);
    $m->createPost($post);
    
    //Creamos un comentario de prueba
    $comentario = new Comentario(null, "Si, y se denominara Raring Ringtail", "2013-03-20 15:50:30", 1, 1);
    $m->createComentario($comentario);
    
    //Conseguimos los datos del post con id = 1 y mostramos su titulo y su texto
    $p = $m->getPost(1);
    echo $p->getTitulo();
    echo $p->getTexto();
    
    //Actualizamos el post con id = 1 con otro titulo y texto distinto y lo mostramos
    $post = new Post(null, 1, 1, "Windows", "La version de windows es la 8", "2013-03-20 15:50:30", null, 0);
    $m->updatePost(1, $post);
    $l = $m->getPost(1);
    echo $l->getTitulo();
    echo $l->getTexto();
    
    //Borramos el titulo con id = 1
    //$m->deletePost(1);
    
    
       
    
?>
