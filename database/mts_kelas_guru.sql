-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sisfomts.absensis
CREATE TABLE IF NOT EXISTS `absensis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_didik_id` bigint unsigned NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` enum('hadir','izin','sakit','alpha') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `absensis_uuid_unique` (`uuid`),
  KEY `absensis_peserta_didik_id_foreign` (`peserta_didik_id`),
  CONSTRAINT `absensis_peserta_didik_id_foreign` FOREIGN KEY (`peserta_didik_id`) REFERENCES `peserta_didiks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.absensis: ~0 rows (approximately)
DELETE FROM `absensis`;

-- Dumping structure for table sisfomts.alumnis
CREATE TABLE IF NOT EXISTS `alumnis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.alumnis: ~0 rows (approximately)
DELETE FROM `alumnis`;

-- Dumping structure for table sisfomts.anggota_rombels
CREATE TABLE IF NOT EXISTS `anggota_rombels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `peserta_didik_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anggota_rombels_peserta_didik_id_foreign` (`peserta_didik_id`),
  KEY `anggota_rombels_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `anggota_rombels_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `anggota_rombels_peserta_didik_id_foreign` FOREIGN KEY (`peserta_didik_id`) REFERENCES `peserta_didiks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.anggota_rombels: ~0 rows (approximately)
DELETE FROM `anggota_rombels`;

-- Dumping structure for table sisfomts.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table sisfomts.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table sisfomts.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table sisfomts.informasi_sekolahs
CREATE TABLE IF NOT EXISTS `informasi_sekolahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.informasi_sekolahs: ~0 rows (approximately)
DELETE FROM `informasi_sekolahs`;

