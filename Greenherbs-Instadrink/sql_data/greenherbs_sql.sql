-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Mar 2022 pada 18.31
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
-- Database: `grex2312_greenherbs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(100) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `caption_berita` varchar(255) DEFAULT NULL,
  `isi_berita` varchar(1000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `foto_berita` varchar(255) DEFAULT NULL,
  `tanggal_berita` date DEFAULT NULL,
  `delete_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul_berita`, `caption_berita`, `isi_berita`, `foto_berita`, `tanggal_berita`, `delete_at`) VALUES
(7, 'Promo Launching Greenherbs!', 'Promo 11.11 Shopee Greenherbs Instadrink', 'Pada masa launching greenherbs pada 11.11 terdapat promo diskon up to 20% pada platform Shopee. Buruan pesan melalui Shopee dan ikuti terus toko Greenherbs Instadrink untuk mendapatkan penawaran terbaik. Dan jangan lupa 12.12 pada 12 Desember terdapat promo di toko Greenherbs Instadrink yaa!', 'berita_2021-26_.jpeg', '2021-11-26', NULL),
(8, 'Greenherbs Instadrink', 'Available Now on Shopee!', 'Sekarang Greenherbs Instadrink sudah bisa diakses melalui Shopee App.', 'berita_2021-27_.png', '2021-11-27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_besar`
--

