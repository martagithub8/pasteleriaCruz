<?php
    session_start();
    include "conexion_con_CLASE.php";

    //sesiones
    if(!isset($_SESSION['usuario'])){
        $_SESSION['usuario']='';
    }
  

    
    //creamos conexion
    $conexion = new Conexion("root","","pasteleria");
   
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
  <section  id="cabecera">

            <?php
            echo '<div id="login">
                <div id="login1"><a href=""><i class="bi bi-person-circle iconHeader"></i></a></div>';

            if ($_SESSION['usuario'] != "") {
                echo '<div id="login2"><a href=""><i class="bi bi-cart2 iconHeader"></i></a></div>
                <div id="login2"><a href="cerrarSesion.php"><i class="bi bi-box-arrow-left iconHeader"></i></a></div>
    
                </div>';
            }else{
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
                    
                 echo $_SESSION['usuario']; echo "<p>";
                }else{
                    echo '<p><p>';

                }
                ?>
            </div>


   

  </section>
    <section id="menumenu" >
      <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #f5f5f5;">
        <div class="container-fluid">
          <?php
          
          echo '<a class="navbar-brand margin1"'; 
          if ($_SESSION['usuario'] != "") {
            echo 'href="tienda.php"';

          }else{
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


  <div id="contenedorTartas" >

    <div class="container porSabor" style="background-color:  #FFA07A;">
            <?php
            for ($i=0; $i < 9; $i++) { 
                echo '<div id="tarta1">
                <img src="img/3chocolates.png" alt="esfera" width="380" height="370">
                <div class="datos">
                  <p class="sinNegrita" >TARTA 3 CHOCOLATES </p>
                  <p class="negrita" >35€ </p>';

                  if ($_SESSION['usuario'] != "") {
                    echo '<input type="submit" value="AÑADIR" class="botonAnadir">';
                }

                echo '</div></div> ';
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
