<?php
session_start();

//vacia sesiones
session_unset();
//cierra la sesion
session_destroy();

unlink("compra.txt");



header("Location:index.php");
$prueba=0;
?>
