<?php
    include("../../autoloader.php");

    use src\helpers\Header;
    use src\helpers\pathGen;
    pathGen::cargarRaiz();
?>

<div class="canvas">
    <div class="circulo"><span></span></div>
    <div class="circulo"><span></span></div>
    <div class="circulo"><span></span></div>
    <div class="circulo"><span></span></div>
    <div class="circulo"><span></span></div>
    <div class="circulo actual"><span class="actual">6</span></div>
</div>
<div class="content final">
    <h1>¡ Gracias por confiar en nosotros !</h1>
    <blockquote>
        <p>! Se el primero en entrar en tu nuevo blog: <a href="<?php echo pathGen::pathHome(); ?>"><?php echo pathGen::pathHome(); ?></a> ¡</p>
        <p>Puedes empezar a administrar tu blog <a href="<?php echo pathGen::pathAdmin();?>">aquí.</a></p>
        <p>Da tu opinión en <a href="http://www.openblog.com">http://www.openblog.com</a></p>
    </blockquote>
</div>