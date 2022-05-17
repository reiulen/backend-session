-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 04:19 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
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
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `judul`, `slug`, `created_at`, `updated_at`) VALUES
(6, 'Porak Hari Ke 1 Futsal', '1-porak-hari-ke-1-futsal', '2021-12-17 11:06:56', '2021-12-17 11:06:56'),
(9, 'Porak Voli', '7-porak-voli', '2021-12-17 11:27:17', '2021-12-17 11:27:17'),
(12, 'Ngaliwetttt', '10-ngaliwetttt', '2021-12-21 12:20:52', '2021-12-21 12:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `gambars`
--

CREATE TABLE `gambars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gambars`
--

INSERT INTO `gambars` (`id`, `filename`, `gallery_id`, `created_at`, `updated_at`) VALUES
(15, 'upload/gallery/mTqOheGSouGDJgse7CZPC9LM2VXzpuk5Iav4ULKe.jpg', 6, '2021-12-17 11:06:56', '2021-12-17 11:06:56'),
(16, 'upload/gallery/H9ihLTaTeISWGR1K4aP5gQcI0G3er9DGm8EMGg5W.jpg', 6, '2021-12-17 11:06:56', '2021-12-17 11:06:56'),
(17, 'upload/gallery/PwDZCZ1ox3JWDfmf4pTA6IIUMgLS8LDNyKYPubK3.jpg', 6, '2021-12-17 11:06:56', '2021-12-17 11:06:56'),
(18, 'upload/gallery/flGsFPP1ni7dam1Hfa20KvQYHBYN04p2vnvRYdKA.jpg', 6, '2021-12-17 11:06:56', '2021-12-17 11:06:56'),
(29, 'upload/gallery/KcJ7HlqMZDwnDNPcLejdw6YXnGc0WzPifDmbPEEP.jpg', 9, '2021-12-17 11:27:17', '2021-12-17 11:27:17'),
(30, 'upload/gallery/NHSyVu3toSWkqtUTDFucUNb2PETAaUITvGwd6jtF.jpg', 9, '2021-12-17 11:27:17', '2021-12-17 11:27:17'),
(31, 'upload/gallery/BMFNoyOo9vSE2c035xJJxyqDgQP4ZLNK4zC3HwYf.jpg', 9, '2021-12-17 11:27:17', '2021-12-17 11:27:17'),
(32, 'upload/gallery/5gLbioVdNkWkR13INvahnqIcw90OqM8tk4yZzpU8.jpg', 9, '2021-12-17 11:27:17', '2021-12-17 11:27:17'),
(37, 'upload/gallery/sp7OHvo7bv5AhZ1noCErdNG7aTTJDfJsZDQ57tFp.jpg', 12, '2021-12-21 12:20:52', '2021-12-21 12:20:52'),
(38, 'upload/gallery/CleccHIb9iGRswQ4jl1YJwMDvY6K7gw1r3z9lnm1.jpg', 12, '2021-12-21 12:20:52', '2021-12-21 12:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `slug`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'pengetahuan', 'Pengetahuan', '2021-12-10 21:57:14', '2021-12-14 15:29:10'),
(2, 'desain-grafis', 'Desain Grafis', '2021-12-10 21:57:31', '2021-12-10 21:57:31'),
(6, 'berita', 'Berita', '2021-12-17 12:21:11', '2021-12-17 12:21:11');

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
(5, '2021_12_11_043320_create_posts_table', 2),
(6, '2021_12_11_044033_create_posts_table', 3),
(7, '2021_12_11_044135_create_posts_table', 4),
(8, '2021_12_11_044439_create_posts_table', 5),
(9, '2021_12_11_044602_create_kategoris_table', 6),
(10, '2021_12_11_050256_create_posts_table', 7),
(11, '2021_12_11_121517_create_posts_table', 8),
(12, '2021_12_12_232531_create_projects_table', 9),
(13, '2021_12_15_112002_create_galleries_table', 10),
(14, '2021_12_15_142822_create_gambars_table', 11),
(15, '2021_12_15_143129_create_gambars_table', 12);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Publish','Pending','Draft') COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `judul`, `slug`, `kategori_id`, `thumbnail`, `tag`, `status`, `isi`, `views`, `created_at`, `updated_at`) VALUES
(12, 1, 'Pekan Olahraga Antar Kelas SMK Negeri 1 Ciamis', 'pekan-olahraga-antar-kelas-smk-negeri-1-ciamis', 6, 'upload/thumbnail/GDNOClDiJVDpeR1JfQQ5wmXeyQtbQARgkMhC1l9D.jpg', 'Berita,Berita terbaru,Berita t,SMKN 1 ciamis,Berita SMKN 1 ciamis', 'Publish', '<h2>What is Lorem Ipsum?</h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><h2>Where can I get some?</h2><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 45, '2021-12-15 07:41:47', '2022-02-02 12:30:31'),
(13, 1, 'Session Class', 'session-class', 1, 'upload/thumbnail/lNB0CxmxBr5eArKIXTfBornPb0Z1OtAiBZQScDGF.jpg', 'sessionclass', 'Publish', '<p><a class=\" uppercase lg:justify-start justify-center text-2xl index-sesion text-white/80 lg:text-2xl\" style=\"border: 0px solid rgb(229, 231, 235); --tw-translate-x:0; --tw-translate-y:0; --tw-rotate:0; --tw-skew-x:0; --tw-skew-y:0; --tw-scale-x:1; --tw-scale-y:1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness:proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width:0px; --tw-ring-offset-color:#fff; --tw-ring-color:rgb(59 130 246/0.5); --tw-ring-offset-shadow:0 0 #0000; --tw-ring-shadow:0 0 #0000; --tw-shadow:0 0 #0000; --tw-shadow-colored:0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; text-decoration-line: inherit; justify-content: flex-start; font-size: 1.5rem; text-transform: uppercase; font-family: &quot;Encode Sans&quot;, sans-serif !important;\"><font color=\"#000000\" style=\"\"><span style=\"background-color: rgb(255, 255, 255);\">SESSION&nbsp;</span><span class=\"font-bold ml-1 text-white\" style=\"border: 0px solid rgb(229, 231, 235); --tw-translate-x:0; --tw-translate-y:0; --tw-rotate:0; --tw-skew-x:0; --tw-skew-y:0; --tw-scale-x:1; --tw-scale-y:1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness:proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width:0px; --tw-ring-offset-color:#fff; --tw-ring-color:rgb(59 130 246/0.5); --tw-ring-offset-shadow:0 0 #0000; --tw-ring-shadow:0 0 #0000; --tw-shadow:0 0 #0000; --tw-shadow-colored:0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 700; --tw-text-opacity:1; background-color: rgb(255, 255, 255);\"><font color=\"#000000\" style=\"\">CLASS</font></span></font></a></p><p style=\"border: 0px solid rgb(229, 231, 235); --tw-translate-x:0; --tw-translate-y:0; --tw-rotate:0; --tw-skew-x:0; --tw-skew-y:0; --tw-scale-x:1; --tw-scale-y:1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness:proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width:0px; --tw-ring-offset-color:#fff; --tw-ring-color:rgb(59 130 246/0.5); --tw-ring-offset-shadow:0 0 #0000; --tw-ring-shadow:0 0 #0000; --tw-shadow:0 0 #0000; --tw-shadow-colored:0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: Poppins, Arial, sans-serif; font-size: medium;\"><font color=\"#000000\" style=\"background-color: rgb(255, 255, 255);\">Session adalah nama kelas generasi ke 6 Jurusan Rekayasa Perangkat Lunak di SMK Negeri 1 Ciamis</font></p><p style=\"border: 0px solid rgb(229, 231, 235); --tw-translate-x:0; --tw-translate-y:0; --tw-rotate:0; --tw-skew-x:0; --tw-skew-y:0; --tw-scale-x:1; --tw-scale-y:1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness:proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width:0px; --tw-ring-offset-color:#fff; --tw-ring-color:rgb(59 130 246/0.5); --tw-ring-offset-shadow:0 0 #0000; --tw-ring-shadow:0 0 #0000; --tw-shadow:0 0 #0000; --tw-shadow-colored:0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: Poppins, Arial, sans-serif; font-size: medium;\"><font color=\"#000000\" style=\"background-color: rgb(255, 255, 255);\"><br></font></p><p style=\"text-align: center; \"><img src=\"http://127.0.0.1:8000/upload/content/content_20220212181957.jpeg\" style=\"width: 100%;\"><img src=\"http://127.0.0.1:8000/upload/content/content_20220212182007.jpeg\" style=\"width: 25%;\"><img src=\"http://127.0.0.1:8000/upload/content/content_20220212182015.jpeg\" style=\"width: 25%;\"><img src=\"http://127.0.0.1:8000/upload/content/content_20220212182022.jpeg\" style=\"width: 25%;\"></p><p style=\"text-align: center; \"><img src=\"http://127.0.0.1:8000/upload/content/content_20220212182211.jpg\" style=\"width: 50%;\"><br></p>', 0, '2022-02-12 11:21:07', '2022-05-17 04:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `thumbnail`, `judul`, `link`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'upload/project/vULfYn1bz3Dj89A79Uz9g9PA4A1wjoYXY9RIR6Om.png', 'E Perpus - Sistem Peminjaman Buku Siswa dan Management Perpustakaan', 'http://reihanpraja.me', 'Dibuat dengan Bootstrap 5 dan Laravel', '2021-12-13 11:06:28', '2022-02-02 12:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nis`, `nama`, `email`, `avatar`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 192010568, 'Reihan Andika MMM', 'reiandika10@gmail.com', 'upload/avatar/avatar_20220202192607_300_x_300.jpg', 'Admin', '$2y$10$Oebj.aMh.X0bu8912BrUBu3q632xWdeqlQg3IKwV.6I/44Qy6u7c6', NULL, '2021-12-10 17:42:05', '2022-02-02 12:26:07'),
(33, 192010541, '192010541', '192010541@gmail.com', 'upload/avatar/avatar_20220202192549_300_x_300.jpg', 'Siswa', '$2y$10$zYYNHxFr5RS42htYNCviJuKzl2eOLytp.TnQi0HrVVoRRI2VcbMFW', NULL, NULL, '2022-02-02 12:25:50'),
(34, 192010542, '192010542', '192010542@gmail.com', 'upload/avatar/avatar_20211221220927_300_x_300.png', 'Siswa', '$2y$10$QBmokzFvkEdB6K5JQsca0./uExdJSACcYvI8uFAfe2Y3ks4QKSryy', NULL, NULL, '2021-12-21 22:09:27'),
(35, 192010543, '192010543', '192010543@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$.yYEh6zEDcqcx6CHuVimz.dc1nd4P.jw215uQs6cl3FcWAj6gkfim', NULL, NULL, NULL),
(36, 192010544, '192010544', '192010544@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$7fnPPyvjZX8fQ55t.fRPr.b.iV0cOucRy5S5ABCWPPDJNOUIIuTeK', NULL, NULL, NULL),
(37, 192010545, '192010545', '192010545@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$NK1TeNe5Ix.Rnb5z0IMCHOR17jVmP0HC71zL.Sv9alk.59gidynou', NULL, NULL, NULL),
(38, 192010546, '192010546', '192010546@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$f8FZ/Pq1KNVCHICX2XJ3v.MNyBG2NyEanf20tGiZHjub0i1F.2ny2', NULL, NULL, NULL),
(39, 192010547, '192010547', '192010547@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$U7M5Av.fCuU650wN4FF2OO.FJStvo2q3DN0pWNcj2tS5Rh/dTi6uy', NULL, NULL, NULL),
(40, 192010548, '192010548', '192010548@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$qiSPCeTqvlzrN9AHh80b8eEcRjrJ/vX4G3C22mV0Dwx5xSsub.T2G', NULL, NULL, NULL),
(41, 192010549, '192010549', '192010549@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$4oapx/RlV3deLMYbznjlHe34hRgjI.74JoeYJI2TGh0.aAqnktOz6', NULL, NULL, NULL),
(42, 192010550, '192010550', '192010550@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$/UGaW.TgpIURNm5VmNg.PuMJxw3NOzsrlZoFf8xdxGgfTFLmMEpc2', NULL, NULL, NULL),
(43, 192010551, '192010551', '192010551@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$uRoz9PV8Ya9KvQnXm9r8D.vxPsxBcJffSvLr9.s2cjsjJWXNmE6G.', NULL, NULL, NULL),
(44, 192010552, '192010552', '192010552@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$gJkCSXlIJgJCwTxOkzkjxeQ9Rea8d3N43ab4PWyqj.vVFwyNmivKa', NULL, NULL, NULL),
(45, 192010553, '192010553', '192010553@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$po.7ztZ.ZWJIg1rhcEfVS.BSe56OmIl.S3A8AG5jbfEpvG.DdVkH6', NULL, NULL, NULL),
(46, 192010554, '192010554', '192010554@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$LJzWSmePBB4vm74UoyjOdOTUgIRA3hHppDMiII2WS/uEJ9kaHJLQi', NULL, NULL, NULL),
(47, 192010555, '192010555', '192010555@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$QBN25S.IrClCchMolaXj6u5iQ2EWfgWwecnMTRvbFZxOCEe.RX0QW', NULL, NULL, NULL),
(48, 192010556, '192010556', '192010556@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$QoewAjUQpwWb4dDLrAVDWOXOiBv9acbNM3ycS7h2kobUB0EYTg1gu', NULL, NULL, NULL),
(49, 192010557, '192010557', '192010557@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$yHxZ4w3s.Pj.1kE7IS.5ROtO2tJH9tQJQ0IpxoADI68Cq.W7fo7hq', NULL, NULL, NULL),
(50, 192010558, '192010558', '192010558@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$9fD/KUaHJ65CqufKXQQyku82elug0X1UxW9heobJ6j1dkJipbvAL.', NULL, NULL, NULL),
(51, 192010559, '192010559', '192010559@gmail.com', 'upload/avatar/avatar_20211221215153_300_x_300.jpg', 'Siswa', '$2y$10$2yaiZa1mszbh0GkBrVPMf.kiaeBpY0TgEhik53gOqyCoZB.zgsQie', NULL, NULL, '2021-12-21 21:51:53'),
(52, 192010560, '192010560', '192010560@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$pK6mgTlxx2QvghADP1oq7eswk83K9a53q1jF8C257No2g9Vl4mOfu', NULL, NULL, NULL),
(53, 192010561, '192010561', '192010561@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$6fJRmWCQt.qKnNUAkhD3hewnUVpeS0WO19TxhOcOBCvOR8u1ydRLi', NULL, NULL, NULL),
(54, 192010562, '192010562', '192010562@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$6jE3NWgsLFDdvHzvotugOuOq3EnMupfjLgxlqtlLXJ5jY6JVB/SDm', NULL, NULL, NULL),
(55, 192010563, '192010563', '192010563@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$dmHZdS1jVZUGGy1fUteY0OZewmB4UygL0rYlT.5fDidIG43ZGmSe.', NULL, NULL, NULL),
(56, 192010564, '192010564', '192010564@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$Iv20I3L2ouN565yvAWmY7.2.eeozmY2l0tMogHR.JsBTahfZCChCm', NULL, NULL, NULL),
(57, 192010565, '192010565', '192010565@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$2ZJTYJMV58DTKuGDO2zy..clMyhABocATUdU/7Vgjz90ifJKGcojS', NULL, NULL, NULL),
(58, 192010566, '192010566', '192010566@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$r4njPiMyZ27KhTDLeUHgY.ijYkIUudXfWGFKtuUyiKMKhzkDVvXj.', NULL, NULL, NULL),
(59, 192010567, '192010567', '192010567@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$b8IWPeirKE8jeOFqSCH7juwmb9vtag6/GXfviX918Fo4Gd0qhLeyW', NULL, NULL, NULL),
(60, 192010569, '192010569', '192010569@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$KFCJpUeNTQA6P1/O1HGtgemPp/3HBe3Y53h2afoeLITHLghyswWOK', NULL, NULL, NULL),
(61, 192010570, '192010570', '192010570@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$JBXaBt2JPLjA7t.EBIoP5.1OnjhVvjoCwNZCO9S0ASO0FXRFQdmZO', NULL, NULL, NULL),
(62, 192010571, 'S kemal Pasha', '192010571@gmail.com', 'upload/avatar/avatar_20211221220622_300_x_300.jpg', 'Siswa', '$2y$10$XMYkzZIGSx9wMNcC2/kl8euvnTKKf9yQfwlTMDBj8YeH/pxntLPm.', NULL, NULL, '2021-12-21 22:06:46'),
(63, 192010572, 'Septi Gunawan', '192010572@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$mDtWcvjSpmXC5C4llMYn4.AFtUd1c6QNavbZJLzEu2yBEGeMQmEDa', NULL, NULL, '2021-12-21 22:09:22'),
(64, 192010573, '192010573', '192010573@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$G23ckzHJmWgM5KEAgGGAl.RLAlXJ68eN54rEqXsc3HvbVYvMTJOXC', NULL, NULL, NULL),
(65, 192010574, '192010574', '192010574@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$3K0hhjn8uG0p41rRvrbEeeWDogXrGAA3bneI7T6knCqDxZtX5h0ZS', NULL, NULL, NULL),
(66, 192010575, '192010575', '192010575@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$3/YRQD7lnRwdUEJyCvXqBOM7oErt//7b7oh7sFwvWmj2IRoecDyBS', NULL, NULL, NULL),
(67, 192010576, '192010576', '192010576@gmail.com', 'upload/avatar/user.png', 'Siswa', '$2y$10$xnxRT2A.3/GfKfF9Dqzw3eDSO/tzMPWml5972ffAvZM3eFZQiwJdW', NULL, NULL, NULL);

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
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambars`
--
ALTER TABLE `gambars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nis_unique` (`nis`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gambars`
--
ALTER TABLE `gambars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
