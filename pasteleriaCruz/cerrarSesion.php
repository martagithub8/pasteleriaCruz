<?php
session_start();

//vacia sesiones
session_unset();
//cierra la sesion
session_destroy();

//Borrar fichero
unlink("compra.txt");



header("Location:index.php");
$prueba=0;
?>
