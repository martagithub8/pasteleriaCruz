<?php
class Conexion
{
    public $conexion;


    function __construct($user, $pwd, $bd = "")
    {


        try {
            //construir la conexion
            $dsn = "mysql:host=localhost;dbname=$bd";

            //le damos valores a la conexion
            $this->conexion = new PDO($dsn, $user, $pwd);
            //le crea un atributo de errores y excepciones
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<h1>Ok la conexión</h1>";
        } catch (PDOException $e) {
            //ideal personalizar el mensaje
            echo "Error " . $e->getMessage();
            $this->conexion = null;
        }
    }
}

class Basededatos extends Conexion
{

    function __construct($user, $pwd, $bd)
    {


        //ahora al llamar al constructor del parent se hace un new de la clase parent con su propiedad conexion
        parent::__construct($user, $pwd);
        //creamos la bd
        $sql = "CREATE DATABASE $bd";
        try {
            //aquí usamos conexion que es propiedad de la clase conexion donde ya hay una conexion validada
            //y ahora ya hacemos el exec
            $this->conexion->exec($sql);
            echo "BASE DE DATOS CREADA";
        } catch (PDOException $error) {
            echo "<h1>" . $error->getMessage() . "</h1>";
        }
    }
}

$bd = new Basededatos("root", "", "pasteleria");
$con = new Conexion("root", "", "pasteleria");


$sql =
    "
    create table usuarios(
        id int(50) NOT NULL AUTO_INCREMENT,
        nombre varchar(40) NOT NULL,
        correo varchar(40) NOT NULL,
        usuario varchar(25) NOT NULL,
        password varchar(40) NOT NULL,
        PRIMARY KEY(id)
    );

    create table compra(
        id int(50) NOT NULL AUTO_INCREMENT,
        producto_fk int(25) NOT NULL,
        tarta_personalizada_fk int(25) NOT NULL,
        precio double NOT NULL,
        fecha date NOT NULL,
        PRIMARY KEY(id)  
    );
    
    create table producto(
        id int(50) NOT NULL AUTO_INCREMENT,
        img varchar(100) NOT NULL,
        nombre varchar(25) NOT NULL,
        categoria varchar(25) NOT NULL,
        detalle varchar(25) NOT NULL,
        precio double NOT NULL,
        stock int(100) NOT NULL,
        PRIMARY KEY(id)
    );

    create table tarta_personalizada(
        id int(50) NOT NULL AUTO_INCREMENT,
        base_fk varchar(25) NOT NULL,
        relleno_fk varchar(25) NOT NULL,
        decoracion_fk varchar(25) NOT NULL,
        precio double NOT NULL,
        PRIMARY KEY(id)
    );

    create table base(
        nombre varchar(50) NOT NULL,
        PRIMARY KEY(nombre)
    );

    create table relleno(
        nombre varchar(50) NOT NULL,
        PRIMARY KEY(nombre)
    );

    create table decoracion(
        nombre varchar(50) NOT NULL,
        PRIMARY KEY(nombre)
    );
    
    
    
    ALTER TABLE compra
    ADD FOREIGN KEY (producto_fk) REFERENCES producto(id);

    ALTER TABLE compra
    ADD FOREIGN KEY (tarta_personalizada_fk) REFERENCES tarta_personalizada(id);

    ALTER TABLE tarta_personalizada
    ADD FOREIGN KEY (base_fk) REFERENCES base(nombre);

    ALTER TABLE tarta_personalizada
    ADD FOREIGN KEY (relleno_fk) REFERENCES relleno(nombre);

    ALTER TABLE tarta_personalizada
    ADD FOREIGN KEY (decoracion_fk) REFERENCES decoracion(nombre);
    
    INSERT INTO usuarios(nombre, correo, usuario, password) VALUES ('Marta', 'marta@gmail.com', 'marta0','c23499dba1407c74aaa8c17386a6d6f9');
    INSERT INTO usuarios(nombre, correo, usuario, password) VALUES ('Usuario', 'usuario@gmail.com', 'usuario','f8032d5cae3de20fcec887f395ec9a6a');

INSERT INTO base(nombre) VALUES ('chocolate');
INSERT INTO base(nombre) VALUES ('chocolateBlanco');
INSERT INTO base(nombre) VALUES ('fresa');
INSERT INTO base(nombre) VALUES ('vainilla');
INSERT INTO base(nombre) VALUES ('nata');
INSERT INTO base(nombre) VALUES ('queso');


INSERT INTO relleno(nombre) VALUES ('chocolate');
INSERT INTO relleno(nombre) VALUES ('chocolateBlanco');
INSERT INTO relleno(nombre) VALUES ('fresa');
INSERT INTO relleno(nombre) VALUES ('vainilla');
INSERT INTO relleno(nombre) VALUES ('nata');
INSERT INTO relleno(nombre) VALUES ('kinderBueno');
INSERT INTO relleno(nombre) VALUES ('oreo');
INSERT INTO relleno(nombre) VALUES ('queso');

INSERT INTO decoracion(nombre) VALUES ('mermelada');
INSERT INTO decoracion(nombre) VALUES ('chocolate');
INSERT INTO decoracion(nombre) VALUES ('chocolateBlanco');
INSERT INTO decoracion(nombre) VALUES ('fresa');
INSERT INTO decoracion(nombre) VALUES ('vainilla');
INSERT INTO decoracion(nombre) VALUES ('nata');
INSERT INTO decoracion(nombre) VALUES ('kinderBueno');
INSERT INTO decoracion(nombre) VALUES ('oreo');
INSERT INTO decoracion(nombre) VALUES ('queso');
INSERT INTO decoracion(nombre) VALUES ('felicitacion');
INSERT INTO decoracion(nombre) VALUES ('olaf');
INSERT INTO decoracion(nombre) VALUES ('superMario');
INSERT INTO decoracion(nombre) VALUES ('pokemon');
INSERT INTO decoracion(nombre) VALUES ('mickey');
INSERT INTO decoracion(nombre) VALUES ('mini');


INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel1.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel2.png', 'Pastel', 'pastel','vainilla', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel3.png', 'Pastel', 'pastel','chocolate', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel4.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel5.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel6.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel7.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel8.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel9.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel10.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel11.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel12.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel13.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel14.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel15.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel16.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel17.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel18.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel19.png', 'Pastel', 'pastel','fresa', '3€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel20.png', 'Pastel', 'pastel','fresa', '3€','5');

INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta1.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta2.png', 'Tarta', 'tarta','fresa', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta3.png', 'Tarta', 'tarta','vainilla', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta4.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta5.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta6.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta7.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta8.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta9.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta10.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta11.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta12.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta13.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta14.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta15.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta16.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta17.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta18.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta19.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta20.png', 'Tarta', 'tarta','chocolate', '30€','5');
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta21.png', 'Tarta', 'tarta','chocolate', '30€','5');

    ";

$con->conexion->exec($sql);
echo "<h1>Insertado con éxito</h1>";
