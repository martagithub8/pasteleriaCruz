<?php
session_start();
include "conexion_con_CLASE.php";
if ($_SESSION['usuario'] == "") {
  header('Location: index.php');
}

//variables


//sesiones




//creamos conexion
$conexion = new Conexion("root", "", "pasteleria");






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



  <div id="contenedorNoticias">
        <div id="noticia1">
            <p class="negrita">OFERTA</p>
            <div id="imagenn">
                <img src="img/oferta0.jpg" alt="esfera" width="380" height="370">
            </div>
            <div class="texto">
                <p class="sinNegrita" style="text-align: justify;"> <strong>¿Aún no conoces nuestra oferta?</strong><br> Por la compra de una de nuestras tartas personalizadas llévese una de nuestro catálogo gratis.</p>
                <a class="consultar" href="oferta.php">CONSULTAR</a>
            </div>

        </div>

        <div id="noticia1">
            <p class="negrita">CATÁLOGO TARTAS </p>
            <div id="imagenn">
                <img src="img/chocoo.png" alt="esfera" width="380" height="370">
            </div>
            <div class="texto">
                <p class="sinNegrita" style="text-align: justify;"><strong> Ya ha llegado la hora de disfrutar con los tuyos de nuestras tartas artesanas.</strong><br> Esperamos que os guste probarlas tanto como a nosotras elaborarlas.</p>
                <a class="consultar" href="tarta.php">CONSULTAR</a>
            </div>

        </div>

        <div id="noticia2">
            <p class="negrita">PERSONALIZA TU TARTA </p>
            <div id="imagenn">
                <img src="img/tarta.jpg" alt="esfera" width="380" height="370">
            </div>
            <div class="texto">
                <p class="sinNegrita" style="text-align: justify;"><strong>¿Quieres una tarta personalizada?</strong><br> Prueba con nosotras a seleccionar los sabores y la decoración a tu gusto. Además podrá disfrutar de la oferta 2x1.</p>
                <a class="consultar" href="personalizar.php">CONSULTAR</a>
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