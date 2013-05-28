<?php

namespace src\helpers;

use src\entidades\Categoria;
use src\entidades\Post;
use src\entidades\Rol;
use src\entidades\Comentario;
use src\entidades\Usuario;
use PDO;

class ManejadorBD {

  protected $host;
  protected $username;
  protected $password;
  protected $bd;
  protected $numPost;
  private $db;

  public function __construct($config = null) {
	// Si al instanciar el PDO le pasamos la configuracion, buscará los datos de conexion en dicha configuracion, si no cogerá la configuracion por defecto que es la siguiente: 
  $this->host = $config['host'];
  $this->username = $config['user'];
  $this->password = $config['pass'];
  $this->bd = $config['nombreBd'];
  $this->numPost = $config['numPost'];

	$this->db = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->bd, $this->username, $this->password);
	$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  //POST
  public function createPost(Post $post) {
	$sql = "
								INSERT INTO ob_post (idUsuario, idCategoria, titulo, texto, fechaCreacion, fechaModificacion, modificaciones) 
								VALUES (:idUsuario, :idCategoria, :titulo, :texto, :fechaCreacion, :fechaModificacion, :modificaciones)
						";
	$sth = $this->db->prepare($sql);
	$sth->bindValue(":idUsuario", $post->getIdUsuario());
	$sth->bindValue(":idCategoria", $post->getIdCategoria());
	$sth->bindValue(":titulo", $post->getTitulo());
	$sth->bindValue(":texto", $post->getTexto());
	$sth->bindValue(":fechaCreacion", $post->getFechaCreacion());
	$sth->bindValue(":fechaModificacion", null);
	$sth->bindValue(":modificaciones", 0);
	return $sth->execute();
  }

  public function getPost($id) {
	$sql = "
								SELECT * 
								FROM ob_post 
								WHERE id = :id"
	;
	$sth = $this->db->prepare($sql);
	$sth->bindParam(':id', $id);
	$sth->execute();
	$post = $sth->fetchObject('src\entidades\Post');
	return $post;
  }

  public function getAllPosts() {
	$sql = "
								SELECT * 
								FROM ob_post 
								
	  ";
	$sth = $this->db->prepare($sql);
	$sth->execute();
	$posts = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Post');
	return $posts;
  }

  public function updatePost($id, Post $post) {
	$sql = "
								UPDATE ob_post
								SET idUsuario = :idUsuario, idCategoria = :idCategoria, titulo = :titulo, texto = :texto, fechaCreacion = :fechaCreacion, fechaModificacion = :fechaModificacion, modificaciones = :modificaciones
								WHERE id = :id;"
	;
	$sentencia = $this->db->prepare($sql);

	$sentencia->bindValue(":idUsuario", $post->getIdUsuario());
	$sentencia->bindValue(":idCategoria", $post->getIdCategoria());
	$sentencia->bindValue(":titulo", $post->getTitulo());
	$sentencia->bindValue(":texto", $post->getTexto());
	$sentencia->bindValue(":fechaCreacion", $post->getFechaCreacion());
	$sentencia->bindValue(":fechaModificacion", $post->getFechaModificacion());
	$sentencia->bindValue(":modificaciones", $post->getModificaciones());
	$sentencia->bindValue(':id', $id);


	return $sentencia->execute();
  }
  public function updateCategoriaPost($idCategoria) {
  	# Funcion encargada de cambiar la categoria del post al ser borrada la categoría
	$sql = "
								UPDATE ob_post
								SET idCategoria = 0
								WHERE idCategoria = :idCategoria;"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(":idCategoria", $idCategoria);


	return $sentencia->execute();
  }
  public function getUltimoPostDe($idUsuario){
  	$sql = "SELECT *
  	FROM ob_post
  	WHERE idUsuario = :idUsuario
  	ORDER BY id DESC
  	LIMIT 1;";
  	$sentencia = $this->db->prepare($sql);
  	$sentencia->bindParam(':idUsuario', $idUsuario);
  	$sentencia->execute();
  	$post = $sentencia->fetchObject('src\entidades\Post');
  	return $post;
  }

