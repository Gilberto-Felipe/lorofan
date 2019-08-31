<?php 

class ControladorEquipos {

	/*=============================================
	MOSTRAR USUARIOS              
	=============================================*/

	static public function ctrMostrarEquipos($item, $valor){

		$tabla = 'equipos';

		$respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR DE EQUIPOS
	=============================================*/

	static public function ctrRegistrarEquipo(){

		if (isset($_POST['nuevoAlias'])) {

			echo $_POST['nuevoAlias'];
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ]+$/', $_POST['nuevoAlias']) && 
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST['nuevoEquipo']) && 
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST['nuevoEstadio'])){

				/*=============================================
				VALIDAR ESCUDO
				=============================================*/

				$ruta = "";			

				if (isset($_FILES['nuevoEscudo']['tmp_name'])) {

					/*=============================================
					OBTENER EL TAMAÑO DEL ESCUDO Y FORMATEARLO
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES['nuevoEscudo']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAR DIRECTORIO PARA GUARDAR EL ESCUDO
					=============================================*/	

					$directorio = "vistas/img/equipos/".$_POST['nuevoAlias'];

					// OTORGAR PERMISOS DE ADMINISTRADOR 
					mkdir($directorio, 0755);

					/*=============================================
					VALIDAR TIPO DE IMAGEN APLICANDO FUNCIONES DE PHP
					=============================================*/	

					if ($_FILES['nuevoEscudo']['type'] == 'image/jpeg') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						// $aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/equipos/".$_POST['nuevoAlias'].".jpg";

						$origen = imagecreatefromjpeg($_FILES['nuevoEscudo']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if ($_FILES['nuevoEscudo']['type'] == 'image/png') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						// $aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/equipos/".$_POST['nuevoAlias'].".png";

						$origen = imagecreatefrompng($_FILES['nuevoEscudo']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				/*=============================================
				ENVIAR DATOS AL MODELO
				=============================================*/

				$tabla = "equipos";	

				$datos = array(
					"alias" => $_POST['nuevoAlias'],
					"nombre" => $_POST['nuevoEquipo'],
					"escudo" => $ruta,
					"estadio" => $_POST['nuevoEstadio']
				);

				var_dump($datos);

				//! $respuesta = ModeloEquipos::mdlRegistrarEquipo($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario se ha guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "usuarios";

						}

					});

					</script>';

				}
				
			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "usuarios";

						}

					});

					</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR USUARIOS              
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = 'usuarios';

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR USUARIOS              
	=============================================*/

	static public function ctrEditarUsuario(){

		if (isset($_POST["editarUsuario"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST['editarNombre'])){

				/*=============================================
				VALIDAR IMAGEN USUARIO
				=============================================*/

				$ruta = $_POST['fotoActual'];

				if (isset($_FILES['editarFoto']['tmp_name']) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES['editarFoto']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAR DIRECTORIO PARA GUARDAR LA FOTO
					=============================================*/	

					$directorio = "vistas/img/usuarios/".$_POST['editarUsuario'];

					/*=============================================
					PREGUNTAMOS SI EXISTE OTRA FOTO EN LA BD
					=============================================*/

					if(!empty($_POST['fotoActual'])){

						unlink($_POST['fotoActual']);

					}else {

						mkdir($directorio, 0755);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN VALIDAR TIPO DE IMAGEN APLICANDO FUNCIONES DE PHP
					=============================================*/	

					if ($_FILES['editarFoto']['type'] == 'image/jpeg') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/".$_POST['editarUsuario']."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/usuarios/".$_POST['editarUsuario']."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES['editarFoto']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}	

				$tabla = 'usuarios';

				if ($_POST["editarPassword"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarPassword'])) {
						
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');

					}else {

						echo '<script>

							swal({

								type: "error",
								title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false						
						
							}).then((result)=>{

								if(result.value){

									window.location = "usuarios";

								}

							});

							</script>';

					}

				}else {

					$encriptar = $_POST['passwordActual'];

				}

				$datos = array(
					"nombre" => $_POST['editarNombre'],
					"usuario" => $_POST['editarUsuario'],
					"password" => $encriptar,
					"perfil" => $_POST['editarPerfil'],
					"foto" => $ruta
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "usuarios";

						}

					});

					</script>';

				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El nombre no debe ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "usuarios";

						}

					});

					</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR USUARIO             
	=============================================*/

	public function ctrBorrarUsuario(){

		if(isset($_GET['idUsuario'])){

			if($_GET["idUsuario"] != $_SESSION["id"]){

				$tabla = 'usuarios';
				$datos = $_GET['idUsuario'];

				if ($_GET['fotoUsuario'] != "") {
					
					unlink($_GET['fotoUsuario']);
					rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

				}

				$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido eliminado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "usuarios";

						}

					})

					</script>';

				}

			}

		}

	}

}