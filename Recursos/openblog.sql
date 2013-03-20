-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2013 at 11:00 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `ob_categoria`
--

CREATE TABLE IF NOT EXISTS `ob_categoria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ob_comentario`
--

CREATE TABLE IF NOT EXISTS `ob_comentario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `texto` text NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(10) NOT NULL,
  `idPost` int(10) NOT NULL,
  PRIMARY KEY (`id`,`idUsuario`,`idPost`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idPost` (`idPost`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ob_post`
--

CREATE TABLE IF NOT EXISTS `ob_post` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(10) NOT NULL,
  `idCategoria` int(10) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL,
  `modificaciones` int(10) NOT NULL,
  PRIMARY KEY (`id`,`idUsuario`,`idCategoria`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idCategoria` (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ob_rol`
--

CREATE TABLE IF NOT EXISTS `ob_rol` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ob_usuario`
--

CREATE TABLE IF NOT EXISTS `ob_usuario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `pass` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `idRol` int(10) NOT NULL,
  PRIMARY KEY (`id`,`idRol`),
  UNIQUE KEY `nombre` (`nombre`,`mail`),
  KEY `idRol` (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ob_comentario`
--
ALTER TABLE `ob_comentario`
  ADD CONSTRAINT `ob_comentario_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `ob_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ob_comentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `ob_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ob_post`
--
ALTER TABLE `ob_post`
  ADD CONSTRAINT `ob_post_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `ob_categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ob_post_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `ob_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ob_usuario`
--
ALTER TABLE `ob_usuario`
  ADD CONSTRAINT `ob_usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `ob_rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