  public function deletePost($id) {
	$sql = "
								DELETE FROM ob_post
								WHERE id= :id ;"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindValue(':id', $id);
	$sentencia->execute();
	return $count = $sentencia->rowCount();
  }

  public function getPostsCategoria($idCategoria) {

	$sql = "
							SELECT * 
							FROM ob_post 
							WHERE idCategoria = :idCategoria ;"
	;
	$sth = $this->db->prepare($sql);
	$sth->bindValue(':idCategoria', $idCategoria);

	$sth->execute();

	$posts = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Post');

	return $posts;
  }
  
  public function getPostsUsuario($idUsuario){
      $sql = "SELECT * FROM ob_post WHERE idUsuario = :idUsuario";
      $sth = $this->db->prepare($sql);
        $sth->bindValue(':idUsuario', $idUsuario);

        $sth->execute();

        $posts = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Post');

        return $posts;
  }
  
  public function getAllCategorias(){
	$sql = "SELECT * FROM ob_categoria";
	$sth = $this->db->prepare($sql);
	$sth->execute();
	return $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Categoria');
  }

  public function obtenerUltimosPost($inicio = 0, $numPost = 5) {
	$sql = "
										SELECT * 
										FROM ob_post 
										LIMIT :inicio , :numPost ;"
	;
	$sth = $this->db->prepare($sql);
	$sth->bindValue(':inicio', (int) $inicio, PDO::PARAM_INT);
	$sth->bindValue(':numPost', (int) $numPost, PDO::PARAM_INT);

	$sth->execute();

	$posts = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Post');

	return $posts;
  }

  /*
   *   CODIGO GENERADO PARA SACAR LOS POST DE UNA PAGINA, CODIGO SPAGUETTI WARNING
   */

  public function getPostPagina($pagina) {
	$total = $this->getNumeroTotalPosts();

	$postYaMostrados = $pagina * $this->numPost; //Hayamos el numero de post que han sido mostrados
	//Si el numero de post que ya han sido mostrados ( contando que mostrasemos esta página ) es mayor que el total
	//significa que es la ultima página y vemos cuantos post quedan por mostrar
	if ($postYaMostrados > $total) {
	  $postUltimaPagina = $postYaMostrados - $total - 1;
	}
	// El primer post a mostrar de la página actual ( en realidad es el ultimo de la anterior, pero asi es como funciona el limit )
	$primerPostPagina = $total - $postYaMostrados;


	//si existe la variable significa que estamos en la ultima pagina y solo vamos a mostrar los post que quedan por mostrar
	if (isset($postUltimaPagina)) {
	  $sql = "
										SELECT * 
										FROM ob_post 
										LIMIT 0, :postUltimaPagina"
	  ;
	  $sth = $this->db->prepare($sql);
	  $sth->bindValue(':postUltimaPagina', (int) $postUltimaPagina, PDO::PARAM_INT);	  
	} else {
	  $sql = "
										SELECT * 
										FROM ob_post
										LIMIT :primerPostPagina , :numPost ;"
	  ;
	  $sth = $this->db->prepare($sql);
	  //  Hay que hacer casting a INT y indicarle que le pasas un Integer ya que sino da error la sentencia SQL
	  $sth->bindValue(':primerPostPagina', (int) $primerPostPagina, PDO::PARAM_INT);
	  $sth->bindValue(':numPost', (int) $this->numPost, PDO::PARAM_INT);
	}
	$sth->execute();

	$postsPagina = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Post');


	$postsPaginaOrdenados = array_reverse($postsPagina, true);

	return $postsPaginaOrdenados;
  }

  public function getNumeroTotalPosts() {
	$sql = "SELECT count(*) as numTotalPosts FROM ob_post;";
	$sentencia = $this->db->prepare($sql);
	$sentencia->execute();
	$totalPost = $sentencia->fetchColumn(0);

	return $totalPost;
  }

