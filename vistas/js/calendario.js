/*=============================================
EDITAR JORNADAS
=============================================*/

$(".tablas").on("click", ".btnEditarJornada", function(){

	let idJornada = $(this).attr('idJornada');
	console.log("idJornada ", idJornada);
	 
	let datos = new FormData();
	datos.append('idJornada', idJornada);

	$.ajax({
		url:'ajax/calendario.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			// console.log(respuesta);

			$('#idJornada').val(respuesta['id']);
            $('#editarJornada').val(respuesta['jornada']);

            // SEPARAR Y FORMATEAR FECHA CON MOMENT.JS
            let fechaSola = moment(respuesta["fecha"]).format('DD-MM-YYYY');
            $('#editarFecha').val(fechaSola);

            // SEPARAR Y FORMATEAR HORA CON MOMENT.JS
            let horaSola = moment(respuesta["fecha"]).format('HH:mm');
            $('#editarHora').val(horaSola);
            
            $('#editarEstadio').val(respuesta['lugar']);

            $('#editarAlias1').html(respuesta['equipo1']);
            $('#editarAlias1').val(respuesta['idEquipo1']);

            $('#editarAlias2').html(respuesta['equipo2']);
            $('#editarAlias2').val(respuesta['idEquipo2']);

		}

	});
	
});


/*=============================================
ELIMINAR JORNADA
=============================================*/

$(".tablas").on("click", ".btnEliminarJornada", function(){

	let idJornada = $(this).attr("idJornada");

	swal({

		title: "¿Estás seguro de eliminar la jornada?",
		text: "Puedes cancelar la acción",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sí, eliminar'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=calendario&idJornada="+idJornada;

		}

	});

});


/*=============================================
EVITAR ALIAS REPETIDOS EN EL MODAL AGREGAR JORNADA
=============================================*/

$("#nuevaJornada").change(function() {

	$(".alert").remove();
	
	let jornada = $(this).val();
 	// console.log("jornada ", jornada);

	let datos = new FormData();
	datos.append('validarJornada', jornada);

		$.ajax({
		url: 'ajax/calendario.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

 		// console.log("respuesta ", respuesta);

			if (respuesta) {

				$("#nuevaJornada").parent().after('<div class="alert alert-warning">Esta jornada ya existe en la base de datos.</div>');

				$("#nuevaJornada").val("");

			}

		}

	});

});
