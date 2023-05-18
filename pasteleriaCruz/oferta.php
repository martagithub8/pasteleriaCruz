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
<html lang="en">

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

            <?php
            echo '<div id="login">';


            if ($_SESSION['usuario'] != "") {
                echo '<div id="login2"><a href="tienda.php"><i class="bi bi-house iconHeader"></i></a></div>
                <div id="login2"><a href="cerrarSesion.php"><i class="bi bi-box-arrow-left iconHeader"></i></a></div>
    
                </div>';
            } else {
                echo '<div id="login1"><a href="login.php"><i class="bi bi-person-circle iconHeader"></i></a></div>
                <div id="login2"><a href="login.php"></a></div>
                      <div id="login2"><a href="index.php"></i></a></div>
      
                  </div>';
            }

            ?>



            <h1 id="lala">PASTELERÍA CRUZ</h1>

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
                                <a class="nav-link active" aria-current="page" href="personalizar.php">DISEÑA</a>
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
    <div style="text-align:center; justify-content:center">
        <h2>¿Aún no conoces nuestra oferta?</h2>
        <span>Por la compra de una de nuestras tartas personalizadas llévese un pastel de nuestro catálogo gratis</span>
    </div>
    <section id="cajaGlobal">
        <section id="ejemplo1">
            <div id="tarta1">
                <img src="img/per5.png" alt="esfera" width="280" height="270">

            </div>

            <div id="tarta1">
                <img src="img/per2.png" alt="esfera" width="280" height="270">

            </div>
        </section>


        <section class="col-sm-7 container mb-4 " id="seccionPersonalizar">
            <div class="container" style="display:flex; justify-content: center; margin-top: 20%;">


                <a style="border:1px solid black; padding:4%; text-decoration:none; background-color:#7D5A48; color:white; background-color:  rgb(40,12,3);
background: linear-gradient(0deg, rgba(40,12,3,1) 1%, rgba(3,225,228,1) 73%, rgba(129,221,204,1) 100%);" href="personalizar.php">COMENZAR</a>


            </div>
        </section>


        <section id="ejemplo1">
            <div id="tarta1">
                <img src="img/per2.png" alt="esfera" width="280" height="270">

            </div>

            <div id="tarta1">
                <img src="img/per5.png" alt="esfera" width="280" height="270">


            </div>
        </section>
    </section>


</body>


<footer>
    <span id="derechosReservados">Pastelería Cruz © 2023. Todos los derechos reservados</span>
    <div id="iconos1">
        <i class="bi bi-twitter iconito0"></i>&nbsp;&nbsp;
        <i class="bi bi-instagram iconito0"></i>
    </div>
</footer>

</html>