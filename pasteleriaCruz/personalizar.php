<?php
session_start();
include "conexion_con_CLASE.php";

//sesiones
if (!isset($_SESSION['usuario'])) {
    $_SESSION['usuario'] = '';
}

if (!isset($_SESSION['tartaPersonalizada'])) {
    $_SESSION['tartaPersonalizada'] = [];
}

//variable array donde metemos valor del select
$tartaPersonalizada = [];

//si existe lo guarda en variavel para luego comprobar q sea distinto de seleccione color
if (isset($_POST['base'])) {
    $base = $_POST['base'];
}

if (isset($_POST['relleno'])) {
    $relleno = $_POST['relleno'];
}

if (isset($_POST['decoracion'])) {
    $decoracion = $_POST['decoracion'];
}






//creamos conexion
$conexion = new Conexion("root", "", "pasteleria");

//PROGRAMACIÓN
if (isset($_POST['encargo'])) {
//el problema está aquí
$problem;
    if ($base != '0' && $relleno != '0' && $decoracion != '0' ) {

        array_push($tartaPersonalizada, $base);
        array_push($tartaPersonalizada, $relleno);
        array_push($tartaPersonalizada, $decoracion);
        //si hay intentos . Controlamos si introduce repetidos
        //creamos sesion

        $_SESSION['tartaPersonalizada'] = $tartaPersonalizada;
        
        guardarString();
    } else {
        $error = "NO PUEDE INTRODUCIR COLORES REPETIDOS.";
        $_SESSION['error'] = true;
    }
}





//FUNCIONES
function guardarString()
{

    // $contenidoFichero=implode('-',$_SESSION['coloresUsuario']);
    // $fichero=fopen('partida.txt','a');
    // //actualizamos contenido introduciendo el nuevo string completo
    // fwrite($fichero,$contenidoFichero."\n");
    // fclose($fichero);
    // _________________________________________________________________
    $contenidoFichero = '';
    //podria guardarlo en el fichero igual q lo muestro abajo en div Intentos
    $fichero = fopen('tartapersonalizada.txt', 'a');

    for ($i = 0; $i < count($_SESSION['tartapersonalizada']); $i++) {
        // echo '<div class="'.$_SESSION['coloresUsuario'][$i].'"></div>';
        $contenidoFichero .= '<div class="' . $_SESSION['tartapersonalizada'][$i] . '"></div>';
    }

    fwrite($fichero, $_SESSION['tartapersonalizada'] . "\n");
    fclose($fichero);
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
                echo '<div id="login2"><a href="cesta.php"><i class="bi bi-cart2 iconHeader"></i></a></div>
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
            <div class="container">



                <div class=" mt4" style="text-align: center;" id="editarCuenta">
                    <h3 style="color: #7D5A48;">COMENZAR PERSONALIZACIÓN </h3><br><br>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="row justify-content-center">
                        <span>SELECCIONE BASE</span>
                        <select onchange="cambiarColor()" name="base" class="form-select" aria-label="Default select example" style="font-weight: bold;color: #7D5A48;border: 1px #7D5A48 solid;">
                            <option class="contenido" value="0">BASE</option>

                            <?php

                            $sql = "SELECT * FROM base ; ";

                            $consulta = $conexion->conexion->prepare($sql);
                            $consulta->execute();
                            while ($fila = $consulta->fetch()) {
                                echo '<option class="'.$fila["nombre"].'" value="' . $fila["nombre"] . '" selected>' . $fila["nombre"] . '</option>';
                            }
                            ?>
                        </select><br><br>
                        <span>SELECCIONE RELLENO</span>
                        <select onchange="cambiarColor()" name="relleno" class="form-select" aria-label="Default select example" style="font-weight: bold;color: #7D5A48;border: 1px #7D5A48 solid;">
                            <option class="contenido" value="0">RELLENO</option>

                            <?php
                            $sql = "SELECT * FROM relleno ; ";

                            $consulta = $conexion->conexion->prepare($sql);
                            $consulta->execute();
                            while ($fila = $consulta->fetch()) {
                                echo '<option class="'.$fila["nombre"].'" value="' . $fila["nombre"] . '" selected>' . $fila["nombre"] . '</option>';
                            }
                            ?>
                        </select><br><br>
                        <span>SELECCIONE DECORACIÓN</span>
                        <select onchange="cambiarColor()" name="decoracion" style="font-weight: bold;color: #7D5A48;border: 1px #7D5A48 solid;" class="form-select" aria-label="Default select example">
                            <option class="contenido" value="0">DECORACIÓN</option>

                            <?php
                            $sql = "SELECT * FROM decoracion ; ";

                            $consulta = $conexion->conexion->prepare($sql);
                            $consulta->execute();
                            while ($fila = $consulta->fetch()) {
                                echo '<option class="'.$fila["nombre"].'" value="' . $fila["nombre"] . '" selected>' . $fila["nombre"] . '</option>';
                            }
                            ?>
                        </select>
                        <br><br>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px;border: 1px #7D5A48 solid;"></textarea>
                            <label for="floatingTextarea2" style="font-weight: bold;color: #7D5A48;">Añadir detalle:</label>

                        </div>

                        <input style="margin-bottom: 3%;" type="submit" value="REALIZAR PERSONALIZACIÓN" class="botonAnadir" name="encargo">

                    </form>
                </div>

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
<script>

//no se puede detectar el select sobre el q estamos actuando por tanto guardamos todos los select en una variable
//el q esté seleccionado modificará a su correspondiente select
function cambiarColor() {
    var selectColores = document.getElementsByTagName("select");
    for (let i = 0; i < selectColores.length; i++) {
      //obtenemos el option seleccionado
      var option = selectColores[i].options[selectColores[i].selectedIndex];
      //con esto obtenemos la clase del option marcado
      var classColorOption = option.classList;
      //añadimos la clase del option al select.
      selectColores[i].classList=classColorOption;
    }
}

  



</script>