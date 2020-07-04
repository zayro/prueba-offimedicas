-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-07-2020 a las 02:49:11
-- Versión del servidor: 8.0.16
-- Versión de PHP: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `offimedicas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_familiar`
--

CREATE TABLE `grupo_familiar` (
  `id_grupo_familiar` int(11) NOT NULL,
  `nombres` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `parentesco` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `identificacion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `grupo_familiar`
--

INSERT INTO `grupo_familiar` (`id_grupo_familiar`, `nombres`, `apellidos`, `edad`, `parentesco`, `identificacion`, `id_usuario`) VALUES
(6, 'Stalin', '34grrr', 4, 'ertert', '345345', 22),
(7, 'dfgdfg', '34edg', 4, 'ert', '32', 22),
(9, 'ok', 'uevo', 34, 'qweqw', '23', 22),
(20, 'fghfgh', '456h', 54, 'rtyrty', '1000', 31),
(26, 'dfgdfg', 'dfgd', 435, 'dfgdfg', '1008', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(20) NOT NULL,
  `usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `identificacion` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nombres` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `identificacion`, `nombres`, `apellidos`, `email`) VALUES
(21, 'pepe', '$2y$10$YVEnUMG2nFlJ1wOnSvdmxu7bR31E58JZ0w.lSp2/V5nw.wNfFP95e', '100', '10', '10', '1asdas@sdfsfd.com'),
(22, 'coco', '$2y$10$Ggr973iQziHSiRRjbY4MEulMlimRbtGVI1dnaJ1GCLKcIeC6oRSYS', '234234', 'asda', 'asdasd', 'asdasda@sdfsdf.com'),
(23, 'sdfs', '$2y$10$PibWEd6kfTgujoemFwwyDOkJmyJkzdSDdXTIcW69KYVYXf5q1QsKK', '34', 'sdf', 'sdf', 'sdf@sdfs.com'),
(25, 'rtyrt', '$2y$10$gsfG/g8myhAD5LEtQhAnJu/VGogv9y5J7kp99Tn9Sdll67GXlOrgK', '23423444', 'yryry', 'rtyrtyrty', 'rtyrtyr@sdfsdf.com'),
(26, '34534', '$2y$10$4SNkaXzmZxtqFlcOo2EFTO2wc4RTSu2BFN3zdSYUXV3SmHxajWXMO', '3423424', 'erter3', '345345', 'erteter@ewerwer.com'),
(31, 'zayro', '$2y$10$94qK0uB7NYMvyWM0meZVgepv4BmQaucflJv7DyttzZGm7/vHJiFxG', '1098669883', 'marlon zayro', 'arias vargas', 'zayro8905@gmail.com'),
(35, 'werwer', '$2y$10$BHs4dx7jcyjByZEUQdpAJOXJiP0jUSxetcxjjdxf5vI2de425gpxm', '10085', 'werwer', '34534', 'ertert@sdfsd.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupo_familiar`
--
ALTER TABLE `grupo_familiar`
  ADD PRIMARY KEY (`id_grupo_familiar`,`id_usuario`) USING BTREE,
  ADD UNIQUE KEY `identificacion` (`identificacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`) USING BTREE,
  ADD UNIQUE KEY `user` (`usuario`),
  ADD UNIQUE KEY `identificacion` (`identificacion`),
  ADD KEY `id` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupo_familiar`
--
ALTER TABLE `grupo_familiar`
  MODIFY `id_grupo_familiar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupo_familiar`
--
ALTER TABLE `grupo_familiar`
  ADD CONSTRAINT `grupo_familiar_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
