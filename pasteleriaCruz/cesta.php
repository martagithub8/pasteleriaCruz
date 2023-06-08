<?php
session_start();
include "conexion_con_CLASE.php";

//crear una conexión de la clase conexión importada
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

$mensajeUsuario = "";
$mensajePassword = "";
$usuario = "";
$mensaje = '';

  //VARIABLES
  $total=0;
  $contenidoCesta=false;
  $cantidadProducto=0;
  $producto='';
  $productosComprados='';
  $fecha_actual = date('d-m-Y H:i:s');
  $mensaje='';
  $mensajeTotal='';
  $contenidoFichero='';
  $productoTabla='';
  $precioTabla=0;
  $cantidadTabla=0; 
  $filasTabla='';



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
  if(!isset($_SESSION['total'])){
    $_SESSION['total']=0;
}

if(!isset($_SESSION['producto'])){
    $_SESSION['producto']='';
}
if(!isset($_SESSION['cantidadProducto'])){
    $_SESSION['cantidadProducto']=0;
}

if(!isset($_SESSION['productosComprados'])){
    $_SESSION['productosComprados']='';
}






    //COMPROBAR SI COMPRA.TXT EXISTE O NO
    if(!file_exists("compra.txt")){
        $mensaje="SU CESTA ESTÁ VACÍA";
        $contenidoCesta=false;

    }else{
        $contenidoCesta=true;

        //MOSTRAR CESTA
      //guardar en variables las líneas del fichero y hacer el select a la bd
    //   $contenidoFichero = "";
    //   $fichero=fopen('compra.txt','r');

    //   while (!feof($fichero)) {
    //          $linea=fgets($fichero);
    //         if($linea!=''){
    //             //linea lo separaremos con ese split                
    //                 $contenidoFichero.="<br>".$linea;
                 
    //         }
    //     }
    //     fclose($fichero);
       


        //OBTENER PRECIO TOTAL DE LA COMPRA
        $fichero=fopen('compra.txt','r');
             
             while (!feof($fichero)) {
                 $linea=fgets($fichero);
                 if($linea!=''){
                     //linea lo separaremos con ese split
                    $separador=explode('-',$linea);
                        $total+=$separador[1];  
                        $productoTabla=$separador[0];
                        $precioTabla=$separador[1];
                        $cantidadTabla=$separador[2];   
                        $filasTabla.="<tr>
                                        <th scope='row'>$productoTabla</th>
                                        <td>$precioTabla</td>
                                        <td>$cantidadTabla</td>
                                        </tr> ";
                         
                                                   
                 }
             }
            fclose($fichero);

            //para convertir una variable en un entero
            $_SESSION['total']=intval($total);


    }


 


    //MIENTRAS SE PULSE EL BOTÓN ticket
        if (isset($_POST['ticket'])) {

            //COMPROBAR SI LA CESTA TIENE CONTENIDO O NO
            if($contenidoCesta==true){
               
                //OBTENER PRODUCTOS DEL COMPRADOR Y ACTUALIZARLOS EN LA BD
                    $fichero=fopen('compra.txt','r');
                    
                    while (!feof($fichero)) {
                        $linea=fgets($fichero);
                        if($linea!=''){
                            //linea lo separaremos con ese split
                        $separador=explode('-',$linea);

                            $producto=$separador[0];  
                            $cantidadProducto= $separador[2];   
                            $_SESSION['producto']=$producto;
                            $_SESSION['cantidadProducto']=intval($cantidadProducto);

                            //ACTUALIZAR BD
                            $sql = "UPDATE producto SET stock = stock - ".$_SESSION['cantidadProducto']." WHERE nombre = '".$_SESSION['producto']."'";

                            $consulta = $conexion->conexion->prepare($sql);            
                            $consulta->execute();
                        }
                    }

                            //REALIZAMOS EL REGISTRO

                            //PRIMERO SE LEE COMPRA.TXT PARA GUARDAR LOS PRODUCTOS EN UN STRING
                            $fichero=fopen('compra.txt','r');
                         
                            while (!feof($fichero)) {
                                $linea=fgets($fichero);
                                if($linea!=''){
                                    //linea lo separaremos con ese split
                                   $separador=explode('-',$linea);
                                       $total+=$separador[1];  
                                       $productoTabla=$separador[0];
                                       $precioTabla=$separador[1];
                                       $cantidadTabla=$separador[2];   
                                       $contenidoTicket.= "Producto: $productoTabla - $precioTabla €. Cant: $cantidadTabla\n ";
                                                      
                                        
                                                                  
                                }
                            }
                           fclose($fichero);
               
                           //para convertir una variable en un entero
                        //   $_SESSION['total']=intval($total);

                                //AHORA creamos registro. Si ya existe lo añade el nuevo al final de la linea.
                                // Si el fichero existe se conserva el contenido, si no existe se crea uno nuevo. El puntero se sitúa al final del fichero
                                $fichero=fopen('registro.txt','a');
                                fwrite($fichero,'Cliente: '.$_SESSION['usuario']."\n \n".$contenidoTicket."\n" .'Total: '.$_SESSION['total'].'€'."\n".$fecha_actual."\n\n ------------------------ \n");
                                fclose($fichero);

                                $fichero=fopen('ticket.txt','w');
                                fwrite($fichero,'Cliente: '.$_SESSION['usuario']."\n \n".$contenidoTicket."\n" .'Total: '.$_SESSION['total'].'€'."\n".$fecha_actual."\n\n ------------------------ \n");
                                fclose($fichero);
                               
                 //UNA VEZ REALIZADA LA COMPRA ELIMINAMOS EL TXT.COMPRA/ LA CESTA         
                unlink("compra.txt");
                //ELIMINAMOS TAMBIÉN EL CÁLCULO DEL PRECIO TOTAL
                $_SESSION['total']=0;


                //REDIRIGIMOS A LA PÁGINA DEL PAGO
                //aqui va ticket.php
                   header("Location:ticket.php");
 
            }else{
                //EN CASO DE NO EXISTIR NADA EN LA CESTA
                $mensaje="SU CESTA ESTÁ VACÍA";
            }
        }

        

        //MIENTRAS SE PULSE EL BOTÓN VACIAR CESTA
          if (isset($_POST['vaciar'])) {
           
            //si no hay nada avisa que cesta está vacía. Si hay contenido la vacía
            if(file_exists("compra.txt")){
                unlink("compra.txt");
                $_SESSION['total']=0;
                header("Location:tienda.php");
            }else{
                $mensaje="SU CESTA ESTÁ VACÍA";
                $_SESSION['total']=0;

            }
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
    <section  id="cabecera">

    <?php
            echo '<div id="login">';
                

            if ($_SESSION['usuario'] != "") {
                echo '<div id="login2"><a href="tienda.php"><i class="bi bi-house iconHeader"></i></a></div>
                <div id="login2"><a href="cerrarSesion.php"><i class="bi bi-box-arrow-left iconHeader"></i></a></div>
    
                </div>';
            } else if ($_SESSION['usuario'] == ""){
                echo '<div id="login1"><a href="login.php"><i class="bi bi-person-circle iconHeader"></i></a></div>
                <div id="login2"><a href="login.php"></a></div>
                      <div id="login2"><a href="index.php"></i></a></div>
      
                  </div>';
            } 

            ?>

  
  
  <h1>PASTELERÍA CRUZ</h1>

  <div id="usuario">
    <p><i class="bi bi-person-fill"></i><?php echo $_SESSION['usuario'];?><p>
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


   
    <div class="mt4 container-fluid" id="contenidoPagina">
          
          <p><?php echo $contenidoFichero; ?></p>

            <p class="text-center"><?php echo $mensaje; ?></p>

          <!-- TABLA CON CONTENIDO CESTA    -->
          <table class="table">
            <thead>
                <tr>
                <th scope="col">PRODUCTO</th>
                <th scope="col">PRECIO</th>
                <th scope="col">CANTIDAD</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                echo $filasTabla;
                ?>
                
            </tbody>
            </table>



            <p style="font-weight:bold"><?php echo "EL TOTAL ES: ".$_SESSION['total']; ?>€</p>


            <form action="#" method="POST">
        <input class="btn btn-success" type="submit" value="ticket" name="ticket">
        <input class="btn btn-danger" type="submit" value="VACIAR CESTA" name="vaciar">

            </form>

          </div>



</body>


<!-- <footer>
    <span id="derechosReservados">Pastelería Cruz © 2023. Todos los derechos reservados</span>
    <div id="iconos1">
        <i class="bi bi-twitter iconito0"></i>&nbsp;&nbsp;
        <i class="bi bi-instagram iconito0"></i>
    </div>
</footer> -->

</html>
