<DOCTYPE HTML>
<meta charset = "utf8" />
<?php  
// crear conexion con oracle
$conexion = oci_connect("FERRETERIA", "FERRETERIA", "localhost/xe"); 
 
if (!$conexion) {    
  $m = oci_error();    
  echo $m['message'], "n";    
  exit; 
} else {    
  echo "Conexión con éxito a Oracle!"; } 
 
?>