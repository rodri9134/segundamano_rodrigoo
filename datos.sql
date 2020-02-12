-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.37-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para segundamano_rol
CREATE DATABASE IF NOT EXISTS `segundamano_rol` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `segundamano_rol`;


-- Volcando estructura para tabla segundamano_rol.anuncio
CREATE TABLE IF NOT EXISTS `anuncio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `titulo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_crea` datetime NOT NULL,
  `fecha_mod` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B3BC0D4DB38439E` (`user_id`),
  CONSTRAINT `FK_4B3BC0D4DB38439E` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.anuncio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
INSERT INTO `anuncio` (`id`, `user_id`, `titulo`, `descripcion`, `precio`, `fecha_crea`, `fecha_mod`) VALUES
	(1, 1, 'Casa', 'Casa en la playa', 23423422.00, '2020-01-27 22:25:56', '2020-01-27 22:25:57'),
	(2, 1, 'daffd', 'movil', 23423.00, '2020-02-03 16:25:14', '2020-02-03 16:25:16');
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;


-- Volcando estructura para tabla segundamano_rol.foto
CREATE TABLE IF NOT EXISTS `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anuncio_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EADC3BE5963066FD` (`anuncio_id`),
  CONSTRAINT `FK_foto_anuncio` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.foto: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
INSERT INTO `foto` (`id`, `anuncio_id`, `nombre`) VALUES
	(1, 1, 'img/malaga.jpg'),
	(2, 2, 'img/malaga2.jpg');
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;


-- Volcando estructura para tabla segundamano_rol.migration_versions
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.migration_versions: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
	('20200127210754', '2020-01-28 15:13:28');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;


-- Volcando estructura para tabla segundamano_rol.provincia
CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.provincia: ~52 rows (aproximadamente)
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` (`id`, `nombre`) VALUES
	(1, 'Álava'),
	(2, 'Albacete'),
	(3, 'Alicante'),
	(4, 'Almería'),
	(5, 'Ávila'),
	(6, 'Badajoz'),
	(7, 'Baleares (Illes)'),
	(8, 'Barcelona'),
	(9, 'Burgos'),
	(10, 'Cáceres'),
	(11, 'Cádiz'),
	(12, 'Castellón'),
	(13, 'Ciudad Real'),
	(14, 'Córdoba'),
	(15, 'A Coruña'),
	(16, 'Cuenca'),
	(17, 'Girona'),
	(18, 'Granada'),
	(19, 'Guadalajara'),
	(20, 'Guipúzcoa'),
	(21, 'Huelva'),
	(22, 'Huesca'),
	(23, 'Jaén'),
	(24, 'León'),
	(25, 'Lleida'),
	(26, 'La Rioja'),
	(27, 'Lugo'),
	(28, 'Madrid'),
	(29, 'Málaga'),
	(30, 'Murcia'),
	(31, 'Navarra'),
	(32, 'Ourense'),
	(33, 'Asturias'),
	(34, 'Palencia'),
	(35, 'Las Palmas'),
	(36, 'Pontevedra'),
	(37, 'Salamanca'),
	(38, 'Santa Cruz de Tenerife'),
	(39, 'Cantabria'),
	(40, 'Segovia'),
	(41, 'Sevilla'),
	(42, 'Soria'),
	(43, 'Tarragona'),
	(44, 'Teruel'),
	(45, 'Toledo'),
	(46, 'Valencia'),
	(47, 'Valladolid'),
	(48, 'Vizcaya'),
	(49, 'Zamora'),
	(50, 'Zaragoza'),
	(51, 'Ceuta'),
	(52, 'Melilla');
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;


-- Volcando estructura para tabla segundamano_rol.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_id` int(11) DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2265B05D4E7121AF` (`provincia_id`),
  CONSTRAINT `FK_2265B05D4E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.user: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `provincia_id`, `email`, `password`, `nombre`, `apellidos`, `telefono`, `foto`, `roles`) VALUES
	(1, 1, 'rodri_9134@hotmail.com', '123456', 'sdafasdf', 'asdfasdf', 'sadfas', 'asfdasf', ''),
	(3, 13, 'rodri9134@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$U3pxVE1IRmZlSlB3YU45Wg$yATrF6GRd1Rg8KohlzyUHbqsIfYVJAf7c9G95GUDFfQ', 'Rodrigo', 'Ordoñez', '690152880', '756d1033eaf2685928506bcd1e835b04.jpg', 'ROLE_USER'),
	(4, 1, 'hola@h.com', '$argon2id$v=19$m=65536,t=4,p=1$UXlXSmovaWsuT3RPQkVxYQ$g2liZuslHcqsxrQBo4J0VGHwCmJYJNbGsZTK3jefRvM', 'fdsafdsa', 'sdfaas', '3242342', '18122d02f45f1b73a731d4c524a3564e.png', 'ROLE_USER');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
