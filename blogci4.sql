-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jul 2025 pada 08.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogci4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'melondua1@gmail.com', '$2y$10$oEpRbgQ5bOoulBj50ci5COpzp5RLRSjRg.dq/LUI9fVIaRuKC7.7y', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2024-05-25 04:34:14'),
(2, 2, 'user', '2024-06-03 02:19:24'),
(3, 3, 'user', '2024-06-07 01:56:04'),
(4, 4, 'user', '2025-02-13 03:34:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'admin@gmail.com', '$2y$12$seOao/ikMLKs7TJtVvuKFupSKq6v6PIysno0tjWoYgvnm1WFdCYGm', NULL, NULL, 0, '2024-06-02 16:28:07', '2024-05-25 04:34:13', '2024-06-02 16:28:07'),
(2, 2, 'email_password', NULL, 'user2@gmail.com', '$2y$12$oJsn5etvVVF6hwc0St9K/OTppaSM9CSCV6H0SCpWSb2DvI9j6XGZm', NULL, NULL, 0, '2025-04-18 15:06:54', '2024-06-03 02:19:23', '2025-04-18 15:06:54'),
(3, 3, 'email_password', NULL, 'user4@gmail.com', '$2y$12$j779Ij6OlX5mpkWNUz6OdOEehnlaiXVQO01e2UnHGr3k.4YDQTIuu', NULL, NULL, 0, NULL, '2024-06-07 01:56:03', '2024-06-07 01:56:03'),
(4, 4, 'email_password', NULL, 'admin4@gmail.com', '$2y$12$hNMqcL/qgXHMO/o.H7j9cunLkmMrSBAe55jzFTAfFcuBXU9XG9ssC', NULL, NULL, 0, NULL, '2025-02-13 03:34:35', '2025-02-13 03:34:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'melondua1@gmail.com', NULL, '2024-05-25 04:31:51', 0),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'melondua1@gmail.com', NULL, '2024-05-25 04:33:00', 0),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', NULL, '2024-05-26 11:43:35', 0),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', NULL, '2024-05-26 11:43:43', 0),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', NULL, '2024-05-26 11:44:13', 0),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', NULL, '2024-05-26 11:44:31', 0),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', NULL, '2024-05-26 11:44:41', 0),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', 1, '2024-05-26 11:45:19', 1),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', 1, '2024-05-26 12:12:08', 1),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', 1, '2024-05-26 13:07:16', 1),
(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'admin@gmail.com', 1, '2024-06-02 16:28:07', 1),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'user1@gmail.com', NULL, '2024-06-03 02:18:20', 0),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'user1@gmail.com', NULL, '2024-06-03 02:18:29', 0),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'email_password', 'user1@gmail.com', NULL, '2024-06-07 01:55:18', 0),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'email_password', 'melondua1@gmail.com', NULL, '2025-02-13 03:31:37', 0),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'email_password', 'melondua1@gmail.com', NULL, '2025-02-13 03:31:46', 0),
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'email_password', 'melondua1@gmail.com', NULL, '2025-02-13 03:32:10', 0),
(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'email_password', 'melondua1@gmail.com', NULL, '2025-02-13 03:32:28', 0),
(19, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'email_password', 'melondua1@gmail.com', NULL, '2025-02-13 03:33:59', 0),
(20, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'email_password', 'melondua1@gmail.com', NULL, '2025-03-04 10:18:25', 0),
(21, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'email_password', 'user2@gmail.com', NULL, '2025-03-05 05:37:12', 0),
(22, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'email_password', 'user2@gmail.com', 2, '2025-03-05 05:37:24', 1),
(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'email_password', 'admin@gmail.com', NULL, '2025-03-18 04:20:10', 0),
(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'email_password', 'admin@gmail.com', NULL, '2025-03-18 04:20:18', 0),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'email_password', 'admin1@gmail.com', NULL, '2025-04-18 15:05:51', 0),
(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'email_password', 'admin1@gmail.com', NULL, '2025-04-18 15:05:57', 0),
(27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'email_password', 'user2@gmail.com', 2, '2025-04-18 15:06:54', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'farmasi', '2024-05-25 11:54:46', '2024-05-25 11:54:46', '2024-05-25 11:54:46'),
(2, 'gizi', '2024-05-25 11:54:55', '2024-05-25 11:54:55', '2024-05-25 11:54:55'),
(3, 'bidan', '2024-05-25 11:55:03', '2024-05-25 11:55:03', '2024-05-25 11:55:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqcategories`
--

CREATE TABLE `faqcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `faqcategories`
--

INSERT INTO `faqcategories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kehamilan', '2025-03-06 23:49:55', '2025-03-06 23:49:55', '2025-03-06 23:49:55'),
(2, 'Menyusui', '2025-03-06 23:50:27', '2025-03-06 23:50:27', '2025-03-06 23:50:27'),
(3, 'Persalinan', '2025-03-06 23:50:27', '2025-03-06 23:50:27', '2025-03-06 23:50:27'),
(4, 'Vaksin', '2025-03-06 23:50:27', '2025-03-06 23:50:27', '2025-03-06 23:50:27'),
(5, 'Tumbuh Kembang', '2025-03-06 23:50:27', '2025-03-06 23:50:27', '2025-03-06 23:50:27'),
(6, 'Nutrisi', '2025-03-06 23:50:27', '2025-03-06 23:50:27', '2025-03-06 23:50:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `category_id`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`, `deleted_at`) VALUES
(37, 1, 'Apa perbedaan vitamin dan suplemen?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Vitamin:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Adalah senyawa organik esensial yang dibutuhkan tubuh dalam jumlah kecil untuk fungsi normal. Vitamin tidak dapat diproduksi oleh tubuh (atau diproduksi dalam jumlah yang tidak mencukupi) dan harus diperoleh dari makanan atau sumber lain. Vitamin berbeda dengan suplemen, vitamin adalah zat atau senyawa organik kompleks yang berfungsi mengatur proses metabolism tertentu dalam tubuh, sedangkan suplemen adalah nutrisi yang digunakan untuk melengkapi makanan, terdiri dari satu atau lebih bahan yang dapat berupa vitamin, mineral, herbal atau tumbuhan, dan asam amino. Vitamin berasal dari makanan dan buah-buahan yang bersifat organik dan suplemen umumnya diproduksi secara mekanik, mengandung beberapa macam vitamin dan mineral yang diperlukan tubuh.</span></p><p class=\"ql-align-justify\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Suplemen:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Adalah produk yang dimaksudkan untuk melengkapi diet dan mengandung satu atau lebih bahan makanan, termasuk vitamin, mineral, herbal, asam amino, atau zat lainnya.</span></p><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Dengan kata lain: </span><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Vitamin adalah <em>salah satu jenis</em> nutrisi yang dapat terkandung dalam suplemen.</strong></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 1, 'Apa saja jenis vitamin itu?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Secara umum vitamin dibagi menjadi 2 tipe, meliputi vitamin yang larut dalam air dan vitamin yang larut dalam lemak. Vitamin yang larut dalam air, yaitu vitamin B dan C tidak dapat disimpan dalam jumlah banyak dalam tubuh dan akan dibuang melalui urine. Vitamin larut dalam lemak diantaranya adalah vitamin A, D, E dan K. Konsumsi vitamin ini harus berhati-hati, karena jika dosisnya terlalu tinggi akan terakumulasi dalam tubuh.</span></p><p><br></p><p><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Referensi:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Dra. apt. Tri Murti Andayani, Sp.FRS, PhD; drh. Retno Murwanti,MP, PhD (Dosen Departemen Farmakologi dan Farmasi Klinik, Fakultas Farmasi UGM).</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 1, 'Apa yang dimaksud dengan suplemen?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Suplemen merupakan produk yang mengandung satu atau lebih vitamin, mineral, asam amino, asam lemak dan serat. Selain itu, suplemen dapat berupa produk alami berupa herba atau bahan alami non tumbuhan, yang dikemas dalam bentuk tablet, pil, kapsul, kapsul lunak atau cairan. Saat ini banyak sekali jenis suplemen yang beredar di pasaran, seperti multivitamin yang mengandung tiga atau lebih vitamin dan mineral, seperti vitamin C, B, A, D3, E, K, tembaga, seng besi, kalsium, magnesium, dan lain-lain, atau suplemen nonvitamin nonmineral, seperti minyak ikan, probiotik, echinacea, suplemen bawang putih, dan lain-lain. </span><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Vitamin dan suplemen sebaiknya dikonsumsi saat tubuh memang membutuhkan saja</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">.&nbsp;</span></p><p class=\"ql-align-justify\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Referensi:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Dra. apt. Tri Murti Andayani, Sp.FRS, PhD; drh. Retno Murwanti,MP, PhD (Dosen Departemen Farmakologi dan Farmasi Klinik, Fakultas Farmasi UGM).</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Suplemen dapat diperoleh dari apotek dan supermarket, atau dokter umum dapat meresepkannya. Jika ingin mendapatkan asam folat dari tablet multivitamin, pastikan tablet tersebut tidak mengandung vitamin A (atau retinol)</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 1, 'Apakah Asam Folat diburuhkan sebelum dan selama kehamilan?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Penting untuk mengonsumsi tablet asam folat 400 mikrogram setiap hari sebelum hamil dan hingga usia kehamilan 12 minggu.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Asam folat dapat membantu mencegah cacat lahir yang dikenal sebagai cacat tabung saraf, termasuk spina bifida.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Jika tidak mengonsumsi asam folat sebelum hamil, mulailah segera setelah mengetahui bahwa Anda hamil. Sulit untuk mendapatkan jumlah folat yang direkomendasikan untuk kehamilan sehat hanya dari makanan, itulah sebabnya penting untuk mengonsumsi suplemen asam folat. Jika memiliki peluang lebih tinggi terkena cacat tabung saraf, disarankan untuk mengonsumsi asam folat dosis lebih tinggi (5 miligram) setiap hari hingga usia kehamilan 12 minggu</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Menurut Kemenkes RI, asam folat sangat penting untuk mencegah cacat pada sistem saraf bayi (neural tube defect/NTD) yang biasanya mulai berkembang pada 28 hari pertama setelah pembuahan. Wanita yang sedang menjalani program kehamilan disarankan mengonsumsi 400-800 mikrogram asam folat setiap hari sampai kehamilan mencapai usia 3 bulan.</span></p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 1, 'Apakah vitamin D dibutuhkan selama kehamilan?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Membutuhkan 10 mikrogram vitamin D setiap hari. Wanita hamil dan menyusui disarankan mengonsumsi suplemen harian tersebut.</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Vitamin D mengatur jumlah kalsium dan fosfat dalam tubuh, yang dibutuhkan untuk menjaga kesehatan tulang, gigi, dan otot. Tubuh membuat vitamin D saat kulit terpapar sinar matahari</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Vitamin D juga ada dalam beberapa makanan, termasuk ikan berminyak (seperti salmon, mackerel, herring, dan sarden), telur, dan daging merah. Vitamin D juga ditambahkan ke beberapa sereal sarapan, olesan lemak, dan alternatif susu non-dairy. Karena vitamin D hanya ditemukan dalam sejumlah kecil makanan, baik yang terjadi secara alami atau ditambahkan, sulit untuk mendapatkan cukup hanya dari makanan.&nbsp;</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Jangan mengonsumsi lebih dari 100 mikrogram (4.000 IU) vitamin D sehari karena dapat berbahaya. Menurut Kemenkes RI, ibu hamil atau ibu menyusui disarankan mengonsumsi 10 mikrogram vitamin D setiap hari.&nbsp;</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Vitamin D berperan dalam kesehatan tulang dan gigi, serta menunjang pertumbuhan tulang bayi1. Kekurangan vitamin D membuat anak-anak rentan mengalami pertumbuhan tulang yang abnormal.</span></p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, 'Apakah penting mengkonsumsi kalsium selama kehamilan?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Kalsium Selama Kehamilan Kalsium sangat penting untuk membuat tulang dan gigi bayi.&nbsp;</span></p><p class=\"ql-align-justify\"><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Menurut Kemenkes RI, kalsium dibutuhkan janin untuk membentuk tulang. Kalsium dapat ditemukan di makanan seperti tahu, tempe, kacang merah, susu kedelai, susu, keju, yoghurt, sayuran berdaun hijau, sarden, salmon, dan kacang-kacangan</span></p><p><br></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 1, 'Kemudian apa yang seharusnya dikonsumsi ibu hamil untuk menunjang kesehatan ibu dan anak?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Suplementasi Multimikronutrien (MMS)</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Kemenkes RI menekankan pentingnya ragam mikronutrien bagi ibu hamil. MMS memiliki kandungan gizi yang dibutuhkan oleh ibu hamil, sehingga dapat mengurangi berbagai risiko yang menyertai kehamilan, bayi lahir pendek, stunting, dan kematian bayi.</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 1, 'Bagaimana cara memilih suplememtasi untuk kehamilan?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Pilih suplementasi prenatal yang dimana setiap tablet MMS mengandung 10 vitamin (A, D, E, C, B1, B2, niasin, B6, B12, asam folat) dan 5 mineral (zat besi, zinc, tembaga, selenium, dan iodin). Kemenkes menyarankan ibu hamil mengonsumsi MMS selama 6 bulan masa kehamilan untuk mengurangi risiko BBLR (</span><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Berat Badan Lahir Rendah</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">, yaitu kondisi ketika bayi baru lahir memiliki berat badan kurang dari 2.500 gram atau 2,5 kg) dan stunting.</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 1, 'Kapan Waktu Terbaik untuk Minum Vitamin Prenatal?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p class=\"ql-align-justify\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Ketika Memutuskan untuk Menjalani Program Hamil:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Banyak dokter dan ahli kesehatan menyarankan agar mulai mengonsumsi suplemen prenatal sebelum kehamilan. Idealnya, vitamin prenatal dikonsumsi sebelum masa kehamilan, bahkan sejak tiga bulan sebelumnya. Hal tersebut akan membantu meningkatkan asupan vitamin dan mineral dalam tubuh dan mencegah potensi kekurangan selama kehamilan. Idealnya, suplemen prenatal harus dimulai setidaknya tiga bulan sebelum mencoba untuk hamil. Hal ini terutama berlaku untuk asam folat, yang penting untuk membantu mencegah cacat tabung saraf, yaitu kelainan serius pada otak dan sumsum tulang belakang bayi Perkembangan tabung saraf terjadi pada 28 hari pertama pembuahan, ketika banyak wanita masih belum menyadari kehamilan mereka. Penggunaan asam folat setidaknya 400 mikrogram sebelum konsepsi akan membantu mencegah penghilangan vitamin penting ini selama periode perkembangan awal yang penting.</span></p><p class=\"ql-align-justify\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Segera Setelah Mengetahui Hamil:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Jika belum mengonsumsi suplemen prenatal, mulailah segera setelah mendapatkan hasil tes kehamilan positif.</span></p><p class=\"ql-align-justify\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Setelah Sarapan:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Minum suplemen prenatal saat sarapan atau makan siang dapat menurunkan kemungkinan sakit perut atau asam lambung</span></p><p class=\"ql-align-justify\"><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Bersama Makanan:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Selalu konsumsi suplemen prenatal dengan makanan dan hindari saat perut kosong. Cobalah mengonsumsinya di siang hari atau sore hari daripada pagi hari.&nbsp;</span></p><p><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Kalsium:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Waktu terbaik untuk minum vitamin hamil ini tergantung jenisnya. Suplemen kalsium tersedia dalam dua bentuk, kalsium karbonat dan kalsium sitrat. Kalsium karbonat membutuhkan asam di lambung agar dapat diserap dengan baik, sehingga diminum setelah makan pada pagi hari. Kalsium sitrat dapat diminum dengan atau tanpa makan karena tubuh dapat menyerapnya dengan atau tanpa asam.</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 1, 'Apa saja suplemen prenatal terpenting yang perlu terkandung dalam suplemen prenatal yang dikonsumsi dan apa fungsi spesifiknya? ', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Asam folat, zat besi, dan kalsium adalah beberapa komponen terpenting dari suplemen prenatal.</span></p><p><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Asam folat:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Membantu mencegah cacat tabung saraf.</span></p><p><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Zat besi:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Mendukung pertumbuhan dan perkembangan bayi. Umum bagi ibu untuk mengalami kekurangan darah selama kehamilan karena volume darah meningkat. Suplementasi zat besi akan membantu mencegah kondisi tersebut.</span></p><p><strong style=\"background-color: transparent; color: rgb(0, 0, 0);\">Kalsium:</strong><span style=\"background-color: transparent; color: rgb(0, 0, 0);\"> Membantu perkembangan tulang bayi sambil mempertahankan kepadatan tulang ibu selama kehamilan.</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, ' Apakah semua jenis suplemen prenatal sama?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Terdapat Ada banyak formulasi suplemen prenatal yang berbeda tersedia, dengan konsentrasi setiap nutrisi yang berbeda. Tidak semua suplemen prenatal mengandung asam omega-3, yang mungkin berguna untuk meningkatkan perkembangan otak dan mata bayi. Jika Ibu hamil tidak bisa makan dengan kandungan ikan atau makanan tinggi asam omega-3 yang cukup tinggi, maka Anda dapat mempertimbangkan komponen omega-3 terdapat didalam pilihan suplemen prenatal.</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, 'Apa yang harus Ibu Hamil lakukan jika Anda mengalami morning sickness dan muntah?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Cobalah untuk mengonsumsi suplemen di malam hari sebelum tidur sehingga Ibu dapat tidur melewati rasa mual. Atau, dapat mencoba jenis suplemen prenatal alternatif lainnya. Cari penilaian lebih lanjut dari dokter Anda jika Anda tidak dapat menahan suplemen tersebut.</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 1, 'Apa saja risiko kesehatan, jika ada, saat mengonsumsi suplemen prenatal?', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p><span style=\"background-color: transparent; color: rgb(0, 0, 0);\">Waspadai kandungan suplemen prenatal yang dipilih di luar resep. Sebagian besar persiapan aman. Namun, merek-merek tertentu mungkin tidak cocok untuk kehamilan karena mungkin mengandung terlalu banyak nutrisi tertentu, yang membahayakan kesehatan bayi.</span></p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pdffile` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `files`
--

INSERT INTO `files` (`id`, `title`, `category_id`, `pdffile`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'empat', 2, 'dsdf - Copy (4).pdf', 'GRUm-LOa0AAi-f9.jpeg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Tumbang Anak Sehat', 1, 'Tumbang Anak Sehat_compressed.pdf', 'Tumbang Anak Sehat_compressed_.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Persiapan Kehamilan Untuk Calon Pengantin', 1, 'Persiapan Kehamilan Untuk Calon Pengantin.pdf', 'Persiapan Kehamilan Untuk Calon Pengantin.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Pencegahan Stunting Bagi Ibu Hamil', 1, 'Pencegahan Stunting bagi Ibu Hamil.pdf', 'Pencegahan Stunting bagi Ibu Hamil.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `filescategories`
--

CREATE TABLE `filescategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `filescategories`
--

INSERT INTO `filescategories` (`id`, `name`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 'Modul', '2025-03-08 10:37:41', '2025-03-08 10:37:41', '2025-03-08 10:37:41'),
(2, 'Flayer', '2025-03-08 10:37:41', '2025-03-08 10:37:41', '2025-03-08 10:37:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1716561190, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1716561190, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1716561190, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `body`, `user_id`, `user_name`, `category`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 'example 55i3838', 'tutup.png', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><p>fad dsf asdf asdf asdf asdf asd f</p></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" rel=\"noopener noreferrer\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', 1, 'Admin', 'farmasi', '2025-04-19 13:08:37', '2025-04-19 13:08:37', '2025-04-19 13:08:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, 1, NULL, '2024-05-25 04:34:13', '2024-05-25 04:34:14', NULL),
(2, 'admin2', NULL, NULL, 1, NULL, '2024-06-03 02:19:23', '2024-06-03 02:19:24', NULL),
(3, 'admin3', NULL, NULL, 1, NULL, '2024-06-07 01:56:03', '2024-06-07 01:56:04', NULL),
(4, 'admin4', NULL, NULL, 1, NULL, '2025-02-13 03:34:35', '2025-02-13 03:34:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`post_id`);

--
-- Indeks untuk tabel `faqcategories`
--
ALTER TABLE `faqcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `filescategories`
--
ALTER TABLE `filescategories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faqcategories`
--
ALTER TABLE `faqcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `filescategories`
--
ALTER TABLE `filescategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
