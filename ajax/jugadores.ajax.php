<?php 

require_once "../controladores/jugadores.controlador.php";
require_once "../modelos/jugadores.modelo.php";


class AjaxJugador {
		
	/*=============================================
	LLENAR EL MODAL EDITAR JUGADORES
	=============================================*/

	public $idJugador;

	public function ajaxEditarJugador(){

		$item = "id";
		$valor = $this->idJugador;

		$respuesta = ControladorPlantillaJugadores::ctrMostrarPlantilla($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
LLENAR MODAL EDITAR JUGADORES INICIALIZACIÓN
=============================================*/

if (isset($_POST['idJugador'])) {
	
	$editarJugador = new AjaxJugador();
	$editarJugador -> idJugador = $_POST['idJugador'];
	$editarJugador -> ajaxEditarJugador();

}
