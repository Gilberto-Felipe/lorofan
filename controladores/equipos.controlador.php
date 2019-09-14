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
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST['nuevoAlias']) && 
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

					// Quitar espacios en blanco al alias

					$alias = $_POST['nuevoAlias'];
					$alias = str_replace(" ", "", $alias);

					$directorio = "vistas/img/equipos/".$alias;

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

						$ruta = "vistas/img/equipos/".$alias."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/equipos/".$alias."/".$aleatorio.".png";

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
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚüÜ ]+$/', $_POST['editarAlias'])){

				/*=============================================
				VALIDAR ESCUDO EQUIPO
				=============================================*/

				$ruta = $_POST['escudoActual'];

				if (isset($_FILES['editarEscudo']['tmp_name']) && !empty($_FILES["editarEscudo"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES['editarEscudo']['tmp_name']);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAR DIRECTORIO PARA GUARDAR EL ESCUDO
					=============================================*/

					$editarAlias = $_POST['editarAlias'];
					$editarAlias = str_replace(" ", "", $editarAlias);

					$directorio = "vistas/img/equipos/".$editarAlias;

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

						$ruta = "vistas/img/equipos/".$editarAlias."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/equipos/".$editarAlias."/".$aleatorio.".png";

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

			}
			else{

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
	ELIMINAR EQUIPO             
	=============================================*/

	public function ctrBorrarEquipo(){

		if(isset($_GET['idEquipo'])){
 
			if($_GET["idEquipo"]){

				$tabla = 'equipos';
				$datos = $_GET['idEquipo'];

				if ($_GET['imagenEscudo'] != "") {
					
					unlink($_GET['imagenEscudo']);
					rmdir('vistas/img/equipos/'.$_GET["equipo"]);

				}

				$respuesta = ModeloEquipos::mdlBorrarEquipo($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type: "success",
						title: "¡El equipo ha sido eliminado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false						
				
					}).then((result)=>{

						if(result.value){

							window.location = "equipos";

						}

					})

					</script>';

				}

			}

		}

	}

}