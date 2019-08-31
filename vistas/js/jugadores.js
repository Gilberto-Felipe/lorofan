/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/
/*COMPRUEBA CONEXIÓN CON datatable-clientes.ajax.php
$.ajax({
	url: 'ajax/datatable-clientes.ajax.php',
	success: function (respuesta){
		console.log(respuesta);		
	}
});*/


/*=============================================
CONFIGURANDO DATATABLE
=============================================*/
$('.tablaClientes').DataTable( {

    "ajax": "ajax/datatable-clientes.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
		
	}
    
});

/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablaClientes tbody").on("click", ".btnEditarCliente", function(){

	let idCliente = $(this).attr("idCliente");

	let datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
        $("#idCliente").val(respuesta["id"]);
        $("#editarCliente").val(respuesta["nombre"]);
        $("#editarDocumentoId").val(respuesta["documento"]);
        $("#editarEmail").val(respuesta["email"]);
        $("#editarTelefono").val(respuesta["telefono"]);
        $("#editarDireccion").val(respuesta["direccion"]);
        $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);

	  }

  	});

});


/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablaClientes").on("click", ".btnEditarCliente", function(){

	let idCliente = $(this).attr("idCliente");

	let datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
        $("#idCliente").val(respuesta["id"]);
        $("#editarCliente").val(respuesta["nombre"]);
        $("#editarDocumentoId").val(respuesta["documento"]);
        $("#editarEmail").val(respuesta["email"]);
        $("#editarTelefono").val(respuesta["telefono"]);
        $("#editarDireccion").val(respuesta["direccion"]);
        $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
	  }

  	})

})

/*=============================================
EVITAR AGREGAR CLIENTES REPETIDOS
=============================================*/

$("#nuevoDocumentoId").change(function() {

	$(".alert").remove();
	
	let documento = $(this).val();

	let datos = new FormData();
	datos.append('validarCliente', documento);

		$.ajax({
		url: 'ajax/clientes.ajax.php',
		method: 'POST',
		data: datos,
		cache: false, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(respuesta){

			if (respuesta) {

				$("#nuevoDocumentoId").parent().after('<div class="alert alert-warning">Este documento ya existe en la base de datos.</div>');

				$("#nuevoDocumentoId").val("");

			}

		}

	});

});

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablaClientes").on("click", ".btnEliminarCliente", function(){

	let idCliente = $(this).attr("idCliente");
	
	swal({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;

        }

  });

});