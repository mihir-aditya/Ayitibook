-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2025 at 09:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ayitibook`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `alternate_mobile_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `address_type` enum('home','office','other') DEFAULT 'home',
  `is_default` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `first_name`, `last_name`, `mobile_number`, `alternate_mobile_number`, `address`, `city`, `postal_code`, `address_type`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'test', 'kumar', '1234567890', '123467890', 'test , place', 'place', '578964', 'home', 1, 1, '2025-09-24 01:12:02', '2025-09-24 01:12:02'),
(2, 4, 'test', NULL, '1234567890', NULL, 'Azad Colony', 'place', '378964', 'home', 0, 1, '2025-09-25 17:28:44', '2025-09-25 17:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `phone`, `super_admin`, `password`, `status`, `last_login_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', 'admin@example.com', '8888888888', 1, '$2y$12$bx6DQj0OZppDRgbFhItZJ.i3TCFYVvsHx7q3GMYtkfZBSUinDAw7.', 1, NULL, NULL, '2025-08-14 03:12:34', '2025-08-14 03:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_id`, `name`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, '17HOUD', 'Babymel', 'brands/babymel.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(2, 'DH66PQ', 'Burberry', 'brands/burberry.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(3, 'NV74NX', 'Camper', 'brands/camper.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(4, '7KRAXX', 'Chanel', 'brands/chanel.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(5, 'KPB7LB', 'Dr. Martens', 'brands/drmartens.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(6, 'ZADC4K', 'Fila', 'brands/fila.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(7, 'WBLUNY', 'Levi\'s', 'brands/levis.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(8, 'E8MGFJ', 'Puma', 'brands/puma.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(9, 'LHQ4LN', 'Apple', 'brands/apple.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(10, '3AYTBZ', 'Samsung', 'brands/samsung.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(11, 'SBA4YH', 'Nike', 'brands/nike.png', 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-jk@gmail.cim|127.0.0.1', 'i:1;', 1755575639),
('laravel-cache-jk@gmail.cim|127.0.0.1:timer', 'i:1755575639;', 1755575639),
('laravel-cache-test@gmail.cim|127.0.0.1', 'i:2;', 1753721257),
('laravel-cache-test@gmail.cim|127.0.0.1:timer', 'i:1753721257;', 1753721257),
('laravel-cache-user@example.com|127.0.0.1', 'i:2;', 1758218304),
('laravel-cache-user@example.com|127.0.0.1:timer', 'i:1758218304;', 1758218304);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 3, '2025-09-18 14:22:49', '2025-09-18 14:22:59'),
(2, 2, 3, 2, '2025-09-18 14:23:04', '2025-09-18 14:23:04'),
(3, 2, 4, 2, '2025-09-18 14:23:13', '2025-09-18 14:23:13'),
(4, 2, 5, 2, '2025-09-18 14:24:13', '2025-09-18 14:24:13'),
(5, 4, 2, 4, '2025-09-19 01:34:35', '2025-09-21 04:04:04'),
(6, 4, 3, 2, '2025-09-19 01:42:33', '2025-09-19 01:42:33'),
(7, 4, 6, 3, '2025-09-19 04:52:37', '2025-09-19 04:53:59'),
(8, 4, 8, 2, '2025-09-19 04:59:45', '2025-09-19 04:59:45'),
(9, 4, 4, 2, '2025-09-19 10:12:10', '2025-09-19 10:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men26', NULL, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(2, 'Clothing', 'clothing379112', 1, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(3, 'Hoodies & Sweatshirts', 'hoodies-sweatshirts325170', 2, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(4, 'Jackets & Vests', 'jackets-vests436188', 2, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(5, 'Pants & Tights', 'pants-tights179104', 2, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(6, 'Shorts', 'shorts492120', 2, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(7, 'Tops & T-shirts', 'tops-t-shirts274190', 2, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(8, 'Shoes', 'shoes224133', 1, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(9, 'Basket Ball', 'basket-ball302120', 8, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(10, 'Running', 'running387169', 8, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(11, 'Sandals & Slides', 'sandals-slides389141', 8, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(12, 'Sneakers', 'sneakers251144', 8, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(13, 'Soccer', 'soccer146189', 8, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(14, 'Accessories', 'accessories463128', 1, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(15, 'Bags & Backpacks', 'bags-backpacks467121', 14, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(16, 'Hat & Beanies', 'hat-beanies480154', 14, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(17, 'Socks', 'socks354102', 14, 1, '2025-08-19 02:47:11', '2025-08-19 02:47:11'),
(18, 'Underwear', 'underwear266137', 14, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(19, 'Women', 'women35', NULL, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(20, 'Clothing', 'clothing175130', 19, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(21, 'Dresses & Skirts', 'dresses-skirts447153', 20, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(22, 'Hoodies & Sweatshirts', 'hoodies-sweatshirts487108', 20, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(23, 'Pants', 'pants127117', 20, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(24, 'Tights & Leggings', 'tights-leggings197107', 20, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(25, 'Tops & T-shirts', 'tops-t-shirts127144', 20, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(26, 'Shoes', 'shoes346164', 19, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(27, 'Running', 'running466102', 26, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(28, 'Sneakers', 'sneakers213155', 26, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(29, 'Training & Gym', 'training-gym395132', 26, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(30, 'Accessories', 'accessories103100', 19, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(31, 'Bags & Backpacks', 'bags-backpacks265189', 30, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(32, 'Hats', 'hats303184', 30, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(33, 'Socks', 'socks348148', 30, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(34, 'Juniors', 'juniors92', NULL, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(35, 'Clothing', 'clothing274155', 34, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(36, 'Hoodies & Sweatshirts', 'hoodies-sweatshirts158112', 35, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(37, 'Shorts', 'shorts192146', 35, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(38, 'Tops & T-shirts', 'tops-t-shirts347189', 35, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(39, 'Shoes', 'shoes349113', 34, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(40, 'Basket Ball', 'basket-ball379147', 39, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(41, 'Running', 'running108155', 39, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(42, 'Sneakers', 'sneakers223133', 39, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(43, 'Accessories', 'accessories427197', 34, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(44, 'Bags & Backpacks', 'bags-backpacks314160', 43, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(45, 'Hats', 'hats159177', 43, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12'),
(46, 'Clothes', 'clothes', NULL, 1, '2025-08-19 02:47:12', '2025-08-19 02:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `isd_code` varchar(25) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `is_default` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `country_code`, `isd_code`, `status`, `is_default`) VALUES
(1, 'Afghanistan', 'AFG', '+93', 'active', 0),
(2, 'Albania', 'ALB', '+355', 'active', 0),
(3, 'Algeria', 'DZA', '+213', 'active', 0),
(4, 'Andorra', 'AND', '+376', 'active', 0),
(5, 'Angola', 'AGO', '+244', 'active', 0),
(6, 'Antigua and Barbuda', 'ATG', '+1-268', 'active', 0),
(7, 'Argentina', 'ARG', '+54', 'active', 0),
(8, 'Armenia', 'ARM', '+374', 'active', 0),
(9, 'Australia', 'AUS', '+61', 'active', 0),
(10, 'Austria', 'AUT', '+43', 'active', 0),
(11, 'Azerbaijan', 'AZE', '+994', 'active', 0),
(12, 'Bahamas', 'BHS', '+1-242', 'active', 0),
(13, 'Bahrain', 'BHR', '+973', 'active', 0),
(14, 'Bangladesh', 'BGD', '+880', 'active', 0),
(15, 'Barbados', 'BRB', '+1-246', 'active', 0),
(16, 'Belarus', 'BLR', '+375', 'active', 0),
(17, 'Belgium', 'BEL', '+32', 'active', 0),
(18, 'Belize', 'BLZ', '+501', 'active', 0),
(19, 'Benin', 'BEN', '+229', 'active', 0),
(20, 'Bhutan', 'BTN', '+975', 'active', 0),
(21, 'Bolivia', 'BOL', '+591', 'active', 0),
(22, 'Bosnia and Herzegovina', 'BIH', '+387', 'active', 0),
(23, 'Botswana', 'BWA', '+267', 'active', 0),
(24, 'Brazil', 'BRA', '+55', 'active', 0),
(25, 'Brunei', 'BRN', '+673', 'active', 0),
(26, 'Bulgaria', 'BGR', '+359', 'active', 0),
(27, 'Burkina Faso', 'BFA', '+226', 'active', 0),
(28, 'Burundi', 'BDI', '+257', 'active', 0),
(29, 'Cabo Verde', 'CPV', '+238', 'active', 0),
(30, 'Cambodia', 'KHM', '+855', 'active', 0),
(31, 'Cameroon', 'CMR', '+237', 'active', 0),
(32, 'Canada', 'CAN', '+1', 'active', 0),
(33, 'Central African Republic', 'CAF', '+236', 'active', 0),
(34, 'Chad', 'TCD', '+235', 'active', 0),
(35, 'Chile', 'CHL', '+56', 'active', 0),
(36, 'China', 'CHN', '+86', 'active', 0),
(37, 'Colombia', 'COL', '+57', 'active', 0),
(38, 'Comoros', 'COM', '+269', 'active', 0),
(39, 'Congo, Democratic Republic of the', 'COD', '+243', 'active', 0),
(40, 'Congo, Republic of the', 'COG', '+242', 'active', 0),
(41, 'Costa Rica', 'CRI', '+506', 'active', 0),
(42, 'Croatia', 'HRV', '+385', 'active', 0),
(43, 'Cuba', 'CUB', '+53', 'active', 0),
(44, 'Cyprus', 'CYP', '+357', 'active', 0),
(45, 'Czech Republic', 'CZE', '+420', 'active', 0),
(46, 'Denmark', 'DNK', '+45', 'active', 0),
(47, 'Djibouti', 'DJI', '+253', 'active', 0),
(48, 'Dominica', 'DMA', '+1-767', 'active', 0),
(49, 'Dominican Republic', 'DOM', '+1-809', 'active', 0),
(50, 'Ecuador', 'ECU', '+593', 'active', 0),
(51, 'Egypt', 'EGY', '+20', 'active', 0),
(52, 'El Salvador', 'SLV', '+503', 'active', 0),
(53, 'Equatorial Guinea', 'GNQ', '+240', 'active', 0),
(54, 'Eritrea', 'ERI', '+291', 'active', 0),
(55, 'Estonia', 'EST', '+372', 'active', 0),
(56, 'Eswatini', 'SWZ', '+268', 'active', 0),
(57, 'Ethiopia', 'ETH', '+251', 'active', 0),
(58, 'Fiji', 'FJI', '+679', 'active', 0),
(59, 'Finland', 'FIN', '+358', 'active', 0),
(60, 'France', 'FRA', '+33', 'active', 0),
(61, 'Gabon', 'GAB', '+241', 'active', 0),
(62, 'Gambia', 'GMB', '+220', 'active', 0),
(63, 'Georgia', 'GEO', '+995', 'active', 0),
(64, 'Germany', 'DEU', '+49', 'active', 0),
(65, 'Ghana', 'GHA', '+233', 'active', 0),
(66, 'Greece', 'GRC', '+30', 'active', 0),
(67, 'Grenada', 'GRD', '+1-473', 'active', 0),
(68, 'Guatemala', 'GTM', '+502', 'active', 0),
(69, 'Guinea', 'GIN', '+224', 'active', 0),
(70, 'Guinea-Bissau', 'GNB', '+245', 'active', 0),
(71, 'Guyana', 'GUY', '+592', 'active', 0),
(72, 'Haiti', 'HTI', '+509', 'active', 1),
(73, 'Honduras', 'HND', '+504', 'active', 0),
(74, 'Hungary', 'HUN', '+36', 'active', 0),
(75, 'Iceland', 'ISL', '+354', 'active', 0),
(76, 'India', 'IND', '+91', 'active', 0),
(77, 'Indonesia', 'IDN', '+62', 'active', 0),
(78, 'Iran', 'IRN', '+98', 'active', 0),
(79, 'Iraq', 'IRQ', '+964', 'active', 0),
(80, 'Ireland', 'IRL', '+353', 'active', 0),
(81, 'Israel', 'ISR', '+972', 'active', 0),
(82, 'Italy', 'ITA', '+39', 'active', 0),
(83, 'Ivory Coast', 'CIV', '+225', 'active', 0),
(84, 'Jamaica', 'JAM', '+1-876', 'active', 0),
(85, 'Japan', 'JPN', '+81', 'active', 0),
(86, 'Jordan', 'JOR', '+962', 'active', 0),
(87, 'Kazakhstan', 'KAZ', '+7', 'active', 0),
(88, 'Kenya', 'KEN', '+254', 'active', 0),
(89, 'Kiribati', 'KIR', '+686', 'active', 0),
(90, 'Korea, North', 'PRK', '+850', 'active', 0),
(91, 'Korea, South', 'KOR', '+82', 'active', 0),
(92, 'Kuwait', 'KWT', '+965', 'active', 0),
(93, 'Kyrgyzstan', 'KGZ', '+996', 'active', 0),
(94, 'Laos', 'LAO', '+856', 'active', 0),
(95, 'Latvia', 'LVA', '+371', 'active', 0),
(96, 'Lebanon', 'LBN', '+961', 'active', 0),
(97, 'Lesotho', 'LSO', '+266', 'active', 0),
(98, 'Liberia', 'LBR', '+231', 'active', 0),
(99, 'Libya', 'LBY', '+218', 'active', 0),
(100, 'Liechtenstein', 'LIE', '+423', 'active', 0),
(101, 'Lithuania', 'LTU', '+370', 'active', 0),
(102, 'Luxembourg', 'LUX', '+352', 'active', 0),
(103, 'Madagascar', 'MDG', '+261', 'active', 0),
(104, 'Malawi', 'MWI', '+265', 'active', 0),
(105, 'Malaysia', 'MYS', '+60', 'active', 0),
(106, 'Maldives', 'MDV', '+960', 'active', 0),
(107, 'Mali', 'MLI', '+223', 'active', 0),
(108, 'Malta', 'MLT', '+356', 'active', 0),
(109, 'Marshall Islands', 'MHL', '+692', 'active', 0),
(110, 'Mauritania', 'MRT', '+222', 'active', 0),
(111, 'Mauritius', 'MUS', '+230', 'active', 0),
(112, 'Mexico', 'MEX', '+52', 'active', 0),
(113, 'Micronesia', 'FSM', '+691', 'active', 0),
(114, 'Moldova', 'MDA', '+373', 'active', 0),
(115, 'Monaco', 'MCO', '+377', 'active', 0),
(116, 'Mongolia', 'MNG', '+976', 'active', 0),
(117, 'Montenegro', 'MNE', '+382', 'active', 0),
(118, 'Morocco', 'MAR', '+212', 'active', 0),
(119, 'Mozambique', 'MOZ', '+258', 'active', 0),
(120, 'Myanmar', 'MMR', '+95', 'active', 0),
(121, 'Namibia', 'NAM', '+264', 'active', 0),
(122, 'Nauru', 'NRU', '+674', 'active', 0),
(123, 'Nepal', 'NPL', '+977', 'active', 0),
(124, 'Netherlands', 'NLD', '+31', 'active', 0),
(125, 'New Zealand', 'NZL', '+64', 'active', 0),
(126, 'Nicaragua', 'NIC', '+505', 'active', 0),
(127, 'Niger', 'NER', '+227', 'active', 0),
(128, 'Nigeria', 'NGA', '+234', 'active', 0),
(129, 'North Macedonia', 'MKD', '+389', 'active', 0),
(130, 'Norway', 'NOR', '+47', 'active', 0),
(131, 'Oman', 'OMN', '+968', 'active', 0),
(132, 'Pakistan', 'PAK', '+92', 'active', 0),
(133, 'Palau', 'PLW', '+680', 'active', 0),
(134, 'Panama', 'PAN', '+507', 'active', 0),
(135, 'Papua New Guinea', 'PNG', '+675', 'active', 0),
(136, 'Paraguay', 'PRY', '+595', 'active', 0),
(137, 'Peru', 'PER', '+51', 'active', 0),
(138, 'Philippines', 'PHL', '+63', 'active', 0),
(139, 'Poland', 'POL', '+48', 'active', 0),
(140, 'Portugal', 'PRT', '+351', 'active', 0),
(141, 'Qatar', 'QAT', '+974', 'active', 0),
(142, 'Romania', 'ROU', '+40', 'active', 0),
(143, 'Russia', 'RUS', '+7', 'active', 0),
(144, 'Rwanda', 'RWA', '+250', 'active', 0),
(145, 'Saint Kitts and Nevis', 'KNA', '+1-869', 'active', 0),
(146, 'Saint Lucia', 'LCA', '+1-758', 'active', 0),
(147, 'Saint Vincent and the Grenadines', 'VCT', '+1-784', 'active', 0),
(148, 'Samoa', 'WSM', '+685', 'active', 0),
(149, 'San Marino', 'SMR', '+378', 'active', 0),
(150, 'Sao Tome and Principe', 'STP', '+239', 'active', 0),
(151, 'Saudi Arabia', 'SAU', '+966', 'active', 0),
(152, 'Senegal', 'SEN', '+221', 'active', 0),
(153, 'Serbia', 'SRB', '+381', 'active', 0),
(154, 'Seychelles', 'SYC', '+248', 'active', 0),
(155, 'Sierra Leone', 'SLE', '+232', 'active', 0),
(156, 'Singapore', 'SGP', '+65', 'active', 0),
(157, 'Slovakia', 'SVK', '+421', 'active', 0),
(158, 'Slovenia', 'SVN', '+386', 'active', 0),
(159, 'Solomon Islands', 'SLB', '+677', 'active', 0),
(160, 'Somalia', 'SOM', '+252', 'active', 0),
(161, 'South Africa', 'ZAF', '+27', 'active', 0),
(162, 'South Sudan', 'SSD', '+211', 'active', 0),
(163, 'Spain', 'ESP', '+34', 'active', 0),
(164, 'Sri Lanka', 'LKA', '+94', 'active', 0),
(165, 'Sudan', 'SDN', '+249', 'active', 0),
(166, 'Suriname', 'SUR', '+597', 'active', 0),
(167, 'Sweden', 'SWE', '+46', 'active', 0),
(168, 'Switzerland', 'CHE', '+41', 'active', 0),
(169, 'Syria', 'SYR', '+963', 'active', 0),
(170, 'Tajikistan', 'TJK', '+992', 'active', 0),
(171, 'Tanzania', 'TZA', '+255', 'active', 0),
(172, 'Thailand', 'THA', '+66', 'active', 0),
(173, 'Timor-Leste', 'TLS', '+670', 'active', 0),
(174, 'Togo', 'TGO', '+228', 'active', 0),
(175, 'Tonga', 'TON', '+676', 'active', 0),
(176, 'Trinidad and Tobago', 'TTO', '+1-868', 'active', 0),
(177, 'Tunisia', 'TUN', '+216', 'active', 0),
(178, 'Turkey', 'TUR', '+90', 'active', 0),
(179, 'Turkmenistan', 'TKM', '+993', 'active', 0),
(180, 'Tuvalu', 'TUV', '+688', 'active', 0),
(181, 'Uganda', 'UGA', '+256', 'active', 0),
(182, 'Ukraine', 'UKR', '+380', 'active', 0),
(183, 'United Arab Emirates', 'ARE', '+971', 'active', 0),
(184, 'United Kingdom', 'GBR', '+44', 'active', 0),
(185, 'United States', 'USA', '+1', 'active', 0),
(186, 'Uruguay', 'URY', '+598', 'active', 0),
(187, 'Uzbekistan', 'UZB', '+998', 'active', 0),
(188, 'Vanuatu', 'VUT', '+678', 'active', 0),
(189, 'Venezuela', 'VEN', '+58', 'active', 0),
(190, 'Vietnam', 'VNM', '+84', 'active', 0),
(191, 'Yemen', 'YEM', '+967', 'active', 0),
(192, 'Zambia', 'ZMB', '+260', 'active', 0),
(193, 'Zimbabwe', 'ZWE', '+263', 'active', 0),
(194, 'Vatican City', 'VAT', '+379', 'active', 0),
(195, 'Palestine', 'PSE', '+970', 'active', 0),
(196, 'Taiwan', 'TWN', '+886', 'active', 0),
(197, 'Kosovo', 'XKX', '+383', 'active', 0),
(198, 'Western Sahara', 'ESH', '+212', 'active', 0),
(199, 'Northern Cyprus', 'CYN', '+90-392', 'active', 0),
(200, 'South Ossetia', 'OST', '+995-34', 'active', 0),
(201, 'Abkhazia', 'ABH', '+7-840', 'active', 0),
(202, 'Transnistria', 'PRD', '+373-533', 'active', 0),
(203, 'Artsakh (Nagorno-Karabakh)', 'ART', '+374-47', 'active', 0),
(204, 'Cook Islands', 'COK', '+682', 'active', 0),
(205, 'Niue', 'NIU', '+683', 'active', 0),
(206, 'Somaliland', 'SOL', '+252', 'active', 0),
(207, 'Sahrawi Arab Democratic Republic', 'SAD', '+212', 'active', 0),
(208, 'Donetsk People\'s Republic', 'DNR', '+7', 'active', 0),
(209, 'Luhansk People\'s Republic', 'LNR', '+7', 'active', 0),
(210, 'Azad Kashmir', 'AZK', '+92', 'active', 0),
(211, 'Turkish Republic of Northern Cyprus', 'TRC', '+90-392', 'active', 0),
(212, 'Republic of China (Taiwan)', 'ROC', '+886', 'active', 0),
(213, 'Nagorno-Karabakh', 'NKR', '+374-47', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_14_082514_create_users_table', 2),
(5, '2025_08_14_082522_create_admins_table', 3),
(9, '2025_08_19_052753_create_categories_table', 4),
(10, '2025_08_19_052813_create_brands_table', 4),
(11, '2025_08_19_053101_create_products_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `prduct_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `payment_method` enum('COD','Credit Card','Debit Card','UPI','Net Banking','Wallet','Natcash','Moncash') DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `order_status` enum('placed','confirmed','shipped','delivered','cancelled','refunded') DEFAULT 'placed',
  `placed_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `sl_no` int(11) NOT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `can_purchase` tinyint(1) NOT NULL DEFAULT 1,
  `show_stock_out` tinyint(1) NOT NULL DEFAULT 1,
  `maximum_purchase_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `low_stock_quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `refundable` tinyint(1) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'INR',
  `discount_price` decimal(10,2) DEFAULT NULL,
  `discount_type` enum('flat','percent') DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `sold_count` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `videos` longtext DEFAULT NULL,
  `is_flash_sale` int(11) NOT NULL DEFAULT 0,
  `sales_count` int(11) NOT NULL DEFAULT 0,
  `weight` decimal(8,2) DEFAULT NULL,
  `length` decimal(8,2) DEFAULT NULL,
  `width` decimal(8,2) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `description`, `category_id`, `brand_id`, `seller_id`, `can_purchase`, `show_stock_out`, `maximum_purchase_quantity`, `low_stock_quantity`, `refundable`, `price`, `currency`, `discount_price`, `discount_type`, `stock_quantity`, `sold_count`, `thumbnail`, `images`, `videos`, `is_flash_sale`, `sales_count`, `weight`, `length`, `width`, `height`, `meta_title`, `meta_keywords`, `meta_description`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Razer BlackWidow Keyboard', 'razer-blackwidow-keyboard-1', 'SKU-0001', 'High quality Razer BlackWidow Keyboard for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 254.59, '₹', NULL, NULL, 81, 0, 'assets/images/products/product1.png', '[\"assets/images/products/product1.png\",\"assets/images/products/product1.png\",\"assets/images/products/product1.png\"]', './assets/videos/product-demo.mp4', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(3, 'Cooler Master Gaming Case', 'cooler-master-gaming-case-2', 'SKU-0002', 'High quality Cooler Master Gaming Case for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 30.23, '₹', NULL, NULL, 419, 0, 'assets/images/products/product2.png', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(4, 'Gigabyte Aorus GPU', 'gigabyte-aorus-gpu-3', 'SKU-0003', 'High quality Gigabyte Aorus GPU for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 38.34, '₹', NULL, NULL, 450, 0, 'assets/images/products/product3.png', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(5, 'Kingston Fury RAM', 'kingston-fury-ram-4', 'SKU-0004', 'High quality Kingston Fury RAM for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 264.58, '₹', NULL, NULL, 201, 0, 'assets/images/products/product4.png', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(6, 'Razer BlackWidow Keyboard', 'razer-blackwidow-keyboard-5', 'SKU-0005', 'High quality Razer BlackWidow Keyboard for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 315.95, '₹', NULL, NULL, 83, 0, 'assets/images/products/explore-p2.png', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(7, 'SteelSeries QcK Mousepad', 'steelseries-qck-mousepad-6', 'SKU-0006', 'High quality SteelSeries QcK Mousepad for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 499.87, '₹', NULL, NULL, 449, 0, 'assets/images/products/explore-p3.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(8, 'HyperX Cloud II Headset', 'hyperx-cloud-ii-headset-7', 'SKU-0007', 'High quality HyperX Cloud II Headset for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 147.58, '₹', NULL, NULL, 351, 0, 'assets/images/products/explore-p4.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(9, 'G.Skill Trident RAM', 'gskill-trident-ram-8', 'SKU-0008', 'High quality G.Skill Trident RAM for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 484.75, '₹', NULL, NULL, 469, 0, 'assets/images/products/explore-p5.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(10, 'Samsung 980 Pro SSD', 'samsung-980-pro-ssd-9', 'SKU-0009', 'High quality Samsung 980 Pro SSD for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 458.92, '₹', NULL, NULL, 454, 0, 'assets/images/products/product9.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(11, 'Logitech G733 Headset', 'logitech-g733-headset-10', 'SKU-0010', 'High quality Logitech G733 Headset for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 92.79, '₹', NULL, NULL, 186, 0, 'assets/images/products/product10.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(12, 'Intel i9 Processor', 'intel-i9-processor-11', 'SKU-0011', 'High quality Intel i9 Processor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 55.27, '₹', NULL, NULL, 85, 0, 'assets/images/products/product11.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(13, 'NZXT Kraken Z63 Cooler', 'nzxt-kraken-z63-cooler-12', 'SKU-0012', 'High quality NZXT Kraken Z63 Cooler for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 421.46, '₹', NULL, NULL, 377, 0, 'assets/images/products/product12.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(14, 'NZXT Kraken Z63 Cooler', 'nzxt-kraken-z63-cooler-13', 'SKU-0013', 'High quality NZXT Kraken Z63 Cooler for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 169.09, '₹', NULL, NULL, 345, 0, 'assets/images/products/product13.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(15, 'MSI Optix Gaming Monitor', 'msi-optix-gaming-monitor-14', 'SKU-0014', 'High quality MSI Optix Gaming Monitor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 138.58, '₹', NULL, NULL, 460, 0, 'assets/images/products/product14.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(16, 'Samsung 980 Pro SSD', 'samsung-980-pro-ssd-15', 'SKU-0015', 'High quality Samsung 980 Pro SSD for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 441.24, '₹', NULL, NULL, 485, 0, 'assets/images/products/product15.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(17, 'WD Black HDD', 'wd-black-hdd-16', 'SKU-0016', 'High quality WD Black HDD for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 392.47, '₹', NULL, NULL, 215, 0, 'assets/images/products/product16.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(18, 'Logitech G502 Hero Mouse', 'logitech-g502-hero-mouse-17', 'SKU-0017', 'High quality Logitech G502 Hero Mouse for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 56.48, '₹', NULL, NULL, 91, 0, 'assets/images/products/product17.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(19, 'AMD Ryzen 9 Processor', 'amd-ryzen-9-processor-18', 'SKU-0018', 'High quality AMD Ryzen 9 Processor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 170.65, '₹', NULL, NULL, 107, 0, 'assets/images/products/product18.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(20, 'Samsung 980 Pro SSD', 'samsung-980-pro-ssd-19', 'SKU-0019', 'High quality Samsung 980 Pro SSD for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 27.82, '₹', NULL, NULL, 268, 0, 'assets/images/products/product19.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(21, 'HyperX Cloud II Headset', 'hyperx-cloud-ii-headset-20', 'SKU-0020', 'High quality HyperX Cloud II Headset for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 38.53, '₹', NULL, NULL, 75, 0, 'assets/images/products/product20.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(22, 'MSI Optix Gaming Monitor', 'msi-optix-gaming-monitor-21', 'SKU-0021', 'High quality MSI Optix Gaming Monitor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 401.21, '₹', NULL, NULL, 461, 0, 'assets/images/products/product21.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(23, 'Gigabyte Aorus GPU', 'gigabyte-aorus-gpu-22', 'SKU-0022', 'High quality Gigabyte Aorus GPU for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 160.16, '₹', NULL, NULL, 86, 0, 'assets/images/products/product22.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(24, 'WD Black HDD', 'wd-black-hdd-23', 'SKU-0023', 'High quality WD Black HDD for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 136.52, '₹', NULL, NULL, 23, 0, 'assets/images/products/product23.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(25, 'Samsung 980 Pro SSD', 'samsung-980-pro-ssd-24', 'SKU-0024', 'High quality Samsung 980 Pro SSD for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 20.70, '₹', NULL, NULL, 66, 0, 'assets/images/products/product24.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(26, 'Logitech G733 Headset', 'logitech-g733-headset-25', 'SKU-0025', 'High quality Logitech G733 Headset for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 175.25, '₹', NULL, NULL, 289, 0, 'assets/images/products/product25.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(27, 'G.Skill Trident RAM', 'gskill-trident-ram-26', 'SKU-0026', 'High quality G.Skill Trident RAM for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 260.09, '₹', NULL, NULL, 479, 0, 'assets/images/products/product26.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(28, 'Logitech G733 Headset', 'logitech-g733-headset-27', 'SKU-0027', 'High quality Logitech G733 Headset for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 80.52, '₹', NULL, NULL, 496, 0, 'assets/images/products/product27.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(29, 'ASUS TUF Gaming Monitor', 'asus-tuf-gaming-monitor-28', 'SKU-0028', 'High quality ASUS TUF Gaming Monitor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 452.99, '₹', NULL, NULL, 262, 0, 'assets/images/products/product28.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(30, 'AMD Ryzen 9 Processor', 'amd-ryzen-9-processor-29', 'SKU-0029', 'High quality AMD Ryzen 9 Processor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 169.35, '₹', NULL, NULL, 88, 0, 'assets/images/products/product29.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(31, 'MSI Optix Gaming Monitor', 'msi-optix-gaming-monitor-30', 'SKU-0030', 'High quality MSI Optix Gaming Monitor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 271.64, '₹', NULL, NULL, 500, 0, 'assets/images/products/product30.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(32, 'Razer DeathAdder Mouse', 'razer-deathadder-mouse-31', 'SKU-0031', 'High quality Razer DeathAdder Mouse for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 27.30, '₹', NULL, NULL, 124, 0, 'assets/images/products/product31.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(33, 'G.Skill Trident RAM', 'gskill-trident-ram-32', 'SKU-0032', 'High quality G.Skill Trident RAM for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 162.20, '₹', NULL, NULL, 149, 0, 'assets/images/products/product32.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(34, 'Seagate Barracuda HDD', 'seagate-barracuda-hdd-33', 'SKU-0033', 'High quality Seagate Barracuda HDD for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 469.89, '₹', NULL, NULL, 348, 0, 'assets/images/products/product33.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(35, 'Cooler Master Gaming Case', 'cooler-master-gaming-case-34', 'SKU-0034', 'High quality Cooler Master Gaming Case for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 371.42, '₹', NULL, NULL, 344, 0, 'assets/images/products/product34.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(36, 'AMD Ryzen 9 Processor', 'amd-ryzen-9-processor-35', 'SKU-0035', 'High quality AMD Ryzen 9 Processor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 61.28, '₹', NULL, NULL, 133, 0, 'assets/images/products/product35.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(37, 'Logitech G502 Hero Mouse', 'logitech-g502-hero-mouse-36', 'SKU-0036', 'High quality Logitech G502 Hero Mouse for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 312.41, '₹', NULL, NULL, 60, 0, 'assets/images/products/product36.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(38, 'Gigabyte Aorus GPU', 'gigabyte-aorus-gpu-37', 'SKU-0037', 'High quality Gigabyte Aorus GPU for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 68.16, '₹', NULL, NULL, 314, 0, 'assets/images/products/product37.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(39, 'AMD Ryzen 9 Processor', 'amd-ryzen-9-processor-38', 'SKU-0038', 'High quality AMD Ryzen 9 Processor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 368.35, '₹', NULL, NULL, 24, 0, 'assets/images/products/product38.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(40, 'Corsair K70 RGB Keyboard', 'corsair-k70-rgb-keyboard-39', 'SKU-0039', 'High quality Corsair K70 RGB Keyboard for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 370.31, '₹', NULL, NULL, 41, 0, 'assets/images/products/product39.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(41, 'Logitech G502 Hero Mouse', 'logitech-g502-hero-mouse-40', 'SKU-0040', 'High quality Logitech G502 Hero Mouse for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 220.73, '₹', NULL, NULL, 443, 0, 'assets/images/products/product40.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(42, 'SteelSeries QcK Mousepad', 'steelseries-qck-mousepad-41', 'SKU-0041', 'High quality SteelSeries QcK Mousepad for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 365.29, '₹', NULL, NULL, 376, 0, 'assets/images/products/product41.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(43, 'Logitech G502 Hero Mouse', 'logitech-g502-hero-mouse-42', 'SKU-0042', 'High quality Logitech G502 Hero Mouse for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 153.52, '₹', NULL, NULL, 496, 0, 'assets/images/products/product42.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(44, 'G.Skill Trident RAM', 'gskill-trident-ram-43', 'SKU-0043', 'High quality G.Skill Trident RAM for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 231.78, '₹', NULL, NULL, 387, 0, 'assets/images/products/product43.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(45, 'WD Black HDD', 'wd-black-hdd-44', 'SKU-0044', 'High quality WD Black HDD for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 128.27, '₹', NULL, NULL, 80, 0, 'assets/images/products/product44.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(46, 'Acer Predator Gaming Chair', 'acer-predator-gaming-chair-45', 'SKU-0045', 'High quality Acer Predator Gaming Chair for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 483.49, '₹', NULL, NULL, 110, 0, 'assets/images/products/product45.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(47, 'MSI Optix Gaming Monitor', 'msi-optix-gaming-monitor-46', 'SKU-0046', 'High quality MSI Optix Gaming Monitor for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 371.17, '₹', NULL, NULL, 454, 0, 'assets/images/products/product46.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(48, 'Cooler Master Gaming Case', 'cooler-master-gaming-case-47', 'SKU-0047', 'High quality Cooler Master Gaming Case for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 40.17, '₹', NULL, NULL, 300, 0, 'assets/images/products/product47.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(49, 'Cooler Master Gaming Case', 'cooler-master-gaming-case-48', 'SKU-0048', 'High quality Cooler Master Gaming Case for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 417.81, '₹', NULL, NULL, 316, 0, 'assets/images/products/product48.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(50, 'Cooler Master Gaming Case', 'cooler-master-gaming-case-49', 'SKU-0049', 'High quality Cooler Master Gaming Case for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 448.43, '₹', NULL, NULL, 305, 0, 'assets/images/products/product49.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11'),
(51, 'Cooler Master Gaming Case', 'cooler-master-gaming-case-50', 'SKU-0050', 'High quality Cooler Master Gaming Case for gamers', 1, 1, 1, 1, 1, 0, 1, 0, 371.55, '₹', NULL, NULL, 315, 0, 'assets/images/products/product50.png', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-09-05 21:24:11', '2025-09-05 21:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Color', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(2, 'Size', '2025-03-23 17:01:42', '2025-03-23 17:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_options`
--

CREATE TABLE `product_attribute_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_options`
--

INSERT INTO `product_attribute_options` (`id`, `product_attribute_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'White', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(2, 1, 'Black', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(3, 1, 'Grey', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(4, 1, 'Red', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(5, 1, 'Blue', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(6, 2, 'S', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(7, 2, 'M', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(8, 2, 'L', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(9, 2, 'XL', '2025-03-23 17:01:42', '2025-03-23 17:01:42'),
(10, 2, 'XXL', '2025-03-23 17:01:42', '2025-03-23 17:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `sl_no` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `media_url` varchar(255) NOT NULL,
  `media_type` enum('image','video') DEFAULT 'image',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `star` tinyint(4) NOT NULL,
  `review` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `sl_no` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tag_map`
--

CREATE TABLE `product_tag_map` (
  `sl_no` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `sl_no` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `variant_name` varchar(100) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_requests`
--

CREATE TABLE `refund_requests` (
  `sl_no` int(11) NOT NULL,
  `refund_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected','refunded') DEFAULT 'pending',
  `requested_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7KZObYo4d6bpYLayhe1dztccR1DLZ1cxuSyyhZgO', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVlg2ZEtqcDhXYVljQ3BoRUZyZzBFWWNSTzB6eENXbDdWdnlmcDd0aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1759652535),
('7W7HOw5dcg0oqbO2Fy7Gc1kIGwppDwoeaP4sdJJ1', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSmZsekNOUmdQOE1zR1ZkdGhESUZwSVB3Mnh5T0lhclBTM0JWakVLSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1759735204),
('EJ81PXs2sYyWdrObYYP3F5T9Hm58LakneNYnbFhi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0tLMTZ2b2JZcmoyTHF2RHpqcFNXcGdURDdZNFkwbzRqWENOaWhxNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760126494),
('m7MwQesJaXZtoYZhpUNp0kInM2udVYLtICebGAHd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiVHdINzRpSjNHcWJWdlJSVVprQWtVQTVJejk3NlFYc2JnVVZmaGg1TyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759734576),
('MHwE35wlqnf8mVeATUC7ChynxSJgFhvLjGuQKG7H', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVThCdExYS0thb0RudWlPTUlKb2t5OFVWTFoxa1NMZE9BMkttc2lxRyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbXktYWNjb3VudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1759665107),
('n51m4ZWrxeqHAlorukjcnvwBUMjYXRjrLDDLwZgI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiV0F6bWFQc3lFeGxrclR0VTVWdmRjcGZra0RyeERvck1nMzBuQmp5dyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759640300),
('NZNsHhy99iRHFW4RcwnAeUfhcAfd2s7DRXWgViNm', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZzFMcHhEem1RU3ZqYzR5NHVjbTVFVXlQb0JiMUx0dnFsbTlWclZkQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1759642895),
('pOOmLNjlF676ytWRAnj0CQqfceD3b14a2nSKiWBk', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoienFSMDluUzMySlplOU83NmlpZkR5MTI5THBMMEhCa3doQ052cnlJVSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvd2lzaGxpc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1759680960),
('QBJLZftcYamZJzVifyMJz3DTxQ99jKy5uP1qZWjC', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiemtlV3NzdGNiYjNjUVMxVGM4RWRMYmVzZHNyS09JZ2duVmwxS2RUQyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbXktYWNjb3VudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1758696646),
('uaC16X3hcogT2QNFcEanfLUBaXWD6bw0OzalnjK8', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVGdQbVFUbnY3eURQUVE5WlNyTXNOaHJKNU5LSFNtQ0NQSENCZjlZbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1758841497);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `sl_no` int(11) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `sl_no` int(11) NOT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `sl_no` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `transaction_type` enum('wallet_reload','order_payment') NOT NULL,
  `payment_method` enum('COD','Net Banking','Natcash','Moncash','Credit Card','Debit Card','bank transfer') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_status` enum('pending','success','failed','refunded') DEFAULT 'pending',
  `transaction_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `wallet_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `email_verified_at`, `password`, `last_login_at`, `last_login_ip`, `profile_pic`, `wallet_balance`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', NULL, 'testuser', 'user@example.com', '9999999999', NULL, '$2y$12$JIuw46af9Z29GBy8TcF4ZeGGGsdJMG1DcRvBv9OajfarPY.xUtHwS', NULL, NULL, NULL, 100.00, 1, NULL, '2025-08-14 03:12:33', '2025-08-14 03:12:33'),
(2, 'akaka', NULL, NULL, 'akaka@gmail.com', NULL, NULL, '$2y$12$eMcX9ieiaaR5vmJlVYuj5O9GyIWWK.HPdEn4Rw3YxTZpZA7y5fE0y', NULL, NULL, NULL, 0.00, 1, NULL, '2025-09-18 12:28:53', '2025-09-18 12:28:53'),
(4, 'test', 'kumar', NULL, 'test@gmail.com', '1234567890', NULL, '$2y$12$4gwrKltjfDqXwh.rxwpvQ.usTu1sAtjC7foVpWv/Pccg4eTktwqPq', NULL, NULL, NULL, 0.00, 1, NULL, '2025-09-18 12:42:34', '2025-09-23 23:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `sl_no` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_type` enum('home','office','other') DEFAULT 'home',
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'India',
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `sl_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT 'default.png',
  `user_type` enum('customer','seller','admin') DEFAULT 'customer',
  `created_at` datetime DEFAULT current_timestamp(),
  `wallet_balance` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `sl_no` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `balance_after` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `wallet_transactions`
--
DELIMITER $$
CREATE TRIGGER `update_wallet_balance_after_insert` AFTER INSERT ON `wallet_transactions` FOR EACH ROW BEGIN
    IF NEW.transaction_type = 'credit' THEN
        UPDATE user_info
        SET wallet_balance = wallet_balance + NEW.amount
        WHERE user_id = NEW.user_id;
    ELSEIF NEW.transaction_type = 'debit' THEN
        UPDATE user_info
        SET wallet_balance = wallet_balance - NEW.amount
        WHERE user_id = NEW.user_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(6, 2, 4, '2025-09-18 19:30:37', '2025-09-18 19:30:37'),
(7, 2, 2, '2025-09-18 19:36:14', '2025-09-18 19:36:14'),
(9, 4, 4, '2025-09-19 07:13:17', '2025-09-19 07:13:17'),
(11, 4, 6, '2025-09-19 10:24:10', '2025-09-19 10:24:10'),
(12, 4, 3, '2025-09-19 10:24:17', '2025-09-19 10:24:17'),
(13, 4, 11, '2025-09-19 10:28:08', '2025-09-19 10:28:08'),
(16, 4, 2, '2025-09-21 10:03:31', '2025-09-21 10:03:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cart` (`user_id`,`product_id`),
  ADD KEY `fk_cart_product` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_name` (`country_name`),
  ADD UNIQUE KEY `country_code` (`country_code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `order_item_id` (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute_options`
--
ALTER TABLE `product_attribute_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attribute_options_product_attribute_id_foreign` (`product_attribute_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `media_id` (`media_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `tag_name` (`tag_name`),
  ADD UNIQUE KEY `tag_id` (`tag_id`);

--
-- Indexes for table `product_tag_map`
--
ALTER TABLE `product_tag_map`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `product_id` (`product_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `variant_id` (`variant_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `refund_requests`
--
ALTER TABLE `refund_requests`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `refund_id` (`refund_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_item_id` (`order_item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`sl_no`),
  ADD KEY `country_code` (`country_code`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `stock_id` (`stock_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `address_id` (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`sl_no`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_wishlist` (`user_id`,`product_id`),
  ADD KEY `fk_wishlist_product` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attribute_options`
--
ALTER TABLE `product_attribute_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tag_map`
--
ALTER TABLE `product_tag_map`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_requests`
--
ALTER TABLE `refund_requests`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `user_address` (`address_id`);

--
-- Constraints for table `product_attribute_options`
--
ALTER TABLE `product_attribute_options`
  ADD CONSTRAINT `product_attribute_options_product_attribute_id_foreign` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`id`);

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `fk_wishlist_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_wishlist_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
