<?php
session_start();

//vacia sesiones
session_unset();
//cierra la sesion
session_destroy();

//Borrar fichero
unlink("compra.txt");

$_SESSION['idProductos'] = [];
$_SESSION['totalPersonalizada'] = 0;


echo '<script>location.href="index.php"</script>';

// header("Location:index.php");
$prueba=0;
?>
