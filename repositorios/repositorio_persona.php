<?php
class Repositorio_persona{
	public static function insertar($conexion, $persona, $aislamiento, $bloqueo){
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


	public static function registrar($conexion, $persona, $aislamiento, $bloqueo){
		$persona_insertada =  false;
		switch ($aislamiento) {
		    case 1:
		        $aislamiento="SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;";
		        break;
		    case 2:
		        $aislamiento="SET TRANSACTION ISOLATION LEVEL READ COMMITTED;";
		        break;
		    case 3:
		        $aislamiento="";
		        break;
		}
		switch ($bloqueo) {
		    case 'e':
		        $bloqueo="LOCK TABLE PERSONAS IN EXCLUSIVE MODE;";
		        break;
		    case "c":
		        $bloqueo="SET TRANSACTION ISOLATION LEVEL READ ONLY";
		        break;		    
		}

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
		if(!oci_execute($registrar, OCI_DEFAULT)) {    
         // Si tenemos un problema, retrocede, muere
			echo '<script>alert("No se completo el registro", "", "warning");</script>';
         oci_rollback ($conexion);         
     	}else{
     		oci_commit($conexion);
     	}
		
		
	}
}



?>

