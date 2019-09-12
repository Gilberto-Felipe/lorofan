<?php 

class ControladorCalendario {

	/*=============================================
	MOSTRAR JORNADAS
	=============================================*/

	static public function ctrMostrarCalendario($item, $valor){

		$tabla = 'calendario';

		$respuesta = ModeloCalendario::mdlMostrarCalendario($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	CREAR JORNADA
	=============================================*/

	static public function ctrCrearJornada(){

		if (isset($_POST['nuevaJornada'])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST['nuevaJornada'])) {

				$tabla = 'calendario';

				// FORMATEAR FECHA Y HORA PARA ENVIAR A BD

				$fechaDatePicker = $_POST['nuevaFecha'];
				$horaTimepicker = $_POST['nuevaHora'];
				$fechaFormateada = date("Y-m-d H:i:s", strtotime($fechaDatePicker.$horaTimepicker));
				
				$datos = array(
					'jornada' => $_POST['nuevaJornada'],
					'fecha' => $fechaFormateada,
					'lugar' => $_POST['nuevoEstadio'],
					'equipo1' => $_POST['nuevoAlias1'],
					'equipo2' => $_POST['nuevoAlias2']
				);

				//var_dump($datos);

				$respuesta = ModeloCalendario::mdlCrearJornada($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡La jornada se ha guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "calendario";

						}

					});

					</script>';

				}

			} 
			else{

				echo '<script>

					swal({

						type: "error",
						title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "categorias";

						}

					});

					</script>';

			}

		}
			
	}
				
}
