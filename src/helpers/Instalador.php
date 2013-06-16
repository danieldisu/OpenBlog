<?php
namespace src\helpers;

use PDO;

class Instalador {
    
    protected $host;
    protected $username;
    protected $password;
    protected $bd;
    protected $conn;
    
    public function __construct($config) {
        // Si al instanciar el PDO le pasamos la configuracion, buscará los datos de conexion en dicha configuracion, si no cogerá la configuracion por defecto que es la siguiente: 
        /*if(!isset($config)){
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
        }*/
        /* Mejor pasarle la configuración, ya que todavia no tenemos todos los datos guardados en un JSON */
        $this->host = $config['host'];
        $this->username = $config['user'];
        $this->password = $config['pass'];
        $this->bd = $config['nombreBd'];

        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
        }catch(Exception $e){
            throw new Exception('Error de conexion');
        }
    }


    public function crearTablas(){
            $this->crearTablaCategoria();
            $this->crearTablaRol();
            $this->crearTablaUsuario();
            $this->crearTablaPost();
            $this->crearTablaComentario();            
    }

    private function crearTablaCategoria(){
        $sqlCategoria = "
             CREATE TABLE ob_categoria (
             id int(10) NOT NULL AUTO_INCREMENT,
             nombre varchar(25) NOT NULL,
             descripcion text NOT NULL,
             PRIMARY KEY (id)
             ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        ";
        $this->conn->exec($sqlCategoria);        
    }

    private function crearTablaRol(){
            $sqlRol = "
                CREATE TABLE ob_rol (
                id int(10) NOT NULL AUTO_INCREMENT,
                nombre varchar(25) NOT NULL UNIQUE,
                descripcion text NOT NULL,
                PRIMARY KEY (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1  
            ";
                    $this->conn->query($sqlRol);        

    }

    private function crearTablaUsuario(){
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
                    $this->conn->query($sqlUsuario);        

    }

    private function crearTablaPost(){
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
                    $this->conn->query($sqlPost);        

    }

    private function crearTablaComentario(){
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
                        $this->conn->query($sqlComentario);        

    }
    
    public function borrarTablas(){
            
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
            
            if($this->existeTabla('ob_comentario')){
                $this->conn->exec($sqlComentario);
            }
            if($this->existeTabla('ob_post')){
                $this->conn->exec($sqlPost);
            }
            if($this->existeTabla('ob_usuario')){
                $this->conn->exec($sqlUsuario);
            }
            if($this->existeTabla('ob_rol')){
                $this->conn->exec($sqlRol);
            }
            if($this->existeTabla('ob_categoria')){
                $this->conn->exec($sqlCategoria);
            }
    }

    public function existeTabla($nombreTabla){
        $sql = "SELECT 1 FROM $nombreTabla";
        $res = $this->conn->query($sql);
        

        if(is_object($res)){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkTablas(){
        if(!$this->existeTabla('ob_comentario')){
            return false;
        }
        if(!$this->existeTabla('ob_post')){
            return false;
        }
        if(!$this->existeTabla('ob_usuario')){
            return false;
        }
        if(!$this->existeTabla('ob_rol')){
            return false;
        }
        if(!$this->existeTabla('ob_categoria')){
            return false;
        }
        
        return true;
    }

    public function crearCategoriaPorDefecto(){
        $sql = "INSERT INTO  ob_categoria (nombre ,descripcion)VALUES ('General',  'Categoria General');";
        $this->conn->query($sql);
    }

}

?>
