<?php 

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";


class AjaxEquipos {
		
	/*=============================================
	EDITAR EQUIPO
	=============================================*/

	public $idEquipo;

	public function ajaxEditarEquipo(){

		$item = "id";
		$valor = $this->idEquipo;

		$respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EVITAR EQUIPOS REPETIDOS
	=============================================*/

	public $validarAlias;

	public function ajaxValidarAlias(){

		$item = "alias";
		$valor = $this->validarAlias;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR EQUIPO INICIALIZACIÓN
=============================================*/

if (isset($_POST['idEquipo'])) {
	
	$editar = new AjaxEquipos();
	$editar -> idEquipo = $_POST['idEquipo'];
	$editar -> ajaxEditarEquipo();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/
if (isset($_POST['activarUsuario'])){

	$activarUsuario = new AjaxEquipos();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
EVITAR EQUIPOS REPETIDOS INICIALIZACIÓN
=============================================*/

if (isset($_POST['validarAlias'])){
	//echo '<pre>'; print_r($_POST['validarAlias']); echo '</pre>';

	$validarAlias = new AjaxEquipos();
	$validarAlias -> validarAlias = $_POST["validarAlias"];
	$validarAlias -> ajaxValidarUsuario();

}