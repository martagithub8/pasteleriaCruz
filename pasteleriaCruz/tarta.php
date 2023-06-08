<?php
session_start();
include "conexion_con_CLASE.php";

//variables
$listaTartas = "";
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

//MUESTRA PRODUCTOS SEGÚN EL FILTRO SELECCIONADO
if (!isset($_POST['filtro'])) {
  $_POST['filtro'] = '';
  $_SESSION['filtro'] = '';

  $sql = "SELECT * FROM producto WHERE categoria = 'tarta'; ";


  $consulta = $conexion->conexion->prepare($sql);
  $consulta->execute();
  while ($fila = $consulta->fetch()) {


    //control del stock
    if ($fila['stock'] > 0) {

      if ($_SESSION['usuario'] != "") {
        $listaTartas .= '<div class="card col-4 m-4" style="width: 18rem;border:none; box-shadow:8px 1px 10px grey">
      <div class="row">
      <form class="col-6 " method="post">
        <input type="hidden" name="nombre" value="' . $fila["nombre"] . '">
        <input type="hidden" name="precio" value="' . $fila["precio"] . '">
        <input style=" background-color: #FFA07A; border-radius:5px" class="btn" type="submit" type="submit"  name="anadir" value="AÑADIR">
    </form>
      <span class="card-text col-6">stock: ' . $fila['stock'] . '</span>
     
      </div>
      <img src="img/' . $fila['img'] . '" width="100px" height="250px" class="card-img-top" alt="...">
      <div style="text-align:center" class="card-body">
      <h5 class="card-title">' . $fila['nombre'] . '</h5>
      <p class="card-text">Precio: ' . $fila['precio'] . ' €</p>

      
      
          </div>
      </div>';
      } else {
        $listaTartas .= '<div class="card col-4 m-4" style="width: 18rem;border:none; box-shadow:8px 1px 10px grey">
        <div class="row">
  
        <span class="card-text col-6">stock: ' . $fila['stock'] . '</span>
       
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
}


//MIENTRAS HAYA ALGO SELECCIONADO EN EL FILTRO MOSTRARÁ LO SELECCIONADO
if (isset($_POST['filtro'])) {
  $_SESSION['filtro'] = $_POST['filtro'];


  if ($_SESSION['filtro'] == 'todos') {
    $sql = "SELECT * FROM producto WHERE categoria = 'tarta'; ";
  } else {
    $sql = "SELECT * FROM producto WHERE categoria = 'tarta' AND detalle = '" . $_SESSION['filtro'] . "'; ";
  }

  $consulta = $conexion->conexion->prepare($sql);
  $consulta->execute();
  while ($fila = $consulta->fetch()) {

    //Control del stock
    if ($fila['stock'] > 0) {


      if ($_SESSION['usuario'] != "") {
        $listaTartas .= '<div class="card col-4 m-4" style="width: 18rem;border:none; box-shadow:8px 1px 10px grey">
      <div class="row">
      <form class="col-6 " method="post">
        <input type="hidden" name="nombre" value="' . $fila["nombre"] . '">
        <input type="hidden" name="precio" value="' . $fila["precio"] . '">
        <input style=" background-color: #FFA07A; border-radius:5px" class="btn" type="submit" type="submit"  name="anadir" value="AÑADIR">
    </form>
      <span class="card-text col-6">stock: ' . $fila['stock'] . '</span>
     
      </div>
      <img src="img/' . $fila['img'] . '" width="100px" height="250px" class="card-img-top" alt="...">
      <div style="text-align:center" class="card-body">
      <h5 class="card-title">' . $fila['nombre'] . '</h5>
      <p class="card-text">Precio: ' . $fila['precio'] . ' €</p>

      
      
          </div>
      </div>';
      } else {
        $listaTartas .= '<div class="card col-4 m-4" style="width: 18rem;border:none; box-shadow:8px 1px 10px grey">
        <div class="row">
  
        <span class="card-text col-6">stock: ' . $fila['stock'] . '</span>
       
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
}


//MIENTRAS SE PULSE EL BOTÓN AÑADIR
if (isset($_POST['anadir'])) {
  //Guardamos datos fundamentales PRODUCTO. PRECIO. CANTIDAD. Para realizar el añadir a la cesta
  $nombre = $_POST['nombre'];
  $precio = $_POST['precio'];



  //Si no existe el fichero
  if (!file_exists("compra.txt")) {
    //lo creamos y añadimos el primer elemento a la compra.txt
    $fichero = fopen('compra.txt', 'a');
    fwrite($fichero, $nombre . '-' . $precio . '-' . $cantidadPorDefecto . "\n");
    fclose($fichero);
    $_SESSION['cantidad'] = 1;
    // $_SESSION['precio']=$precio;



  } else {
    //comprueba si ya hay alguna producto para que no se repitan y simplemente aumente la cantidad            
    $existeNombre = false;


    //VER SI EXISTE LA PRODUCTO O NO. PONER BOOLEANO A TRUE O FALSE. Y GUARDAR LA CANTIDAD PARA LUEGO ACTUALIZARLA.
    //r de lectura para solo leer fichero. puntero al inicio del fichero
    $fichero = fopen('compra.txt', 'r');
    //bucle para recorrer ficheros de php
    //SIMPLEMENTE PARA VER SI PRODUCTO EXISTE O NO
    while (!feof($fichero)) {
      //guardamos en variable cada linea
      $linea = fgets($fichero);
      if ($linea != '') {
        //linea lo separaremos con ese split
        $separador = explode('-', $linea);
        //si ya hay una nombre de ese tipo
        if ($separador[0] == $nombre) {
          //ponemos el booleano a true
          $existeNombre = true;

          //tomar la cantidad actual en una variable normal para luego aplicar el intval
          $cantidad = $separador[2];
          // $precio=$separador[1];


        }
      }
    }
    fclose($fichero);

    //para convertir una variable en un entero
    $_SESSION['cantidad'] = intval($cantidad);
    // $_SESSION['precio']=intval($precio);



    //COMPROBAR BOOLEANO. 
    //SI TRUE: COGER CANTIDAD Y MODIFICAR.
    //SI FALSE: AÑADIR NUEVA LINEA CON ESA PRODUCTO + CANTIDAD 1

    //NO HAY NINGUNA PRODUCTO COMO LA ACTUALMENTE SELECCIONADA EN EL FICHERO COMPRA.TXT
    if ($existeNombre == false) {
      $fichero = fopen('compra.txt', 'a');
      fwrite($fichero, $nombre . '-' . $precio . '-' . $cantidadPorDefecto . "\n");
      fclose($fichero);
    }

    //YA EXISTE UNA PRODUCTO DE ESE TIPO EN EL FICHERO
    if ($existeNombre == true) {
      //COMPROBAR STOCK. MUY IMPORTANTE.
      $sql = "SELECT nombre, stock FROM producto WHERE nombre='" . $nombre . "'; ";

      $consulta = $conexion->conexion->prepare($sql);
      $consulta->execute();
      while ($fila = $consulta->fetch()) {

        $stockBD = $fila['stock'];
      }



      //AQUÍ PARTE DE ACTUALIZAR CANTIDAD
      $contenidoFichero = "";
      //linea que añadiremos al final del fichero
      $cantidadActualizada = "";

      //AQUÍ VA LA CANTIDAD TOTAL
      $_SESSION['cantidad']++;
      //AQUÍ VA EL PRECIO TOTAL;
      $_SESSION['precio'] = $_SESSION['cantidad'] * $precio;


      //COMPROBAR STOCK
      if ($_SESSION['cantidad'] > $stockBD) {
        $mensaje = "PRODUCTO AGOTADO.";
      } else {
        //SI AÚN HAY STOCK
        $fichero = fopen('compra.txt', 'r');
        while (!feof($fichero)) {
          //guardamos en variable cada linea
          $linea = fgets($fichero);
          if ($linea != '') {
            //linea lo separaremos con ese split
            $separador = explode('-', $linea);

            //SI ESTAMOS EN LA LÍNEA DE LA PRODUCTO.
            if ($separador[0] == $nombre) {
              //MODIFICAMOS CANTIDAD Y PRECIO.
              $cantidadActualizada = $nombre . '-' . $_SESSION['precio'] . '-' . $_SESSION['cantidad'] . "\n";
            } else {
              $contenidoFichero .= $linea;
            }
          }
        }

        $contenidoFichero .= $cantidadActualizada;
        fclose($fichero);


        //abrimos de nuevo fichero
        $fichero = fopen('compra.txt', 'w');
        //actualizamos contenido introduciendo el nuevo string completo
        fwrite($fichero, $contenidoFichero);
        //cerramos el fichero
        fclose($fichero);


        //establecemos a 0 cantidad y precio para próximo producto que se añada a la cesta
        $_SESSION['cantidad'] = 0;
        $_SESSION['precio'] = 0;
      }
    }
  }
}



//SI NO HAY PRODUCTOS
if ($listaTartas == '') {
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
          ?>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

  <div class="mt4" id="contenidoPagina">
    <p class="text-center"><?php echo $mensaje; ?></p>

  </div>




  <form action="#" method="POST" class="row justify-content-center">
    <select class="form-select" style="width: 150px; margin-right: 10px;" name="filtro" id="filtro">
    <option value="todos">todos</option>
    <?php
      $sql = "SELECT * FROM base ; ";
  
    $consulta = $conexion->conexion->prepare($sql);
    $consulta->execute();
    while ($fila = $consulta->fetch()) {
      echo '<option value="'.$fila["nombre"].'" selected>'.$fila["nombre"].'</option>';

    }
    ?>

    </select>
    <input type="submit" class="btn btn-dark" style="width: 150px;" value="FILTRAR" name="filtrar">
    </select>
  </form>

  <div id="contenedorTartas">
    <div class="container porSabor">




      <?php
      echo $listaTartas;
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