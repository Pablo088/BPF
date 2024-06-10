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

-- Volcando datos para la tabla bpf.buses: ~0 rows (aproximadamente)

-- Volcando datos para la tabla bpf.bus_lines: ~0 rows (aproximadamente)

-- Volcando datos para la tabla bpf.bus_stops: ~12 rows (aproximadamente)
INSERT INTO `bus_stops` (`id`, `direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
	(1, 'Rioja y Rio Gallegos', '-33.004133', '-58.538857', '2024-05-29 01:15:52', '2024-05-29 01:15:52'),
	(2, '13 de junio y Rioja', '-33.004408', '-58.544392', '2024-05-29 01:43:56', '2024-05-29 01:43:56'),
	(3, 'Rioja y Del Inmigrante', '-33.004376', '-58.543009', '2024-05-29 01:45:02', '2024-05-29 01:45:02'),
	(4, 'Rioja y Sagrado Corazon', '-33.004147', '-58.539965', '2024-05-28 22:45:02', '2024-05-28 22:45:02'),
	(5, 'Bvard. Daneri y Rioja (Norte)', '-33.004142', '-58.537108', '2024-05-28 22:45:02', '2024-05-28 22:45:02'),
	(10, 'Rioja y Martin Fierro', '-33.004410', '-58.546975', '2024-05-29 02:34:40', '2024-05-29 02:34:40'),
	(14, 'Bvard. Daneri y Rioja (Sur)', '-33.00398995242106', '-58.53740930557252', '2024-05-29 02:50:48', '2024-05-29 02:50:48'),
	(17, 'Bvard. Daneri y San Juan (Norte)', '-33.00548100290519', '-58.53703916072846', '2024-05-29 02:55:48', '2024-05-29 02:55:48'),
	(19, 'Bvard. Daneri y San Juan (Sur)', '-33.00549899770337', '-58.53728860616685', '2024-05-29 02:57:30', '2024-05-29 02:57:30'),
	(20, 'Bvard. Daneri y Bernardino Rivadavia (norte)', '-33.007300989449284', '-58.53690505027772', '2024-05-29 03:01:51', '2024-05-29 03:01:51'),
	(69, 'Casa del bananero', '25.85115', '-80.13874', '2024-05-29 02:37:39', '2024-05-29 02:37:39'),
	(71, 'Bvard. Daneri y Bernardino Rivadavia (sur)', '-33.007354972718936', '-58.537210822105415', '2024-05-29 03:03:21', '2024-05-29 03:03:21');

-- Volcando datos para la tabla bpf.failed_jobs: ~0 rows (aproximadamente)

-- Volcando datos para la tabla bpf.migrations: ~8 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(23, '2024_05_20_213851_routes', 1),
	(32, '2014_10_12_000000_create_users_table', 2),
	(33, '2014_10_12_100000_create_password_reset_tokens_table', 2),
	(34, '2019_08_19_000000_create_failed_jobs_table', 2),
	(35, '2019_12_14_000001_create_personal_access_tokens_table', 2),
	(36, '2023_05_20_213917_bus_lines', 2),
	(37, '2024_05_20_213816_bus_stops', 2),
	(38, '2024_05_21_213217_buses', 2);

-- Volcando datos para la tabla bpf.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando datos para la tabla bpf.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando datos para la tabla bpf.users: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
