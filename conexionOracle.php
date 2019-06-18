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

