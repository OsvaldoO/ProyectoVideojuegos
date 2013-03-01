-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2013 at 02:14 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CiberGXLeon`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `nick` varchar(20) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `credito` int(11) DEFAULT '10',
  PRIMARY KEY (`nick`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`nick`, `nombre`, `email`, `password`, `avatar`, `puntos`, `credito`) VALUES
('gaby', 'Gabriela', 'Gaby123@hotmail.com', 'gabiii', NULL, 30, 20),
('Jon', 'Yonatan ', 'yoni56@gmail.com', 'jona', NULL, 10, 10),
('luiz', 'Luis Alverto', 'luis@hotmail.com', 'luilly', NULL, 0, 10),
('Max', 'Marcos', 'marcos.45@hotmail.com', 'max45', NULL, 10, 50),
('OsvaldoO', 'Osvaldo Leon', 'osvaldo.lp.5889@gmail.com', '54321', NULL, 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `detalleseventos`
--

CREATE TABLE IF NOT EXISTS `detalleseventos` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `detalles` varchar(200) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `nom_juego` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `detalleseventos`
--

INSERT INTO `detalleseventos` (`numero`, `detalles`, `tipo`, `fecha`, `nom_juego`) VALUES
(1, 'Máximo 8 equipos, Eliminación Directa', 'Torneo', '2013-02-26', 'Fifa_13'),
(2, 'Consigue pasar el juego en menos tiempo que tus competidores', 'Desafio', '2013-02-19', 'Halo_2'),
(4, '3 rondas por pelea', 'Torneo', '2013-02-21', 'Mortal_Kombat_8'),
(5, 'El Jugador mas Rápido dando 5 vueltas en White Mountain Gana', 'Competencia', '2013-03-21', 'Burnout_4');

-- --------------------------------------------------------

--
-- Table structure for table `detallesrenta`
--

CREATE TABLE IF NOT EXISTS `detallesrenta` (
  `clave_renta` int(11) NOT NULL,
  `nom_juego` varchar(40) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detallesrenta`
--

INSERT INTO `detallesrenta` (`clave_renta`, `nom_juego`, `horas`) VALUES
(1, 'Burnout_4', 1),
(1, 'Fifa_13', 2),
(2, 'Fifa_13', 2),
(5, 'Dragon_Ball_Z', 3),
(4, 'Burnout_4', 1),
(3, 'Halo_2', 4),
(3, 'Mortal_Kombat_8', 1),
(2, 'Halo_2', 7);

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `rfc` varchar(20) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(30) NOT NULL,
  `tiempo` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`codigo`, `nombre`, `rfc`, `telefono`, `direccion`, `tiempo`) VALUES
(1, 'Martin', 'DUSA12545', 21474836, 'Morelos#114', 5),
(2, 'Liliana', 'JDSD565D4', 40412569, 'Hidalgo 24', 2),
(3, 'Alejandro', 'DDSFS54DS', NULL, 'Morelos 12', 3),
(6, 'Jessica', 'GKJHD5655', 45956566, 'Aldama 5', 8),
(10, 'Carmen', 'SHDD554FE', 2565546, 'Mata_Moros 32', 9);

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `num_evento` int(11) NOT NULL,
  `nick_ganador` varchar(20) NOT NULL,
  `participantes` int(11) DEFAULT NULL,
  UNIQUE KEY `num_evento` (`num_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`num_evento`, `nick_ganador`, `participantes`) VALUES
(1, 'OsvaldoO', 8),
(2, 'Jon', 13),
(4, 'Max', 12);

-- --------------------------------------------------------

--
-- Table structure for table `juegos`
--

CREATE TABLE IF NOT EXISTS `juegos` (
  `nombre` varchar(40) NOT NULL,
  `genero` varchar(15) DEFAULT NULL,
  `cantidad` int(11) DEFAULT '1',
  `popularidad` int(11) DEFAULT '0',
  `imagen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `juegos`
--

INSERT INTO `juegos` (`nombre`, `genero`, `cantidad`, `popularidad`, `imagen`) VALUES
('Burnout_4', 'Carreras', 3, 6, NULL),
('Dragon_Ball_Z', 'Aventuras', 3, 7, NULL),
('Fifa_13', 'Deporte', 5, 8, NULL),
('Halo_2', 'Accion', 6, 10, NULL),
('Mortal_Kombat_8', 'Peleas', 4, 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logros`
--

CREATE TABLE IF NOT EXISTS `logros` (
  `clave` int(11) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(45) DEFAULT NULL,
  `puntos_otorgados` varchar(15) DEFAULT NULL,
  `Nom_Juego` varchar(20) NOT NULL,
  `cliente_premiado` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `logros`
--

INSERT INTO `logros` (`clave`, `detalle`, `puntos_otorgados`, `Nom_Juego`, `cliente_premiado`, `fecha`) VALUES
(1, 'Logro por pasar el Juego ( cualquier nivel )', '20', 'Halo_2', 'OsvaldoO', '2013-02-12'),
(2, 'Logro por pasar el Juego ( cualquier nivel )', '15', 'Dragon_Ball_Z', 'Jon', '2013-02-13'),
(3, 'Pasar Juego en menos de  24 horas', '50', 'Dragon_Ball_Z', 'Jon', '2013-02-15'),
(4, 'Superar nivel sin ninguna vida perdida', '10', 'Halo_2', 'Max', '2013-02-28'),
(5, 'Desbloquear nuevo personaje', '25', 'Mortal_Kombat_8', 'OsvaldoO', '2013-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `rentas`
--

CREATE TABLE IF NOT EXISTS `rentas` (
  `clave` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(15) DEFAULT NULL,
  `cod_empleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rentas`
--

INSERT INTO `rentas` (`clave`, `nick`, `cod_empleado`, `fecha`) VALUES
(1, 'luiz', 2, '2013-02-13'),
(2, 'luiz', 2, '2013-02-19'),
(3, 'Max', 10, '2013-02-11'),
(4, 'gaby', 6, '2013-02-14'),
(5, 'Max', 6, '2013-02-13');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;