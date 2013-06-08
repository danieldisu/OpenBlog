/* 
	Funcion que iniciar todo el tinglado, es una funcion anonima que se llama así misma ( vease http://sarfraznawaz.wordpress.com/2012/01/26/javascript-self-invoking-functions/ ) 
	Iniciar aquí los listener GLOBALES para todas las páginas
*/

(function() {
	var paginaActual = window.location.hash;
	cargarPagina(paginaActual);

	window.onhashchange = function() {
		var paginaActual = window.location.hash;
		$(".content").css({"position":"absolute"})
			.animate({
               "margin-left":"2000px"
            },750,function(){
                 cargarPagina(paginaActual);
      	});
	}
        /*
         * No hagais caso a estas funciones de momento ya que estaban pensadas para hacer animaciones (que he quitado codigo)
         * así que lo dejo sin ellas de momento y ya si eso más adelante las implemento
        function actualizarClasesPasos(){
            var paginaActual = window.location.hash;
            addClasesPasos(paginaActual);
            removeClasesPasos(paginaActual);
        }
        
        function addClasesPasos(paginaActual){
            if(paginas.indexOf(paginaActual) == -1){
                $("div.circulo:eq(0)").addClass("actual");
                $("div.circulo:eq(0) span").text("1").addClass("actual");
            }
            else {
                $("div.circulo:eq("+paginas.indexOf(paginaActual)+")").addClass("actual");
                $("div.circulo:eq("+paginas.indexOf(paginaActual)+") span").text(paginas.indexOf(paginaActual) + 1).addClass("actual");
            }
        }
        
        function removeClasesPasos(paginaActual){
            $("div.actual").each(function(){
                $(this).removeClass("actual");
            });
            $("span.actual").each(function(){
                $(this).text("").removeClass("actual");
            });
        }
        */
        
	function cargarPagina(paginaActual) {
		switch (paginaActual) {
			case '#elegirBD':
				IniciarElegirBD();
				break;
			case '#creaciontablas':
				IniciarCreacionTablas()
				break;
			case '#cuentaadmin':
				IniciarCuentaAdmin();
				break;
			case '#datosconfiguracion':
				IniciarDatosConfiguracion();
				break;
			case '#final':
				IniciarPantallaFinal();
				break;
			default:
				IniciarPantallaBienvenida()
		}
	}

})()

/* Funciones de bienvenida */

function IniciarPantallaBienvenida() {
	initA();

	function initA() {
		console.debug('Pagina Actual : bienvenida');

		$('.cajaMain').load('template/templatePantallaBienvenida.php', function(){
                    $(".content").css({"margin-left":"auto"});
                }).attr('id', 'cajaBienvenida');

		$('#botonSiguiente').attr("href", "#elegirBD");
	}

}



/*
	Funciones que responden a #elegirBD
*/

function IniciarElegirBD() {
	var campoHostVacio = true;
	var campoUserVacio = true;

	initB();

	function initB() {
		console.debug('Pagina Actual : ElegirBD');

		$('.cajaMain').load('template/templateFormularioElegirBD.php', function(){
                    $('#labelNombreBD').tooltip({
			title: 'Si se deja vacio se creará con el nombre openblog'
                    });
                    $(".content").css({"margin-left":"auto"});
                    cargarListeners();
                }).attr('id', 'cajaElegirBD'); // Cargamos la ruta y le añadimos el id

		$('#botonAnterior').attr("href", "#bienvenida"); // Actualizamos la url de los botones, estos botones no exisitiran en la version final!!

		$('#botonSiguiente').attr("href", "#creaciontablas");

		

		

	};

	function cargarListeners() {
		$('#campoHost').keyup(function() {
			if ($(this).val() !== "") {
				campoHostVacio = false;
			} else {
				campoHostVacio = true;
			}
		});

		$('#campoUser').keyup(function() {
			if ($(this).val() !== "") {
				campoUserVacio = false;
			} else {
				campoUserVacio = true;
			}
		});

		$('.botonValidar').click(function() {
			if (!campoUserVacio && !campoHostVacio) {
				$(this).hide();
				$('.spinner').show();
				iniciarComprobacionBD();
			} else {
				mostrarAlertaError('Ha de completar los campos de Host y Usuario', 3000);
			}
		})
	}

	function comprobarCamposVacios(campo, vacio) {
		if ($(campo).val() !== "") {
			vacio = false;
		} else {
			vacio = true;
		}
	}

	function iniciarComprobacionBD() {
		var user = $('#campoUser').val();
		var pass = $('#campoPass').val();
		var host = $('#campoHost').val();

		var datos = {
			user: user,
			pass: pass,
			host: host
		};

		$.post('src/comprobacionBaseDatos.php', datos, function(data) {
			var respuesta = JSON.parse(data);
			if (respuesta.codigo == 2) {
				mostrarAlertaExito('Se ha conectado exitosamente a la Base de Datos', 3000);
				$('.spinner').toggle();
				var botonSiguiente = "<a href='#creaciontablas' class='btn btn-big'> Siguiente </a> ";
				$('.cajaBotonValidar').append(botonSiguiente)
			} else {
				var tipoError = respuesta.mensaje;
				mostrarAlertaError('No se ha podido establecer una conexión con el servidor, <b>' + tipoError + '</b>', 3000);
				$('.spinner').toggle();
				$('.botonValidar').toggle();
			}
		});
	}

}