-- Dumping structure for table sisfomts.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table sisfomts.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table sisfomts.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wali_kelas_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_wali_kelas_id_foreign` (`wali_kelas_id`),
  CONSTRAINT `kelas_wali_kelas_id_foreign` FOREIGN KEY (`wali_kelas_id`) REFERENCES `pendidik_tendiks` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.kelas: ~10 rows (approximately)
DELETE FROM `kelas`;
INSERT INTO `kelas` (`id`, `nama_kelas`, `wali_kelas_id`, `created_at`, `updated_at`) VALUES
	(1, '9A', 17, '2025-06-11 11:09:49', '2025-06-11 11:09:49'),
	(2, '9B', 13, '2025-06-11 11:10:26', '2025-06-11 11:10:26'),
	(3, '9C', 14, '2025-06-11 11:11:00', '2025-06-11 11:11:00'),
	(4, '9D', 20, '2025-06-11 11:11:33', '2025-06-11 11:11:33'),
	(5, '9E', 5, '2025-06-11 11:12:12', '2025-06-11 11:12:12'),
	(6, '8A', 11, '2025-06-11 11:12:50', '2025-06-11 11:12:50'),
	(7, '8B', 17, '2025-06-11 11:13:31', '2025-06-11 11:13:31'),
	(8, '8C', 13, '2025-06-11 11:14:08', '2025-06-11 11:14:08'),
	(9, '8D', 13, '2025-06-11 11:14:38', '2025-06-11 11:14:38'),
	(10, '8E', 20, '2025-06-11 11:15:14', '2025-06-11 11:15:14'),
	(11, '8F', 14, '2025-06-11 11:16:01', '2025-06-11 11:16:01'),
	(12, 'NOKELAS', 20, '2025-06-11 11:16:33', '2025-06-11 11:16:33');

-- Dumping structure for table sisfomts.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_05_09_071239_laratrust_setup_tables', 1),
	(5, '2025_05_10_063739_create_pendidik_tendiks_table', 1),
	(6, '2025_05_10_063815_create_kelas_table', 1),
	(7, '2025_05_10_063843_create_peserta_didiks_table', 1),
	(8, '2025_05_10_063905_create_alumnis_table', 1),
	(9, '2025_05_10_063909_create_anggota_rombels_table', 1),
	(10, '2025_05_10_063941_create_informasi_sekolahs_table', 1),
	(11, '2025_05_10_064011_create_sekolahs_table', 1),
	(12, '2025_05_10_064036_create_absensis_table', 1),
	(13, '2025_05_10_064111_create_prestasis_table', 1),
	(14, '2025_05_10_064140_create_sarana_prasaranas_table', 1),
	(15, '2025_06_10_133849_create_suaramadrasahs_table', 1);

-- Dumping structure for table sisfomts.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table sisfomts.pendidik_tendiks
CREATE TABLE IF NOT EXISTS `pendidik_tendiks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nuptk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `nrg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pendidik_tendiks_uuid_unique` (`uuid`),
  KEY `pendidik_tendiks_user_id_foreign` (`user_id`),
  CONSTRAINT `pendidik_tendiks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.pendidik_tendiks: ~32 rows (approximately)
DELETE FROM `pendidik_tendiks`;
INSERT INTO `pendidik_tendiks` (`id`, `uuid`, `nuptk`, `nip`, `user_id`, `nrg`, `npwp`, `created_at`, `updated_at`) VALUES
	(2, 'c5d0b1bc-8e97-431d-b71e-9a5229284d1d', '2237748652300003', '197009051999032003', 4, '081002123001', '14.779.764.1-704.000', '2025-06-11 11:08:45', '2025-06-11 11:08:45'),
	(3, 'fe74c8a2-6b53-4bd3-9803-8df4c4fc5b67', '2547762663210070', '198412152009122000', 5, '-', '15.642.483.0-701.000', '2025-06-11 11:08:45', '2025-06-11 11:08:45'),
	(4, '6abb75f5-23a0-47a3-9f18-cd2dfb5954c1', '2237748652300033', '197007281994032004', 6, '101586927022', '14.860.914.2-704.000', '2025-06-11 11:08:46', '2025-06-11 11:08:46'),
	(5, '58716aab-a552-4200-a33c-82ccaaf9a1b4', '1246759660200003', '198109142005011003', 7, '092271155481', '14.779.772.4-704.000', '2025-06-11 11:08:46', '2025-06-11 11:08:46'),
	(6, '11df697d-efc3-4d9c-8c26-0686e4a2908c', '7245745647300003', '196709132003122002', 8, '080942132001', '14.779.767.4-704.000', '2025-06-11 11:08:47', '2025-06-11 11:08:47'),
	(7, 'c5efd071-9cc8-4dff-9319-6f5ac8df97bf', '3901180147008', '199007182023211000', 9, '-', '82.714.444.5-704.000', '2025-06-11 11:08:47', '2025-06-11 11:08:47'),
	(8, 'd00b69cf-e051-480f-8270-33ff65db2feb', '8956755656300002', '197706242005012006', 10, '101586927022', '72.638.479.5-704.000', '2025-06-11 11:08:48', '2025-06-11 11:08:48'),
	(9, '06efa55b-054e-44f4-8d83-1a589bc3e768', '1746749652300012', '197104142006042034', 11, '084612063003', '14.860.937.3-704.000', '2025-06-11 11:08:48', '2025-06-11 11:08:48'),
	(10, 'e7be71b3-3ab1-47c2-9cc8-fa2529eb24f2', '3954752654300002', '197406222000032005', 12, '132352176040', '77.357.210.2-701.000', '2025-06-11 11:08:49', '2025-06-11 11:08:49'),
	(11, '881fb409-6015-47c1-b44c-f392ca0ac817', '0547759660300042', '198102152005012011', 13, '083417063001', '78.395.321.9-704.000', '2025-06-11 11:08:49', '2025-06-11 11:08:49'),
	(12, 'fe02ce55-74af-4b85-a90e-b9fd0877cc38', '2944756658300062', '197806122005012003', 14, '121802106297', '77.357.301.9-704.000', '2025-06-11 11:08:50', '2025-06-11 11:08:50'),
	(13, '70a210a7-4912-40fd-bb5d-1f77e8438c51', '6035755657300000', '197707032011012000', 15, '082352141452', '14.944.883.9-704.000', '2025-06-11 11:08:50', '2025-06-11 11:08:50'),
	(14, 'e1abfd50-ae13-42e3-ad84-515662a0d8d2', '-', '197905052014112000', 16, '-', '73.185.885.8-704.000', '2025-06-11 11:08:50', '2025-06-11 11:08:50'),
	(15, '1cd56dbe-9c11-4cbf-b06c-fa26a0eb6620', '834274865130003', '197010102014112000', 17, '-', '45.512.551.8-704.000', '2025-06-11 11:08:51', '2025-06-11 11:08:51'),
	(16, '5ba235bc-e88f-4b91-ba5e-29a8e1af64c2', '3344753654300003', '197410122022212005', 18, '112352189005', NULL, '2025-06-11 11:08:51', '2025-06-11 11:08:51'),
	(17, '92f51442-c284-491c-b7f0-c346d8b8c4f4', '9822690096048', '198206292023211010', 19, '192372234490', '73.242.972.5-704.000', '2025-06-11 11:08:52', '2025-06-11 11:08:52'),
	(18, '3be56e72-75ce-4eb8-aec7-1c58396bfb3f', '1902620038097', '199008222023211019', 20, '-', '55.273.425.3-704.000', '2025-06-11 11:08:52', '2025-06-11 11:08:52'),
	(19, '048d8d1b-83c6-4875-ab0c-15157a5f96e9', '8894850132010', '198912052023212047', 21, '-', '73.277.340.3-704.000', '2025-06-11 11:08:53', '2025-06-11 11:08:53'),
	(20, '5f4d8e2e-ceec-4daa-9388-b9de2d440002', '8916400101023', '199111202023212036', 22, '-', '75.100.005.0-704.000', '2025-06-11 11:08:53', '2025-06-11 11:08:53'),
	(21, '9e488bbb-3650-4ba0-931a-584f9a139d58', '2915770220086', '199110172023212050', 23, '-', '76.840.567.2-704.000', '2025-06-11 11:08:54', '2025-06-11 11:08:54'),
	(22, 'b581219a-cf48-4ce7-9682-695c823b19be', '9890770151037', '198901072023211020', 24, '-', '81.169.601.2-704.000', '2025-06-11 11:08:54', '2025-06-11 11:08:54'),
	(23, '41c18360-5a4e-4ecd-808a-413348f23729', '5883010075092', '198805312023211015', 25, '-', '76.820.896.9-704.000', '2025-06-11 11:08:55', '2025-06-11 11:08:55'),
	(24, 'f2f25a19-df58-4c8e-ab5e-5be1f4a91ce3', '8902400277069', '199007202023212046', 26, '-', '76.793.840.0-704.000', '2025-06-11 11:08:55', '2025-06-11 11:08:55'),
	(25, '221c40ce-b500-401a-a447-3d5cb26ec207', '8951470117052', '199507172023212046', 27, '-', '83.836.663.1-704.000', '2025-06-11 11:08:56', '2025-06-11 11:08:56'),
	(26, 'cbe80124-3d32-40de-ac70-2db000e4da3f', '8975410000098', '199710112023212014', 28, '-', '93.570.084.9-704.000', '2025-06-11 11:08:56', '2025-06-11 11:08:56'),
	(27, '0da1ad80-d017-44ec-9f65-031229e4a706', '8904130200095', '199010032023212000', 29, '-', '76.802.878.9-704.000', '2025-06-11 11:08:57', '2025-06-11 11:08:57'),
	(28, '79c32824-6514-4053-8f80-a438dbd93a0b', '6862330266063', '198606232023212029', 30, '-', '75.554.055.3-704.000', '2025-06-11 11:08:57', '2025-06-11 11:08:57'),
	(29, 'a6ff09fa-e5a9-4ae1-bed6-bb1313b1bdba', '8844280230095', '', 31, '-', '76.406.813.6-704.000', '2025-06-11 11:08:58', '2025-06-11 11:08:58'),
	(30, 'f7952da0-783b-4457-ab01-5370800c45ab', '2910020221009', '', 32, '-', '82.419.506.9-704.000', '2025-06-11 11:08:58', '2025-06-11 11:08:58'),
	(31, '05c665fd-e304-4630-9fe3-8bfe169f4d97', '8902960212091', '', 33, '-', '90.151.275.6-704.000', '2025-06-11 11:08:58', '2025-06-11 11:08:58'),
	(32, 'a3cf7b45-a70d-47d3-b610-ebef1e7e10f5', '4974640091025', '', 34, '-', '43.017.790.7-704.000', '2025-06-11 11:08:59', '2025-06-11 11:08:59'),
	(33, '94a8f483-1df5-4c86-bc05-9d2058d135b3', '4964540172053', '', 35, '-', '83.405.579.0-704.000', '2025-06-11 11:08:59', '2025-06-11 11:08:59');

-- Dumping structure for table sisfomts.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.permissions: ~0 rows (approximately)
DELETE FROM `permissions`;

-- Dumping structure for table sisfomts.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.permission_role: ~0 rows (approximately)
DELETE FROM `permission_role`;

-- Dumping structure for table sisfomts.permission_user
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.permission_user: ~0 rows (approximately)
DELETE FROM `permission_user`;

-- Dumping structure for table sisfomts.peserta_didiks
CREATE TABLE IF NOT EXISTS `peserta_didiks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nis_lokal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `peserta_didiks_uuid_unique` (`uuid`),
  KEY `peserta_didiks_user_id_foreign` (`user_id`),
  CONSTRAINT `peserta_didiks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.peserta_didiks: ~0 rows (approximately)
DELETE FROM `peserta_didiks`;

-- Dumping structure for table sisfomts.prestasis
CREATE TABLE IF NOT EXISTS `prestasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prestasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peringkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `peserta_didik_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prestasis_peserta_didik_id_foreign` (`peserta_didik_id`),
  CONSTRAINT `prestasis_peserta_didik_id_foreign` FOREIGN KEY (`peserta_didik_id`) REFERENCES `peserta_didiks` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.prestasis: ~0 rows (approximately)
