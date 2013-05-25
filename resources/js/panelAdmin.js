var editor;
$('.btn.admin').on('click', function(e) {
	
  e.preventDefault();
  var indice = $(this).data('admin');
  /*Obtengo el id del boton, para saber cual se pulsa*/
  //console.log('Click en: '+indice);
  /*Segun el boton pulsado cargamos una opcion u otra.*/
  $cajaLoader = $('.cajaLoader'); // 'cacheamos' cajaLoader para que no tenga que estar buscandolo cada vez
  switch (indice) {
	case "nEntrada": // Nuevo post
	  $cajaLoader.load('paneladmin/nuevaEntrada.php', function(){
		cargarListenersNuevoPost();
		editor = new EpicEditor({
			basePath: 'resources/js/epiceditor'
		}).load();
	  })
	  break;
	case "aEntradas": // Administrar entradas
	  $cajaLoader.load('paneladmin/administrarPosts.php',function(){
	  	funcionesListaPost();
	  });
	  break;
	case "aUsuarios": // Administrar usuarios
	  $cajaLoader.load('paneladmin/administrarUsuarios.php');
	  break;
	case "aCategorias": // Administrar categorías
	  $cajaLoader.load('paneladmin/administrarCategorias.php', function(){
	  	cargarListenersCategoria();
	  });
	  break;
	case "personalizar": // Personalizar
	  $cajaLoader.load('paneladmin/personalizar.php');
	  break;
	case "aCuenta": // Administrar cuenta (mi cuenta)
	  $cajaLoader.load('paneladmin/administrarCuenta.php');
	  break;
	case "aSalir": // Administrar cuenta (mi cuenta)
		// IMPLEMENTAR FUNCION QUE ME LLEVE A INDEX
		goToIndex();
		break;
	default: // Defecto, e Index.
	  $cajaLoader.load('paneladmin/indexAdministrador.php');
  }
});
/*
	Funcion que me manda a index
*/
function goToIndex(){
	/**
	* Funcion encargada de obtener el enlace actual en el panel admin
	* y quitarle 'panelAdmin.php' para volver al indice.
	 */
	var actualHref = $(location).attr('href');
	var hrefRaiz = actualHref.replace('panelAdmin.php', '');
	$(location).attr('href', hrefRaiz);
}

/*
 *	Panel Nuevo Post
 *	IMPORTANTE!
 *	Todos los listeners para las diferentes páginas/paneles del panel de admin hay que cargarlos una vez se haya cargado el php, es decir, cargarlos en un callback despues del LOAD
 *	o en un archivo Javascript que se cargue con el php de ese panel
 */
