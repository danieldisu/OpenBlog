<?php

class DatosPrueba {
    private $instalador;
    private $manejadorBD;
    
    public function __construct() {
        $this->instalador = new Instalador();
        $this->manejadorBD = new ManejadorBD();
    }
    
    public function resetearTablas(){
        $this->instalador->borrarEstructuraTablas();
        $this->instalador->crearEstructuraTablas();
    }
    
    public function datosRapidos(){
        $this->crearRol(1); //Rol Usuario
        $this->crearRol(2); //Rol Administrador
        $this->crearCategoria(1); //Categoria PhP
        $this->crearCategoria(2); //Categoria CSS
        $this->crearUsuario(1); //Rol administrador (nombre: rafa, pass: rafa)
        $this->crearUsuario(2); //Rol usuario (nombre: adonai, pass: adonai)
        $this->crearUsuario(3); //Rol usuario (nombre: daniel, pass: daniel)

        // He agregado muchos post de prueba para probar la paginacion
        $this->crearPost(1); //Post (categoria: php, modificado: no)
        $this->crearPost(2); //Post (categoria: css, modificado: si[3])
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(2);
        $this->crearPost(1);
        $this->crearPost(2);
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(2);
        $this->crearPost(1);
        $this->crearPost(2);
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(2);
        $this->crearPost(1);
        $this->crearPost(2);
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(2);
        $this->crearPost(1);
        $this->crearPost(2);
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(4);
        $this->crearPost(3);
        $this->crearPost(2);
        $this->crearPost(1);
        $this->crearPost(2);
        $this->crearPost(3);
        $this->crearPost(4);        
        $this->crearComentario(1); //Comentario php
        $this->crearComentario(2); //Comentario php
        $this->crearComentario(3); //Comentario CSS
        $this->crearComentario(4); //Comentario CSS
        $this->crearComentario(5); //Comentario CSS (por el administrador)
    }
    
    public function crearRol($ejemplo){
        switch ($ejemplo){
            case 1 : $this->manejadorBD->createRol(new Rol(null, "usuario", "Podrá publicar comentario y ver gran parte del contenido del bog, pero no podrá borrar o modificar los comentarios así como no podrá crear nuevos post"));break;
            case 2 : $this->manejadorBD->createRol(new Rol(null, "administrador", "Tendrá acceso a todas las funcionalidades del post así como a la adinistración de los mismos y de los usuarios. También podrá personalizar a su gusto el blog"));break;
        }
    }
    
    public function crearCategoria($ejemplo){
        switch($ejemplo){
            case 1 : $this->manejadorBD->createCategoria(new Categoria(null, "php", "Categoría sobre el lenguaje de servidor, php."));break;
            case 2 : $this->manejadorBD->createCategoria(new Categoria(null, "css", "Categoría sobre las hojas de estilo y el diseño de las páginas web"));break;
        }
    }
    
    public function crearUsuario($ejemplo){
        switch ($ejemplo){
            case 1 : $this->manejadorBD->createUsuario(new Usuario(null, "rafa", "rafa", "rafa@gmail.com", 2));break;
            case 2 : $this->manejadorBD->createUsuario(new Usuario(null, "adonai", "adonai", "adonai@gmail.com", 1));break;
            case 3 : $this->manejadorBD->createUsuario(new Usuario(null, "daniel", "daniel", "daniel@gmail.com", 1));break;
        }
    }
    
    public function crearPost($ejemplo){
        switch ($ejemplo){
            case 1 : $this->manejadorBD->createPost(new Post(null, 1, 1, "PhP 5 y POO", "Uno de los grandes avances de php 5 ha sido incluir el paradigma de información orientada a objetos, el cual nos da una gran variedad de opciones así como mejor manejo del programa, encapsulamiento, etc. Se estima que pronto sacarán la version PhP6 con nuevas mejoras y más opciones", "2013-03-25 13:24:05", null, 0));break;
            case 2 : $this->manejadorBD->createPost(new Post(null, 1, 1, "PhP 5 y Programación orientada a objetos (POO)", "Uno de los grandes avances de php 5 ha sido incluir el paradigma de programación orientado a objetos (POO), el cual nos da una gran variedad de opciones así como mejor manejo del programa, encapsulamiento, etc. Se estima que pronto sacarán la version PhP6 con nuevas mejoras y más opciones", "2013-03-25 13:24:05", "2013-03-25 14:52:36", 1));break;
            case 3 : $this->manejadorBD->createPost(new Post(null, 1, 2, "Los 10 mejores trucos de CSS", "Ahora les vamos a presentar los 10 mejores trucos posibles que se pueden hacer con CSS, desde menús desplegables hasta efectos acordeón, pasando por cambios de estilo en fondos o de imagenes.", "2013-02-24 22:30:15", null, 0));break;
            case 4 : $this->manejadorBD->createPost(new Post(null, 1, 2, "Las 20 mejores aplicaciones de CSS3", "Vamos a hablar de las 20 mejores aplicaciones posibles que se pueden hacer con CSS3, desde menús desplegables hasta efectos acordeón, pasando por cajas rotativas y ¡Animaciones!.", "2013-02-24 22:30:15", "2013-03-01 08:02:17", 3));break;
        }
    }
    
    public function crearComentario($ejemplo){
        switch ($ejemplo){
            case 1 : $this->manejadorBD->createComentario(new Comentario(null, "Gran articulo sobre la programación orientada a objetos", "2013-03-25 16:13:59", 2, 1));break;
            case 2 : $this->manejadorBD->createComentario(new Comentario(null, "Esta bien pero podría corregirse algunos fallos que tienes... :/", "2013-03-25 22:58:41", 3, 1));break;
            case 3 : $this->manejadorBD->createComentario(new Comentario(null, "Alguno de los trucos son impresionantes =)", "2013-02-24 23:52:21", 2, 2));break;
            case 4 : $this->manejadorBD->createComentario(new Comentario(null, "Me encanta las animaciones", "2013-02-25 01:12:12", 3, 2));break;
            case 5 : $this->manejadorBD->createComentario(new Comentario(null, "Gracias gente :)", "2013-02-25 08:30:35", 1, 2));break;
        }
    }
}

?>
