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
    
    //+++++++++++++
    //+COMENTARIO++
    //+++++++++++++
    
    //Conseguimos los datos del comentario con id = 1 y mostramos su texto y fecha
    $co = $m->getComentario(1);
    echo $co->getTexto()." ";
    echo $co->getFecha()."<br />";
    
    //Actualizamos el comentario con id = 1 con otro texto y fecha y lo mostramos
    $comentarioPrueba = new Comentario(null, "Esto es un comentario", "2013-01-23 18:06:06", 1, 1);
    $m->updateComentario(1, $comentarioPrueba);
    $co2 = $m->getComentario(1);
    echo $co2->getTexto()." ";
    echo $co2->getFecha()."<br />";
       
    //Borramos la categoria con id = 1
    //$m->deleteComentario(1);
    
    
    //+++++++++++++
    //++++POST+++++
    //+++++++++++++

    //Conseguimos los datos del post con id = 1 y mostramos su titulo y su texto
    $p = $m->getPost(1);
    echo $p->getTitulo()." ";
    echo $p->getTexto()."<br />";
    
    //Actualizamos el post con id = 1 con otro titulo y texto distinto y lo mostramos
    $postPrueba = new Post(null, 1, 1, "Windows", "La version de windows es la 8", "2013-03-20 15:50:30", null, 0);
    $m->updatePost(1, $postPrueba);
    $p2 = $m->getPost(1);
    echo $p2->getTitulo()." ";
    echo $p2->getTexto()."<br />";
    
    //Borramos el titulo con id = 1
    //$m->deletePost(1);
    
    
    //+++++++++++++
    //+++USUARIO+++
    //+++++++++++++
    
    //Conseguimos los datos del usuario con id = 1 y mostramos su nombre y mail
    $u = $m->getUsuario(1);
    echo $u->getNombre()." ";
    echo $u->getMail()."<br />";
    
    //Actualizamos el usuario con id = 1 con otro nombre y mail y lo mostramos
    $usuarioPrueba = new Usuario(null, "Daniel", "daniel", "daniel@gmail.com", 1);
    $m->updateUsuario(1, $usuarioPrueba);
    $u2 = $m->getUsuario(1);
    echo $u2->getNombre()." ";
    echo $u2->getMail()."<br />";
       
    //Borramos el usuario con id = 1
    //$m->deleteUsuario(1);
    
    //+++++++++++++
    //++CATEGORIA++
    //+++++++++++++
    
    //Conseguimos los datos de la categoria con id = 1 y mostramos su nombre y descripcion
    $c = $m->getCategoria(1);
    echo $c->getNombre()." ";
    echo $c->getDescripcion()."<br />";
    
    //Actualizamos la categoria con id = 1 con otro nombre y descripcion y lo mostramos
    $categoriaPrueba = new Categoria(null, "JSON", "se dice yeison no jotasón");
    $m->updateCategoria(1, $categoriaPrueba);
    $c2 = $m->getCategoria(1);
    echo $c2->getNombre()." ";
    echo $c2->getDescripcion()."<br />";
       
    //Borramos la categoria con id = 1
    //$m->deleteCategoria(1);
    
    
    
    //+++++++++++++
    //+++++ROL+++++
    //+++++++++++++
    
    //Conseguimos los datos del rol con id = 1 y mostramos su nombre y descripcion
    $r = $m->getRol(1);
    echo $r->getNombre()." ";
    echo $r->getDescripcion()."<br />";
    
    //Actualizamos el rol con id = 1 con otro nombre y descripcion y lo mostramos
    $rolPrueba = new Rol(null, "administrador", "funciones de administrador");
    $m->updateRol(1, $rolPrueba);
    $r2 = $m->getRol(1);
    echo $r2->getNombre()." ";
    echo $r2->getDescripcion()."<br />";
       
    //Borramos el rol con id = 1
    //$m->deleteRol(1);
    
?>
