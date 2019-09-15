<?php

class ControladorPlantillaJugadores{

	/*=============================================
	REGISTRAR JUGADOR EN LA PLANTILLA
	=============================================*/

	static public function ctrRegistrarJugador(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevoApellido"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevoNumero"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["nuevaPosicion"])) {

				/*=============================================
				VALIDAR FOTO DEL JUGADOR
				=============================================*/

				$ruta = "";			

				if (isset($_FILES['nuevaFoto']['tmp_name'])) {

					/*=============================================
					OBTENER EL TAMAÑO DE LA IMAGEN Y FORMATEARLA
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAR DIRECTORIO PARA GUARDAR LA IMAGEN
					=============================================*/
					
					// CREAR ID ÚNICO PARA CADA JUGADOR: CONCATENER NOMBRE + NÚMERO
					// Y QUITAR ESPACIOS EN BLANCO PARA PASARLO COMO RUTA

					$foto = $_POST['nuevoNombre'].$_POST["nuevoNumero"];
					$foto = str_replace(" ", "", $foto);

					$directorio = "vistas/img/plantillaJugadores/".$foto;

					// OTORGAR PERMISOS DE ADMINISTRADOR 
					mkdir($directorio, 0755);

					/*=============================================
					VALIDAR TIPO DE IMAGEN APLICANDO FUNCIONES DE PHP
					=============================================*/	

					if ($_FILES['nuevaFoto']['type'] == 'image/jpeg') {
						
						/*=============================================
						GUARDAR IMAGEN EN DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/plantillaJugadores/".$foto."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if ($_FILES['nuevaFoto']['type'] == 'image/png') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/plantillaJugadores/".$foto."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				/*=============================================
				ENVIAR DATOS AL MODELO
				=============================================*/

			   	$tabla = "plantilla";

			   	$datos = array(
					"nombre" => $_POST["nuevoNombre"],
					"apellido" => $_POST["nuevoApellido"],
					"numero" => $_POST["nuevoNumero"],
					"posicion" => $_POST["nuevaPosicion"],
					"foto" => $ruta
				);
				
				// var_dump($datos);

			   	$respuesta = ModeloPlantillaJugadores::mdlRegistrarJugador($tabla, $datos);

			   if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El jugador se registró correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){

								if (result.value) {

									window.location = "jugadores";

								}

							})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "jugadores";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR PLANTILLA 
	=============================================*/

	static public function ctrMostrarPlantilla($item, $valor){

		$tabla = "plantilla";

		$respuesta = ModeloPlantillaJugadores::mdlMostrarPlantilla($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "nombre"=>$_POST["editarCliente"],
					           "documento"=>$_POST["editarDocumentoId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
					           "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						
						  type: "success",
						  title: "El cliente se cambió correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){

							if (result.value) {

								window.location = "clientes";

							}
						})

					</script>';

				}

			} else{

				echo'<script>

					swal({

						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){

							if (result.value) {

								window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente fue borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		

		}

	}

}



