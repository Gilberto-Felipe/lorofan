/*=============================================
SUBIR ESCUDO DEL EQUIPO AL MODAL AGREGAR EQUIPO Y AL MODAL EDITAR EQUIPO
=============================================*/

$(".nuevaFoto").change(function(){

	let imagen = this.files[0];
	console.log("imagen", imagen);

	/*=============================================
	=          VALIDAR FORMATO PNG O JPG           =
	=============================================*/

	if (imagen["type"] != "image/jpeg"  && imagen["type"] != "image/png") {

		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato .jpg o .png!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else if (imagen["size"] > 2000000 ) {

		$(".nuevaFoto").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe pesar menos de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else {

		let datosImagen = new FileReader();
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event) {

			let rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		});

	}

});


/*=============================================
LLENAR CAMPOS DEL MODAL EDITAR JUGADOR
=============================================*/

$(".tablas").on("click", ".btnEditarJugador", function(){

	let idJugador = $(this).attr("idJugador");
    // console.log("TCL: idJugador", idJugador)
	
	let datos = new FormData();
	datos.append('idJugador', idJugador);

	$.ajax({
		url: 'ajax/jugadores.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){
        // console.log("TCL: respuesta", respuesta)
			
			$('#idJugador').val(respuesta['id']);
			$('#editarNombre').val(respuesta['nombre']);
			$('#editarApellido').val(respuesta['apellido']);
			$('#editarNumero').val(respuesta['numero']);
			$('#editarPosicion').val(respuesta['posicion']);
			$('#fotoActual').val(respuesta['foto']);


			if (respuesta['foto'] != "") {

				$(".previsualizar").attr("src", respuesta['foto']);

			} else {

				$(".previsualizar").attr("src", "vistas/img/plantillaJugadores/default/anonymous.png");				
			}

		}

	});

});

/*=============================================
ELIMINAR JUGADORES
=============================================*/

$(".tablas").on("click", ".btnEliminarJugador", function(){

	let idJugador = $(this).attr("idJugador");
	let jugador = $(this).attr("jugador");
	let numero = $(this).attr("numero");
	let foto = $(this).attr("foto");

	// CONCATENAR jugador + numero QUE SON EL ALIAS DE LA CARPETA DE LA FOTO DEL JUGADOR
	let aliasFoto = jugador+numero;
	aliasFoto.replace(/ /g, "");
    console.log("TCL: aliasFoto", aliasFoto);	

	swal({

		title: "¿Estás seguro de eliminar al jugador?",
		text: "Puedes cancelar la acción",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sí, eliminar'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=jugadores&idJugador="+idJugador+"&aliasFoto="+aliasFoto+"&foto="+foto;

		}

	});

});

/*=============================================
MOSTRAR FOTO POR DEFECTO AL AGREGAR NUEVO USUARIO 
=============================================*/

/* Problema: 
El problema cuando editas un usuario en su modal y no guardas cambios; y luego abres el modal agregar nuevo usuario, entonces aparece la foto del usuario que ibas modificar y del que no guardaste los cambios; no la foto por defecto.
Solución: 
*/

$(document).on("click", "#btnAgregarJugador", function(){

    $(".previsualizar").attr("src", "vistas/img/plantillaJugadores/default/anonymous.png");
    
});




