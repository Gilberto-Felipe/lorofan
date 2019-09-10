<?php 

class ControladorCalendario {

	/*=============================================
	MOSTRAR jORNADAS
	=============================================*/

	static public function ctrMostrarJornadas($item, $valor){

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
				
				$datos = array(
					'jornada' => $_POST['nuevaJornada'],
					'fecha' => $_POST['nuevaFecha'],
					'lugar' => $_POST['nuevoEstadio'],
					'equipo1' => $_POST['nuevoEstadio'],
					'equipo2' => $_POST['nuevoEstadio']
				);

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

							window.location = "categorias";

						}

					});

					</script>';

				}


			} else{

				echo '<script>

					swal({

						type: "error",
						title: "¡La jornada no puede ir vacía o llevar caracteres especiales!",
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
	EDITAR CATEGORÍA
	=============================================*/

	static public function ctrEditarCategoria(){

		if (isset($_POST['editarCategoria'])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST['editarCategoria'])) {

				$tabla = 'categorias';
				$datos = array("categoria" => $_POST['editarCategoria'],
								"id" => $_POST['idCategoria']);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡La categoría se modificó correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"					
				
					}).then((result)=>{

						if(result.value){

							window.location = "categorias";

						}

					});

					</script>';

				}


			} else{

				echo '<script>

					swal({

						type: "error",
						title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"		
				
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
	ELIMINAR CATEGORÍA
	=============================================*/

	static public function ctrBorrarCategoria(){

		if (isset($_GET['idCategoria'])) {
			
			$tabla = "categorias";
			$datos = $_GET['idCategoria'];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);


				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡La categoría ha sido eliminada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "categorias";

						}

					})

					</script>';

				}


		}

	}

}