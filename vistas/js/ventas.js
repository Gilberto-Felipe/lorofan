/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/
/*$.ajax({

	url: "ajax/datatable-ventas.ajax.php",
	success: function (respuesta){

		console.log("respuesta", respuesta);

	}

});
*/
/*=============================================
CONFIGURANDO DATATABLE
=============================================*/
$('.tablaVentas').DataTable( {

    "ajax": "ajax/datatable-ventas.ajax.php",
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
    
} );

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentas tbody").on('click', 'button.agregarProducto', function() {
	
	let idProducto = $(this).attr("idProducto");
	//console.log("idProducto", idProducto);

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	let datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({

		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			let descripcion = respuesta["descripcion"];
          	let stock = respuesta["stock"];
          	let precio = respuesta["precio_venta"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    return;

          	}

          	/*=============================================
          	CAPTURANDO idProducto PARA AÑADIR Y QUITAR PRODUCTOS
          	=============================================*/
          	$(".nuevoProducto").append(

          		'<div class="row" style="padding:5px 15px">'+

	          		'<!-- Descripción del producto -->'+
	                 
	                '<div class="col-xs-6" style="padding-right: 0px">'+
	                  
	                  '<div class="input-group">'+
	                    
	                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	                    '<input type="text" class="form-control nuevaDescripcionProducto" name="agregarProducto" id="agregarProducto" value="'+descripcion+'" readonly required>'+

	                  '</div>'+

	                '</div>'+

	                '<!-- Cantidad del producto -->'+

	                '<div class="col-xs-3">'+
	                  
	                  '<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" required>'+

	                '</div>'+

	                '<!-- Precio del producto -->'+

	                '<div class="col-xs-3" style="padding-left: 0px">'+

	                 '<div class="input-group">'+

	                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                    
	                    '<input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+

	                 '</div>'+

	                '</div>'+

	            '</div>'

          	);

		}

	});

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		let listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(let i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}

	}

});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN AGREGAR PRODUCTO
=============================================*/

let idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on('click', 'button.quitarProducto', function() {

	$(this).parent().parent().parent().parent().remove();

	let idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto;
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass("btn-default");

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');


});
