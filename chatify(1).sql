-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Agu 2021 pada 10.56
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatify`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `type`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
(1875229718, 'user', 7, 6, 'halo mas', NULL, 1, '2021-08-18 23:50:11', '2021-08-18 23:50:25'),
(1882025702, 'user', 6, 4, 'a', NULL, 0, '2021-08-23 22:02:09', '2021-08-23 22:02:09'),
(2094586551, 'user', 5, 5, 'hi', NULL, 1, '2021-08-04 08:51:01', '2021-08-04 08:51:03'),
(2261159989, 'user', 5, 4, 'hi palerian', NULL, 1, '2021-08-04 08:51:35', '2021-08-04 19:22:57'),
(2261407077, 'user', 4, 5, 'hi too', NULL, 1, '2021-08-04 19:23:01', '2021-08-04 19:23:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_covid`
--

CREATE TABLE `claim_covid` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `gambar_hasiltest` varchar(255) DEFAULT NULL,
  `gambar_pcr` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_confirmed` date DEFAULT NULL,
  `status_verified` int(11) NOT NULL DEFAULT 0,
  `pilihan_isolasi` int(11) DEFAULT NULL,
  `sembuh` varchar(255) DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `claim_covid`
--

INSERT INTO `claim_covid` (`id`, `id_user`, `nim_nip`, `gambar_hasiltest`, `gambar_pcr`, `keterangan`, `tanggal_confirmed`, `status_verified`, `pilihan_isolasi`, `sembuh`, `created_at`, `updated_at`) VALUES
(244, 23, 'K252516', 'foto_antigen_K252516.png', NULL, 'Saya Terkena Covid', '2021-08-20', 0, 1, 'belum', '2021-08-22 07:14:11', '2021-08-22 07:14:11'),
(245, 22, 'K029908', 'foto_antigen_k029908.png', NULL, 'asasdasd', '2021-08-17', 0, 3, 'belum', '2021-08-22 16:46:45', '2021-08-22 16:46:45'),
(246, 20, 'K808020', NULL, 'foto_pcr_k808020.png', 'asasdasdads', '2021-08-20', 0, 2, 'belum', '2021-08-22 16:48:59', '2021-08-22 16:48:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_covid_history`
--

CREATE TABLE `claim_covid_history` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `sembuh` varchar(255) DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_gejala`
--

CREATE TABLE `claim_gejala` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `gejala` text NOT NULL,
  `keadaan` varchar(255) NOT NULL,
  `ambulan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `url_map` text NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `orang` varchar(255) NOT NULL,
  `kontak_covid` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `berhenti` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_isolasi`
--

CREATE TABLE `claim_isolasi` (
  `id` int(11) NOT NULL,
  `id_covid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `url_map` text DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `butuh_bantuan` varchar(255) DEFAULT NULL,
  `kiriman_bantuan` varchar(255) DEFAULT NULL,
  `selesai` varchar(255) DEFAULT NULL,
  `status_change` int(11) NOT NULL DEFAULT 0,
  `status_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `claim_isolasi`
--

INSERT INTO `claim_isolasi` (`id`, `id_covid`, `id_user`, `nim_nip`, `alasan`, `alamat`, `url_map`, `keterangan`, `butuh_bantuan`, `kiriman_bantuan`, `selesai`, `status_change`, `status_verified`, `created_at`, `updated_at`) VALUES
(39, 244, NULL, 'K252516', 'Ya, Saya tinggal sendirian', 'asd asd', 'wwr wwr', NULL, NULL, 'belum', 'belum', 0, 0, '2021-08-22 07:14:11', '2021-08-22 07:14:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_isolasi_rslainnya`
--

