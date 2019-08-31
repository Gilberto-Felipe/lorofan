<?php 

require_once "conexion.php";


class ModeloEquipos{
	
	/*=============================================
	=            MOSTRAR EQUIPOS            =
	=============================================*/

	static public function mdlMostrarEquipos($tabla, $item, $valor){

		if ($item != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		} 
		else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	=            CREAR DE EQUIPOS            =
	=============================================*/

	static public function mdlRegistrarEquipo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(alias, nombre, escudo, estadio) VALUES(:alias, :nombre, :escudo, :estadio)");

		$stmt -> bindParam(":alias", $datos["alias"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":escudo", $datos["escudo"], PDO::PARAM_STR);
		$stmt -> bindParam(":estadio", $datos["estadio"], PDO::PARAM_STR);

		if ($stmt->execute()){
			
			return "ok";

		} 
		else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		if ($stmt->execute()){
			
			return "ok";

		}
		else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ELIMINAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
}






