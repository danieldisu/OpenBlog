<?php

class ManejadorBD {

    protected $host = "localhost";
    protected $username = "root";
    protected $password = "SacredShadow23";
    protected $bd = "openblog";

    public function __construct() {
        
    }
    
    /*
            while($fila = $sentencia->fetch()){
               echo "Nombre: ".$fila["nombre"];
               echo "descripcion: ".$fila["descripcion"];
            }*/
    
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
            
            while($fila = $sentencia->fetch()){
               echo "Nombre: ".$fila["nombre"];
               echo "descripcion: ".$fila["descripcion"];
            }
            
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function updatePost($id, Post $post){
        
    }
    public function deletePost($id){
        
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
        
    }
    public function updateCategoria($id, Categoria $categoria){
        
    }
    public function deleteCategoria($id){
        
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
        
    }
    public function updateComentario($id, Comentario $comentario){
        
    }
    public function deleteComentario($id){
        
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
        
    }
    public function updateRol($id, Rol $rol){
        
    }
    public function deleteRol($id){
        
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
        
    }
    public function updateUsuario($id, Usuario $usuario){
        
    }
    public function deleteUsuario($id){
        
    }
}
?>