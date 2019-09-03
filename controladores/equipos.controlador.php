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

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/equipos/".$_POST['nuevoAlias']."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES['nuevoEscudo']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if ($_FILES['nuevoEscudo']['type'] == 'image/png') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/equipos/".$_POST['nuevoAlias']."/".$aleatorio.".png";

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

				// var_dump($datos);

				$respuesta = ModeloEquipos::mdlRegistrarEquipo($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡El alias se ha guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "equipos";

						}

					});

					</script>';

				}
				
			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El alias no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "equipos";

						}

					});

					</script>';

			}

		}

	}

	/*=============================================
	EDITAR EQUIPO              
	=============================================*/

	static public function ctrEditarEquipo(){

		if (isset($_POST["editarAlias"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ]+$/', $_POST['editarAlias'])){

				/*=============================================
				VALIDAR ESCUDO EQUIPO
				=============================================*/

				$ruta = $_POST['escudoActual'];

				if (isset($_FILES['editarEscudo']['tmp_name']) && !empty($_FILES["editarEscudo"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES['editarEscudo']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAR DIRECTORIO PARA GUARDAR LA FOTO
					=============================================*/	

					$directorio = "vistas/img/equipos/".$_POST['editarAlias'];

					/*=============================================
					PREGUNTAMOS SI EXISTE OTRA FOTO EN LA BD
					=============================================*/

					if(!empty($_POST['escudoActual'])){

						unlink($_POST['escudoActual']);

					} else {

						mkdir($directorio, 0755);

					}

					/*=============================================
					VALIDAR TIPO DE IMAGEN (JPEG O PNG) APLICANDO FUNCIONES DE PHP
					=============================================*/	

					if ($_FILES['editarEscudo']['type'] == 'image/jpeg') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/equipos/".$_POST['editarAlias']."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES['editarEscudo']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if ($_FILES['editarEscudo']['type'] == 'image/png') {
						
						/*=============================================
						GUARDAR IMAGEN EN  DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/equipos/".$_POST['editarAlias']."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES['editarEscudo']['tmp_name']);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}	

				$tabla = 'equipos';

				$datos = array(
					"id" => $_POST['idEquipo'],
					"alias" => $_POST['editarAlias'],
					"nombre" => $_POST['editarEquipo'],
					"estadio" => $_POST['editarEstadio'],
					"escudo" => $ruta
				);

				$respuesta = ModeloEquipos::mdleditarEquipo($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡El equipo ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "equipos";

						}

					});

					</script>';

				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El alias no debe ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "equipos";

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