<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            include_once "Helpers/ManejadorConfig.php";
            include_once 'Helpers/ManejadorBD.php';
            include_once './Entidades/Post.php';
            
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
                <div class="post">
                    <div class="cajaTituloPost">
                        <h3>Titulo Post</h3>
                    </div>
                    <div class="cajaInfo row">
                        <div class="cajaAutorPost span2">
                            <span>Autor</span>
                        </div>

                        <div class="cajaFechaPost span2 ">
                            <span>Fecha</span>
                        </div>
                        <div class="cajaCategoriaPost span2 ">
                            <span>Categoria</span>
                        </div>
                        <div class="cajaNumeroComentarios span2 ">
                            <span>5 Comentarios</span>
                        </div>                         
                    </div>


                    <div class="cajaContenidoPost">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
                    </div>
                    <div class="row cajaAcciones">
                        <div class="cajaVerComentarios span3 offset1">
                            <button class="btn"> Ver Comentarios</button>
                        </div>
                        <div class="cajaEscribirComentarios span3 offset1">
                            <button class="btn"> Escribir Comentario</button>
                        </div>
                    </div>
                </div>
            <div class="post">
              <div class="cajaTituloPost">
                <h3>Titulo Post</h3>
              </div>
              <div class="cajaInfo row">
                  <div class="cajaAutorPost span2">
                    <span>Autor</span>
                </div>

                <div class="cajaFechaPost span2 ">
                  <span>Fecha</span>
                </div>
                <div class="cajaCategoriaPost span2 ">
                  <span>Categoria</span>
                </div>
                <div class="cajaNumeroComentarios span2 ">
                  <span>5 Comentarios</span>
                </div>                         
              </div>


              <div class="cajaContenidoPost">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
              </div>
                <div class="row cajaAcciones">
                  <div class="cajaVerComentarios span3 offset1">
                    <button class="btn"> Ver Comentarios</button>
                  </div>
                  <div class="cajaEscribirComentarios span3 offset1">
                    <button class="btn"> Escribir Comentario</button>
                  </div>
                </div>
            </div>
            <div class="post">
              <div class="cajaTituloPost">
                <h3>Titulo Post</h3>
              </div>
              <div class="cajaInfo row">
                  <div class="cajaAutorPost span2">
                    <span>Autor</span>
                </div>

                <div class="cajaFechaPost span2 ">
                  <span>Fecha</span>
                </div>
                <div class="cajaCategoriaPost span2 ">
                  <span>Categoria</span>
                </div>
                <div class="cajaNumeroComentarios span2 ">
                  <span>5 Comentarios</span>
                </div>                         
              </div>


              <div class="cajaContenidoPost">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
              </div>
                <div class="row cajaAcciones">
                  <div class="cajaVerComentarios span3 offset1">
                    <button class="btn"> Ver Comentarios</button>
                  </div>
                  <div class="cajaEscribirComentarios span3 offset1">
                    <button class="btn"> Escribir Comentario</button>
                  </div>
                </div>
            </div>                    
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
