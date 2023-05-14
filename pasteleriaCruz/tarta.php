<?php
session_start();
include "conexion_con_CLASE.php";

//creamos conexion
$conexion = new Conexion("root", "", "pasteleria");


//sesiones
if (!isset($_SESSION['usuario'])) {
  $_SESSION['usuario'] = '';
}

if (!isset($_SESSION['cantidad'])) {
  $_SESSION['cantidad'] = 0;
}
if (!isset($_SESSION['precio'])) {
  $_SESSION['precio'] = 0;
}
if (!isset($_SESSION['filtro'])) {
  $_SESSION['filtro'] = '';
}

//variables
$listaTartas="";
$filtro='';
$raza='';
$precio=0;
$cantidadPorDefecto=1;
$cantidad=0;
$stockBD=0;
$mensaje='';




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
      echo '<div id="login">
                <div id="login1"><a href=""><i class="bi bi-person-circle iconHeader"></i></a></div>';

      if ($_SESSION['usuario'] != "") {
        echo '<div id="login2"><a href=""><i class="bi bi-cart2 iconHeader"></i></a></div>
                <div id="login2"><a href="cerrarSesion.php"><i class="bi bi-box-arrow-left iconHeader"></i></a></div>
    
                </div>';
      } else {
        echo '<div id="login2"><a href=""></a></div>
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

  <form style="margin-top: 2%;" action="#" method="POST" class="row justify-content-center">
    <select class="form-select" style="width: 150px; margin-right: 10px;" name="filtro" id="filtro">
      <option value="todos" selected>TODOS</option>
      <option value="perro">CHOCOLATE</option>
      <option value="gato">FRESA</option>
      <option value="cobaya">NATA</option>
    </select>
    <input type="submit" class="btn btn-success" style="width: 150px;" value="FILTRAR" name="filtrar">
    </select>
  </form>

  <div id="contenedorTartas">

    <div class="container porSabor">
      <?php
      for ($i = 0; $i < 9; $i++) {
        echo '<div class="card col-4 m-4" style="width: 23rem;">
              <img src="img/queso (1).png" alt="esfera" width="320" height="320">
              <div class="card-body">
              <h5 class="card-title">TARTA DE FRESA</h5>
              <p class="card-text">Informacion sobre la tarta</p>
              <p class="card-text">Stock: 0</p>
              <p class="card-text">Precio: 30€ €</p>
              <form  method="post">
                  <input type="hidden" name="raza" value="raza">
                  <input type="hidden" name="precio" value="precio">';
        if ($_SESSION['usuario'] != "") {
          echo ' <input type="submit" class="btn btn-success" name="anadir" value="AÑADIR">';
        }

        echo '</form>
                  </div>
              </div>';
      }
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