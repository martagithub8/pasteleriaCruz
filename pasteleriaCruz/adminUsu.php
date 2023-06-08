<?php
session_start();
include "conexion_con_CLASE.php";

//crear una conexión de la clase conexión importada
$conexion = new Conexion("root", "", "pasteleria");

$mensajeUsuario = "";
$mensajePassword = "";
$usuario = "";
$mensaje = '';
//VARIABLES
$total = 0;
$contenidoCesta = false;
$cantidadProducto = 0;
$producto = '';
$productosComprados = '';
$fecha_actual = date('d-m-Y H:i:s');
$mensaje = '';
$mensajeTotal = '';
$contenidoFichero = '';
$productoTabla = '';
$precioTabla = 0;
$cantidadTabla = 0;
$filasTabla = '';
$mensaje = '';
$editarUsuario = '';



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

//SESIONES
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
}

if (!isset($_SESSION['producto'])) {
    $_SESSION['producto'] = '';
}
if (!isset($_SESSION['cantidadProducto'])) {
    $_SESSION['cantidadProducto'] = 0;
}

if (!isset($_SESSION['productosComprados'])) {
    $_SESSION['productosComprados'] = '';
}

//usuariobd

if (!isset($_SESSION['usuariobd'])) {
    $_SESSION['usuariobd'] = '';
}
if (!isset($_SESSION['saborbd'])) {
    $_SESSION['saborbd'] = '';
}
if (!isset($_SESSION['imagenbd'])) {
    $_SESSION['imagenbd'] = '';
}


//nombre0
if (!isset($_SESSION['nombre0'])) {
    $_SESSION['nombre0'] = '';
}
if (!isset($_SESSION['correo0'])) {
    $_SESSION['correo0'] = '';
}
if (!isset($_SESSION['usuario0'])) {
    $_SESSION['usuario0'] = '';
}


//nombreN
if (!isset($_SESSION['nombreN'])) {
    $_SESSION['nombreN'] = '';
}
if (!isset($_SESSION['saborN'])) {
    $_SESSION['saborN'] = '';
}
if (!isset($_SESSION['imagenN'])) {
    $_SESSION['imagenN'] = '';
}
if (!isset($_SESSION['precioN'])) {
    $_SESSION['precioN'] = '';
}

if (!isset($_SESSION['stockN'])) {
    $_SESSION['stockN'] = '';
}
if (!isset($_SESSION['categoria'])) {
    $_SESSION['categoria'] = '';
}




//PROGRAMACION

//mientras haya algo seleccionado en el filtro
if (isset($_POST['filtro']) && isset($_POST['quantity'])) {
    $_SESSION['filtro'] = $_POST['filtro'];
    $_SESSION['quantity'] = $_POST['quantity'];

    if ($_SESSION['filtro'] == 'todos') {
        // $mensaje='debe seleccionar un producto';
    } else {

        $sql = "UPDATE producto SET stock = stock + '" . $_SESSION['quantity'] . "' WHERE nombre = '" . $_SESSION['filtro'] . "';";
    }

    $consulta = $conexion->conexion->prepare($sql);
    $consulta->execute();
}

//PARTE DE EDITAR

if (isset($_POST['filtroEd'])) {
    $_SESSION['filtroEd'] = $_POST['filtroEd'];

    if ($_SESSION['filtroEd'] == 'todos') {
        // $mensaje='debe seleccionar un producto';
    } else {
        $sql = "SELECT * FROM usuarios WHERE usuario = '" . $_SESSION['filtroEd'] . "'; ";
    }

    $consulta = $conexion->conexion->prepare($sql);
    $consulta->execute();
    while ($fila = $consulta->fetch()) {
        $_SESSION['usuariobd'] = $fila['usuario'];



        $editarUsuario = '
       
        <span>Nombre: "' . $fila['nombre'] . '" </span>
        <span>correo: "' . $fila['correo'] . '"</span>
        <span>usuario: "' . $fila['usuario'] . '"</span>
        <span>contraseña: "' . $fila['password'] . '"</span>


        
        <form action="#" method="POST">
        <label for="nombre0">Nombre:</label>
        <input type="text" id="nombre0" name="nombre0" value="'.$fila['nombre'] .'">

        <label for="correo0">correo:</label>
        <input type="text" id="correo0" name="correo0" value="'.$fila['correo'] .'">

        <label for="usuario0">usuario:</label>
        <input type="text" id="usuario0" name="usuario0" value="'.$fila['usuario'] .'">

        <label for="password0">contraseña:</label>
        <input type="text" id="password0" name="password0" value="'.$fila['password'] .'">

       

        <input type="submit" class="btn btn-dark" style="width: 150px;" value="editarr" name="editarr">

        </form>

     ';
    }
}


