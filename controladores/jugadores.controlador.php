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
					
					// CREAR ID ÚNICO PARA CADA JUGADOR: CONCATENER NOMBRE + NÚMERO Y QUITAR ESPACIOS EN BLANCO PARA PASARLO COMO RUTA

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
	EDITAR JUGADOR
	=============================================*/

	static public function ctrEditarJugador(){

		if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST["editarNumero"])) {

				/*=============================================
				VALIDAR FOTO DEL JUGADOR
				=============================================*/

				$ruta = $_POST['fotoActual'];

				if (isset($_FILES['editarFoto']['tmp_name']) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES['editarFoto']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAR DIRECTORIO PARA GUARDAR LA IMAGEN
					=============================================*/
					//* CREAR ID ÚNICO PARA CADA JUGADOR: CONCATENER NOMBRE + NÚMERO Y QUITAR ESPACIOS EN BLANCO PARA PASARLO COMO RUTA DEL DIRECTORIO

					$editarAlias = $_POST['editarNombre'].$_POST["editarNumero"];
					$editarAlias = str_replace(" ", "", $editarAlias);

					$directorio = "vistas/img/plantillaJugadores/".$editarAlias;

					/*=============================================
					PREGUNTAMOS SI EXISTE OTRA FOTO EN LA BD Y LA ELIMINAMOS O CREAMOS UN NUEVO DIRECTORIO
					=============================================*/

					if(!empty($_POST['fotoActual'])){

						unlink($_POST['fotoActual']);

					} else {

						mkdir($directorio, 0755);

					}

					/*=============================================
					VALIDAR TIPO DE IMAGEN (JPEG O PNG) APLICANDO FUNCIONES DE PHP
					=============================================*/	

					if ($_FILES['editarFoto']['type'] == 'image/jpeg') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/plantillaJugadores/".$editarAlias."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES['editarFoto']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if ($_FILES['editarFoto']['type'] == 'image/png') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/plantillaJugadores/".$editarAlias."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES['editarFoto']['tmp_name']);

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
					"id" => $_POST['idJugador'],
					"nombre" => $_POST["editarNombre"],
					"apellido" => $_POST["editarApellido"],
					"numero" => $_POST["editarNumero"],
					"posicion" => $_POST["editarPosicion"],
					"foto" => $ruta
				);
				
				// var_dump($datos);

			   	$respuesta = ModeloPlantillaJugadores::mdlEditarJugador($tabla, $datos);

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
	ELIMINAR JUGADOR
	=============================================*/

	static public function ctrEliminarJugador(){

		if(isset($_GET['idJugador'])){
 
			if($_GET["idJugador"]){

				$tabla = 'plantilla';
				$datos = $_GET['idJugador'];

				var_dump($datos);

				if ($_GET['foto'] != "") {

					// ELIMINA LA FOTO ACTUAL					
					unlink($_GET['foto']);

					// ELIMINA LA CARPETA
					rmdir('vistas/img/plantillaJugadores/'.$_GET["aliasFoto"]);

				}

				$respuesta = ModeloPlantillaJugadores::mdlEliminarJugador($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡El jugador ha sido eliminado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "jugadores";

						}

					})

					</script>';

				}

			}

		}

	}

}



