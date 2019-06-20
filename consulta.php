<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BD</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">-->

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<?php
$sql=$_GET['sql'];
$resul=$_GET['resul'];
?>
<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!--<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
          <div class="col-lg-10">
            <div class="p-7">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Consultas</h1>
              </div>
              <form class="user" method="post" id="myForm" name="myForm">
                 <input type="hidden" name="pass" id="pass" >
                <div class="form-group row ">
                  <div class="col-lg-12">                    
                    <textarea type="text" class="form-control form-control-user" id="sql" name="sql" placeholder="consulta"
                    ><?php echo $sql;  ?></textarea>
                  </div>                  
                </div>

                <div class="form-group row">
                  <div class="col-lg">
                     <textarea type="text" class="form-control form-control-user" id="resul" name="resul" placeholder="resultado">
                       <?php echo $resul;  ?>
                     </textarea>
                  </div>
                </div>
               
                 
               
                 
                <a type="button" href="javascript:document.forms[0].submit()" onclick="consultar();" class="btn btn-primary btn-user btn-block">
                  CONSULTAR
                  
                </a>
                <hr>
               <a href="index.php" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-yc-square fa-fw"></i> Regresar
                </a>
                
              </form>
              <hr>
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script language="javascript">
   function consultar(){
    
  //  document.getElementById("myForm").submit();
  //  alert("ff");
   }
  </script>

</body>

</html>
 <?php
 //echo '<script>alert("No se completo el registro", "", "warning");</script>';
 if (isset($_REQUEST["pass"])
    ) {
   echo '<script>alert("No se completo el registro", "", "warning");</script>';
      include_once './conexionOracle.php';
      $conn=new conexion();
      $sql = $_POST['sql'];
     
      $registrar = oci_parse($conn->conectar(), $sql);
      $resul = oci_execute($registrar);
      $otro="";
      while ($fila = oci_fetch_array($registrar, OCI_ASSOC+OCI_RETURN_NULLS)) 
      {
        
        foreach ($fila as $elemento) {
        $otro= $otro."".implode(" - ", $fila);
        $resul=$otro.' \n <br> ';

        } 
      }

      header('Location: consulta.php?sql='.$sql.' & resul='.$resul.'');
      //oci_execute($registrar); 
     }    

 ?>