-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 24, 2024 at 02:54 PM
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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` varchar(191) DEFAULT '65d48d1874996',
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
(1, '65dc8a541c64f', 1, 1, 'INVASD012024', '{\"company\":\"Zaions\",\"address\":\"lahore, pakistan\",\"company_number\":\"123\",\"vat_number\":\"10\",\"zipcode\":\"54000\",\"country\":\"Pakistan\",\"city\":\"Lahore\"}', '{\"path\":\"uploaded-files\\/iwMsYqn7K0tYbRtlnHCsVn0QKIiaCEXQa98Y74fX.png\",\"url\":\"https:\\/\\/api-v2.nyuk.in\\/storage\\/uploaded-files\\/iwMsYqn7K0tYbRtlnHCsVn0QKIiaCEXQa98Y74fX.png\"}', NULL, NULL, '2323', 1, '[{\"description\":\"asdasd\",\"quantity\":\"123\",\"rate\":\"0232\",\"amount\":28536}]', 'asd', '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', NULL, '{\"value\":\"Bitcoin\",\"label\":\"Bitcoin\",\"symbol\":\"\\u0e3f\"}', 'inv', '28536', '691427.28', 0, NULL, NULL, NULL, '2024-02-26 12:55:48', '2024-03-18 08:55:01'),
(2, '65e841f42c0d4', 1, 1, 'EXPASD022024', '{\"company\":\"Zaions\",\"address\":\"lahore, pakistan\",\"company_number\":\"123\",\"vat_number\":\"10\",\"zipcode\":\"54000\",\"country\":\"Pakistan\",\"city\":\"Lahore\"}', '{\"path\":\"uploaded-files\\/Pm9TVlLnEzuFrOw6lIrCpBsOIZPgD49HPdY8ewnq.jpg\",\"url\":\"https:\\/\\/api-v2.nyuk.in\\/storage\\/uploaded-files\\/Pm9TVlLnEzuFrOw6lIrCpBsOIZPgD49HPdY8ewnq.jpg\"}', '2024-03-20 00:00:00', '2024-03-30 00:00:00', '45450', 1, '[{\"description\":\"dfgdfgdfg\",\"quantity\":\"34531\",\"rate\":\"3450\",\"amount\":119131950},{\"description\":\"dfgdf\",\"quantity\":\"451\",\"rate\":\"450\",\"amount\":202950}]', 'asd\ndfg\ndfg', '\"Account Title: Ahsan Mahmood, Account Email: tester@zaions.com\"', NULL, '{\"value\":\"BAM\",\"label\":\"BAM\",\"symbol\":\"KM\"}', 'exp', '119334900', '11933490045450', 0, NULL, NULL, NULL, '2024-03-06 10:14:12', '2024-03-06 10:14:35'),
(3, '65f0c94dd8dcd', 7, 2, 'INVTES012024', '{\"company\":\"Testcompname\",\"address\":\"Testadd\",\"company_number\":\"123vv23v3\",\"vat_number\":\"324141fff\",\"zipcode\":\"12893712\",\"country\":\"Brunei Darussalam\",\"city\":\"Rott\"}', '{\"path\":\"\",\"url\":\"\"}', '2024-03-13 00:00:00', NULL, '50', 1, '[{\"description\":\"test\",\"quantity\":1,\"rate\":\"2131\",\"amount\":2131}]', 'Note', '\"details\"', NULL, '{\"value\":\"EUR\",\"label\":\"Euro\",\"symbol\":\"\\u20ac\"}', 'inv', '2131', '2181', 0, NULL, NULL, '2024-03-12 21:36:26', '2024-03-12 21:29:49', '2024-03-12 21:36:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_client_id_foreign` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
