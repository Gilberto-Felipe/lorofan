<?php 

require_once "conexion.php";


class ModeloEquipos{
	
	/*=============================================
	MOSTRAR EQUIPOS            
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
	CREAR DE EQUIPOS
	=============================================*/

	static public function mdlRegistrarEquipo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(alias, nombre, estadio, escudo) VALUES(:alias, :nombre, :estadio, :escudo)");

		$stmt -> bindParam(":alias", $datos["alias"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":estadio", $datos["estadio"], PDO::PARAM_STR);
		$stmt -> bindParam(":escudo", $datos["escudo"], PDO::PARAM_STR);

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
	EDITAR EQUIPOS
	=============================================*/

	static public function mdleditarEquipo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET alias = :alias, nombre = :nombre, escudo = :escudo, estadio = :estadio WHERE alias = :alias");

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
	ELIMINAR EQUIPO
	=============================================*/

	static public function mdlBorrarEquipo($tabla, $datos){

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






