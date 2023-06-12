<?php
session_start();
if ($_SESSION['usuario'] == "") {
    header('Location: index.php');
}

$mensaje = '';
$separador = '';


if (file_exists("compra.txt")) {
    unlink("compra.txt");
}



$mensaje = "¡GRACIAS POR REALIZAR SU COMPRA!";
//OBTENER TICKET TOTAL DE LA COMPRA

$nombreArchivo = 'ticket.txt'; // Reemplaza 'ticket.txt' con el nombre de tu archivo

// Leer el contenido del archivo
$contenido = file_get_contents($nombreArchivo);

// Convertir los saltos de línea en etiquetas <br>
$contenidoFormateado = nl2br($contenido);




if (isset($_POST['salir'])) {
    unlink("ticket.txt");

    header('Location: cerrarSesion.php');

}

if (isset($_POST['tienda'])) {
    unlink("ticket.txt");

    header('Location: tienda.php');

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
                echo "<form action='#' method='POST'>
                <input class='btn btn-dark' type='submit' value='TIENDA' name='tienda'></form>
                ";
                echo "<form style='padding-right:10%' action='#' method='POST'>
                <input class='btn btn-dark' type='submit' value='SALIR' name='salir'></form>
                ";
                echo  '</div>';
              
            } else {
                echo '<div id="login1"><a href="login.php"><i class="bi bi-person-circle iconHeader"></i></a></div>
                <div id="login2"><a href="login.php"></a></div>
                      <div id="login2"><a href="index.php"></i></a></div>
      
                  </div>';
            }

            ?>



            <h1>PASTELERÍA CRUZ</h1>

            <div id="usuario0">
                <p><i class="bi bi-person-fill"></i><?php echo $_SESSION['usuario']; ?>
                <p>
            </div>




        </section>
        <section id="menumenu">
            <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #f5f5f5;">
                
            </nav>
        </section>

    </header>

    <div class="container">
        <section>
            <span style="text-align:center; color:green; font-size: large; font-weight: bold;">COMPRA REALIZADA CON ÉXITO</span>
        </section>


        <div class="ticket">
            <?php
            echo $contenidoFormateado;
            ?>
        </div>
    </div>
    </div>