CREATE TABLE `buku_besar` (
  `id` int(11) NOT NULL,
  `tanggal_buku_besar` date NOT NULL,
  `hutang_buku_besar` int(11) NOT NULL,
  `piutang_buku_besar` int(11) NOT NULL,
  `aset_buku_besar` int(11) NOT NULL,
  `total_gaji_buku_besar` int(11) NOT NULL,
  `total_pembelian_buku_besar` int(11) NOT NULL,
  `total_penjualan_buku_besar` int(11) NOT NULL,
  `keterangan_buku_besar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor`
--

CREATE TABLE `distributor` (
  `id` int(11) NOT NULL,
  `nama_distributor` varchar(255) NOT NULL,
  `nomor_distributor` varchar(20) DEFAULT NULL,
  `alamat_distributor` varchar(255) DEFAULT NULL,
  `zona_distributor` varchar(255) DEFAULT NULL,
  `tanggungan_distributor` int(11) DEFAULT NULL,
  `keterangan_distributor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `distributor`
--

INSERT INTO `distributor` (`id`, `nama_distributor`, `nomor_distributor`, `alamat_distributor`, `zona_distributor`, `tanggungan_distributor`, `keterangan_distributor`) VALUES
(5, 'Official store Shopee', '087888586464', 'Jl. Margobasuki Gg III No 8 Jetis', 'Seluruh Indonesia', -15490, ''),
(6, 'Sardo', '-', '-', 'Sardo', 0, ''),
(7, 'Bayaqub', '-', '-', 'Bayaqub', 70000, ''),
(8, 'Pak Girman', '', 'Malang', 'Malang', 480000, 'Distributor perorang'),
(9, 'Pak Soni', '', 'Pendem', 'Batu', 80000, 'Perorangan'),
(10, 'Pak Pri', '', 'Karangploso', 'Karangploso', 80000, 'Perorangan'),
(11, 'Persada', '-', '-', '-', 240000, '-');

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
-- Struktur dari tabel `gaji_karyawan`
--

CREATE TABLE `gaji_karyawan` (
  `id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `gaji_gaji_karyawan` int(11) DEFAULT NULL,
  `tanggal_gaji_karyawan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `foto_galeri` varchar(255) DEFAULT NULL,
  `caption_galeri` varchar(255) DEFAULT NULL,
  `delete_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `foto_galeri`, `caption_galeri`, `delete_at`) VALUES
(6, 'galeri_Sekarang Greenherbs sudah ada di Shopee loh!_bannershopee1.png', 'Sekarang Greenherbs sudah ada di Shopee loh!', NULL),
(7, 'galeri_Buruan pesan melalui shopee untuk promo terbaik!_bannershopee2.png', 'Buruan pesan melalui shopee untuk promo terbaik!', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `nomor_karyawan` varchar(255) DEFAULT NULL,
  `alamat_karyawan` varchar(255) DEFAULT NULL,
  `gaji_karyawan` int(11) DEFAULT NULL,
  `keterangan_karyawan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama_karyawan`, `nomor_karyawan`, `alamat_karyawan`, `gaji_karyawan`, `keterangan_karyawan`) VALUES
(5, 'Lek Mar', '', 'Perum BPTP', 60000, 'Per Hari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `nama_kategori_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `nama_kategori_produk`) VALUES
(1, 'Roemah Bamboe');

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
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `hutang_pembelian` int(11) DEFAULT NULL,
  `keterangan_pembelian` varchar(255) DEFAULT NULL,
  `tanggal_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `total_pembelian`, `hutang_pembelian`, `keterangan_pembelian`, `tanggal_pembelian`) VALUES
(11, 300000, 0, 'tunai', '2021-11-27'),
(12, 50000, 0, '', '2021-11-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `tanggungan_penjualan` int(11) DEFAULT NULL,
  `status_penjualan` varchar(255) NOT NULL,
  `keterangan_penjualan` varchar(255) DEFAULT NULL,
  `tanggal_penjualan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `distributor_id`, `total_penjualan`, `tanggungan_penjualan`, `status_penjualan`, `keterangan_penjualan`, `tanggal_penjualan`) VALUES
(21, 5, 80000, 0, 'HUTANG', NULL, '2021-11-27'),
(23, 6, 160000, 0, 'TUNAI', NULL, '2022-03-09'),
(24, 7, 80000, 0, 'TUNAI', NULL, '2022-03-09'),
(25, 7, 80000, 0, 'TUNAI', NULL, '2022-03-09'),
(26, 7, 80000, 0, 'TUNAI', NULL, '2022-03-09'),
(27, 7, 70000, 70000, 'HUTANG', NULL, '2022-03-09'),
(28, 5, 8500, 0, 'TUNAI', NULL, '2022-03-15'),
(29, 5, 24000, 0, 'TUNAI', NULL, '2022-03-15'),
(30, 5, 48000, 0, 'TUNAI', NULL, '2022-03-15'),
(31, 5, 8000, 0, 'TUNAI', NULL, '2022-03-15'),
(32, 5, 48000, 0, 'TUNAI', NULL, '2022-03-15'),
(33, 5, 8000, 0, 'TUNAI', NULL, '2022-03-15'),
(34, 5, 72000, 0, 'TUNAI', NULL, '2022-03-15'),
(35, 5, 24000, 0, 'TUNAI', NULL, '2022-03-15'),
(36, 5, 80000, 0, 'TUNAI', NULL, '2022-03-15'),
(37, 8, 480000, 480000, 'HUTANG', NULL, '2022-03-15'),
(38, 9, 80000, 80000, 'HUTANG', NULL, '2022-03-15'),
(39, 10, 80000, 80000, 'HUTANG', NULL, '2022-03-15'),
(40, 5, 24500, 24500, 'HUTANG', NULL, '2022-03-16'),
(41, 11, 240000, 240000, 'HUTANG', NULL, '2022-03-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `nama_pesan` varchar(255) NOT NULL,
  `email_pesan` varchar(255) NOT NULL,
  `nomor_pesan` varchar(255) NOT NULL,
  `subyek_pesan` varchar(255) NOT NULL,
  `isi_pesan` varchar(255) NOT NULL,
  `file_pesan` varchar(255) DEFAULT NULL,
  `tanggal_pesan` date NOT NULL,
  `delete_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id`, `nama_pesan`, `email_pesan`, `nomor_pesan`, `subyek_pesan`, `isi_pesan`, `file_pesan`, `tanggal_pesan`, `delete_at`) VALUES
(1, 'yono', 'aa@gmail.com', '+62821673781236', 'MAKAN SEHAT', 'ini makan sehatini makan sehatini makan sehatini makan sehat', NULL, '2021-11-12', NULL),
(2, 'ddd', 'ddd', '+62ddd', 'dd', 'ddddd', NULL, '2021-11-13', NULL),
(3, 'Tes', 'Tes@mail.com', '+6200000', 'Tes', 'Ini tes', NULL, '2021-12-06', NULL),
(4, 'Tes', 'Tes@mail.com', '+620000', 'Tes', 'Ini tes', NULL, '2021-12-06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `komposisi_produk` varchar(1000) DEFAULT NULL,
  `deksripsi_produk` varchar(1000) DEFAULT NULL,
  `foto_produk_produk` varchar(255) DEFAULT NULL,
  `berat_produk` int(11) DEFAULT NULL,
  `harga_produk` int(11) NOT NULL,
  `hpp_produk` int(11) DEFAULT NULL,
  `delete_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama_produk`, `komposisi_produk`, `deksripsi_produk`, `foto_produk_produk`, `berat_produk`, `harga_produk`, `hpp_produk`, `delete_at`) VALUES
(1, 1, 'Wedang Uwuh Strong', 'Jahe Emprit, Jahe Merah, Serai, Secang, Kayu Manis, Kapulaga, Bunga Lawang, Cengkeh, Gula', 'Minuman wedang uwuh instan dengan manfaat yang banyak untuk kesehatan', 'produk_2021-11-26_strong.png', 100, 8000, 4000, NULL),
(6, 1, 'Wedang Uwuh Mild', 'Jahe Emprit, Jahe Merah, Serai, Secang, Kayu Manis, Kapulaga, Bunga Lawang, Cengkeh, Gula, Krimer', 'Minuman wedang uwuh instan dengan rasa lebih mild', 'produk_2021-11-26_mild.png', 100, 8500, 4492, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `jumlah_produksi` int(11) NOT NULL,
  `biaya_produksi` int(11) NOT NULL,
  `keterangan_produksi` varchar(255) DEFAULT NULL,
  `tanggal_produksi` date NOT NULL,
  `kadaluarsa_produksi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id`, `produk_id`, `kode_produksi`, `jumlah_produksi`, `biaya_produksi`, `keterangan_produksi`, `tanggal_produksi`, `kadaluarsa_produksi`) VALUES
(14, 1, 'AA222', 1, 400000, '', '2021-12-03', '2022-06-08'),
(15, 6, 'AABB', 0, 4492, '', '2022-03-15', '2021-08-10'),
(16, 1, 'MK2022', 168, 600000, '', '2022-03-15', '2023-10-10'),
(18, 6, 'MM32022', 1, 8984, '', '2022-03-16', '2023-10-10'),
(19, 1, '--', 0, 120000, 'khusus persada', '2022-03-30', '2023-02-08');

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
(1095, 1),
(1096, 1),
(1097, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sejarah_transaksi`
--

CREATE TABLE `sejarah_transaksi` (
  `id` int(11) NOT NULL,
  `transaksi_id` varchar(255) NOT NULL,
  `tipe_sejarah_transaksi` varchar(255) NOT NULL,
  `total_sejarah_transaksi` int(11) NOT NULL,
  `tanggal_sejarah_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sejarah_transaksi`
--

INSERT INTO `sejarah_transaksi` (`id`, `transaksi_id`, `tipe_sejarah_transaksi`, `total_sejarah_transaksi`, `tanggal_sejarah_transaksi`) VALUES
(64, '9', 'PRODUKSI', 450000, '2021-11-24'),
(65, '14', 'PENJUALAN TUNAI', 425000, '2021-11-24'),
(66, '15', 'PENJUALAN TUNAI', 425000, '2021-11-24'),
(67, '10', 'PRODUKSI', 900000, '2021-11-24'),
(68, '16', 'PENJUALAN HUTANG', 510000, '2021-11-24'),
(69, '10', 'PEMBELIAN HUTANG', 300000, '2021-11-24'),
(70, '11', 'PRODUKSI', 675000, '2021-11-25'),
(71, '4', 'GAJI', 65000, '2021-11-25'),
(72, '1', 'GAJI', 1500000, '2021-11-25'),
(73, '17', 'PENJUALAN TUNAI', 830000, '2021-11-25'),
(74, '18', 'PENJUALAN TUNAI', 1615000, '2021-11-25'),
(75, '10', 'PEMBAYARAN PEMBELIAN', 300000, '2021-11-25'),
(76, '10', 'PENGHAPUSAN HUTANG PEMBELIAN', 300000, '2021-11-25'),
(77, '11', 'HAPUS GAJI', 1500000, '2021-11-25'),
(78, '16', 'PEMBAYARAN PENJUALAN', 510000, '2021-11-25'),
(79, '16', 'PENGHAPUSAN HUTANG PENJUALAN', 510000, '2021-11-25'),
(80, '12', 'PRODUKSI', 600000, '2021-11-26'),
(81, '19', 'PENJUALAN HUTANG', 400000, '2021-11-26'),
(82, '19', 'PEMBAYARAN PENJUALAN', 200000, '2021-11-26'),
(83, '19', 'PENGHAPUSAN HUTANG PENJUALAN', 200000, '2021-11-26'),
(84, '19', 'HAPUS PENJUALAN HUTANG', 200000, '2021-11-26'),
(85, '20', 'PENJUALAN HUTANG', 240000, '2021-11-26'),
(86, '20', 'PEMBAYARAN PENJUALAN', 120000, '2021-11-26'),
(87, '20', 'PENGHAPUSAN HUTANG PENJUALAN', 120000, '2021-11-26'),
(88, '1', 'HAPUS SELLER', 120000, '2021-11-26'),
(89, '10', 'HAPUS PEMBELIAN TUNAI', 300000, '2021-11-26'),
(90, '10', 'HAPUS GAJI', 65000, '2021-11-26'),
(91, '11', 'HAPUS PRODUKSI', 0, '2021-11-26'),
(92, '10', 'HAPUS PRODUKSI', 0, '2021-11-26'),
(93, '9', 'HAPUS PRODUKSI', 0, '2021-11-26'),
(94, '12', 'HAPUS PRODUKSI', 280000, '2021-11-26'),
(95, '11', 'PEMBELIAN TUNAI', 300000, '2021-11-27'),
(96, '13', 'PRODUKSI', 40000, '2021-11-27'),
(97, '21', 'PENJUALAN HUTANG', 80000, '2021-11-27'),
(98, '12', 'PEMBELIAN TUNAI', 50000, '2021-11-27'),
(99, '14', 'PRODUKSI', 400000, '2021-12-03'),
(100, '21', 'PEMBAYARAN PENJUALAN', 40000, '2021-12-03'),
(101, '21', 'PENGHAPUSAN HUTANG PENJUALAN', 40000, '2021-12-03'),
(102, '22', 'PENJUALAN HUTANG', 40000, '2022-03-07'),
(103, '23', 'PENJUALAN TUNAI', 160000, '2022-03-09'),
(104, '24', 'PENJUALAN TUNAI', 80000, '2022-03-09'),
(105, '25', 'PENJUALAN TUNAI', 80000, '2022-03-09'),
(106, '26', 'PENJUALAN TUNAI', 80000, '2022-03-09'),
(107, '27', 'PENJUALAN HUTANG', 70000, '2022-03-09'),
(108, '13', 'HAPUS PRODUKSI', 20000, '2022-03-15'),
(109, '15', 'PRODUKSI', 4492, '2022-03-15'),
(110, '28', 'PENJUALAN TUNAI', 8500, '2022-03-15'),
(111, '29', 'PENJUALAN TUNAI', 24000, '2022-03-15'),
(112, '30', 'PENJUALAN TUNAI', 48000, '2022-03-15'),
(113, '31', 'PENJUALAN TUNAI', 8000, '2022-03-15'),
(114, '32', 'PENJUALAN TUNAI', 48000, '2022-03-15'),
(115, '33', 'PENJUALAN TUNAI', 8000, '2022-03-15'),
(116, '34', 'PENJUALAN TUNAI', 72000, '2022-03-15'),
(117, '35', 'PENJUALAN TUNAI', 24000, '2022-03-15'),
(118, '36', 'PENJUALAN TUNAI', 80000, '2022-03-15'),
(119, '21', 'PEMBAYARAN PENJUALAN', 40000, '2022-03-15'),
(120, '21', 'PENGHAPUSAN HUTANG PENJUALAN', 40000, '2022-03-15'),
(121, '22', 'HAPUS PENJUALAN HUTANG', 40000, '2022-03-15'),
(122, '16', 'PRODUKSI', 600000, '2022-03-15'),
(123, '37', 'PENJUALAN HUTANG', 480000, '2022-03-15'),
(124, '38', 'PENJUALAN HUTANG', 80000, '2022-03-15'),
(125, '39', 'PENJUALAN HUTANG', 80000, '2022-03-15'),
(126, '17', 'PRODUKSI', 600000, '2022-03-15'),
(127, '17', 'HAPUS PRODUKSI', 600000, '2022-03-15'),
(128, '18', 'PRODUKSI', 8984, '2022-03-16'),
(129, '40', 'PENJUALAN HUTANG', 24500, '2022-03-16'),
(130, '19', 'PRODUKSI', 120000, '2022-03-30'),
(131, '41', 'PENJUALAN HUTANG', 240000, '2022-03-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pembelian`
--

CREATE TABLE `transaksi_pembelian` (
  `id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `nama_pembelian` varchar(255) NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `keterangan_transaksi_pembelian` varchar(255) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_pembelian`
--

INSERT INTO `transaksi_pembelian` (`id`, `pembelian_id`, `nama_pembelian`, `jumlah_pembelian`, `keterangan_transaksi_pembelian`, `tanggal_pembelian`) VALUES
(17, 11, 'makan', 200000, 'makan untuk karyawan', NULL),
(18, 11, 'minum', 100000, 'minum untuk karyawan', NULL),
(19, 12, 'sutil', 50000, '', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `produksi_id` int(11) NOT NULL,
  `nama_transaksi_penjualan` varchar(255) DEFAULT NULL,
  `jumlah_transaksi_penjualan` int(11) NOT NULL,
  `harga_transaksi_penjualan` int(11) NOT NULL,
  `keterangan_transaksi_penjualan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`id`, `penjualan_id`, `produksi_id`, `nama_transaksi_penjualan`, `jumlah_transaksi_penjualan`, `harga_transaksi_penjualan`, `keterangan_transaksi_penjualan`) VALUES
(24, 23, 14, 'Wedang Uwuh Strong', 20, 8000, 'AA222'),
(25, 24, 14, 'Wedang Uwuh Strong', 10, 8000, 'AA222'),
(26, 25, 14, 'Wedang Uwuh Strong', 10, 8000, 'AA222'),
(27, 26, 14, 'Wedang Uwuh Strong', 10, 8000, 'AA222'),
(28, 27, 14, 'Wedang Uwuh Strong', 10, 7000, 'AA222'),
(29, 28, 15, 'Wedang Uwuh Mild', 1, 8500, 'AABB'),
(30, 29, 14, 'Wedang Uwuh Strong', 3, 8000, 'AA222'),
(31, 30, 14, 'Wedang Uwuh Strong', 6, 8000, 'AA222'),
(32, 31, 14, 'Wedang Uwuh Strong', 1, 8000, 'AA222'),
(33, 32, 14, 'Wedang Uwuh Strong', 6, 8000, 'AA222'),
(34, 33, 14, 'Wedang Uwuh Strong', 1, 8000, 'AA222'),
(35, 34, 14, 'Wedang Uwuh Strong', 9, 8000, 'AA222'),
(36, 35, 14, 'Wedang Uwuh Strong', 3, 8000, 'AA222'),
(37, 36, 14, 'Wedang Uwuh Strong', 10, 8000, 'AA222'),
(38, 37, 16, 'Wedang Uwuh Strong', 60, 8000, 'MK2022'),
(39, 38, 16, 'Wedang Uwuh Strong', 10, 8000, 'MK2022'),
(40, 39, 16, 'Wedang Uwuh Strong', 10, 8000, 'MK2022'),
(41, 40, 18, 'Wedang Uwuh Mild', 1, 8500, 'MM32022'),
(42, 40, 16, 'Wedang Uwuh Strong', 2, 8000, 'MK2022'),
(43, 41, 19, 'Wedang Uwuh Strong', 30, 8000, '--');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usaha`
--

CREATE TABLE `usaha` (
  `id` int(11) NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `modal_usaha` int(20) NOT NULL,
  `hutang_usaha` int(20) NOT NULL,
  `piutang_usaha` int(20) NOT NULL,
  `saldo_usaha` int(20) NOT NULL,
  `video_usaha` varchar(255) DEFAULT NULL,
  `caption_tentang_usaha` varchar(255) DEFAULT NULL,
  `tentang_usaha` varchar(10000) DEFAULT NULL,
  `alamat_usaha` varchar(255) DEFAULT NULL,
  `nomor1_usaha` varchar(255) DEFAULT NULL,
  `nomor2_usaha` varchar(255) DEFAULT NULL,
  `email_usaha` varchar(255) DEFAULT NULL,
  `ig_usaha` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `usaha`
--

INSERT INTO `usaha` (`id`, `nama_usaha`, `modal_usaha`, `hutang_usaha`, `piutang_usaha`, `saldo_usaha`, `video_usaha`, `caption_tentang_usaha`, `tentang_usaha`, `alamat_usaha`, `nomor1_usaha`, `nomor2_usaha`, `email_usaha`, `ig_usaha`, `status`) VALUES
(1, 'Greenherbs', 0, 0, 0, 1000000, 'o25cTRR8a8U', 'Merupakan salah satu UMKM yang berjalan di bidang produksi Minuman Instan sejak tahun 2021', 'Didirikan pada tahun 2021 secara resmi oleh Hiu Adam Abdullah, Amaliya Hasnah, Aning Triwahyuni, Pandri Sunaryo — Greenherbs adalah salah satu UMKM yang ada di wilayah Kabupaten Malang yang berjalan di bidang industri Makanan & Minuman instan. Dengan bekerjasama ke berbagai macam toko dan pusat oleh-oleh yang ada di Malang, produk Greenherbs sudah dipercaya oleh berbagai kalangan masyarakat. Kami bertekat dalam mengembangkan usaha Greenherbs agar lebih berkembang dan bermanfaat bagi Nusa, Bangsa, dan Agama.', 'Perum BPTP Blok F Nomor 1 Karangploso Malang Jawa Timur, Indonesia', '813 3330 4248', '856 3077 368', '2020.greenherbs@gmail.com', '2020.greenherbs', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'admin@admin.com', '$2y$10$YS0WwZ8jMAIU8Rqnf8ZaSufoW9O6VBee0k7sviwK.pEGTBPaEFTk.', 'Admin', NULL, 'iu1DHmNqvstPxd35LF9WAwKOGFnZlhJq2wu6sIpr22vmODCCUZiYabwit15U', '2021-09-03 15:48:34', '2021-09-03 15:48:34'),
(1095, 'test@test.com', '$2y$10$nUAAvNq30XCAHPm.OisM4.4tbA5KhyVqYBNaS/PQpEscWMCBd4VE2', 'akun tes', NULL, NULL, '2021-11-25 07:50:35', '2021-11-25 07:50:35'),
(1096, 'demo@greenherbs.com', '$2y$10$4eNjvX7moPH5P8Ut0eWNquDVmyLgaED/Bym8hn0/dtKwmArRCItrm', 'Akun demo', NULL, NULL, '2021-12-07 19:58:02', '2021-12-07 19:58:02'),
(1097, 'amaliyahasnah@greenherbs.com', '$2y$10$4Vu6lhvx58bkeAWK30Vtt.1wbZ.irvvLK2z2GLVP41qetBDU3.69W', 'Amaliya Hasnah', NULL, NULL, '2022-03-07 04:15:52', '2022-03-07 04:15:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `link_video` varchar(500) NOT NULL,
  `delete_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `video`
--

INSERT INTO `video` (`id`, `link_video`, `delete_at`) VALUES
(1, 'percobaan.mp4', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `buku_besar`
--
ALTER TABLE `buku_besar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `used` (`karyawan_id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
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
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `6` (`distributor_id`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `has` (`kategori_id`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `1` (`produk_id`);

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
-- Indeks untuk tabel `sejarah_transaksi`
--
ALTER TABLE `sejarah_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `2` (`pembelian_id`);

--
-- Indeks untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `7` (`penjualan_id`),
  ADD KEY `8` (`produksi_id`);

--
-- Indeks untuk tabel `usaha`
--
ALTER TABLE `usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `buku_besar`
--
ALTER TABLE `buku_besar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sejarah_transaksi`
--
ALTER TABLE `sejarah_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `usaha`
--
ALTER TABLE `usaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1098;

--
-- AUTO_INCREMENT untuk tabel `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gaji_karyawan`
--
ALTER TABLE `gaji_karyawan`
  ADD CONSTRAINT `used` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `6` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `has` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD CONSTRAINT `2` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD CONSTRAINT `7` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `8` FOREIGN KEY (`produksi_id`) REFERENCES `produksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
