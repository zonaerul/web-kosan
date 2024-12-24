-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 24, 2024 at 12:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_kosan`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `title`, `create_at`) VALUES
(1, 'Admin', '2024-12-07 15:47:12'),
(2, 'Pemilik', '2024-12-07 15:47:12'),
(3, 'Penghuni', '2024-12-07 15:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `transfer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `transfer`) VALUES
(1, 'BRimo', 'bri123456789'),
(2, 'BCA', 'bca123456789'),
(3, 'BSI', 'bsi123456789');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`) VALUES
(1, 'cewe', '2024-12-07 20:59:41'),
(2, 'cowo', '2024-12-07 20:59:41'),
(3, 'campur', '2024-12-07 20:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kosans`
--

CREATE TABLE `kosans` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_kosan` varchar(255) NOT NULL,
  `upload_file` text,
  `lokasi` varchar(255) NOT NULL,
  `nomer_whatsapp` text,
  `harga` text NOT NULL,
  `pembayaran` varchar(100) NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `kamar` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `fasilitas` json NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `map` text NOT NULL,
  `category` enum('cewe','cowo','campur') NOT NULL DEFAULT 'cewe',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kosans`
--

INSERT INTO `kosans` (`id`, `email`, `nama_kosan`, `upload_file`, `lokasi`, `nomer_whatsapp`, `harga`, `pembayaran`, `tanggal_pembayaran`, `kamar`, `fasilitas`, `deskripsi`, `map`, `category`, `created_at`, `updated_at`) VALUES
(9, 'qenboxofficial@gmail.com', 'Kosan Perumahan 4 Kamar di Bandung', '[\"uploads\\/mYz7AMGapWRu5F2DarAmztx0Fl9mCzLJH4QbHDNY.jpg\",\"uploads\\/bPBOhpCyd7ayTeUUybEv186jgu6aHvAlQXotb5vQ.jpg\"]', 'bandung', NULL, 'Rp 1.000.000', 'tahun', '2024-12-09', '4', '[\"tv\", \"wifi\", \"ac\"]', 'Kosan Perumahan 4 Kamar di Bandung\n\nKami menawarkan kosan perumahan dengan fasilitas yang nyaman dan lokasi strategis di Bandung. Terdiri dari 4 kamar yang tersedia untuk disewa, kosan ini sangat cocok untuk mahasiswa, pekerja, atau keluarga yang membutuhkan tempat tinggal yang tenang dan dekat dengan berbagai fasilitas kota.\n\nFasilitas:\n\nKamar tidur dengan ukuran yang cukup luas\nTempat tidur, lemari pakaian, meja belajar/kerja, dan AC (sesuai kamar)\nDapur bersama lengkap dengan peralatan memasak\nKamar mandi bersih dengan fasilitas air panas\nWi-Fi cepat dan akses internet gratis\nArea parkir luas dan aman\nKeamanan 24 jam dengan CCTV\nLokasi: Kosan ini terletak di lokasi yang strategis di Bandung, dekat dengan pusat perbelanjaan, universitas, dan akses transportasi umum. Anda dapat dengan mudah mencapai berbagai tempat penting di Bandung seperti [nama lokasi/daerah], menjadikan kosan ini pilihan yang tepat untuk tinggal.\n\nHarga Sewa: Harga sewa per kamar mulai dari [harga] per bulan, tergantung pada fasilitas yang tersedia di dalam kamar.', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63379.890169398495!2d109.1043328!3d-6.8614379!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb92207662cdd%3A0xd5defd65d367132e!2sRita%20Supermall%20Tegal!5e0!3m2!1sid!2sid!4v1733743645721!5m2!1sid!2sid', 'cowo', '2024-12-09 04:42:15', '2024-12-09 04:42:15'),
(10, 'admin@app.com', 'Hotel Angreani Jatibarang', '[\"uploads\\/5zLYfzNhD5PsDg5fp8CfOI4WTu31aY8D3YCZPJ1X.jpg\",\"uploads\\/nmiw4PNvtQgo60PSiBRP7RW727RQqR5iXOTb4yaF.jpg\",\"uploads\\/DPq0Vwe1BBtmWNk3vNr1unNWm3XQA7M8hLI6j949.jpg\"]', 'Brebes, Jatibarang', NULL, 'Rp 300.000', 'minggu', '2024-12-10', '2', '[\"Tv\", \"Wifi\", \"Kamar mandi\"]', 'Hotel Angreani Jatibarang adalah pilihan penginapan yang nyaman dan strategis yang terletak di Jatibarang, Indramayu. Hotel ini menawarkan berbagai fasilitas untuk memenuhi kebutuhan para tamu, baik untuk perjalanan bisnis maupun rekreasi.\r\n\r\nDengan desain yang sederhana namun modern, hotel ini menyediakan kamar-kamar yang bersih dan terawat, dilengkapi dengan fasilitas seperti AC, TV, Wi-Fi gratis, dan kamar mandi pribadi. Beberapa kamar juga menawarkan pemandangan yang menenangkan.\r\n\r\nLokasinya yang strategis memungkinkan para tamu untuk dengan mudah mengakses berbagai tempat penting di Jatibarang, termasuk pusat perbelanjaan, rumah makan lokal, dan tempat wisata terdekat.\r\n\r\nFasilitas Hotel:\r\n\r\n• Resepsionis 24 jam\r\n• Area parkir yang luas\r\n• Layanan kamar\r\n• Wi-Fi gratis di seluruh area hotel\r\n• Sarapan (opsional)\r\n\r\nAkses Lokasi: Hotel ini berada dekat dengan stasiun Jatibarang dan berbagai fasilitas umum lainnya, membuatnya menjadi pilihan ideal bagi para pelancong yang ingin mengeksplorasi Indramayu dan sekitarnya.\r\n\r\nNikmati pengalaman menginap yang nyaman dengan harga terjangkau di Hotel Angreani Jatibarang.', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63379.890169398495!2d109.1043328!3d-6.8614379!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb92207662cdd%3A0xd5defd65d367132e!2sRita%20Supermall%20Tegal!5e0!3m2!1sid!2sid!4v1733743645721!5m2!1sid!2sid', 'campur', '2024-12-09 12:58:58', '2024-12-09 12:58:58'),
(11, 'pemilik@gmail.com', 'Hotel Angreani Jatibarang', '[\"uploads\\/wJDCp63bX8Ar0OJrba24CjK8ICPE43KuT97wKLW7.jpg\",\"uploads\\/j43K8qTHoNjn3nTVfnWZEeWn6oOL5EOyr73ab2Fq.jpg\",\"uploads\\/xYNIaTUd26eF3MzD0UZR9EpoyQjnLtgYWp7I0Pq3.jpg\"]', 'Brebes, Jatibarang', NULL, 'Rp 500.000', 'bulan', '2024-12-10', '4', '[\"tv\", \"wifi\"]', 'Hotel Angreani Jatibarang adalah pilihan penginapan yang nyaman dan strategis yang terletak di Jatibarang, Indramayu. Hotel ini menawarkan berbagai fasilitas untuk memenuhi kebutuhan para tamu, baik untuk perjalanan bisnis maupun rekreasi.\r\n\r\nDengan desain yang sederhana namun modern, hotel ini menyediakan kamar-kamar yang bersih dan terawat, dilengkapi dengan fasilitas seperti AC, TV, Wi-Fi gratis, dan kamar mandi pribadi. Beberapa kamar juga menawarkan pemandangan yang menenangkan.\r\n\r\nLokasinya yang strategis memungkinkan para tamu untuk dengan mudah mengakses berbagai tempat penting di Jatibarang, termasuk pusat perbelanjaan, rumah makan lokal, dan tempat wisata terdekat.\r\n\r\nFasilitas Hotel:\r\n\r\nResepsionis 24 jam\r\nArea parkir yang luas\r\nLayanan kamar\r\nWi-Fi gratis di seluruh area hotel\r\nSarapan (opsional)\r\nAkses Lokasi: Hotel ini berada dekat dengan stasiun Jatibarang dan berbagai fasilitas umum lainnya, membuatnya menjadi pilihan ideal bagi para pelancong yang ingin mengeksplorasi Indramayu dan sekitarnya.\r\n\r\nNikmati pengalaman menginap yang nyaman dengan harga terjangkau di Hotel Angreani Jatibarang.', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63379.890169398495!2d109.1043328!3d-6.8614379!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb92207662cdd%3A0xd5defd65d367132e!2sRita%20Supermall%20Tegal!5e0!3m2!1sid!2sid!4v1733743645721!5m2!1sid!2sid', 'campur', '2024-12-09 13:20:58', '2024-12-09 13:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '0001_01_01_000000_create_users_table', 1),
(8, '0001_01_01_000001_create_cache_table', 1),
(9, '0001_01_01_000002_create_jobs_table', 1),
(10, '2024_11_11_120840_create_kelola_kosans_table', 1),
(11, '2024_11_11_122901_table__pelanggan_kosan', 1),
(12, '2024_11_14_115601_create_notas_table', 1),
(13, '2024_12_09_153525_transaksi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kosan` int NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kosan` int NOT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `category` enum('cewe','cowo','campur') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kamar` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('15sPPLYQgLsKkVirg8h4ZrXZJyzcR8lDaUWkPeFL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicEgyUWx4OGFrakQzTjI0RFRrdkhkSURITGV4RTdCblhaR2JicTh1eSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734481771),
('9XUgaYoqIIJQRZuPT72dP054UNDyLlCaNrsW2rx3', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWHBoZnJHMkRTTGVPb3BiUVVDT1NqaldzWEFic2Fpa2NYeWZGRnV2UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyLW1hbmFnZW1lbnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAva29zYW4vdmlldy85Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1734444997),
('pSEp3Q3I9WkrqZKfl8EH4mVfrSzue0XH369sJN67', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicVdsNk85VVJ0TTZQaGxZVHZhZXZEdDFtMWhSSWcxZTA5eEpHRlNOUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyLW1hbmFnZW1lbnQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=', 1733775815);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kosan` int NOT NULL,
  `nama_kosan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','paid','failed','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_kosan`, `nama_kosan`, `code`, `email`, `nama`, `bank`, `total`, `tanggal`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 9, 'Kosan Perumahan 4 Kamar di Bandung', 'hnNs2C', 'admin@app.com', 'Chaerul wahyu', 'BRimo', 'Rp 1.000.000', '2024-12-10', 8, 'paid', '2024-12-09 12:54:01', '2024-12-09 13:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `number`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'Chaerul wahyu', 'Admin', '082320000000', 'admin@app.com', '2024-12-09 09:17:57', '$2y$12$qGKvljFNZmL9u4CbkbrfhOzK.u3WFOr5.7eqJnKCdbir0hGq0ZR7i', 'XEYiuyS7cHuKvdU4qw9rtwokIBdfzhCmaww3hwCP6fIZGAEOqrIvoFEhEUve', '2024-12-09 09:17:57', '2024-12-09 09:17:57'),
(9, 'Pemilik Test', 'Pemilik', '082328200000', 'pemilik@gmail.com', '2024-12-09 13:14:39', '$2y$12$lEqX05c.V.yCwypKaQXbSe/BzpXMjWmfT4a8ygJPKWSc7jiRdeQve', 'jDtgmol52L', '2024-12-09 13:14:39', '2024-12-09 13:14:39'),
(10, 'Chaerul wahyu', 'Admin', '082328200000', 'erul@gmail.com', '2024-12-17 06:29:53', '$2y$12$r0fD4AHZHJqOiNoMd9pPHuVDy3CnIp8m9loqbQ9s6M9i3/PZAx1X6', 'D6qtSh7FzG', '2024-12-17 06:29:53', '2024-12-17 06:29:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `kosans`
--
ALTER TABLE `kosans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kosans`
--
ALTER TABLE `kosans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
