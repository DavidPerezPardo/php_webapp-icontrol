-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-12-2019 a las 14:05:17
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `icontrol`
--
CREATE DATABASE IF NOT EXISTS `icontrol` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `icontrol`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `codCon` int(11) NOT NULL AUTO_INCREMENT,
  `inicioCon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `finCon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `codUsu` int(11) NOT NULL,
  PRIMARY KEY (`codCon`),
  KEY `fk_codUsu` (`codUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`codCon`, `inicioCon`, `finCon`, `codUsu`) VALUES
(1, '2019-11-20 08:15:59', '2019-11-20 08:16:11', 1),
(7, '2019-11-20 08:41:14', '2019-11-20 08:41:32', 1),
(9, '2019-11-20 08:41:52', '2019-11-20 08:42:18', 1),
(11, '2019-11-20 08:43:02', '2019-11-20 08:44:52', 1),
(13, '2019-11-20 08:45:18', '2019-11-20 08:46:00', 1),
(15, '2019-11-20 08:57:57', '2019-11-20 08:57:58', 1),
(16, '2019-11-20 10:43:12', '2019-11-20 10:43:15', 1),
(17, '2019-11-20 10:43:16', '2019-11-20 12:30:03', 1),
(18, '2019-11-24 12:18:10', '2019-11-24 12:18:12', 1),
(19, '2019-11-25 12:38:34', '2019-11-25 12:38:36', 1),
(20, '2019-11-28 12:32:27', '2019-11-28 12:32:36', 1),
(21, '2019-11-28 12:38:46', '2019-11-28 12:38:48', 1),
(22, '2019-11-28 12:38:49', '2019-11-28 12:38:50', 1),
(23, '2019-12-02 00:48:32', '2019-12-02 00:53:05', 1),
(24, '2019-12-01 14:00:00', '2019-12-01 21:10:00', 2),
(25, '2019-12-02 14:06:17', '2019-12-02 21:09:00', 2),
(26, '2019-12-01 06:58:13', '2019-12-01 14:08:10', 20),
(27, '2019-12-02 07:01:12', '2019-12-02 13:56:18', 20),
(28, '2019-12-01 07:00:10', '2019-12-01 16:31:00', 19),
(30, '2019-12-03 07:03:00', '2019-12-03 16:02:00', 19),
(31, '2019-12-01 07:00:11', '2019-12-01 16:31:00', 23),
(32, '2019-12-08 07:00:12', '2019-12-03 16:32:00', 23),
(33, '2019-12-03 07:02:00', '2019-12-03 16:33:00', 23),
(34, '2019-12-01 07:00:00', '2019-12-01 16:37:00', 21),
(36, '2019-12-03 07:05:00', '2019-12-03 16:37:26', 21),
(37, '2019-12-01 07:10:00', '2019-12-01 13:46:28', 1),
(38, '2019-12-01 07:07:00', '2019-12-01 16:31:00', 22),
(40, '2019-12-03 07:12:00', '2019-12-03 16:29:15', 22),
(41, '2019-12-01 07:07:00', '2019-12-01 16:31:00', 16),
(42, '2019-12-03 07:12:00', '2019-12-03 16:26:00', 16),
(43, '2019-12-02 12:59:48', '2019-12-02 12:59:58', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `codLog` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `rol` tinyint(4) NOT NULL DEFAULT '0',
  `codUsu` int(11) DEFAULT NULL,
  PRIMARY KEY (`codLog`),
  KEY `codUsu` (`codUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`codLog`, `email`, `pass`, `rol`, `codUsu`) VALUES
