<?php

class ManejadorBD {

    protected $host = "localhost";
    protected $username = "root";
    protected $password = "SacredShadow23";
    protected $bd = "openblog";

    public function __construct() {
        
    }
    
    //No la usamos en un principio
    public function conectar(){
        try {
            $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
        }
        
    }
    public function desconectar(){
        
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
                VALUES (".$post->getIdUsuario().",".$post->getIdCategoria().",'".$post->getTitulo()."','".$post->getTexto()."','".$post->getFechaCreacion()."','".$post->getFechaModificacion()."',".$post->getModificaciones().")
            ";
            $sentencia = $conn->prepare($sql);
            $sentencia->execute();
            
            //Cierra la conexion (no existe metodo close() en pdo)
            $conn = null;
         }
         catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
         }
    }
    public function getPost($id){
        
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
                VALUES ('".$categoria->getNombre()."','".$categoria->getDescripcion()."')
            ";
            $sentencia = $conn->prepare($sql);
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
                INSERT INTO ob_categoria (texto, fecha, idUsuario, idPost) 
                VALUES ('".$comentario->getTexto()."','".$comentario->getFecha()."',".$comentario->getIdUsuario().",".$comentario->getIdPost().")
            ";
            $sentencia = $conn->prepare($sql);
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
                VALUES ('".$rol->getNombre()."','".$rol->getDescripcion()."')
            ";
            $sentencia = $conn->prepare($sql);
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
        
    }
    public function getUsuario($id){
        
    }
    public function updateUsuario($id, Usuario $usuario){
        
    }
    public function deleteUsuario($id){
        
    }
}
?>