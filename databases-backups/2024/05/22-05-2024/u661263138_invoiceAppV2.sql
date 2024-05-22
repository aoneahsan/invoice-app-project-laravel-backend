-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2024 at 08:16 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u661263138_invoiceAppV2`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` varchar(191) DEFAULT '662ea63ee2360',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `company` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `registration_number` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `zipcode` varchar(191) DEFAULT NULL,
  `vat_number` varchar(191) DEFAULT NULL,
  `default_currency` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`default_currency`)),
  `bank_details` varchar(191) DEFAULT NULL,
  `sort_order_no` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `extra_attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_attributes`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `unique_id`, `user_id`, `name`, `email`, `phone_number`, `address`, `company`, `country`, `notes`, `registration_number`, `city`, `zipcode`, `vat_number`, `default_currency`, `bank_details`, `sort_order_no`, `is_active`, `extra_attributes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '662eab46360e0', 1, 'Ahsan Mahmood', 'aoneahsan@gmail.com', NULL, 'Office#F41, 1st Floor, Pakistan Mall, Baghbanpura, GT Road Lahore', 'ahsan', 'Pakistan', 'asd', 'asdasda', 'Lahore', '54000', 'asdasd', '{\"value\":\"Bitcoin\",\"label\":\"Bitcoin\",\"symbol\":\"\\u0e3f\"}', '\"asd\\nasd\\nasd\\nasd\"', 0, 1, NULL, '2024-04-28 20:44:49', '2024-04-28 20:02:14', '2024-04-28 20:44:49'),
(2, '662eb151ad54e', 1, 'Ahsan Mahmood', 'aoneahsan@gmail.com', NULL, 'Office#F41, 1st Floor, Pakistan Mall, Baghbanpura, GT Road Lahore', 'ahsan2', 'Pakistan', NULL, NULL, 'Lahore', '54000', NULL, '{\"value\":\"USDT\",\"label\":\"USDT\",\"symbol\":\"USDT\"}', NULL, 0, 1, NULL, '2024-04-28 20:44:43', '2024-04-28 20:28:01', '2024-04-28 20:44:43'),
(3, '662eb55dbb836', 1, 'Ahsan Mahmood', 'aoneahsan@gmail.com', NULL, 'Office#F41, 1st Floor, Pakistan Mall, Baghbanpura, GT Road Lahore', 'ahsan', 'Pakistan', NULL, '34234234', 'Lahore', '54000', NULL, '{\"value\":\"AFN\",\"label\":\"Afghan afghani\",\"symbol\":\"\\u060b\"}', NULL, 0, 1, NULL, NULL, '2024-04-28 20:45:17', '2024-04-28 20:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` varchar(191) DEFAULT '662ea63ef3fe0',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(191) DEFAULT NULL,
  `user` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`user`)),
  `invoice_logo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`invoice_logo`)),
  `date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `vat_value` varchar(191) DEFAULT NULL,
  `is_invoice_vat_applied` tinyint(1) DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `invoice_notes` text DEFAULT NULL,
  `invoice_bank_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`invoice_bank_details`)),
  `invoice_terms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`invoice_terms`)),
  `selected_currency` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`selected_currency`)),
  `invoice_type` varchar(191) DEFAULT NULL,
  `sub_total` varchar(191) DEFAULT NULL,
  `total` varchar(191) DEFAULT NULL,
  `sort_order_no` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `extra_attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_attributes`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `unique_id`, `user_id`, `client_id`, `invoice_no`, `user`, `invoice_logo`, `date`, `due_date`, `vat_value`, `is_invoice_vat_applied`, `items`, `invoice_notes`, `invoice_bank_details`, `invoice_terms`, `selected_currency`, `invoice_type`, `sub_total`, `total`, `sort_order_no`, `is_active`, `extra_attributes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '662eab559a6bc', 1, 1, 'INVAHS012024', '{\"company\":\"Zaions\",\"address\":\"lahore, pakistan\",\"company_number\":\"123\",\"vat_number\":\"10\",\"zipcode\":\"54000\",\"country\":\"Pakistan\",\"city\":\"Lahore\"}', '{\"path\":\"uploaded-files\\/1714334548_1493.jpeg\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1714334548_1493.jpeg\"}', NULL, NULL, '0', 0, '[]', 'asd', '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', NULL, '{\"value\":\"Bitcoin\",\"label\":\"Bitcoin\",\"symbol\":\"\\u0e3f\"}', 'inv', '0', '0', 0, NULL, NULL, '2024-04-28 20:26:32', '2024-04-28 20:02:29', '2024-04-28 20:26:32'),
(2, '662eab6c49a1a', 1, 1, 'INVAHS022024', '{\"company\":\"Zaions\",\"address\":\"lahore, pakistan\",\"company_number\":\"123\",\"vat_number\":\"10\",\"zipcode\":\"54000\",\"country\":\"Pakistan\",\"city\":\"Lahore\"}', '{\"path\":\"uploaded-files\\/1714334504_3604.png\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1714334504_3604.png\"}', NULL, NULL, '0', 0, '[]', 'asd', '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', NULL, '{\"value\":\"Bitcoin\",\"label\":\"Bitcoin\",\"symbol\":\"\\u0e3f\"}', 'inv', '0', '0', 0, NULL, NULL, '2024-04-28 20:26:36', '2024-04-28 20:02:52', '2024-04-28 20:26:36'),
(3, '662eaed3d0e30', 1, 1, 'EXPAHS032024', '{\"company\":\"Zaions\",\"address\":\"lahore, pakistan\",\"company_number\":\"123\",\"vat_number\":\"10\",\"zipcode\":\"54000\",\"country\":\"Pakistan\",\"city\":\"Lahore\"}', '{\"path\":\"uploaded-files\\/1714334504_3604.png\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1714334504_3604.png\"}', NULL, NULL, '0', 0, '[]', 'asd', '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', NULL, '{\"value\":\"Bitcoin\",\"label\":\"Bitcoin\",\"symbol\":\"\\u0e3f\"}', 'exp', '0', '0', 0, NULL, NULL, '2024-04-28 20:26:47', '2024-04-28 20:17:23', '2024-04-28 20:26:47'),
(4, '662eb62b122ab', 1, 3, 'EXPAHS012024', '{\"company\":\"Zaions\",\"address\":\"lahore, pakistan\",\"company_number\":\"1\",\"vat_number\":\"10\",\"zipcode\":\"54000\",\"country\":\"Pakistan\",\"city\":\"Lahore\"}', '{\"path\":\"uploaded-files\\/1714337250_2180.jpeg\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1714337250_2180.jpeg\"}', NULL, NULL, '20', 1, '[{\"description\":\"1\",\"quantity\":100,\"rate\":100,\"amount\":10000}]', NULL, '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', NULL, '{\"value\":\"AFN\",\"label\":\"Afghan afghani\",\"symbol\":\"\\u060b\"}', 'exp', '10000', '12000', 0, NULL, NULL, NULL, '2024-04-28 20:48:43', '2024-04-28 20:48:43'),
(5, '662eb6577395d', 1, 3, 'EXPAHS022024', '{\"company\":\"Zaions\",\"address\":\"lahore, pakistan\",\"company_number\":\"1\",\"vat_number\":\"10\",\"zipcode\":\"54000\",\"country\":\"Pakistan\",\"city\":\"Lahore\"}', '{\"path\":\"uploaded-files\\/1714337366_6671.jpg\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1714337366_6671.jpg\"}', '2024-04-17 00:00:00', '2024-05-10 00:00:00', '0', 0, '[{\"description\":\"main\",\"quantity\":10,\"rate\":50,\"amount\":500}]', 'jkshdkfhjsdfsdf', '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', NULL, '{\"value\":\"AFN\",\"label\":\"Afghan afghani\",\"symbol\":\"\\u060b\"}', 'exp', '500', '500', 0, NULL, NULL, NULL, '2024-04-28 20:49:27', '2024-04-28 20:49:27'),
(6, '662eb6947fe6f', 1, 3, 'INVAHS012024', '{\"company\":\"Zaions\",\"address\":\"lahore, pakistan\",\"company_number\":\"1\",\"vat_number\":\"10\",\"zipcode\":\"54000\",\"country\":\"Pakistan\",\"city\":\"Lahore\"}', '{\"path\":\"uploaded-files\\/1714337427_3946.png\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1714337427_3946.png\"}', NULL, NULL, '80', 1, '[{\"description\":\"main\",\"quantity\":10,\"rate\":30,\"amount\":300}]', NULL, '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', NULL, '{\"value\":\"USD\",\"label\":\"USD\",\"symbol\":\"$\"}', 'inv', '300', '540', 0, NULL, NULL, NULL, '2024-04-28 20:50:28', '2024-04-28 20:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_22_123359_create_permission_tables', 1),
(6, '2024_01_22_133348_create_clients_table', 1),
(7, '2024_01_22_134623_create_invoices_table', 1),
(8, '2024_01_22_135056_create_user_details_table', 1),
(9, '2024_02_10_083205_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Default\\User', 1),
(2, 'App\\Models\\Default\\User', 2),
(3, 'App\\Models\\Default\\User', 3),
(3, 'App\\Models\\Default\\User', 7),
(3, 'App\\Models\\Default\\User', 8),
(4, 'App\\Models\\Default\\User', 4),
(5, 'App\\Models\\Default\\User', 5),
(6, 'App\\Models\\Default\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'viewAny_role', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(2, 'view_role', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(3, 'create_role', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(4, 'update_role', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(5, 'delete_role', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(6, 'replicate_role', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(7, 'restore_role', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(8, 'forceDelete_role', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(9, 'viewAny_permission', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(10, 'view_permission', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(11, 'create_permission', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(12, 'update_permission', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(13, 'delete_permission', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(14, 'replicate_permission', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(15, 'restore_permission', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(16, 'forceDelete_permission', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(17, 'viewAny_user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(18, 'view_user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(19, 'create_user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(20, 'update_user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(21, 'delete_user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(22, 'replicate_user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(23, 'restore_user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(24, 'forceDelete_user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(25, 'viewAny_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(26, 'view_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(27, 'create_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(28, 'update_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(29, 'delete_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(30, 'download_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(31, 'replicate_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(32, 'restore_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(33, 'forceDelete_invoice', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(34, 'viewAny_client', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(35, 'view_client', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(36, 'create_client', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(37, 'update_client', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(38, 'delete_client', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(39, 'replicate_client', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(40, 'restore_client', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(41, 'forceDelete_client', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(42, 'viewAny_user_detail', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(43, 'view_user_detail', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(44, 'create_user_detail', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(45, 'update_user_detail', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(46, 'delete_user_detail', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(47, 'replicate_user_detail', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(48, 'restore_user_detail', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(49, 'forceDelete_user_detail', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(50, 'can_impersonate', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(51, 'canBe_impersonate', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(4, 'App\\Models\\Default\\User', 1, 'auth', '65e830001f5d7792f9bca5f4d45e14dbaca892afd70d58449af628dc5a687c8f', '[\"*\"]', '2024-05-08 17:01:06', NULL, '2024-04-28 20:44:29', '2024-05-08 17:01:06'),
(5, 'App\\Models\\Default\\User', 7, 'auth', 'fe7b1ea8e48c1de933ad8d2f5bdeaf32e10e111718de47388ab22b085ef6c777', '[\"*\"]', '2024-05-06 12:40:00', NULL, '2024-05-06 12:35:08', '2024-05-06 12:40:00'),
(7, 'App\\Models\\Default\\User', 1, 'auth', 'f7529ddde09f2f9bf9badc87baa3d41abf8f97b751a5ad297b7499900aeeb666', '[\"*\"]', '2024-05-22 06:03:11', NULL, '2024-05-11 16:30:55', '2024-05-22 06:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superAdmin', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(2, 'admin', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(3, 'user', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(4, 'buyer', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(5, 'seller', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(6, 'buyerSeller', 'web', '2024-04-28 14:40:47', '2024-04-28 14:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(16, 1),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(24, 1),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(26, 3),
(27, 1),
(27, 2),
(27, 3),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(29, 2),
(29, 3),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(31, 3),
(32, 1),
(33, 1),
(34, 1),
(34, 2),
(34, 3),
(35, 1),
(35, 2),
(35, 3),
(36, 1),
(36, 2),
(36, 3),
(37, 1),
(37, 2),
(37, 3),
(38, 1),
(38, 2),
(38, 3),
(39, 1),
(39, 2),
(39, 3),
(40, 1),
(41, 1),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(49, 1),
(50, 1),
(50, 2),
(50, 3),
(51, 2),
(51, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` varchar(191) DEFAULT '662ea63e33e14',
  `username` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `country_code` varchar(191) DEFAULT NULL,
  `country_code_text` varchar(191) DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `profile_publicly_visible` varchar(191) DEFAULT 'visible',
  `profile_photo_path` text DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `company` varchar(191) DEFAULT NULL,
  `registration_number` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `zipcode` varchar(191) DEFAULT NULL,
  `vat_number` varchar(191) DEFAULT NULL,
  `default_currency` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`default_currency`)),
  `logo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`logo`)),
  `notes` varchar(191) DEFAULT NULL,
  `bank_details` varchar(191) DEFAULT NULL,
  `onboarding_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`onboarding_details`)),
  `otp_code` varchar(191) DEFAULT NULL,
  `otp_code_valid_till` varchar(191) DEFAULT NULL,
  `can_reset_password` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `extra_attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_attributes`)),
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `username`, `name`, `email`, `email_verified_at`, `password`, `phone_number`, `country_code`, `country_code_text`, `location`, `profile_publicly_visible`, `profile_photo_path`, `address`, `country`, `state`, `company`, `registration_number`, `city`, `zipcode`, `vat_number`, `default_currency`, `logo`, `notes`, `bank_details`, `onboarding_details`, `otp_code`, `otp_code_valid_till`, `can_reset_password`, `is_active`, `extra_attributes`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '662ea63f5adcd', 'aoneahsan', 'Ahsan Mahmood', 'tester@zaions.com', '2024-04-28 14:40:47', '$2y$12$dYb8iOlUErVfhop85k9mTePZ68F/reK1NFzaTIghPe9uUW7RQdV62', '03046619706', '92', 'pk', 'lahore, pakistan', 'visible', NULL, 'lahore, pakistan', 'Pakistan', 'Asia', 'Zaions', '1', 'Lahore', '54000', '10', '{\"value\":\"ALL\",\"label\":\"Albanian lek\",\"symbol\":\"L\"}', '{\"path\":\"uploaded-files\\/1714337250_2180.jpeg\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1714337250_2180.jpeg\"}', 'Thanks for your business.', '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', '{\"currency\":true}', NULL, NULL, 0, 1, NULL, NULL, NULL, '2024-04-28 14:40:47', '2024-04-28 20:47:31'),
(2, '662ea63f9b3d1', 'admin', 'Admin', 'admin@gmail.com', '2024-04-28 14:40:47', '$2y$12$AiWAVVJf/GbOkxzzvU4K4uFrO1Z7TVZWuc.Deeif/lGDdoYvJBE5.', '03046619706', '92', 'pk', 'lahore, pakistan', 'visible', NULL, 'lahore, pakistan', 'Pakistan', 'Asia', 'Zaions', '123', 'Lahore', '54000', '10', '\"USD\"', NULL, 'Thanks for your business.', '\"Account Title: admin, Account Email: admin@gmail.com\"', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2024-04-28 14:40:47', '2024-04-28 14:40:47'),
(3, '662ea63fe5764', 'user', 'User', 'user@gmail.com', '2024-04-28 14:40:48', '$2y$12$ENJ.s.qTERN6I2MANPfWAOFs2X9B13bq7Or.R5FVnWho9jEhrDUkK', '03046619706', '92', 'pk', 'lahore, pakistan', 'visible', NULL, 'lahore, pakistan', 'Pakistan', 'Asia', 'Zaions', '123', 'Lahore', '54000', '10', '\"USD\"', NULL, 'Thanks for your business.', '\"Account Title: user, Account Email: user@gmail.com\"', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2024-04-28 14:40:48', '2024-04-28 14:40:48'),
(4, '662ea6402f949', 'buyer', 'Buyer', 'buyer@gmail.com', '2024-04-28 14:40:48', '$2y$12$dG/yrx7PIqK7trFeNGJ3g.B6iU0N/Kr2d6QRqUYUMu91U8/sQNnZG', '03046619706', '92', 'pk', 'lahore, pakistan', 'visible', NULL, 'lahore, pakistan', 'Pakistan', 'Asia', 'Zaions', '123', 'Lahore', '54000', '10', '\"USD\"', NULL, 'Thanks for your business.', '\"Account Title: buyer, Account Email: buyer@gmail.com\"', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2024-04-28 14:40:48', '2024-04-28 14:40:48'),
(5, '662ea64068be7', 'seller', 'Seller', 'seller@gmail.com', '2024-04-28 14:40:48', '$2y$12$TswSNa36Okvakql32.SWb.xoXaciiHbEbaokLVskCeJOqf1L7YvzK', '03046619706', '92', 'pk', 'lahore, pakistan', 'visible', NULL, 'lahore, pakistan', 'Pakistan', 'Asia', 'Zaions', '123', 'Lahore', '54000', '10', '\"USD\"', NULL, 'Thanks for your business.', '\"Account Title: seller, Account Email: seller@gmail.com\"', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2024-04-28 14:40:48', '2024-04-28 14:40:48'),
(6, '662ea640a45ab', 'buyerSeller', 'BuyerSeller', 'buyerSeller@gmail.com', '2024-04-28 14:40:48', '$2y$12$Buf3D33/dfFFUp7BWPMokevYR7aWrUF.YTWwPX3s1h96UdYZDLGmS', '03046619706', '92', 'pk', 'lahore, pakistan', 'visible', NULL, 'lahore, pakistan', 'Pakistan', 'Asia', 'Zaions', '123', 'Lahore', '54000', '10', '\"USD\"', NULL, 'Thanks for your business.', '\"Account Title: buyerSeller, Account Email: buyerSeller@gmail.com\"', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, '2024-04-28 14:40:48', '2024-04-28 14:40:48'),
(7, '6638ce7c5a524', NULL, NULL, 'hi@donouwens.com', NULL, '$2y$12$seianeNoL/OXm4sfhzGDhOrlWh.eEMxWDR4nhDLyS3ArZxkdyItAK', NULL, NULL, NULL, NULL, 'visible', NULL, 'Perkūnkiemio g. 13-91', 'Lithuania', NULL, 'MB Dodoma', '304485059', 'Vilnius', 'LT-12114', 'LT100012830516', '{\"value\":\"EUR\",\"label\":\"Euro\",\"symbol\":\"\\u20ac\"}', '{\"path\":\"uploaded-files\\/1714999020_5911.png\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1714999020_5911.png\"}', NULL, NULL, '{\"register\":true,\"profile\":true,\"currency\":true,\"bank_details\":false}', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2024-05-06 12:35:08', '2024-05-06 12:37:00'),
(8, '663a447ce8ec7', NULL, NULL, 'talha-test-1@yopmail.com', NULL, '$2y$12$pYS8VN6/VxqTp/XM.0ODr.Nfy2F5k2/jTuchjN.lvhZ/eIvwMubbC', NULL, NULL, NULL, NULL, 'visible', NULL, 'Zia Colony', 'Pakistan', NULL, 'personal updated', '030000000000', 'sdf', '54000', '10', '{\"value\":\"PKR\",\"label\":\"Pakistani rupee\",\"symbol\":\"\\u20a8\"}', '{\"path\":\"uploaded-files\\/1715094691_1585.jpg\",\"url\":\"https:\\/\\/invoice-app-v2.s3.eu-north-1.amazonaws.com\\/uploaded-files\\/1715094691_1585.jpg\"}', NULL, '\"ghhggjj\"', '{\"register\":true,\"profile\":true,\"currency\":true,\"bank_details\":true}', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2024-05-07 15:10:53', '2024-05-07 15:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` varchar(191) DEFAULT '662ea63f232a4',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_intro` varchar(191) DEFAULT NULL,
  `user_description` text DEFAULT NULL,
  `user_average_response_time` varchar(191) DEFAULT NULL,
  `user_languages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`user_languages`)),
  `user_skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`user_skills`)),
  `user_education` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`user_education`)),
  `cnic` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `cnic_front` varchar(191) DEFAULT NULL,
  `cnic_back` varchar(191) DEFAULT NULL,
  `facebook_link` varchar(191) DEFAULT NULL,
  `linkedin_link` varchar(191) DEFAULT NULL,
  `twitter_link` varchar(191) DEFAULT NULL,
  `github_link` varchar(191) DEFAULT NULL,
  `sort_order_no` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `extra_attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_attributes`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_client_id_foreign` (`client_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