(2, 'Administrador@gmail.com', '91f5167c34c400758115c2a6826ec2e3', 1, 1),
(3, 'María_13@gmail.com', '263bce650e68ab4e23f28263760b9fa5', 1, 2),
(11, 'alfredo_12@gmail.com', '5c2bf15004e661d7b7c9394617143d07', 0, 16),
(14, 'juan_14@gmail.com', 'a94652aa97c7211ba8954dd15a3cf838', 0, 19),
(15, 'marta_15@gmail.com', 'a763a66f984948ca463b081bf0f0e6d0', 0, 20),
(16, 'paco_16@gmail.com', '311020666a5776c57d265ace682dc46d', 0, 21),
(17, 'ana_17@gmail.com', '276b6c4692e78d4799c12ada515bc3e4', 0, 22),
(18, 'fray_18@gmail.com', '4b8560be612cba9d3ef020f52e1e49c6', 0, 23),
(19, 'carlos_19@gmail.com', 'dc599a9972fde3045dab59dbd1ae170b', 0, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codUsu` int(11) NOT NULL AUTO_INCREMENT,
  `checkEntry` tinyint(1) NOT NULL DEFAULT '0',
  `baja` tinyint(1) NOT NULL DEFAULT '0',
  `nomUsu` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apeUsu` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tfnUsu` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `puestoUsu` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `turnoUsu` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `altaUsu` date NOT NULL,
  `dniUsu` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `dirUsu` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codUsu`, `checkEntry`, `baja`, `nomUsu`, `apeUsu`, `tfnUsu`, `puestoUsu`, `turnoUsu`, `altaUsu`, `dniUsu`, `dirUsu`) VALUES
(1, 0, 0, 'David', 'Pérez Pardo', '651632547', 'Director Ejecutivo', 'Mañana - 08:00 a 15:00', '2012-10-17', '76876992k', 'C/ de la cruz,17 29004 Málaga (Málaga)'),
(2, 0, 0, 'María', 'Suárez Reverte', '665874525', 'Atención al cliente', 'Tarde - 15:00 a 22:00', '2017-11-13', '69854789l', 'C/ la esquina,12 29043 Málaga (Málaga)'),
(16, 0, 0, 'Alfredo', 'García palacios', '651478569', 'Técnico de redes', 'Jornada completa - 08:00 a 17:30', '2019-12-02', '74785236l', 'C/ zapata, 23 29004  Málaga (Málaga)'),
(19, 0, 0, 'Juan', 'Palomo Aguilar', '669887458', 'Técnico de redes', 'Jornada completa - 08:00 a 17:30', '2019-12-02', '9658514p', 'C/ anderson,2 29014  Málaga (Málaga)'),
(20, 0, 0, 'Marta', 'Sanchez rábanos', '669874525', 'RRHH', 'Mañana - 08:00 a 15:00', '2019-12-02', '47856987t', 'C/ la pera,9 29005 Málaga (Málaga)'),
(21, 0, 0, 'Francisco', 'Gómez Puertas', '698541236', 'Programador web', 'Jornada completa - 08:00 a 17:30', '2019-12-02', '58741236m', 'C/ la rosa, 13 29003  Málaga (Málaga)'),
(22, 0, 0, 'Ana', 'Márquez Rey', '669878458', 'Programador web', 'Jornada completa - 08:00 a 17:30', '2019-12-02', '96965897l', 'C/ la cuesta,32 29003 Málaga (Málaga)'),
(23, 0, 0, 'Frayleopoldo', 'De alpandeire', '666999666', 'programador web', 'Jornada completa - 08:00 a 17:30', '2019-12-02', '69696969p', 'C/ atalaya,10 29004  Málaga (Málaga)'),
(24, 0, 0, 'Carlos', 'Ramírez López', '669874566', 'Programador web', 'Mañana - 08:00 a 15:00', '2019-12-02', '69874523k', 'C/ la hoz,19 2904  Málaga (Málaga)');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `control`
--
ALTER TABLE `control`
  ADD CONSTRAINT `fk_codUsu` FOREIGN KEY (`codUsu`) REFERENCES `usuario` (`codUsu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`codUsu`) REFERENCES `usuario` (`codUsu`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
