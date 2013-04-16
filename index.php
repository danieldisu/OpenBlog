<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            include_once "Helpers/ManejadorConfig.php";
            include_once 'Helpers/ManejadorBD.php';
            include_once './Entidades/Categoria.php';
            include_once './Entidades/Rol.php';
            include_once './Entidades/Usuario.php';
            include_once './Entidades/Post.php';
            include_once './Entidades/Comentario.php';
            
            $mj = new ManejadorConfig();
            $json = $mj->cargarConfig();
            
            $mbd = new ManejadorBD();
        ?>
        <meta charset="utf-8">
        <title>OpenBlog</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Le styles -->
        <link href="Recursos/css/bootstrap.css" rel="stylesheet">
        <link href="Recursos/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="Recursos/css/fuentes.css" rel="stylesheet">
        <link href=<?php echo $json["rutaCss"] ?> rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="../recursos/ico/favicon.ico">
    </head>

    <body>
      <div class="container">

        <div class="row">
            <div class="span12 header">
                <img src="Recursos/betaLogo01.png">
                <h1><?php echo $json["tituloBlog"] ?></h1>
            </div>
        </div><!-- /header -->

        <div class="row main">
            <div class="span9 contenido">
                <?php
                    $posts = $mbd->obtenerUltimosPost(5,0);
                    foreach ($posts as $post){
                        include "Blog/plantillaPost.php";
                    }
                ?>
                                   
            </div>
        <div class="span3 sidebar">

            <div class="cajaLogin">
              <h3> Login </h3>
              <label>Usuario</label>
              <input type="text" id="inputUsuario">
              <label>Contraseña</label>
              <input type="password" id="inputPassword">
              <input type="button" class="btn btn-block" value="Login">
              <input type="button" class="btn btn-block" value="Registrarse">
            </div>

            <div class="cajaUltimosPost">
              <h3> Ultimos Post </h3>
              <ul>
                <li><a href="#">Post numero 1</a></li>
                <li><a href="#">Post numero 2</a></li>
                <li><a href="#">Post numero 3</a></li>
                <li><a href="#">Post numero 4</a></li>
                <li><a href="#">Post numero 5</a></li>
              </ul>
            </div>

            <div class="cajaUltimosComentarios">
              <h3> Ultimos Comentarios </h3>
              <ul>
                <li>Por: <a href="#">Usuario</a><br>Comentario numero 1</li>
                <li>Por: <a href="#">Usuario</a><br>Comentario numero 2</li>
                <li>Por: <a href="#">Usuario</a><br>Comentario numero 3</li>
                <li>Por: <a href="#">Usuario</a><br>Comentario numero 4</li>
                <li>Por: <a href="#">Usuario</a><br>Comentario numero 5</li>
              </ul>            
            </div>
          </div>
        </div>
      </div> <!-- /container -->

      <!-- Le javascript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="Recursos/js/jquery.js"></script>
      <script type="Recursos/js/bootstrap.js"></script>
    </body>
</html>
