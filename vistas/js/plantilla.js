/*=============================================
=            Sidebar menu           =
=============================================*/

$('.sidebar-menu').tree();


/*=============================================
=            Data Table           =
=============================================*/

$(".tablas").DataTable({

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
iCHECK FOR CHECKBOX & RADIO-BUTTONS
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({

  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
  
});


/*=============================================
DATE-MASK
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
//Money Euro
$('[data-mask]').inputmask();


/*=============================================
DATE-MASK
=============================================*/

$('.select2-single').select2();


/*=============================================
BOOTSTRAP DATEPICKER
=============================================*/

// No sé cómo ponerla el display en español, ni cómo cambiar el resaltado del día

$('#nuevaFecha').datepicker({
	format: 'dd-mm-yyyy',
	todayHighlight: true,
	autoclose: true,
});

$('#editarFecha').datepicker({
	format: 'dd-mm-yyyy',
	todayHighlight: true,
	autoclose: true,
});

/*=============================================
BOOTSTRAP TIMEPICKER
=============================================*/

$('#nuevaHora').timepicker({
	timeFormat: 'HH:mm',
	minuteStep: 1,
	template: 'modal',
	appendWidgetTo: 'body',
	showSeconds: true,
	showMeridian: false,
	defaultTime: false
});

$('#editarHora').timepicker({
	timeFormat: 'HH:mm',
	minuteStep: 1,
	template: 'modal',
	appendWidgetTo: 'body',
	showSeconds: true,
	showMeridian: false,
	defaultTime: false
});


