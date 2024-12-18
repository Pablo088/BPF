-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla bpf.bus_lines
CREATE TABLE IF NOT EXISTS `bus_lines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `line_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `horario_comienzo` time NOT NULL,
  `horario_finalizacion` time NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_lines_company_id_foreign` (`company_id`),
  CONSTRAINT `bus_lines_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `bus_companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bpf.bus_lines: ~11 rows (aproximadamente)

INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('1A', 1, '00:00:00', '00:00:00', '#F7E300', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('1B', 1, '00:00:00', '00:00:00', '#F7E300', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('4A', 1, '00:00:00', '00:00:00', '#F7E300', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('4A1', 1, '00:00:00', '00:00:00', '#F7E300', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('4B', 1, '00:00:00', '00:00:00', '#F7E300', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('2A', 2, '00:00:00', '00:00:00', '#003366', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('2B', 2, '00:00:00', '00:00:00', '#003366', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('5A - vuelta', 3, '00:00:00', '00:00:00', '#32CD32', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('5A - ida', 3, '00:00:00', '00:00:00', '#32CD32', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('5B - vuelta', 3, '00:00:00', '00:00:00', '#32CD32', NULL, NULL);
INSERT INTO `bus_lines` (`line_name`, `company_id`, `horario_comienzo`, `horario_finalizacion`, `color`, `created_at`, `updated_at`) VALUES ('5B - ida', 3, '00:00:00', '00:00:00', '#32CD32', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
