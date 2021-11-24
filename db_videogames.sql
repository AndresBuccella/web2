-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2021 a las 22:59:57
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_videogames`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `puntaje` double NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `comentario`, `puntaje`, `fk_usuario`, `fk_producto`) VALUES
(7, 'Primer comentario', 5, 26, 3),
(18, 'Ultimo comentario', 5, 26, 3),
(28, 'Gran juego', 5, 26, 85);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `genero` varchar(30) NOT NULL,
  `descripcion_genero` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `genero`, `descripcion_genero`) VALUES
(11, 'Disparos', 'Lorem disparos'),
(12, 'Peleas', 'Lorem peleas'),
(14, 'Aventura grafica', 'Lorem aventura grafica'),
(20, 'Didactico', 'Lorem didactico'),
(22, 'Musical', 'Lorem musical'),
(23, 'Ejercicio', 'Lorem ejercicio'),
(26, 'Deportes', 'Lorem deportes'),
(27, 'Carreras', 'Lorem carreras'),
(28, 'Juegos de mesa', 'Lorem juegos de mesa'),
(29, 'Juegos mecanicos', 'Lorem juegos mecanicos'),
(50, 'Accion', 'Lorem accion'),
(51, 'Estrategia', 'Lorem estrategia'),
(52, 'Hack and Slash', 'Lorem hack and slash'),
(53, 'Aventura', 'Lorem aventura'),
(54, 'Rol', 'Lorem rol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `precio` double NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `plataforma` varchar(30) DEFAULT NULL,
  `fk_id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `descripcion`, `plataforma`, `fk_id_genero`) VALUES
(3, 'Fifa 20', 70, 'Juego ', 'Ps4', 26),
(85, 'Grand Theft Auto V', 11, 'Mundo abierto', 'PC', 50),
(86, 'Halo Infinite', 60, 'Tiros y aliens', 'PC', 50),
(87, 'Battlefield 6', 60, 'Muchos tiros', 'PC', 50),
(88, 'UNO', 15, 'El clasico juego de cartas', 'PC', 28),
(89, 'Performous', 10, 'Juego de karaoke', 'PC', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `mail`, `clave`, `rol`) VALUES
(26, 'admin', 'admin@admin.com', '$2y$10$wssGBqZv8M028r7gXIM/veLjHQivycasg1S3ROLFOHD83zKx/d8o6', 2),
(32, 'noadmin', 'noadmin@noadmin.com', '$2y$10$IPkTehKX71BFhaggiBRwb.AiTqM7K.6Y/uzMW6CpyyOGT5QlvpeG.', 1),
(33, 'noadmin2', 'noadmin2@noadmin2.com', '$2y$10$mHPzlUEZhlTzJBg.v96uQeZkqqdLaQFOBuF.0zp4hadANLd.aH2kq', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_producto` (`fk_producto`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_id_genero` (`fk_id_genero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`fk_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`fk_id_genero`) REFERENCES `generos` (`id_genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
