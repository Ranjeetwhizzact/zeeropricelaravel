-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 10:35 AM
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
-- Database: `zeroprice`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'India',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `adminid` int(11) NOT NULL,
  `byadminid` int(11) NOT NULL DEFAULT 0,
  `username` varchar(50) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `ipassword` varchar(100) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `pic1` varchar(100) DEFAULT NULL,
  `admintype` tinyint(1) NOT NULL DEFAULT 2,
  `commission` decimal(10,2) NOT NULL DEFAULT 0.00,
  `istatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`adminid`, `byadminid`, `username`, `emailid`, `ipassword`, `fullname`, `pic1`, `admintype`, `commission`, `istatus`) VALUES
(1, 0, 'admin', 'hemantjd@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Hemant Jadhav', NULL, 1, 0.00, 1),
(3, 0, '9222369691', 'hemantjd1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Fulllname', NULL, 2, 0.00, 1),
(4, 1, '9699377247', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Ranjeet Poojari', NULL, 3, 10.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `ad_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `media_type` enum('image','video') DEFAULT 'image',
  `media_url` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('active','paused','completed') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`ad_id`, `seller_id`, `product_id`, `title`, `description`, `media_type`, `media_url`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 35, 'SKODA LIGTS', NULL, 'image', 'ads/1776691631_69e629afccd23.jpg', NULL, NULL, 'active', '2026-04-20 07:57:29', '2026-04-20 07:57:29'),
