/* --- Parte menu administrador --- */
$(document).ready(function(){
	/*
		Evento click en boton de comentarios. Mostrar comentarios.
	*/
	$('.btnComentarios').on('click', function(e){
		e.preventDefault();
		var idPost = $(this).parent().parent().data('idpost');		
		if (window.XMLHttpRequest){
			xhr = new XMLHttpRequest();
		}else if (window.ActiveXObject) {
			var xhr= new ActiveXObject("Microsoft.XMLHTTP");
		}
		var lanzadorEvento = $(this);
		//Enviamos peticion ajax
		enviarPeticionAJAX(idPost, xhr, lanzadorEvento);
	});

	/*
		Escribir nuevo comentario botonNuevoComentario
	*/
	$('.botonNuevoComentario').on('click', function(e){
		e.preventDefault();
		var idPost = $(this).parent().parent().data('idpost');
			var cajaNuevoComentario = $(this).parent().parent().next().next();			
			if(cajaNuevoComentario.attr("class") == "cajaNuevoComentario oculto"){
				cajaNuevoComentario.removeClass("oculto");
				cajaNuevoComentario.addClass("visible");
			}
			else{
				cajaNuevoComentario.removeClass("visible");
				cajaNuevoComentario.addClass("oculto");				
			}				
	});

	$('.botonEnviarComentario').on('click', function(e){
		e.preventDefault();
		xhr = new XMLHttpRequest();		
		var idPost = $(this).parent().parent().prev().prev().data('idpost');
		var autorComentario = $(this).parent().find("#autor").val();
		var textoComentario = $(this).parent().find("textarea").val();
		enviarNuevoComentario(xhr, idPost, autorComentario, textoComentario);	
	});
        
	$("div.cajaLogin input[value='Login']").click(function(e){
	   comprobarLogin();
	});

	$("div.cajaLogin input[value='Logout']").click(function(e){
	   $.post("logout.php")
	   .done(function(data){
	       window.location.reload(true);
	   });
	   
	});
	$("div.cajaLogin input[value='Administrar']").click(function(e){
	   window.location.replace('panelAdmin.php');	   
	});
        
        /*Comprobar campo de registro*/
        $("#regNombre input").keyup(function(){
            comprobarRegNombre(this);
        });
        $("#regEmail input").keyup(function(){
            comprobarRegEmail(this);
            comprobarRegEmailR("#regEmailR input");
        });
        $("#regEmailR input").keyup(function(){
            comprobarRegEmailR(this);
        });
        $("#regPass input").keyup(function(){
            comprobarRegPass(this);
            comprobarRegPassR("#regPassR input");
        });
        $("#regPassR input").keyup(function(){
            comprobarRegPassR(this);
        });
        $("#btnRegistro").click(function(){
            var correcto = true;
            correcto = correcto && regNombre;
            correcto = correcto && regEmail;
            correcto = correcto && regEmailR;
            correcto = correcto && regPass;
            correcto = correcto && regPassR;
            
            if(correcto){
                $.post("comprobarRegistro.php", {
                    nombre : $("#regNombre input").val(),
                    email : $("#regEmail input").val(),
                    emailR : $("#regEmailR input").val(),
                    pass : $("#regPass input").val(),
                    passR : $("#regPassR input").val()
                }, "json")
                .success(function(data){
                    var json = JSON.parse(data);
                    if(!json.nombre.correcto){
                        mostrarImagen("#regNombre", false, json.nombre.msn);
                    }
                    if(!json.email.correcto){
                        mostrarImagen("#regEmail", false, json.email.msn);
                    }
                    if(!json.emailR.correcto){
                        mostrarImagen("#regEmailR", false, json.emailR.msn);
                    }
                    if(!json.pass.correcto){
                        mostrarImagen("#regPass", false, json.pass.msn);
                    }
                    if(!json.passR.correcto){
                        mostrarImagen("#regPassR", false, json.passR.msn);
                    }
                    if(json.nombre.correcto && json.email.correcto && json.emailR.correcto && json.pass.correcto && json.passR.correcto){
                        $.post("nuevoUsuario.php",{
                            nombre : $("#regNombre input").val(),
                            email : $("#regEmail input").val(),
                            pass : $("#regPass input").val(),
                        })
                        .success(function(){
                            
                        });
                    }
                });
            }
            else {
                comprobarRegNombre("#regNombre input");
                comprobarRegEmail("#regEmail input");
                comprobarRegEmailR("#regEmailR input");
                comprobarRegPass("#regPass input");
                comprobarRegPassR("#regPassR input");
            }
        });
});

function comprobarLogin(){    
    var usuario = $("#inputUsuario").val();
    var pass = $("#inputPassword").val();
    
    if(usuario == ""){
        crearMensajeErrorLogin("El campo usuario no puede estar vacio");
    }
    else if(pass == ""){
        crearMensajeErrorLogin("El campo contraseña no puede estar vacio");
    }
    else {
        comprobarLoginAjax(usuario, pass);
    }
}

