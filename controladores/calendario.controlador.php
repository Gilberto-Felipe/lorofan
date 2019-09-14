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

	/*=============================================
	EDITAR JORNADA
	=============================================*/

	static public function ctrEditarJornada(){

		if (isset($_POST["editarJornada"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST['editarJornada'])){
				
				$tabla = 'calendario';

				// FORMATEAR FECHA Y HORA PARA ENVIAR DATOS A BD
				$fechaDatePicker = $_POST['editarFecha'];
				$horaTimepicker = $_POST['editarHora'];
				$fechaFormateada = date("Y-m-d H:i:s", strtotime($fechaDatePicker.$horaTimepicker));
				
				$datos = array(
					'id' => $_POST['idJornada'],
					'jornada' => $_POST['editarJornada'],
					'fecha' => $fechaFormateada,
					'lugar' => $_POST['editarEstadio'],
					'equipo1' => $_POST['editarAlias1'],
					'equipo2' => $_POST['editarAlias2']
				);

				$respuesta = ModeloCalendario::mdlEditarJornada($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

							swal({

								type: "success",
								title: "¡La jornada ha sido editada correctamente!",
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
							title: "¡La jornada no debe ir vacía o llevar caracteres especiales!",
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

	}

	/*=============================================
	ELIMINAR JORNADA             
	=============================================*/

	public function ctrEliminarJornada(){

		if(isset($_GET['idJornada'])){
 
			if($_GET["idJornada"]){

				//var_dump($_GET["idJornada"]);

				$tabla = 'calendario';
				$datos = $_GET['idJornada'];

				$respuesta = ModeloCalendario::mdlEliminarCalendario($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡La jornada ha sido eliminado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "calendario";

						}

					})

					</script>';

				}

			}

		}

	}

				
}
