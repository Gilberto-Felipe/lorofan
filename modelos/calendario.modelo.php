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
					A.alias as equipo1, B.alias as equipo2,
					C.equipo1 as idEquipo1, C.equipo2 as idEquipo2
				FROM 
					$tabla AS C JOIN equipos AS A ON C.equipo1 = A.id
					JOIN equipos AS B ON B.id = C.equipo2
				WHERE C.$item = :$item"
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
	EDITAR JORNADAS
	=============================================*/

	static public function mdlEditarJornada($tabla, $datos){

		var_dump($datos);

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET jornada = :jornada, fecha = :fecha, lugar = :lugar, equipo1 = :equipo1, equipo2 = :equipo2 WHERE id = :id");

		$stmt -> bindParam(":jornada", $datos["jornada"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt -> bindParam(":lugar", $datos["lugar"], PDO::PARAM_STR);
		$stmt -> bindParam(":equipo1", $datos["equipo1"], PDO::PARAM_INT);
		$stmt -> bindParam(":equipo2", $datos["equipo2"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()){
			
			return "ok";

		} else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ELIMINAR JORNADA
	=============================================*/

	static public function mdlEliminarCalendario($tabla, $datos){

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