function comprobarLoginAjax(usuario, pass){
    $.post("comprobarLogin.php", {
        usuario: usuario,
        pass: pass
    })
    .done(function(data){
        if(data == "exito"){
            window.location.reload(true);
        }
        else {
            crearMensajeErrorLogin(data);
        }
    });
}

function crearMensajeErrorLogin(msn){
    $("div.alert").remove();
    $("div.cajaLogin h3").after("<div class='alert alert-msn'>"+msn+"</div>");
    $("div.alert").fadeIn(500).delay(2500).fadeOut(1000, function(){
        $("div.alert").remove();
    });
}

function enviarNuevoComentario(xhr, idPost, autorComentario, textoComentario){
	$.post("nuevoComentario.php", { idPost: idPost, autor: autorComentario , textoComentario : textoComentario} )
	.done(function(data){
		
		$(".cajaNuevoComentario").fadeOut('fast',function(){
			$(this).html(data).fadeIn();
		})
	})
}

function enviarPeticionAJAX(idPost, xhr, lanzadorEvento) {
	var idPost = idPost;
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			var cajaComentarios = lanzadorEvento.parent().parent().next();
			if(cajaComentarios.attr("class") == "cajaComentarios oculto"){
				
				cajaComentarios.removeClass("oculto");
				cajaComentarios.addClass("visible");				
				cajaComentarios.html(xhr.responseText);
			}
			else{
				cajaComentarios.removeClass("visible");
				cajaComentarios.addClass("oculto");				
			}
		}
	}
	xhr.open('POST', 'src/helpers/cargadorComentarios.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send('idPost='+idPost);				
}

//REGISTRO

var regNombre = false;
var regEmail = false;
var regEmailR = false;
var regPass = false;
var regPassR = false;

function comprobarRegNombre(self){
    $expr = /^[A-Za-zñÑ0-9_.]*$/;
    if(!$expr.test($(self).val())){
        mostrarImagen("#regNombre", false, "No puedes usar ni espacios ni caracteres especiales");
        regNombre = false;
    }
    else if($(self).val().length < 6){
        mostrarImagen("#regNombre", false, "El nombre tiene que tener más de 6 caracteres");
        regNombre = false;
    }
    else if($(self).val().length > 20){
        mostrarImagen("#regNombre", false, "El nombre tiene que tener menos de 20 caracteres");
        regNombre = false;
    }
    else {
        $.post("comprobarUsuarioExiste.php", {
            usuario : $(self).val()
        }, function(data){
            if(data.correcto){
                mostrarImagen("#regNombre", true);
                regNombre = true;
            }
            else{
                mostrarImagen("#regNombre", false, data.msn);
                regNombre = false;
            }
        }, "json");
    }
}

function comprobarRegEmail(self){
    $expr = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if(!$expr.test($(self).val())){
        mostrarImagen("#regEmail", false, "El formato de email introducido es incorrecto");
        regEmail = false;
    }
    else {
        $.post("comprobarEmailExiste.php", {
            email : $(self).val()
        }, function(data){
            if(data.correcto){
                mostrarImagen("#regEmail", true);
                regEmail = true;
            }
            else{
                mostrarImagen("#regEmail", false, data.msn);
                regEmail = false;
            }
        }, "json");
    }
}

function comprobarRegEmailR(self){
    if($(self).val().length > 3){
        if($("#regEmail input").val() != $(self).val()){
            mostrarImagen("#regEmailR", false, "El email no coincide");
            regEmailR = false;
        }
        else {
            mostrarImagen("#regEmailR", true);
            regEmailR = true;
        }
    }
    else {
        regEmailR = false;
    }
}

function comprobarRegPass(self){
    if($(self).val().length < 6){
        mostrarImagen("#regPass", false, "La contraseña tiene que tener más de 6 caracteres");
        regPass = false;
    }
    else if($(self).val().length > 50){
        mostrarImagen("#regPass", false, "La contraseña tiene que tener menos de 50 caracteres");
        regPass = false;
    }
    else {
        mostrarImagen("#regPass", true);
        regPass = true;
    }
}

function comprobarRegPassR(self){
    if($(self).val().length > 3){
        if($("#regPass input").val() != $(self).val()){
            mostrarImagen("#regPassR", false, "Las contraseñas no coinciden");
            regPassR = false;
        }
        else {
            mostrarImagen("#regPassR", true);
            regPassR = true;
        }
    }
    else {
        regPassR = false;
    }
}

/**
 * Muestra la imagen deseada según paramentros
 * 
 * @param {string} destino tag al cual se añadirá la imagen
 * @param {boolean} correcto muestra la imagen erronea(false) o verdadera(true)
 * @param {string} mensaje en caso de mostrar la imagen erronea que mensaje de información se añadirá
 */
function mostrarImagen(destino, correcto, mensaje){
    if(correcto){
        $(destino+" img").attr("src", "resources/img/Check-icon.png"); 
        $(destino+" span").text("");
    }
    else {
        $(destino+" img").attr("src", "resources/img/Delete-icon.png");
        $(destino+" span").text(mensaje);
    }
}