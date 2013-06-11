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
	  });
	  break;
	case "aUsuarios": // Administrar usuarios
	  $cajaLoader.load('paneladmin/administrarUsuarios.php',function(){
          cargarAdministrarUsuarios();
      });
	  break;
	case "aCategorias": // Administrar categorías
	  $cajaLoader.load('paneladmin/administrarCategorias.php', function(){
	  	cargarListenersCategoria();
	  });
	  break;
	case "personalizar": // Personalizar
	  $cajaLoader.load('paneladmin/personalizar.php', function(){
              cargarListenersPersonalizar();
          });
	  break;
	case "aCuenta": // Administrar cuenta (mi cuenta)
	  $cajaLoader.load('paneladmin/administrarCuenta.php', function(){
	  	cargarListenersAdministrarCuenta();

	  });
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
	var hrefRaiz = actualHref.replace('administrador', '');
	$(location).attr('href', hrefRaiz);
}
function cargarListenersAdministrarCuenta(){
	$('#botonAdministrarDatosAdmin').on('click', function(e){
		e.preventDefault();
		/* Recogida de datos */
		var idUsuario = $('#idUsuario').val();
		var adminName = $('#adminName').val();
		var adminMail = $('#adminMail').val();
		var adminNewPassword = $('#adminNewPassword').val();
		var adminNewRePassword = $('#adminNewRePassword').val();
		var adminPassword = $('#adminPassword').val();
		/* Validaciones en cliente */
		validacion = validarModificarAdministrador(adminName, adminMail, adminNewPassword, adminNewRePassword, adminPassword);
		if(validacion.valor){
			$('#mensajeAdmin').text('');
			//Creamos un JSON con los datos
			var datos = {
				idUsuario : idUsuario,
				nombre : adminName,
				correo : adminMail,
				nuevaPass : adminNewPassword,
				adminPass : adminPassword
			}
			//Enviar al servidor
		$.post('paneladmin/administrarAdministrador.php', datos)
			.done(function(data){
				datos =  $.parseJSON(data);
				if(datos.cambio){
					$('#mensajeAdmin').removeClass('alert-error');
					$('#mensajeAdmin').addClass('alert-success');
					$('#mensajeAdmin').html('<p>'+datos.descripcion+'</p>');
				}else{
					$('#mensajeAdmin').removeClass('alert-success');
					$('#mensajeAdmin').addClass('alert-error');
					$('#mensajeAdmin').html('<p>'+datos.descripcion+'</p>');
				}
			})
			.fail(function(){
				console.log('Ha ocurrido algún fallo al enviar los datos.');
			})
		}else{
			$('#mensajeAdmin').addClass('alert-error');
			$('#mensajeAdmin').html('<p>'+validacion.error+'</p>');
		}
	});
}
function validarModificarAdministrador(adminName, adminMail, adminNewPassword, adminNewRePassword, adminPassword){
	validacion = { valor: false , error: ''};
	// Comprobamos que el campo nombre este relleno
	if(adminName == '' || adminName == ' '){
		$('#adminName').css('background', '#f2dede');
		//Error adminName vacio
		return validacion = {
			valor: false,
			error: 'Debes completar el nombre'
		}
	}
	$('#adminName').css('background', '#fff');
	//Si esta completado comprobamos el correo
	if(adminMail == ''  || adminMail == ' '){
		//Error mail vacio
		$('#adminMail').css('background', '#f2dede');
		return validacion = {
			valor: false,
			error: 'Debes indicar el correo'
		}
	}
	$('#adminMail').css('background', '#fff');
	//Si esta completado el correo comprobamos el campo nueva contraseña				
	if(adminNewPassword == '' || adminNewPassword == ' '){
			//Si no esta completado comprobamos que el de repetida lo está
			if(adminNewRePassword == '' || adminNewRePassword == ' '){
				$('#adminNewPassword').css('background', '#fff');
				$('#adminNewRePassword').css('background', '#fff');
			}else{
				$('#adminNewPassword').css('background', '#f2dede');
				$('#adminNewRePassword').css('background', '#f2dede');
				if(adminPassword != '' && adminPassword != ' '){
					$('#adminPassword').css('background', '#fff');
				}
				// Error contraseña vacía
				return validacion = {
					valor: false,
					error: 'Completa ambos campos, o ninguno.'
				}
			}
			if(adminPassword == '' || adminPassword == ' '){
				$('#adminPassword').css('background', '#f2dede');
				// Error contraseña vacía
				return validacion = {
					valor: false,
					error: 'Indica tu password'
				}
			}else{
				$('#adminPassword').css('background', '#fff');
				//Enviar petición a servidor
				return validacion = {
					valor: true,
					error: ''
				}
			}
	}
	$('#adminNewPassword').css('background', '#fff');
	//Si la nueva contraseña no esta vacia
	if(adminNewRePassword == '' || adminNewRePassword == ' '){
		$('#adminNewRePassword').css('background', '#f2dede');
		if(adminPassword != ''){
			$('#adminPassword').css('background', '#fff');							
		}
		//Error nueva contraseña repetida vacia
		return validacion = {
			valor: false,
			error: 'Completa el campo repetir nueva password'
		}
	}
	$('#adminNewRePassword').css('background', '#fff');
	//Comprobamos que la repita
	if(adminNewPassword == adminNewRePassword){
		$('#adminNewPassword').css('background', '#fff');
		$('#adminNewRePassword').css('background', '#fff');
		if(adminPassword != ''){
			$('#adminPassword').css('background', '#fff');							
			//Enviar petición a servidor
			return validacion = {
				valor: true,
				error: ''
			}
		}else {
			$('#adminPassword').css('background', '#f2dede');
			// Error contraseña vacía
			return validacion = {
				valor: false,
				error: 'Indica tu password'
			}
		}	
	}else{
		$('#adminNewPassword').css('background', '#f2dede');
		$('#adminNewRePassword').css('background', '#f2dede');
		//Error Contraseñas nuevas distintas
		return validacion = {
			valor: false,
			error: 'Ambas password deben coincidir'
		}
	}
				
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

	$('.botonCrearCategoria').on('click',function(e){
		$('#modalNuevaCategoria').modal({});
	});
	$('.botonEditarCategoria').on('click',function(e){
		$('#modalEditarCategoria').modal({});
		var idCategoria = $(this).data('idcategoria');
		$('.editarCategoria').attr('data-idcategoria', idCategoria);
		obtenerDatosCategoria(idCategoria);
		
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
		if(validarDatosCategoria(datosCategoria)){
			$.post('paneladmin/nuevaCategoria.php', datosCategoria)
			.done(function(data){
				$('#modalNuevaCategoria').modal('hide');				
				$cajaLoader.load('paneladmin/administrarCategorias.php', function(){
		  			cargarListenersCategoria();
		  			$('.cajaContenidoCategoria').find('table').before(data);
		  			ocultarAlerta();		  			
		  		});			
			})
			.fail(function(){
				console.log('Fallo en el envio de crear una categoria');
			})
		}else{
			mostrarAlertaError();
			ocultarAlerta();
		}
		
	});
	function ocultarAlerta(){
		setTimeout(function(){
		  		$('.alert').fadeOut(1500);		  				
		}, 2000);
	}
	function mostrarAlertaError(){
		var cajaAlerta ="<div class='cajaAlertaErrorCategoria alert alert-error alertaNuevoPost'> Debes completar los campos </div>";
		$('.modal-body').append(cajaAlerta);
	}
	function validarDatosCategoria(datosCategoria){
		var nombre = datosCategoria.nombre;
		var descripcion = datosCategoria.descripcion;
		if (nombre != '' && nombre != ' ' && descripcion != '' && descripcion != ' ') {
			return true;	
		}else{
			return false; 
		}
	}
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
		  			ocultarAlerta();
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
		if(validarDatosCategoria(datosCategoria)){
			$.post('paneladmin/editarCategoria.php', datosCategoria)
				.done(function(data){
					$('#modalEditarCategoria').modal('hide');
					 $cajaLoader.load('paneladmin/administrarCategorias.php', function(){
			  			cargarListenersCategoria();
			  			$('.cajaContenidoCategoria').find('table').before(data);
			  			ocultarAlerta();
			  		});			
				})
				.fail(function(){
					console.log('Fallo en el envio de crear una categoria');
				})
		}else{
			mostrarAlertaError();
			ocultarAlerta();
		}	
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

function cargarAdministrarUsuarios(){

    $('.botonBorrarUsuario').click(function(){
        if(confirm('¿Está seguro de que desea borrar el usuario?')){
            var idUsuario = $(this).parents('tr').data('idusuario');
            mandarPeticionBorrarUsuario(idUsuario);
        }
    });

    $('.botonEditarUsuario').click(function(){
		var idUsuario = $(this).parents('tr').data('idusuario');
		$('#myModal').modal({});
		$('#myModal .modal-body').load('paneladmin/src/templates/templateFormularioEditarUsuario.php?idUsuario='+idUsuario);




	})
	$('#myModal .btn-primary').click(function(){
		$myForm = $(this).parent().siblings('.modal-body').find('form');
		var datos = $myForm.serializeArray();
		$('#myModal').modal('hide');
		editarUsuario(datos);
	})
	function editarUsuario(datos){
		$.post('paneladmin/src/editarUsuario.php', datos, function(data){
			actualizarAlerta(data);
		  $cajaLoader.load('paneladmin/administrarUsuarios.php',function(){
	          cargarAdministrarUsuarios();
	      });			
		});

	}

	function actualizarAlerta(data){
		$('.cajaAlertas').html(data).show().delay(2000).queue(function(n) {
		  $(this).hide(); n();
		});;
		
	}


	function mandarPeticionBorrarUsuario(idUsuario){
	  $.post('paneladmin/src/borrarUsuario.php',{ idUsuario : idUsuario },function(data){
	      if(data){
	          $('.cajaAlertas').html('<div class="alert alert-success">Se ha eliminado correctamente el usuario</div>').fadeIn('slow');
	          $cajaLoader.load('paneladmin/administrarUsuarios.php',function(){
	              cargarAdministrarUsuarios();
	          });
	      }else{
	          $('.cajaAlertas').html('<div class="alert alert-error">Ha habido un problema intentando borrar el post, vuelva a intentarlo mas tarde</div>').fadeIn('slow');
	      }
	      setTimeout(function(){
	          $('div .alert').fadeOut('slow',function(){
	          });
	      }, 4000);
	  });
	}
}

function cargarListenersPersonalizar(){
    $("#tituloBlog + button").click(function(){
        $.post("paneladmin/src/actualizarJSON.php", {
            dato : $("#tituloBlog").val(),
            actualizar : "tituloBlog"
        })
        .success(function(){
            $cajaLoader.load('paneladmin/personalizar.php', function(){
                cargarListenersPersonalizar();
            });
        })
        .fail(function(){
            console.log('Ha ocurrido algún fallo al enviar los datos.');
        });
    });
    $("#descripcionBlog + button").click(function(){
        $.post("paneladmin/src/actualizarJSON.php", {
            dato : $("#descripcionBlog").val(),
            actualizar : "descripcionBlog"
        })
        .success(function(){
            $cajaLoader.load('paneladmin/personalizar.php', function(){
                cargarListenersPersonalizar();
            });
        })
        .fail(function(){
            console.log('Ha ocurrido algún fallo al enviar los datos.');
        });
    });
    $("#estilosBlog + button").click(function(){
        $.post("paneladmin/src/actualizarJSON.php", {
            dato : $("#estilosBlog").val(),
            actualizar : "rutaCss"
        })
        .success(function(){
            $cajaLoader.load('paneladmin/personalizar.php', function(){
                cargarListenersPersonalizar();
            });
        })
        .fail(function(){
            console.log('Ha ocurrido algún fallo al enviar los datos.');
        });
    });
    $("#logoBlog + button").click(function(){
        $.post("paneladmin/src/actualizarJSON.php", {
            dato : $("#logoBlog").val(),
            actualizar : "logo"
        })
        .success(function(){
            $cajaLoader.load('paneladmin/personalizar.php', function(){
                cargarListenersPersonalizar();
            });
        })
        .fail(function(){
            console.log('Ha ocurrido algún fallo al enviar los datos.');
        });
    });
}