//CAMPOS PARA HACER EDIT
if (isset($_POST['editarr'])) {
    $_SESSION['nombre0'] = $_POST['nombre0'];
    $_SESSION['correo0'] = $_POST['correo0'];
    $_SESSION['usuario0'] = $_POST['usuario0'];
    $_SESSION['password0'] = md5($_POST['password0']);


    $sql2 = "UPDATE usuarios SET correo = '" . $_SESSION['correo0'] . "' WHERE usuario = '" . $_SESSION['usuariobd'] . "'; ";
    $consulta2 = $conexion->conexion->prepare($sql2);
    $consulta2->execute();


    $sql4 = "UPDATE usuarios SET password = '" . $_SESSION['password0'] . "' WHERE usuario = '" . $_SESSION['usuariobd'] . "';";
    $consulta = $conexion->conexion->prepare($sql4);
    $consulta->execute();

    $sql = "UPDATE usuarios SET nombre = '" . $_SESSION['nombre0'] . "' WHERE usuario = '" . $_SESSION['usuariobd'] . "';";
    $consulta = $conexion->conexion->prepare($sql);
    $consulta->execute();

    $sql3 = "UPDATE usuarios SET usuario = '" . $_SESSION['usuario0'] . "' WHERE usuario = '" . $_SESSION['usuariobd'] . "'; ";
    $consulta3 = $conexion->conexion->prepare($sql3);
    $consulta3->execute();

   
}

//AÑADIR PRODUCTO NUEVO

// if (isset($_POST['nuevoProducto'])) {
//     $_SESSION['nombreN'] = $_POST['nombreN'];
//     $_SESSION['saborN'] = $_POST['saborN'];
//     $_SESSION['imagenN'] = $_POST['imagenN'];

//     $_SESSION['precioN'] = $_POST['precioN'];
//     $_SESSION['stockN'] = $_POST['stockN'];
//     $_SESSION['categoria'] = $_POST['categoria'];


//     $sql = "INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('" . $_SESSION['imagenN'] . "', '" . $_SESSION['nombreN'] . "', '" . $_SESSION['categoria'] . "','" . $_SESSION['saborN'] . "', " . $_SESSION['precioN'] . ", " . $_SESSION['stockN'] . ");";
//     $consulta = $conexion->conexion->prepare($sql);
//     $consulta->execute();
// }


//ELIMINAR PRODUCTO
if (isset($_POST['eliminarP'])) {
    $_SESSION['eliminarP'] = $_POST['eliminarP'];

    if ($_SESSION['eliminarP'] == 'todos') {
        // $mensaje='debe seleccionar un producto';
    } else {

        $sql = "DELETE FROM usuarios WHERE usuario = '" . $_SESSION['eliminarP'] . "';";
    }

    $consulta = $conexion->conexion->prepare($sql);
    $consulta->execute();
}



//************************* */
if ($editarUsuario == '') {
    $mensaje = "NO EXISTEN PRODUCTOS EN ESTA TIENDA";
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


    </div>



    <div class="editar productos">

        
       <br><span>AÑADIR USUARIO </span>
        <div>
            <a href="nuevoUsu.php"> add usuario</a>
        </div>


        <br><br><span>EDITAR USUARIO</span>
        <form action="#" method="POST">
            <select class="form-select" style="width: 150px; margin-right: 10px;" name="filtroEd" id="filtroEd">
                <!-- <option value="todos">todos</option> -->

                <?php
                $sql = "SELECT usuario FROM usuarios ; ";

                $consulta = $conexion->conexion->prepare($sql);
                $consulta->execute();
                while ($fila = $consulta->fetch()) {
                    echo '<option value="' . $fila["usuario"] . '" selected>' . $fila["usuario"] . '</option>';
                }
                ?>

            </select>

            <input type="submit" class="btn btn-dark" style="width: 150px;" value="EDITAR" name="editar">



        </form>
        <div class="editarProd">
            <?php
            echo $editarUsuario;


            ?>
        </div>



        <br><br><span>ELMINAR USUARIO</span>
        <form action="#" method="POST">
            <select class="form-select" style="width: 150px; margin-right: 10px;" name="eliminarP" id="eliminarP">
                <!-- <option value="todos">todos</option> -->
                <?php
                $sql = "SELECT usuario FROM usuarios ; ";

                $consulta = $conexion->conexion->prepare($sql);
                $consulta->execute();
                while ($fila = $consulta->fetch()) {
                    echo '<option value="' . $fila["usuario"] . '" selected>' . $fila["usuario"] . '</option>';
                }
                ?>

            </select>

            <input type="submit" class="btn btn-dark" style="width: 150px;" value="ELIMINAR" name="eliminar">



        </form>

    </div>



</body>

</html>