/*=============================================
=          SUBIR ESCUDO DEL EQUIPO            =
=============================================*/

$(".nuevoEscudo").change(function(){

	let imagen = this.files[0];
	console.log("imagen", imagen);

	/*=============================================
	=          VALIDAR FORMATO PNG O JPG           =
	=============================================*/

	if (imagen["type"] != "image/jpeg"  && imagen["type"] != "image/png") {

		$(".nuevoEscudo").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato .jpg o .png!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else if (imagen["size"] > 2000000 ) {

		$(".nuevoEscudo").val("");

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
EDITAR EQUIPO
=============================================*/

$(".tablas").on("click", ".btnEditarEquipo", function(){

	let idEquipo = $(this).attr("idEquipo");
	//console.log("idEquipo", idEquipo);

	let datos = new FormData();
	datos.append('idEquipo', idEquipo);

	$.ajax({
		url: 'ajax/equipos.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			$('#idEquipo').val(respuesta['id']);
			$('#editarAlias').val(respuesta['alias']);
			$('#editarEquipo').val(respuesta['nombre']);
			$('#escudoActual').val(respuesta['escudo']);

			if (respuesta['escudo'] != "") {

				$(".previsualizar").attr("src", respuesta['escudo']);

			} else {

				$(".previsualizar").attr("src", "vistas/img/equipos/default/anonymous.png");				

			}

			$('#editarEstadio').val(respuesta['estadio']);

		}

	});

});

/*=============================================
EVITAR ALIAS REPETIDOS
=============================================*/

$("#nuevoAlias").change(function() {

	$(".alert").remove();
	
	let alias = $(this).val();

	let datos = new FormData();
	datos.append('validarAlias', alias);

		$.ajax({
		url: 'ajax/equipos.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			if (respuesta) {

				$("#nuevoAlias").parent().after('<div class="alert alert-warning">Este alias ya existe en la base de datos.</div>');

				$("#nuevoAlias").val("");

			}

		}

	});

});

/*=============================================
ELIMINAR USUARIO
=============================================*/

$(".tablas").on("click", ".btnEliminarEquipo", function(){

	let idEquipo = $(this).attr("idEquipo");
	let imagenEscudo = $(this).attr("imagenEscudo");
	let equipo = $(this).attr("equipo");

	swal({

		title: "¿Estás seguro de eliminar el equipo?",
		text: "Puedes cancelar la acción",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sí, eliminar'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=equipos&idEquipo="+idEquipo+"&equipo="+equipo+"&imagenEscudo="+imagenEscudo;

		}

	});

});

/*=============================================
MOSTRAR FOTO POR DEFECTO AL AGREGAR NUEVO USUARIO 
-- problema: ocurre cuando editas un usuario (en su modal) y no guardas cambios. 
Luego abres el modal agregar nuevo usuario, entonces aparece la foto del usuario que ibas modificar, no la foto por defecto.
=============================================*/

$(document).on("click", "#btnAgregarEquipo", function(){

    $(".previsualizar").attr("src", "vistas/img/equipos/default/anonymous.png");
    
});

