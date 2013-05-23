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
    $("div.cajaLogin h3").after("<div class='alert alert-msn'>"+info+"</div>");
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