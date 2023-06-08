<?php


session_start();
include "conexion_con_CLASE.php";

//variables
$mensajeNombre = "";
$mensajeCorreo = "";
$mensajeUsuario = "";
$mensajePassword1 = "";
$mensajePassword2 = "";
$valido = true;
$mensaje = '';
$usuario = "";
$nombre = '';
$correo = '';

//sesiones
if (isset($_POST['nombre']) && $_POST['nombre'] != "") {
    $nombre =  trim(stripcslashes(htmlspecialchars($_POST['nombre'])));
}
if (isset($_POST['correo']) && $_POST['correo'] != "") {
    $correo =  trim(stripcslashes(htmlspecialchars($_POST['correo'])));
}


if (isset($_POST['usuario']) && $_POST['usuario'] != "") {
    $usuario =  trim(stripcslashes(htmlspecialchars($_POST['usuario'])));
}
$password1 = "";
if (isset($_POST['password1']) && $_POST['password1'] != "") {
    $password1 = trim(stripcslashes(htmlspecialchars($_POST['password1'])));
}
$password2 = "";
if (isset($_POST['password2']) && $_POST['password2'] != "") {
    $password2 = trim(stripcslashes(htmlspecialchars($_POST['password2'])));
}



//crear una conexion de la clase conexion importada
$con = new Conexion("root", "", "pasteleria");

// Comprobar datos
if ($nombre == "") {
    $mensajeNombre = "Este campo no puede estar vacío";
    $valido = false;
} else {
    $mensajeNombre = "";
}

if (isset($_POST['btnNuevo'])) {
    if ($correo == "") {
        $mensajeCorreo = "Este campo no puede estar vacío";
        $valido = false;
    } else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensajeCorreo = "El correo es inválido";
        $valido = false;
    } else {
        $mensajeCorreo = "";
        $consulta = "SELECT correo FROM usuarios WHERE correo = '$correo' ";
        //lanza consulta
        $res = $con->conexion->query($consulta);
    
        if ($res->rowCount() == 1) {
            // Las credenciales no son válidas, mostrar un mensaje de error             
            $mensajeCorreo = 'Ese correo ya está registrado';
            $valido = false;
        }
    }



    if ($usuario == "") {
        $mensajeUsuario = "Este campo no puede estar vacío";
        $valido = false;
    } else {
        $mensajeUsuario = "";
        $consulta = "SELECT usuario FROM usuarios WHERE usuario = '$usuario' ";
        //lanza consulta
        $res = $con->conexion->query($consulta);

        if ($res->rowCount() == 1) {
            // Las credenciales no son válidas, mostrar un mensaje de error             
            $mensajeUsuario = 'Ese usuario ya está registrado';
            $valido = false;
        }
    }


    if ($password1 == "") {
        $mensajePassword1 = "Este campo no puede estar vacío";
        $valido = false;
    } else {
        $mensajePassword1 = "";

        if (strlen($password1) >= 5 && strlen($password1) <= 8) {
            $mensajePassword1 = "";
        } else {
            $mensajePassword1 = "La contraseña debe contener entre 5-8 caracteres";
            $valido = false;
        }
    }

    if ($password2 == "") {
        $mensajePassword2 = "Este campo no puede estar vacío";
        $valido = false;
    } else {
        $mensajePassword2 = "";
    }
    if ($password1 == $password2) {
    } else {
        $valido = false;
        $mensajePassword2 = "Las contraseñas deben coincidir";
    }

    if ($valido != false) {
        try {
            $password1 = md5($password1);
            $password2 = md5($password2);

            $sql = "INSERT INTO usuarios (nombre, correo, usuario, password) VALUES ('$nombre', '$correo', '$usuario', '$password1')";
            $res = $con->conexion->query($sql);
            echo "<h1>Registrado con éxito</h1>";
            $res->closeCursor();
            // Las credenciales son válidas, iniciar sesión
            $_SESSION['usuario'] = $usuario;
            header('Location: adminUsu.php');
        } catch (Exception $e) {
            echo "<h1>Error al registrar</h1>";
        }
    }
}








?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Registro</title>
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



            <h1>PASTELERÍA CRUZ</h1>

            <div id="usuario">
                <p><i class="bi bi-person-fill"></i><?php echo $_SESSION['usuario']; ?>
                <p>
            </div>




        </section>
        <section id="menumenu">
            <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #f5f5f5;">
                <div class="container-fluid">
                    <?php

                    echo '<a class="navbar-brand margin1"';
                    if ($_SESSION['usuario'] != "") {
                        echo 'href="tienda.php"';
                    } else {
                        echo 'href="index.php"';
                    }

                    echo '>INICIO</a>';
                    ?> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
    <div class="container mt-4">
        <h1>REGISTRATE</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduzca su nombre">
                <div style="color: red;" class="nombre"><?php echo $mensajeNombre ?></div>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" placeholder="Introduzca su correo">
                <div style="color: red;" class="correo"><?php echo $mensajeCorreo ?></div>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Introduzca nombre de usuario">
                <div style="color: red;" class="usuario"><?php echo $mensajeUsuario ?></div>
            </div>
            <div class="mb-3">
                <label for="password1" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password1" name="password1" aria-describedby="emailHelp" placeholder="Debe contener entre 5-8 caracteres">
                <div style="color: red;" class="password1"><?php echo $mensajePassword1 ?></div>

            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Repetir contraseña:</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Debe contener entre 5-8 caracteres">
                <div style="color: red;" class="password2"><?php echo $mensajePassword2 ?></div>
            </div>

            <button type="submit" class="btn btn-primary" name="btnNuevo">AÑADIR NUEVO USUARIO</button>
            <a href="adminUsu.php">volver</a>
        </form>
        <div class="mensaje"><?php echo $mensaje ?></div>
    </div>



</body>

</html>