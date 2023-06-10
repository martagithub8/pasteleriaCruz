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
        tipo varchar(40) NOT NULL,
        PRIMARY KEY(id)
    );

    create table compra(
        id int(50) NOT NULL AUTO_INCREMENT,
        producto_fk int(25) NOT NULL,
        tarta_personalizada_fk int(25) NOT NULL,
        precio double NOT NULL,
        fecha date NOT NULL,
        usuario_fk int(50) NOT NULL,
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

    ALTER TABLE compra
    ADD FOREIGN KEY (usuario_fk) REFERENCES usuarios(id);

    ALTER TABLE tarta_personalizada
    ADD FOREIGN KEY (base_fk) REFERENCES base(nombre);

    ALTER TABLE tarta_personalizada
    ADD FOREIGN KEY (relleno_fk) REFERENCES relleno(nombre);

    ALTER TABLE tarta_personalizada
    ADD FOREIGN KEY (decoracion_fk) REFERENCES decoracion(nombre);
    
    INSERT INTO usuarios(nombre, correo, usuario, password, tipo) VALUES ('Marta', 'marta@gmail.com', 'marta0','c23499dba1407c74aaa8c17386a6d6f9', 'cliente');
    INSERT INTO usuarios(nombre, correo, usuario, password, tipo) VALUES ('Usuario', 'usuario@gmail.com', 'usuario','f8032d5cae3de20fcec887f395ec9a6a', 'cliente');
    INSERT INTO usuarios(nombre, correo, usuario, password, tipo) VALUES ('admin', 'admin@gmail.com', 'admin0','62f04a011fbb80030bb0a13701c20b41', 'administrador');

INSERT INTO base(nombre) VALUES ('chocolate');
INSERT INTO base(nombre) VALUES ('chocolateBlanco');
INSERT INTO base(nombre) VALUES ('fresa');
INSERT INTO base(nombre) VALUES ('nata');
INSERT INTO base(nombre) VALUES ('queso');


INSERT INTO relleno(nombre) VALUES ('chocolate');
INSERT INTO relleno(nombre) VALUES ('chocolateBlanco');
INSERT INTO relleno(nombre) VALUES ('fresa');
INSERT INTO relleno(nombre) VALUES ('vainilla');
INSERT INTO relleno(nombre) VALUES ('limon');
INSERT INTO relleno(nombre) VALUES ('nata');
INSERT INTO relleno(nombre) VALUES ('kinderBueno');
INSERT INTO relleno(nombre) VALUES ('oreo');
INSERT INTO relleno(nombre) VALUES ('queso');

INSERT INTO decoracion(nombre) VALUES ('mermelada');
INSERT INTO decoracion(nombre) VALUES ('chocolate');
INSERT INTO decoracion(nombre) VALUES ('chocolateBlanco');
INSERT INTO decoracion(nombre) VALUES ('fresa');
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

INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel4.png', 'Barco de chocolate', 'pastel','chocolate', 2, 5);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel19.png', 'Donuts de azucar', 'pastel','azucar', 2, 5);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel6.png', 'Barco relleno de chocolate', 'pastel','chocolate', 2 ,5);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel8.png', 'Barco de crema', 'pastel','crema', 2,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel9.png', 'Cono de vainilla', 'pastel','vainilla', 2,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel10.png', 'Pastel de fresa', 'pastel','fresa', 2.5,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel11.png', 'Palmera de huevo', 'pastel','huevo', 2.5,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel12.png', 'Barco de dulce de leche', 'pastel','dulce de leche', 2.5,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel13.png', 'Donuts de fresa', 'pastel','fresa', 2,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel2.png', 'Donuts de chocolate', 'pastel','chocolate', 2,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel14.png', 'Macarons de nata', 'pastel','nata', 2,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel15.png', 'Palo de nata', 'pastel','nata', 2,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel16.png', 'Croissant', 'pastel','mantequilla', 2,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel17.png', 'Crepes', 'pastel','otro', 5 ,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel18.png', 'Macarons (5uds.)', 'pastel','variado', 3,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel5.png', 'Palmera de chocolate', 'pastel','chocolate', 2.5,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel20.png', 'Cake pops (9uds.)', 'pastel','variado', 5.5,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('pastel1.png', 'Caña de chocolate', 'pastel','chocolate', 2,20);

INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta6.png', 'Brownie', 'tarta','chocolate', 30,5);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta7.png', 'Chocolate y Nueces', 'tarta','chocolate', 30,5);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta8.png', 'Fresa y Nata', 'tarta','fresa', 30,5);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta9.png', 'Fresa y Queso', 'tarta','fresa', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta10.png', 'Tarta de Fresa ', 'tarta','fresa', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta11.png', 'Nata y Chocolate', 'tarta','Nata', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta12.png', 'Nata y Vainilla', 'tarta','Nata', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta13.png', 'Tarta de Almendras', 'tarta','Almendras', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta14.png', 'Tarta de Zanahoria', 'tarta','Zanahoria', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta15.png', 'San Marco', 'tarta','otro', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta16.png', 'Tarta de Queso', 'tarta','Queso', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta17.png', 'Tarta de Zanahoria', 'tarta','Zanahoria', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta18.png', 'Red Velvet', 'tarta','otro', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta19.png', 'San Marco', 'tarta','otro', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta20.png', 'Queso y Fresa', 'tarta','fresa', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta2.png', '3 chocolates con adorno ', 'tarta','chocolate', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta4.png', '3 chocolates con virutas', 'tarta','chocolate', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta5.png', 'Selva Negra', 'tarta','chocolate', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta21.png', 'Queso y Fresa con adorno', 'tarta','fresa', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta1.png', '3 chocolates con virutas', 'tarta','chocolate', 30,20);
INSERT INTO producto(img, nombre, categoria, detalle, precio, stock) VALUES ('tarta3.png', 'Tarta Ballantines', 'tarta','chocolate', 30,20);



";

$con->conexion->exec($sql);
echo "<h1>Insertado con éxito</h1>";
