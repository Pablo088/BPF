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

-- Volcando estructura para tabla bpf.bus_stops
CREATE TABLE IF NOT EXISTS `bus_stops` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bpf.bus_stops: ~121 rows (aproximadamente)
/* INSERT INTO `bus_stops` (`id`, `direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
	(1, 'Rioja y Rio Gallegos', '-33.004133', '-58.538857', '2024-05-29 01:15:52', '2024-05-29 01:15:52'),
	(2, '13 de junio y Rioja', '-33.004408', '-58.544392', '2024-05-29 01:43:56', '2024-05-29 01:43:56'),
	(3, 'Rioja y Del Inmigrante', '-33.004376', '-58.543009', '2024-05-29 01:45:02', '2024-05-29 01:45:02'),
	(4, 'Rioja y Sagrado Corazon', '-33.004147', '-58.539965', '2024-05-28 22:45:02', '2024-05-28 22:45:02'),
	(5, 'Bvard. Daneri y Rioja', '-33.004142', '-58.537108', '2024-05-28 22:45:02', '2024-05-28 22:45:02'),
	(10, 'Rioja y Martin Fierro', '-33.004410', '-58.546975', '2024-05-29 02:34:40', '2024-05-29 02:34:40'),
	(14, 'Bvard. Daneri y Rioja', '-33.00398995242106', '-58.53740930557252', '2024-05-29 02:50:48', '2024-05-29 02:50:48'),
	(17, 'Bvard. Daneri y San Juan', '-33.00548100290519', '-58.53703916072846', '2024-05-29 02:55:48', '2024-05-29 02:55:48'),
	(19, 'Bvard. Daneri y San Juan', '-33.00549899770337', '-58.53728860616685', '2024-05-29 02:57:30', '2024-05-29 02:57:30'),
	(20, 'Bvard. Daneri y Bernardino Rivadavia', '-33.007300989449284', '-58.53690505027772', '2024-05-29 03:01:51', '2024-05-29 03:01:51'),
	(22, 'Bvard. Daneri y Bernardino Rivadavia', '-33.007354972718936', '-58.537210822105415', '2024-05-29 03:03:21', '2024-05-29 03:03:21'),
	(23, 'Urquiza y L. N. Palma', '-33.00894718315231', '-58.53684067726136', '2024-06-10 22:20:52', '2024-06-10 22:20:52'),
	(69, 'Casa del bananero', '25.85115', '-80.13874', '2024-05-29 02:37:39', '2024-05-29 02:37:39'),
	(74, 'Urquiza y L. N. Palma', '-33.00903715357081', '-58.53708744049073', '2024-06-10 22:23:32', '2024-06-10 22:23:32'),
	(75, 'Bvard. Daneri y Clavarino', '-33.001875502339175', '-58.53726983070374', '2024-06-10 22:28:43', '2024-06-10 22:28:43'),
	(76, 'Bvard. Daneri y Clavarino', '-33.00164577778215', '-58.53760242462159', '2024-06-10 22:29:11', '2024-06-10 22:29:11'),
	(77, 'Perigán Y Bvard. Daneri', '-33.00091020528655', '-58.537578284740455', '2024-06-10 22:29:57', '2024-06-10 22:29:57'),
	(78, 'Bvard. Daneri y J. E. Díaz', '-33.00002616050298', '-58.53739053010941', '2024-06-10 22:30:48', '2024-06-10 22:30:48'),
	(79, 'Bvard. Daneri y Margalot', '-32.998534736630326', '-58.53745222091675', '2024-06-10 22:33:29', '2024-06-10 22:33:29'),
	(81, 'Bvard. Daneri y Margalot', '-32.998294036900596', '-58.53773385286332', '2024-06-10 22:34:38', '2024-06-10 22:34:38'),
	(82, 'Bvard. Daneri y 2 de abril', '-32.99713102054413', '-58.537825047969825', '2024-06-10 22:35:20', '2024-06-10 22:35:20'),
	(83, 'Bvard. Daneri y 2 de abril', '-32.997104025785156', '-58.53753805160523', '2024-06-10 22:37:55', '2024-06-10 22:37:55'),
	(84, 'Bvard. A. Daneri y Gregorio Goyo Aguilar', '-32.99549782276194', '-58.53790283203126', '2024-06-10 22:42:27', '2024-06-10 22:42:27'),
	(86, 'Bvard. A. Daneri y Gregorio Goyo Aguilar', '-32.995482075528756', '-58.53760778903962', '2024-06-10 22:43:48', '2024-06-10 22:43:48'),
	(87, 'Bvard. A. Daneri y Maestra Paggio', '-32.994474246759744', '-58.537956476211555', '2024-06-10 22:44:26', '2024-06-10 22:44:26'),
	(88, 'Bvard. A. Daneri y Maestra Paggio', '-32.9946519674009', '-58.53766947984696', '2024-06-10 22:45:08', '2024-06-10 22:45:08'),
	(89, 'Bvard. A. Daneri - Cementerio', '-32.99293632961674', '-58.53803157806397', '2024-06-10 23:57:32', '2024-06-10 23:57:32'),
	(90, 'Pedro Perigán y Sagrado Corazón', '-33.00076623930985', '-58.540483117103584', '2024-06-10 23:58:58', '2024-06-10 23:58:58'),
	(91, 'Pedro Perigán y Empleados Municipales', '-33.00089923913643', '-58.54275763034821', '2024-06-10 23:59:44', '2024-06-10 23:59:44'),
	(92, 'Pedro Perigán y 3 de Diciembre', '-33.00109916027444', '-58.54384124279023', '2024-06-11 00:04:40', '2024-06-11 00:04:40'),
	(93, 'Pedro Perigán y Rivenson', '-33.00105417102832', '-58.54505360126496', '2024-06-11 00:05:05', '2024-06-11 00:05:05'),
	(94, 'Pedro Perigán y Boulevard De Maria', '-33.00136459635962', '-58.54988962411881', '2024-06-11 00:05:38', '2024-06-11 00:05:38'),
	(95, '26 de Junio y Clavarino', '-33.00187072227493', '-58.545600771904', '2024-06-11 00:06:15', '2024-06-11 00:06:15'),
	(96, 'Martín Fierro y Juan José Franco', '-33.00309890909033', '-58.54712426662446', '2024-06-11 00:07:00', '2024-06-11 00:07:00'),
	(97, 'Boulevard De Maria y Juan José Franco', '-33.00297772200329', '-58.54965090751649', '2024-06-11 00:07:35', '2024-06-11 00:07:35'),
	(98, 'Boulevard De Maria y Rioja', '-33.00445979209314', '-58.549787700176246', '2024-06-11 00:08:29', '2024-06-11 00:08:29'),
	(99, 'Clavarino y Martín Fierro', '-33.00190699452069', '-58.54687750339508', '2024-06-11 00:09:26', '2024-06-11 00:09:26'),
	(100, 'Bulevard 2 de Abril y María Amelia Cafferata de Frávega', '-32.99740349843014', '-58.536470532417304', '2024-06-11 00:10:48', '2024-06-11 00:10:48'),
	(101, 'Bulevard 2 de Abril y 21 de Septiembre', '-32.997182760475745', '-58.536360561847694', '2024-06-11 00:11:06', '2024-06-11 00:11:06'),
	(102, 'Bulevard 2 de Abril y Héctor Irigoyen', '-32.99714226835793', '-58.53509187698365', '2024-06-11 00:11:52', '2024-06-11 00:11:52'),
	(103, 'Bulevard 2 de Abril y Héctor Irigoyen', '-32.997337980088545', '-58.53518038988114', '2024-06-11 00:12:20', '2024-06-11 00:12:20'),
	(104, 'Bulevard 2 de Abril y Roffo', '-32.99728624024796', '-58.533115088939674', '2024-06-11 00:13:04', '2024-06-11 00:13:04'),
	(105, 'Bulevard 2 de Abril y Roffo', '-32.99709052840258', '-58.53310167789459', '2024-06-11 00:13:22', '2024-06-11 00:13:22'),
	(106, 'Bulevard 2 de Abril y Velez Sarsfield', '-32.99707703101793', '-58.53096932172776', '2024-06-11 00:14:56', '2024-06-11 00:14:56'),
	(107, 'Bulevard 2 de Abril y Velez Sarsfield', '-32.99725024729749', '-58.530988097190864', '2024-06-11 00:15:19', '2024-06-11 00:15:19'),
	(108, 'Bulevard 2 de Abril y Alsina', '-32.99697158262929', '-58.52852046489716', '2024-06-11 00:16:02', '2024-06-11 00:16:02'),
	(110, 'Bulevard 2 de Abril y Schachtel', '-32.99702529102432', '-58.526827991008766', '2024-06-11 00:51:48', '2024-06-11 00:51:48'),
	(111, 'Bulevard 2 de Abril y Schachtel', '-32.99727274289325', '-58.526870906353004', '2024-06-11 00:52:10', '2024-06-11 00:52:10'),
	(112, 'Puerto Argentino y Teresa Margalot', '-32.998878913607804', '-58.525452017784126', '2024-06-11 00:54:08', '2024-06-11 00:54:08'),
	(113, 'Bulevar Montana y Puerto Argentino', '-32.99892165444594', '-58.52530717849732', '2024-06-11 00:55:39', '2024-06-11 00:55:39'),
	(114, 'Bulevar Montana y Avenida Primera Junta', '-32.99920959218427', '-58.52169424295426', '2024-06-11 00:59:22', '2024-06-11 00:59:22'),
	(115, 'Bulevar Montana y Avenida Primera Junta', '-32.99942554487137', '-58.52193027734757', '2024-06-11 00:59:37', '2024-06-11 00:59:37'),
	(116, 'Bulevar Montana e Yrigoyen', '-32.999355810207284', '-58.51963698863984', '2024-06-26 00:16:16', '2024-06-26 00:16:16'),
	(117, 'Bulevar Montana e Yrigoyen', '-32.99917360001838', '-58.519634306430824', '2024-06-26 00:16:35', '2024-06-26 00:16:35'),
	(118, 'Bulevar Montana y Fray Mocho', '-32.99911736222975', '-58.517638742923744', '2024-06-26 00:17:34', '2024-06-26 00:17:34'),
	(119, 'Bulevar Montana y Fray Mocho', '-32.99925908138842', '-58.51778358221055', '2024-06-26 00:17:56', '2024-06-26 00:17:56'),
	(120, 'Bulevar Montana y Santiago Díaz', '-32.999025132178815', '-58.51576924324036', '2024-06-26 00:18:43', '2024-06-26 00:18:43'),
	(121, 'Bulevar Montana y Santiago Díaz', '-32.999166851485626', '-58.51589262485505', '2024-06-26 00:18:57', '2024-06-26 00:18:57'),
	(122, 'Bulevar Montana y 9 de Julio', '-32.99896214574717', '-58.51394802331925', '2024-06-26 00:19:51', '2024-06-26 00:19:51'),
	(123, 'Bulevar Montana y 9 de Julio', '-32.99911736222975', '-58.514119684696205', '2024-06-26 00:20:29', '2024-06-26 00:20:29'),
	(124, 'Bulevar Montana y San José', '-32.99888791168072', '-58.51242184638978', '2024-06-26 00:23:25', '2024-06-26 00:23:25'),
	(125, 'Bulevar Montana y San José', '-32.999148855395795', '-58.51241648197175', '2024-06-26 00:24:04', '2024-06-26 00:24:04'),
	(126, 'Bulevar Montana y Belgrano', '-32.998901408788356', '-58.51155012845993', '2024-06-26 00:29:56', '2024-06-26 00:29:56'),
	(127, 'Bulevar Montana y Belgrano', '-32.99908586905247', '-58.5115259885788', '2024-06-26 00:38:49', '2024-06-26 00:38:49'),
	(128, 'Bulevar Montana y 1 de Mayo', '-32.99898464090649', '-58.50888669490815', '2024-06-26 00:39:18', '2024-06-26 00:39:18'),
	(129, 'Bulevar Montana y 1 de Mayo', '-32.99897114381158', '-58.50868284702302', '2024-06-26 00:39:32', '2024-06-26 00:39:32'),
	(130, 'San José y Perito Moreno', '-32.99826479296347', '-58.51230114698411', '2024-06-26 00:40:25', '2024-06-26 00:40:25'),
	(131, 'San José y Perito Moreno', '-32.99811182451898', '-58.512491583824165', '2024-06-26 00:40:37', '2024-06-26 00:40:37'),
	(132, 'San José y Arturo Jauretche', '-32.99675084359441', '-58.512370884418495', '2024-06-26 00:41:35', '2024-06-26 00:41:35'),
	(133, 'San José y Arturo Jauretche', '-32.99661136998323', '-58.51254791021348', '2024-06-26 00:41:49', '2024-06-26 00:41:49'),
	(134, 'San José y Juan Lapalma', '-32.995236868249435', '-58.512462079525', '2024-06-26 00:42:17', '2024-06-26 00:42:17'),
	(135, 'San José y Juan Lapalma', '-32.9950816449406', '-58.512633740901954', '2024-06-26 00:42:27', '2024-06-26 00:42:27'),
	(136, 'Juan Lapalma y 9 de Julio', '-32.995191876014104', '-58.51418137550355', '2024-06-26 00:43:03', '2024-06-26 00:43:03'),
	(137, 'Juan Lapalma y 9 de Julio', '-32.9953560975621', '-58.514350354671485', '2024-06-26 00:43:15', '2024-06-26 00:43:15'),
	(138, 'Juan Lapalma y Santiago Díaz', '-32.99526836280051', '-58.51561903953553', '2024-06-26 00:43:46', '2024-06-26 00:43:46'),
	(139, 'Juan Lapalma y Santiago Díaz', '-32.99541683696133', '-58.51580142974854', '2024-06-26 00:43:58', '2024-06-26 00:43:58'),
	(140, 'Juan Lapalma y Hector Galguera', '-32.99525289672771', '-58.51890206336976', '2024-06-26 00:45:05', '2024-06-26 00:45:05'),
	(141, 'Juan Lapalma y Hector Galguera', '-32.995403339320674', '-58.5190173983574', '2024-06-26 00:45:40', '2024-06-26 00:45:40'),
	(142, 'Juan Lapalma y Magnasco', '-32.99481843957554', '-58.52017879486084', '2024-06-26 00:46:09', '2024-06-26 00:46:09'),
	(143, 'Juan Lapalma y Magnasco', '-32.99492867097782', '-58.52031558752061', '2024-06-26 00:46:20', '2024-06-26 00:46:20'),
	(144, 'Juan Lapalma y Avenida Primera Junta', '-32.99437104489406', '-58.52183640003205', '2024-06-26 00:46:52', '2024-06-26 00:46:52'),
	(145, 'Magnasco y Federación', '-32.99215034771679', '-58.519859611988075', '2024-06-26 00:48:07', '2024-06-26 00:48:07'),
	(146, 'Roffo y Héctor Maya', '-32.9962922107895', '-58.5333001613617', '2024-06-26 00:51:13', '2024-06-26 00:51:13'),
	(147, 'Roffo y Héctor Maya', '-32.99623372157862', '-58.53312313556672', '2024-06-26 00:51:23', '2024-06-26 00:51:23'),
	(148, 'Roffo y Maestra Piaggio', '-32.99520790450057', '-58.53340208530427', '2024-06-26 00:51:43', '2024-06-26 00:51:43'),
	(149, 'Roffo y Maestra Piaggio', '-32.995392372486116', '-58.533192873001106', '2024-06-26 00:52:02', '2024-06-26 00:52:02'),
	(150, 'Roffo y Alférez José María Sobral', '-32.994101088489344', '-58.53336989879609', '2024-06-26 00:52:29', '2024-06-26 00:52:29'),
	(151, 'Roffo y Alférez José María Sobral', '-32.99421328922035', '-58.533225059509284', '2024-06-26 00:52:39', '2024-06-26 00:52:39'),
	(152, 'Roffo y Federación', '-32.990177628860955', '-58.53252768516541', '2024-06-26 00:53:09', '2024-06-26 00:53:09'),
	(153, 'Federación y Roffo', '-32.989930719533056', '-58.532731533050544', '2024-06-26 00:53:22', '2024-06-26 00:53:22'),
	(154, 'Omar Torrijos y Salvador Allende', '-32.98809490733549', '-58.533793687820435', '2024-06-26 00:54:03', '2024-06-26 00:54:03'),
	(155, 'Alsina y Miguel de Cervantes', '-33.000071431459325', '-58.52888524532319', '2024-06-26 01:43:53', '2024-06-26 01:43:53'),
	(156, 'Alsina y Miguel de Cervantes', '-33.00010250250598', '-58.52851778268815', '2024-06-26 01:44:20', '2024-06-26 01:44:20'),
	(157, 'Alsina y Jujuy', '-33.00374997050992', '-58.52841049432755', '2024-06-26 01:45:07', '2024-06-26 01:45:07'),
	(160, 'Alsina y Jujuy', '-33.00354457246818', '-58.52882623672486', '2024-06-26 01:46:28', '2024-06-26 01:46:28'),
	(163, 'Alsina y San Juan', '-33.00526956375162', '-58.528340756893165', '2024-06-26 01:55:40', '2024-06-26 01:55:40'),
	(164, 'Alsina y San Juan', '-33.005149082571066', '-58.52869346737862', '2024-06-26 01:55:56', '2024-06-26 01:55:56'),
	(165, 'Alsina y Colombo', '-33.00672699342156', '-58.52867871522904', '2024-06-26 01:57:49', '2024-06-26 01:57:49'),
	(166, 'Alsina y Colombo', '-33.00687432364247', '-58.528250902891166', '2024-06-26 01:58:03', '2024-06-26 01:58:03'),
	(167, 'Alsina y Luis N. Palma', '-33.0084751181087', '-58.52864921092988', '2024-06-26 01:58:33', '2024-06-26 01:58:33'),
	(168, 'Alsina y Luis N. Palma', '-33.00862778742543', '-58.52861166000367', '2024-06-26 01:58:45', '2024-06-26 01:58:45'),
	(169, 'Roffo y Teresa Margalot', '-32.99844728622036', '-58.533262610435486', '2024-06-26 02:05:13', '2024-06-26 02:05:13'),
	(170, 'Roffo y Teresa Margalot', '-32.998536986157426', '-58.53308022022248', '2024-06-26 02:05:26', '2024-06-26 02:05:26'),
	(171, 'Roffo y Juan Esteban Díaz', '-33.000084647199955', '-58.533262610435486', '2024-06-26 02:05:56', '2024-06-26 02:05:56'),
	(172, 'Roffo y Juan Esteban Díaz', '-33.0002802118114', '-58.533077538013465', '2024-06-26 02:06:08', '2024-06-26 02:06:08'),
	(173, 'Juan Esteban Díaz y Ramirez', '-33.00042684983742', '-58.531449437141426', '2024-06-26 02:06:29', '2024-06-26 02:06:29'),
	(174, 'Juan Esteban Díaz y Velez Sarsfield', '-33.000642799545105', '-58.53110074996949', '2024-06-26 02:06:45', '2024-06-26 02:06:45'),
	(175, 'Santa Fe y Luis N. Palma', '-33.00819367729442', '-58.52250427007676', '2024-06-26 02:11:52', '2024-06-26 02:11:52'),
	(176, 'Luis N. Palma y Rosario', '-33.00786753097168', '-58.5127142071724', '2024-06-26 02:12:17', '2024-06-26 02:12:17'),
	(177, 'Luis N. Palma y San José', '-33.00789002386025', '-58.511799573898315', '2024-06-26 02:12:33', '2024-06-26 02:12:33'),
	(178, 'Avenida Luis N. Palma y República Oriental', '-33.00765609753882', '-58.50920319557191', '2024-06-26 02:13:08', '2024-06-26 02:13:08'),
	(179, 'Avenida Luis N. Palma y República Oriental', '-33.00795075463071', '-58.50932389497758', '2024-06-26 02:13:21', '2024-06-26 02:13:21'),
	(180, 'Avenida Luis N. Palma y Victoria', '-33.007608862340945', '-58.50742489099503', '2024-06-26 02:13:36', '2024-06-26 02:13:36'),
	(181, 'Avenida Luis N. Palma y Victoria', '-33.00789227314879', '-58.50745707750321', '2024-06-26 02:14:03', '2024-06-26 02:14:03'),
	(182, 'Avenida Luis N. Palma y Brasil', '-33.00750342654014', '-58.504986763000495', '2024-06-26 02:21:52', '2024-06-26 02:21:52'),
	(183, 'Avenida Luis N. Palma y Brasil', '-33.007796537754544', '-58.50471585988999', '2024-06-26 02:22:23', '2024-06-26 02:22:23'),
	(184, 'Avenida Luis N. Palma y Patico Daneri', '-33.00749414818363', '-58.50327819585801', '2024-06-26 02:23:18', '2024-06-26 02:23:18'),
	(185, 'Avenida Luis N. Palma y Patico Daneri', '-33.00774480404744', '-58.50303679704667', '2024-06-26 02:23:56', '2024-06-26 02:23:56'),
	(186, 'Avenida Luis N. Palma y Boulevard José de León', '-33.00752887172494', '-58.501333594322205', '2024-06-26 02:24:50', '2024-06-26 02:24:50'),
	(187, 'Avenida Luis N. Palma y Costanera Norte Morrogh Bernard', '-33.00776167373787', '-58.50141674280167', '2024-06-26 02:25:03', '2024-06-26 02:25:03'),
	(188, 'Rosario y Ituzaingó', '-33.005627069949995', '-58.51268336176874', '2024-06-27 01:13:20', '2024-06-27 01:13:20'),
	(189, 'Ituzaingó y Belgrano', '-33.00560499823689', '-58.510994911193855', '2024-06-27 01:15:24', '2024-06-27 01:15:24');
 */
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Rioja y Rio Gallegos', '-33.004133', '-58.538857', '2024-05-28 22:15:52', '2024-05-28 22:15:52');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('13 de junio y Rioja', '-33.004408', '-58.544392', '2024-05-28 22:43:56', '2024-05-28 22:43:56');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Rioja y Del Inmigrante', '-33.004376', '-58.543009', '2024-05-28 22:45:02', '2024-05-28 22:45:02');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Rioja y Sagrado Corazon', '-33.004147', '-58.539965', '2024-05-28 19:45:02', '2024-05-28 19:45:02');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y Rioja', '-33.004142', '-58.537108', '2024-05-28 19:45:02', '2024-05-28 19:45:02');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Rioja y Martin Fierro', '-33.004410', '-58.546975', '2024-05-28 23:34:40', '2024-05-28 23:34:40');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y Rioja', '-33.00398995242106', '-58.53740930557252', '2024-05-28 23:50:48', '2024-05-28 23:50:48');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y San Juan', '-33.00548100290519', '-58.53703916072846', '2024-05-28 23:55:48', '2024-05-28 23:55:48');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y San Juan', '-33.00549899770337', '-58.53728860616685', '2024-05-28 23:57:30', '2024-05-28 23:57:30');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y Bernardino Rivadavia', '-33.007300989449284', '-58.53690505027772', '2024-05-29 00:01:51', '2024-05-29 00:01:51');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y Bernardino Rivadavia', '-33.007354972718936', '-58.537210822105415', '2024-05-29 00:03:21', '2024-05-29 00:03:21');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Urquiza y L. N. Palma', '-33.00894718315231', '-58.53684067726136', '2024-06-10 19:20:52', '2024-06-10 19:20:52');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Casa del bananero', '25.85115', '-80.13874', '2024-05-28 23:37:39', '2024-05-28 23:37:39');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Urquiza y L. N. Palma', '-33.00903715357081', '-58.53708744049073', '2024-06-10 19:23:32', '2024-06-10 19:23:32');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y Clavarino', '-33.001875502339175', '-58.53726983070374', '2024-06-10 19:28:43', '2024-06-10 19:28:43');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y Clavarino', '-33.00164577778215', '-58.53760242462159', '2024-06-10 19:29:11', '2024-06-10 19:29:11');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Perigán Y Bvard. Daneri', '-33.00091020528655', '-58.537578284740455', '2024-06-10 19:29:57', '2024-06-10 19:29:57');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y J. E. Díaz', '-33.00002616050298', '-58.53739053010941', '2024-06-10 19:30:48', '2024-06-10 19:30:48');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y Margalot', '-32.998534736630326', '-58.53745222091675', '2024-06-10 19:33:29', '2024-06-10 19:33:29');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y Margalot', '-32.998294036900596', '-58.53773385286332', '2024-06-10 19:34:38', '2024-06-10 19:34:38');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y 2 de abril', '-32.99713102054413', '-58.537825047969825', '2024-06-10 19:35:20', '2024-06-10 19:35:20');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. Daneri y 2 de abril', '-32.997104025785156', '-58.53753805160523', '2024-06-10 19:37:55', '2024-06-10 19:37:55');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. A. Daneri y Gregorio Goyo Aguilar', '-32.99549782276194', '-58.53790283203126', '2024-06-10 19:42:27', '2024-06-10 19:42:27');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. A. Daneri y Gregorio Goyo Aguilar', '-32.995482075528756', '-58.53760778903962', '2024-06-10 19:43:48', '2024-06-10 19:43:48');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. A. Daneri y Maestra Paggio', '-32.994474246759744', '-58.537956476211555', '2024-06-10 19:44:26', '2024-06-10 19:44:26');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. A. Daneri y Maestra Paggio', '-32.9946519674009', '-58.53766947984696', '2024-06-10 19:45:08', '2024-06-10 19:45:08');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bvard. A. Daneri - Cementerio', '-32.99293632961674', '-58.53803157806397', '2024-06-10 20:57:32', '2024-06-10 20:57:32');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Pedro Perigán y Sagrado Corazón', '-33.00076623930985', '-58.540483117103584', '2024-06-10 20:58:58', '2024-06-10 20:58:58');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Pedro Perigán y Empleados Municipales', '-33.00089923913643', '-58.54275763034821', '2024-06-10 20:59:44', '2024-06-10 20:59:44');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Pedro Perigán y 3 de Diciembre', '-33.00109916027444', '-58.54384124279023', '2024-06-10 21:04:40', '2024-06-10 21:04:40');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Pedro Perigán y Rivenson', '-33.00105417102832', '-58.54505360126496', '2024-06-10 21:05:05', '2024-06-10 21:05:05');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Pedro Perigán y Boulevard De Maria', '-33.00136459635962', '-58.54988962411881', '2024-06-10 21:05:38', '2024-06-10 21:05:38');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('26 de Junio y Clavarino', '-33.00187072227493', '-58.545600771904', '2024-06-10 21:06:15', '2024-06-10 21:06:15');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Martín Fierro y Juan José Franco', '-33.00309890909033', '-58.54712426662446', '2024-06-10 21:07:00', '2024-06-10 21:07:00');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Boulevard De Maria y Juan José Franco', '-33.00297772200329', '-58.54965090751649', '2024-06-10 21:07:35', '2024-06-10 21:07:35');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Boulevard De Maria y Rioja', '-33.00445979209314', '-58.549787700176246', '2024-06-10 21:08:29', '2024-06-10 21:08:29');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Clavarino y Martín Fierro', '-33.00190699452069', '-58.54687750339508', '2024-06-10 21:09:26', '2024-06-10 21:09:26');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y María Amelia Cafferata de Frávega', '-32.99740349843014', '-58.536470532417304', '2024-06-10 21:10:48', '2024-06-10 21:10:48');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y 21 de Septiembre', '-32.997182760475745', '-58.536360561847694', '2024-06-10 21:11:06', '2024-06-10 21:11:06');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Héctor Irigoyen', '-32.99714226835793', '-58.53509187698365', '2024-06-10 21:11:52', '2024-06-10 21:11:52');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Héctor Irigoyen', '-32.997337980088545', '-58.53518038988114', '2024-06-10 21:12:20', '2024-06-10 21:12:20');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Roffo', '-32.99728624024796', '-58.533115088939674', '2024-06-10 21:13:04', '2024-06-10 21:13:04');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Roffo', '-32.99709052840258', '-58.53310167789459', '2024-06-10 21:13:22', '2024-06-10 21:13:22');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Velez Sarsfield', '-32.99707703101793', '-58.53096932172776', '2024-06-10 21:14:56', '2024-06-10 21:14:56');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Velez Sarsfield', '-32.99725024729749', '-58.530988097190864', '2024-06-10 21:15:19', '2024-06-10 21:15:19');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Alsina', '-32.99697158262929', '-58.52852046489716', '2024-06-10 21:16:02', '2024-06-10 21:16:02');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Schachtel', '-32.99702529102432', '-58.526827991008766', '2024-06-10 21:51:48', '2024-06-10 21:51:48');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevard 2 de Abril y Schachtel', '-32.99727274289325', '-58.526870906353004', '2024-06-10 21:52:10', '2024-06-10 21:52:10');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Puerto Argentino y Teresa Margalot', '-32.998878913607804', '-58.525452017784126', '2024-06-10 21:54:08', '2024-06-10 21:54:08');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Puerto Argentino', '-32.99892165444594', '-58.52530717849732', '2024-06-10 21:55:39', '2024-06-10 21:55:39');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Avenida Primera Junta', '-32.99920959218427', '-58.52169424295426', '2024-06-10 21:59:22', '2024-06-10 21:59:22');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Avenida Primera Junta', '-32.99942554487137', '-58.52193027734757', '2024-06-10 21:59:37', '2024-06-10 21:59:37');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana e Yrigoyen', '-32.999355810207284', '-58.51963698863984', '2024-06-25 21:16:16', '2024-06-25 21:16:16');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana e Yrigoyen', '-32.99917360001838', '-58.519634306430824', '2024-06-25 21:16:35', '2024-06-25 21:16:35');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Fray Mocho', '-32.99911736222975', '-58.517638742923744', '2024-06-25 21:17:34', '2024-06-25 21:17:34');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Fray Mocho', '-32.99925908138842', '-58.51778358221055', '2024-06-25 21:17:56', '2024-06-25 21:17:56');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Santiago Díaz', '-32.999025132178815', '-58.51576924324036', '2024-06-25 21:18:43', '2024-06-25 21:18:43');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Santiago Díaz', '-32.999166851485626', '-58.51589262485505', '2024-06-25 21:18:57', '2024-06-25 21:18:57');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y 9 de Julio', '-32.99896214574717', '-58.51394802331925', '2024-06-25 21:19:51', '2024-06-25 21:19:51');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y 9 de Julio', '-32.99911736222975', '-58.514119684696205', '2024-06-25 21:20:29', '2024-06-25 21:20:29');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y San José', '-32.99888791168072', '-58.51242184638978', '2024-06-25 21:23:25', '2024-06-25 21:23:25');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y San José', '-32.999148855395795', '-58.51241648197175', '2024-06-25 21:24:04', '2024-06-25 21:24:04');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Belgrano', '-32.998901408788356', '-58.51155012845993', '2024-06-25 21:29:56', '2024-06-25 21:29:56');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y Belgrano', '-32.99908586905247', '-58.5115259885788', '2024-06-25 21:38:49', '2024-06-25 21:38:49');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y 1 de Mayo', '-32.99898464090649', '-58.50888669490815', '2024-06-25 21:39:18', '2024-06-25 21:39:18');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Bulevar Montana y 1 de Mayo', '-32.99897114381158', '-58.50868284702302', '2024-06-25 21:39:32', '2024-06-25 21:39:32');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('San José y Perito Moreno', '-32.99826479296347', '-58.51230114698411', '2024-06-25 21:40:25', '2024-06-25 21:40:25');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('San José y Perito Moreno', '-32.99811182451898', '-58.512491583824165', '2024-06-25 21:40:37', '2024-06-25 21:40:37');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('San José y Arturo Jauretche', '-32.99675084359441', '-58.512370884418495', '2024-06-25 21:41:35', '2024-06-25 21:41:35');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('San José y Arturo Jauretche', '-32.99661136998323', '-58.51254791021348', '2024-06-25 21:41:49', '2024-06-25 21:41:49');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('San José y Juan Lapalma', '-32.995236868249435', '-58.512462079525', '2024-06-25 21:42:17', '2024-06-25 21:42:17');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('San José y Juan Lapalma', '-32.9950816449406', '-58.512633740901954', '2024-06-25 21:42:27', '2024-06-25 21:42:27');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y 9 de Julio', '-32.995191876014104', '-58.51418137550355', '2024-06-25 21:43:03', '2024-06-25 21:43:03');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y 9 de Julio', '-32.9953560975621', '-58.514350354671485', '2024-06-25 21:43:15', '2024-06-25 21:43:15');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y Santiago Díaz', '-32.99526836280051', '-58.51561903953553', '2024-06-25 21:43:46', '2024-06-25 21:43:46');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y Santiago Díaz', '-32.99541683696133', '-58.51580142974854', '2024-06-25 21:43:58', '2024-06-25 21:43:58');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y Hector Galguera', '-32.99525289672771', '-58.51890206336976', '2024-06-25 21:45:05', '2024-06-25 21:45:05');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y Hector Galguera', '-32.995403339320674', '-58.5190173983574', '2024-06-25 21:45:40', '2024-06-25 21:45:40');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y Magnasco', '-32.99481843957554', '-58.52017879486084', '2024-06-25 21:46:09', '2024-06-25 21:46:09');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y Magnasco', '-32.99492867097782', '-58.52031558752061', '2024-06-25 21:46:20', '2024-06-25 21:46:20');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Lapalma y Avenida Primera Junta', '-32.99437104489406', '-58.52183640003205', '2024-06-25 21:46:52', '2024-06-25 21:46:52');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Magnasco y Federación', '-32.99215034771679', '-58.519859611988075', '2024-06-25 21:48:07', '2024-06-25 21:48:07');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Héctor Maya', '-32.9962922107895', '-58.5333001613617', '2024-06-25 21:51:13', '2024-06-25 21:51:13');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Héctor Maya', '-32.99623372157862', '-58.53312313556672', '2024-06-25 21:51:23', '2024-06-25 21:51:23');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Maestra Piaggio', '-32.99520790450057', '-58.53340208530427', '2024-06-25 21:51:43', '2024-06-25 21:51:43');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Maestra Piaggio', '-32.995392372486116', '-58.533192873001106', '2024-06-25 21:52:02', '2024-06-25 21:52:02');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Alférez José María Sobral', '-32.994101088489344', '-58.53336989879609', '2024-06-25 21:52:29', '2024-06-25 21:52:29');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Alférez José María Sobral', '-32.99421328922035', '-58.533225059509284', '2024-06-25 21:52:39', '2024-06-25 21:52:39');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Federación', '-32.990177628860955', '-58.53252768516541', '2024-06-25 21:53:09', '2024-06-25 21:53:09');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Federación y Roffo', '-32.989930719533056', '-58.532731533050544', '2024-06-25 21:53:22', '2024-06-25 21:53:22');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Omar Torrijos y Salvador Allende', '-32.98809490733549', '-58.533793687820435', '2024-06-25 21:54:03', '2024-06-25 21:54:03');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y Miguel de Cervantes', '-33.000071431459325', '-58.52888524532319', '2024-06-25 22:43:53', '2024-06-25 22:43:53');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y Miguel de Cervantes', '-33.00010250250598', '-58.52851778268815', '2024-06-25 22:44:20', '2024-06-25 22:44:20');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y Jujuy', '-33.00374997050992', '-58.52841049432755', '2024-06-25 22:45:07', '2024-06-25 22:45:07');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y Jujuy', '-33.00354457246818', '-58.52882623672486', '2024-06-25 22:46:28', '2024-06-25 22:46:28');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y San Juan', '-33.00526956375162', '-58.528340756893165', '2024-06-25 22:55:40', '2024-06-25 22:55:40');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y San Juan', '-33.005149082571066', '-58.52869346737862', '2024-06-25 22:55:56', '2024-06-25 22:55:56');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y Colombo', '-33.00672699342156', '-58.52867871522904', '2024-06-25 22:57:49', '2024-06-25 22:57:49');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y Colombo', '-33.00687432364247', '-58.528250902891166', '2024-06-25 22:58:03', '2024-06-25 22:58:03');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y Luis N. Palma', '-33.0084751181087', '-58.52864921092988', '2024-06-25 22:58:33', '2024-06-25 22:58:33');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Alsina y Luis N. Palma', '-33.00862778742543', '-58.52861166000367', '2024-06-25 22:58:45', '2024-06-25 22:58:45');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Teresa Margalot', '-32.99844728622036', '-58.533262610435486', '2024-06-25 23:05:13', '2024-06-25 23:05:13');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Teresa Margalot', '-32.998536986157426', '-58.53308022022248', '2024-06-25 23:05:26', '2024-06-25 23:05:26');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Juan Esteban Díaz', '-33.000084647199955', '-58.533262610435486', '2024-06-25 23:05:56', '2024-06-25 23:05:56');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Roffo y Juan Esteban Díaz', '-33.0002802118114', '-58.533077538013465', '2024-06-25 23:06:08', '2024-06-25 23:06:08');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Esteban Díaz y Ramirez', '-33.00042684983742', '-58.531449437141426', '2024-06-25 23:06:29', '2024-06-25 23:06:29');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Juan Esteban Díaz y Velez Sarsfield', '-33.000642799545105', '-58.53110074996949', '2024-06-25 23:06:45', '2024-06-25 23:06:45');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Santa Fe y Luis N. Palma', '-33.00819367729442', '-58.52250427007676', '2024-06-25 23:11:52', '2024-06-25 23:11:52');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Luis N. Palma y Rosario', '-33.00786753097168', '-58.5127142071724', '2024-06-25 23:12:17', '2024-06-25 23:12:17');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Luis N. Palma y San José', '-33.00789002386025', '-58.511799573898315', '2024-06-25 23:12:33', '2024-06-25 23:12:33');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y República Oriental', '-33.00765609753882', '-58.50920319557191', '2024-06-25 23:13:08', '2024-06-25 23:13:08');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y República Oriental', '-33.00795075463071', '-58.50932389497758', '2024-06-25 23:13:21', '2024-06-25 23:13:21');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y Victoria', '-33.007608862340945', '-58.50742489099503', '2024-06-25 23:13:36', '2024-06-25 23:13:36');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y Victoria', '-33.00789227314879', '-58.50745707750321', '2024-06-25 23:14:03', '2024-06-25 23:14:03');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y Brasil', '-33.00750342654014', '-58.504986763000495', '2024-06-25 23:21:52', '2024-06-25 23:21:52');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y Brasil', '-33.007796537754544', '-58.50471585988999', '2024-06-25 23:22:23', '2024-06-25 23:22:23');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y Patico Daneri', '-33.00749414818363', '-58.50327819585801', '2024-06-25 23:23:18', '2024-06-25 23:23:18');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y Patico Daneri', '-33.00774480404744', '-58.50303679704667', '2024-06-25 23:23:56', '2024-06-25 23:23:56');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y Boulevard José de León', '-33.00752887172494', '-58.501333594322205', '2024-06-25 23:24:50', '2024-06-25 23:24:50');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Avenida Luis N. Palma y Costanera Norte Morrogh Bernard', '-33.00776167373787', '-58.50141674280167', '2024-06-25 23:25:03', '2024-06-25 23:25:03');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Rosario y Ituzaingó', '-33.005627069949995', '-58.51268336176874', '2024-06-26 22:13:20', '2024-06-26 22:13:20');
	INSERT INTO `bus_stops` (`direction`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES ('Ituzaingó y Belgrano', '-33.00560499823689', '-58.510994911193855', '2024-06-26 22:15:24', '2024-06-26 22:15:24');

	/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
	/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
	/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
	/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
	/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
