<?php

class Instalador {
    public function __construct() {
        $this->borrarEstructuraTablas();
        $this->crearEstructuraTablas();
    }
    
    public function crearEstructuraTablas(){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sqlCategoria = "
                 CREATE TABLE ob_categoria (
                 id int(10) NOT NULL AUTO_INCREMENT,
                 nombre varchar(25) NOT NULL,
                 descripcion text NOT NULL,
                 PRIMARY KEY (id)
                 ) ENGINE=InnoDB DEFAULT CHARSET=latin1
            ";
            $sqlRol = "
                CREATE TABLE ob_rol (
                id int(10) NOT NULL AUTO_INCREMENT,
                nombre varchar(25) NOT NULL,
                descripcion text NOT NULL,
                PRIMARY KEY (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1  
            ";
            
            $sqlUsuario = "
                CREATE TABLE ob_usuario (
                id int(10) NOT NULL AUTO_INCREMENT,
                nombre varchar(25) NOT NULL,
                pass text NOT NULL,
                mail varchar(50) NOT NULL,
                idRol int(10) NOT NULL,
                PRIMARY KEY (id,idRol),
                UNIQUE KEY nombre (nombre,mail),
                KEY idRol (idRol),
                CONSTRAINT ob_usuario_ibfk_1 FOREIGN KEY (idRol) REFERENCES ob_rol (id) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
            ";
            $sqlPost = "
                CREATE TABLE ob_post (
                id int(10) NOT NULL AUTO_INCREMENT,
                idUsuario int(10) NOT NULL,
                idCategoria int(10) NOT NULL,
                titulo varchar(100) NOT NULL,
                texto text NOT NULL,
                fechaCreacion datetime NOT NULL,
                fechaModificacion datetime DEFAULT NULL,
                modificaciones int(10) NOT NULL,
                PRIMARY KEY (id,idUsuario,idCategoria),
                KEY idUsuario (idUsuario),
                KEY idCategoria (idCategoria),
                CONSTRAINT ob_post_ibfk_1 FOREIGN KEY (idUsuario) REFERENCES ob_usuario (id) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT ob_post_ibfk_2 FOREIGN KEY (idCategoria) REFERENCES ob_categoria (id) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
            ";
            $sqlComentario = "
                CREATE TABLE ob_comentario (
                id int(10) NOT NULL AUTO_INCREMENT,
                texto text NOT NULL,
                fecha datetime NOT NULL,
                idUsuario int(10) NOT NULL,
                idPost int(10) NOT NULL,
                PRIMARY KEY (id,idUsuario,idPost),
                KEY idUsuario (idUsuario),
                KEY idPost (idPost),
                CONSTRAINT ob_comentario_ibfk_1 FOREIGN KEY (idUsuario) REFERENCES ob_usuario (id) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT ob_comentario_ibfk_2 FOREIGN KEY (idPost) REFERENCES ob_post (id) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
            ";
            
            //**********************************
            
            
            $sentencia = $conn->prepare($sql);
            
            $idUsuario = $post->getIdUsuario();
            $idCategoria = $post->getIdCategoria();
            $titulo = $post->getTitulo();
            $texto = $post->getTexto();
            $fechaCreacion = $post->getFechaCreacion();
            $fechaModificacion = $post->getFechaModificacion();
            $modificaciones = $post->getModificaciones();
            
            $sentencia->bindParam(":idUsuario", $idUsuario);
            $sentencia->bindParam(":idCategoria", $idCategoria);
            $sentencia->bindParam(":titulo", $titulo);
            $sentencia->bindParam(":texto", $texto);
            $sentencia->bindParam(":fechaCreacion", $fechaCreacion);
            $sentencia->bindParam(":fechaModificacion", $fechaModificacion);
            $sentencia->bindParam(":modificaciones", $modificaciones);
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    
    public function borrarEstructuraTablas(){
        
    }
}

?>
