/* SECCION: Elegir BD */

function IniciarElegirBD(){
	var campoHostVacio = true;
	var campoUserVacio = true;

	var textoTooltip = 'Si se deja vacio se creará con el nombre openblog';
	$('#labelNombreBD').tooltip({
		title : textoTooltip
	});

	
	cargarListeners();

	function cargarListeners(){
		$('#campoHost').keyup(function(){
			if($(this).val() !== ""){
				campoHostVacio = false;
			}else{
				campoHostVacio = true;
			}			
		});

		$('#campoUser').keyup(function(){
			if($(this).val() !== ""){
				campoUserVacio = false;
			}else{
				campoUserVacio = true;
			}		
		});

		$('.botonValidar').click(function(){
			if(!campoUserVacio && !campoHostVacio){
				$(this).hide();
				$('.spinner').show();
				iniciarComprobacionBD();
			}else{
				mostrarAlertaError('Ha de completar los campos de Host y Usuario', 3000);	
			}
		})
	}

	function comprobarCamposVacios(campo, vacio){
		if($(campo).val() !== ""){
			console.log(vacio);
			vacio = false;
		}else{
			vacio = true;
		}
	}

	function iniciarComprobacionBD(){
		var user = $('#campoUser').val();
		var pass = $('#campoPass').val();
		var host = $('#campoHost').val();

		var datos = {
			user : user,
			pass : pass,
			host : host
		};

		$.post('src/comprobacionBaseDatos.php', datos, function(data){
			console.log(data);
			var respuesta = JSON.parse(data);
			if(respuesta.codigo == 2){
				mostrarAlertaExito('Se ha conectado exitosamente a la Base de Datos', 3000);
				$('.spinner').toggle();
				$('.botonValidar').toggle();
			}else{
				var tipoError = respuesta.mensaje;
				mostrarAlertaError('No se ha podido establecer una conexión con el servidor, <b>'+tipoError+'</b>', 3000);
				$('.spinner').toggle();
				$('.botonValidar').toggle();
			}
		});
	}

}


function mostrarAlertaError(texto, tiempo){
	var alerta = "<div class='alert alert-error'>"+texto+"</div>";
	$('.cajaAlertas').html(alerta).slideDown();
	setTimeout(function(){
		$('.alert').slideUp().html(" ");
	}, tiempo)
}

function mostrarAlertaExito(texto, tiempo){
	var alerta = "<div class='alert alert-success'>"+texto+"</div>";
	$('.cajaAlertas').html(alerta).slideDown();
	setTimeout(function(){
		$('.alert').slideUp().html(" ");
	}, tiempo)
}