  /*
   * CATEGORIA
   */

  public function createCategoria(Categoria $categoria) {
	$sql = "
								INSERT INTO ob_categoria (nombre, descripcion) 
								VALUES (:nombre, :descripcion)
						";
	$sentencia = $this->db->prepare($sql);

	$nombre = $categoria->getNombre();
	$descripcion = $categoria->getDescripcion();

	$sentencia->bindParam(":nombre", $nombre);
	$sentencia->bindParam(":descripcion", $descripcion);
	return $sentencia->execute();
  }

  public function getCategoria($id) {

	$sql = "
								SELECT * 
								FROM ob_categoria 
								WHERE id = :id"
	;
	$sth = $this->db->prepare($sql);
	$sth->bindParam(":id", $id);
	$sth->execute();
	$categoria = $sth->fetchObject('src\entidades\Categoria');

	return $categoria;
  }

  public function updateCategoria($id, Categoria $categoria) {
	$sql = "
								UPDATE ob_categoria
								SET nombre = :nombre, descripcion = :descripcion
								WHERE id = :id"
	;
	$sentencia = $this->db->prepare($sql);

	$nombre = $categoria->getNombre();
	$descripcion = $categoria->getDescripcion();

	$sentencia->bindParam(':id', $id);
	$sentencia->bindParam(":nombre", $nombre);
	$sentencia->bindParam(":descripcion", $descripcion);

	return $sentencia->execute();
  }

  public function deleteCategoria($id) {
	$sql = "
								DELETE FROM ob_categoria
								WHERE id= :id"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(':id', $id);
	return $sentencia->execute();
  }

  public function obtenerNombreCategoria($id) {
	$sql = "
								SELECT nombre 
								FROM ob_categoria 
								WHERE id = :id"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(":id", $id);
	$sentencia->execute();
	$nombreCategoria = $sentencia->fetchColumn(0);

	return $nombreCategoria;
  }
  public function obtenerCategorias(){
  	$sql = "
  	SELECT * 
  	FROM ob_categoria"
  	;
  	$sentencia = $this->db->prepare($sql);
  	$sentencia->execute();
  	$categorias = $sentencia->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Categoria');

	return $categorias;
  }
  public function obtenerNumPostPorCategoria($idCategoria){
  	$sql = "
								SELECT count(*) 
								FROM ob_post
								WHERE idCategoria = :idCategoria"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(":idCategoria", $idCategoria);
	$sentencia->execute();
	$numPosts = $sentencia->fetchColumn(0);

	return $numPosts;
  }
  /*
   * COMENTARIO
   */

  public function createComentario(Comentario $comentario) {
	$sql = "
								INSERT INTO ob_comentario (texto, fecha, idUsuario, idPost) 
								VALUES (:texto, :fecha, :idUsuario, :idPost)
						";
	$sentencia = $this->db->prepare($sql);

	$sentencia->bindValue(":texto", $comentario->getTexto());
	$sentencia->bindValue(":fecha", $comentario->getFecha());
	$sentencia->bindValue(":idUsuario", $comentario->getIdUsuario());
	$sentencia->bindValue(":idPost", $comentario->getIdPost());
	return $sentencia->execute();
  }

  public function getComentario($id) {
	$sql = "
								SELECT * 
								FROM ob_comentario 
								WHERE id = :id"
	;
	$sth = $this->db->prepare($sql);
	$sentencia->bindParam(":id", $id);
	$sth->execute();
	$comentario = $sth->fetchObject('src\entidades\Comentario');

	return $comentario;
  }

  public function updateComentario($id, Comentario $comentario) {
	$sql = "
								UPDATE ob_comentario
								SET texto = :texto, fecha = :fecha, idUsuario = :idUsuario, idPost = :idPost
								WHERE id = :id;"
	;
	$sentencia = $this->db->prepare($sql);

	$sentencia->bindValue(":texto", $comentario->getTexto());
	$sentencia->bindValue(":fecha", $comentario->getFecha());
	$sentencia->bindValue(":idUsuario", $comentario->getIdUsuario());
	$sentencia->bindValue(":idPost", $comentario->getIdPost());
	$sentencia->bindValue(':id', $id);

	return $sentencia->execute();
  }

