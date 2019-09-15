<?php 

require_once "../controladores/calendario.controlador.php";
require_once "../modelos/calendario.modelo.php";


class AjaxCalendario{

	/*=============================================
	LLENAR EL MODAL EDITAR JORNADAS
	=============================================*/

	public $idJornada;

	public function ajaxEditarJornada(){

		$item = "id";
        $valor = $this->idJornada;

		$respuesta = ControladorCalendario::ctrMostrarCalendario($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EVITAR JORNADAS REPETIDAS EN EL MODAL AGREGAR JORNADA
	=============================================*/

	public $validarJornada;

	public function ajaxValidarJornada(){

		$item = "jornada";
		$valor = $this->validarJornada;

		$respuesta = ControladorCalendario::ctrMostrarCalendario($item, $valor);

		echo json_encode($respuesta);

	}

}


/*=============================================
LLENAR MODAL EDITAR JORNADAS INSTANCIACIÓN
=============================================*/

if (isset($_POST['idJornada'])) {

	$idJornada = new AjaxCalendario();
	$idJornada -> idJornada = $_POST['idJornada'];
	$idJornada -> ajaxEditarJornada();

}

/*=============================================
EVITAR JORNADAS REPETIDAS EN MODAL AGREGAR JORNADAS INSTANCIACIÓN
=============================================*/

if (isset($_POST['validarJornada'])){
	//echo '<pre>'; print_r($_POST['validarJornada']); echo '</pre>';

	$validarJornada = new AjaxCalendario();
	$validarJornada -> validarJornada = $_POST["validarJornada"];
	$validarJornada -> ajaxValidarJornada();

}

