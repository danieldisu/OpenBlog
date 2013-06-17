(function() {

	var listaPost = {
		estado: "inicio",
		idPostSeleccionado: null,
		postSeleccionado: null,
		modal: $('#myModal'),
		
		lanzarModal: function() {
			
			this.modal.modal();
		},
		setContenidoModal: function(contenido) {
			return $(".modal-body").html(contenido);
		},
		setFooterModal: function() {
			var botonVolver = $('.botonVolver');
			var botonGuardarModificaciones = $('.botonGuardarModificaciones');
			var botonGuardarTexto = $('.botonGuardarTexto');
			if (this.estado == "editandoTexto") {
				botonGuardarTexto.show();
				botonGuardarModificaciones.hide();
				botonVolver.show();
			}

			if (this.estado == "editandoPost") {
				botonVolver.hide();
				botonGuardarTexto.hide();
				botonGuardarModificaciones.show();
			}
		},
		
		cargarListenersIniciales: function() {
			_this = this;

			$('.botonModificarTextoSolo').click(function() {
				estado.cambiarEstado('editandoTexto')
			});

			$('.botonEditarPost').click(function() {
				_this.idPostSeleccionado = $(this).data('idpost');
				estado.cambiarEstado('editandoPost')
			});

			$('.botonBorrarPost').click(function() {
				var idPost = $(this).data('idpost');
				if (window.confirm('¿Está seguro que desea borrar el post?'))
					_this.borrarPost(idPost);
			});

			$('#myModal').on('hide', function() {
				return confirm('perderá los cambios que no haya guardado');
			});

			$('#myModal').on('hidden', function() {
				estado.setEstadoInicial();
				_this.reloadLista();
			});

			$('.botonVolver').click(function() {
				estado.cambiarEstado('editandoPost');
			})

			$('.botonGuardarTexto').click(function() {
				_this.guardarModificacionesTexto();
			});

			$('.botonGuardarModificaciones').click(function() {
				_this.guardarModificacionesPost();
			});

			$('.administrarComentarios').click(function() {
				var idPost = $(this).data('idpost');
				administrarComentarios.abrirVentana(idPost);
			})
		},
		reloadLista: function() {
			console.debug("se ha recargado la lista");
			$cajaLoader.load('paneladmin/administrarPosts.php');
		},
		cargarVistaFormulario: function(post, usuarios, categorias) {
			this.postSeleccionado = post;
			
			this.setContenidoModal(this.rellenarFormulario(post, usuarios, categorias));

			$('.botonModificarTextoPost').click(function() {
				estado.cambiarEstado('editandoTexto');
			})

			return true;
		},
		rellenarFormulario: function(post, usuarios, categorias) {
			var $form = $('.formularioModificarPost').clone();

			$form.css('display', 'block');

			$form.find('#idpost').val(post.id);
			$form.find('#titulo').val(post.titulo);

			var $selectCategorias = $form.find('#categorias');

			post.idCategoria;
			post.idUsuario;

			for (var i = 0; i < categorias.length; i++) {


				var nombrecat = categorias[i].nombre;

				var idcat = categorias[i].id;

				var selected = false;

				if (idcat == post.idCategoria)
					selected = true; // Si el id de la categoria a mostrar es el id al que pertenece el post se le indica que tiene que estar seleccionado por defecto

				$selectCategorias.append(new Option(nombrecat, idcat, selected, selected)); // Los dos selected hacen que el option seleccionado por defecto sea el correcto
			};
			var $selectUsuarios = $form.find('#usuarios');

			for (var i = 0; i < usuarios.length; i++) {
				var nombreusuario = usuarios[i].nombre;
				var idusuario = usuarios[i].id;
				var selected = false;

				if (idusuario == post.idUsuario)
					selected = true;

				$selectUsuarios.append(new Option(nombreusuario, idusuario, selected, selected));
			};

			$form.find('#texto').html(post.texto);

			return $form;
		},
		cargarVistaEditor: function() {
			$('.modal-body').append("<div id='epiceditor'></div>");

			this.iniciarEditor();
		},
		iniciarEditor: function() {
			var now = new Date().getTime();

			var file = {
				name: "modificandoPost" + now,
				defaultContent: toMarkdown(this.postSeleccionado.texto)
			}

			editor2 = new EpicEditor({
				clientSideStorage: false,
				basePath: 'resources/js/epiceditor',
				file: file
			}).load();
		},
		guardarModificacionesTexto: function() {
			var idPost = this.postSeleccionado.id;
			editor2.preview(); // Pequeño hack, antes de mandar los datos, hacemos un preview y así obligamos al markdown a generarse
			var texto = $(editor2.getElement('previewer').body).find("div").html(); // Obtenemos el texto de la pantalla de preview
			$.post('paneladmin/src/actualizarTextoPost.php', {
				texto: texto,
				idPost: idPost
			}, function(data) {
				if (!JSON.parse(data).resultado) // Si el php devuelve algun error mostramos una alerta de error
					_this.mostrarAlertaFooter("Se ha encontrado un error", false);
				else {
					_this.mostrarAlertaFooter("Se ha Modificado correctamente el postr", true);
					var textoCambiado = JSON.parse(data).texto;
					_this.actualizarTextoPost(textoCambiado);
					estado.cambiarEstado('editandoPost');
				}
			})
		},
		guardarModificacionesPost: function() {

			var idPost = this.modal.find('#idpost').val();
			var titulo = this.modal.find('#titulo').val();
			var categoria = this.modal.find('#categorias').val();
			var usuario = this.modal.find('#usuarios').val();

			var infoPost = {
				id: idPost,
				idCategoria: categoria,
				idUsuario: usuario,
				titulo: titulo
			}
			if (titulo != "") {
				$.post('paneladmin/src/modificarPostEntero.php', {
					post: infoPost
				}, function(data) {
					$('#myModal').on('hidden', function() { // Reiniciamos los valores del modal al cerrarlo
						_this.reloadLista();
					})
					_this.mostrarAlertaFooter("Se ha Modificado correctamente el post", true);
				})
			} else {
				_this.mostrarAlertaFooter("El titulo no puede estar vacio", false);
			}
		},
		actualizarTextoPost: function(nuevoTexto) {
			$('#texto').html(nuevoTexto);
		},
		borrarPost: function(idPost) {
			$.post('paneladmin/src/borrarPost.php', {
				idPost: idPost
			}, function(data) {
				if (data) {
					_this.reloadLista();
					_this.mostrarAlerta("Se ha eliminado correctamente el post", true);
				} else
					_this.mostrarAlerta("Ha habido un problema intentando borrar el post, vuelva a intentarlo mas tarde", false);
			});

		},
		mostrarAlerta: function(texto, success) {
			if (success)
				$('.cajaAlertas').prepend('<div class="alert alert-success">' + texto + '</div>').fadeIn('slow');
			else
				$('.cajaAlertas').prepend('<div class="alert alert-error">' + texto + '</div>').fadeIn('slow');

			setTimeout(function() {
				$('div .alert').fadeOut('slow');
			}, 4000);
		},
		mostrarAlertaFooter: function(texto, success) {
			if (success)
				$('.modal-footer').prepend('<div class="alert alert-success">' + texto + '</div>').fadeIn('slow');
			else
				$('.modal-footer').prepend('<div class="alert alert-error">' + texto + '</div>').fadeIn('slow');

			setTimeout(function() {
				$('div .alert').fadeOut('slow');
			}, 4000);
		}
	}

	listaPost.cargarListenersIniciales();

	$('.botonVerTexto').click(function() {
		$(this).siblings('pre').toggle();
	})

	var estado = {
		cambiarEstado: function(estado) {
			switch (estado) {
				case 'estadoInicial':
					this.setEstadoInicial();
					break;
				case 'editandoPost':
					this.setEstadoEditandoPost();
					break;
				case 'editandoTexto':
					this.setEstadoEditandoTexto();
					break;
				default:
					this.setEstadoInicial();
			}
		},
		setEstadoInicial: function() {
			console.debug("Ha entrado estado inicial");
		},
		setEstadoEditandoPost: function() {
			volviendo = false;
			if (listaPost.estado == 'editandoTexto') {
				volviendo = true;
			}
			listaPost.estado = "editandoPost";

			console.debug('Ha entrado en el estado editando post');
			if (!volviendo) {
				$.when(
					$.ajax('paneladmin/src/getPost.php?idPost=' + listaPost.idPostSeleccionado),
					$.ajax('paneladmin/src/getUsuarios.php'),
					$.ajax('paneladmin/src/getCategorias.php')).then(function(post, usuarios, categorias) {
					listaPost.cargarVistaFormulario($.parseJSON(post[0]), $.parseJSON(usuarios[0]), $.parseJSON(categorias[0]));
					listaPost.estado = "editandoPost";
					listaPost.lanzarModal();
				});
			} else {
				$('#epiceditor').remove();
				$('.modal-body .formularioModificarPost').show();
			}
			listaPost.setFooterModal();
		},
		setEstadoEditandoTexto: function(post) {
			listaPost.estado = 'editandoTexto';
			console.debug('Ha entrado en el estado editando texto');
			$('.modal-body .formularioModificarPost').hide();
			listaPost.cargarVistaEditor();
			listaPost.setFooterModal();
		}
	}

	var administrarComentarios = {
		abrirVentana: function(idPost) {
			window.open('paneladmin/administrarComentarios.php?idPost=' + idPost, 'Administracion de Comentarios', 'width=900,height=500,resizable=no,status=no');
		}
	}
})();