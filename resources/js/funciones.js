/* --- Parte menu administrador --- */
$(document).ready(function(){
	/*
		Evento click en boton de comentarios. 
	*/
	$('.btnComentarios').on('click', function(e){
		e.preventDefault();
		var idPost = $(this).attr('id');
		if (window.XMLHttpRequest){
			xhr = new XMLHttpRequest();
		}else if (window.ActiveXObject) {
			var xhr= new ActiveXObject("Microsoft.XMLHTTP");
		}
		//Enviamos peticion ajax
		enviarPeticionAJAX(idPost, xhr);
	});

	/*
		Escribir nuevo comentario botonNuevoComentario
	*/
	$('.botonNuevoComentario').on('click', function(e){
		console.log("click en nuevo comentario")
		e.preventDefault();
		var idPost = $(this).attr('id');
			if($('#cajaNuevoComentario'+idPost).attr("class") == "cajaNuevoComentario oculto"){
				$('#cajaNuevoComentario'+idPost).removeClass("oculto");
				$('#cajaNuevoComentario'+idPost).addClass("visible");
			}
			else{
				$('#cajaNuevoComentario'+idPost).removeClass("visible");
				$('#cajaNuevoComentario'+idPost).addClass("oculto");				
			}				
	});

	$('.botonEnviarComentario').on('click', function(e){
		e.preventDefault();
		xhr = new XMLHttpRequest();		
		var idPost = $(this).parent().find("#idPost").val();
		var autorComentario = $(this).parent().find("#autor").val();
		var textoComentario = $(this).parent().find("textarea").val();
		enviarNuevoPost(xhr, idPost, autorComentario, textoComentario);	
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
    $("div.loginError").remove();
    $("div.cajaLogin h3").after("<div class='loginError'>"+msn+"</div>");
    $("div.loginError").css({
        color: "#df4931",
        "background-color": "#f9f9f9",
        width: "100%",
        padding: "5px 10px",
        margin: "5px 0 10px 0",
        "font-weight": "bold",
        border: "1px solid #363636",
        display: "none"
    });
    $("div.loginError").fadeIn(500).delay(2500).fadeOut(1000, function(){
        $("div.loginError").remove();
    });
}

function enviarNuevoPost(xhr, idPost, autorComentario, textoComentario){
	$.post("nuevoComentario.php", { idPost: idPost, autor: autorComentario , textoComentario : textoComentario} )
	.done(function(data){
		console.log(data)
	})
}

function enviarPeticionAJAX(idPost, xhr) {
	var idPost = idPost;
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {

			if($('#caja'+idPost).attr("class") == "cajaComentarios oculto"){
				$('#caja'+idPost).removeClass("oculto");
				$('#caja'+idPost).addClass("visible");				
				$('#caja'+idPost).html(xhr.responseText);	
			}
			else{
				$('#caja'+idPost).removeClass("visible");
				$('#caja'+idPost).addClass("oculto");				
			}
			
		}
	}
	xhr.open('POST', 'src/helpers/cargadorComentarios.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send('idPost='+idPost);				
}