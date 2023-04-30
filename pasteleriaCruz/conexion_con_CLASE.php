<?php

//Una clase creada solo para la conexion
    class Conexion{
        public $conexion;

        function __construct($user,$pwd,$bd=""){
            
            try{
                //construir la conexion
                $dsn = "mysql:host=localhost;dbname=$bd";

                //le damos valores a la conexion
                $this->conexion= new PDO($dsn,$user,$pwd);
                //le crea un atributo de errores y excepciones
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "<h1>Ok la conexión</h1>";


            } catch (PDOException $e) {
                //ideal personalizar el msj
                echo "Error ". $e->getMessage();
                $this->conexion=null;
            }
        }
    }
?>