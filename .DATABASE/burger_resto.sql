-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2023 at 02:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `burger_resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `dtail_pesanan`
--

CREATE TABLE `dtail_pesanan` (
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('proses','done') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dtail_pesanan`
--

INSERT INTO `dtail_pesanan` (`pesanan_id`, `menu_id`, `jumlah`, `status`, `created_at`, `updated_at`, `id`) VALUES
(28, 3, 2, 'proses', '2023-02-11 04:41:17', '2023-02-11 04:41:17', 16),
(28, 13, 1, 'proses', '2023-02-11 04:41:17', '2023-02-11 04:41:17', 17),
(29, 12, 3, 'proses', '2023-02-11 05:04:44', '2023-02-11 05:04:44', 18),
(29, 13, 2, 'proses', '2023-02-11 05:04:44', '2023-02-11 05:04:44', 19);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Burger', '2023-01-17 17:21:27', '2023-01-17 17:50:47'),
(3, 'Minuman', '2023-01-17 17:55:13', '2023-01-17 17:55:13'),
(4, 'Kebab', '2023-01-18 15:41:27', '2023-01-18 15:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `status` enum('ready','used') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_meja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`status`, `created_at`, `updated_at`, `id`, `nomor_meja`) VALUES
('ready', '2023-01-31 17:30:24', '2023-02-11 05:05:01', 1, 1),
('used', '2023-01-31 17:30:37', '2023-02-11 04:41:17', 2, 2),
('used', '2023-01-31 17:30:40', '2023-02-11 05:04:44', 3, 3),
('ready', '2023-01-31 17:30:43', '2023-02-11 05:05:05', 4, 4),
('ready', '2023-01-31 17:30:46', '2023-02-11 05:05:11', 5, 5),
('ready', '2023-01-31 17:30:51', '2023-01-31 17:30:51', 6, 6),
('ready', '2023-01-31 17:30:55', '2023-01-31 17:30:55', 7, 7),
('ready', '2023-01-31 17:30:57', '2023-02-05 04:23:12', 8, 8),
('ready', '2023-01-31 17:31:03', '2023-02-05 04:24:12', 9, 9),
('ready', '2023-01-31 17:31:09', '2023-02-11 05:05:16', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` double(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` enum('ready','sold') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `kategori_id`, `gambar`, `harga`, `stok`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Chicken Burger', 3, 'BurgerAyam.jpg', 25000.00, 22, 'ready', '2023-01-18 18:19:46', '2023-02-11 04:41:17'),
(9, 'Double Beef Burger', 1, 'Double Burger.jpeg', 35000.00, 8, 'ready', '2023-01-29 21:37:59', '2023-02-05 05:36:23'),
(12, 'Kebab Beef', 4, 'KebabBeef.jpg', 42000.00, 29, 'ready', '2023-01-30 15:44:24', '2023-02-11 05:04:44'),
(13, 'Coke', 3, 'Coke.jpg', 12000.00, 54, 'ready', '2023-01-30 15:50:54', '2023-02-11 05:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_16_050826_meja', 2),
(6, '2023_01_16_052612_meja', 3),
(7, '2023_01_16_053752_buku', 4),
(8, '2023_01_16_235348_meja', 5),
(9, '2023_01_16_235447_pesanan', 6),
(10, '2023_01_17_001027_kategori', 7),
(11, '2023_01_17_001538_menu', 8),
(12, '2023_01_17_002845_dtail_pesanan', 9),
(13, '2023_01_17_003527_pembayaran', 10),
(14, '2023_01_18_011648_update_kategori', 11),
(15, '2023_01_18_012204_update_menu', 12),
(16, '2023_01_18_012413_update_pembayaran', 13),
(17, '2023_02_01_002900_update_meja', 14),
(18, '2023_02_01_005631_update_meja2', 15),
(19, '2023_02_01_012103_update_meja2', 16),
(20, '2023_02_02_015035_detail_pesanan_update', 17),
(21, '2023_02_05_112430_update_detail_pesanan', 18),
(22, '2023_02_05_130446_update_detail_pesanan', 19);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `total_harga` double(10,2) NOT NULL,
  `status` enum('unpaid','paid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pesanan_id`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 28, 62000.00, 'unpaid', '2023-02-11 04:41:17', '2023-02-11 05:10:56'),
(2, 29, 150000.00, 'unpaid', '2023-02-11 05:04:44', '2023-02-11 05:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `meja_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `user_id`, `meja_id`, `created_at`, `updated_at`) VALUES
(28, 1, 2, '2023-02-11 04:41:17', '2023-02-11 04:41:17'),
(29, 1, 3, '2023-02-11 05:04:44', '2023-02-11 05:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kasir','pegawai','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `hp`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'haikal252005@gmail.com', '082254953452', 'admin', NULL, '$2y$10$tZ2KJRoVA2Mh6uaQ6Ypy2.G8VBJfh3P9n/MnWQuD1qoLmWr8E1ESO', NULL, '2023-01-03 18:48:34', '2023-01-09 06:09:02'),
(4, 'kasir1', 'kasir@gmail.com', '7654322345', 'kasir', NULL, '$2y$10$NY.Uc5/y7C//LN/W.cOD2egoc.Y2CtjtirIQ4YJdKuyQaBMKh5HE2', NULL, '2023-01-05 16:55:42', '2023-01-05 16:55:42'),
(6, 'pegawai', 'pegawai@gmail.com', '54334542', 'pegawai', NULL, '$2y$10$DqnFmkUfRPOc4MCyIVwYWOsgMkPdfi2ZpXYJOC0i79LaS3n26D6f2', NULL, '2023-01-05 16:56:44', '2023-01-05 16:56:44'),
(9, 'pegawai2', 'pegawai2@gmail.com', '7654322345', 'pegawai', NULL, '$2y$10$4owYjlg1jrRjJ.BBwPjd8OeUFuquSEMF0xwUsMRh1dEbXHAc//PHK', NULL, '2023-01-08 05:12:27', '2023-01-08 05:12:27'),
(13, 'pegawai 3', 'pegawai3@gmail.com', '542635452', 'pegawai', NULL, '$2y$10$pScZlHrfXGw4eFHhIfg8Aeb65M4CZRhCrQ8UmjA9oiUxyFjSAmmHa', NULL, '2023-01-10 04:39:15', '2023-01-10 04:39:15'),
(15, 'pegawai 4', 'pegawai4@gmail.com', '54241323129', 'pegawai', NULL, '$2y$10$cA8d447BNGpGr4gtyb0Ns.0PYYIpxdKpmNz4MeMa03NSC6650Yeh6', NULL, '2023-01-16 17:19:27', '2023-01-17 16:19:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dtail_pesanan`
--
ALTER TABLE `dtail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dtail_pesanan_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `dtail_pesanan_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_pesanan_id_foreign` (`pesanan_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_user_id_foreign` (`user_id`),
  ADD KEY `meja_id` (`meja_id`);

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
-- AUTO_INCREMENT for table `dtail_pesanan`
--
ALTER TABLE `dtail_pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dtail_pesanan`
--
ALTER TABLE `dtail_pesanan`
  ADD CONSTRAINT `dtail_pesanan_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dtail_pesanan_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`meja_id`) REFERENCES `meja` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
