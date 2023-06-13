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

if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['usuario']) && isset($_POST['password1'])&& isset($_POST['password2'])) {
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
            $mensajePassword1 = "La contraseña debe contener entre 6-8 caracteres";
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

            $sql = "INSERT INTO usuarios (nombre, correo, usuario, password, tipo) VALUES ('$nombre', '$correo', '$usuario', '$password1', 'cliente')";
            $res = $con->conexion->query($sql);
            $res->closeCursor();
            // Las credenciales son válidas, iniciar sesión
            $_SESSION['usuario'] = $usuario;
            header('Location: tienda.php');
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
    <script src="javascript.js"></script>
    <title>Registro</title>
</head>

<body>
    <div class="container mt-4">
        <h1 style="color:black">REGISTRATE</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="formRegistro">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduzca su nombre">
                <span id="errorNombre"  style="display:none; color:red;"></span>            
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" class="form-control" id="correo" name="correo" placeholder="Introduzca su correo">
                <span id="errorCorreo"  style="display:none; color:red; "></span>            
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Introduzca nombre de usuario">
                <span id="errorUsuario"  style="display:none; color:red;"></span>            
            </div>
            <div class="mb-3">
                <label for="password1" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password1" name="password1" aria-describedby="emailHelp" placeholder="Debe contener entre 6-8 caracteres">
                <span id="errorPassword1"  style="display:none; color:red;"></span>            

            </div>
            <div class="mb-3">
                <label for="password2" class="form-label">Repetir contraseña:</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Debe contener entre 5-8 caracteres">
                <span id="errorPassword2"  style="display:none; color:red;"></span>            
            </div>

            <button class="btn btn-primary" id="btnRegistro" name="btnRegistro">REGISTRARME</button>
            <a href="login.php">INICIAR SESION</a>
        </form>
        <div class="mensaje"><?php echo $mensaje ?></div>
    </div>



</body>

</html>