-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Mar 2022 pada 18.43
-- Versi server: 10.3.34-MariaDB-cll-lve
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enue1435_online2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_app` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggalBuka` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggalTutup` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jamBuka` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jamTutup` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_app`, `tanggalBuka`, `tanggalTutup`, `jamBuka`, `jamTutup`, `updated_at`) VALUES
(2, 'Ujian', '1225', '1227', '0800', '2100', '2021-09-23 07:03:03'),
(3, 'tryout', '1215', '1218', '0800', '2000', NULL),
(5, 'pendaftaran', '1', '1219', '0500', '2300', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(100) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `keterangan`, `foto`) VALUES
(1, 'EMJ Enura Institute', 'DONE', 'event.jpeg'),
(2, 'RE-SCIENCE', 'Dealine: 27 Nov 2021', '041337_2_re-science.jpg'),
(3, 'KSN EMP 2021', 'Done', '051817_3_EMP JADI.jpg'),
(4, 'COMING SOON', '', 'comingsoon.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_bidang` char(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`id`, `nama_bidang`) VALUES
(1, 'SDMatematika'),
(2, 'SDInggris'),
(3, 'SDIpa'),
(4, 'SMPMatematika'),
(5, 'SMPInggris'),
(6, 'SMPIpa'),
(7, 'SMPIps'),
(8, 'SMAMatematika'),
(9, 'SMAInggris'),
(10, 'SMAIpa'),
(11, 'SMAIps'),
(12, 'SDtrMatematika'),
(13, 'SDtrInggris'),
(14, 'SDtrIpa'),
(15, 'SmptrMatematika'),
(16, 'SmptrInggris'),
(17, 'SmptrIpa'),
(18, 'SmptrIps'),
(19, 'SmatrMatematika'),
(20, 'SmatrInggris'),
(21, 'SmatrIpa'),
(22, 'SmatrIps'),
(23, 'SD1Matematika'),
(24, 'SD1Ipa'),
(25, 'SD1Iinggris'),
(26, 'SD1fnMatematika'),
(27, 'SD1fnInggris'),
(28, 'SD1fnIpa'),
(29, 'SD1fnIps'),
(30, 'SD2fnInggris'),
(31, 'SD2fnIpa'),
(32, 'SD2fnIps'),
(33, 'SMPfnMatematika'),
(34, 'SMPfnInggris'),
(35, 'SMPfnIpa'),
(36, 'SMPfnIps'),
(37, 'SMAfnMatematika'),
(38, 'SMAfnInggris'),
(39, 'SMAfnIpa'),
(40, 'SMAfnIps'),
(41, 'SD2fnMatematika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_menu` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_menu` varchar(252) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_menu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_menu` int(11) DEFAULT NULL,
  `foto_menu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_menu` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` tinyint(1) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_tag`
--

CREATE TABLE `menu_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_transaksi`
--

CREATE TABLE `menu_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_19_100048_menu', 1),
(5, '2021_01_19_100152_tag', 1),
(6, '2021_01_21_034246_create_toko_table', 1),
(7, '2021_01_21_042736_create_menu_tag_table', 1),
(8, '2021_01_21_043425_create_transaksi_table', 1),
(9, '2021_01_30_144712_menu_transaksi_table', 1),
(10, '2021_02_06_093142_create_roles_table', 1),
(11, '2021_02_06_093418_create_role_users_table', 1),
(12, '2021_08_22_061940_create_bidang_table', 1),
(13, '2021_08_22_062458_create_soal_table', 1),
(14, '2021_08_22_063905_create_piagam_table', 1),
(15, '2021_08_22_063914_create_sertif_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.com', '$2y$10$4aVdC.TEbUf2U44oC/cHzuLV7V3qxyXXOauPbctaKTG3K1n/wkJni', '2021-09-04 00:57:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `piagam`
--

CREATE TABLE `piagam` (
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', NULL, NULL),
(2, 'admin', NULL, NULL),
(3, 'kasir', NULL, NULL),
(4, 'peserta', NULL, NULL),
(5, 'sd', NULL, NULL),
(6, 'smp', NULL, NULL),
(7, 'sma', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_users`
--

CREATE TABLE `role_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`) VALUES
(4, 2),
(1003, 6),
(1005, 7),
(1008, 6),
(1011, 6),
(1017, 6),
(1026, 6),
(1027, 6),
(1029, 6),
(1030, 6),
(1032, 6),
(1050, 6),
(1051, 6),
(1056, 6),
(1058, 6),
(1062, 6),
(1064, 6),
(1065, 6),
(1067, 6),
(1068, 6),
(1069, 6),
(1070, 6),
(1073, 6),
(1074, 6),
(1075, 6),
(1076, 6),
(1078, 6),
(1079, 6),
(1080, 6),
(1081, 6),
(1086, 6),
(1088, 6),
(1089, 6),
(1091, 6),
(1099, 7),
(1100, 7),
(1101, 6),
(1102, 6),
(1103, 6),
(1106, 7),
(1108, 7),
(1112, 6),
(1113, 6),
(1114, 7),
(1124, 6),
(1130, 6),
(1133, 6),
(1142, 6),
(1144, 6),
(1148, 7),
(1150, 6),
(1154, 6),
(1155, 6),
(1157, 6),
(1159, 6),
(1160, 6),
(1161, 6),
(1171, 6),
(1172, 6),
(1175, 6),
(1178, 6),
(1196, 7),
(1199, 6),
(1206, 6),
(1212, 7),
(1223, 6),
(1245, 6),
(1248, 6),
(1249, 6),
(1250, 6),
(1251, 6),
(1252, 6),
(1253, 6),
(1254, 6),
(1255, 7),
(1256, 7),
(1258, 7),
(1259, 7),
(1260, 6),
(1261, 6),
(1262, 6),
(1263, 6),
(1264, 6),
(1265, 6),
(1266, 6),
(1267, 6),
(1268, 6),
(1269, 6),
(1270, 6),
(1274, 6),
(1277, 6),
(1278, 6),
(1280, 6),
(1281, 6),
(1282, 6),
(1283, 6),
(1284, 6),
(1285, 6),
(1286, 6),
(1287, 6),
(1288, 6),
(1289, 6),
(1292, 6),
(1294, 6),
(1305, 6),
(1306, 6),
(1309, 7),
(1314, 6),
(1315, 6),
(1316, 6),
(1317, 6),
(1318, 7),
(1321, 6),
(1324, 6),
(1325, 6),
(1326, 6),
(1327, 6),
(1332, 6),
(1333, 6),
(1334, 6),
(1335, 6),
(1336, 6),
(1337, 7),
(1338, 7),
(1339, 7),
(1340, 7),
(1341, 7),
(1342, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertif`
--

CREATE TABLE `sertif` (
  `id` int(10) UNSIGNED NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `peringkat` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sertif`
--

INSERT INTO `sertif` (`id`, `foto`, `user_id`, `peringkat`, `nilai`) VALUES
(1, 'GOLD MATEMATIKA SD', 1330, '1', 145),
(2, 'GOLD MATEMATIKA SD', 1331, '2', 145),
(3, 'GOLD MATEMATIKA SD', 1290, '3', 140),
(4, 'SILVER MATEMATIKA SD', 1129, '4', 140),
(5, 'SILVER MATEMATIKA SD', 1025, '5', 135),
(6, 'SILVER MATEMATIKA SD', 1145, '6', 135),
(7, 'BRONZE MATEMATIKA SD', 1176, '7', 135),
(8, 'BRONZE MATEMATIKA SD', 1047, '8', 130),
(9, 'BRONZE MATEMATIKA SD', 1126, '9', 120),
(10, 'BRONZE MATEMATIKA SD', 1291, '10', 115),
(11, 'PESERTA MATEMATIKA SD', 1119, '11', 115),
(12, 'PESERTA MATEMATIKA SD', 1134, '12', 115),
(13, 'PESERTA MATEMATIKA SD', 1140, '13', 115),
(14, 'PESERTA MATEMATIKA SD', 1177, '14', 115),
(15, 'PESERTA MATEMATIKA SD', 1180, '15', 115),
(16, 'PESERTA MATEMATIKA SD', 1054, '16', 110),
(17, 'PESERTA MATEMATIKA SD', 1138, '17', 110),
(18, 'PESERTA MATEMATIKA SD', 1139, '18', 110),
(19, 'PESERTA MATEMATIKA SD', 1190, '19', 110),
(20, 'PESERTA MATEMATIKA SD', 1193, '20', 110),
(21, 'PESERTA MATEMATIKA SD', 1194, '21', 110),
(22, 'PESERTA MATEMATIKA SD', 1207, '22', 110),
(23, 'PESERTA MATEMATIKA SD', 1208, '23', 110),
(24, 'PESERTA MATEMATIKA SD', 1227, '24', 110),
(25, 'PESERTA MATEMATIKA SD', 1228, '25', 110),
(26, 'PESERTA MATEMATIKA SD', 1028, '26', 105),
(27, 'PESERTA MATEMATIKA SD', 1115, '27', 105),
(28, 'PESERTA MATEMATIKA SD', 1295, '28', 100),
(29, 'PESERTA MATEMATIKA SD', 1105, '29', 100),
(30, 'PESERTA MATEMATIKA SD', 1043, '30', 90),
(31, 'PESERTA MATEMATIKA SD', 1063, '31', 90),
(32, 'PESERTA MATEMATIKA SD', 1136, '32', 90),
(33, 'PESERTA MATEMATIKA SD', 1166, '33', 90),
(34, 'PESERTA MATEMATIKA SD', 1167, '34', 90),
(35, 'PESERTA MATEMATIKA SD', 1312, '35', 85),
(36, 'PESERTA MATEMATIKA SD', 1041, '36', 75),
(37, 'PESERTA MATEMATIKA SD', 1271, '37', 65),
(38, 'PESERTA MATEMATIKA SD', 1313, '38', 50),
(39, 'PESERTA MATEMATIKA SD', 1128, '39', 35),
(40, 'PESERTA MATEMATIKA SD', 1272, '40', 35),
(41, 'GOLD IPA SD', 1323, '1', 150),
(42, 'GOLD IPA SD', 1328, '2', 145),
(43, 'GOLD IPA SD', 1329, '3', 145),
(44, 'SILVER IPA SD', 1090, '4', 130),
(45, 'SILVER IPA SD', 1104, '5', 130),
(46, 'SILVER IPA SD', 1126, '6', 130),
(47, 'BRONZE IPA SD', 1111, '7', 125),
(48, 'BRONZE IPA SD', 1137, '8', 125),
(49, 'BRONZE IPA SD', 1273, '9', 125),
(50, 'BRONZE IPA SD', 1115, '10', 120),
(51, 'PESERTA IPA SD', 1183, '11', 120),
(52, 'PESERTA IPA SD', 1215, '12', 120),
(53, 'PESERTA IPA SD', 1217, '13', 120),
(54, 'PESERTA IPA SD', 1220, '14', 120),
(55, 'PESERTA IPA SD', 1221, '15', 120),
(56, 'PESERTA IPA SD', 1276, '16', 120),
(57, 'PESERTA IPA SD', 1040, '17', 115),
(58, 'PESERTA IPA SD', 1298, '18', 115),
(59, 'PESERTA IPA SD', 1059, '19', 115),
(60, 'PESERTA IPA SD', 1119, '20', 115),
(61, 'PESERTA IPA SD', 1202, '21', 115),
(62, 'PESERTA IPA SD', 1203, '22', 115),
(63, 'PESERTA IPA SD', 1228, '23', 115),
(64, 'PESERTA IPA SD', 1257, '24', 115),
(65, 'PESERTA IPA SD', 1084, '25', 110),
(66, 'PESERTA IPA SD', 1146, '26', 110),
(67, 'PESERTA IPA SD', 1198, '27', 110),
(68, 'PESERTA IPA SD', 1204, '28', 110),
(69, 'PESERTA IPA SD', 1222, '29', 110),
(70, 'PESERTA IPA SD', 1225, '30', 110),
(71, 'PESERTA IPA SD', 1044, '31', 105),
(72, 'PESERTA IPA SD', 1117, '32', 105),
(73, 'PESERTA IPA SD', 1162, '33', 105),
(74, 'PESERTA IPA SD', 1190, '34', 105),
(75, 'PESERTA IPA SD', 1193, '35', 105),
(76, 'PESERTA IPA SD', 1194, '36', 105),
(77, 'PESERTA IPA SD', 1167, '37', 100),
(78, 'PESERTA IPA SD', 1213, '38', 100),
(79, 'PESERTA IPA SD', 1063, '39', 95),
(80, 'PESERTA IPA SD', 1128, '40', 95),
(81, 'PESERTA IPA SD', 1153, '41', 95),
(82, 'PESERTA IPA SD', 1188, '42', 95),
(83, 'PESERTA IPA SD', 1240, '43', 95),
(84, 'PESERTA IPA SD', 1045, '44', 90),
(85, 'PESERTA IPA SD', 1313, '45', 85),
(86, 'PESERTA IPA SD', 1275, '46', 80),
(87, 'PESERTA IPA SD', 1243, '47', 75),
(88, 'PESERTA IPA SD', 1205, '48', 70),
(89, 'PESERTA IPA SD', 1046, '49', 65),
(90, 'GOLD MATEMATIKA SMP', 1332, '1', 145),
(91, 'GOLD MATEMATIKA SMP', 1321, '2', 140),
(92, 'GOLD MATEMATIKA SMP', 1333, '3', 140),
(93, 'SILVER MATEMATIKA SMP', 1171, '4', 130),
(94, 'SILVER MATEMATIKA SMP', 1199, '5', 125),
(95, 'SILVER MATEMATIKA SMP', 1088, '6', 120),
(96, 'BRONZE MATEMATIKA SMP', 1223, '7', 120),
(97, 'BRONZE MATEMATIKA SMP', 1268, '8', 120),
(98, 'BRONZE MATEMATIKA SMP', 1263, '9', 115),
(99, 'BRONZE MATEMATIKA SMP', 1144, '10', 110),
(100, 'PESERTA MATEMATIKA SMP', 1149, '11', 110),
(101, 'PESERTA MATEMATIKA SMP', 1267, '12', 110),
(102, 'PESERTA MATEMATIKA SMP', 1027, '13', 105),
(103, 'PESERTA MATEMATIKA SMP', 1103, '14', 100),
(104, 'PESERTA MATEMATIKA SMP', 1091, '15', 95),
(105, 'PESERTA MATEMATIKA SMP', 1283, '16', 90),
(106, 'PESERTA MATEMATIKA SMP', 1285, '17', 90),
(107, 'PESERTA MATEMATIKA SMP', 1056, '18', 90),
(108, 'PESERTA MATEMATIKA SMP', 1113, '19', 90),
(109, 'PESERTA MATEMATIKA SMP', 1264, '20', 90),
(110, 'PESERTA MATEMATIKA SMP', 1269, '21', 90),
(111, 'PESERTA MATEMATIKA SMP', 1058, '22', 85),
(112, 'PESERTA MATEMATIKA SMP', 1175, '23', 85),
(113, 'PESERTA MATEMATIKA SMP', 1252, '24', 85),
(114, 'PESERTA MATEMATIKA SMP', 1030, '25', 80),
(115, 'PESERTA MATEMATIKA SMP', 1305, '26', 80),
(116, 'PESERTA MATEMATIKA SMP', 1075, '27', 80),
(117, 'PESERTA MATEMATIKA SMP', 1315, '28', 75),
(118, 'PESERTA MATEMATIKA SMP', 1064, '29', 75),
(119, 'PESERTA MATEMATIKA SMP', 1261, '30', 75),
(120, 'PESERTA MATEMATIKA SMP', 1086, '31', 70),
(121, 'PESERTA MATEMATIKA SMP', 1265, '32', 70),
(122, 'PESERTA MATEMATIKA SMP', 1280, '33', 65),
(123, 'PESERTA MATEMATIKA SMP', 1284, '34', 65),
(124, 'PESERTA MATEMATIKA SMP', 1317, '35', 65),
(125, 'PESERTA MATEMATIKA SMP', 1260, '36', 65),
(126, 'PESERTA MATEMATIKA SMP', 1017, '37', 65),
(127, 'PESERTA MATEMATIKA SMP', 1078, '38', 60),
(128, 'PESERTA MATEMATIKA SMP', 1101, '39', 60),
(129, 'PESERTA MATEMATIKA SMP', 1157, '40', 60),
(130, 'PESERTA MATEMATIKA SMP', 1251, '41', 60),
(131, 'PESERTA MATEMATIKA SMP', 1254, '42', 60),
(132, 'PESERTA MATEMATIKA SMP', 1270, '43', 60),
(133, 'PESERTA MATEMATIKA SMP', 1281, '44', 55),
(134, 'PESERTA MATEMATIKA SMP', 1314, '45', 55),
(135, 'PESERTA MATEMATIKA SMP', 1155, '46', 55),
(136, 'PESERTA MATEMATIKA SMP', 1253, '47', 55),
(137, 'PESERTA MATEMATIKA SMP', 1266, '48', 55),
(138, 'PESERTA MATEMATIKA SMP', 1124, '49', 50),
(139, 'PESERTA MATEMATIKA SMP', 1178, '50', 50),
(140, 'PESERTA MATEMATIKA SMP', 1026, '51', 45),
(141, 'PESERTA MATEMATIKA SMP', 1327, '52', 45),
(142, 'PESERTA MATEMATIKA SMP', 1081, '53', 45),
(143, 'PESERTA MATEMATIKA SMP', 1159, '54', 45),
(144, 'PESERTA MATEMATIKA SMP', 1282, '55', 35),
(145, 'PESERTA MATEMATIKA SMP', 1306, '56', 35),
(146, 'PESERTA MATEMATIKA SMP', 1150, '57', 35),
(147, 'PESERTA MATEMATIKA SMP', 1262, '58', 35),
(148, 'GOLD IPA SMP', 1335, '1', 145),
(149, 'GOLD IPA SMP', 1334, '2', 140),
(150, 'GOLD IPA SMP', 1336, '3', 135),
(151, 'SILVER IPA SMP', 1003, '4', 125),
(152, 'SILVER IPA SMP', 1089, '5', 120),
(153, 'SILVER IPA SMP', 1112, '6', 120),
(154, 'BRONZE IPA SMP', 1286, '7', 115),
(155, 'BRONZE IPA SMP', 1032, '8', 115),
(156, 'BRONZE IPA SMP', 1050, '9', 115),
(157, 'BRONZE IPA SMP', 1263, '10', 115),
(158, 'PESERTA IPA SMP', 1144, '11', 110),
(159, 'PESERTA IPA SMP', 1149, '12', 110),
(160, 'PESERTA IPA SMP', 1199, '13', 110),
(161, 'PESERTA IPA SMP', 1268, '14', 110),
(162, 'PESERTA IPA SMP', 1287, '15', 105),
(163, 'PESERTA IPA SMP', 1051, '16', 105),
(164, 'PESERTA IPA SMP', 1113, '17', 105),
(165, 'PESERTA IPA SMP', 1267, '18', 105),
(166, 'PESERTA IPA SMP', 1289, '19', 100),
(167, 'PESERTA IPA SMP', 1161, '20', 100),
(168, 'PESERTA IPA SMP', 1245, '21', 100),
(169, 'PESERTA IPA SMP', 1274, '22', 100),
(170, 'PESERTA IPA SMP', 1292, '23', 95),
(171, 'PESERTA IPA SMP', 1068, '24', 95),
(172, 'PESERTA IPA SMP', 1133, '25', 95),
(173, 'PESERTA IPA SMP', 1142, '26', 95),
(174, 'PESERTA IPA SMP', 1172, '27', 95),
(175, 'PESERTA IPA SMP', 1249, '28', 95),
(176, 'PESERTA IPA SMP', 1008, '29', 95),
(177, 'PESERTA IPA SMP', 1056, '30', 90),
(178, 'PESERTA IPA SMP', 1154, '31', 90),
(179, 'PESERTA IPA SMP', 1160, '32', 90),
(180, 'PESERTA IPA SMP', 1206, '33', 90),
(181, 'PESERTA IPA SMP', 1248, '34', 90),
(182, 'PESERTA IPA SMP', 1130, '35', 85),
(183, 'PESERTA IPA SMP', 1265, '36', 85),
(184, 'PESERTA IPA SMP', 1277, '37', 85),
(185, 'PESERTA IPA SMP', 1062, '38', 80),
(186, 'PESERTA IPA SMP', 1264, '39', 80),
(187, 'PESERTA IPA SMP', 1316, '40', 75),
(188, 'PESERTA IPA SMP', 1069, '41', 75),
(189, 'PESERTA IPA SMP', 1073, '42', 75),
(190, 'PESERTA IPA SMP', 1074, '43', 75),
(191, 'PESERTA IPA SMP', 1250, '44', 75),
(192, 'PESERTA IPA SMP', 1288, '45', 70),
(193, 'PESERTA IPA SMP', 1317, '46', 70),
(194, 'PESERTA IPA SMP', 1011, '47', 70),
(195, 'PESERTA IPA SMP', 1294, '48', 65),
(196, 'PESERTA IPA SMP', 1314, '49', 65),
(197, 'PESERTA IPA SMP', 1262, '50', 65),
(198, 'PESERTA IPA SMP', 1269, '51', 65),
(199, 'PESERTA IPA SMP', 1260, '52', 60),
(200, 'PESERTA IPA SMP', 1266, '53', 60),
(201, 'PESERTA IPA SMP', 1278, '54', 60),
(202, 'PESERTA IPA SMP', 1017, '55', 55),
(203, 'PESERTA IPA SMP', 1324, '56', 50),
(204, 'PESERTA IPA SMP', 1079, '57', 50),
(205, 'PESERTA IPA SMP', 1102, '58', 50),
(206, 'PESERTA IPA SMP', 1325, '59', 40),
(207, 'PESERTA IPA SMP', 1326, '60', 35),
(208, 'PESERTA IPA SMP', 1076, '61', 30),
(209, 'PESERTA IPA SMP', 1200, '62', 30),
(210, 'PESERTA IPA SMP', 1261, '63', 30),
(211, 'PESERTA IPA SMP', 1270, '64', 30),
(212, 'PESERTA IPA SMP', 1026, '65', 25),
(213, 'GOLD MATEMATIKA SMA', 1337, '1', 145),
(214, 'GOLD MATEMATIKA SMA', 1338, '2', 140),
(215, 'GOLD MATEMATIKA SMA', 1339, '3', 135),
(216, 'SILVER MATEMATIKA SMA', 1196, '4', 130),
(217, 'SILVER MATEMATIKA SMA', 1099, '5', 110),
(218, 'SILVER MATEMATIKA SMA', 1114, '6', 110),
(219, 'BRONZE MATEMATIKA SMA', 1106, '7', 100),
(220, 'BRONZE MATEMATIKA SMA', 1318, '8', 95),
(221, 'BRONZE MATEMATIKA SMA', 1148, '9', 60),
(222, 'BRONZE MATEMATIKA SMA', 1256, '10', 55),
(223, 'GOLD IPA SMA', 1342, '1', 145),
(224, 'GOLD IPA SMA', 1341, '2', 140),
(225, 'GOLD IPA SMA', 1340, '3', 135),
(226, 'SILVER IPA SMA', 1212, '4', 125),
(227, 'SILVER IPA SMA', 1258, '5', 125),
(228, 'SILVER IPA SMA', 1309, '6', 120),
(229, 'BRONZE IPA SMA', 1318, '7', 120),
(230, 'BRONZE IPA SMA', 1100, '8', 120),
(231, 'BRONZE IPA SMA', 1259, '9', 120),
(232, 'BRONZE IPA SMA', 1256, '10', 115),
(233, 'PESERTA IPA SMA', 1108, '11', 110),
(234, 'PESERTA IPA SMA', 1106, '12', 105),
(235, 'PESERTA IPA SMA', 1148, '13', 90),
(236, 'PESERTA IPA SMA', 1005, '14', 45),
(237, 'PESERTA IPA SMA', 1255, '15', 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bidang` int(10) UNSIGNED NOT NULL,
  `soal` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_foto` tinyint(1) NOT NULL,
  `jawaban1` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban2` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban3` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban4` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id`, `id_bidang`, `soal`, `foto`, `status_foto`, `jawaban1`, `jawaban2`, `jawaban3`, `jawaban4`) VALUES
(1, 1, '(485 – ( - 253) – n = 93. Nilai n adalah ...', 'assa2.png', 0, '645', '653', '713', '687'),
(2, 1, 'Hasil kali bilangan terbesar dengan bilangan terkecil dari tiga bilangan asli berurutan adalah 35. Nilai bilangan tengah adalah ….', 'assa2.png', 0, '6', '3', '4', '5'),
(3, 1, 'Uang Fifi : uang Najla = 5 : 4,sedangkan uang Fifi : uang Diva = 5 : 3. Maka uang Fifi : uang Najla : uang Diva adalah ...', 'assa2.png', 0, '5 : 4 : 3', '4 : 5 : 3', '3 : 4 : 5', '5 : 3 : 4'),
(4, 1, 'Ayu dan Adi akan pergi membeli pulpen di toko pak Agus dengan naik sepeda. Sepeda Adi melaju dengan kecepatan rata-rata 30 km/jam dan sampai di toko Pak Agus dalam waktu 15 menit sedangkan Ayu hanya mampu mengayuh sepeda dengan kecepatan rata-rata 25 km/jam. Waktu yang digunakan Ayu untuk menunggu Adi adalah ... menit', '041723_4_4.png', 0, '3', '15', '18', '2'),
(5, 1, 'Soal 5', '105403_5_soal 5.png', 1, '3/4', '1', '1/4', '1/2'),
(6, 1, 'Bilangan prima terkecil yang lebih dari 400 adalah ...', 'assa2.png', 0, '401', '411', '413', '417'),
(7, 1, 'Pada saat liburan Kiano membeli miniatur Monumen Nasional untuk oleh-oleh. Tinggi miniatur adalah 15 cm. Tinggi Monumen Nasional yang sesungguhnya adalah 132 m. Miniatur monumen yang dibeli oleh Kiara memiliki skala....', 'assa2.png', 0, '1 : 880', '1 : 320', '1 : 848', '1 : 386'),
(8, 1, 'Bilangan palindrom adalah bilangan yang sama jika dibaca dari depan ke belakang atau dari belakang ke depan, nisalnya 212,464, 393, dll. Berapa banyak bilangan palindrom 3 angka yang dapat disusun dari bilangan 1, 2, 3, 4, 5, 6?', 'assa2.png', 0, '36', '42', '12', '20'),
(9, 1, 'Sebuah balok ABCD.EFGH dengan AB = 25cm, BC = 20 sm dan CG = 12 cm. Garis IJ sejajar BC, dan KL sejajar EH. Perbandingan IB : EL adalah 1 : 3 dan panjang LI = 15 cm. Volume IBCD.LFGK ... cm3', 'assa2.png', 0, '2040', '2030', '2050', '2100'),
(10, 1, 'Rata-rata nilai ujian matematika dari 24 siswa kelas 2 adalah 7,6. Rata-rata nilai ujian matematika kelas 2 setelah ada 2 siswa pindahan yang melakukan ujian susulan menjadi 7,8. Jumlah nilai ujian matematika dua siswa pindahan tersebut adalah ....', 'assa2.png', 0, '20,4', '18,2', '16,8', '14,5'),
(11, 1, 'Hari ini adalah hari Sabtu. Jatuh pada hari apakah 2005 hari yang akan datang ?', 'assa2.png', 0, 'Selasa', 'Kamis', 'Jum\'at', 'Sabtu'),
(12, 1, 'Pukul 08.30 Rama bersepeda dari kota A menuju kota B dengan kecepatan 16 km/jam. Setengah jam kemudian Rudi menyusul bersepeda dengan kecepatan 20 km/jam. Pukul berapakah Rama tersusul oleh Rudi ?', 'assa2.png', 0, '11.00', '10.45', '10.00', '10.30'),
(13, 1, 'Jumlah dua bilangan prima adalah 123. Tentukan hasil kali kedua bilangan tersebut!', 'assa2.png', 0, '242', '224', '123', '422'),
(14, 1, 'Sebuah kotak berukuran 12m x 8m x 4m. balok-balok kecil berukuran 15cm x 20cm x 12,5cm dimasukan kedalam kotak itu. Paling banyak berapa balok kecil yang dapat dimasukkan?', 'assa2.png', 0, '102400', '21500', '101200', '51200'),
(15, 1, 'Bu ani menjual dua buah apartemen yang masing-masing harganya Rp. 52.000.000,00. Ia menderita kerugian 20% dari apartemen pertama, tetapi memperoleh keuntungan 30% dari apartemen kedua. Ternyata secara keseluruhan Bu Ani mengalami kerugian. Berapa rupiahkah kerugiannya?', 'assa2.png', 0, 'Rp. 1.000.000,00.', 'Rp. 500.000,00.', 'Rp. 1.200.000,00.', 'Rp. 800.000,00.'),
(16, 1, 'Dua pecahan jumlahnya 2/3 dan selisihnya 5/18 . Tentukan kedua pecahan tersebut!', 'assa2.png', 0, '2/9 dan 1/2', '4/3 dan 5/4', '2/3 dan 3/2', '3/5 dan 1/6'),
(17, 1, 'Bilangan terbesar dari 100 buah bilangan asli yang berurutan adalah 2102. Berapakah bilangan terkecilnya', 'assa2.png', 0, '2003', '2001', '2012', '1202'),
(18, 1, 'Sembilan buku dan enam pulpen dijual seharga Rp. 48.000,00. Tiap buku harganya lebih mahal Rp. 2.000,00 dari harga pulpen. Tentukan harga sebuah buku!', '053829_18_18.png', 0, 'Rp. 4.000,00', 'Rp. 3.500,00', 'Rp. 5.000,00', 'Rp. 4.500,00'),
(19, 1, 'Banyak siswa di kelas 5 ada 30 orang. Sebelas orang senang bermain bulu tangkis, 12 orang senang bermain bola voli, dan tujuh orang senang kedua olahraga tersebut. Berapa orang yang tidak menyenangi bulu tangkis maupun bola voli?', 'assa2.png', 0, '14', '16', '13', '11'),
(20, 1, 'Reno dan Adi sedang bermain teka-teki. Teka-teki yang dibuat oleh Reno adalah “jika kamu bagi umurku dengan 2, maka akan diperoleh sisa 1. Kemudian, jika kamu bagi umurku dengan 3 atau 4 juga akan diperoleh sisa 1.” Berapakah umur Reno?', '053632_20_20.png', 0, '25', '20', '14', '24'),
(21, 1, 'Sebuah kolam  berbentuk balok tanpa tutup. Kolam  itu berukuran 2,3m x 1,5m x 1m dengan tebal bahan pembuat 5cm. Berapakah kapasitas (volume bagian dalam) kolam tersebut?', 'assa2.png', 0, '2926 dm3', '2962 dm3', '2692 dm3', '2629 dm3'),
(22, 1, 'Pak Rizal memiliki delapan kotak besar. Dalam tiap kotak besar tersebut terdapat enam kotak berukuran sedang. Dalam tiap kotak terdapat berukuran sedang terdapat empat kotak kecil. Berapa jumlah kotak keseluruh yang dimiliki Pak Rizal?', 'assa2.png', 0, '192 kotak', '162 kotak', '163 kotak', '193 kotak'),
(23, 1, 'Dua orang pekerja mengecat kantor. Jika pekerjaan ini dikerjakan seorang diri oleh Pak Anggi memerlukan waktu 5 jam. Sedangkan jika dilakukan sendiri oleh Pak Sandi memerlukan 7 jam. Berapa lama pekerjaan ini dapat diselesaikan jika dikerjakan bersama-sama oleh Pak Anggi dan Pak Sandi?', '054114_23_23.png', 0, '35/12', '12/5', '12/35', '7/12'),
(24, 1, 'Ares menghabiskan Rp. 150.000,00 pada hari pertama liburannya. Pada hari kedua, dia menghabis seperempat dari sisa uangnya. Jika sekarang dia memiliki sisa uang Rp. 300.000,00. Tentukan banyak uang yang dimilikinya sebelum liburan  !', '054258_24_24.png', 0, 'Rp. 550.000,00', 'Rp. 500.000,00', 'Rp. 450.000,00', 'Rp. 600.000,00'),
(25, 1, 'Bintang melakukan perjalanan dari kota A ke Kota C melalui Kota B. Pada pukul 8.30 dia berangkat dari Kota A dengan kecepatan rata-rata 30 km/jam. Pada pukul 9.30 dia sampai di Kota B. Setelah beristirahat selama 45 menit, Bintang berangkat menuju kota C dan sampai di kota C pada pukul 11.30. Jika jarak antara kota A dan kota C adalah 135 km, berapa kecepatan rata-rata perjalanan dari kota B ke kota C?', '054704_25_25.png', 0, '60 km/jam', '90 km/jam', '45 km/jam', '75 km/jam'),
(26, 1, 'Keliling lapangan golf adalah 70m. Ukuran panjangnya adalah dua kali lebarnya ditambah 5m. Tentukan luas lapangan golf tersebut!', '115313_26_soal 26.png', 1, 'D', 'A', 'B', 'C'),
(27, 1, 'Ibu Siti memiliki tanah berukuran 25m x 18m. Tiga puluh persen dari tanah tersebut terkena program pembangunan jalan tol. Ganti rugi tanah yang diberikan sebesar 40 % dari harga pada umumnya. Jika harga tanah pada umumnya Rp.150.000,00 /m2 . berapakah ganti rugi yang diterima Ibu Siti?', 'assa2.png', 0, 'Rp. 8.100.000,00.', 'Rp. 4.800.000,00.', 'Rp. 6.400.000,00.', 'Rp. 4.860.000,00.'),
(28, 1, 'Ada enam pemain yang biasa bermain ganda di sebuah perkumpulan tenis meja, yaitu Dodit, Jalu, Andre, Kevin, Anang, Riski. Ada berapa pasangan berbeda yang bisa dibentuk dari keenam pemain tersebut?', 'assa2.png', 0, '15', '12', '16', '9'),
(29, 1, 'Berapa banyakkah bilangan prima 2 angka yang hasil jumlah kedua angkanya juga bilangan prima?', '055912_29_29.png', 0, '10', '12', '14', '16'),
(30, 1, 'The sum of two integers is 19, and the difference is 7. Find the product of the two numbers!', 'assa2.png', 0, '78', '88', '70', '84'),
(31, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '071129_31_1-15.png', 1, 'Was revealed', 'Were revealed', 'Being revealed', 'Has revealed'),
(32, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '071326_32_1-15.png', 1, 'Are employed', 'Is employed', 'Was employed', 'Were employed'),
(33, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space', '071612_33_1-15.png', 1, 'Is being transferred', 'Are being transferred', 'Transferred', 'Was transferred'),
(34, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '071823_34_1-15.png', 1, 'are expected', 'expected', 'is expected', 'were expected'),
(35, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '072131_35_1-15.png', 1, 'were we not informed', 'are we not informed', 'not informed', 'is informed'),
(36, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space', '072606_36_1-15.png', 1, 'were only told', 'is being told', 'are only told', 'have been told'),
(37, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '072752_37_1-15.png', 1, 'started', 'start', 'start to', 'start from'),
(38, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '073039_38_1-15.png', 1, 'are affected', 'is affected', 'have affected', 'was affected'),
(39, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '073318_39_1-15.png', 1, 'knew', 'know', 'is known', 'have known'),
(40, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space', '073555_40_1-15.png', 1, 'been made', 'made', 'to make', 'makes'),
(41, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space', '073742_41_1-15.png', 1, 'has been made', 'been made', 'is made', 'have to make'),
(42, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space', '073944_42_1-15.png', 1, 'questioned', 'question', 'questioning', 'was questioned'),
(43, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '074143_43_1-15.png', 1, 'were not told', 'were not telling', 'am not told', 'did not tell'),
(44, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '074252_44_1-15.png', 1, 'was promised', 'is promising', 'were promised', 'was promising'),
(45, 2, 'Read the text and decide which option (A, B, C or D ) best fits each space.', '074411_45_1-15.png', 1, 'decided', 'was deciding', 'have decided', 'has decided'),
(46, 2, '‘What’s the matter with Alice?’ “Who knows? She’s always -------------.', 'assa2.png', 0, 'annoyed about something', 'annoying about something', 'annoyed for something', 'annoying for something'),
(47, 2, 'Maybe she was ________ the movie, but it sounds to me she might be ____________ the guy', 'assa2.png', 0, 'fascinated by – disappointed with', 'fascinated with – disappointed by', 'fascinating by – disappointing by', 'fascinating of – disappointing with'),
(48, 2, '‘ I can’t believe the size of this menu. It’s going to take me forever to ------------.', 'assa2.png', 0, 'make up my mind', 'make my mind.', 'making up my minds', 'makes up my mind'),
(49, 2, 'It’s hard to tell with Bob; his moods ----------.', 'assa2.png', 0, 'are always very surprising', 'is always very surprised', 'can be very surprised', 'may be very surprised'),
(50, 2, 'The coffee table is -------- the room.', 'assa2.png', 0, 'in the middle of', 'on the middle of', 'at the middle of', 'of the middle of'),
(51, 2, '---------- is the study of money and finance.', 'assa2.png', 0, 'economics', 'economy', 'economies', 'economos'),
(52, 2, '‘Have you read anything ------- Ernest Hemingway?’ ‘No, what sort of books did he write?', 'assa2.png', 0, 'by', 'of', 'from', 'on'),
(53, 2, 'I couldn’t --------- such noisy neighbours as yours.', 'assa2.png', 0, 'put up with', 'put up to', 'put up for', 'put up from'),
(54, 2, '24.All the students at his school were ------------------- Gants in the tennis championship.', 'assa2.png', 0, 'rooting for', 'rooting with', 'rooting to', 'rooting on'),
(55, 2, 'Bob looks really pale and tired. Something is clearly------------.', 'assa2.png', 0, 'weighing on him', 'weighing in him', 'weighing at him', 'weighing for him'),
(56, 2, 'I discovered the washbasin ---------------------- in the bathroom, so I had to clear that.', 'assa2.png', 0, 'was clogged up', 'clogged up', 'was clogging up', 'clogs'),
(57, 2, 'A friend of mine phoned ---------- me to a party.', 'assa2.png', 0, 'to invite', 'for invite', 'for inviting', 'inviting'),
(58, 2, '------------- a hotel, we looked for somewhere to have dinner.', 'assa2.png', 0, 'Having found', 'Finding', 'We found', 'Finds'),
(59, 2, 'Are you looking forward ----------- on holiday?', 'assa2.png', 0, 'to going', 'going', 'to go', 'goes'),
(60, 2, 'I’m tired. I’d rather --------- out this evening, if you don’t mind.', 'assa2.png', 0, 'not go', 'not to go', 'not going', 'does not go'),
(61, 3, 'Kadar alkohol jika 100 ml alkohol dilarutkan ke dalam 200 ml air adalah ...', 'assa2.png', 0, '50%', '25%', '33,33%', '75%'),
(62, 3, 'Planet-planet beredar dalam satu lintasan planet yang disebut orbit yang berbentuk elips. Peredaran planet-planet mengelilingi matahari disebut...', 'assa2.png', 0, 'Revolusi bumi', 'Revolusi matahari', 'Revolusi planet', 'Revolusi bulan'),
(63, 3, 'Keluarnya sel telur (ovum) dari indung telur (ovarium) yang tidak dibuahi bersama lapisan dinding rahim yang banyak mengandung pembuluh', 'assa2.png', 0, 'Menstruasi', 'Pembuahan', 'Pendarahan', 'Luka dalam'),
(64, 3, 'Klorofil adalah zat warna hijau daun. Klorofil berguna untuk menangkap cahaya matahari. Cahaya matahari digunakan untuk proses pembuatan zat makanan. Secara ilmiah fotosintesis terjadi pada …', 'assa2.png', 0, 'Siang hari', 'Malam hari', 'Musim hujan', 'Musim gugur'),
(65, 3, 'Masehi calendar is also called the solar calendar. Masehi, one year is devided into 12 months. Leap year is the year that the number of day 366 days. Determination of masehi is based on the calendar …', 'assa2.png', 0, 'Revolution of the earth', 'Earth’s rotation', 'Revolution of the moon', 'Rotation of the moon'),
(66, 3, 'Gas berbahaya yang dihasilkan dari pembakaran tidak sempurna adalah gas karbon monoksida. Penulisan rumus kimia karbon monoksida adalah …', 'assa2.png', 0, 'CO', 'C2O', 'CO2', 'CO3'),
(67, 3, 'Apabila kadar pengotor dalam bijih besi adalah 10%. Maka banyak  bijih besi murni dalam 500 gram bijih besi tersebut adalah ...', 'assa2.png', 0, '450 gram', '500 gram', '350 gram', '100 gram'),
(68, 3, 'Selama tahun 2010 di Desa Sembalun tercatat bahwa jumlah kelahiran 30 orang, jumlah meninggal 43 orang, pendatang baru 33 orang dan yang berangkat 5 jiwa. Berapa pertumbuhan penduduk desa Sembalun pada tahun 2010?', 'assa2.png', 0, '15 orang', '17 orang', '13 orang', '21 orang'),
(69, 3, 'Tumbuhan berguna unutk membersihkan udara yang kotor, serta mengurangi pencemaran udara karena tumbuhan mengandung ...', 'assa2.png', 0, 'Oksigen', 'Karbonmonoksida', 'Nitrogen', 'Karbondioksia'),
(70, 3, 'Pada hewan dan tumbuhan terjadi peristiwa makan dan dimakan dengan urutan tertentu. Peristiwa tersebut dimakan ....', 'assa2.png', 0, 'Rantai makanan', 'Urutan makanan', 'Ekosistem', 'Jaringan makanan'),
(71, 3, 'Gaya tekan menyebabkan jungkat-jungkit bergerak, jungkat-jungkit menjadi tidak seimbang karena ada gaya yang berbeda. Gaya tersebut adalah gaya …', 'assa2.png', 0, 'Tekan', 'Gesek', 'Dorong', 'Tarik'),
(72, 3, 'Setiap hari kita sering menggunakan berbagai macam benda yang memiliki bentuk, sifat, rasa, dan aroma yang berbeda. Benda-benda tersebut memiliki ciri tersendiri yang dipengaruhi oleh bahan-bahan yang terkandung di dalam benda tersebut, maka benda benda tersebut dapat dikelompokkan ke dalam golongan asam, basa, atau garam. Yang termasuk larutan asam adalah …', 'assa2.png', 0, 'Air garam', 'Air gula', 'Air sabun', 'Air sirup'),
(73, 3, 'Sebuah mobil bergerak dengan jarak 10 km pada 5 menit pertama, 10 menit kemudian menempuh jarak 45 km dan 15 menit kemudian mobil itu menempuh jarak 15 km. Kecepatan rata-rata mobil tersebut adalah ...', 'assa2.png', 0, '140 m/h', '70 km/h', '95 km/h', '35 km/h'),
(74, 3, 'Setiap makhluk hidup memerlukan makanan atau nutrisi untuk mempertahankan hidupnya. Makanan diperlukan sebagai sumber energy untuk melakukan proses-proses kehidupan. Cara mendapatkan makanan maupun cara makan setiap makhluk hidup berbeda-beda. Tumbuhan dapat membuat makanan sendiri dengan proses …', 'assa2.png', 0, 'Fotosistesis', 'Menghisap', 'Memasak', 'Berburu'),
(75, 3, 'Komponen tak hidup berupa benda-benda tak hidup. Sementara itu, komponen hidup meliputi produsen, konsumen, dan pengurai. Hubungan timbal balik antara komponen hidup dan tak hidup disebut …', 'assa2.png', 0, 'Ekosistem', 'Habitat', 'Adaptasi', 'Komunitas'),
(76, 3, 'Mobil dari kota A ke kota B melaju selama satu jam. Jarak dari kota C ke D 60 km. Maka kelajuan motor tersebut adalah …', 'assa2.png', 0, '3.600.000 m/s', '36.000.000 m/s', '360.000 m/s', '36.000 m/s'),
(77, 3, 'Pembangkit listrik menggunakan sumber energi pengganti seperti air, panas  matahari, dan angin. Pembangkit listrik juga menggunakan bahan bakar fosil. Misalnya, minyak bumi dan batubara. Sumber energi listrik yang dapat diperbarui adalah...', 'assa2.png', 0, 'Coal', 'Matahari', 'Air', 'Udara'),
(78, 3, 'Ketika bola dilempar ke atas maka bola tersebut akan jatuh ke bawah. Hal tersebut terjadi karna bola memiliki gaya ...', 'assa2.png', 0, 'Gravitasi', 'Magnet', 'Pegas', 'Gesek'),
(79, 3, 'Pelapukan adalah hancurnya batuan dari ukuran besar menjadi batuan yang kecil. Pelapukan disebabkan adanya …', 'assa2.png', 0, 'Eksogen', 'Korosis', 'Endogen', 'Erosi'),
(80, 3, 'Dinamika penduduk dipengaruhi oleh berbagai hal antara lain kelahiran, kematian, dan perpindahan penduduk. Apabila lahirnya individu baru bisa disebut juga dengan …', 'assa2.png', 0, 'Natalis', 'Emigrasi', 'Mortalitas', 'Imigrasi'),
(81, 3, 'Benda bening adalah benda yang dapat meneruskan sebagian besar cahaya yang diterimanya. Jadi, air yang jernih termasuk benda bening. Selain benda bening terdapat pula benda yang tidak dapat ditembus cahaya. Benda yang tidak dapat ditembus cahaya tersebut dinamakan benda …', 'assa2.png', 0, 'kaca', 'cahaya', 'gelap', 'air'),
(82, 3, 'Tata surya yaitu bagian di alam semesta yang sangat luas. Tata surya juga terletak di dalam satu galaksi yang dapat disebut Bimasakti. Galaksi Bimasakti dapat juga disebut ....', 'assa2.png', 0, 'Milky way', 'Sky high', 'Sky way', 'Univers'),
(83, 3, 'Berikut yang bukan merupakan bagian dari bunga adalah ...', 'assa2.png', 0, 'Tangkai Bunga', 'Kelopak Bunga', 'Benang Sari', 'Putik'),
(84, 3, 'Pada paru-paru terdapat bronkus yang bercabang. Cabang tersebut adalah ...', 'assa2.png', 0, 'Bronkiolus', 'Bronkus', 'Alveoli', 'Pleura'),
(85, 3, 'Sprint runners have a speed of 6 m / s. how many distance runners if the journey time 15 second ?', 'assa2.png', 0, '90 m', '75 m', '45 m', '30 m'),
(86, 3, 'Sebuah cahaya merambat lurus akan menyebabkan terbentuknya bayangan dari benda yang telah terkena cahaya. Pembentukan cahaya dapat dimanfaatkan untuk membuat kamera. Kamera adalah alat yang dapat digunakan untuk …', 'assa2.png', 0, 'Memotret', 'Mencetak', 'Membuat gambar', 'Mengungkit'),
(87, 3, 'Udara yang telah masuk ke rongga hidung dan dapat diteruskan ke batang tenggorokan. Pada batang tenggorokan telah tersusun atas tulang – tulang rawan yang kemudian bercabang dua. Cabang batang tenggorokan tersebut bisa juga disebut ….', 'assa2.png', 0, 'Bronkus', 'Bronkiolus', 'Alvelia', 'Pleura'),
(88, 3, 'kemampuan hewan untuk meniru obyek maupun hewan lain agar tidak dikenali pemangsa maupun mangsa mereka disebut juga ...', 'assa2.png', 0, 'mimikri', 'adaptasi', 'ekosistem', 'habitat'),
(89, 3, 'berikut yang merupakan benuk morfologi pada hewan yaitu ...', 'assa2.png', 0, 'paruh bebek', 'bunga bangkai', 'cumi-cumi', 'daun teratai'),
(90, 3, 'paru-paru memiliki ... bagian', 'assa2.png', 0, '4', '1', '2', '3'),
(91, 4, 'Berapakah banyaknya titik pada segitiga ke-enam?', '133600_91_Soal 1.png', 1, '21', '15', '55', '31'),
(92, 4, 'Soal 2', '133707_92_soal 2.png', 1, '16', '6', '1', '12'),
(93, 4, 'Enam bola berwarna merah dicampur dengan delapan bola berwarna kuning. Jika dua bola diambil secara acak, maka peluang terambil satu bola berwarna merah dan satu bola berwarna kuning adalah ...', 'assa2.png', 0, '48/91', '16/33', '32/55', '7/13'),
(94, 4, 'Soal 4', '134129_94_Soal 4.png', 1, '198', '110', '138', '72'),
(95, 4, 'Jika suatu kolam diisi air melalui kran A,B, atau C saja, maka kolam tersebut akan penuh dalam waktu berturut-turut 12 menit, 15 menit, atau 20 menit. Jika tiga kran digunakan bersama selama 4 menit, maka kolam tersebut akan terisi sebanyak ....', 'assa2.png', 0, '0,8 bagian', '0,4 bagian', '0,45 bagian', '0,6 bagian'),
(96, 4, 'Jika tanggal 13 pada suatu bulan jatuh pada hari Jumat, kita menyebutnya Jumat tanggal 13. Diketahui bahwa hari Jumat tanggal 13 terjadi setidaknya sekali setiap tahun dalam kalender. Jika selang terpanjang antara dua kejadian Jumat tanggal 13 adalah x bulan, berapakah nilai x?', 'assa2.png', 0, '14', '16', '13', '18'),
(97, 4, 'Berapa banyak bilangan 4 digit yang lebih dari 4000 dengan syarat angka yang boleh berulang hanyalah 8 ?', 'assa2.png', 0, '3165', '3156', '3365', '2645'),
(98, 4, 'Soal 8', '134613_98_Soal 8.png', 1, '1/4', '1/2', '1', '1/8'),
(99, 4, 'Suatu kelas terdiri dari 35 siswa. Pada saat ulangan matematka terdapat 2 orang siswa berhalangan, misalkan siswa A dan B. Nilai ulangan pada awalnya dicatat hanya dari 33 siswa dan memiliki rata-rata 80. Setelah ditambah nilai susulan dua siswa yang berhalangan tersebut, nilai rata-rata kelas menjadi 78. Jika nilai A dua kali lebih tinggi dibandingkan nilai B, maka selisih nilai A dan B adalah ...', '013532_99_9.png', 0, '30', '15', '10', '35'),
(100, 4, 'Bilangan tadutima adalah bilangan bulat positif yang bukan kelipatan 2, 3, atau 5. Banyak bilangan bulat positif kurang dari  yang merupakan bilangan tadutima adalah ...', 'assa2.png', 0, '266', '232', '233', '333'),
(101, 4, 'Diantara bilangan berikut, yang bernilai ganjil untuk setiap bilangan bulat n adalah ...', 'assa2.png', 0, '2019 + 2n', '2019 + n', '2019 + n2', '2019 – 3n'),
(102, 4, 'Manakah dia antara pernyataan berikut yang benar untuk semua bilangan asli n ?', '135122_102_Soal 12.png', 1, 'SEMUA pilihan benar.', 'HANYA (2) yang benar.', '(3) dan (4) SAJA yang benar.', '(1),(2),(3) SAJA yang benar .'),
(103, 4, 'Jika p adalah bilangan habis dibagi 8 dan nilainya diantara 9 dan 19 sedangkan q adalah bilangan yang habis dibagi 9 dan nilainya diantara 11 dan 19 maka pernyataan yang paling tepat adalah ...', 'assa2.png', 0, 'Q > p', '2p < q', '2q < p', 'P > q'),
(104, 4, 'Soal 14', '135542_104_soal 14.png', 1, '-6x – 5', '6x – 5', '6x – 8', '-6x + 5'),
(105, 4, 'Dalam sebuah organisasi OSIS di SMP terdapat struktur osis yang terdiri dari ketua, wakil ketua, sekretaris 1, sekretaris 2, bendahara 1, dan bendahara 2. Jika ketua dan wakil ketua duduknya selalu berdampingan maka banyak cara mereka duduk mengelilingi meja bundar tersebut adalah ...', '014543_105_15.png', 0, '48', '12', '36', '90'),
(106, 4, 'Suatu perusahaan mempunyai tujuh pintu masuk. Jika lima orang hendak memasuki perusahaan itu maka banyaknya cara mereka masuk dari pintu yang berlainan adalah', 'assa2.png', 0, '5040', '5400', '5000', '4500'),
(107, 4, 'Soal 17', '140047_107_Soal 17.png', 1, '10', '12', '24', '32'),
(108, 4, 'Rahmat  akan melakukan tendangan penalti ke gawang yang dijaga oleh Ivan. Peluangnya membuat gol dalam sekali tendangan adalah 2/5. Jika Rahmat melakukan 3 kali tendangan penalti maka peluangnya untuk membuat  2 gol adalah ...', 'assa2.png', 0, '18/125', '36/125', '48/125', '54/125'),
(109, 4, 'Jika x + y = 5, dan x + 2y = 7 maka ...', 'assa2.png', 0, 'x – y = 1', 'xy = 12', 'x = 2', 'y = 3'),
(110, 4, 'jika p = 2a + 3 dan q = a + 6, maka 4p +2q adalah ...', 'assa2.png', 0, '10a +24', '3a + 9', '3a + 18', '8a + 12'),
(111, 4, '2013ab + 3 = 3040, maka 8052ab adalah ...', 'assa2.png', 0, '12148', '12048', '21248', '12284'),
(112, 4, 'Jika suatu bilangan habis dibagi 6 dan 16, maka bilangan tersebut habis dibagi ...', 'assa2.png', 0, '32', '28', '24', '22'),
(113, 4, 'Setiap pagi Jono berangkat pukul 06.30 menggunakan sepeda dengan kecepatan 40 km/jam dan tiba disekolah pukul 07.00. bila hari ini Jono berangkat pukul 06.40, berapakah kecepatan sepeda Jono agar tiba pukul 07.00 ?', '015811_113_23.png', 0, '60 km/jam', '65 km/jam', '50 km/jam', '45 km/jam'),
(114, 4, 'Bila seseorang mengendarai mobil dengan kecepatan tetap menempuh jarak 8 km dalam waktu 10 menit, berapa menit waktu yang ia perlukan untuk menempuh jarak 28 km?', 'assa2.png', 0, '35', '34', '32', '30'),
(115, 4, 'Bilangan genap lima angka yang memuat semua angka 2, 3, 5, 7, dan 8 ada sebanyak ...', 'assa2.png', 0, '48', '40', '24', '32'),
(116, 4, 'Jika tia bilangan positif x – 2, x + 1, dan 2x + 2 membentuk barisan geometri maka jumlah ketiga bilangan tersebut adalah ...', '020253_116_26.png', 0, '21', '20', '19', '18'),
(117, 4, 'Soal 27', '141210_117_soal 27.png', 1, '-1 atau 1', '1 atau 2', '-2 atau 1', '-2 atau -1'),
(118, 4, 'Umur Rani  1/3 kali umur ibunya, umur bibinya 5/6 kali ibunya. Jika umur Rani 18 tahun, maka umur bibinya adalah ...', '020712_118_28.png', 0, '45', '36', '50', '46'),
(119, 4, 'Jika perbandingan volume dua buah kubus adalah 1 : 27. Perbandingan luas permukaan dua kubus tersebut adalah ...', 'assa2.png', 0, '1 : 9', '1 : 6', '1 : 3', '1 : 2'),
(120, 4, 'If the numerator of a fraction is added by 3 then the value is 1/3 , and if the denominator is reduced by 3, the value is 1/6 . The fraction in question is...', 'assa2.png', 0, '2/15', '1/7', '2/14', '1/18'),
(121, 5, 'From 1949 onward ,the artist Georgia O’keeffe made New Mexico -----.', 'assa2.png', 0, 'her permanent residence', 'permanent residence for her', 'where her permanent residence', 'her permanent residence was'),
(122, 5, 'Just as remote-controlled satellites can be employed to explore outer space, ------- employed to investigate the deep sea.', 'assa2.png', 0, 'robots can be', 'can be robots', 'can robots', 'can robots that are'),
(123, 5, 'In	people, the areas of the brain that control speech are located in the left hemisphere', 'assa2.png', 0, 'most', 'mostly of', 'almost the', 'the most of'),
(124, 5, 'Stars shine because of ------- produced by the nuclear reactions taking place within them.', 'assa2.png', 0, 'the amount of light and heat', 'the amount of light and heat that it is', 'which the amount of light and heat', 'the amount of light and heat is'),
(125, 5, 'is not clear to researchers.', 'assa2.png', 0, 'Why dinosaurs became extinct', 'Why dinosaurs having become extinct .', 'Did dinosaurs become extinct', 'Dinosaurs became extinct'),
(126, 5, 'Although many people use the word “milk” to refer to cow’s milk, -------- to milk from any mammal, including human milk and goat’s milk.', 'assa2.png', 0, 'it also applies', 'applies also', 'applying it also', 'but it also applies'),
(127, 5, 'The first transatlantic telephone cable system was not established ------- 1956.', 'assa2.png', 0, 'Until', 'While', 'On', 'When'),
(128, 5, 'on two people think exactly alike, there will always be disagreement, but disagreement should not always be avoided: it can be healthy if handled creatively.', 'assa2.png', 0, 'Because', 'That', 'Why', 'There are'),
(129, 5, 'Drinking water ------- excessive amounts of fluorides may leave a stained or mottled effect on the enamel of teeth.', 'assa2.png', 0, 'containing', 'in which containing', 'contains', 'that contain'),
(130, 5, 'In the 1820’s physical education became ------- of the curriculum of Harvard and Yale Universities.', 'assa2.png', 0, 'part', 'was part', 'which was part', 'to be part'),
(131, 5, 'Pewter, ----------- for eati ng and drinking utensils in colonial America, is about ninety percent tin, with copper or bismuth added for hardness.', 'assa2.png', 0, 'widely used', 'was widely used', 'widely used it', 'which widely used'),
(132, 5, 'A moth possesses two pairs of wings ----- as a single pair and are covered with dust like scales.', 'assa2.png', 0, 'that function', 'are functioning', 'function', 'but functions'),
(133, 5, 'Soap operas, a type of television drama series, are so called because, at first they were ----.', 'assa2.png', 0, 'often sponsored by soap manufacturers', 'sponsored often soap manufactures', 'often which soap manufacturers', 'soap manufactures often sponsored them'),
(134, 5, 'The Woolworth Building in New York was the highest in America when -------  in 1913 and was famous for its use of Gothic decorative detail.', 'assa2.png', 0, 'built', 'it built', 'was built', 'built it'),
(135, 5, '15.Humans, ------- , interact through communicative behavior by means of signs or symbols used conventionally.', 'assa2.png', 0, 'like other animals', 'how other animals', 'other animals that', 'do other animals'),
(136, 5, 'Soal 16', '040743_136_16.png', 1, 'B', 'A', 'C', 'D'),
(137, 5, 'Soal 17', '041027_137_17.png', 1, 'C', 'A', 'B', 'D'),
(138, 5, 'Soal 18', '041508_138_18.png', 1, 'A', 'B', 'C', 'D'),
(139, 5, 'Soal 19', '042036_139_19.png', 1, 'B', 'A', 'C', 'D'),
(140, 5, 'Soal 20', '042335_140_20.png', 1, 'D', 'A', 'B', 'C'),
(141, 5, 'Soal 21', '042623_141_21.png', 1, 'C', 'A', 'B', 'D'),
(142, 5, 'Soal 22', '043008_142_22.png', 1, 'C', 'A', 'B', 'D'),
(143, 5, 'Soal 23', '043232_143_23.png', 1, 'D', 'A', 'B', 'C'),
(144, 5, 'Soal 24', '043839_144_24.png', 1, 'D', 'A', 'B', 'C'),
(145, 5, 'Soal 25', '043913_145_25.png', 1, 'B', 'A', 'C', 'D'),
(146, 5, 'Soal 26', '043950_146_26.png', 1, 'C', 'A', 'B', 'D'),
(147, 5, 'Soal 27', '044032_147_27.png', 1, 'A', 'B', 'C', 'D'),
(148, 5, 'Soal 28', '044201_148_28.png', 1, 'A', 'B', 'C', 'D'),
(149, 5, 'Soal 29', '044233_149_29.png', 1, 'A', 'B', 'C', 'D'),
(150, 5, 'Soal 30', '044304_150_Soal 30.png', 1, 'D', 'A', 'B', 'C'),
(151, 6, 'Apa yang dimaksud dengan ilmu biologi?', 'assa2.png', 0, 'Ilmu yang membahas tentang kehidupan makhluk hidup termasuk tumbuhan, hewan, dan Manusia.', 'Ilmu yang mempelajari fisik suatu  objek.', 'ilmu pengetahuan dimana didalamnya mempelajari tentang sifat dan fenomena alam atau gejala alam dan seluruh interaksi yang terjadi didalamnya.', 'Ilmu alam yang mengkaji unsur pembentuk alam semesta dan gaya yang bekerja di dalamnya.'),
(152, 6, 'Mengapa ilmu fisiologi termasuk ke dalam biologi murni?', 'assa2.png', 0, 'Berhubungan erat dengan penerapan sistem kehidupan yang terlibat dalam fungsi kegiatan tubuh makhluk hidup.', 'Melibatkan macam kaidah kehidupan.', 'Mengarahkan bagaimana struktur tubuh dapat terbentuk.', 'Mempelajari perbedaan bentuk luar tubuh dari masing-masing organisme.'),
(153, 6, 'Bagian organ mana pada tumbuhan yang mengandung anthocyanin adalah...', 'assa2.png', 0, 'Daun', 'Batang', 'Akar', 'Bunga'),
(154, 6, 'Which one of the following is correct….', '124504_154_soal 4.png', 1, 'I dan III', 'I saja', 'II dan III', 'II saja'),
(155, 6, 'Manakah di bawah ini yang benar….', '023330_155_soal 5.png', 1, 'III saja', 'I saja', 'I dan II', 'I, II, dan III'),
(156, 6, 'Pada tahap mana nukleus memperbesar ukurannya….', '023636_156_6.png', 0, 'Telopase', 'Anaphase', 'Metaphase', 'Propase'),
(157, 6, 'Manakah pernyataan di bawah ini yang tepat….', '125032_157_Soal 7.png', 1, 'I dan II', 'II dan III', 'I, II, dan III', 'I dan III'),
(158, 6, 'Sel organisme prokariotik menambah jumlahnya dengan cara pembelahan….', 'assa2.png', 0, 'Mitosis', 'Meiosis', 'Metafase', 'Anfase'),
(159, 6, 'Jika air sungai pada ember diganti dengan zat cair yang memiliki massa jenis yang lebih besar maka kemungkinan yang bisa terjadi adalah …….', 'assa2.png', 0, 'Jarak maksimum semburan cairan lebih kecil dibanding semula', 'Suhu pada kedalam x dari dasar ember lebih besar dari semula', 'Tekanan pada kedalam x dari dasar ember lebih kecil dari semula', 'volume benda yang tidak terendam akan muncul di permukaan lebih besar dibanding semula'),
(160, 6, 'Ketika pulang sekolah, Irwan menjaga adiknya yang masing balita, Annisa. Biasanya Irwan  meletakkan Annisa pada ayunan per. Hal ini mempermudah Irwan ketika Annisa  mulai rewel jika sudah mengantuk. Saat sedang mengayun adiknya, Irwan mengamati ada hal yang menyebabkan per bergerak ke atas setelah per dibebaskan gaya tarik ke bawah oleh Irwan. Seandainya per tersebut dipendekan ¼ dari panjang semula maka tingkat elastisitasnya adalah ….', 'assa2.png', 0, 'Semakin kecil dari sebelumnya', 'Semakin besar dari sebelumnya', 'Tidak berpengaruh dengan elastisitasnya', 'Luas penampang per semakin besar dari sebelumnya'),
(161, 6, 'Arie Untung  melakukan perjalanan darat Banyuwangi ke Bali dengan kecepatan yang berubah ubah menempuh jarak sebesar 2480 km dan membutuhkan waktu selama 48 jam. Apabila menggunakan jalur laut waktu yang tempuh dari pelabuhan Gili Ketapang ke Padang Bai menggunakan kapal feri yang massanya 500 dan seluruh penumpang 100 ton sekitar 1 jam 30 menit. Daya mesin kapal laut yang digunakan sebesar 1811 kW. Maka tentukan besar kecepatan kapal laut tersebut ?', 'assa2.png', 0, '32,4 m/s', '16,2 m/s', '44,4 m/s', '48,4 m/s'),
(162, 6, 'Bila kita berdiri dekat rel dan kebetulan lewat serangkaian kereta api cepat, maka kita …', 'assa2.png', 0, 'Merasa ditarik menuju rel', 'Merasa didorong menjauhi rel', 'Kadang – kadang merasa ditarik', 'Tidak merasa apa – apa'),
(163, 6, 'Seorang siswa merangkaikan beberapa resistor menggunakan seperti gambar. Tentukan daya pada rangkaian tersebut ?', '130217_163_soal 13.png', 1, '34,8 W', '36.5 W', '38,8 W', '40,2 W'),
(164, 6, 'Yoyo sedang menjalankan ujian praktik fisika, ia mendapat materi besaran dan pengukuran yaitu mengamati benda yang ada di hadapannya, bohlam merek Z. Yoyo melakukan hal tertentu serta harus mengisi tabel yang disediakan oleh guru fisikanya. Berdasarkan pengamatan yang andi lakukan, hal apa saja yang mungkin ia temukan ?', 'assa2.png', 0, 'Panjang, suhu dan massa bohlam', 'Volume, luas, dimensi dan berat jenis bohlam sebagai besaran turunan', 'Massa, panjang, volt, intensitas cahaya dan suhu', 'Panjang, daya, intensitas, suhu dan massa bohlam sebagai besaran pokok'),
(165, 6, 'Orgabel didalam sel hewan maupun manusia yang terlihat langsung dalam sintesis enzim ialah ...', 'assa2.png', 0, 'Ribosom', 'Mitokondria', 'Lisosom', 'Mikrosom'),
(166, 6, 'Nefritis adalah gangguan sistem ekskresi yang disebabkan oleh ...', 'assa2.png', 0, 'Pengerasan pembuluh darah pada ginjal', 'Kekurangan hormon antidiuretik', 'Pengendapan garam-garam mineral', 'Infeksi bakteri Streptococcus'),
(167, 6, 'NH3 sebagai hasil metabolisme protein dan CO2 sebagai hasil respirasi dapat membentuk urea yang kemudian diekskresikan. Pembentukan urea itu terjadi di dalam ...', 'assa2.png', 0, 'Hati', 'Ginjal', 'Usus besar', 'Usus halus'),
(168, 6, 'Semangka tanpa biji mngandung kromoson 3n. Semangka ini diperoleh dari mutasi yang memanfaatkan ...', 'assa2.png', 0, 'Kolkisin', 'Sinar ultraviolet', 'Gas metana', 'Asam nitrat'),
(169, 6, 'Penderita sindrom klinefelter memiliki kariotipe kromosom 44A + XXY. Hal ini terjadi karena ....', 'assa2.png', 0, 'Ovum XXY dibuahi sperma Y', 'Sperma Y membuahi ovum XY', 'Individu XXY yang gagal bepisah', 'Pengurangan satu kromosom Y'),
(170, 6, 'Peristiwa yang terjadi dalam fase interfase adalah ...', '131501_170_Soal 20.png', 1, 'i dan iii', 'ii dan iv', 'i dan ii', 'ii dan iii'),
(171, 6, 'Penyusunan matriks berupa serat dengan daya elastisitas rendah, daya regang sangat tinggi, berwarna putih dan terdapat pada tendon. Penyusun  matriks yang dimaksud adalah serat ...', 'assa2.png', 0, 'Kolagen', 'Hialin', 'Elastin', 'Perifer'),
(172, 6, 'Materi penyusun tulang rawan yang berupa zat bening seperti kanji disebut ...', 'assa2.png', 0, 'Kondrin', 'Kondroblas', 'Fibrosa', 'Hialin'),
(173, 6, 'The following statements are related to smooth muscle, except...', 'assa2.png', 0, 'function to move the frame', 'slow reaction to stimuli', 'found in the internal organs', 'one core'),
(174, 6, 'Takson terendah yang mendudukkan manusia dan orang utan pada kedudukan yang sama adalah ...', 'assa2.png', 0, 'Ordo', 'Kelas', 'Filum', 'Genus'),
(175, 6, 'Pengelompokan organisme dapat didasarkan atas keanekaragaman tingkat gen dan keanekaragaman tingkat spesies. Tanaman berikut yang menunjukkan keanekaragaman tingkat gen adalah ....', 'assa2.png', 0, 'Kelapa gading, kelapa hibrid, kelapa hijau', 'Bunga melati, bunga mawar, bunga lily', 'Srikaya, sirsak, mentimun', 'Temu lawak, temu ireng, kunyit'),
(176, 6, 'Tindakan preventif yang digunakan untuk mencegah terjadinya penyakit digunakan cara vaksinasi. Kepanjangan dari vaksin BCG adalah ....', 'assa2.png', 0, 'Bacillus Calmet Guirine', 'Bacterium Calmet Gurine', 'Bacterium Calmet Guirine', 'Bacillus Calsium Gurine'),
(177, 6, 'Pada pemeriksaan air minum bertujuan untuk melihat ada dan tidaknya pencemaran oleh tinja manusia sebagai indikatornya digunakan salah satu bakteri usus yang bukan patogen dan tidak berbahaya, tetapi keluar bersama tinja, yaitu ...', '031700_177_27.png', 0, 'Eschericia coli', 'Vibrio cholerae', 'Balantidium coli', 'Ptoteus vulgaris'),
(178, 6, 'Diantara makhluk hidup ini yang memiliki jumlah gen paling sedikit adalah ....', 'assa2.png', 0, 'Bakteri', 'Jamur', 'Tumbuhan berbunga', 'Lumut'),
(179, 6, 'Garam mineral yang paling sedikit menyusun jaringan tulang adalah ...', 'assa2.png', 0, 'Kalsium fluorida', 'Kalsium florida', 'Kalsium karbonat', 'Kalsium fosfat'),
(180, 6, 'Otot disebut alat gerak aktif  karena ....', 'assa2.png', 0, 'Mempunyai kemampuan berkontraksi untuk memnggerakkan bagian-bagian tubuh', 'Bergerak disebabkan rangsang yang berupa panas, dingin, arus listrik, dan rangsang kimia', 'Tersusun atas serabut-serabut otto yang membentuk otot atau daging', 'Bekerja dibawah kemauan, lambat, beraturan, dan tidak mudah lelah'),
(181, 7, 'Tanah yang banyak mengandung zat besi dan alumunium yang disebabkan pelapukan dan sudah tua adalah ciri tanah…', 'assa2.png', 0, 'Podzolik', 'Humus', 'Kapur', 'Aluvial'),
(182, 7, 'Secara geologis, kesuburan tanah di Pulau Jawa banyak dipengaruhi oleh…', 'assa2.png', 0, 'Aktivitas gunung api dan relief permukaan bumi yang berbukit', 'Curah hujan yang tinggi dan terpeliharanya hutan lebat', 'Tersedianya Saluran irigasi dan penggunaan pupuk organik', 'Pengolahan lahan dengan menggunakan traktor dan cangkul'),
(183, 7, 'Soal 3', '045032_183_3.png', 1, 'Terjadi hujan Zenithal', 'Lambatnya pelapukan batu', 'Temperatur Indonesia rendah', 'Rendahnya curah hujan'),
(184, 7, 'Negara di kawasan Asia yang termasuk ke dalamnegara development countries yaitu….', 'assa2.png', 0, 'Taiwan, Jepang, Korea Selatan', 'Thailand,Hongkong, Taiwan', 'Korea Selatan, Singapura, Cina', 'Brunei, Korea Selatan, Singapura'),
(185, 7, 'Berikut ini suku asli yang mendiami salah satu negara di Asia tenggara yang tepat yaitu….', 'assa2.png', 0, 'Khmer di Kamboja', 'Sekai di Filipina', 'Lao yao di Vietnam', 'Dayak di Vietnam'),
(186, 7, 'Persamaan karakteristik antara Negara Malaysia dan Singapura adalah….', 'assa2.png', 0, 'Mayoritas suku melayu', 'Beriklim tropis', 'Berbentuk kepulauan', 'Pengekspor industri elektronik'),
(187, 7, 'Pegunungan Andes di Benua Amerika terbentuk oleh pergerakan ….', 'assa2.png', 0, 'Vertikal lempeng benua dan lempeng samudera', 'Saling menjauh antara 2 lempeng benua', 'Mendatar 2 lempeng benua', 'Mendatar 2 lempengsamudera'),
(188, 7, 'Bentuk kerjasama ekonomi regional, antara lain….', 'assa2.png', 0, 'MEE, APEC, ASEAN', 'OPEC, APEC, LAIA', 'MEE, APEC, UNDP', 'IMF, UNESCO, FAO'),
(189, 7, 'Lembaga sosial di dalam masyarakat terdapat dua macam, yaitu yang diterima dan tidak diterima oleh masyarakat. Lembaga sosial yang ditentang oleh masyarakat disebut dengan….', 'assa2.png', 0, 'Unsanctioned institutions', 'Basic institutions', 'Subsidiary institutions', 'General institutions'),
(190, 7, 'Pernyataan berikut ini yang tepat mengenai pranata sosial adalah….', 'assa2.png', 0, 'Sistem norma untuk memenuhi dan mencapai tujuan kebutuhan', 'Tata tertib di masyarakat untuk kebaikan bersama', 'Aturan di masyarakat sebagai pedoman generasi muda', 'Adat istiadat atau tata kelakuan dalam masyarakat'),
(191, 7, 'Laras merengek pada ibunya agar rambut keritingnya diluruskan. Hal ini dikarenakan teman-teman sekolahnya seringkali menertawakan rambutnya. Keinginan Laras karena adanya pengaruh teman-temannya tersebut menunjukkan adanya bentuk interaksi sosial….', 'assa2.png', 0, 'Sugesti', 'Identifikasi', 'Simpati', 'Imitasi'),
(192, 7, 'Sarah selalu tersenyum dan mengucapkan salam setiap berpapasan dengan guru.Tindakan Sarah tersebut merupakan persyaratan dari interaksi….', 'assa2.png', 0, 'Kontak dan komunikasi', 'Sosialisasi dan kontak', 'Internalisasi dan kontak', 'Akulturasi dan komunikasi'),
(193, 7, 'Susi adalah seorang gadis belia berumur 15 tahundan sedang duduk di kelas 3 SMP. Namun, Susi terpaksa berhenti sekolah karena hamil diluar nikah. Hal ini sesuai dengan peraturan sekolah. Pada hakikatnya kebijakan sekolah tersebut merupakan pengendalian sosial yang bersifat….', 'assa2.png', 0, 'Koersif', 'Preventif', 'Kuratif', 'Persuasif'),
(194, 7, 'Diantara contoh perilaku berikut, yang sesuai dengan teori pembelajaran menyimpang adalah….', 'assa2.png', 0, 'Sekelompok supporter sepak bola melakukan aksi pelemparan botol karena tidak puas dengan kepemimpinan wasit', 'Seorang anak menjadi perokok karena dia melihat orang-orang disekitarnya melakukan hal yang sama', 'Sekelompok siswa melakukan aksi coret-coret tembok karena meyakini perbuatan tersebut merupakan kegiatan remaja sebelumnya', 'Seorang mantan pecandu narkoba memutuskan bergabung dalam gerakan anti narkoba setelah mengikuti program rehabilitasi kecanduan narkoba'),
(195, 7, 'Masyarakat selalu dihadapkan kepada realita bahwa terdapat individu dan kelompok yang nonkonformis, cenderung melakukan pelanggaran terhadap aturan sosial. Pengertian tersebut merujuk kepada….', 'assa2.png', 0, 'Penyimpangan sosial', 'Perubahan sosial', 'Dinamika sosial', 'Realitas sosial'),
(196, 7, 'Demam piala dunia merupakan satu fenomena globalisasi. Salah satunya ditandai dengan pengidolaan Tim sepak bola negara lain oleh pecinta sepak bola di Indonesia. Hal ini merupakan contoh gejala globalisasi yang disebut….', 'assa2.png', 0, 'Fenomena global', 'Refleksi global', 'Reaksi global', 'Identitas global'),
(197, 7, 'Tujuan reformasi politik oleh masyarakat yang dimotori oleh mahasiswa menjelang kejatuhan Presiden Soeharto mencerminkan….', 'assa2.png', 0, 'Ketidakpercayaan rakyat terhadap pemerintah akibat berbagai praktik KKN (Kolusi, Korupsi, Nepotisme) yang telah lama dilakukan oleh pemerintah orde baru', 'Kekecewaan rakyat terhadap kinerja pemerintahan orde baru yang berulang kali menaikkan harga sembako', 'Ketidakpuasan rakyat terhadap lambatnya pemerintahan orde baru menanggapi krisis ekonomi 1997-1998', 'Adanya anggapan rakyat bahwa terjadi kecurangan pada Pemilu 1997 yang menguntungkan Orde Baru sehingga rakyat menuntut pemilu ulang'),
(198, 7, 'Metode sensus yang paling tepat digunakan untuk melakukan pencatatan di daerah yang mayoritas penduduknya memiliki tingkat pendidikan yang rendah adalah sensus….', 'assa2.png', 0, 'House Holder', 'Canvasser', 'De Jure', 'De Facto'),
(199, 7, 'Penundaan usia pernikahan yang dilakukan oleh seseorang karena alasan ekonomi, menempuh pendidikan atau karir secara tidak langsung dapat mempengaruhi pertumbuhan penduduk, karena hal tersebut merupakan faktor….', 'assa2.png', 0, 'Antinatalitas', 'Antimoralitas', 'Pronatalitas', 'Promoralitas'),
(200, 7, 'Korupsi yang dilakukan oleh orang berpendidikan tinggi dan memiliki jabatan di lingkungan pemerintahan disebut dengan….', 'assa2.png', 0, 'White collar crime', 'Black collar crime', 'Blue collar crime', 'Pink collar crime'),
(201, 7, 'Ketika para siswa akan mengadakan widya wisata, terjadilah perbedaan pendapat dalam menentukan objek. Untuk mencapai mufakat diadakan voting. Contoh penyelesaian konflik tersebut bentuk akomodasi….', 'assa2.png', 0, 'Major rule', 'Subjugation', 'Stalemte', 'Elimination'),
(202, 7, 'Pada prinsipnya status seseorang dapat diperoleh dengan cara-cara bersifat….', 'assa2.png', 0, 'Ascribed, achieved, dan assigned', 'Subjektif, objektif, dan otomatis', 'Otomatis, ada usaha, dan subjektif', 'Konflik, simbol, dan assigned'),
(203, 7, 'Kurva Permintaan yang dihadapi perusahaan dalam pasar oligopoli adalah….', 'assa2.png', 0, 'Bagian atas elastis, bagian bawah inelastis', 'Bagian atas inelastis, bagian bawah elastis', 'Sangat inelastis', 'Sangat elastis'),
(204, 7, 'Salah satu jenis instrumen pasar uang adalah….', 'assa2.png', 0, 'SBI', 'Valuta Asing', 'Obligasi', 'Saham'),
(205, 7, 'Istilah yang menunjukkan persamaan ciri kehidupan masa bercocok tanam dengan masa perundagian adalah….', 'assa2.png', 0, 'Nomaden', 'Sedentar', 'Semi sedentar', 'Semi Nomaden'),
(206, 7, 'Pola teknologi kapak genggam dibawa ke Indonesia oleh gelombang migrasi nenek moyang disebut….', 'assa2.png', 0, 'Proto Melayu', 'Vedda', 'Rig Vedda', 'Deutro Melayu'),
(207, 7, 'Jalur Migrasi orang-orang Proto Melayu ke wilayah nusantara melalui jalur barat yang terjadi sekitar 11000-2000 SM, antara lain melewati wilayah berikut ini….', 'assa2.png', 0, 'Semenanjung Malaysia dan Kalimantan', 'Indocina dan Sumatera', 'Thailand dan Sulawesi', 'Jepang dan Papua'),
(208, 7, 'Penguasa kerajaan Islam yang sesuai dengan wilayah yang dikuasainya adalah….', 'assa2.png', 0, 'Sultan Zaenal Abidin adalah raja Ternate yang pertama memeluk Islam', 'Sultan Trenggono berkuasa di kerajaan Mataram Islam', 'Sultan Agung Tirtayasa adalah penguasa dari kerajaan Demak', 'Sultan Ali Mughayat Syah berkuasa di kerajaan Samudera Pasai'),
(209, 7, 'Isi Pidato PM Ali Sastroamidjojo tanggal 25 Agustus 1953 di DPR mencerminkan….', 'assa2.png', 0, 'Peranan Indonesia sebagai penggagas Konferensi Asia Afrika', 'Pelaksanaan politik luar negeri Indonesia bebas aktif', 'Reaksi Indonesia terhadap penjajahan di Asia-Afrika', 'Keinginan Indonesia menjadi pemimpin di Asia-Afrika'),
(210, 7, 'Terjadinya revolusi Perancis pada tanggal 14 Juli 1789 didukung oleh….', 'assa2.png', 0, 'Borjuis', 'Feodal', 'Rakyat miskin', 'Pemuka Agama'),
(211, 8, '4, 4, 4, 7, 5, 4, 5, 8, 6, 4, ... , ....', '073205_211_1.png', 0, '6, 9', '5, 9', '5, 8', '6, 8'),
(212, 8, 'Soal 2', '051327_212_Soal 2.png', 1, 'D', 'A', 'B', 'C'),
(213, 8, 'Soal 3', '051500_213_Soal 3.png', 1, '8', '2', '4', '6'),
(214, 8, 'Soal 4', '051704_214_Soal 4.png', 1, 'A', 'B', 'C', 'D'),
(215, 8, 'Diberikan bilangan real tak negatif a, b, c, d, e dengan ab + bc + cd + de = 121. Nilai minimum dari a + b + c + d + e adalah . . . .', '053138_215_Soal 5.png', 1, 'B', 'A', 'C', 'D'),
(216, 8, 'Soal 6', '053309_216_Soal 6.png', 1, '3', '4', '5', '6'),
(217, 8, 'Diberikan dua bilangan asli dua angka yang selisihnya 10. Diketahui bahwa bilangan yang kecil merupakan kelipatan 3, sedangkan yang lainnya merupakan kelipatan 7. Diketahui pula bahwa jumlah semua faktor prima kedua bilangan tersebut adalah 17. Jumlah dua bilangan tersebut adalah ....', '074455_217_7.png', 0, '130', '60', '70', '150'),
(218, 8, 'Panjang sisi-sisi dari segitiga merupakan bilangan asli yang berurutan. Diketahui bahwa garis berat dari segitiga tegak lurus dengan salah satu garis baginya. Keliling segitiga itu adalah ...', '074735_218_8.png', 0, '6', '7', '9', '12'),
(219, 8, 'Soal 9', '053637_219_soal 9.png', 1, '1052', '1252', '1588', '1012'),
(220, 8, 'Soal 10', '053811_220_Soal 10.png', 1, '719', '917', '817', '718'),
(221, 8, 'Simpulan yang tepat adalah ...', '054137_221_Soal 11.png', 1, 'Sebagian yang luas dan terbuka dijadikan ladang', 'Semua yang luas dan terbuka dijadikan ladang', 'Semua yang luas dan terbuka adalah lapangan', 'Semua lapangan dijadikan ladang'),
(222, 8, 'Sesuai dengan kesepakatan direktur dengan karyawan perusahaan “X” , karyawan mengundurkan diri dengan diberi pesangon atau perusahaan ditutup. Ternyata perusahaan ditutup. Kesimpulan mana yang benar?', '075819_222_12.png', 0, 'Perusahaan tidak memberi pesangon kepada karyawan.', 'Karyawan memilih perusahaan ditutup', 'Sebagian karyawan diberi pesangon', 'Sebagian karyawan tidak mau mengundurkan diri'),
(223, 8, 'Pada sebuah bidang datar, terdapat 16 garis berbeda dan n titik potong berbeda. Nilai minimal n sehingga dapat dipastikan terdapat 3 kelompok garis yang masing- masing memuat garis-garis berbeda yang saling sejajar adalah ....', 'assa2.png', 0, '117', '115', '171', '152'),
(224, 8, 'Diberikan sebuah box berbentuk kubus besar berukuran 3×3×3 yang seluruh permukaannya dicat dengan warna kuning. Kubus tersebut dipotong menjadi 27 kubus satuan (kubus berukuran 1×1×1). Diketahui bahwa Amir mengambil satu kubus kecil yang salah satu sisinya berwarna kuning. Peluang kubus kecil yang diambil Amir memiliki tepat dua sisi berwarna merah adalah . . . .', 'assa2.png', 0, '6/13', '13/26', '7/13', '8/13'),
(225, 8, 'Misalkan a, b bilangan asli sehingga 2a + 3b = 2020. Nilai terbesar yang mungkin dari 3a + 2b adalah . . . .', 'assa2.png', 0, '3025', '3225', '3250', '3205'),
(226, 8, 'Suatu OSIS yang terdiri dari beberapa anggota hendak menghadiri 40 rapat. Diketahui bahwa setiap rapat dihadiri tepat 10 anggota OSIS dan setiap dua anggota menghadiri rapat bersama paling banyak satu kali. Banyaknya anggota OSIS terkecil yang mungkin adalah . . . .', '080636_226_16.png', 0, '61', '31', '52', '67'),
(227, 8, 'Bilangan asli x terkecil sehingga x + 3 dan 2020x + 1 bilangan kuadrat sempurna adalah . . . .', '080834_227_17.png', 0, '726', '725', '832', '732'),
(228, 8, 'Lima tim bertanding satu sama lain dimana setiap dua tim bertanding tepat sekali. Dalam setiap pertandingan, masing-masing tim memiliki peluang 1/2 untuk menang dan tidak ada pertandingan yang berakhir seri. Peluang bahwa setiap tim menang minimal sekali dan kalah minimal sekali adalah ....', '081058_228_18.png', 0, '17/32', '18/31', '13/32', '5/32'),
(229, 8, 'Jika sebuah jam sekarang menunjukkan pukul 12:00 maka 2959 menit yang lalu jam tersebut menunjukkan pukul ...', '081429_229_19.png', 0, '03.21', '03.22', '03.24', '03.25'),
(230, 8, 'Tujuh buah bendera dengan motif berbeda akan dipasang pada 4 tiang bendera. Pada masing-masing tiang bendera bisa dipasang sebanyak nol, satu, atau lebih dari satu bendera. Banyaknya cara memasang bendera tersebut adalah . . .', '081709_230_20.png', 0, '604800', '684000', '600408', '600480'),
(231, 8, 'Misalkan n adalah bilangan asli terkecil yang semua digitnya sama dan sedikitnya terdiri dari 2019 digit. Jika n habis dibagi 126, maka hasil penjumlahan semua digit dari n adalah . .', 'assa2.png', 0, '12132', '12321', '12221', '13212');
INSERT INTO `soal` (`id`, `id_bidang`, `soal`, `foto`, `status_foto`, `jawaban1`, `jawaban2`, `jawaban3`, `jawaban4`) VALUES
(232, 8, 'Misalkan P adalah himpunan bilangan asli yang digitnya tidak berulang dan dipilih dari 1, 3, 5, 7. Jumlah digit satuan dari semua anggota P adalah ....', '081923_232_21.png', 0, '256', '196', '126', '225'),
(233, 8, 'Terdapat tiga meja bundar yang identik. Setiap meja harus dapat ditempuh minimal satu siswa. Banyaknya cara mendudukkan enam siswa pada meja-meja tersebut adalah ....', '082152_233_23.png', 0, '225', '177', '196', '126'),
(234, 8, 'Bilangan-bilangan 1111, 5276, 8251, dan 9441 bersisa sama jika dibagi N. Nilai N terbesar yang memiliki sifat tersebut adalah ....', '082452_234_24.png', 0, '595', '656', '959', '458'),
(235, 8, 'Ada sebanyak 6! Permutasi dari huruf-huruf OSNMAT. Jika semua permutasi tersebut diurutkan secara abjad dari A ke Z, maka OSNMAT pada urutan ke ....', '082904_235_25.png', 0, '447', '443', '450', '348'),
(236, 8, 'Suatu perusahaan permen memproduksi empat macam rasa permen. Permen dijual dalam bungkus, setiap bungkus berisi 10 permen dengan setiap rasa permen ada dalam bungkus. Banyaknya macam variasi isi bungkusan permen adalah ....', '083043_236_26.png', 0, '84', '42', '10', '21'),
(237, 8, 'Soal 27', '063600_237_Soal 27.png', 1, '2', '3', '-1', '1'),
(238, 8, 'Diberikan tiga bilangan bulat positif berurutan. Jika bilangan pertama tetap, bilangan kedua ditambah 10 dan bilangan ketiga ditambah bilangan prima, maka ketiga bilangan ini membentuk deret ukur. Bilangan ketiga dari bilangan bulat berurutan adalah ....', '083454_238_28.png', 0, '13', '11', '12', '21'),
(239, 8, 'Bilangan bulat x jika dikalikan 11 terletak diantara 1500 dan 2000. Jika x dikalikan 7 terletak antara 970 dan 1275. Jika x dikalikan 5 terletak antara 960 dan 900. Banyaknya bilangan x sedemikian yang habis dibagi 3 sekaligus habis dibagi 5 ada sebanyak ....', '083608_239_29.png', 0, '2', '11', '9', '15'),
(240, 8, 'Suatu sekolah mempunyai lima kelompok belajar siswa kelas 11. Kelompok-kelompok belajar itu berturut-turut mengirimkan 2, 2, 2, 3, dan 3 siswa untuk suatu pertemuan. Mereka akan duduk melingkar sehingga setiap siswa memiliki paling sedikit satu teman dari kelompok belajar yang sama yang duduk disampingnya. Banyaknya cara melakukan hal tersebut adalah ....', '083732_240_30.png', 0, '6912', '4650', '1296', '9613'),
(241, 9, 'What does the passage mainly discuss?', '022437_241_1 sampai 10.PNG', 1, 'The changing definition of an urban area .', 'How cities in the United States began and developed.', 'Solutions to overcrowding in cities .', 'How the United States Census Bureau conducts a census.'),
(242, 9, 'According to the passage, the population of the United States was first classified as rural or urban in', '022514_242_1 sampai 10.PNG', 1, '1870', '1900', '1950', '1970'),
(243, 9, 'The word “distinguished” in line 2 is closest in meaning to ___.', '022559_243_1 sampai 10.PNG', 1, 'differentiated', 'removed', 'honored', 'protected'),
(244, 9, '4.	Prior to 1900, how many inhabitants would a town have to have before being defined as urban?', '022647_244_1 sampai 10.PNG', 1, '8,000', '2,500', '15,000', '50,000'),
(245, 9, 'According to the passage, why did the Census Bureau revise the definition of urban in 1950?', '022724_245_1 sampai 10.PNG', 1, 'City borders had become less distinct.', 'Cities had undergone radical social change.', 'Elected officials could not agree on an acceptable definition.', 'New businesses had relocated to larger cities.'),
(246, 9, 'The word “those” in line 8 refers to ___.', '022811_246_1 sampai 10.PNG', 1, 'persons', 'boundaries', 'units', 'areas'),
(247, 9, 'Which of the following is NOT true of an SMSA?', '022903_247_1 sampai 10.PNG', 1, 'It consists of at least two cities.', 'It can include unincorporated regions.', 'It can include a city\'s outlying regions.', 'It has a population of at least 50,000 .'),
(248, 9, 'By 1970, what proportion of the population in the United States did NOT live in an SMSA?', '022942_248_1 sampai 10.PNG', 1, '1/ 3', '1/ 2', '2/ 3', '3/ 4'),
(249, 9, 'The Census Bureau first use d the term “SMSA” in ___.', '023022_249_1 sampai 10.PNG', 1, '1950', '1900', '1969', '1970'),
(250, 9, 'Where in the passage does the author mention names used by social scientists for an urban area?', '023057_250_1 sampai 10.PNG', 1, 'Line 20-21.', 'Line 17-18.', 'Line 10-11.', 'Lines 2-3.'),
(251, 9, 'The word \"coined\" in line 1 could be replaced by ___ .', '023202_251_11 sampai 20.PNG', 1, 'created', 'mentioned', 'understood', 'discovered'),
(252, 9, 'The word \"intervention\" in line 3 can best be replaced by ___.', '023243_252_11 sampai 20.PNG', 1, 'influence', 'device', 'need', 'source'),
(253, 9, 'The second \"it\" in line 5 refers to ___.', '023325_253_11 sampai 20.PNG', 1, 'energy', 'light bulb', 'molecule', 'atom'),
(254, 9, 'Which of the following statements best describes a laser?', '023417_254_11 sampai 20.PNG', 1, 'A device for stimulating atoms and molecules to emit light .', 'An atom in a high-energy state.', 'A technique for destroying atoms or molecules .', 'An instrument for measuring light waves .'),
(255, 9, 'Why was Towne\'s early work with stimulat ed emission done with microwaves?', '023458_255_11 sampai 20.PNG', 1, 'It was easier to work with longer wavelengths.', 'He was not concerned with light amplification .', 'His partner Schawlow had already begun work on the laser.', 'The laser had already been developed.'),
(256, 9, 'In his research at Columbia University, Charles Townes worked with all of the following EXCEPT ___.', '023547_256_11 sampai 20.PNG', 1, 'light amplification', 'a maser', 'microwaves', 'stimulated emission'),
(257, 9, 'In approximately what year was the first maser built?', '023623_257_11 sampai 20.PNG', 1, '1953', '1951', '1917', '1957'),
(258, 9, 'The word \"emerged\" in line 17 is closest in meaning to ___.', '023707_258_11 sampai 20.PNG', 1, 'appeared', 'succeeded', 'concluded', 'increased'),
(259, 9, 'The word \"outlining\" in line 18 is closest in meaning to', '023748_259_11 sampai 20.PNG', 1, 'summarizing', 'checking', 'studying', 'assigning'),
(260, 9, 'Why do people still argue about who deserves the credit for the concept of the laser?', '023825_260_11 sampai 20.PNG', 1, 'Several people were developing the idea at the same time.', 'The researchers\' notebooks were lost.', 'No one claimed credit for the development until recently.', 'The work is still incomplete.'),
(261, 9, 'What does the passage mainly discuss?', '024145_261_21 sampai 30.PNG', 1, 'The efficiency of the bill of the crossbill .', 'The importance of conifers in evergreen forests .', 'The variety of food available in a forest .', 'The different techniques birds use to obtain food.'),
(262, 9, 'Which of the following statements best represents the type of \"evolutionary fine -tuning\" mentioned in line 1?', '024415_262_21 sampai 30.PNG', 1, 'Different shapes of bills have evolved depending on the available food supply.', 'White-wing crossbills have evolved from red crossbills.', 'Newfoundland\'s conifers have evolved small cones.', 'Several subspecies of crossbills have evolved from two species.'),
(263, 9, 'Why does the author mention oystercatchers, hummingbirds, and kiwis in lines 2 -3?', '024452_263_21 sampai 30.PNG', 1, 'They illustrate the relationship between bill design and food supply.', 'They are closely related to the crossbill.', 'Their beaks are similar to the beak of the crossbill.', 'They are examples of birds that live in the forest.'),
(264, 9, 'Crossbills are a type of _ .', '024525_264_21 sampai 30.PNG', 1, 'finch', 'kiwi', 'hummingbird', 'shorebird'),
(265, 9, 'The word \"which\" in line 10 refers to ___ .', '024600_265_21 sampai 30.PNG', 1, 'force', 'bird', 'bill', 'seed'),
(266, 9, 'The word \"defter\" in line 17 is closest meaning to ___.', '024658_266_21 sampai 30.PNG', 1, 'mroe skilled', 'hungrier', 'more tired', 'more pleasant'),
(267, 9, 'The word \"robust\" in line 21 is closest in meaning to___ .', '024731_267_21 sampai 30.PNG', 1, 'strong', 'colorful', 'unusual', 'sharp'),
(268, 9, 'In what way is the Newfoundland crossbill an anomaly?', '024808_268_21 sampai 30.PNG', 1, 'The size of its bill does not fit the size of its food source.', 'It uses a different technique to obtain food.', 'It is larger than the other crossbill species.', 'It does not live in evergreen forests.'),
(269, 9, 'The final paragraph of the passage will probably continue with a discussion of ___.', '024844_269_21 sampai 30.PNG', 1, 'how the Newfoundland crossbill survives wit h a large bill', 'what mammals live in the forests of North America', 'the fragile ecosystem of Newfoundland', 'other species of forest birds'),
(270, 9, 'Where in the passage does the author describe how a crossbill removes a seed from its cone?', '024918_270_21 sampai 30.PNG', 1, 'The second paragraph.', 'The first paragraph.', 'The third paragraph .', 'The fourth paragraph .'),
(271, 10, 'Sel yang mempunyai bentuk dan fungsi yang sama akan membentuk ...', 'assa2.png', 0, 'Jaringan', 'Organ', 'Individu', 'Bioma'),
(272, 10, 'Vaksin yang mempunyai nukleokapsid terpanjang terdapat pada ...', 'assa2.png', 0, 'Adenovirus, warzervirus, TMV', 'Virus influenza, TMV, virus herpes', 'Adenovirus, virus kutil, TMV', 'Adenovirus, virus kutil, virus influenza'),
(273, 10, 'Cyanophyta yang berbentuk benang memiliki sel yang bentuknya berbeda dengan sel-sel tetangganya. Sel tersebut berfungsi sebagai alat reproduksi, sel itu disebut...', 'assa2.png', 0, 'Heterokist', 'Sporangium', 'Zoospora', 'Hormogonium'),
(274, 10, 'Emfisema merupakan gangguan pada jaringan paru-paru yang kehilangan elastisitasnya. Apa yang akan terjadi apabila gangguan ini terus berlangsung ?', 'assa2.png', 0, 'Proses inspirasi dan ekspirasi terganggu sehingga beban pernapasan meningkat', 'Bronkus akan mengalami penyempitan sehingga proses pernapasan terganggu', 'Proses penyampaian oksigen ke dalam sel-sel tubuh meningkat', 'Tidak terjadi proses pertukaran O2 dan CO2 di alveolus'),
(275, 10, 'Melalui teknik transplantasi inti dapat diperoleh domba Dolly yang memiliki sifat keunggulan dari induk yang mendonorkan inti sel yang disisipkan pada sel ovum. Apa prinsip teknik tersebut?', 'assa2.png', 0, 'Seluruh sifat-sifat induk pendonor diwariskan kepada keturunannya', 'Sebagian besar sifat-sifat induk pendonor diwariskan kepada keturunannya', 'Inti dari sel induk dapat meningkatkan kualitas gen-gen unggul', 'Interaksi antara inti sel donor dan sitoplasmaovum membentuk sifat unggul'),
(276, 10, 'Senyawa yang dihasilkan oleh katabolisme karbohidrat, lemak dan protein yang selanjutnya memasuki rangkaian reaksi dalam siklus krebs adalah ...', 'assa2.png', 0, 'Asetil KoA', 'Asam piruvat', 'Gliseraldehid-3p', 'Oksaloasetat'),
(277, 10, 'Diketahui dua populasi berbeda mengalami inhibridasi akibat migrasi populasi 1 ke habitat populasi 2. Diduga populasi sesungguhnya berasal dari nenek moyang yang sama. Peristiwa tersebut memunculkan variasi baru spesies yang adaptif dan fertil sehingga mendorong terjadinya evolusi. Alasan yang tepat terjadinya proses evolusi pada kasus tersebut adalah ...', 'assa2.png', 0, 'Perpindahan populasi mendorong terjadinya mutasi pohon', 'Masing-masing induk merekomendasikan setengah sifat pewarisannya', 'Gen-gen resesif pada dua populasi akan tersingkir', 'Interaksi gen-gen yang sama akan memunculkan sifat baru'),
(278, 10, 'Berdasarkan hasil pemeriksaan kesehatan, seorang siswi kelas XII memiliki tekanan darah 150/90 mmHg, selang satu minggu masih memiliki tekanan darah yang sama. Siswi tersebut merasa sangat pusing yang amat sangat. Hasil diagnosis dokter diduga siswi tersebut', 'assa2.png', 0, 'Hipertensi', 'Hipotensi', 'Polistemia', 'Anemia'),
(279, 10, 'Tahun 1926 Muller melakukan eksperimen terhadap lalat buah yang dipengaruhi sinar X. Hasil eksperimen memunculkan variasi fenotip yang tidak pernah dijumpai pada populasi liar, seperti individu tanpa sayap dan bersayap melengkung yang mampu membentuk populasi di laboratorium. Apakah alasan yang tepat bahwa eksperimen tersebut dapat memengarhi keberlangsungan evolusi ?', 'assa2.png', 0, 'Fenotip tersebut hanya muncul jika dipengaruhi sinar X', 'Fenotip tersebut bersifat steril dan tidak stabil', 'Fenotip tersebut hanya bersifat sesaat, ketika tidak dipengaruhi sinar X akan kembali normal', 'Terjadi perubahan fenotip akibat desakan lingkungan'),
(280, 10, 'yang merupakan ciri-ciri trombosit adalah ...', '143126_280_Soal 10.png', 1, 'semua jawaban benar', 'iii dan v', 'i, ii, dan iv', 'i, ii, dan iii'),
(281, 10, 'Seseorang memiliki jenis kelamin laki-laki tetapi memiliki payudara yang tumbuh dan testis tidak berkembang. Orang tersebut mengalami sindrom...', 'assa2.png', 0, 'Klinefelter', 'Turner', 'Patau', 'Down'),
(282, 10, 'Pernyatan berikut yang benar tentang nikotinamid adenine dinukleotida (NAD+) adalah ...', 'assa2.png', 0, 'NADH adalah akseptor elektron yang pertama pada reaksi oksidatif metabolik.', 'NAD+ adalah donor elektron yang pertama pada reaksi oksidatif metabolik.', 'NADH dan NAD+ membentuk gugus prostetik untuk beberapa dehydrogenase.', 'NAD+ adalah akseptor elektron yang pertama pada reaksi oksidatif metabolik.'),
(283, 10, 'Pada penyakit kolera, terdapat sekresi tidak terkontrol ion-ion natrium dan air ke dalam iumen usus karena aksi dari toksin kolera pada sistem reseptor terikat protein G. Bagaimana toksin ini bekerja?', '085015_283_13.png', 0, 'Kolera toksin menghambat aktivitas GTPase dari subunit alfa protein G', 'Toksin kolera menghambat pengikatan vasoaktif polipeptida intestinal pada reseptor.', 'Kolera toksin menghambat polimerisasi fimalen aktin pada saat sel bergerak.', 'Toksin kolera mengaktifkan protein G (inhibitor)'),
(284, 10, 'Pernyataan berikut ini yang benar tentang mekanisme reaksi yang bergantung cahaya pada fotosisntesis adalah ...', 'assa2.png', 0, 'Ferredoksin-NADP reduktase mereduksi NADP+ mejadi NADPH', 'Siklik fotofosforilasi mereduksi NADP+ menjadi NADPH.', 'Elektron dari fotosistem I mereduksi feofitin.', 'Elektron dari fotosistem I mereduksi NADPH.'),
(285, 10, 'Laju transpirasi dipengaruhi oleh kecepatan angin. Berikut ini yang mencegah peningkatan laju transpirasi ketika ada angin disekitar daun tumbuhan adalah ...', 'assa2.png', 0, 'Stomata berada dipermukaan daun-daun tepat berhadapan dengan lapisan tipis udara.', 'Daun menggulung disepanjang sumbunya', 'Jawaban A dan B.', 'Trikom melindungi stomata yang berad dicelah permukaan daun.'),
(286, 10, 'Diantara senyawa berikut ini yang disintesis oleh sel-sel mesofil dari tumbuhan CAM saat malam hari adalah ..', 'assa2.png', 0, 'Ribulosa bifosfat', 'Amilum', 'Malat', 'Glukosa'),
(287, 10, 'Pembuatan wine dari buah anggur menggunakan prinsip reaksi mana dari jalur respirasi dibawah ini ...', 'assa2.png', 0, 'Sistem sitokrom', 'Siklus krebs', 'Respirasi anaerob', 'Reaksi gelap'),
(288, 10, 'Ketika musim hujan datang, banyak cacing yang keluar ke permukaan tanah. Pernyataan berikut ini yang paling tepat untuk menjelaskan perilaku tersebut adalah ....', '085849_288_18.png', 0, 'Tanah yang basah menyulitkan cacing tanah melakukan pertukaran gas dengan lingkungannya.', 'Tanah yang basah menyulitkan cacaing tanah untuk bergerak di dalam tanah', 'Tanah yang  basah menyediakan nurisi yang lebih sedidikt bagi cacing tanah', 'Air yang banyak di permukaan tanah dapat menghemat eneri cacing tanah dalam memproduksi lendir.'),
(289, 10, 'Dua pegas dengan konstanta pegas ( k1) dan (k2 ) dihubungkan seri. Hitung konstanta gabungan kedua pegas. Jika pegas pertama (k1 ) dipotong menjadi 2 bagian yang sama persis. Kemudian kedua bagian ini dihubungkan paralel dan selanjutnya sistem ini dihubungkan seri dengan pegas kedua ( k2). konstanta pegas gabungan sekarang adalah', '144455_289_Soal 19.png', 1, 'A', 'B', 'C', 'D'),
(290, 10, 'Seorang berlari diatas suatu lori yang bergerak kecepatan 10m/s. Kecepatan orang 2m/s relatif terhadap lori. Jika panjang lori 8m. Berapa lama orang itu bergerak dari satu ujung lori ke ujung lain jika kecepatan orang searah dengan kecepatan lori dan berapa lama jika orang itu berlari berlawanan arah dengan arah lori ...', 'assa2.png', 0, '4 s dan 4 s', '8 s dan 4 s', '5 s dan 4 s', '2,5 s dan 5 s'),
(291, 10, 'Sebuah pesawat luar angkasa ditembakkan dengan kecepatan 11.000 m/s dari permukaan bumi. Berapakan kecepatan minimum pesawat tersebut agar tidak kembali ke bumi ?', 'assa2.png', 0, '11.200 km/jam', '11.000 km/jam', '10.000 km/jam', '11.800 km/jam'),
(292, 10, 'Di antara senyawa berikut ini, senyawa yang mempunyai tekanan uap paling rendah adalah ...', 'assa2.png', 0, 'Hidrogenperoksida, H2O2', 'Etanol, CH3CH2OH', 'Arteriosklerosis', 'Air, H2O'),
(293, 10, 'Perhatikanlah unsur-unsur dalam susunan bekala yang terdapat dalam periode ke-2 dari blok-p. Energi ionisasi pertama dari unsur unsur ini adalah', 'assa2.png', 0, 'Naik dari B ke N, turun untuk O dan naik dari O ke Ne', 'Turun dari B ke N dan nanik beraturan dari N ke Ne', 'Naik dari B ke O, turun untuk F, dan kemudian naik untuk Ne', 'Turun dari B ke Ne'),
(294, 10, 'Soal 24', '145055_294_Soal 24.png', 1, '7,64', '7,46', '7,56', '7,00'),
(295, 10, 'Kedalam 100 mL larutan NaOH yang mempunyai pH=12 ditambahkan sebanyak 900 mL air. Nilai pH larutan yang anda peroleh adalah ...', 'assa2.png', 0, '11', '1', '5', '7'),
(296, 10, 'Bila anda membuat larutan asam lemah seperti tabel dibawah ini dengan molaritas yang sama, maka yang kan memberikan pH paling kecil adalah ...', 'assa2.png', 0, 'Asam kloroasetat', 'Ion benzilammonium', 'Asam benzoat', 'Hiroksilamin hidroklorida'),
(297, 10, 'Larutan kalium permanganat direaksikan dengan kalium oksalat dalam suasana basa menghasilkan mangan oksida (MnO2) dan karbondioksia. Maka koefisien kalium permanganat dan kalium oksalat setelah reaksi setara yaitu ...', 'assa2.png', 0, '2 dan 3', '4 dan 3', '3 dan 2', '2 dan 6'),
(298, 10, 'Bila gelembung-gelembung gas klor dialirkan ke dalam larutan natrium hidroksida pekat panas, maka akan terbentuk larutan...', 'assa2.png', 0, 'NaCl dan NaClO3', 'NaCl dan NaClO', 'NaClO dan NaClO3', 'NaClO3 saja'),
(299, 10, 'Compared to pure water, a 0.1 mol/L NaCl solution has...', 'assa2.png', 0, 'Lower freezing point', 'Lower electrical conductivity', 'higher pH', 'Higher vapor pressure'),
(300, 10, 'Among the following groups of compounds, the group of compounds containing only covalent bond molecules is...', 'assa2.png', 0, 'BCl3, SiCl4, PCl3', 'Al, O3, As4', 'I2, H2S, Nal', 'NH4Br, N2H4, HBr'),
(301, 11, 'Fosil penemuan Eugene Dubois di Trinil Ngawi tahun 1890 disebut dengan Pithecantropus erectus karena merupakan….', 'assa2.png', 0, 'Manusia kera yang sudah bisa berjalan tegak', 'Manusia kera yang sudah hidup menetap', 'Manusia kera yang memiliki fisik seperti manusia', 'Manusia yang lebih maju dibanding spesies lainnya'),
(302, 11, 'Pada zaman pemerintahan Dinasti Chin terjadi perubahan revolusioner di bidang sistem teknologi masyarakat, yaitu….', 'assa2.png', 0, 'Penyatuan ukuranalat-alat timbangan, perkakas pertanian, ukuran roda kereta', 'Membuat pakaian lenan, perkakas dari tembikar dan tembaga serta perhiasan dari emas', 'Membuat menara-menara pengawas untuk menahan serangan dari utara', 'Pembuatan benda-benda dari keramik yang memiliki nilai seni dan jual tinggi'),
(303, 11, 'Adipati unus menyerang Portugis di Malaka pada tahun 1513 karena….', 'assa2.png', 0, 'Demak menganggap Portugis sebagai ancaman ekonomi perdagangan lada', 'Portugis berupaya untuk menyebarkan ajaran kristen ke seluruh nusantara', 'Portugis adalah penjajah yang kejam', 'Portugis mengkhianati kesepakatan perjanjian perdagangan dengan Demak'),
(304, 11, 'Kebijakan militer Jepang menempatkan pulau Jawa berada di bawah kekuasaan….', 'assa2.png', 0, 'Komando angkatan darat', 'Komando angkatan laut', 'Komando angkatan udara', 'Letjen Hitoshi Imamura'),
(305, 11, 'Pada masa Orde Lama sistem ekonomi yang dianut adalah sitem ekonomi etatisme yaitu….', 'assa2.png', 0, 'Negara beserta aparat ekonomi mendomisili perekonomian negara', 'Rakyat bertanggungjawab terhadap perkembangan ekonomi', 'Rakyat menghimpun kekuatan ekonomi untuk bersaing dengan investor asing', 'Negara menyediakan perundang-undangan dalam bidang perekonomian'),
(306, 11, 'Terdapat beberapa huruf yang dikenal oleh bangsa Indonesia pada masa awal aksara, salah satunya adalah huruf yang berasal dari India Utara. Huruf ini terdapat di beberapa prasasti peninggalan kerajaan Mataram Kuno,jenis huruf tersebut adalah….', 'assa2.png', 0, 'Pallawa', 'Pranagari', 'Kawi', 'Sansekerta'),
(307, 11, 'Salah satu dampak dari zaman es bagi wilayah Indonesia adalah….', 'assa2.png', 0, 'Terbentuknya paparan sahul dan paparan sunda', 'Wilayah Indonesia berbentuk daratanyang sangat luas', 'Indonesia wilayahnya terdiri dari kepulauan', 'Banyaknya pegunungan di Wilayah Indonesia'),
(308, 11, 'Kitab perundang-undnagan tertulis pertama yang diakui secara Internasional adalah codex hammurabi yang berasal dari peradaban….', 'assa2.png', 0, 'Lembah sungai Eufrat dan Trigis', 'Lembah sungai Indus', 'Lembah sungai Nil', 'Lembah sungai Kuning'),
(309, 11, 'Geosfer merupakan studi tentang persamaan dan perbedaan geosfer . Oleh karena itu geosfer merupakan….', 'assa2.png', 0, 'Obyek material geografi', 'Obyek regional geografi', 'Obyek fungsional geografi', 'Obyek formal geografi'),
(310, 11, 'Gejala-gejala di permukaan bumi dikaji secara geografis melalui sudut pandang….', 'assa2.png', 0, 'Keruangan dan kewilayahan', 'Persebaran dan perbandingan', 'Persamaan dan perbedaan', 'Kelingkungan dan kelestarian'),
(311, 11, 'Hasil bagian dari peta topografi yang penting untuk keperluan studi geologi adalah….', 'assa2.png', 0, 'Kemiringan Lereng', 'Wilayah administrasi', 'Pola pemukiman', 'Bentuk transportasi'),
(312, 11, 'Menurut Descartes (1596-1650) Bumi semakin lama semakin surut dan mengerut yang diakibatkan oleh proses pendinginan. Ini adalah inti dari teori….', 'assa2.png', 0, 'Kontraksi', 'Lempeng tektonik', 'Konveksi', 'Pergeseran benua'),
(313, 11, 'Tanah yang banyak ditemukan di sekitar gunung api di Pulau Jawa adalah….', 'assa2.png', 0, 'Andosol', 'Mergel', 'Grumusol', 'Regosol'),
(314, 11, 'Angin pasat yang bertiup di atas Pulau Sumatra menunjukkan kecenderungan….', 'assa2.png', 0, 'Dibelokkan ke kanan dan semakin melemah', 'Dibelokkan ke kiri dan semakin melemah', 'Semakin menguat dan menjadi pusat siklon', 'Semakin melemah dan menimbulkan daerah doldrum'),
(315, 11, 'Peranan hutan dalam pengendalian banjir di daerah aliran sungai (DAS) bagian hilir adalah….', 'assa2.png', 0, 'Meningkatkan infiltrasi dan menurunkan debit banjir', 'Mengurangi evaporasi dan meningkatkan infiltrasi', 'Memperlancar aliran dan meningkatkan debit banjir', 'Mempercepat laju aliran dan meningkatkan infiltrasi'),
(316, 11, 'Faktor yang mempengaruhi kemiripan tumbuhan di Sulawesi bagian timur dengan yang ada', 'assa2.png', 0, 'Iklim, edafik, dan bentang alam', 'Topografi, edafik, dan iklim', 'Iklim, edafik, dan topografi', 'Bentang lahan, edafik, dan topografi'),
(317, 11, 'Berikut ini merupakan objek studi sosiologi adalah….', 'assa2.png', 0, 'Hubungan antar manusia dan proses klausal timbulnya antar manusia', 'Pemenuhan kebutuhan hidup manusia dalamkehidupan masyarakat', 'Hunungan proses pemilikan pemimpin dan proses pembagian kekuasaan', 'Proses hubungan timbal balik antar sesama hingga timbul saling pengertian'),
(318, 11, 'Lahirnya sosiologi dilatarbelakangi oleh peristiwa penting yang mengubah tatanan sosial masyarakat Eropa secara mendasar di abad 19 pertengahan.Salah satu peristiwa tersebut adalah….', 'assa2.png', 0, 'Revolusi politik di Perancis', 'Imperialisme perdagangan', 'Revolusi komunis di Rusia', 'Munculnya fasisme di Jerman'),
(319, 11, 'Pertentangan antar kelas borjuis dan proletary menurut Karl Marx dapat dijelaskan dengan prespektif….', 'assa2.png', 0, 'Konflik sosial', 'Interaksi simbolik', 'Struktural fungsional', 'Definisi sosial'),
(320, 11, 'Kebingungan yang terjadi akibat tidak jelasnya norma yang berlaku dapat menyebabkan seseorang melakukan tindakan yang menyimpang dari nilai dan norma yang berlaku di masyarakat disebut….', 'assa2.png', 0, 'Anomi', 'Deviant', 'Cultural shock', 'Cultural Lag'),
(321, 11, 'Kepribadian seorang anak biasanya mirip dengan kepribadian orang tuanya. Pernyataan tersebut merupakan faktor sosialisasi yaitu….', 'assa2.png', 0, 'Warisan biologis', 'Lingkungan fisik', 'Kebudayaan', 'Pengalaman unik'),
(322, 11, 'Kontak sosial primer adalah interaksi sosial yang terjadi antara dua orang atau lebih yang meliputi….', 'assa2.png', 0, 'Adanya tatap muka melalui saluran primer', 'Adanya tujuan tatap muka dan perencanaan', 'Adanya kesamaan konsep tujuan dan tatap muka', 'Adanya tujuansaluran primer dan impersonal'),
(323, 11, 'Pihak pemuda yang sudah minta maaf pada kerabat si gadis pada peristiwa “kawin lari” pada masyarakat lombok merupakan contoh….', 'assa2.png', 0, 'Customs', 'Folkways', 'Laws', 'Mores'),
(324, 11, 'Jika pemerintah melakukan ekspansi kebijakan moneter, maka hal berikut adalah dampak kebijakan tersebut, kecuali….', 'assa2.png', 0, 'Investasi meningkat', 'Tingkat suku bunga menurun', 'Inflasi tinggi', 'Ekspor meningkat'),
(325, 11, 'Menurut teori kuantitas uang, kalau jumlah uang beredar bertambah akan dapat menyebabkan terjadinya….', 'assa2.png', 0, 'Inflasi', 'Deflasi', 'Devaluasi', 'Pengangguran'),
(326, 11, 'Pasar oligopoli adalah suatu bentuk pasar dimana dalam industri terdapat….', 'assa2.png', 0, 'Beberapa penjual', 'Banyak penjual', 'Banyak sekali penjual', 'Satu penjual'),
(327, 11, 'Nilai barang/jasa yang dikorbankan untuk mendapatkan barang/jasa yang lain, dalam istilah ekonomi disebut….', 'assa2.png', 0, 'Opportunity cost', 'Replacement cost', 'Explicit cost', 'Production cost'),
(328, 11, 'Fungsi konsumsi masyarakat adalah C = 70.000.000 + 0,8 Y. Bila pendapatan nasional sebesar Rp 1.200.000.000, jumlah tabungan masyarakat adalah….', 'assa2.png', 0, 'Rp 170.000.000', 'Rp 180.000.000', 'Rp 190.000.000', 'Rp 200.000.000'),
(329, 11, 'Penyusunan APBN bertujuan untuk….', 'assa2.png', 0, 'Mengatur pembiayaan agar lebih bermanfaat dalam mensejahterakan rakyat', 'Mengalokasikan dana pemerintah per departemen', 'Menetapkan proyek yang harus dibiayai pemerintah', 'Penggunaan hasil pajak secara maksimal'),
(330, 11, 'Faktor utama yang menyebabkan timbulnya perdagangan internasional adalah….', 'assa2.png', 0, 'Adanya keinginan memenuhi kebutuhan yang tidak dapat dipenuhi dalam negerinya sendiri', 'Adanya persamaan sumber-sumber daya alam antara dua negara atau lebih sehingga timbul kerjasama', 'Adanya keinginan suatu Negara untuk menguasai negara lain', 'Adanya keinginan untuk mendapatkan dan menguasai bahan-bahan mentah secara monopoli di suatu Negara'),
(331, 12, 'Lingkaran-lingkaran pada gambar berasal dari bilangan 1 sampai dengan 12. Agar jumlah tiap ruas barisn sama, maka tempat yang tepat untuk bilangan 7 pada huruf ….', '133029_331_1.PNG', 1, 'A', 'B', 'C', 'D'),
(332, 12, 'Sebuah bilangan dilambangkan dengan p, jika dikalikan dengan 60, nilainya meningkat sebesar 3.717. Berapakah nilai p ?', 'enura.png', 0, '63', '37', '73', '67'),
(333, 12, 'Dua buah kayu beralaskan lingaran yang kemudian diikat dengan tali dengan panjang 288 cm. Jika panjang jari – jari kedua kayu sama panjang maka tentukan panjang jari – jari tersebut …', '133226_333_3.PNG', 1, 'B', 'A', 'C', 'D'),
(334, 12, '4', '133327_334_4.PNG', 1, 'B', 'A', 'C', 'D'),
(335, 12, '5', '133519_335_5.PNG', 1, '5', '6', '4', '3'),
(336, 12, '6', '133555_336_6.PNG', 1, '45', '43', '47', '49'),
(337, 12, 'Tentukan nilai a + b + c yang memenuhi hubungan berikut!', '133633_337_7.PNG', 1, '5', '8', '10', '12'),
(338, 12, 'Sebuah kontainer berisi 2640 boks. Tiap boks memiliki berat 0,75 kg. Berapakah berat seluruh isi kontainer tersebut ?', 'enura.png', 0, '1980', '1990', '1970', '2000'),
(339, 12, 'Diketahui suatu bilangan ABBCA. Jika A adalah bilangan prima yang genap, B bilangan kuadrat kedua dan C adalah bilangan komposit pertama yang ganjil maka tentukan ABBCA :', 'enura.png', 0, '6123', '6122', '6121', '6120'),
(340, 12, 'Perkebunan milik Pak Widodo menghasilkan apel 30%, jeruk 45% dan sisanya durian. Jika produksi total hasil perkebunannya adalah 2500 ton maka tentukan jumlah durian yang dihasilkan!', 'enura.png', 0, '625', '600', '650', '675'),
(341, 12, 'Agus mendapat bagian 25% tanah pamannya. Jika luas tanah pamannya itu 2,7 hektar maka berapa luas tanah yang diterima Agus?', 'enura.png', 0, '6750 m kuadrat', '6500 m kuadrat', '6250 m kuadrat', '6000 m kuadrat'),
(342, 12, 'Penduduk Jawa Tengah 25% dari penduduk pulau Jawa dan sebesear 15% dari penduduk Indonesia. Berapa persenkah penduduk Indonesia yang tinggal di luar Jawa?', 'enura.png', 0, '40%', '30%', '50%', '60%'),
(343, 12, 'Harga sebuah kemeja adalah rp 150.000,00 Jika mendapat diskon 20% maka berapakah harga beli kemeja tersebut?', 'enura.png', 0, 'Rp 120.000,00', 'Rp 130.000,00', 'Rp 120.000,00', 'Rp 150.000,00'),
(344, 12, 'Putri dan Angga membeli baju dan celana. Pada label harganya tertulis harga total Rp 250.000,00. Pada saat membayar ke kasir ternyata uang tersebut dikembalikan Rp 37.500,00 Berapa persen diskon yang mereka terima?', '035227_344_Untitled.png', 0, '15%', '10%', '12%', '17%'),
(345, 12, 'Untuk mendapatkan laba 25% ternyata sebuah mobil bekas harus dijual 42 juta rupiah. Berapakah harga saat beli (modal) mobil bekas tersebut?', 'enura.png', 0, 'Rp 52.500.000,00', 'Rp 50.000.000,00', 'Rp 47.500.000,00', 'Rp 45.000.000,00'),
(346, 12, '16', '134254_346_16.PNG', 1, 'A', 'B', 'C', 'D'),
(347, 12, 'Dikethaui barisan 1, 3, 5, ..., 401. Banyaknya bilangan itu jika ditulis lengkap adalah ....', 'enura.png', 0, '201', '120', '101', '210'),
(348, 12, 'FPB dan KPK dari 40 dan 60 berturut-turut ....', 'enura.png', 0, '20 dan 120', '30 dan 120', '30 dan 100', '20 dan 100'),
(349, 12, '19', '134512_349_19.PNG', 1, 'A', 'B', 'C', 'D'),
(350, 12, 'Bayu, Adit dan Dimas berlatih futsal di tempat yang sama. Bayu berlatih futsal setiap 6 hari sekali, Adit setiap 12 hari sekali, dan Dimas setiap 10 hari sekali. Pada hari Sabtu, mereka berlatih futsal bersama-sama untuk pertama kalinya. Pada hari apa mereka akan berlatih futsal bersama-sama untuk kedua kalinya?', '040229_350_Untitled.png', 0, 'Rabu', 'Selasa', 'Senin', 'Minggu'),
(351, 12, 'Pak Made memiliki 3 petak sawah yang luasnya masing-masing 6 are, 0,15 ha, dan 125m^2. Luas seluruh sawah Pak Made adalah ....', '040402_351_Untitled.png', 0, '2.225 m kuadrat', '1.375 m kuadrat', '1.225 m kuadrat', '2.375 m kuadrat'),
(352, 12, 'Seorang pedagang membelli 1 gros dan 3 lusin piring untuk dijual di tokonya. Jika sebelumnya ia masih memiliki persediaan 45 piring, banyak piring yang dimiliki pedagang tersebut sekarang adalah ....', '040630_352_Untitled.png', 0, '225 buaj', '200 buah', '250 buah', '175 buah'),
(353, 12, 'Usia ayah Nina adalah 4 dasawarsa lebih 2 windu. Usia ayah Nina adalah ....', 'enura.png', 0, '56 tahun', '54 tahun', '52 tahun', '50 tahun'),
(354, 12, '24', '134832_354_24.PNG', 1, '5.775', '5.575', '7.755', '7.775'),
(355, 12, '.25', '134925_355_25.PNG', 1, '611', '520', '429', '385'),
(356, 12, '26', '134957_356_26.PNG', 1, '4', '2', '3', '5'),
(357, 12, '27', '135057_357_27.PNG', 1, 'A', 'B', 'C', 'D'),
(358, 12, '28', '135226_358_28.PNG', 1, 'A', 'B', 'C', 'D'),
(359, 12, 'Luas daerah yang diarsir pada gambar berikut adalah .....', '135314_359_29.PNG', 1, '72 m kuadrat', '96 m kuadrat', '48 m kuadrat', '24 m kuadrat'),
(360, 12, 'Pada persegi panjang dibentuk segitiga seperti pada gambar berikut. Luas daerah yang tidak diarsir adalah ....', '135357_360_30.PNG', 1, '140 cm kuadrat', '160 cm kuadrat', '120 cm kuadrat', '80 cm kuadrat'),
(361, 13, 'The suitable title for the text above is …', '132047_361_1 dan 4.PNG', 1, 'Tangkuban Perahu', 'A Cool Place', 'A Natural View', 'A High Place'),
(362, 13, 'What time did Mira and her family go to Tangkuban Perahu?', '132124_362_1 dan 4.PNG', 1, 'At a half past nine in the morning', 'At a half past eight in the morning', 'At a half to nine in the afternoon', 'At a half to ten in the morning'),
(363, 13, 'Why is Tangkuba Perahu called a cold place?', '132154_363_1 dan 4.PNG', 1, 'Because it is located in a high place', 'Because it has snow', 'Because it is located in a low place', 'Because it has natural view'),
(364, 13, 'People can do some activities in Tangkuban Perahu, except …', '132221_364_1 dan 4.PNG', 1, 'People can ride an elephant', 'People can enjoy the cool weather', 'People can buy beautiful souvenirs', 'People can see beautiful view'),
(365, 13, '5', '132248_365_5.PNG', 1, 'Post Office', 'Supermarket', 'Livrary', 'Bank'),
(366, 13, '6', '132320_366_6.PNG', 1, 'Bakery', 'Post Office', 'Fruit Stall', 'Bookstore'),
(367, 13, 'The text tells us about …', '132352_367_7 dan 9.PNG', 1, 'Season', 'Weather', 'Rainy Season', 'Dry Season'),
(368, 13, 'The outdoor activity you can do in dry season is …', '132428_368_7 dan 9.PNG', 1, 'Playing basketball', 'watching movie', 'playing computer game', 'cooking foods'),
(369, 13, 'The outdoor activity you cannot do in rainy season is ...', '132512_369_7 dan 9.PNG', 1, 'Playing football', 'cooking foods', 'collecting stamps', 'playing computer game'),
(370, 13, '10', '132535_370_10.PNG', 1, 'Ship', 'Plane', 'Car', 'Train'),
(371, 13, '11', '132602_371_11.PNG', 1, 'Airport', 'Harbour', 'Train statioin', 'Bus stop'),
(372, 13, 'If  today is Thursday, tomorrow is …', 'enura.png', 0, 'Friday', 'Saturday', 'Monday', 'Sunday'),
(373, 13, 'If  today is Wednesday, yesterday was …', 'enura.png', 0, 'Tuesday', 'Monday', 'Thursday', 'Friday'),
(374, 13, '14', '132648_374_14.PNG', 1, 'Fifteen past five', 'Fifteen to five', 'Five to fifteen', 'Five past fifteen'),
(375, 13, 'I am so .... I want to eat', 'enura.png', 0, 'hungry', 'angry', 'sleepy', 'sad'),
(376, 13, 'Mr. Jamil works all day long in the rice field. He feels ....', 'enura.png', 0, 'tired', 'sad', 'happy', 'excited'),
(377, 13, 'Andy\'s bike is lost. He feels ....', 'enura.png', 0, 'sad', 'happy', 'excited', 'glad'),
(378, 13, 'A person who is travelling for a pleasure is a ....', 'enura.png', 0, 'tourist', 'driver', 'visitor', 'guest'),
(379, 13, 'People can do fishing in the ....', 'enura.png', 0, 'river', 'cave', 'hill', 'field'),
(380, 13, 'The room is too dark. We say ....', 'enura.png', 0, 'turn on the lamp, please !', 'keep the lamp, please !', 'turn off the lamp, please !', 'switch off the lamp, please !'),
(381, 13, 'switch off the lamp, please !', 'enura.png', 0, 'Keep silent!', 'Keep noisy !', 'Don\'t be lazy !', 'Speak up !'),
(382, 13, 'Don\'t .... here! The floor is dirty.', 'enura.png', 0, 'sleep', 'clean', 'write', 'sweep'),
(383, 13, '.... ! The rainbow is so beautiful.', 'enura.png', 0, 'look', 'listen', 'speak', 'seem'),
(384, 13, 'Mrs. Nadia works at the hospital. She helps the doctor. She is a ....', 'enura.png', 0, 'nurse', 'herbalist', 'dentist', 'surgeon'),
(385, 13, 'A man who sends some letters is called ….', 'enura.png', 0, 'postman', 'postcard', 'teller', 'deskman'),
(386, 13, 'A woman who gives the information and serve as long in plane is called…', 'enura.png', 0, 'stewardess', 'steward', 'pilot', 'passenger'),
(387, 13, 'My mother wants to buy meats, rice, and carrots. She goes to …..', 'enura.png', 0, 'market', 'hospital', 'laboratory', 'school'),
(388, 13, '28', '132731_388_28.PNG', 1, 'Good morning', 'Good bye', 'Good afternoon', 'See you later'),
(389, 13, '29', '132808_389_29.PNG', 1, 'See you later', 'Good afternoon', 'Good morning', 'Good evening'),
(390, 13, 'The month before September is .....', 'enura.png', 0, 'Augusst', 'October', 'November', 'July'),
(391, 14, 'Tumbuhan bakau hidup di daerah pantai. Manfaat utama bagi lingkungan adalah….', 'enura.png', 0, 'mencegah terjadinya abrasi pantai', 'menggemburkan tanah pantai', 'tempat hidup hewan laut', 'mencegah terjadinya gelombang tsunami'),
(392, 14, 'Tumbuhan sangat dibutuhkan oleh semua makhluk hidup karena….', 'enura.png', 0, 'Rel kereta api mengalami pemuaian karena panas sinar matahari', 'Fotosintesis menghasilkan oksigen untuk bernapas', 'Makanan pokok manusia dihasilkan oleh tumbuhan', 'Hewan ternak memperoleh makanan dari tumbuhan'),
(393, 14, 'Taman Nsional Ujung Kulon beberapa waktu lalu terkena dampak tsunami selat sunda. Pemerintah dan masyarakat bersama-sama memulihkan kondisi alam taman nasional tersebut. Hal ini bertujuan ….', 'enura.png', 0, 'Menjaga badak bercula satu tidak punah', 'Memelihara habitat burung cendrawasih', 'Menjadikan komodo sebagai objek wisata nusantara', 'Melestarikan habitat gajah agar dapat berkembangbiak'),
(394, 14, 'Pengelompokkan hewan seperti pada daftar tersebut, didasarkan ….', '135652_394_4.PNG', 1, 'Cara berkembang biak', 'Jenis makanannya', 'cara beradaptasi', 'tempat hidup'),
(395, 14, 'Tanaman kaktus hidup di tempat kering. Kaktus memiliki daun yang kecil dan berduri serta batangnya tebal berair dan berlapis lilin. Batang pada kaktus berfungsi untuk ….', 'enura.png', 0, 'Mengurangi penguapan air', 'Menyimpan cadangan air', 'Mencari air', 'Membantu pernapasan'),
(396, 14, 'Mimikri merupakan salah satu jenis kemampuan hewan untuk mempertahankan diri dari ancaman pemangsanya. Salah satu hewan yang mempertahankan dirinya dengan cara mimikri adalah ….', 'enura.png', 0, 'Bunglon', 'Unta', 'Cecak', 'Kelelawar'),
(397, 14, 'Urutan cara penyesuaian diri bebek dan burung pelikan secara berturut-turut adalah ….', 'enura.png', 0, 'Berparuh ceper dan berlamela; Berparuh panjang dan membentuk kantong', 'Berparuh kecil, runcing, dan panjang; Bentuk paruh panjang, kecil, dan runcing', 'Bentuk paruh membentuk kantong; berparuh ceper dan berlamela', 'Bentuk paruh tebal, kecil, dan runcing; berparuh melengkung, tajam, dan kuat'),
(398, 14, 'Ciri adaptasi bentuk paruh yang dimiliki burung pemakan daging yang tepat adalah ….', '135917_398_8.PNG', 1, '2, 3, dan 5', '2, 3, dan 4', '1, 2, dan 5', '1, 2, dan 3'),
(399, 14, 'Fungsi rangka yang ditunjukkan oleh nomor 3 adalah….', '135950_399_9.PNG', 1, 'Melindungi sumsum tulang belakang', 'Melindungi organ pencernaan', 'Melindungi paru paru', 'Tempat melekatnya otot tangan dan kaki'),
(400, 14, 'Alat pernapasan yang digunakan oleh Lipan adalah ….', 'enura.png', 0, 'Trakea', 'Paru paru buku', 'Kulit basah', 'Stigma'),
(401, 14, 'Pada mulut terdapat enzim ptialin yang berfungsi ….', 'enura.png', 0, 'Mengubah zat tepung menjadi gula', 'Mengubah zat tepung menjadi protein', 'Mengubah protein menjadi lemak', 'Mengubah protein menjadi pepsin'),
(402, 14, 'Proses yang terjadi pada alat pernapasan yang bernama alveolus adalah….', 'enura.png', 0, 'Penyerapan 02 dan pelepasan CO2', 'Penyaringan udara dari debu dan kotoran', 'Penyesuaian suhu udara dengan tubuh', 'Pelembaban untuk mengendapkan debu'),
(403, 14, 'Urutan peredaran darah bersih ditunjukkan oleh nomor ….', '140151_403_13.PNG', 1, '5, 2, 4, 7, 9', '9, 8, 1, 3, 5', '4, 7, 9, 8, 1', '1, 3, 5, 2, 4'),
(404, 14, 'Berikut yang merupakan contoh simbiosis mutualisme adalah.…', 'enura.png', 0, 'Lebah yang hinggap pada bunga', 'Ikan remora dengan ikan laut', 'Tanaman benalu dengan pohon yang ditumpanginya', 'Tanaman anggrek yang hidup di pohon mangga'),
(405, 14, 'Pemerintah membuat undang-undang perlindungan terhadap hewan tertentu yang hampir punah, tujuannya adalah….', 'enura.png', 0, 'Menjaga keseimbangan ekosistem', 'Agar hewan lain tidak ikut punah', 'Menarik wisatawan mancanegara', 'Luka dalam'),
(406, 14, 'Eksploitasi yang berlebihan terhadap sumber daya alam salah satunya penebangan pohon secara liar memiliki dampak negatif bagi kehidupan, yaitu ….', 'enura.png', 0, 'Mengurangi resapan air', 'Meningkatkan mata pencaharian', 'Tanah menjadi subur', 'Menjaga keseimbangan ekosistem'),
(407, 14, 'Manusia terus berupaya meningkatkan hasil panen tanaman diantaranya dengan cara pemberian pupuk kimia. Namun, penggunaan pupuk kimia dalam jangka waktu panjang justru dapat mengganggu ekosistem, karena….', 'enura.png', 0, 'Mematikan organisme pengurai dalam tanah', 'Tanaman menjadi bertambah banyak terus', 'Dapat merusak hasil panen tanaman', 'Berkurangnya penggunaan pupuk alami'),
(408, 14, 'Bioteknologi berupa jamur aspergilus wentii digunakan dalam pembuatan ….', 'enura.png', 0, 'kecap', 'tape', 'sirup', 'tempe'),
(409, 14, 'Warga yang tinggal di daerah tepi sungai sering kali membuang sampah padat ke sungai. Salah satu dampak terhadap siklus air dari kegiatan tersebut adalah ….', 'enura.png', 0, 'Terhambatnya evaporasi dari air sungai', 'Bertambahnya volume air sungai', 'Pengurangan laju penyerapan air ke tanah', 'Peningkatan laju transpirasi tumbuhan di pinggir sungai'),
(410, 14, 'Blender dan kipas merupakan alat-alat yang mengalami perubahan energi ….', 'enura.png', 0, 'Energi listrik menjadi energi gerak', 'Energi listrik menjadi energi cahaya', 'Energi gerak menjadi energi listrik', 'Energi kimia menjadi energi panas'),
(411, 14, 'Ketika seorang pengemudi menginjak rem, laju kendaraan menjadi lebih lambat. Hal ini dikarenakan gaya dapat mengubah….', 'enura.png', 0, 'Kecepatan benda', 'Bentuk benda', 'Keadaan benda', 'Arah gerak benda'),
(412, 14, 'Kegiatan yang menunjukkan bahwa gaya dapat mengubah arah gerak benda adalah….', 'enura.png', 0, 'Melontarkan anak panah dengan busur', 'Mengegas untuk mempercepat laju mobil', 'Memehat kayu menjadi patung', 'Membuat asbak dari tanah liat'),
(413, 14, 'Ketika seseorang mendorong mobil, jenis gaya yang berperan adalah ….', 'enura.png', 0, 'Gaya gesek dan gaya otot', 'Gaya otot dan gaya pegas', 'Gaya pegas dan gaya magnet', 'Gaya magnet dan gaya otot'),
(414, 14, 'Perpindahan panas secara konveksi terjadi dalam peristiwa ….', 'enura.png', 0, 'Terjadinya angin darat dan angin laut', 'Memasak dengan wajan alumunium', 'Panas api unggun terasa di badan', 'Sendok ikut panas saat mengaduk teh panas'),
(415, 14, 'Sifat benda yang dimiliki sirup dan minyak adalah ….', 'enura.png', 0, 'Mengisi seluruh ruangan', 'Menekan ke segala arah', 'Volume berubah', 'Bentuk tetap'),
(416, 14, 'Peristiwa berikut yang menunjukkan proses penguapan adalah ….', 'enura.png', 0, 'Air yang dimasak terus menerus lama-lama akan habis', 'Titik air di daun pada pagi hari', 'Kapur barus yang berada pada udara terbuka', 'Mentega yang mencair akibat kenaikan suhu'),
(417, 14, 'Sifat-sifat benda di atas adalah sifat dari benda ….', '140744_417_27.PNG', 1, 'Kayu', 'Besi', 'Karet', 'Alumunium'),
(418, 14, 'Wati menaruh kapur barus di dalam lemari untuk mengusir kecoa. Setelah satu minggu kapur barus menghilang. Peristiwa ini disebut ….', 'enura.png', 0, 'menyublim', 'mengembun', 'menguap', 'mencair'),
(419, 14, 'Kompas sebagai penunjuk arah merupakan alat yang menggunakan gaya. Gaya yang bekerja pada kompas adalah ….', 'enura.png', 0, 'gaya magnet', 'gaya gesek', 'gaya otot', 'gaya pegas'),
(420, 14, 'Cara membuat magnet pada gambar adalah dengan cara ….', '140904_420_30.PNG', 1, 'induksi', 'gosok', 'aliran listrik', 'elektromagnetik'),
(421, 15, 'Dalam suatu permainan, regu yang menang akan diberi nilai 3. Jika kalah diberi nilai -2 dan jika seri diberi nilai -1. Suatu regu telah bermain selama 50 kali diantaranya 35 kali menang dan 5 kali kalah. Maka nilai yang diperoleh regu itu adalah …', 'enura.png', 0, '85', '100', '90', '95'),
(422, 15, 'Berapa petak sayur sawi keseluruhan yang dipanen?', '092929_422_2.PNG', 1, '30', '40', '50', '60'),
(423, 15, 'Nilai maksimum dari n adalah …', '093021_423_3.PNG', 1, '6.516', '6.666', '6.513', '6.767'),
(424, 15, '2, 3, 4, 9, … , 81, … , 6561. Bilangan yang tepat untuk melengkapi pola tersebut adalah …', 'enura.png', 0, '16 dan 256', '90 dan 100', '17 dan 289', '15 dan 225'),
(425, 15, 'Suku ketiga dan kelima suaru barisan geometri adalah 25 dan 400. Diketahui rasio dari baris tersebut adalah positif maka hitunglah rasio dari baris tersebut …', 'enura.png', 0, '4', '5', '10', '12'),
(426, 15, 'Hitunglah suku ke 8 jika diketahui suku ketiga dan kelima barisan geometri adalah 20 dan 100 serta rasio baris tersebut adalah 2 …', 'enura.png', 0, '640', '880', '550', '990'),
(427, 15, 'Hitunglah jumlah 8 suku pertamanya jika diketahui suku ketiga dan kelima barisan geometri adalah 20 dan 100 serta rasio baris tersebut adalah 2 dan suku pertama baris tersebut adalah 5  …', 'enura.png', 0, '1275', '2020', '1890', '1445'),
(428, 15, 'Seorang kontraktor bangunan berencana membangun ruko dengan menggunakan tiang – tiang beton. Satu ruko memerlukan 14 tiang beton, 2 ruko memerlukan 18 tiang beton, 3 ruko memerlukan 24 tiang beton dan 4 ruko memerlukan 32 tiang beton. Jika kontraktor ingin membuat 5 ruko, maka hitunglah jumlah tiang beton untuk membuat ruko yang ke 5 …', 'enura.png', 0, '42', '45', '24', '41'),
(429, 15, 'Seorang guru menerima gaji pada bulan pertama sebesar Rp 4.000.000,00 tiap bulannya gaji tersebut naik sebesar Rp 50.000, maka berapakah gaji guru pada bulan ke 4 …', 'enura.png', 0, '4.150.000', '4.000.000', '4.350.000', '5.000.000'),
(430, 15, 'Diketahui A : B = 10 : 30 dan nilai B = 81. Nilai 3(A + 2B) adalah …', 'enura.png', 0, '567', '456', '123', '890'),
(431, 15, 'Jika R : S = 5 : 7 dan selisih R dan S adalah 14, maka nilai R × S adalah …', 'enura.png', 0, '1.715', '2.789', '3.453', '4.599'),
(432, 15, 'Untuk menyelesaikan suatu pekerjaan dalam 30 hari memerlukan 12 pekerja. Jika pekerja harus diselesaikan dalam 24 hari, diperlukan tambahan pekerja sebanyak …', 'enura.png', 0, '3 orang', '4 orang', '5 orang', '6 orang'),
(433, 15, 'Pada hari minggu jumlah uang Tora dan Ani berbanding 3:1. Pada hari senin Tora memberi uang sejumlah 50.000 rupiah pada Ani. Sekarang perbandingan jumlah uang Tora dan Ani menjadi 1:2. Jumlah uang Tora dan Ani pada hari minggu ialah …', 'enura.png', 0, '120.000', '130.000', '140.000', '150.000'),
(434, 15, 'Kolam ikan pak yanuar berbentuk persegi. Pada denah berskala 1 : 900, kolam tersebut digambarkan luasnya 4 cm2. Keliling sebenarnya kolam pak yanuar adalah …', 'enura.png', 0, '72 cm', '75 cm', '70 cm', '76 cm'),
(435, 15, 'Seseorang pekerja mendapatkan bonus sekali dalam tiga bulan sebesar 10% dari gajinya. Jika gaji pekerja Rp. 200.000/bulan, bonus yang diterima selama 2 tahun adalah …', 'enura.png', 0, 'Rp 160.000', 'Rp 220.000', 'Rp 100.000', 'Rp 200.000'),
(436, 15, 'Tika mempunyai uang di bank dengan bunga 16% per tahun. Ternyata setelah 6 bulan bunga yang diperoleh menjadi Rp 72.000. Jumlah uang tika setelah 10 bulan adalah …', 'enura.png', 0, '1.020.000', '1.220.000', '1.200.000', '1.320.000'),
(437, 15, 'Pak Alan meminjam uang dikoperasi sebesar Rp. 2.000.000,00 dengan bunga 2% perbulan. Jika lama meminjam 5 bulan, besar angsuran yang harus dibayar setiap bulan adalah …', 'enura.png', 0, '440.000', '230.000', '450.000', '500.000'),
(438, 15, 'Diketahui xy = 42, yz = 63 dan xz = 54.', '093804_438_18.PNG', 1, '166', '144', '120', '180'),
(439, 15, 'Amir memiliki kelereng sebanyak a. Budi memiliki kelereng 10 buah lebih sedikit dari kelereng Amir. Jika jumlah kelereng mereka adalah 30, pernyataan berikut yang benar adalah …', 'enura.png', 0, '2a = 40', '2a + 10 = 30', 'a – 10 = 30', 'a + 10 = 30'),
(440, 15, 'Semua siswa kelas VII berusia paling tua 18 tahun. Jika u menyatakan usia siswa kelas VII, model matematika yang tepat adalah …', '093954_440_20.PNG', 1, 'c', 'a', 'b', 'd'),
(441, 15, 'Pada tahun 2016, umur seorang ibu 3 kali umur anaknya. Pada tahun 2010, umur ibu lima kali umur anaknya. Jumlah umur mereka pada tahun 2021 adalah …', 'enura.png', 0, '58 tahun', '50 tahun', '60 tahun', '45 tahun'),
(442, 15, 'Taman bunga berbentuk persegi panjang dengan ukuran panjang (8x + 2) meter dan ukuran lebarnya (6x – 16) meter. Jika keliling taman tidak kurang dari 140 meter, maka panjang tanaman tersebut adalah…', '094114_442_22.PNG', 1, 'b', 'a', 'c', 'd'),
(443, 15, 'Dari 42 siswa kelas 1A, 24 siswa mengikuti ekstrakurikuler pramuka, 17 siswa PMR dan 8 siswa tidak mengikuti kedua – duanya. Banyaknya siswa yang mengikuti kedua ekstrakulikuler adalah …', 'enura.png', 0, '7 orang', '6 orang', '9 orang', '16 orang'),
(444, 15, 'Pada acara kerja bakti kebersihan kelas dan lingkungan, sebanyak 18 siswa membawa sapu, 24 siswa membawa kain lap dan 5 siswa membawa peralatan lain. Jika banyak siswa dalam kelas tersebut 34 anak, banyak siswa yang membawa sapu dan kain lap adalah …', 'enura.png', 0, '13', '17', '3', '5'),
(445, 15, 'Disediakan kawat sepanjang 10 m untuk membuat model kerangka balok dengan panjang 20 cm, lebar 17 cm dan tinggi 13 cm. Banyak model kerangka balok yang dihasilkan adalah …', 'enura.png', 0, '5 buah', '4 buah', '3 buah', '6 buah'),
(446, 15, 'Sebuah lantai berbentuk persegi dengan panjang sisinya 6 m. Lantai tersebut akan dipasang ubin berbentuk persegi berukuran 30 cm × 30 cm. Tentukan banyaknya ubin yang diperlukan untuk menutupi lantai …', 'enura.png', 0, '400 buah', '500 buah', '600 buah', '700 buah'),
(447, 15, 'Diketahui titik A(4,10), B(-1,p) dan C(2,2) terletak pada sat ugaris lurus. Maka nilai p adalah …', 'enura.png', 0, '– 10', '-5', '5', '10'),
(448, 15, 'Luas layang – layang ABCD adalah …', '094712_448_28.PNG', 1, '252 cm kuadrat', '240 cm kuadrat', '260 cm kuadrat', '273 cm kuadrat'),
(449, 15, 'Sisi persegi ABCD sejajar dengan sumbu – sumbu koordinat. Titik A(1,-2) dan C(5,1) adalah titik sudut yang saling berhadapan. Persamaan garis yang melalui titik B dan D adalah …', 'enura.png', 0, '3x + 4y – 7 = 0', '3x + 4y + 7 = 0', '3x – 4y + 7 = 0', '4x – 3y + 7 = 0'),
(450, 15, 'Misalkan m menyatakan bilangan bulat positif serta garis 13x + 11y = 700 dan y = mx -1 berpotongan di titik yang koordinatnya bilangan bulat. Banyak kemungkinan nilai m adalah …', 'enura.png', 0, '1', '0', '2', '3'),
(451, 16, 'What is the purpose of the greeting card?', '033348_451_1 dan 2.jpg', 1, 'To praise Hilda on her success', 'To show Hilda’s talent', 'To tell the prie that Hilda got', 'To show Hilda’s parents’ achievement'),
(452, 16, 'The word “proves” is closest meaning to?', '033454_452_1 dan 2.jpg', 1, 'Confirms', 'Confronts', 'Conducts', 'Contains'),
(453, 16, 'From the text we know that the writer wants to .....', '033557_453_3 dan 4.jpg', 1, 'persuade the readers to register', 'inform about the availability of the seats register', 'call the contact person', 'join the admission test');
INSERT INTO `soal` (`id`, `id_bidang`, `soal`, `foto`, `status_foto`, `jawaban1`, `jawaban2`, `jawaban3`, `jawaban4`) VALUES
(454, 16, 'Based on the advertisement above, it is true that .....', '033630_454_3 dan 4.jpg', 1, 'The admission test was held on May 20, 2017', 'There are abundant seats for the new students', 'The advertisement is about graduation', 'The admittee should come to Bekasi'),
(455, 16, 'What should the students do to participate in the program?', '090108_455_5 dan 6.PNG', 1, 'Contact the program coordinator', 'Watch some good English contest', 'Support only interesting programs', 'Come to school before 07.30 a.m.'),
(456, 16, 'The (objective) of the programs is to develop students’ skill’. inside brackets word is closest meaning to .....', '090337_456_5 dan 6.PNG', 1, 'goal', 'step', 'tool', 'material'),
(457, 16, 'What does the notice mean ?', '090433_457_7 dan 8.PNG', 1, 'Students are prohibited to do any form of cheating', 'Students are permitted to do any form of cheating', 'Students are encouraged to do any form of cheating', 'Students are asked to cheat during test'),
(458, 16, 'What will happen if a student cheats during the test ?', '090521_458_7 dan 8.PNG', 1, 'She/ he will no longer be eligible to continue the test', 'She/ he will be caught be the teacher', 'She/ he will be taken rigt away', 'She/ he is not tolerated'),
(459, 16, 'The purpose of the label is to .....', '090623_459_9 dan 10.PNG', 1, 'give detailed information of the product of nutrition', 'give detailed information about the date', 'inform the readers how to store the product', 'inform the customers of how to make the product'),
(460, 16, 'What does the element of the nutrion contain?', '090701_460_9 dan 10.PNG', 1, 'Sodium', 'Toxic', 'Oxygen', 'Calory'),
(461, 16, 'What is the topic of paragraph 2?', '090806_461_11 dan 12.PNG', 1, 'The physical appearance of Marina’s jersey', 'Marina’s jersey’s difference to others', 'Marina’s feeling toward the jersey', 'The great autograph on the jersey'),
(462, 16, 'How is the jersey look like?', '090846_462_11 dan 12.PNG', 1, 'It’s an ordinary jersey but with the signature on the back', 'It’s a medium yellow jersey with a picture in the chest', 'It’s a yellow jersey with a black stripes on its shoulder', 'It’s a medium yellow stripes jersey with the picture'),
(463, 16, '... her luck of attending a conference after the basketball match, Marina got a CLS Knight’s jersey', '090929_463_11 dan 12.PNG', 1, 'Due to', 'Because', 'Moreover', 'Although'),
(464, 16, 'What is the topic of the text?', '091028_464_14 dan 16.PNG', 1, 'A disobedient son', 'A poor woman', 'A generous woman', 'A wealthy merchant'),
(465, 16, 'We know from the text that Malin Kundang is ...', '091309_465_14 dan 16.PNG', 1, 'arrogant and disobedient', 'disobedient and generous', 'obedient and cruel', 'cruel and generous'),
(466, 16, '“In return the merchant asked him to sail with him.” (paragraph 2) The word him refers to ....', '091359_466_14 dan 16.PNG', 1, 'The merchant', 'The villager', 'Malin Kundang', 'The ship crew'),
(467, 16, 'What did the writer do to know the result of the exam?', '091502_467_17 dan 18.PNG', 1, 'Asked her friend to inform her by phone', 'Checked it at the location at the exam', 'Waited for the school inform her by phone', 'Asked her mother to check by phone'),
(468, 16, 'How did the writer probably feel before the announcement?', '091534_468_17 dan 18.PNG', 1, 'Anxious', 'Sad', 'Tired', 'Calm'),
(469, 16, 'What can you gain from the text ?', '091636_469_19 dan 21.PNG', 1, 'We can use electronic rice cooker correctly', 'We can remove the pesticides that may be present', 'We must buy electronic rice cooker soon', 'We need to see the water'),
(470, 16, 'What must we do after rinse the rice?', '091704_470_19 dan 21.PNG', 1, 'Add some water into the cooking pot', 'Measure the rice by using the measurement cup', 'Put the rice into the cooking pot', 'Wait until the cooking process is over'),
(471, 16, 'We need water a centimeter ... the rice when want to cook rice using electrinic magic com.', '091738_471_19 dan 21.PNG', 1, 'Over', 'Under', 'Into', 'Along'),
(472, 16, '.....', '091837_472_22 dan 26.PNG', 1, 'was', 'is', 'were', 'are'),
(473, 16, '.....', '092050_473_22 dan 26.PNG', 1, 'felt', 'feel', 'feels', 'fell'),
(474, 16, '.....', '092121_474_22 dan 26.PNG', 1, 'got', 'get', 'gets', 'gotten'),
(475, 16, '.....', '092147_475_22 dan 26.PNG', 1, 'tried', 'try', 'tries', 'trying'),
(476, 16, '.....', '092216_476_22 dan 26.PNG', 1, 'came', 'common', 'come', 'comes'),
(477, 16, 'What is the best arrangement of the words to make a good sentence?', '092303_477_27.PNG', 1, '2 – 4 – 5 – 6 – 1 – 3', '3– 5 – 1 – 2 – 6 – 4', '2-1-  4 -  6 – 3 – 5', '3 – 6 – 4 – 1 – 5 – 2'),
(478, 16, 'The best arrangement is …', '092501_478_29.PNG', 1, '1-3-2-6-4-7-5', '1-4-6-3-7-5-2', '1-2-4-7-6-3-5', '1-6-5-3-2-4-7'),
(479, 16, 'What will the committee do on the meeting ?', '092558_479_29 asli.PNG', 1, 'To report the financial', 'To discuss the financial', 'To prepare the meeting', 'To guide the meeting'),
(480, 16, 'What does the text tell us about?', '092708_480_30.PNG', 1, 'Gorillas', 'Gorillas habitat', 'Gorillas habits', 'Gorillas enemies'),
(481, 17, 'Model atom yang diusulkan memiliki kelemahan bahwa model atom ini tidak dapat menjelaskan di mana elektron berada dan bagaimana mereka pindah ke nukleus model atom dengan kelemahan yang diusulkan oleh.', 'enura.png', 0, 'Rutherford', 'Dalton', 'J Thomson', 'Bohr'),
(482, 17, 'Partikel yang bergerak dapat disebut sebagai.', 'enura.png', 0, 'Elektron', 'Proton dan elektron', 'Proton', 'Neutron'),
(483, 17, '+3 partikel C dan x mengalami gaya Coulomb 4-27 kedua beban terpisah 2 m maka Jika interaksi antara kedua muatan adalah daya tarik, maka nilai dan jenis muatan adalah x.', 'enura.png', 0, '4 C dan negatif', '2 C dan negatif', '2 C dan positif', '4 C dan positif'),
(484, 17, 'Tiga hambatan listrik dipasang berdampingan. Pernyataan persis tentang sifat-sifat rangkaian adalah.', 'enura.png', 0, 'Arus yang mengalir di perpindahan hitam itu sama', 'Arus listrik yang mengalir pada tiga hambatan tidak dapat ditentukan karena mereka tidak diberi tahu nilai hambatan listrik', 'Tegangan yang mengalir pada setiap rintangan adalah sama', 'Resistansi total dari tiga rintangan kurang dari nilai masing-masing hambatan'),
(485, 17, 'Sifat-sifat sel dalam fase interfase yang benar adalah.', 'enura.png', 0, 'Membran inti masih terlihat', 'Pembentukan materi genetik dalam bentuk kromosom', 'Nukleus dan nukleolus tidak terlihat', 'Penurunan materi genetik dalam bentuk DNA'),
(486, 17, 'Hormon yang bekerja pada spermatognesis dan memicu tanda genital sekunder seperti pertumbuhan jakun.', 'enura.png', 0, 'Testosteron', 'Progesteron', 'Estrogen', 'Prolaktin'),
(487, 17, 'Hormon yang terlibat dalam proses menstruasi dan fungsinya yang tepat adalah.', 'enura.png', 0, 'Hormon luteinizing (LH) memicu proses ovulasi', 'Estrogen memicu pembentukan folikel', 'Follicular stimulation hormone (FSH), penebalan dinding endometrium', 'Progesteron memicu perkembangan sekunder pada wanita'),
(488, 17, 'Berikut ini TIDAK termasuk sebagai bantuan eliminasi pada manusia.', 'enura.png', 0, 'Paru-paru', 'Hati', 'Otak', 'Ginjal'),
(489, 17, 'Bagian kulit manusia dibagi menjadi 3 bagian, dengan pengecualian.', 'enura.png', 0, 'Kulit Ginjal (korteks)', 'Kulit Ari', 'Jangat (kulit)', 'Jaringan ikat secara subkutan'),
(490, 17, 'Contoh alat reproduksi pada pria adalah.', 'enura.png', 0, 'Indung Telur', 'Rahim', 'Epididimis', 'Pembunuhan wanita'),
(491, 17, 'Proses pembentukan telur disebut.', 'enura.png', 0, 'Spermatogenesis', 'Haid', 'Indung Telur', 'Oogenesis'),
(492, 17, 'Contoh binatang yang mengandung fosil hidup itu.', 'enura.png', 0, 'Dinosaurus, kecoak', 'Komodo, kadal', 'Kadal, kadal', 'Orangutan, badak Jawa'),
(493, 17, 'Jika objek A bermuatan positif dan objek B bermuatan negatif, apa yang terjadi ketika kedua objek tersebut didekatkan.', 'enura.png', 0, 'Barang rusak', 'Sampah', 'Daya tarik', 'Putus'),
(494, 17, 'Yang juga merupakan pendeteksi muatan listrik.', 'enura.png', 0, 'Barometer', 'Meter', 'Electroscope', 'Stetoskop'),
(495, 17, 'Formula berikut ini adalah energi listrik yang benar, bukan.', 'enura.png', 0, 'W = P x t', 'P = V x I', 'W = V x I x R', 'P = F / A'),
(496, 17, 'Contoh Energi listrik diubah menjadi energi. Gerakan itu.', 'enura.png', 0, 'Kipas Angin', 'Lampu-lampu itu', 'Kipas Angin', 'Kipas Angin'),
(497, 17, 'Berdasarkan nama tulang di atas dan dapat dikelompokan pada jumlah.', 'enura.png', 0, '1, 2 dan 3', '1, 3 dan 4', '2, 5 dan 6', '4, 5 dan 6'),
(498, 17, 'Ani mengamati jaringan otot dengan mikroskop. Hasil pengamatannya adalah sel silindris panjang, ada bagian yang terlihat terang dan gelap, sehingga sel otot tampak melintang, memiliki banyak nuklei. Sel-sel otot diamati dari jaringan.', 'enura.png', 0, 'Pronator, bisep dan trisep', 'Perut, usus dan dubur', 'Hati, ginjal dan jantung', 'Arteri, vena, dan aorta'),
(499, 17, 'Rkia menanam dua kacang hijau dari jenis yang sama dalam dua pot berbeda. Dia menaruh Pot A di tempat yang terkena sinar matahari. Selama Pot B, ia menempatkannya di tempat yang tidak terkena sinar matahari. Dia menyirami setiap pot dengan jumlah air yang sama dan frekuensi irigasi yang sama. Pada hari kelima ia mengukur panjang batang pot B 12 cm, sedangkan panjang pot A adalah 4 cm, ini karena.', 'enura.png', 0, 'Sel punca yang terpapar cahaya tumbuh lebih cepat daripada sel punca yang tidak terpapar cahaya karena hormon auksin di batang matahari berfungsi optimal', 'Sel punca yang terpapar cahaya tumbuh lebih lambat daripada sel punca yang terpapar cahaya, karena hormon auksin bekerja optimal saat terpapar cahaya.', 'Sel punca yang tidak terpapar pertumbuhan tumbuh lebih cepat daripada sel punca yang terpapar cahaya karena hormon auksin dalam balok yang tidak terpapar paparan tidak berfungsi secara optimal', 'Sel punca yang tidak terpapar cahaya tumbuh lebih lambat dari sel punca yang tidak terpapar cahaya karena hormon auksin pada batang tidak berfungsi optimal'),
(500, 17, 'Alasan berikut ini tidak termasuk mengapa burung dapat terbang di udara.', 'enura.png', 0, 'Memiliki sayap pendek', 'Memiliki lapisan air berbentuk sayap', 'Memiliki tubuh yang ringan dan kuat', 'Kekuatan ke atas dan ke bawah dan stabil di udara'),
(501, 17, 'Bumi mengelilingi matahari dengan kecepatan 100.000 km / jam. Anda sedang duduk di kursi. Jika titik rujukannya adalah kursi yang Anda duduki, diasumsikan bahwa Anda berada dalam keadaan __ (1). Jika titik rujukan adalah matahari, diasumsikan bahwa Anda berada di negara Serbia (2).', 'enura.png', 0, '(1) diam sementara (2) bergerak', '(1) tidak bergerak, sedangkan (2) diam', '(1) melayang ketika (2) bergerak', '(1) diam, sementara (2) diam'),
(502, 17, 'Tuas dan contoh yang benar adalah.', 'enura.png', 0, 'Tuas kelas dua: pembuka botol', 'Tuas kelas satu: pemotong kertas', 'Tuas kelas dua: tang', 'Tuas kelompok ketiga: jungkat-jungkit'),
(503, 17, 'Perhatikan informasi berikut.', '032715_503_23.PNG', 1, 'Kulit ari', 'Parenchyma', 'Floem', 'Kolenkim'),
(504, 17, 'Berikut ini, bagian-bagian dari akar yang melintasi air tanah berturut-turut adalah.', 'enura.png', 0, 'Epidermis akar rambut/ parenkim /endodermis /akar xilem', 'Epidermis rambut akar / endodermis /parenkim /akar xilem', 'Epidermis rambut akar /kambium /parenkim /akar xilem', 'Kulit luar / kambium /endodermis /akar xilem'),
(505, 17, 'Struktur daun digunakan sebagai tempat produksi makanan dan sebagai tempat pertukaran udara di.', 'enura.png', 0, 'Palisade dan jaringan stoma', 'Spons dan jaringan epidermis', 'Palisade dan Jaringan Xylem', 'Jaringan spons dan floem'),
(506, 17, 'Apa yang harus dilakukan seseorang yang sudah tergantung pada obat-obatan psikiatris adalah.', 'enura.png', 0, 'Pergi ke terapi di rumah sakit khusus yang tidak lagi menggunakan obat-obatan psikiatris.', 'Atasi dengan tidak menggunakan bahan apa pun, bahkan jika ada rasa sakit yang berlebihan.', 'Dengan bahan aktif identik lainnya, tetapi tidak berbahaya, sehingga rasa sakit yang hilang itu hilang.', 'Kurangi penggunaan dosis psikotropika sesuai keinginan.'),
(507, 17, 'Seragam untuk pekerja lapangan yang bekerja di bawah sinar matahari, banyak berkeringat dan bekerja siang dan malam sehingga pakaian yang terbuat dari bahan sangat dibutuhkan.', 'enura.png', 0, 'Kapas', 'Polyster', 'Serat wol', 'Serat nilon'),
(508, 17, 'Ban kendaraan yang digunakan di alam liar, di tanah berawa dan di jalan berliku membutuhkan kekuatan ban non-slip, tahan gores, dan tahan tekanan. Ban kendaraan ini sangat cocok jika.', 'enura.png', 0, 'Karet alam', 'Karet sintetis tipe NBR', 'Jenis karet sintetis', 'Karet sintetis tipe IIR'),
(509, 17, 'Pabrik pengembangbiakan domba menghasilkan pakaian hangat dari pakaian domba. Bahan-bahan ini.', 'enura.png', 0, 'Serat protein hewani', 'Serat protein nabati', 'Wol protein nabati', 'Kapas dari protein hewani'),
(510, 17, 'Berbagai industri tekstil di masyarakat pedesaan umumnya harus menggunakan 100% bahan baku serat alami untuk membuat kostum budaya yang biasa. Serat berasal dari.', 'enura.png', 0, 'Kapas, rambut, wol', 'Nilon, rambut, wol', 'Kapas, rambut, poliester', 'Kapas, rambut, nilon'),
(514, 18, 'Berdasarkan letak geografisnya Indonesia dilalui rangkaian Pegunungan Muda Sirkum Pasifik dan Sirkum Mediterania. Kondisi ini menyebabkan Indonesia memiliki banyak gunungapi yang rawan meletus. Dampak positif dari banyaknya gunungapi di Indonesia adalah ….', 'enura.png', 0, 'Tanah sekitar pegunungan semakin subur akibat pengendapan abu vulkanik gunungapi', 'Tanah disekitar pegunungan semakin subur akibat pengendapan lahar gunungapi', 'Sumber mata air di daerah pegunungan semakin banyak akibat aliran lahar dingin', 'Tumbuhan di daerah pegunungan semakin subur akibat tertutup abu vulkanik'),
(515, 18, 'Indonesia merupakan negara yang mampu mengambangkan aktivitas perdagangan internasional. Kondisi tersebut merupakan keuntungan wilayah Indonesia yang strategis dilihat dari letak ….', 'enura.png', 0, 'Geografis', 'Astronomis', 'Geologi', 'Maritime'),
(516, 18, 'Minyak bumi termasuk salah satu bentuk sumber daya alam tidak terbarukan. Akan tetapi, saat ini ketergantungan masyarakat akan hasil olahan minyak bumi masih tergolong tinggi. Upaya tepat untuk mengatasi kondisi tersebut adalah ….', 'enura.png', 0, 'Mencari sumber bahan bakar baru dan terbarukan', 'Membangun kilang minyak bumi baru di Indonesia', 'Memperbanyak ekspor minyak bumi dalam bentuk mentah', 'Memanfaatkan minyak bumi secara terus menerus untuk bahan bakar'),
(517, 18, 'Indonesia merupakan negara yang kaya akan sumber daya alam. Hampir setiap daerah memiliki sumber daya alam khas, misalnya barang tambang. Daerah yang menghasilkan batu bara di Indonesia adalah ….', 'enura.png', 0, 'Ombilin dan Pulau Buru', 'Bukit asam dan Pulau Tarakan', 'Cilacap dan Mahakam', 'Wonokromo dan Tembagapura'),
(518, 18, 'Perhatikan kenampakan berikut!', '155413_518_5.PNG', 1, '2), 4) dan 6)', '1), 2), dan 4)', '2), 3), dan 4)', '4), 5) dan 6)'),
(519, 18, 'Jarak Kota Surabaya dan Kota Malang pada peta berskala 1:100.000 sebesar 90 cm. jarak sebenarnya Kota Surabaya dan Kota Malang yaitu …..', 'enura.png', 0, '90 cm', '50 cm', '60 cm', '100 cm'),
(520, 18, 'Perhatikan ciri-ciri berikut!', '160402_520_7.PNG', 1, '1), 3), dan 4)', '1), 2), dan 3)', '2), 4), dan 5)', '3), 4), dan 5)'),
(521, 18, 'Perhatikan keterangan berikut!', '160605_521_8.PNG', 1, 'Maju karena memiliki pendapatan per kapita tinggi', 'Berkembang karena memiliki jumlah penduduk tinggi', 'Maju karena sektor perekonomian utamanya bergantung pada alam', 'Berkembang karena menggunakan peralatan modern dalam sektor pertanian'),
(522, 18, 'Pada tahun 2016 masyarakat Indonesia memasuki era Masyarakat ekonomi ASEAN (MEA). Salah satu tujuan pemberlakuan MEA di Asia Tenggara yaitu ….', 'enura.png', 0, 'Mengentaskan kemiskinan dan meratakan pertumbuhan ekonomi', 'Mewujudkan Asia sebagai kawasan yang bebas, aman, dan damai', 'Meminimalisir konflik antarnegara di kawasan Asia Tenggara', 'Mempererat kerjasama di Asia Tenggara dalam berbagai bidang'),
(523, 18, 'Kawasan Asia Tenggara dilalui oleh dua jalur gunungapi yaitu Sirukum Pasifik dan Sirukum Mediterania. Karakteristik geografis wilayah yang dilaluinya memiliki tanah relative subur. Dampak positif kondisi tersebut yaitu ….', 'enura.png', 0, 'Mendukung pengembangan agroindustry', 'Mendorong kegiatan peternakan dan perikanan', 'Meningkatkan ekspor komoditas hasil hutan', 'Memiliki banyak tambang minyak bumi'),
(524, 18, 'Sebagian besar pembangunan sektor ekonomi terpusat di Pulau Jawa permasalahan kependudukan di Indonesia akibat kondisi tersebut adalah ….', 'enura.png', 0, 'Persebaran penduduk yang tidak merata', 'Angka beban tanggungan yang tinggi', 'Pertumbuhan penduduk yang tinggi', 'Kualitas penduduk yang rendah'),
(525, 18, 'Program keluarga berencana (KB) merupakan upaya pemerintah Indonesia untuk mengatasa permasalahan ….', 'enura.png', 0, 'Ledakan penduduk yang tinggi', 'Pendapatan per kapita yang rendah', 'Angka pengangguran yang tinggi', 'Laju migrasi yang tinggi'),
(526, 18, 'Perhatikan bentuk-bentuk peroses sosial berikut!', '015020_526_13.PNG', 1, '1), 3), dan 5)', '1), 2), dan 3)', '1), 2), dan 4)', '2), 4), dan 5)'),
(527, 18, 'Setiap bulan peserta didik melakukan kerja bakti di sekolah. Bentuk proses sosial asosiatif berdasarkan pernyataan tersebut adalah …..', 'enura.png', 0, 'Kerja sama', 'Akomodasi', 'Akulturasi', 'Asimilasi'),
(528, 18, 'Pada masa praaksara manusia sudah mampu menghasilkan kebudayaan. Hasil kebudayaan manusia pada masa bercocok tanam ditunjukkan oleh pilihan ….', 'enura.png', 0, 'Kapak persegi, Kapak lonjong, Gerabag', 'Kapak perimbas, Kapak genggam, Alat serpih', 'Bejana perunggu, Arca perunggu, Kapak corong', 'Lukisan dinding, Manik-manik, Rumah panggung'),
(529, 18, 'Faktor yang mempermudah agama dan kebudayaan Hindu-Budha masuk di Indonesia adalah ….', 'enura.png', 0, 'Jalur perdagangan yang menghubungkan India, Cina, dan Indonesia', 'Indonesia mimiliki tanah yang subuh dan iklim tropis', 'Masyarakat Indonesia bersikap ramah dan sopan', 'Sebagaian besar masyarakat Indonesia menganut animism dan dinamisme'),
(530, 18, 'Raja pertama kutai yang bernama Kudungga masih menganut kepercayaan asli Indonesia. Adapun raja kedua Kutai yang bernama Aswawarman sudah menganut agama Hindu. Informasi tersebut diperoleh dari ….', 'enura.png', 0, 'Yupa yang ditemukan di Kalimantan Timur', 'Laporan perjalanan yang ditulis I-Tsing', 'Prasasti Talang Tuo yang ditemukan di tepi Sungai Musi', 'Prasasti Ciaruteun yang saat ini disimpan di Museum Nasional'),
(531, 18, 'Perhatikan beberapa prasasti berikut!', '015357_531_18.PNG', 1, '1), 2), dan 3)', '1), 3), dan 4)', '2), 3), dan 5)', '3), 4), dan 5)'),
(532, 18, 'Masyarakat kerajaan mataram kuno memiliki keunggulan dalam seni bangunan terutama candi. Bukti yang memperkuat pendapat tersebut yaitu …..', 'enura.png', 0, 'Banyak peninggalan candi di sekitar wilayah mataram kuno', 'Raja mataram kuno yang wafat selalui dimakamkan di candi', 'Penemuan bekas candi di dekat keratin kerajaan mataram kuno', 'Ditemukan informasi tentang masyarakat mataram kuno yang bekerja sebagai pemahat candi'),
(533, 18, 'Perhatikan tokoh-tokoh berikut!', '015523_533_20.PNG', 1, '3), 4), dan 5)', '1), 2), dan 3)', '2), 3), dan 4)', '2), 4), dan 5)'),
(534, 18, 'Pada awalnya pembacaan naskah proklamasi akan dilaksanakan di lapangan ikada. Akan tetapi, akhirnya dipindahkan ke kediaman Soekarno. Faktor penyebab pemindahan tempat pembacaan naskah proklamasi adalah …..', 'enura.png', 0, 'Lapangan Ikada dijaga ketat oleh pasukan Jepang bersenjata lengkap', 'Peta tidak menjamin keselamatan Soekarno apabila proklamasi dibacakan di lapangan Ikada', 'Kediaman Soekarno memiliki peralatan lebih canggih daripada lapangan Ikada', 'Banyak rakyat Indonesia yang terlanjur mendatangai kediaman Soekarno'),
(535, 18, 'Perhatikan keterangan berikut!', '015719_535_22.PNG', 1, 'Memenuhi kebutuhan rakyat', 'Memperluas lapangan kerja', 'Menyelenggarakan kegiatan usaha', 'salahMemberikan pemasukan bagi Negara'),
(536, 18, 'Manfaat yang dirasakan produsen dalam negeri dari adanya kegiatan ekspor adalah …..', 'enura.png', 0, 'Memperluas pasar penjualan produknya', 'Meningkatkan harga hasil produksi', 'Meningkatkan jumlah hasil produksi', 'Mempermudah dalam memperoleh bahan baku'),
(537, 18, 'Tujuan utama pemerintah Indonesia melakukan kegiatan impor adalah…', 'enura.png', 0, 'Memenuhi kebutuhan dalam negeri', 'Memperoleh barang berkualitas', 'Menambah cadangan devisa Negara', 'Meningkatkan produksi dalam negeri'),
(538, 18, 'Pemberlakuan Masyarakat Ekonomi ASEAN (MEA) menyebabkan maraknya produk impor beredar di pasar dalam negeri. Kondisi ini, membawa manfaat bagi masyarakat Indonesia yaitu….', 'enura.png', 0, 'Memperoleh barang bermutu dengan harga murah', 'Memperluas kesempatan kerja di Indonesia', 'Memiliki banyak alternative barang konsumsi', 'Mewujudkan distribusi pendapatan secara merata'),
(539, 18, 'Sebagian besar warga Desa Kenanga berprofesi sebagai peternak sapi perah. Para peternak ingin mendirikan koperasi untuk mempermudah penjualan susu hasil perahan. Berdasarkan keterangan tersebut jenis koperasi yang dapat dikembangkan warga Desa Kenanga adalah …..', 'enura.png', 0, 'Koperasi pemasaran', 'Koperasi konsumsi', 'Koperasi produksi', 'Koperasi jasa'),
(540, 18, 'Perbedaan mendasar antara pasar monopoli dan pasar monopsoni adalah ….', 'enura.png', 0, 'Pasar monopoli dikuasai oleh satu penjual, sedangkan pasar monopsoni dikuasai satu pembeli', 'Pasar monopoli harganya ditentukan oleh pembeli, sedangkan pasar monopsoni ditetntukan oleh penjual', 'Pasar monopoli menjual satu jenis barang, sedangkan pasar monopsony menjual berbagai barang', 'Pasar monopoli hanya teradapat satu penjual, sedangkan pasar monopsony terditi atas beberapa penjual'),
(541, 18, 'Pak Thomas tinggal di negara G  dan bekerja sebagai pegawai pemerintah.  sistem ekonomi di negara tersebut memberi kebebasan kepada rakyat untuk memiliki faktor-faktor produksi pertumbuhan ekonomi di negara G  sangat tinggi karena kegiatan ekonomi berdasarkan mekanisme pasar.  pindah ke negara N  karena tugas negara.  di negara N  kegiatan ekonomi dibatasi pemerintah titik swasta hanya diberikan kesempatan mengolah selain sektor ekonomi vital. kesimpulan dari ilustrasi tersebut adalah …..', 'enura.png', 0, 'negara N menganut sistem ekonomi campuran', 'negara N menganut sistem ekonomi pasar', 'negara G menganut sistem ekonomi terpusat', 'negara G menganut sistem ekonomi komando'),
(542, 18, 'Penerapan sistem ekonomi pasar dapat berdampak positif dan berdampak negatif dalam perekonomian Salah satu dampak negatif sistem ekonomi pasar adalah perekonomian yang relatif tidak stabil kondisi tersebut disebabkan oleh ….', 'enura.png', 0, 'Ada kebebasan swasta dalam perekonomian sehingga  pemerintah tidak bisa mengintervensi', 'Ketimpangan pendapatan yang rendah menyebabkan kecemburuan sosial yang tinggi', 'Perekonomian berdasarkan mekanisme pasar menyebabkan kegiatan ekonomi tidak efisien', 'Persaingan usaha yang terlalu ketat sehingga menghasilkan produk banyak berkualitas rendah'),
(543, 18, 'geri  bekerja sebagai tenaga pemasaran di perusahaan otomotif. Ia memiliki penghasilan 13 juta perbulan titik dia telah beristri dan memiliki 3 orang anak istrinya sebagai ibu rumah tangga titik biaya jabatan geri  per tahun sebesar Rp. 2.000.000,00. geri juga membayar Rp. 1.000.000,00 pertahun. besar pajak penghasilan yang harus dibayar geri selama setahun adalah ….', 'enura.png', 0, 'Rp.7.150.000,00', 'Rp.2.500.000,00', 'Rp.4.650.000,00', 'Rp.12.150.000,00'),
(544, 19, 'Soal nomor 1', '121858_544_1.PNG', 1, 'D', 'A', 'B', 'C'),
(545, 19, 'Soal nomor 2', '121916_545_2.PNG', 1, 'C', 'A', 'B', 'D'),
(546, 19, 'Soal nomor 3', '121936_546_3.PNG', 1, 'A', 'B', 'C', 'D'),
(547, 19, 'Parabola y = x – (2k + 1)x + 3k memotong sumbu y di (0,c) dan memotong sumbu x di (a,0) dan (b,0). Jika 3a,2c – 4, dan 3b + 1 membentuk barisan aritmatika, maka nilai k adalah …', 'enura.png', 0, '2', '1', '3', '4'),
(548, 19, 'Soal nomor 5', '121956_548_5.PNG', 1, 'D', 'A', 'B', 'C'),
(549, 19, 'Soal nomor 6', '124232_549_6.PNG', 1, 'A', 'B', 'C', 'D'),
(550, 19, 'Soal nomor 7', '124344_550_7.PNG', 1, 'C', 'D', 'B', 'A'),
(551, 19, 'Soal nomor 8', '124530_551_8.PNG', 1, 'D', 'A', 'B', 'C'),
(552, 19, 'Soal nomor 9', '125023_552_9.PNG', 1, 'B', 'A', 'C', 'D'),
(553, 19, 'Pak Harno memiliki modal sebesar Rp 60.000,00 ia kebingungan menentukan jenis dagangannya. Jika ia membeli 70 barang jenis I dan 50 barang jenis II, uang sisanya Rp 2.500,00 sedangkan jika ia membeli 70 barang jenis I dan 60 jenis II uangnya kurang Rp 2.000,00. Model matematika yang dapat disusun adalah …', '154748_553_comingsoon.png', 0, '7x + 5y = 5.750 dan 7x + 6y = 6.200', '7x + 5y = 6.200 dan 7x + 6y = 5.750', '7x + 5y = 6.000 dan 7x + 5y = 5.750', '7x + 5y = 6.250 dan 7x + 5y = 5.800'),
(554, 19, 'Kompetensi SEA GAMES diikuti oleh 5 negara ASEAN. Pada babak awal setiap negara harus bertanding satu sama lain. Banyak pertandingan pada babak awal adalah …', 'enura.png', 0, '10', '15', '20', '25'),
(555, 19, 'Ibu Retno membelanjakan uangnya sebesar Rp 26.000,00 digunakan untuk membeli 2 kg terigu dan 3 kg gula. Ibu Eli membelanjakan Rp 32.000,00 untuk membeli 2 kg terigu dan 4 kg gula. Di toko yang sama Bu Kismi membeli 2 kg terigu dan 1 kg gula, ia harus membayar …', 'enura.png', 0, 'Rp 14.000,00', 'Rp 12.000,00', 'Rp 16.000,00', 'Rp 20.000,00'),
(556, 19, 'Diketahui barisan aritmatika dengan suku pertama 5 dan suku ke 6 adalah 15. Jumlah 20 suku pertama deret tersebut adalah …', 'enura.png', 0, '480', '540', '450', '400'),
(557, 19, 'Soal nomor 14', '125339_557_14.PNG', 1, 'C', 'A', 'B', 'D'),
(558, 19, 'Soal nomor 15', '125519_558_15.PNG', 1, 'D', 'A', 'B', 'C'),
(559, 19, 'Soal nomor 16', '125605_559_16.PNG', 1, 'D', 'A', 'B', 'C'),
(560, 19, 'Diberikan fungsi f memenuhi persamaan 3f(-x) + f(x – 3) = x + 3, nilai 8f(-3) adalah …', 'enura.png', 0, '15', '16', '20', '21'),
(561, 19, 'Soal nomor 18', '125730_561_18.PNG', 1, 'D', 'A', 'B', 'C'),
(562, 19, 'Soal nomor 19', '125836_562_19.PNG', 1, 'A', 'B', 'C', 'D'),
(563, 19, 'Soal nomor 20', '130203_563_20.PNG', 1, 'C', 'A', 'B', 'D'),
(564, 19, 'Dua buah mobil menempuh jarak 450 km. Kecepatan mobil kedua setiap jamnya 15 km lebih cepat daripada kecepatan mobil pertama. Jika waktu perjalanan mobil kedua 1 jam lebih pendek dari waktu perjalanan mobil pertama, maka rata – rata kecepatan kedua mobil tersebut adalah …', 'enura.png', 0, '82,5 km/jam', '92,5 km/jam', '97,5 km/jam', '85 km/jam'),
(565, 19, 'Jika x adalah sisi bujur sangkar yang luasnya 100 cm kuadrat dan y = alas segitiga siku – siku yang luasnya 150 cm2 dengan tinggi 2x, berapakah nilai 2xy …', 'enura.png', 0, '300', '225', '100', '325'),
(566, 19, 'P, Q, dan R memancing ikan. Jika hasil Q lebih sedikit dari R, sedangkan jumlah P dan Q lebih banyak daripada dua kali R, maka yang terbanyak mendapatkan ikan adalah …', 'enura.png', 0, 'P dan R', 'P dan Q', 'P', 'Q'),
(567, 19, 'Dari 10 finalis putri Indonesia juara I, II dan III. Banyak kemungkinan susunan terpilihnya sebagai juara adalah …', 'enura.png', 0, '720', '480', '240', '120'),
(568, 19, 'Soal nomor 25', '130229_568_25.PNG', 1, 'C', 'A', 'B', 'D'),
(569, 19, 'Soal nomor 26', '130256_569_26.PNG', 1, 'C', 'A', 'B', 'D'),
(570, 19, 'Soal nomor 27', '130323_570_27.PNG', 1, 'A', 'B', 'C', 'D'),
(571, 19, 'Soal nomor 28', '130342_571_28.PNG', 1, 'B', 'A', 'C', 'D'),
(572, 19, 'Soal nomor 29', '130400_572_29.PNG', 1, 'D', 'A', 'B', 'C'),
(573, 19, 'Soal nomor 30', '130415_573_30.PNG', 1, 'C', 'A', 'B', 'D'),
(574, 20, 'What are the man and the woman talking about', '110851_574_1.PNG', 1, 'Weekend plans', 'Seeing a movie', 'Going to the city', 'Trying new cafes'),
(575, 20, 'What does the woman express?', '110921_575_2.PNG', 1, 'Dissatisfaction', 'Expectation', 'Satisfaction', 'Sympathy'),
(576, 20, 'What is the most possible place where Mira is talking to her father?', '111047_576_3.PNG', 1, 'Her school.', 'The office.', 'her home.', 'A meeting room.'),
(577, 20, 'What are the speakers going to do?', '111130_577_4.PNG', 1, 'To arrange their free time.', 'To see Peterpan show.', 'To stay at home', 'To watch Peterpan at home.'),
(578, 20, 'What happened after the incident?', '111210_578_5.PNG', 1, 'A protest would be held.', 'The railway was closed.', 'Police would close the case.', 'People became afraid to take the train.'),
(579, 20, 'What can we infer from the monologue?', '111248_579_6.PNG', 1, 'Pattimura was executed to stop the rebellion.', 'Pattimura was born in a nationalist family.', 'The Dutch took Maluku from the British.', 'Thomas Matulessy joined the British army to fight the Dutch.'),
(580, 20, 'What is the main idea of the second paragraph?', '111554_580_7 dan 8.PNG', 1, 'Word choice in the text of proclamation.', 'The term ‘TRANSFER OF POWER’.', 'The night before the proclamation.', 'The location of the proclamation.'),
(581, 20, '“the text was (secretly) broadcast” Paragraph 3. Word inside bracket has similar meaning to ….', '111648_581_7 dan 8.PNG', 1, 'Quietly', 'Publicly', 'Openly', 'Formally'),
(582, 20, 'What is the purpose of the text?', '111759_582_9.PNG', 1, 'To announce the Consulate General of Nigeria closing due to the US Veteran’s Day.', 'To tell Nigeria about the Veteran\'s Day hold by the United States of America.', 'To invite the staff of the Consulate General of Nigeria to the White House.', 'To announce the Veteran\'s Day celebration.'),
(583, 20, 'From the text we can infer that …', '111857_583_10 dan 11.PNG', 1, 'the people loved the dog more than the king.', 'nobody came to the king’s funeral because it was far.', 'Virat Singh was killed by his people.', 'the dog was actually the King’s child.'),
(584, 20, 'The citizens abandoned the king … he died.', '111925_584_10 dan 11.PNG', 1, 'When', 'Before', 'While', 'Until'),
(585, 20, 'From the text we know Maria remembered that ...', '112040_585_12.PNG', 1, 'Felyta’s daughter was going to enter kindergarten.', 'they always celebrated Christmas together.', 'their children went to the same university.', 'they used to be classmates.'),
(586, 20, 'After reading the text, the reader will be able to ...', '112117_586_13 dan 14.PNG', 1, 'browse the internet.', 'find Wi-Fi signals around them.', 'make new friends on the internet', 'tell the other readers to find network connections.'),
(587, 20, 'What is one possible condition if your network does not appear?', '112146_587_13 dan 14.PNG', 1, 'The network is hidden', 'Your phone is broken.', 'The network is password-protected.', 'You don’t have enough phone credit.'),
(588, 20, '“using (advanced) technologies” Paragraph. 2. Word inside bracket is synonymous with ….', '112246_588_15.PNG', 1, 'Modern', 'Expensive', 'Affordable', 'Useful'),
(589, 20, 'Which of the following information can be found in the text?', '112330_589_16 dan 17.PNG', 1, 'Studying abroad will improve your social skills.', 'Studying abroad may cost you a lot of money.', 'Learning everything online is better than traveling abroad.', 'Students who study abroad are more successful than those who don’t.'),
(590, 20, 'What is the writer’s recommendation regarding studying abroad?', '112400_590_16 dan 17.PNG', 1, 'Students must travel to gain real experience.', 'The needs of students should be learned internationally.', 'Parents who don’t send their kids abroad need to be sanctioned.', 'Schools must make special programs for their students to study abroad.'),
(591, 20, '“Smoking doesn\'t only affect people, but also the environment.”. Change the sentence above into passive voice!', '112504_591_18.PNG', 1, 'People and environment are affected by smoking.', 'People and environment were affected by smoking.', 'People and environment will be affected by smoking.', 'People and environment can be affected by smoking.'),
(592, 20, 'Why is the text written?', '112539_592_19.PNG', 1, 'To invite Mr. Ferguson to the business summit 2020.', 'To inform the company’s growth.', 'To announce an office move.', 'To present Domina Sales & Marketing Pvt Ltd and its clients.'),
(593, 20, 'What is the appropriate sentence to fill the gap above?', '112608_593_20.PNG', 1, 'I can’t believe this!', 'That\'s too bad!', 'You could do much better!', 'I can’t trust you!'),
(594, 20, 'Arrange the sentences above based on the appropriate procedural text….', '112647_594_21.PNG', 1, '1 – 3 – 5 – 4 – 2', '1 – 3 – 5 – 2 – 4', '3 – 1 – 5 – 4 – 2', '3 – 5 – 1 – 4 – 2'),
(595, 20, 'Arrange the sentences above based on the appropriate procedural text….', '112740_595_22.PNG', 1, '3 – 5 – 4 – 2 – 7 – 6 – 1', '3 – 5 – 4 – 2 – 7 – 1 – 6', '3 – 4 – 5 – 2 – 7 – 1 – 6', '3 – 4 – 5 – 2 – 7 – 6 – 1'),
(596, 20, 'What is the purpose of the text below?', '113626_596_23 dan 24.PNG', 1, 'To explain how to create a PayPal account', 'To explain how to verify your PayPal account', 'To explain how to register a new bank account', 'To give a brief hint how to use PayPal credit'),
(597, 20, 'The sentence ‘You can create an account from the PayPal homepage or from the app.’ could possibly restated as…', '113701_597_23 dan 24.PNG', 1, 'You can make an account either from the PayPal homepage or the app.', 'You need to create an account with both the PayPal homepage and the app.', 'You don’t need to create an account from the PayPal homepage or from the app.', 'You are obliged to create an account on the PayPal homepage and the app.'),
(598, 20, 'Wich picture is described in the text?', '113429_598_25.PNG', 1, 'D', 'A', 'B', 'C'),
(599, 20, 'All of you are good, nice, gentle, and kind ...\" (Paragraph 2) The underlined word is synonymous with ...', '113207_599_29 dan 30.PNG', 1, 'honorable', 'easygoing', 'cheerful', 'diligent'),
(600, 20, 'What is the topic of the announcement above? Students’ association', '112849_600_27.PNG', 1, 'Students’ gathering', 'School’s gathering', 'Students’ association office', 'Teachers’ gathering'),
(601, 20, 'What happened when they were about to leave for Bali?', '112939_601_28.PNG', 1, 'The plane was late for an hour.', 'The adverse weather prompted the plane to delay.', 'They needed to put their trip off.', 'They needed to cancel their trip.'),
(602, 20, 'The story mainly tells us about ...', '113051_602_29 dan 30.PNG', 1, 'a rabbit and twenty crocodiles', 'the boss of the crocodile', 'twenty crocodiles', 'a rabbit and the boss of crocodile'),
(603, 20, 'We know from the first paragraph that the rabbit actually wanted ...', '113128_603_29 dan 30.PNG', 1, 'to cross the river', 'to swim across the river', 'to meet the boss of crocodile', 'to know where the crocodiles are'),
(604, 21, 'Jika tiap kotak mewakili 10 km, maka Besar perpindahan yang ditempuh orang tersebut adalah...', '095226_604_1.PNG', 1, '50 km', '30 km', '40 km', '60 km'),
(605, 21, 'Sebuah bola pejal dengan massa 4 kg terletak di ujung lemari setinggi 2 m, kemudian didorong mendatar sehingga kecepatannya 2 m/s pada saat lepas dari tepi atas lemari. Percepatan gravitasi g adalah 10 m/s², maka energi mekanik partikel pada saat benda berada pada ketinggian 1 m dari tanah sebesar...', 'enura.png', 0, '88 J', '40 J', '48 J', '80 J'),
(606, 21, 'Pernyataan yang benar berkaitan dengan grafik di atas ditunjukkan oleh nomor … .', '095424_606_3.PNG', 1, '2 dan 3', '1 dan 3', '2 dan 4', '3 dan 4'),
(607, 21, 'Jarak maksimum koin dari poros putar agar koin tersebut tetap berputar bersama piringan adalah … .', '095535_607_4.PNG', 1, '11 cm', '10 cm', '16 cm', '6 cm'),
(608, 21, '...', '095707_608_5.PNG', 1, '540.000 N', '608.000 N', '24.000 N', '10.800 N'),
(609, 21, '...', '095844_609_6.PNG', 1, 'c', 'a', 'b', 'c'),
(610, 21, 'Berat tangga 300 N dan berat orang 700 N. Bila orang tersebut dapat naik sejauh 3 m sesaat sebelum tangga itu tergelincir, maka koefisien gesekan antara lantai dan tangga adalah....', '095955_610_7.PNG', 1, '0,43', '0,14', '0,49', '0,50'),
(611, 21, 'Seorang anak menjatuhkan sebuah kayu di permukaan air sehingga pada permukaan air terbentuk gelombang. Jika menganggap persamaan simpangan gelombang yang dihasilkan  y = 6 sin (0,2πt + 0,5 πx) dimana y dan x dalam cm dan t dalam sekon, dapat disimpulkan:', '100126_611_8.PNG', 1, '(2) dan (3)', '(2) dan (4)', '(3) dan (4)', '(1) dan (2)'),
(612, 21, '...', '100251_612_9.PNG', 1, 'a', 'b', 'c', 'd'),
(613, 21, 'Agar hal tersebut tercapai maka berapa jarak celah ke layar harus dijadikan?', '100450_613_10.PNG', 1, '(5/4) L', '(4/5)L', '(1/3) L', '2/5 L'),
(614, 21, '...', '100619_614_11.PNG', 1, 'c', 'a', 'b', 'd'),
(615, 21, 'Pernyataan yang benar berkaitan dengan rangkaian di atas adalah', '100722_615_12.PNG', 1, '(1) dan (2)', '(1) dan (3)', '(1) dan (4)', '(2) dan (4)'),
(616, 21, 'Pasangan pernyataan yang benar tentang kelemahan model atom tersebut adalah ….', '100804_616_13.PNG', 1, '2 dan 4', '1 dan 2', '1 dan 3', '1 dan 4'),
(617, 21, 'Berdasarkan wacana tersebut, hukum kimia yang berlaku adalah ….', '100857_617_14.PNG', 1, 'Hukum Gay-Lussac', 'Hukum Avogadro', 'Hukum Lavoisier', 'Hukum Dalton'),
(618, 21, 'Suatu larutan glukosa (Mr = 180) dilarutkan dalam 100 gram air dan mendidih pada suhu 100,650C. Jika Kb air = 0,520C kg/mol, massa glukosa yang dilarutkan adalah ….', 'enura.png', 0, '22,5 gram', '11,2 gram', '5,6 gram', '45,0 gram'),
(619, 21, 'Pasangan data yang tepat antara meneral dan kandungan unsurnnya adalah . . . .', '101049_619_16.PNG', 1, '1 dan 3', '1 dan 2', '4 dan 5', '3 dan 4'),
(620, 21, '....', '101209_620_17.PNG', 1, '– 1368 kJ', '– 958 kJ', '– 402 kJ', '+ 1368 kJ'),
(621, 21, '...', '101316_621_18.PNG', 1, '+36,8 kJ', '+18,4 kJ', '−18,4 kJ', '+184 kJ'),
(622, 21, '....', '101411_622_19.PNG', 1, '3 dan 4', '1 dan 2', '2 dan 3', '2 dan 4'),
(623, 21, 'Penentuan konsentrasi suatu asam kuat dapat dilakukan dengan titrasi menggunakan basa kuat. Misalnya 50 mL larutan HCl 0,1 MHCl 0,1 M dititrasi dengan larutan NaOH 0,1 M menggunakan indikator fenolftalein (PP). Titrasi dihentikan ketika larutan berubah warna menjadi merah muda secara tiba-tiba.  Alasan yang paling tepat terkait dengan terjadinya perubahan warna pada saat titrasi adalah . . . .', 'enura.png', 0, 'pada saat volume NaOH berlebih maka larutan menjadi merah', 'larutan indikator pp akan memberikan warna merah pada larutan asam', 'NaOH bersifat basa kuat sehingga larutan HCl menjadi merah', 'mol HCl = mol NaOH dan pH larutan > 8,5'),
(624, 21, 'Data yang berhubungan dengan tepat ditunjukkan oleh pasangan nomor . . . .', '101615_624_21.PNG', 1, '2 dan 3', '2 dan 4', '3 dan 4', '4 dan 5'),
(625, 21, 'Pernyataan yang benar terkait dengan kedua larutan basa tersebut adalah . . .', '101658_625_22.PNG', 1, 'harga pH kedua larutan adalah 11', 'dengan indikator fenolftalein larutan tidak berwarna', 'konsentrasi NH4OH sama dengan konsentrasi NaOH', 'dibutuhkan konsentrasi asam yang tidak sama untuk menetralkan kedua basa'),
(626, 21, 'Bahan bakar yang memiliki mutu terbaik adalah . . . .', '101740_626_23.PNG', 1, 'Pertamax turbo', 'Pertamax plus', 'Pertamax', 'Pertalite'),
(627, 21, 'Berdasarkan hasil uji, golongan karbohidrat tersebut adalah . . . .', '101824_627_24.PNG', 1, 'amilum', 'sukrosa', 'fruktosa', 'glukosa'),
(628, 21, 'Tumpahan minyak di lautan akibat kebocoran kapal tanker dapat menyebabkan permukaan laut tertutup minyak. Kondisi ini dapat menghalangi fotosintesis plankton, selanjutnya menyebabkan rantai makanan terputus. Apakah memungkinkan terjadinya evolusi dalam ekosistem dalam jangka waktu lama?', 'enura.png', 0, 'Ya, perubahan lingkungan mempengaruhi perubahan cara adaptasi individu', 'Ya, perubahan lingkungan dapat mempercepat kejadian mutasi.', 'Ya, fotosintesis plankton tergeser menjadi kemosintesis.', 'Tidak, perubahan lingkungan tidak mempengaruhi cara adaptasi individu'),
(629, 21, 'Dari jenis-jenis hewan tersebut yang termasuk kelas cephalopoda ialah:', '101943_629_26.PNG', 1, '1 dan 4', '1 dan 2', '3 dan 4', '2 dan 5'),
(630, 21, 'Gas CO yang masuk ke dalam sistem pemapasan kita dapat menyebabkan kematian karena:', 'enura.png', 0, 'Gagalnya pengangkutan oksigen oleh hemoglobin', 'Melemahnya otot diafragma sehingga meluasnya alveolus', 'Karena banyaknya gas CO sehingga paru-paru membesar tidak dapat berkontraksi', 'Penyempitan saluran pernapasan karena alergi gas CO'),
(631, 21, 'Jenis hewan yang memiliki dua macam carareproduksi, seksualis dan aseksualisadalah………', 'enura.png', 0, 'Hydraviridis', 'Lumbricus terrestris', 'Taenia saginata', 'Nereis vexillosa'),
(632, 21, 'Urutan jalannya sel telur sampai terjadinya pembuahandan embrio adalah ….', '102117_632_29.PNG', 1, '5-1-6-4', '3-4-6-1', '2-3-4-5', '1-4-5-6'),
(633, 21, 'Organ manakah berfungsi membuang sampah yang mengandung N (Nitrogen) ?', '102152_633_30.PNG', 1, '1', '2', '3', '4'),
(634, 22, 'Salah satu faktor dalam proses interaksi sosial adalah kecenderungan seseorang untuk sama dengan orang lain. Itu adalah faktor …', 'enura.png', 0, 'Identifikasi', 'Kasih sayang', 'salah2', 'Imitasi'),
(635, 22, 'Interaksi sosial dapat terjadi jika memenuhi dua persyaratan utama, yaitu …', 'enura.png', 0, 'Kontak dan komunikasi sosial', 'Kontak sosial dan imitasi', 'Simpati dan empati', 'Peniruan dan saran'),
(636, 22, 'Sikap dan perilaku Dito, seperti berbicara, berpakaian dan berjalan, selalu ingin sama dengan saudaranya. Contoh tindakan ini adalah tindakan berdasarkan faktor …', 'enura.png', 0, 'Identifikasi', 'Sosialisasi', 'Empati', 'Proposal'),
(637, 22, 'Ketika kami memberi selamat kepada teman yang cakap, itu adalah ekspresi …', 'enura.png', 0, 'Simpati', 'Empati', 'Proposal', 'Imitasi'),
(638, 22, 'Pertemuan kelompok parlemen ke-5 dalam DVR untuk membahas proposal legislatif yang …', 'enura.png', 0, 'Kelompok dengan kelompok', 'Individu dengan individu', 'Individu dengan grup', 'Grup dengan pihak'),
(639, 22, 'Fila memotong rambutnya dan mengecat pirang seperti penyanyi idolanya. Dalam hal ini, Fila melakukan proses …', 'enura.png', 0, 'Imitasi', 'Empati', 'Kasih sayang', 'Identifikasi'),
(640, 22, 'Ketika terjadi gempa bumi di Yogyakarta, kami sedih dan merasakan sakitnya. Ini adalah bentuk dari proses …', 'enura.png', 0, 'Empati', 'Proposal', 'Imitasi', 'Identifikasi'),
(641, 22, 'Jika ada teman kita yang unggul, kami mengucapkan selamat padanya, itu adalah manifestasi dari menjadi …', 'enura.png', 0, 'Simpati', 'Empati', 'Imitasi', 'Proposal'),
(642, 22, 'Dalam proses sosial seseorang dapat berbicara tentang interaksi sosial jika memenuhi persyaratan utama, yaitu …', 'enura.png', 0, 'Kontak sosial', 'Komunikasi', 'proses sosial', 'Konflik sosial'),
(643, 22, 'Interaksi adalah proses penanggulangan oleh masing-masing kelompok secara berurutan yang menjadi kekuatan pendorong untuk pembalasan oleh kelompok lain. Interaksi didefinisikan oleh …', 'enura.png', 0, 'Raucek dan Warren', 'Selo Soemardjan', 'Koentjaraningrat', 'Gillin'),
(644, 22, 'Ketika duta besar memanggil Dista untuk bertemu Dina, hubungan itu disebut …', 'enura.png', 0, 'Kontak sekunder tidak langsung', 'Kontak sekunder langsung', 'Kontak sekunder', 'Kontak primer'),
(645, 22, 'Manusia sebagai makhluk sosial memiliki tiga kebutuhan, salah satunya adalah kebutuhan sekunder yang mencakup yang berikut, kecuali …', 'enura.png', 0, 'Pengetahuan', 'Kondisi kehidupan biasa', 'Kesehatan yang baik', 'Berkomunikasi dengan orang lain'),
(646, 22, 'Berikut ini bukan bagian dari elemen komunikasi ….', 'enura.png', 0, 'Komunikasi', 'Mengkomunikasikan', 'Komunikator', 'Pesan'),
(647, 22, 'Komunikasi dipahami …', 'enura.png', 0, 'Suatu proses pengiriman pesan dari satu pihak ke pihak lain sehingga ada saling campur tangan di antara keduanya', 'Korelasi langsung', 'Hubungan sosial antara individu dan individu', 'Mempengaruhi pihak lain'),
(648, 22, 'Nilai-nilai yang terkait dengan sistem ekonomi disebut …', 'enura.png', 0, 'Nilai ekonomi', 'nilai materi', 'Nilai karakter', 'nilai sosial'),
(649, 22, 'Nilai moral atau nilai barang berasal dari …', 'enura.png', 0, 'Kebenaran', 'Alasan manusia', 'Niat dan etika', 'Perasaan estetika'),
(650, 22, 'Peraturan yang berlaku di masyarakat dan disertai dengan sanksi atau ancaman disebut sebagai …', 'enura.png', 0, 'Adat', 'Norma', 'Nilai', 'Hukum'),
(651, 22, 'Suatu bentuk norma yang tidak tertulis adalah ….', 'enura.png', 0, 'Bea Cukai', 'Hukum', 'Hukum Pidana', 'Hukum Perdata'),
(652, 22, 'Norma sosial yang memiliki sanksi paling ketat adalah …', 'enura.png', 0, 'Norma hukum', 'Norma Etis', 'norma kesopanan', 'norma agama'),
(653, 22, 'Nilai-nilai yang dibangun dalam kepribadian, sikap, dan perilaku seseorang selalu cocok dengan nilai-nilai yang sangat dihargai oleh masyarakat', 'enura.png', 0, 'Nilai tidak tercerna', 'Nilai kepribadian', 'Nilai sosial', 'Nilai material'),
(654, 22, 'Proses pembelajaran anak untuk menjadi anggota yang berpartisipasi dalam masyarakat adalah memahami sosialisasi setelah …', 'enura.png', 0, 'Peter L. Berger', 'Koentjaraningrat', 'Raucek dan Warren', 'Fitcher'),
(655, 22, 'Lingkungan yang masih dalam kandungan disebut …', 'enura.png', 0, 'Lingkungan prenatal', 'Lingkungan ibu', 'Lingkungan sosial', 'Lingkungan pribadi'),
(656, 22, 'Menurut Notonegoro, nilai-nilai spiritual dibagi menjadi empat sebagai berikut, kecuali …', 'enura.png', 0, 'Nilai materi', 'Nilai etis', 'Nilai kebenaran', 'Nilai agama'),
(657, 22, 'Sosialisasi media pertama yang dialami seseorang adalah …', 'enura.png', 0, 'Keluarga', 'Sekolah', 'Media massa', 'Organisasi'),
(658, 22, 'Nilai adalah kesadaran dan emosi yang hilang untuk suatu objek, ide atau orang untuk waktu yang relatif lama, diungkapkan oleh …', 'enura.png', 0, 'Alvin L. Bertrand', 'Woods', 'Peter L. Berger', 'Kimbal Young'),
(659, 22, 'Menurut Walter G. Everett, tipe nilai dapat dibagi menjadi lima, kecuali …', 'enura.png', 0, 'Nilai seni', 'Nilai gabungan', 'Nilai-nilai kenyamanan', 'Nilai karakter'),
(660, 22, 'Tidak termasuk dalam fase penjangkauan berikut …', 'enura.png', 0, 'Panggung', 'Tahap permainan', 'Level', 'Tahap persiapan'),
(661, 22, 'Salah satu alasan mengapa orang Eropa ingin menjelajahi lautan di timur adalah penemuan teori Copernicus yang …', 'enura.png', 0, 'Bahwa bumi itu bulat dan matahari adalah pusat tata surya', 'Bumi berputar mengelilingi matahari', 'matahari berputar mengelilingi bumi', 'bahwa bumi itu bulat dan bumi adalah pusat kehidupan'),
(662, 22, 'Orang Eropa pertama yang melakukan perjalanan ke Indonesia melalui rute barat dan Maluku …', 'enura.png', 0, 'Portugis', 'Inggris', 'Belanda', 'Spanyol'),
(663, 22, 'Pada awal Abad Pertengahan, orang-orang Eropa mulai mengakui hasil perdagangan dari dunia Timur, terutama …', 'enura.png', 0, 'Rempah-rempah', 'logam mulia', 'Sutera', 'Perancis'),
(664, 23, 'Hitunglah 5 + 8 + 0 + 9 + 7 = ....', 'enura.jpg', 0, '29', '30', '23', '13'),
(665, 23, 'jika 9 = a + 7, maka nilai a adalah ...', 'enura.jpg', 0, '2', '1', '3', '4'),
(666, 23, '(10-5) + 20 = 15 + ....', 'enura.jpg', 0, '10', '5', '15', '20'),
(667, 23, 'Setiap pekan Ayah Riko selalu masuk kantor mulai hari Senin sampai hari Jum’at saja. Berarti setiap pekan Ayah Riko bekerja selama ... hari.', 'enura.jpg', 0, '5', '4', '6', '7'),
(668, 23, '5 + 4 = 2 + ...', 'enura.jpg', 0, '7', '8', '9', '10'),
(669, 23, 'Pak Iman membeli 2 buku yang akan diberikan kepada Nabila. Total harga buku adalah Rp. 7.000,00. Jika harga salah satu buku adalah Rp. 3.000,00 lebih mahal dari buku satunya, berapa harga masing masing buku yang dibeli Pak Iman ?', 'enura.jpg', 0, 'Rp. 3.000,00 dan Rp. 4.000,00', 'Rp. 2 000,00 dan Rp. 3.000,00', 'Rp. 3.000,00 dan Rp. 5.000,00', 'Rp. 2.000,00 dan Rp. 4.000,00'),
(670, 23, 'Bila 9 – h = 1 ,  maka nilai yang benar untuk h adalah ...', 'enura.jpg', 0, '8', '6', '7', '9'),
(671, 23, 'Empat hari yang lalu adalah hari Jumat. Tentukan tiga hari yang akan datang ...', 'enura.jpg', 0, 'Jum\'at', 'Rabu', 'Kamis', 'Sabtu'),
(672, 23, 'Suatu lapangan berbentuk persegi akan ditanami pohon di setiap sisi lapangan. Jika di setiap pojok lapangan di tanami satu pohon dan setiap sisi lapangan di tanami 4 pohon (termasuk yang di pojok), maka banyak pohon yang di Tanami pada lapangan tersebut ? ', 'enura.jpg', 0, '16', '12', '18', '20'),
(673, 23, 'Dalam kompetisi lomba melukis, Rini berada dalam urutan ke 9 dari atas sekaligus urutan 12 dari bawah. Ada berapa jumlah peserta dalam lomba melukis tersebut ?', 'enura.jpg', 0, '21', '20', '15', '12'),
(674, 23, 'Rafathar membaca buku dari halaman 3 sampai 17. Berapa halaman buku yang dibaca Rafathar ?', 'enura.jpg', 0, '14', '16', '13', '15'),
(675, 23, 'Jika sekarang pukul 23.00 , maka 2 jam kemudian adalah pukul ?', 'enura.jpg', 0, '01.00', '00.00', '24.00', '03.00'),
(676, 23, 'Dua buah bilangan jika dijumlahkan hasilnya 8 dan jika di kurangi hasilnya 2. Maka bilangan terbesar dari dua bilangan tersebut adalah ...', 'enura.jpg', 0, '5', '6', '3', '8'),
(677, 23, 'Umur Deva 2 tahun lagi adalah 15 tahum, sedangkan umur Riko 4 tahun lagi adalah 16 tahun. Selisih umur mereka sekarang adalah ...', 'enura.jpg', 0, '1', '2', '3', '4'),
(678, 23, 'Manakah nilai yang paling besar', 'enura.jpg', 0, '8 : 3', '7 : 4', '5 : 3', '4 : 2'),
(679, 23, 'Berapa banyak bilangan genap dari 1 – 13 ?', 'enura.jpg', 0, '6', '4', '5', '7'),
(680, 23, 'Pak Ahmad membersihkan halaman rumah tetangganya dengan upah Rp 25.000,00 per hari. Satu minggu dia bekerja pada hari kamis, jum’at dan minggu. Berapakah uang yang di kumpulkan oleh Pak Ahmad dalam satu minggu?', 'enura.jpg', 0, 'Rp. 75.000,00', 'Rp. 55.000,00', 'Rp. 50.000,00', 'Rp. 60.000,00'),
(681, 23, 'Tiga orang siswa memakan 3 buah jambu dalam waktu 3 menit. Berapa menit yang dibutuhkan oleh 3 orang siswa untuk memakan 6 buah jambu?', 'enura.jpg', 0, '6', '3', '4', '5'),
(682, 23, 'Bulan Februari Tahun 2018 terdiri dari ...', 'enura.jpg', 0, '29', '28', '30', '31'),
(683, 23, 'Diva  mengerjakan PR selama 3 jam. Dinda selesai mengerjakan PR 1 jam lebih cepat dari Diva. Jika Dinda selesai mengerjakan PR pada jam 8 malam. Maka jam berapakah Diva mulai mengerjakan PR ?', 'enura.jpg', 0, '6', '7', '8', '9'),
(684, 23, 'Dalam sebuah perkemahan, jumlah peserta adalah 48 anak. Jika setiap tenda dapat menampung 5 orang anak, maka berapakah paling sedikit banyak tenda yang diperlukan?', 'enura.jpg', 0, '9', '7', '8', '10');
INSERT INTO `soal` (`id`, `id_bidang`, `soal`, `foto`, `status_foto`, `jawaban1`, `jawaban2`, `jawaban3`, `jawaban4`) VALUES
(685, 23, 'Umur Jono 4 tahun lebih tua dari umur Dika. Umur Dika 3 tahun lebih muda dari umur Roni. Umur Roni tiga kali umur Dena. Jika umur Dena 5 tahun, maka berapakah Jono?', 'enura.jpg', 0, '16', '17', '18', '21'),
(686, 23, 'Bilangan terkecil yang dapat dibuat dari angka 3, 7, 9 adalah ...', 'enura.jpg', 0, '379', '739', '397', '937'),
(687, 23, '125 = n + n + n + n + n nilai n =', 'enura.jpg', 0, '25', '15', '20', '35'),
(688, 23, 'Hari ini dikelas ada 4 mata pelajaran. Setiap mata pelajaran berlangsung selama 40 menit. Jika pelajaran dimulai pukul 06.45, keempat pelajaran berakhir pada pukul ...', 'enura.jpg', 0, '09.25', '09.15', '09.20', '09.30'),
(689, 23, 'Pak Agam membeli 9 paket beras masing-masing beratnya 10 kg. Beras itu akan dimasukkan kedalam kantong plastik dengan berat 5 kg. Banyak kantong plastik yang diperlukan adalah ...', 'enura.jpg', 0, '14', '12', '18', '22'),
(690, 23, 'Dua bilangan berikutnya dari barisan 4, 5, 9, 14, 23, ... , .... adalah ...', 'enura.jpg', 0, '37', '35', '39', '23'),
(691, 23, 'Pada hari Minggu pagi, Ayu dan teman-temannya berlari mengelilingi sebuah lapangan yang berbentuk persegi dengan panjang sisi 18 m sebanyak 1 kali. Mereka telah menempuh jarak 35m. Sisa jarak lapangan yang harus ditempuh ayu dan teman-temannya adalah ...', 'enura.jpg', 0, '27', '25', '13', '62'),
(692, 23, 'Pada hari Sabtu, Ibu membuat 150 roti. Pada hari Minggu, ia membuat 25 roti lebih banyak daripada hari Sabtu. Jumlah roti yang dibuat pada hari Minggu adalah ...', 'enura.jpg', 0, '175', '170', '160', '165'),
(693, 23, 'Rini bought 221 eggs to sell bread. If 123 eggs have been used, the number of eggs remaining is...', 'enura.jpg', 0, '98', '88', '78', '45'),
(694, 24, 'Salah satu jenis tumbuhan pemakan serangga adalah kantong semar, tujuan tumbuhan tersebut memakan serangga adalah untuk...', 'enura.png', 0, 'Memenuhi kebutuhan nitrogen', 'Memenuhi kebutuhan air', 'Memenuhi kebutuhan hydrogen', 'Memenuhi kebutuhan oksigen'),
(695, 24, 'Yang termasuk keuntungan dari perkembangbiakan vegetative adalah …', 'enura.png', 0, 'Dapat memproduksi tumbuhan yang diinginkan', 'Berdaun lebat', 'Batang bercabang banyak', 'Mendapatkan buah yang sedang dan manis'),
(696, 24, 'Dari data tersebut manakah yang merupakan tumbuhan yang berkembang biak secara vegetative ….', '091818_696_soal 3.png', 1, '2 dan 4', '2 dan 3', '4 dan 5', '1 dan 4'),
(697, 24, 'Jika bunyi merambat di ruang udara maka ….', 'enura.png', 0, 'Bunyi tidak dapat terdengar karena tidak ada medium perambatan', 'Bunyi tersebut akan dapat terdengar pada jarak radius 5 meter', 'Bunyi tersebut akan langsung terdengar', 'Bunyi tersebut dapat terdengar namun dalam jeda waktu lama'),
(698, 24, 'Urutan metamorphosis yang benar pada nyamuk yaitu ….', 'enura.png', 0, 'Telur – larva – pupa – nyamuk dewasa', 'larva - telur – pupa – nyamuk dewasa', 'larva – pupa – telur – nyamuk dewasa', 'pupa – larva – telur – nyamuk dewasa'),
(699, 24, 'Suatu tanaman berkembangbiak dengan berbagai cara. Salah satunya yaitu berkembangbiak dengan cara okulasi. Tujuan suatu tanaman berkembang biak secara okulasi adalah untuk ...', 'enura.png', 0, 'Mendapatkan sifat yang unggul dari kedua pohon yang diokulasi', 'Memperbanyak tanaman yang tahan terhadap serangan hama', 'Mempercepat perolehan hail dari kedua pohon yang diokulasi', 'Mempertahankan sifat asli dari dua tanaman induk yang diokulasi'),
(700, 24, 'Perkembangbiakan makhluk hidup dengan tiga cara, yaitu bertelur atau ovipar, beranak atau vivipar dan mengerami telurnya dalam tubuh hingga menetas di dalam dan kemudian dilahirkan atau ovovivipar. Berikut ini yang merupakan pernyataan yang benar adalah ….', 'enura.png', 0, 'kambing, kucing, kerbau, dan sapi adalah kelompok hewan vivipar', 'Ayam, bebek, angsa, dan kucing adalah kelompok hewan ovipar', 'Buaya, kelelawar, bebek dan nyamuk adalah kelompok hewan ovovivipar', 'Kucing, ayam, bebek dan kambing adalah kelompok hewan vivipar'),
(701, 24, 'Pada siang hari yang cerah rel kereta api pada bagian sembungan rel akan lebih rapat dibandingkan pada malam hari. Hal ini bisa terjadi karena ….', 'enura.png', 0, 'Rel kereta api mengalami pemuaian karena panas sinar matahari', 'Pada siang hari lebih banyak yang melewati rel kereta api', 'Kualitas rel kereta api yang rendah', 'Rel kereta api mengalami penyusutan karena melepaskan panas'),
(702, 24, 'Pisau yang tajam akan lebih mudah digunakan untuk memotong benda dibandingkan dengan pisau yang tumpul, hal ini karena ….', 'enura.png', 0, 'Benda mendapat tekanan yang lebih besar', 'Benda mendapatkan tekanan yang lebih kecil', 'Benda mendapatkan gaya yang lebih besar', 'Benda mendapatkan gaya yang lebih kecil'),
(703, 24, 'Pada saat ini minyak bumi mulai langka sehingga harga minyak bumi sangat tinggi. Oleh karena itu energi alternatif sangat dibutuhkan. Yang termasuk sumber energi yang dapat dijadikan sebagai sumber energi alternatif yaitu ….', 'enura.png', 0, 'Matahari dan gas', 'Gas dan air', 'Air, matahari dan batu bara', 'Air dan matahari'),
(704, 24, 'Negara indonesia terletak pada 3 pertemuan lempeng tektonik, sehingga banyak gunung berapi dan perbukitan, sehingga menyebabkan Indonesia sering terjadi bencana geologi. Berikut ini yang bukan termasuk bencana geologi adalah ….', 'enura.png', 0, 'Angin', 'Gunung meletus', 'Tsunami', 'Gempa bumi'),
(705, 24, 'Pohon dan akar cendana memiliki harum yang alami, sehingga banyak manusia yang memanfaatkan kayu cendana untuk dijadikan kerajinan, parfum fan sabun. Akibatnya adalah populasi pohon cendana akan semakin langka. Cara melestarikan populasi pohon cendana yang benar adalah …', 'enura.png', 0, 'Menanam pohon cendana secara besar-besaran di pegunungan', 'Mengirim kerajinan tangan hasil dari pohon cendana ke luar negeri untuk dijual', 'Menjual kayu cendana dengan harga yang mahal', 'Tetap mengolah kayu cendana agar dapat keuntungan yang banyak untuk manusia'),
(706, 24, 'Kandungan unsur hidrosfer terbesar adalah ….', 'enura.png', 0, 'Hidrogen', 'Karbondioksida', 'Nitrogen', 'Oksigen'),
(707, 24, 'Tumbuhan kaktus mempunyai daun yang kecil dan tebal, daun ini bertujuan untuk...', 'enura.png', 0, 'Mengurangi penguapan air', 'Melindungi diri dari pemangsa', 'Menyimpan cadangan air ketika musim panas', 'Menahan panas dari luar'),
(708, 24, 'cicak dapat menangkap serangga sebagai makanannya menggunakan ...', 'enura.png', 0, 'Lidah yang panjang dan lengket', 'Kaki yang dapat menempel', 'Mulut dan gigi', 'Ekor yang panjang'),
(709, 24, 'Tumbuhan yang berkembang biak secara tak kawin dengan cara rizhoma adalah ....', 'enura.png', 0, 'Lengkuas, jahe, kunyit', 'Jahe, merica, alang-alang', 'Alang-alang, jahe, Lengkuas', 'Lengkuas, kunyit, ketumbar'),
(710, 24, 'Yang termasuk hewan karnivora adalah ….', 'enura.png', 0, 'Harimau, singa, elang', 'Kambing, kucing, anjing', 'Kambing, kerbau, sapi', 'Ayam, gajah, kucing'),
(711, 24, 'Tujuan utama suatu makhluk hidup dalam berkembang biak adalah ….', 'enura.png', 0, 'Untuk melestarikan jenisnya', 'Untuk memperoleh pasangan', 'Untuk melestarikan lingkungannya', 'Untuk memperoleh nutrisi'),
(712, 24, 'Suatu tumbuhan melakukan fotosintesis. Bahan-bahan yang digunakan dalam proses fotosintesis agar dapat berkembang dengan baik adalah ….', 'enura.png', 0, 'Air dan karbondioksida', 'Glukosa dan air', 'Air dan oksigen', 'Glukosa dan karbondioksida'),
(713, 24, 'Bunga yang sempurna adalah yang memiliki ….', 'enura.png', 0, 'Putik dan benang sari', 'Kelopak bunga dan mahkota bunga', 'Putik dan kelopak bunga', 'Benang sari dan mahkota bunga'),
(714, 24, 'Dalam aktivitas mikroorganisme ada yang bersifat menguntungkan manusia dan adapula yang merugikan. Berikut mikroorganisme yang bersifat menguntungkan adalah ….', 'enura.png', 0, 'Singkong rebus berubah menjadi tape', 'Nasi menjadi basi', 'Singkong menjadi busuk', 'Roti berjamur'),
(715, 24, 'Yang termasuk perkembangbiakan secara generatif yaitu. . . .', 'enura.png', 0, 'Pembentukan biji', 'Okulasi', 'Setek', 'Cangkok'),
(716, 24, 'cara yang tepat untuk melindungi hewan langka dan sulit berkembangbiak adalah …', 'enura.png', 0, 'Membuat peraturan untuk melindungi hewan tersebut dari pemburu liar', 'Membangun tempat buatan yang luas', 'Membuat hewan tiruan yang mirip dengan hewan tersebut', 'Dipelihara di tempat khusus dan dikembangkan secara inseminasi'),
(717, 24, 'Tumbuh dan berkembang memiliki pengertian yang berbeda. Pengertian berkembang adalah Perkembangan fisik makhluk hidup secara terus menerus tanpa batas. Pengertian pertumbuhan adalah ….', 'enura.png', 0, 'Perubahan volume tubuh suatu makhluk hidup', 'Perubahan mental yang terjadi secara teratur', 'Proses kedewasaan yang tidak dapat diukur', 'Pertumbuhan ukuran tubuh makhluk hidup yang dapat diukur'),
(718, 24, 'Bunyi dihasilkan dari benda yang bergetar. Benda tersebut dinamakan ...', 'enura.png', 0, 'Sumber bunyi', 'Alat bunyi', 'Rambatan bunyi', 'Pantulan bunyi'),
(719, 24, 'Kemampuan kelelawar mengetahui llingkungan sekitarnya dengan  menggunakan system sonar. Dikenal dengan istilah apakah kemampuan yang dimiliki oleh kelelawar?', 'enura.png', 0, 'Ekolokasi', 'Adaptasi', 'Mimikri', 'Habitat'),
(720, 24, 'Many snakes have to. Can it be used for protect yhenselves from enemies. Can be a toxic substance which can be deadly. Examples of poisonous snakes is ...', 'enura.png', 0, 'Cobra', 'Python', 'Tikusan', 'Sacking'),
(721, 24, 'Domba dan sapi adalah contoh hewan yang memakan tumbuhan. Domba dan sapi memakan dedaunan. Hewan pemakan tumbuhan adalah ...', 'enura.png', 0, 'Herbivora', 'Karnivora', 'Omnivora', 'Klorofil'),
(722, 24, 'Flexible, robust, and finely fibrous is characteristic of the tree ...', 'enura.png', 0, 'Banana', 'Rose apple', 'Bamboo', 'Teak'),
(723, 24, 'Panas api unggun berpindah ke tubuh kita dengan cara ....', 'enura.png', 0, 'Radiasi', 'Reduksi', 'Konveksi', 'Konduksi'),
(724, 25, 'SOAL SD Tingkat 1 Inggrisd', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(725, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(726, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(727, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(728, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(729, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(730, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(731, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(732, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(733, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(734, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(735, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(736, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(737, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(738, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(739, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(740, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(741, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(742, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(743, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(744, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(745, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(746, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(747, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(748, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(749, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(750, 25, 'SOAL SD Tingkat 1 Inggrisdddaaa', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(751, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(752, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(753, 25, 'SOAL SD Tingkat 1 Inggris', 'enura.png', 0, 'benar', 'salah', 'salah', 'salah'),
(754, 26, '1,5 m – 75 cm – 50 mm = ... cm', 'enura.png', 0, '70', '25', '75', '80'),
(755, 26, 'Bentuk desimal bilangan 7/90 adalah ...', 'enura.png', 0, '0,078', '0,075', '0,06', '0,7'),
(756, 26, 'Jika 1 jam 45 menit yang lalu menunjukkan pukul 6.30, maka setelah 2 jam kemudian menunjukkan pukul ...', 'enura.png', 0, '10.15', '09.15', '09.45', '08.15'),
(757, 26, 'Faktor prima dari 650 adalah ...', 'enura.png', 0, '2, 5, dan 13', '2, 7, 11', '2 dan 5', '2, 5, dan 7'),
(758, 26, 'Kecepatan yang diperlukan Bolang untuk menempuh jarak 60 km dengan waktu 4 jam adalah …', 'enura.png', 0, '15 km/jam', '20 km/jam', '25 km/jam', '32 km/jam'),
(759, 26, 'Hasil dari (-24) + 14 – 1 x 5 + 20 = ...', 'enura.png', 0, '5', '30', '75', '-5'),
(760, 26, 'Fizi mempunyai tali sepanjang 3,5 m. Lalu diminta oleh Ehsan 164 cm. Berapa cm panjang sisa tali Fizi?', 'enura.png', 0, '186 cm', '184 cm', '194 cm', '200 cm'),
(761, 26, 'Lampu kuning menyala setiap 2 menit. Lampu biru setiap 3 menit. Kedua lampu akan menyala bersama dalam ... menit', 'enura.png', 0, '6', '3', '2', '12'),
(762, 26, 'Jika 245 kg + 3.050 hg + 1.500.000 cg = n kg, maka nilai n adalah…', 'enura.png', 0, '3265', '3250', '3295', '4010'),
(763, 26, 'Soal 10', '034647_763_10.png', 1, 'C', 'A', 'B', 'D'),
(764, 26, 'Lawan dari -7-12 adalah', 'enura.png', 0, '19', '-19', '-5', '-12'),
(765, 26, 'Sudut lancip ditunjukkan gambar nomor …', '034834_765_12.png', 1, '3', '1', '2', '4'),
(766, 26, 'Jika harga permen 5 biji Rp. 2.000 maka harga 13 biji permen adalah …', 'enura.png', 0, 'Rp. 5.200', 'Rp. 4.400', 'Rp. 3.200', 'Rp. 2.800'),
(767, 26, 'Hasil dari 20 – ( - 13) – 15 : 5 + 5 = …', 'enura.png', 0, '35', '41', '48', '8'),
(768, 26, 'Selisih antara 7,5 ton dengan 64,5 kuintal adalah … kuintal.', 'enura.png', 0, '10,5', '57', '685,5', '63, 97'),
(769, 26, 'Yoga pergi ke toko membeli 7 kg beras, 10 kg gula, 3 kg cabai, dan 2 kg tomat. Ketika Yoga akan membayar, ia membeli 7 kg bawang putih dan 5 kg bawang merah. Berapa kg total belanjaan Yoga seluruhnya?', 'enura.png', 0, '34', '22', '12', '32'),
(770, 26, 'Soal 17', '035446_770_17.png', 1, '132', '112', '121', '122'),
(771, 26, 'Jika 20 x 87 – 570 + 3.500 : 7 = n, maka nilai n adalah …', 'enura.png', 0, '1.670', '630', '830', '1.630'),
(772, 26, 'Bilangan 49 jika ditulis dengan angka Romawi adalah…', 'enura.png', 0, 'XLIX', 'XLXI', 'LXXIX', 'XXXXIX'),
(773, 26, 'Di laci terdapat 10 kaos kaki yang terdiri atas 5 pasang, masing-masing berwarna hitam, putih, biru, cokelat, dan merah. Paling sedikit banyaknya kaos kaki yang harus diambil dari laci tersebut agar diperoleh sepasang kaos kaki berwarna sama adalah . . .', 'enura.png', 0, '6', '7', '10', '12'),
(774, 26, 'Hasil dari pengerjaan 5 tahun + 28 minggu + 3 bulan + 2 windu = …', 'enura.png', 0, '86', '60', '70', '76'),
(775, 26, 'Dari 20 siswa, 14 orang berkacamata, 15 orang berambut lurus, 17 orang berat badannya di atas 30kg, dan 18 orang tingginya lebih dari 120cm. Paling sedikit terdapat . . . siswa yang memiliki keempat sifat tersebut.', 'enura.png', 0, '4 orang', '8 orang', '12 orang', '16 orang'),
(776, 26, 'Sebanyak 72 siswa dibagi menjadi tiga kelompok dengan perbandingan banyaknya anggota 3 : 4 : 5. Banyaknya siswa pada kelompok terkecil adalah . . . orang.', 'enura.png', 0, '18', '16', '32', '22'),
(777, 26, 'Jika harga 3 mobil mainan Rp. 150.000 maka harga 5 mobil mainan adalah ….', 'enura.png', 0, 'Rp. 250.000', 'Rp. 200.000', 'Rp. 150.000', 'Rp. 350.000'),
(778, 26, 'Lawan dari -32+73 adalah …', 'enura.png', 0, '-41', '41', '40', '-39'),
(779, 26, 'Bentuk decimal dari 234% adalah …', 'enura.png', 0, '2,34', '23,4', '0,0234', '0,234'),
(780, 26, 'Jika sekarang pukul 12.12, maka 38 menit lagi pukul …', 'enura.png', 0, '12.50', '12.40', '13.00', '13.10'),
(781, 26, 'Jika empat hari yang lalu hari Jum’at, maka seminggu kemudian adalah hari ….', 'enura.png', 0, 'Selasa', 'senin', 'Rabu', 'Kamis'),
(782, 26, 'Modus nilai ulangan Ajeng adalah …', '040319_782_29.png', 1, '9', '8', '7', '6'),
(783, 26, 'Bilangan 2012 ditulis angka romawi adalah …', 'enura.png', 0, 'MMXII', 'MXII', 'MDDXII', 'MDXII'),
(784, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(785, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(786, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(787, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(788, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(789, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(790, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(791, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(792, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(793, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(794, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(795, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(796, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(797, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(798, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(799, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(800, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(801, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(802, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(803, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(804, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(805, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(806, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(807, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(808, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(809, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(810, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(811, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(812, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(813, 27, 'sd1finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(814, 28, 'burung elang yang sudah tumbuh besar maka bisa …', 'enura.png', 0, 'Terbang', 'Menari', 'Berenang', 'Berjalan'),
(815, 28, 'anak burung merpati yang baru lahir tidak memiliki …', 'enura.png', 0, 'Bulu', 'Kaki', 'Mata', 'Telinga'),
(816, 28, 'tumbuhan padi bisa ditanam menggunakan …', '074304_816_Soal 3.png', 0, 'Bijinya', 'Batangnya', 'Daunnya', 'Akarnya'),
(817, 28, 'tumbuhan yang bisa tumbuh dengan menanam batangnya adalah …', 'enura.png', 0, 'Tebu', 'Pisang', 'Mangga', 'Apel'),
(818, 28, 'biji kedelai akan tumbuh menjadi …', 'enura.png', 0, 'Tempe', 'Padi', 'Kecambah', 'Kacang'),
(819, 28, 'Peralatan berikut ini yang menghasilkan panas adalah ....', 'enura.png', 0, 'Kompor', 'Radio', 'Televisi', 'Komputer'),
(820, 28, 'Piano adalah peralatan yang menghasilkan ....', 'enura.png', 0, 'Bunyi', 'Gerak', 'Panas', 'Dingin'),
(821, 28, 'Dispenser adalah peralatan yang digunakan untuk memanaskan ....', 'enura.png', 0, 'Air', 'Nasi', 'Sayur', 'Ikan'),
(822, 28, 'Benda yang menghasilkan cahaya adalah ....', 'enura.png', 0, 'Lampu', 'Dispenser', 'Setrika', 'Mesin Cuci'),
(823, 28, 'Semua benda yang dapat menghasilkan energi disebut ....', 'enura.png', 0, 'Sumber Energi', 'Sumber Cahaya', 'Sumber Panas', 'Sumber bunyi'),
(824, 28, 'Peralatan berikut yang tidak memanfaatkan energi listrik adalah ....', 'enura.png', 0, 'senter', 'Setrika', 'Televisi', 'Kulkas'),
(825, 28, 'Kegunaan baterai seperti pada gambar biasanya digunakan sebagai sumber energi untuk ....', '020054_825_soal 12.png', 1, 'mobil-mobilan', 'telepon genggam', 'kulkas', 'Televisi'),
(826, 28, 'Kandungan unsur hidrosfer terbesar adalah ….', 'enura.png', 0, 'Bensin', 'Solar', 'Minyak', 'Air'),
(827, 28, 'Energi panas terbesar berasal dari ....', 'enura.png', 0, 'Matahari', 'Minyak Bumi', 'Nyala Api', 'Air'),
(828, 28, 'Sumber energi peralatan seperti pada gambar adalah ....', '021556_828_soal 15.png', 1, 'spiritus', 'minyak tanah', 'Solar', 'Bensin'),
(829, 28, 'Benda di bawah ini yang memanfaatkan energi angin adalah ....', 'enura.png', 0, 'layang-layang', 'sepeda', 'mobil-mobilan', 'Motor'),
(830, 28, 'Tumbuhan membutuhkan energi cahaya untuk ....', 'enura.png', 0, 'memasak makanan', 'Menghasilkan udara', 'Bergerak', 'Bertumbuh'),
(831, 28, 'Mematikan lampu ketika tidur dapat menghemat ....', 'enura.png', 0, 'Listrik', 'Uang', 'Tenaga', 'Waktu'),
(832, 28, 'Penggunaan setrika listrik yang hemat adalah ....', 'enura.png', 0, 'menyetrika baju dalam jumlah banyak', 'menyetrika baju sesering mungkin', 'menyetrika baju setiap hari', 'menyetrika baju setiap satu jam'),
(833, 28, 'Energi panas matahari digunakan petani untuk ....', 'enura.png', 0, 'mengeringkan gabah', 'mencari ikan', 'menanam padi', 'Memanen Padi'),
(834, 28, 'Selain dapat mengeringkan benda, matahari juga dimanfaatkan untuk ....', 'enura.png', 0, 'pembangkit listrik', 'menghasilkan energi bunyi', 'menghasilkan energi gerak', 'menghasilkan energi gelombang'),
(835, 28, 'Nelayan memanfaatkan panas matahari untuk ....', 'enura.png', 0, 'mengeringkan ikan', 'menjual ikan', 'mencari ikan', 'Memancing Ikan'),
(836, 28, 'Kipas angin dapat berputar jika dihubungkan dengan ....', 'enura.png', 0, 'sumber listrik', 'tiang listrik', 'peralatan listrik', 'Kabel Listrik'),
(837, 28, 'Kendaraan bermesin diesel bahan bakarnya ....', 'enura.png', 0, 'Solar', 'Bensin', 'Minyak Tanah', 'Gas'),
(838, 28, 'Minyak bumi harus dihemat karena jumlahnya ....', 'enura.png', 0, 'Terbatas', 'Banyak', 'Sangat banyak', 'Melimpah'),
(839, 28, 'Kentungan adalah alat untuk menghasilkan ....', 'enura.png', 0, 'Bunyi', 'Cahaya', 'Gerak', 'Listrik'),
(840, 28, 'Angin merupakan sumber energi ....', 'enura.png', 0, 'Gerak', 'Panas', 'Cahaya', 'Listrik'),
(841, 28, 'Manusia mendapatkan energi dari ....', 'enura.png', 0, 'Makanan', 'Angin', 'Matahari', 'Tumbuhan'),
(842, 28, 'Matahari adalah sumber energi ....', 'enura.png', 0, 'cahaya dan panas', 'Panas dan gerak', 'gerak dan cahaya', 'listrik dan panas'),
(843, 28, 'Berikut ini kendaraan yang tidak memakai bahan bakar adalah ....', 'enura.png', 0, 'becak', 'kereta api', 'Mobil', 'Motor'),
(844, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(845, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(846, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(847, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(848, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(849, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(850, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(851, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(852, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(853, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(854, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(855, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(856, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(857, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(858, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(859, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(860, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(861, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(862, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(863, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(864, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(865, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(866, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(867, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(868, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(869, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(870, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(871, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(872, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(873, 29, 'sd1finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(874, 30, 'sd2finalinggris', 'enura.png', 0, 'abenar', 'b', 'c', 'd'),
(875, 30, 'sd2finalinggris', 'enura.png', 0, 'aebnar', 'bsalah', 'c', 'dsalah'),
(876, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(877, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(878, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(879, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(880, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(881, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(882, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(883, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(884, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(885, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(886, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(887, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(888, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(889, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(890, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(891, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(892, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(893, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(894, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(895, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(896, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(897, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(898, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(899, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(900, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(901, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(902, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(903, 30, 'sd2finalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(904, 31, 'Kadar alkohol jika 100 ml alkohol dilarutkan ke dalam 200 ml air adalah ...', 'enura.png', 0, '50%', '25 %', '33,33%', '75%'),
(905, 31, 'Planet-planet beredar dalam satu lintasan planet yang disebut orbit yang berbentuk elips. Peredaran planet-planet mengelilingi matahari disebut...', 'enura.png', 0, 'Revolusi bumi', 'Revolusi matahari', 'Revolusi planet', 'Revolusi bulan'),
(906, 31, 'Keluarnya sel telur (ovum) dari indung telur (ovarium) yang tidak dibuahi bersama lapisan dinding rahim yang banyak mengandung pembuluh . . .', 'enura.png', 0, 'Menstruasi', 'Pembuahan', 'Pendarahan', 'Luka dalam'),
(907, 31, 'Klorofil adalah zat warna hijau daun. Klorofil berguna untuk menangkap cahaya matahari. Cahaya matahari digunakan untuk proses pembuatan zat makanan. Secara ilmiah fotosintesis terjadi pada …', 'enura.png', 0, 'Siang hari', 'Malam hari', 'Musim hujan', 'Musim gugur'),
(908, 31, 'Masehi calendar is also called the solar calendar. Masehi, one year is devided into 12 months. Leap year is the year that the number of day 366 days. Determination of masehi is based on the calendar …', 'enura.png', 0, 'Revolution of the earth', 'Earth’s rotation', 'Revolution of the moon', 'Rotation of the moon'),
(909, 31, 'Gas berbahaya yang dihasilkan dari pembakaran tidak sempurna adalah gas karbon monoksida. Penulisan rumus kimia karbon monoksida adalah …', 'enura.png', 0, 'CO', 'C2O', 'CO2', 'CO3'),
(910, 31, 'Apabila kadar pengotor dalam bijih besi adalah 10%. Maka banyak  bijih besi murni dalam 500 gram bijih besi tersebut adalah ...', 'enura.png', 0, '450 gram', '500 gram', '350 gram', '100 gram'),
(911, 31, 'Selama tahun 2010 di Desa Sembalun tercatat bahwa jumlah kelahiran 30 orang, jumlah meninggal 43 orang, pendatang baru 33 orang dan yang berangkat 5 jiwa. Berapa pertumbuhan pendduk desa Sembalun pada tahun 2010?', 'enura.png', 0, '15 orang', '21 orang', '17 orang', '13 orang'),
(912, 31, 'Tumbuhan berguna unutk membersihkan udara yang kotor, sertamengurangi pencemaran udara karena tumbuhan mengandung ...', 'enura.png', 0, 'Oksigen', 'Nitrogen', 'Karbondioksia', 'Karbonmonoksida'),
(913, 31, 'Pada hewan dan tumbuhan terjadi peristiwa makan dan dimakan dengan urutan tertentu. Peristiwa tersebut dinamakan ....', 'enura.png', 0, 'Rantai makanan', 'Urutan makanan', 'Ekosistem', 'Jaringan makanan'),
(914, 31, 'Gaya tekan menyebabkan jungkat-jungkit bergerak, jungkat-jungkit menjadi tidak seimbang karena ada gaya yang berbeda. Gaya tersebut adalah gaya …', 'enura.png', 0, 'Tekan', 'Gesek', 'Dorong', 'Tarik'),
(915, 31, 'Setiap hari kita sering menggunakan berbagai macam benda yang memiliki bentuk, sifat, rasa, dan aroma yang berbeda. Benda-benda tersebut memiliki ciri tersendiri yang dipengaruhi oleh bahan-bahan yang terkandung di dalam benda tersebut, maka benda benda tersebut dapat dikelompokkan ke dalam golongan asam, basa, atau garam. Yang termasuk larutan asam adalah …', 'enura.png', 0, 'Air garam', 'Air sirup', 'Air sabun', 'Air gula'),
(916, 31, 'Sebuah mobil bergerak dengan jarak 10 km pada 5 menit pertama, 10 menit kemudian menempuh jarak 45 km dan 15 menit kemudian mobil itu menempuh jarak 15 km. Kecepatan rata-rata mobil tersebut adalah ...', 'enura.png', 0, '140 km/h', '95 km/h', '35 km/h', '70 km/h'),
(917, 31, 'Setiap makhluk hidup memerlukan makanan atau nutrisi untuk mempertahankan hidupnya. Makanan diperlukan sebagai sumber energy untuk melakukan proses-proses kehidupan. Cara mendapatkan makanan maupun cara makan setiap makhluk hidup berbeda-beda. Tumbuhan dapat membuat makanan sendiri dengan proses …', 'enura.png', 0, 'Fotosistesis', 'Menghisap', 'Memasak', 'Berburu'),
(918, 31, 'Komponen tak hidup berupa benda-benda tak hidup. Sementara itu, komponen hidup meliputi produsen, konsumen, dan pengurai. Hubungan timbal balik antara komponen hidup dan tak hidup disebut …', 'enura.png', 0, 'Ekosistem', 'Habitat', 'Adaptasi', 'Komunitas'),
(919, 31, 'Mobil dari kota A ke kota B melaju selama satu jam. Jarak dari kota C ke D 60 km. Maka kelajuan motor tersebut adalah …', 'enura.png', 0, '3.600.000 m/s', '36.000.000 m/s', '360.000 m/s', '36.000 m/s'),
(920, 31, 'Pembangkit listrik menggunakan sumber energi pengganti seperti air, panas  matahari, dan angin. Pembangkit listrik juga menggunakan bahan bakar fosil. Misalnya, minyak bumi dan batubara. Sumber energi listrik yang dapat diperbarui adalah...', 'enura.png', 0, 'Coal', 'Matahari', 'Air', 'Udara'),
(921, 31, 'Ketika bola dilempar ke atas maka bola tersebut akan jatuh ke bawah. Hal tersebut terjadi karna bola memiliki gaya ...', 'enura.png', 0, 'Gravitasi', 'Magnet', 'Pegas', 'Gesek'),
(922, 31, 'Pelapukan adalah hancurnya batuan dari ukuran besar menjadi batuan yang kecil. Pelapukan disebabkan adanya …', 'enura.png', 0, 'Eksogen', 'Endogen', 'Korosis', 'Erosi'),
(923, 31, 'Benda bening adalah benda yang dapat meneruskan sebagian besar cahaya yang diterimanya. Jadi, air yang jernih termasuk benda bening. Selain benda bening terdapat pula benda yang tidak dapat ditembus cahaya. Benda yang tidak dapat ditembus cahaya tersebut dinamakan benda …', 'enura.png', 0, 'kaca', 'Cahaya', 'Gelap', 'Air'),
(924, 31, 'Dinamika penduduk dipengaruhi oleh berbagai hal antara lain kelahiran, kematian, dan perpindahan penduduk. Apabila lahirnya individu baru bisa disebut juga dengan …', 'enura.png', 0, 'Natalis', 'Emigrasi', 'Mortalitas', 'Imigrasi'),
(925, 31, 'Tata surya yaitu bagian di alam semesta yang sangat luas. Tata surya juga terletak di dalam satu galaksi yang dapat disebut Bimasakti. Galaksi Bimasakti dapat juga disebut ....', 'enura.png', 0, 'Milky way', 'Sky high', 'Sky way', 'Univers'),
(926, 31, 'Berikut yang bukan merupakan bagian dari bunga adalah ...', 'enura.png', 0, 'Tangkai Bunga', 'Kelopak Bunga', 'Putik', 'Benang Sari'),
(927, 31, 'Pada paru-paru terdapat bronkus yang bercabang. Cabang tersebut adalah ...', 'enura.png', 0, 'Bronkiolus', 'Bronkus', 'Alveoli', 'Pleura'),
(928, 31, 'Sprint runners have a speed of 6 m / s. how many distance runners if the journey time 15 second ?', 'enura.png', 0, '90 m', '30 m', '75 m', '45 m'),
(929, 31, 'Sebuah cahaya merambat lurus akan menyebabkan terbentuknya bayangan dari benda yang telah terkena cahaya. Pembentukan cahaya dapat dimanfaatkan untuk membuat kamera. Kamera adalah alat yang dapat digunakan untuk …', 'enura.png', 0, 'Memotret', 'Membuat gambar', 'Mencetak', 'Mengungkit'),
(930, 31, 'Udara yang telah masuk ke rongga hidung dan dapat diteruskan ke batang tenggorokan. Pada batang tenggorokan telah tersusun atas tulang – tulang rawan yang kemudian bercabang dua. Cabang batang tenggorokan tersebut bisa juga disebut ….', 'enura.png', 0, 'Bronkus', 'Bronkiolus', 'Alvelia', 'Pleura'),
(931, 31, 'kemampuan hewan untuk meniru obyek maupun hewan lain agar tidak dikenali pemangsa maupun mangsa mereka disebut juga ...', 'enura.png', 0, 'mimikri', 'Adaptasi', 'Ekosistem', 'Habitat'),
(932, 31, 'berikut yang merupakan benuk morfologi pada hewan yaitu ...', 'enura.png', 0, 'Paruh bebek', 'bunga bangkai', 'Cumi-cumi', 'Daun teratai'),
(933, 31, 'paru-paru memiliki ... bagian', 'enura.png', 0, '4', '1', '2', '3'),
(934, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(935, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(936, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(937, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(938, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(939, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(940, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(941, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(942, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(943, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(944, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(945, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(946, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(947, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(948, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(949, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(950, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(951, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(952, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(953, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(954, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(955, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(956, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(957, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(958, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(959, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(960, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(961, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(962, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(963, 32, 'sd2finalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(964, 33, '(19 x 21) + (9 x 11) = . . . .', 'enura.png', 0, '498', '398', '589', '689'),
(965, 33, 'Jika suatu bilangan habis dibagi 8 dan 14, maka bilangan tersebut habis dibagi ...', 'enura.png', 0, '28', '24', '18', '12'),
(966, 33, 'Jika rata-rata dari 2, 3, x, dan y adalah 5, maka rata-rata dari 4, 5, 6, x, dan y adalah ....', 'enura.png', 0, '6,0', '4,6', '5,6', '5,0'),
(967, 33, '1, 3, 4, 8, 7, 13, 10, ...', 'enura.png', 0, '18', '12', '14', '16'),
(968, 33, 'Jika p < -3 dan q > 5 maka nilai q – p ....', 'enura.png', 0, 'Lebih besar daripada 8', 'Lebih besar daripada 9', 'Lebih besar daripada 2', 'Lebih kecil daripada 8'),
(969, 33, 'Semua nilai xyang memenuhi x< x -2 adalah ....', 'enura.png', 0, '-2 < x < -1', 'x < -1 atau 1 < x > -2', 'x < -2', 'x < -1'),
(970, 33, 'Soal 7', '065234_970_7.png', 1, '10', '4', '6', '22'),
(971, 33, 'Pada ulangan matematika,diketahui nilai rata-rata kelas adalah 58. Jika rata-rata nilai matematika untuk siswa laki-laki 64 dan rata-rata untuk siswa perempuan 56 maka perbandingan banyak siswa laki-laki dan perempuan adalah ....', 'enura.png', 0, '3 : 1', '1 : 3', '3 : 2', '1 : 6'),
(972, 33, 'Tiga kelas A, B dan C berturut-turut terdiri atas 10 siswa, 20 siswa, dan 15 siswa. Rata-rata nilai gabungan dari ketiga kelas 55. Jika rata-rata kelas A dan C berturut-turut 56 dan 65 maka rata-rata nilai kelas B = ...', 'enura.png', 0, '47', '45', '48', '50'),
(973, 33, 'Ani telah mengikuti tes matematika sebanyak n kali. Pada tes berikutnya ia memperoleh nilai 83 sehingga nilai rata-rata Ani adalah 80. Tetapi, jika nilai tes tersebut adalah 67 maka rata-ratanya adalah 76. Nilai n adalah ....', 'enura.png', 0, '3', '2', '4', '5'),
(974, 33, 'Soal 11', '065832_974_11.png', 1, '1', '2', '-1', '-2'),
(975, 33, 'Suku ke- 4 dan ke- 9 suatu barisan aritmetika berturut-turut adalah 110 dan 150. Suku ke-30 barisan aritmatika tersebut adalah ....', 'enura.png', 0, '318', '308', '344', '326'),
(976, 33, 'Soal 13', '070103_976_13.png', 1, '32', '27', '30', '35'),
(977, 33, 'Antara dua suku yang berurutan pada barisan : 3, 18, 33, .... disisipkan 4 buah bilangan sehingga membentuk barisan aritmetika yang baru. Jumlah 7 suku pertama dari barisan yang terbentuk adalah ....', 'enura.png', 0, '84', '78', '81', '87'),
(978, 33, 'Ada 5 orang anak akan foto bersama tiga-tiga ditempat penobatan juara I, II dan III. Jika salah seorang diantaranya harus selalu ada dan selalu menempati tempat juara I maka banyak foto berbeda yang mungkin tercetak adalah ....', 'enura.png', 0, '12', '6', '20', '24'),
(979, 33, 'Dalam sebuah keluarga yang terdiri dari Ayah, ibu, dan 5 orang  anaknya akan makan bersama duduk mengelilingi meja bundar. Jika Ayah dan Ibu dudknya selalu berdampingan maka banyak cara mereka duduk mngelilingi meja bundar tersebut adalah ....', 'enura.png', 0, '240', '120', '720', '1020'),
(980, 33, 'Sebuah kotak berisi 4 bola putih dan 5 bola biru. Dari dalam kotak diambil 3 bola sekaligus, banyak cara pengambilan sedemikian hingga sedikitnya terdapat 2 bola biru adalah ....', 'enura.png', 0, '50 cara', '10 cara', '55 cara', '24 cara'),
(981, 33, 'Dalam kantong terdapat 4 kelereng merah dan 5 kelereng biru. Jika dari kantong diambil dua kelereng sekaligus maka peluang mendapatkan kelereng sau warna merah dan stu warna biru adalah ....', 'enura.png', 0, '5/9', '9/81', '20/81', '4/9'),
(982, 33, 'Diketahui kubus ABCD.EFGH dengan panjang rusuk 10 cm. Jarak titik F ke garis AC adalah ... cm', '070714_982_20.png', 1, 'A', 'B', 'C', 'D'),
(983, 33, 'Seorang peneliti memprediksikan dampak kenaikan harga BBM terhadap kenaikan harga sembako dan kenaikan gaji pegawai negeri. Peluang harga sembako naik adalah 0,92 sedangkan peluang gaji pegawai negeri tidak naik hanya 0,15. Bila prediksi ini benar maka besar peluang gaji pegawai negeri dan harga sembako adalah ....', 'enura.png', 0, '0,78', '0,68', '0,65', '0,75'),
(984, 33, 'Peluang kejadian terpilihnya dua bola merah adalah ....', '071544_984_21.png', 1, '3/20', '3/10', '3/8', '2/5'),
(985, 33, 'Peluang kejadian terpilihnya dua bola putih adalah ...', '071724_985_22.png', 1, '3/8', '3/20', '3/10', '2/5'),
(986, 33, 'Peluang terplihnya satu bola merah dan satu bola putih adalah ...', '071831_986_23.png', 1, '19/40', '1/4', '3/8', '3/10'),
(987, 33, 'Dari angka 1, 2, 3, 4 dan 7 akan dibentuk bilangan yang terdiri atas tiga angka berbeda. Banyak bilangan berbeda yang dapat dibentuk dengan nilai masing-masing kurang dari 400 adalah ....', 'enura.png', 0, '36', '12', '24', '48'),
(988, 33, 'Seorang anak setiap bulan menabung. Pada bulan pertama sebesar Rp. 50.000,00 pada bulan kedua Rp. 55.000,00, pada bulan ketiga Rp. 60.000,00, dan seterusnya. Maka banyaknya tabungan anak tersebut selama dua tahun adalah ....', 'enura.png', 0, 'Rp. 2.580.000', 'Rp.1.315.000,00', 'Rp. 1.320.000,00', 'Rp. 2.640.000'),
(989, 33, 'Panjang rusuk kubus ABCD.EFGH adalah 12 cm. Jika P titik tengah CG maka jarak titik P dengan garis HB adalah ....', '072149_989_25.png', 1, 'D', 'A', 'B', 'C'),
(990, 33, 'Banyak bilangan yang bernilaikurang dari 1000, yang disusun oleh : 1, 2, 3, 4, 5, dan 6 adalah ...', 'enura.png', 0, '216', '120', '156', '258'),
(991, 33, 'Of the 6 men and 4 women selected 3 people consisting of 2 men and 1 woman. The probability of choosing is...', 'enura.png', 0, '60/120', '70/120', '10/120', '36/120'),
(992, 33, 'Diketahui empat bidang beraturan ABCD dengan panjang rusuk 6 cm. Kosinus sudut antara bidang ABC dan bidang ABD adalah ...', '072510_992_29.png', 1, 'B', 'A', 'C', 'D'),
(993, 33, 'Soal 30', '020129_993_Untitled.png', 1, '4', '-4', '8', '-8'),
(994, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(995, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(996, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(997, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(998, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(999, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1000, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1001, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1002, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1003, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1004, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1005, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1006, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1007, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1008, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1009, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1010, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1011, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1012, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1013, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1014, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1015, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1016, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1017, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1018, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1019, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1020, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1021, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1022, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1023, 34, 'smpfinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1024, 35, 'Lintah berbeda dengan Annelida lainnya karena pada lintah tidak dijumpai adanya ....', 'enura.png', 0, 'Parapodia', 'Susunan Saraf', 'Alat peredaran darah', 'Alat ekskresi'),
(1025, 35, 'Organ ekskresi Mollusca berupa ....', 'enura.png', 0, 'Nefridium', 'Hati', 'Ginjal', 'Pembuluh malphigi'),
(1026, 35, 'Hewan porifera belum memiliki ....', 'enura.png', 0, 'A, B dan C benar', 'A dan B benar', 'Sistem saraf', 'Organ pencernaan'),
(1027, 35, 'Hewan Arthopoda yang bukan serangga adalah ...', 'enura.png', 0, 'Lalat buah', 'Undur-undur', 'Lebah madu', 'Rayap'),
(1028, 35, 'Fungsi dari daur biogeokimia adalah ...', 'enura.png', 0, 'Menjaga kelestarian ekosistem', 'Menyediakan unsur mineral bagi konsumen', 'Melakukan reaksi metabolisme karnivor puncak', 'Menjaga kestabilan ekosistem'),
(1029, 35, 'Energi yang ada di dalam tubuh hewan yang diambil oleh predator adalah energi yang ....', 'enura.png', 0, 'Disimpan dalam tubuh', 'Digunakan untuk lari', 'Digunakan untuk bergerak', 'Dikeluarkan dalam bentuk panas tubuh'),
(1030, 35, 'Dibawah ini yang berperan dalam siklus nitrogen, kecuali ....', 'enura.png', 0, 'Acetobacter', 'Nitrobacter', 'Nitrosomonas', 'Clostridium'),
(1031, 35, 'Jaringan epitel yang berfungsi sebagai tempat absorpsi terdapat pada ....', 'enura.png', 0, 'Dinding usus halus', 'Kelenjar keringat', 'Ginjal', 'Lidah'),
(1032, 35, 'Garam mineral yang paling sedikit menyusun jaringan tulang adalah ....', 'enura.png', 0, 'Kalsium fluorida', 'Kalium fosfat', 'Magnesium klorida', 'Kalsium klorida'),
(1033, 35, 'Penyusun darah yang berbentuk cairan disebut ....', 'enura.png', 0, 'Plasma darah', 'Trombosit', 'Eritrosit', 'Leukosit'),
(1034, 35, 'Hubungan antarulang yang terdapat pada tulang tengkorak orang dewasa adalah ...', 'enura.png', 0, 'Sinkondrosis', 'Sinositosis', 'Sinfibrosis', 'Diartrosis'),
(1035, 35, 'Organisme yang berhasil berkembangbiak tanpa melalui proses meiosis adalah ....', 'enura.png', 0, 'Amoeba', 'Belalang', 'Cacing', 'Nyamuk'),
(1036, 35, 'Pada tumbuhan pembelahan reduksi terjadi pada ...', 'enura.png', 0, 'Alat berkembangbiak', 'Ujung Akar', 'Pucuk Batang', 'Lingkaran kambium'),
(1037, 35, 'Apabila terjadi persilangan dihibridyang menghasilkan F2 dengan ratio fenotipe 12 : 3 : 1 hal ini menunjukkan adanya penyimpangan hukum mendel yaitu ...', 'enura.png', 0, 'Epistasis', 'Kriptomeri', 'Interaksi', 'Dominasi'),
(1038, 35, 'Kegagalan fungsi glomerulus pada ginjal dapat menyebabkan timbulnya  penyakit ...', 'enura.png', 0, 'Nefritis', 'Batu ginjal', 'Hematuria', 'Poliuria'),
(1039, 35, 'Individu yang mengalami mutasi disebut ....', 'enura.png', 0, 'Mutan', 'Mutasi', 'Mitosis', 'Mutagen'),
(1040, 35, 'Salah satu hewan yang dijadikan bukti evolusi hewan laut menjadi hewan adarat adalah ...', 'enura.png', 0, 'Katak', 'Paus', 'Kanguru', 'Ikan Mas'),
(1041, 35, 'Gigi peristom akan ditemukan pada ...', 'enura.png', 0, 'Spongarium lumut', 'Spongarium tumbuhan paku', 'Anteridium lumut', 'Protalium tumbuhan paku'),
(1042, 35, 'Pembuluh angkut tidak ditemukan pada ...', 'enura.png', 0, 'Bryophyta', 'Dikotil', 'Monokotil', 'Gymnospermae'),
(1043, 35, 'Dari deretan tumbuhan berikut yang seluruhnya termasuk dalam kelompok gymnospermae adalah ...', 'enura.png', 0, 'Pakis haji, pinus, darma, melinjo', 'Cemara, pinus, damar, pinang', 'Alang-alang, pakis haji, damar, melinjo', 'Pinus, pinang, akis haji, cemara'),
(1044, 35, 'Pada lumut sel telur yang telah dibuahi kelak akan tumbuh menjadi ....', 'enura.png', 0, 'Sporangium', 'Protalium', 'Protonema', 'Arkegonium'),
(1045, 35, 'Berikut ini yang merupakan contoh tanaman dikotil adalah ...', 'enura.png', 0, 'Mangga, apel, kacang panjang', 'Jagung, padi, kelapa', 'Ketela pohon, durian, pinus', 'Lumut daun, kaktus, salak'),
(1046, 35, 'Oksigen merupakan unsur kimia yang terkandung di alam. Dalam ekosistem oksigen diproduksi oleh ...', 'enura.png', 0, 'Tumbuhan', 'Hewan', 'Matahari', 'Atmosfer'),
(1047, 35, 'Minyak bumi dan batu bara merupakan babhan alam yang diperoleh pada ....', 'enura.png', 0, 'Siklus karbon', 'Siklus air', 'Siklus nitrogen', 'Siklus oksigen'),
(1048, 35, 'Jika pertumbuhan populasi melapaui daya dukung lingkungan akan terjadi ...', 'enura.png', 0, 'Kompetisi', 'Populasi terus bertambah', 'Daya dukung lingkungan terus meningkat', 'Terjadi peningkatan keseimbangan'),
(1049, 35, 'Jaringan klorenkim berfungsi untuk ....', 'enura.png', 0, 'Alat pelindung', 'Fotosistesis', 'Alat penyangkutan', 'Penyimpanan cadangan makanan'),
(1050, 35, 'Jaringan meristem primerterdapat di ....', 'enura.png', 0, 'Kambium', 'Kulit biji', 'Kulit buah', 'Ujung buah'),
(1051, 35, 'Lemak tidak dapat larut dalam ....', 'enura.png', 0, 'Air', 'Alkohol Panas', 'Benzena', 'Klorosom'),
(1052, 35, 'In the digestive tract, proteins will be simplified into compounds called . . .', 'enura.png', 0, 'Fatty acid', 'Glucose', 'Vitamin', 'Amino acid'),
(1053, 35, 'Usus duabelas jari, selain merupakan muara saluran dari hati juga dari ...', 'enura.png', 0, 'Kelenjar pankreas', 'Saluran darah', 'Saluran urin', 'Empedu'),
(1054, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1055, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1056, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1057, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1058, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1059, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1060, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1061, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1062, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1063, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1064, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1065, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1066, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1067, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1068, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1069, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1070, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1071, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1072, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1073, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1074, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1075, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1076, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1077, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1078, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1079, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1080, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1081, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1082, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1083, 36, 'smpfinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1084, 37, 'Diketahui x dan y adalah dua bialangan positif. Rata-rata dari jumlah 4,7, 4, dikali y sama dengan rata-rata dari jumlah 6, 8, 4, dikali x. Maka perbandingan x dan y berturut-turut adalah ...', 'enura.png', 0, '5 : 6', '2 : 3', '3 : 4', '6 : 5');
INSERT INTO `soal` (`id`, `id_bidang`, `soal`, `foto`, `status_foto`, `jawaban1`, `jawaban2`, `jawaban3`, `jawaban4`) VALUES
(1085, 37, 'Kopi kualitas I dan kualitas II dicampur dengan perbandingan berat a : b. Harga kopi kualitas I dan kualitas II tiap masing-masing adalah Rp. 16.000,00 dan Rp. 18.000,00. Jika harga kopi kualitas I naik 15% sedangkan kopi kualitas II turun 10%, tetapi harga kopi campuran setiap kg tidak berubah, maka nilai a : b adalah .....', 'enura.png', 0, '9 : 8', '8 : 9', '3 : 4', '4 : 3'),
(1086, 37, 'Dedy dan peserta asuransi dengan besar premi sama. Jika untuk membayar premi gaji dedy sebesar Rp. 1.500.000 dipotong 3%, dan gaji Ambar dipotong 5%, maka gaji Ambar adalah ...', 'enura.png', 0, 'Rp. 900.000', 'Rp. 950.000', 'Rp. 975.000', 'Rp. 990.000'),
(1087, 37, 'Iqbal mendapat nialai 81 untuk IPA. Nilai 89 untuk IPS. Nilai 78 untuk bahasa Indonesia. Dan nilai 86 untuk matematika. Bila Iqbal ingin mendapatkan rata-rata nilainya sebesar 84. Maka berapakah nilai yang harus diperolah untuk pelajaran Bahasa Inggris?', 'enura.png', 0, '86', '85', '88', '84'),
(1088, 37, 'Lima tahun yang lalu usia Karin adalah 2/3 dari usianya sekarang, sepuluh ahun yang akan datang perbandingan usia Fifi dan Karin adalah 4 : 5. Berapakah usia Fifi pada 7 tahun yang akan datang ....', 'enura.png', 0, '17 tahun', '15 tahun', '25 tahun', '27 tahun'),
(1089, 37, 'Bilangan berikut ini habis dibagi oleh 11, yaitu ...', 'enura.png', 0, '135806', '135966', '127804', '133701'),
(1090, 37, 'Jika x adalah 37,5% dari 80 dan y adalah 135 dari jumlah angka 1 s.d. 10, maka hubungan antara x dengan y adalah ....', 'enura.png', 0, 'x > y', 'x = y', 'x < y', 'Hubungan x dan y tidak dapat ditentukan'),
(1091, 37, 'Jika sebuah tiang setinggi 98 m membentuk bayangan setinggi 42 m, berapakah panjangbayangan untuk tiang setinggi 35 m pada saat yang sama?', 'enura.png', 0, '15 m', '5 m', '10 m', '20 m'),
(1092, 37, 'Soal 9', '073448_1092_9.png', 1, '2', '3', '-2', '-3'),
(1093, 37, 'Seri huruf : h m i n j', 'enura.png', 0, 'o, k', 'l, p', 'p, r', 'm, k'),
(1094, 37, 'Jika Eko bisa membaca 2 halaman koran tiap x menit. Maka dalam 7 menit Eko mampu membaca berapa halaman ?', 'enura.png', 0, '14/x', '14/2x', '7/x', '7/2x'),
(1095, 37, 'Manakah angka yang paling kecil?', '073801_1095_12.png', 1, 'D', 'A', 'B', 'C'),
(1096, 37, '1, 4, 10, 19 .....', 'enura.png', 0, '31', '31', '29', '28'),
(1097, 37, 'Berapakah jumlah dari 1 – 2 + 3 – 4 + 5 – 6 + .... + 99 – 100?', 'enura.png', 0, '-50', '-51', '-52', '-53'),
(1098, 37, 'Kia mudik lebaran dengan naik sepeda motor  menempuh jarak 240 km. Pada 1/3 perjalanan awal kecepatan rata-rata motornya adalah 50 km/jam. Setelah itu ia meningkatkan kecepatan rata-rata motornya sebesar 60%. Jika ia berangkat pukul 06.30 maka Kia akan sampai ke tempat tujuan pada pukul ....', 'enura.png', 0, '10.06', '09.30', '10.12', '11.18'),
(1099, 37, 'Harga sebuah laptop diberikan diskon 40% lalu dikenai pajak 30%. Maka harga laptop tersebut menjadi ..... % harga semula.', 'enura.png', 0, '0,58', '0,62', '0,6', '0,7'),
(1100, 37, 'Bang andre memiliki 200 buku di lemarinya. 30% dari buku-buku tersebut adalah tentang science. 20% science adalah buku matematika. Banyaknya buku matematika dinyatakan dalampersen total adalah ...', 'enura.png', 0, '6%', '12%', '25%', '50%'),
(1101, 37, 'Jika x = 0,08% dari 2,54 dan y = 2,54% dari 0,08, manakah pernyataan yang benar?', 'enura.png', 0, 'x = y', 'x > y', 'x < y', '2x < y'),
(1102, 37, 'smafinalmatematika', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1103, 37, 'jika tinggi tabung X adalah dua kali tinggi tabung Y, sedangkan jari-jari X adalah setengah dari tabung Y. Maka perbandingan isi tabung X terhadap Y adalah ...', 'enura.png', 0, '2 : 1', '1 : 2', '1 : 4', '1 : 8'),
(1104, 37, 'Semua mahasiswa Perguruan Tinggi memiliki nomor induk ahasiswa. Andi seorang mahasiswa. Jadi .....', 'enura.png', 0, 'Andi memiliki nomor induk mahasiswa', 'Andi mungkin memiliki nomor induk mahasiswa', 'Belum tentu Andi memiliki nomor induk mahasiswa', 'Andi tidak memiliki nomor induk mahasiswa'),
(1105, 37, 'Soal 22', '074521_1105_22.png', 1, '0', '1', '2', '4'),
(1106, 37, 'Sebuah survei sampling melaporkan bahwa dalam 1000 kelahiran bayi, 4 diantaranya meninggal. Di kota A terjadi kelahiran bayi sejumlah 750 pada tahun ini. Berapakah jumlah peluang bayi yang tidak meninggal jika didasarkan pada survei tersebut ?', 'enura.png', 0, '720', '700', '710', '740'),
(1107, 37, 'Oki memasukkan kardus kecil yang berukuran 6 cm x 5 cm x 75 mm ke dalam kotak besar berukuran 42 cm x 24 cm x 63 cm. Berapa jumlah kardus kecil yang dapatdimasukkan ke dalam kotak tersebut ?', 'enura.png', 0, '282', '300', '282,4', '283'),
(1108, 37, 'Diketahui panjang sisi-sisi sebuha segitiga sama sisi adalah 3 cm dan di dalamnya dibuat segitiga sama sisi yang panjangnya 1 cm. Berapa jumlah maksimum segitiga kecil yang dibentuk ?', 'enura.png', 0, '9', '3', '8', '12'),
(1109, 37, 'Dua buahkubus panjangnya berselisih 4 cm dan luas permukaannya berselisih 288 cm3. Panjang rusuk yang terpanjang adalah ...', 'enura.png', 0, '8', '7', '5', '6'),
(1110, 37, 'Dalam sebuah kotak terdapat 200 kelereng yang terdiri dari kelereng kecil dan kelereng besar. Ada 130 kelereng berwarna hijau, 35 diantaranya adalah kelereng besar, jumlah kelereng besar dalam kotak tersebut ada 75 buah. Berapakah jujmlah kelereng kecil yangtidak berwarna hijau?', 'enura.png', 0, '30', '35', '40', '45'),
(1111, 37, 'Seorangagen koran telah berhasil menjual 168 buah koran dari 154 lusin koran yang tersedia. Persentase koran yang tersedia adalah ....', 'enura.png', 0, '0,88%', '0,85%', '91,1%', '90,1%'),
(1112, 37, 'A cylindrical vessel contains 1/3 of the water. If you add another 3 liters of water, this vessel becomes of it. How many liters is the capacity of the vessel?', 'enura.png', 0, '18', '15', '24', '27'),
(1113, 37, 'smafinalmatematika', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1114, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1115, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1116, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1117, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1118, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1119, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1120, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1121, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1122, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1123, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1124, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1125, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1126, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1127, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1128, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1129, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1130, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1131, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1132, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1133, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1134, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1135, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1136, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1137, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1138, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1139, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1140, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1141, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1142, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1143, 38, 'smafinalinggris', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1144, 39, 'Sel sarah yang berfungsi mengirimkan impuls dari sistem saraf pusat ke otot dan kelenjar adalah ....', 'enura.png', 0, 'Neuron eferen', 'Neuron intermedier', 'Neuron afaren', 'Neuron sensori'),
(1145, 39, 'Peristiwa yang menunjukkan bahwa bagian ujung tubuh hewan berdiferensiasi menjadi kepala adalah ....', 'enura.png', 0, 'Sefalisasi bagian tubuh', 'Pembentukan selom', 'Segmentasi anterior', 'Pembentukan jaringan syaraf'),
(1146, 39, 'Yang BUKAN termasuk fungsi hipotalamus adalah ....', 'enura.png', 0, 'Mengontrol refleks mata', 'Mengontrol suhu tubuh', 'Mengatur metabolisme lemak', 'Mengontrol nafsu makan'),
(1147, 39, 'Kayu pinus disusun terutama oleh sel-sel yang apnjang dengan ujung runcing,mempunyai noktah yang berfungsi untuk mengangkut air dari akar ke daun. Sel-sel yang dimaksud adalah ....', 'enura.png', 0, 'Trakeid', 'Trakea', 'Sklereid', 'Sklerenkim'),
(1148, 39, 'Jaringan dasar tumbuhan yang berfungsi memperkuat jaringan lain dan dapat diubah menjadi merismatis adalah ...', 'enura.png', 0, 'Parenkim', 'Kambium', 'Mesenkim', 'Sklerenkim'),
(1149, 39, 'Peristiwa apoptosis pada memendeknya ekor berudu katak terjadi karena aktivitas dari ....', 'enura.png', 0, 'Lisosom', 'Mitokondria', 'Nukleolus', 'Ribosom'),
(1150, 39, 'Untuk membiakkan virus, kultur yang paling sesuai adalah ....', 'enura.png', 0, 'Embrio ayam hidup', 'Kaldu steril', 'Embrio tikus', 'Medium agar'),
(1151, 39, 'Yang dimaksud dengan bakteriofag adalah virus yang menyerang ....', 'enura.png', 0, 'Bakteri', 'Hewan', 'Manusia', 'Hewan dan manusia'),
(1152, 39, 'Aliran darah yang bergerak paling lambat terjadi pada ....', 'enura.png', 0, 'Kapiler', 'Aorta', 'Arteriol', 'Venula'),
(1153, 39, 'Kesamaan antara tumbuhan lumut dan tumbuhan paku adalah ...', 'enura.png', 0, 'Metagenesis', 'Kormofita sejati', 'Rizoid pada sporofit', 'Struktur gametofit'),
(1154, 39, 'Jenis daun tumbuhan paku yang berperan khusus untuk melanjutkan keturunan dari generasi ke generasi adalah ....', 'enura.png', 0, 'Sporofil', 'Mikrofil', 'Makrofil', 'Tropofil'),
(1155, 39, 'Tumbuhan lumut yang sehari-hari tampak berwarna hijau adalah bagian ....', 'enura.png', 0, 'Gametofit', 'Sporofit', 'Protonema', 'Protalium'),
(1156, 39, 'Ditinjau dari spora yang dihasilkannya, paku rame (selaginella) tergolongan paku yang ....', 'enura.png', 0, 'Heterosper', 'Homosper', 'Isosper', 'Makrospor'),
(1157, 39, 'Untuk melakukan klasifikasi hewan invertrebrata, perlu diperhatikan hal-hal berikut, kecuali ....', 'enura.png', 0, 'Segmentasi tubuh', 'Rangka luar', 'Simetri tubuh', 'Warna eksoskeleton'),
(1158, 39, 'Ferilisasi antara makrogamet dan mikrogamet plasmodium penyebab malaria berlansng dalam ....', 'enura.png', 0, 'Lambung nyamuk', 'Kelenjar ludah nyamuk', 'Sel hati manusia', 'Eritrosit manusia'),
(1159, 39, 'Parasit berikut ini yang hidup dalam plasma darah adalah ....', 'enura.png', 0, 'Trynasoma', 'Plasmodium', 'Taenia', 'Fasciola'),
(1160, 39, 'Kelas berikut yang salah satu anggotanya secara teoritis dapat menambah oksigen terlarut di habitatnya adalah ...', 'enura.png', 0, 'Mastigophora', 'Rhizopoda', 'Calcarea', 'Sporozoa'),
(1161, 39, 'Cacing tambang masuk ke dalam tubuh manusia dalam bentuk ...', 'enura.png', 0, 'Larva', 'Metaserkaria', 'Telur', 'Serkaria'),
(1162, 39, 'Gerakan air dari lingkungan luar melintasi selaput biji untuk keperluan perkecambahan disebut ....', 'enura.png', 0, 'Imbisisi', 'Difusi', 'Osmosis', 'Plasmolisis'),
(1163, 39, 'Daun kaktus yang tereduksi seperti duri-duri merupakan suatu bentuk penyesuaian terhadap lingkungan hidup di daerah gurun. Pendapat tersebut sejalan dengan yang dikemukakan oleh ....', 'enura.png', 0, 'Darwin', 'Morgan', 'Lamark', 'Wallace'),
(1164, 39, 'Kelompok tumbuhan sejenis yang hidup di sebidang sawah, berdasarkan konsep ekologi merupakan suatu ....', 'enura.png', 0, 'Populasi', 'Ekosistem', 'Komunitas', 'Spesies endemik'),
(1165, 39, 'Cloning masih merupakan kontroversi antara berencana dan keberhasilan dalam bidang bioteknologi. Cloning manusia meupakan rekayasa genetika yang dilakukan pada tingkat ...', 'enura.png', 0, 'Sel', 'Organ', 'Jaringan', 'Sistem organ'),
(1166, 39, 'Persentasi laki-laki buta warna di Indonesia sekitas 7%. Persentasi wanita carier dan buta warna adalah ...', 'enura.png', 0, '13,02% dan 0,49%', '0,07% dan 0,7%', '13,02% dan 49%', '93% dan 7%'),
(1167, 39, 'Penyusun matriks berupa garam mineral pada jaringan tulang yang benar ditunjukkan oleh nomor ....', '020955_1167_24.png', 1, '1, 3 dan 5', '1, 2 dan 3', '1, 2 dan 4', '2, 3 dan 5'),
(1168, 39, 'Organel yang memiliki ribosom dan dianggap mirip dengan prokariotik sel tunggal adalah ....', 'enura.png', 0, 'Mitokondria', 'Nukleus', 'Lisosom', 'Badan golgi'),
(1169, 39, 'Sel merupakan unit fungsional da struktural terkecil dari sistem organisasi makhluk hidup. Sel sebagai unit struktural memiliki makna bahwa ....', 'enura.png', 0, 'Setiap makhluk hidup terdiri atas sel-sel', 'Semua fungsi kehidupan berlangsung didalam sel', 'Sel-sel makhluk hidup bervariasi', 'Sel terlihat dengan panca indra'),
(1170, 39, 'Pernyataan beikut ini yang benar adalah ...', 'enura.png', 0, 'Serabut xilem dan sklereid mempunyai penebalan sekunder', 'Semua tumbuhan berbiji tidak mempunyai trakea dan trakeid', 'Xilem yang berbentuk dari prokambium merupakan xilem sekunder', 'Xilem yang berbentuk dari prokambium merupakan xilem primer'),
(1171, 39, 'Epidermis dan endodermis merupakan jaringan pelindung yang mempunyai persamaan ...', 'enura.png', 0, 'Biasanya terdiri dari selapis sel saja', 'Dinding selnya mengandung lilin', 'Sel-sel waktu dewasa mati', 'Bentul sel sama'),
(1172, 39, 'Tumbuhan gramineae memiliki sel epidermis yang berbentuk ....', 'enura.png', 0, 'Terombak dan poliginal', 'Memanjang dan tidak beraturan', 'Tipis, tebal dan mengandung lignin', 'Panjang dan pendek berganti-ganti'),
(1173, 39, 'The following organisms belong to the class of mammals, which live in water, except ...', 'enura.png', 0, 'Seahorses', 'Porpoise', 'Pause', 'Dolphins'),
(1174, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1175, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1176, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1177, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1178, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1179, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1180, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1181, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1182, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1183, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1184, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1185, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1186, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1187, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1188, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1189, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1190, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1191, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1192, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1193, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1194, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1195, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1196, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1197, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1198, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1199, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1200, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1201, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1202, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1203, 40, 'smafinalips', 'enura.png', 0, 'a', 'b', 'c', 'd'),
(1204, 41, '20 x ( 80 : 5 ) – ( 16 + 9) = n, n adalah', 'enura.png', 0, '295', '313', '327', '345'),
(1205, 41, 'Ani membeli 4 keranjang buahmangga. Tiap keranjang berisi 15 buah. Ternyata setelah dibuka ada 8 bauh mangga yang busuk.Kemudian Ani memebeli lagi 25 buah mangga. Jadi, buah mangga Ani yang masih segar sekarang ada .. buah.', 'enura.png', 0, '77', '52', '85', '93'),
(1206, 41, 'Hasil pengerjaan dari 2.876 + 390 : 26 = ....', 'enura.png', 0, '2801', '3221', '1223', '1245'),
(1207, 41, 'Di warung serba ada tersedia 17karung gula pasir masing-masing berisi 95kg. Hari ini warung serba ada menerima kiriman gula seberat 125 kg, berat gula di warung serba ada sekarang adalah ....', 'enura.png', 0, '1615', '665', '245', '1610'),
(1208, 41, 'Soal 5', '060040_1208_5.png', 1, 'A', 'B', 'C', 'D'),
(1209, 41, 'Ibu memepunyaipersediaan 3 3/4  liter minyak goreng, kemudiian membeli lagi 1,25 liter. Minyak tersebut digunakan untuk keperluan memasak 1 3/5 liter. Persediaan minyak goreng ibu sekarang adalah ....', 'enura.png', 0, '3,4', '5,0', '6,6', '8,4'),
(1210, 41, 'Jarak kota Solo dan kota Semarang 140 km. Kota tersebut digambar dengan skala 1 : 700.000, maka jarak kedua kota pada peta adalah ....', 'enura.png', 0, '5 cm', '50 cm', '500 cm', '5000 cm'),
(1211, 41, 'Umur ayah 48 tahun dan umuribu 40 taun. Perbandingan umur ayah dan ibu adalah ...', 'enura.png', 0, '6 : 5', '5 : 6', '3 : 2', '5 : 4'),
(1212, 41, 'KPK dari 28 da 36 adalah', '060459_1212_9.png', 1, 'B', 'A', 'C', 'D'),
(1213, 41, 'Soal 10', '060619_1213_10.png', 1, '192', '8', '64', '320'),
(1214, 41, 'Tanpa harus mengalikan 25 x 84, Brendan menghitung 100 x 84. Dari hasil ini, apa yang dapat ia lakukan untuk memperoleh jawaban yang benar?', 'enura.png', 0, 'Membaginya dengan 4', 'Mengalikannya dengan 4', 'Menguranginya dengan 1/4', 'Menambahkannyadengan 5'),
(1215, 41, 'Sebuah mobil berjalan pada kecepatan 80 kilometer per jam. Seberapa jauhkah perjalanannya dalam waktu 75 menit?', 'enura.png', 0, '60 km', '80 km', '100 km', '120 km'),
(1216, 41, 'Soal 13', '060911_1216_13.png', 1, '30', '3', '9', '90'),
(1217, 41, 'Kecepatan rata-rata motor yang dikndarai oleh Yantoadalah 72 km/jam. Jika Yanto harus menempuh jarak 216 km, maka lama perjalanan Yanto adalah .....', 'enura.png', 0, '3 jam', '60 menit', '30 menit', '4 jam'),
(1218, 41, 'Hasan bekerja di sebuah perusahaan memperoleh upah kotor dalam sebulan Rp.800.000,00 dengan pajak penghasilan 18%. Upah bersih yang diterima Hasan dalam satu tahun adalah ...', 'enura.png', 0, 'Rp.7.872.000', 'Rp.8.727.000', 'Rp.11.200.000', 'Rp.7.200.000'),
(1219, 41, 'Jika 4 ekor kucing menangkap 4 ekor tikus dalam waktu 6 menit, maka jumlah tikus yang dapat ditangkap oleh 20 ekor kucing dalam waktu 30 menit adalah...', 'enura.png', 0, '100 tikus', '75 tikus', '85 tikus', '95 tikus'),
(1220, 41, 'Tiga buah tangki masing-masing berisi solar 6,70 m3, 4.250 liter, dan 6.050 dm3. Jumlah solar di ketiga tangki itu adalah ...', 'enura.png', 0, '13.000 liter', '45.200 liter', '17.050 liter', '12.350 liter'),
(1221, 41, 'FPB dab KPK dari bilangan 18, 32, dan 48 adalah ...', 'enura.png', 0, '6 dan 288', '8 dan 288', '9 dan 288', '7 dan 288'),
(1222, 41, 'Denah sebuah kebun yang berskala 1 : 1.000 panjangnya 3,5 cm dan lebarnya 2,2 cm. luas kebun sebenarnya adalah ...', 'enura.png', 0, '770 m2', '470 m2', '570 m2', '670 m2'),
(1223, 41, 'Nilai rata-rata Bahasa Indonesia siswa kelas 3 adalah 7,5 sedangkan siswa kelas 4 adalah 8. Banyaknya siswa kelas 3 adalah 30 orang, sedangkan kelas 4 adalah 31 orang. Jika siswa kelas 3 dan 4 digabungkan maka tentukan berapa nilai rata-rata Bahasa Indonesia mereka?', 'enura.png', 0, '7,8', '7,5', '7,6', '7,7'),
(1224, 41, 'Suhu udara di sebuah perkampungan sekarang 340C, karena cuaca yang kurang baik, maka setiap jam suhu udara di perkampungan tersebut turun 90C. Berapa derajat Celcius suhu udara 4 jam kemudian?', 'enura.png', 0, '-2°', '-1°', '0°', '1°'),
(1225, 41, 'Arif membeli 2 sepatu olahraga dan 3 sandal, harga semuanya Rp. 254.000,00. Di toko yang sama, Satya akan membeli 4 sepatu olahraga dan 6 sandal. Berapa rupiah uang yang harus dikeluarkan Satya untuk membayar barang tersebut?', 'enura.png', 0, 'Rp. 508.000', 'Rp. 254.000', 'Rp. 760.000', 'Rp. 502.000'),
(1226, 41, 'Jumlah dua bilangan prima adalah 12.345. hasil kali kedua bilangan tersebut adalah ...', 'enura.png', 0, '24.686', '24.668', '26.486', '28.342'),
(1227, 41, 'Umur Rudi 9 tahun 11 bulan 21 hari, sedangkan umur Andi 12 tahun 3 bulan 14 hari. Jumlah umur Rudi dan Andi adalah ...', 'enura.png', 0, '21 tahun 3 bulan 5 hari', '22 tahun 3 bulan 5 hari', '22 tahun 2 bulan 5 hari', '21 tahun 3 bulan 6 hari'),
(1228, 41, 'Bak mandi yangvolumenya 522 liter dalamkeadaan kosong akan diisi air menggunakan pompa hingga penuh dalam waktu 18 menit. Debit air yang dihasilkan pompa air ... liter/menit', 'enura.png', 0, '29', '26', '27', '28'),
(1229, 41, 'Bu Yayan mempunyai tanaman tomat, cabai rawit, wortel di ladangnya. Ia memetik cabai rawit setiap 6 hari, tomat 5 hari, dan wortel 9 hari. Jika ia sekarang memetik bersamaan,ia akan memetik bersamaan lagi setelag ... bulan.', 'enura.png', 0, '2', '1', '3', '4'),
(1230, 41, 'Sinta membeli 5 ½ kg gula, 17 ons tepung terigu dan 600 gram bumbu masak. Berat seluruh belanjaan sinta adalah ... ons', 'enura.png', 0, '222', '325', '455', '285'),
(1231, 41, 'Bilangan 2.457 jika ditulis ke dalam bilangan Romawi adalah ...', 'enura.png', 0, 'MMCDLVII', 'MCMXLIII', 'MMCLVII', 'MMMDVII'),
(1232, 41, 'If two dice are rolled 36 times, what is the probability of getting a dice? unlock 7 is...', 'enura.png', 0, '6 times', '8 times', '10 times', '12 times'),
(1233, 41, 'Akuarium Pak Musa berbentuk kubus. Jika volume akuarium tersebut 6.859 cm 3 , maka panjang rusuknya adalah ... cm.', 'enura.png', 0, '19', '12', '13', '17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_final`
--

CREATE TABLE `status_final` (
  `id` int(11) NOT NULL,
  `status_final` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_final`
--

INSERT INTO `status_final` (`id`, `status_final`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE `tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tag` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_tag` varchar(252) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_tag` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_transaksi` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_transaksi` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_transaksi` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_dapur` tinyint(1) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelamin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `nomorhp` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sekolah` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkatan` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_bayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profil` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasmtk` tinyint(1) NOT NULL,
  `hasipa` tinyint(1) NOT NULL,
  `hasbing` tinyint(1) NOT NULL,
  `hasips` tinyint(1) NOT NULL,
  `statmtk` tinyint(1) DEFAULT NULL,
  `statipa` tinyint(1) DEFAULT NULL,
  `statbing` tinyint(1) DEFAULT NULL,
  `statips` tinyint(1) DEFAULT NULL,
  `nilaimtk` int(11) DEFAULT NULL,
  `nilaiipa` int(11) DEFAULT NULL,
  `nilaibing` int(11) DEFAULT NULL,
  `nilaiips` int(11) DEFAULT NULL,
  `timermtk` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeripa` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timerbing` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timerips` char(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasverif` tinyint(1) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `kelamin`, `tempat`, `date`, `nomorhp`, `sekolah`, `alamat`, `tingkatan`, `kota`, `provinsi`, `bukti_bayar`, `foto_profil`, `hasmtk`, `hasipa`, `hasbing`, `hasips`, `statmtk`, `statipa`, `statbing`, `statips`, `nilaimtk`, `nilaiipa`, `nilaibing`, `nilaiips`, `timermtk`, `timeripa`, `timerbing`, `timerips`, `hasverif`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'admin@admin.com', '$2y$10$YS0WwZ8jMAIU8Rqnf8ZaSufoW9O6VBee0k7sviwK.pEGTBPaEFTk.', 'Admin', 'Laki-laki', 'Jeneponto2', '2021-09-21', '0812152512222', 'SMP INTEGRAL AR-ROHMAH', 'Puncak Permata Sengkaling R.9\r\nSemanding Sumbersekar Dau', 'admin', 'Malang', 'Lampung', 'bayar_admin@admin.com_images (3).jpeg', 'profil_admin@admin.com_comingsoon.png', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 'DqzYitp2Y6Eel8t4Pw8J59n9qah2h4gL2GK1SeVqBDGBgC8xjeJahCNa92TL', '2021-09-03 15:48:34', '2021-09-03 15:48:34'),
(1003, 'keyna.naima@gmail.com', '$2y$10$aIBxwvShLU6GloaN0I/PY.CrDZrhzIk.QE6qEVKK6GSy7GfFR6ihm', 'Keyna Naima Subekti', 'Perempuan', 'Bekasi', '2009-07-22', '082122882804', 'SMP Islam Al Azhar 8 Kemang Pratama', 'Dukuh Bima Jl. Bima Buana XI No. 50 RT.004/009 Lambang Sari Tambun Bekasi Jawa Barat', 'smp', 'Bekasi', 'Jawa Barat', 'bayar_keyna.naima@gmail.com_bukti bayar.jpeg', 'profil_keyna.naima@gmail.com_Foto_Keyna.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 125, 0, 0, NULL, '17Menit 23Detik', NULL, NULL, 1, NULL, NULL, '2021-09-28 01:16:36', '2021-09-28 01:16:36'),
(1005, 'pangestudimas106@gmail.com', '$2y$10$5kwJWV7UZ62KRIoKyzVL.OAYK6DsbaFufepwzLzL1DDPeL8ydgrpu', 'Dimas Ananda Pangestu', 'Laki-laki', 'Magelang', '2005-03-03', '0859138896598', 'SMA NEGERI 1 BANDONGAN', 'Dusun Salam 2 RT 04 RW 02 Desa Salamkanci Kecamatan Bandongan Kabupaten Magelang Jawa Tengah', 'sma', 'Kabupaten Magelang', 'Jawa Tengah', 'bayar_pangestudimas106@gmail.com_Screenshot_2021-09-30-19-58-01-750_id.co.bri.brimo.jpg', 'profil_pangestudimas106@gmail.com_IMG_20210930_195952.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 45, 0, 0, NULL, '50Menit 36Detik', NULL, NULL, 1, NULL, NULL, '2021-09-30 06:02:53', '2021-09-30 06:02:53'),
(1008, 'azrilleshea@gmail.com', '$2y$10$fP3.BFgRj12JzOtrHitBU.1zgcAcGHjKgLgNQxG2v6139tFRmZBba', 'AZRIELLE SHEA SEVERIANO MOHAMMAD', 'Laki-laki', 'Surabaya', '2007-06-25', '+62 878-5154-8176', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari No. 17 Dau Malang', 'smp', 'Malang', 'Jawa Timur', '', 'profil_azrilleshea@gmail.com_IMG-20211005-WA0005.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, '3Menit 55Detik', NULL, NULL, 1, NULL, 'NvSHLP43MYIAysv1VlO3zwTSocbXoPA5VeMrtoLtJ8MMEFHs7WPHdQbkXhnf', '2021-10-05 04:21:20', '2021-10-05 04:21:20'),
(1011, 'aqilaputrahamzah@gmail.com', '$2y$10$Kwl5rptrJzKZPwH.y/8f8eqY0VIxUuChswBO9miXMe3wkP79oOdqa', 'Aqila Putra Hamzah', 'Laki-laki', 'Bali', '2009-05-20', '087861468987', 'SMP INTEGRAL AR - ROHMAH', 'Jl. Locari No.17', 'smp', 'Malang', 'Jawa Timur', '', 'profil_aqilaputrahamzah@gmail.com_molecule2.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 70, 0, 0, NULL, '31Menit 34Detik', NULL, NULL, 1, NULL, 'ksu9p16BNNGSvDobw2IBfuTGRxLAZF0D9yfy1MfwJUYIDezo7mDQPwPo1BTU', '2021-10-06 19:42:41', '2021-10-06 19:42:41'),
(1017, 'alifluqmannurrosyid@gmail.com', '$2y$10$gjUkytI5NkaKZE2PfenBzuOel/f8QxmulM5AmgNSOsFx6ygpPbLs6', 'Alif Luqman Nur Rosyid', 'Laki-laki', 'Jember', '2009-03-04', '081230044989', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari 17', 'smp', 'Malang', 'Jawa Timur', 'bayar_alifluqmannurrosyid@gmail.com_16340095634646218502599373770859.jpg', 'profil_alifluqmannurrosyid@gmail.com_16340095910451133885942865815985.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 65, 55, 0, 0, '24Menit 27Detik', '37Menit 37Detik', NULL, NULL, 1, NULL, 'GYV7BdCELw0hJ7q6TlhLSRt6EMswqYT0U5zFpAsDL4hxPbyOWgD1ZxAXFkLy', '2021-10-11 20:33:33', '2021-10-11 20:33:33'),
(1025, 'etykyunita@gmail.com', '$2y$10$1XEju6jI58QUortdIcS35u3MyngGd9fmksF8Q3EoDdA7z.xi7Unqq', 'Ghassan Ashfi Al Habibi', 'Laki-laki', 'Pematangsiantar', '2012-12-05', '085227960655', 'SDIT Kaffah Islamic School Jakarta', 'Jl Rawamangun Utara III No. 234 B1, Rawasari, Cempaka Putih, Jakarta Pusat', 'sd1', 'Jakarta Pusat', 'DKI Jakarta', 'bayar_etykyunita@gmail.com_WhatsApp Image 2021-10-17 at 14.28.34.jpeg', 'profil_etykyunita@gmail.com_Ghassan baju Biru.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 135, 0, 0, 0, '19Menit 44Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-10-17 06:41:14', '2021-10-17 06:41:14'),
(1026, 'naufalrazan@gmail.com', '$2y$10$ID62eCcmDLrTdElKcYMmAenPIDCiMTsvZEfDumlEgbqADuFxAuOSW', 'Naufal Razan Andrianto', 'Laki-laki', 'Tulungagung', '2008-10-27', '081334392582', 'SMP INTEGRAL AR-ROHMAH', 'Jln. Locari 17', 'smp', 'Malang', 'Jawa Timur', 'bayar_naufalrazan@gmail.com_16345269200514476430898052100646.jpg', 'profil_naufalrazan@gmail.com_16345269389881151402369146561315.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 45, 25, 0, 0, '54Menit 8Detik', '47Menit 25Detik', NULL, NULL, 1, NULL, NULL, '2021-10-17 20:15:54', '2021-10-17 20:15:54'),
(1027, 'alishayudap@gmail.com', '$2y$10$c3JHvRtw.RGpNQsN3EM13Ou.in.L1ddEzP.sN3KAT1X.G7nQOD9qy', 'Alisha Yuda Paramitha', 'Perempuan', 'Yogyakarta', '2008-12-26', '081329158008', 'SMP MUHAMMADIYAH 3 YOGYAKARTA', 'Jl. Kapten Piere Tendean No.19, Wirobrajan, Kota Yogyakarta, Daerah Istimewa Yogyakarta', 'smp', 'Yogyakarta', 'DI Yogyakarta', 'bayar_alishayudap@gmail.com_41D591D3-C747-42DF-8777-D736F505AE2A.jpeg', 'profil_alishayudap@gmail.com_9A63D4E2-2E56-41F5-92F0-2D76F5034738.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 105, 0, 0, 0, '1Menit 16Detik', NULL, NULL, NULL, 1, NULL, '6fR6zr3EDNDf6AFtoqPyz8IM3WSoxChiVcFlQ5n0NXeYSxphBeRMIQnNg0xF', '2021-10-18 21:11:03', '2021-10-18 21:11:03'),
(1028, 'arbynovridok@gmail.com', '$2y$10$qJnhQJIdQkRg3vJskQQpn.PxZzt2f30veJQmJCphZrlgVY1h37mgi', 'Arby Novrido Kharibaldi', 'Laki-laki', 'Bandung. jawa barat', '2010-07-17', '087730304171', 'SDPN 037 Sabang', 'Jl Bungursari 5 no 72(depan no27) rt 07 rw 05 kelurahan pasirlayung. Cibeunying kidul. Bandung. Jawa Barat', 'sd2', 'Bandung', 'Jawa Barat', 'bayar_arbynovridok@gmail.com_IMG_20211021_105815.jpg', 'profil_arbynovridok@gmail.com_1635320822111.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 105, 0, 0, 0, '12Menit 58Detik', NULL, NULL, NULL, 1, NULL, 'wAx5WkKAJ3qMzLlnedqlkKPTDB8Pw9x9x0bUYdqMgsR3WVeasfL5brXbKjAW', '2021-10-20 21:36:48', '2021-10-20 21:36:48'),
(1029, 'noorindah.sarasati@gmail.com', '$2y$10$/952ql.SHIIBRxFCxXfshO9R2LNmF0RsnoqsrTszchdO0mA4cNR3O', 'Fahel syamsadukhan Akbar', 'Laki-laki', 'Surabaya', '2008-02-04', '085697974030', 'SMP INTEGRAL AR-ROHMAH', 'Jln.merpati5 Blok N-5', 'smp', 'Malang', 'Jawa Timur', '', 'profil_noorindah.sarasati@gmail.com_16348703431326306337968731995329.jpg', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-10-21 19:39:30', '2021-10-21 19:39:30'),
(1030, 'feriyusuf837@gmail.com', '$2y$10$UyMY6Xz0ZVf1YTvYIuxpQ.ydE13E3qN4cMEV4QCsfeyQGXv1Gk42u', 'Feri Afandi', 'Laki-laki', '17 Juni 2009', '2009-06-17', '085895202360', 'SMP NEGERI 1 PANDAAN', 'Dsn Klagen DS. Sebani Kec. Pandaan Pasuruan', 'smp', 'Pasuruan', 'Jawa Timur', 'bayar_feriyusuf837@gmail.com_IMG-20211024-WA0000.jpg', 'profil_feriyusuf837@gmail.com_IMG_20210913_221733_242.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 80, 0, 0, 0, '11Menit 30Detik', NULL, NULL, NULL, 1, NULL, 'rVzOFpPIhmnjYYkRKBcNtdnnTs1ZP9IZU2sexHRQN1hpjPm10TdjdPbuc3hb', '2021-10-24 02:16:23', '2021-10-24 02:16:23'),
(1032, 'nidiayasmeen@gmail.com', '$2y$10$89iz/CQUeyzxz6gtPDhh.OADnWT42v4k3tw2o6.rkkBGwU5FwL/Ee', 'NIDIA YASMEEN', 'Perempuan', 'BANDA ACEH', '2008-03-31', '08975370400', 'SMPN 2 REMBANG', 'JL. P. Sedolaut Gang Magersari I no. 3 Kutoharjo Kec. REMBANG', 'smp', 'REMBANG', 'Jawa Tengah', 'bayar_nidiayasmeen@gmail.com_Bukti Pendaftaran RE-SCIENCE.jpg', 'profil_nidiayasmeen@gmail.com_Scan Foto Nidia Yasmeen.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '23Menit 7Detik', NULL, NULL, 1, NULL, NULL, '2021-10-26 02:13:03', '2021-10-26 02:13:03'),
(1040, 'arkanantapraditya.nugroho@gmail.com', '$2y$10$z6uix9OAmMnYjj5OfdaJWudgpqfpE/wuy9NViCHH6mp1UJ3nBqmKq', 'Arkananta Praditya Nugroho', 'Laki-laki', 'Surabaya', '2011-10-04', '08123018769', 'SD Patra Dharma 1 Balikpapan', 'Jl. Klamono, Muara Rapak, Kec. Balikpapan Utara, Kota Balikpapan, Kalimantan Timur 76124', 'sd2', 'Balikpapan', 'Kalimantan Timur', 'bayar_arkanantapraditya.nugroho@gmail.com_EAF5B914-D212-4FAA-BBC1-D9439A582371.png', 'profil_arkanantapraditya.nugroho@gmail.com_E1663C14-DC35-4E75-9194-1D65A20C90C2.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '33Menit 22Detik', NULL, NULL, 1, NULL, NULL, '2021-10-29 20:20:30', '2021-10-29 20:20:30'),
(1041, 'shaffa.safiane@alharaki.sch.id', '$2y$10$J7LknRnJAaYqBk.7a6GK5.4n6i8AdAG6UmqjhlKBORw1JTtQpqGuG', 'Shaffa Aliya Safiane', 'Perempuan', 'Tegal', '2011-09-04', '085774908851', 'SDIT Al Haraki', 'Jl. H. Karim 2 no 39, rt 4 rw 5, tirtajaya, sukmajaya, depok, jawa barat', 'sd2', 'Depok', 'Jawa Barat', 'bayar_shaffa.safiane@alharaki.sch.id_FT213102S12N.jpg', 'profil_shaffa.safiane@alharaki.sch.id_20211016_113340.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, 0, '10Menit 23Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-06 03:46:07', '2021-11-06 03:46:07'),
(1043, 'bagasputraso@gmail.com', '$2y$10$ArHudjDhz5lvFf95/n9bNOaobETd8qLN8/rur8uFGKWO5ZiFAcdqy', 'MUHAMMAD BAGAS PUTRASON PRADANA', 'Laki-laki', 'PASURUAN', '2009-06-30', '081335931980', 'MINU MIFTAHUL HUDA PECALUKAN', 'Jalan Kedok Ombo Krajan Tengah Pecalukan', 'sd2', 'PASURUAN', 'Jawa Timur', 'bayar_bagasputraso@gmail.com_WhatsApp Image 2021-11-08 at 00.33.16.jpeg', 'profil_bagasputraso@gmail.com_IMG20211009113840.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, 0, '33Menit 50Detik', NULL, NULL, NULL, 1, NULL, 'al8P8PLfYkLHNwf52TZB9eznD5pWhJx1GyMu8Rl9LWFohObnrVT5LMTB3oJV', '2021-11-07 10:35:49', '2021-11-07 10:35:49'),
(1044, 'irwansyahm679@gmail.com', '$2y$10$mxjI7S0D2C6FKGtzWpDoSumXNukcmgNOaCTT5Xvv5p0.ifHJpBHA2', 'MUHAMMAD IRWANSYAH', 'Laki-laki', 'PASURUAN', '2009-07-18', '085816660782', 'MINU MIFTAHUL HUDA PECALUKAN', 'Jalan Kedok Ombo Krajan Tengah Pecalukan', 'sd2', 'PASURUAN', 'Jawa Timur', 'bayar_irwansyahm679@gmail.com_WhatsApp Image 2021-11-08 at 00.33.16.jpeg', 'profil_irwansyahm679@gmail.com_WhatsApp Image 2021-10-11 at 08.58.18.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 105, 0, 0, NULL, '52Menit 27Detik', NULL, NULL, 1, NULL, '92qZX6rTDHDkEQXbsjJ2QHDqKKd1S3K6LxZbH0LoP4TPcPJ15LIJpH30n5nc', '2021-11-07 10:40:25', '2021-11-07 10:40:25'),
(1045, 'sheihandwisaputra@gmail.com', '$2y$10$IxJyk95Tdo2CC67Hp3ECLeoyoF.whGgTejnybUjqviIxMt/5e560.', 'SHEIHAN DWI SATRIYA YUDISTIRA', 'Laki-laki', 'PASURUAN', '2009-06-20', '081320205574 / 082333179670', 'MINU MIFTAHUL HUDA PECALUKAN', 'Jalan Kedok Ombo Krajan Tengah Pecalukan', 'sd2', 'PASURUAN', 'Jawa Timur', 'bayar_sheihandwisaputra@gmail.com_WhatsApp Image 2021-11-08 at 00.33.16.jpeg', 'profil_sheihandwisaputra@gmail.com_WhatsApp Image 2021-10-09 at 08.21.09.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, NULL, '47Menit 58Detik', NULL, NULL, 1, NULL, NULL, '2021-11-07 10:45:12', '2021-11-07 10:45:12'),
(1046, 'ahmadazmil567@gmail.com', '$2y$10$kiULQtMtrO9eGqqymLrdKehWmEl5OwEIy9JmIeYMQ7/VsoMcz2rRy', 'AHMAD AZMIL ILMI HAMZAH', 'Laki-laki', 'PASURUAN', '2012-05-04', '085895232515', 'MINU MIFTAHUL HUDA PECALUKAN', 'Jalan Kedok Ombo Krajan Tengah Pecalukan', 'sd2', 'PASURUAN', 'Jawa Timur', 'bayar_ahmadazmil567@gmail.com_WhatsApp Image 2021-11-08 at 00.33.16.jpeg', 'profil_ahmadazmil567@gmail.com_WhatsApp Image 2021-10-08 at 21.15.15.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 65, 0, 0, NULL, '44Menit 57Detik', NULL, NULL, 1, NULL, NULL, '2021-11-07 10:48:19', '2021-11-07 10:48:19'),
(1047, 'gelyashakilla@rescience.com', '$2y$10$CbcQ8oJEcOEhv9u2JWLlFOOiIjCHgKkTfjj9bUyMH0vUnXjY9asYy', 'Gelya Shakilla Keani', 'Perempuan', 'Jakarta', '2013-08-13', '081996003434', 'SDIT EXISS ABATA', 'Gg.delima putih no.4 RT.004/01 larangan utara kota tangerang 15154', 'sd1', 'Kota Tangerang', 'Banten', 'bayar_gelyashakilla@rescience.com_Screenshot_20211108-084544_BCA mobile.jpg', 'profil_gelyashakilla@rescience.com_Screenshot_20211108-085136.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 130, 0, 0, 0, '38Menit 34Detik', NULL, NULL, NULL, 1, NULL, 'QuV0GqMa5WyzHMcjxiuimlmXtGyRC1KGTQsEsxMGnHUCWNIk2y5lNJUSVtb0', '2021-11-07 18:52:44', '2021-11-07 18:52:44'),
(1050, 'caemdiva165@gmail.com', '$2y$10$1rK5zw2mfo2YqjOgyXkTHOsKvRWGO7WVga.khkZ9yBEeR1QyBA6B6', 'Diva Putri Arsanti', 'Perempuan', 'Lamongan', '2008-07-18', '082257168370', 'MTSN 1 lamongan', 'Jl. Raya Plaosan babat Lamongan', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_caemdiva165@gmail.com_IMG-20211111-WA0000.jpg', 'profil_caemdiva165@gmail.com_IMG20211111051525.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '11Menit 6Detik', NULL, NULL, 1, NULL, 'ZGWnhRq9EDHZzjN0p7D4hhzu0Eca3Ff2w4ciHLKpBHdteFtPvDEd02mBVzEh', '2021-11-10 16:19:32', '2021-11-10 16:19:32'),
(1051, 'zhalif13@gmail.com', '$2y$10$Wg03AGMtg1PcCGcuYr4GDeOz5x8hUl6YqmsAZMTL63w/YI1KM7Ut2', 'Rukyatul Khisti Nur Islmi', 'Perempuan', 'Banyuwangi', '2006-08-21', '083854456033', 'MTs N 8 Banyuwangi', 'Dsn. Wadung pal RT 09/ RW 04. Desa Tulungrejo. Kec Glenmore. Banyuwangi. Jawa Timur', 'smp', 'Banyuwangi', 'Jawa Timur', 'bayar_zhalif13@gmail.com_IMG-20211111-WA0000.jpg', 'profil_zhalif13@gmail.com_20211106_075203.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 105, 0, 0, NULL, '14Menit 56Detik', NULL, NULL, 1, NULL, NULL, '2021-11-10 16:58:54', '2021-11-10 16:58:54'),
(1052, 'deliameriska04@gmail.com', '$2y$10$1wOT4jvDG9DMXu3teWFisevZ3iA2GCS.W.hAVq80FR1jo/IkEyW/C', 'AURYN FLOWRENCIA PRAWIRA', 'Perempuan', 'Rejang Lebong', '2012-10-15', '085381522010', 'SD KRISTEN PELITA', 'Jln. DR. Sutomo No 5 Pasar De', 'sd1', 'Rejang Lebong/ Curup', 'bengkulu', 'bayar_deliameriska04@gmail.com_650A4C2E-B241-4966-BEF1-134A561108C0.jpeg', 'profil_deliameriska04@gmail.com_39899D93-4E13-4887-9848-22197FF39674.jpeg', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-11-10 17:40:43', '2021-11-10 17:40:43'),
(1053, 'sherenwang1@gmail.com', '$2y$10$.24qQGXBz9irKNl5WhYcFOBW6CtmetT.NK6qyy4RisU2yC4m3x9n.', 'SHEREN WANG', 'Perempuan', 'Rejang Lebong', '2014-04-16', '081222228282', 'SD KRISTEN PELITA', 'Jln. Dr. Sutomo No 5 Pasar De', 'sd1', 'Rejang Lebong/Curup', 'Bengkulu', 'bayar_sherenwang1@gmail.com_FD987FCC-3133-422C-8D86-4AA0D3140947.jpeg', 'profil_sherenwang1@gmail.com_5C3716B7-9816-4A67-BE92-9418CA214F76.jpeg', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-11-10 17:53:37', '2021-11-10 17:53:37'),
(1054, 'kaylaadrien@gmail.com', '$2y$10$7j/jdW43iGadFoPQtImhYenxRGFab6P13Mt1URgvcNOXPjSePxU9C', 'Kayla Adrien Rezfan Mosyadharma Jusuf Prihatna', 'Perempuan', 'Bandung', '2010-02-08', '08122172885', 'SDN 196 Sukarasa Bandung', 'KPAD Gegerkalong jln. Pak Gatot IV no. 54 RT 03/RW 02 Kel. Gegerkalong, Kec. Sukasari', 'sd2', 'Bandung', 'Jawa Barat', 'bayar_kaylaadrien@gmail.com_Screenshot_20211111_075344.jpg', 'profil_kaylaadrien@gmail.com_IMG20210620133014.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, 0, '32Menit 18Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-10 18:04:08', '2021-11-10 18:04:08'),
(1055, 'vatrawigorocalvino@gmail.com', '$2y$10$Gfwb6ucqXik6AVRn5SQ14.d7TdCUMgUsHyMC9Xg8uMOJukuJh9oJC', 'CALVINO VATRA WIGORO', 'Laki-laki', 'Rejang Lebong', '2013-08-03', '08117323088', 'SD KRISTEN PELITA', 'Jln. Dr. Sutomo 5 Pasar De', 'sd1', 'Rejang Lebong/ Curup', 'Bengkulu', 'bayar_vatrawigorocalvino@gmail.com_FE541477-0AF8-4EA6-9D69-BD704DF7C867.jpeg', 'profil_vatrawigorocalvino@gmail.com_A49C59BC-B556-4956-A66F-98F6115B9616.jpeg', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-11-10 18:10:05', '2021-11-10 18:10:05'),
(1056, 'carolinekenjo@gmail.com', '$2y$10$WjTcGHYqWueqJmlY4sQxcOa1hZDJofkZPGKtVSLTs1hCkFN4l3t0m', 'Caroline Patricia Siahaan', 'Perempuan', 'Bekasi', '2008-01-18', '+62 813-1932-7421', 'SMPN 123 JAKARTA UTARA', 'Gg.baru no 31 kelurahan Cakung timur Kecamatan Cakung Rt/Rw 001/012', 'smp', 'JAKARTA TIMUR', 'DKI Jakarta', 'bayar_carolinekenjo@gmail.com_Screenshot_20211111-081345_Samsung Internet.jpg', 'profil_carolinekenjo@gmail.com_20211111_081453.png', 1, 1, 0, 0, 1, 1, 0, 0, 90, 90, 0, 0, '30Menit 44Detik', '20Menit 21Detik', NULL, NULL, 1, NULL, 'V0vkkvRRWizjfvQkwMzbPrYYNkZmLFRJ3oEFs3BDkpJU8D594KP9j44O8Xer', '2021-11-10 18:15:11', '2021-11-10 18:15:11'),
(1057, 'vatrawigorovianca@gmail.com', '$2y$10$cmHLVwzTzRsjnR3OVfZWpOYJSNInYmsk1mGUHTqblGkzDYn1i5yPq', 'VIANCA VATRA WIGORO', 'Perempuan', 'Rejang Lebong', '2015-04-15', '08117323088', 'SD KRISTEN PELITA', 'Jln. Dr. Sutomo No 5 Pasar De', 'sd1', 'Rejang Lebong/ Curup', 'Bengkulu', 'bayar_vatrawigorovianca@gmail.com_C4394241-2951-401C-92C6-69E1F5F405AF.jpeg', 'profil_vatrawigorovianca@gmail.com_12ED2002-8278-4507-A99A-11C90B81A073.jpeg', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-11-10 18:16:20', '2021-11-10 18:16:20'),
(1058, 'MahestaRahmaArdhani@gmail.com', '$2y$10$mvnRPry.KdyFdlEfmfjDDeAQ6s.SEKfI3lOgTg45AY0957T3oUjBm', 'Mahesta Rahma Ardhani', 'Perempuan', 'Lamongan', '2008-10-16', '085749846285', 'MTSN 1 lamongan', 'Jl.raya Plaosan babat', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_MahestaRahmaArdhani@gmail.com_IMG-20211111-WA0004.jpg', 'profil_MahestaRahmaArdhani@gmail.com_IMG20211111060437.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 85, 0, 0, 0, '37Menit 8Detik', NULL, NULL, NULL, 1, NULL, 'GZSlhubLCdiNUwblcgurZNDBLe5yXtn9DmkecbENN93EKNYHJH2cEIA83vhV', '2021-11-10 19:17:46', '2021-11-10 19:17:46'),
(1059, 'FhelyziaAngelika@gmail.com', '$2y$10$KUZB3qGYmVofjc7eeRcYS.lf2DXr/Jc7PJFTSEGZa4f2Tos.OQfmy', 'Fhelyzia Angelika Simanjorang', 'Perempuan', 'Bandung', '2010-02-16', '081322235153', 'SDN 043 CIMUNCANG', 'JL.Sukalaksana Rt.05 Rw.11 No.141 Kel,Cicaheum Kec,Kiaracondong,Kota Bandung,Jawa Barat', 'sd2', 'Bandung', 'Jawa Barat', 'bayar_FhelyziaAngelika@gmail.com_Screenshot_20211111-094210_BRImo.jpg', 'profil_FhelyziaAngelika@gmail.com_Screenshot_20211111-094929_Gallery.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '43Menit 10Detik', NULL, NULL, 1, NULL, 'ZDZ7dDTbYM8DLig9bWREKGsMzdZWsSECLy3LZ72X92egw3KcRj1SMJwYCbEk', '2021-11-10 19:50:41', '2021-11-10 19:50:41'),
(1061, 'faustinaevelyn21@gmail.com', '$2y$10$wkJCTH29v.wDSq7UDaaOTuuJ68bs6lifG5sq9iqxCEFXuQ8dMyq6C', 'EVELYN FAUSTINA', 'Perempuan', 'Curup', '2013-02-26', '081289221486', 'SD KRISTEN PELITA', 'Jln. Dr. Sutomo no 5 Pasar De', 'sd1', 'Rejang Lebong/ Curup', 'Bengkulu', 'bayar_faustinaevelyn21@gmail.com_BAB8CB3E-AA1A-4B83-B406-29E5031C2C31.jpeg', 'profil_faustinaevelyn21@gmail.com_E3C26639-129E-4053-9ECA-51D16D430AA9.jpeg', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-11-10 20:36:45', '2021-11-10 20:36:45'),
(1062, 'nabilarivany@gmail.com', '$2y$10$r9XUT6J1byiObC3ZedgS..DSjGs1JHqiqzSUBd8HnrS9fmx7XAXlG', 'NABILA FACHRANA AULIA RIVANY', 'Perempuan', 'TUBAN', '2007-10-17', '089660599031', 'MTsN 1 Lamongan', 'Jl. Raya Plaosan - Babat No.11, Plaosan, Kec. Babat, Kabupaten Lamongan, Jawa Timur 62271', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_nabilarivany@gmail.com_Screenshot_2021-11-11-11-31-04-41.jpg', 'profil_nabilarivany@gmail.com_jpg_20211111_110155_0000.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 80, 0, 0, NULL, '11Menit 39Detik', NULL, NULL, 1, NULL, '53gEzBc6EpVxnOXUbJe2KKN5wxmBdWUDddrvplBooXf6HeoCxRfdxA4pE7cL', '2021-11-10 21:34:02', '2021-11-10 21:34:02'),
(1063, 'ningsihnurma01@gmail.com', '$2y$10$roghMeuRW3Nk4xxCsY.llejOpQ8VqUGJxkF95eWYFPQFEcfW3aBXG', 'RASYA ADIANSYAH', 'Laki-laki', 'BATAM', '2010-11-30', '081266188521', 'SDS RADMILA BATAM', 'Perumahan Marina view blok G4 no 9.', 'sd2', 'BATAM', 'Kep. Riau', 'bayar_ningsihnurma01@gmail.com_IMG_20211111_101436.jpg', 'profil_ningsihnurma01@gmail.com_IMG_20211106_144648.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 90, 95, 0, 0, '4Menit 47Detik', '40Menit 26Detik', NULL, NULL, 1, NULL, NULL, '2021-11-10 21:37:06', '2021-11-10 21:37:06'),
(1064, 'arthacell435@gmail.com', '$2y$10$SNI6urqgG86sB.tDAY5OAObkcejfIL13p0U3ujxzxShbYC73LPZ9m', 'Nadhifa Artha Al-akbar', 'Perempuan', 'Bojonegoro', '2008-12-06', '085232930416', 'MTSN 1 lamongan', 'Jl raya Plaosan babat', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_arthacell435@gmail.com_IMG-20211111-WA0009.jpg', 'profil_arthacell435@gmail.com_IMG20211111120708.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, 0, '31Menit 5Detik', NULL, NULL, NULL, 1, NULL, 'BHJD2PPj18OadxKb9DRinmyM7Z47Qc3Sf5EUW3ogfqXQOpL7WNaKArxlGK53', '2021-11-10 22:16:31', '2021-11-10 22:16:31'),
(1065, 'ahmadwafi@rescience.com', '$2y$10$Nw3hekNfx.dbIaHcjYlUpODCElmi.LAXFWD.992yUA7NYcMQKJrdi', 'Ahmad wafi', 'Laki-laki', 'Situbondo', '2009-01-29', '081335751790', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', 'bayar_ahmadwafi@rescience.com_16366090139505211084682855877199.jpg', 'profil_ahmadwafi@rescience.com_16366089959556131876571799149378.jpg', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-11-10 22:37:38', '2021-11-10 22:37:38'),
(1067, 'aisyahsalsabila211@gmail.com', '$2y$10$dlDSOIourt5OPP6YCCZBVebYDQe/kNLk8imfsh4VFCql7x0xS9fVG', 'Aisyah Salsabila', 'Perempuan', 'Lamongan', '2008-08-02', '081330687440', 'MTSN 1 lamongan', 'Jln raya Plaosan babat', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_aisyahsalsabila211@gmail.com_IMG-20211111-WA0013.jpg', 'profil_aisyahsalsabila211@gmail.com_IMG20211111060648.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 'dGUD8X56f9Yad84suAoxqAqd0FIG1GWrmDMoaOw3eQxWCkwE20aQYXKkBDVg', '2021-11-10 22:48:52', '2021-11-10 22:48:52'),
(1068, 'ardiatha@rescience.com', '$2y$10$VAQPNYm5Y6T0AldoJ.zywuTHknNiQx.dKfqDTHnAdqlRYWrog6bBu', 'Ardiatha Dwialwan Faadiansyah', 'Laki-laki', 'Tulungagung', '2009-01-14', '082141374374', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_ardiatha@rescience.com_16366102890681814481468518078581.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, '32Menit 43Detik', NULL, NULL, 1, NULL, NULL, '2021-11-10 22:58:41', '2021-11-10 22:58:41'),
(1069, 'zakiraditya@rescience.com', '$2y$10$d9P8zLGUSASBZ72GQHBNLOqqlZqoPEnBmg3LOgaTtM2.hSWSFJPrO', 'Zaki Raditya Lil Firdaus', 'Laki-laki', 'Tulungagung', '2007-11-30', '081335147070', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_zakiraditya@rescience.com_16366104691895712756485536751971.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, NULL, '43Menit 17Detik', NULL, NULL, 1, NULL, NULL, '2021-11-10 23:02:53', '2021-11-10 23:02:53'),
(1070, 'raialfath@rescience.com', '$2y$10$m/psJFUwwBiJRvvUKq8PIOHpvow4d9l5vaFeJOGxl.pS.Y6EA0tVG', 'Raialfath Candramukti Yusfandrik', 'Laki-laki', 'Kediri', '2008-10-11', '082333979599', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_raialfath@rescience.com_163661075202357817755707174964.jpg', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-11-10 23:06:18', '2021-11-10 23:06:18'),
(1073, 'wildanfirdaus@resciemce.com', '$2y$10$7kp44vJrwCeGByS/m0lkder4076tqatG9fnUf04Z1FslGKrMYSqNC', 'Wildan Firdaus Dzaky Amrizal', 'Laki-laki', 'Malang', '2008-12-04', '08534127303', 'SMP INTEGRAL AR-ROHMAH', 'Jl watu damar 15 rt 14 rw 03 girimoyo karangploso', 'smp', 'Malang', 'Jawa Timur', 'bayar_wildanfirdaus@resciemce.com_Screenshot_2021-11-11-09-51-12-93_d5ccbdb81597ed2d3af10faf3da0ff76.jpg', 'profil_wildanfirdaus@resciemce.com_16366113294297096923938670015228.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, NULL, '59Menit 40Detik', NULL, NULL, 1, NULL, 'D9LoIhQchhY0XccZ5rZQYGFncZyoBDkpFf2fofhDPvSzb98jmsZNs1lOc7mC', '2021-11-10 23:16:04', '2021-11-10 23:16:04'),
(1074, 'joseshabra@rescience.com', '$2y$10$AtoFyghoERQgCEFJj80hJehplBWLP0Ld/W1da63E.X5G3tkW3KfaS', 'Jose Shabra Shatilla Rajawani', 'Laki-laki', 'Malang', '2009-04-01', '08563619191', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', 'bayar_joseshabra@rescience.com_Screenshot_2021-11-11-09-51-12-93_d5ccbdb81597ed2d3af10faf3da0ff76.jpg', 'profil_joseshabra@rescience.com_1636611541418615913004871711355.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, NULL, '32Menit 4Detik', NULL, NULL, 1, NULL, 'OLqqkCCyC5qH1An8MdQ5i55intHI8Mk2fqOiM8uKwCfKhC3uCIqjVqICf67R', '2021-11-10 23:19:27', '2021-11-10 23:19:27'),
(1075, 'uthfia5629@gmail.com', '$2y$10$PSov5mQpmSTitDvvyr/nHeVJBZkX2ZX3IexWWJkKMWcFBN/8gFsOm', 'Uthfia irfanil fahima', 'Perempuan', 'Lamongan', '2009-06-05', '081232404739', 'MTSN 1 lamongan', 'Jln raya Plaosan babat', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_uthfia5629@gmail.com_IMG-20211111-WA0015.jpg', 'profil_uthfia5629@gmail.com_IMG20211111135640.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 80, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 'G6eH08Odx2vsWtoCPrYN58i0iQEjKAqLW9h4uJRsk4OsP1grDPjGALoiYW0o', '2021-11-11 00:01:07', '2021-11-11 00:01:07'),
(1076, 'ajioscar@rescience.com', '$2y$10$PJF3Q2NApmg57lERudwqnuoneVJaLk3Vf6/2DSddnCkSpErs5TUwm', 'Aji Oscar Ibrahim', 'Laki-laki', 'Lampung', '2009-05-11', '085384270212', 'SMP INTEGRAL AR - ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_ajioscar@rescience.com_IMG-20211208-WA0001.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 30, 0, 0, NULL, '47Menit 56Detik', NULL, NULL, 1, NULL, 'HQqkDKTuJEw97dYdnpVSnxETMZzeaEwggmqR1KWe3Tz1Ux6Y5dTMfclNN2UK', '2021-11-11 00:28:54', '2021-11-11 00:28:54'),
(1078, 'fakhriazhar@rescience.com', '$2y$10$L2fP44WyrsqBLYjyYDmlLepl1/oWMU15aFA9RRESnQ3OJPs9UaTfi', 'Muhammad Fakhri azhar', 'Laki-laki', 'Gresik', '2008-12-27', '081336676148', 'SMP INTEGRAL AR - ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_fakhriazhar@rescience.com_Koala.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 60, 0, 0, 0, '36Menit 54Detik', NULL, NULL, NULL, 1, NULL, 'PwJvZlcxC1tL4hov9y8rw9oj03FfSxXEvxCYUhb8a7qc0mhI3u0lEWAxQKgM', '2021-11-11 00:33:54', '2021-11-11 00:33:54'),
(1079, 'noerhafizh@rescience.com', '$2y$10$YDgZWvhQkygzNOZBIJo.nOH.15HBHIERIUmESkgdRUN1lIOzBfx7O', 'Noer Hafizh Dirgantara', 'Laki-laki', 'Situbondo', '2008-12-25', '081215256008', 'SMP INTEGRAL AR - ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_noerhafizh@rescience.com_Koala.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 50, 0, 0, NULL, '36Menit 42Detik', NULL, NULL, 1, NULL, NULL, '2021-11-11 00:35:56', '2021-11-11 00:35:56'),
(1080, 'rajaevwilfi@rescience.com', '$2y$10$u405qJCrHpOp704FTQnQDOpAhky99rfLX9AFQtre58tiykAJAMLSq', 'Rajaev Wilfi Talib', 'Laki-laki', 'Malang', '2009-03-16', '085290027571', 'SMP INTEGRAL AR - ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_rajaevwilfi@rescience.com_Koala.jpg', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 'gazlgTJz2YymlYL7xYK5ux102XiHhD3JaGslzIhN74YZGHmyCOa5VOlLtFxT', '2021-11-11 00:38:35', '2021-11-11 00:38:35'),
(1081, 'rivaldoputra@rescience.com', '$2y$10$1V9MRoRQrXTKJoVyyXHIH.aa1YJrrQHR7CZL9BSpdN11FAKBheOsy', 'Rivaldo Putra Hari Kusuma', 'Laki-laki', 'Surabaya', '2008-07-17', '082248427767', 'SMP INTEGRAL AR - ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_rivaldoputra@rescience.com_Koala.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 45, 0, 0, 0, '50Menit 33Detik', NULL, NULL, NULL, 1, NULL, 'vGnf5lGuhtpQObUqXuWiuA8YT8JsLBL8o2MLUDxGgUwSWPWVXOR4EAuCeTm7', '2021-11-11 00:42:10', '2021-11-11 00:42:10'),
(1084, 'indira.mandaris@gmail.com', '$2y$10$ugvmizazGPEUGVyjZylKmuLLhuG97/3zV2h9uNGL0S2.qOCxFUXVS', 'Catharina Indira Maheswari Mandaris', 'Perempuan', 'Bandung', '2009-12-01', '081294114194', 'SDK Mater Dei Pamulang', 'Perumahan Bukit Dago, cluster ambassador 2, blok D4 no. 19', 'sd2', 'Bogor', 'Jawa Barat', 'bayar_indira.mandaris@gmail.com_Screenshot_20211111-155402_WhatsApp.jpg', 'profil_indira.mandaris@gmail.com_20210911_165710.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, NULL, '40Menit 37Detik', NULL, NULL, 1, NULL, 'Qc5Fues1TxSTUgZe92hWcKglSuKEnqjacsrUVrG0R1mJ2dCBhGQ1pLMuzcvC', '2021-11-11 01:57:00', '2021-11-11 01:57:00'),
(1086, 'orangtamvan293@gmail.com', '$2y$10$5beAyhpNaped.HRWh4Zofun/P6cfkMU4jXHOiWBp5/XzlLyOfarbi', 'DESTRA ARDHI WIJAYA', 'Laki-laki', 'PURWOKERTO', '2008-12-18', '081328705817', 'SMP AL IRSYAD PURWOKERTO', 'PERUM KPN GR no 142 Jl SOKAJATI RT 03 RW 08 Kel Bantarsoka Kec Purwokerto Barat', 'smp', 'BANYUMAS', 'Jawa Tengah', 'bayar_orangtamvan293@gmail.com_IMG_20211111_163354.jpg', 'profil_orangtamvan293@gmail.com_IMG_20210922_170038.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 70, 0, 0, 0, '18Menit 45Detik', NULL, NULL, NULL, 1, NULL, 'ABHr5AJzdwbUz26si6n8v0X7f3IvCM0BkgUx7U6xlBDWoY9OLdCEq1bRt0FA', '2021-11-11 02:48:08', '2021-11-11 02:48:08'),
(1088, 'rasiyansian309@gmail.com', '$2y$10$2pXdo84n6rU1ve1uliRQCOSe/kYM1X3ddeiDttiTxr235ksMdxdKu', 'MIFTAHUL FITRIYA', 'Perempuan', 'Tuban', '2008-09-25', '+62 812-3061-5188', 'MTsN 1 Lamongan', 'Jln.raya Plaosan, Kec.Babat,Kab.Lamongan', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_rasiyansian309@gmail.com_Bukti pembayaran MIFTAHUL FITRIYA.jpg', 'profil_rasiyansian309@gmail.com_Foto Miftahul Fitriya.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, 0, '3Menit 3Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-11 03:09:38', '2021-11-11 03:09:38'),
(1089, 'claireailie1818@gmail.com', '$2y$10$G.D/yIvPxVhVz5DGTb1lmO9lbmdvyKIIsWKkueICmWtOAmYfKuJma', 'CLAIRE SHANE AILIE SUMANTRI', 'Perempuan', 'Surakarta', '2008-01-18', '081222428055', 'SMP KRISTEN KALAM KUDUS SURAKARTA', 'Jln Pinus 2 GH 5 SOLO BARU Serengan SURAKARTA', 'smp', 'SURAKARTA', 'Jawa Tengah', 'bayar_claireailie1818@gmail.com_IMG_20211111_170740.jpg', 'profil_claireailie1818@gmail.com_IMG_20211111_171646.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '37Menit 11Detik', NULL, NULL, 1, NULL, 'P9st7HWfQ2cbNxMHp9HfuAJ1c58gYKDBqhfquckRSbgEfEr7Ew2v5qs7Dd3s', '2021-11-11 03:17:50', '2021-11-11 03:17:50'),
(1090, 'sumantrikate@gmail.com', '$2y$10$mFlXutA8vfYUXrz55xVla.PibngkTPVqP29ZbbqKKmIU8Ms0soPgS', 'KATHLYNN SHANE AIREEN SUMANTRI', 'Perempuan', 'SURAKARTA', '2013-02-09', '081222428055', 'SD KRISTEN KALAM KUDUS SURAKARTA', 'Jln Pinus 2 GH 5 SOLO BARU Serengan SURAKARTA', 'sd1', 'SURAKARTA', 'Jawa Tengah', 'bayar_sumantrikate@gmail.com_IMG_20211111_170740.jpg', 'profil_sumantrikate@gmail.com_IMG_20211111_171732.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 130, 0, 0, NULL, '48Menit 20Detik', NULL, NULL, 1, NULL, 'DnNfmyAHB5qf7iDb5QTUDttsurtZhI3phvKYoxy0AieP0LkRPYqeacMMi54U', '2021-11-11 03:20:21', '2021-11-11 03:20:21'),
(1091, 'khofifahdzurriyatul@gmail.com', '$2y$10$yxaFn9S2j1O61cjb/Zg2zenxYL/FPS6KY5IZP0CpzoG1j0/A.Nd4i', 'Dzurriyatus Syiddah Nurfahmi', 'Perempuan', 'Lamongan', '2008-03-31', '+62 858-5571-0986', 'MTs N 1 Lamongan', 'Jl.raya plaosan no. 11 babat lamongan', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_khofifahdzurriyatul@gmail.com_Screenshot_2021-11-11-17-18-13-19.png', 'profil_khofifahdzurriyatul@gmail.com_IMG-20211111-WA0038.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, 0, '20Menit 49Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-11 03:20:34', '2021-11-11 03:20:34'),
(1099, 'ariegunawanpriadji@gmail.com', '$2y$10$cr4uB.oqYSXM/ckV0iZ1ou0.WM48vJhoEd3VlDytUvKfbp5ZLoM7m', 'Arie Gunawan Priadji', 'Laki-laki', 'Majalengka', '2006-05-03', '085524973686', 'SMA Negeri 1 Majalengka', 'Jln KH Abdul Halim no 49 pasar balong RT 02 RW 11 Kel Majalengka kulon kec Majalengka kab Majalengka Jawa barat', 'sma', 'Majalengka', 'Jawa Barat', 'bayar_ariegunawanpriadji@gmail.com_IMG_20211111_190306.jpg', 'profil_ariegunawanpriadji@gmail.com_IMG_20211111_190030.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, 0, '9Menit 25Detik', NULL, NULL, NULL, 1, NULL, '8MiRRJCeGZkihie1EHVBv2ZjkpPQ31Au4t3LQnGxIXwsws6udA9IWVPNf1ae', '2021-11-11 05:04:12', '2021-11-11 05:04:12'),
(1100, 'deendaraa54@gmail.com', '$2y$10$ZXh2V6RHv5dt9gDhZTr8LOPrh7UMcO6VICYVT6hjaKqSOF44D6PAe', 'ADINDA RAHAYU FADILLAH SOMANTRI', 'Perempuan', 'GARUT', '2004-01-05', '089690353373', 'SMAN 1 Cileunyi', 'Komplek Taman Cileunyi\r\nblok 2B no.11 \r\nRT.06/ RW.22 \r\nKec. Cileunyi, Kab. Bandung, Jawa Barat\r\nkode pos : 40622', 'sma', 'Kabupaten Bandung', 'Jawa Barat', 'bayar_deendaraa54@gmail.com_C5BFBA3E-EE7E-46B0-A661-9DB9A0B1D59B.jpeg', 'profil_deendaraa54@gmail.com_187178C4-DBD4-4283-BFFA-B8B3F5453B17.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '1Menit 32Detik', NULL, NULL, 1, NULL, 'bbrTzCuBEX02i2h84HVtHXNZmryEpteIJevrRM98Z9AP4dg1VobtRSl5lzRo', '2021-11-11 05:47:06', '2021-11-11 05:47:06'),
(1101, 'herculesfaizunnaja19@gmail.com', '$2y$10$/EuDTyZJblMLdENORjgGJOXzw3wLCCO1Fb6gzY4z2cMgAYQyTsX22', 'MOHAMMAD HERCULES FAIZZUNNAJA', 'Laki-laki', 'Kediri', '2008-10-30', '087772352267', 'MTSN2 KOTA KEDIRI', 'Jalan Saroja RT 01 RW 08 Ds Sumberjo Kec.Kandat', 'smp', 'Kab.Kediri', 'Jawa Timur', 'bayar_herculesfaizunnaja19@gmail.com_16366357392296131996707008681278.jpg', 'profil_herculesfaizunnaja19@gmail.com_IMG-20211025-WA0005.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 60, 0, 0, 0, '55Menit 7Detik', NULL, NULL, NULL, 1, NULL, 'c70DRDBjVgnjQg9fEp1dc0Z89a1bz2bZvwfbKSLWYoY6JbNXnZLBFOnBbLAv', '2021-11-11 06:04:26', '2021-11-11 06:04:26'),
(1102, 'mayyasahputri@rescience.com', '$2y$10$1P0jkIUASIJjRSW/vzXyQO2hlox3LA1jNFlQp71J6PCXDjKexTnFq', 'Mayyasah Putri Khairul Amri', 'Perempuan', 'Purwokerto', '2009-02-11', '081229113344', 'SMP Al Irsyad Al Islamiyyah Purwokerto', 'Jalan Ahmad Yani Gg 2 Nmr 12 RT 001 RW 07 Kel. Kedungwuluh, Kec. Purwokerto Barat', 'smp', 'Purwokerto / Banyumas', 'Jawa Tengah', 'bayar_mayyasahputri@rescience.com_ReactNative-snapshot-image6512805190418896042.jpg', 'profil_mayyasahputri@rescience.com_20210711_112106.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 50, 0, 0, NULL, '59Menit 49Detik', NULL, NULL, 1, NULL, 'K1dfHoHkga04OxkoA2UBzMnUyqTzsvNrGt9r1TFNohM6yzFv3UEpluIEbjFp', '2021-11-11 06:05:06', '2021-11-11 06:05:06'),
(1103, 'yatimayatima77@gmail.com', '$2y$10$7YfIZdsUssHeZxr25CAWvu5oC4INDI7CZoJ9xnGhMkfuwJJKFOyVO', 'Siti nurfi Laili yaum', 'Perempuan', 'Bojonegoro', '2009-06-24', '082143005353', 'MTSN 1 lamongan', 'Jln raya Plaosan babat', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_yatimayatima77@gmail.com_IMG-20211111-WA0027.jpg', 'profil_yatimayatima77@gmail.com_IMG20211111182906.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 100, 0, 0, 0, '0Menit 39Detik', NULL, NULL, NULL, 1, NULL, 'BUOcFJtmP3N7vKwohEz8vNMyMhiuHEBhKN7vRYOH7Okl63hiJxIxsUi6wzcc', '2021-11-11 06:13:05', '2021-11-11 06:13:05'),
(1104, 'shybillaazzahra@gmail.com', '$2y$10$FiK1uEf6tMbBl/gdK3XL1eDrucCXBOGyfOM9oOkqnscSqnzhN7NIW', 'Shybilla Zahrotul Mazhita Azzahra', 'Perempuan', 'Gresik', '2013-02-27', '085731750124', 'MI. AL-MA\'ARIF ABAR ABIR', 'Abar-abir Bungah Gresik', 'sd1', 'Gresik', 'Jawa Timur', 'bayar_shybillaazzahra@gmail.com_IMG-20211111-WA0007.jpg', 'profil_shybillaazzahra@gmail.com_IMG20210208105118.jpg', 0, 1, 0, 0, 0, 0, 0, 0, 0, 130, 0, 0, NULL, '42Menit 20Detik', NULL, NULL, 1, NULL, '75MCrvhM4rb7GZMdja8cc5Fn0ZsvFGpt3W3yBZNpfXVty48UVTtBItxbAaar', '2021-11-11 06:16:56', '2021-11-11 06:16:56'),
(1105, 'wn6154616@gmail.com', '$2y$10$y.CJqzPgu6NGUbWhs5NZNemx5omQqAZRkLONirgVKuHdDeAQG7l92', 'AISYA VINNETTA VASTHI MAHITA', 'Perempuan', 'SURABAYA', '2009-07-30', '082133333271', 'SDN GADING V SURABAYA', 'KAPAS BARU gang 2 nomor 93\r\nKecamatan Tambak Sari\r\nSURABAYA 60134\r\nJAWA TIMUR', 'sd2', 'SURABAYA', 'Jawa Timur', 'bayar_wn6154616@gmail.com_IMG-20211111-WA0038.jpeg', 'profil_wn6154616@gmail.com_FB_IMG_1636542070394.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 100, 0, 0, 0, '26Menit 13Detik', NULL, NULL, NULL, 1, NULL, 'l8eLFYxCWZF2uXJPOW4X9vI9ugZ3XxxdzXxhoA82Turpxb8OzhA0etQ7yjm7', '2021-11-11 06:20:08', '2021-11-11 06:20:08'),
(1106, 'nazwazahramaulida@gmail.com', '$2y$10$yqYHZ0HXIif7pt7fH7EOGeGBber2pj9xSW8M3x3/kVnqeyOT4RPSi', 'Nazwa Zahra Maulida', 'Perempuan', 'Banjarmasin', '2007-04-26', '081358404997', 'SMA Negeri 1 Kedungwaru', 'RT 003/RW 002,DS.Mojoarum,Kec.Gondang,Kab.Tulungagung,Jawa Timur', 'sma', 'Tulungagung', 'Jawa Timur', 'bayar_nazwazahramaulida@gmail.com_IMG-20211111-WA0026.jpg', 'profil_nazwazahramaulida@gmail.com_Remini20211111111753951.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 100, 105, 0, 0, 'EXPIRED', '17Menit 28Detik', NULL, NULL, 1, NULL, NULL, '2021-11-11 06:37:47', '2021-11-11 06:37:47'),
(1108, 'demayhawa@gmail.com', '$2y$10$DxVm4ZYNySNytnd56170De9rmwZZWP5swsBnOFl5Wi1FBe7kEXQD.', 'DEMAY NUR HAWA', 'Perempuan', 'BANDUNG', '2005-07-02', '088229255725', 'SMA NEGERI 7 BANDUNG', 'Jl. Taman Mekar Utama VI no.11, Mekar Wangi Kota Bandung', 'sma', 'KOTA BANDUNG', 'Jawa Barat', 'bayar_demayhawa@gmail.com_photo_2021-11-11_20-56-43.jpg', 'profil_demayhawa@gmail.com_photo_2021-11-11_20-56-38.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, NULL, '24Menit 28Detik', NULL, NULL, 1, NULL, 'OmBKXDsAyJVDgVTY0CsYyb7svjdCLWoZeQeW9HqYbRkXlNIYB2Q3LCtQJDqW', '2021-11-11 07:01:31', '2021-11-11 07:01:31'),
(1111, 'emmeliaputri.windy@gmail.com', '$2y$10$1ulNrInDjd4fKzhsfmi0F.7lxjMcxDfXP9uoeL/6Pr/5A14lrnYfW', 'Emmelia Putri Windriya Bandung', 'Perempuan', 'Bandung', '2010-06-26', '081321364937', 'SD Santa Ursula Bandung', 'Griya Bukit Mas II No B3/1 Jalan Bojong Koneng\r\nKel. Cibeunying, Kec. Cimenyan', 'sd2', 'Kab. Bandung', 'Jawa Barat', 'bayar_emmeliaputri.windy@gmail.com_WhatsApp Image 2021-11-11 at 21.05.18.jpeg', 'profil_emmeliaputri.windy@gmail.com_Pasphoto Emmelia Putri.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 125, 0, 0, NULL, '32Menit 20Detik', NULL, NULL, 1, NULL, 'C15EUgdKT2DoKtSu6B95eHJwRq4Q7LKfhNnTVH2VApJ63FRAoEHH2BKQVNzt', '2021-11-11 07:13:10', '2021-11-11 07:13:10'),
(1112, 'ybandung@gmail.com', '$2y$10$HcDy7QNCup0aJbkkDu3Pmu/NovqGNTDL75oKd.K6hOrYczrCiE5N.', 'Arlene Veterina Nindita Bandung', 'Perempuan', 'Bandung', '2006-10-07', '081321364937', 'SMP Santa Angela Bandung', 'Griya Bukit Mas II No B3/1 Jalan Bojong Koneng\r\nKel. Cibeunying, Kec. Cimenyan', 'smp', 'Kab. Bandung', 'Jawa Barat', 'bayar_ybandung@gmail.com_WhatsApp Image 2021-11-11 at 21.05.18-2.jpeg', 'profil_ybandung@gmail.com_Pasphoto Arlene Veterina.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '17Menit 56Detik', NULL, NULL, 1, NULL, 'nZWWHuh0HFh0P8gNVclVolrFFcI1pFHyDwZDushBvCP1FqGSDp1biYTqAMQm', '2021-11-11 07:15:21', '2021-11-11 07:15:21'),
(1113, 'vanessaruby374@gmail.com', '$2y$10$QmhRjsGmCA7ugikuffC2aubiOCxPeMIo8Zj4siJDhmmPikLMS1W4a', 'Vanessa Ruby Aulia', 'Perempuan', 'Lamongan', '2006-10-13', '085706708159', 'SMPN 1 PACIRAN', 'Rumah Bapak Mashur, Gowah RT 3 RW 1 (Arah Barat Masjid Maqbul), Kelurahan Blimbing, Kecamatan Paciran, Kabupaten Lamongan', 'smp', 'LAMONGAN', 'Jawa Timur', 'bayar_vanessaruby374@gmail.com_IMG_20211111_183259.jpg', 'profil_vanessaruby374@gmail.com_picsart_09-19-06-10-14.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 90, 105, 0, 0, 'EXPIRED', '17Menit 45Detik', NULL, NULL, 1, NULL, NULL, '2021-11-11 07:51:46', '2021-11-11 07:51:46'),
(1114, 'pohontinta39@gmail.com', '$2y$10$DIfWGB36nhWE0pK9dQQDeuFGxhuF/arz0C20sNmbyRSD/iJ1ePW0W', 'Dimas Aditya Rahman', 'Laki-laki', 'Bandung', '2001-10-21', '081386857782', 'SMAN 2 Bandung', 'Jalan Pamekar Raya Panyileukan, Kota Bandung, Jawa Barat', 'sma', 'Kota Bandung', 'Jawa Barat', 'bayar_pohontinta39@gmail.com_Bukti Pembayaran Dimas Rahman.jpeg', 'profil_pohontinta39@gmail.com_Foto Dimas Aditya Rahman (2).jpg', 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, 0, '30Menit 41Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-11 08:32:49', '2021-11-11 08:32:49'),
(1115, 'ayesharania@gmail.com', '$2y$10$flElGIQGN5Zpj9W64F1bdO7tMgnDHQsSMz2pOwhEMknTwFhG4aRA6', 'AYESHA RANIA', 'Perempuan', 'REJANG LEBONG', '2012-10-20', '081271904669', 'SD NEGERI 02 CENTER', 'Kelurahan Talang Benih Rt 1 Rw 5 Curup Rejang  Lebong', 'sd1', 'REJANG LEBONG', 'bengkulu', 'bayar_ayesharania@gmail.com_WhatsApp Image 2021-11-11 at 10.36.26 PM.jpeg', 'profil_ayesharania@gmail.com_WhatsApp Image 2021-09-11 at 1.02.04 PM.jpeg', 1, 1, 0, 0, 1, 1, 0, 0, 105, 120, 0, 0, '13Menit 57Detik', '47Menit 15Detik', NULL, NULL, 1, NULL, 'R229v8uIQ1sBrMeGNWnIeevY7S3iOESoFaYNL4nsnzeZrDZ65ZLqPkjns5zu', '2021-11-11 08:50:58', '2021-11-11 08:50:58'),
(1117, 'nathancia54@gmail.com', '$2y$10$z8HYDxuapZNDswMw1TnlhefHvRoaie1tnkaZc3tqSiGL.3cIfokDW', 'NATHANAEL AARONCIA', 'Laki-laki', 'JAKARTA', '2010-07-10', '085281497647', 'SD Pelita Kasih Curup', 'talang benih', 'sd2', 'REJANG LEBONG', 'Bengkulu', 'bayar_nathancia54@gmail.com_WhatsApp Image 2021-11-11 at 10.36.26 PM.jpeg', 'profil_nathancia54@gmail.com_WhatsApp Image 2021-09-13 at 4.31.30 PM.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 105, 0, 0, NULL, '37Menit 54Detik', NULL, NULL, 1, NULL, 'mRDb4XWGgEFSqRx272aU0OrCQMQq46Nvak0in5OYIjXQgrXSfhq1EjONzWIb', '2021-11-11 08:57:32', '2021-11-11 08:57:32'),
(1119, 'abigailp2110@gmail.com', '$2y$10$os54amyI2p4XVZ5i7/rmA.sJkKss5z/h7M/M6iIuqlZ7JnMNQ/6k.', 'Jacinda Quinn Rizqulloh', 'Perempuan', 'Cirebon', '2010-05-15', '081386857782', 'SDN 258 Sukarela Bandung', 'Jalan Raya Panyileukan Blok G, Kota Bandung, Jawa Barat', 'sd2', 'Kota Bandung', 'Jawa Barat', 'bayar_abigailp2110@gmail.com_TF_Jacinda Quinn Rizqulloh.jpg', 'profil_abigailp2110@gmail.com_Jacinda Quinn R.jpeg', 1, 1, 0, 0, 1, 1, 0, 0, 115, 115, 0, 0, '37Menit 55Detik', '46Menit 3Detik', NULL, NULL, 1, NULL, NULL, '2021-11-11 09:36:51', '2021-11-11 09:36:51'),
(1124, 'yardanyasser@rescience.com', '$2y$10$6rFNJY.O5/Chbk2mbRvov.f99JIjXYJAM7Xw/Wry5R/4iYPZcx6.e', 'Muhammad Yardan Yasser', 'Laki-laki', 'Pasuruan', '2008-11-17', '082251712661', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari', 'smp', 'Malang', 'Jawa Timur', 'bayar_yardanyasser@rescience.com_Screenshot_2021-11-16-09-33-07-78_92b64b2a7aa6eb3771ed6e18d0029815.jpg', 'profil_yardanyasser@rescience.com_16370426422561339173651304200038.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 50, 0, 0, 0, '41Menit 33Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-15 23:04:51', '2021-11-15 23:04:51'),
(1126, 'nisa220583@gmail.com', '$2y$10$M2iW92l1B7aylyHRaKoRiuCu4nZta1CvGcujzymzCHW/bDFE7U3Fi', 'Aqila Zahwa Salimah', 'Perempuan', 'Bojonegoro', '2014-04-08', '081225582780', 'SDIT Mutiara Insan Cepu', 'Jalan Diponegoro Gang Lawu RT 18 RW 03 Nomor 45 Demaan Dengok Padangan', 'sd1', 'Bojonegoro', 'Jawa Timur', 'bayar_nisa220583@gmail.com_WhatsApp Image 2021-11-17 at 2.46.30 PM.jpeg', 'profil_nisa220583@gmail.com_Aqila Seragam Putih.jpeg', 1, 1, 0, 0, 1, 1, 0, 0, 120, 130, 0, 0, '10Menit 7Detik', '53Menit 11Detik', NULL, NULL, 1, NULL, NULL, '2021-11-17 00:58:51', '2021-11-17 00:58:51'),
(1128, 'akhtarelgusti@gmail.com', '$2y$10$UrVxo9Vn5UYn/krz7Y8cLOwuKlr/Z3qZP1SNIOKTA8pilfJILA0hy', 'Akhtarelgusya Al Dian', 'Laki-laki', 'Jakarta', '2010-05-05', '081289512010', 'Syafana Islamic School', 'Cluster Sevilla AC 19, BSD', 'sd2', 'Tangerang Selatan', 'Banten', 'bayar_akhtarelgusti@gmail.com_Bukti Bayar Enura AKhtar 6SD.png', 'profil_akhtarelgusti@gmail.com_Indonesia Akhtar G6.png', 1, 1, 0, 0, 1, 1, 0, 0, 35, 95, 0, 0, '34Menit 58Detik', '40Menit 21Detik', NULL, NULL, 1, NULL, NULL, '2021-11-18 06:44:02', '2021-11-18 06:44:02'),
(1129, 'faithathallahzakisaparudin@gmail.com', '$2y$10$qe2Xyd4md/mkcJ6AZrqHqOpYGzKxAjPbptqHyAGRAzB97rNaQlDei', 'FAITH ATHALLAH ZAKI SAPARUDIN', 'Laki-laki', 'SEMARANG', '2011-10-19', '085656503504', 'SD Negeri Pendrikan Kidul Semarang', 'JL. SADEWA IV NO. 21 SEMARANG', 'sd1', 'KOTA SEMARANG', 'Jawa Tengah', 'bayar_faithathallahzakisaparudin@gmail.com_ENURA-100.jpg', 'profil_faithathallahzakisaparudin@gmail.com_ade zaki (2).jpg', 1, 0, 0, 0, 1, 0, 0, 0, 140, 0, 0, 0, '12Menit 51Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-19 03:34:11', '2021-11-19 03:34:11'),
(1130, 'dela9019uvu@gmail.com', '$2y$10$168ZOoGSdVUFTH18O0q6guO0hNAScEVLNW82.kO/e2OkCUwDcQCSq', 'Adelia Sanuya Nidya Iftinah', 'Perempuan', 'Bandung', '2009-06-10', '0895709768020', 'SMP Aisyiyah Boarding School Bandung', 'Jl. Terusan rancagoong 2 no. 1, kel. Batununggal kec.Gumuruh, 40275', 'smp', 'Kota Bandung', 'Jawa Barat', 'bayar_dela9019uvu@gmail.com_bukti pembayaran adelia smp aisyiyah.jpeg', 'profil_dela9019uvu@gmail.com_foto adel.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 85, 0, 0, NULL, '9Menit 54Detik', NULL, NULL, 1, NULL, 'T9FEM9hgrxHCZRnUFdli8qnSqPqbBQugRfmYE2jqnOj6aLq5wTKLYXyLG7nM', '2021-11-21 21:47:44', '2021-11-21 21:47:44'),
(1133, 'ignasia.roseline@gmail.com', '$2y$10$yiXDK.uc1irKLY7keuMFF.d1gsvLa8U8dkB0yWiNua31t5rJclDA.', 'Ignasia Roseline Nirwasita', 'Perempuan', 'Yogyakarta', '2008-07-18', '081228375920', 'Olifant High School', 'Jalan Cungkuk Raya no 188a, Ngestiharjo, Kasihan', 'smp', 'Bantul', 'DI Yogyakarta', 'bayar_ignasia.roseline@gmail.com_Screenshot_2021-11-25-19-31-17-68_f339d16c976c0b263d991820e972fb72.jpg', 'profil_ignasia.roseline@gmail.com_foto.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, '44Menit 22Detik', NULL, NULL, 1, NULL, '7ptmeZ4CW4VgKrpO2HDdRoz5MOYSq9GTj2j3sqTOP5ae5ID4wrgfZsqsjgbX', '2021-11-25 05:54:14', '2021-11-25 05:54:14'),
(1134, 'muhammadannadhif91@sd.belajar.id', '$2y$10$4KXXdozUqZmIWwfCeJIJX.7WTJJwus1gr5Np/.UNFLkJoJFiQsMV2', 'MUHAMMAD REGAN ANNADHIF', 'Laki-laki', 'Malang', '2010-01-19', '089652420855', 'SD Negeri Bunulrejo 2 Malang', 'Jl. Bedadung 3 Kelurahan Bunulrejo Kecamatan Blimbing', 'sd2', 'Kota Malang', 'Jawa Timur', 'bayar_muhammadannadhif91@sd.belajar.id_Screenshot_20211125_223838.jpg', 'profil_muhammadannadhif91@sd.belajar.id_IMG_20211125_224751.JPG', 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, 0, '24Menit 27Detik', NULL, NULL, NULL, 1, NULL, '2NZeA4vA9LKxmPuRoS9v94do5791LLE9AYA2FYoOPbfWw76kpMcN5OOjiePg', '2021-11-25 08:48:17', '2021-11-25 08:48:17'),
(1136, 'syifanafi90@gmail.com', '$2y$10$2KRanN6iP7eRQIvFUPFn.eDNiyZjFVGj4vachcz7DwnVPYjndglgy', 'Assyifa Fadillah Nafi\'urrohmah', 'Perempuan', 'Kediri', '2010-01-14', '088237504478', 'MIN 2 KEDIRI', 'Dsn.kwarasan kidul RT.006/RW.002 DS.Tiru kidul kec.Gurah kab.Kediri', 'sd2', 'Kabupaten Kediri', 'Jawa Timur', 'bayar_syifanafi90@gmail.com_IMG-20211125-WA0012.jpg', 'profil_syifanafi90@gmail.com_IMG_20210814_141720_517.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, 0, '2Menit 57Detik', NULL, NULL, NULL, 1, NULL, 'lwIqG8nuFkg8CzG3ywHefzxfrgL9P5jKurC9cOt2C0TGP65fufxBpEcAaqoH', '2021-11-25 22:20:09', '2021-11-25 22:20:09'),
(1137, 'nur374336@gmail.com', '$2y$10$JlsNQzzXXGUbLrtNgudkVOYi1XxvVYmHaDRn1MSk0MhzYmrAIkut6', 'NUR MAYRA ZAHRA NASUTION', 'Perempuan', 'KISARAN', '2011-04-25', '082360939586', 'SD NEGERI 010139 PERK. GUNUNG MELAYU', 'DUSUN II DESA GUNUNG MELAYU KECAMATAN RAHUNING KABUPATEN ASAHAN PROVINSI SUMATERA UTARA', 'sd2', 'ASAHAN', 'Sumatra Utara', 'bayar_nur374336@gmail.com_BUKTI TRANSFER PENDAFTRAN MAYRA.jpg', 'profil_nur374336@gmail.com_NUR MAYRA ZAHRA NASUTION.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 125, 0, 0, NULL, '19Menit 22Detik', NULL, NULL, 1, NULL, 'BXwqufWZQPvgTlTfyvoOGFAZdVpS21dnIoTW5Xxt9L4ICAbfZl5RmYEvrkec', '2021-11-26 00:49:12', '2021-11-26 00:49:12'),
(1138, 'nurjannanurjanna849@gmail.com', '$2y$10$hfiNQkLf0o4hJQsXGQzfneiMlxnLl.DJE41gK9h6FXKRsj4GeSUf2', 'IKHSAN EL GHIFARI', 'Laki-laki', 'PERK. GUNUNG MELAYU', '2011-06-12', '082360939586', 'SD NEGERI 010139 PERK. GUNUNG MELAYU', 'PERK. GUNUNG MELAYU DUSUN IV KECAMATAN RAHUNING KABUPATEN ASAHAN PROVINSI SUMATERA UTARA', 'sd2', 'ASAHAN', 'Sumatra Utara', 'bayar_nurjannanurjanna849@gmail.com_BUKTI TRANSFER PENDAFTARAN FAHRI.jpg', 'profil_nurjannanurjanna849@gmail.com_IKHSAN EL GHIFARI.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, 0, '14Menit 30Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-26 01:16:51', '2021-11-26 01:16:51'),
(1139, 'fazaadzima.zazu@gmail.com', '$2y$10$N9uCTNJXdu3iyFfB/RnvQuLjo3JFojzPfzd5jRh/k0y5egV6BHrze', 'Faza Adzima', 'Laki-laki', 'Bandung', '2009-11-10', '081809933711', 'SDN 037 Sabang Kota Bandung', 'Jl. Sabang No.2, Cihapit, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40114', 'sd1', 'Kota Bandung', 'Jawa Barat', 'bayar_fazaadzima.zazu@gmail.com_FAZA.jpeg', 'profil_fazaadzima.zazu@gmail.com_FAZA ADZIMA.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, 0, '49Menit 34Detik', NULL, NULL, NULL, 1, NULL, 'Om5nSSAacfIz63XtSKJVYi7n3rybmi8DLwRe1lsdaR67rFHTQ7fTRMaOfLy3', '2021-11-26 01:30:09', '2021-11-26 01:30:09'),
(1140, 'ghazali.adzima@gmail.com', '$2y$10$9uJd5yyMhHcX2xDR.e/Q5ezFI5Q1ZSL6AF2D5Tljl8RWvu.7QOkeK', 'Ghazali Adzima', 'Laki-laki', 'Bandung', '2012-03-13', '081809933711', 'SDN 037 Sabang Kota Bandung', 'Jl. Sabang No.2, Cihapit, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40114', 'sd1', 'Bandung', 'Jawa Barat', 'bayar_ghazali.adzima@gmail.com_GHAZALI.jpeg', 'profil_ghazali.adzima@gmail.com_GHAZALI ADZIMA.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, 0, '15Menit 31Detik', NULL, NULL, NULL, 1, NULL, 'YXycLUZYnQXIUdzY7OLub4hJ02oZ8Vpo2oNehzTYpTvZHmpiuCKhVT2CorXj', '2021-11-26 01:32:33', '2021-11-26 01:32:33'),
(1142, 'faizzahfawazzynursyahbani@gmail.com', '$2y$10$R2rDiKC0l6uamGcgDT3ST.IXkRlgr5jjDVicC0113Z.Syi7ksEbN2', 'Faizzah Fawazzy Nursyahbani', 'Perempuan', 'Pangkalpinang', '2008-05-28', '082281978564', 'SMP NEGERI 2 PANGKALPINANG', 'Alamat: Komplek tata graha Stania jln melati 5 RT.rw .007.003 Kel taman bunga kec.gerunggang kota Pangkalpinang, prov Bangka Belitung', 'smp', 'Pangkalpinang', 'Kep. Bangka Belitung', 'bayar_faizzahfawazzynursyahbani@gmail.com_IMG-20211126-WA0020.jpg', 'profil_faizzahfawazzynursyahbani@gmail.com_IMG-20210908-WA0061.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, '29Menit 36Detik', NULL, NULL, 1, NULL, NULL, '2021-11-26 03:27:28', '2021-11-26 03:27:28'),
(1144, 'harunarrosyid2006@gmail.com', '$2y$10$8o70QrbN4mf2YEkKVd5wM.PtiyANXLN9Rq0OAtnjjNqKZ4Fq5xdkO', 'MUHAMAD HARUN AR ROSYID', 'Laki-laki', 'MALANG', '2006-12-21', '087859576129', 'SMP NEGERI 6 MALANG', 'Jl. Janti Barat Gg.lll No.61A RT 05 RW 08, Kelurahan Bandungrejosari, Kecamatan Sukun, Kota Malang, 65148', 'smp', 'MALANG', 'Jawa Timur', 'bayar_harunarrosyid2006@gmail.com_WhatsApp Image 2021-11-26 at 10.03.14.png', 'profil_harunarrosyid2006@gmail.com_Foto Formal Muhamad Harun Ar Rosyid 9.1 (Back Merah).jpeg', 1, 1, 0, 0, 1, 1, 0, 0, 110, 110, 0, 0, '1Menit 4Detik', '2Menit 43Detik', NULL, NULL, 1, NULL, NULL, '2021-11-26 08:41:38', '2021-11-26 08:41:38'),
(1145, 'yani.dwianna@yahoo.com', '$2y$10$/a5xGpRWrIWtd2jUAsM7DO2pUOuIBywe1TUFlLuT6gDlj1Ob21uuu', 'Arissa Rifaya Khairunnisa', 'Perempuan', 'Depok', '2015-06-15', '081381136560', 'SD Labschool Cibubur', 'Perumahan Citra Gran Cibubur, Cluster The Varden Blok S1 No 03 RT.07 RW.14 Jatikarya Jatisampurna Kota Bekasi 17435', 'sd1', 'Bekasi', 'Jawa Barat', 'bayar_yani.dwianna@yahoo.com_Elnura Math Arissa.jpeg', 'profil_yani.dwianna@yahoo.com_WhatsApp Image 2021-11-16 at 13.00.21 (1).jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 135, 0, 0, 0, '35Menit 30Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-11-26 19:43:57', '2021-11-26 19:43:57');
INSERT INTO `users` (`id`, `email`, `password`, `name`, `kelamin`, `tempat`, `date`, `nomorhp`, `sekolah`, `alamat`, `tingkatan`, `kota`, `provinsi`, `bukti_bayar`, `foto_profil`, `hasmtk`, `hasipa`, `hasbing`, `hasips`, `statmtk`, `statipa`, `statbing`, `statips`, `nilaimtk`, `nilaiipa`, `nilaibing`, `nilaiips`, `timermtk`, `timeripa`, `timerbing`, `timerips`, `hasverif`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1146, 'y.barliani@gmail.com', '$2y$10$jA1bPS.ldoQXWSwGyKOcTOC2gEruqoeOtf19sFl7yJOo0I2DxiZju', 'Aqmar Hanif Abdullah', 'Laki-laki', 'Depok', '2012-07-02', '081381136560', 'SD Labschool Cibubur', 'Perumahan Citra Gran Cibubur, Cluster The Varden Blok S1 No 03 RT.07 RW.14 Jatikarya Jatisampurna Kota Bekasi 17435', 'sd2', 'Bekasi', 'Jawa Barat', 'bayar_y.barliani@gmail.com_Elnura Science Aqmar.jpeg', 'profil_y.barliani@gmail.com_Foto Formal Aqmar.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, NULL, '51Menit 20Detik', NULL, NULL, 1, NULL, NULL, '2021-11-26 19:49:15', '2021-11-26 19:49:15'),
(1148, 'jmeru1010@gmail.com', '$2y$10$rMQXFLYI.o0rTBfxcNYRWOX.jnO1.9hIZ0qtPU7boJTZLqyYiN0fa', 'Javana Meru Rafif Dipajana', 'Laki-laki', 'Jakarta', '2006-10-10', '085717587170', 'SMAN 1 Cileungsi', 'Taman Kenari Nusantara\r\nCluster Ranah Melayu Blok MG 3 NO. 18B', 'sma', 'Kabupaten Bogor', 'Jawa Barat', 'bayar_jmeru1010@gmail.com_Bukti Transfer Re-Science.jpeg', 'profil_jmeru1010@gmail.com_Foto Diri(Formal).jpg', 1, 1, 0, 0, 1, 1, 0, 0, 60, 90, 0, 0, '0Menit 8Detik', '7Menit 51Detik', NULL, NULL, 1, NULL, NULL, '2021-11-27 05:14:51', '2021-11-27 05:14:51'),
(1149, 'wimbidar@gmail.com', '$2y$10$S6g2tbpdYx5u1AJYy1aRL.xszfxopPqZol4AbMKs2wqkBMU8cWXSS', 'Adrian Maulana', 'Laki-laki', 'Banyumas', '2008-02-26', '081327696951', 'Smp al irsyad purwokerto', 'Kalpataru 2 no 15, purwosari', 'smp', 'Banyumas', 'Jawa Tengah', 'bayar_wimbidar@gmail.com_Screenshot_20211127-225442_OVO.jpg', 'profil_wimbidar@gmail.com_20211127_230147.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 110, 110, 0, 0, '13Menit 27Detik', '4Menit 26Detik', NULL, NULL, 1, NULL, 'zmcRPYL0DFWCveFloBCi5GNG70fkpOHsWpm5JIjOOCMAy6Uw6ZDYpI7ASgs1', '2021-11-27 09:00:17', '2021-11-27 09:00:17'),
(1150, 'fairuznazriel17@gmail.com', '$2y$10$Xn8bt4UJT/GzyLBCahwTr.4m.qU59fcdUissqW/b8Tw/PfJdjI61G', 'Muhammad Nazriel Fairuzsuzza', 'Laki-laki', 'Sumedang', '2008-10-17', '081280853174', 'SMP PLUS AR-RAHMAT', 'JL. Villa Bandung Indah No.5 RT.01 RW.07 Kp. Tanjakan Muncang Desa Cileunyi Wetan Kecamatan Cileunyi Kabupaten Bandung \r\nJawa Barat 40622 Telp. 022-87883576', 'smp', 'Bandung', 'Jawa Barat', 'bayar_fairuznazriel17@gmail.com_Bukti Transfer 100.jpeg', 'profil_fairuznazriel17@gmail.com_Nazriel.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 35, 0, 0, 0, '45Menit 45Detik', NULL, NULL, NULL, 1, NULL, 'ikr23vHScJUkhPsW8FPEH0TiedgCsbKek6oPAWgbpLCa7RIpWvC8En653lxj', '2021-11-27 19:17:33', '2021-11-27 19:17:33'),
(1153, 'ninanapisah2018@gmail.com', '$2y$10$wWsU8objpEfdOtGyiHNv2eWmQBG6yVuh/aX760TyEdimeGJgvxj4a', 'Syafaz Fadhillah', 'Laki-laki', 'Bandung', '2010-09-25', '085793952999', 'SD PLUS AR-RAHMAT', 'JL. Villa Bandung Indah No.5 RT.01 RW.07 Kp. Tanjakan Muncang Desa Cileunyi Wetan Kecamatan Cileunyi Kabupaten Bandung \r\nJawa Barat 40622 Telp. 022-87883576', 'sd2', 'Bandung', 'Jawa Barat', 'bayar_ninanapisah2018@gmail.com_Bukti Transfer 300.jpeg', 'profil_ninanapisah2018@gmail.com_Syafaz.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, '30Menit 58Detik', NULL, NULL, 1, NULL, '1NnRXfxJxuSIQ0UNWcxsj9HYzssrwQ8tOUXMlpVBspOiawaTDo4hdUAsHhVC', '2021-11-27 19:43:20', '2021-11-27 19:43:20'),
(1154, 'arindwie12@gmail.com', '$2y$10$fNCeasWYqmvvcqiXEiIJnuB4wkNikTERQNVSycYMl0rWGqevTEHdm', 'Alisa Putri', 'Perempuan', 'Banyumas', '2008-11-27', '081296481079', 'SMP PLUS AR-RAHMAT', 'JL. Villa Bandung Indah No.5 RT.01 RW.07 Kp. Tanjakan Muncang Desa Cileunyi Wetan Kecamatan Cileunyi Kabupaten Bandung \r\nJawa Barat 40622 Telp. 022-87883576', 'smp', 'Bandung', 'Jawa Barat', 'bayar_arindwie12@gmail.com_Bukti Transfer 300.jpeg', 'profil_arindwie12@gmail.com_Alisa.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, NULL, '5Menit 24Detik', NULL, NULL, 1, NULL, 'mt1ccmkHdl7yPrYD5zUb6RRUveDeOZiysXbR8SzhwL8wFbZacBIhJbOmpH3M', '2021-11-27 19:51:52', '2021-11-27 19:51:52'),
(1155, 'fathandhiya01@gmail.com', '$2y$10$SDXwJ1dIT7s9W3mF3KJzCeX2o4C8PmkIgAqkXry3G94P1ozfaceAm', 'Fathan dhiya arkan azzamy', 'Laki-laki', 'Bandung', '2009-02-23', '081284654728', 'SMP PLUS AR-RAHMAT', 'JL. Villa Bandung Indah No.5 RT.01 RW.07 Kp. Tanjakan Muncang Desa Cileunyi Wetan Kecamatan Cileunyi Kabupaten Bandung \r\nJawa Barat 40622 Telp. 022-87883576', 'smp', 'Bandung', 'Jawa Barat', 'bayar_fathandhiya01@gmail.com_Bukti Transfer 300.jpeg', 'profil_fathandhiya01@gmail.com_fatan.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 55, 0, 0, 0, '14Menit 26Detik', NULL, NULL, NULL, 1, NULL, '8ihVnWqJC9ZHZQ0Cf1wtCPFqw9toAwnu1KArUjPnoqdxIP3TEbRYu0wQogyC', '2021-11-27 20:02:35', '2021-11-27 20:02:35'),
(1157, 'sitiayesha104@gmail.com', '$2y$10$nTtL6fEVvOc3boj8z1vMiee.X/bpdXTgpf32o2RkYHNmz7FEtnh0i', 'Siti Ayesha Radhiya Khalila', 'Perempuan', 'Bandung', '2008-10-08', '089616148310', 'SMP PLUS AR-RAHMAT', 'JL. Villa Bandung Indah No.5 RT.01 RW.07 Kp. Tanjakan Muncang Desa Cileunyi Wetan Kecamatan Cileunyi Kabupaten Bandung \r\nJawa Barat 40622 Telp. 022-87883576', 'smp', 'Bandung', 'Jawa Barat', 'bayar_sitiayesha104@gmail.com_Bukti Transfer 300.jpeg', 'profil_sitiayesha104@gmail.com_IMG_20211129_060816_774.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 60, 0, 0, 0, 'EXPIRED', NULL, NULL, NULL, 1, NULL, '6f3YsWFESAALuztQy39ADf8r35eyZFvUxPWMHtpYs5XeUxWJDJEru0O7RVxh', '2021-11-27 20:13:14', '2021-11-27 20:13:14'),
(1159, 'ambuhilda02@gmail.com', '$2y$10$N8mWGuyaQx0r68GSAaTtgumL98sVr6LepSPUcDfGeXOq8uMFThG8O', 'Namina Airis Raturida', 'Perempuan', 'Sumedang', '2007-09-12', '082115375786', 'SMP PLUS AR-RAHMAT', 'JL. Villa Bandung Indah No.5 RT.01 RW.07 Kp. Tanjakan Muncang Desa Cileunyi Wetan Kecamatan Cileunyi Kabupaten Bandung \r\nJawa Barat 40622 Telp. 022-87883576', 'smp', 'Bandung', 'Jawa Barat', 'bayar_ambuhilda02@gmail.com_Bukti Transfer 300.jpeg', 'profil_ambuhilda02@gmail.com_Namina.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 45, 0, 0, 0, '36Menit 1Detik', NULL, NULL, NULL, 1, NULL, 'LdwatU9Up1ETNGovziRgUVUTENkuWBFIZzLpeMJXbYWX6l8DDUH9bkzOtSj7', '2021-11-27 20:30:12', '2021-11-27 20:30:12'),
(1160, 'tsabilnaya@gmail.com', '$2y$10$k4UUXgVlPBtdtnwBFG6QW.AY5caIsb.SIxA4VvFaASiw8rbHs055i', 'Tsa Sabillna ya athiyya', 'Perempuan', 'Bandung', '2008-02-25', '081321253018', 'SMP PLUS AR-RAHMAT', 'JL. Villa Bandung Indah No.5 RT.01 RW.07 Kp. Tanjakan Muncang Desa Cileunyi Wetan Kecamatan Cileunyi Kabupaten Bandung \r\nJawa Barat 40622 Telp. 022-87883576', 'smp', 'Bandung', 'Jawa Barat', 'bayar_tsabilnaya@gmail.com_Bukti Transfer 300.jpeg', 'profil_tsabilnaya@gmail.com_Tsabilla.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, NULL, '12Menit 48Detik', NULL, NULL, 1, NULL, 'i9jQZfDEDclpkFkf5pw0lXgtjKQhIrDACN4KyZGEG4ejlHbIYn30aBciPJp8', '2021-11-27 20:40:40', '2021-11-27 20:40:40'),
(1161, 'febbyaghnia@gmail.com', '$2y$10$DLKfM0yLmWRUpum3N8PMdOgs/eHi5rZaeL04cVIJV2VUqAeE5le4q', 'Febby Aghnia Alqonita', 'Perempuan', 'Bandung', '2009-02-07', '085846649490', 'SMP PLUS AR-RAHMAT', 'JL. Villa Bandung Indah No.% RT.01 RW.07 Kp. Tanjakan Muncang Desa Cileunyi Wetan Kecamatan Cileunyi KabupatenBandung\r\nJawa Barat 40622 Telp. 022 - 87883576', 'smp', 'Bandung', 'Jawa Barat', 'bayar_febbyaghnia@gmail.com_Bukti Transfer 100.jpeg', 'profil_febbyaghnia@gmail.com_Febby.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 100, 0, 0, NULL, '5Menit 56Detik', NULL, NULL, 1, NULL, 'IuzVWSTDxmC0cBOvbbeLhAkfYNFECNX4EjYTpxAAQCJndl3r9scpZ2Qs6xOf', '2021-11-28 19:19:06', '2021-11-28 19:19:06'),
(1162, 'laksitatisna@rescience.com', '$2y$10$2Ejjh9hG2gZh3Q.8V04N3uf0zqJMkBunBsNrDAPy.6oUAKYpwm.Xi', 'Ni Luh Putu Laksita Tisna Ardhaniasa', 'Perempuan', 'Denpasar', '2011-01-13', '08113802550', '-', 'JALAN BATUYANG GANG ANGGREK NO. 41 BATUBULAN KANGIN SUKAWATI GIANYAR BALI', 'sd2', 'GIANYAR', 'Bali', '', 'profil_laksitatisna@rescience.com_IMG-20211129-WA0011.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 105, 0, 0, NULL, '38Menit 13Detik', NULL, NULL, 1, NULL, NULL, '2021-11-29 00:38:22', '2021-11-29 00:38:22'),
(1166, 'yusnitadewi2121@gmail.com', '$2y$10$APtbuhjsZbM5/lQHMcy.xuRoNMjDkLrOSVLUk9Qqe90ff8aGb9peG', 'DESVINA ALMIRA MAHENDRA', 'Perempuan', 'KARAWANG', '2014-10-01', '081220007836', 'SDI AL AZHAR KARAWANG', 'RENGASDENGKLOK - KARAWANG', 'sd1', 'KARAWANG', 'Jawa Barat', 'bayar_yusnitadewi2121@gmail.com_WhatsApp Image 2021-11-27 at 21.54.44.jpeg', 'profil_yusnitadewi2121@gmail.com_WhatsApp Image 2021-11-29 at 16.47.33.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, 0, '21Menit 19Detik', NULL, NULL, NULL, 1, NULL, 'SMl1CdtgMIsl4JpiXQPPmDU4qRORnBBfk4FTD3Pe8x3hI7pQlEui39GzHh0G', '2021-11-29 22:09:34', '2021-11-29 22:09:34'),
(1167, 'gerrard.bramantyo57@gmail.com', '$2y$10$lYwrAFPVP.CQGL9wIGf58ue8.wxiLX2f0rgAKCfW56cYDR39uU10O', 'Muhammad Gerrard Bramantyo', 'Laki-laki', 'Malang', '2014-07-05', '085331609530', 'MIN 1 Kota Malang', 'Jl. Karya Timur Gg. Wonosari No. 35 Purwantoro Blimbing Malang', 'sd1', 'Kota Malang', 'Jawa Timur', 'bayar_gerrard.bramantyo57@gmail.com_Screenshot_2021-12-14-08-41-40-407_com.bca.jpg', 'profil_gerrard.bramantyo57@gmail.com_IMG_20210823_173828.png', 1, 1, 0, 0, 1, 1, 0, 0, 90, 100, 0, 0, '30Menit 33Detik', '53Menit 9Detik', NULL, NULL, 1, NULL, 'AXZKUz5KTYAV12z3oA4yUtnaTgstoq8iIhZgNS1UMJ7wWfKRyO5uiRI5xP5C', '2021-12-13 18:42:11', '2021-12-13 18:42:11'),
(1171, 'rafiahmadalbar@resciencw.com', '$2y$10$ovniPVdYpsIG33yT8xlPbeS5Sw3yDSFaqRqRDvrXXmziyowyBXElu', 'RAFI AHMAD ALBAR', 'Laki-laki', 'BLITAR', '2008-01-12', '081333174280', 'SMPN 1 WLINGI', 'Jl. Pramuka, No 1, RT 3, RW 2, Dusun Pantimulyo, Desa Kendalrejo, Kab. Blitar, Prov. Jawa Timur', 'smp', 'BLITAR', 'Jawa Timur', 'bayar_rafiahmadalbar@resciencw.com_BUKTI PEMBAYARAN.jpeg', 'profil_rafiahmadalbar@resciencw.com_FOTO.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 130, 0, 0, 0, '8Menit 8Detik', NULL, NULL, NULL, 1, NULL, 'Eo9ynUxaWP9yfwgoUtoIhN4ri2XesrYXpqhKe9xJbQdzY5zf17EiXM5oSejM', '2021-12-13 19:22:50', '2021-12-13 19:22:50'),
(1172, 'rizkyfirmansyah@rescience.com', '$2y$10$BFotxGZP4e73.c9femxRkuh5DWCywOZuUaM.XbBDMonwq/39c7n7a', 'Rizky firmansyah', 'Laki-laki', 'Malang', '2009-04-14', '081331544572', 'Smp integral ar rohmah', 'Jl suropati gang 2 Rt19 RW04', 'smp', 'Malang', 'Jawa Timur', 'bayar_rizkyfirmansyah@rescience.com_IMG-20211214-WA0001.jpg', 'profil_rizkyfirmansyah@rescience.com_IMG_20211214_094145.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, '31Menit 41Detik', NULL, NULL, 1, NULL, 'N3RJJniW0LeiK39rtBXqou6URQJwdVAcU8xxxMwE0UoZJlQWc7kl4WqjUCwg', '2021-12-13 19:45:56', '2021-12-13 19:45:56'),
(1175, 'fajarastronomi@gmail.com', '$2y$10$sry5jpQgwwpCvLDwjF0VRelr3R43ysJlfxVZPPaCqKZ71HUpi30YC', 'Mochamad Fajar Naayif', 'Laki-laki', 'Kediri', '2008-10-22', '085236602012', 'MTsN 2 Kota Kediri', 'Dsn. Kejuron RT 1/ RW 3 Ds. Plosorejo Kec. Gampengrejo', 'smp', 'Kabupaten', 'Jawa Timur', 'bayar_fajarastronomi@gmail.com_IMG-20211111-WA0060.jpg', 'profil_fajarastronomi@gmail.com_IMG20210712094940.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 85, 0, 0, 0, '0Menit 27Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-13 21:05:36', '2021-12-13 21:05:36'),
(1176, 'linda.lesmana@gmail.com', '$2y$10$GOG5sV.IomisdanBzVr9eeB2SAvlNqftzzn741OKY3D5abgDJB/bm', 'Caleb Elias Dharmawirya', 'Laki-laki', 'Jakarta', '2015-01-15', '0818654190', 'SDK Penabur Gading Serpong', 'Sutera Palmyra V no 21, Alam Sutera, Tangerang 15144', 'sd1', 'Tangerang', 'Banten', 'bayar_linda.lesmana@gmail.com_518A78CA-DFF3-43A6-B5E6-2C909825B6DC.jpeg', 'profil_linda.lesmana@gmail.com_9B59200E-45BA-4F5A-9873-2246B30E782B.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 135, 0, 0, 0, '33Menit 13Detik', NULL, NULL, NULL, 1, NULL, 'KEhNPnoODMkpQ0OKFEWepID5DjMi9xwRABeVqvthm0t6wZPxlQPtlGB6Qf2n', '2021-12-13 21:20:50', '2021-12-13 21:20:50'),
(1177, 'mitzikurniawan@gmail.com', '$2y$10$210A1Kh7L9D8MAupF/GSEeLyqL5yEONayQFrCZI7393qYLjke2IrC', 'Mitzi Firsyani Kurniawan', 'Perempuan', 'Jakarta', '2010-04-18', '08111000771', 'SD Islam Al Ikhlas Cipete Jakarta Selatan', 'Lebak Bulus Raya 1 Jl. H. Baun No. 43A (belakang agent JNE) kec. Cilandak kelas. Lebak Bulus Jakarta Selatan 12440', 'sd2', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_mitzikurniawan@gmail.com_Screenshot_2021-12-14-11-48-30-935_com.whatsapp.jpg', 'profil_mitzikurniawan@gmail.com_IMG_20211027_120205.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, 0, '16Menit 24Detik', NULL, NULL, NULL, 1, NULL, 'H84ABcHMtI234jPkGFKmPD9Ekllffy9dzWFifIz3NVQ2gD4BjHJWIWVc3Dd4', '2021-12-13 21:52:05', '2021-12-13 21:52:05'),
(1178, 'desy.aik30@gmail.com', '$2y$10$305nDVYxNpJrWbtG8qZbleQUnEW5WPTCOsqkhb1cOIhaNHRns5WP.', 'MUHAMMAD WILDAN RONNI BUDIHARTANTO', 'Laki-laki', 'MADIUN', '2009-06-02', '087754597811', 'SMP INTEGRAL AR-ROHMAH TAHFIZH', 'JALAN LOCARI 17 SUMBERSEKAR, DAU, MALANG', 'smp', 'BATU-MALANG', 'Jawa Timur', 'bayar_desy.aik30@gmail.com_IMG-20211214-WA0027.jpg', 'profil_desy.aik30@gmail.com_IMG-20211214-WA0027.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 50, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, '7HY8zF3xQafQiM1YdTBanuvQ8Z5NNdJOiFw4kwKCUIg7osKAsk87s0s2VRvV', '2021-12-13 23:27:00', '2021-12-13 23:27:00'),
(1180, 'indahphoto1517@gmail.com', '$2y$10$TsOdE26ay5XM98yLf6DxwOZzXtTc6KqEPOsdMf0GI0ipFL1iOkGv6', 'CHOKY ABED JERIKO', 'Laki-laki', 'Curup', '2010-01-17', '082175749289', 'SD PELITA KASIH CURUP', 'Pasar atas', 'sd2', 'Kabupaten rejang Lebong', 'Bengkulu', 'bayar_indahphoto1517@gmail.com_IMG-20211214-WA0017.jpg', 'profil_indahphoto1517@gmail.com_IMG-20211214-WA0020.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, 0, '11Menit 41Detik', NULL, NULL, NULL, 1, NULL, 'dEykl2VHCvBlrpG2zw7LzBruH8HAiKFVwZpzbsWz09iXaeTc6HxOuaY2MaWt', '2021-12-13 23:36:59', '2021-12-13 23:36:59'),
(1183, 'elysiachannathania@gmail.com', '$2y$10$q7TdaDV3MTP0Re0.7Y2hleKgbLLofb2cX7RGeBaaQZxk8TtArvnTW', 'Nathania Elysia Chan', 'Perempuan', 'Curup', '2010-05-15', '083135345151', 'SD Pelita Kasih Curup', 'Kepala Siring', 'sd2', 'Rejang Lebong', 'bengkulu', 'bayar_elysiachannathania@gmail.com_Screenshot_2021_1214_133259.jpg', 'profil_elysiachannathania@gmail.com_Remini20211214213237355.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '45Menit 23Detik', NULL, NULL, 1, NULL, 'OgqT7nLbcVOSJNAVPe2vmxE7G0TV2Wtp46fVQxWfP9kRZNq95BP3V2spOSIh', '2021-12-13 23:38:01', '2021-12-13 23:38:01'),
(1188, 'elleoracrp@gmail.com', '$2y$10$R1R6fRQsJkscBVQddGPDHOOm4LsdIL6U8FMmdGotcUmajIBCJ0Zj.', 'Elleora Chava evanjeline Pasaribu', 'Perempuan', 'Jayapura', '2010-01-05', '082159396763', 'SD pelita kasih Curup', 'Temple Rejo', 'sd2', 'Rejang Lebong', 'Bengkulu', 'bayar_elleoracrp@gmail.com_IMG-20211214-WA0007.jpg', 'profil_elleoracrp@gmail.com_IMG-20211214-WA0006.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-13 23:40:41', '2021-12-13 23:40:41'),
(1190, 'naeldamanik17@gmail.com', '$2y$10$qaYkZUDUtguqEKl01XBWl.b108w.Zt06hEj61cktGlTt7NHyuBKoW', 'Pangeran Natanael Eprahim Damanik', 'Laki-laki', 'Curup', '2010-09-17', '081273579802', 'SD PELITA KASIH CURUP', 'Jalan Kartini Nomor 1823', 'sd2', 'Kabupaten Rejang Lebong', 'Bengkulu', 'bayar_naeldamanik17@gmail.com_IMG-20211214-WA0006.jpg', 'profil_naeldamanik17@gmail.com_IMG-20210728-WA0008.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 110, 105, 0, 0, '10Menit 15Detik', '37Menit 54Detik', NULL, NULL, 1, NULL, '4qNyb05YZ34o7xhZDqt1CDr9lw3Vkd9Jz6PC7x0bVqYs6RaWBdx1CwSHrciP', '2021-12-13 23:45:12', '2021-12-13 23:45:12'),
(1193, 'chykojonathan@gmail.com', '$2y$10$qyyTF9CO3gV8bNd6DBGxeuYbUYTYnDeKJmw4BAtzIMHiqPNkrVRgO', 'CHYKOJONATHAN', 'Laki-laki', 'Rejang lebong', '2011-11-15', '081334873568', 'SD KRISTEN PELITA KASIH CURUP', 'PASAR ATAS', 'sd2', 'REJANG LEBONG', 'Bengkulu', 'bayar_chykojonathan@gmail.com_IMG-20211214-WA0001.jpg', 'profil_chykojonathan@gmail.com_IMG-20211214-WA0009.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 110, 105, 0, 0, '10Menit 15Detik', '37Menit 47Detik', NULL, NULL, 1, NULL, 'CSyZ9QNi2nxFcXemU7hAHY7ChKKBl6AtRLGjRZXEohKl5ceoqvWGL7GcV4IQ', '2021-12-13 23:58:21', '2021-12-13 23:58:21'),
(1194, 'purnomoalvin019@gmail.com', '$2y$10$aZrs8Zi8cUPFFoS0OwyK4umqk1/PMJ4BzA0GO3MkdqKLUYrjK2Jeu', 'Albert Shan Jerycho Purnomo', 'Laki-laki', 'Curup', '2010-06-17', '082372981212', 'Pelita kasih', 'Jln.Mh tamhrin', 'sd2', 'Curup', 'Aceh', 'bayar_purnomoalvin019@gmail.com_IMG-20211214-WA0071.jpg', 'profil_purnomoalvin019@gmail.com_IMG-20211214-WA0056.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 110, 105, 0, 0, '10Menit 15Detik', '48Menit 47Detik', NULL, NULL, 1, NULL, 'xxIeKBL21rwLGE1YAaBSej2cQJBY2EhMGqTKIeHMPJ6D5ANv6FIrrRSdJ63Y', '2021-12-14 05:02:29', '2021-12-14 05:02:29'),
(1196, 'fernelfidei08@gmail.com', '$2y$10$Io39lenL5YjeUF.xmcjFy./frfVFVY2kCYf7NdCjWoHvuYlkByw/m', 'Fernel Fidei Sitorus', 'Laki-laki', 'Sungai Apit', '2004-08-22', '081267698952', 'SMA Negeri 1 Sungai Apit', 'Jalan Gajah Mada, Kecamatan Sungai Apit, Kabupaten Siak, Provinsi Riau', 'sma', 'SIAK', 'Riau', 'bayar_fernelfidei08@gmail.com_Bukti pembayaran Re-Science.jpeg', 'profil_fernelfidei08@gmail.com_FOTO_FERNEL FIDEI SITORUS.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 130, 0, 0, 0, '3Menit 25Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 05:12:56', '2021-12-14 05:12:56'),
(1198, 'karensiatrinadia@gmail.com', '$2y$10$kXGmuE3Z.5JOW0TrVvwgie.lYSfnwcAawZsaSVIduYBmBFo9pQoHq', 'Karensia Tri Nadia', 'Perempuan', 'Muara Aman', '2010-02-16', '082175534518', 'SD Pelita Kasih Curup', 'Air Meles bawah', 'sd2', 'Rejang Lebong', 'Bengkulu', 'bayar_karensiatrinadia@gmail.com_Screenshot_20211214_135343.jpg', 'profil_karensiatrinadia@gmail.com_IMG-20211214-WA0033.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, NULL, '45Menit 24Detik', NULL, NULL, 1, NULL, '5ypX62uc2eZzLTgSXrzCGHOialcsOW5OdZ374a6QrQfAiMkXVxlgYf81Z7SU', '2021-12-14 07:23:45', '2021-12-14 07:23:45'),
(1199, 'rafaelsitorus29@gmail.com', '$2y$10$HUkEOIoLQitn3SnNpGw6k.8oZoWqEUFe46wc20TvWgrRUMwjuvulu', 'Rafael Sitorus', 'Laki-laki', 'Pekanbaru', '2009-12-29', '08127646776', 'SMP Negeri 1 Sungai Apit', 'Jalan Gajah Mada, RT 003/RW 007, Kecamatan Sungai Apit', 'smp', 'Siak', 'Riau', 'bayar_rafaelsitorus29@gmail.com_Bukti Pembayaran RE-SCIENCE.jpeg', 'profil_rafaelsitorus29@gmail.com_Foto Rafael Sitorus.jpeg', 1, 1, 0, 0, 1, 1, 0, 0, 125, 110, 0, 0, '3Menit 25Detik', '2Menit 10Detik', NULL, NULL, 1, NULL, 'QQzTIncf5uEERAfXabA51IvGbrUMVsI3QZRoFqFZ5VEnuWNf682Fv4fC7WvR', '2021-12-14 07:45:30', '2021-12-14 07:45:30'),
(1200, 'nixie.sanuya27@gmail.com', '$2y$10$QzyFxJKjpRIUGSXYtDMB3OfxbZg9c5bS9m5Djr/hiYO8UCnMk87VK', 'Ardi Pradikta Utama', 'Laki-laki', 'Boyolali', '2008-08-27', '081217735303', 'Ar Rohmah tahfidz', 'Jl locari no 17 dau sumber sekar malang', 'smp', 'Malang', 'Jawa Timur', 'bayar_nixie.sanuya27@gmail.com_IMG-20211214-WA0001.jpg', 'profil_nixie.sanuya27@gmail.com_Foto Santri_ardi PU_SMP.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 30, 0, 0, NULL, '50Menit 58Detik', NULL, NULL, 1, NULL, 'gYVD0S26YoTLWlBKL0CuIPijlf2Dz9LRLPixWee85LibK3xCqvhYlGV7UTrj', '2021-12-14 17:59:02', '2021-12-14 17:59:02'),
(1202, 'jasminefarahnaimah@rescience.com', '$2y$10$r1.xztXRQVk1uZQR7ufv/.YOFsKZ1/dUDEXAequqi4scKnv1f1ukm', 'Jasmine Farah Naimah H', 'Perempuan', 'Jember', '2003-06-15', '081329844585', 'Anna\'s Course', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_jasminefarahnaimah@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_jasminefarahnaimah@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '38Menit 34Detik', NULL, NULL, 1, NULL, 'rYwo0Oaey0MbnNvBKLAw6Ax0kbiDbzs3OGKt6RsFqUHay2wsuv6sCdVTVJUh', '2021-12-14 18:32:42', '2021-12-14 18:32:42'),
(1203, 'bintaninafisa@rescience.com', '$2y$10$jya21k6XAIsDqlRXd05jPeDANGhBcnI8m3Io1kGX3HX.LtPgGRq7e', 'BINTANI NAFISA F.', 'Perempuan', 'Jember', '2003-06-15', '082312456087', '\'SDI AL FURQON', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_bintaninafisa@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_bintaninafisa@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '31Menit 17Detik', NULL, NULL, 1, NULL, '7ZhDxBn9rv9POg5wLNRiwwrYYaZS4NDrwcFUUfM8LAg53V3sz8LOoZY9KP90', '2021-12-14 18:35:51', '2021-12-14 18:35:51'),
(1204, 'canayyapatrapuspa@rescience.com', '$2y$10$CDL94Nv6FSmfpkMzWPvfWOI5lQe8122NujGSzg02pkvuIaa1RJDIK', 'CANAYYA PATRA PUSPA', 'Perempuan', 'Jember', '2011-06-16', '081259234180', '\'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_canayyapatrapuspa@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_canayyapatrapuspa@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, NULL, '31Menit 3Detik', NULL, NULL, 1, NULL, 'J6q1aCttYcBUiTHDA3x3CjMBpt1TUPZt8Levq8P1yTFG6pEmCBr4wIXOTq0s', '2021-12-14 18:38:11', '2021-12-14 18:38:11'),
(1205, 'kyvanamozavia@rescience.com', '$2y$10$GJ5OxwlotLvpDQKI0Pztx..NBi/qPC9iFVzKo6w/uSsyzOtgtwY6.', 'KYVANA MOZAVIA R', 'Perempuan', 'Jember', '2010-06-11', '82228182994', '\'SDN KEPATIHAN 03', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_kyvanamozavia@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_kyvanamozavia@rescience.com_IMG-20211023-WA0030.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 70, 0, 0, NULL, '50Menit 54Detik', NULL, NULL, 1, NULL, '43uhUOBlrVcr6hOggEQO1PCNw4RIvhnysjvJoDRrsz2woWlkU98kBAgpD5jq', '2021-12-14 18:40:27', '2021-12-14 18:40:27'),
(1206, 'kalunafawwaz@rescience.com', '$2y$10$5UH4HuROPKohd.yScL/HHemCwYlMsgymBp4nKc46/Rz8OI1HPk64e', 'KALUNA FAWWAZ J.P.', 'Perempuan', 'Jember', '2003-06-15', '0892448529458', '\'SMPN 2 JEMBER', 'Jember', 'smp', 'Jember', 'Jawa Timur', 'bayar_kalunafawwaz@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_kalunafawwaz@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, NULL, '26Menit 29Detik', NULL, NULL, 1, NULL, 'Cq80c7vweJS3U5n8LCy5fHUNUBbrPZguecbxy88iZL37PNEvWRWlkzhxyoFG', '2021-12-14 18:42:56', '2021-12-14 18:42:56'),
(1207, 'chansamufidatunnisa@rescience.com', '$2y$10$VHJbqU4XhWFMj4nWo.7mseKJhlHDZ.Weqzb8u5nqw2JV00QFrY9ju', 'CHANSA MUFIDATUNNISA', 'Perempuan', 'Jember', '2009-08-10', '082132454047', '\'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_chansamufidatunnisa@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_chansamufidatunnisa@rescience.com_download.png', 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, 0, '7Menit 5Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 18:45:19', '2021-12-14 18:45:19'),
(1208, 'lanilituhayu@rescience.com', '$2y$10$KT4HO89v4An5LAtV.ZoFAeJzJJ/Qx7D3JClbmugG7TYbU0BTEELnW', 'LANI LITUHAYU R.D', 'Perempuan', 'Jember', '2003-06-15', '08765123456', '\'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_lanilituhayu@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_lanilituhayu@rescience.com_download.png', 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, 0, '13Menit 42Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 18:47:26', '2021-12-14 18:47:26'),
(1212, 'andhikafathurrohman55@gmail.com', '$2y$10$KUfVq43itMsQsQh9iQs7GuO6ZzDfwauoDvngPMAPsVe74TMm4dsx2', 'Andhika Fathurrohman', 'Laki-laki', 'Banyumas', '2004-04-08', '082220069347', 'SMAN 1 Purwokerto', 'Kelurahan Pasir Kidul RT 2 RW 3, Kec. Purwokerto Barat, Kab. Banyumas, Prov. Jawa Tengah', 'sma', 'Banyumas', 'Jawa Tengah', 'bayar_andhikafathurrohman55@gmail.com_photo1639532710.jpeg', 'profil_andhikafathurrohman55@gmail.com_photo1639532843.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 125, 0, 0, NULL, '17Menit 21Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 18:48:41', '2021-12-14 18:48:41'),
(1213, 'nyomanradhitya@rescience.com', '$2y$10$BmMJ3CfGaL/dGmapg21TGenGpg6pF/x68y3oWN5CPedmNYXQiAh/.', 'NYOMAN RADHITYA T.P', 'Laki-laki', 'Jember', '2011-03-30', '081252461796', '\'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_nyomanradhitya@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_nyomanradhitya@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 100, 0, 0, NULL, '32Menit 40Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 18:51:11', '2021-12-14 18:51:11'),
(1215, 'extreeyanaura@rescience.com', '$2y$10$5gaOOKGQsPlpb9pLQXCJBez5EydnQ0gUgzVcYiUIYj8ZJuUc8G3dm', 'EXTREEYA NAURA S.P.M.', 'Perempuan', 'Jember', '2011-02-01', '085336479501', '\'SDI AL BAITUL AMIN', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_extreeyanaura@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_extreeyanaura@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '45Menit 26Detik', NULL, NULL, 1, NULL, '8cknKEDdEzhejUqvdSVTbtCnWkXmf3RyTk6lcAl3NTtRssQmVBzH272TpUYf', '2021-12-14 18:53:33', '2021-12-14 18:53:33'),
(1217, 'chyndimakaila@rescience.com', '$2y$10$js24AEhKUfbkYBYxDtGiGOK3v9eS84HHli8YBcqck1x/hB5CYkvqm', 'CHYNDI MAKAILA S.', 'Perempuan', 'Jember', '2010-09-16', '086348585939', '\'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_chyndimakaila@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_chyndimakaila@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '55Menit 15Detik', NULL, NULL, 1, NULL, 'BH82Yk3Hy610x4L5ZgCzeJ1woeZOWLMmUaxzzvSms9ErcpT2i9Oei1CLhMfZ', '2021-12-14 18:55:58', '2021-12-14 18:55:58'),
(1220, 'cliantaadoniakhalda@rescience.com', '$2y$10$N1URiJAoqTdBNJRQRbaOFOQT5COVEvF.q3nIw3OlMXNy8Frlh4UQK', 'CLIANTA ADONIA KHALDA', 'Perempuan', 'Jember', '2003-06-15', '08976482848', '\'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_cliantaadoniakhalda@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_cliantaadoniakhalda@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '46Menit 58Detik', NULL, NULL, 1, NULL, 'QxQfgbGkblgjNT2Yin1DRNSsCBc2iu2MklwaeTPPkGBMg5ZMgFkd4PWwlScC', '2021-12-14 19:35:26', '2021-12-14 19:35:26'),
(1221, 'davin@rescience.com', '$2y$10$LWwLHC58L2FCBoO0CUZwoOD8dxrNN7lCoVtQIu78izRbJMQxhXK9i', 'M. DAVIN A.', 'Laki-laki', 'Jember', '2003-06-15', '086234123456', 'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_davin@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_davin@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '48Menit 31Detik', NULL, NULL, 1, NULL, 'lx0u2oScVGmAIZx4s5W8AJmhR89UAdJ57NhUFaPe398Lp73m34YhY2cKklDe', '2021-12-14 19:38:13', '2021-12-14 19:38:13'),
(1222, 'attayasakhi@rescience.com', '$2y$10$Y1SQ3JMri0FVnm3GY7D16up2Ire1PrZSibKE4WfQulMluYbkpuB4S', 'Attaya Sakhi Z.R.', 'Laki-laki', 'Jember', '2011-05-16', '082335775966', 'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_attayasakhi@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_attayasakhi@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, NULL, '31Menit 51Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 19:40:38', '2021-12-14 19:40:38'),
(1223, 'najwaacinta@rescience.com', '$2y$10$9HX6Ehyk4y4e94uDT11AW.qUeJbhtv73DFJhbdLi92/5eLh5J5WRG', 'NAJWA ACINTA A.P', 'Perempuan', 'Jember', '2003-06-15', '085332123567', 'SMPN 3 JEMBER', 'Jember', 'smp', 'Jember', 'Jawa Timur', 'bayar_najwaacinta@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_najwaacinta@rescience.com_download.png', 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, 0, '6Menit 39Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 19:42:42', '2021-12-14 19:42:42'),
(1225, 'dhiaulhaqfajri@rescience.com', '$2y$10$2oL.tJX5AgFGRe/Nh7DuhuR1hyBTJTIIg47Qth/RtWHZgOwGd05Pi', 'DHIAULHAQ FAJRI R', 'Perempuan', 'Jember', '2003-06-15', '0842481940835', 'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_dhiaulhaqfajri@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_dhiaulhaqfajri@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, NULL, '35Menit 38Detik', NULL, NULL, 1, NULL, '4VSECFh6TaGHPXbafuvsc035ODuIvAlEHZclG3JXWIHbqhaVpGXUlDcsBNIv', '2021-12-14 19:45:01', '2021-12-14 19:45:01'),
(1227, 'adristicayanisa@rescience.com', '$2y$10$fRBpRsCQoOM4djPswRSYOu1iIGUVkyNP6N7SH712XcCVWgUZun5e2', 'ADRISTI CAYA NISA', 'Perempuan', 'Jember', '2011-08-15', '081252739278', 'SDN JEMBER LOR 3', 'Jember', 'sd2', 'Jember', 'Jawa Timur', 'bayar_adristicayanisa@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_adristicayanisa@rescience.com_download.png', 1, 0, 0, 0, 1, 0, 0, 0, 110, 0, 0, 0, '50Menit 47Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 19:47:09', '2021-12-14 19:47:09'),
(1228, 'alvinshanjoypurnomo@rescience.com', '$2y$10$aB4NVeP0Qx8zYbF3s.spd.gjcmZ3ISJyE.4iAEORYniJqdncFSYqq', 'ALVIN SHAN JOY PURNOMO', 'Laki-laki', 'Bengkulu', '2003-01-15', '085273990032', 'SD PELITA KASIH CURUP', 'Jember', 'sd2', 'Bengkulu', 'Aceh', 'bayar_alvinshanjoypurnomo@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_alvinshanjoypurnomo@rescience.com_download.png', 1, 1, 0, 0, 1, 1, 0, 0, 110, 115, 0, 0, '47Menit 39Detik', '56Menit 46Detik', NULL, NULL, 1, NULL, 't4RNVwrYbnmHNBKisiDfWIIZgOqjOz9YlVo0bPU7zDLUAZx7Vmo2ulH2vUex', '2021-12-14 19:52:26', '2021-12-14 19:52:26'),
(1233, 'chikojonathan@rescience.com', '$2y$10$Q71Ps/R4hyOBrMp8bucD2.7jCDGkhpAJjTUXTrClbaw8HXIDZxTCS', 'CHIKO JONATHAN', 'Laki-laki', 'Bengkulu', '2003-01-15', '081373727265', 'SD PELITA KASIH CURUP', 'Bengkulu', 'sd2', 'Bengkulu', 'Bengkulu', 'bayar_chikojonathan@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_chikojonathan@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 'SY0ajuNs1AKRQBAdYpuJGLxR0wg4G9mmmQMGjoueOIRPbhKa1Do5VdKtetQN', '2021-12-14 19:59:28', '2021-12-14 19:59:28'),
(1240, 'eleorachavavanjelynepasaribu@rescience.com', '$2y$10$Br9sdoZ7y998YahlMHMDBeynHkSlPDuFLO9iku/2/ncls48fdWxF6', 'ELEORA CHAVA EVANJELYNE PASARIBU', 'Perempuan', 'bengku', '2010-01-05', '082159396763', 'SD PELITA KASIH CURUP', 'Bengkulu', 'sd2', 'Bengkulu', 'Aceh', 'bayar_eleorachavavanjelynepasaribu@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_eleorachavavanjelynepasaribu@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 'UJop7yfDN9i2oQtjBJXtskB5Y0SHKPccDnK6z3vORgCRMJQO7FbHrqxxIQXZ', '2021-12-14 20:11:25', '2021-12-14 20:11:25'),
(1243, 'ivanderalfharoginting@rescience.com', '$2y$10$m8JtjtOifBNVdcA6byZ2NeT1cfvoWSQSyTZDf2sdLvCX8YF78VMW6', 'IVANDER ALFHARO GINTING', 'Laki-laki', 'Bengkulu', '2003-01-15', '082378788703', 'SD PELITA KASIH CURUP', 'Bengkulu', 'sd2', 'Bengkulu', 'Bengkulu', 'bayar_ivanderalfharoginting@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_ivanderalfharoginting@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, NULL, '28Menit 11Detik', NULL, NULL, 1, NULL, '9zc1pGA46RUdVTOlIZBKUc7mDz3OQYympVIAJRpdMdtHI7r91ITWcxSfZaAf', '2021-12-14 20:15:15', '2021-12-14 20:15:15'),
(1245, 'sidraaltabbaa@rescience.com', '$2y$10$ZUXiOwG6D3qQ9Pie9wu33euwPo0JWErI5KNUQiNBPVPmJAqmZYefG', 'Sidra Altabbaa', 'Laki-laki', 'Jakarta Selatan', '2003-02-15', '085717353151', 'Sekolah Bakti Mulya 400', 'Jakarta Selatan', 'smp', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_sidraaltabbaa@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_sidraaltabbaa@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 100, 0, 0, NULL, '1Menit 33Detik', NULL, NULL, 1, NULL, 'RBQhc1Gq6KblqyxXznigmbzl2n5nURJzr8CmSG07zH5s1yBZNyxK6NBywYkk', '2021-12-14 20:20:06', '2021-12-14 20:20:06'),
(1248, 'cutjauzaaazzahra@rescience.com', '$2y$10$ObKcob72VfwcXg4ViTARcuVyxA9aEslXwe5BL1Jt2Qv9Cx8Un5kMK', 'Cut Jauzaa Azzahra', 'Perempuan', 'Banda Aceh', '2007-07-04', '085717353151', 'Sekolah Bakti Mulya 400', 'FELICE RESIDENCE, Jl. Jambu No.7, Rmh No 7B, RT 04 RW 06, Cemp. Putih, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten', 'smp', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_cutjauzaaazzahra@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_cutjauzaaazzahra@rescience.com_images.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, NULL, '8Menit 28Detik', NULL, NULL, 1, NULL, 'X8P4hbLw9EB5i9rMpMwsOKz9Ko1RpHOZ1r0XJax1w6x4sehEvyQT2V3bzXqK', '2021-12-14 20:26:01', '2021-12-14 20:26:01'),
(1249, 'haurakhairunisagustiyantoputri@rescience.com', '$2y$10$fDaeG9/SriXS2ALHqcf4leRQgw2vj69BvROHye6eVMpUJNJvPd52O', 'Haura Khairunisa Gustiyanto Putri', 'Perempuan', 'Jakarta Selatan', '2003-02-15', '085717353151', 'Sekolah Bakti Mulya 400', 'Jakarta Selatan', 'smp', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_haurakhairunisagustiyantoputri@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_haurakhairunisagustiyantoputri@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, '14Menit 41Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 20:27:48', '2021-12-14 20:27:48'),
(1250, 'razzanalghifari@rescience.com', '$2y$10$C0MORyoq6W1.Gu4KSqceI.sbmCSw20F2VPu3UoaBGFM/5uDzIPa3S', 'Razzan Alghifari', 'Laki-laki', 'Batam', '2008-02-13', '085813592220', 'Sekolah Bakti Mulya 400', 'Jalan maya garden nomer 30 kebayoran lama jakarta selatan', 'smp', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_razzanalghifari@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_razzanalghifari@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, NULL, '19Menit 22Detik', NULL, NULL, 1, NULL, 'ZclIsZRAcosyYdHZ5nwXwSya4V72xtVtaF1uReeX1qtJeCr3edvbQJt5XaJf', '2021-12-14 20:29:41', '2021-12-14 20:29:41'),
(1251, 'gwynethaninditaayuningtyas@rescience.com', '$2y$10$IlsUZacWPorGsyELE726BuQbMYbCT4VmYMhMBZPqqRt1hVXwByhr6', 'Gwyneth Anindita Ayuningtyas', 'Perempuan', 'Jakarta Selatan', '2007-11-07', '085717353151', 'Sekolah Bakti Mulya 400', 'Jakarta Selatan', 'smp', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_gwynethaninditaayuningtyas@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_gwynethaninditaayuningtyas@rescience.com_images.png', 1, 0, 0, 0, 1, 0, 0, 0, 60, 0, 0, 0, '3Menit 28Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 20:31:48', '2021-12-14 20:31:48'),
(1252, 'allunaamayra@rescience.com', '$2y$10$pBZtsOGMwduvVmYYhFRvyu.vQC8/CJZc/vBHfjG/Epmphw4QAykMS', 'Alluna Amayra', 'Perempuan', 'Jakarta Selatan', '2008-06-29', '081286009794', 'Sekolah Bakti Mulya 400', 'Jl. Tumaritis/11 Cilandak, Jakarta Selatan', 'smp', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_allunaamayra@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_allunaamayra@rescience.com_images.png', 1, 0, 0, 0, 1, 0, 0, 0, 85, 0, 0, 0, '5Menit 9Detik', NULL, NULL, NULL, 1, NULL, 'olF5UAQQnRiPhncPaGuz0yZDuiGTJFN1fdMDjji83Hc5JCNwT6F3gr1u2jsm', '2021-12-14 20:33:44', '2021-12-14 20:33:44'),
(1253, 'masayumaritzaadelianafis@rescience.com', '$2y$10$sy83xmQ.6nV4zXSu06n78OAWKjDJU8mxqL9V3Vlsrw9.OT.ocExOy', 'Masayu Maritza Adelia Nafis', 'Perempuan', 'Jakarta Selatan', '2007-01-01', '087876958628', 'Sekolah Bakti Mulya 400', 'Jl. Kebagusan 1 No. 9A', 'smp', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_masayumaritzaadelianafis@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_masayumaritzaadelianafis@rescience.com_images.png', 1, 0, 0, 0, 1, 0, 0, 0, 55, 0, 0, 0, '0Menit 19Detik', NULL, NULL, NULL, 1, NULL, 'azkkYWzhOXVywGADcfmBbaHSgzSJW2N14rficDveEpRtRBBjNYVXoB1U8SAB', '2021-12-14 20:35:32', '2021-12-14 20:35:32'),
(1254, 'cathleyalaiska@rescience.com', '$2y$10$//nfAXiCxTA/hnaOewwe.esAFBYUFJPDvzEm057SLU2dtlSQ4/OqG', 'Cathleya Laiska', 'Perempuan', 'Jakarta Selatan', '2008-12-27', '081513512629', 'Sekolah Bakti Mulya 400', 'Jakarta Selatan', 'smp', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_cathleyalaiska@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_cathleyalaiska@rescience.com_download.png', 1, 0, 0, 0, 1, 0, 0, 0, 60, 0, 0, 0, 'EXPIRED', NULL, NULL, NULL, 1, NULL, 'CUHz6l8klMJa2YTMfaWzWANOIRZT4KzF3ZlKyElS6R7iUcv3m2NR0SCVLz91', '2021-12-14 20:37:36', '2021-12-14 20:37:36'),
(1255, 'jonaswilliam@rescience.com', '$2y$10$cErEBxOUd8ueDiswx.V5yOSHOBVzO.aqOShNAfRIKna.GWa74A6ne', 'JONAS WILLIAM', 'Laki-laki', 'Jakarta Selatan', '2004-05-09', '085717353151', 'Sekolah Bakti Mulya 400', 'Jakarta Selatan', 'sma', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_jonaswilliam@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_jonaswilliam@rescience.com_EF717D03-7F9E-401C-9857-525429BC2FD0.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 35, 0, 0, NULL, '55Menit 37Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 20:39:33', '2021-12-14 20:39:33'),
(1256, 'daffaaryoseno@rescience.com', '$2y$10$2RDtNB3UVNBJg8omizM4.OXoeON5Q5gZZXQYGySZH1gjdagMeE0w.', 'DAFFA ARIOSENO', 'Laki-laki', 'Jakarta Selatan', '2004-03-09', '0816268210', 'Sekolah Bakti Mulya 400', 'jl Dempo 6 no 19 Kebayoran Baru', 'sma', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_daffaaryoseno@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_daffaaryoseno@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 55, 115, 0, 0, '54Menit 58Detik', '23Menit 59Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 20:41:21', '2021-12-14 20:41:21'),
(1257, 'tedypunya@gmail.com', '$2y$10$vCBV2NvQqbcWXyaV6ozrs.cKY7Iklk.Z0dCNaCmr1li9y/r7aEarC', 'Akbar Daffa Pratama', 'Laki-laki', 'Pontianak', '2013-05-12', '085787201226', 'SDIT Almumtaz Pontianak', 'Jl.Karet. Komp.Permata Usaha No A14. Pontianak Barat. Pontianak. Kalimantan Barat.', 'sd1', 'Kota Pontianak', 'Kalimantan Barat', 'bayar_tedypunya@gmail.com_Bukti Transfer.jpeg', 'profil_tedypunya@gmail.com_Photo Daffa.jpeg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '53Menit 13Detik', NULL, NULL, 1, NULL, 'khnQmY1exIn2dZWTF8JHx1YE17Sc8gNgyPipo7rW6l13qRaq5X8pMYbffns7', '2021-12-14 20:42:38', '2021-12-14 20:42:38'),
(1258, 'andhiansyahpadmasena@rescience.com', '$2y$10$f/uhfpD4Efk0nZ8YOEWFHuAAN955c1p.jV6yOrMlmnrF1FMdCDOTC', 'ANDHIANSYAH PADMASENA M. D', 'Laki-laki', 'Jakarta Barat', '2003-08-15', '08111387010', 'Sekolah Bakti Mulya 400', 'Jakarta Barat, Kebon Jeruk, Kelapa Dua', 'sma', 'Jakarta Barat', 'DKI Jakarta', 'bayar_andhiansyahpadmasena@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_andhiansyahpadmasena@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 125, 0, 0, NULL, '5Menit 6Detik', NULL, NULL, 1, NULL, 'i1Olv3dt3wUCpyHU9zCeP7SCdtPCZZv0ih7IQNBS7tl9jxFsMQgdCxlIiyhE', '2021-12-14 20:42:57', '2021-12-14 20:42:57'),
(1259, 'mirzaadjiepoernomo@rescience.com', '$2y$10$C3rySzQl6AhjL7vVRN.NDOCbARtHjj1uenJUpRFbwCuLtCMsysYNq', 'MIRZA ADJIE POERNOMO', 'Laki-laki', 'Jakarta Selatan', '2003-11-27', '085717353151', 'Sekolah Bakti Mulya 400', 'Jakarta Selatan', 'sma', 'Jakarta Selatan', 'DKI Jakarta', 'bayar_mirzaadjiepoernomo@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_mirzaadjiepoernomo@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '31Menit 29Detik', NULL, NULL, 1, NULL, 'nBsFhYfQg3byfzstM1jJulg3TCiWZvqXwDmFQWTt8UIkC6i53jDpbCaTrxv0', '2021-12-14 20:44:44', '2021-12-14 20:44:44'),
(1260, 'azkiyakhusnulainy@rescience.com', '$2y$10$9aotMQhfd9Oe9h/1FK6rTObPVf.tz7uKu02A9mQ8vx1GKk.lIUzne', 'Azkiya Khusnul Ainy', 'Perempuan', 'Sumedang', '2008-06-23', '081223004124', 'SMP IT Insan Sejahtera', 'Sumedang Jawa Barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_azkiyakhusnulainy@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_azkiyakhusnulainy@rescience.com_images.png', 1, 1, 0, 0, 1, 1, 0, 0, 65, 60, 0, 0, '0Menit 2Detik', '55Menit 6Detik', NULL, NULL, 1, NULL, 'aQqFlSRrxfhY7tgsDHej18XWA3jI6Gxg2yohU6kv80AAUSN5xVV29gqtwcq1', '2021-12-14 20:49:11', '2021-12-14 20:49:11'),
(1261, 'cathleachalisahakim@rescience.com', '$2y$10$ML5kzJ0WA8p/V/YsztPPGOnL2/XRSMxVjpymvDS9bgVN.85Tp.h96', 'Cathlea Chalisa Hakim', 'Perempuan', 'Sumedang', '2007-12-07', '089656572204', 'SMP IT Insan Sejahtera', 'Sumedang Jawa Barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_cathleachalisahakim@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_cathleachalisahakim@rescience.com_download.png', 1, 1, 0, 0, 1, 1, 0, 0, 75, 30, 0, 0, '20Menit 47Detik', '59Menit 45Detik', NULL, NULL, 1, NULL, 'VX9ZZ4i616dh5aGAvw2rAEPJWN5CM7kaJXhPXKlBqjaeZLIh3XmUvikf05ic', '2021-12-14 20:51:12', '2021-12-14 20:51:12'),
(1262, 'fatihasysyariefshoimuddin@rescience.com', '$2y$10$z32iAtWsmL6ME8tK5jkmTexWVrJDWRAFCVJksOwOyo2zie9RUmsKW', 'Fatih Asy Syarief Shoimuddin', 'Laki-laki', 'Depok', '2008-02-22', '081313564450', 'SMP IT Insan Sejahtera', 'Perum kampung toga blok g no.1 desa Surabaya kecamatan Sumedang Selatan Kabupaten/kota Sumedang provinsi Jawa barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_fatihasysyariefshoimuddin@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_fatihasysyariefshoimuddin@rescience.com_images.png', 1, 1, 0, 0, 1, 1, 0, 0, 35, 65, 0, 0, '28Menit 46Detik', '51Menit 44Detik', NULL, NULL, 1, NULL, 'TJxBfuKJYaVzKy5RhRLvtOPkC7NG6HWA51tVn3obBsM6VsvEmuQOzK942Lh7', '2021-12-14 20:53:02', '2021-12-14 20:53:02'),
(1263, 'kameliaaisyahzahrah@rescience.com', '$2y$10$KhDVW4ctVM0yajdcyGqb4eEHLx/CDGkfWHq2EEl9ZvSloThLo50ou', 'Kamelia Aisyah Zahrah', 'Perempuan', 'Sumedang', '2007-07-29', '082116065896', 'SMP IT Insan Sejahtera', 'Sumedang Jawa Barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_kameliaaisyahzahrah@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_kameliaaisyahzahrah@rescience.com_images.png', 1, 1, 0, 0, 1, 1, 0, 0, 115, 115, 0, 0, '22Menit 12Detik', '27Menit 2Detik', NULL, NULL, 1, NULL, '3stMf5TIBHknnbNE4FCw2VTVCBgA6ArLfMVEIIhgxa8tLjvnMRSyeyHGcCKf', '2021-12-14 20:54:59', '2021-12-14 20:54:59'),
(1264, 'kaylanissasyahlaghandi@rescience.com', '$2y$10$y0kBPjiUImz9yl05luQJkODoMDVgux9ZJ1JA8SX6z/bzk6OmJU9rG', 'Kayla Nissa Syahla Ghandi', 'Perempuan', 'Sumedang', '2003-03-15', '081313564450', 'SMP IT Insan Sejahtera', 'Sumedang Jawa Barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_kaylanissasyahlaghandi@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_kaylanissasyahlaghandi@rescience.com_download.png', 1, 1, 0, 0, 1, 1, 0, 0, 90, 80, 0, 0, '34Menit 12Detik', '35Menit 56Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 20:56:36', '2021-12-14 20:56:36'),
(1265, 'kiranaamil@rescience.com', '$2y$10$8qwzkHJd3coL3ucsBz/cLeg.XZO6BvVLBZ43ZpELwEfgri9CFJmCS', 'Kirana Kamil', 'Perempuan', 'Sumedang', '2008-02-16', '081221945858', 'SMP IT Insan Sejahtera', 'Sumedang Jawa Barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_kiranaamil@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_kiranaamil@rescience.com_images.png', 1, 1, 0, 0, 1, 1, 0, 0, 70, 85, 0, 0, '28Menit 3Detik', '57Menit 53Detik', NULL, NULL, 1, NULL, 'iOVbiL4gSRYmHLmeamGYaaT68CPgHXUpmWmmdDcShyLXbsKVV6ON3OyZswCO', '2021-12-14 20:58:18', '2021-12-14 20:58:18'),
(1266, 'mochamadkrisnadilaga@rescience.com', '$2y$10$hzL27rjNfsbKPUveVY2EDujy7AVKyMRKqMhj3.0ARTU6uPWI/5WOK', 'Mochamad Krisna Dilaga', 'Laki-laki', 'Sumedang', '2008-02-28', '082130921869', 'SMP IT Insan Sejahtera', 'jalan serma muchtar baru 2 no 62 RT 05 RW 05,sumedang utara,situ,sumedang jawa barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_mochamadkrisnadilaga@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_mochamadkrisnadilaga@rescience.com_images.png', 1, 1, 0, 0, 1, 1, 0, 0, 55, 60, 0, 0, '52Menit 39Detik', '48Menit 11Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 21:00:19', '2021-12-14 21:00:19'),
(1267, 'nailahwafaayudiahariyanto@rescience.com', '$2y$10$c0giyFrROKUQhsNWfjasOOu6ThfNQh2bFbD8Ea24e4M4RKKHlGnry', 'Nailah Wafa Ayudia Hariyanto', 'Perempuan', 'Sumedang', '2009-01-27', '081235528908', 'SMP IT Insan Sejahtera', 'Perum Griya Pesona Alam Blok AA1-1 RT 005 RW 005, Desa Rancamulnya, Kecamatan Sumedang Utara, Kabupaten Sumedang', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_nailahwafaayudiahariyanto@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_nailahwafaayudiahariyanto@rescience.com_images.png', 1, 1, 0, 0, 1, 1, 0, 0, 110, 105, 0, 0, '38Menit 44Detik', '30Menit 8Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 21:02:05', '2021-12-14 21:02:05'),
(1268, 'natayamahadewi@rescience.com', '$2y$10$blQU.JvGqe29fvhU8YsR1uQLpio3n1uXnJ8f6xI4Zj5zbvM1K2WCG', 'Nataya Mahadewi', 'Perempuan', 'Sumedang', '2007-06-19', '081224733595', 'SMP IT Insan Sejahtera', 'Angkrek Regency Jl. Cendana No. 4, Situ, Sumedang Utara, Sumedang, Jawa Barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_natayamahadewi@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_natayamahadewi@rescience.com_C577B17D-2E3D-4ECC-BC73-D888486DC634.jpeg', 1, 1, 0, 0, 1, 1, 0, 0, 120, 110, 0, 0, '19Menit 43Detik', '36Menit 19Detik', NULL, NULL, 1, NULL, 'q6mnOeUnZ3wqrHcZVd8FWQEtVpqYDaNyJEYU8BLdC0vEUGj8x7WqZAJXyvIx', '2021-12-14 21:03:43', '2021-12-14 21:03:43'),
(1269, 'salwafadilah@rescience.com', '$2y$10$MZTS6xZ8fricmnHIWBkwK.orOA1YY/i.H3UdvRY4n3BkDJWBVw2QG', 'Salwa Fadilah', 'Perempuan', 'Sumedang', '2008-04-08', '082110127057', 'SMP IT Insan Sejahtera', 'Sumedang Jawa Barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_salwafadilah@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_salwafadilah@rescience.com_download.png', 1, 1, 0, 0, 1, 1, 0, 0, 90, 65, 0, 0, '26Menit 4Detik', '34Menit 11Detik', NULL, NULL, 1, NULL, 'gBUyo6CI1rIIT6I8nJCeWWyTHgwmHGUafxbuPgz4jO5gIpatMdOSFY0hbyWo', '2021-12-14 21:05:33', '2021-12-14 21:05:33'),
(1270, 'rhadistyayundianurfauziah@rescience.com', '$2y$10$kKM/TRclTmRk3zYOWSWfRuto.vUJn7pwk7caywkUXmSzC5JhTUKlK', 'Rhadisty Ayundia Nur Fauziah', 'Perempuan', 'Sumedang', '2003-03-15', '081313564450', 'SMP IT Insan Sejahtera', 'Sumedang Jawa Barat', 'smp', 'Sumedang', 'Jawa Barat', 'bayar_rhadistyayundianurfauziah@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_rhadistyayundianurfauziah@rescience.com_images.png', 1, 1, 0, 0, 1, 1, 0, 0, 60, 30, 0, 0, '1Menit 49Detik', '47Menit 27Detik', NULL, NULL, 1, NULL, 'T38t0A8xwC5on2nceEST3X8DppSzKpwVf9FQPYE0fkoOJKBO2DZyM8gsimB9', '2021-12-14 21:07:25', '2021-12-14 21:07:25'),
(1271, 'naufalnabighramadhan@rescience.com', '$2y$10$5cHAsjVPEYdyTCafpmO30.zZuP/C2PdwLXmqwbUUd7.luT1owHilS', 'Naufal Nabigh Ramadhan', 'Laki-laki', 'Makassar', '2011-08-06', '082348438168', 'SD SEKOLAH ALAM BOSOWA', 'Makasar', 'sd2', 'Makassar', 'Aceh', 'bayar_naufalnabighramadhan@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_naufalnabighramadhan@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 65, 0, 0, 0, '5Menit 47Detik', NULL, NULL, NULL, 1, NULL, 'vBHIPSaRav8U5SuhpIfrUibLwti3RJz4gP9hiHEvYPUNj3z84PigvE5RAcT4', '2021-12-14 21:12:21', '2021-12-14 21:12:21'),
(1272, 'zakiradikaputra@rescience.com', '$2y$10$smofvr.C1/5S13OYZNL3KefN3GABS2ykHutZpfDm1clice8wT/zyO', 'Zaki Radika Putra', 'Laki-laki', 'Pekanbaru', '2012-04-22', '082348438168', 'SD SEKOLAH ALAM BOSOWA', 'Makassar', 'sd2', 'Makassar', 'Sulawesi Selatan', 'bayar_zakiradikaputra@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_zakiradikaputra@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 35, 0, 0, 0, '30Menit 44Detik', NULL, NULL, NULL, 1, NULL, 'WyGPQDvTAKSyPW4eTVXwuabRGc7xPxI9wC5QVy0fa9P1vJZWmdfp3QJHnqFT', '2021-12-14 21:14:26', '2021-12-14 21:14:26'),
(1273, 'danirahmaanwijanarko@rescience.com', '$2y$10$nX3j2Uow/VSj/jSqSo46a.boL2cn1W2tgyy7V8fhmxpCBTCt1dKdC', 'Dani Rahmaan Wijanarko', 'Laki-laki', 'Jakarta', '2011-01-19', '082348438168', 'SD SEKOLAH ALAM BOSOWA', 'Makassar', 'sd2', 'Makassar', 'Sulawesi Selatan', 'bayar_danirahmaanwijanarko@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_danirahmaanwijanarko@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 125, 0, 0, NULL, '45Menit 6Detik', NULL, NULL, 1, NULL, 'gfcZH3lt9BaELHgC2uRt1umBsNf1CZENz0ZBqxUkGZK87pyimuDI2CwWp00y', '2021-12-14 21:16:21', '2021-12-14 21:16:21'),
(1274, 'rifqyfayyad@rescience.com', '$2y$10$UddoCi099yzxMo6OL8Y7a.q7JqEPKnsuliQHsMggdZ7T6DSzM.UaW', 'Rifqy fayyad khalfani azis', 'Laki-laki', 'Jakarta', '2009-11-02', '+6281513079003', 'SMP INTEGRAL AR-ROHMAH MALANG', 'Jl. Locari No. 19', 'smp', 'Malang', 'Jawa Timur', 'bayar_rifqyfayyad@rescience.com_IMG-20211215-WA0006.jpg', 'profil_rifqyfayyad@rescience.com_IMG-20211215-WA0006.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 100, 0, 0, NULL, '43Menit 51Detik', NULL, NULL, 1, NULL, 'LB4ua9YWKGYDv01GLL2TNguuStBPmeU1OrdEdOMebOlDsCnB8cVKYrJUrLJB', '2021-12-14 21:18:25', '2021-12-14 21:18:25'),
(1275, 'saqfildanendrakenzie@rescience.com', '$2y$10$MrBG/KVwxh11EWxfmodPaebvK/mu98dp2PB06Jo6to3ipt5Ss3Xx.', 'Saqfil Danendra Kenzie P', 'Laki-laki', 'Makassar', '2011-04-10', '087846339150', 'SD SEKOLAH ALAM BOSOWA', 'Jl. Cendrawasih No.275 D', 'sd2', 'Makassar', 'Sulawesi Selatan', 'bayar_saqfildanendrakenzie@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_saqfildanendrakenzie@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 80, 0, 0, NULL, '48Menit 27Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 21:18:29', '2021-12-14 21:18:29'),
(1276, 'awmunandari@gmail.com', '$2y$10$PwwOnXoAi4MY4/2ac7.VleX3zvzTGseF3rHxggt1E5emXykqU13t2', 'Ibrahim Naufal Zuhdi', 'Laki-laki', 'Sidoarjo', '2010-12-06', '087856684088', 'SD Muhammadiyah 1 Pucanganom Sidoarjo', 'Candi, Sidoarjo', 'sd2', 'Sidoarjo', 'Jawa Timur', 'bayar_awmunandari@gmail.com_IMG-20211215-WA0039.jpg', 'profil_awmunandari@gmail.com_20210617_003333.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '53Menit 30Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 21:20:39', '2021-12-14 21:20:39'),
(1277, 'muhammadakmallatief@rescience.com', '$2y$10$7ZuP0FXi.vsUMyx2D5/zX.Qw2m9imSHAh5N0qWjI0l/hYW4jNz7lm', 'Muhammad Akmal Lathif', 'Laki-laki', 'Bandung', '2007-11-09', '082127556965', 'SMPIT Assyifa Boarding School', 'Jl. Situsari 6 no.31', 'smp', 'Bandung', 'Jawa Barat', 'bayar_muhammadakmallatief@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_muhammadakmallatief@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 85, 0, 0, NULL, '19Menit 13Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 21:23:26', '2021-12-14 21:23:26');
INSERT INTO `users` (`id`, `email`, `password`, `name`, `kelamin`, `tempat`, `date`, `nomorhp`, `sekolah`, `alamat`, `tingkatan`, `kota`, `provinsi`, `bukti_bayar`, `foto_profil`, `hasmtk`, `hasipa`, `hasbing`, `hasips`, `statmtk`, `statipa`, `statbing`, `statips`, `nilaimtk`, `nilaiipa`, `nilaibing`, `nilaiips`, `timermtk`, `timeripa`, `timerbing`, `timerips`, `hasverif`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1278, 'kenziemaulna@rescience.com', '$2y$10$P6LsISAwM5K0H3E2oiCJs.bU6HSiwJM2qPIMsJioTdUxRU1YO94e2', 'Kenzie Maulana Badja W.', 'Laki-laki', 'Yogyakarta', '2009-10-09', '082127556965', 'SMPIT Assyifa Boarding School', 'Griya rajawali bintaro 1 sawah baru ciputat tangerang selatan', 'smp', 'Tangerang selatan', 'Banten', 'bayar_kenziemaulna@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_kenziemaulna@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 60, 0, 0, NULL, '46Menit 20Detik', NULL, NULL, 1, NULL, 'uTS1GkFo7WbKhRkVKbuxooFhbd4aGDlggIjCycNVXAp43CcJVqP1p2HiILhc', '2021-12-14 21:25:56', '2021-12-14 21:25:56'),
(1280, 'nohantadya@rescience.com', '$2y$10$06JiN72zvXNyCzEihJ53huJBsni4QjfzGR3WnYe.KOldInsszgRia', 'Nohan Tadya Reiffan Kharisma', 'Laki-laki', 'Semarang', '2008-06-24', '08156560794', 'SMPIT Assyifa Boarding School', 'Puri juanda regency, Blok M no.19 Jl Dharmawangsa III Bekasi Timur', 'smp', 'Bekasi', 'Jawa Barat', 'bayar_nohantadya@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_nohantadya@rescience.com_20211217_150342.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 65, 0, 0, 0, 'EXPIRED', NULL, NULL, NULL, 1, NULL, 'x7SuTeJajxOUNCnTTxSOB1aK5DCWh1xSULyhaxyVUbUJoIoFuq38eGuZWqYK', '2021-12-14 21:30:42', '2021-12-14 21:30:42'),
(1281, 'muhammadraja@rescience.com', '$2y$10$EKuW3YxnRyejMwjU8r/PCe4CJJh5LC7Xh5s5OJbp6iSyhA.eDcVya', 'Muhammad Raja Niawana', 'Laki-laki', 'bekasi', '2008-02-24', '082127556965', 'SMPIT Assyifa Boarding School', 'bekasi', 'smp', 'bekasi', 'Jawa Barat', 'bayar_muhammadraja@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_muhammadraja@rescience.com_16398028337888455837136024071032.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 55, 0, 0, 0, '5Menit 39Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 21:32:22', '2021-12-14 21:32:22'),
(1282, 'ahzanabihan@rescience.com', '$2y$10$/sI4AWVZ3uLOKjo50hcgsOPfhGglPfboWnrxR7jzSwJgi2yK4zmA2', 'Ahza Nabihan', 'Laki-laki', 'Bekasi', '2008-10-10', '082127556965', 'SMPIT Assyifa Boarding School', 'Pr. Taman Aster, Telaga Asih, Bekasi, Jawa barat', 'smp', 'Bekasi', 'Jawa Barat', 'bayar_ahzanabihan@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_ahzanabihan@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 35, 0, 0, 0, '37Menit 46Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 21:34:09', '2021-12-14 21:34:09'),
(1283, 'nadiyahkhairani@rescience.com', '$2y$10$w0BfUEr5Gfm7IU05MY35Vu4CSq2FBUYOXATW9oPKBFbVvERYFJfxe', 'Nadiyah Khairani', 'Perempuan', 'Banyuwangi', '2008-08-02', '081931057567', 'SMP AR-ROHMAH PUTRI', 'JL. Raya Jambu No. 01 Sumber Sekar, Dau, Malang', 'smp', 'Malang', 'Jawa Timur', 'bayar_nadiyahkhairani@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_nadiyahkhairani@rescience.com_download.png', 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, 0, '0Menit 30Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 21:37:58', '2021-12-14 21:37:58'),
(1284, 'cahayamedinakurniasari@rescience.com', '$2y$10$FLhQjYXF0b2Rl6w44Xw11e0REaTn6qGwrK4xOJK6X9sVPwKt1qnJO', 'Cahaya Medina Kurniasari', 'Perempuan', 'Malang', '2008-11-22', '081931057567', 'SMP AR-ROHMAH PUTRI', 'Malang', 'smp', 'Malang', 'Jawa Timur', 'bayar_cahayamedinakurniasari@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_cahayamedinakurniasari@rescience.com_download.png', 1, 0, 0, 0, 1, 0, 0, 0, 65, 0, 0, 0, '19Menit 44Detik', NULL, NULL, NULL, 1, NULL, 'LK4XQw2ZZv2XLg54ELN3Ct1gyEcB50Mmkfz9tcalhc4bmajgjdJgVD7fqMU2', '2021-12-14 21:39:52', '2021-12-14 21:39:52'),
(1285, 'nisrinafazila@rescience.com', '$2y$10$T7O8T.pHcmfbT9D71Vk2Y.pYgRZrD9DPkP/.MdByRhXaHv61P12xK', 'Nisrina Fazila', 'Perempuan', 'Banyuwangi', '2006-05-12', '081931057567', 'SMP AR-ROHMAH PUTRI', 'Jl Raya Jambu 01 Sumbersekar Dau Malang', 'smp', 'Malang', 'Jawa Timur', 'bayar_nisrinafazila@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_nisrinafazila@rescience.com_images.png', 1, 0, 0, 0, 1, 0, 0, 0, 90, 0, 0, 0, '0Menit 1Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-14 21:41:46', '2021-12-14 21:41:46'),
(1286, 'hanafajri@rescience.com', '$2y$10$ve5mXBnuUtKfoe0elW.lQu1gf89CAVnf6YhwUpyVYhHKNIJOIHDnC', 'Hana Fajri', 'Perempuan', 'Malang', '2003-07-15', '081931057567', 'SMP AR-ROHMAH PUTRI', 'Malang', 'smp', 'Malang', 'Jawa Timur', 'bayar_hanafajri@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_hanafajri@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '31Menit 18Detik', NULL, NULL, 1, NULL, 'fvUHiZ3GAKw87zSBlrq6CErPZq4udTkxAMCyvteWsXGEym4il4LaKQ7A7jDZ', '2021-12-14 21:43:51', '2021-12-14 21:43:51'),
(1287, 'roveynacallistasetiawan@rescience.com', '$2y$10$V6WZcg3PKCUhR/N.D/zMJevZB54ooRq6/O.lE0Y3UhNDhufWtTPX.', 'Roveyna Callista Setiawan', 'Perempuan', 'Trenggalek', '2006-09-08', '081331606190', 'SMP AR-ROHMAH PUTRI', 'Malang', 'smp', 'Malang', 'Jawa Timur', 'bayar_roveynacallistasetiawan@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_roveynacallistasetiawan@rescience.com_images.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 105, 0, 0, NULL, '44Menit 39Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 21:49:06', '2021-12-14 21:49:06'),
(1288, 'calistaaqilaariani@rescience.com', '$2y$10$kIwcYnx/brcUaqiFsFOjHevMjrIM/QMbOEi51qwB9sD2XbD4Rey.i', 'Calista Aqila Ariani', 'Perempuan', 'Malang', '2003-07-15', '081931057567', 'SMP AR-ROHMAH PUTRI', 'Malang', 'smp', 'Malang', 'Jawa Timur', 'bayar_calistaaqilaariani@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_calistaaqilaariani@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 70, 0, 0, NULL, '40Menit 28Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 21:50:43', '2021-12-14 21:50:43'),
(1289, 'diandraalthafunnisa@rescience.com', '$2y$10$TqmKauJXyMQAgtxaoGYgHOKKRUDkxI0Ed6FLTuwiJWb6dx3A8gtF6', 'Diandra Althafunnisa', 'Perempuan', 'Surabaya', '2008-05-08', '081931057567', 'SMP AR-ROHMAH PUTRI', 'Malang', 'smp', 'Malang', 'Jawa Timur', 'bayar_diandraalthafunnisa@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_diandraalthafunnisa@rescience.com_images.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 100, 0, 0, NULL, '37Menit 7Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 21:52:26', '2021-12-14 21:52:26'),
(1290, 'ghibran@rescience.com', '$2y$10$SBHlb5KnGflQjbkQWgrtcu/Utt0VdenqUSc4BwjqSkaDjm8DPsYAu', 'Ghibran', 'Laki-laki', 'Jayapura', '2009-12-15', '08213478597', 'SD Alam Ar Rohmah', 'Malang', 'sd2', 'Malang', 'Jawa Timur', 'bayar_ghibran@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_ghibran@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 140, 0, 0, 0, '5Menit 46Detik', NULL, NULL, NULL, 1, NULL, 'YEJV0cfAPuk97pdfuT51Ct80ay4st52HxRL92Jdzb60iSuWLrYeQ3LemHqdb', '2021-12-14 22:00:03', '2021-12-14 22:00:03'),
(1291, 'anugrahputraramadan@rescience.com', '$2y$10$N/C9E6.io4qxaGMu5UAWle4yF69c.cTTYZmAXkcsj7MCupjgiEZ8K', 'ANUGRAH PUTRA RAMADAN', 'Laki-laki', 'Curup', '2011-08-15', '081245738593', 'SD NEGERI 01 REJANG LEBONG', 'Curup', 'sd2', 'Curup', 'Bengkulu', 'bayar_anugrahputraramadan@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_anugrahputraramadan@rescience.com_person-icon-male-user-profile-avatar-vector-18833568.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, 0, '12Menit 33Detik', NULL, NULL, NULL, 1, NULL, 'gamDkaOEm3RqyFBaxRXWYlS7RkRvLah1qWpgyJCLdo5qbgm1S2gAa0kVYRka', '2021-12-14 22:28:34', '2021-12-14 22:28:34'),
(1292, 'keikoviniziohendrison@rescience.com', '$2y$10$5OabgDjF7ZtzkGhJZiBVZuzdAI.y4S5Dw.HkMBhDH38Jsa2Rhitj6', 'KEIKO VINIZIO HENDRISON', 'Perempuan', 'Curup', '2010-02-02', '081252493949', 'SMP XAVERIUS', 'Curup', 'smp', 'Curup', 'Bengkulu', 'bayar_keikoviniziohendrison@rescience.com_c9903451bf109cc7e3b504e83ff66b18.jpg', 'profil_keikoviniziohendrison@rescience.com_download.png', 0, 1, 0, 0, 0, 1, 0, 0, 0, 95, 0, 0, NULL, '17Menit 38Detik', NULL, NULL, 1, NULL, '5QrwfyyK3lwgvW1TckYUKUBFQHbRh48pgAdSAC2WlAEFxCZ8rG8UcKPUhy7u', '2021-12-14 22:30:37', '2021-12-14 22:30:37'),
(1294, 'gerrardsihole01@gmail.com', '$2y$10$ZoQZPXKo4tJWOWr0a4FFWeazCWSY7UxcLsKrGJi7I/xGVe.EI52aC', 'Steven Andrean Gerrard Sihole', 'Laki-laki', 'Curup', '2009-05-01', '08999105961', 'SMP NEGERI 1 REJANG LEBONG', 'Air Meles bawah Curup bengkulu', 'smp', 'Rejang Lebong', 'bengkulu', 'bayar_gerrardsihole01@gmail.com_IMG-20211215-WA0007.jpg', 'profil_gerrardsihole01@gmail.com_IMG-20211215-WA0006.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 65, 0, 0, NULL, '47Menit 29Detik', NULL, NULL, 1, NULL, NULL, '2021-12-14 23:18:35', '2021-12-14 23:18:35'),
(1295, 'pandunathanielsidabutar@gmail.com', '$2y$10$zhzhXpU3faxJ6NNdbDMXQOStfcdsbTYuWW8/yZfM83rt.ZSUwrKHa', 'Pandu Nathaniel Febrian Sidabutar', 'Laki-laki', 'Bengkulu', '2010-02-07', '081274798456', 'Pelita kasih curup', 'Jln. Perumahan griya Regency RT. 8 RW.3 kelurahan Air Bang Curup Tengah \r\nPropinsi Bengkulu', 'sd2', 'Rejang Lebong', 'Aceh', 'bayar_pandunathanielsidabutar@gmail.com_IMG-20211214-WA0004.jpg', 'profil_pandunathanielsidabutar@gmail.com_IMG-20211214-WA0006.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 100, 0, 0, 0, '42Menit 6Detik', NULL, NULL, NULL, 1, NULL, 'QchXhpJhrzE50O2oJJ7rK6zmi28dagFbcsSG7nFGJ34uB3aamRPbYUwVSNpa', '2021-12-15 01:58:06', '2021-12-15 01:58:06'),
(1298, 'wildanadzaky214@gmail.com', '$2y$10$CBQFBVayysFxMV7jVbcaIOn4B5JNMlZG7ajQbBlo85U./PwgAlInq', 'Muhammad Wildan Adzaky', 'Laki-laki', 'Jember', '2009-08-14', '089515796136', 'SD Al Furqon Jember', 'Perum Bumi Kaliwates jl.Nusantara D20', 'sd2', 'Jember', 'Jawa Timur', '', 'profil_wildanadzaky214@gmail.com_IMG_20211126_110128_689.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 115, 0, 0, NULL, '42Menit 2Detik', NULL, NULL, 1, NULL, 'OSGQwhxvIuHSJ6LbrPzZ4k4flklpL6ITAuwGaeeURU2I9WPigHNmBIIVFzCi', '2021-12-15 03:43:35', '2021-12-15 03:43:35'),
(1305, '123nurmufidah@gmail.com', '$2y$10$uVQFV3VTPfAaUcQu7p3k7e.ec2FbEqT0Pgl5BLeeTHC7pAIZQQ/Mq', 'Maghfiroh izzani maulania', 'Perempuan', 'Bojonegoro', '2008-12-06', '085755026476', 'MTSN 1 lamongan', 'Jl. Raya Plaosan babat Lamongan', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_123nurmufidah@gmail.com_IMG20211111143613.jpg', 'profil_123nurmufidah@gmail.com_IMG20211111060540.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 80, 0, 0, 0, '3Menit 47Detik', NULL, NULL, NULL, 1, NULL, 'oxH3v0Knyw0xCmnfJgFrsPs1Q6j66neZ3TLDz64rbCpNkNLf8DJ5FJdL0nvM', '2021-12-15 19:54:38', '2021-12-15 19:54:38'),
(1306, 'gartikasrizal@gmail.com', '$2y$10$cpxA/MEvZxbUOLa/5Ud4X.T20GXALcHha3TnNg9DLL5SiqheXu0KS', 'Gheiza Difa\'ulhaq', 'Perempuan', 'Bandung', '2008-11-25', '085100198284', 'MTs Zakaria Bandung', 'Buah Batu Regency D4 number 6', 'smp', 'Bandung', 'Jawa Barat', 'bayar_gartikasrizal@gmail.com_Screenshot_20211127-172840_BCA mobile.jpg', 'profil_gartikasrizal@gmail.com_Screenshot_20211127-173608_Gallery.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 35, 0, 0, 0, '18Menit 55Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-17 00:46:13', '2021-12-17 00:46:13'),
(1309, 'nasutionkenny35@gmail.com', '$2y$10$OI76kLrNjKk4uz3MAqwo6uQ1Pc8WkYboQQmIuC/GEeGcEvB15MwLK', 'Muhammad Kenny Nasution', 'Laki-laki', 'Jakarta', '2003-11-21', '081212853495', 'Bakti Mulya 400', 'Jl Mertilang XVII KC 1 no 2 Bintaro Sektor 9', 'sma', 'Tangerang Selatan', 'Banten', 'bayar_nasutionkenny35@gmail.com_Screenshot_20211217-203907.png', 'profil_nasutionkenny35@gmail.com_IMG_20211208_232719_153.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 120, 0, 0, NULL, '5Menit 19Detik', NULL, NULL, 1, NULL, NULL, '2021-12-17 06:45:10', '2021-12-17 06:45:10'),
(1312, 'ervandiwajra@rescience.com', '$2y$10$aUF84u1WkuwUHiGMB3uloeU5xkpcTYmN/DKsi2HOgmkjQzHgXbJ62', 'ERVANDI WAJRA SENA SIHOLE', 'Laki-laki', 'REJANG LEBONG', '2014-03-30', '082371306522', 'SD Pelita Kasih Curup', 'AIR MELES', 'sd1', 'Rejang Lebor', 'Aceh', 'bayar_ervandiwajra@rescience.com_bayar_simbolonjuwita44@gmail.com_WhatsApp Image 2021-11-12 at 8.52.53 AM.jpeg', 'profil_ervandiwajra@rescience.com_profil_simbolonjuwita44@gmail.com_WhatsApp Image 2021-11-12 at 8.53.58 AM.jpeg', 1, 0, 0, 0, 1, 0, 0, 0, 85, 0, 0, 0, '50Menit 38Detik', NULL, NULL, NULL, 1, NULL, '1i25bXQqV7RXyh0uAjWlFhhcvRVXjUPs9grxHdDfKQDErPbTHzolYEXJ0qlg', '2021-12-18 00:24:30', '2021-12-18 00:24:30'),
(1313, 'arundito_dr@yahoo.com', '$2y$10$lkd7LtqfMvDcVvKLNGdsvut2h6DMPRC7pFAi08SYpDmb15alri3dS', 'Arfa Rizqy Widikusumo', 'Laki-laki', 'Banyumas', '2013-01-15', '081317701231', 'SD Negeri 2 Berkoh, Purwokerto', 'Jl. Sitihinggil 3 no 5 , RT/RW 03/07, Mersi, Purwokerto Timur, Banyumas 53112', 'sd1', 'Banyumas', 'Jawa Tengah', 'bayar_arundito_dr@yahoo.com_Screenshot_20211111-205524_BNIMobilenew.jpg', 'profil_arundito_dr@yahoo.com_20211111_210323.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 50, 85, 0, 0, '36Menit 12Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-18 04:05:30', '2021-12-18 04:05:30'),
(1314, 'arundito@gmail.com', '$2y$10$1CkAZb6r7G/Wx/I2twbnwOMYbYUk.kHcMqL3ogre4F4uAh/EeKisO', 'Farros Arkan Widikusumo', 'Laki-laki', 'Jakarta', '2007-08-05', '081317701231', 'SMP Al Irsyad Al Islamiyyah Purwokerto', 'Jl Sitihinggil 3 no 5, RT/RW: 03/07, Mersi, Purwokerto Timur, Banyumas 53112', 'smp', 'Banyumas', 'Jawa Tengah', 'bayar_arundito@gmail.com_Screenshot_20211111-205221_BNIMobilenew.jpg', 'profil_arundito@gmail.com_20200807_070616.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 55, 65, 0, 0, '7Menit 14Detik', '43Menit 48Detik', NULL, NULL, 1, NULL, NULL, '2021-12-18 04:13:25', '2021-12-18 04:13:25'),
(1315, 'fananjaamirahasyisyi@rescience.com', '$2y$10$.FV..6MhNr.kmfHHhTU3D.CaqkLVcudSp8IYYhJ96Rsmc8BPQRPye', 'Fananja Amira hasyisyi', 'Perempuan', 'Lamongan', '2008-11-07', '081337055630', 'MTSN 1 lamongan', 'Jln raya Plaosan babat', 'smp', 'Lamongan', 'Jawa Timur', 'bayar_fananjaamirahasyisyi@rescience.com_bayar_dinunarza@gmail.com_IMG20211111143613.jpg', 'profil_fananjaamirahasyisyi@rescience.com_profil_dinunarza@gmail.com_IMG20211111055643.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, 0, '38Menit 44Detik', NULL, NULL, NULL, 1, NULL, '49aP9R3fA7qTlWF63awdY4MuUhWWuwEyuFJWh6OTqy8pffoT3qXUTV5nXxR4', '2021-12-18 22:38:44', '2021-12-18 22:38:44'),
(1316, 'davinsaveroyp@gmail.com', '$2y$10$gig3Jj1iFD9e7iF/s/Wbx.Xr2fmUK.qj2uTXb8RBu3RdZsC8chl4q', 'Davin Savero Yuma Putra', 'Laki-laki', 'Malang', '2007-05-02', '081331266288', 'SMP INTEGRAL AR-ROHMAH', 'Jl. Locari no.17, desa sumbersekar, kec.dau', 'smp', 'Malang', 'Jawa Timur', '', 'profil_davinsaveroyp@gmail.com_IMG-20211104-WA0009.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 75, 0, 0, NULL, '53Menit 14Detik', NULL, NULL, 1, NULL, 'kSqVm041gtmDY9l8vrHCFyoVPo2c2kCSLYrcltZW51gm1YcKtxFAi3HpF1De', '2021-12-19 04:20:40', '2021-12-19 04:20:40'),
(1317, 'luqmanmanggalaji@gmail.com', '$2y$10$dj.gs/nvkUf2GHMd/KXtI.jBV9n6kUzWg0AYeWxc5Wqui9lyHI0Z.', 'Luqman Manggala Aji', 'Laki-laki', 'Jember', '2008-07-24', '082334788756', 'SMP INTEGRAL AR-ROHMAH', 'Kecamatan Kapongan.kabupaten Situbondo.Jl ASTA WANGI RT 1 RW 11', 'smp', 'Malang', 'Jawa Timur', '', 'profil_luqmanmanggalaji@gmail.com_IMG-20211217-WA0009.jpg', 1, 1, 0, 0, 1, 1, 0, 0, 65, 70, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 'jfH0m1CuMQdngLAGygw4E6ieD9NUUoDlCtdTSRYsBiVjlPrBzLTD1JHZpEVF', '2021-12-19 05:56:46', '2021-12-19 05:56:46'),
(1318, 'arisafrizal1704@gmail.com', '$2y$10$fGmteDFd1crC4uJ14D7p6ui.qf0aP9y3sG22FvRbW9fFFuh4fcEGq', 'Aris Afrizal', 'Laki-laki', 'SURABAYA', '2004-07-01', '081907718600', 'SMAN 10 Surabaya', 'JL. WONOCOLO PABRIK KULIT NO. 69 B ( BAKSO KOTAK CAK RIE ), KECAMATAN WONOCOLO, KELURAHAN JEMUR WONOSARI, KOTA SURABAYA, PROVINSI JAWA TIMUR, KODE POS 60237', 'sma', 'KOTA SURABAYA', 'Jawa Timur', '', 'profil_arisafrizal1704@gmail.com_ARIS AFRIZAL - SMA NEGERI 10 SURABAYA.jpeg', 1, 1, 0, 0, 1, 1, 0, 0, 95, 120, 0, 0, '2Menit 40Detik', '14Menit 49Detik', NULL, NULL, 1, NULL, 'VxbwZ0tfecwbXNa4zqJfppAG7OSfNSNdXcW669FCJi2Pf0i69VIe590XTx71', '2021-12-22 23:52:39', '2021-12-22 23:52:39'),
(1321, 'tes@smp.com', '$2y$10$UCSIfXMYtIc0IsG6htezwu3L/f8nU3WqkP9ebWXwtc4RNQMlLdKQe', 'Adam Alvaro', 'Laki-laki', 'Malang', '2021-12-31', '+628563077368', 'dawdad', 'jl. atletik perum BPTP F1 Karangploso Malang Jawatimur', 'smp', 'Malang', 'Kalimantan Timur', '', 'profil_tes@smp.com_logoumm.jpg', 1, 0, 0, 0, 1, 1, 0, 0, 140, 25, 0, 0, '59Menit 31Detik', '59Menit 38Detik', NULL, NULL, 1, NULL, NULL, '2021-12-24 08:43:35', '2021-12-24 08:43:35'),
(1323, 'ananda@gmail.com', '$2y$10$FdaoLRiWR2SXj9BI2Q7ZvOPseJwfTVlTPfSfs62oGlsJkirIT6BGe', 'Maheswari Tri Ananda', 'Perempuan', 'Makassar', '2012-06-01', '000', 'Lifeschoool Makassar', '-', 'sd1', 'Makassar', 'Jawa Timur', '', 'profil_ananda@gmail.com_Lighthouse.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 150, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-25 19:02:32', '2021-12-25 19:02:32'),
(1324, 'muhammadkasfi@rescience.com', '$2y$10$3r5I51d5BEJ6s2QaCaPs7.QTPJmAA82b5zDzsTkMENY75v2fHRUGe', 'Muhammad Kasfi Al Hamiz', 'Laki-laki', 'Bandung', '2007-11-22', '082127556965', 'SMPIT Assyifa Boarding School', 'Griya rajawali bintaro 1 sawah baru ciputat tangerang selatan', 'smp', 'Suban', 'Jawa Barat', '', 'profil_muhammadkasfi@rescience.com_Lighthouse.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 50, 0, 0, NULL, '52Menit 9Detik', NULL, NULL, 1, NULL, 'hEEUomhzEYyn9wIJ1j0o1qY0dYNmoIlOGEHfuKCXykBVabxFR7yA7r5715ah', '2021-12-25 20:56:06', '2021-12-25 20:56:06'),
(1325, 'dimasfaudzan@rescience.com', '$2y$10$kzofuMJ0qZuoJeLYAltMFu4NX5YaqW1qMq8TBIrvdfWHwob4gwv3y', 'Dimas Faudzan Muhadzib', 'Laki-laki', '-', '2021-12-27', '-', '-', '-', 'smp', '-', 'Jawa Timur', '', 'profil_dimasfaudzan@rescience.com_IMG-20211213-WA0006.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 40, 0, 0, NULL, '41Menit 38Detik', NULL, NULL, 1, NULL, NULL, '2021-12-26 18:30:48', '2021-12-26 18:30:48'),
(1326, 'najmus@rescience.com', '$2y$10$zwOlPySIIihvvDnN4Am4x.Z5WDw8ozGtoUS/0VQDjwOxVusld.KJW', 'M. Najmuts Tsaqib Wigdogdo', 'Laki-laki', 'Surabaya', '2009-04-10', '-', 'SMP INTEGRAL AR-ROHMAH', 'Puncak Permata Sengkaling R.9\r\nSemanding Sumbersekar Dau', 'smp', 'Malang', 'Jawa Timur', '', 'profil_najmus@rescience.com_IMG-20211213-WA0007.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 35, 0, 0, NULL, '40Menit 32Detik', NULL, NULL, 1, NULL, NULL, '2021-12-26 18:44:04', '2021-12-26 18:44:04'),
(1327, 'firazsultan@rescience.com', '$2y$10$6o//063R3YsYs184dl1Ik.tii9a4Q3mpaCUpQUkykcflsLT.fAgwy', 'Firaz sultan', 'Laki-laki', 'Situbondo', '2008-10-23', '081215256008', 'SMP INTEGRAL AR-ROHMAH', 'Locari', 'smp', 'Malang', 'Jawa Timur', '', 'profil_firazsultan@rescience.com_IMG-20211213-WA0007.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 45, 0, 0, 0, '50Menit 1Detik', NULL, NULL, NULL, 1, NULL, NULL, '2021-12-26 18:48:24', '2021-12-26 18:48:24'),
(1328, 'kirana@gmail.com', '$2y$10$/ZP5T.4HDe074fXNWGmyOuaDxGvhEq9amGqiM.Nvs6c2wd0N7dXx.', 'Kirana Dewi wulandari', 'Perempuan', 'Semarang', '2013-08-18', '081215256008', 'Bimbingan Belajar Cemara', 'Jl. jedral sudirman No.1', 'sd1', 'Semarang', 'Jawa Tengah', '', 'profil_kirana@gmail.com_Koala.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 145, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 01:44:31', '2021-12-27 01:44:31'),
(1329, 'sulthan@gmail.com', '$2y$10$zQGPx9AqYeUcO9evJYqhweB34B7c4cAc0othMfhSyp0oCdsC0h.2O', 'Sulthan Bilhaq', 'Laki-laki', 'Jakarta', '2012-07-06', '081215256008', 'SD Kasih Ibu', 'Jl. Semanggi', 'sd2', 'Jakarta', 'DKI Jakarta', '', 'profil_sulthan@gmail.com_Lighthouse.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 145, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 01:46:49', '2021-12-27 01:46:49'),
(1330, 'oscar@gmail.com', '$2y$10$vPAtOSuRyQzXvPun0YAwbuRzwliVXBkawhGOPNpZhssCU5b0tO5x.', 'Muhammad Oscar Pangestu', 'Laki-laki', 'Bandung', '2012-02-02', '00', 'SD Ahmad Dahlan', 'Jl. Sukarno', 'sd2', 'Tikep', 'Maluku Utara', '', 'profil_oscar@gmail.com_Koala.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 145, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 09:52:20', '2021-12-27 09:52:20'),
(1331, 'pratiwi@gmail.com', '$2y$10$v4tnC6BI5z8WtCxKScgRAetTMHfUyPoQKZSPODnroBNb1.8lVrgZO', 'Indah Pratiwi', 'Perempuan', 'Jakarta', '2011-10-06', '0', 'SD Jayakusuma', 'Jl. Semarang', 'sd2', 'Bantaeng', 'Sulawesi Selatan', '', 'profil_pratiwi@gmail.com_Penguins.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 145, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 09:56:06', '2021-12-27 09:56:06'),
(1332, 'latifah@gmail.com', '$2y$10$CLDaamEasMpBYV5cJ.Te8OcU2RP8uyfkCf2Jh13hNcGChT7eecbvK', 'Latifah Khairani', 'Perempuan', 'Bandung', '2011-04-04', '0', 'MTs Muhammadiyah', 'Jl. Kramatjati', 'smp', 'Mursil', 'Aceh', '', 'profil_latifah@gmail.com_Penguins.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 145, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:02:49', '2021-12-27 10:02:49'),
(1333, 'hashim@gmail.com', '$2y$10$x.MoyfGktT6BtzFZaD0IYecczV8vQ50XeNPJg8QC/7JlOy/XZUKe.', 'Hashim Mohamed', 'Laki-laki', 'Tulungagung', '2009-06-05', '00', 'SMA Islam Ali', 'Jl. KH. Agus salim', 'smp', 'Kota Pinang', 'Sumatera Barat', '', 'profil_hashim@gmail.com_Penguins.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 140, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:08:19', '2021-12-27 10:08:19'),
(1334, 'ayudia@gmail.com', '$2y$10$PBorP6Oj3ixLbPtoorsqWOFDiNqwQlX54c8IikreIgDq/jDrYvVT.', 'Ayudia Atta W', 'Perempuan', 'Turkey', '2008-01-01', '0', 'SMPI KH Alwi', 'Kapandas mawar', 'smp', 'Lotu', 'Sulawesi Utara', '', 'profil_ayudia@gmail.com_Lighthouse.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 140, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:24:51', '2021-12-27 10:24:51'),
(1335, 'aurellia@gamil.com', '$2y$10$CDNRq6iNpsIcoeZpK8h/aunQRYHAJ.kG46dF14uLn5JQzwOzlHyiK', 'Aurellia Adena', 'Perempuan', 'Kalimantan', '2007-07-07', '0', 'SMP Al Haq', 'Jl. siliwangi', 'smp', 'Bone', 'Sumatera Selatan', '', 'profil_aurellia@gamil.com_Tulips.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 145, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:28:42', '2021-12-27 10:28:42'),
(1336, 'ayu@gmail.com', '$2y$10$I0BM1IWMGaC4QyJMWFP0S.DWdDfwJns9ZU9ICHyBZ0y2NKPzKXkVK', 'Chandie Kirana', 'Perempuan', 'Malang', '2009-09-09', '0', 'Lifeschoool Buol', 'Jl. Adem Sari', 'smp', 'Buol', 'Sulawesi Tengah', '', 'profil_ayu@gmail.com_Lighthouse.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 135, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:33:21', '2021-12-27 10:33:21'),
(1337, 'grizelle@gmail.co', '$2y$10$sJD0E8vbCNl.ZGxQxWk3d.KOeaAKamL5ULPLrpRqOsZDvoKdWw8.K', 'Grizelle Fany Dwijayanti', 'Perempuan', 'Kediri', '2004-11-11', '1', 'SMP Katolik Jakarta', 'Menteng dalam', 'sma', 'Jakarta', 'DKI Jakarta', '', 'profil_grizelle@gmail.co_Tulips.jpg', 1, 1, 0, 0, 1, 0, 0, 0, 145, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:41:44', '2021-12-27 10:41:44'),
(1338, 'indira@gmail.com', '$2y$10$PGvv0HOfovbgdZ8mgezsiOTkpEp8GMNN5LdiEUEQq8EFNqZHGSj2W', 'Indira Iswari Khairunnisa', 'Laki-laki', 'Jakarta', '2006-11-11', '1', 'SMA Islam Jakarta', 'Jl. Bandung', 'sma', 'Jakarta', 'DKI Jakarta', '', 'profil_indira@gmail.com_Chrysanthemum.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 140, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:44:08', '2021-12-27 10:44:08'),
(1339, 'lasmaya@gmail.com', '$2y$10$doQNHukQZ/lTMFoi4Sxrq.52KocWKj.Y9u5dgG5iramZfu6oA57qG', 'Lasmaya Van Mega', 'Perempuan', 'Makassar', '2006-06-06', '00', 'SMAN Makassar', 'Jl. Pettarani', 'sma', 'Makassar', 'Sulawesi Selatan', '', 'profil_lasmaya@gmail.com_Penguins.jpg', 1, 0, 0, 0, 1, 0, 0, 0, 135, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:48:09', '2021-12-27 10:48:09'),
(1340, 'bayu@gmail.com', '$2y$10$4TaUNceS64QRyXlwU2ZxBO6jFOYxKbZYcI.v7cxG8z6hOUclPFzsG', 'Bayu Setiawan', 'Laki-laki', 'Balikpapan', '2003-09-09', '0', 'SMA Trisakti', 'Jl. Bumi Kita', 'sma', 'Palopo', 'Sulawesi Tenggara', '', 'profil_bayu@gmail.com_Lighthouse.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 135, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 10:55:47', '2021-12-27 10:55:47'),
(1341, 'zvonimira@gmail.com', '$2y$10$4PM5X6BhU5dS36CnGyzx7uBCH7MuZCbWNiqixgsmWIbT27BIeTkAm', 'Urvi Zvonimira wening', 'Perempuan', 'Meraoke', '2002-12-12', 'q', 'SMA Purwokerto', 'Jl. Majapahit', 'sma', 'Purwokerto', 'Jawa Tengah', '', 'profil_zvonimira@gmail.com_Penguins.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 140, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 11:00:06', '2021-12-27 11:00:06'),
(1342, 'anggraeni@gmail.com', '$2y$10$sBW/Lq7et9acN8fOYHquk.zWQkWrmqt0n/4OfRU5LnLxfGZ/CU4.i', 'Anggraeni Pramusita Ayunisari', 'Perempuan', 'Slawi', '2007-11-11', '0', 'MA Unggulan KH Wahab', 'Jl. KH. Wahab', 'sma', 'Tegal', 'Jawa Tengah', '', 'profil_anggraeni@gmail.com_Jellyfish.jpg', 0, 1, 0, 0, 0, 1, 0, 0, 0, 145, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-12-27 11:03:04', '2021-12-27 11:03:04');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_tag`
--
ALTER TABLE `menu_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_tag_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_tag_tag_id_foreign` (`tag_id`);

--
-- Indeks untuk tabel `menu_transaksi`
--
ALTER TABLE `menu_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_transaksi_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `menu_transaksi_menu_id_foreign` (`menu_id`);

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
-- Indeks untuk tabel `piagam`
--
ALTER TABLE `piagam`
  ADD UNIQUE KEY `piagam_user_id_unique` (`user_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_users`
--
ALTER TABLE `role_users`
  ADD UNIQUE KEY `role_users_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sertif`
--
ALTER TABLE `sertif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sertif_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soal_id_bidang_foreign` (`id_bidang`);

--
-- Indeks untuk tabel `status_final`
--
ALTER TABLE `status_final`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu_tag`
--
ALTER TABLE `menu_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu_transaksi`
--
ALTER TABLE `menu_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sertif`
--
ALTER TABLE `sertif`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234;

--
-- AUTO_INCREMENT untuk tabel `status_final`
--
ALTER TABLE `status_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1344;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `menu_tag`
--
ALTER TABLE `menu_tag`
  ADD CONSTRAINT `menu_tag_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Ketidakleluasaan untuk tabel `menu_transaksi`
--
ALTER TABLE `menu_transaksi`
  ADD CONSTRAINT `menu_transaksi_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `menu_transaksi_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `piagam`
--
ALTER TABLE `piagam`
  ADD CONSTRAINT `piagam_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sertif`
--
ALTER TABLE `sertif`
  ADD CONSTRAINT `sertif_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
