-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2021 a las 22:38:53
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
(9, 'Arcade', 'Lorem arcade'),
(10, 'Plataforma', 'Lorem plataforma'),
(11, 'Disparos', 'Lorem disparos'),
(12, 'Peleas', 'Lorem peleas'),
(13, 'Aventura conversacional', 'Lorem aventura conversacional'),
(14, 'Aventura grafica', 'Lorem aventura grafica'),
(16, 'Rol', 'Lorem rol'),
(17, 'Aventura de accion', 'Lorem aventura de accion'),
(18, 'Puzzle', 'Lorem puzzle'),
(19, 'Puzle de bloques', 'Lorem puzle de bloques'),
(20, 'Didactico', 'Lorem didactico'),
(21, 'Preguntas', 'Lorem preguntas'),
(22, 'Musical', 'Lorem musical'),
(23, 'Ejercicio', 'Lorem ejercicio'),
(24, 'Estrategia', 'Lorem estrategia'),
(25, 'Simulacion', 'Lorem simulacion'),
(26, 'Deportes', 'Lorem deportes'),
(27, 'Carreras', 'Lorem carreras'),
(28, 'Juegos de mesa', 'Lorem juegos de mesa'),
(29, 'Juegos mecanicos', 'Lorem juegos mecanicos'),
(32, 'Video interactivo', 'Lorem video interactivo');

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
(1, 'PacMan', 5, 'El clasico', 'Family', 9),
(2, 'Galaga', 5, 'El clasico', 'PC', 9),
(3, 'Fifa 21', 60, 'Juego de futbol', 'PC', 26),
(4, 'NBA 2K21', 60, 'Juego de basquet', 'PC', 26),
(5, 'Minecraft', 30, 'Juego de rol en el que podes construir', 'PC', 16),
(6, 'Dark Souls', 20, 'Si te gustan los desafios, este es tu juego', 'PC', 16),
(9, 'Dragon Ball FighterZ', 47, '', 'PC', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `clave` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `mail`, `clave`) VALUES
(26, 'admin', 'admin@admin.com', '$2y$10$wssGBqZv8M028r7gXIM/veLjHQivycasg1S3ROLFOHD83zKx/d8o6');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`fk_id_genero`) REFERENCES `generos` (`id_genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
