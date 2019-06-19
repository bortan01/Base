<?php
class conexion{
	private static $conexion;
    // crear conexion con oracle
public function conectar(){
   $conexion = oci_connect("root", "root", "localhost/xe"); 
 
if (!$conexion) {    
  $m = oci_error();    
  echo $m['message'], "n";    
  exit; 
} else { 
return $conexion  ; 
   } 


}

public function conectarPDO(){
  try
{
$usuario = root;
$password = root;
$nombredb = root;
//para oracle el tipo es oci
$conn =new PDO("oci:dbname".$nombredb,$usuario,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $conn;
}
catch ( PDOException $e )
{  echo "Error: ".$e->getMessage( );  }

}

 public static function obtener_conexion(){
        return self::$conexion;
    }

 public static function cerrar_conexion() {
        if (isset(self::$conexion)) {
            self::$conexion = null;
            //print 'conexion cerrada';
        }
    }

}