function cargarListenersNuevoPost(){
  $('#botonNuevoPost').on('click', function(e){
	e.preventDefault();
	editor.preview();
	var texto = $(editor.getElement('previewer').body).find("div").html();
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
			editor.remove(); // Limpiamos el editor de texto si todo va bien
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
function cargarListenersCategoria(){
	// Mostrar u ocultar div nueva categoria
	$('.botonCrearCategoria').on('click',function(e){
		e.preventDefault();
		var display = $('.cajaFormularioNuevaCategoria').css('display');
		if (display == 'none'){
			$('.cajaFormularioNuevaCategoria').css('display', 'block');
		}
		else{
			$('.cajaFormularioNuevaCategoria').css('display', 'none');	
		}
		
	});
	// Mostrar u ocultar div editar categoria
	$('.botonEditarCategoria').on('click',function(e){
		e.preventDefault();
		var display = $('.cajaFormularioEditarCategoria').css('display');
		var idCategoria = $(this).data('idcategoria');
		if (display == 'none'){
			$('.editarCategoria').attr('data-idcategoria', idCategoria);
			obtenerDatosCategoria(idCategoria);
			$('.cajaFormularioEditarCategoria').css('display', 'block');
		}
		else{
			$('.cajaFormularioEditarCategoria').css('display', 'none');	
		}
		
	});
	// Crear nueva categoria
	$('.crearCategoria').on('click',function(e){
		e.preventDefault();
		var nombre = $('#nombreCategoria').val();
		var descripcion = $('#descripcionCategoria').val();
		var datosCategoria ={
			nombre : nombre,
			descripcion : descripcion
		}
		$.post('paneladmin/nuevaCategoria.php', datosCategoria)
			.done(function(data){
				$('.cajaFormularioNuevaCategoria').css('display', 'none');
				 $cajaLoader.load('paneladmin/administrarCategorias.php', function(){
		  			cargarListenersCategoria();
		  			$('.cajaContenidoCategoria').find('table').before(data);
		  		});			
			})
			.fail(function(){
				console.log('Fallo en el envio de crear una categoria');
			})
	});
	$('.botonBorrarCategoria').on('click', function(e){
		// Cogemos el id de la categoria
		var idCategoria = $(this).data('idcategoria');
		var datosCategoria = {
			id : idCategoria
		}
		$.post('paneladmin/borrarCategoria.php', datosCategoria)
			.done(function(data){
				 $cajaLoader.load('paneladmin/administrarCategorias.php', function(){
		  			cargarListenersCategoria();
		  			$('.cajaContenidoCategoria').find('table').before(data);
		  		});			
			})
			.fail(function(){
				console.log('Fallo en el envio de crear una categoria');
			})		
	});
	$('.editarCategoria').on('click', function(e){
		// Cogemos el id de la categoria
		var id = $(this).data('idcategoria');
		var nombre = $('#editarNombreCategoria').val();
		var descripcion = $('#editarDescripcionCategoria').val();
		var datosCategoria = {
			id : id,
			nombre : nombre,
			descripcion: descripcion
		}
		$.post('paneladmin/editarCategoria.php', datosCategoria)
			.done(function(data){
				 $cajaLoader.load('paneladmin/administrarCategorias.php', function(){
		  			cargarListenersCategoria();
		  			$('.cajaContenidoCategoria').find('table').before(data);
		  		});			
			})
			.fail(function(){
				console.log('Fallo en el envio de crear una categoria');
			})		
	});
}

function obtenerDatosCategoria(idCategoria){
	datosCategoria = {
		id: idCategoria
	};
	datos = $.post('paneladmin/obtenedorCategoria.php', datosCategoria)
			.done(function(data){
				datos =  $.parseJSON(data);
				$('#editarNombreCategoria').val(datos.nombre);
				$('#editarDescripcionCategoria').val(datos.descripcion);
			})
			.fail(function(){
				console.log('Fallo en el envio de crear una categoria');
			})
	return datos;
	
}

/* LISTA POSTS */
function funcionesListaPost(){
	var idPostEditando;
	var editor2;
	//var botonGuardarModificaciones = "<button class='btn btn-warning botonGuardarModificaciones'> Guardar Modificaciones </button>";
	var botonGuardar = $('.botonModificarPost');
	var botonModificar = $('.botonGuardarModificaciones');
	var datosPost;

 	/* EVENTOS */
	$('.listaPosts .btn-info').click(function(){//Evento para abrir modal
		datosPost = getDatosPost(this);
		var textoPost = datosPost.textoPost;
		var tituloPost = datosPost.tituloPost;
		botonModificar.data('postentero',false);
		actualizarModal(tituloPost, textoPost, false);
	});

	$('.botonModificarPost').click(function(){
		getDatosPost();
		var contenidoModal = "<div id='epiceditor'></div>";
		var tituloModal = "editando el post:";
		actualizarModal(tituloModal, contenidoModal,true);
		cargarEditor();
	})

	$('.botonGuardarModificaciones').click(function(){
		if($(this).data('postentero')){
			guardarModificacionPost();
		}else{
			guardarModificaciones();
		}
	});

	$('#myModal').on('hidden', function () {	// Reiniciamos los valores del modal al cerrarlo
 		actualizarModal(" ", " ", false);
 	})

 	$('.botonEditarPost').click(function(){
 		idPostEditando = $('this').data('idpost');
 		botonModificar.data('postentero',true);
 		var contenido = getFormularioEditarPost(this);
 	});

 	$('.botonBorrarPost').click(function(){
 		if(window.confirm('¿Está seguro que desea borrar el post?'))
 			mandarPeticionBorrarPost($(this).data('idpost'));
 	});


	/* FIN EVENTOS */

	function mandarPeticionBorrarPost(idPost){
		$.post('paneladmin/src/borrarPost.php', { idPost : idPost }, function(data){
			if(data){
				recargarListaPost();
				alert("Se ha eliminado correctamente el post");
			}
			else
				alert("Se ha encontrado un error eliminando el post");
		});
	}

	function cargarEditor_old(){
		var now = new Date().getTime();

		var file = {
			name : "modificandoPost"+now,
			defaultContent : toMarkdown(datosPost.textoPost)
		}

		editor2 = new EpicEditor({
			clientSideStorage: false,
			basePath: 'resources/js/epiceditor',
			file : file
		}).load();

	}

	function cargarEditor(post){
		var now = new Date().getTime();

		var file = {
			name : "modificandoPost"+now,
			defaultContent : toMarkdown(post.texto)
		}

		editor2 = new EpicEditor({
			clientSideStorage: false,
			basePath: 'resources/js/epiceditor',
			file : file
		}).load();		
	}

	function actualizarModal(titulo, contenido, modificando){
		$(".modal-header h3").html(titulo);
		$(".modal-body").html(contenido);
		actualizarBotonesModal(modificando);
	}

	function actualizarBotonesModal(editando){
		var div = $('.modal-footer');
		if(editando == null){

		}else if(!editando){
			botonGuardar.show();
			botonModificar.hide();
		}else{
			botonGuardar.hide();
			botonModificar.show();
		}
	}

	/* MODIFICACIONES REALIZADAS PARA EL EDITOR DE POST */
	function guardarModificaciones(){
		var texto = datosPost.textoPost;
		var idPost = datosPost.idPost;
		editor2.preview();	// Pequeño hack, antes de mandar los datos, hacemos un preview y así obligamos al markdown a generarse
		var texto = $(editor2.getElement('previewer').body).find("div").html(); // Obtenemos el texto de la pantalla de preview
		$.post('paneladmin/src/actualizarTextoPost.php', {texto : texto, idPost : idPost} ,function(data){
			if(!JSON.parse(data).resultado)	// Si el php devuelve algun error mostramos una alerta de error
				$('.modal-footer').prepend('<div class="alert alert-error">Se ha encontrado un error</div>').fadeIn('slow');
			else{
				console.log(JSON.parse(data).resultado); // En caso de que vaya todo bien, mostramos una alerta 
				$('.modal-footer').prepend('<div class="alert alert-success">Se ha Modificado correctamente el post</div>').fadeIn('slow');
					setTimeout(function(){
					  $('div .alert').fadeOut('slow');
					}, 5000);
				
			}
		})
	}

	function guardarModificacionPost(){
		var $modal = $('#myModal');
		var idPost = $modal.find('#idpost').val();
		var titulo = $modal.find('#titulo').val();
		var categoria = $modal.find('#categorias').val();
		var usuario = $modal.find('#usuarios').val();

		var infoPost = {
			id : idPost,
			idCategoria : categoria,
			idUsuario : usuario,
			titulo : titulo 
		}
		$.post('paneladmin/src/modificarPostEntero.php',{ post : infoPost },function(data){
			$('#myModal').on('hidden', function () {	// Reiniciamos los valores del modal al cerrarlo
		 		recargarListaPost();
		 	})	
			$('.modal-footer').prepend('<div class="alert alert-success">Se ha Modificado correctamente el post</div>').fadeIn('slow');

			setTimeout(function(){
			  $('div .alert').fadeOut('slow');
			}, 5000);
		})
	}

	function recargarListaPost(){
		return $cajaLoader.load('paneladmin/administrarPosts.php',function(){
			funcionesListaPost();
			return true;
		});

	}

	function getDatosPost(enlace){
		var textoPost = $(enlace).siblings(".textoPost").html();
		var idPost = $(enlace).data('idpost');
		
		var datosPost = {
			idPost : idPost,
			textoPost : textoPost
		}
		return datosPost;
	}


	function getFormularioEditarPost(boton){
		var idPost = $(boton).data('idpost');
		var post;
		var usuarios;
		var categorias;
		$.get('paneladmin/src/getPost.php?idPost='+idPost, function(data){
			post = $.parseJSON(data);
			$.get('paneladmin/src/getCategorias.php', function(data){
				categorias = $.parseJSON(data);
				$.get('paneladmin/src/getUsuarios.php', function(data){
					usuarios = $.parseJSON(data);
					var contenido = rellenarFormulario(post,usuarios,categorias);
					actualizarModal('Editando Post',contenido, true);
					$('#myModal').modal();
					$('.botonModificarTextoPost').click(function(){
						var contenidoModal = "<div id='epiceditor'></div>";
						var tituloModal = "editando el post:";
				 		actualizarModal(tituloModal, contenidoModal,true);
						cargarEditor(post);
				 	})
				})
			})
		})



	}

	function rellenarFormulario(post,usuarios,categorias){
		var $form = $('.formularioModificarPost').clone();
		
		$form.css('display','block');

		$form.find('#idpost').val(post.id);
		$form.find('#titulo').val(post.titulo);
		var $selectCategorias = $form.find('#categorias');
		post.idCategoria;
		post.idUsuario;
		for (var i = 0; i < categorias.length; i++) {
			var nombrecat = categorias[i].nombre;
			var idcat = categorias[i].id;

			var selected = false;

			if(idcat == post.idCategoria)
				selected = true;	// Si el id de la categoria a mostrar es el id al que pertenece el post se le indica que tiene que estar seleccionado por defecto

			$selectCategorias.append(new Option(nombrecat, idcat, selected, selected));	// Los dos selected hacen que el option seleccionado por defecto sea el correcto
		};




		var $selectUsuarios = $form.find('#usuarios');

		for (var i = 0; i < usuarios.length; i++) {
			var nombreusuario = usuarios[i].nombre;
			var idusuario = usuarios[i].id;
			var selected = false;

			if(idusuario == post.idUsuario)
				selected = true;

			$selectUsuarios.append(new Option(nombreusuario, idusuario, selected, selected));			
		};

		//console.log(post);

		//console.log(usuarios);
		
		return $form;
	}
}