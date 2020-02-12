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
-- Volcando datos para la tabla segundamano_rol.anuncio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;

-- Volcando datos para la tabla segundamano_rol.foto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;

-- Volcando datos para la tabla segundamano_rol.migration_versions: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
	('20200127210754', '2020-01-27 21:08:14');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;

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

-- Volcando datos para la tabla segundamano_rol.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
