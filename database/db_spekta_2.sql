-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 21 Jul 2022 pada 07.48
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spekta_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absensi_ekstra`
--

CREATE TABLE `tb_absensi_ekstra` (
  `id_absen` int(11) NOT NULL,
  `id_ekstra` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `tgl_absen` date DEFAULT NULL,
  `hadir` tinyint(4) NOT NULL DEFAULT '0',
  `sakit` tinyint(4) NOT NULL DEFAULT '0',
  `ijin` tinyint(4) NOT NULL DEFAULT '0',
  `alpa` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_absensi_ekstra`
--

INSERT INTO `tb_absensi_ekstra` (`id_absen`, `id_ekstra`, `id_users`, `tgl_absen`, `hadir`, `sakit`, `ijin`, `alpa`, `created_at`, `updated_at`) VALUES
(1, 13, 1, '2022-01-27', 0, 0, 0, 1, '2022-01-27 13:42:22', '2022-01-27 13:42:22'),
(2, 13, 2, '2022-01-27', 1, 0, 0, 0, '2022-01-27 14:11:35', '2022-01-27 14:11:35'),
(3, 13, 1, '2022-01-28', 0, 0, 0, 1, '2022-01-28 15:28:12', '2022-01-28 15:28:12'),
(4, 13, 1, '2022-01-29', 0, 0, 0, 1, '2022-01-28 15:29:24', '2022-01-28 15:29:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_account`
--

CREATE TABLE `tb_account` (
  `id_acc` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `google_acc` tinyint(4) NOT NULL DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `active_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_account`
--

INSERT INTO `tb_account` (`id_acc`, `email`, `password`, `is_active`, `google_acc`, `code`, `active_at`, `created_at`, `updated_at`) VALUES
(1, 'admin@spekta.com', 'admin12345', 1, 0, NULL, NULL, '2021-12-26 15:05:20', '2021-12-26 15:05:20'),
(2, 'user@spekta.com', 'User_12345', 1, 0, NULL, '2021-12-27 12:41:20', '2021-12-27 03:43:26', '2021-12-27 03:43:26'),
(3, 'pramuka@spekta.com', 'pramuka12345', 1, 0, NULL, NULL, '2021-12-27 04:05:27', '2021-12-27 04:05:27'),
(4, 'teacher@spekta.com', 'teacher12345', 1, 0, NULL, NULL, '2021-12-27 04:18:58', '2021-12-27 04:18:58'),
(6, 'chaidar@spekta.com', 'Chaidar_813', 1, 0, '6ad4257dd56fb57b280acc6769f24a94386ce69b3908a8046466b38c64192cbf', '2022-01-15 04:19:48', '2022-01-15 03:37:14', '2022-01-15 03:37:14'),
(7, 'guru@spekta.com', 'guru12345', 1, 0, NULL, NULL, '2022-01-18 02:29:02', '2022-01-18 02:29:02'),
(8, 'pmr@spekta.com', 'pmr12345', 1, 0, NULL, NULL, '2022-01-19 14:25:49', '2022-01-19 14:25:49'),
(10, 'rohis@spekta.com', 'Rohis_12345', 1, 0, NULL, NULL, '2022-02-02 13:30:42', '2022-02-02 13:30:42'),
(11, 'aria@spekta.com', 'aria_12345', 1, 0, NULL, '2022-02-11 02:09:10', '2022-02-11 02:06:55', '2022-02-11 02:06:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `id_acc` int(11) DEFAULT NULL,
  `id_ekstra` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `id_acc`, `id_ekstra`, `name`, `created_at`, `updated_at`) VALUES
(1, 3, 13, 'admin pramuka', '2022-01-19 14:17:46', '2022-01-27 04:39:47'),
(2, 8, 14, 'admin palang merah remaja', '2022-01-19 14:27:38', '2022-01-19 14:27:38'),
(4, 10, 15, 'admin rohis', '2022-02-02 13:47:41', '2022-02-02 13:47:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_app_settings`
--

CREATE TABLE `tb_app_settings` (
  `id_app_settings` int(11) NOT NULL,
  `about_app` varchar(10000) NOT NULL,
  `app_version` varchar(11) NOT NULL,
  `release_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_app_settings`
--

INSERT INTO `tb_app_settings` (`id_app_settings`, `about_app`, `app_version`, `release_date`, `created_at`, `updated_at`) VALUES
(1, '<p><big>PENDAFTARAN<var> </var>ANGGOTA BARU EKSTRAKURIKULER SMA NEGERI 1 MEJAYAN TAHUN ANGGARAN 2022 DITUTUP</big></p>\r\n\r\n<p><big>TERIMA KASIH ATAS PASTISIPASI SAUDARA SEMUA</big></p>\r\n\r\n<p><big>SEHAT SELALU</big></p>\r\n', '1.0.1', '2022-01-10', '2021-11-23 15:15:35', '2022-07-19 03:00:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_auth_settings`
--

CREATE TABLE `tb_auth_settings` (
  `id_auth_setting` int(11) NOT NULL,
  `date_open_reg` date DEFAULT NULL,
  `date_close_reg` date DEFAULT NULL,
  `is_regis` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_auth_settings`
--

INSERT INTO `tb_auth_settings` (`id_auth_setting`, `date_open_reg`, `date_close_reg`, `is_regis`, `created_at`, `updated_at`) VALUES
(1, '2022-07-01', '2022-07-31', 0, '2021-11-23 14:38:54', '2022-07-19 03:00:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bina_ekstra`
--

CREATE TABLE `tb_bina_ekstra` (
  `id_bina_ekstra` int(11) NOT NULL,
  `id_ekstra` int(11) DEFAULT NULL,
  `id_pembina` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bina_ekstra`
--

INSERT INTO `tb_bina_ekstra` (`id_bina_ekstra`, `id_ekstra`, `id_pembina`, `created_at`, `updated_at`) VALUES
(2, 13, 3, '2022-01-18 13:36:09', '2022-01-18 13:36:09'),
(3, 14, 4, '2022-01-18 14:08:10', '2022-01-18 14:08:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cbt_time`
--

CREATE TABLE `tb_cbt_time` (
  `id_time` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `cbt_timer` int(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_cbt_time`
--

INSERT INTO `tb_cbt_time` (`id_time`, `test_id`, `cbt_timer`, `created_at`, `updated_at`) VALUES
(1, 1, 30, '2021-12-27 15:19:29', '2021-12-27 15:19:29'),
(2, 2, 30, '2022-01-02 06:42:26', '2022-01-02 06:42:26'),
(5, 7, 100, '2022-01-15 02:22:29', '2022-01-15 02:22:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_class`
--

CREATE TABLE `tb_class` (
  `id_class` int(11) NOT NULL,
  `class` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_class`
--

INSERT INTO `tb_class` (`id_class`, `class`, `created_at`, `updated_at`) VALUES
(1, 'X IPA 1', '2021-12-18 04:05:50', '2021-12-18 04:05:50'),
(2, 'X IPA 2', '2021-12-18 04:05:50', '2021-12-18 04:05:50'),
(3, 'X IPA 3', '2021-12-18 04:05:59', '2021-12-18 04:05:59'),
(4, 'X IPA 4', '2021-12-18 04:05:59', '2021-12-18 04:05:59'),
(5, 'X IPA 5', '2021-12-18 04:06:15', '2021-12-18 04:06:15'),
(6, 'X IPA 6', '2021-12-18 04:06:15', '2021-12-18 04:06:15'),
(7, 'X IPS 1', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(8, 'X IPS 2', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(9, 'X IPS 3', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(10, 'XI IPA 1', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(11, 'XI IPA 2', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(12, 'XI IPA 3', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(13, 'XI IPA 4', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(14, 'XI IPA 5', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(15, 'XI IPA 6', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(16, 'XI IPS 1', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(17, 'XI IPS 2', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(18, 'XI IPS 3', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(19, 'XII IPA 1', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(20, 'XII IPA 2', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(21, 'XII IPA 3', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(22, 'XII IPA 4', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(23, 'XII IPA 5', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(24, 'XII IPA 6', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(25, 'XII IPS 1', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(26, 'XII IPS 2', '2021-12-18 04:09:31', '2021-12-18 04:09:31'),
(27, 'XII IPS 3', '2021-12-18 04:09:31', '2021-12-18 04:09:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_sekolah`
--

CREATE TABLE `tb_data_sekolah` (
  `id_data_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(1000) DEFAULT NULL,
  `alamat_sekolah` varchar(1000) DEFAULT NULL,
  `kepala_sekolah` varchar(1000) DEFAULT NULL,
  `nip_kepsek` varchar(100) DEFAULT NULL,
  `waka_kesiswaan` varchar(100) DEFAULT NULL,
  `nip_waka_kesiswaan` varchar(50) NOT NULL,
  `waka_kurikulum` varchar(100) NOT NULL,
  `nip_waka_kurikulum` varchar(50) NOT NULL,
  `ass_waka_kesiswaan` varchar(100) NOT NULL,
  `nip_ass_waka_kesiswaan` varchar(50) NOT NULL,
  `ass_waka_kurikulum` varchar(100) NOT NULL,
  `nip_ass_waka_kurikulum` varchar(50) NOT NULL,
  `email_sekolah` varchar(1000) DEFAULT NULL,
  `no_telp_sekolah` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_data_sekolah`
--

INSERT INTO `tb_data_sekolah` (`id_data_sekolah`, `nama_sekolah`, `alamat_sekolah`, `kepala_sekolah`, `nip_kepsek`, `waka_kesiswaan`, `nip_waka_kesiswaan`, `waka_kurikulum`, `nip_waka_kurikulum`, `ass_waka_kesiswaan`, `nip_ass_waka_kesiswaan`, `ass_waka_kurikulum`, `nip_ass_waka_kurikulum`, `email_sekolah`, `no_telp_sekolah`, `created_at`, `updated_at`) VALUES
(1, 'SMA NEGERI 1 MEJAYAN', 'Jl.P.Sudirman, No.82, Mejayan, Kab.Madiun 63153', 'KEPSEK 1', '20210101 202201 1 001', 'WAKA KESISWAAN', '20210101 202201 1 004', 'WAKA KURIKULUM', '20210101 202201 1 002', 'ASS WAKA KESISWAAN', '20210101 202201 1 005', 'ASS WAKA KURIKULUM', '20210101 202201 1 003', 'sman1mjy@yahoo.co.id', '+62 0123 4567 890', '2022-01-27 03:17:24', '2022-02-02 13:08:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ekstrakurikuler`
--

CREATE TABLE `tb_ekstrakurikuler` (
  `id_ekstra` int(11) NOT NULL,
  `id_ekskul` varchar(20) NOT NULL,
  `ekstrakurikuler` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_ekstrakurikuler`
--

INSERT INTO `tb_ekstrakurikuler` (`id_ekstra`, `id_ekskul`, `ekstrakurikuler`, `created_at`, `updated_at`) VALUES
(13, '110', 'PRAMUKA', '2021-12-26 07:33:03', '2021-12-26 07:33:03'),
(14, '111', 'PALANG MERAH REMAJA (PMR)', '2021-12-26 07:33:17', '2021-12-26 07:33:17'),
(15, '112', 'ROHANI ISLAM (ROHIS)', '2021-12-26 07:33:27', '2021-12-26 07:33:27'),
(16, '113', 'JURNALISTRIK (KIPRAH)', '2021-12-26 07:34:10', '2021-12-26 07:34:10'),
(17, '114', 'KARYA ILMIAH REMAJA (KIR)', '2021-12-26 07:34:47', '2021-12-26 07:34:47'),
(18, '115', 'Pusat Informasi dan Konseling Remaja (PIK-R)', '2021-12-26 07:35:34', '2021-12-26 07:35:34'),
(19, '116', 'TARI', '2021-12-26 07:35:55', '2021-12-26 07:35:55'),
(20, '117', 'MUSIK', '2021-12-26 07:36:01', '2021-12-26 07:36:01'),
(21, '118', 'TEATER', '2021-12-26 07:36:08', '2021-12-26 07:36:08'),
(22, '119', 'INKANAS', '2021-12-26 07:36:12', '2021-12-26 07:36:12'),
(23, '120', 'BASKET', '2021-12-26 07:36:19', '2021-12-26 07:36:19'),
(24, '121', 'VOLI', '2021-12-26 07:36:40', '2021-12-26 07:36:40'),
(25, '122', 'FUTSAL', '2021-12-26 07:36:46', '2021-12-26 07:36:46'),
(26, '123', 'PERSEKUTUAN PELAJAR KRISTEN (PPK)', '2021-12-26 07:37:03', '2021-12-26 07:37:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_files`
--

CREATE TABLE `tb_files` (
  `id_files` int(11) NOT NULL,
  `no_file` varchar(50) DEFAULT NULL,
  `name_file` varchar(1000) DEFAULT NULL,
  `date_file` date DEFAULT NULL,
  `file_berkas` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_files`
--

INSERT INTO `tb_files` (`id_files`, `no_file`, `name_file`, `date_file`, `file_berkas`, `created_at`, `updated_at`) VALUES
(17, '1-221-2', 'FILE 1', '2021-11-06', 'pdfcoffee.com_aws-exam-pdf-free.pdf', '2022-01-12 13:46:54', '2022-01-12 13:46:54'),
(23, '1-0-0', '123', '2022-01-14', 'DATA SASARAN TPK.xlsx', '2022-01-12 14:43:34', '2022-01-12 14:43:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan_ekstra`
--

CREATE TABLE `tb_kegiatan_ekstra` (
  `id_kegiatan` int(11) NOT NULL,
  `id_ekstra` int(11) DEFAULT NULL,
  `kode_kegiatan` varchar(100) DEFAULT NULL,
  `nama_kegiatan` varchar(1000) DEFAULT NULL,
  `tanggal_mulai_kegiatan` date DEFAULT NULL,
  `tanggal_selesai_kegiatan` date DEFAULT NULL,
  `penyelenggara_kegiatan` varchar(1000) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  `tinjau_admin` int(11) NOT NULL DEFAULT '0',
  `status_kegiatan` tinyint(4) NOT NULL DEFAULT '0',
  `setuju_pembina` tinyint(4) NOT NULL DEFAULT '0',
  `alasan_tolak` varchar(1000) DEFAULT NULL,
  `surat_tugas` varchar(10000) DEFAULT NULL,
  `bukti_kegiatan` varchar(10000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kegiatan_ekstra`
--

INSERT INTO `tb_kegiatan_ekstra` (`id_kegiatan`, `id_ekstra`, `kode_kegiatan`, `nama_kegiatan`, `tanggal_mulai_kegiatan`, `tanggal_selesai_kegiatan`, `penyelenggara_kegiatan`, `id_users`, `tinjau_admin`, `status_kegiatan`, `setuju_pembina`, `alasan_tolak`, `surat_tugas`, `bukti_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 13, '110-190722-keg-1', 'a', '2022-07-19', '2022-08-01', 'a', 1, 1, 0, 1, NULL, NULL, 'SURAT TUGAS 1 - Sun, 17 Jul 2022 10_59_12 +0700.pdf', '2022-07-19 13:16:11', '2022-07-19 13:16:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `id_level_name` int(11) NOT NULL DEFAULT '4',
  `id_acc` int(11) DEFAULT NULL,
  `id_users_cbt` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `id_level_name`, `id_acc`, `id_users_cbt`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '2021-12-26 15:06:03', '2021-12-26 15:06:03'),
(3, 2, 3, NULL, '2021-12-27 04:05:27', '2021-12-27 04:05:27'),
(4, 3, 4, NULL, '2021-12-27 04:18:58', '2021-12-27 04:18:58'),
(6, 3, 7, NULL, '2022-01-18 02:29:02', '2022-01-18 02:29:02'),
(7, 2, 8, NULL, '2022-01-19 14:31:31', '2022-01-19 14:31:31'),
(9, 2, 10, NULL, '2022-02-02 13:30:42', '2022-02-02 13:30:42'),
(10, 4, 2, 7, '2022-02-09 01:27:52', '2022-02-09 01:27:52'),
(11, 4, 6, 6, '2022-02-09 02:27:00', '2022-02-09 02:27:00'),
(12, 4, 11, 8, '2022-02-11 02:09:10', '2022-02-11 02:09:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level_name`
--

CREATE TABLE `tb_level_name` (
  `id_level_name` int(11) NOT NULL,
  `level_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_level_name`
--

INSERT INTO `tb_level_name` (`id_level_name`, `level_name`, `created_at`, `updated_at`) VALUES
(1, 'SUPERADMIN', '2021-12-26 14:57:32', '2021-12-26 14:57:32'),
(2, 'ADMIN', '2021-12-26 14:57:32', '2021-12-26 14:57:32'),
(3, 'TEACHER', '2021-12-26 14:57:47', '2021-12-26 14:57:47'),
(4, 'USER', '2021-12-26 14:57:47', '2021-12-26 14:57:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembina`
--

CREATE TABLE `tb_pembina` (
  `id_pembina` int(11) NOT NULL,
  `id_acc` int(11) DEFAULT NULL,
  `name` text,
  `nip` int(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembina`
--

INSERT INTO `tb_pembina` (`id_pembina`, `id_acc`, `name`, `nip`, `created_at`, `updated_at`) VALUES
(3, 4, 'PEMBINA PRAMUKA', 1234567890, '2022-01-18 03:01:22', '2022-01-27 05:11:14'),
(4, 7, 'TEST1', 54321, '2022-01-18 14:08:05', '2022-01-23 06:24:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_question`
--

CREATE TABLE `tb_question` (
  `que_id` int(11) NOT NULL,
  `test_id` int(5) DEFAULT NULL,
  `que_desc` varchar(50000) DEFAULT NULL,
  `ans1` varchar(500) DEFAULT NULL,
  `ans2` varchar(500) DEFAULT NULL,
  `ans3` varchar(500) DEFAULT NULL,
  `ans4` varchar(500) DEFAULT NULL,
  `ans5` varchar(500) DEFAULT NULL,
  `true_ans` varchar(500) DEFAULT NULL,
  `que_score` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_question`
--

INSERT INTO `tb_question` (`que_id`, `test_id`, `que_desc`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`, `true_ans`, `que_score`, `created_at`, `updated_at`) VALUES
(1, 1, '<p><img alt=\"\" src=\"https://idschool.net/wp-content/uploads/2017/05/Rumus-Integral-1-e1518517988448.png\" style=\"height:200px; width:485px\" /></p>\r\n\r\n<p>Jika diberikan rumus seperti diatas maka apa nama dari rumus tersebut?</p>\r\n', '<p>turunan</p>\r\n', '<p>integral</p>\r\n', '<p>matriks</p>\r\n', '<p>deferensial</p>\r\n', '<p>volume</p>\r\n', 'B', '10', '2021-12-27 14:23:19', '2021-12-27 14:23:19'),
(3, 1, '<p>Diketahui&nbsp;<img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?f%28x%29%20%3D%20%5Cint%7Bx%5E2%7Ddx\" style=\"height:41px; width:115px\" />&nbsp;. Jika&nbsp;<img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?f%282%29%20%3D%20-%5Cfrac%7B19%7D%7B3%7D\" />&nbsp;<em>maka kurva itu memotong sumbu x pada...</em></p>\r\n', '<p>(0,0)</p>\r\n', '<p>(1,0)</p>\r\n', '<p>(2,0)</p>\r\n', '<p>(3,0)</p>\r\n', '<p>(4,0)</p>\r\n', 'A', '10', '2021-12-31 06:03:22', '2021-12-31 06:03:22'),
(4, 1, '<p>Diketahui&nbsp;<img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?%5Cint%7Bf%28x%29dx%3D%5Cfrac%7B1%7D%7B4%7Dax%5E2+bx+c%7D\" />&nbsp;dan&nbsp;<img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?a%20%5Cneq%200\" />&nbsp;. Jika&nbsp; <img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?f%28a%29%20%3D%20%5Cfrac%7Ba+2b%7D%7B2%7D%20%5C%3B%20dan%20%5C%3B%20f%28b%29%20%3D%206\" />&nbsp;maka fungsi&nbsp;<img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?f%28x%29%3D\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?%5Cfrac%7B1%7D%7B2%7Dx+4\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?2x+4\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?%5Cfrac%7B1%7D%7B2%7Dx-4\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?x+4\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?-%5Cfrac%7B1%7D%7B2%7Dx+4\" style=\"height:37px; width:66px\" /></p>\r\n', 'B', '10', '2021-12-31 06:09:00', '2021-12-31 06:09:00'),
(5, 1, '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?%5Cint%7B%5Cfrac%7B3%281-x%29%7D%7B1+%5Csqrt%7Bx%7D%7D%7Ddx%3D\" style=\"height:42px; width:125px\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?3x-2x%5Csqrt%7Bx%7D+C\" style=\"height:18px; width:120px\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?2x-3x%5Csqrt%7Bx%7D+C\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?3x%5Csqrt%7Bx%7D-2x+C\" style=\"height:18px; width:120px\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?2x%5Csqrt%7Bx%7D-3x+C\" /></p>\r\n', '<p><img alt=\"\" src=\"https://latex.codecogs.com/svg.latex?3x+2x%5Csqrt%7Bx%7D+C\" /></p>\r\n', 'A', '10', '2021-12-31 06:13:47', '2021-12-31 06:13:47'),
(6, 1, '<p>asd</p>\r\n', '<p>A</p>', '<p>asd</p>\r\n', '<p>as</p>\r\n', '<p>asd</p>\r\n', '<p>asd</p>\r\n', 'C', '10', '2021-12-31 13:38:31', '2021-12-31 13:38:31'),
(7, 2, '<p>A</p>\r\n', '<p>B</p>\r\n', '<p>C</p>\r\n', '<p>D</p>\r\n', '<p>E</p>\r\n', '<p>F</p>\r\n', 'A', '10', '2022-01-02 06:44:06', '2022-01-02 06:44:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_religion`
--

CREATE TABLE `tb_religion` (
  `id_religion` int(11) NOT NULL,
  `religion` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_religion`
--

INSERT INTO `tb_religion` (`id_religion`, `religion`, `created_at`, `updated_at`) VALUES
(1, 'ISLAM', '2021-12-18 04:13:03', '2021-12-18 04:13:03'),
(2, 'KRISTEN', '2021-12-18 04:13:03', '2021-12-18 04:13:03'),
(3, 'KATHOLIK', '2021-12-18 04:14:24', '2021-12-18 04:14:24'),
(4, 'HINDU', '2021-12-18 04:14:24', '2021-12-18 04:14:24'),
(5, 'BUDDHA', '2021-12-18 04:14:24', '2021-12-18 04:14:24'),
(6, 'KONGHUCU', '2021-12-18 04:14:24', '2021-12-18 04:14:24'),
(7, 'ALIRAN KEPERCAYAAN', '2021-12-18 04:14:24', '2021-12-18 04:14:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sumber_uang`
--

CREATE TABLE `tb_sumber_uang` (
  `id_sumber` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sumber_uang`
--

INSERT INTO `tb_sumber_uang` (`id_sumber`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Dana Sekolah', '2021-05-31 01:41:50', '2021-05-31 01:41:50'),
(2, 'Dana Kas', '2021-05-31 01:41:50', '2021-05-31 01:41:50'),
(3, 'Uang Sisa', '2021-05-31 01:41:50', '2021-05-31 01:41:50'),
(4, 'Uang Usaha', '2021-05-31 01:41:50', '2021-05-31 01:41:50'),
(5, 'Dana Hibah', '2021-12-02 03:48:57', '2021-12-02 03:48:57'),
(6, 'Dana Tak Terduga', '2021-12-02 03:49:10', '2021-12-02 03:49:10'),
(7, 'Dana Lain', '2021-05-31 01:41:50', '2021-05-31 01:41:50'),
(8, 'Kegiatan Tahunan', '2021-05-31 01:41:50', '2021-05-31 01:41:50'),
(9, 'Kegiatan Besar', '2021-05-31 01:42:22', '2021-05-31 01:42:22'),
(10, 'Kegiatan Rutin', '2021-05-31 01:42:22', '2021-05-31 01:42:22'),
(11, 'Kegiatan Lomba', '2021-05-31 01:42:39', '2021-05-31 01:42:39'),
(12, 'Kegiatan Khusus', '2021-12-02 03:47:46', '2021-12-02 03:47:46'),
(13, 'Kegiatan Lain-lain', '2021-12-02 03:47:46', '2021-12-02 03:47:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_test`
--

CREATE TABLE `tb_test` (
  `test_id` int(5) NOT NULL,
  `sub_id` int(5) DEFAULT NULL,
  `test_name` varchar(500) DEFAULT NULL,
  `test_min_grade` varchar(100) DEFAULT NULL,
  `cbt_date_start` date DEFAULT NULL,
  `cbt_date_end` date DEFAULT NULL,
  `cbt_time_start` time DEFAULT NULL,
  `cbt_time_end` time DEFAULT NULL,
  `cbt_token` varchar(50) DEFAULT NULL,
  `cbt_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_test`
--

INSERT INTO `tb_test` (`test_id`, `sub_id`, `test_name`, `test_min_grade`, `cbt_date_start`, `cbt_date_end`, `cbt_time_start`, `cbt_time_end`, `cbt_token`, `cbt_status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'UJI COBA CBT', '70', '2022-02-01', '2022-02-28', '07:00:00', '09:00:00', 'CIPSW', 1, '2021-12-26 13:43:36', '2021-12-26 13:43:36'),
(2, NULL, 'UJI COBA 2', '50', '2022-01-02', '2022-01-15', NULL, NULL, NULL, 0, '2022-01-02 06:40:46', '2022-01-02 06:40:46'),
(7, NULL, 'UJI CBT 1', NULL, '2022-01-16', '2022-01-22', NULL, NULL, NULL, 0, '2022-01-15 02:22:28', '2022-01-15 02:22:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_uang_keluar`
--

CREATE TABLE `tb_uang_keluar` (
  `id_pengeluaran` int(11) NOT NULL,
  `kode_uang_keluar` varchar(100) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `id_ekstra` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_uang_keluar`
--

INSERT INTO `tb_uang_keluar` (`id_pengeluaran`, `kode_uang_keluar`, `tgl_pengeluaran`, `jumlah`, `id_sumber`, `id_ekstra`, `created_at`, `updated_at`) VALUES
(7, 'uang-keluar-02122117', '2021-12-02', 650000, 9, 13, '2021-12-02 04:28:21', '2021-12-02 04:28:21'),
(8, 'uang-keluar-02122138', '2021-11-05', 45000, 11, 14, '2021-12-02 04:28:33', '2021-12-02 04:28:33'),
(9, 'uang-keluar-02122114', '2021-11-28', 25000, 10, 15, '2021-12-02 15:12:53', '2021-12-02 15:12:53'),
(10, 'uang-keluar-02122177', '2021-10-26', 50000, 13, 16, '2021-12-02 15:31:21', '2021-12-02 15:31:21'),
(11, 'uang-keluar-15012223', '2022-01-16', 250000, 8, 17, '2022-01-15 02:54:21', '2022-01-15 02:54:21'),
(12, '110-keluar-220120', '2021-11-09', 500, 8, 13, '2022-01-19 22:37:40', '2022-01-19 22:37:40'),
(14, '111-keluar-220120', '2021-12-20', 500000, 12, 13, '2022-01-20 08:07:11', '2022-01-20 08:07:11'),
(15, '111-keluar-220120', '2022-01-19', 50000, 8, 14, '2022-01-20 08:07:22', '2022-01-20 08:07:22'),
(16, '111-keluar-220120-1642666415', '2021-12-31', 95000, 8, 14, '2022-01-20 08:13:35', '2022-01-20 08:13:35'),
(17, '115-keluar-220126-4929550188', '2022-01-26', 50000, 11, 18, '2022-01-26 07:49:56', '2022-01-26 07:49:56'),
(18, '110-keluar-220127-8216281965', '2022-01-28', 50000, 12, 13, '2022-01-27 04:06:33', '2022-01-27 04:06:33'),
(19, '111-keluar-220210-1644454339', '2022-02-10', 1500000, 11, 14, '2022-02-10 00:52:19', '2022-02-10 00:52:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_uang_masuk`
--

CREATE TABLE `tb_uang_masuk` (
  `id_pemasukan` int(11) NOT NULL,
  `kode_uang_masuk` varchar(100) NOT NULL,
  `tgl_pemasukan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `id_ekstra` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_uang_masuk`
--

INSERT INTO `tb_uang_masuk` (`id_pemasukan`, `kode_uang_masuk`, `tgl_pemasukan`, `jumlah`, `id_sumber`, `id_ekstra`, `created_at`, `updated_at`) VALUES
(16, 'uang-masuk-02122123', '2021-11-26', 171500, 5, 13, '2021-12-02 04:27:31', '2021-12-02 04:27:31'),
(18, 'uang-masuk-02122118', '2020-12-31', 1000000, 1, 14, '2021-12-02 04:49:19', '2021-12-02 04:49:19'),
(19, 'uang-masuk-02122117', '2020-12-31', 550000, 1, 15, '2021-12-02 05:06:06', '2021-12-02 05:06:06'),
(20, 'uang-masuk-02122128', '2020-11-02', 60000, 7, 16, '2021-12-02 05:06:29', '2021-12-02 05:06:29'),
(21, 'uang-masuk-02122120', '2021-11-18', 750000, 1, 17, '2021-12-02 14:28:27', '2021-12-02 14:28:27'),
(22, 'uang-masuk-02122170', '2021-10-31', 550000, 3, 18, '2021-12-02 14:50:21', '2021-12-02 14:50:21'),
(23, 'uang-masuk-02122111', '2021-10-27', 50000, 2, 19, '2021-12-02 15:09:43', '2021-12-02 15:09:43'),
(24, 'uang-masuk-02122125', '2021-10-12', 75000, 6, 20, '2021-12-02 15:20:50', '2021-12-02 15:20:50'),
(25, 'uang-masuk-02122129', '2021-10-21', 50000, 1, 21, '2021-12-02 15:21:05', '2021-12-02 15:21:05'),
(26, 'uang-masuk-02122119', '2021-10-30', 250000, 4, 22, '2021-12-02 15:21:51', '2021-12-02 15:21:51'),
(27, 'uang-masuk-15012213', '2022-01-15', 1000000, 1, 23, '2022-01-15 02:53:43', '2022-01-15 02:53:43'),
(28, 'uang-masuk-17012212', '2021-12-31', 900000, 1, 24, '2022-01-17 14:01:54', '2022-01-17 14:01:54'),
(29, 'uang-masuk-17012243', '2022-01-17', 85000, 2, 25, '2022-01-17 14:02:38', '2022-01-17 14:02:38'),
(30, '110-masuk-220120', '2021-11-02', 500, 1, 13, '2022-01-19 22:38:02', '2022-01-19 22:38:02'),
(35, '111-masuk-220120-13141330832', '2022-01-20', 50000, 4, 14, '2022-01-20 08:12:34', '2022-01-20 08:12:34'),
(36, '111-masuk-220120-11498664744', '2021-11-20', 200000, 7, 14, '2022-01-20 08:13:12', '2022-01-20 08:13:12'),
(37, '121-masuk-220126-16431833340', '2022-01-26', 100000, 3, 24, '2022-01-26 07:48:54', '2022-01-26 07:48:54'),
(38, '111-masuk-220126-6572737532', '2022-01-26', 2000000, 4, 14, '2022-01-26 08:06:23', '2022-01-26 08:06:23'),
(39, '110-masuk-220127-13146051000', '2022-01-27', 100000, 2, 13, '2022-01-27 04:06:15', '2022-01-27 04:06:15'),
(40, '115-masuk-220127-3286521258', '2022-01-27', 65000, 5, 18, '2022-01-27 05:17:09', '2022-01-27 05:17:09'),
(41, '123-masuk-220127-16432606450', '2022-01-25', 450000, 6, 26, '2022-01-27 05:17:25', '2022-01-27 05:17:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_useranswer`
--

CREATE TABLE `tb_useranswer` (
  `id_user_answer` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `id_users_cbt` int(11) DEFAULT NULL,
  `que_id` int(11) DEFAULT NULL,
  `user_answer` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_useranswer`
--

INSERT INTO `tb_useranswer` (`id_user_answer`, `test_id`, `id_users_cbt`, `que_id`, `user_answer`, `created_at`, `updated_at`) VALUES
(12, 1, 6, 1, 'B', '2022-02-08 15:45:01', '2022-02-08 15:45:01'),
(13, 1, 6, 3, 'B', '2022-02-08 15:45:47', '2022-02-08 15:45:47'),
(14, 1, 6, 4, 'C', '2022-02-08 15:45:55', '2022-02-08 15:45:55'),
(15, 1, 6, 5, 'B', '2022-02-08 15:46:17', '2022-02-08 15:46:17'),
(16, 1, 6, 6, 'B', '2022-02-08 15:46:19', '2022-02-08 15:46:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `id_acc` int(11) NOT NULL,
  `id_sso` int(11) DEFAULT NULL,
  `id_ekstra_1` int(11) DEFAULT NULL,
  `id_ekstra_2` int(11) DEFAULT NULL,
  `nisn` bigint(20) DEFAULT NULL,
  `nis` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birth_place` text,
  `birth_date` date DEFAULT NULL,
  `id_class` int(11) DEFAULT NULL,
  `id_religion` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `id_acc`, `id_sso`, `id_ekstra_1`, `id_ekstra_2`, `nisn`, `nis`, `name`, `gender`, `birth_place`, `birth_date`, `id_class`, `id_religion`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 13, 14, 1234567890, 12345, 'USER', 'L', 'A', '2000-01-01', 18, 1, '2021-12-27 12:41:20', '2021-12-27 12:41:20'),
(2, 6, NULL, 13, 15, 1234567890, 98765, 'CHAIDAR ARIA BAYU PRATAMA', 'L', 'MADIUN', '2003-01-08', 19, 1, '2022-01-15 04:19:48', '2022-01-15 04:19:48'),
(3, 11, NULL, 15, 26, 5463728190, 19283, 'ARIA', 'L', 'JAKARTA', '2001-01-01', 1, 7, '2022-02-11 02:09:10', '2022-02-11 02:09:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_address`
--

CREATE TABLE `tb_users_address` (
  `id_address` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `street` varchar(1000) DEFAULT NULL,
  `rt` varchar(50) DEFAULT NULL,
  `rw` varchar(50) DEFAULT NULL,
  `village` varchar(500) DEFAULT NULL,
  `district` varchar(500) DEFAULT NULL,
  `regency` varchar(500) DEFAULT NULL,
  `province` varchar(500) DEFAULT NULL,
  `poscode` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users_address`
--

INSERT INTO `tb_users_address` (`id_address`, `id_users`, `street`, `rt`, `rw`, `village`, `district`, `regency`, `province`, `poscode`, `created_at`, `updated_at`) VALUES
(1, 1, 'A           ', '1', '1', 'KENONGOREJO', 'PILANGKENCENG', 'MADIUN', 'JAWA TIMUR', 123456, '2021-12-27 12:41:20', '2021-12-27 12:41:20'),
(2, 2, 'SIDOLUHUR  ', '4', '1', 'KENONGOREJO', 'PILANGKENCENG', 'KAB. MADIUN', 'JAWA TIMUR', 63154, '2022-01-15 04:19:48', '2022-01-15 04:19:48'),
(3, 3, 'JALAN JALAN ', '1', '1', 'LURAH1', 'CENGKARENG', 'JAKARTA BARAT', 'JAKARTA', 1111, '2022-02-11 02:09:10', '2022-02-11 02:09:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_cbt`
--

CREATE TABLE `tb_users_cbt` (
  `id_users_cbt` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `test_id` int(5) DEFAULT NULL,
  `no_regis_admin` char(50) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users_cbt`
--

INSERT INTO `tb_users_cbt` (`id_users_cbt`, `id_users`, `test_id`, `no_regis_admin`, `username`, `password`, `created_at`, `updated_at`) VALUES
(3, NULL, NULL, 'ADMIN-011-010101', 'admin', 'admin12345', '2021-12-26 15:07:39', '2021-12-26 15:07:39'),
(6, 2, 1, NULL, '1-22-110-112', 'WDPcQlHZ', '2022-02-08 14:12:31', '2022-02-08 14:12:31'),
(7, 1, 1, NULL, '1-22-110-111', 'lVfYnzCN', '2022-02-08 23:57:38', '2022-02-08 23:57:38'),
(8, 3, 1, NULL, '1-22-112-123', '5mewCOSb', '2022-02-11 02:09:10', '2022-02-11 02:09:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_cbt_choice`
--

CREATE TABLE `tb_users_cbt_choice` (
  `id_cbt_choice` int(11) NOT NULL,
  `id_users_cbt` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users_cbt_choice`
--

INSERT INTO `tb_users_cbt_choice` (`id_cbt_choice`, `id_users_cbt`, `test_id`, `created_at`, `updated_at`) VALUES
(2, 6, 1, '2022-02-08 15:55:24', '2022-02-08 15:55:24'),
(3, 7, 1, '2022-02-08 23:58:38', '2022-02-08 23:58:38'),
(4, 8, 1, '2022-02-11 10:05:32', '2022-02-11 10:05:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_cbt_date`
--

CREATE TABLE `tb_users_cbt_date` (
  `id_cbt_date` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `id_users_cbt` int(11) DEFAULT NULL,
  `users_cbt_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users_cbt_date`
--

INSERT INTO `tb_users_cbt_date` (`id_cbt_date`, `test_id`, `id_users_cbt`, `users_cbt_date`, `created_at`, `updated_at`) VALUES
(7, 1, 6, '2022-02-08', '2022-02-08 14:44:21', '2022-02-08 14:44:21'),
(8, 1, 7, '2022-02-10', '2022-02-08 23:58:38', '2022-02-08 23:58:38'),
(9, 1, 8, '2022-02-14', '2022-02-11 10:05:32', '2022-02-11 10:05:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_cbt_grade`
--

CREATE TABLE `tb_users_cbt_grade` (
  `id_grade` int(11) NOT NULL,
  `id_users_cbt` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `grade` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users_cbt_grade`
--

INSERT INTO `tb_users_cbt_grade` (`id_grade`, `id_users_cbt`, `test_id`, `grade`, `created_at`, `updated_at`) VALUES
(3, 6, 1, '20.00', '2022-02-08 15:46:36', '2022-02-08 15:46:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_cbt_status`
--

CREATE TABLE `tb_users_cbt_status` (
  `id_status_cbt` int(11) NOT NULL,
  `id_users_cbt` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `exam_status` varchar(50) NOT NULL DEFAULT 'TERDAFTAR',
  `work_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users_cbt_status`
--

INSERT INTO `tb_users_cbt_status` (`id_status_cbt`, `id_users_cbt`, `test_id`, `exam_status`, `work_status`, `created_at`, `updated_at`) VALUES
(3, 6, 1, 'FINISH', 1, '2022-02-08 14:44:21', '2022-02-08 14:44:21'),
(5, 7, 1, 'TERDAFTAR', 0, '2022-02-08 23:58:38', '2022-02-08 23:58:38'),
(6, 8, 1, 'TERDAFTAR', 0, '2022-02-11 10:05:32', '2022-02-11 10:05:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_status`
--

CREATE TABLE `tb_users_status` (
  `id_status` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `isi_verval` tinyint(4) NOT NULL DEFAULT '0',
  `isi_foto` tinyint(4) NOT NULL DEFAULT '0',
  `is_permanent` tinyint(4) NOT NULL DEFAULT '0',
  `is_verval` tinyint(4) NOT NULL DEFAULT '0',
  `is_reset` tinyint(4) NOT NULL DEFAULT '0',
  `pilih_ekstra` tinyint(4) NOT NULL DEFAULT '0',
  `pilih_jadwal_cbt` tinyint(4) NOT NULL DEFAULT '0',
  `is_tolak` tinyint(4) NOT NULL DEFAULT '0',
  `permanent_at` timestamp NULL DEFAULT NULL,
  `verval_at` timestamp NULL DEFAULT NULL,
  `alasan_tolak` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users_status`
--

INSERT INTO `tb_users_status` (`id_status`, `id_users`, `isi_verval`, `isi_foto`, `is_permanent`, `is_verval`, `is_reset`, `pilih_ekstra`, `pilih_jadwal_cbt`, `is_tolak`, `permanent_at`, `verval_at`, `alasan_tolak`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 1, 1, 0, 1, 1, 0, '2022-01-12 13:37:33', '2022-01-23 13:02:11', '', '2021-12-27 12:41:20', '2021-12-27 12:41:20'),
(2, 2, 1, 0, 1, 1, 0, 1, 1, 0, '2022-02-03 03:45:20', '2022-02-03 03:45:27', '', '2022-01-15 04:19:48', '2022-01-15 04:19:48'),
(3, 3, 1, 1, 1, 1, 0, 1, 1, 0, '2022-02-11 02:11:57', '2022-02-11 02:32:37', '', '2022-02-11 02:09:10', '2022-02-11 02:09:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_utility`
--

CREATE TABLE `tb_users_utility` (
  `id_utility` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_spekta` varchar(50) DEFAULT NULL,
  `foto_users` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users_utility`
--

INSERT INTO `tb_users_utility` (`id_utility`, `id_users`, `id_spekta`, `foto_users`, `created_at`, `updated_at`) VALUES
(1, 1, '110-111-00-01', '12-01-2022-128221176_1317352301949132_1053601950648797114_n.jpg', '2021-12-27 12:41:20', '2021-12-27 12:41:20'),
(2, 2, '110-112-03-02', '03-02-2022-graviti.jpg', '2022-01-15 04:19:48', '2022-01-15 04:19:48'),
(3, 3, NULL, '11-02-2022-unnamed.jpg', '2022-02-11 02:09:10', '2022-02-11 02:09:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_web_settings`
--

CREATE TABLE `tb_web_settings` (
  `id_web_settings` int(11) NOT NULL,
  `about_spekta` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_web_settings`
--

INSERT INTO `tb_web_settings` (`id_web_settings`, `about_spekta`, `created_at`, `updated_at`) VALUES
(1, '<p><strong>SPEKTA SMANSA&nbsp;</strong>atau<strong> Sistem Pencatatan Keuangan dan Keanggotaan Ekstrakurikuler SMA Negeri 1 Mejayan</strong> merupakan sebuah wadah bagi ekstrakurikuler untuk melaporkan segala macam laporan baik dari sisi keuangan maupun keadministrasian.&nbsp;Dengan diluncurkannya <strong>SPEKTA SMANSA</strong> ini diharapkan bisa memberikan wadah bagi ekstrakurikuler untuk memudahkan koordinasi dengan pihah sekolah dan juga guna mempercepat pelaporan ekstrakurikuler.</p>\r\n', '2021-11-23 14:48:26', '2022-01-18 01:34:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_absensi_ekstra`
--
ALTER TABLE `tb_absensi_ekstra`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_ekstra` (`id_ekstra`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tb_account`
--
ALTER TABLE `tb_account`
  ADD PRIMARY KEY (`id_acc`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_acc` (`id_acc`),
  ADD KEY `id_ekstra` (`id_ekstra`);

--
-- Indeks untuk tabel `tb_app_settings`
--
ALTER TABLE `tb_app_settings`
  ADD PRIMARY KEY (`id_app_settings`);

--
-- Indeks untuk tabel `tb_auth_settings`
--
ALTER TABLE `tb_auth_settings`
  ADD PRIMARY KEY (`id_auth_setting`);

--
-- Indeks untuk tabel `tb_bina_ekstra`
--
ALTER TABLE `tb_bina_ekstra`
  ADD PRIMARY KEY (`id_bina_ekstra`),
  ADD KEY `id_ekstra` (`id_ekstra`),
  ADD KEY `id_pembina` (`id_pembina`),
  ADD KEY `id_pembina1` (`id_pembina`),
  ADD KEY `id_pembina_2` (`id_pembina`);

--
-- Indeks untuk tabel `tb_cbt_time`
--
ALTER TABLE `tb_cbt_time`
  ADD PRIMARY KEY (`id_time`),
  ADD KEY `test_id` (`test_id`);

--
-- Indeks untuk tabel `tb_class`
--
ALTER TABLE `tb_class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indeks untuk tabel `tb_data_sekolah`
--
ALTER TABLE `tb_data_sekolah`
  ADD PRIMARY KEY (`id_data_sekolah`);

--
-- Indeks untuk tabel `tb_ekstrakurikuler`
--
ALTER TABLE `tb_ekstrakurikuler`
  ADD PRIMARY KEY (`id_ekstra`);

--
-- Indeks untuk tabel `tb_files`
--
ALTER TABLE `tb_files`
  ADD PRIMARY KEY (`id_files`);

--
-- Indeks untuk tabel `tb_kegiatan_ekstra`
--
ALTER TABLE `tb_kegiatan_ekstra`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `id_ekstra` (`id_ekstra`),
  ADD KEY `peserta_kegiatan` (`id_users`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`),
  ADD KEY `id_acc` (`id_acc`),
  ADD KEY `id_users_cbt` (`id_users_cbt`),
  ADD KEY `id_level_name` (`id_level_name`);

--
-- Indeks untuk tabel `tb_level_name`
--
ALTER TABLE `tb_level_name`
  ADD PRIMARY KEY (`id_level_name`);

--
-- Indeks untuk tabel `tb_pembina`
--
ALTER TABLE `tb_pembina`
  ADD PRIMARY KEY (`id_pembina`),
  ADD KEY `id_acc` (`id_acc`);

--
-- Indeks untuk tabel `tb_question`
--
ALTER TABLE `tb_question`
  ADD PRIMARY KEY (`que_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indeks untuk tabel `tb_religion`
--
ALTER TABLE `tb_religion`
  ADD PRIMARY KEY (`id_religion`);

--
-- Indeks untuk tabel `tb_sumber_uang`
--
ALTER TABLE `tb_sumber_uang`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indeks untuk tabel `tb_test`
--
ALTER TABLE `tb_test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indeks untuk tabel `tb_uang_keluar`
--
ALTER TABLE `tb_uang_keluar`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_sumber` (`id_sumber`),
  ADD KEY `id_ekstra` (`id_ekstra`);

--
-- Indeks untuk tabel `tb_uang_masuk`
--
ALTER TABLE `tb_uang_masuk`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `id_sumber` (`id_sumber`),
  ADD KEY `id_ekstra` (`id_ekstra`);

--
-- Indeks untuk tabel `tb_useranswer`
--
ALTER TABLE `tb_useranswer`
  ADD PRIMARY KEY (`id_user_answer`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `que_id` (`que_id`),
  ADD KEY `user_id` (`id_users_cbt`),
  ADD KEY `id_users_cbt` (`id_users_cbt`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `id_acc` (`id_acc`),
  ADD KEY `id_ekstra` (`id_ekstra_1`),
  ADD KEY `id_class` (`id_class`,`id_religion`),
  ADD KEY `id_religion` (`id_religion`),
  ADD KEY `id_ekstra_2` (`id_ekstra_2`),
  ADD KEY `id_sso` (`id_sso`);

--
-- Indeks untuk tabel `tb_users_address`
--
ALTER TABLE `tb_users_address`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tb_users_cbt`
--
ALTER TABLE `tb_users_cbt`
  ADD PRIMARY KEY (`id_users_cbt`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_test` (`test_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indeks untuk tabel `tb_users_cbt_choice`
--
ALTER TABLE `tb_users_cbt_choice`
  ADD PRIMARY KEY (`id_cbt_choice`),
  ADD KEY `id_users_cbt` (`id_users_cbt`),
  ADD KEY `test_id` (`test_id`);

--
-- Indeks untuk tabel `tb_users_cbt_date`
--
ALTER TABLE `tb_users_cbt_date`
  ADD PRIMARY KEY (`id_cbt_date`),
  ADD KEY `test_id` (`test_id`,`id_users_cbt`),
  ADD KEY `id_users_cbt` (`id_users_cbt`);

--
-- Indeks untuk tabel `tb_users_cbt_grade`
--
ALTER TABLE `tb_users_cbt_grade`
  ADD PRIMARY KEY (`id_grade`),
  ADD KEY `id_users_cbt` (`id_users_cbt`),
  ADD KEY `test_id` (`test_id`);

--
-- Indeks untuk tabel `tb_users_cbt_status`
--
ALTER TABLE `tb_users_cbt_status`
  ADD PRIMARY KEY (`id_status_cbt`),
  ADD KEY `id_users_cbt` (`id_users_cbt`),
  ADD KEY `test_id` (`test_id`);

--
-- Indeks untuk tabel `tb_users_status`
--
ALTER TABLE `tb_users_status`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tb_users_utility`
--
ALTER TABLE `tb_users_utility`
  ADD PRIMARY KEY (`id_utility`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeks untuk tabel `tb_web_settings`
--
ALTER TABLE `tb_web_settings`
  ADD PRIMARY KEY (`id_web_settings`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_absensi_ekstra`
--
ALTER TABLE `tb_absensi_ekstra`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_account`
--
ALTER TABLE `tb_account`
  MODIFY `id_acc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_app_settings`
--
ALTER TABLE `tb_app_settings`
  MODIFY `id_app_settings` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_auth_settings`
--
ALTER TABLE `tb_auth_settings`
  MODIFY `id_auth_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_bina_ekstra`
--
ALTER TABLE `tb_bina_ekstra`
  MODIFY `id_bina_ekstra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_cbt_time`
--
ALTER TABLE `tb_cbt_time`
  MODIFY `id_time` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_class`
--
ALTER TABLE `tb_class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_data_sekolah`
--
ALTER TABLE `tb_data_sekolah`
  MODIFY `id_data_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_ekstrakurikuler`
--
ALTER TABLE `tb_ekstrakurikuler`
  MODIFY `id_ekstra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_files`
--
ALTER TABLE `tb_files`
  MODIFY `id_files` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan_ekstra`
--
ALTER TABLE `tb_kegiatan_ekstra`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_level_name`
--
ALTER TABLE `tb_level_name`
  MODIFY `id_level_name` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_pembina`
--
ALTER TABLE `tb_pembina`
  MODIFY `id_pembina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_question`
--
ALTER TABLE `tb_question`
  MODIFY `que_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_religion`
--
ALTER TABLE `tb_religion`
  MODIFY `id_religion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_sumber_uang`
--
ALTER TABLE `tb_sumber_uang`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_test`
--
ALTER TABLE `tb_test`
  MODIFY `test_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_uang_keluar`
--
ALTER TABLE `tb_uang_keluar`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_uang_masuk`
--
ALTER TABLE `tb_uang_masuk`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tb_useranswer`
--
ALTER TABLE `tb_useranswer`
  MODIFY `id_user_answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_users_address`
--
ALTER TABLE `tb_users_address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_users_cbt`
--
ALTER TABLE `tb_users_cbt`
  MODIFY `id_users_cbt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_users_cbt_choice`
--
ALTER TABLE `tb_users_cbt_choice`
  MODIFY `id_cbt_choice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_users_cbt_date`
--
ALTER TABLE `tb_users_cbt_date`
  MODIFY `id_cbt_date` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_users_cbt_grade`
--
ALTER TABLE `tb_users_cbt_grade`
  MODIFY `id_grade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_users_cbt_status`
--
ALTER TABLE `tb_users_cbt_status`
  MODIFY `id_status_cbt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_users_status`
--
ALTER TABLE `tb_users_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_users_utility`
--
ALTER TABLE `tb_users_utility`
  MODIFY `id_utility` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_web_settings`
--
ALTER TABLE `tb_web_settings`
  MODIFY `id_web_settings` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_absensi_ekstra`
--
ALTER TABLE `tb_absensi_ekstra`
  ADD CONSTRAINT `tb_absensi_ekstra_ibfk_1` FOREIGN KEY (`id_ekstra`) REFERENCES `tb_ekstrakurikuler` (`id_ekstra`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_absensi_ekstra_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_acc`) REFERENCES `tb_account` (`id_acc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_admin_ibfk_2` FOREIGN KEY (`id_ekstra`) REFERENCES `tb_ekstrakurikuler` (`id_ekstra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_bina_ekstra`
--
ALTER TABLE `tb_bina_ekstra`
  ADD CONSTRAINT `tb_bina_ekstra_ibfk_1` FOREIGN KEY (`id_ekstra`) REFERENCES `tb_ekstrakurikuler` (`id_ekstra`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_bina_ekstra_ibfk_2` FOREIGN KEY (`id_pembina`) REFERENCES `tb_pembina` (`id_pembina`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_cbt_time`
--
ALTER TABLE `tb_cbt_time`
  ADD CONSTRAINT `tb_cbt_time_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tb_test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kegiatan_ekstra`
--
ALTER TABLE `tb_kegiatan_ekstra`
  ADD CONSTRAINT `tb_kegiatan_ekstra_ibfk_1` FOREIGN KEY (`id_ekstra`) REFERENCES `tb_ekstrakurikuler` (`id_ekstra`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kegiatan_ekstra_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD CONSTRAINT `tb_level_ibfk_1` FOREIGN KEY (`id_level_name`) REFERENCES `tb_level_name` (`id_level_name`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_level_ibfk_4` FOREIGN KEY (`id_acc`) REFERENCES `tb_account` (`id_acc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_level_ibfk_5` FOREIGN KEY (`id_users_cbt`) REFERENCES `tb_users_cbt` (`id_users_cbt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembina`
--
ALTER TABLE `tb_pembina`
  ADD CONSTRAINT `tb_pembina_ibfk_2` FOREIGN KEY (`id_acc`) REFERENCES `tb_account` (`id_acc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_question`
--
ALTER TABLE `tb_question`
  ADD CONSTRAINT `tb_question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tb_test` (`test_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_uang_keluar`
--
ALTER TABLE `tb_uang_keluar`
  ADD CONSTRAINT `tb_uang_keluar_ibfk_1` FOREIGN KEY (`id_sumber`) REFERENCES `tb_sumber_uang` (`id_sumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_uang_keluar_ibfk_2` FOREIGN KEY (`id_ekstra`) REFERENCES `tb_ekstrakurikuler` (`id_ekstra`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_uang_masuk`
--
ALTER TABLE `tb_uang_masuk`
  ADD CONSTRAINT `tb_uang_masuk_ibfk_1` FOREIGN KEY (`id_sumber`) REFERENCES `tb_sumber_uang` (`id_sumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_uang_masuk_ibfk_2` FOREIGN KEY (`id_ekstra`) REFERENCES `tb_ekstrakurikuler` (`id_ekstra`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_useranswer`
--
ALTER TABLE `tb_useranswer`
  ADD CONSTRAINT `tb_useranswer_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tb_test` (`test_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_useranswer_ibfk_2` FOREIGN KEY (`que_id`) REFERENCES `tb_question` (`que_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_useranswer_ibfk_3` FOREIGN KEY (`id_users_cbt`) REFERENCES `tb_users_cbt` (`id_users_cbt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `tb_users_ibfk_1` FOREIGN KEY (`id_acc`) REFERENCES `tb_account` (`id_acc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_ibfk_2` FOREIGN KEY (`id_ekstra_1`) REFERENCES `tb_ekstrakurikuler` (`id_ekstra`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_ibfk_3` FOREIGN KEY (`id_religion`) REFERENCES `tb_religion` (`id_religion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_ibfk_4` FOREIGN KEY (`id_class`) REFERENCES `tb_class` (`id_class`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_ibfk_5` FOREIGN KEY (`id_ekstra_2`) REFERENCES `tb_ekstrakurikuler` (`id_ekstra`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users_address`
--
ALTER TABLE `tb_users_address`
  ADD CONSTRAINT `tb_users_address_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users_cbt`
--
ALTER TABLE `tb_users_cbt`
  ADD CONSTRAINT `tb_users_cbt_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tb_test` (`test_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_cbt_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users_cbt_choice`
--
ALTER TABLE `tb_users_cbt_choice`
  ADD CONSTRAINT `tb_users_cbt_choice_ibfk_1` FOREIGN KEY (`id_users_cbt`) REFERENCES `tb_users_cbt` (`id_users_cbt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_cbt_choice_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tb_test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users_cbt_date`
--
ALTER TABLE `tb_users_cbt_date`
  ADD CONSTRAINT `tb_users_cbt_date_ibfk_1` FOREIGN KEY (`id_users_cbt`) REFERENCES `tb_users_cbt` (`id_users_cbt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_cbt_date_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tb_test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users_cbt_grade`
--
ALTER TABLE `tb_users_cbt_grade`
  ADD CONSTRAINT `tb_users_cbt_grade_ibfk_1` FOREIGN KEY (`id_users_cbt`) REFERENCES `tb_users_cbt` (`id_users_cbt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_cbt_grade_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tb_test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users_cbt_status`
--
ALTER TABLE `tb_users_cbt_status`
  ADD CONSTRAINT `tb_users_cbt_status_ibfk_1` FOREIGN KEY (`id_users_cbt`) REFERENCES `tb_users_cbt` (`id_users_cbt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_users_cbt_status_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tb_test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users_status`
--
ALTER TABLE `tb_users_status`
  ADD CONSTRAINT `tb_users_status_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_users_utility`
--
ALTER TABLE `tb_users_utility`
  ADD CONSTRAINT `tb_users_utility_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
