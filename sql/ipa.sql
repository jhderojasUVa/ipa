# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Base de datos: ebayuva
# Tiempo de Generación: 2018-07-04 10:08:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla administradores
# ------------------------------------------------------------

CREATE TABLE `administradores` (
  `idadmin` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla barrios
# ------------------------------------------------------------

CREATE TABLE `barrios` (
  `idbarrio` int(11) NOT NULL AUTO_INCREMENT,
  `idlocalizacion` int(11) NOT NULL,
  `barrio` varchar(50) NOT NULL,
  PRIMARY KEY (`idbarrio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla categorias
# ------------------------------------------------------------

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` char(20) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla comentarios
# ------------------------------------------------------------

CREATE TABLE `comentarios` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` varchar(10) NOT NULL,
  `comentario` text NOT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `idobjeto` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idcomentario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla denuncias
# ------------------------------------------------------------

CREATE TABLE `denuncias` (
  `idcomentario` int(11) NOT NULL,
  `iddenunciante` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla imagenes
# ------------------------------------------------------------

CREATE TABLE `imagenes` (
  `idobjeto` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `descripcion` tinytext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla imagenes_pisos
# ------------------------------------------------------------

CREATE TABLE `imagenes_pisos` (
  `idpiso` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL DEFAULT '',
  `descripcion` text NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla localizaciones
# ------------------------------------------------------------

CREATE TABLE `localizaciones` (
  `idlocalizacion` int(11) NOT NULL AUTO_INCREMENT,
  `localizacion` varchar(20) NOT NULL,
  PRIMARY KEY (`idlocalizacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla objetos
# ------------------------------------------------------------

CREATE TABLE `objetos` (
  `idobjeto` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` varchar(10) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `fechainsercion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `categoria` int(11) NOT NULL,
  `contacto` tinytext,
  `localizacion` int(11) DEFAULT NULL,
  `barrio` int(11) DEFAULT NULL,
  PRIMARY KEY (`idobjeto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla pisos
# ------------------------------------------------------------

CREATE TABLE `pisos` (
  `id_piso` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `calle` varchar(250) NOT NULL DEFAULT '',
  `numero` int(11) NOT NULL,
  `piso` varchar(11) NOT NULL,
  `letra` varchar(10) DEFAULT NULL,
  `cp` int(11) NOT NULL,
  `idlocalizacion` int(11) NOT NULL,
  `idbarrio` int(11) NOT NULL,
  `extras` text,
  `libre` tinyint(1) NOT NULL DEFAULT '0',
  `idusuario` varchar(10) NOT NULL DEFAULT '',
  `tlf` varchar(50) DEFAULT NULL,
  `lt` float DEFAULT NULL,
  `ln` float DEFAULT NULL,
  `verificado` tinyint(1) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_piso`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla pisos_precio
# ------------------------------------------------------------

CREATE TABLE `pisos_precio` (
  `idpiso` int(11) unsigned NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Volcado de tabla usuarios
# ------------------------------------------------------------

CREATE TABLE `usuarios` (
  `idu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `nombre` varchar(40) NOT NULL DEFAULT '',
  `apellidos` varchar(40) NOT NULL DEFAULT '',
  `direccion` text NOT NULL,
  `tlf` int(11) NOT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT '0',
  `dni` varchar(9) NOT NULL,
  `fechaalta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Volcado de tabla palabras
# ------------------------------------------------------------

DROP TABLE IF EXISTS `palabras`;

CREATE TABLE `palabras` (
  `palabra` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '' COMMENT 'Palabras para el buscador',
  PRIMARY KEY (`palabra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `palabras` WRITE;
/*!40000 ALTER TABLE `palabras` DISABLE KEYS */;

INSERT INTO `palabras` (`palabra`)
VALUES
	('calefacción'),
	('cerca'),
	('compartido'),
	('grande'),
	('habitación'),
	('lejos'),
	('pequeño');

/*!40000 ALTER TABLE `palabras` ENABLE KEYS */;
UNLOCK TABLES;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
