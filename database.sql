-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-06-2024 a las 20:43:16
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.3.0
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
-- Base de datos: `MiskyYurax`
--
CREATE DATABASE IF NOT EXISTS `miskyyurax` DEFAULT CHARACTER
SET
  utf8mb3 COLLATE utf8mb3_unicode_ci;

USE `miskyyurax`;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `citas`
--
DROP TABLE IF EXISTS `citas`;

CREATE TABLE
  IF NOT EXISTS `citas` (
    `idCita` int NOT NULL AUTO_INCREMENT,
    `idUsuarioFK` int NOT NULL,
    `fecha_cita` date NOT NULL,
    `motivo_cita` text COLLATE utf8mb3_unicode_ci NOT NULL,
    PRIMARY KEY (`idCita`),
    KEY `idUsuarioFK` (`idUsuarioFK`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `logins`
--
DROP TABLE IF EXISTS `logins`;

CREATE TABLE
  IF NOT EXISTS `logins` (
    `IdLogin` int NOT NULL AUTO_INCREMENT,
    `fecha_login` datetime NOT NULL,
    `idUsuarioFK` int NOT NULL,
    `usuario` varchar(12) COLLATE utf8mb3_unicode_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `role` varchar(8) COLLATE utf8mb3_unicode_ci NOT NULL,
    PRIMARY KEY (`IdLogin`),
    KEY `idUsuarioFK` (`idUsuarioFK`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 85 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `noticias`
--
DROP TABLE IF EXISTS `noticias`;

CREATE TABLE
  IF NOT EXISTS `noticias` (
    `idNoticia` int NOT NULL AUTO_INCREMENT,
    `titulo` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
    `cuerpo` longtext CHARACTER
    SET
      utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
      `imagen` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
      `fecha` datetime NOT NULL,
      `idUserFK` int NOT NULL,
      PRIMARY KEY (`idNoticia`),
      KEY `idUserFK` (`idUserFK`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuarios`
--
DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE
  IF NOT EXISTS `usuarios` (
    `IdUsuario` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
    `apellidos` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
    `email` varchar(30) CHARACTER
    SET
      utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL UNIQUE,
      `telefono` varchar(9) CHARACTER
    SET
      utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
      `fecha_nacimiento` date NOT NULL,
      `fecha_alta` date NOT NULL,
      `direccion` varchar(255) CHARACTER
    SET
      utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
      `sexo` varchar(30) CHARACTER
    SET
      utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
      PRIMARY KEY (`IdUsuario`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_unicode_ci;

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