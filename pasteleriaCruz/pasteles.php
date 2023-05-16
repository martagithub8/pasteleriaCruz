<?php
session_start();
include "conexion_con_CLASE.php";

//variables
$listaPasteles = "";
$filtro = '';
$nombre = '';
$precio = 0;
$cantidadPorDefecto = 1;
$cantidad = 0;
$stockBD = 0;
$mensaje = '';

//sesiones
if (!isset($_SESSION['cantidad'])) {
    $_SESSION['cantidad'] = 0;
}
if (!isset($_SESSION['precio'])) {
    $_SESSION['precio'] = 0;
}
if (!isset($_SESSION['filtro'])) {
    $_SESSION['filtro'] = '';
}



//creamos conexion
$conexion = new Conexion("root", "", "pasteleria");

//MUESTRA ANIMALES SEGÚN EL FILTRO SELECCIONADO
if (!isset($_POST['filtro'])) {
    $_POST['filtro'] = '';
    $_SESSION['filtro'] = '';

    $sql = "SELECT * FROM producto WHERE categoria = 'pastel'; ";


    $consulta = $conexion->conexion->prepare($sql);
    $consulta->execute();
    while ($fila = $consulta->fetch()) {


        //control del stock
        if ($fila['stock'] > 0) {
            $listaPasteles .= '<div class="card col-4 m-4" style="width: 18rem;">
            <div class="row">
            <span class="card-text col-6">Cantidad: ' . $fila['stock'] . '</span>
            <form class="col-6 " method="post">
                <input type="hidden" name="raza" value="' . $fila["nombre"] . '">
                <input type="hidden" name="precio" value="' . $fila["precio"] . '">
                <input type="submit" class="btn btn-secondary text-right" name="anadir" value="AÑADIR">
            </form>
            </div>
            <img src="img/' . $fila['img'] . '" width="100px" height="250px" class="card-img-top" alt="...">
            <div style="text-align:center" class="card-body">
            <h5 class="card-title">' . $fila['nombre'] . '</h5>
            <p class="card-text">Precio: ' . $fila['precio'] . ' €</p>

            
            
                </div>
            </div>';
        }
    }
}


//MIENTRAS HAYA ALGO SELECCIONADO EN EL FILTRO MOSTRARÁ LO SELECCIONADO
if (isset($_POST['filtro'])) {
    $_SESSION['filtro'] = $_POST['filtro'];


    if ($_SESSION['filtro'] == 'todos') {
        $sql = "SELECT * FROM producto WHERE categoria = 'pastel'; ";
    } else {
        $sql = "SELECT * FROM producto WHERE categoria = 'pastel' AND detalle = '" . $_SESSION['filtro'] . "'; ";
    }

    $consulta = $conexion->conexion->prepare($sql);
    $consulta->execute();
    while ($fila = $consulta->fetch()) {

        //Control del stock
        if ($fila['stock'] > 0) {


            $listaPasteles .= '<div class="card col-4 m-4" style="width: 18rem;">
            <div class="row">
            <span class="card-text col-6">Cantidad: ' . $fila['stock'] . '</span>
            <form class="col-6 " method="post">
                <input type="hidden" name="raza" value="' . $fila["nombre"] . '">
                <input type="hidden" name="precio" value="' . $fila["precio"] . '">
                <input type="submit" class="btn btn-secondary text-right" name="anadir" value="AÑADIR">
            </form>
            </div>
            <img src="img/' . $fila['img'] . '" width="100px" height="250px" class="card-img-top" alt="...">
            <div style="text-align:center" class="card-body">
            <h5 class="card-title">' . $fila['nombre'] . '</h5>
            <p class="card-text">Precio: ' . $fila['precio'] . ' €</p>

            
            
                </div>
            </div>';
        }
    }
}

//SI NO HAY PRODUCTOS
if ($listaPasteles == '') {
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
                echo '<div id="login2"><a href=""><i class="bi bi-cart2 iconHeader"></i></a></div>
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
                <?php
                if ($_SESSION['usuario'] != "") {
                    echo "<p><i class='bi bi-person-fill'></i>";

                    echo $_SESSION['usuario'];
                    echo "<p>";
                } else {
                    echo '<p><p>';
                }
                ?>
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
                    ?>
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

    <div class="mt4" id="contenidoPagina">
        <p class="text-center"><?php echo $mensaje; ?></p>

    </div>



    <form action="#" method="POST" class="row justify-content-center">
        <select class="form-select" style="width: 150px; margin-right: 10px;" name="filtro" id="filtro">
            <option value="todos" selected>TODOS</option>
            <option value="chocolate">CHOCOLATE</option>
            <option value="vainilla">VAINILLA</option>
            <option value="fresa">FRESA</option>
        </select>
        <input type="submit" class="btn btn-secondary" style="width: 150px;" value="FILTRAR" name="filtrar">
        </select>
    </form>


    <div id="contenedorTartas">
        <div class="container porSabor">




            <?php
            echo $listaPasteles;
            ?>

        </div>
    </div>





</body>


<footer>
    <span id="derechosReservados">Pastelería Cruz © 2023. Todos los derechos reservados</span>
    <div id="iconos1">
        <i class="bi bi-twitter iconito0"></i>&nbsp;&nbsp;
        <i class="bi bi-instagram iconito0"></i>
    </div>
</footer>

</html>