  public function deleteComentario($id) {
	$sql = "
								DELETE FROM ob_comentario
								WHERE id= :id"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(':id', $id);
	$sentencia->execute();
   return $sentencia->rowCount();
  }

  public function obtenerNumeroComentarios($id) {
	$sql = "
								SELECT count(*)
								FROM ob_comentario
								WHERE idPost = :id"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(":id", $id);
	$sentencia->execute();
	$numeroComentarios = $sentencia->fetchColumn(0);

	return $numeroComentarios;
  }

  /*
   * Obtiene los 5 ultimos comentarios del post que se le indique, en caso de que no se le indique ningun post, extrae los ultimos 5 comentarios de todos los posts
   */
  public function obtenerUltimosComentarios($idPost = null) {
	if ($idPost == null) {
	  $sql = "
					 SELECT *
					 FROM ob_comentario 
					 ORDER BY fecha DESC 
					 LIMIT 5"
	  ;
	} else {

	  $sql = "
					 SELECT *
					 FROM ob_comentario 
					 WHERE idPost = :idPost
					 ORDER BY fecha DESC 
					 LIMIT 5"
	  ;
	}
	$sth = $this->db->prepare($sql);
	$sth->bindParam(":idPost", $idPost);
	$sth->execute();
	$comentarios = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Comentario');
	return $comentarios;
  }

  public function getAllComentarios($idPost){
		  $sql = "
						 SELECT *
						 FROM ob_comentario 
						 WHERE idPost = :idPost
						 ORDER BY fecha DESC";
		

		$sth = $this->db->prepare($sql);
		$sth->bindParam(":idPost", $idPost);
		$sth->execute();
		$comentarios = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Comentario');
		return $comentarios;
  }

  /*
   * ROL
   */

  public function createRol(Rol $rol) {
	$sql = "
									 INSERT INTO ob_rol (nombre, descripcion) 
									 VALUES (:nombre, :descripcion)
				";
	$sentencia = $this->db->prepare($sql);

	$sentencia->bindValue(":nombre", $rol->getNombre());
	$sentencia->bindValue(":descripcion", $rol->getDescripcion());
	return $sentencia->execute();
  }

  public function getRol($id) {
	$sql = "
								SELECT * 
								FROM ob_rol 
								WHERE id = :id"
	;
	$sth = $this->db->prepare($sql);
	$sth->bindParam(":id", $id);
	$sth->execute();
	$rol = $sth->fetchObject('src\entidades\Rol');
	return $rol;
  }

  public function updateRol($id, Rol $rol) {
	$sql = "
								UPDATE ob_rol
								SET nombre = :nombre, descripcion = :descripcion
								WHERE id = :id "
	;
	$sentencia = $this->db->prepare($sql);

	$sentencia->bindValue(":nombre", $rol->getNombre());
	$sentencia->bindValue(":descripcion", $rol->getDescripcion());
	$sth->bindParam(":id", $id);
	return $sentencia->execute();
  }

  public function deleteRol($id) {
	$sql = "
								DELETE FROM ob_rol
								WHERE id= :id"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(":id", $id);
	return $sentencia->execute();
  }

  public function getAllRoles(){
      $sql = "
								SELECT *
								FROM ob_rol

	  ";
      $sth = $this->db->prepare($sql);
      $sth->execute();
      $roles = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Rol');
      return $roles;
  }

  //USUARIO
  public function createUsuario(Usuario $usuario) {
	$sql = "
								INSERT INTO ob_usuario (nombre, pass, mail, idRol) 
								VALUES (:nombre, :pass, :mail, :idRol)
						";
	$sentencia = $this->db->prepare($sql);
        $nombre = $usuario->getNombre();
        $pass = $usuario->getPass();
        $mail = $usuario->getMail();
        $idRol = $usuario->getIdRol();
	$sentencia->bindParam(":nombre", $nombre);
	$sentencia->bindParam(":pass", $pass);
	$sentencia->bindParam(":mail", $mail);
	$sentencia->bindParam(":idRol", $idRol);
	return $sentencia->execute();
  }

