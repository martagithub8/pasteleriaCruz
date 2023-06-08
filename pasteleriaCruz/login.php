<?php
session_start();
include "conexion_con_CLASE.php";
$mensajeUsuario = "";
$mensajePassword = "";
$usuario = "";
$mensaje = '';

//sesiones
if (isset($_POST['usuario'])) {
  $usuario =  trim(stripcslashes(htmlspecialchars($_POST['usuario'])));
}

$password = "";
if (isset($_POST['password'])) {
  $password = trim(stripcslashes(htmlspecialchars($_POST['password'])));
  $password = md5($password);
}

if (!isset($_SESSION['usuario'])) {
  $_SESSION['usuario'] = '';
}





//crear una conexión de la clase conexión importada
$con = new Conexion("root", "", "pasteleria");

//control de errores en login
if (isset($_POST['btnIniciarSesion'])) {
  if ($usuario == "") {
    $mensajeUsuario = "Este campo no puede estar vacío";
  } else {
    $mensajeUsuario = "";
  }

  if ($password == "") {
    $mensajePassword = "Este campo no puede estar vacío";
  } else {
    $mensajePassword = "";


    //AHORA COMPROBAMOS QUE EXISTA EN LA BD
    // Consulta para comprobar si las credenciales son válidas
    $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
    //lanza consulta
    $res = $con->conexion->query($consulta);

    if ($res->rowCount() == 1) {
      // Las credenciales son válidas, iniciar sesión
      $_SESSION['usuario'] = $usuario;
      header('Location: tienda.php');
    } else {
      // Las credenciales no son válidas, mostrar un mensaje de error
      $mensaje = 'Nombre de usuario o contraseña incorrectos.';
    }
  }
}


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


  <title>Pastelería Cruz</title>
</head>

<body>
  <header>
    <section id="cabecera">

      <div id="login">
        <div id="login1"><a class="nav-item " href="login.php"><i class="bi bi-person-circle iconHeader "></i></a></div>
        <div id="login2"><a href="index.php"><i class="bi bi-house iconHeader"></i></a></div>

      </div>



      <h1>PASTELERÍA CRUZ</h1>

      <div id="usuario">

      </div>




    </section>
    <section id="menumenu">
      <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #f5f5f5;">
        <div class="container-fluid">
          <a class="navbar-brand margin1" href="index.php">INICIO</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item margin">
                <a class="nav-link active" aria-current="page" href="informacion.php">INFORMACIÓN</a>
              </li>
              <li class="nav-item margin">
                <a class="nav-link active " aria-current="page" href="tarta.php">TARTAS</a>
              </li>
              <li class="nav-item margin">
                <a class="nav-link active" aria-current="page" href="pasteles.php">PASTELES</a>
              </li>


            </ul>

          </div>
        </div>
      </nav>
    </section>

  </header>

  

  <div class="container mt-4">
    <h1>Iniciar sesión</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

      <div class="mb-3">
        <label for="usuario" class="form-label">Usuario:</label>
        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Introduzca su usuario">
        <div class="usuario"><?php echo $mensajeUsuario ?></div>

      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp" placeholder="Introduzca su contraseña">
        <div class="password"><?php echo $mensajePassword ?></div>
      </div>

      <button type="submit" class="btn btn-primary" name="btnIniciarSesion">INICIAR SESIÓN</button>
      <a href="registro.php">REGISTRATE</a>

    </form>
    <div class="mensaje"><?php echo $mensaje ?></div>




  



</body>

</html>