DELETE FROM `prestasis`;

-- Dumping structure for table sisfomts.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.roles: ~3 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'admin', NULL, NULL, '2025-06-11 11:05:08', '2025-06-11 11:05:08'),
	(2, 'guru', NULL, NULL, '2025-06-11 11:05:08', '2025-06-11 11:05:08'),
	(3, 'siswa', NULL, NULL, '2025-06-11 11:05:08', '2025-06-11 11:05:08');

-- Dumping structure for table sisfomts.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.role_user: ~46 rows (approximately)
DELETE FROM `role_user`;
INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
	(1, 1, 'App\\Models\\User'),
	(2, 2, 'App\\Models\\User'),
	(2, 4, 'App\\Models\\User'),
	(2, 5, 'App\\Models\\User'),
	(2, 6, 'App\\Models\\User'),
	(2, 7, 'App\\Models\\User'),
	(2, 8, 'App\\Models\\User'),
	(2, 9, 'App\\Models\\User'),
	(2, 10, 'App\\Models\\User'),
	(2, 11, 'App\\Models\\User'),
	(2, 12, 'App\\Models\\User'),
	(2, 13, 'App\\Models\\User'),
	(2, 14, 'App\\Models\\User'),
	(2, 15, 'App\\Models\\User'),
	(2, 16, 'App\\Models\\User'),
	(2, 17, 'App\\Models\\User'),
	(2, 18, 'App\\Models\\User'),
	(2, 19, 'App\\Models\\User'),
	(2, 20, 'App\\Models\\User'),
	(2, 21, 'App\\Models\\User'),
	(2, 22, 'App\\Models\\User'),
	(2, 23, 'App\\Models\\User'),
	(2, 24, 'App\\Models\\User'),
	(2, 25, 'App\\Models\\User'),
	(2, 26, 'App\\Models\\User'),
	(2, 27, 'App\\Models\\User'),
	(2, 28, 'App\\Models\\User'),
	(2, 29, 'App\\Models\\User'),
	(2, 30, 'App\\Models\\User'),
	(2, 31, 'App\\Models\\User'),
	(2, 32, 'App\\Models\\User'),
	(2, 33, 'App\\Models\\User'),
	(2, 34, 'App\\Models\\User'),
	(2, 35, 'App\\Models\\User'),
	(2, 36, 'App\\Models\\User'),
	(2, 37, 'App\\Models\\User'),
	(2, 38, 'App\\Models\\User'),
	(2, 39, 'App\\Models\\User'),
	(2, 40, 'App\\Models\\User'),
	(2, 41, 'App\\Models\\User'),
	(2, 42, 'App\\Models\\User'),
	(2, 43, 'App\\Models\\User'),
	(2, 44, 'App\\Models\\User'),
	(2, 45, 'App\\Models\\User'),
	(2, 46, 'App\\Models\\User'),
	(3, 3, 'App\\Models\\User');

