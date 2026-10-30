-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: hotel_loyalty
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guests`
--

DROP TABLE IF EXISTS `guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_number` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `tier` varchar(20) NOT NULL DEFAULT 'Silver',
  `points` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guests_member_number_unique` (`member_number`),
  KEY `guests_phone_index` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guests`
--

LOCK TABLES `guests` WRITE;
/*!40000 ALTER TABLE `guests` DISABLE KEYS */;
INSERT INTO `guests` VALUES (6,'GSH-2610-0005','Rama Panji Putra Pratama','0882005851950','Silver',15,'2026-10-19 21:02:43','2026-10-19 21:02:43'),(7,'GSH-2610-0006','ferdiyansyah sambo','0812345678912','Silver',100,'2026-10-19 21:28:49','2026-10-19 21:53:47'),(8,'GSH-2610-0007','alifian pradika','082226587686','Silver',900,'2026-10-23 19:36:49','2026-10-23 19:36:49'),(9,'GSH-2610-0008','azsy septian','087825324659','Silver',30,'2026-10-23 19:37:23','2026-10-23 19:37:23'),(10,'GSH-2610-0009','roni septiyansyah','081234567891234','Silver',15,'2026-10-23 19:38:28','2026-10-23 19:38:28');
/*!40000 ALTER TABLE `guests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_19_041306_create_guests_and_stays_tables',1),(5,'2026_10_19_081652_add_banquet_fields_to_stays_table',1),(6,'2026_10_19_084210_create_redemptions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redemptions`
--

DROP TABLE IF EXISTS `redemptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redemptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `guest_id` bigint(20) unsigned NOT NULL,
  `voucher_code` varchar(50) NOT NULL,
  `item_title` varchar(150) NOT NULL,
  `item_category` int(10) unsigned NOT NULL,
  `item_detail` varchar(255) DEFAULT NULL,
  `selected_option` varchar(150) DEFAULT NULL,
  `points_cost` int(10) unsigned NOT NULL,
  `points_before` int(10) unsigned NOT NULL,
  `points_after` int(10) unsigned NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'aktif',
  `redeemed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `redemptions_voucher_code_unique` (`voucher_code`),
  KEY `redemptions_guest_id_foreign` (`guest_id`),
  CONSTRAINT `redemptions_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redemptions`
--

LOCK TABLES `redemptions` WRITE;
/*!40000 ALTER TABLE `redemptions` DISABLE KEYS */;
INSERT INTO `redemptions` VALUES (4,7,'GSH-RDM-XND6CM','Dining Voucher Rp 75.000',100,'Voucher makan Lunch / Dinner senilai Rp 75.000,-',NULL,100,300,200,'aktif','2026-10-19 21:29:36',NULL,'2026-10-19 21:29:36','2026-10-19 21:29:36'),(5,7,'GSH-RDM-T1AOUD','E-Bike Rental (1 Jam)',100,'Sewa sepeda listrik 1 pax selama 1 jam',NULL,100,200,100,'aktif','2026-10-19 21:53:47',NULL,'2026-10-19 21:53:47','2026-10-19 21:53:47');
/*!40000 ALTER TABLE `redemptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('14X8kiEn5oawqk0q2WseZnw6RVV41tJ1Dk7jBMsq',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmNSVHpPUmgyY3RTRkw4U1NySG9ydEhGeW5iZHdENm1XZTI0bVVUdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792483747),('1llRUGQohhHRbpph94Bte5lnXJ1UwbsvHGvj92JR',NULL,'127.0.0.1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXRLR0Y4QldlbTlLclYxQTBIcmFCcmc5ZmlWT3laYUJ4Mk5QTmMyViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792808688),('1SD56Qk1O5M0C736hiutYKNtMpMmIyqlldqYlsD9',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFdlVGhLRG1zMnNoMlU3bWV5bE9lN3lpUnY0SXRWd2ltOVVqZTdlNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792479144),('1zkDXHHEU5geK1Qm5UlkgY3yE525GThZ7K1hrXkm',NULL,'::1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmNqWW80Uk15TGh1NWw2TWNiaEdZdDFZS3NEMWhwOURMZG5qbWhWQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbj9uYW1lPVJhbWEiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0LnBvaW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792815778),('58u4po3Zck9njbswdIalMl8lYv9ixPA34rezi3kD',NULL,'127.0.0.1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoic25YVEJWMnBaN3B2dmh0WW9zazVSeHp3WVVZakM2NUZNYUJHN0Y0RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792638265),('5DOsL6mztAisIv1IJ9BBvlVBtwjaCAzHPJqd8vtj',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoicG5zVFNkVnpEY3ROMEtmdjhwVXZIZDJmS2lpQUpzN21RbTVoTUhHTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792808074),('77KSG7QVr8vIf4gQAzvdqVfTYRXkxBE681QYI8En',NULL,'::1','Python-urllib/3.13','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2lUVTl4OThlMVdjb2h2SW1aSkR2WUFLMm5QejZNdFV6T2V1ckhsZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792486752),('aDx8bXSUXF6Vm1OVP57uiwvxUBketAt6pqkFp47Y',NULL,'127.0.0.1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFk4Z2FEMkpTc09BcEFhbjFTOEtIZzJJdHNOTUtLQ2xZeFg5ZjNFbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792638262),('Ag73oQMk6TgBUl5EALnGXe5Jg9bG8Ld8QJjZVfkE',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTdveWxPN29zOWdtc1VWVE9zVTdVV0tYN0ZuZm1KNGNpOHFoN3RHbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792808218),('BncHIq4BjwqdOUJxaJlQO6DNZABy9rwyMijL1gSY',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZVFFR2h3TUtSZzFVZ2pKVGt2ZWRZNm5FNUxWcVAwOENxWW9SNlFnUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792808234),('buHv6e1juxDANWgMMT4IH8GQ5XLIgy0Krpz9K53i',NULL,'::1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3RhYklCR2I3VHBZNWVNZkRXV2RoOWR3akQyc0FldXpyQ3lSWnh3VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbj9uYW1lPVJhbWEiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0LnBvaW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792816336),('cYbmOZhmHLyeUotdQQjWIGGtqozjV1dW1b2X9YJY',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicjJoRGFPTGFwWUlkV0hhMjAxUXU1VkRsWldFMmtIZlVMOGltSWhjTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9yZWthbWFuLWxheWFyIjtzOjU6InJvdXRlIjtzOjE1OiJndWVzdC5yZWNvcmRpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1792485201),('D1UfGJrypTLFGbyRVBRvfv3GDSNa8vabvD6Qziqg',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWI5ekxhSjVjaHVVVFBUVEdrN2N2ZWpMbzlUR2JJWWRncE92SkxTVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792808658),('da82fEVRRMRGGhMXQSmx4F41t2Esk5CFpEIOL1gJ',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkVYMG9oWHl1SWVnR2h0bzJEeGx1eDdpTmV0ZHlqZkRjTlp2TUg3UCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792482811),('DbHZplhQKilid4hDvMvzHwp3FB786yD9SI7Qs0go',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoicmc2b2luRWY3MG1KdGxXYk02aDNOMnQ1OUhKemduMEZmY3l1VG5DcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792808227),('DT4cFPHKcqJni6WmxMNB9uDGXztREWENRzOPIJrv',NULL,'::1','Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoielVUbDg2RzhpNVVFSzRwb0VOTEUxa1N5Z0I5TEQxREhOeFRCWGtqMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MyI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792484989),('f3olFyz8vTDelmWYOXNz3zu2jVBM6LY8iusouLPx',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiblFPSHRQMTlPRkV4T05IVGU3QzdONWhSSGFqT2JwaDFrYzQ0UHJEUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NzM6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbj9uYW1lPVNpdGklMjBSYWhtYSZwaG9uZT0wODE5ODc2NTQzMjEiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0LnBvaW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792485035),('FocOTn53Vzx0cN6wjsU5rh5py65BJEh2oW4q5Xc7',NULL,'::1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXRNYWFKckpMN0pQN2FNWDc2U0xlYXNQTzh1aUhpRFZPYjZRV3ppWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792816335),('Fy33wyozHuYaPvfBVqV6Ijr03MSo2GTwr6fKOTxE',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoic3JmampNT0NuZDRQdWVyemlxQlJMUWhCQlFjVTJoRDhqTUMzZlo4ZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792479111),('g2Hxm5nhbslTaIcGqEtlloyTLm5JsboeWcymFmoJ',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmJVbUMzOFk1REFNNUI2VVduSzI5d1hvcXpsSEVYOWxWY05vcnU0cyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1792486060),('GGXjLlU9verBoxcy20APvUcRxsaWreo7fscPhqfV',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWlFLU3BvaDQ1WGhDdkJjcUNNTjNLSkpDS05OT1JOYWtoWTVmdDR3NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792477711),('glxVdlpmntyVDPzjtYBnsZAfiBtBbAdi4EC32OB0',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoic3ZGZ1hJVElmZTNtOWNVa3dxRHdLNE8waWhCd1VUMlBnZXB1TWtSRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792482347),('hl7RIe6lr0ZrZN3CndXVJuFvzTYa39JryuKj5IeI',NULL,'::1','Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFRQS1VUQkNMR2RRTUc2OUtBQU5IS29iOXZWT1d2MnF5REpUNVdaTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MyI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792482054),('hs6ImjWMi0lYQolmj3261J790zuXf6b2USIIKctX',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieUVNZ0NieWc1YnFSQjBrZHBUVk93ckl6VUgzUHlWakhGc0l2TlFRRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792482894),('id5Q8XB5rG11EkADuojrB4bt5BERfWvpZnEAlR5R',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWG9vbnFZNU5lbVpHUXdtSWdIbjVtemRmREI2dVZ2MldyNllyU2pZWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792977010),('iDeHXqfJWZEKYeofH4QTjTGYhlN2RyLNRJ1cgwl9',NULL,'::1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0N5TFB5Ym94aXUxZFMzSmhBZk93NjluYkw1eVFJc3NWQVZaMmFmMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792815777),('IivkmXWN2vW8ZQRrpP6sriobn5zLJfLQLAptEYu5',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUhYTWJZSUh0VWlubkNwTU1DcmtZZ25sOVJTVWlDUk96Q3JjQTJtbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792482348),('iPcVceiBlz7y0YdNBLjZmOCTMhK17VtEjh9bUg9G',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiejYxZnVEUFBla2M4MTRiYVp4REEwQmpldDRzYTRRc3BWZklnSzc0WiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiNDBlOTQzMDI2YmYwZDBkZDRkM2JiYTU4NTdkZWNkNjljMzY4ZmI5MTU0MjQxNzQ5ZTA4MDQ4NDI3Y2UyODYwNiI7fQ==',1792486291),('iURJnOtH9KIFjPuH4MbTVmKHMKUb6fSjP5pITepY',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoicUQ3SVZGU010VjBJaEs3ZjRQVDVPWkhMOUczUnhPZ1VvOFM5cDlCSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9yZWthbWFuLWxheWFyIjtzOjU6InJvdXRlIjtzOjE1OiJndWVzdC5yZWNvcmRpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1792479144),('jleYboMQBt78733m0ruX8vC6eyMoW7wFTtAr333e',NULL,'::1','Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUtsR1dPeDRDNlNlVGdYd2FZd01FdEJxYWo3TnZDUmEwSmtQOWRiNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MyI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792482409),('jxpFjucyhruxvAeNXurN7HaZNxjKAPG4DlER6wR4',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEdQSm8zMGpiRWFCQkY0bEVXSXdsZ0VEUXpHeFNVVFlVTkMwRXhLVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792481280),('jYBIkK6ojpVwfAPdBpbFEBoqbPmgvhxCpNoCLcwK',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTlKNFhTZXhKVk5PNDJudnhMdlR5ajdhRXZKWHlSQlByejBKS0pDNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792809133),('JZ6wXEhTUz8TeVSc112kQWCQEEDPyB3ahgKaDp31',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHNXMm9SZWxvZHZNV1BBZ2w0OVlvTzNvc1pjclBmU0FZMTZZeHB2VCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792482771),('kwQKwtocWwAjHds4pde5QZ9Xbayok8mOzrYjllpW',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmUyREV0NHIyZUpLelF3V1pZVmVJNDJCOTNLRUcwNUZDczhaa3NQbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792482972),('KxJn5e85mCd1Rm5cOMJDd4bB0KDAqhCRrA4clRs8',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTFaQU1jV0ZYYmNLTjQwYlpFR1Ryc3MyMHZIejB5UVRROE03TVBvZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792481301),('kZrDQISrJlFFzzS2KZe8C6fNMiXb8YfalqJPqipH',NULL,'127.0.0.1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiejRvcUs2U1hiUlI5NVZzUVVJbGI1aHFsRkoyUzEyY0t3MlFQWlZwayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792552714),('LiZEhtDUdmWW7IBhjeuO2Oi9paKazonQ5P3niNUR',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidmJMdVRncmpPaG4xZHNpRUJLWkg3T0hPYVlUbzRWODhhaEprbmRGbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792808223),('lPvw1NuUpnfXUIFWjD72Zf3e1gKiMRUY8Qj6sLhD',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVVSdTRxWFlQcFdaZkVtVGplNkFKbENmUjJadGtkdHVTa1V4aWo5MCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792481927),('LrhFSMRotlEHPZwgTp11v8qNgz4XFrlgTx1ZmAzk',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWE5SHBkdkpHVGNZVUxGYWlPbFdaNjBBZkZsYlZXcHI4bjdWYWdkdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792486710),('M0TSQv8rH4DJP9mQwXNpHOqpVZkYQ9wo9VwDCJwH',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2RQNjdSNlRVMXhiOUtBUTU5eHZvcW5TMDBWWlJDZlFpcndIa1JHQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792483569),('Men90cwZdNlcQiR4viJhJXR9kMfHiqLoy2MG3m8w',NULL,'127.0.0.1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmxxZk4zR1JvWk5LRm5sRjFraTVCRGh3Qk8yaTlIOGkyZjZSaWpGcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792638099),('moDZim5wtc8Y6br2vvB6DkQDsYcoixIhnsWPnsgB',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibWJ2aEtQZFJsQ2lzQjBkVHQxUEtFMU9oWGZKZU9iMXNHQjdONzh2bCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792808082),('NBUNaUe36rxXHz2ryipSgORynXshdIWpD6k1420Z',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWQzRUx4ZExWaXRTMjJwRW9oYjFmTWw2SE91Zmw3VXNLVVNpRFNWaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792482971),('NJG8ZT2OAJ8JHpBvr1NFudeIjhqfTjZaHCgAefqC',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHdLTGtqQktSN1cxbFFXS3YxZE9RRUlNWWdNaTZ1ZTZzN2szUVlLaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792484570),('nWpJzfHHZOogNLSEJbPYBtK5iy6GasRw97GQIN44',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3RrZmFJaVdkb0NFNjlWMWYzaHllQVo4SXBxb0ZFUExvWTlYMTRVVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792808035),('Og9VZtu1yY22BHFbVVgjz8BzYAGSoEOnsYPM1B7Z',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEhDTlNIcU8xcFZJTkNGZnNlWnJ0YUQ4bDdOZjNicmQ0SGVFS2lRRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792808088),('Ownil08gWvXZJh2KqEBoHKqpyHldMoDIGtkavAf8',NULL,'::1','Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoieG43RW1xbFhNM2hsclIydWV1VHVORXQyWlpQUHVsNFJWU3JqT3dVSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MyI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792477838),('owYaBLHVsKk1TXup1BD7FmmEtXIBum6XYKf6mFiu',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2hOV2hPQ3pJczZadU5BMGdaaFNuNW1TOTh2bDI2YVRGZ3dRRGZMYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792481989),('PmKgZlBt8yatCQ3tzD3U5tSiqwzVfKXe4eUwWIRz',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDB0ZklWTVZ5ZGxWeUIwb3huanNrVGxMb0JkN0w2VDVubUNobUVGRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792814783),('PRirvmPnRPGlUW5sz2ws327gvHeZfDylGMWNSX0m',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzFicTNlMEFUZ3lJV3Fka1dqcGVEY2IyaFhnZzlta0Z6bVdtMlJwYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792477699),('qj02E6GTAuaRlkWturZ6txMCFNApbPsAdaVJQxmy',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOGtQZU03cnVFWU1qdTNydlBLZ0VPN3hweHlVam5CaTVSOFdnYVhlWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1792567457),('qOPWvSLCXkbrcsGP49rbZLMGIFlLB869bK2JejCY',NULL,'127.0.0.1','','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzR5SlpMZWlmMFpHQm03WGRDVGcwQ1hFT1B6YzJkekNPeTRFMXNrWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792553147),('R0UD3rzbDmHiuHT5Yry0o2qnfglMMQUBR2wvDPFb',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDJSV3ZaeHlrdG9uZXVEMXBrbUk4OG5iWW9OWjdabkdPbExEMlZ2MiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792482946),('r6U64IPxU5K6HL0oHV8DdAm7BLXu8iCjgzYLwmgy',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGdsQ2pOR1VINkhvUG11VjZSNW5iejE0YUxDTFI3b2VkdEZCQU1pciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792816360),('RH6G8Kxi6513CR2aYUDFIzMGve2gPg9zRaJkRn1T',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiejRIQTRScWs3Wm9Ec2tXSno4RjJDZ0N4RzBtSENjRnJmN3RzVzFpNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGU/cGhvbmU9MDgxMjM0NTY3ODkwIjtzOjU6InJvdXRlIjtzOjEyOiJndWVzdC5tb2JpbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1792808096),('rmpBSfoWlyOU8BDDAzWyIiMen3EWMb1LvT2BRdDG',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaktSNE9admNjbnhESGZ0Q0NpWmNkT3hJUTNJSkY2Z21iSVZ4Qkw1YiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1793160615),('rwj3NR3aqcKfQ5MFV2JD9yZT3x8yNLSHdmeImb3e',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVlaNUhmazZUeXhNNldYVVNQdVF4aU9aUjhNU0NCV29Ib1MwSXZLaCI7czo1OiJlcnJvciI7czo3NjoiQWtzZXMga2h1c3VzIHN0YWYgYWRtaW5pc3RyYXRvciAmIGZyb250IGRlc2suIFNpbGFrYW4gbG9naW4gdGVybGViaWggZGFodWx1LiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjU6ImVycm9yIjt9fX0=',1792808432),('sQPkFXDw8VZmEtyBUdu7pYiAdkD0uIpyqHjyEvy4',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXpQS3pSS0RXSmpHOUFMMVV1Wk1pN0R5Tkp3UHRVN0xST05CUkRwaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792810577),('tDlSlLv2XbLMyu6mwLtLhEwczZ9fp37rxHehots5',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2hXYzlzRGt0Qm1VM2o3WEl4SkhlTG9kbGJHdWxLWkgwdk1FWWZDWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792481925),('TrKsTqJ9hQEHsFW2a3viJN6qkqKoRcfa9WpmaeQV',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0h4OWE3d3BWQ3ZzeGVINnF1Z2lUUUhtRGxxck9ta0dsN3ZsdWtvcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9yZWthbWFuLWxheWFyIjtzOjU6InJvdXRlIjtzOjE1OiJndWVzdC5yZWNvcmRpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1792485167),('tWhXeBWcPPK16GxgEQMlwWFDbOwbJ1xj7FXS0vmC',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzhmN1JmWkhhOU53WkNDRlFNbUx6VEtFUlg5YXJXQkM4ZUQzVko3YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792816361),('UccmTujwDkmfQ8uKVolZNkB7jnIAHSoqb7yTZOm5',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV1NBSmdkZGtSWVBrSE1NenZwNEFZQWl6eEVMT2pLUm9kWTFFYXZPVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiNDBlOTQzMDI2YmYwZDBkZDRkM2JiYTU4NTdkZWNkNjljMzY4ZmI5MTU0MjQxNzQ5ZTA4MDQ4NDI3Y2UyODYwNiI7fQ==',1792816386),('V5AGJ9V8ofPe1uZ9DgGEOQISxCsSQ3jlE4LzfuKV',NULL,'::1','Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGNwQUpiU1gxY2M0VGlxalg1YngwZmJaQ3lYdTZIQllmaHdMaDRKNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MyI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792481362),('VSZT7FPW6Zm83Yez48sy7EU9Fazt3kzzjzeQ9wfw',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicW9pWE1jUWlndFlOMlppbFk5WlNlMFVSNzJwYXNYNVFXOUVFaUdRTyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozNDoiaHR0cDovL2xvY2FsaG9zdC9nc2gvcHVibGljL21vYmlsZSI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792638992),('wELBpbKxfD8FZZPdvWM79HUQaGxIFtuqXYHvqrC9',NULL,'::1','Python-urllib/3.13','YTozOntzOjY6Il90b2tlbiI7czo0MDoic1BBOW1ZVkx2bWtxSXBITDZGZkROZ1VMMjdGQ1RKVmx0eXEwejQ2NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792486739),('wFiMs2F06cafhMAIsLwOffuc98hEzSLpeOUA7H5z',NULL,'::1','Python-urllib/3.13','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWFWMmQ4UXo0UWZZcUI3YlpOWGFCdms4c0hlejNORWVLallCU0ZHbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9yZWthbWFuLWxheWFyIjtzOjU6InJvdXRlIjtzOjE1OiJndWVzdC5yZWNvcmRpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1792486767),('WSXFJ9NigJgSNFZi7ja3pMeWbmoYqiFpfOsoUXR4',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFp5YkpjUkxwT3NGM0Q2MUl6c2pnU2pOQ2cyQ1NJWllEaGhiY0k0VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792809168),('XmXzriFeC6xxioldHwGQfqv77FSMETzDIlTkkQxQ',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVExaWpwdjNLeTJhYWZ4cjdxZk4wVjR3WHY0Rk9KNWdvTndhMjgxNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792483653),('xPoTepmZVBQg3fOTC1lj8KToImk0mdUmuJocb6yH',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnM2TE81YlhmYUpXVkJZMFZObjczMnhLN05rMmZVMFVHZjkydjN0dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792552700),('XsRQFNlWOQhCl4dDsFKK76YspsNFxWldT29chbwf',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0M4TUtldVRrT1UyY2FIWHB0b3M0U25qQUl6M2t1MFdBUTdvY1BSOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792481281),('Xx1kzVbyuBl6UIp6MMwJgxRw4eZwazrzxNtmleIL',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEdLdXJjdklXUXIyUHhERzBZUWJpd0tZdE1KbFRDRjNKZTFqQXc5MiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792808041),('Y64DNhPx0wKQpjEXakTu7SrAr2iHZcvFIktrda2b',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnM2UTl6WUYzWDBWVjdJTXhMTjdwcGdrRDZtQXJHMWhMc2tsZVAycyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9tb2JpbGU/Z3Vlc3RfaWQ9MyI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QubW9iaWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792554791),('ZeHAg9KP2FBoQse9a0pQ5Wq3he9ydloAs8DGTrFt',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHF4VlVOV2UwWGIwWmg2dGlUZ1ByR3QyVHBvSENFemZ5Z1FBYkl4QyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792810621),('ZG1zVLaYr1yFPsLN2IZ96CceeAoPBhqYa3iRpg18',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU1NoV0V1dk1XeHlpdWFNS0QwN0dKU09NN3Zyb2hDcjU0aWRhQzQyQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODQ6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbj9uYW1lPUhlbmRyYSUyMFdpamF5YSZwaG9uZT0wODExMjIzMzQ0NTUmc2xpZGU9NCI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiNDBlOTQzMDI2YmYwZDBkZDRkM2JiYTU4NTdkZWNkNjljMzY4ZmI5MTU0MjQxNzQ5ZTA4MDQ4NDI3Y2UyODYwNiI7fQ==',1792486919),('zPNpTcFuXbBXyjGlIvRTSKWuShlHITYcfqXFSsk0',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/155.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0xtdXBJU1pncml4TmF0VzVOelhVbTRDdEQ2UVpSU1hJWHhOZlZjbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9jZWstcG9pbiI7czo1OiJyb3V0ZSI7czoxMjoiZ3Vlc3QucG9pbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792484512),('ZYSN9GedI2DBhRSejCg550BgeMOsrVpNikgx0bv0',NULL,'127.0.0.1','curl/8.21.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2RhV2JQSmFKeDRoOXVaTEZOVVM1SEs1cHg5Y2hWTVB3QldMR2tyaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjEvZ3NoL3B1YmxpYy9tb2JpbGUiO3M6NToicm91dGUiO3M6MTI6Imd1ZXN0Lm1vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1792808123),('zz5cqiVrK40cbqKfArWvavYAvc75VeUtsXqcaAMo',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; id-ID) WindowsPowerShell/5.1.26100.9711','YTozOntzOjY6Il90b2tlbiI7czo0MDoidDJmeUFaamxvd1VyYzdVRDk2bU9LTnhVZ3IwZWkzbkQ0dVhGTk4zeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvZ3NoL3B1YmxpYy9yZWthbWFuLWxheWFyIjtzOjU6InJvdXRlIjtzOjE1OiJndWVzdC5yZWNvcmRpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1792485152);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stays`
--

DROP TABLE IF EXISTS `stays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stays` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `guest_id` bigint(20) unsigned NOT NULL,
  `transaction_type` varchar(30) NOT NULL DEFAULT 'room',
  `booking_code` varchar(50) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `points_per_night` int(10) unsigned NOT NULL,
  `nights` int(10) unsigned NOT NULL,
  `revenue_amount` bigint(20) unsigned DEFAULT NULL,
  `points_earned` int(10) unsigned NOT NULL,
  `points_added` int(10) unsigned NOT NULL,
  `stay_date` date DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stays_booking_code_unique` (`booking_code`),
  KEY `stays_guest_id_foreign` (`guest_id`),
  CONSTRAINT `stays_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stays`
--

LOCK TABLES `stays` WRITE;
/*!40000 ALTER TABLE `stays` DISABLE KEYS */;
INSERT INTO `stays` VALUES (10,6,'room','BK-33186','Grand Executive',15,1,NULL,15,15,'2026-10-20',NULL,'2026-10-19 21:02:43','2026-10-19 21:02:43'),(11,7,'room','BK-16184','President Suite',30,10,NULL,300,300,'2026-10-20',NULL,'2026-10-19 21:28:49','2026-10-19 21:28:49'),(12,8,'room','BK-26458','President Suite',30,30,NULL,900,900,'2026-10-24',NULL,'2026-10-23 19:36:49','2026-10-23 19:36:49'),(13,9,'room','BK-66644','President Suite',30,1,NULL,30,30,'2026-10-24',NULL,'2026-10-23 19:37:23','2026-10-23 19:37:23'),(14,10,'room','BK-81392','Grand Executive',15,1,NULL,15,15,'2026-10-24',NULL,'2026-10-23 19:38:28','2026-10-23 19:38:28');
/*!40000 ALTER TABLE `stays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Front Desk Admin','admin@grandsenyum.com',NULL,'$2y$12$wfvLpytSCHQZ2scfzvD6MOehuC17OWt5z1ccu1Z/9t183UI4B3nKO','RkVn5YTDClU3Xf7DmC0V7Vo8rKM1calGWl9MTawHBTXYsSzAqPtBkwjN62uR','2026-10-19 20:37:28','2026-10-19 20:37:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-28 11:23:09
