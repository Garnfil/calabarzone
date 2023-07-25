-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 25, 2023 at 03:34 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calabarzone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomodations`
--

DROP TABLE IF EXISTS `accomodations`;
CREATE TABLE IF NOT EXISTS `accomodations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` bigint NOT NULL,
  `city_id` bigint NOT NULL,
  `merchant_code` varchar(255) DEFAULT NULL,
  `business_name` text,
  `classification` varchar(255) DEFAULT NULL,
  `description` longtext,
  `interest_type` text,
  `contact_number` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` int NOT NULL,
  `city_id` int NOT NULL,
  `activity_name` varchar(255) DEFAULT NULL,
  `interest_type` text,
  `description` text,
  `things_todo` text,
  `what_to_wear` text,
  `operational_hours` text,
  `best_time_to_visit` text,
  `created_at` timestamp NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attractions`
--

DROP TABLE IF EXISTS `attractions`;
CREATE TABLE IF NOT EXISTS `attractions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `provice_id` int NOT NULL,
  `city_id` int NOT NULL,
  `how_to_get_there` text,
  `interest_type` text,
  `attraction_name` text,
  `description` text,
  `things_todo` varchar(255) DEFAULT NULL,
  `operational_hours` varchar(255) DEFAULT NULL,
  `best_time_to_visit` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities_municipalities`
--

DROP TABLE IF EXISTS `cities_municipalities`;
CREATE TABLE IF NOT EXISTS `cities_municipalities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `province_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_municipalities_province_id_foreign` (`province_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` bigint NOT NULL,
  `city_id` bigint NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `interest_type` varchar(255) DEFAULT NULL,
  `event_date` varchar(255) DEFAULT NULL,
  `description` text,
  `what_to_wear` varchar(255) DEFAULT NULL,
  `travel_tips` text,
  `department_id` int DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_province_id_foreign` (`province_id`),
  KEY `events_city_id_foreign` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_and_dining`
--

DROP TABLE IF EXISTS `food_and_dining`;
CREATE TABLE IF NOT EXISTS `food_and_dining` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` int NOT NULL,
  `city_id` int NOT NULL,
  `merchant_code` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `interest_type` text,
  `cuisine` varchar(255) DEFAULT NULL,
  `price_range` varchar(255) DEFAULT NULL,
  `operation_hours` varchar(255) DEFAULT NULL,
  `atmosphere` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `trunkline` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `service_options` varchar(255) DEFAULT NULL,
  `is_open_for_reservation` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gci_tours`
--

DROP TABLE IF EXISTS `gci_tours`;
CREATE TABLE IF NOT EXISTS `gci_tours` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tour_name` varchar(255) DEFAULT NULL,
  `tour_type` text,
  `what_to_wear` varchar(255) DEFAULT NULL,
  `best_time` varchar(255) DEFAULT NULL,
  `operation_hours` bigint DEFAULT NULL,
  `inclusions` text,
  `province` int DEFAULT NULL,
  `inclusion_details` text,
  `cities` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gci_tours_cities_foreign` (`cities`(250)),
  KEY `gci_tours_province_foreign` (`province`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
CREATE TABLE IF NOT EXISTS `interests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `interest_name` varchar(255) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` bigint DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `transportations` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `created_at`, `updated_at`) VALUES
(1, 'godesq', '$2y$10$mZQCInLCs.xOEOMztNkB3u8Ko03hz6c4esU.MIdqUDgf64d7y5ep.', 'james@godesq.com', 'GodesQ Digital', '2023-07-25 13:04:01', '2023-07-25 13:04:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
