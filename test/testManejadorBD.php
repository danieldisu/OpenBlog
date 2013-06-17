<?php
    
    require_once("../Helpers/ManejadorBD.php");
    
    
    
    require_once("../Entidades/Categoria.php");
    require_once("../Entidades/Rol.php");
    require_once("../Entidades/Usuario.php");
    require_once("../Entidades/Post.php");
    require_once("../Entidades/Comentario.php");
    
   
    $m = new ManejadorBD();
   
    $categoria = new Categoria(null, "python", "Categoria dedicada al lenguaje Python");
    $m->createCategoria($categoria);
    
   
    $rol = new Rol(null, "usuario", "La descripcion de usuario");
    $m->createRol($rol);
    
   
    $usuario = new Usuario(null, "adonai", "adonai", "adoargu@gmail.com", 1);
    $m->createUsuario($usuario);
    
   
    $post = new Post(null, 1, 1, "Ubuntu", "Dentro de poco saldrá Ubuntu 13.04", "2013-03-20 15:50:30", null, 0);
    $m->createPost($post);
    
   
    $comentario = new Comentario(null, "Si, y se denominara Raring Ringtail", "2013-03-20 15:50:30", 1, 1);
    $m->createComentario($comentario);
   
         
    $co = $m->getComentario(1);
    echo $co->getTexto()." ";
    echo $co->getFecha()."<br />";
    
   
    $comentarioPrueba = new Comentario(null, "Esto es un comentario", "2013-01-23 18:06:06", 1, 1);
    $m->updateComentario(1, $comentarioPrueba);
    $co2 = $m->getComentario(1);
    echo $co2->getTexto()." ";
    echo $co2->getFecha()."<br />";
       
   
    $p = $m->getPost(1);
    echo $p->getTitulo()." ";
    echo $p->getTexto()."<br />";
    
    $postPrueba = new Post(null, 1, 1, "Windows", "La version de windows es la 8", "2013-03-20 15:50:30", null, 0);
    $m->updatePost(1, $postPrueba);
    $p2 = $m->getPost(1);
    echo $p2->getTitulo()." ";
    echo $p2->getTexto()."<br />";
    
    $u = $m->getUsuario(1);
    echo $u->getNombre()." ";
    echo $u->getMail()."<br />";
    
    $usuarioPrueba = new Usuario(null, "Daniel", "daniel", "daniel@gmail.com", 1);
    $m->updateUsuario(1, $usuarioPrueba);
    $u2 = $m->getUsuario(1);
    echo $u2->getNombre()." ";
    echo $u2->getMail()."<br />";
       
    $c = $m->getCategoria(1);
    echo $c->getNombre()." ";
    echo $c->getDescripcion()."<br />";
    
    $categoriaPrueba = new Categoria(null, "JSON", "se dice yeison no jotasón");
    $m->updateCategoria(1, $categoriaPrueba);
    $c2 = $m->getCategoria(1);
    echo $c2->getNombre()." ";
    echo $c2->getDescripcion()."<br />";
       
    $r = $m->getRol(1);
    echo $r->getNombre()." ";
    echo $r->getDescripcion()."<br />";
    
    $rolPrueba = new Rol(null, "administrador", "funciones de administrador");
    $m->updateRol(1, $rolPrueba);
    $r2 = $m->getRol(1);
    echo $r2->getNombre()." ";
    echo $r2->getDescripcion()."<br />";
       
    
?>
