$('.btn.admin').on('click',function(e){
	e.preventDefault();
	var indice = $(this).data('admin');
	/*Obtengo el id del boton, para saber cual se pulsa*/
	//console.log('Click en: '+indice);
	/*Segun el boton pulsado cargamos una opcion u otra.*/
	$cajaLoader = $('.cajaLoader'); // 'cacheamos' cajaLoader para que no tenga que estar buscandolo cada vez
	switch(indice){
		case "nEntrada": // Nuevo post
		$cajaLoader.load('panelAdmin/nuevaEntrada.php');
		break;
		case "aEntradas": // Administrar entradas
		$cajaLoader.load('panelAdmin/administrarEntradas.php');
		break;
		case "aUsuarios": // Administrar usuarios
		$cajaLoader.load('panelAdmin/administrarUsuarios.php');
		break;
		case "aCategorias": // Administrar categorías
		$cajaLoader.load('panelAdmin/administrarCategorias.php');
		break;
		case "personalizar": // Personalizar
		$cajaLoader.load('panelAdmin/personalizar.php');
		break;
		case "aCuenta": // Administrar cuenta (mi cuenta)
		$cajaLoader.load('panelAdmin/administrarCuenta.php');
		break;
		default: // Defecto, e Index.
		$cajaLoader.load('panelAdmin/indexAdministrador.php');
	}
});
