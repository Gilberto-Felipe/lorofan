<?php

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS cuando se es administrador 
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	CREAR VENTAS
	=============================================*/

	static public function ctrCrearVenta(){

		/*=============================================
		VALIDAR QUE HAYA LISTA DE PRODUCTOS PARA PODER GUARDAR LA COMPRA
		=============================================*/

		if (isset($_POST["nuevaVenta"]) && isset($_POST["seleccionarCliente"]) && isset($_POST["listaProductos"])) {

			if(!empty($_POST["listaProductos"])){
            	
				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE, REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos = json_decode($_POST["listaProductos"], true);

				$totalProductosComprados = array();

				foreach ($listaProductos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

					// ACTUALIZAR VENTAS

					$item1a = "ventas";
					$valor1a = $value["cantidad"] + $traerProducto["ventas"];

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					// ACTUALIZAR STOCK

					$item1b = "stock";
					$valor1b = $value["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				// ACTUALIZAR LA COMPRA DEL CLIENTE

				$tablaClientes = "clientes";

				$item = "id";
				$valor = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

				$item1a = "compras";
				$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

				// LLENAR FECHA DE ÚLTIMA COMPRA

				$item1b = "ultima_compra";

				date_default_timezone_set('America/Mexico_City');
				
				$valor1b = date('Y-m-d H:i:s');

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

				/*=============================================
				GUARDAR LA COMPRA
				=============================================*/	

				$tabla = "ventas";

				$datos = array("id_vendedor"=>$_POST["idVendedor"],
							   "id_cliente"=>$_POST["seleccionarCliente"],
							   "codigo"=>$_POST["nuevaVenta"],
							   "productos"=>$_POST["listaProductos"],
							   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
							   "neto"=>$_POST["nuevoPrecioNeto"],
							   "total"=>$_POST["totalVenta"],
							   "metodo_pago"=>$_POST["listaMetodoPago"]);

				$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

						localStorage.removeItem("rango");

						swal({
							  type: "success",
							  title: "La venta se guardó correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
									if (result.value) {

										window.location = "ventas";

									}
								})

					</script>';

				}

        	} else{

        		echo '<script>

        			localStorage.removeItem("rango");

        			swal({
        				  type: "error",
        				  title: "Debe elegir un producto",
        				  showConfirmButton: true,
        				  confirmButtonText: "Cerrar"
        				  }).then((result) => {
        						if (result.value) {

        							window.location = "crear-venta";

        						}
        					})

        		</script>';

        	}
			
		}

	}
	
}