<?php
class Repositorio_persona{
	public static function insertar($conexion, $persona){
		$persona_insertada =  false;

		if (isset($conexion)){
			echo '<script>alert("paso1", "", "warning");</script>';
			try {
				$dui = $persona->getDui();
				$nombre = $persona->getNombre();
				$apellido = $persona->getApellido();
				$telefono = $persona->getTelefono();
				$deporte = $persona->getDeporte();
				$edad = $persona->getEdad();
				$equipo = $persona->getEquipo ();
				$direccion = $persona->getDireccion();

				$sql = 'insert into personas :dui, :nombre, :apellido, :telefono, :deporte, :edad, :equipo, :direccion';

				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':dui', $dui, PDO::PARAM_STR);
				$sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
				$sentencia->bindParam(':apellido', $apellido, PDO::PARAM_STR);
				$sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);
				$sentencia->bindParam(':deporte', $deporte, PDO::PARAM_STR);
				$sentencia->bindParam(':edad', $edad, PDO::PARAM_STR);
				$sentencia->bindParam(':equipo', $equipo, PDO::PARAM_STR);
				$sentencia->bindParam(':direccion', $edireccion, PDO::PARAM_STR);
				$persona_insertada = $sentencia->execute();

			}catch (PDOException $ex){
				 echo '<script>swal("No se puedo realizar el registro acivo", "Favor revisar los datos e intentar nuevamente' . $ex->getMessage() . '", "warning");</script>';
                print 'ERROR: ' . $ex->getMessage();
			}
		}else{
			echo '<script>alert("no paso1", "", "warning");</script>';
		}

	}


	public static function registrar($conexion, $persona){
		$persona_insertada =  false;

		$dui = $persona->getDui();
				$nombre = $persona->getNombre();
				$apellido = $persona->getApellido();
				$telefono = $persona->getTelefono();
				$deporte = $persona->getDeporte();
				$edad = $persona->getEdad();
				$equipo = $persona->getEquipo ();
				$direccion = $persona->getDireccion();

		$sql = "INSERT INTO personas(dui,nombre) "."VALUES('".$dui."','".$nombre."')"	;	
		
		$registrar = oci_parse($conexion, $sql);
		oci_execute($registrar);
	}
}



?>