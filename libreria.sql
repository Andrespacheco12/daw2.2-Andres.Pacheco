-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-10-2020 a las 13:21:58
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--
CREATE DATABASE IF NOT EXISTS `libreria` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `libreria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `establecimiento`;
CREATE TABLE IF NOT EXISTS `establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `categoria`
--

TRUNCATE TABLE `establecimiento`;
--
-- Volcado de datos para la tabla `local`
--

INSERT INTO `establecimiento` (`id`, `nombre`) VALUES
(1, 'libreria las margaritas'),
(2, 'libreria tio paco'),
(5, 'libreria dos tostas'),
(6, 'libreria eustaquia'),
(10, 'libreria asd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

DROP TABLE IF EXISTS `libro`;
CREATE TABLE IF NOT EXISTS `libro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `editorial` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ISBN` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `reservado` tinyint(1) NOT NULL DEFAULT 0,
  `establecimiento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_establecimiento_id_idx` (`establecimiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `persona`
--

TRUNCATE TABLE `libro`;
--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `libro` (`id`, `nombre`, `editorial`,`ISBN`, `establecimiento_id`) VALUES
(1, 'pelea de estrellas', 'bruno','334523861-7',1, 2),
(4, 'la tormenta misteriosa', 'edebe','20976738492-8',0, 1),
(5, 'la ciudad perdida', 'salvat','457642801-2',0, 5),
(6, 'las aguas movedizas', 'hola','567219074-1',1,6),
(8, 'la oscura verdad', 'edebe','56565',1, 2),
(9, 'en medio de la nada', 'astral','1232',1, 10),
(13, 'el lejano pais de los estanques', 'bruno','237848691-2',0,6);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `fk_establecimiento_id` FOREIGN KEY (`establecimiento_id`) REFERENCES `establecimiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;