CREATE TABLE `claim_isolasi_rslainnya` (
  `id` int(11) NOT NULL,
  `id_covid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `nama_tempat` varchar(255) DEFAULT NULL,
  `alamat_tempat` varchar(255) DEFAULT NULL,
  `url_tempat` varchar(255) DEFAULT NULL,
  `selesai` varchar(255) DEFAULT NULL,
  `status_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `claim_isolasi_rslainnya`
--

INSERT INTO `claim_isolasi_rslainnya` (`id`, `id_covid`, `id_user`, `nim_nip`, `nama_tempat`, `alamat_tempat`, `url_tempat`, `selesai`, `status_verified`, `created_at`, `updated_at`) VALUES
(29, 246, NULL, 'K808020', 'yanhgke', 'jl. yanmghke', 'asdasadasdasd', 'belum', 0, '2021-08-22 16:48:59', '2021-08-22 16:48:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_isolasi_terpusat`
--

CREATE TABLE `claim_isolasi_terpusat` (
  `id` int(11) NOT NULL,
  `id_covid` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `rumah_sehat` varchar(255) DEFAULT NULL,
  `selesai` varchar(255) DEFAULT NULL,
  `status_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `claim_isolasi_terpusat`
--

INSERT INTO `claim_isolasi_terpusat` (`id`, `id_covid`, `id_user`, `nim_nip`, `rumah_sehat`, `selesai`, `status_verified`, `created_at`, `updated_at`) VALUES
(88, 245, NULL, 'K029908', 'RS1', 'belum', 0, '2021-08-22 16:46:45', '2021-08-22 16:46:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_vaksin`
--

CREATE TABLE `claim_vaksin` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `dosis_ke` int(11) NOT NULL,
  `link` text NOT NULL,
  `keterangan` text NOT NULL,
  `status_verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `claim_vaksin`
--

INSERT INTO `claim_vaksin` (`id`, `id_user`, `nim_nip`, `dosis_ke`, `link`, `keterangan`, `status_verified`, `created_at`, `updated_at`) VALUES
(33, 20, 'k808020', 2, 'asdasdasdasd', 'sadasd', 0, '2021-08-25 21:42:07', '2021-08-25 21:42:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `claim_vaksin_history`
--

CREATE TABLE `claim_vaksin_history` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `dosis` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `claim_vaksin_history`
--

INSERT INTO `claim_vaksin_history` (`id`, `id_user`, `nim_nip`, `dosis`, `created_at`, `updated_at`) VALUES
(13, 20, 'k808020', 1, '2021-08-25 21:41:54', '2021-08-25 21:41:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `info`
--

INSERT INTO `info` (`id`, `text`, `created_at`, `updated_at`) VALUES
(1, 'Pengumunan : \r\n\r\n- Surat Keterangan Positif Covid dapat berupa hasil text rapid antigen maupun test SWAB PCR (semua valid)\\\r\n- Apabila User melaporkan dirinya positif covid, data tersebut harus menunggu konfirmasi dari operator / admin\r\n- aku cinta kamu\r\n\r\n\r\nSarangheyo :) -> i love u so muchhhh.....\r\n\r\n\r\nwhy i still mad when i saw u\r\n\r\n\r\ncontact Person : \r\n\r\n- Dr. Andri                081353283933\r\n- Dr. vella                 081363728934\r\n- Dr. Anub Sp. Kk    0812378194723', NULL, '2021-08-24 03:44:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_covid`
--

CREATE TABLE `lokasi_covid` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lokasi_covid`
--

INSERT INTO `lokasi_covid` (`id`, `nama_lokasi`, `created_at`, `updated_at`) VALUES
(1, 'Isolasi Mandiri', NULL, NULL),
(2, 'Rumah Sakit / Klinik Lain', NULL, NULL),
(3, 'Rumah Sehat UNS 1', NULL, NULL),
(4, 'Rumah Sehat UNS 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `active_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `messenger_color`, `dark_mode`, `active_status`) VALUES
(4, 'palerian', 'palerian@gmail.com', NULL, 'user', '$2y$10$AfVTVFXyqxjZnmQjECOOsuUg8uO49WY.9RoxvKkrQ27PGdpmvTFP2', NULL, '2021-08-04 08:48:51', '2021-08-04 09:00:12', 'avatar.png', '#2180f3', 0, 0),
(5, 'yahya', 'yahya@gmail.com', NULL, 'operator', '$2y$10$9wVdT3BvyPXlz1A/7sa3Nu3ANQwQaEG5W.rS9Wlk8k0SW3dawtLvy', NULL, '2021-08-04 08:49:40', '2021-08-14 22:39:09', 'avatar.png', '#4CAF50', 0, 0),
(6, 'Rasyid Paradisa', 'admin@gmail.com', NULL, 'admin', '$2y$10$hvaCqy9kAvd0tVE04qQBPOO.SXYXxEsUgxb7s8gcyQ7Hk0U3.kbV.', NULL, '2021-08-04 20:43:07', '2021-08-23 21:55:03', 'avatar.png', '#2196F3', 0, 0),
(7, 'user', 'user@gmail.com', NULL, 'user', '$2y$10$J97YsFK.CmmpHtnJ7K24KecOpsLvmi9EJmwbejLaI/oT0/t.N1PLS', NULL, '2021-08-05 02:39:16', '2021-08-05 02:39:16', 'avatar.png', '#2180f3', 0, 0),
(8, 'friends', 'friend@gmail.com', NULL, 'user', '$2y$10$dNxkNeBgZLVbZfe3S3PC.eHsqFE.kXYB8X9EyxBu8H1za90sCDaGy', NULL, '2021-08-06 04:29:36', '2021-08-06 04:29:36', 'avatar.png', '#2180f3', 0, 0),
(11, 'fahri', 'dokterfahri@gmail.com', NULL, 'user', '$2y$10$5ywlfaHcsrAiEm8Vm7gsMuUoXIkKVg/se/ANrB1QKkp5G3lgu.acK', NULL, '2021-08-07 20:48:13', '2021-08-07 20:48:13', 'avatar.png', '#2180f3', 0, 0),
(12, 'polka', 'polka@gmail.com', NULL, 'user', '$2y$10$Yc9FQJ9mZ20i6a58cuR2puUTruQjd0QCC/K4lkl74gXtIxMkAU1/6', NULL, '2021-08-11 08:58:41', '2021-08-11 08:58:41', 'avatar.png', '#2180f3', 0, 0),
(13, 'elsa', 'dokterelsa@gmail.com', NULL, 'user', '$2y$10$Vak2S9SqVCp8rAsuAPJJ9uvYTWWEgWfmy.ivvahNWoFKpxHyD0pJ2', NULL, '2021-08-11 17:37:00', '2021-08-11 17:37:00', 'avatar.png', '#2180f3', 0, 0),
(14, 'operator', 'operator@gmail.com', NULL, 'operator', '$2y$10$dOdAcz67Pl//lV93AiepBe.Y1E6.bhC9.voFLpo/Vhxq4p.DOFira', NULL, '2021-08-14 22:09:03', '2021-08-14 22:09:03', 'avatar.png', '#2180f3', 0, 0),
(15, 'viana', 'viana@gmail.com', NULL, 'user', '$2y$10$qF9rwI02yXshaqmBhXWGI.cCFQrk59iMKWapZBUfNV8CMtYl/t8A2', NULL, '2021-08-15 02:50:23', '2021-08-15 02:50:23', 'avatar.png', '#2180f3', 0, 0),
(16, 'kentang goreng', 'kentang@gmail.com', NULL, 'user', '$2y$10$8YCr3sZ9kjgDfIubSVt1j.Z4LOBsVla04YDZrxBiHnL1YBWpe8ulu', NULL, '2021-08-17 03:06:04', '2021-08-17 03:06:04', 'avatar.png', '#2180f3', 0, 0),
(17, 'sukarto atmaja', 'sukarto@gmail.com', NULL, 'user', '$2y$10$cg9bVnQNJA0dw18xsljjuepsAfTqz0ohL0ib.oevJpROyTC2dQiDi', NULL, '2021-08-18 22:04:09', '2021-08-18 22:04:09', 'avatar.png', '#2180f3', 0, 0),
(18, 'malik ibrahim', 'malik@gmail.com', NULL, 'user', '$2y$10$hDhy/4OACkiO3UarOrAEpu.RWy.R6QpGjwjK2fvzcuWsuhG4Z57BO', NULL, '2021-08-18 22:04:09', '2021-08-18 22:04:09', 'avatar.png', '#2180f3', 0, 0),
(19, 'chika ivelia', 'ivelia@gmail.com', NULL, 'operator', '$2y$10$mdJelAtwwCl0WZFbzd8IvuhGJzEaeHvvzRr35KXkK8ToYRuD9vsua', NULL, '2021-08-18 22:04:09', '2021-08-18 22:04:09', 'avatar.png', '#2180f3', 0, 0),
(20, 'Aisyah', 'aisyah@gmail.com', NULL, 'user', '$2y$10$HAL35gRdOYA1F7X93co9ZehPsSAVq.4K0OKxw2/AMvpdPsyv1o6dG', NULL, '2021-08-21 00:38:24', '2021-08-21 00:38:24', 'avatar.png', '#2180f3', 0, 0),
(21, 'Aisyah', 'aisyah2@gmail.com', NULL, 'user', '$2y$10$JDar3.Dq5Eeea5zTX3//KOP1xswUlv1nnI9/2gBtv0ZMEnegVQQai', NULL, '2021-08-22 01:58:45', '2021-08-22 01:58:45', 'avatar.png', '#2180f3', 0, 0),
(22, 'user2', 'user2@gmail.com', NULL, 'user', '$2y$10$bGNx.YWAuywRotYagt3OAua90iry1/rqaHwFy6IcLb3iIhLTfjGqa', NULL, '2021-08-22 05:28:25', '2021-08-22 05:28:25', 'avatar.png', '#2180f3', 0, 0),
(23, 'user 3', 'user3@gmail.com', NULL, 'user', '$2y$10$vl9iLT9LlFt4wqyhMzUWCOk3gfgdM6G2oebVdIPY/Zfu5gkPwNPcK', NULL, '2021-08-22 07:12:19', '2021-08-22 07:12:19', 'avatar.png', '#2180f3', 0, 0),
(24, 'sutrisno', 'sutrisno@staff.uns.ac.id', NULL, 'admin', '$2y$10$nuOcIQictj8MhEA/Mjr7dOMVAq6h9vSi9VjKZBP.ooQ6u.V63bqL2', NULL, '2021-08-25 22:29:11', '2021-08-25 22:29:11', 'avatar.png', '#2180f3', 0, 0),
(25, 'meiyanto', 'mekosulistyo@staff.uns.ac.id', NULL, 'operator', '$2y$10$H2IFY2/.JS01vAYbK6MK/.L4rQOzVsjVZgc7Pvv1fidqYP5YjE/vO', NULL, '2021-08-25 22:30:38', '2021-08-25 22:30:38', 'avatar.png', '#2180f3', 0, 0),
(26, 'feri adriyanto', 'feri.adriyanto@staff.uns.ac.id', NULL, 'operator', '$2y$10$/1RLsVx2zYRTyYEVylUt0Oz/QGkGhkDaUNXXmh5BRjwKfp1f/bXeG', NULL, '2021-08-25 22:32:06', '2021-08-25 22:32:06', 'avatar.png', '#2180f3', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_data`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_data`
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
(34, 26, 'feri adriyanto', 'K333333333', '08135263222', 'dosen', 'jalan makan', NULL, 'yes', '2021-08-25 22:32:24', '2021-08-25 22:32:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `claim_covid`
--
ALTER TABLE `claim_covid`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `claim_covid_history`
--
ALTER TABLE `claim_covid_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `claim_gejala`
--
ALTER TABLE `claim_gejala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `claim_isolasi`
--
ALTER TABLE `claim_isolasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `claim_isolasi_rslainnya`
--
ALTER TABLE `claim_isolasi_rslainnya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `claim_isolasi_terpusat`
--
ALTER TABLE `claim_isolasi_terpusat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `claim_vaksin`
--
ALTER TABLE `claim_vaksin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `claim_vaksin_history`
--
ALTER TABLE `claim_vaksin_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lokasi_covid`
--
ALTER TABLE `lokasi_covid`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `claim_covid`
--
ALTER TABLE `claim_covid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT untuk tabel `claim_covid_history`
--
ALTER TABLE `claim_covid_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT untuk tabel `claim_gejala`
--
ALTER TABLE `claim_gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `claim_isolasi`
--
ALTER TABLE `claim_isolasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `claim_isolasi_rslainnya`
--
ALTER TABLE `claim_isolasi_rslainnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `claim_isolasi_terpusat`
--
ALTER TABLE `claim_isolasi_terpusat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `claim_vaksin`
--
ALTER TABLE `claim_vaksin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `claim_vaksin_history`
--
ALTER TABLE `claim_vaksin_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `lokasi_covid`
--
ALTER TABLE `lokasi_covid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
