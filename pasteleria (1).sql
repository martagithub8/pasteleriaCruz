-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2023 a las 00:24:01
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pasteleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `base`
--

CREATE TABLE `base` (
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `base`
--

INSERT INTO `base` (`nombre`) VALUES
('chocolate'),
('chocolateBlanco'),
('fresa'),
('nata'),
('queso'),
('vainilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(50) NOT NULL,
  `producto_fk` int(25) NOT NULL,
  `tarta_personalizada_fk` int(25) NOT NULL,
  `precio` double NOT NULL,
  `fecha` date NOT NULL,
  `usuario_fk` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `decoracion`
--

CREATE TABLE `decoracion` (
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `decoracion`
--

INSERT INTO `decoracion` (`nombre`) VALUES
('chocolate'),
('chocolateBlanco'),
('felicitacion'),
('fresa'),
('kinderBueno'),
('mermelada'),
('mickey'),
('mini'),
('nata'),
('olaf'),
('oreo'),
('pokemon'),
('queso'),
('superMario'),
('vainilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `detalle` varchar(25) NOT NULL,
  `precio` double NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `img`, `nombre`, `categoria`, `detalle`, `precio`, `stock`) VALUES
(1, 'pastel4.png', 'Barco de chocolate', 'pastel', 'chocolate', 2, 5),
(2, 'pastel19.png', 'Donuts de azucar', 'pastel', 'azucar', 2, 5),
(3, 'pastel6.png', 'Barco relleno de chocolat', 'pastel', 'chocolate', 2, 5),
(4, 'pastel8.png', 'Barco de crema', 'pastel', 'crema', 2, 20),
(5, 'pastel9.png', 'Cono de vainilla', 'pastel', 'vainilla', 2, 20),
(6, 'pastel10.png', 'Pastel de fresa', 'pastel', 'fresa', 2.5, 20),
(7, 'pastel11.png', 'Palmera de huevo', 'pastel', 'huevo', 2.5, 20),
(8, 'pastel12.png', 'Barco de dulce de leche', 'pastel', 'dulce de leche', 2.5, 20),
(9, 'pastel13.png', 'Donuts de fresa', 'pastel', 'fresa', 2, 20),
(10, 'pastel2.png', 'Donuts de chocolate', 'pastel', 'chocolate', 2, 20),
(11, 'pastel14.png', 'Macarons de nata', 'pastel', 'nata', 2, 20),
(12, 'pastel15.png', 'Palo de nata', 'pastel', 'nata', 2, 20),
(13, 'pastel16.png', 'Croissant', 'pastel', 'mantequilla', 2, 20),
(14, 'pastel17.png', 'Crepes', 'pastel', 'otro', 5, 20),
(15, 'pastel18.png', 'Macarons (5uds.)', 'pastel', 'variado', 3, 20),
(16, 'pastel5.png', 'Palmera de chocolate', 'pastel', 'chocolate', 2.5, 20),
(17, 'pastel20.png', 'Cake pops (9uds.)', 'pastel', 'variado', 5.5, 20),
(18, 'pastel1.png', 'Caña de chocolate', 'pastel', 'chocolate', 2, 20),
(19, 'tarta6.png', 'Brownie', 'tarta', 'chocolate', 30, 5),
(20, 'tarta7.png', 'Chocolate y Nueces', 'tarta', 'chocolate', 30, 5),
(21, 'tarta8.png', 'Fresa y Nata', 'tarta', 'fresa', 30, 5),
(22, 'tarta9.png', 'Fresa y Queso', 'tarta', 'fresa', 30, 20),
(23, 'tarta10.png', 'Tarta de Fresa ', 'tarta', 'fresa', 30, 20),
(24, 'tarta11.png', 'Nata y Chocolate', 'tarta', 'Nata', 30, 20),
(25, 'tarta12.png', 'Nata y Vainilla', 'tarta', 'Nata', 30, 20),
(26, 'tarta13.png', 'Tarta de Almendras', 'tarta', 'Almendras', 30, 20),
(27, 'tarta14.png', 'Tarta de Zanahoria', 'tarta', 'Zanahoria', 30, 20),
(28, 'tarta15.png', 'San Marco', 'tarta', 'otro', 30, 20),
(29, 'tarta16.png', 'Tarta de Queso', 'tarta', 'Queso', 30, 20),
(30, 'tarta17.png', 'Tarta de Zanahoria', 'tarta', 'Zanahoria', 30, 20),
(31, 'tarta18.png', 'Red Velvet', 'tarta', 'otro', 30, 20),
(32, 'tarta19.png', 'San Marco', 'tarta', 'otro', 30, 20),
(33, 'tarta20.png', 'Queso y Fresa', 'tarta', 'fresa', 30, 20),
(34, 'tarta2.png', '3 chocolates con adorno ', 'tarta', 'chocolate', 30, 20),
(35, 'tarta4.png', '3 chocolates con virutas', 'tarta', 'chocolate', 30, 20),
(36, 'tarta5.png', 'Selva Negra', 'tarta', 'chocolate', 30, 20),
(37, 'tarta21.png', 'Queso y Fresa con adorno', 'tarta', 'fresa', 30, 20),
(38, 'tarta1.png', '3 chocolates con virutas', 'tarta', 'chocolate', 30, 20),
(39, 'tarta3.png', 'Tarta Ballantines', 'tarta', 'chocolate', 30, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relleno`
--

CREATE TABLE `relleno` (
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `relleno`
--

INSERT INTO `relleno` (`nombre`) VALUES
('chocolate'),
('chocolateBlanco'),
('fresa'),
('kinderBueno'),
('nata'),
('oreo'),
('queso'),
('vainilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarta_personalizada`
--

CREATE TABLE `tarta_personalizada` (
  `id` int(50) NOT NULL,
  `base_fk` varchar(25) NOT NULL,
  `relleno_fk` varchar(25) NOT NULL,
  `decoracion_fk` varchar(25) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(50) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `usuario`, `password`, `tipo`) VALUES
(1, 'Marta', 'marta@gmail.com', 'marta0', 'c23499dba1407c74aaa8c17386a6d6f9', 'cliente'),
(2, 'Usuario', 'usuario@gmail.com', 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', 'cliente'),
(3, 'admin', 'admin@gmail.com', 'admin0', '62f04a011fbb80030bb0a13701c20b41', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_fk` (`producto_fk`),
  ADD KEY `tarta_personalizada_fk` (`tarta_personalizada_fk`),
  ADD KEY `usuario_fk` (`usuario_fk`);

--
-- Indices de la tabla `decoracion`
--
ALTER TABLE `decoracion`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `relleno`
--
ALTER TABLE `relleno`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `tarta_personalizada`
--
ALTER TABLE `tarta_personalizada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `base_fk` (`base_fk`),
  ADD KEY `relleno_fk` (`relleno_fk`),
  ADD KEY `decoracion_fk` (`decoracion_fk`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `tarta_personalizada`
--
ALTER TABLE `tarta_personalizada`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`producto_fk`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`tarta_personalizada_fk`) REFERENCES `tarta_personalizada` (`id`),
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tarta_personalizada`
--
ALTER TABLE `tarta_personalizada`
  ADD CONSTRAINT `tarta_personalizada_ibfk_1` FOREIGN KEY (`base_fk`) REFERENCES `base` (`nombre`),
  ADD CONSTRAINT `tarta_personalizada_ibfk_2` FOREIGN KEY (`relleno_fk`) REFERENCES `relleno` (`nombre`),
  ADD CONSTRAINT `tarta_personalizada_ibfk_3` FOREIGN KEY (`decoracion_fk`) REFERENCES `decoracion` (`nombre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
