<?php
namespace src\helpers;
use PDO;
class Instalador {
    
    protected $host;
    protected $username;
    protected $password;
    protected $bd;
    
    public function __construct() {
        // Si al instanciar el PDO le pasamos la configuracion, buscará los datos de conexion en dicha configuracion, si no cogerá la configuracion por defecto que es la siguiente: 
        if(!isset($config)){
            $this->host = "127.0.0.1";
            $this->username = "root";
            $this->password = "";
            $this->bd = "openblog";
        }else{
            print_r($config);
            $this->host = $config['host'];
            $this->username = $config['user'];
            $this->password = $config['pass'];
            $this->bd = $config['nombreBd'];          
        }        
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
            
            
            $sentenciaCategoria = $conn->prepare($sqlCategoria);
            $sentenciaRol = $conn->prepare($sqlRol);
            $sentenciaUsuario = $conn->prepare($sqlUsuario);
            $sentenciaPost = $conn->prepare($sqlPost);
            $sentenciaComentario = $conn->prepare($sqlComentario);
            
            $sentenciaCategoria->execute();
            $sentenciaRol->execute();
            $sentenciaUsuario->execute();
            $sentenciaPost->execute();
            $sentenciaComentario->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    
    public function borrarEstructuraTablas(){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sqlCategoria = "
                DROP TABLE ob_categoria; 
            ";
            $sqlRol = "
                DROP TABLE ob_rol;
            ";
            $sqlUsuario = "
                DROP TABLE ob_usuario;
            ";
            $sqlPost = "
                DROP TABLE ob_post;
            ";
            $sqlComentario = "
                DROP TABLE ob_comentario;
            ";
            
            
            $sentenciaCategoria = $conn->prepare($sqlCategoria);
            $sentenciaRol = $conn->prepare($sqlRol);
            $sentenciaUsuario = $conn->prepare($sqlUsuario);
            $sentenciaPost = $conn->prepare($sqlPost);
            $sentenciaComentario = $conn->prepare($sqlComentario);
            
            $sentenciaComentario->execute();
            $sentenciaPost->execute();
            $sentenciaUsuario->execute();
            $sentenciaRol->execute();
            $sentenciaCategoria->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }

    public function crearBD(){
        $conn = new PDO("mysql:host=".$this->host.";", $this->username, $this->password);
        $conn->query("CREATE DATABASE IF NOT EXISTS ".$this->bd.";");
        $conn = null;
    }
}

?>
