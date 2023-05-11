<?php
session_start();

//vacia sesiones
session_unset();
//cierra la sesion
session_destroy();



header("Location:index.php");
$prueba=0;
?>
