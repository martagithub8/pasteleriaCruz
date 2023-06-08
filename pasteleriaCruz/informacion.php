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
    if ($base != '0' && $relleno != '0' && $decoracion != '0') {

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

            <div id="usuario0">
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

    <section id="cajaGlobal">
        <div class="container">
            <h1 style="color:black">Bienvenidos a Pastelería Cruz</h1>

            <div class="image">
                <img src="img/bg4.jpg" alt="Pastel" width="400">

            </div>

            <div class="description">
                <p>En nuestra pastelería, ofrecemos una amplia variedad de deliciosas tartas y pasteles, elaborados con
                    pasión y cuidado por nuestra talentosa pastelera, Nuria.</p>
                <p>Nuria es una apasionada de la repostería y dedica su tiempo y creatividad para crear auténticas obras de
                    arte. Cada tarta y pastel que sale de nuestra pastelería es único y está hecho con ingredientes
                    frescos y de la más alta calidad.</p>
                <p>Nuestra misión es endulzar los momentos especiales de nuestros clientes. Ya sea para celebrar un cumpleaños,
                    una boda o simplemente para darse un capricho, nuestras creaciones están diseñadas para deleitar el paladar
                    y hacer que cada ocasión sea inolvidable.</p>
            </div>

            <div class="image">
                <img src="img/bg.jpg" alt="Tarta" width="400">

            </div>

            <div class="description">
                <p>En nuestra pastelería, podrás encontrar una amplia variedad de sabores y diseños en nuestras tartas y pasteles.
                    Desde clásicos como la tarta de chocolate o el pastel de fresa, hasta creaciones más originales.</p>
                <p>Estamos comprometidos con la satisfacción de nuestros clientes y nos esforzamos por brindar un servicio excepcional.
                    Puedes confiar en nosotros para que tu experiencia en nuestra pastelería sea simplemente deliciosa.</p>
            </div>
            <div class="contact">
        <h2>Contacto</h2>
        <p>¡Estamos encantados de atenderte! Puedes contactarnos a través de los siguientes medios:</p>
        <ul>
            <li><i class="bi bi-telephone"></i> Teléfono: <a href="tel: 698772334"> 698772334</a></li>
            <li><i class="bi bi-envelope"></i> Email: <a href="mailto:info@pasteleriacruz.com">info@pasteleriacruz.com</a></li>
            <li><i class="bi bi-geo-alt"></i> Dirección: Calle Arboleda, 123, 41000 Sevilla</li>
        </ul>
    </div>
        </div>


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
            selectColores[i].classList = classColorOption;
        }
    }
</script>