  public function getUsuario($id) {
	$sql = "
								SELECT * 
								FROM ob_usuario 
								WHERE id = :id"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(":id", $id);
	$sentencia->execute();
	$usuario = $sentencia->fetchObject('src\entidades\Usuario');
	return $usuario;
  }

  public function getAllUsuarios() {
	$sql = "
								SELECT * 
								FROM ob_usuario 
								
	  ";
	$sth = $this->db->prepare($sql);
	$sth->execute();
	$usuarios = $sth->fetchAll(PDO::FETCH_CLASS, 'src\entidades\Usuario');
	return $usuarios;
  }

  public function updateUsuario($id, Usuario $usuario) {
	$sql = "
								UPDATE ob_usuario
								SET nombre = :nombre, pass = :pass, mail = :mail, idRol = :idRol
								WHERE id = :id"
	;
	$sentencia = $this->db->prepare($sql);

	$sentencia->bindValue(":nombre", $usuario->getNombre());
	$sentencia->bindValue(":pass", $usuario->getPass());
	$sentencia->bindValue(":mail", $usuario->getMail());
	$sentencia->bindValue(":idRol", $usuario->getIdRol());
	$sentencia->bindValue(":id", $id);

	$sentencia->execute();
    return $count = $sentencia->rowCount();
  }

  public function deleteUsuario($id) {
	$sql = "
								DELETE FROM ob_usuario
								WHERE id= :id ;"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(":id", $id);

	$sentencia->execute();
    return $count = $sentencia->rowCount();

  }

  public function obtenerNombreAutor($id) {
	$sql = "
								SELECT nombre 
								FROM ob_usuario 
								WHERE id = :id"
	;
	$sentencia = $this->db->prepare($sql);
	$sentencia->bindParam(":id", $id);
	$sentencia->execute();
	$nombreAutor = $sentencia->fetchColumn(0);
	return $nombreAutor;
  }
  
  public function comprobarLogin($usuario, $pass){
      $sql = "
          SELECT *
          FROM ob_usuario
          WHERE (nombre = :usuario AND pass = :pass) OR (mail = :usuario AND pass = :pass)
      ";
      $sentencia = $this->db->prepare($sql);
      $sentencia->bindParam(":usuario", $usuario);
      $sentencia->bindParam(":pass", $pass);
      $sentencia->execute();
      if($sentencia->rowCount()){
          return true;
      }
      else {
          return false;
      }
  }
  
  public function comprobarNombreUsuario($usuario){
      $sql = "
          SELECT *
          FROM ob_usuario
          WHERE nombre = :usuario
      ";
      $sentencia = $this->db->prepare($sql);
      $sentencia->bindParam(":usuario", $usuario);
      $sentencia->execute();
      if($sentencia->rowCount()){
          return true;
      }
      else {
          return false;
      }
  }
  
  public function comprobarEmailUsuario($mail){
      $sql = "
          SELECT *
          FROM ob_usuario
          WHERE mail = :mail
      ";
      $sentencia = $this->db->prepare($sql);
      $sentencia->bindParam(":mail", $mail);
      $sentencia->execute();
      if($sentencia->rowCount()){
          return true;
      }
      else {
          return false;
      }
  }

  public function getUsuarioByName($nombre){
        $sql = "
             SELECT id, nombre, pass, mail, idRol
             FROM ob_usuario
             WHERE nombre = :usuario OR mail = :usuario
         ";
        $sentencia = $this->db->prepare($sql);
        $sentencia->bindParam(":usuario", $nombre);
        $sentencia->execute();
        $usuario = $sentencia->fetchObject('src\entidades\Usuario');
	return $usuario;
   }
}

?>