-- Dumping structure for table sisfomts.sarana_prasaranas
CREATE TABLE IF NOT EXISTS `sarana_prasaranas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `status` enum('Baik','Rusak Ringan','Rusak Berat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.sarana_prasaranas: ~0 rows (approximately)
DELETE FROM `sarana_prasaranas`;

-- Dumping structure for table sisfomts.sekolahs
CREATE TABLE IF NOT EXISTS `sekolahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepala_sekolah_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sekolahs_kepala_sekolah_id_foreign` (`kepala_sekolah_id`),
  CONSTRAINT `sekolahs_kepala_sekolah_id_foreign` FOREIGN KEY (`kepala_sekolah_id`) REFERENCES `pendidik_tendiks` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.sekolahs: ~0 rows (approximately)
DELETE FROM `sekolahs`;

-- Dumping structure for table sisfomts.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.sessions: ~1 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('1pOMqMCt033bQgdOpJD0LCDfhjzBwrvpJ3b1WJfW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSUsxa2dHcEZ1ZkpRejlacXd1MFhnVWZmREhpVUJ1ZEVYMGxiREYzZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZXNpc3dhYW4va2VsYXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YToxODp7aTowO3M6MTg6ImFsZXJ0LmRlbGV0ZS50aXRsZSI7aToxO3M6MTc6ImFsZXJ0LmRlbGV0ZS50ZXh0IjtpOjI7czoyMzoiYWxlcnQuZGVsZXRlLmJhY2tncm91bmQiO2k6MztzOjE4OiJhbGVydC5kZWxldGUud2lkdGgiO2k6NDtzOjIzOiJhbGVydC5kZWxldGUuaGVpZ2h0QXV0byI7aTo1O3M6MjA6ImFsZXJ0LmRlbGV0ZS5wYWRkaW5nIjtpOjY7czoyODoiYWxlcnQuZGVsZXRlLnNob3dDbG9zZUJ1dHRvbiI7aTo3O3M6MzA6ImFsZXJ0LmRlbGV0ZS5jb25maXJtQnV0dG9uVGV4dCI7aTo4O3M6Mjk6ImFsZXJ0LmRlbGV0ZS5jYW5jZWxCdXR0b25UZXh0IjtpOjk7czoyOToiYWxlcnQuZGVsZXRlLnRpbWVyUHJvZ3Jlc3NCYXIiO2k6MTA7czoyNDoiYWxlcnQuZGVsZXRlLmN1c3RvbUNsYXNzIjtpOjExO3M6Mjk6ImFsZXJ0LmRlbGV0ZS5zaG93Q2FuY2VsQnV0dG9uIjtpOjEyO3M6MzE6ImFsZXJ0LmRlbGV0ZS5jb25maXJtQnV0dG9uQ29sb3IiO2k6MTM7czoxNzoiYWxlcnQuZGVsZXRlLmljb24iO2k6MTQ7czozMjoiYWxlcnQuZGVsZXRlLnNob3dMb2FkZXJPbkNvbmZpcm0iO2k6MTU7czoyNzoiYWxlcnQuZGVsZXRlLmFsbG93RXNjYXBlS2V5IjtpOjE2O3M6MzA6ImFsZXJ0LmRlbGV0ZS5hbGxvd091dHNpZGVDbGljayI7aToxNztzOjEyOiJhbGVydC5kZWxldGUiO31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ5NjM5OTQzO31zOjU6ImFsZXJ0IjthOjA6e319', 1749640595);

-- Dumping structure for table sisfomts.suaramadrasahs
CREATE TABLE IF NOT EXISTS `suaramadrasahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_responden` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp_responden` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_aduan` enum('gratifikasi','pengaduan_masyarakat','whistleblowing','kritik_saran') COLLATE utf8mb4_unicode_ci NOT NULL,
  `teks_suara` text COLLATE utf8mb4_unicode_ci,
  `apa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `siapa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapan` date NOT NULL,
  `dimana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mengapa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagaimana` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.suaramadrasahs: ~0 rows (approximately)
