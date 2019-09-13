/*=============================================
EVITAR CATEGORIAS REPETIDAS
=============================================*/

$("#nuevaJornada").change(function() {

	$(".alert").remove();
	
	let jornada = $(this).val();

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

			if (respuesta) {

				$("#editarJornada").parent().after('<div class="alert alert-warning">Esta jornada ya existe en la base de datos.</div>');

				$("#editarJornada").val("");

			}

		}

	});

});

/*=============================================
EDITAR JORNADAS
=============================================*/

$(".tablas").on("click", ".btnEditarJornada", function(){

	let idJornada = $(this).attr('idJornada');

	let datos = new FormData();
	datos.append("idJornada", idJornada);

	$.ajax({
		url: 'ajax/calendario.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			$("#idJornada").val(respuesta["id"]);
			$("#editarJornada").val(respuesta["jornada"]);
			

			//$("#editarFecha").val(fechaSola);
			//$("#editarHora").val(horaSola);
			$("#editarEstadio").val(respuesta["estadio"]);
			$("#editarAlias1").val(respuesta["equipo1"]);
			$("#editarAlias12").val(respuesta["equipo2"]);

			$('#idJornada').val(respuesta["id"]);
			$("#editarJornada").val(respuesta["jornada"]);

			/*	FORMATEAR FECHA BD EN JS	
			
			let fechaBD = moment(respuesta["fecha"]).format('DD-MM-YYYY');

			$("#editarFecha").val(fechaBD);
			//$("#editarHora").val(horaSola);


			$("#editarEstadio").val(respuesta["lugar"]);
			$("#editarAlias1").html(respuesta["equipo1"]);
			$("#editarAlias1").val(respuesta["equipo1"]);
			$("#editarAlias2").html(respuesta["equipo2"]);
			$("#editarAlias2").val(respuesta["equipo2"]);*/

		}

	});

});

/*=============================================
ELIMINAR CATEGORIAS
=============================================*/

$(".tablas").on("click", ".btnEliminarCategoria", function(){

	let idCategoria = $(this).attr("idCategoria");

	swal({

		title: "¿Estás seguro de eliminar la categoría?",
		text: "Puedes cancelar la acción",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sí, eliminar'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

		}

	});

});