function IniciarCreacionTablas() {
	initC();

	function initC() {
		console.debug('Pagina Actual : creaciontablas');
		$('.cajaMain').load('template/templateCreacionTablas.php', function(){
                    $(".content").css({"margin-left":"auto"});
                }).attr('id', 'cajaCreacionTablas');

		MandarPeticionCreacionTablas();

		$('#botonAnterior').attr("href", "#elegirBD");
		$('#botonSiguiente').attr("href", "#cuentaadmin");
	}

	function MandarPeticionCreacionTablas(){
		$.post('src/crearTablas.php', function(data){
			var respuesta = JSON.parse(data);
			if (respuesta.codigo == 2) {
				mostrarAlertaExito('Se han creado correctamente las tablas en la base de datos', 3000);
				$('#comprobacion img').remove();
				var botonSiguiente = "<a href='#cuentaadmin' class='btn btn-big'> Siguiente </a> ";
				$('#comprobacion').append(botonSiguiente)
			} else {
				var tipoError = respuesta.mensaje;
				mostrarAlertaError('Se ha encontrado un error al crear las tablas, <b>' + tipoError + '</b>', 3000);

			}

		})
	}

}

function IniciarCuentaAdmin() {
	var campoNombreVacio = true;
	var campoMailVacio = true;
	var campoPassAdminVacio = true;
	var campoPassAdminRVacio = true;
	initD();

	function initD() {
		console.debug('Pagina Actual : cuentaadmin');
		$('.cajaMain').load('template/templateCuentaAdmin.php', function(){
                    $(".content").css({"margin-left":"auto"});
                    cargarListenersCuentaAdmin();
                }).attr('id', 'cajaCuentaAdmin');

		$('#botonAnterior').attr("href", "#elegirBD");
		$('#botonSiguiente').attr("href", "#datosconfiguracion");
	}

	function cargarListenersCuentaAdmin() {
		$('#campoNombre').keyup(function() {
			if ($(this).val() !== "") {
				campoNombreVacio = false;
			} else {
				campoNombreVacio = true;
			}
		});
		$('#campoMail').keyup(function() {
			if ($(this).val() !== "") {
				campoMailVacio = false;
			} else {
				campoMailVacio = true;
			}
		});
		$('#campoPassAdmin').keyup(function() {
			if ($(this).val() !== "") {
				campoPassAdminVacio = false;
			} else {
				campoPassAdminVacio = true;
			}
		});
		$('#campoPassAdminR').keyup(function() {
			if ($(this).val() !== "") {
				campoPassAdminRVacio = false;
			} else {
				campoPassAdminRVacio = true;
			}
		});
		$('.botonValidar').click(function() {
			if (!campoNombreVacio && !campoMailVacio && !campoPassAdminVacio && !campoPassAdminRVacio) {
				$(this).hide();
				$('.spinner').show();
				insercionBD();
			} else {
				mostrarAlertaError('Ha de completar todos los campos', 3000);
			}
		})
	}
	function insercionBD() {
		var nombre = $('#campoNombre').val();
		var mail = $('#campoMail').val();
		var pass = $('#campoPassAdmin').val();
		var passR =$('#campoPassAdminR').val();
		if(validarContraseña(pass, passR)){
			var datos = {
				nombre: nombre,
				mail: mail,
				pass: pass
			};
			$.post('src/insercionCuentaAdmin.php', datos, function(data){
				data = JSON.parse(data);
				if(data.insercion){
					mostrarAlertaExito('Usuario administrador creado correctamente.' , 3000);
					$('.spinner').toggle();
					var botonSiguiente = "<a href='#datosconfiguracion' class='btn btn-big'> Siguiente </a> ";
					$('.cajaBotonValidar').append(botonSiguiente)					
				}	
				else{
					mostrarAlertaError(data.error, 4000);
					// Añadir posibilidades en caso de fallo
				}
					
			});
		}
	}

	function validarContraseña(pass, passR) {
		if (pass == passR) {
			return true;
		}else {
			return false;
		}
	} 

}
/*
    Funciones que corresponden a los datos de configuración
 */

