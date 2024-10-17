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

-- Volcando estructura para tabla bpf.line_has_stops
CREATE TABLE IF NOT EXISTS `line_has_stops` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `busLine_id` bigint unsigned NOT NULL,
  `busStop_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `line_has_stops_busline_id_foreign` (`busLine_id`),
  KEY `line_has_stops_busstop_id_foreign` (`busStop_id`),
  CONSTRAINT `line_has_stops_busline_id_foreign` FOREIGN KEY (`busLine_id`) REFERENCES `bus_lines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `line_has_stops_busstop_id_foreign` FOREIGN KEY (`busStop_id`) REFERENCES `bus_stops` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bpf.line_has_stops: ~57 rows (aproximadamente)
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (4, 82, '2024-10-02 22:46:08', '2024-10-02 22:46:08');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (4, 79, '2024-10-02 22:49:00', '2024-10-02 22:49:00');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (2, 7, '2024-10-02 22:54:51', '2024-10-02 22:54:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (9, 359, '2024-10-02 22:56:21', '2024-10-02 22:56:21');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (1, 374, '2024-10-02 22:57:46', '2024-10-02 22:57:46');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (6, 203, '2024-10-02 23:03:37', '2024-10-02 23:03:37');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 239, '2024-10-03 20:11:35', '2024-10-03 20:11:35');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 237, '2024-10-03 20:12:00', '2024-10-03 20:12:00');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (10, 238, '2024-10-03 20:12:14', '2024-10-03 20:12:14');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 231, '2024-10-03 20:12:26', '2024-10-03 20:12:26');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (10, 236, '2024-10-03 20:12:37', '2024-10-03 20:12:37');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 230, '2024-10-03 20:39:37', '2024-10-03 20:39:37');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 232, '2024-10-03 21:12:22', '2024-10-03 21:12:22');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 223, '2024-10-03 21:12:49', '2024-10-03 21:12:49');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 226, '2024-10-03 21:13:01', '2024-10-03 21:13:01');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 225, '2024-10-03 21:13:13', '2024-10-03 21:13:13');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 221, '2024-10-03 21:13:48', '2024-10-03 21:13:48');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 219, '2024-10-03 21:14:03', '2024-10-03 21:14:03');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 262, '2024-10-03 21:14:20', '2024-10-03 21:14:20');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 263, '2024-10-03 21:14:32', '2024-10-03 21:14:32');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 264, '2024-10-03 21:14:46', '2024-10-03 21:14:46');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 266, '2024-10-03 21:15:44', '2024-10-03 21:15:44');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 294, '2024-10-03 21:16:03', '2024-10-03 21:16:03');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 272, '2024-10-03 21:16:15', '2024-10-03 21:16:15');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 273, '2024-10-03 21:16:54', '2024-10-03 21:16:54');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 278, '2024-10-03 21:18:37', '2024-10-03 21:18:37');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 275, '2024-10-03 21:18:48', '2024-10-03 21:18:48');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (10, 279, '2024-10-14 20:27:53', '2024-10-14 20:27:53');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 276, '2024-10-14 20:28:06', '2024-10-14 20:28:06');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 280, '2024-10-14 20:28:19', '2024-10-14 20:28:19');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (5, 120, '2024-10-17 20:56:43', '2024-10-17 20:56:43');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (5, 169, '2024-10-17 20:56:43', '2024-10-17 20:56:43');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (5, 119, '2024-10-17 20:56:44', '2024-10-17 20:56:44');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 265, '2024-10-17 21:23:51', '2024-10-17 21:23:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 291, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 292, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 121, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 123, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 126, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 127, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 128, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 179, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 137, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 176, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 138, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 175, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 139, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 177, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 183, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 186, '2024-10-17 21:25:51', '2024-10-17 21:25:51');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 187, '2024-10-17 21:25:52', '2024-10-17 21:25:52');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 188, '2024-10-17 21:25:52', '2024-10-17 21:25:52');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 172, '2024-10-17 21:25:52', '2024-10-17 21:25:52');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 161, '2024-10-17 21:25:52', '2024-10-17 21:25:52');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 160, '2024-10-17 21:25:52', '2024-10-17 21:25:52');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 399, '2024-10-17 21:25:52', '2024-10-17 21:25:52');
INSERT INTO `line_has_stops` (`busLine_id`, `busStop_id`, `created_at`, `updated_at`) VALUES (11, 165, '2024-10-17 21:25:52', '2024-10-17 21:25:52');


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
