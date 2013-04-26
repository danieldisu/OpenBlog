<?php

class ManejadorBD {

    protected $host;
    protected $username;
    protected $password ;
    protected $bd;

    public function __construct() {
            //TO-DO Cargar el username y la contraseña del JSON
            $this->host = "localhost";
            $this->username = "root";
            $this->password = "root";
            $this->bd = "openblog";
    }
    
    //POST
    public function createPost(Post $post){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                INSERT INTO ob_post (idUsuario, idCategoria, titulo, texto, fechaCreacion, fechaModificacion, modificaciones) 
                VALUES (:idUsuario, :idCategoria, :titulo, :texto, :fechaCreacion, :fechaModificacion, :modificaciones)
            ";
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
    public function getPost($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                SELECT * 
                FROM ob_post 
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            $fila = $sentencia->fetch();
            
            $post = new Post(0,0,0,"","","","",0);
            
            $post->setId($fila["id"]);
            $post->setIdUsuario($fila["idUsuario"]);
            $post->setIdCategoria($fila["idCategoria"]);
            $post->setTitulo($fila["titulo"]);
            $post->setTexto($fila["texto"]);
            $post->setFechaCreacion($fila["fechaCreacion"]);
            $post->setFechaModificacion($fila["fechaModificacion"]);
            $post->setModificaciones($fila["modificaciones"]);
            
            $conn = null;
            
            return $post;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function updatePost($id, Post $post){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                UPDATE ob_post
                SET idUsuario = :idUsuario, idCategoria = :idCategoria, titulo = :titulo, texto = :texto, fechaCreacion = :fechaCreacion, fechaModificacion = :fechaModificacion, modificaciones = :modificaciones
                WHERE id = ".$id
            ;
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
    public function deletePost($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                DELETE FROM ob_post
                WHERE id=".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function obtenerUltimosPost($inicio = 0, $numPost = 5){
        if($inicio >= 0){
            try {
                $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $posts = array();
                $sql = "
                    SELECT * 
                    FROM ob_post 
                    LIMIT ".$inicio.",".$numPost
                ;
                $sentencia = $conn->prepare($sql);
                
                $sentencia->execute();
                while($fila = $sentencia->fetch()){
                    $post = new Post(0,0,0,"","","","",0);

                    $post->setId($fila["id"]);
                    $post->setIdUsuario($fila["idUsuario"]);
                    $post->setIdCategoria($fila["idCategoria"]);
                    $post->setTitulo($fila["titulo"]);
                    $post->setTexto($fila["texto"]);
                    $post->setFechaCreacion($fila["fechaCreacion"]);
                    $post->setFechaModificacion($fila["fechaModificacion"]);
                    $post->setModificaciones($fila["modificaciones"]);
                    
                    array_push($posts, $post);
                }
                
                $conn = null;

                return $posts;
             }
             catch(PDOException $e) {
                echo 'ERROR: '.$e->getMessage();
             }
        }
        else {
            //Mandar a la pagina de error
        }
    }
    public function getNumeroTotalPosts(){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(*) as numTotalPosts FROM ob_post;";
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            $fila = $sentencia->fetch();
            $conn = null;

            return $fila['numTotalPosts'];
        }

        catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
        }
    }
    
    //CATEGORIA
    public function createCategoria(Categoria $categoria){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                INSERT INTO ob_categoria (nombre, descripcion) 
                VALUES (:nombre, :descripcion)
            ";
            $sentencia = $conn->prepare($sql);
            
            $nombre = $categoria->getNombre();
            $descripcion = $categoria->getDescripcion();
            
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":descripcion", $descripcion);
            $sentencia->execute();
            
            //Cierra la conexion (no existe metodo close() en pdo)
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }               
    }
    public function getCategoria($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                SELECT * 
                FROM ob_categoria 
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            $fila = $sentencia->fetch();
            
            $categoria = new Categoria(0, "", "");
            
            $categoria->setId($fila["id"]);
            $categoria->setNombre($fila["nombre"]);
            $categoria->setDescripcion($fila["descripcion"]);
                    
            $conn = null;
            
            return $categoria;
        }
        catch(PDOException $e) {
           echo 'ERROR: '.$e->getMessage();
        }    
    }
    public function updateCategoria($id, Categoria $categoria){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                UPDATE ob_categoria
                SET nombre = :nombre, descripcion = :descripcion
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            
            $nombre = $categoria->getNombre();
            $descripcion = $categoria->getDescripcion();
            
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":descripcion", $descripcion);
            
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function deleteCategoria($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                DELETE FROM ob_categoria
                WHERE id=".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function obtenerNombreCategoria($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                SELECT nombre 
                FROM ob_categoria 
                WHERE id = :id"
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->bindParam(":id", $id);
            $sentencia->execute();
            $fila = $sentencia->fetch();
                    
            $conn = null;
            
            return $fila["nombre"];
        }
        catch(PDOException $e) {
           echo 'ERROR: '.$e->getMessage();
        }
    }
    
    //COMENTARIO
    public function createComentario(Comentario $comentario){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                INSERT INTO ob_comentario (texto, fecha, idUsuario, idPost) 
                VALUES (:texto, :fecha, :idUsuario, :idPost)
            ";
            $sentencia = $conn->prepare($sql);
            
            $texto = $comentario->getTexto();
            $fecha = $comentario->getFecha();
            $idUsuario = $comentario->getIdUsuario();
            $idPost = $comentario->getIdPost();
            
            $sentencia->bindParam(":texto", $texto);
            $sentencia->bindParam(":fecha", $fecha);
            $sentencia->bindParam(":idUsuario", $idUsuario);
            $sentencia->bindParam(":idPost", $idPost);
            $sentencia->execute();
            
            //Cierra la conexion (no existe metodo close() en pdo)
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function getComentario($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                SELECT * 
                FROM ob_comentario 
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            $fila = $sentencia->fetch();
            
            $comentario = new Comentario(0, "", "", "", "");
            
            $comentario->setId($fila["id"]);
            $comentario->setTexto($fila["texto"]);
            $comentario->setFecha($fila["fecha"]);
            $comentario->setIdUsuario($fila["idUsuario"]);
            $comentario->setIdPost($fila["idPost"]);
                    
            $conn = null;
            
            return $comentario;
        }
        catch(PDOException $e) {
           echo 'ERROR: '.$e->getMessage();
        }
    }
    public function updateComentario($id, Comentario $comentario){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                UPDATE ob_comentario
                SET texto = :texto, fecha = :fecha, idUsuario = :idUsuario, idPost = :idPost
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            
            $texto = $comentario->getTexto();
            $fecha = $comentario->getFecha();
            $idUsuario = $comentario->getIdUsuario();
            $idPost = $comentario->getIdPost();
            
            $sentencia->bindParam(":texto", $texto);
            $sentencia->bindParam(":fecha", $fecha);
            $sentencia->bindParam(":idUsuario", $idUsuario);
            $sentencia->bindParam(":idPost", $idPost);
            
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function deleteComentario($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                DELETE FROM ob_comentario
                WHERE id=".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function obtenerNumeroComentarios($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                SELECT count(*)
                FROM ob_comentario
                WHERE idPost = :id"
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->bindParam(":id", $id);
            $sentencia->execute();
            $fila = $sentencia->fetch();
                    
            $conn = null;
            
            return $fila[0];
        }
        catch(PDOException $e) {
           echo 'ERROR: '.$e->getMessage();
        }
    }
    
    //ROL
    public function createRol(Rol $rol){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                INSERT INTO ob_rol (nombre, descripcion) 
                VALUES (:nombre, :descripcion)
            ";
            $sentencia = $conn->prepare($sql);
            
            $nombre = $rol->getNombre();
            $descripcion = $rol->getDescripcion();
            
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":descripcion", $descripcion);
            $sentencia->execute();
            
            //Cierra la conexion (no existe metodo close() en pdo)
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function getRol($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                SELECT * 
                FROM ob_rol 
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            $fila = $sentencia->fetch();
            
            $rol = new Rol(0, "", "");
            
            $rol->setId($fila["id"]);
            $rol->setNombre($fila["nombre"]);
            $rol->setDescripcion($fila["descripcion"]);
                    
            $conn = null;
            
            return $rol;
        }
        catch(PDOException $e) {
           echo 'ERROR: '.$e->getMessage();
        }
    }
    public function updateRol($id, Rol $rol){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                UPDATE ob_rol
                SET nombre = :nombre, descripcion = :descripcion
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            
            $nombre = $rol->getNombre();
            $descripcion = $rol->getDescripcion();
            
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":descripcion", $descripcion);
            
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function deleteRol($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                DELETE FROM ob_rol
                WHERE id=".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    
    //USUARIO
    public function createUsuario(Usuario $usuario){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                INSERT INTO ob_usuario (nombre, pass, mail, idRol) 
                VALUES (:nombre, :pass, :mail, :idRol)
            ";
            $sentencia = $conn->prepare($sql);
            
            $nombre = $usuario->getNombre();
            $pass = $usuario->getPass();
            $mail = $usuario->getMail();
            $idRol = $usuario->getIdRol();
            
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":pass", $pass);
            $sentencia->bindParam(":mail", $mail);
            $sentencia->bindParam(":idRol", $idRol);
            $sentencia->execute();
            
            //Cierra la conexion (no existe metodo close() en pdo)
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         } 
    }
    public function getUsuario($id){
       try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                SELECT * 
                FROM ob_usuario 
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            $fila = $sentencia->fetch();
            
            $usuario = new Usuario(0, "", "", "", 0);
            
            $usuario->setId($fila["id"]);
            $usuario->setNombre($fila["nombre"]);
            $usuario->setPass($fila["pass"]);
            $usuario->setMail($fila["mail"]);
            $usuario->setIdRol($fila["idRol"]);
                    
            $conn = null;
            
            return $usuario;
        }
        catch(PDOException $e) {
           echo 'ERROR: '.$e->getMessage();
        }
    }
    public function updateUsuario($id, Usuario $usuario){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                UPDATE ob_usuario
                SET nombre = :nombre, pass = :pass, mail = :mail, idRol = :idRol
                WHERE id = ".$id
            ;
            $sentencia = $conn->prepare($sql);
            
            $nombre = $usuario->getNombre();
            $pass = $usuario->getPass();
            $mail = $usuario->getMail();
            $idRol = $usuario->getIdRol();
            
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":pass", $pass);
            $sentencia->bindParam(":mail", $mail);
            $sentencia->bindParam(":idRol", $idRol);
            
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function deleteUsuario($id){
      try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                DELETE FROM ob_usuario
                WHERE id=".$id
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }  
    }
    public function obtenerNombreAutor($id){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "
                SELECT nombre 
                FROM ob_usuario 
                WHERE id = :id"
            ;
            $sentencia = $conn->prepare($sql);
            $sentencia->bindParam(":id", $id);
            $sentencia->execute();
            $fila = $sentencia->fetch();
                    
            $conn = null;
            
            return $fila["nombre"];
        }
        catch(PDOException $e) {
           echo 'ERROR: '.$e->getMessage();
        }
    }
}
?>