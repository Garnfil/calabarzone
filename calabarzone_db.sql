-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 27, 2023 at 09:01 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

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
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` bigint(20) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `activity_name` varchar(255) DEFAULT NULL,
  `interest_type` text,
  `description` text,
  `things_todo` text,
  `what_to_wear` text,
  `operational_hours` text,
  `best_time_to_visit` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `province_id`, `city_id`, `featured_image`, `activity_name`, `interest_type`, `description`, `things_todo`, `what_to_wear`, `operational_hours`, `best_time_to_visit`, `created_at`, `updated_at`) VALUES
(2, 2, 3, 'walk_the_angono_mural_street.jpg', 'WALK THE ANGONO MURAL STREET', '2', 'THE ANGONO MURAL STREET IS AN ARRAY OF MURAL/SCULPTURED WALLS DEPICTING THE FAMOUS PAINTINGS OF NATIONAL ARTIST CARLOS “BOTONG” V. FRANCISCO. MOST OF THE MURALS ARE REPRESENTATIONS OF RURAL LIFE SEEN ALONG DOÑA AURORA STREET OF BARANGAY POBLACION ITAAS, ANGONO, RIZAL.', 'WALK THE ANGONO MURAL STREET', 'COMFORTABLE CLOTHES', '8:00 AM to 5:00 PM', 'YEARROUND', '2023-07-26 04:50:38', '2023-07-26 05:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `name`, `created_at`, `updated_at`) VALUES
(1, 'godesq', 'james@godesq.com', '$2y$10$mZQCInLCs.xOEOMztNkB3u8Ko03hz6c4esU.MIdqUDgf64d7y5ep.', 'GodesQ Digital', '2023-07-27 00:52:32', '2023-07-27 00:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `attractions`
--

DROP TABLE IF EXISTS `attractions`;
CREATE TABLE IF NOT EXISTS `attractions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` int(11) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `how_to_get_there` mediumtext,
  `interest_type` text,
  `attraction_name` text,
  `description` text,
  `things_todo` varchar(255) DEFAULT NULL,
  `operational_hours` varchar(255) DEFAULT NULL,
  `best_time_to_visit` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `is_featured` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attractions`
--

