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

});

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