(2, 1, 35, 'SOKADA', NULL, 'image', 'ads/1775388260.jpg', '2026-04-05', '2026-04-06', 'active', '2026-04-05 05:54:20', '2026-04-05 05:54:20'),
(9, 1, 72, 'LED LIGHTS', NULL, 'image', 'ads/1776856803_69e8aee39c3ba.jpg', '2026-04-22', '2028-03-22', 'active', '2026-04-22 05:50:03', '2026-04-22 05:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `ad_clicks`
--

CREATE TABLE `ad_clicks` (
  `click_id` int(11) NOT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `click_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_reward_given` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ad_clicks`
--

INSERT INTO `ad_clicks` (`click_id`, `ad_id`, `buyer_id`, `product_id`, `click_time`, `is_reward_given`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 78, '2026-06-05 11:46:19', 0, '2026-06-05 06:16:19', '2026-06-05 06:16:19'),
(2, 2, 1, 35, '2026-06-05 12:13:23', 1, '2026-06-05 06:43:23', '2026-06-05 06:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `ad_packages`
--

CREATE TABLE `ad_packages` (
  `id` bigint(20) NOT NULL,
  `price` int(11) NOT NULL,
  `ads_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ad_packages`
--

INSERT INTO `ad_packages` (`id`, `price`, `ads_count`, `created_at`, `updated_at`) VALUES
(1, 100, 1, '2026-04-22 11:02:16', '2026-04-22 11:02:16'),
(2, 500, 5, '2026-04-22 11:02:16', '2026-04-22 11:02:16'),
(3, 1000, 12, '2026-04-22 11:02:16', '2026-04-22 11:02:16'),
(4, 2000, 30, '2026-04-22 11:02:16', '2026-04-22 11:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `ad_revenue_split`
--

CREATE TABLE `ad_revenue_split` (
  `id` int(11) NOT NULL,
  `click_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT 5.00,
  `buyer_reward` decimal(10,2) DEFAULT 1.00,
  `product_reduction` decimal(10,2) DEFAULT 1.00,
  `ad_product_reduction` decimal(10,2) DEFAULT 1.00,
  `platform_earning` decimal(10,2) DEFAULT 2.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ad_revenue_split`
--

INSERT INTO `ad_revenue_split` (`id`, `click_id`, `total_amount`, `buyer_reward`, `product_reduction`, `ad_product_reduction`, `platform_earning`, `created_at`, `updated_at`) VALUES
(1, 2, 10.00, 5.00, 2.00, 1.00, 2.00, '2026-06-05 06:43:23', '2026-06-05 06:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `ad_tasks`
--

CREATE TABLE `ad_tasks` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `task_type` enum('watch','like','share','comment') DEFAULT NULL,
  `task_details` text DEFAULT NULL,
  `comment_text` text DEFAULT NULL,
  `reward` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ad_tasks`
--

INSERT INTO `ad_tasks` (`task_id`, `user_id`, `ad_id`, `task_type`, `task_details`, `comment_text`, `reward`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'comment', 'Comment completed', 'Click buy before price goes up!', 5, '2026-06-05 06:43:23', '2026-06-05 06:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `ad_task_completions`
--

CREATE TABLE `ad_task_completions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `Suburbs` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `city`, `Suburbs`, `area`, `pincode`, `status`, `created_at`) VALUES
(2, 'Mumbai', 'sion', 'Sion (W)', '400017', '1', '2025-07-02 08:19:06'),
(3, 'Mumbai', 'Kurla', 'Kurla (E)', '400070', '1', '2025-07-02 08:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_ad_slots`
--

CREATE TABLE `buyer_ad_slots` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer_ad_slots`
--

INSERT INTO `buyer_ad_slots` (`id`, `buyer_id`, `ad_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'completed', '2026-06-05 06:16:19', '2026-06-05 06:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` int(11) NOT NULL,
  `catname` varchar(50) NOT NULL,
  `istatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `catname`, `istatus`) VALUES
(1, 'Cloths', 1),
(2, 'Mobile & Tablets', 0),
(3, 'Computers & Accessories', 1),
(4, 'Electronics', 1),
(5, 'Furniture', 0),
(6, 'Jewellery', 0),
(14, 'Watches', 1),
(8, 'Bags, Wallets', 0),
(9, 'Sports & Fitness', 0),
(10, 'Personal Care', 0),
(11, 'Hardware', 0),
(12, 'Shoes', 0),
(13, 'Automobile', 0),
(15, 'Stationery', 1),
(16, 'Grocery', 0),
(18, 'Liquor', 0),
(19, 'Fight Corona', 1),
(21, 'Festival', 1),
(22, 'Ayurveda ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount_offers`
--

CREATE TABLE `discount_offers` (
  `id` int(11) NOT NULL,
  `form_price` varchar(50) NOT NULL,
  `to_price` varchar(50) NOT NULL,
  `discounts` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `discount_offers`
--

INSERT INTO `discount_offers` (`id`, `form_price`, `to_price`, `discounts`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '3000', '10', '', '2025-06-13 12:49:31', '2025-08-12 05:58:41'),
(3, '3001', '4999', '12', '', '2025-06-13 12:50:40', '2025-08-12 06:01:18'),
(20, '5000', '9999', '15', '', '2025-06-20 13:31:23', '2025-08-12 06:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctype` varchar(100) NOT NULL,
  `doc_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `freepoints`
--

CREATE TABLE `freepoints` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `postedon` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `freepoints`
--

INSERT INTO `freepoints` (`id`, `userid`, `points`, `postedon`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2023-04-28', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(2, 3, 2, '2023-04-30', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(3, 3, 2, '2023-05-04', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(4, 3, 2, '2023-05-08', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(5, 3, 2, '2023-05-09', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(6, 3, 2, '2023-05-11', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(7, 3, 2, '2023-05-12', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(8, 3, 2, '2023-05-16', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(9, 6, 3, '2023-05-18', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(10, 5, 3, '2023-05-19', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(11, 6, 3, '2023-05-19', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(12, 6, 3, '2023-05-20', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(13, 6, 3, '2023-05-21', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(14, 5, 4, '2023-05-21', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(15, 7, 4, '2023-05-22', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(16, 9, 3, '2023-05-22', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(17, 9, 4, '2023-05-23', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(18, 5, 4, '2023-05-23', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(19, 10, 2, '2023-05-26', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(20, 10, 2, '2023-05-27', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(21, 11, 2, '2023-05-29', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(22, 11, 2, '2023-05-30', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(23, 11, 2, '2023-06-01', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(24, 12, 2, '2023-06-01', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(25, 12, 2, '2023-06-02', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(26, 12, 2, '2023-06-04', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(27, 12, 2, '2023-06-11', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(28, 12, 2, '2023-06-12', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(29, 13, 2, '2023-06-13', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(30, 14, 2, '2023-06-13', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(31, 12, 2, '2023-06-15', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(32, 12, 2, '2023-06-17', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(33, 12, 2, '2023-06-19', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(34, 10, 2, '2023-06-20', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(35, 10, 2, '2023-06-21', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(36, 10, 2, '2023-06-22', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(37, 16, 0, '2023-06-22', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(38, 16, 0, '2023-06-23', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(39, 16, 0, '2023-06-24', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(40, 3, 2, '2023-06-26', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(41, 3, 2, '2023-07-14', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(42, 3, 2, '2023-07-22', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(43, 15, 4, '2023-07-22', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(44, 15, 4, '2023-07-23', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(45, 9, 4, '2023-07-23', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(46, 17, 4, '2023-07-23', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(47, 17, 4, '2023-07-24', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(48, 3, 2, '2023-07-25', '2025-12-22 02:02:48', '2025-12-22 02:02:48'),
(49, 1, 164, '2025-12-22', '2025-12-21 20:37:00', '2026-06-05 06:41:54'),
(51, 2, 46, '2026-04-21', '2026-04-20 23:58:39', '2026-04-21 02:28:43');

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
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `orderid` varchar(25) NOT NULL,
  `sellerid` smallint(100) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `isFree` tinyint(1) NOT NULL DEFAULT 0,
  `pid` int(11) NOT NULL,
  `ititle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `mrp` decimal(10,0) NOT NULL,
  `minprice` decimal(10,0) NOT NULL,
  `collectedprice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `customercost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `otp` varchar(6) DEFAULT NULL,
  `isCancelled` tinyint(1) NOT NULL DEFAULT 0,
  `cancelledOn` timestamp NULL DEFAULT NULL,
  `returndays` tinyint(3) NOT NULL DEFAULT 0,
  `isDelivered` tinyint(1) NOT NULL DEFAULT 0,
  `postedon` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `orderid`, `sellerid`, `userid`, `isFree`, `pid`, `ititle`, `qty`, `mrp`, `minprice`, `collectedprice`, `customercost`, `otp`, `isCancelled`, `cancelledOn`, `returndays`, `isDelivered`, `postedon`, `created_at`, `updated_at`) VALUES
(1, '372025185905', 37, 45, 0, 44, 'Deepak ', 1, 300, 50, 13.00, 287.00, '39803', 0, NULL, 0, 0, '2025-01-06 23:59:09', NULL, NULL),
(2, '412025190822', 41, 45, 0, 45, 'T.v. Remote ', 1, 550, 400, 3.00, 547.00, '61527', 0, NULL, 0, 0, '2025-01-07 00:08:27', NULL, NULL),
(3, '452025173118', 45, 45, 0, 47, 'Mango', 1, 2, 1, 1.00, 0.00, '50348', 0, NULL, 0, 0, '2025-05-24 12:02:01', NULL, NULL),
(4, '452025174911', 45, 45, 0, 48, 'Mango', 1, 5, 1, 1.00, 0.00, '30151', 0, NULL, 0, 0, '2025-05-24 12:19:29', NULL, NULL),
(5, '452025175127', 45, 45, 0, 52, 'Usha Fan', 1, 7, -1, 1.00, 0.00, '84930', 0, NULL, 0, 0, '2025-05-24 12:21:34', NULL, NULL),
(6, '452025175439', 45, 45, 0, 51, 'Mango', 1, 8, 1, 1.00, 0.00, '41492', 0, NULL, 0, 0, '2025-05-24 12:24:43', NULL, NULL),
(7, '452025175641', 45, 45, 0, 50, 'Car', 1, 7, 1, 1.00, 0.00, '8605', 0, NULL, 0, 0, '2025-05-24 12:26:46', NULL, NULL),
(8, '452025182218', 45, 45, 0, 49, 'Lifebuoy', 1, 6, 1, 1.00, 0.00, '80701', 0, NULL, 0, 0, '2025-05-24 12:52:20', NULL, NULL),
(9, '452025171140', 45, 45, 0, 55, 'Ear Phone', 1, 7, 1, 1.00, 0.00, '17317', 0, NULL, 0, 0, '2025-05-28 11:41:50', NULL, NULL),
(10, '452025173743', 45, 45, 0, 57, 'Ozier', 1, 7, 1, 1.00, 0.00, '12189', 0, NULL, 0, 0, '2025-05-29 12:07:44', NULL, NULL),
(11, '452025164019', 45, 45, 0, 58, 'Pexter', 1, 7, 1, 1.00, 0.00, '53503', 0, NULL, 0, 0, '2025-05-30 11:10:23', NULL, NULL),
(12, '452025164722', 45, 45, 0, 59, 'Rjjr', 1, 16, 1, 1.00, 0.00, '51406', 0, NULL, 0, 0, '2025-05-30 11:17:24', NULL, NULL),
(13, '452025165401', 45, 45, 0, 60, 'Lifebuoy', 1, 45, -1, 1.00, 0.00, '84361', 0, NULL, 0, 0, '2025-05-30 11:24:03', NULL, NULL),
(14, '452025173614', 45, 47, 0, 59, 'Rjjr', 1, 16, 1, 4.00, 0.00, '66836', 0, NULL, 0, 0, '2025-05-30 12:06:16', NULL, NULL),
(15, '452025175428', 45, 47, 0, 59, 'Rjjr', 1, 16, 1, 6.00, 0.00, '15364', 0, NULL, 0, 0, '2025-05-30 12:24:30', NULL, NULL),
(16, '452025175614', 45, 45, 0, 59, 'Rjjr', 1, 16, 1, 7.00, 0.00, '76277', 0, NULL, 0, 0, '2025-05-30 12:26:16', NULL, NULL),
(17, '452025180415', 45, 45, 0, 59, 'Rjjr', 1, 16, 1, 8.00, 0.00, '68634', 0, NULL, 0, 0, '2025-05-30 12:34:16', NULL, NULL),
(18, '452025180533', 45, 47, 0, 59, 'Rjjr', 1, 16, 1, 9.00, 0.00, '25504', 0, NULL, 0, 0, '2025-05-30 12:35:35', NULL, NULL),
(19, '452025193209', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '95700', 0, NULL, 0, 0, '2025-07-08 14:02:09', NULL, NULL),
(20, '452025180303', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '35908', 0, NULL, 0, 0, '2025-07-09 12:33:03', NULL, NULL),
(21, '452025181122', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '4566', 0, NULL, 0, 0, '2025-07-09 12:41:22', NULL, NULL),
(22, '452025183347', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '29533', 0, NULL, 0, 0, '2025-07-09 13:03:47', NULL, NULL),
(23, '452025184836', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '42510', 0, NULL, 0, 0, '2025-07-09 13:18:36', NULL, NULL),
(24, '452025114811', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '5084', 0, NULL, 0, 0, '2025-07-10 06:18:11', NULL, NULL),
(25, '452025115454', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '56423', 0, NULL, 0, 0, '2025-07-10 06:24:54', NULL, NULL),
(26, '452025150926', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '99123', 0, NULL, 0, 0, '2025-07-10 09:39:26', NULL, NULL),
(27, '452025151613', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '69579', 0, NULL, 0, 0, '2025-07-10 09:46:13', NULL, NULL),
(28, '452025152023', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '28174', 0, NULL, 0, 0, '2025-07-10 09:50:23', NULL, NULL),
(29, '452025152137', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '37864', 0, NULL, 0, 0, '2025-07-10 09:51:37', NULL, NULL),
(30, '452025152915', 45, 45, 0, 62, 'Pextside', 1, 5, 3, 0.00, 5.00, '30416', 0, NULL, 0, 0, '2025-07-10 09:59:15', NULL, NULL),
(31, '452025113305', 45, 45, 0, 63, 'Mango', 1, 4, 3, 3.00, 0.00, '2977', 0, NULL, 0, 0, '2025-08-05 06:03:30', NULL, NULL),
(32, '452025113651', 45, 45, 0, 63, 'Mango', 1, 4, 3, 3.00, 4.00, '26138', 0, NULL, 0, 0, '2025-08-05 06:06:51', NULL, NULL),
(33, '452025120851', 45, 45, 0, 63, 'Mango', 1, 4, 3, 4.00, 0.00, '96355', 0, NULL, 0, 0, '2025-08-05 06:39:15', NULL, NULL),
(34, '452025121307', 45, 45, 0, 63, 'Mango', 1, 4, 3, 5.00, 0.00, '80950', 0, NULL, 0, 0, '2025-08-05 06:43:23', NULL, NULL),
(35, '452025112425', 45, 45, 0, 64, 'Rose', 1, 4, 3, 1.00, 4.00, '89769', 0, NULL, 0, 0, '2025-08-06 05:54:25', NULL, NULL),
(36, '452025112540', 45, 45, 0, 64, 'Rose', 1, 4, 3, 1.00, 4.00, '83522', 0, NULL, 0, 0, '2025-08-06 05:55:40', NULL, NULL),
(37, '452025090551', 45, 45, 0, 65, 'Raki', 1, 5, 2, 2.00, 0.00, '87013', 0, NULL, 0, 0, '2025-08-11 03:36:15', NULL, NULL),
(38, '452025111751', 45, 45, 0, 65, 'Raki', 1, 4, 2, 2.00, 0.00, '12740', 0, NULL, 0, 0, '2025-08-11 05:55:47', NULL, NULL),
(39, '452025114115', 45, 45, 0, 65, 'Raki', 1, 4, 2, 1.00, 3.00, '73145', 0, NULL, 0, 0, '2025-08-11 06:11:25', NULL, NULL),
(40, '452025115943', 45, 45, 0, 65, 'Raki', 1, 4, 2, 2.00, 0.00, '85959', 0, NULL, 0, 0, '2025-08-11 06:30:17', NULL, NULL),
(41, '452025120210', 45, 45, 0, 65, 'Raki', 1, 4, 2, 1.00, 3.00, '69336', 0, NULL, 0, 0, '2025-08-11 06:32:34', NULL, NULL),
(42, '452025120806', 45, 45, 0, 65, 'Raki', 1, 4, 2, 0.00, 4.00, '62350', 0, NULL, 0, 0, '2025-08-11 06:38:06', NULL, NULL),
(43, '452025120922', 45, 45, 0, 65, 'Raki', 1, 4, 2, 0.00, 4.00, '11126', 0, NULL, 0, 0, '2025-08-11 06:39:22', NULL, NULL),
(44, '452025122558', 45, 45, 0, 65, 'Raki', 1, 4, 2, 0.00, 4.00, '28296', 0, NULL, 0, 0, '2025-08-11 06:55:58', NULL, NULL),
(45, '452025122916', 45, 45, 0, 65, 'Raki', 1, 4, 2, 2.00, 0.00, '31541', 0, NULL, 0, 0, '2025-08-11 06:59:28', NULL, NULL),
(46, '452025125216', 45, 45, 0, 65, 'Raki', 1, 4, 2, 1.00, 3.00, '59289', 0, NULL, 0, 0, '2025-08-11 07:22:29', NULL, NULL),
(47, '452025125404', 45, 45, 0, 65, 'Raki', 1, 4, 2, 2.00, 0.00, '67538', 0, NULL, 0, 0, '2025-08-11 07:24:15', NULL, NULL),
(48, '452025214921', 45, 45, 0, 66, 'Raki1', 1, 5, 3, 3.00, 0.00, '38172', 0, NULL, 0, 0, '2025-09-21 16:19:28', NULL, NULL),
(49, '452025220212', 45, 45, 0, 66, 'Raki1', 1, 5, 3, 3.00, 0.00, '70122', 0, NULL, 0, 0, '2025-09-21 16:32:48', NULL, NULL),
(50, '452025221252', 45, 45, 0, 66, 'Raki1', 1, 5, 3, 4.00, 0.00, '67496', 0, NULL, 0, 0, '2025-09-21 16:43:11', NULL, NULL),
(51, '452025223042', 45, 45, 0, 66, 'Raki1', 1, 5, 3, 3.00, 0.00, '42711', 0, NULL, 0, 0, '2025-09-21 17:01:10', NULL, NULL),
(52, '452025223258', 45, 45, 0, 66, 'Raki1', 1, 5, 3, 3.00, 0.00, '67254', 0, NULL, 0, 0, '2025-09-21 17:03:13', NULL, NULL),
(53, '452025224820', 45, 45, 0, 66, 'Raki1', 1, 5, 3, 3.00, 0.00, '62769', 0, NULL, 0, 0, '2025-09-21 17:18:29', NULL, NULL);

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
-- Table structure for table `pointspackage`
--

CREATE TABLE `pointspackage` (
  `id` int(11) NOT NULL,
  `packagename` varchar(50) NOT NULL,
  `points` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `cost` decimal(10,0) NOT NULL,
  `istatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pointspackage`
--

INSERT INTO `pointspackage` (`id`, `packagename`, `points`, `currency`, `cost`, `istatus`) VALUES
(1, 'Budget 5', 5, 'INR', 5, 1),
(2, 'Budget 10', 10, 'INR', 10, 1),
(3, 'Budget 15', 15, 'INR', 15, 1),
(4, 'Economy 25', 25, 'INR', 25, 1),
(5, 'Economy 50', 50, 'INR', 50, 1),
(6, 'Economy 100', 100, 'INR', 100, 1),
(7, 'Premium', 250, 'INR', 250, 1),
(8, 'Golden', 500, 'INR', 500, 1),
(9, 'Platinum', 1000, 'INR', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pointstransaction`
--

CREATE TABLE `pointstransaction` (
  `transactionid` int(11) NOT NULL,
  `orderid` varchar(35) NOT NULL,
  `userid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qtyBatchNo` int(11) NOT NULL DEFAULT 1,
  `sellerid` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `reducedPrice` decimal(10,2) NOT NULL,
  `postedon` timestamp NOT NULL DEFAULT current_timestamp(),
  `source` enum('gold','ad','free') DEFAULT 'gold',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pointstransaction`
--

INSERT INTO `pointstransaction` (`transactionid`, `orderid`, `userid`, `pid`, `qtyBatchNo`, `sellerid`, `points`, `mrp`, `reducedPrice`, `postedon`, `source`, `created_at`, `updated_at`) VALUES
(1, '', 2, 1, 1, 3, 5, 0.00, 49999.00, '2023-03-02 09:24:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(2, '', 2, 1, 1, 3, 5, 0.00, 49998.00, '2023-03-02 09:27:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(3, '', 2, 1, 1, 3, 5, 0.00, 49996.00, '2023-03-03 11:21:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(4, '', 2, 1, 1, 3, 5, 0.00, 49995.00, '2023-03-03 11:24:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(5, '', 2, 1, 1, 3, 5, 0.00, 49994.00, '2023-03-03 11:25:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(6, '', 2, 1, 1, 3, 5, 0.00, 49993.00, '2023-03-03 11:26:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(7, '', 2, 1, 1, 3, 5, 0.00, 49991.00, '2023-03-03 11:26:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(8, '', 2, 1, 1, 3, 5, 0.00, 49990.00, '2023-03-03 11:44:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(9, '', 2, 1, 1, 3, 5, 0.00, 49989.00, '2023-03-03 11:19:45', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(10, '', 2, 1, 1, 3, 5, 0.00, 49988.00, '2023-03-03 11:20:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(11, '', 2, 1, 1, 3, 5, 0.00, 49986.00, '2023-03-03 11:39:58', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(12, '', 2, 1, 1, 3, 5, 0.00, 49985.00, '2023-03-03 11:40:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(13, '', 2, 1, 1, 3, 5, 0.00, 49983.85, '2023-03-03 15:01:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(14, '', 1, 1, 1, 3, 5, 0.00, 49982.65, '2023-03-03 00:36:57', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(15, '', 1, 3, 1, 3, 1, 0.00, 49.75, '2023-03-06 04:44:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(16, '', 2, 3, 1, 3, 1, 0.00, 49.50, '2023-03-06 03:45:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(17, '', 2, 3, 1, 3, 1, 0.00, 49.25, '2023-03-06 09:44:09', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(18, '', 1, 2, 1, 3, 1, 0.00, 49.75, '2023-03-06 09:49:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(19, '', 1, 2, 1, 3, 1, 0.00, 49.50, '2023-03-06 09:49:55', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(20, '', 2, 2, 1, 3, 1, 0.00, 49.25, '2023-03-06 09:50:27', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(21, '', 2, 2, 1, 3, 1, 0.00, 49.75, '2023-03-06 09:50:59', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(22, '', 2, 2, 1, 3, 1, 0.00, 49.50, '2023-03-06 09:51:06', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(23, '', 1, 3, 1, 3, 1, 0.00, 49.75, '2023-03-06 09:57:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(24, '', 1, 3, 1, 3, 1, 0.00, 49.50, '2023-03-06 09:57:27', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(25, '', 1, 3, 1, 3, 1, 0.00, 49.25, '2023-03-06 09:57:58', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(26, '', 1, 3, 1, 3, 1, 0.00, 49.75, '2023-03-06 09:45:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(27, '', 1, 3, 1, 3, 1, 0.00, 49.50, '2023-03-06 09:45:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(28, '', 1, 3, 1, 3, 1, 0.00, 49.25, '2023-03-06 09:48:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(29, '', 1, 3, 1, 3, 1, 0.00, 49.75, '2023-03-08 05:35:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(30, '', 1, 3, 1, 3, 1, 0.00, 49.50, '2023-03-08 05:35:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(31, '', 1, 3, 1, 3, 1, 0.00, 49.25, '2023-03-08 05:35:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(32, '', 1, 2, 1, 3, 1, 0.00, 49.25, '2023-03-08 05:28:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(33, '', 1, 2, 1, 3, 1, 0.00, 49.75, '2023-03-10 14:59:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(34, '', 1, 2, 1, 3, 1, 0.00, 49.50, '2023-03-14 12:47:26', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(35, '', 1, 2, 1, 3, 1, 0.00, 49.25, '2023-03-14 12:50:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(36, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-14 12:52:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(37, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:53:55', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(38, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:56:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(39, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:56:54', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(40, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:57:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(41, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:57:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(42, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:58:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(43, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:59:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(44, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:59:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(45, '', 1, 2, 1, 3, 1, 0.00, 49.00, '2023-03-15 13:59:35', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(46, '', 1, 1, 1, 3, 5, 50000.00, 49981.40, '2023-03-15 14:19:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(47, '', 1, 1, 1, 3, 5, 50000.00, 49980.15, '2023-04-13 09:21:43', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(48, '', 4, 4, 1, 4, 1, 100.00, 99.75, '2023-05-01 05:22:19', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(49, '', 1, 5, 1, 4, 1, 600.00, 599.25, '2023-05-01 15:13:25', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(50, '', 2, 5, 1, 4, 1, 600.00, 599.00, '2023-05-01 16:06:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(51, '', 2, 4, 1, 4, 1, 100.00, 99.50, '2023-05-01 17:55:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(52, '', 4, 4, 1, 4, 1, 100.00, 99.25, '2023-05-04 21:45:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(53, '', 4, 5, 1, 4, 1, 600.00, 598.75, '2023-05-04 21:46:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(54, '', 4, 4, 1, 4, 1, 100.00, 99.00, '2023-05-05 13:11:43', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(55, '', 4, 5, 1, 4, 1, 600.00, 598.50, '2023-05-05 13:13:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(56, '', 4, 5, 1, 4, 1, 600.00, 598.25, '2023-05-06 01:43:30', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(57, '', 4, 5, 1, 4, 1, 600.00, 598.00, '2023-05-06 01:45:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(58, '', 4, 3, 1, 3, 10, 500000.00, 499968.50, '2023-05-06 01:46:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(59, '', 4, 5, 1, 4, 1, 600.00, 597.75, '2023-05-06 02:53:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(60, '', 4, 3, 1, 3, 10, 500000.00, 499966.00, '2023-05-06 03:02:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(61, '', 4, 5, 1, 4, 1, 600.00, 597.50, '2023-05-06 15:02:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(62, '', 4, 5, 1, 4, 1, 600.00, 597.25, '2023-05-06 16:05:09', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(63, '', 4, 5, 1, 4, 1, 600.00, 597.00, '2023-05-06 20:40:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(64, '', 4, 5, 1, 4, 1, 600.00, 596.75, '2023-05-07 13:21:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(65, '', 4, 3, 1, 3, 10, 500000.00, 499963.50, '2023-05-07 13:22:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(66, '', 4, 3, 1, 3, 10, 500000.00, 499961.00, '2023-05-07 13:32:00', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(67, '', 4, 5, 1, 4, 1, 600.00, 596.50, '2023-05-08 14:08:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(68, '', 4, 6, 1, 4, 1, 150.00, 149.75, '2023-05-08 15:04:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(69, '', 4, 7, 1, 4, 1, 200.00, 199.75, '2023-05-08 15:10:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(70, '', 4, 7, 1, 4, 1, 200.00, 199.50, '2023-05-08 23:17:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(71, '', 4, 7, 1, 4, 1, 200.00, 199.25, '2023-05-09 02:13:10', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(72, '', 4, 10, 1, 3, 5, 15000.00, 14998.75, '2023-05-09 02:14:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(73, '', 4, 7, 1, 4, 1, 200.00, 199.00, '2023-05-09 17:28:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(74, '', 4, 10, 1, 3, 5, 15000.00, 14997.50, '2023-05-09 19:49:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(75, '', 4, 1, 1, 3, 1, 400.00, 396.25, '2023-05-10 00:17:48', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(76, '', 4, 7, 1, 4, 1, 200.00, 198.75, '2023-05-10 00:57:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(77, '', 1, 7, 1, 4, 1, 200.00, 198.50, '2023-05-10 17:33:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(78, '', 1, 7, 1, 4, 1, 200.00, 198.25, '2023-05-10 17:34:58', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(79, '', 1, 10, 1, 3, 5, 15000.00, 14996.25, '2023-05-11 20:47:59', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(80, '', 1, 10, 1, 3, 5, 15000.00, 14995.00, '2023-05-11 20:48:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(81, '', 1, 10, 1, 3, 5, 15000.00, 14993.75, '2023-05-11 20:49:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(82, '', 4, 7, 1, 4, 1, 200.00, 198.00, '2023-05-15 04:20:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(83, '', 4, 10, 1, 3, 5, 15000.00, 14992.50, '2023-05-17 15:07:59', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(84, '', 4, 7, 1, 4, 1, 200.00, 197.75, '2023-05-17 15:08:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(85, '', 6, 11, 1, 5, 1, 50.00, 49.75, '2023-05-21 16:06:43', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(86, '', 6, 12, 1, 7, 1, 250.00, 249.75, '2023-05-31 02:18:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(87, '', 6, 12, 1, 7, 1, 250.00, 249.50, '2023-05-31 02:20:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(88, '', 16, 17, 1, 16, 1, 115.00, 229.00, '2023-06-25 22:36:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(89, '', 16, 16, 1, 16, 1, 115.00, 81.00, '2023-06-25 22:51:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(90, '', 16, 12, 1, 7, 1, 288.00, 286.00, '2023-06-26 20:11:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(91, '', 16, 12, 1, 7, 1, 288.00, 285.00, '2023-06-26 20:12:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(92, '', 16, 12, 1, 7, 1, 288.00, 327.00, '2023-06-27 14:30:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(93, '', 16, 14, 1, 12, 1, 104.00, 103.00, '2023-06-28 04:28:37', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(94, '', 16, 14, 1, 12, 1, 104.00, 102.00, '2023-06-28 04:28:50', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(95, '', 16, 15, 1, 12, 1, 144.00, 143.00, '2023-06-29 00:05:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(96, '', 16, 14, 1, 12, 1, 104.00, 116.00, '2023-06-30 00:18:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(97, '', 16, 12, 1, 7, 1, 288.00, 375.00, '2023-06-30 00:18:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(98, '', 16, 19, 1, 16, 1, 805.00, 804.00, '2023-06-30 21:22:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(99, '', 16, 19, 1, 16, 1, 805.00, 803.00, '2023-07-01 14:56:43', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(100, '', 16, 18, 1, 16, 1, 782.00, 781.00, '2023-07-02 02:50:19', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(101, '', 16, 18, 1, 16, 1, 782.00, 780.00, '2023-07-02 02:50:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(102, '', 16, 18, 1, 16, 1, 782.00, 779.00, '2023-07-02 02:51:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(103, '', 16, 18, 1, 16, 1, 782.00, 778.00, '2023-07-04 02:58:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(104, '', 16, 18, 1, 16, 1, 782.00, 894.00, '2023-07-04 14:43:11', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(105, '', 16, 19, 1, 16, 1, 805.00, 922.00, '2023-07-04 14:46:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(106, '', 16, 13, 1, 12, 1, 115.00, 114.00, '2023-07-04 14:53:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(107, '', 16, 14, 1, 12, 1, 104.00, 132.00, '2023-07-04 14:53:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(108, '', 16, 18, 1, 16, 1, 782.00, 1026.00, '2023-07-05 01:59:25', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(109, '', 16, 19, 1, 16, 1, 805.00, 1059.00, '2023-07-05 22:29:11', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(110, '', 16, 18, 1, 16, 1, 782.00, 1179.00, '2023-07-07 04:12:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(111, '', 16, 13, 1, 12, 1, 115.00, 130.00, '2023-07-07 19:22:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(112, '', 16, 18, 1, 16, 1, 782.00, 1355.00, '2023-07-08 22:40:50', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(113, '', 16, 18, 1, 16, 1, 782.00, 1557.00, '2023-07-10 03:44:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(114, '', 16, 18, 1, 16, 1, 782.00, 1790.00, '2023-07-11 16:11:06', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(115, '', 16, 18, 1, 16, 1, 782.00, 1789.00, '2023-07-11 22:21:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(116, '', 16, 18, 1, 16, 1, 782.00, 2056.00, '2023-07-13 04:06:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(117, '', 16, 18, 1, 16, 1, 782.00, 2363.00, '2023-07-15 17:50:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(118, '', 16, 18, 1, 16, 1, 680.00, 2362.00, '2023-07-17 17:31:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(119, '', 16, 18, 1, 16, 1, 680.00, 2361.00, '2023-07-17 17:31:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(120, '', 16, 18, 1, 16, 1, 680.00, 2360.00, '2023-07-17 17:32:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(121, '', 16, 20, 1, 16, 1, 150.00, 149.00, '2023-07-17 18:50:00', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(122, '', 16, 20, 1, 16, 1, 150.00, 148.00, '2023-07-17 18:50:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(123, '', 16, 20, 1, 16, 1, 150.00, 147.00, '2023-07-17 18:50:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(124, '', 16, 20, 1, 16, 1, 150.00, 146.00, '2023-07-17 18:50:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(125, '', 16, 20, 1, 16, 1, 150.00, 146.00, '2023-07-17 18:51:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(126, '', 16, 20, 1, 16, 1, 150.00, 146.00, '2023-07-17 18:51:30', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(127, '', 16, 21, 1, 16, 1, 11.00, 10.00, '2023-07-17 18:54:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(128, '', 16, 21, 1, 16, 1, 11.00, 8.00, '2023-07-17 18:56:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(129, '', 16, 21, 1, 16, 1, 11.00, 7.00, '2023-07-17 18:56:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(130, '', 16, 21, 1, 16, 1, 11.00, 6.00, '2023-07-17 18:56:54', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(131, '', 16, 21, 1, 16, 1, 11.00, 10.00, '2023-07-17 20:22:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(132, '', 16, 21, 1, 16, 1, 11.00, 9.00, '2023-07-17 20:22:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(133, '', 16, 21, 1, 16, 1, 11.00, 8.00, '2023-07-17 20:22:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(134, '', 16, 21, 1, 16, 1, 11.00, 7.00, '2023-07-17 20:22:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(135, '', 16, 13, 1, 12, 1, 100.00, 129.00, '2023-07-18 13:54:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(136, '', 16, 22, 1, 16, 1, 45.00, 44.00, '2023-07-19 03:39:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(137, '', 16, 22, 1, 16, 1, 45.00, 43.00, '2023-07-19 03:39:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(138, '', 1, 25, 1, 16, 1, 18.00, 16.00, '2023-07-24 22:25:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(139, '', 1, 29, 1, 17, 1, 30.00, 29.00, '2023-07-24 22:27:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(140, '', 17, 26, 1, 16, 1, 55.00, 53.00, '2023-07-24 23:16:58', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(141, '', 4, 26, 1, 16, 1, 55.00, 52.00, '2023-07-24 23:17:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(142, '', 17, 26, 1, 16, 1, 55.00, 52.00, '2023-07-24 23:18:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(143, '', 4, 26, 1, 16, 1, 55.00, 51.00, '2023-07-24 23:18:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(144, '', 17, 26, 1, 16, 1, 55.00, 51.00, '2023-07-24 23:19:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(145, '', 4, 26, 1, 16, 1, 55.00, 50.00, '2023-07-24 23:19:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(146, '', 17, 26, 1, 16, 1, 55.00, 50.00, '2023-07-24 23:21:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(147, '', 17, 24, 1, 16, 1, 55.00, 54.00, '2023-07-24 23:30:06', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(148, '', 4, 24, 1, 16, 1, 55.00, 53.00, '2023-07-24 23:30:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(149, '', 4, 24, 1, 16, 1, 55.00, 52.00, '2023-07-24 23:30:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(150, '', 17, 24, 1, 16, 1, 55.00, 53.00, '2023-07-24 23:31:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(151, '', 17, 24, 1, 16, 1, 55.00, 52.00, '2023-07-24 23:31:37', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(152, '', 17, 21, 1, 16, 1, 11.00, 10.00, '2023-07-24 23:38:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(153, '', 4, 21, 1, 16, 1, 11.00, 9.00, '2023-07-24 23:39:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(154, '', 4, 21, 1, 16, 1, 11.00, 8.00, '2023-07-24 23:39:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(155, '', 17, 21, 1, 16, 1, 11.00, 9.00, '2023-07-24 23:40:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(156, '', 4, 27, 1, 15, 1, 36.00, 35.00, '2023-07-26 14:49:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(157, '', 4, 26, 1, 16, 1, 55.00, 49.00, '2023-07-26 14:51:25', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(158, '', 4, 25, 1, 16, 1, 18.00, 15.00, '2023-07-26 14:51:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(159, '', 1, 29, 1, 17, 1, 30.00, 28.00, '2023-07-26 23:42:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(160, '', 4, 24, 1, 16, 1, 55.00, 51.00, '2023-07-27 18:58:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(161, '', 4, 21, 1, 16, 1, 11.00, 10.00, '2023-07-27 18:59:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(162, '', 4, 26, 1, 16, 1, 55.00, 48.00, '2023-07-28 01:43:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(163, '', 4, 29, 1, 17, 1, 30.00, 27.00, '2023-07-29 03:17:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(164, '', 4, 28, 1, 15, 1, 12.00, 11.00, '2023-07-29 03:38:06', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(165, '', 4, 29, 1, 17, 1, 30.00, 26.00, '2023-08-01 15:09:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(166, '', 4, 20, 1, 16, 1, 150.00, 146.00, '2023-08-01 22:29:48', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(167, '', 4, 26, 1, 16, 1, 55.00, 47.00, '2023-08-03 17:19:44', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(168, '', 4, 28, 1, 15, 1, 12.00, 10.00, '2023-08-04 02:13:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(169, '', 4, 24, 1, 16, 1, 55.00, 50.00, '2023-08-04 02:14:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(170, '', 1, 29, 0, 17, 1, 30.00, 25.00, '2023-08-04 20:16:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(171, '', 4, 26, 0, 16, 1, 55.00, 46.00, '2023-08-04 22:33:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(172, '', 5, 25, 0, 16, 1, 18.00, 14.00, '2023-08-04 22:43:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(173, '', 5, 24, 0, 16, 1, 55.00, 49.00, '2023-08-04 22:44:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(174, '', 5, 29, 0, 17, 1, 30.00, 24.00, '2023-08-04 22:53:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(175, '', 5, 29, 0, 17, 1, 30.00, 23.00, '2023-08-04 23:22:35', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(176, '', 5, 29, 0, 17, 1, 30.00, 22.00, '2023-08-04 23:22:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(177, '', 5, 29, 0, 17, 1, 30.00, 21.00, '2023-08-04 23:24:55', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(178, '', 5, 29, 0, 17, 1, 30.00, 20.00, '2023-08-04 23:25:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(179, '', 5, 25, 0, 16, 1, 18.00, 13.00, '2023-08-04 23:28:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(180, '', 5, 23, 0, 16, 1, 65.00, 64.00, '2023-08-04 23:32:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(181, '', 5, 23, 0, 16, 1, 65.00, 63.00, '2023-08-04 23:35:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(182, '', 5, 23, 0, 16, 1, 65.00, 62.00, '2023-08-04 23:36:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(183, '', 17, 29, 0, 17, 1, 30.00, 19.00, '2023-08-05 02:34:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(184, '', 5, 29, 0, 17, 1, 30.00, 18.00, '2023-08-05 02:35:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(185, '', 17, 29, 0, 17, 1, 30.00, 17.00, '2023-08-05 02:51:55', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(186, '', 17, 29, 0, 17, 1, 30.00, 16.00, '2023-08-05 02:54:55', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(187, '', 17, 27, 0, 15, 1, 36.00, 34.00, '2023-08-05 02:56:25', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(188, '', 5, 27, 0, 15, 1, 36.00, 33.00, '2023-08-05 02:57:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(189, '', 5, 28, 0, 15, 1, 12.00, 9.00, '2023-08-06 03:49:55', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(190, '', 5, 30, 1, 5, 1, 70.00, 69.00, '2023-08-06 03:55:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(191, '', 5, 30, 1, 5, 1, 70.00, 68.00, '2023-08-06 03:57:09', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(192, '', 5, 30, 1, 5, 1, 70.00, 67.00, '2023-08-06 03:57:21', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(193, '', 5, 30, 1, 5, 1, 70.00, 66.00, '2023-08-06 21:05:50', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(194, '', 5, 30, 1, 5, 1, 70.00, 65.00, '2023-08-06 21:06:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(195, '', 19, 31, 1, 5, 1, 8.00, 7.00, '2023-08-08 16:34:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(196, '', 19, 31, 1, 5, 1, 8.00, 6.00, '2023-08-08 16:34:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(197, '', 19, 31, 1, 5, 1, 8.00, 5.00, '2023-08-08 16:36:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(198, '', 19, 32, 1, 19, 1, 12.00, 11.00, '2023-08-08 16:39:58', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(199, '', 19, 32, 1, 19, 1, 12.00, 10.00, '2023-08-08 21:54:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(200, '', 19, 32, 1, 19, 1, 12.00, 9.00, '2023-08-08 21:55:57', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(201, '', 19, 32, 1, 19, 1, 12.00, 8.00, '2023-08-08 21:56:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(202, '', 1, 32, 1, 19, 1, 12.00, 7.00, '2023-08-10 01:26:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(203, '', 19, 31, 1, 5, 1, 8.00, 4.00, '2023-08-10 13:53:43', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(204, '', 19, 32, 1, 19, 1, 12.00, 6.00, '2023-08-12 00:11:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(205, '', 19, 32, 1, 19, 1, 12.00, 5.00, '2023-08-13 18:20:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(206, '', 19, 31, 1, 5, 1, 8.00, 3.00, '2023-08-16 05:03:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(207, '', 19, 31, 1, 5, 1, 8.00, 2.00, '2023-08-16 05:03:45', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(208, '', 1, 22, 0, 16, 1, 45.00, 42.00, '2023-08-17 04:11:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(209, '', 1, 31, 1, 5, 1, 8.00, 1.00, '2023-08-18 11:19:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(210, '', 19, 31, 1, 5, 1, 8.00, 0.00, '2023-08-19 02:38:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(211, '', 19, 31, 1, 5, 1, 8.00, -1.00, '2023-08-19 11:55:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(212, '', 19, 31, 1, 5, 1, 8.00, -2.00, '2023-08-19 11:56:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(213, '', 19, 31, 1, 5, 1, 8.00, -3.00, '2023-08-19 11:56:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(214, '', 1, 32, 1, 19, 1, 12.00, 4.00, '2023-08-22 01:01:10', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(215, '', 1, 32, 1, 19, 1, 12.00, 3.00, '2023-08-22 01:02:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(216, '', 1, 32, 1, 19, 1, 12.00, 2.00, '2023-08-22 01:02:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(217, '', 1, 32, 1, 19, 1, 12.00, 1.00, '2023-08-22 01:02:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(218, '', 1, 32, 1, 19, 1, 12.00, 1.00, '2023-08-22 01:03:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(219, '', 1, 32, 1, 19, 1, 12.00, 1.00, '2023-08-22 01:03:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(220, '', 1, 31, 1, 5, 1, 8.00, 1.00, '2023-08-22 01:04:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(221, '', 19, 30, 1, 5, 1, 70.00, 64.00, '2023-08-22 01:06:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(222, '', 19, 30, 1, 5, 1, 70.00, 63.00, '2023-08-22 01:07:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(223, '', 19, 30, 1, 5, 1, 70.00, 62.00, '2023-08-22 01:07:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(224, '', 19, 32, 1, 19, 1, 12.00, 1.00, '2023-08-24 23:36:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(225, '', 19, 30, 1, 5, 1, 70.00, 61.00, '2023-09-06 14:12:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(226, '', 1, 33, 1, 2, 1, 450.00, 449.00, '2023-09-18 16:57:28', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(227, '', 1, 33, 1, 2, 1, 450.00, 448.00, '2023-09-18 16:58:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(228, '', 1, 33, 1, 2, 1, 450.00, 447.00, '2023-09-18 16:59:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(229, '', 1, 33, 1, 2, 1, 450.00, 446.00, '2023-09-18 17:00:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(230, '', 2, 33, 1, 2, 1, 450.00, 445.00, '2023-09-18 20:14:54', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(231, '', 1, 35, 1, 1, 1, 250.00, 249.00, '2023-09-18 21:51:45', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(232, '', 1, 35, 1, 1, 1, 250.00, 248.00, '2023-09-18 21:52:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(233, '', 1, 35, 1, 1, 1, 250.00, 247.00, '2023-09-18 21:52:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(234, '', 1, 35, 1, 1, 1, 250.00, 246.00, '2023-09-18 21:52:57', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(235, '', 19, 35, 1, 1, 1, 250.00, 245.00, '2023-09-19 02:26:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(236, '', 1, 33, 1, 2, 1, 450.00, 444.00, '2023-09-19 05:50:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(237, '', 19, 34, 1, 1, 1, 400.00, 399.00, '2023-09-19 16:10:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(238, '', 1, 33, 1, 2, 1, 450.00, 443.00, '2023-09-20 02:51:35', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(239, '', 1, 33, 1, 2, 1, 450.00, 442.00, '2023-09-20 02:52:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(240, '', 1, 33, 1, 2, 1, 450.00, 441.00, '2023-09-20 02:52:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(241, '', 1, 33, 1, 2, 1, 450.00, 440.00, '2023-09-20 02:54:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(242, '', 1, 33, 1, 2, 1, 450.00, 439.00, '2023-09-20 02:54:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(243, '', 1, 33, 1, 2, 1, 450.00, 438.00, '2023-09-20 02:54:30', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(244, '', 1, 35, 1, 1, 1, 250.00, 244.00, '2023-09-22 00:58:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(245, '', 2, 35, 1, 1, 1, 250.00, 243.00, '2023-09-22 01:01:27', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(246, '', 2, 35, 1, 1, 1, 250.00, 242.00, '2023-09-22 01:01:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(247, '', 19, 34, 1, 1, 1, 400.00, 398.00, '2023-09-22 22:30:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(248, '', 1, 33, 1, 2, 1, 450.00, 437.00, '2023-09-24 19:26:28', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(249, '', 19, 34, 1, 1, 1, 400.00, 397.00, '2023-09-25 15:21:44', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(250, '', 1, 36, 1, 19, 1, 145.00, 144.00, '2023-09-26 22:51:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(251, '', 19, 36, 1, 19, 1, 145.00, 143.00, '2023-09-28 18:52:45', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(252, '', 19, 36, 1, 19, 1, 145.00, 142.00, '2023-10-13 23:06:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(253, '', 19, 36, 1, 19, 1, 145.00, 141.00, '2023-10-13 23:08:35', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(254, '', 19, 36, 1, 19, 1, 145.00, 140.00, '2023-10-13 23:09:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(255, '', 18, 35, 1, 1, 1, 250.00, 241.00, '2023-10-22 03:02:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(256, '', 18, 35, 1, 1, 1, 250.00, 240.00, '2023-10-23 17:34:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(257, '', 18, 33, 1, 2, 1, 450.00, 436.00, '2023-10-23 17:37:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(258, '', 18, 35, 1, 1, 1, 250.00, 239.00, '2023-10-30 14:46:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(259, '', 18, 36, 1, 19, 1, 145.00, 139.00, '2023-10-31 01:24:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(260, '', 18, 34, 1, 1, 1, 400.00, 396.00, '2023-11-07 02:51:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(261, '', 15, 35, 1, 1, 1, 250.00, 238.00, '2023-11-27 03:58:28', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(262, '', 15, 35, 1, 1, 1, 250.00, 237.00, '2023-11-27 03:59:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(263, '', 15, 35, 1, 1, 1, 250.00, 236.00, '2023-11-29 00:56:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(264, '', 15, 35, 1, 1, 1, 250.00, 235.00, '2023-11-29 04:41:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(265, '', 15, 35, 1, 1, 1, 250.00, 234.00, '2023-11-29 17:23:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(266, '', 15, 35, 1, 1, 1, 250.00, 233.00, '2023-11-29 17:23:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(267, '', 15, 34, 1, 1, 1, 400.00, 395.00, '2023-12-03 00:00:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(268, '', 15, 34, 1, 1, 1, 400.00, 394.00, '2023-12-03 00:00:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(269, '', 15, 35, 1, 1, 1, 250.00, 232.00, '2023-12-06 00:53:09', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(270, '', 15, 35, 1, 1, 1, 250.00, 231.00, '2023-12-06 00:54:19', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(271, '', 29, 37, 1, 29, 1, 100.00, 99.00, '2024-07-15 00:02:59', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(272, '', 29, 37, 1, 29, 1, 100.00, 98.00, '2024-07-15 00:03:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(273, '', 29, 37, 1, 29, 1, 100.00, 97.00, '2024-07-16 04:09:31', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(274, '', 29, 37, 1, 29, 1, 100.00, 96.00, '2024-07-16 04:10:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(275, '', 29, 38, 1, 29, 1, 550.00, 549.00, '2024-07-17 00:06:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(276, '', 29, 38, 1, 29, 1, 550.00, 548.00, '2024-07-17 00:11:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(277, '', 29, 40, 1, 29, 1, 550.00, 549.00, '2024-07-17 17:53:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(278, '', 29, 40, 1, 29, 1, 550.00, 548.00, '2024-07-17 17:54:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(279, '', 29, 39, 1, 29, 1, 100.00, 99.00, '2024-07-21 00:42:19', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(280, '', 29, 39, 1, 29, 1, 100.00, 98.00, '2024-07-21 00:42:26', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(281, '', 29, 39, 1, 29, 1, 100.00, 97.00, '2024-07-21 00:42:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(282, '', 29, 39, 1, 29, 1, 100.00, 96.00, '2024-07-21 13:19:54', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(283, '', 29, 39, 1, 29, 1, 100.00, 95.00, '2024-07-29 04:13:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(284, '', 29, 39, 1, 29, 1, 100.00, 94.00, '2024-07-29 04:13:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(285, '', 29, 40, 1, 29, 1, 550.00, 547.00, '2024-07-30 01:58:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(286, '', 29, 40, 1, 29, 1, 550.00, 546.00, '2024-07-30 01:58:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(287, '', 29, 40, 1, 29, 1, 550.00, 545.00, '2024-07-30 01:58:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(288, '', 29, 39, 1, 29, 1, 100.00, 93.00, '2024-07-30 01:59:57', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(289, '', 29, 39, 1, 29, 1, 100.00, 92.00, '2024-07-30 02:00:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(290, '', 29, 39, 1, 29, 1, 100.00, 91.00, '2024-07-31 03:07:48', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(291, '', 29, 39, 1, 29, 1, 100.00, 90.00, '2024-07-31 03:08:10', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(292, '', 29, 39, 1, 29, 1, 100.00, 89.00, '2024-08-03 22:10:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(293, '', 29, 40, 1, 29, 1, 550.00, 544.00, '2024-08-04 03:32:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(294, '', 29, 40, 1, 29, 1, 550.00, 543.00, '2024-08-04 03:32:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(295, '', 29, 39, 1, 29, 1, 100.00, 88.00, '2024-08-04 22:37:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(296, '', 29, 39, 1, 29, 1, 100.00, 87.00, '2024-08-04 22:54:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(297, '', 29, 39, 1, 29, 1, 100.00, 86.00, '2024-08-06 00:31:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(298, '', 29, 39, 1, 29, 1, 100.00, 85.00, '2024-08-12 02:01:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(299, '', 29, 39, 1, 29, 1, 100.00, 84.00, '2024-08-12 20:31:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(300, '', 29, 39, 1, 29, 1, 100.00, 83.00, '2024-08-12 20:32:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(301, '', 29, 39, 1, 29, 1, 100.00, 82.00, '2024-08-14 23:40:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(302, '', 33, 41, 1, 33, 1, 280.00, 279.00, '2024-08-18 02:01:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(303, '', 33, 41, 1, 33, 1, 280.00, 278.00, '2024-08-18 02:04:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(304, '', 33, 41, 1, 33, 1, 280.00, 277.00, '2024-08-18 02:05:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(305, '', 33, 40, 1, 29, 1, 550.00, 542.00, '2024-08-18 02:06:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(306, '', 33, 40, 1, 29, 1, 550.00, 541.00, '2024-08-20 23:32:55', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(307, '', 33, 41, 1, 33, 1, 280.00, 276.00, '2024-08-20 23:33:31', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(308, '', 33, 39, 1, 29, 1, 100.00, 81.00, '2024-08-20 23:34:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(309, '', 33, 40, 1, 29, 1, 550.00, 540.00, '2024-08-22 00:55:50', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(310, '', 33, 40, 1, 29, 1, 550.00, 539.00, '2024-08-23 00:27:21', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(311, '', 33, 40, 1, 29, 1, 550.00, 538.00, '2024-08-26 05:07:26', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(312, '', 33, 41, 1, 33, 1, 280.00, 275.00, '2024-08-26 05:08:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(313, '', 33, 39, 1, 29, 1, 100.00, 80.00, '2024-08-26 05:08:57', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(314, '', 33, 42, 1, 33, 3, 3500.00, 3497.00, '2024-08-26 17:26:58', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(315, '', 33, 42, 1, 33, 3, 3500.00, 3494.00, '2024-08-28 21:51:59', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(316, '', 33, 39, 1, 29, 1, 100.00, 79.00, '2024-08-29 01:57:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(317, '', 33, 42, 1, 33, 3, 3500.00, 3491.00, '2024-08-29 22:51:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(318, '', 1, 41, 1, 33, 1, 280.00, 274.00, '2024-08-29 22:58:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(319, '', 1, 42, 1, 33, 3, 3500.00, 3488.00, '2024-08-29 23:01:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(320, '', 33, 42, 1, 33, 3, 3500.00, 3485.00, '2024-08-31 23:08:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(321, '', 33, 42, 1, 33, 3, 3500.00, 3482.00, '2024-08-31 23:08:26', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(322, '', 33, 41, 1, 33, 1, 280.00, 273.00, '2024-09-01 01:28:54', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(323, '', 33, 42, 1, 33, 3, 3500.00, 3479.00, '2024-09-01 16:58:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(324, '', 33, 42, 1, 33, 3, 3500.00, 3476.00, '2024-09-05 03:43:19', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(325, '', 33, 42, 1, 33, 3, 3500.00, 3473.00, '2024-09-06 01:22:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(326, '', 33, 42, 1, 33, 3, 3500.00, 3470.00, '2024-09-06 01:22:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(327, '', 33, 42, 1, 33, 3, 3500.00, 3467.00, '2024-09-06 15:37:50', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(328, '', 33, 41, 1, 33, 1, 280.00, 272.00, '2024-09-07 02:55:50', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(329, '', 33, 42, 1, 33, 3, 3500.00, 3464.00, '2024-09-09 17:20:27', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(330, '', 33, 42, 1, 33, 3, 3500.00, 3461.00, '2024-09-09 17:23:55', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(331, '', 33, 42, 1, 33, 3, 3500.00, 3458.00, '2024-09-13 18:03:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(332, '', 33, 42, 1, 33, 3, 3500.00, 3455.00, '2024-09-13 18:04:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(333, '', 33, 42, 1, 33, 3, 3500.00, 3452.00, '2024-09-13 18:06:19', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(334, '', 1, 42, 1, 33, 3, 3500.00, 3449.00, '2024-09-24 03:26:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(335, '', 1, 43, 1, 33, 1, 500.00, 499.00, '2024-09-29 02:59:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(336, '', 1, 43, 1, 33, 1, 500.00, 498.00, '2024-09-29 02:59:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(337, '', 1, 42, 1, 33, 3, 3500.00, 3446.00, '2024-09-29 16:52:30', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(338, '', 1, 42, 1, 33, 3, 3500.00, 3443.00, '2024-10-02 03:39:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(339, '', 1, 43, 1, 33, 1, 500.00, 497.00, '2024-10-02 14:42:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(340, '', 1, 42, 1, 33, 3, 3500.00, 3440.00, '2024-10-02 14:42:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(341, '', 1, 42, 1, 33, 3, 3500.00, 3437.00, '2024-10-03 15:24:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(342, '', 1, 42, 1, 33, 3, 3500.00, 3434.00, '2024-10-03 15:25:09', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(343, '', 1, 42, 1, 33, 3, 3500.00, 3431.00, '2024-10-03 15:26:58', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(344, '', 1, 42, 1, 33, 3, 3500.00, 3428.00, '2024-10-04 15:17:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(345, '', 1, 43, 1, 33, 1, 500.00, 496.00, '2024-10-06 03:17:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(346, '', 1, 43, 1, 33, 1, 500.00, 495.00, '2024-10-06 03:17:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(347, '', 1, 42, 1, 33, 3, 3500.00, 3425.00, '2024-10-15 02:17:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(348, '', 1, 42, 1, 33, 3, 3500.00, 3422.00, '2024-10-15 02:18:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(349, '', 1, 42, 1, 33, 3, 3500.00, 3419.00, '2024-10-15 02:24:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(350, '', 1, 42, 1, 33, 3, 3500.00, 3416.00, '2024-10-15 02:24:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(351, '', 1, 42, 1, 33, 3, 3500.00, 3413.00, '2024-10-15 02:25:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(352, '', 1, 43, 1, 33, 1, 500.00, 494.00, '2024-10-15 02:25:45', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(353, '', 1, 42, 1, 33, 3, 3500.00, 3410.00, '2024-10-16 23:16:45', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(354, '', 1, 42, 1, 33, 3, 3500.00, 3407.00, '2024-10-16 23:17:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(355, '', 1, 42, 1, 33, 3, 3500.00, 3404.00, '2024-10-16 23:17:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(356, '', 1, 42, 1, 33, 3, 3500.00, 3401.00, '2024-10-18 20:45:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(357, '', 1, 42, 1, 33, 3, 3500.00, 3398.00, '2024-10-18 20:46:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(358, '', 1, 43, 1, 33, 1, 500.00, 493.00, '2024-10-19 21:20:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(359, '', 1, 41, 1, 33, 1, 280.00, 271.00, '2024-10-19 22:49:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(360, '', 37, 43, 1, 33, 1, 500.00, 492.00, '2024-10-23 23:45:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(361, '', 37, 42, 1, 33, 3, 3500.00, 3395.00, '2024-10-26 00:37:26', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(362, '', 37, 41, 1, 33, 1, 280.00, 270.00, '2024-10-28 03:09:35', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(363, '', 37, 41, 1, 33, 1, 280.00, 269.00, '2024-10-28 03:09:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(364, '', 37, 41, 1, 33, 1, 280.00, 268.00, '2024-10-31 02:46:10', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(365, '', 37, 42, 1, 33, 3, 3500.00, 3392.00, '2024-10-31 21:44:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(366, '', 37, 42, 1, 33, 3, 3500.00, 3389.00, '2024-10-31 21:45:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(367, '', 37, 41, 1, 33, 1, 280.00, 267.00, '2024-11-01 04:29:32', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(368, '', 37, 41, 1, 33, 1, 280.00, 266.00, '2024-11-01 04:29:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(369, '', 37, 42, 1, 33, 3, 3500.00, 3386.00, '2024-11-01 23:24:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(370, '', 37, 43, 1, 33, 1, 500.00, 491.00, '2024-11-02 15:58:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(371, '', 37, 43, 1, 33, 1, 500.00, 490.00, '2024-11-02 15:58:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(372, '', 37, 41, 1, 33, 1, 280.00, 265.00, '2024-11-04 11:27:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(373, '', 37, 41, 1, 33, 1, 280.00, 264.00, '2024-11-05 00:02:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(374, '', 37, 41, 1, 33, 1, 280.00, 263.00, '2024-11-05 00:02:31', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(375, '', 37, 41, 1, 33, 1, 280.00, 262.00, '2024-11-05 00:02:54', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(376, '', 37, 43, 1, 33, 1, 500.00, 489.00, '2024-11-05 16:28:57', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(377, '', 37, 42, 1, 33, 3, 3500.00, 3383.00, '2024-11-06 04:20:44', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(378, '', 37, 42, 1, 33, 3, 3500.00, 3380.00, '2024-11-08 01:53:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(379, '', 37, 42, 1, 33, 3, 3500.00, 3377.00, '2024-11-08 01:53:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(380, '', 37, 42, 1, 33, 3, 3500.00, 3374.00, '2024-11-08 01:54:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(381, '', 37, 44, 1, 37, 1, 300.00, 299.00, '2024-11-08 05:06:31', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(382, '', 37, 44, 1, 37, 1, 300.00, 298.00, '2024-11-10 19:58:11', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(383, '', 37, 41, 1, 33, 1, 280.00, 261.00, '2024-11-11 04:03:25', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(384, '', 37, 44, 1, 37, 1, 300.00, 297.00, '2024-11-12 03:41:21', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(385, '', 37, 44, 1, 37, 1, 300.00, 296.00, '2024-11-13 16:19:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(386, '', 37, 41, 1, 33, 1, 280.00, 260.00, '2024-11-13 16:19:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(387, '', 1, 42, 1, 33, 3, 3500.00, 3371.00, '2024-11-15 20:54:09', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(388, '', 37, 43, 1, 33, 1, 500.00, 488.00, '2024-11-16 19:55:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(389, '', 37, 44, 1, 37, 1, 300.00, 295.00, '2024-11-17 04:29:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(390, '', 37, 44, 1, 37, 1, 300.00, 294.00, '2024-11-17 04:33:03', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(391, '', 37, 44, 1, 37, 1, 300.00, 293.00, '2024-11-17 04:34:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(392, '', 37, 43, 1, 33, 1, 500.00, 487.00, '2024-11-17 17:37:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(393, '', 37, 43, 1, 33, 1, 500.00, 486.00, '2024-11-17 17:38:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(394, '', 37, 44, 1, 37, 1, 300.00, 292.00, '2024-11-18 17:53:13', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(395, '', 37, 43, 1, 33, 1, 500.00, 485.00, '2024-11-19 02:56:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(396, '', 37, 42, 1, 33, 3, 3500.00, 3368.00, '2024-11-19 02:57:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(397, '12024000130', 2, 35, 1, 1, 1, 250.00, 230.00, '2024-11-19 05:01:30', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(398, '12024000324', 2, 35, 1, 1, 1, 250.00, 229.00, '2024-11-19 05:03:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(399, '12024000622', 2, 35, 1, 1, 1, 250.00, 228.00, '2024-11-19 05:06:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(400, '12024000640', 2, 35, 1, 1, 1, 250.00, 227.00, '2024-11-19 05:06:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(401, '332024113028', 37, 42, 1, 33, 3, 3500.00, 3365.00, '2024-11-19 16:30:28', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(402, '12024164117', 1, 35, 1, 1, 1, 250.00, 226.00, '2024-11-19 21:41:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(403, '12024003147', 1, 35, 1, 1, 1, 250.00, 225.00, '2024-11-20 05:31:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(404, '332024111800', 37, 42, 1, 33, 3, 3500.00, 3362.00, '2024-11-20 16:18:00', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(405, '332024213036', 37, 42, 1, 33, 3, 3500.00, 3359.00, '2024-11-21 02:30:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(406, '12024235453', 37, 35, 1, 1, 1, 250.00, 224.00, '2024-11-21 04:54:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(407, '12024235545', 37, 35, 1, 1, 1, 250.00, 223.00, '2024-11-21 04:55:45', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(408, '332024172440', 41, 42, 1, 33, 3, 3500.00, 3356.00, '2024-11-30 22:24:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(409, '12024172538', 41, 35, 1, 1, 1, 250.00, 222.00, '2024-11-30 22:25:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(410, '372024210046', 41, 44, 1, 37, 1, 300.00, 291.00, '2024-12-02 02:00:46', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(411, '372024232431', 41, 44, 1, 37, 1, 300.00, 290.00, '2024-12-03 04:24:31', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(412, '372024122706', 41, 44, 1, 37, 1, 300.00, 289.00, '2024-12-05 17:27:06', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(413, '412024210017', 41, 45, 1, 41, 1, 550.00, 549.00, '2024-12-07 02:00:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(414, '372024001700', 41, 44, 1, 37, 1, 300.00, 288.00, '2024-12-07 05:17:00', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(415, '12024031822', 1, 35, 1, 1, 1, 250.00, 0.00, '2024-12-08 08:18:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(416, '12024144242', 1, 35, 1, 1, 1, 250.00, 249.00, '2024-12-08 19:42:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(417, '412024164653', 41, 45, 1, 41, 1, 550.00, 548.00, '2024-12-09 21:46:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(418, '12024180748', 2, 35, 1, 1, 1, 250.00, 248.00, '2024-12-09 23:07:48', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(419, '12024180801', 2, 35, 1, 1, 1, 250.00, 247.00, '2024-12-09 23:08:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52');
INSERT INTO `pointstransaction` (`transactionid`, `orderid`, `userid`, `pid`, `qtyBatchNo`, `sellerid`, `points`, `mrp`, `reducedPrice`, `postedon`, `source`, `created_at`, `updated_at`) VALUES
(420, '12024184934', 2, 35, 1, 1, 1, 250.00, 246.00, '2024-12-09 23:49:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(421, '12024221841', 2, 35, 1, 1, 1, 250.00, 245.00, '2024-12-10 03:18:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(422, '372025185905', 45, 44, 1, 37, 1, 300.00, 287.00, '2025-01-06 23:59:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(423, '412025190822', 45, 45, 1, 41, 1, 550.00, 547.00, '2025-01-07 00:08:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(424, '452025235805', 45, 46, 1, 45, 1, 350.00, 349.00, '2025-01-11 04:58:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(425, '452025235834', 45, 46, 1, 45, 1, 350.00, 348.00, '2025-01-11 04:58:34', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(426, '452025235901', 45, 46, 1, 45, 1, 350.00, 347.00, '2025-01-11 04:59:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(427, '452025144226', 45, 46, 1, 45, 1, 350.00, 346.00, '2025-01-13 19:42:26', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(428, '452025003844', 45, 46, 1, 45, 1, 350.00, 345.00, '2025-01-20 05:38:44', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(429, '452025060028', 45, 46, 1, 45, 1, 350.00, 344.00, '2025-01-26 11:00:28', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(430, '452025105438', 1, 46, 1, 45, 1, 350.00, 343.00, '2025-02-04 15:54:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(431, '12025003900', 41, 35, 1, 1, 1, 250.00, 244.00, '2025-03-11 07:39:00', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(432, '12025231036', 41, 35, 1, 1, 1, 250.00, 243.00, '2025-03-31 06:10:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(433, '12025231729', 41, 35, 1, 1, 1, 250.00, 242.00, '2025-03-31 06:17:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(434, '452025184129', 45, 46, 1, 45, 1, 350.00, 342.00, '2025-04-08 01:41:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(435, '452025173118', 45, 47, 1, 45, 1, 2.00, 0.00, '2025-05-24 12:01:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(436, '452025174911', 45, 48, 1, 45, 1, 5.00, 0.00, '2025-05-24 12:19:11', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(437, '452025175127', 45, 52, 1, 45, 1, 7.00, 0.00, '2025-05-24 12:21:27', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(438, '452025175439', 45, 51, 1, 45, 1, 8.00, 0.00, '2025-05-24 12:24:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(439, '452025175641', 45, 50, 1, 45, 1, 7.00, 0.00, '2025-05-24 12:26:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(440, '452025182218', 45, 49, 1, 45, 1, 6.00, 0.00, '2025-05-24 12:52:18', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(441, '452025182621', 45, 53, 1, 45, 1, 5.00, 0.00, '2025-05-24 12:56:21', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(442, '452025171140', 45, 55, 1, 45, 1, 7.00, 0.00, '2025-05-28 11:41:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(443, '452025171406', 45, 56, 1, 45, 2, 1000.00, 998.00, '2025-05-28 11:44:06', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(444, '452025171559', 45, 56, 1, 45, 2, 1000.00, 996.00, '2025-05-28 11:45:59', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(445, '452025171610', 45, 54, 1, 45, 1, 7.00, 0.00, '2025-05-28 11:46:10', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(446, '452025173743', 45, 57, 1, 45, 1, 7.00, 0.00, '2025-05-29 12:07:43', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(447, '452025164019', 45, 58, 1, 45, 1, 7.00, 0.00, '2025-05-30 11:10:19', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(448, '452025164236', 45, 58, 1, 45, 1, 7.00, 0.00, '2025-05-30 11:12:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(449, '452025164722', 45, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 11:17:22', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(450, '452025164911', 45, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 11:19:11', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(451, '452025165121', 45, 58, 1, 45, 1, 7.00, 0.00, '2025-05-30 11:21:21', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(452, '452025165401', 45, 60, 1, 45, 1, 45.00, 0.00, '2025-05-30 11:24:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(453, '452025172553', 47, 60, 1, 45, 1, 45.00, 0.00, '2025-05-30 11:55:53', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(454, '452025173436', 47, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 12:04:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(455, '452025173614', 47, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 12:06:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(456, '452025175111', 47, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 12:21:11', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(457, '452025175428', 47, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 12:24:28', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(458, '452025175614', 45, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 12:26:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(459, '452025180415', 45, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 12:34:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(460, '452025180533', 47, 59, 1, 45, 1, 16.00, 0.00, '2025-05-30 12:35:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(461, '472025180833', 47, 61, 1, 47, 1, 64.00, 63.00, '2025-05-30 12:38:33', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(462, '472025180901', 47, 61, 1, 47, 1, 64.00, 0.00, '2025-05-30 12:39:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(463, '452025112136', 45, 63, 1, 45, 1, 4.00, 3.00, '2025-08-05 05:51:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(464, '452025112242', 45, 63, 1, 45, 1, 4.00, 2.00, '2025-08-05 05:52:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(465, '452025113305', 45, 63, 1, 45, 1, 4.00, 0.00, '2025-08-05 06:03:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(466, '452025120851', 45, 63, 1, 45, 1, 4.00, 0.00, '2025-08-05 06:38:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(467, '452025121307', 45, 63, 1, 45, 1, 4.00, 0.00, '2025-08-05 06:43:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(468, '452025121351', 45, 63, 1, 45, 1, 4.00, 0.00, '2025-08-05 06:43:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(469, '452025111956', 45, 64, 1, 45, 1, 4.00, 3.00, '2025-08-06 05:49:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(470, '452025190317', 45, 63, 1, 45, 1, 4.00, 0.00, '2025-08-06 13:33:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(471, '452025090248', 45, 63, 1, 45, 1, 4.00, 0.00, '2025-08-11 03:32:48', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(472, '452025090445', 45, 65, 1, 45, 1, 5.00, 4.00, '2025-08-11 03:34:45', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(473, '452025090551', 45, 65, 1, 45, 1, 5.00, 0.00, '2025-08-11 03:35:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(474, '452025090635', 45, 65, 1, 45, 1, 5.00, 0.00, '2025-08-11 03:36:35', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(475, '452025091109', 45, 65, 1, 45, 1, 5.00, 0.00, '2025-08-11 03:41:09', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(476, '452025092049', 45, 65, 1, 45, 1, 5.00, 0.00, '2025-08-11 03:50:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(477, '452025111751', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 05:47:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(478, '452025112615', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 05:56:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(479, '452025114115', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 06:11:15', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(480, '452025115943', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 06:29:43', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(481, '452025120039', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 06:30:39', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(482, '452025120210', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 06:32:10', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(483, '452025120324', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 06:33:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(484, '452025121038', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 06:40:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(485, '452025121323', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 06:43:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(486, '452025122649', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 06:56:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(487, '452025122916', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 06:59:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(488, '452025123329', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 07:03:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(489, '452025124549', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 07:15:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(490, '452025125056', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 07:20:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(491, '452025125216', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 07:22:16', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(492, '452025125247', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 07:22:47', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(493, '452025125404', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 07:24:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(494, '452025162731', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 10:57:31', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(495, '452025162935', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 10:59:35', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(496, '452025163440', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 11:04:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(497, '452025163949', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 11:09:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(498, '452025164156', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 11:11:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(499, '452025171623', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-08-11 11:46:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(500, '452025171709', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 11:47:09', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(501, '452025171828', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 11:48:28', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(502, '452025172223', 45, 65, 1, 45, 1, 4.00, 3.00, '2025-08-11 11:52:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(503, '452025172330', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 11:53:30', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(504, '452025172924', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 11:59:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(505, '452025173210', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 12:02:10', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(506, '452025173812', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 12:08:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(507, '452025174251', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 12:12:51', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(508, '452025175302', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 12:23:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(509, '452025181549', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 12:45:49', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(510, '452025181744', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 12:47:44', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(511, '452025182507', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 12:55:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(512, '452025183657', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 13:06:57', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(513, '452025184520', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 13:15:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(514, '452025185644', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 13:26:44', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(515, '452025190228', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 13:32:28', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(516, '452025190524', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 13:35:24', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(517, '452025190617', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-11 13:36:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(518, '452025101405', 45, 65, 1, 45, 1, 4.00, 0.00, '2025-08-12 04:44:05', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(519, '452025101523', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-08-12 04:45:23', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(520, '452025101601', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-08-12 04:46:01', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(521, '452025104056', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-08-12 05:10:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(522, '452025214838', 45, 66, 1, 45, 1, 5.00, 2.00, '2025-09-21 16:18:38', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(523, '452025214921', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 16:19:21', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(524, '452025215429', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 16:24:29', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(525, '452025215440', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 16:24:40', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(526, '452025215452', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 16:24:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(527, '452025215937', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 16:29:37', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(528, '452025220107', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 16:31:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(529, '452025220212', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 16:32:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(530, '452025220336', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 16:33:36', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(531, '452025220402', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 16:34:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(532, '452025220507', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 16:35:07', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(533, '452025221252', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 16:42:52', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(534, '452025221321', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 16:43:21', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(535, '452025221331', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 16:43:31', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(536, '452025222504', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 16:55:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(537, '452025222625', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 16:56:25', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(538, '452025222656', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 16:56:56', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(539, '452025222804', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 16:58:04', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(540, '452025223008', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 17:00:08', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(541, '452025223020', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 17:00:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(542, '452025223042', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 17:00:42', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(543, '452025223202', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 17:02:02', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(544, '452025223250', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 17:02:50', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(545, '452025223258', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 17:02:58', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(546, '452025223814', 45, 65, 1, 45, 1, 4.00, 4.00, '2025-09-21 17:08:14', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(547, '452025224617', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 17:16:17', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(548, '452025224803', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 17:18:03', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(549, '452025224820', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 17:18:20', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(550, '452025224844', 45, 66, 1, 45, 1, 5.00, 4.00, '2025-09-21 17:18:44', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(551, '452025224941', 45, 66, 1, 45, 1, 5.00, 3.00, '2025-09-21 17:19:41', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(552, '452025225812', 45, 66, 1, 45, 1, 5.00, 0.00, '2025-09-21 17:28:12', 'gold', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(568, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-06 05:37:39', 'ad', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(567, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-05 12:58:22', 'ad', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(566, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-05 11:03:47', 'ad', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(565, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-03-25 05:45:41', 'ad', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(564, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-03-24 18:56:31', 'ad', '2026-04-14 17:15:52', '2026-04-14 17:15:52'),
(569, '0', 1, 72, 1, 1, -1, 787.00, 708.00, '2026-04-14 17:27:54', 'ad', '2026-04-14 11:57:54', '2026-04-14 11:57:54'),
(570, '0', 1, 72, 1, 1, -1, 787.00, 708.00, '2026-04-14 17:27:58', 'ad', '2026-04-14 11:57:58', '2026-04-14 11:57:58'),
(571, '0', 1, 72, 1, 1, -1, 787.00, 708.00, '2026-04-14 17:31:44', 'ad', '2026-04-14 12:01:44', '2026-04-14 12:01:44'),
(572, '0', 1, 72, 1, 1, -1, 787.00, 708.00, '2026-04-14 17:33:54', 'ad', '2026-04-14 12:03:54', '2026-04-14 12:03:54'),
(573, '0', 1, 72, 1, 1, -1, 787.00, 708.00, '2026-04-14 17:34:00', 'ad', '2026-04-14 12:04:00', '2026-04-14 12:04:00'),
(574, '0', 1, 72, 1, 1, -1, 787.00, 708.00, '2026-04-14 17:38:03', 'ad', '2026-04-14 12:08:03', '2026-04-14 12:08:03'),
(575, '0', 1, 72, 1, 1, -1, 787.00, 708.00, '2026-04-14 17:40:01', 'ad', '2026-04-14 12:10:01', '2026-04-14 12:10:01'),
(576, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-14 17:59:42', 'ad', '2026-04-14 17:59:42', '2026-04-14 17:59:42'),
(577, '0', 1, 72, 1, 1, -1, 787.00, 708.00, '2026-04-14 18:00:24', 'ad', '2026-04-14 12:30:24', '2026-04-14 12:30:24'),
(578, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-14 18:10:25', 'ad', '2026-04-14 18:10:25', '2026-04-14 18:10:25'),
(579, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-14 18:12:46', 'ad', '2026-04-14 18:12:46', '2026-04-14 18:12:46'),
(580, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-14 18:14:02', 'ad', '2026-04-14 18:14:02', '2026-04-14 18:14:02'),
(581, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-20 17:42:25', 'ad', '2026-04-20 17:42:25', '2026-04-20 17:42:25'),
(582, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-20 17:49:52', 'ad', '2026-04-20 17:49:52', '2026-04-20 17:49:52'),
(583, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-20 18:01:59', 'ad', '2026-04-20 18:01:59', '2026-04-20 18:01:59'),
(584, '0', 2, 35, 1, 0, 5, 0.00, 0.00, '2026-04-21 05:40:14', 'ad', '2026-04-21 05:40:14', '2026-04-21 05:40:14'),
(585, '0', 2, 35, 1, 0, 5, 0.00, 0.00, '2026-04-21 05:40:49', 'ad', '2026-04-21 05:40:49', '2026-04-21 05:40:49'),
(586, '0', 2, 35, 1, 0, 5, 0.00, 0.00, '2026-04-21 05:46:17', 'ad', '2026-04-21 05:46:17', '2026-04-21 05:46:17'),
(587, '0', 2, 35, 1, 0, 5, 0.00, 0.00, '2026-04-21 05:48:48', 'ad', '2026-04-21 05:48:48', '2026-04-21 05:48:48'),
(588, '0', 2, 72, 1, 1, -1, 787.00, 696.00, '2026-04-21 06:00:59', 'ad', '2026-04-21 00:30:59', '2026-04-21 00:30:59'),
(589, '0', 1, 78, 1, 2, -1, 1000.00, 197.06, '2026-04-21 07:30:31', 'ad', '2026-04-21 02:00:31', '2026-04-21 02:00:31'),
(590, '0', 1, 78, 1, 2, -1, 1000.00, 197.06, '2026-04-21 07:30:45', 'ad', '2026-04-21 02:00:45', '2026-04-21 02:00:45'),
(591, '0', 1, 78, 1, 2, -1, 1000.00, 197.06, '2026-04-21 07:31:03', 'ad', '2026-04-21 02:01:03', '2026-04-21 02:01:03'),
(592, '0', 1, 78, 1, 2, -1, 1000.00, 197.06, '2026-04-21 07:31:29', 'ad', '2026-04-21 02:01:29', '2026-04-21 02:01:29'),
(593, '0', 1, 72, 1, 1, -1, 787.00, 683.00, '2026-04-21 07:31:49', 'ad', '2026-04-21 02:01:49', '2026-04-21 02:01:49'),
(594, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-04-21 07:32:45', 'ad', '2026-04-21 07:32:45', '2026-04-21 07:32:45'),
(595, '0', 1, 72, 1, 1, -1, 787.00, 683.00, '2026-04-21 07:33:28', 'ad', '2026-04-21 02:03:28', '2026-04-21 02:03:28'),
(596, '0', 1, 72, 1, 1, -1, 787.00, 683.00, '2026-04-21 07:34:34', 'ad', '2026-04-21 02:04:34', '2026-04-21 02:04:34'),
(597, '0', 2, 72, 1, 1, -1, 787.00, 683.00, '2026-04-21 08:01:15', 'ad', '2026-04-21 02:31:15', '2026-04-21 02:31:15'),
(598, '0', 1, 72, 1, 1, -1, 787.00, 682.00, '2026-06-05 12:12:01', 'ad', '2026-06-05 06:42:01', '2026-06-05 06:42:01'),
(599, '0', 1, 35, 1, 0, 5, 0.00, 0.00, '2026-06-05 12:13:23', 'ad', '2026-06-05 12:13:23', '2026-06-05 12:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `subcatid` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `pic1` varchar(50) DEFAULT NULL,
  `pic2` varchar(50) DEFAULT NULL,
  `pic3` varchar(50) DEFAULT NULL,
  `pic4` varchar(50) DEFAULT NULL,
  `ititle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `mrp` float(10,2) NOT NULL,
  `minprice` float(10,2) NOT NULL,
  `reducedPrice` float(10,2) NOT NULL,
  `collectedprice` float(10,2) NOT NULL,
  `returndays` tinyint(4) NOT NULL DEFAULT 0,
  `postedon` timestamp NULL DEFAULT NULL,
  `ip` varchar(45) NOT NULL,
  `updatedon` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `isupdated` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-No, 1-Yes',
  `isactive` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0:deactive, 1:Active',
  `tilldate` datetime DEFAULT NULL,
  `isSold` tinyint(1) NOT NULL DEFAULT 0,
  `istatus` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Disapproved, 1:Approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `zeroprice` decimal(10,2) DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `sellerid`, `catid`, `subcatid`, `qty`, `pic1`, `pic2`, `pic3`, `pic4`, `ititle`, `description`, `currency`, `mrp`, `minprice`, `reducedPrice`, `collectedprice`, `returndays`, `postedon`, `ip`, `updatedon`, `isupdated`, `isactive`, `tilldate`, `isSold`, `istatus`, `created_at`, `updated_at`, `zeroprice`) VALUES
(23, 16, 21, 68, 6, 'IMG-2023-1772250.jpg', '', '', NULL, 'Black Shoes ', 'Super Black Shoes for all occasions. ', 'INR', 65.00, 5.00, 62.00, 3.00, 0, '2023-07-18 02:55:50', '180.148.44.194', '2025-05-28 12:11:20', 0, 1, '2023-08-31 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(20, 16, 1, 8, 5, 'IMG-2023-1771429.jpg', '', '', NULL, 'Ladies Dress', 'Nice Red colour Dress. All sizes available ', 'INR', 150.00, 146.00, 146.00, 7.00, 0, '2023-07-17 18:49:29', '180.148.44.194', '2023-08-01 12:59:48', 0, 1, '2023-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(21, 16, 1, 8, 3, 'IMG-2023-1771418.jpg', '', '', NULL, 'Ladies  Dress', 'Nice Green colour Ladies dress. Many more colours available. ', 'INR', 11.00, 4.00, 10.00, 1.00, 0, '2023-07-17 18:54:18', '180.148.44.194', '2023-07-27 09:29:17', 0, 1, '2023-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(22, 16, 21, 68, 5, 'IMG-2023-1772204.jpg', '', '', NULL, 'White  Shoes', 'Super White Shoes for all occasions. ', 'INR', 45.00, 5.00, 42.00, 3.00, 0, '2023-07-18 02:54:04', '180.148.44.194', '2023-08-16 18:41:36', 0, 1, '2023-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(28, 15, 21, 68, 7, 'IMG-2023-2370001.jpeg', '', '', NULL, 'Indian Corn', 'Tasty Indian  Roasted Corn .', 'INR', 12.00, 4.00, 9.00, 3.00, 0, '2023-07-23 04:02:01', '180.148.44.194', '2023-08-05 18:19:55', 0, 1, '2023-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(29, 17, 21, 68, 10, 'image-2372310.jpg', '', '', NULL, 'Clip Hair', 'Black hair clip for beautiful hair.  Many colour and sizes available.    Durable', 'INR', 30.00, 12.00, 16.00, 14.00, 0, '2023-07-24 03:39:10', '180.148.44.194', '2023-08-04 17:24:55', 0, 1, '2023-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(24, 16, 1, 7, 6, 'IMG-2023-1872333.jpg', '', '', NULL, 'White Ladies  Dress', 'Super Off White  Ladies  Dress . Many sizes available  .', 'INR', 55.00, 8.00, 49.00, 8.00, 0, '2023-07-19 03:58:33', '180.148.44.194', '2023-08-04 13:14:16', 0, 1, '2023-08-26 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(25, 16, 21, 68, 9, 'IMG-2023-2171045.jpg', '', '', NULL, 'Red Rose', 'Beautiful Red Rose for all occasions. ', 'INR', 18.00, 6.00, 13.00, 4.00, 0, '2023-07-21 14:21:45', '180.148.44.194', '2023-08-04 13:58:13', 0, 1, '2023-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(26, 16, 21, 68, 8, 'IMG-2023-2272003.jpg', '', '', NULL, 'Hawain Slipper ', 'Red and White Dots  Hawain  Slippers  for comfort and relax walk. ', 'INR', 55.00, 12.00, 46.00, 11.00, 0, '2023-07-23 00:01:03', '180.148.44.194', '2023-08-04 13:03:16', 0, 1, '2023-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(27, 15, 22, 71, 12, 'IMG-2023-2272306.jpg', '', '', NULL, 'Sweet  Lassi', 'Delicious Sweet Healthy  Lassi .', 'INR', 36.00, 6.00, 33.00, 3.00, 0, '2023-07-23 03:59:06', '180.148.44.194', '2023-08-04 17:27:16', 0, 1, '2023-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(30, 5, 21, 68, 9, 'IMG-2023-0582306.jpg', '', '', NULL, 'Pink Roses', 'Light pink Roses for all seasons . \r\nGift them to loved ones.\r\nDelivery service Extra.', 'INR', 70.00, 0.00, 61.00, 9.00, 0, '2023-08-06 03:54:06', '180.148.44.218', '2023-09-06 04:42:47', 0, 1, '2023-09-30 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(31, 5, 21, 68, 5, 'IMG-2023-0781000.jpg', '', '', NULL, 'White Rose', 'Fresh White Roses for all occasions.   ', 'INR', 8.00, 0.00, 1.00, 12.00, 0, '2023-08-07 14:37:00', '180.148.44.218', '2023-08-21 15:34:56', 0, 1, '2023-09-23 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(32, 19, 15, 43, 12, '16914784-0881214.jpg', '', '', NULL, 'Black Pencil', 'Beautiful black pencil', 'INR', 12.00, 0.00, 1.00, 14.00, 0, '2023-08-08 16:39:14', '180.148.38.237', '2023-08-24 14:06:40', 0, 1, '2023-09-30 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(60, 45, 4, 39, 63, '3005165236883.png', NULL, NULL, NULL, 'Lifebuoy', 'jhnriui2', 'INR', 45.00, -1.00, 0.00, 2.00, 0, '2025-05-30 11:22:36', '::1', '2025-05-30 11:55:53', 0, 1, '2025-07-31 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(61, 47, 21, 68, 3, '3005180820548.png', NULL, NULL, NULL, 'Aesther', 'uediui', 'INR', 64.00, 2.00, 0.00, 2.00, 0, '2025-05-30 12:38:20', '::1', '2025-07-02 06:15:42', 0, 1, '2025-07-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(35, 1, 4, 38, 1, '1811235713513.webp', '', '', NULL, 'Skoda Slavia Led Light', 'Skoda salvia car front led at wholesale rate', 'INR', 250.00, 200.00, 242.00, 8.00, 0, '2023-09-18 21:47:55', '49.32.193.150', '2025-03-30 17:47:29', 0, 1, '2025-03-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(45, 41, 4, 39, 1, '0512182259863.jpg', '1203182912654.jpg', NULL, NULL, 'T.v. Remote ', 'TV Remote  for longer lasting . Very reasonable priced .', 'INR', 550.00, 400.00, 547.00, 3.00, 0, '2024-12-05 23:22:59', '183.87.170.250', '2025-03-15 17:29:34', 0, 1, '2025-03-05 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(36, 19, 21, 68, 1, 'IMG-2023-2591100.jpg', '', '', NULL, 'Rose Bouquet ', 'Beautiful Red Roses. ', 'INR', 145.00, 0.00, 139.00, 6.00, 0, '2023-09-25 15:24:00', '182.237.159.61', '2023-10-30 15:54:36', 0, 1, '2023-10-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(42, 33, 1, 7, 1, '2608132540779.jpg', NULL, NULL, NULL, 'Fancy Pillows ', 'Nice Fancy Pillows for decor  and comfortable living. \r\n\r\nUse for night sleep too .', 'INR', 3500.00, 350.00, 3356.00, 144.00, 0, '2024-08-26 17:25:40', '1.38.145.100', '2024-11-30 11:54:40', 0, 1, '2024-11-30 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(41, 33, 4, 41, 1, '1508231802507.jpg', NULL, NULL, NULL, 'A/c  Remote', 'AC remote . Powerfull remote for easy use', 'INR', 280.00, 50.00, 260.00, 20.00, 0, '2024-08-16 03:18:02', '183.87.170.254', '2024-11-13 05:49:41', 0, 1, '2024-11-22 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(39, 29, 1, 4, 1, '1607204109127.jpg', NULL, NULL, NULL, 'Roses', 'Beautiful  Roses', 'INR', 100.00, 0.00, 79.00, 21.00, 0, '2024-07-17 00:41:09', '183.87.170.241', '2024-08-28 16:27:20', 0, 1, '2024-08-31 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(40, 29, 21, 68, 1, '1607204346971.jpg', NULL, NULL, NULL, 'Flower Bouquet', 'Fresh Bouquet of flowers for all occasions ', 'INR', 550.00, 0.00, 538.00, 12.00, 0, '2024-07-17 00:43:46', '183.87.170.241', '2025-05-28 12:11:33', 0, 1, '2024-09-29 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(43, 33, 15, 43, 1, '1309163828458.jpg', NULL, NULL, NULL, 'Ketchup Ip', 'Yummy tamato\r\nKetchup', 'INR', 500.00, 50.00, 485.00, 15.00, 0, '2024-09-13 20:38:28', '1.38.216.153', '2025-05-29 12:09:53', 0, 1, '2024-11-29 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(44, 37, 21, 68, 0, '0811000542301.jpg', NULL, NULL, NULL, 'Deepak ', 'Indian Traditional  Lamps', 'INR', 300.00, 50.00, 287.00, 13.00, 0, '2024-11-08 05:05:42', '1.38.144.143', '2025-01-06 13:29:09', 0, 0, '2025-01-31 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(59, 45, 3, 19, 0, '3005164623933.png', NULL, NULL, NULL, 'Rjjr', 'rjr jf', 'INR', 16.00, 1.00, 0.00, 0.00, 0, '2025-05-30 11:16:23', '::1', '2025-08-11 06:31:27', 0, 1, '2025-07-31 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(48, 45, 4, 39, 0, '2405174525971.jpg', NULL, NULL, NULL, 'Mango', 'mango', 'INR', 5.00, 1.00, 0.00, 1.00, 0, '2025-05-24 12:15:25', '::1', '2025-05-24 12:19:29', 0, 1, '2025-06-30 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(49, 45, 15, 43, 0, '2405174624670.png', NULL, NULL, NULL, 'Lifebuoy', 'this is the wheel', 'INR', 6.00, 1.00, 0.00, 1.00, 0, '2025-05-24 12:16:24', '::1', '2025-05-24 12:52:20', 0, 1, '2025-06-30 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(50, 45, 15, 42, 0, '2405174705470.png', NULL, NULL, NULL, 'Car', 'this is the car', 'INR', 7.00, 1.00, 0.00, 1.00, 0, '2025-05-24 12:17:05', '::1', '2025-05-24 12:26:46', 0, 1, '2025-06-30 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(51, 45, 15, 42, 0, '2405174808607.png', NULL, NULL, NULL, 'Mango', 'car', 'INR', 8.00, 1.00, 0.00, 1.00, 0, '2025-05-24 12:18:08', '::1', '2025-05-24 12:24:43', 0, 1, '2025-06-30 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(52, 45, 21, 68, 0, '2405174855511.png', NULL, NULL, NULL, 'Usha Fan', 'this is the product', 'INR', 7.00, -1.00, 0.00, 1.00, 0, '2025-05-24 12:18:55', '::1', '2025-05-24 12:21:34', 0, 1, '2025-06-30 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(53, 45, 21, 68, 5, '2405175854838.png', NULL, NULL, NULL, 'Mango', 'this is the product ', 'INR', 5.00, 1.00, 0.00, 1.00, 0, '2025-05-24 12:28:54', '::1', '2025-05-24 12:56:21', 0, 1, '2025-06-25 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(54, 45, 14, 58, 6, '2405180045453.png', NULL, NULL, NULL, 'Tools', 'this is the tool products', 'INR', 7.00, 1.00, 0.00, 1.00, 0, '2025-05-24 12:30:45', '::1', '2025-05-28 11:46:10', 0, 1, '2025-06-30 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(55, 45, 21, 68, 0, '2405180223388.jpg', NULL, NULL, NULL, 'Ear Phone', 'this is the earburd', 'INR', 7.00, 1.00, 0.00, 1.00, 0, '2025-05-24 12:32:23', '::1', '2025-05-28 11:41:50', 0, 1, '2025-06-30 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(56, 45, 15, 42, 70, '2805171354994.png', NULL, NULL, NULL, ' Usha Fan', 'this is usha 3 blaide fan', 'INR', 1000.00, 350.00, 996.00, 4.00, 0, '2025-05-28 11:43:54', '::1', '2025-05-28 11:45:59', 0, 1, '2025-07-16 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(57, 45, 21, 68, 0, '2905165201117.png', NULL, NULL, NULL, 'Ozier', 'it is the camical pastiside', 'INR', 7.00, 1.00, 1.00, 1.00, 0, '2025-05-29 11:22:01', '::1', '2025-05-29 12:37:07', 0, 1, '2025-07-02 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(58, 45, 22, 72, 15, '2905165347112.png', NULL, NULL, NULL, 'Pexter', 'this is the pexter the camical pestiside', 'INR', 7.00, 1.00, 0.00, 3.00, 0, '2025-05-29 11:23:47', '::1', '2025-05-30 11:21:21', 0, 1, '2025-06-30 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(62, 45, 22, 71, 0, '0807193200790.png', NULL, NULL, NULL, 'Pextside', 'this is the pest side', 'INR', 5.00, 3.00, 0.00, 0.00, 0, '2025-07-08 14:02:00', '::1', '2025-07-10 09:59:15', 0, 1, '2025-08-31 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(63, 45, 15, 43, 11, '1007153748155.png', NULL, NULL, NULL, 'Mango', 'this is the product', 'INR', 4.00, 0.00, 0.00, 1.00, 0, '2025-07-10 10:07:48', '::1', '2025-08-11 03:32:48', 0, 1, '2025-08-31 00:00:00', 1, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(64, 45, 4, 41, 3, '0608111839680.jpeg', NULL, NULL, NULL, 'Rose', 'this is just for test', 'INR', 4.00, 0.00, 0.00, 1.00, 0, '2025-08-06 05:48:39', '::1', '2025-08-11 06:47:12', 0, 1, '2025-09-29 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(65, 45, 14, 58, 5, '1108090429734.jpeg', NULL, NULL, NULL, 'Raki', 'gyuwedgyuw', 'INR', 4.00, 2.00, 4.00, 1.00, 0, '2025-08-11 03:34:29', '::1', '2025-09-21 17:08:14', 0, 1, '2025-09-30 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(66, 45, 14, 58, 2, '1108122429417.png', NULL, NULL, NULL, 'Raki1', 'ytyf', 'INR', 5.00, 3.00, 0.00, 3.00, 0, '2025-08-11 06:54:29', '::1', '2025-09-21 17:28:12', 0, 1, '2025-09-30 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(67, 45, 4, 38, 7, NULL, NULL, NULL, NULL, 'E', 'e', 'INR', 3.00, 6.00, 3.00, 0.00, 0, '2025-12-01 04:53:16', '::1', '2025-12-01 04:53:16', 0, 1, '2025-05-30 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(68, 45, 4, 39, 5, '0112102406950.png', NULL, NULL, NULL, 'Fan ', 'ff', 'INR', 4.00, 3.00, 4.00, 0.00, 0, '2025-12-01 04:54:06', '::1', '2025-12-01 04:54:06', 0, 1, '2026-01-27 00:00:00', 0, 1, '2025-12-06 06:03:11', '2025-12-06 06:03:11', 0.00),
(71, 1, 2, 51, 5, '1771668799_0.png', '1771668799_1.jpg', '1771668799_2.png', '1771668799_3.png', 'this just product', 'testing the product', 'INR', 56.00, 33.99, 20.01, 2.00, 0, '2026-02-21 04:43:19', '192.168.1.3', '2026-02-21 10:16:40', 0, 1, '2026-02-22 00:00:00', 0, 1, '2026-02-21 04:43:19', '2026-02-21 04:46:40', 0.00),
(70, 1, 8, 14, 737, '1765028516_0.jpg', '1765028516_1.webp', '1765028516_2.jpg', '1765028516_3.jpg', 'Product title 23', 'Product title 23', 'INR', 89.00, 23.00, 66.00, 23.00, 0, '2025-12-06 08:11:56', '127.0.0.1', '2025-12-23 05:49:13', 0, 1, '2025-12-28 00:00:00', 0, 1, '2025-12-06 08:11:56', '2025-12-23 00:19:13', 0.00),
(72, 1, 13, NULL, 67, '1773768404_0.jpg', NULL, NULL, NULL, 'Skoda Slavia Led Light', 'fdtrdtdytd', 'INR', 787.00, 78.00, 682.00, 14.00, 0, '2026-04-14 11:30:20', '127.0.0.1', '2026-06-05 12:11:54', 0, 1, '2026-07-10 00:00:00', 0, 1, '2026-03-16 03:31:05', '2026-06-05 06:41:54', 0.00),
(78, 2, 13, 36, 10, '1776755892_0.jpg', NULL, NULL, NULL, 'SKODA CAR TYRE', 'SKODA CAR TYRESKODA CAR TYRESKODA CAR TYRESKODA CAR TYRESKODA CAR TYRE', 'INR', 1000.00, 799.94, 194.06, 3.00, 0, '2026-04-21 01:48:12', '127.0.0.1', '2026-04-23 06:24:30', 0, 1, '2027-08-27 00:00:00', 0, 1, '2026-04-21 01:48:13', '2026-04-23 00:54:30', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `userid` int(11) NOT NULL,
  `role` enum('admin','director','execative','subexcative','shopowner','customer') DEFAULT NULL,
  `adminid` int(11) NOT NULL DEFAULT 0,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` varchar(10) NOT NULL,
  `bdate` date NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `ipassword` varchar(100) DEFAULT NULL,
  `aboutyou` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic1` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `area` varchar(200) NOT NULL,
  `mobno` varchar(12) NOT NULL,
  `pancard` varchar(25) DEFAULT NULL,
  `gst` varchar(50) DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `acno` varchar(50) DEFAULT NULL,
  `ifsc` varchar(50) DEFAULT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'INR',
  `freePoints` int(11) NOT NULL DEFAULT 4,
  `points` int(11) NOT NULL DEFAULT 0,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0,
  `subscribed` tinyint(1) NOT NULL DEFAULT 1,
  `verifycode` varchar(6) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `fbuserid` varchar(25) DEFAULT NULL,
  `isvendor` tinyint(1) NOT NULL DEFAULT 0,
  `istatus` int(1) NOT NULL DEFAULT 0,
  `postedon` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`userid`, `role`, `adminid`, `fullname`, `gender`, `bdate`, `emailid`, `ipassword`, `aboutyou`, `pic1`, `address`, `area`, `mobno`, `pancard`, `gst`, `bank`, `acno`, `ifsc`, `currency`, `freePoints`, `points`, `isPaid`, `subscribed`, `verifycode`, `verified`, `fbuserid`, `isvendor`, `istatus`, `postedon`) VALUES
(1, NULL, 0, 'Hemant Jadhav', '', '0000-00-00', 'hemantjd@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', '1607172449224.jpg', '', '', '9222369691', NULL, NULL, NULL, NULL, NULL, 'INR', 278, 109, 1, 1, '86488', 1, NULL, 0, 1, '2023-04-21 11:04:02'),
(2, NULL, 0, 'Rahul', '', '0000-00-00', 'hemantjd1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', '1911000101701.jpg', '', '', '9222369692', NULL, NULL, NULL, NULL, NULL, 'INR', 43, 182, 1, 1, '28727', 1, NULL, 0, 1, '2023-04-21 10:54:20'),
(3, NULL, 0, 'Hemant Jadhav3', '', '0000-00-00', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '', 'IMG_2022-2141612.jpg', '', '', '9222369693', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 100, 1, 1, '19498', 1, NULL, 1, 1, '2023-04-21 11:06:15'),
(4, NULL, 0, 'Ajay Pandya', '', '0000-00-00', 'ajaypandya444@yahoo.com', 'bc9be5bb0291dbc10dc1689c30cf0fe1', '', '', '', '', '9820492139', NULL, NULL, NULL, NULL, NULL, 'INR', 8, 3358, 1, 1, '50084', 1, NULL, 1, 1, '2023-07-24 03:13:31'),
(5, NULL, 0, 'Amit  Sha', '', '0000-00-00', 'Aj12345@yahoo.com ', 'af8f9dffa5d420fbc249141645b962ee', '', '', '', '', '9820412345', NULL, NULL, NULL, NULL, NULL, 'INR', 55, 11, 1, 1, '55579', 1, NULL, 1, 1, '2023-08-04 22:40:11'),
(6, NULL, 0, 'Sha Amit', '', '0000-00-00', 'Aj56789@yahoo.com', '81ef17316dc8ad111918817e7005ea59', '', '', '', '', '9820456789', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 17, 1, 1, '80042', 1, NULL, 0, 1, '2023-05-19 03:46:08'),
(7, NULL, 0, 'Kami', '', '0000-00-00', 'Kami@yahoo.com ', 'f7a9717b1d4ecea4d55bcb31c4b6d325', '', '', '', '', '9773712345', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '57294', 1, NULL, 1, 1, '2023-05-22 14:33:53'),
(8, NULL, 0, 'Ka2 ', '', '0000-00-00', 'Kami2@yahoo.com ', '0106cbb11f4efaa9777511a02e514ef9', '', '', '', '', '9773756789', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '37975', 1, NULL, 0, 1, '2023-06-13 21:48:34'),
(9, NULL, 0, 'Kaml3', '', '0000-00-00', 'kami3@yahoo.com ', '0c4bc6037260b474ed247d51e77b81dd', '', '', '', '', '9773712378', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 15, 1, 1, '70715', 1, NULL, 0, 1, '2023-07-24 02:57:33'),
(10, NULL, 0, 'Nine Nine', '', '0000-00-00', '9999@yahoo.com ', '4ef77bad8f7816f05cb6726a059d9910', '', '', '', '', '9999999999', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '17683', 1, NULL, 0, 1, '2023-05-26 13:12:36'),
(11, NULL, 0, 'Aj8888', '', '0000-00-00', 'Aj888@yahoo.com', '402a577325938173e61b74db15e6f321', '', '', '', '', '8888888888', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '32045', 1, NULL, 0, 1, '2023-05-29 17:24:23'),
(12, NULL, 0, 'Ja', '', '0000-00-00', 'Ja@yahoo.com ', '0993ef3f0e19277532759f89f478718e', '', '', '', '', '7777777777', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '88928', 1, NULL, 1, 1, '2023-06-01 13:13:21'),
(13, NULL, 0, 'Anil', '', '0000-00-00', '', 'd48256e4bed2386e9bcfbcd8db9891ec', '', '', '', '', '9154336704', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '66849', 1, NULL, 0, 1, '2023-06-13 14:53:52'),
(14, NULL, 0, 'Test', '', '0000-00-00', 'Test@gmail.com', '0b3bc9ce555f07d127c6da44337e364f', '', '', '', '', '9000349782', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '25377', 1, NULL, 0, 1, '2023-06-13 15:36:57'),
(15, NULL, 0, 'Kp', '', '0000-00-00', '', 'c1dd0b21d432c0c65474a6dc7cece684', '', '', '', '', '9888888888', NULL, NULL, NULL, NULL, NULL, 'INR', 41, 5, 1, 1, '66259', 1, NULL, 1, 1, '2023-11-27 03:54:03'),
(16, NULL, 0, 'Umesh', '', '0000-00-00', '', 'ce9679f9e3dfa489d66764ad1bfdeaa1', '', '', '', '', '8999999999', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 40, 1, 1, '52907', 1, NULL, 1, 1, '2023-06-23 00:21:38'),
(17, NULL, 0, 'Priya', '', '0000-00-00', 'Priyap@yahoo.com', '25593b9d56e2a3f91e1a4ee382ea1d35', '', '', '', '', '9773722379', NULL, NULL, NULL, NULL, NULL, 'INR', 15, 107, 1, 1, '40599', 1, NULL, 1, 1, '2023-08-05 02:33:27'),
(18, NULL, 0, 'One', '', '0000-00-00', 'One@yahoo.com ', 'b9382712993ab4255b44ec72a27ab78c', '', '', '', '', '9811111111', NULL, NULL, NULL, NULL, NULL, 'INR', 25, 44, 1, 1, '37104', 1, NULL, 1, 1, '2023-10-22 02:58:59'),
(19, NULL, 0, 'Two Two Two', '', '0000-00-00', 'Two@yahoo.com ', '6231224492ae67766ce1f349b7dae50f', '', '', '', '', '9822222222', NULL, NULL, NULL, NULL, NULL, 'INR', 84, 16, 1, 1, '79015', 1, NULL, 1, 1, '2023-09-19 02:24:18'),
(20, NULL, 0, 'EJHYUNMKg', '', '0000-00-00', 'mamie37hamiltonlnw@outlook.com', '90d72df758a5780e3ae1ed11ada0da55', '', '', '', '', '8122479756', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '36903', 0, NULL, 0, 0, '2024-02-15 00:04:26'),
(21, NULL, 0, 'LOPNIzuvY', '', '0000-00-00', 'david_garrisonzjtt@outlook.com', '0e6244bf4cbd0abc2e42ac88e797c1c3', '', '', '', '', '7721207249', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '16149', 0, NULL, 0, 0, '2024-03-18 23:51:31'),
(22, NULL, 0, 'YbpVIaeSyWLGEw', '', '0000-00-00', 'dickerson.micheal5896@yahoo.com', 'd2fba1e36b2418c05f4bc3ffbe79f6f6', '', '', '', '', '9329983781', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '84740', 0, NULL, 0, 0, '2024-04-16 16:06:54'),
(23, NULL, 0, 'EGpHyQrxOgw', '', '0000-00-00', 'love_raymond4527@yahoo.com', '2423486995e8d1d09a2f765e298951af', '', '', '', '', '7670566706', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '43880', 0, NULL, 0, 0, '2024-04-24 14:46:40'),
(24, NULL, 0, 'Nfejdekofhofjwdoe Jirekdwjfreohogjkerwkr', '', '0000-00-00', 'vadimnea66+188s@list.ru', '8f56d963efb6a11c912ce0acfb54ac94', '', '', '', '', '8887939195', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '42732', 0, NULL, 0, 0, '2024-05-14 04:31:50'),
(25, NULL, 0, 'ERqZfGAo', '', '0000-00-00', 'jessica_long1988@yahoo.com', 'afebd3ff79b53412625827030fc898e3', '', '', '', '', '7981902929', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '18499', 0, NULL, 0, 0, '2024-05-18 04:04:45'),
(26, NULL, 0, 'Hemant Jadhav', '', '0000-00-00', 'hemantjd@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '', '9222222222', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '47235', 0, NULL, 0, 0, '2024-05-25 17:26:07'),
(27, NULL, 0, 'TuyFCjXpwoOBAUc', '', '0000-00-00', 'ferrellnatila3464@gmail.com', '25594690e87108dd98423cb4a74533d7', '', '', '', '', '7217106090', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '23325', 0, NULL, 0, 0, '2024-06-02 08:36:23'),
(28, NULL, 0, 'CNdfioXFzbvm', '', '0000-00-00', 'melissaerickson748283@yahoo.com', 'd3534cab9fefc48ec8b008ce202f3bf7', '', '', '', '', '8839093905', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '11652', 0, NULL, 0, 0, '2024-06-09 11:55:32'),
(29, NULL, 0, 'JA', '', '0000-00-00', 'Aj12345@yahoo.com', '768c8121cc23bede141f2bf44b1a687a', '', '', '', '', '9820512345', NULL, NULL, NULL, NULL, NULL, 'INR', 113, 19, 1, 1, '46788', 1, NULL, 0, 1, '2024-07-14 23:50:56'),
(30, NULL, 0, 'OqNUFMXKjWICyg', '', '0000-00-00', 'jsb_frazier2001@yahoo.com', '6231f5fceb67d00a43955bcb4101ce75', '', '', '', '', '7487710988', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '88027', 0, NULL, 0, 0, '2024-07-18 11:25:52'),
(31, NULL, 0, 'SeJNanBhGPLwQ', '', '0000-00-00', 'morrisondesiree9364@yahoo.com', '5932032c5acb5632f591c2ea17b4cc5f', '', '', '', '', '9757201601', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '22919', 0, NULL, 0, 0, '2024-07-31 08:03:33'),
(32, NULL, 0, 'KrncWEYRNwz', '', '0000-00-00', 'darbic28@gmail.com', '047b1f69227306af5b8ee59deea48339', '', '', '', '', '7944720833', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '38794', 0, NULL, 0, 0, '2024-08-09 15:54:53'),
(33, NULL, 0, 'Aj4', '', '0000-00-00', 'Aj4@zeeroprice.com', '18e1793d4637a3caccf7e3e5940ec472', '', '', '', '', '9820444444', NULL, NULL, NULL, NULL, NULL, 'INR', 102, 265, 1, 1, '59514', 1, NULL, 0, 1, '2024-08-14 15:39:56'),
(34, NULL, 0, 'EAZvnzfG', '', '0000-00-00', 'lopez_melissa1112@yahoo.com', '7d7990ff2b9e1dedbb74b7ded64d8aed', '', '', '', '', '7487645468', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '76436', 0, NULL, 0, 0, '2024-08-15 20:05:44'),
(35, NULL, 0, 'OMIEFNQKZLRwHvgT', '', '0000-00-00', 'david86campjgy@outlook.com', 'a1e27da1e3d4b75120cd1861259af663', '', '', '', '', '8086328264', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '29840', 0, NULL, 0, 0, '2024-08-26 23:56:53'),
(36, NULL, 0, 'OAkpMDTQrXydHLvc', '', '0000-00-00', 'shaakasksh@yahoo.com', 'f88e3f0b20304edcf4a49795d5e34d5a', '', '', '', '', '8819667276', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '56766', 0, NULL, 0, 0, '2024-09-13 21:39:39'),
(37, NULL, 0, 'Aj0', '', '0000-00-00', 'Ap@yahoo.com', '2796e7ba537c5043d7d3d53f971da4db', '', '', '', '', '9000000000', NULL, NULL, NULL, NULL, NULL, 'INR', 263, 238, 1, 1, '41374', 1, NULL, 0, 1, '2024-10-23 23:39:39'),
(38, NULL, 0, '', '', '0000-00-00', 'salavat@ya.ru', 'ba3c2919c73f5359b4758f89e190cf7a', '', '', '', '', '9093429282', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '97837', 0, NULL, 0, 0, '2024-11-18 22:42:37'),
(39, NULL, 0, '', '', '0000-00-00', 'bropand39@gmail.com', 'ba3c2919c73f5359b4758f89e190cf7a', '', '', '', '', '9092345678', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '55770', 0, NULL, 0, 0, '2024-11-18 22:42:54'),
(40, NULL, 0, '', '', '0000-00-00', 'feknefotro@gufum.com', 'ba3c2919c73f5359b4758f89e190cf7a', '', '', '', '', '9092345681', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '59050', 0, NULL, 0, 0, '2024-11-18 22:42:57'),
(41, NULL, 0, 'Aj89', '', '0000-00-00', 'Aj89@zeeroprice.com', '0ee54e4adcd193865627d9ca7a50935c', '', '', '', '', '9898989898', NULL, NULL, NULL, NULL, NULL, 'INR', 51, 215, 1, 1, '39927', 1, NULL, 0, 1, '2025-03-07 16:40:02'),
(42, NULL, 0, 'Nfejdekofhofjwdoe Jirekdwjfreohogjkerwkr', '', '0000-00-00', 'yasen.krasen.13+93967@mail.ru', '8f56d963efb6a11c912ce0acfb54ac94', '', '', '', '', '8381451852', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '42256', 0, NULL, 0, 0, '2024-12-02 01:03:44'),
(43, NULL, 0, 'Nfejdekofhofjwdoe Jirekdwjfreohogjkerwkr', '', '0000-00-00', 'yasen.krasen.13+75429@mail.ru', '8f56d963efb6a11c912ce0acfb54ac94', '', '', '', '', '8968715189', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '11551', 0, NULL, 0, 0, '2024-12-11 13:29:02'),
(44, NULL, 0, 'Miguelmoift', '', '0000-00-00', 'kertyucds@onet.eu', 'f8ec601b27fd864ed8151bc467aa147e', '', '', '', '', '8249824571', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '51119', 0, NULL, 0, 0, '2025-01-03 14:01:32'),
(45, NULL, 0, 'Jay', '', '0000-00-00', 'Jay@zeeroprice.com ', 'f2d7492fcbd0806266b5bf515c7b4b4e', '', '', '', '', '7878787878', NULL, NULL, NULL, NULL, NULL, 'INR', 464, 2884, 1, 1, '26841', 1, NULL, 0, 1, '2025-01-06 23:54:34'),
(49, 'admin', 1, 'Ranjeet Poojari', '', '0000-00-00', 'rohitkumar@gmail.com', '9dec15be6b1f7c8618b0a2e8569540c2', '', '', '', '', '9699377247', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '', 1, NULL, 0, 1, '2025-06-30 09:52:53'),
(50, 'director', 4, 'Rohit', '', '0000-00-00', 'ranj@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '', '', '9876543210', NULL, NULL, NULL, NULL, NULL, 'INR', 4, 0, 0, 1, '', 1, NULL, 0, 1, '2025-07-02 06:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `seller_ad_payments`
--

CREATE TABLE `seller_ad_payments` (
  `payment_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `ad_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
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
('4WF4p5WqzvdjvgvElI182Q0yYC8keLRjMvbdTVgt', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU0dndEdsejFNOFVReEMyVTQ2UUFoUVhzZ3lZQzJ5MEY1emdHMmkyeiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1780077837),
('9IXCBvYyOZW0gDgY1Zx4EdV0Da9y0cLEfukakUzA', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWldMcmlCWWtGclZFWUdDQ1BXeWpiVnIyemVLTnVLY2dBQTdVVkN5YiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRzL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo4OiJhZHMuZGFzaCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1776927914),
('G3k964kBzCB2bKLQtRCA1u9u2gClYu2DzX603ezR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVZIa1ZpMzh4R0VVUFpWV2RidEduTER1NEJKRll6dmZkQTVvbFZIVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1777008715),
('HqHz0D1NVyLhaHpsM9k7MmVhDwLP8lyi6q9plaHk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidUdtd3FVN0VpcFFWcmNTcGZvRXVRb1JRYzk3cks1U29RTFoyZ3Q0TCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcHJvZHVjdGRldGFpbC83MiI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjEzOiJhZF9zdGFydF90aW1lIjtpOjE3ODA2NjE1Njg7czoxMDoiYWRfc2xvdF9pZCI7czoxOiIxIjt9', 1780662257),
('ycL1joFleai4KJoqcp1fF71NV5RTkRnrDwuNq5C9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQWRHNnVuVXIxdlNPR3hPUXlKN0xOd2IyTzh2U1lNRlhvSnA2TWdWaCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1776862545),
('YeA79rRI6gAuzSxQbBc64B20GisUgknq9eTAFY0o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiclpqcTdGSWdlTkNOa3hCSGZSZXd4QzBrZDJHdlJZMXhaazhXMWJXaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1780660146),
('z8jhNVGWr3rIHCw2hEj9gF0UdIl77b4ClkIHw6th', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicVhoSUx2cHdIWHZpNm5OQnpVc3hXZlF6bjRta2FRWjRFMlp3bWpxUSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777008611);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcatid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `subcatname` varchar(50) NOT NULL,
  `istatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcatid`, `catid`, `subcatname`, `istatus`) VALUES
(1, 1, 'T-shirts', 0),
(2, 1, 'Shirts', 0),
(9, 9, 'GYM Equipments', 1),
(4, 1, 'Handkerchief ', 1),
(5, 1, 'Ethenic wear', 0),
(6, 1, 'Western wear', 0),
(7, 1, 'Nightwear', 1),
(8, 1, 'Innerwear', 1),
(10, 9, 'Health Suppliments', 1),
(36, 13, 'Car Tyres', 1),
(13, 8, 'Wallets', 1),
(14, 8, 'Hand Bags', 1),
(15, 8, 'Suitcase', 1),
(16, 10, 'Health care', 1),
(17, 10, 'Beauty Products', 1),
(18, 10, 'Perfumes, Deodorants', 1),
(19, 3, 'Laptops', 1),
(20, 3, 'Printers', 1),
(21, 3, 'Pen drives', 1),
(22, 3, 'Memory Cards', 1),
(23, 5, 'Seating furniture', 1),
(24, 6, 'Gold Plated', 1),
(25, 12, 'Formal Shoes', 1),
(26, 12, 'Casual Shoes', 1),
(27, 12, 'Sports Shoes', 1),
(28, 12, 'Flip-Flops', 1),
(29, 12, 'Sandals', 1),
(30, 9, 'Football, Basketball, Tenis', 1),
(31, 9, 'Cricket', 1),
(32, 13, 'Bike Accessories, Bike Parts', 1),
(34, 13, 'Bike Tyres', 1),
(35, 13, 'Car Accessories, Car Parts', 1),
(37, 5, 'Kitchen & Dining', 1),
(38, 4, 'LED Lights, Bulbs', 1),
(39, 4, 'LED TV', 1),
(40, 4, 'Fridge', 1),
(41, 4, 'Air Conditioners', 1),
(42, 15, 'Pen, Pencils, Notebooks', 1),
(43, 15, 'General Products', 1),
(44, 16, 'Cold Drinks, Juice & Water', 1),
(45, 16, 'Tea & Coffee', 1),
(46, 16, 'Dairy Products', 1),
(47, 16, 'Nutritional Drinks, Health Drinks', 1),
(48, 16, 'Packaged Food', 1),
(49, 16, 'Household', 1),
(50, 16, 'Cosmetics', 1),
(51, 2, 'Budget Mobiles', 1),
(52, 2, 'Smartphones', 1),
(53, 2, 'Tablets', 1),
(54, 4, 'Iron', 1),
(55, 6, 'Silver Plated', 1),
(56, 6, 'Stones', 1),
(57, 6, 'Pure Gold Jewellery', 1),
(58, 14, 'Wrist watches', 1),
(68, 21, 'DiwaliKandils', 1),
(70, 4, 'Mobiles', 1),
(69, 1, 'Saree', 1),
(71, 22, 'Syrup', 1),
(72, 22, 'Tablets', 1),
(73, 22, 'Churna', 1),
(74, 15, 'Books', 1),
(75, 3, 'hruruyre', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temporders`
--

CREATE TABLE `temporders` (
  `orderid` varchar(25) NOT NULL,
  `userid` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qtyBatchNo` int(11) NOT NULL,
  `customercost` decimal(10,2) NOT NULL,
  `postedon` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `temporders`
--

INSERT INTO `temporders` (`orderid`, `userid`, `sellerid`, `pid`, `qtyBatchNo`, `customercost`, `postedon`) VALUES
('332024215715', 37, 33, 42, 0, 3368.00, '2024-11-19 02:57:15'),
('332024215649', 37, 33, 43, 0, 485.00, '2024-11-19 02:56:49'),
('372024125313', 37, 37, 44, 0, 292.00, '2024-11-18 17:53:13'),
('332024123820', 37, 33, 43, 0, 486.00, '2024-11-17 17:38:20'),
('332024123738', 37, 33, 43, 0, 487.00, '2024-11-17 17:37:38'),
('372024233414', 37, 37, 44, 0, 293.00, '2024-11-17 04:34:14'),
('372024233303', 37, 37, 44, 0, 294.00, '2024-11-17 04:33:03'),
('372024232913', 37, 37, 44, 0, 295.00, '2024-11-17 04:29:13'),
('332024145523', 37, 33, 43, 0, 488.00, '2024-11-16 19:55:23'),
('332024155410', 1, 33, 42, 0, 3371.00, '2024-11-15 20:54:09'),
('332024111941', 37, 33, 41, 0, 260.00, '2024-11-13 16:19:41'),
('372024111918', 37, 37, 44, 0, 296.00, '2024-11-13 16:19:18'),
('372024224121', 37, 37, 44, 0, 297.00, '2024-11-12 03:41:21'),
('332024230325', 37, 33, 41, 0, 261.00, '2024-11-11 04:03:25'),
('372024145811', 37, 37, 44, 0, 298.00, '2024-11-10 19:58:11'),
('372024000631', 37, 37, 44, 0, 299.00, '2024-11-08 05:06:31'),
('332024205434', 37, 33, 42, 0, 3374.00, '2024-11-08 01:54:34'),
('332024205351', 37, 33, 42, 0, 3377.00, '2024-11-08 01:53:51'),
('332024205342', 37, 33, 42, 0, 3380.00, '2024-11-08 01:53:42'),
('332024232044', 37, 33, 42, 0, 3383.00, '2024-11-06 04:20:44'),
('332024112857', 37, 33, 43, 0, 489.00, '2024-11-05 16:28:57'),
('332024190254', 37, 33, 41, 0, 262.00, '2024-11-05 00:02:54'),
('332024190231', 37, 33, 41, 0, 263.00, '2024-11-05 00:02:31'),
('332024190226', 37, 33, 41, 0, 264.00, '2024-11-05 00:02:24'),
('332024062714', 37, 33, 41, 0, 265.00, '2024-11-04 11:27:14'),
('332024115817', 37, 33, 43, 0, 490.00, '2024-11-02 15:58:17'),
('332024115802', 37, 33, 43, 0, 491.00, '2024-11-02 15:58:02'),
('332024192408', 37, 33, 42, 0, 3386.00, '2024-11-01 23:24:08'),
('332024002942', 37, 33, 41, 0, 266.00, '2024-11-01 04:29:42'),
('332024002932', 37, 33, 41, 0, 267.00, '2024-11-01 04:29:32'),
('332024174504', 37, 33, 42, 0, 3389.00, '2024-10-31 21:45:04'),
('332024174452', 37, 33, 42, 0, 3392.00, '2024-10-31 21:44:52'),
('332024224610', 37, 33, 41, 0, 268.00, '2024-10-31 02:46:10'),
('332024230949', 37, 33, 41, 0, 269.00, '2024-10-28 03:09:49'),
('332024230935', 37, 33, 41, 0, 270.00, '2024-10-28 03:09:35'),
('332024203726', 37, 33, 42, 0, 3395.00, '2024-10-26 00:37:26'),
('332024194515', 37, 33, 43, 0, 492.00, '2024-10-23 23:45:15'),
('332024184916', 1, 33, 41, 0, 271.00, '2024-10-19 22:49:16'),
('332024172047', 1, 33, 43, 0, 493.00, '2024-10-19 21:20:47'),
('332024164601', 1, 33, 42, 0, 3398.00, '2024-10-18 20:46:01'),
('332024164533', 1, 33, 42, 0, 3401.00, '2024-10-18 20:45:33'),
('332024191742', 1, 33, 42, 0, 3404.00, '2024-10-16 23:17:42'),
('332024191729', 1, 33, 42, 0, 3407.00, '2024-10-16 23:17:29'),
('332024191647', 1, 33, 42, 0, 3410.00, '2024-10-16 23:16:45'),
('332024222545', 1, 33, 43, 0, 494.00, '2024-10-15 02:25:45'),
('332024222508', 1, 33, 42, 0, 3413.00, '2024-10-15 02:25:08'),
('332024222451', 1, 33, 42, 0, 3416.00, '2024-10-15 02:24:51'),
('332024222432', 1, 33, 42, 0, 3419.00, '2024-10-15 02:24:32'),
('332024221847', 1, 33, 42, 0, 3422.00, '2024-10-15 02:18:47'),
('332024221739', 1, 33, 42, 0, 3425.00, '2024-10-15 02:17:39'),
('332024231723', 1, 33, 43, 0, 495.00, '2024-10-06 03:17:22'),
('332024231715', 1, 33, 43, 0, 496.00, '2024-10-06 03:17:15'),
('332024111701', 1, 33, 42, 0, 3428.00, '2024-10-04 15:17:01'),
('332024112658', 1, 33, 42, 0, 3431.00, '2024-10-03 15:26:58'),
('332024112509', 1, 33, 42, 0, 3434.00, '2024-10-03 15:25:09'),
('332024112433', 1, 33, 42, 0, 3437.00, '2024-10-03 15:24:33'),
('332024104239', 1, 33, 42, 0, 3440.00, '2024-10-02 14:42:38'),
('332024104205', 1, 33, 43, 0, 497.00, '2024-10-02 14:42:05'),
('332024233938', 1, 33, 42, 0, 3443.00, '2024-10-02 03:39:38'),
('332024125230', 1, 33, 42, 0, 3446.00, '2024-09-29 16:52:30'),
('332024225936', 1, 33, 43, 0, 498.00, '2024-09-29 02:59:36'),
('332024225904', 1, 33, 43, 0, 499.00, '2024-09-29 02:59:04'),
('332024232639', 1, 33, 42, 0, 3449.00, '2024-09-24 03:26:39'),
('332024140619', 33, 33, 42, 0, 3452.00, '2024-09-13 18:06:19'),
('332024140453', 33, 33, 42, 0, 3455.00, '2024-09-13 18:04:53'),
('332024140339', 33, 33, 42, 0, 3458.00, '2024-09-13 18:03:39'),
('332024132355', 33, 33, 42, 0, 3461.00, '2024-09-09 17:23:55'),
('332024132027', 33, 33, 42, 0, 3464.00, '2024-09-09 17:20:27'),
('332024225550', 33, 33, 41, 0, 272.00, '2024-09-07 02:55:50'),
('332024113751', 33, 33, 42, 0, 3467.00, '2024-09-06 15:37:50'),
('332024212239', 33, 33, 42, 0, 3470.00, '2024-09-06 01:22:39'),
('332024212202', 33, 33, 42, 0, 3473.00, '2024-09-06 01:22:02'),
('332024234319', 33, 33, 42, 0, 3476.00, '2024-09-05 03:43:19'),
('332024125851', 33, 33, 42, 0, 3479.00, '2024-09-01 16:58:51'),
('332024212854', 33, 33, 41, 0, 273.00, '2024-09-01 01:28:54'),
('332024190826', 33, 33, 42, 0, 3482.00, '2024-08-31 23:08:26'),
('332024190805', 33, 33, 42, 0, 3485.00, '2024-08-31 23:08:05'),
('332024190108', 1, 33, 42, 0, 3488.00, '2024-08-29 23:01:08'),
('332024185856', 1, 33, 41, 0, 274.00, '2024-08-29 22:58:56'),
('332024185112', 33, 33, 42, 0, 3491.00, '2024-08-29 22:51:12'),
('292024215720', 33, 29, 39, 0, 79.00, '2024-08-29 01:57:20'),
('332024175159', 33, 33, 42, 0, 3494.00, '2024-08-28 21:51:59'),
('332024132658', 33, 33, 42, 0, 3497.00, '2024-08-26 17:26:58'),
('292024010857', 33, 29, 39, 0, 80.00, '2024-08-26 05:08:57'),
('332024010812', 33, 33, 41, 0, 275.00, '2024-08-26 05:08:12'),
('292024010726', 33, 29, 40, 0, 538.00, '2024-08-26 05:07:26'),
('292024202721', 33, 29, 40, 0, 539.00, '2024-08-23 00:27:21'),
('292024205550', 33, 29, 40, 0, 540.00, '2024-08-22 00:55:50'),
('292024193401', 33, 29, 39, 0, 81.00, '2024-08-20 23:34:01'),
('332024193331', 33, 33, 41, 0, 276.00, '2024-08-20 23:33:31'),
('292024193255', 33, 29, 40, 0, 541.00, '2024-08-20 23:32:55'),
('292024220601', 33, 29, 40, 0, 542.00, '2024-08-18 02:06:01'),
('332024220508', 33, 33, 41, 0, 277.00, '2024-08-18 02:05:08'),
('332024220443', 33, 33, 41, 0, 278.00, '2024-08-18 02:04:42'),
('332024220138', 33, 33, 41, 0, 279.00, '2024-08-18 02:01:38'),
('292024194048', 29, 29, 39, 0, 82.00, '2024-08-14 23:40:47'),
('292024163218', 29, 29, 39, 0, 83.00, '2024-08-12 20:32:18'),
('292024163146', 29, 29, 39, 0, 84.00, '2024-08-12 20:31:46'),
('292024220139', 29, 29, 39, 0, 85.00, '2024-08-12 02:01:39'),
('292024135413', 29, 29, 40, 0, 548.00, '2024-07-17 17:54:12'),
('292024135329', 29, 29, 40, 0, 549.00, '2024-07-17 17:53:29'),
('292024201153', 29, 29, 38, 0, 548.00, '2024-07-17 00:11:53'),
('292024200614', 29, 29, 38, 0, 549.00, '2024-07-17 00:06:14'),
('12023190024', 15, 1, 34, 0, 394.00, '2023-12-03 00:00:24'),
('12023195309', 15, 1, 35, 0, 232.00, '2023-12-06 00:53:09'),
('12023195419', 15, 1, 35, 0, 231.00, '2023-12-06 00:54:19'),
('292024200300', 29, 29, 37, 0, 99.00, '2024-07-15 00:02:59'),
('292024200316', 29, 29, 37, 0, 98.00, '2024-07-15 00:03:16'),
('292024000931', 29, 29, 37, 0, 97.00, '2024-07-16 04:09:31'),
('292024001002', 29, 29, 37, 0, 96.00, '2024-07-16 04:10:02'),
('292024203149', 29, 29, 39, 0, 86.00, '2024-08-06 00:31:49'),
('292024185422', 29, 29, 39, 0, 87.00, '2024-08-04 22:54:22'),
('292024183742', 29, 29, 39, 0, 88.00, '2024-08-04 22:37:42'),
('292024233218', 29, 29, 40, 0, 543.00, '2024-08-04 03:32:18'),
('292024233207', 29, 29, 40, 0, 544.00, '2024-08-04 03:32:07'),
('292024181001', 29, 29, 39, 0, 89.00, '2024-08-03 22:10:01'),
('292024230810', 29, 29, 39, 0, 90.00, '2024-07-31 03:08:10'),
('292024230748', 29, 29, 39, 0, 91.00, '2024-07-31 03:07:48'),
('292024220009', 29, 29, 39, 0, 92.00, '2024-07-30 02:00:08'),
('292024215957', 29, 29, 39, 0, 93.00, '2024-07-30 01:59:57'),
('292024215853', 29, 29, 40, 0, 545.00, '2024-07-30 01:58:53'),
('292024215834', 29, 29, 40, 0, 546.00, '2024-07-30 01:58:33'),
('292024215815', 29, 29, 40, 0, 547.00, '2024-07-30 01:58:14'),
('292024001320', 29, 29, 39, 0, 94.00, '2024-07-29 04:13:20'),
('292024001304', 29, 29, 39, 0, 95.00, '2024-07-29 04:13:04'),
('292024091954', 29, 29, 39, 0, 96.00, '2024-07-21 13:19:54'),
('292024204234', 29, 29, 39, 0, 97.00, '2024-07-21 00:42:34'),
('292024204226', 29, 29, 39, 0, 98.00, '2024-07-21 00:42:26'),
('292024204219', 29, 29, 39, 0, 99.00, '2024-07-21 00:42:19'),
('12023190014', 15, 1, 34, 0, 395.00, '2023-12-03 00:00:14'),
('12023122334', 15, 1, 35, 0, 233.00, '2023-11-29 17:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `transactionid` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `credited` int(11) DEFAULT 0,
  `debited` int(11) DEFAULT 0,
  `remark` text NOT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0,
  `postedon` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `userid`, `transactionid`, `amount`, `currency`, `credited`, `debited`, `remark`, `isPaid`, `postedon`) VALUES
(1, 2, '220230515030137', 5, 'INR', 20, 0, 'Coins purchased', 1, '2023-05-15 07:02:38'),
(2, 2, '220230515030331', 100, 'INR', 400, 0, 'Economy 100', 0, '2023-05-15 07:03:31'),
(3, 1, '120230515051754', 250, 'INR', 1000, 0, 'Premium', 0, '2023-05-15 09:17:54'),
(4, 6, '620230518234907', 5, 'INR', 20, 0, 'Budget 5', 0, '2023-05-19 03:49:07'),
(5, 6, '620230521115731', 5, 'INR', 20, 0, 'Budget 5', 1, '2023-05-21 16:01:28'),
(6, 1, '120230528093310', 10, 'INR', 40, 0, 'Budget 10', 0, '2023-05-28 13:33:10'),
(7, 13, '1320230613105536', 5, 'INR', 20, 0, 'Budget 5', 0, '2023-06-13 14:55:36'),
(8, 13, '1320230613120502', 5, 'INR', 20, 0, 'Budget 5', 0, '2023-06-13 16:05:02'),
(9, 16, '1620230622204155', 5, 'INR', 20, 0, 'Budget 5', 0, '2023-06-23 00:41:55'),
(10, 16, '1620230624230144', 5, 'INR', 20, 0, 'Budget 5', 1, '2023-06-25 03:02:57'),
(11, 16, '1620230704215827', 20, 'INR', 20, 0, 'Budget 20', 1, '2023-07-05 01:59:04'),
(12, 16, '1620230717145535', 25, 'INR', 25, 0, 'Economy 25', 1, '2023-07-17 18:56:06'),
(13, 16, '1620230722164117', 25, 'INR', 25, 0, 'Economy 25', 1, '2023-07-22 20:41:39'),
(14, 15, '1520230723223811', 15, 'INR', 15, 0, 'Budget 15', 1, '2023-07-24 02:38:35'),
(15, 9, '920230723225904', 15, 'INR', 15, 0, 'Budget 15', 1, '2023-07-24 02:59:42'),
(16, 17, '1720230724191607', 100, 'INR', 100, 0, 'Economy 100', 1, '2023-07-24 23:16:37'),
(17, 5, '520230804184137', 5, 'INR', 5, 0, 'Budget 5', 1, '2023-08-04 22:41:56'),
(18, 5, '520230804192320', 10, 'INR', 10, 0, 'Budget 10', 1, '2023-08-04 23:23:38'),
(19, 17, '1720230804230927', 10, 'INR', 10, 0, 'Budget 10', 1, '2023-08-05 03:10:06'),
(20, 17, '1720230804231036', 10, 'INR', 10, 0, 'Budget 10', 1, '2023-08-05 03:10:52'),
(21, 5, '520230805235629', 15, 'INR', 15, 0, 'Budget 15', 1, '2023-08-06 03:56:56'),
(22, 19, '1920230808123205', 5, 'INR', 5, 0, 'Budget 5', 0, '2023-08-08 16:32:05'),
(23, 19, '1920230808123331', 5, 'INR', 5, 0, 'Budget 5', 1, '2023-08-08 16:33:48'),
(24, 19, '1920230808175519', 15, 'INR', 15, 0, 'Budget 15', 1, '2023-08-08 21:55:39'),
(25, 19, '1920230822192525', 25, 'INR', 25, 0, 'Economy 25', 1, '2023-08-22 23:25:49'),
(26, 18, '1820231021230057', 50, 'INR', 50, 0, 'Economy 50', 1, '2023-10-22 03:01:28'),
(27, 29, '2920240714195819', 50, 'INR', 50, 0, 'Economy 50', 1, '2024-07-14 23:59:42'),
(28, 33, '3320240815232053', 50, 'INR', 50, 0, 'Economy 50', 1, '2024-08-16 03:21:48'),
(29, 33, '3320240906113847', 250, 'INR', 250, 0, 'Premium', 1, '2024-09-06 15:39:44'),
(30, 33, '3320240913154434', 25, 'INR', 25, 0, 'Economy 25', 0, '2024-09-13 19:44:34'),
(31, 33, '3320240913154924', 25, 'INR', 25, 0, 'Economy 25', 1, '2024-09-13 19:50:53'),
(32, 37, '3720241023194404', 250, 'INR', 250, 0, 'Premium', 1, '2024-10-23 23:44:49'),
(33, 1, '120241115155544', 1000, 'INR', 1000, 0, 'Platinum', 0, '2024-11-15 20:55:44'),
(34, 37, '3720241116232952', 500, 'INR', 500, 0, 'Golden', 1, '2024-11-17 04:30:32'),
(35, 41, '4120241128180929', 1000, 'INR', 1000, 0, 'Platinum', 1, '2024-11-28 23:10:06'),
(36, 45, '4520250106185732', 1000, 'INR', 1000, 0, 'Platinum', 1, '2025-01-06 23:58:16'),
(37, 45, '4520250524180252', 5, 'INR', 5, 0, 'Budget 5', 0, '2025-05-24 12:32:52'),
(38, 45, '4520250524180857', 5, 'INR', 5, 0, 'Budget 5', 0, '2025-05-24 12:38:57'),
(39, 45, '4520250524182425', 5, 'INR', 5, 0, 'Budget 5', 1, '2025-05-24 12:55:28'),
(40, 45, '4520250524183907', 5, 'INR', 5, 0, 'Budget 5', 0, '2025-05-24 13:09:07'),
(41, 47, '4720250530170658', 5, 'INR', 5, 0, 'Budget 5', 0, '2025-05-30 11:36:58'),
(42, 45, '4520250530171027', 5, 'INR', 5, 0, 'Budget 5', 1, '2025-05-30 11:41:47'),
(43, 47, '4720250530171223', 1000, 'INR', 1000, 0, 'Platinum', 1, '2025-05-30 11:42:42'),
(44, 45, '4520250710153526', 1000, 'INR', 1000, 0, 'Platinum', 1, '2025-07-10 10:06:23'),
(45, 45, '4520250805113406', 1000, 'INR', 1000, 0, 'Platinum', 1, '2025-08-05 06:05:21'),
(46, 45, '4520250805114405', 15, 'INR', 15, 0, 'Budget 15', 0, '2025-08-05 06:14:05'),
(47, 1, '120251219064741', 10, 'INR', 10, 0, 'Budget 10', 0, '2025-12-19 01:17:41'),
(48, 1, '120251219065254', 10, 'INR', 10, 0, 'Budget 10', 0, '2025-12-19 01:22:54'),
(49, 1, '120251219065319', 10, 'INR', 10, 0, 'Budget 10', 1, '2025-12-19 01:33:02'),
(50, 1, '120251219072122', 10, 'INR', 10, 0, 'Budget 10', 0, '2025-12-19 01:51:24'),
(51, 1, '120251219072153', 1000, 'INR', 1000, 0, 'Platinum', 1, '2025-12-19 01:52:14'),
(52, 1, '120251223054701', 50, 'INR', 50, 0, 'Economy 50', 1, '2025-12-23 00:17:30'),
(53, 1, '120260316090237', 10, 'INR', 10, 0, 'Budget 10', 1, '2026-03-16 03:33:20'),
(54, 1, '120260324185702', 5, 'INR', 5, 0, 'Budget 5', 1, '2026-03-24 13:27:23'),
(55, 1, '120260420130523', 100, 'INR', 0, 100, 'Ad Payment', 1, '2026-04-20 07:35:25'),
(56, 1, '120260420130927', 500, 'INR', 0, 500, 'Ad Payment', 1, '2026-04-20 07:39:27'),
(57, 1, '120260420131853', 1500, 'INR', 0, 1500, 'Ad Payment', 1, '2026-04-20 07:48:54'),
(58, 1, '120260420132711', 2000, 'INR', 0, 2000, 'Ad Payment', 1, '2026-04-20 07:57:12'),
(59, 2, '220260421052652', 1000, 'INR', 1000, 0, 'Platinum', 0, '2026-04-20 23:56:54'),
(60, 2, '220260421052740', 5, 'INR', 5, 0, 'Budget 5', 0, '2026-04-20 23:57:40'),
(61, 1, '120260422110245', 1000, 'INR', 0, 1000, 'Ad Package Purchase', 1, '2026-04-22 05:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `role` enum('admin','director','executive','subexecutive','shopowner','customer') NOT NULL DEFAULT 'customer',
  `points` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `points`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ranjeet Poojari', 'ranjeetpoojari77@gmail.com', '9699377247', 'customer', 1030, NULL, '$2y$12$LLqWqTQmKyv7hLi/A/YHsO09hW1zM6n4EUMWLfo/Sh1kMKWs92mn2', NULL, '2025-12-02 00:53:39', '2026-06-05 06:41:54'),
(2, 'Rahul Kumar', 'rahul@gmail.com', '8978675434', 'customer', 1988, NULL, '$2y$12$.FfOFc23AyIoJCNfGu9DFem.WoIkNv.QiVnJhz.MWASi2k02rLwtC', NULL, '2026-04-20 13:18:03', '2026-04-21 01:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `usersprofile`
--

CREATE TABLE `usersprofile` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `number` varchar(15) NOT NULL,
  `address_type` enum('Home','Office','Other') DEFAULT 'Home',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_ad_credits`
--

CREATE TABLE `user_ad_credits` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_credits` int(11) DEFAULT 0,
  `used_credits` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ad_credits`
--

INSERT INTO `user_ad_credits` (`id`, `user_id`, `total_credits`, `used_credits`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 1, '2026-04-22 05:33:05', '2026-04-22 05:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_products`
--

CREATE TABLE `wallet_products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `istatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wallet_products`
--

INSERT INTO `wallet_products` (`pid`, `pname`, `description`, `cost`, `istatus`) VALUES
(1, 'Product-1', ' description for Product 1  description for Product 1  description for Product 1  description for Product 1  description for Product 1  description for Product 1  description for Product 1  description for Product 1 ', 20, 1),
(2, 'Product-2', ' description for Product 2 description for Product 2 description for Product 2 description for Product 2 description for Product 2 description for Product 2 ', 50, 1),
(3, 'Product 3', 'test desciption for product 3 h=goes here test desciption for product 3 h=goes here test desciption for product 3 h=goes here test desciption for product 3 h=goes here test desciption for product 3 h=goes here test desciption for product 3 h=goes here ', 100, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `ad_clicks`
--
ALTER TABLE `ad_clicks`
  ADD PRIMARY KEY (`click_id`);

--
-- Indexes for table `ad_packages`
--
ALTER TABLE `ad_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_revenue_split`
--
ALTER TABLE `ad_revenue_split`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_tasks`
--
ALTER TABLE `ad_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `ad_task_completions`
--
ALTER TABLE `ad_task_completions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyer_ad_slots`
--
ALTER TABLE `buyer_ad_slots`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `discount_offers`
--
ALTER TABLE `discount_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `freepoints`
--
ALTER TABLE `freepoints`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pointspackage`
--
ALTER TABLE `pointspackage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packagename` (`packagename`);

--
-- Indexes for table `pointstransaction`
--
ALTER TABLE `pointstransaction`
  ADD PRIMARY KEY (`transactionid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `mobno` (`mobno`);

--
-- Indexes for table `seller_ad_payments`
--
ALTER TABLE `seller_ad_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcatid`);

--
-- Indexes for table `temporders`
--
ALTER TABLE `temporders`
  ADD UNIQUE KEY `orderid` (`orderid`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usersprofile`
--
ALTER TABLE `usersprofile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_ad_credits`
--
ALTER TABLE `user_ad_credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_products`
--
ALTER TABLE `wallet_products`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ad_clicks`
--
ALTER TABLE `ad_clicks`
  MODIFY `click_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ad_packages`
--
ALTER TABLE `ad_packages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ad_revenue_split`
--
ALTER TABLE `ad_revenue_split`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ad_tasks`
--
ALTER TABLE `ad_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ad_task_completions`
--
ALTER TABLE `ad_task_completions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buyer_ad_slots`
--
ALTER TABLE `buyer_ad_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `discount_offers`
--
ALTER TABLE `discount_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freepoints`
--
ALTER TABLE `freepoints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pointspackage`
--
ALTER TABLE `pointspackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pointstransaction`
--
ALTER TABLE `pointstransaction`
  MODIFY `transactionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=600;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `seller_ad_payments`
--
ALTER TABLE `seller_ad_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usersprofile`
--
ALTER TABLE `usersprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_ad_credits`
--
ALTER TABLE `user_ad_credits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_products`
--
ALTER TABLE `wallet_products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
