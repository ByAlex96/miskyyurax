-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2024 a las 17:43:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miskyyurax`
--
CREATE DATABASE IF NOT EXISTS `miskyyurax` DEFAULT CHARACTER
SET
  utf8mb3 COLLATE utf8mb3_unicode_ci;

USE `miskyyurax`;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `citas`
--
CREATE TABLE
  `citas` (
    `idCita` int (11) NOT NULL,
    `idUsuarioFK` int (11) NOT NULL,
    `fecha_cita` date NOT NULL,
    `motivo_cita` text NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--
INSERT INTO
  `citas` (
    `idCita`,
    `idUsuarioFK`,
    `fecha_cita`,
    `motivo_cita`
  )
VALUES
  (11, 31, '2024-06-20', 'Prueba1'),
  (12, 30, '2024-06-21', 'Prueba 2');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `logins`
--
CREATE TABLE
  `logins` (
    `IdLogin` int (11) NOT NULL,
    `fecha_login` datetime NOT NULL,
    `idUsuarioFK` int (11) NOT NULL,
    `usuario` varchar(12) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` varchar(8) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `logins`
--
INSERT INTO
  `logins` (
    `IdLogin`,
    `fecha_login`,
    `idUsuarioFK`,
    `usuario`,
    `password`,
    `role`
  )
VALUES
  (
    85,
    '2024-06-13 17:39:29',
    30,
    'usuarioAdmin',
    '$2y$10$Z10oxJLEYdZd4kiHQ7Af7.dwEh5UtMtUORxKosC3sMTX7n5pVUTSu',
    'admin'
  ),
  (
    86,
    '2024-06-13 17:39:54',
    30,
    'usuarioAdmin',
    '$2y$10$Z10oxJLEYdZd4kiHQ7Af7.dwEh5UtMtUORxKosC3sMTX7n5pVUTSu',
    'admin'
  ),
  (
    87,
    '2024-06-13 17:40:42',
    31,
    'usuarioUser',
    '$2y$10$4QxRvQwVv0oAggGC25mlCuhBSe60hua68kFZuuWknGJVTJa./S/6C',
    'usuario'
  ),
  (
    88,
    '2024-06-13 17:40:52',
    31,
    'usuarioUser',
    '$2y$10$4QxRvQwVv0oAggGC25mlCuhBSe60hua68kFZuuWknGJVTJa./S/6C',
    'usuario'
  ),
  (
    89,
    '2024-06-13 17:41:23',
    30,
    'usuarioAdmin',
    '$2y$10$Z10oxJLEYdZd4kiHQ7Af7.dwEh5UtMtUORxKosC3sMTX7n5pVUTSu',
    'admin'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `noticias`
--
CREATE TABLE
  `noticias` (
    `idNoticia` int (11) NOT NULL,
    `titulo` varchar(255) NOT NULL,
    `cuerpo` longtext NOT NULL,
    `imagen` varchar(255) NOT NULL,
    `fecha` datetime NOT NULL,
    `idUserFK` int (11) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--
INSERT INTO
  `noticias` (
    `idNoticia`,
    `titulo`,
    `cuerpo`,
    `imagen`,
    `fecha`,
    `idUserFK`
  )
VALUES
  (
    5,
    'Prueba 1',
    'Prueba 1',
    'imagenes/666b1374360fd_666ad2924b440.jpg',
    '2024-06-13 17:42:44',
    30
  ),
  (
    6,
    'Prueba 3',
    'Prueba 3',
    'imagenes/666b138f9e5f7_666b0ddba560d.jpg',
    '2024-06-13 17:43:11',
    30
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuarios`
--
CREATE TABLE
  `usuarios` (
    `IdUsuario` int (11) NOT NULL,
    `nombre` varchar(30) NOT NULL,
    `apellidos` varchar(30) NOT NULL,
    `email` varchar(30) NOT NULL,
    `telefono` varchar(9) NOT NULL,
    `fecha_nacimiento` date NOT NULL,
    `fecha_alta` date NOT NULL,
    `direccion` varchar(255) NOT NULL,
    `sexo` varchar(30) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO
  `usuarios` (
    `IdUsuario`,
    `nombre`,
    `apellidos`,
    `email`,
    `telefono`,
    `fecha_nacimiento`,
    `fecha_alta`,
    `direccion`,
    `sexo`
  )
VALUES
  (
    30,
    'usuarioAdmin',
    'usuarioAdmin',
    'misky.yurax@admin.com',
    '123456789',
    '1996-03-11',
    '2024-06-13',
    'Calle administrador',
    'hombre'
  ),
  (
    31,
    'usuarioUser',
    'usuarioUser',
    'misky.yurax@usuarioUser.com',
    '000000000',
    '1991-02-09',
    '2024-06-13',
    'Calle usuario',
    'hombre'
  );

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas` ADD PRIMARY KEY (`idCita`),
ADD KEY `idUsuarioFK` (`idUsuarioFK`);

--
-- Indices de la tabla `logins`
--
ALTER TABLE `logins` ADD PRIMARY KEY (`IdLogin`),
ADD KEY `idUsuarioFK` (`idUsuarioFK`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias` ADD PRIMARY KEY (`idNoticia`),
ADD KEY `idUserFK` (`idUserFK`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios` ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas` MODIFY `idCita` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT de la tabla `logins`
--
ALTER TABLE `logins` MODIFY `IdLogin` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 90;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias` MODIFY `idNoticia` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios` MODIFY `IdUsuario` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 32;

--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas` ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUsuarioFK`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `logins`
--
ALTER TABLE `logins` ADD CONSTRAINT `logins_ibfk_1` FOREIGN KEY (`idUsuarioFK`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias` ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`idUserFK`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;