-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 06:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring`
--

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
-- Table structure for table `hardware`
--

CREATE TABLE `hardware` (
  `id` int(11) NOT NULL,
  `hardware` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `local_time` timestamp NULL DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hardware`
--

INSERT INTO `hardware` (`id`, `hardware`, `location`, `timezone`, `local_time`, `latitude`, `longitude`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4001, 'ST. Jombang', '7', '2022-11-10 09:20:00', '-3.709444', '115.403611', 'admin', '2022-11-10 09:20:00', '2023-08-19 14:15:51', NULL),
(2, 4002, 'ST. TIMBURU', '7', '2022-11-10 09:20:00', '-2.552639', '115.964806', 'admin', '2022-11-10 09:20:00', '2023-08-19 14:17:19', NULL),
(3, 4003, 'ST. RIAM ADUNGAN', '7', '2022-11-10 09:20:00', '-3.738917', '115.198417', 'admin', '2022-11-10 09:20:00', '2023-08-19 14:17:19', NULL),
(5, 4005, 'ST. TESTING BIRD', '12', '2023-08-20 08:02:00', '1.110', '-1.100', 'admin', '2023-08-20 01:02:51', '2023-08-20 05:42:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hardware_detail`
--

CREATE TABLE `hardware_detail` (
  `id` int(11) NOT NULL,
  `hardware` int(11) DEFAULT NULL,
  `sensor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hardware_detail`
--

INSERT INTO `hardware_detail` (`id`, `hardware`, `sensor`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4001, 'rf', '2023-08-19 14:29:19', '2023-08-19 14:29:19', NULL),
(2, 4002, 'wl', '2023-08-19 14:29:19', '2023-08-19 14:29:19', NULL),
(3, 4002, 'bt', '2023-08-19 14:29:19', '2023-08-19 14:29:19', NULL),
(4, 4003, 'ah', '2023-08-19 14:29:19', '2023-08-19 14:29:19', NULL),
(5, 4003, 'ws', '2023-08-19 14:29:19', '2023-08-19 14:29:19', NULL),
(6, 4003, 'bt', '2023-08-19 14:29:19', '2023-08-19 14:29:19', NULL),
(7, 4005, 'sadad', '2023-08-20 02:29:16', '2023-08-20 02:29:26', '2023-08-20 02:29:26'),
(8, 4005, 'fmsa', '2023-08-20 05:49:04', '2023-08-20 05:49:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `text`, `created_at`, `updated_at`) VALUES
(1, 'Pengumunan : \r\n\r\n- Surat Keterangan Positif Covid dapat berupa hasil text rapid antigen maupun test SWAB PCR (semua valid)\\\r\n- Apabila User melaporkan dirinya positif covid, data tersebut harus menunggu konfirmasi dari operator / admin\r\n- aku cinta kamu\r\n\r\n\r\nSarangheyo :) -> i love u so muchhhh.....\r\n\r\n\r\nwhy i still mad when i saw u\r\n\r\n\r\ncontact Person : \r\n\r\n- Dr. Andri                081353283933\r\n- Dr. vella                 081363728934\r\n- Dr. Anub Sp. Kk    0812378194723', NULL, '2021-08-24 03:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_covid`
--

CREATE TABLE `lokasi_covid` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_covid`
--

INSERT INTO `lokasi_covid` (`id`, `nama_lokasi`, `created_at`, `updated_at`) VALUES
(1, 'Isolasi Mandiri', NULL, NULL),
(2, 'Rumah Sakit / Klinik Lain', NULL, NULL),
(3, 'Rumah Sehat UNS 1', NULL, NULL),
(4, 'Rumah Sehat UNS 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_sensor`
--

CREATE TABLE `master_sensor` (
  `id` int(11) NOT NULL,
  `sensor` varchar(255) DEFAULT NULL,
  `sensor_name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_sensor`
--

INSERT INTO `master_sensor` (`id`, `sensor`, `sensor_name`, `unit`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'rf', 'Rainfall', 'mm', 'admin', '2022-11-10 09:20:00', '2023-08-19 13:44:45', NULL),
(2, 'wl', 'Water Level', 'cm', 'admin', '2022-11-10 09:20:00', '2023-08-19 13:45:45', NULL),
(3, 'ah', 'Air Humidity', '%', 'admin', '2022-11-10 09:20:00', '2023-08-19 13:45:45', NULL),
(4, 'ws', 'Wind Speed', 'm/s', 'admin', '2022-11-10 09:20:00', '2023-08-19 13:46:41', NULL),
(5, 'bt', 'Battery', 'Volt', 'admin', '2022-11-10 09:20:00', '2023-08-19 13:46:41', NULL),
(6, 'fts', 'fake test sensor', 'fakes', 'admin', '2023-08-20 03:54:21', '2023-08-19 20:54:40', '2023-08-19 20:54:40'),
(8, 'FST', 'Fake Sensor Test', 'fest', 'admin', '2023-08-20 00:34:35', '2023-08-20 00:35:42', '2023-08-20 00:35:42'),
(10, 'rms', 'red morphes', 'rms/s', 'admin', '2023-08-20 05:24:35', '2023-08-20 05:31:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `hardware` int(11) DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `trans_id`, `hardware`, `parameter`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4001, '{[isi data dari alat]}', '4001', '2022-11-08 09:20:00', '2023-08-19 14:35:57', NULL),
(2, 2, 4002, '{[isi data dari alat]}', '4002', '2022-11-08 09:20:00', '2023-08-19 14:35:57', NULL),
(3, 3, 4003, '{[isi data dari alat]}', '4003', '2022-11-08 09:20:00', '2023-08-19 14:35:57', NULL),
(4, 4, 4001, '{[isi data dari alat]}', '4001', '2022-11-09 09:20:00', '2023-08-19 14:35:57', NULL),
(5, 5, 4002, '{[isi data dari alat]}', '4002', '2022-11-09 09:20:00', '2023-08-19 14:35:57', NULL),
(6, 6, 4003, '{[isi data dari alat]}', '4003', '2022-11-09 09:20:00', '2023-08-19 14:35:57', NULL),
(7, 7, 4001, '{[isi data dari alat]}', '4001', '2022-11-10 09:20:00', '2023-08-19 14:35:57', NULL),
(8, 8, 4002, '{[isi data dari alat]}', '4002', '2022-11-10 09:20:00', '2023-08-19 14:35:57', NULL),
(9, 9, 4003, '{[isi data dari alat]}', '4003', '2022-11-10 09:20:00', '2023-08-19 14:35:57', NULL),
(10, NULL, 4005, '{[isi data dari alat]}', '4005', '2023-08-20 02:38:51', '2023-08-20 02:41:57', '2023-08-20 02:41:57'),
(11, NULL, 40052, '{[isi data dari alat]}', '40052', '2023-08-20 06:17:05', '2023-08-20 06:17:21', '2023-08-20 06:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `hardware` int(11) DEFAULT NULL,
  `sensor` varchar(255) DEFAULT NULL,
  `value` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `trans_id`, `hardware`, `sensor`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4001, 'rf', 0.5, '2023-08-19 14:39:37', '2023-08-19 14:39:37', NULL),
(2, 2, 4002, 'wl', 701.25, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(3, 2, 4002, 'bt', 12.1, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(4, 3, 4003, 'ah', 27, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(5, 3, 4003, 'ws', 10, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(6, 3, 4003, 'bt', 12.15, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(7, 4, 4001, 'rf', 1.5, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(8, 5, 4002, 'wl', 750.5, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(9, 5, 4002, 'bt', 12.3, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(10, 6, 4003, 'ah', 25, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(11, 6, 4003, 'ws', 8.55, '2023-08-19 14:44:00', '2023-08-19 14:44:00', NULL),
(12, 6, 4003, 'bt', 12.05, '2023-08-19 14:46:11', '2023-08-19 14:46:11', NULL),
(13, 7, 4001, 'rf', 0.5, '2023-08-19 14:46:11', '2023-08-19 14:46:11', NULL),
(14, 8, 4002, 'wl', 550.75, '2023-08-19 14:46:11', '2023-08-19 14:46:11', NULL),
(15, 8, 4002, 'bt', 12.2, '2023-08-19 14:46:11', '2023-08-19 14:46:11', NULL),
(16, 9, 4003, 'ah', 25, '2023-08-19 14:46:11', '2023-08-19 14:46:11', NULL),
(17, 9, 4003, 'ws', 11.3, '2023-08-19 14:46:11', '2023-08-19 14:46:11', NULL),
(18, 9, 4003, 'bt', 12.23, '2023-08-19 14:46:11', '2023-08-19 14:46:11', NULL),
(19, 1, 4005, 'asdsad', 1.5, '2023-08-20 02:56:14', '2023-08-20 02:56:28', '2023-08-20 02:56:28'),
(20, 3, 4005, 'sadad', 1.42, '2023-08-20 02:59:02', '2023-08-20 02:59:21', '2023-08-20 02:59:21'),
(21, 32, 4011, 'sadad3', 1.42, '2023-08-20 06:18:32', '2023-08-20 06:23:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `messenger_color` varchar(255) NOT NULL DEFAULT '#2180f3',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `active_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `messenger_color`, `dark_mode`, `active_status`) VALUES
(27, 'alpha', 'alpharadisa@gmail.com', NULL, 'admin', '$2y$10$WxDwZdnQMEhyszdcGlQWN.dy0iIN5p25PmEpXsCysHov6BZtfF2Y2', NULL, '2023-08-18 21:06:21', '2023-08-18 21:06:21', 'avatar.png', '#2180f3', 0, 0),
(28, 'arkha', 'arkha@gmail.com', NULL, 'super admin', '$2y$10$658yCxdiX87Whz4YktDUnuEBMj741Ooa3ejZAgbMeHF1vGPIrLkUy', NULL, '2023-08-20 00:15:12', '2023-08-20 00:15:12', 'avatar.png', '#2180f3', 0, 0),
(29, 'salsa', 'salsa@gmail.com', NULL, 'user', '$2y$10$Y3QHQ6aypFUrw5seW88BqegSWRzffAaszUWtNbfjW7NeYqPMsux56', NULL, '2023-08-20 21:14:49', '2023-08-20 21:14:49', 'avatar.png', '#2180f3', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `gambar_ktp` varchar(255) DEFAULT NULL,
  `verified` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `id_user`, `nama_lengkap`, `nim_nip`, `no_telp`, `status`, `alamat`, `gambar_ktp`, `verified`, `created_at`, `updated_at`) VALUES
(12, 6, 'Rasyid Fiana Paradisa', 'K202010', '081353283911', 'dokter', '111111', 'foto_ktp_K202010.png', 'no', '2021-08-04 21:18:09', '2021-08-19 21:39:50'),
(13, 4, 'Palerian Eversky', 'K202020', '081353283922', 'biasa', 'Jl. Kasuari', 'foto_ktp_K202020.JPG', 'no', '2021-08-04 21:51:30', '2021-08-04 21:51:30'),
(14, 7, 'Ivelia Kanya', 'K202030', '081353283933', 'biasa', 'Jl. Ngandikan', 'foto_ktp_K202030.JPG', 'no', '2021-08-05 02:40:16', '2021-08-05 02:40:16'),
(15, 5, 'Yahya Muhammad', 'K20203', '081353283944', 'dokter', 'Jl. Janti', 'foto_ktp_K20203.JPG', 'yes', '2021-08-05 03:56:19', '2021-08-05 03:56:19'),
(16, 8, 'Frenzy Virouza', 'K808080', '081353283955', 'biasa', 'Jl. Suprapto', 'foto_ktp_K808080.JPG', 'no', '2021-08-06 04:30:25', '2021-08-06 04:30:25'),
(17, 9, 'Anang Wijayanto', 'K202055', '081353283222', 'dokter', 'Jl. Kapuk', 'foto_ktp_K202055.jpg', 'yes', '2021-08-07 02:16:51', '2021-08-07 02:16:51'),
(18, 10, 'riki aston', 'K202090', '081353283921', 'biasa', 'Jl. Kasuari', 'foto_ktp_K202090.JPG', 'no', '2021-08-07 06:53:28', '2021-08-07 06:53:28'),
(19, 11, 'Fahri Rossiana', '123', '081353283008', 'dokter', 'Jl. Suteja', 'foto_ktp_K202075.JPG', 'yes', '2021-08-07 20:48:55', '2021-08-07 20:48:55'),
(20, 12, 'polka dimika', 'K202095', '081353283927', 'biasa', 'Jl. Sutawijaya', 'foto_ktp_K202095.png', 'no', '2021-08-11 08:59:25', '2021-08-11 08:59:25'),
(21, 13, 'elsa varadisa', 'K202085', '081353283123', 'dokter', 'Jl. Kapuk', 'foto_ktp_K202085.png', 'no', '2021-08-11 17:37:42', '2021-08-11 17:37:42'),
(22, 14, 'operator kampus', 'k808029', '081353283333', 'biasa', 'Jl. Suteja', 'foto_ktp_k808029.xlsx', 'no', '2021-08-14 22:09:31', '2021-08-14 22:09:31'),
(23, 15, 'viana', 'k808023', '081353283934', 'tenaga medis', 'Jl. Yongki', 'foto_ktp_k808023.sql', 'yes', '2021-08-15 02:51:05', '2021-08-15 02:51:42'),
(24, 16, 'kentang goreng', 'k202039', '081353283000', 'umum', 'Jl. nguyuk', NULL, 'no', '2021-08-17 03:06:28', '2021-08-17 03:06:28'),
(25, 17, 'sukarto atmaja', 'k708025', '081353283933', 'dokter', 'jl. Thamrin', NULL, 'yes', '2021-08-18 22:04:09', '2021-08-18 22:04:09'),
(26, 18, 'malik ibrahim', 'k708026', '081353283911', 'mahasiswa', 'jl. Moho', NULL, 'yes', '2021-08-18 22:04:09', '2021-08-18 22:04:09'),
(27, 19, 'chika ivelia', 'k290901', '081353283942', 'mahasiswa', 'jl. Yokire', NULL, 'yes', '2021-08-18 22:04:09', '2021-08-18 22:04:09'),
(28, 20, 'Aisyah Rovela', 'k808020', '081353273944', 'dokter', 'Jl. Kampret', 'foto_ktp_k808020.png', 'no', '2021-08-21 00:38:50', '2021-08-21 00:39:19'),
(29, 21, 'aisyah 2', 'K808022', '081353283321', 'mahasiswa', 'Jl. Maaan', NULL, 'no', '2021-08-22 01:59:05', '2021-08-22 01:59:05'),
(30, 22, 'user 2', 'k029908', '081353283301', 'mahasiswa', 'Jl. kpas', NULL, 'no', '2021-08-22 05:28:50', '2021-08-22 05:28:50'),
(31, 23, 'user tiga', 'K252516', '081353284938', 'mahasiswa', 'Jl. Suteja', NULL, 'no', '2021-08-22 07:12:45', '2021-08-22 07:12:45'),
(32, 24, 'sutrisno', 'K111111111', '08135263741', 'dosen', 'Jalan jalan', NULL, 'yes', '2021-08-25 22:29:35', '2021-08-25 22:29:35'),
(33, 25, 'meiyanto', 'K222222222', '08135263302', 'dosen', 'jalan mongol', NULL, 'yes', '2021-08-25 22:30:55', '2021-08-25 22:30:55'),
(34, 26, 'feri adriyanto', 'K333333333', '08135263222', 'dosen', 'jalan makan', NULL, 'yes', '2021-08-25 22:32:24', '2021-08-25 22:32:24'),
(35, 27, 'alpha radisa', 'I0717014', '081357515074', 'dokter', 'Jl. Kasuari', 'foto_ktp_i0717014.jpeg', 'no', '2023-08-18 21:06:49', '2023-08-18 21:06:49'),
(36, 28, 'arkha rantika', 'I0717111', '08123456122', 'dokter', 'street avenue', 'foto_ktp_i0717111.jpg', 'no', '2023-08-20 00:15:41', '2023-08-20 00:15:41'),
(37, 29, 'salsabila', 'I0717011', '081357515073', 'mahasiswa', 'Jl. Kasuari no37', 'foto_ktp_i0717011.jpg', 'no', '2023-08-20 21:15:13', '2023-08-20 21:15:13');

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
-- Indexes for table `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hardware_detail`
--
ALTER TABLE `hardware_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_covid`
--
ALTER TABLE `lokasi_covid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_sensor`
--
ALTER TABLE `master_sensor`
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
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hardware`
--
ALTER TABLE `hardware`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hardware_detail`
--
ALTER TABLE `hardware_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lokasi_covid`
--
ALTER TABLE `lokasi_covid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_sensor`
--
ALTER TABLE `master_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
