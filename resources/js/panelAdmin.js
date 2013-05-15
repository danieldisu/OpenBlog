$('.btn.admin').on('click', function(e) {
  e.preventDefault();
  var indice = $(this).data('admin');
  /*Obtengo el id del boton, para saber cual se pulsa*/
  //console.log('Click en: '+indice);
  /*Segun el boton pulsado cargamos una opcion u otra.*/
  $cajaLoader = $('.cajaLoader'); // 'cacheamos' cajaLoader para que no tenga que estar buscandolo cada vez
  switch (indice) {
	case "nEntrada": // Nuevo post
	  $cajaLoader.load('panelAdmin/nuevaEntrada.php', function(){
		cargarListenersNuevoPost();
	  })
	  break;
	case "aEntradas": // Administrar entradas
	  $cajaLoader.load('panelAdmin/administrarEntradas.php');
	  break;
	case "aUsuarios": // Administrar usuarios
	  $cajaLoader.load('panelAdmin/administrarUsuarios.php');
	  break;
	case "aCategorias": // Administrar categorías
	  $cajaLoader.load('panelAdmin/administrarCategorias.php');
	  break;
	case "personalizar": // Personalizar
	  $cajaLoader.load('panelAdmin/personalizar.php');
	  break;
	case "aCuenta": // Administrar cuenta (mi cuenta)
	  $cajaLoader.load('panelAdmin/administrarCuenta.php');
	  break;
	default: // Defecto, e Index.
	  $cajaLoader.load('panelAdmin/indexAdministrador.php');
  }
});

/*
 *	Panel Nuevo Post
 *	IMPORTANTE!
 *	Todos los listeners para las diferentes páginas/paneles del panel de admin hay que cargarlos una vez se haya cargado el php, es decir, cargarlos en un callback despues del LOAD
 *	o en un archivo Javascript que se cargue con el php de ese panel
 */
function cargarListenersNuevoPost(){
  $('#botonNuevoPost').on('click', function(e){
	e.preventDefault();
	var texto = $('.cajaEditorTexto textarea').val();
	var titulo = $('.cajaTitulo input').val();
	var idCategoria = $('.cajaCategoria select').val();

	if(!validarNuevoPost(titulo, texto)){
		alert("No puedo dejar ningún campo vacio");
		return false;
	}
	var datosPost = {
		texto : texto,
		titulo : titulo,
		idCategoria : idCategoria
	}
	$.post('paneladmin/nuevoPost.php', datosPost)
		.done(function(data){
			$('.formNuevoPost').fadeOut(function(){
				$('.formNuevoPost').parent().append(data);
			});
		})
		.fail(function(){
			console.log("fallo");
		})
  });
}
function validarNuevoPost(titulo, texto) {
  if(titulo === "") return false;
  if(texto === "") return false;
  return true;
}