function IniciarDatosConfiguracion() {
	initE();

	function initE() {
		console.debug('Pagina Actual : datosconfiguracion');
		$('.cajaMain').load('template/templateDatosConfiguracion.php', function(){
                    $('#tipTitulo').tooltip({
			title: 'Titulo predefinido: OpenBlog'
                    });
                    $('#tipDescripcion').tooltip({
			title: 'Si se deja en blanco el blog no tendrá descripción'
                    });
                    $('#tipEstilos').tooltip({
			title: 'Si se deja en blanco se usará la ruta css por defecto'
                    });
                    $('#tipLogo').tooltip({
			title: 'Si se deja en blanco se usará el logo de OpneBlog por defecto'
                    });
                    $(".content").css({"margin-left":"auto"});
                    cargarListenerConfig();
                }).attr('id', 'cajaConfiguracion');
		$('#botonAnterior').attr("href", "#cuentaadmin");

		$('#botonSiguiente').attr("href", "#final");
	}


}

function cargarListenerConfig(){
    $("#guardarDatosConfig").click(function(){
        $.post("src/insercionDatosConfig.php", {
            tipTitulo : $("#tituloBlog").val(),
            tipDescripcion : $("#descripcionBlog").val(),
            tipEstilos : $("#rutaEstilosBlog").val(),
            tipLogo : $("#rutaLogoBlog").val()
        })
        .success(function(data){
            var datos = $.parseJSON(data);
            if(datos.correcto){
                mostrarAlertaExito("Se han efectuado los cambios correctamente, pulsa siguiente paso para continuar", 3000);
                $("#tituloBlog").val("");
                $("#descripcionBlog").val("");
                $("#rutaEstilosBlog").val("");
                $("#rutaLogoBlog").val("");
            }
            else {
                mostrarAlertaError(datos.msn, 4000);
            }
        })
        .fail(function(){
            mostrarAlertaError("Ha ocurrido un error durante la ejecución", 4000);
        });
    });
}

function IniciarPantallaFinal() {
	initF();

	function initF() {
		console.debug('Pagina Actual : final');
		$('.cajaMain').load('template/templateFinal.php', function(){
                    $(".content").css({"margin-left":"auto"});
                }).attr('id', 'cajaFinal');
		$('#botonAnterior').attr("href", "#datosconfiguracion");

		$('#botonSiguiente').attr("href", "#final");
	}


}



function mostrarAlertaError(texto, tiempo) {
	var alerta = "<div class='alert alert-error'>" + texto + "</div>";
	$('.cajaAlertas').html(alerta).slideDown();
	setTimeout(function() {
		$('.alert').slideUp().html(" ");
	}, tiempo)
}

function mostrarAlertaExito(texto, tiempo) {
	var alerta = "<div class='alert alert-success'>" + texto + "</div>";
	$('.cajaAlertas').html(alerta).slideDown();
	setTimeout(function() {
		$('.alert').slideUp().html(" ");
	}, tiempo)
}