INSERT INTO `attractions` (`id`, `province_id`, `featured_image`, `city_id`, `how_to_get_there`, `interest_type`, `attraction_name`, `description`, `things_todo`, `operational_hours`, `best_time_to_visit`, `contact_number`, `mobile_number`, `contact_email`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(2, 3, 'general_emilio_aguinaldo_shrine.jpg', 2, 'THE NINOY AQUINO INTERNATIONAL AIRPORT (NAIA) IS THE MAIN AIRPORT TO REACH CALABARZON REGION. DIVIDED INTO FOUR TERMINALS, IT CATERS TO DOMESTIC AND INTERNATIONAL FLIGHTS FROM THE WORLD’S MAJOR AIRLINES. IT’S EQUIPPED WITH TOURIST HELP DESKS, HOTEL, AND CAR RENTAL SERVICES, DUTY FREE SOUVENIR SHOPS, AND HANDICAP ASSISTANCE.\r\n\r\nFROM THE AIRPORT, YOU CAN REACH BUS TERMINALS FROM THE AIRPORT LEADING TO PROVINCES IN THE REGION.\r\n\r\nTO REACH OTHER PARTS OF THE REGION, YOU CAN EASILY TRAVEL BY AIR, LAND, OR SEA. COMMERCIAL CARRIERS HAVE SCHEDULED FLIGHTS TO MAJOR DESTINATIONS AND ISLAND RESORTS WHILE BUS TERMINALS HAVE DAILY RIDES TO THE PROVINCES AND OTHER CITIES AS EARLY AS 6 O’CLOCK IN THE MORNING UNTIL 12 MIDNIGHT.\r\n\r\nYOU CAN GO AROUND THE CITIES AND MUNICIPALITIES IN JEEPNEYS, BUSES, TRICYCLES, AND RENT-A-CAR SERVICES AND ALMOST ALL DRIVERS SPEAK AND UNDERSTAND ENGLISH.', '2', 'General Emilio Aguinaldo Shrine', 'IT WAS IN THIS AGUINALDO ANCESTRAL HOME WHERE GEN. EMILIO AGUINALDO PROCLAIMED PHILIPPINE INDEPENDENCE FROM SPAIN ON JUNE 12, 1898. IT WAS ALSO HERE WHERE THE PHILIPPINE FLAG MADE BY MARCELLA AGONCILLO IN HONGKONG WAS OFFICIALLY HOISTED FOR THE FIRST TIME, AND THE PHILIPPINE NATIONAL ANTHEM COMPOSED BY JULIAN FELIPE WAS PLAYED BY BANDA MALABON. MEASURING 1,324 M2 WITH A FIVE-STOREY TOWER, THIS BUILDING IS ACTUALLY A MANSION RENAISSANCE ARCHITECTURE, COMBINING BAROQUE, ROMANESQUE, AND MALAYAN INFLUENCES. IT STANDS ON A SPRAWLING GROUND OF 4,864 M2. GEN. EMILIO AGUINALDO HIMSELF DONATED THE MANSION AND THE LOT TO THE PHILIPPINE GOVERNMENT ON JUNE 12, 1963, \"TO PERPETUATE THE SPIRIT OF THE PHILIPPINE REVOLUTION OF 1896 THAT PUT AN END TO SPANISH COLONIZATION OF THE COUNTRY.” BY VIRTUE OF REPUBLIC ACT NO. 4039 DATED JUNE 18, 1964 ISSUED BY THEN PRESIDENT DIOSDADO MACAPAGAL, THE AGUINALDO MANSION WAS DECLARED NATIONAL SHRINE.', 'MUSEUM TRIP, HISTORY AND CULTURE APPRECIATION', '9:00 AM to 5:00 PM', 'YEARROUND', '948-2829', '0917-8134089', NULL, 1, 1, '2023-07-25 22:24:21', '2023-07-26 00:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `cities_municipalities`
--

DROP TABLE IF EXISTS `cities_municipalities`;
CREATE TABLE IF NOT EXISTS `cities_municipalities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `images` text,
  `type` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `province_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_municipalities_province_id_foreign` (`province_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities_municipalities`
--

INSERT INTO `cities_municipalities` (`id`, `name`, `featured_image`, `images`, `type`, `description`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'Tagaytay', 'tagaytay.jpg', NULL, 'city', 'Tagaytay is a popular holiday town south of Manila on the Philippine island Luzon. Known for its mild climate, it sits on a ridge above Taal Volcano Island, an active volcano surrounded by Taal Lake. Overlooking the area, People’s Park in the Sky occupies the grounds of a never-finished presidential mansion. Picnic Grove is a recreation area with trails and a zip line.', 3, '2023-07-25 18:38:42', '2023-07-25 18:38:42'),
(2, 'Kawit', 'kawit.jpeg', NULL, 'municipality', 'Kawit, officially the Municipality of Kawit, is a first-class municipality in the province of Cavite, Philippines. According to the 2020 census, it has a population of 107,535. It is one of the notable places that had a major role in the country\'s history during the 1800s and 1900s.', 3, '2023-07-25 21:45:18', '2023-07-25 21:45:18'),
(3, 'Angono', 'angono.png', NULL, 'municipality', 'Angono, officially the Municipality of Angono, is a 1st class municipality in the province of Rizal, Philippines. According to the 2020 census, it has a population of 130,494 people.', 2, '2023-07-26 04:37:58', '2023-07-26 04:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` bigint(20) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `interest_type` varchar(255) DEFAULT NULL,
  `event_date` varchar(255) DEFAULT NULL,
  `description` text,
  `what_to_wear` varchar(255) DEFAULT NULL,
  `travel_tips` text,
  `department_id` int(11) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_province_id_foreign` (`province_id`),
  KEY `events_city_id_foreign` (`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `province_id`, `city_id`, `featured_image`, `event_name`, `interest_type`, `event_date`, `description`, `what_to_wear`, `travel_tips`, `department_id`, `contact_person`, `contact_number`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '.jpg', 'INDEPENDENCE DAY', '3', 'June 12', 'REENACTMENT OF THE HISTORIC PROCLAMATION OF THE PHILIPPINE INDEPENDENCE IS DONE AT THE MANSION OF GEN. EMILIO AGUINALDO, THE FIRST PRESIDENT OF THE PHILIPPINE REPUBLIC.', 'COMFORTABLE CLOTHES', 'ALWAYS BRING HOME LOCAL DELICACIES AND PRODUCTS FROM THE TOWN!', NULL, NULL, '046-4348423', '2023-07-25 23:36:29', '2023-07-25 23:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `food_and_dining`
--

DROP TABLE IF EXISTS `food_and_dining`;
CREATE TABLE IF NOT EXISTS `food_and_dining` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gci_tours`
--

DROP TABLE IF EXISTS `gci_tours`;
CREATE TABLE IF NOT EXISTS `gci_tours` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tour_name` varchar(255) DEFAULT NULL,
  `tour_type` text,
  `what_to_wear` varchar(255) DEFAULT NULL,
  `best_time` varchar(255) DEFAULT NULL,
  `operation_hours` bigint(20) DEFAULT NULL,
  `inclusions` text,
  `province` int(11) DEFAULT NULL,
  `inclusion_details` text,
  `cities` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gci_tours_cities_foreign` (`cities`(250)),
  KEY `gci_tours_province_foreign` (`province`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
CREATE TABLE IF NOT EXISTS `interests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `interest_name` varchar(255) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` longtext,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `interest_name`, `featured_image`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Nature & Adventure', 'nature&_adventure.jpg', 'nature&_adventure_icon.png', NULL, '2023-07-25 19:45:00', '2023-07-25 19:45:00'),
(2, 'History & Culture', NULL, 'history&_culture_icon.png', NULL, '2023-07-25 21:53:59', '2023-07-25 21:53:59'),
(3, 'Events & Entertainment', NULL, 'events&_entertainment_icon.png', NULL, '2023-07-25 23:16:20', '2023-07-25 23:16:20'),
(4, 'Sun & Beach', NULL, 'sun&_beach_icon.png', NULL, '2023-07-25 23:17:50', '2023-07-25 23:17:50'),
(5, 'Health & Wellness', NULL, 'health&_wellness_icon.png', NULL, '2023-07-25 23:19:52', '2023-07-25 23:19:52'),
(6, 'Farm & Food', NULL, 'farm&_food_icon.png', NULL, '2023-07-25 23:20:48', '2023-07-25 23:20:48'),
(7, 'Arts', NULL, 'arts_icon.png', NULL, '2023-07-26 19:57:33', '2023-07-26 21:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 1, 'API TOKEN', 'd96592d6a9a564f93b32b6fc07e4a5b3d107fdbe80cfdda526734cf456ea34db', '[\"*\"]', '2023-07-26 21:45:17', '2023-07-26 18:08:24', '2023-07-26 21:45:17'),
(5, 'App\\Models\\User', 1, 'API TOKEN', '5fdc456a3bf531153f69611b605dfe7d0b11428b34b354993d67d80595d30c8c', '[\"*\"]', NULL, '2023-07-26 19:31:39', '2023-07-26 19:31:39'),
(10, 'App\\Models\\User', 5, 'API TOKEN', '7b2aa4a394a7e0c9f04b48d0f4af609f33d414eb0ca6aaffc85f4ca0c7a4e710', '[\"*\"]', NULL, '2023-07-27 00:34:22', '2023-07-27 00:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `transportations` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `featured_image`, `images`, `description`, `transportations`, `tagline`, `languages`, `created_at`, `updated_at`) VALUES
(2, 'Rizal', 'rizal.jpg', NULL, 'Rizal, officially the Province of Rizal, is a province in the Philippines located in the Calabarzon region in Luzon. Its capital is the city of Antipolo. It is about 16 kilometres east of Manila. The province is named after José Rizal, one of the main national heroes of the Philippines.', '[\"Jeep\",\"Bus\",\"Tricycle\",\"Motorcycle\"]', 'PASYAL SA RIZAL', NULL, '2023-07-25 16:54:05', '2023-07-26 19:37:35'),
(3, 'Cavite', 'cavite.jpg', NULL, 'Cavite, officially the Province of Cavite, is a province in the Philippines located in the Calabarzon region in Luzon. Located on the southern shores of Manila Bay and southwest of Manila, it is one of the most industrialized and fastest-growing provinces in the Philippines.', '[\"Jeep\",\"Bus\",\"Tricycle\",\"Motorcycle\"]', 'TARA, CAVITE TAYO!', NULL, '2023-07-25 18:30:32', '2023-07-25 18:30:32'),
(4, 'Batangas', 'batangas.png', NULL, 'Batangas, officially the Province of Batangas, is a province in the Philippines located in the Calabarzon region on Luzon. Its capital is the city of Batangas, and is bordered by the provinces of Cavite and Laguna to the north, and Quezon to the east.', '[\"Jeep\",\"Bus\",\"Tricycle\",\"Motorcycle\"]', 'RICH BATANGAS!', NULL, '2023-07-26 19:34:04', '2023-07-26 19:34:04'),
(5, 'Quezon', 'quezon.jpg', NULL, 'Quezon, officially the Province of Quezon, is a province in the Philippines located in the Calabarzon region on Luzon. Kaliraya/Kalilayan was the first known name of the province upon its creation in 1591. Around the middle of the 18th century, it was changed to Tayabas.', '[\"Jeep\",\"Bus\",\"Tricycle\",\"Motorcycle\"]', 'TARA NA SA QUEZON', NULL, '2023-07-26 19:35:31', '2023-07-26 19:35:31'),
(6, 'Laguna', 'laguna.jpg', NULL, 'Laguna is a province just southeast of Manila and Laguna de Bay, in the Philippines. In Calamba, the Jose Rizal Shrine is a reconstruction of the national hero\'s childhood home. To the south is Mount Makiling, a dormant volcano. The town of Pila has well-preserved Spanish colonial architecture. The crypt of Nagcarlan Underground Cemetery holds 19th-century graves. Boats travel over the rapids of Pagsanjan Falls.', '[\"Jeep\",\"Bus\",\"Tricycle\",\"Motorcycle\"]', 'LOVE LAGUNA', NULL, '2023-07-26 19:36:48', '2023-07-26 19:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `interests` varchar(255) DEFAULT NULL,
  `is_verify` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `firstname`, `lastname`, `interests`, `is_verify`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'james.godesqq', '$2y$10$mZQCInLCs.xOEOMztNkB3u8Ko03hz6c4esU.MIdqUDgf64d7y5ep.', 'james@godesq.com', 'James GodesQ', 'James', 'GodesQ', NULL, 1, 0, '2023-07-25 13:04:01', '2023-07-26 21:22:47'),
(4, 'jamesgarnfil', '$2y$10$H5etE.SL4T3Z.uE1zCVTl.fNiwhtOapnHgkwan4GNiQE5fvjfDfHS', 'jamesgarnfil15@gmail.com', NULL, NULL, NULL, NULL, 1, 0, '2023-07-26 19:32:50', '2023-07-26 19:33:46'),
(5, 'jamisjoe', '$2y$10$8L.xPtdbPhhJSu36Gm3xX.AOSHU0fEiPyXYoitgkNTKGqJv/XHtUe', 'jamisjoecristian@gmail.com', NULL, NULL, NULL, NULL, 1, 0, '2023-07-26 19:35:28', '2023-07-26 19:36:53'),
(6, 'jam', '$2y$10$IGX1BOygSJx9tmu8t47LsORW3EKa6ZJLDff6St8Kw3/FnD8xPim5C', 'jamisjoe@gmail.com', NULL, NULL, NULL, NULL, 0, 0, '2023-07-26 22:24:05', '2023-07-26 22:24:05'),
(8, 'christian', '$2y$10$g6sYY1ZoFAdqGA2./TZAVudfmGe8FB0TniZsIvx/F6zuWtQPtxL7O', 'christianmarkvillasco@gmail.com', NULL, 'Christian', 'Villasco', '[\"1\",\"2\",\"4\"]', 1, 1, '2023-07-26 23:48:59', '2023-07-27 00:49:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