DELETE FROM `suaramadrasahs`;

-- Dumping structure for table sisfomts.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_uuid_unique` (`uuid`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisfomts.users: ~45 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `email_verified_at`, `password`, `nik`, `jenis_kelamin`, `no_hp`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, '9052991a-d295-3201-9d0e-32496157781b', 'Admin', 'admin@example.com', NULL, '$2y$12$6KIiDMLaVFw1QcLZs1V8Ged/Tj5ZNf31hSr6Q6QDl5VsvOMZmB54y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:05:09', '2025-06-11 11:05:09'),
	(3, '4d768b65-2825-3585-969b-5b3904c222bb', 'Siswa Sample', 'siswa@example.com', NULL, '$2y$12$uHMKMPIfFuQ45YfBEM8oZehmykViPT8REu/WF0Bu1PnKxUtZkGWAa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:05:10', '2025-06-11 11:05:10'),
	(4, '714f232b-3705-4088-bd7e-54d763e5645c', 'Tutik Rusmawati, M.Pd', 'rand1@sekolah.com', NULL, '$2y$12$C1sZM.YXuvbotF1XSGW30OACYDBhQiFKuzZKCnnP4ok7w.YZVEnma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:45', '2025-06-11 11:08:45'),
	(5, '569b0237-5197-4bab-8f62-1dac3d1fa2e4', 'Neni Windyarti, S.Pd', 'rand2@sekolah.com', NULL, '$2y$12$iRT83taRLzmnGOntTjIqnOPneXhPkkOlUMtNyZD9spodkRzv48yJ.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:45', '2025-06-11 11:08:45'),
	(6, '2aa8d698-1534-4610-9111-6048465358e0', 'Emy Hayati, S.Pd.Ing', 'rand3@sekolah.com', NULL, '$2y$12$baXGdW4LLwIwGvKkM9gnbuSH1Ha9qmZl9yGj9D3wOhpb7dHRLUp1.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:46', '2025-06-11 11:08:46'),
	(7, '507f3dad-d1ca-4200-98d0-642d4bb66735', 'Fahrurrazi, S.Pd', 'rand4@sekolah.com', NULL, '$2y$12$i4QkPZ6gOYBkhKnGsD9.buh5IhfMBOOuZIkPmEzszb9c229XuImKm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:46', '2025-06-11 11:08:46'),
	(8, 'bf1f8033-949c-409c-9e03-0fc03c0a6a8f', 'Yatmiarti, S.Pd', 'rand5@sekolah.com', NULL, '$2y$12$ShbrzCueANWlcm7IKKE/4.NJ7KZZsuiMbsJEVse/FVT0/mRtEmrpi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:47', '2025-06-11 11:08:47'),
	(9, 'aa87f29b-28da-41e1-9aa1-a2f7643efcd9', 'Juliyansah, S.Pd', 'rand6@sekolah.com', NULL, '$2y$12$WNoSNrQofZG0M8LZzS3eHenXr6igqzO7lcQ0rRipIDy7l.nt/G7u6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:47', '2025-06-11 11:08:47'),
	(10, '38fc40e5-7588-4b06-bc4c-4e7793392ded', 'Nurbaiti, S.Pd', 'rand7@sekolah.com', NULL, '$2y$12$OoYtG4Nl8P7YAn9kYZiDZuSSeZNxlSgSpRgJ5GERwESHvMQAI1oAG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:48', '2025-06-11 11:08:48'),
	(11, '5a23bce0-1143-4be1-b5ae-9f554fa0b99a', 'Yulianti, S.Ag', 'rand8@sekolah.com', NULL, '$2y$12$SU/z/1aAIaVaXbmXfp6Ho.LwfWuck/IkHKbB6QseWfnleFDX8heJK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:48', '2025-06-11 11:08:48'),
	(12, '0780cc37-5f21-4d57-84e7-6ee3732a08a1', 'Roslinah, S.Pd.I', 'rand9@sekolah.com', NULL, '$2y$12$p63VOhumCQmAjakVngYtNexiGuWSjSjlnQB2sbPpyuVxH1eNNfgQ.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:49', '2025-06-11 11:08:49'),
	(13, '5ad05507-28d4-4220-a99a-2aad97dffb39', 'Murdiati, S.Pd', 'rand10@sekolah.com', NULL, '$2y$12$l6eeDQNpY.ccitDNwV14wukxowfa1rVqdJwOxnZgxzGa4GZumo8GG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:49', '2025-06-11 11:08:49'),
	(14, 'c5e223fe-8f8b-46ed-91a1-7a1e420cb87c', 'Netti Herawati, S.Pd', 'rand11@sekolah.com', NULL, '$2y$12$vJxGX.9a2BeYDZv2mKxeAOUfHVQFAnaAGcaur7l6WK5Uymu7ruRJC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:50', '2025-06-11 11:08:50'),
	(15, 'f05e79ff-5a15-42b6-9dbc-94ac2a5e517c', 'Aslinda, S.Pd.I', 'rand12@sekolah.com', NULL, '$2y$12$ElBVqmBmgDUVOmhUX1XYRetj8SfV55aQymKQbqGBkPfufP3DCT7Z2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:50', '2025-06-11 11:08:50'),
	(16, 'f2a4e92e-5444-4432-878f-529daac47fdb', 'Desy Hartati, A.Md', 'rand13@sekolah.com', NULL, '$2y$12$/Rit41NFaoE5CjaL8iKSQOqmOrmCf3TKS4Tc9ITTyNZwFOY3Nbrvq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:50', '2025-06-11 11:08:50'),
	(17, '044a914e-fc09-4060-b468-6e0ea9b78efc', 'Hj. Yusnani, S.A.P', 'rand14@sekolah.com', NULL, '$2y$12$VxDUH3SGaEOBFf6ddlFtmudTAU/rV6o7jFqLynyKZWBLCnhm8GyUq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:51', '2025-06-11 11:08:51'),
	(18, 'b9b42c0c-d569-4c4d-9ce6-e4e73f15543a', 'Hajimah, S.Ag', 'rand15@sekolah.com', NULL, '$2y$12$eaBL9XTr8yaeP/dwDFcVoeWegWewMUYc42428tdy3vctycVHlO44O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:51', '2025-06-11 11:08:51'),
	(19, 'e333dff4-0ea1-4697-9d35-afb1d5b46e8a', 'Ahmad, S.HI', 'rand16@sekolah.com', NULL, '$2y$12$5wUuGvmWMyQ7VIhNtc0mW.GDy/pIdrJPozYSjXXidV.byUc7u.cEm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:52', '2025-06-11 11:08:52'),
	(20, '6870d29c-ea1f-4197-8618-aaabe00052a8', 'Ya\' Agus Sumantri,S.Pd', 'rand17@sekolah.com', NULL, '$2y$12$UBdPOMfQmi21yDMyp1Pw5O/jAsYvQ73LqvwGmd7xMG0Tp5j6MTkom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:52', '2025-06-11 11:08:52'),
	(21, '2c564875-443e-4a12-bb8c-8f0b5a3e0e71', 'Ita Darlina, S.Pd', 'rand18@sekolah.com', NULL, '$2y$12$LiVZWK984t1lA.IzUTDnw.lf3oxh62UFcpGwW2hpkSLDQPGA1zN7G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:53', '2025-06-11 11:08:53'),
	(22, '2bea7816-f09b-4e7c-bb3d-a4d258dd572e', 'Emmy Novyanti, S.Pd', 'rand19@sekolah.com', NULL, '$2y$12$3kQ67VzcxW6zLQPXbbZ/8e5jG5//RKUo6QNmjOj9TcEasY2YpbuMu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:53', '2025-06-11 11:08:53'),
	(23, 'e630cfb1-eb4a-4208-98de-124113e7214a', 'Fitrah Amaliah, S.Pd.I', 'rand20@sekolah.com', NULL, '$2y$12$uwYZ3crYiLT7RSA355zEWOHSQAJnOg73CQqujVBmYNybxYjqRkKuS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:54', '2025-06-11 11:08:54'),
	(24, 'da4cf797-89fa-4b41-bb37-b6917d9832f4', 'Sulaiman, M.Pd.I', 'rand21@sekolah.com', NULL, '$2y$12$qIvHAd/1gu7UkvdMVmqnbeGeXiREeCXJYy5G1nAKpXrqLo.v3OKdy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:54', '2025-06-11 11:08:54'),
	(25, '8d3cbc98-7c9a-43b1-978b-732dc8fdc6ad', 'Ridwansyah, S.Pd', 'rand22@sekolah.com', NULL, '$2y$12$nD6x2rEYIqLjQm.GZVIOiuur/UI5pdbrshyqqQ/w0.1TbzlIMWEku', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:55', '2025-06-11 11:08:55'),
	(26, 'fb3ba6bb-ae28-4f58-a31d-a286248463d4', 'Lily Amaliyatussoliha, S.Pd', 'rand23@sekolah.com', NULL, '$2y$12$kuFSiHpmvaFrQXw4Cy83T.g0yySVd/7P7Lvn8GJCbp34QUTCuPHvC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:55', '2025-06-11 11:08:55'),
	(27, '4b259167-7383-41db-8fd2-cd4982f2a474', 'Putri Yuliandari, S.Pd', 'rand24@sekolah.com', NULL, '$2y$12$/sgdgDWv4V3O0waqkQcpeu3.OL2wcZO54zawLRltWYoGC3.rdjiHa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:56', '2025-06-11 11:08:56'),
	(28, '2697befb-9d7b-49c9-84f0-221397de9dba', 'Putri Oktarilla Murti, S.Pd', 'rand25@sekolah.com', NULL, '$2y$12$DCvCqvRuIjNgmepPWlCf7OSAq7pSoGhgXbGnK5QwLmw8FUDqOmixO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:56', '2025-06-11 11:08:56'),
	(29, '76cd9ae2-ab9e-4b2a-b740-027fdbf92b2a', 'Tri Tika Maulina, S.Pd', 'rand26@sekolah.com', NULL, '$2y$12$cIDkWgIp0INDRqHDEk/m/eNJtCeV8/Qop6asqxEHYuAW1VcDkhOEO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:57', '2025-06-11 11:08:57'),
	(30, '5fc66046-f08b-46d4-a0d0-aa0ada0d8dae', 'Wiwin Saputri, S.Pd', 'rand27@sekolah.com', NULL, '$2y$12$V3H2W.vRcNQymIYysGB6zu.V/MRqb9ieFp0NDGlLUfExoxSpi/6wO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:57', '2025-06-11 11:08:57'),
	(31, '45939b7c-e6d0-4e6a-97cd-ff714ec90806', 'Wahdaniah, S.Pd', 'rand28@sekolah.com', NULL, '$2y$12$wmUisdo5Ozl3XvqS4k2//ecvxKo6sTY04IDK35JY8dWBZ4TynTq7i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:58', '2025-06-11 11:08:58'),
	(32, '9dcc1a21-4771-4ab5-8250-36b83f161c70', 'Musaina, S.Pd.I', 'rand29@sekolah.com', NULL, '$2y$12$FrPeIgWGe96/.Zp6rv3PMOZtLVxVstVzFq9e76JBdhajJNXoPQRJ6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:58', '2025-06-11 11:08:58'),
	(33, '3f689481-ca6a-41c3-93b6-b52ff50ff7f5', 'Yeni Anggreni, S.Pd', 'rand30@sekolah.com', NULL, '$2y$12$DXL8yS7YM2aaIfEPUTUaB.2bGu3xN7NaaSbv6DXbs5uGD7L8ew4Iy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:58', '2025-06-11 11:08:58'),
	(34, '682de5fd-8b42-4f61-a332-bd2f53d4d156', 'Khusnul Hatimah, S.Pd', 'rand31@sekolah.com', NULL, '$2y$12$rQ9L4O2XKKKNxjnmyine9.Kw2gmCTUOdPfJ5bsUR/8aZjrwi2QASO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:59', '2025-06-11 11:08:59'),
	(35, '90d3f763-91e9-475c-9a98-61cddf6da82c', 'Miranda Putri Deana, S.Pd', 'rand32@sekolah.com', NULL, '$2y$12$xgVlMUdB1t460ttTTvelQOGj7UEEgdAFMJjCB338F/DGIGIgSk4Ce', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:08:59', '2025-06-11 11:08:59'),
	(36, '5ad23676-8ca2-4af0-bd0a-40edda565fb0', 'Irawati, S.Pd', 'rand33@sekolah.com', NULL, '$2y$12$8MLwLKr6bCLyk98cJyPQC.uuc0W8URQUOFCJAPaDtbIy0dfmzpqg6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:00', '2025-06-11 11:09:00'),
	(37, '251ab305-0ab4-4626-a756-833c2f7c9de5', 'Agus Saputra, S.Pd', 'rand34@sekolah.com', NULL, '$2y$12$Jxo9ljxCjRjxkaVR7txdVewOxClz3e16U0YzzMaHVE84W8OVcHW7u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:00', '2025-06-11 11:09:00'),
	(38, 'ddb3173e-058a-45a7-b511-8f0ae69a3a65', 'Hutianas Muhar Pratami, S.Pd', 'rand35@sekolah.com', NULL, '$2y$12$zHjQTCLTNDDFpP0YnKRq5ejXhsyezUmlvOHlp1DnJrMADEq33MV0q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:01', '2025-06-11 11:09:01'),
	(39, 'b059f2a7-3cb4-4ecf-8a5b-01418be682a4', 'Muhammad Zaki Noviandi, S.Kom', 'rand36@sekolah.com', NULL, '$2y$12$W0z90F9tR6dsqWIEol7O.upO/sakPZdEOL53lYAc6QqRkiTCOOzNy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:01', '2025-06-11 11:09:01'),
	(40, 'f9e82cbe-a0f4-48d3-b66f-45d26936ca35', 'Siti Nurhidayati', 'rand37@sekolah.com', NULL, '$2y$12$SjYouHYyNHNjoe4b7vEImuMlikQzwfFyua96cCnBIEQ6y0qUnl.Gu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:02', '2025-06-11 11:09:02'),
	(41, '4146c890-38e5-4375-a54c-4566a07866f4', 'Novita Purnamasari, S.A.P', 'rand38@sekolah.com', NULL, '$2y$12$fmosTUA/pZAZzyArMjC9BuMwD1aIzO/AgJ2Gk34OYTF2zstkDrh6C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:02', '2025-06-11 11:09:02'),
	(42, 'ff1e7dbe-09c0-45dc-8767-c9c9afa76286', 'Syamsiah, A.ma.Perpus', 'rand39@sekolah.com', NULL, '$2y$12$k8rS8UKfZjUf2jHlhmk3qOECZQHCP0XFpWFT32.KQdPTRglBkwtI6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:03', '2025-06-11 11:09:03'),
	(43, 'dc325307-4bf6-44d6-94c5-cae429aacb46', 'Sartono', 'rand40@sekolah.com', NULL, '$2y$12$mdgHZUvBrdFkUlaJw2oCIe3O/4pjVdJ4Pj04rZp6tOKfs0JXo6rPm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:03', '2025-06-11 11:09:03'),
	(44, '8b322d78-0985-4974-9966-442a73cea30c', 'Rian Permana Putra', 'rand41@sekolah.com', NULL, '$2y$12$F6NBjbQB/CHmgNFXrGbw2u5zl2co6NdcjwycUwtLXcQ.obcsaQSPq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:04', '2025-06-11 11:09:04'),
	(45, '5b1dc112-619e-4bfe-88fc-9ffc2ff99630', 'Dwi Agus Yosi, A.ma.Perpus', 'rand42@sekolah.com', NULL, '$2y$12$K4KxOdKFT01ezZhVksVn/eGaAE/STtfZiHL2w5/5SjHmj3TbFI.FG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:04', '2025-06-11 11:09:04'),
	(46, '8723187c-b72c-4336-a59a-968ce5e82148', 'Zainal Abidin', 'rand43@sekolah.com', NULL, '$2y$12$5wpmG1Px2PGk0u0nFix/h.3K.CcAM7O3cVMbU60CnDcsbaCH4lEjG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 11:09:04', '2025-06-11 11:09:04');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
