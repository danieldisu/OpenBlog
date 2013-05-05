/* --- Parte menu administrador --- */
$(document).ready(function(){
	$('.btn.admin').on('click',function(e){
		e.preventDefault();
		var indice = $(this).attr('id');
		/*Obtengo el id del boton, para saber cual se pulsa*/
		//console.log('Click en: '+indice);
		/*Segun el boton pulsado cargamos una opcion u otra.*/
		switch(indice){
			case "nEntrada": // Nuevo post
			$('.cajaLoader').load('panelAdmin/nuevaEntrada.php');
			break;
			case "aEntradas": // Administrar entradas
			$('.cajaLoader').load('panelAdmin/administrarEntradas.php');
			break;
			case "aUsuarios": // Administrar usuarios
			$('.cajaLoader').load('panelAdmin/administrarUsuarios.php');
			break;
			case "aCategorias": // Administrar categorías
			$('.cajaLoader').load('panelAdmin/administrarCategorias.php');
			break;
			case "personalizar": // Personalizar
			$('.cajaLoader').load('panelAdmin/personalizar.php');
			break;
			case "aCuenta": // Administrar cuenta (mi cuenta)
			$('.cajaLoader').load('panelAdmin/administrarCuenta.php');
			break;
			default: // Defecto, e Index.
			$('.cajaLoader').load('panelAdmin/indexAdministrador.php');
		}
	});
	/*
		Evento click en boton de comentarios. 
	*/
	$('.btnComentarios').on('click', function(e){
		e.preventDefault();
		var idPost = $(this).attr('id');
		if (window.XMLHttpRequest){
			xhr = new XMLHttpRequest();
		}else if (window.ActiveXObject) {
			xhr= new ActiveXObject("Microsoft.XMLHTTP");
		}
		//Enviamos peticion ajax
		enviarPeticionAJAX(idPost);
	});
});
function enviarPeticionAJAX(idPost) {
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