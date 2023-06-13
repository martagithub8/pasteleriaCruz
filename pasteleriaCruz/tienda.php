<?php
session_start();
include "conexion_con_CLASE.php";
if ($_SESSION['usuario'] == "") {
  header('Location: index.php');
}


//creamos conexion
$conexion = new Conexion("root", "", "pasteleria");
//COMPROBACIÓN USUARIO
$sql = "SELECT * FROM usuarios WHERE usuario = '" . $_SESSION['usuario'] . "'; ";

      $consulta = $conexion->conexion->prepare($sql);
      $consulta->execute();
      while ($fila = $consulta->fetch()) {
        $_SESSION['tipo'] = $fila['tipo'];
      }

if ($_SESSION['tipo'] == "") {
  header('Location: index.php');
}


//variables


//sesiones
if (!isset($_SESSION['tipo'])) {
  $_SESSION['tipo'] = '';
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


      


      if ($_SESSION['tipo'] == "administrador") {
        echo '<div id="login2"><a href="cesta.php"><i class="bi bi-cart2 iconHeader"></i></a></div>
                
                <div  id="login2"><a href="" data-bs-toggle="modal" data-bs-target="#modalLogin"><i class="bi bi-gear iconHeader"></i></a></div>
<div id="login2"><a href="cerrarSesion.php"><i class="bi bi-box-arrow-left iconHeader"></i></a></div>
                </div>';
      } else if ($_SESSION['tipo'] == "cliente") {
        echo '<div id="login2"><a href="cesta.php"><i class="bi bi-cart2 iconHeader"></i></a></div>
        <div id="login2"><a href="cerrarSesion.php"><i class="bi bi-box-arrow-left iconHeader"></i></a></div>

        </div>';
      } else if ($_SESSION['tipo'] == "") {
        echo '<div id="login1"><a href="login.php"><i class="bi bi-person-circle iconHeader"></i></a></div>
                <div id="login2"><a href="login.php"></a></div>
                      <div id="login2"><a href="index.php"></i></a></div>
      
                  </div>';
      }

      ?>

      </div>



      <h1>PASTELERÍA CRUZ</h1>

      <div id="usuario0">
        <p><i class="bi bi-person-fill"></i><?php echo $_SESSION['usuario']; ?>
        <p>
      </div>




    </section>

    <section id="menumenu">
      <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #f5f5f5;">
        <div class="container-fluid">
          <?php
          if ($_SESSION['usuario'] != "") {
            echo '<a class="navbar-brand margin1" href="tienda.php">INICIO</a>';
          } else {
            echo '<a class="navbar-brand margin1" href="index.php">INICIO</a>';
          }
          ?>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item margin">
                <a class="nav-link active" aria-current="page" href="informacion.php">DISEÑA</a>
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



  <div id="contenedorNoticias">
  <div id="noticia1">
            <p class="negrita">CATÁLOGO TARTAS </p>
            <div id="imagenn">
                <img src="img/oferta0.jpg" alt="esfera" width="380" height="370">
            </div>
            <div class="texto">
                <p class="sinNegrita" style="text-align: justify;"><strong> Ya ha llegado la hora de disfrutar con los tuyos de nuestras tartas artesanas.</strong><br> Esperamos que os guste probarlas tanto como a nosotras elaborarlas.</p>
                <a class="consultar" href="tarta.php">CONSULTAR</a>
            </div>

        </div>
        <div id="noticia1">
            <p class="negrita">PERSONALIZA TU TARTA</p>
            <div id="imagenn">
                <img src="img/tarta.jpg" alt="esfera" width="380" height="370">
            </div>
            <div class="texto">
            <p class="sinNegrita" style="text-align: justify;"><strong>¿Quieres una tarta personalizada?</strong><br> Prueba con nosotras a seleccionar los sabores y la decoración a tu gusto. Accede y personaliza una tarta. </p>                <a class="consultar" href="informacion.php">CONSULTAR</a>
            </div>

        </div>

    <div id="noticia2">
      <p class="negrita">CATÁLOGO PASTELES </p>
      <div id="imagenn">
        <img src="img/pastel10.png" alt="esfera" width="380" height="370">
      </div>
      <div class="texto">
      <p class="sinNegrita" style="text-align: justify;"><strong> ¡Disfrutar con tus seres queridos de nuestros exquisitos pasteles artesanales! </strong><br> Los pasteles son una deliciosa opción para cualquier ocasión especial.</p>
        <a class="consultar" href="pasteles.php">CONSULTAR</a>
      </div>
    </div>




  </div>


  <div class="modal fade" id="modalLogin" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <a href="adminProduct.php" class=" btn btn-primary btn-block col-12" role="button">
              <i class="bi bi-gear"> ADMINISTRAR PRODUCTOS </i>
          </a>
        </div>
        <div class="modal-header">
          <a href="adminUsu.php" class=" btn btn-primary btn-block col-12" role="button">
            <i class="bi bi-person-fill-gear"> ADMINISTRAR USUARIO </i>
          </a>
        </div>


      </div>
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