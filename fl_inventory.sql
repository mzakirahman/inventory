-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2023 at 11:05 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fl_inventory`
--

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
-- Table structure for table `item_keluar`
--

CREATE TABLE `item_keluar` (
  `id_item` int(10) UNSIGNED NOT NULL,
  `id_transaksi` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vocab_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uom` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `order_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaks` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_keluar`
--

INSERT INTO `item_keluar` (`id_item`, `id_transaksi`, `vocab_number`, `uom`, `qty`, `order_no`, `remaks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, '6', '1', 'EA', 3, 'PO19212', 'Completed', '2023-05-10 15:43:54', '2023-05-10 14:19:38', '2023-05-10 15:43:54'),
(6, '6', '1', 'EA', 3, 'PO19212', 'Completed', '2023-05-10 15:44:37', '2023-05-10 15:44:23', '2023-05-10 15:44:37'),
(7, '6', '1', 'EA', 3, 'PO19212', 'Completed', '2023-05-15 23:12:25', '2023-05-10 15:44:52', '2023-05-15 23:12:25'),
(8, '6', '3', 'EA', 16, NULL, NULL, NULL, '2023-05-10 15:45:06', '2023-05-10 15:45:06'),
(9, '7', '1', 'EA', 10, 'Po3455', 'completed', NULL, '2023-05-14 19:46:13', '2023-05-14 19:46:13'),
(10, '8', '1', 'EA', 10, 'Po3488', 'completed', NULL, '2023-05-15 23:14:48', '2023-05-15 23:14:48'),
(11, '9', '6', 'drm', 5, '665', 'compleks', NULL, '2023-07-27 08:26:06', '2023-07-27 08:26:06'),
(12, '10', '6', '1', 1, '1', '1', NULL, '2023-07-27 09:12:52', '2023-07-27 09:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `item_masuk`
--

CREATE TABLE `item_masuk` (
  `id_item` int(10) UNSIGNED NOT NULL,
  `id_transaksi` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `po_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_stok` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uoi` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `on_hand` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_max` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin_loc` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_loc` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_masuk`
--

INSERT INTO `item_masuk` (`id_item`, `id_transaksi`, `po_number`, `id_stok`, `uoi`, `on_hand`, `received`, `balance`, `min_max`, `bin_loc`, `doc_loc`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1', '1222', '3', 'uoiii', '6', '120', '120', 'minmaxxx', NULL, NULL, 'completed', NULL, '2023-05-12 14:44:32', '2023-05-12 16:22:55'),
(2, '1', '1312', '1', 'uoiii', '120', '120', '120', 'mm', 'bl', 'dl', 'completed', NULL, '2023-05-12 15:49:22', '2023-05-12 16:22:40'),
(3, '3', 'tes', '3', NULL, '1', '1', '1', NULL, NULL, NULL, NULL, '2023-05-14 19:41:49', '2023-05-14 19:41:43', '2023-05-14 19:41:49'),
(4, '3', '1545', '3', 'drm', '0', '8', '8', 'po111', 'fo7', 'dws/dc/viii/2023', 'compleks', NULL, '2023-05-15 22:34:18', '2023-05-15 22:34:18'),
(5, '3', '4578', '1', 'set', '0', '6', '6', 'pol', 'fo9', 'dws/dc/frte/2023', 'compleks', NULL, '2023-05-15 22:41:27', '2023-05-15 22:41:27'),
(6, '4', '1', '3', '1', '1', '1', '1', '1', '1', '1', '1', NULL, '2023-05-15 22:55:10', '2023-05-15 22:55:10'),
(7, '5', 'Po2 1545', '6', 'drm', '0', '5', '5', 'pooll', 'fo7', 'dc 34', 'compleks', NULL, '2023-07-25 19:59:03', '2023-07-25 19:59:03'),
(8, '6', 'Po2 1545', '7', 'drm', '0', '10', '10', 'pooll', 'fo7', 'dc 34', 'compleks', NULL, '2023-07-27 08:22:11', '2023-07-27 08:22:11'),
(9, '7', NULL, '7', 'drm', '0', '10', '10', 'pooll', 'fo7', NULL, 'compleks', NULL, '2023-07-28 01:40:20', '2023-07-28 01:40:20'),
(10, '7', '2', '8', '1', '1', '2', '3', '1', 'adsad', '1', '1', NULL, '2023-07-31 18:25:00', '2023-07-31 18:25:00');

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
(4, '2023_05_06_004724_create_supliers_table', 1),
(7, '2023_05_06_004934_create_stoks_table', 2),
(8, '2023_05_09_204428_create_transaksi_keluar_table', 3),
(10, '2023_05_09_205119_create_item_keluar_tabel', 4),
(12, '2023_05_11_211920_create_transaksi_masuk_tabel', 6),
(13, '2023_05_11_211818_create_item_masuk_tabel', 7);

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
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(10) UNSIGNED NOT NULL,
  `stock_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `qoh` int(11) NOT NULL,
  `unit_value` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_value` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bin_loc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `stock_code`, `description`, `qoh`, `unit_value`, `total_value`, `location`, `bin_loc`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '031300130', 'Milbio, Biocide: S GAL/CAN', 82, '200', '', 'KRU', 'D21TOPBOX3', NULL, '2023-05-07 11:07:49', '2023-07-25 19:23:12'),
(2, 'tes', 'tes', 13, '200', NULL, 'ew', 'ddf', '2023-05-07 12:37:00', '2023-05-07 11:09:39', '2023-05-07 12:37:00'),
(3, '031300160', 'Calcium Hydroxide (CA(OH)2): 25 KG/SAK; Lime', 1517, '200', NULL, 'KRU', 'D21HFLR', NULL, '2023-05-10 12:42:32', '2023-07-25 22:46:16'),
(4, '031300150', 'Aquacol -D', 4, '200000', '2.000.000', 'KRU', 'D21HFLR', NULL, '2023-05-14 04:49:27', '2023-05-14 18:42:33'),
(5, '2348349', 'galon', 5, '500', '5000000', 'kru', 'b10', '2023-07-10 08:19:38', '2023-07-10 07:56:56', '2023-07-10 08:19:38'),
(6, '456923', 'oli', 5, '100', '1000000', 'kru', 'D5', '2023-07-30 11:00:23', '2023-07-25 19:20:28', '2023-07-30 11:00:23'),
(7, '2345666', 'minyak', 30, '100', '1000000', 'kru', 'fo9', '2023-07-30 11:07:20', '2023-07-26 01:34:38', '2023-07-30 11:07:20'),
(8, '1asd', '2dasda', 3, '12', NULL, '1', 'adsad', NULL, '2023-07-30 19:48:44', '2023-07-31 18:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id_suplier` int(10) UNSIGNED NOT NULL,
  `nama_suplier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `nama_suplier`, `alamat`, `telepon`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'PT Vadhana', 'Jl.Soekarno Hatta', '082292920012', NULL, '2023-05-07 05:13:15', '2023-05-07 05:13:15'),
(6, 'PT Rifansi', 'Jalan Belimbing', '08126672121', NULL, '2023-05-07 05:13:30', '2023-05-07 12:35:21'),
(7, 'aa', 'sd', 'sss', '2023-05-07 10:33:30', '2023-05-07 10:33:26', '2023-05-07 10:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_keluar`
--

CREATE TABLE `transaksi_keluar` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `from` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vessel` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etd` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eta` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vogaye` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignor_empl` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignor_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignor_date` date DEFAULT NULL,
  `consignee_empl` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignee_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignee_date` date DEFAULT NULL,
  `stock_card_empl` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_card_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_card_date` date DEFAULT NULL,
  `mmis_empl` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mmis_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mmis_date` date DEFAULT NULL,
  `consignor_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignee_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_card_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mmis_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_keluar`
--

INSERT INTO `transaksi_keluar` (`id_transaksi`, `from`, `to`, `company`, `serial`, `vessel`, `etd`, `eta`, `vogaye`, `consignor_empl`, `consignor_name`, `consignor_date`, `consignee_empl`, `consignee_name`, `consignee_date`, `stock_card_empl`, `stock_card_name`, `stock_card_date`, `mmis_empl`, `mmis_name`, `mmis_date`, `consignor_signature`, `consignee_signature`, `stock_card_signature`, `mmis_signature`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'KRU Warehouse', 'To Facon', 'Baker Hughes', '42346', '-', '-', '-', '-', '1800116', 'Sugiarto', '2022-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-25 22:46:16', '2023-05-09 14:45:55', '2023-07-25 22:46:16'),
(7, 'KRU WAREHOSE', 'MELIBUR', NULL, '34567', NULL, NULL, NULL, NULL, '1800116', 'SUGIARTO', '2023-05-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-15 22:28:57', '2023-05-14 19:21:15', '2023-05-15 22:28:57'),
(8, 'KRU WAREHOSE', 'pedas', 'PT ITA', '3435', 'KAPAL', '10.20', '16.00', '1  HARI', '2324', 'sugiarto', '2023-07-27', NULL, NULL, '2023-07-27', NULL, NULL, NULL, NULL, NULL, NULL, 'files/ttd/img_20230727153134_6451.jpg', NULL, NULL, NULL, NULL, '2023-05-15 23:14:20', '2023-07-27 09:14:50'),
(9, 'kru warehouse', 'TB', 'PT ITA', '234', 'KAPAL', '11.00', '16.00', NULL, '2324', 'sugiarto', '2023-07-27', 'a', 'sugiarto', '2023-07-27', 's', NULL, NULL, 'd', NULL, NULL, 'tes1', 'tes11', 'tes111', 'tes111', NULL, '2023-07-27 08:24:52', '2023-08-07 18:41:14'),
(10, '1', '2', '1', '1', '1', '1', '1', '1', 'Tes', 'Tes', '2023-07-27', '1', '1', '2023-07-27', '1', '1', '2023-07-27', '1', '1', '2023-07-27', 'files/ttd/img_20230727161211_3142.jpg', 'files/ttd/img_20230727161339_5200.jpg', 'files/ttd/img_20230727161339_1229.jpg', 'files/ttd/img_20230727161339_8102.jpg', '2023-07-30 08:36:02', '2023-07-27 09:10:11', '2023-07-30 08:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_masuk`
--

CREATE TABLE `transaksi_masuk` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_transaksi` date NOT NULL,
  `receiving_from` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carried_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `receiving_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiving_position` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiving_empl` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiving_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_position` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_empl` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_position` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_empl` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_date` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiving_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_signature` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi_masuk`
--

INSERT INTO `transaksi_masuk` (`id_transaksi`, `no`, `date_transaksi`, `receiving_from`, `carried_by`, `checked_by`, `position`, `date`, `receiving_name`, `receiving_position`, `receiving_empl`, `receiving_date`, `inventory_name`, `inventory_position`, `inventory_empl`, `inventory_date`, `record_name`, `record_position`, `record_empl`, `record_date`, `receiving_signature`, `inventory_signature`, `record_signature`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'GW 20844', '2023-05-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-11 15:40:30', '2023-05-12 14:34:35'),
(2, '031300150', '2023-05-02', NULL, '-', 'sugiarto', 'mria', '2023-05-03', 'junidi', 'mria', '1800091', '2023-05-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-25 23:07:10', '2023-05-14 18:48:01', '2023-07-25 23:07:10'),
(3, '1', '2023-05-09', NULL, '-', '-', 'mria', '2023-05-16', 'junaidi', 'mria', '180001', '2023-05-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'files/ttd/img_20230518014335_6562.jpg', NULL, NULL, '2023-07-25 19:23:11', '2023-05-14 18:55:07', '2023-07-25 19:23:11'),
(4, '2', '2023-05-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-15 23:05:18', '2023-05-15 22:54:57', '2023-05-15 23:05:18'),
(5, 'gw : 23244', '2023-07-26', NULL, NULL, NULL, NULL, NULL, 'sugiarto', 'supervisor', '4546', '2023-07-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-25 23:06:48', '2023-07-25 19:22:32', '2023-07-25 23:06:48'),
(6, 'G 1234', '2023-07-26', NULL, NULL, NULL, NULL, NULL, 'sugiarto', 'supervisor', '4546', '2023-07-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-26 01:35:25', '2023-07-27 08:22:35'),
(7, 'G 1234', '2023-07-28', NULL, NULL, NULL, NULL, NULL, 'sugiarto', 'supervisor', '4546', '2023-07-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tes1', 'tes2', 'tes3', NULL, '2023-07-28 01:29:30', '2023-08-07 18:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_user` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `role`, `password`, `foto`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
('0db88533-ab04-42eb-8816-3234ed121c7b', 'Supervisor', 'Supervisor', '3', '$2y$10$tTfB56ZpwMnnZN6L3SC1BuW5zsXoE108bVx410cDmADC7OojmmW/u', 'files/user/receiving966.png', NULL, NULL, '2023-05-07 10:40:13', '2023-07-27 09:34:06'),
('57a8904e-0c97-43a3-b539-352ef06ad6bd', 'tes', 'kasir', '1', '$2y$10$JJe9aA/Xyu7E7URcYRBnwOCbXRR7/r.vY6.WI4GyRE.EHiLSFVt/.', 'files/user/kasir9952.png', '2023-05-07 10:39:30', NULL, '2023-05-06 04:41:32', '2023-05-07 10:39:30'),
('87798fa3-7a37-4778-a139-e30bb733ebba', 'karyawan', 'karyawan', '2', '$2y$10$QcjYXOHe53sak3E.jwnY2ulZw1198PFuJ6kK8QzhweFAfmXVqF5cm', 'files/user/karyawan2479.png', NULL, NULL, '2023-05-14 03:47:38', '2023-05-14 03:47:38'),
('99f32977-0866-4168-b6fc-5bdfaefec353', 'Ardhi Faqih', 'admin', '1', '$2y$10$qBKYPh7YX/vZ83C6WCeKbu4hbZ6iVX/UAKhnw8/uRwxK6xM2UCme.', 'files/user/admin7855.png', NULL, NULL, '2023-05-07 04:41:32', '2023-06-04 18:23:12'),
('f344d3f4-051e-467b-af63-aa903b1e8604', 'manager', 'manager', '4', '$2y$10$AvgmxpSo7cV1Tw.0ebMFm.InoU2t/1mrzO3gmgvbPdeHtVmNcTIoi', 'files/user/manager261.png', NULL, NULL, '2023-05-14 03:47:59', '2023-05-14 03:47:59'),
('fee85a08-d23c-418d-b7ca-a677e25d51d6', 'receiving', 'receiving', '3', '$2y$10$bpBEvslSVAatTOGef94o/OMszYQOLa0cGUYGvU0nzwZx9ShCCL94a', 'files/user/receiving1831.png', '2023-05-07 05:12:25', NULL, NULL, '2023-05-07 05:12:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `item_keluar`
--
ALTER TABLE `item_keluar`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `item_masuk`
--
ALTER TABLE `item_masuk`
  ADD PRIMARY KEY (`id_item`);

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
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indexes for table `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_keluar`
--
ALTER TABLE `item_keluar`
  MODIFY `id_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item_masuk`
--
ALTER TABLE `item_masuk`
  MODIFY `id_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id_suplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
