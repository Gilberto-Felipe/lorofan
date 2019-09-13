<?php 

require_once "../controladores/calendario.controlador.php";
require_once "../modelos/calendario.modelo.php";


class AjaxCalendario{

	/*=============================================
	EVITAR INSERTAR JORNADAS REPETIDAS
	=============================================*/
	public $validarJornada;
	
	public function ajaxValidarJornada(){

		$item = "jornada";
		$valor = $this->validarCategoria;

		$respuesta = ControladorCalendario::ctrMostrarCalendario($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR JORNADAS
	=============================================*/

	public $idJornada;

	public function ajaxEditarJornada(){

		$item = "id";
		$valor = $this->idJornada;

		$respuesta = ControladorCalendario::ctrMostrarCalendario($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
VALIDAR EVITAR JORNADAS REPETIDAS
=============================================*/

if (isset($_POST['validarCategoria'])){

	$validarJornada = new AjaxCalendario();
	$validarJornada -> validarJornada = $_POST["validarJornada"];
	$validarJornada -> ajaxvalidarJornada();

}

/*=============================================
EDITAR JORNADAS
=============================================*/

if (isset($_POST['idJornada'])) {
	

	$idJornada = new AjaxCalendario();
	$idJornada -> idJornada = $_POST['idJornada'];
	$idJornada -> ajaxEditarJornada();

}

