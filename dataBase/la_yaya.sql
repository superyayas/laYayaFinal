-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2025 a las 18:18:14
-- Versión del servidor: 8.0.36
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `la_yaya`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoria` int NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_Categoria`, `Nombre`) VALUES
(3, 'Bebidas'),
(2, 'Carnes'),
(6, 'Harinas'),
(1, 'Lácteos'),
(5, 'Pescados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listacompra`
--

CREATE TABLE `listacompra` (
  `ID_Lista` int NOT NULL,
  `ID_Usuario` int NOT NULL,
  `NombreLista` varchar(100) NOT NULL,
  `FechaCreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `listacompra`
--

INSERT INTO `listacompra` (`ID_Lista`, `ID_Usuario`, `NombreLista`, `FechaCreacion`) VALUES
(1, 1, 'Compra semanal', '2025-03-13 17:55:33'),
(2, 2, 'Cena especial', '2025-03-13 17:55:33'),
(3, 3, 'Desayuno saludable', '2025-03-13 17:55:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listaproductos`
--

CREATE TABLE `listaproductos` (
  `ID_Lista` int NOT NULL,
  `ID_Producto` int NOT NULL,
  `Cantidad` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `listaproductos`
--

INSERT INTO `listaproductos` (`ID_Lista`, `ID_Producto`, `Cantidad`) VALUES
(1, 1, 2),
(1, 3, 1),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precioproducto`
--

CREATE TABLE `precioproducto` (
  `ID_Precio` int NOT NULL,
  `ID_Producto` int NOT NULL,
  `ID_Supermercado` int NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_Usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `precioproducto`
--

INSERT INTO `precioproducto` (`ID_Precio`, `ID_Producto`, `ID_Supermercado`, `Precio`, `FechaRegistro`, `ID_Usuario`) VALUES
(3, 2, 1, 5.50, '2025-03-13 17:55:29', 3),
(4, 3, 3, 2.00, '2025-03-13 17:55:29', 1),
(5, 7, 7, 6.00, '2025-05-25 09:12:00', 1),
(6, 8, 7, 1.20, '2025-05-25 09:31:14', 1),
(21, 25, 7, 3.00, '2025-05-26 16:01:19', 1),
(22, 25, 1, 1.50, '2025-05-26 16:01:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_Producto` int NOT NULL,
  `NombreProducto` varchar(100) NOT NULL,
  `Descripcion` text,
  `ID_Categoria` int NOT NULL,
  `Marca` varchar(50) DEFAULT NULL,
  `Imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_Producto`, `NombreProducto`, `Descripcion`, `ID_Categoria`, `Marca`, `Imagen`) VALUES
(1, 'Leche Entera', 'Leche entera 1L', 1, 'Marca A', NULL),
(2, 'Pechuga de Pollo', 'Pechuga de pollo fresca', 2, 'Marca B', NULL),
(3, 'Coca-Cola 2L', 'Refresco de cola 2 litros', 3, 'Coca-Cola', NULL),
(4, 'Nata', 'nata', 1, 'Asturiana', NULL),
(7, 'yougur', 'gcgfh', 1, 'Asturiana', NULL),
(8, 'Leche', 'aa', 1, 'Hacendadp', 'leche.png'),
(25, 'Leche Desnatada', 'Prueba1', 1, 'Asturiana', 'leche.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supermercado`
--

CREATE TABLE `supermercado` (
  `ID_Supermercado` int NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Ciudad` varchar(50) NOT NULL,
  `Pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `supermercado`
--

INSERT INTO `supermercado` (`ID_Supermercado`, `Nombre`, `Direccion`, `Ciudad`, `Pais`) VALUES
(1, 'Supermercado A', 'Calle 123', 'Madrid', 'España'),
(2, 'Supermercado B', 'Avenida Principal 45', 'Barcelona', 'España'),
(3, 'Supermercado C', 'Plaza Mayor 7', 'Valencia', 'España'),
(7, 'Mercadona', 'San Isidro', 'aa', 'Madrid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `CorreoElectronico` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `FechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Rol` enum('Admin','Usuario','Moderador') DEFAULT 'Usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre`, `Apellidos`, `Usuario`, `CorreoElectronico`, `contrasena`, `FechaRegistro`, `Rol`) VALUES
(1, 'Carlos', 'López', 'carloslopez', 'carlos.lopez@email.com', '***', '2025-03-13 17:52:52', 'Usuario'),
(2, 'Ana', 'Martínez', 'anamartinez', 'ana.martinez@email.com', '***', '2025-03-13 17:52:52', 'Usuario'),
(3, 'Pedro', 'Gómez', 'pedrogomez', 'pedro.gomez@email.com', '***', '2025-03-13 17:52:52', 'Usuario'),
(9, 'admin', 'admin', 'admin', 'ass@f.com', '$2y$10$9vs.Nb2JODfh/XlQ5GTJDeyfRgFuSriRnYNI8sq2QkRYkahYlEo3G', '2025-04-30 10:57:12', 'Usuario'),
(11, 'Abraham', 'díaz', 'abraham-diaz', 'bla@bla.com', '$2y$10$D1e0ZW1xWRzEcFKvWWnIZuam9I5m3Nsac/AP6W9yJjmPx2Xh1O0Qa', '2025-05-01 09:52:06', 'Usuario'),
(13, 'Abraham', 'díaz', 'user', 'abraham.diaz.ahijon98@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '2025-05-01 10:17:56', 'Usuario'),
(17, 'Prueba', 'prueba', 'prueba1', 'prueba@prueba', '$2y$10$eam5Cvd573TsZhfrCVg.sO214V2EHQzKiavSgoZscOE0iaEyr.7Iy', '2025-05-02 09:34:48', 'Usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoria`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `listacompra`
--
ALTER TABLE `listacompra`
  ADD PRIMARY KEY (`ID_Lista`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `listaproductos`
--
ALTER TABLE `listaproductos`
  ADD PRIMARY KEY (`ID_Lista`,`ID_Producto`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `precioproducto`
--
ALTER TABLE `precioproducto`
  ADD PRIMARY KEY (`ID_Precio`),
  ADD UNIQUE KEY `unique_precio_por_producto` (`ID_Producto`,`ID_Supermercado`,`Precio`,`ID_Usuario`),
  ADD UNIQUE KEY `ID_Producto` (`ID_Producto`,`ID_Supermercado`,`FechaRegistro`),
  ADD KEY `ID_Supermercado` (`ID_Supermercado`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `ID_Categoria` (`ID_Categoria`);

--
-- Indices de la tabla `supermercado`
--
ALTER TABLE `supermercado`
  ADD PRIMARY KEY (`ID_Supermercado`),
  ADD UNIQUE KEY `uq_super_direccion` (`Direccion`),
  ADD UNIQUE KEY `uq_super_unico` (`Nombre`,`Ciudad`,`Pais`,`Direccion`(191));

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Usuario` (`Usuario`),
  ADD UNIQUE KEY `CorreoElectronico` (`CorreoElectronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `listacompra`
--
ALTER TABLE `listacompra`
  MODIFY `ID_Lista` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `precioproducto`
--
ALTER TABLE `precioproducto`
  MODIFY `ID_Precio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `supermercado`
--
ALTER TABLE `supermercado`
  MODIFY `ID_Supermercado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listacompra`
--
ALTER TABLE `listacompra`
  ADD CONSTRAINT `listacompra_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `listaproductos`
--
ALTER TABLE `listaproductos`
  ADD CONSTRAINT `listaproductos_ibfk_1` FOREIGN KEY (`ID_Lista`) REFERENCES `listacompra` (`ID_Lista`),
  ADD CONSTRAINT `listaproductos_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`);

--
-- Filtros para la tabla `precioproducto`
--
ALTER TABLE `precioproducto`
  ADD CONSTRAINT `precioproducto_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`),
  ADD CONSTRAINT `precioproducto_ibfk_2` FOREIGN KEY (`ID_Supermercado`) REFERENCES `supermercado` (`ID_Supermercado`),
  ADD CONSTRAINT `precioproducto_ibfk_3` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria` (`ID_Categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
