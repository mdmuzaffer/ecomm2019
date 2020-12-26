-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2020 at 04:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomm2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `mobile`, `email`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '7896541235', 'admin@gmail.com', NULL, '$2y$10$TKTQy2s4nH30UtE7wy6BeuI7TFcuK8c687zg6tXY2QTcaOO18Bme6', 'NULL', 1, NULL, NULL, NULL),
(2, 'Muzaffer', 'admin', '8546784512', 'muzaffer@gmail.com', NULL, '$2y$10$Z6FNaveMc6aw/DqFBDrMiOU4d175yl4UaLdTeTMluDo13LjKK6Mo6', 'NULL', 1, NULL, NULL, NULL),
(3, 'shazidh', 'subadmin', '8789456910', 'shazidh@gmail.com', NULL, '$2y$10$Z6FNaveMc6aw/DqFBDrMiOU4d175yl4UaLdTeTMluDo13LjKK6Mo6', 'NULL', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arrow', 1, NULL, NULL),
(2, 'Gap', 1, NULL, NULL),
(3, 'Lee', 1, NULL, '2020-12-15 11:13:59'),
(4, 'Moment Carlo', 1, NULL, NULL),
(5, 'Peter England', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_discount` double(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'T-shirt', 'Null', 0.00, 'this is the category description', 't-shirt', 'Null', 'Null', 'Null', 1, '2020-11-15 22:11:09', '2020-11-15 22:11:09'),
(2, 1, 1, 'Casual-T-shirt', 'Null', 0.00, 'this is the causal category description', 'casual-t-shirt', 'Null', 'Null', 'Null', 1, '2020-11-15 22:11:09', '2020-11-15 22:11:09'),
(3, 0, 3, 'Kids pant', '1605458908.jpg', 15.00, 'Test description', 'Test-1', 'Test title', 'Test description', 'Test keyword', 1, '2020-11-15 16:45:18', '2020-11-15 16:48:29'),
(4, 0, 1, 'Shirts', '1605941930.jpg', 12.00, 'Shirts', 'casual  shirts', 'Casual shirts', 'Casual T-shirts', 'Casual shirts', 1, '2020-11-17 04:56:47', '2020-11-21 06:58:51'),
(5, 0, 2, 'Kurti', '1608232774.jpeg', 10.00, 'Test', '/kurti', 'Test', 'Test', 'Test', 1, '2020-12-17 19:19:34', '2020-12-17 19:19:34'),
(6, 0, 2, 'girls jeans', '1608317676.jpeg', 12.00, 'Test category', '/jeans', 'Test category', 'Test category', 'Test category', 1, '2020-12-18 18:54:36', '2020-12-18 18:54:36'),
(7, 6, 2, 'Jeans casual', '1608317805.jpeg', 10.00, 'test', '/jeans-casual', 'Test category', 'Test category', 'Test category', 1, '2020-12-18 18:56:46', '2020-12-18 20:13:28'),
(8, 5, 2, 'Kurti formal', '1608318102.jpeg', 5.00, 'Test category of kurti', '/kurti-formal', 'Test category of kurti', 'Test category of kurti', 'Test category of kurti', 1, '2020-12-18 19:01:42', '2020-12-18 20:13:32'),
(9, 5, 2, 'testa', '1608318495.jpeg', 5.00, 'Test category of test', '/kurti-test', 'Test category of test', 'Test category of kurti', 'Test category of test', 1, '2020-12-18 19:03:57', '2020-12-18 19:08:15'),
(10, 3, 3, 'jeans', '1608318622.jpeg', 10.00, 'Test kid jeans', '/kid-jeans', 'Test kid jeans', 'Test kid jeans', 'Test kid jeans', 1, '2020-12-18 19:10:22', '2020-12-18 19:10:22'),
(11, 0, 3, 'T-shirt', '1608318758.jpeg', 5.00, 'T-shirt', '/kid-t-shirt', 'T-shirt', 'T-shirt', 'T-shirt', 1, '2020-12-18 19:12:38', '2020-12-18 19:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2020_02_26_183400_create_admins_table', 1),
(11, '2020_04_19_104259_create_sections_table', 1),
(12, '2020_04_25_091234_create_categories_table', 1),
(15, '2020_11_16_170952_create_products_table', 2),
(16, '2020_12_05_105741_create_products_attributes_table', 3),
(17, '2020_12_12_065234_create_products_images_table', 4),
(18, '2020_12_13_095817_create_brands_table', 5),
(19, '2020_12_15_172241_add_brand_id_to_products', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(8,2) DEFAULT NULL,
  `product_discount` int(25) NOT NULL,
  `product_weight` int(25) NOT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wash_care` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fabric` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pattern` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sleeve` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occasion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `section_id`, `brand_id`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_video`, `main_image`, `description`, `wash_care`, `fabric`, `pattern`, `sleeve`, `fit`, `occasion`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'Blue Casual T-shirt', 'BT001', 'Blue', 1500.00, 10, 200, '1607754955.mp4', '1607754954.jpeg', 'Test Product', 'Test', 'Polyester', 'Printed', 'Short Sleeve', 'Fit', 'Formal', 'Test', 'Test', 'Test 2', 'Yes', 1, NULL, '2020-12-12 01:05:55'),
(2, 4, 1, 3, 'Red CasualT-shirt', 'R001', 'Red', 2000.00, 10, 200, '1608365584.mp4', '1608365583.jpeg', 'Test Product', 'NO', 'Cotton', 'Plain', 'Full Sleeve', 'Regular', 'Casual', 'Test 1', 'Test 1', 'Test 1', 'Yes', 1, NULL, '2020-12-19 02:43:04'),
(11, 1, 1, 0, 'Tes-demo', 'Htn789', 'HTn23', 52.00, 12, 452, '1607802325.mp4', '1607802324.jpeg', 'this is test description', 'Raman', 'Polyester', 'Printed', 'Half Sleeve', 'Regular', 'Formal', 'Test', 'Test', 'Test', 'Yes', 1, '2020-11-28 10:39:54', '2020-12-12 14:15:25'),
(19, 5, 2, 4, 'Girls Kurti', 'GSK001', '#000', 700.00, 10, 500, '1608367224.mp4', '1608367224.jpeg', 'Girls kurti', 'Yes', 'Cotton', 'Checked', 'Full Sleeve', 'Regular', 'Casual', 'Test', 'Test', 'Test', 'Yes', 1, '2020-12-19 03:10:24', '2020-12-19 03:10:24'),
(20, 10, 3, 3, 'Kid jean', 'KIDJ001', '#000', 400.00, 5, 200, '1608367490.mp4', '1608367490.jpeg', 'Test kid jeans', 'Yes', 'Polyester', 'Plain', 'Half Sleeve', 'Regular', 'Casual', 'Test jeans', 'Test jeans', 'Test jeans', 'Yes', 1, '2020-12-19 03:14:50', '2020-12-19 03:14:50'),
(21, 4, 1, 3, 'Casual shirt', 'CUS001', 'White', 450.00, 5, 200, '1608480883.mp4', '1608480882.jpeg', 'Test', 'NO', 'Cotton', 'Plain', 'Full Sleeve', 'Slim', 'Casual', 'Test', 'Test', 'Test', 'Yes', 1, '2020-12-20 10:44:44', '2020-12-20 10:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', 1100.00, 150, 'BCT01-S', 1, '2020-12-10 12:36:10', '2020-12-10 13:42:52'),
(2, 1, 'Medium', 1200.00, 200, 'BCT01-M', 1, '2020-12-10 12:36:11', '2020-12-19 02:45:16'),
(4, 1, 'Large', 1400.00, 20, 'BCT01-L', 1, '2020-12-10 14:04:14', '2020-12-10 14:04:14'),
(5, 2, 'Small', 2000.00, 10, 'R001-S', 1, '2020-12-19 02:44:49', '2020-12-19 02:44:49'),
(6, 2, 'Medium', 2200.00, 15, 'R001-M', 1, '2020-12-19 02:44:49', '2020-12-19 02:44:49'),
(7, 2, 'Large', 2100.00, 20, 'R001-L', 1, '2020-12-19 02:44:49', '2020-12-19 02:44:49'),
(8, 11, 'Small', 200.00, 25, 'Htn789-S', 1, '2020-12-19 02:46:43', '2020-12-19 02:46:43'),
(9, 11, 'Medium', 250.00, 20, 'Htn789-M', 1, '2020-12-19 02:46:43', '2020-12-19 02:46:43'),
(10, 11, 'Large', 300.00, 15, 'Htn789-L', 1, '2020-12-19 02:46:43', '2020-12-19 02:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '79261607852986.jpeg', 1, '2020-12-13 04:19:46', '2020-12-13 04:19:46'),
(2, 2, '52461607852986.jpeg', 1, '2020-12-13 04:19:46', '2020-12-13 04:19:46'),
(4, 1, '9661607853075.jpeg', 1, '2020-12-13 04:21:16', '2020-12-13 04:21:16'),
(5, 1, '91461607853076.jpeg', 1, '2020-12-13 04:21:16', '2020-12-13 04:21:16'),
(6, 1, '60121607853076.jpeg', 1, '2020-12-13 04:21:16', '2020-12-13 04:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Man', 1, NULL, NULL),
(2, 'Woman', 1, NULL, NULL),
(3, 'Kids', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$TKTQy2s4nH30UtE7wy6BeuI7TFcuK8c687zg6tXY2QTcaOO18Bme6', 'nNUm9Bwn0OdNo3QJooJzVhmlUGyPAMpYKP9fy42iMwDcK65QEITu9MYOJwoV', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
