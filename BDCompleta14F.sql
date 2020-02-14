-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para segundamano_rol
DROP DATABASE IF EXISTS `segundamano_rol`;
CREATE DATABASE IF NOT EXISTS `segundamano_rol` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `segundamano_rol`;


-- Volcando estructura para tabla segundamano_rol.anuncio
DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `titulo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_crea` datetime DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `foto_principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B3BC0D4A76ED395` (`user_id`),
  CONSTRAINT `FK_4B3BC0D4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.anuncio: ~5 rows (aproximadamente)
DELETE FROM `anuncio`;
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
INSERT INTO `anuncio` (`id`, `user_id`, `titulo`, `descripcion`, `precio`, `fecha_crea`, `fecha_mod`, `foto_principal`) VALUES
	(2, 2, 'Xiaomi Mi A3', 'Seminuevo, con algunos rasguños', 100.00, '2023-01-01 00:00:00', '2020-02-12 11:30:34', 'a01d4f873671d092438176fdd31e421e.png');
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;


-- Volcando estructura para tabla segundamano_rol.foto
DROP TABLE IF EXISTS `foto`;
CREATE TABLE IF NOT EXISTS `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anuncio_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EADC3BE5963066FD` (`anuncio_id`),
  CONSTRAINT `FK_EADC3BE5963066FD` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.foto: ~0 rows (aproximadamente)
DELETE FROM `foto`;
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;


-- Volcando estructura para tabla segundamano_rol.migration_versions
DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.migration_versions: ~0 rows (aproximadamente)
DELETE FROM `migration_versions`;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
	('20200212094305', '2020-02-12 09:43:11');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;


-- Volcando estructura para tabla segundamano_rol.provincia
DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.provincia: ~52 rows (aproximadamente)
DELETE FROM `provincia`;
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
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  KEY `IDX_8D93D6494E7121AF` (`provincia_id`),
  CONSTRAINT `FK_8D93D6494E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla segundamano_rol.user: ~1 rows (aproximadamente)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `provincia_id`, `email`, `roles`, `password`, `nombre`, `apellidos`, `telefono`, `foto`) VALUES
	(1, 1, 'rodri9134@333gmail.com', 'ROLE_USER', '$argon2id$v=19$m=65536,t=4,p=1$bjlxMGdETEE2MjZRMWZaWg$mjVhoQsIFX5xbs8OqciP2vxPO6SbnNZAdQ25EAGwWXU', 'Prueba', 'prueba', '222222222', ''),
	(2, 1, 'rodri9134@gmail.com', 'ROLE_USER', '$argon2id$v=19$m=65536,t=4,p=1$bjlxMGdETEE2MjZRMWZaWg$mjVhoQsIFX5xbs8OqciP2vxPO6SbnNZAdQ25EAGwWXU', 'Rodrigo', 'López', '690152880', 'bcb3e63d48e5bc962dcf61fef6cbb9a7.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
