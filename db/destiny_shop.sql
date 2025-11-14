-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2025 a las 18:32:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `destiny_shop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `Tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `Nombre`, `Tipo`) VALUES
(1, 'Remeras', 'Ropa'),
(2, 'Buzos', 'Ropa'),
(3, 'Pantalones', 'Ropa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id_envio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Marca` varchar(30) DEFAULT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `Nombre`, `Precio`, `Marca`, `Imagen`, `id_categoria`) VALUES
(1, 'Jean baggy gris', 1000.00, NULL, 'img/ropa/jean_gris.jpeg', 3),
(2, 'Jean dragon', 1200.00, '', 'img/ropa/jean_dragon.jpeg', 3),
(3, 'Remera mariposa', 500.00, '', 'img/ropa/remera_maripo.jpeg', 1),
(4, 'Buzo Gris', 1000.00, '', 'img/ropa/buzo_gris.jpg', 2),
(5, 'Buzo Mariposa', 900.00, '', 'img/ropa/buzo_maripo.jpg', 2),
(6, 'Buzo Negro', 750.00, '', 'img/ropa/buzo_negro.jpeg', 2),
(7, 'Remera Azul', 300.00, '', 'img/ropa/remera_azul.jpeg', 1),
(8, 'Remera Shadow', 250.00, '', 'img/ropa/remera_shadow.jpeg', 1),
(9, 'Jean blanco', 1200.00, '', 'img/ropa/jean_blanco.jpeg', 3),
(52, 'Remera bordo con araña', 350.00, '', 'img/ropa/remera_bordo.jpg', 1),
(53, 'Buzo bordo', 800.00, '', 'img/ropa/buzo_bordo.jpg', 2),
(54, 'Jean con partes rojizas', 1450.00, '', 'img/ropa/jean_rojo.jpg', 3),
(55, 'Buzo celeste', 1100.00, '', 'img/ropa/buzo_celeste.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_producto_talle`
--

CREATE TABLE `stock_producto_talle` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_talle` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock_producto_talle`
--

INSERT INTO `stock_producto_talle` (`id`, `id_producto`, `id_talle`, `stock`) VALUES
(1, 1, 5, 12),
(2, 1, 6, 15),
(3, 1, 7, 10),
(4, 1, 8, 9),
(5, 2, 5, 8),
(6, 2, 6, 6),
(7, 2, 7, 2),
(8, 2, 8, 10),
(9, 3, 1, 10),
(10, 3, 2, 5),
(11, 3, 3, 11),
(12, 3, 4, 7),
(13, 4, 1, 5),
(14, 4, 2, 10),
(15, 4, 3, 15),
(16, 4, 4, 20),
(17, 5, 1, 2),
(18, 5, 2, 9),
(19, 5, 3, 12),
(20, 5, 4, 7),
(21, 7, 1, 1),
(22, 7, 2, 2),
(23, 7, 3, 1),
(24, 7, 4, 3),
(25, 52, 1, 3),
(26, 52, 2, 10),
(27, 52, 3, 8),
(28, 52, 4, 5),
(29, 53, 1, 5),
(30, 53, 2, 12),
(31, 53, 3, 6),
(32, 53, 4, 8),
(33, 54, 5, 5),
(34, 54, 6, 9),
(35, 54, 7, 6),
(36, 54, 8, 2),
(37, 55, 1, 5),
(38, 55, 2, 8),
(39, 55, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talles`
--

CREATE TABLE `talles` (
  `id_talle` int(11) NOT NULL,
  `talle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `talles`
--

INSERT INTO `talles` (`id_talle`, `talle`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, '38'),
(6, '40'),
(7, '42'),
(8, '44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasenia` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `es_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `contrasenia`, `fecha_nacimiento`, `es_admin`) VALUES
(1, 'Sofia', 'Araya', 'arayasofia265@gmail.com', '$2y$10$tOgSuN.YE5uq0u/UHPfu9.vMsiowRJ3f3SBhiDh.9IieMjH24Rjsa', '2007-03-05', 0),
(2, 'Sofia', 'Araya', 'segiss0503@gmail.com', '$2y$10$4MfAA5XkEVh2WJLHvo3R8eCn0WQIVnQ.1wq963LFfY/q2rlQP/.Dq', '2006-06-15', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id_envio`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `stock_producto_talle`
--
ALTER TABLE `stock_producto_talle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_talle` (`id_talle`);

--
-- Indices de la tabla `talles`
--
ALTER TABLE `talles`
  ADD PRIMARY KEY (`id_talle`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `stock_producto_talle`
--
ALTER TABLE `stock_producto_talle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `talles`
--
ALTER TABLE `talles`
  MODIFY `id_talle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `cargo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `envio_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `stock_producto_talle`
--
ALTER TABLE `stock_producto_talle`
  ADD CONSTRAINT `stock_producto_talle_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_producto_talle_ibfk_2` FOREIGN KEY (`id_talle`) REFERENCES `talles` (`id_talle`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
