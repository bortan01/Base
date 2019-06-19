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

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!--<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Registro Jugador!</h1>
              </div>
              <form class="user" method="post">
                 <input type="hidden" name="pass" id="pass" >
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="apellido" name="apellido" placeholder="Apellido">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="direccion" name="direccion" placeholder="Direccion">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="dui" name="dui" placeholder="DUI">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="telefono" name="telefono" placeholder="Telefono">
                  </div>
                </div>
                 <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="procedencia" name="procedencia" placeholder="Procedencia">
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-user" id="altura" name="altura" placeholder="Altura">
                  </div>
                   <div class="col-sm-3">
                    <input type="text" class="form-control form-control-user" id="peso" name="peso" placeholder="Peso">
                  </div>
                </div>
                 <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="posicion" name="posicion" placeholder="Posicion">
                  </div>
                  <div class="col-sm-6">
                      <select class="form-control form-control-user" name="equipo" id="equipo">
                          <!--cargar los equipos desde la base--> 
                          <option value="saab">Saab</option>
                          <option value="mercedes">Mercedes</option>
                          <option value="audi">Audi</option>
                      </select>
                  </div>
                  
                </div>
                 
                <a type="" href="" class="btn btn-primary btn-user btn-block">
                  <button type="submit">Guardar</button>
                  
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

</body>

</html>
<?php
if (isset($_REQUEST["pass"])

    ) {
  include_once './conexionOracle.php';
include_once './modelos/Persona.php';
 include_once './repositorios/repositorio_persona.php';
 $persona = new Persona();

 $persona->setDui($_POST['dui']);
 $persona->setNombre($_POST['nombre']);
 $persona->setApellido($_POST['apellido']);
 $persona->setDireccion($_POST['direccion']);
 $persona->setTelefono($_POST['telefono']);

   $conn=new conexion();
   $conn->conectar() ;

   repositorio_persona::registrar($conn->conectar(), $persona);
   //repositorio_persona::insertar($conn->conectar(), $persona);

    

    /*
    Conexion::abrir_conexion(); 

    $categoria = new Categoria();
    $categoria->setCodigo_tipo($_REQUEST["nameApellido"]);
    $categoria->setNombre($_REQUEST["nameNombre"]);

    Repositorio_categoria::insertar_categoria(Conexion::obtener_conexion(), $categoria); 
   */
    //Conexion::cerrar_conexion();
      
        
}


?>
