<?php 

require_once "conexion.php";

class ModeloCalendario{

	/*=============================================
	MOSTRAR JORNADAS            
	=============================================*/

	static public function mdlMostrarCalendario($tabla, $item, $valor){

		if ($item != null) {
			
			$stmt = Conexion::conectar()->prepare(
				"SELECT 
					C.id, C.jornada, C.fecha, C.lugar, 
					A.alias as equipo1, B.alias as equipo2
			FROM 
				$tabla AS C JOIN equipos AS A ON C.equipo1 = A.id
				JOIN equipos AS B ON B.id = C.equipo2"
			);

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		} 
		else{

			$stmt = Conexion::conectar()->prepare(
				"SELECT 
					C.id, C.jornada, C.fecha, C.lugar, 
					A.alias as equipo1, B.alias as equipo2
				FROM 
					$tabla AS C JOIN equipos AS A ON C.equipo1 = A.id
					JOIN equipos AS B ON B.id = C.equipo2"
			);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CREAR JORNADAS
	=============================================*/

	static public function mdlCrearJornada($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(jornada, fecha, lugar, equipo1, equipo2) VALUES(:jornada, :fecha, :lugar, :equipo1, :equipo2)");

		$stmt->bindParam(":jornada", $datos["jornada"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
		$stmt->bindParam(":equipo1", $datos["equipo1"], PDO::PARAM_STR);
		$stmt->bindParam(":equipo2", $datos["equipo2"], PDO::PARAM_STR);

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
	EDITAR CATEGORÍA
	=============================================*/

	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos['categoria'], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos['id'], PDO::PARAM_INT);


		if ($stmt->execute()){
			
			return "ok";

		} else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ELIMINAR CATEGORÍA
	=============================================*/

		static public function mdlBorrarCategoria($tabla, $datos){

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



