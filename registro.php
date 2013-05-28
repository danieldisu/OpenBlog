<?php
include_once 'autoloader.php';

use src\helpers\Header;
use src\helpers\pathGen;
use src\helpers\ManejadorBD;
use src\helpers\Login;

// Iniciamos el manejador BD con las opciones del JSON
$mbd = new ManejadorBD(Header::cargarJSON());
pathGen::cargarRaiz();

Header::iniciarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<?php Header::cargarHead(false/* false == no es pagina admin */); ?>
    <body>
        <div class="container">
            <div class="row">
                <a href="<?php echo pathGen::pathHome(); ?>"><div class="span12 header">
                        <img src="<?php echo pathGen::loadLogo() ?>">
                        <h1><?php echo Header::$json["tituloBlog"] ?></h1>
                    </div></a>
            </div><!-- /header -->

            <div class="row">
                <div class="span7 registro main">
                        <h2>Formulario de registro</h2>  
                        <label id="regNombre"><input type="text" placeholder="Nombre de usuario" /><img src="" /><span></span></label>
                        <label id="regEmail"><input type="text" placeholder="Email"/><img src="" /><span></span></label>
                        <label id="regEmailR"><input type="text" placeholder="Repetir email"/><img src="" /><span></span></label>
                        <label id="regPass"><input type="password" placeholder="Contraseña"/><img src="" /><span></span></label>
                        <label id="regPassR"><input type="password" placeholder="Repetir contraseña"/><img src="" /><span></span></label>
                        <input id="btnRegistro" type="button" class="btn botonRegistro" value="registrarte"/>
                </div>
            </div><!-- /sidebar -->
        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo pathGen::pathJs("jquery.js") ?>"></script>
        <script src="<?php echo pathGen::pathJs("funciones.js") ?>"></script>
        <script type="<?php echo pathGen::pathJs("bootstrap.js") ?>"></script>
    </body>
</html>
