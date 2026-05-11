-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2025 at 07:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_presence`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto_shifts`
--

CREATE TABLE `auto_shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipe` varchar(191) DEFAULT NULL,
  `judul` varchar(191) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `berita_file_path` varchar(191) DEFAULT NULL,
  `berita_file_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `tipe`, `judul`, `isi`, `berita_file_path`, `berita_file_name`, `created_at`, `updated_at`) VALUES
(1, 'Berita', 'Berita 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner.jpg', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(2, 'Berita', 'Berita 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner2.jpg', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(3, 'Berita', 'Berita 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner3.jpg', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(4, 'Berita', 'Berita 4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner4.jpg', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(5, 'Berita', 'Berita 5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/banner5.jpg', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(6, 'Informasi', 'Informasi 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(7, 'Informasi', 'Informasi 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(8, 'Informasi', 'Informasi 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(9, 'Informasi', 'Informasi 4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(10, 'Informasi', 'Informasi 5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.', 'berita_file_path/informasi.png', NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `text` varchar(191) DEFAULT NULL,
  `counter` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `name`, `text`, `counter`, `created_at`, `updated_at`) VALUES
(1, 'Gaji', 'GJ', 0, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(2, 'Target Kinerja', 'TK', 0, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(3, 'Pengajuan Keuangan', 'PK', 0, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(4, 'Inventory', 'INV', 0, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(5, 'Penugasan', NULL, 0, '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `cutis`
--

CREATE TABLE `cutis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_cuti` varchar(191) DEFAULT NULL,
  `tanggal` varchar(191) DEFAULT NULL,
  `alasan_cuti` text DEFAULT NULL,
  `foto_cuti` varchar(191) DEFAULT NULL,
  `status_cuti` varchar(191) DEFAULT NULL,
  `catatan` varchar(191) DEFAULT NULL,
  `user_approval` bigint(20) UNSIGNED DEFAULT NULL,
  `leader_approval` bigint(20) UNSIGNED DEFAULT NULL,
  `name_leader_approval` varchar(191) DEFAULT NULL,
  `url_redirect` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dinas_luars`
--

CREATE TABLE `dinas_luars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` varchar(191) NOT NULL,
  `jam_absen` varchar(191) DEFAULT NULL,
  `telat` varchar(191) DEFAULT NULL,
  `lat_absen` varchar(191) DEFAULT NULL,
  `long_absen` varchar(191) DEFAULT NULL,
  `foto_jam_absen` varchar(191) DEFAULT NULL,
  `jam_pulang` varchar(191) DEFAULT NULL,
  `pulang_cepat` varchar(191) DEFAULT NULL,
  `foto_jam_pulang` varchar(191) DEFAULT NULL,
  `lat_pulang` varchar(191) DEFAULT NULL,
  `long_pulang` varchar(191) DEFAULT NULL,
  `status_absen` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_file` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fileUpload` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `golongans`
--

CREATE TABLE `golongans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(191) DEFAULT NULL,
  `nama_barang` varchar(191) DEFAULT NULL,
  `stok` double(8,2) DEFAULT NULL,
  `uom` varchar(191) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `lokasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(191) NOT NULL,
  `manager` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `nama_jabatan`, `manager`, `created_at`, `updated_at`) VALUES
(1, 'Human Resource', 1, '2025-12-31 17:32:38', '2025-12-31 17:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kinerjas`
--

CREATE TABLE `jenis_kinerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) DEFAULT NULL,
  `bobot` bigint(20) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kinerjas`
--

INSERT INTO `jenis_kinerjas` (`id`, `nama`, `bobot`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'Menyelesaikan Penugasan Kerja', 20, 'Jika pegawai menyelesaikan Penugasan Kerja yang diberikan pimpinan', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(2, 'Menghadiri Pertemuan', 5, 'Jika pegawai melakukan melakukan presensi saat pertemuan/rapat', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(3, 'Laporan Kerja', 10, 'Jika pegawai melaporkan pekerjaan sesuai tugas kerjanya', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(4, 'Pulang tepat waktu', 10, 'Jika pegawai tidak melakukan presensi pulang kerja', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(5, 'Pulang Sebelum waktunya', -5, 'Jika pegawai melakukan melakukan presensi sebelum jam kerja selesai', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(6, 'Telat Presensi Masuk', -10, 'Jika pegawai telat melakukan presensi masuk kerja', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(7, 'Presensi Kehadiran Ontime', 10, 'Jika pegawai melakukan presensi masuk kerja', '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `kasbons`
--

CREATE TABLE `kasbons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `keperluan` text NOT NULL,
  `status` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `name`, `jumlah`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Bensin Pertalite (Mobil)', 200000, 1, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(2, 'Bensin Pertalite (Motor)', 100000, 1, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(3, 'Biaya Jasa Pasang PSB (50.000)', 50000, 1, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(4, 'Pasang ODP (200.000)', 200000, 1, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(5, 'Tarik Kabel DC Backbone (500/m)', 2000000, 1, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(6, 'Lain-lain', NULL, 1, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(7, 'Pelatihan Olahraga', 1000000, NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `kontraks`
--

CREATE TABLE `kontraks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis_kontrak` varchar(191) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `masa_berlaku_sebelumnya` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `kontrak_file_path` varchar(191) DEFAULT NULL,
  `kontrak_file_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kunjungans`
--

CREATE TABLE `kunjungans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `visit_in` datetime DEFAULT NULL,
  `foto_in` varchar(191) DEFAULT NULL,
  `lat_in` varchar(191) DEFAULT NULL,
  `long_in` varchar(191) DEFAULT NULL,
  `keterangan_in` text DEFAULT NULL,
  `visit_out` datetime DEFAULT NULL,
  `foto_out` varchar(191) DEFAULT NULL,
  `lat_out` varchar(191) DEFAULT NULL,
  `long_out` varchar(191) DEFAULT NULL,
  `keterangan_out` text DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kerjas`
--

CREATE TABLE `laporan_kerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `informasi_umum` text DEFAULT NULL,
  `pekerjaan_dilaksanakan` text DEFAULT NULL,
  `pekerjaan_belum_selesai` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kinerjas`
--

CREATE TABLE `laporan_kinerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis_kinerja_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nilai` bigint(20) DEFAULT NULL,
  `penilaian_berjalan` bigint(20) DEFAULT NULL,
  `reference` varchar(191) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lemburs`
--

CREATE TABLE `lemburs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` varchar(191) NOT NULL,
  `jam_masuk` varchar(191) NOT NULL,
  `lat_masuk` varchar(191) NOT NULL,
  `long_masuk` varchar(191) NOT NULL,
  `jarak_masuk` varchar(191) NOT NULL,
  `foto_jam_masuk` varchar(191) NOT NULL,
  `jam_keluar` varchar(191) DEFAULT NULL,
  `lat_keluar` varchar(191) DEFAULT NULL,
  `long_keluar` varchar(191) DEFAULT NULL,
  `jarak_keluar` varchar(191) DEFAULT NULL,
  `foto_jam_keluar` varchar(191) DEFAULT NULL,
  `total_lembur` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `notes` varchar(191) DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasis`
--

CREATE TABLE `lokasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lokasi` varchar(191) NOT NULL,
  `lat_kantor` varchar(191) DEFAULT NULL,
  `long_kantor` varchar(191) DEFAULT NULL,
  `radius` varchar(191) DEFAULT NULL,
  `keterangan` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasis`
--

INSERT INTO `lokasis` (`id`, `nama_lokasi`, `lat_kantor`, `long_kantor`, `radius`, `keterangan`, `status`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Cabang A', '-6.3707314', '106.8138057', '200', 'Office', 'approved', 1, NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(2, 'Kantor Cabang B', '-6.3707314', '106.8138057', '200', 'Office', 'approved', 1, NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(3, 'Gedung A', '-6.3707314', '106.8138057', '200', 'Patroli', 'approved', 1, NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(4, 'Gedung B', '-6.3707332', '106.81380572', '200', 'Patroli', 'approved', 1, NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `mapping_shifts`
--

CREATE TABLE `mapping_shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_absen` varchar(191) DEFAULT NULL,
  `telat` varchar(191) DEFAULT NULL,
  `lat_absen` varchar(191) DEFAULT NULL,
  `long_absen` varchar(191) DEFAULT NULL,
  `jarak_masuk` varchar(191) DEFAULT NULL,
  `foto_jam_absen` varchar(191) DEFAULT NULL,
  `keterangan_masuk` varchar(191) DEFAULT NULL,
  `jam_pulang` varchar(191) DEFAULT NULL,
  `pulang_cepat` varchar(191) DEFAULT NULL,
  `lat_pulang` varchar(191) DEFAULT NULL,
  `long_pulang` varchar(191) DEFAULT NULL,
  `jarak_pulang` varchar(191) DEFAULT NULL,
  `foto_jam_pulang` varchar(191) DEFAULT NULL,
  `keterangan_pulang` varchar(191) DEFAULT NULL,
  `status_absen` varchar(191) DEFAULT NULL,
  `lock_location` varchar(191) DEFAULT NULL,
  `jam_masuk_pengajuan` varchar(191) DEFAULT NULL,
  `jam_pulang_pengajuan` varchar(191) DEFAULT NULL,
  `deskripsi` varchar(191) DEFAULT NULL,
  `status_pengajuan` varchar(191) DEFAULT NULL,
  `file_pengajuan` varchar(191) DEFAULT NULL,
  `komentar` varchar(191) DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
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
(5, '2022_09_16_095447_create_shifts_table', 1),
(6, '2022_09_19_032649_create_mapping_shifts_table', 1),
(7, '2022_09_20_074944_create_lemburs_table', 1),
(8, '2022_09_20_092230_create_cutis_table', 1),
(9, '2022_10_31_083510_create_lokasis_table', 1),
(10, '2022_11_02_061554_create_reset_cutis_table', 1),
(11, '2022_12_01_041742_create_sips_table', 1),
(12, '2022_12_14_080034_create_jabatans_table', 1),
(13, '2023_03_22_103407_create_dinas_luars_table', 1),
(14, '2023_04_10_130307_create_auto_shifts_table', 1),
(15, '2023_06_28_042019_create_files_table', 1),
(16, '2023_07_15_095632_create_tunjangans_table', 1),
(17, '2023_07_16_152608_create_golongans_table', 1),
(18, '2023_07_19_122052_create_status_ptkps_table', 1),
(19, '2023_07_20_082307_create_pajaks_table', 1),
(20, '2023_07_21_085614_create_payrolls_table', 1),
(21, '2023_12_05_140334_create_counters_table', 1),
(22, '2023_12_06_163716_create_kasbons_table', 1),
(23, '2024_06_15_075202_create_notifications_table', 1),
(24, '2024_07_27_095429_create_settings_table', 1),
(25, '2024_09_19_040613_create_reimbursements_table', 1),
(26, '2024_09_19_040828_create_kategoris_table', 1),
(27, '2024_09_22_082937_create_kunjungans_table', 1),
(28, '2024_10_02_182404_create_reimbursements_items_table', 1),
(29, '2024_11_23_125436_create_jenis_kinerjas_table', 1),
(30, '2024_11_23_143017_create_laporan_kinerjas_table', 1),
(31, '2024_11_23_190924_create_penugasans_table', 1),
(32, '2024_11_23_200000_create_penugasan_items_table', 1),
(33, '2024_11_26_031205_create_rapats_table', 1),
(34, '2024_11_26_040949_create_rapat_pegawais_table', 1),
(35, '2024_11_26_081727_create_rapat_notulens_table', 1),
(36, '2024_11_26_140652_create_inventories_table', 1),
(37, '2024_12_06_123720_create_kontraks_table', 1),
(38, '2024_12_08_072818_create_pegawai_keluars_table', 1),
(39, '2024_12_16_100744_create_patrolis_table', 1),
(40, '2024_12_21_174829_create_target_kinerjas_table', 1),
(41, '2024_12_23_163056_create_target_kinerja_teams_table', 1),
(42, '2025_01_01_155603_create_laporan_kerjas_table', 1),
(43, '2025_01_24_171233_create_permission_tables', 1),
(44, '2025_01_31_124509_create_pengajuan_keuangans_table', 1),
(45, '2025_01_31_161224_create_pengajuan_keuangan_items_table', 1),
(46, '2025_02_01_160925_create_beritas_table', 1),
(47, '2025_05_10_213305_create_status_pajaks_table', 1),
(48, '2025_12_28_101100_create_pengajuan_ro_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pajaks`
--

CREATE TABLE `pajaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(191) NOT NULL,
  `tahun` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patrolis`
--

CREATE TABLE `patrolis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lokasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(191) DEFAULT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `long` varchar(191) DEFAULT NULL,
  `jarak` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `bulan` varchar(191) NOT NULL,
  `tahun` varchar(191) NOT NULL,
  `persentase_kehadiran` varchar(191) NOT NULL,
  `no_gaji` varchar(191) NOT NULL,
  `gaji_pokok` bigint(20) NOT NULL,
  `total_reimbursement` bigint(20) NOT NULL,
  `jumlah_tunjangan_transport` bigint(20) NOT NULL,
  `uang_tunjangan_transport` bigint(20) NOT NULL,
  `total_tunjangan_transport` bigint(20) NOT NULL,
  `jumlah_tunjangan_makan` bigint(20) NOT NULL,
  `uang_tunjangan_makan` bigint(20) NOT NULL,
  `total_tunjangan_makan` bigint(20) NOT NULL,
  `total_tunjangan_bpjs_kesehatan` bigint(20) NOT NULL,
  `total_tunjangan_bpjs_ketenagakerjaan` bigint(20) NOT NULL,
  `total_potongan_bpjs_kesehatan` bigint(20) NOT NULL,
  `total_potongan_bpjs_ketenagakerjaan` bigint(20) NOT NULL,
  `jumlah_mangkir` bigint(20) NOT NULL,
  `uang_mangkir` bigint(20) NOT NULL,
  `total_mangkir` bigint(20) NOT NULL,
  `jumlah_lembur` bigint(20) NOT NULL,
  `uang_lembur` bigint(20) NOT NULL,
  `total_lembur` bigint(20) NOT NULL,
  `jumlah_izin` bigint(20) NOT NULL,
  `uang_izin` bigint(20) NOT NULL,
  `total_izin` bigint(20) NOT NULL,
  `bonus_pribadi` bigint(20) NOT NULL,
  `bonus_team` bigint(20) NOT NULL,
  `bonus_jackpot` bigint(20) NOT NULL,
  `jumlah_terlambat` bigint(20) NOT NULL,
  `uang_terlambat` bigint(20) NOT NULL,
  `total_terlambat` bigint(20) NOT NULL,
  `jumlah_kehadiran` bigint(20) NOT NULL,
  `uang_kehadiran` bigint(20) NOT NULL,
  `total_kehadiran` bigint(20) NOT NULL,
  `saldo_kasbon` bigint(20) NOT NULL,
  `bayar_kasbon` bigint(20) NOT NULL,
  `jumlah_thr` bigint(20) NOT NULL,
  `uang_thr` bigint(20) NOT NULL,
  `total_thr` bigint(20) NOT NULL,
  `loss` bigint(20) NOT NULL,
  `total_penjumlahan` bigint(20) NOT NULL,
  `total_pengurangan` bigint(20) NOT NULL,
  `grand_total` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_keluars`
--

CREATE TABLE `pegawai_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` varchar(191) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `pegawai_keluar_file_path` varchar(191) DEFAULT NULL,
  `pegawai_keluar_file_name` varchar(191) DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_approval` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_keuangans`
--

CREATE TABLE `pengajuan_keuangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor` varchar(191) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total_harga` bigint(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `pk_file_path` varchar(191) DEFAULT NULL,
  `pk_file_name` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `nota_file_path` varchar(191) DEFAULT NULL,
  `nota_file_name` varchar(191) DEFAULT NULL,
  `user_approval` bigint(20) UNSIGNED DEFAULT NULL,
  `note_approval` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_keuangan_items`
--

CREATE TABLE `pengajuan_keuangan_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_keuangan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(191) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_ro`
--

CREATE TABLE `pengajuan_ro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(191) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `nama_acara` varchar(191) NOT NULL,
  `tanggal_acara` date NOT NULL,
  `lokasi` varchar(191) NOT NULL,
  `durasi` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `approval_status` varchar(191) DEFAULT NULL,
  `approval_id` bigint(20) DEFAULT NULL,
  `approval_name` varchar(191) DEFAULT NULL,
  `approval_id_leader` bigint(20) DEFAULT NULL,
  `approval_name_leader` varchar(191) DEFAULT NULL,
  `validation` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penugasans`
--

CREATE TABLE `penugasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_penugasan` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `judul` varchar(191) DEFAULT NULL,
  `rincian` text DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penugasan_items`
--

CREATE TABLE `penugasan_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penugasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `flow` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rapats`
--

CREATE TABLE `rapats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` varchar(191) NOT NULL,
  `jam_selesai` varchar(191) NOT NULL,
  `lokasi` varchar(191) NOT NULL,
  `detail` text NOT NULL,
  `jenis` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rapat_notulens`
--

CREATE TABLE `rapat_notulens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rapat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `notulen` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rapat_pegawais`
--

CREATE TABLE `rapat_pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rapat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hadir` datetime DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reimbursements`
--

CREATE TABLE `reimbursements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `event` text DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `sisa` bigint(20) DEFAULT NULL,
  `file_path` varchar(191) DEFAULT NULL,
  `file_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reimbursements_items`
--

CREATE TABLE `reimbursements_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reimbursement_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fee` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reset_cutis`
--

CREATE TABLE `reset_cutis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `izin_cuti` varchar(191) NOT NULL,
  `izin_dinas_luar` varchar(191) NOT NULL,
  `izin_sakit` varchar(191) NOT NULL,
  `izin_cek_kesehatan` varchar(191) NOT NULL,
  `izin_keperluan_pribadi` varchar(191) NOT NULL,
  `izin_telat` varchar(191) NOT NULL,
  `izin_pulang_cepat` varchar(191) NOT NULL,
  `izin_lainnya` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reset_cutis`
--

INSERT INTO `reset_cutis` (`id`, `izin_cuti`, `izin_dinas_luar`, `izin_sakit`, `izin_cek_kesehatan`, `izin_keperluan_pribadi`, `izin_telat`, `izin_pulang_cepat`, `izin_lainnya`, `created_at`, `updated_at`) VALUES
(1, '10', '10', '10', '10', '10', '10', '10', '10', '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(2, 'user', 'web', '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `alamat` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `whatsapp` varchar(191) DEFAULT NULL,
  `wa_api_url` varchar(191) DEFAULT NULL,
  `wa_session` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `alamat`, `phone`, `whatsapp`, `wa_api_url`, `wa_session`, `email`, `created_at`, `updated_at`) VALUES
(1, 'HRIS R-Tech', 'logo/VnrSRAvUSybiht6pkgf1R5I7Q5gpBc0YRdnYD9eL.png', 'Kura Kura Bali SEZ, Serangan, Denpasar Selatan, Bali 80229, Indonesia', '081380783330', NULL, '-', 'absensi', 'afysaid@gmail.com', '2025-12-31 17:32:38', '2025-12-31 17:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_shift` varchar(191) NOT NULL,
  `jam_masuk` varchar(191) NOT NULL,
  `jam_keluar` varchar(191) NOT NULL,
  `jam_mulai_istirahat` varchar(191) DEFAULT NULL,
  `jam_selesai_istirahat` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `nama_shift`, `jam_masuk`, `jam_keluar`, `jam_mulai_istirahat`, `jam_selesai_istirahat`, `created_at`, `updated_at`) VALUES
(1, 'Libur', '00:00', '00:00', '00:00', '00:00', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(2, 'Pagi', '08:30', '17:30', '12:00', '13:00', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(3, 'Siang', '13:00', '21:00', '17:30', '18:30', '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(4, 'Malam', '21:00', '07:00', '01:30', '02:30', '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `sips`
--

CREATE TABLE `sips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dokumen` varchar(191) NOT NULL,
  `tanggal_berakhir` varchar(191) NOT NULL,
  `file` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_pajaks`
--

CREATE TABLE `status_pajaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `ptkp` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_pajaks`
--

INSERT INTO `status_pajaks` (`id`, `name`, `ptkp`, `created_at`, `updated_at`) VALUES
(1, 'TK/0', 54000000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(2, 'TK/1', 58500000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(3, 'TK/2', 63000000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(4, 'TK/3', 67500000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(5, 'K/0', 58500000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(6, 'K/1', 63000000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(7, 'K/2', 67500000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(8, 'K/3', 72000000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(9, 'K/I/0', 112500000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(10, 'K/I/1', 117000000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(11, 'K/I/2', 121500000, '2025-12-31 17:32:38', '2025-12-31 17:32:38'),
(12, 'K/I/3', 126000000, '2025-12-31 17:32:38', '2025-12-31 17:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `status_ptkps`
--

CREATE TABLE `status_ptkps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `ptkp_2016` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ptkp_2015` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ptkp_2009_2012` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `target_kinerjas`
--

CREATE TABLE `target_kinerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(191) DEFAULT NULL,
  `target_team` bigint(20) DEFAULT NULL,
  `jumlah_persen_team` bigint(20) DEFAULT NULL,
  `bonus_team` bigint(20) DEFAULT NULL,
  `jackpot` bigint(20) DEFAULT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `target_kinerja_teams`
--

CREATE TABLE `target_kinerja_teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `target_kinerja_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `target_pribadi` bigint(20) DEFAULT NULL,
  `jumlah_persen_pribadi` bigint(20) DEFAULT NULL,
  `bonus_pribadi` bigint(20) DEFAULT NULL,
  `judul` varchar(191) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `capai` double DEFAULT NULL,
  `nilai` varchar(191) DEFAULT NULL,
  `bonus_p` bigint(20) DEFAULT NULL,
  `bonus_t` bigint(20) DEFAULT NULL,
  `bonus_j` bigint(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tunjangans`
--

CREATE TABLE `tunjangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `golongan_id` bigint(20) UNSIGNED NOT NULL,
  `tunjangan_makan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tunjangan_transport` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `foto_karyawan` varchar(191) DEFAULT NULL,
  `foto_face_recognition` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `telepon` varchar(191) DEFAULT NULL,
  `username` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `tgl_lahir` varchar(191) DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `tgl_join` varchar(191) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `user_approval_1` varchar(191) DEFAULT NULL,
  `user_approval_2` varchar(191) DEFAULT NULL,
  `izin_cuti` bigint(20) NOT NULL DEFAULT 0,
  `izin_ro` bigint(20) NOT NULL DEFAULT 0,
  `izin_lainnya` bigint(20) NOT NULL DEFAULT 0,
  `izin_telat` bigint(20) NOT NULL DEFAULT 0,
  `izin_pulang_cepat` bigint(20) NOT NULL DEFAULT 0,
  `is_admin` varchar(191) DEFAULT NULL,
  `masa_berlaku` date DEFAULT NULL,
  `status_pajak_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jabatan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lokasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ktp` varchar(191) DEFAULT NULL,
  `kartu_keluarga` varchar(191) DEFAULT NULL,
  `bpjs_kesehatan` varchar(191) DEFAULT NULL,
  `bpjs_ketenagakerjaan` varchar(191) DEFAULT NULL,
  `npwp` varchar(191) DEFAULT NULL,
  `sim` varchar(191) DEFAULT NULL,
  `no_pkwt` varchar(191) DEFAULT NULL,
  `no_kontrak` varchar(191) DEFAULT NULL,
  `tanggal_mulai_pkwt` date DEFAULT NULL,
  `tanggal_berakhir_pkwt` date DEFAULT NULL,
  `rekening` varchar(191) DEFAULT NULL,
  `nama_rekening` varchar(191) DEFAULT NULL,
  `gaji_pokok` bigint(20) DEFAULT NULL,
  `tunjangan_makan` bigint(20) DEFAULT NULL,
  `tunjangan_transport` bigint(20) DEFAULT NULL,
  `tunjangan_bpjs_kesehatan` bigint(20) DEFAULT NULL,
  `tunjangan_bpjs_ketenagakerjaan` bigint(20) DEFAULT NULL,
  `lembur` bigint(20) DEFAULT NULL,
  `kehadiran` bigint(20) DEFAULT NULL,
  `thr` bigint(20) DEFAULT NULL,
  `bonus_pribadi` bigint(20) DEFAULT NULL,
  `bonus_team` bigint(20) DEFAULT NULL,
  `bonus_jackpot` bigint(20) DEFAULT NULL,
  `izin` bigint(20) DEFAULT NULL,
  `terlambat` bigint(20) DEFAULT NULL,
  `mangkir` bigint(20) DEFAULT NULL,
  `saldo_kasbon` bigint(20) DEFAULT NULL,
  `potongan_bpjs_kesehatan` bigint(20) DEFAULT NULL,
  `potongan_bpjs_ketenagakerjaan` bigint(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `foto_karyawan`, `foto_face_recognition`, `email`, `telepon`, `username`, `password`, `tgl_lahir`, `gender`, `tgl_join`, `alamat`, `user_approval_1`, `user_approval_2`, `izin_cuti`, `izin_ro`, `izin_lainnya`, `izin_telat`, `izin_pulang_cepat`, `is_admin`, `masa_berlaku`, `status_pajak_id`, `jabatan_id`, `lokasi_id`, `ktp`, `kartu_keluarga`, `bpjs_kesehatan`, `bpjs_ketenagakerjaan`, `npwp`, `sim`, `no_pkwt`, `no_kontrak`, `tanggal_mulai_pkwt`, `tanggal_berakhir_pkwt`, `rekening`, `nama_rekening`, `gaji_pokok`, `tunjangan_makan`, `tunjangan_transport`, `tunjangan_bpjs_kesehatan`, `tunjangan_bpjs_ketenagakerjaan`, `lembur`, `kehadiran`, `thr`, `bonus_pribadi`, `bonus_team`, `bonus_jackpot`, `izin`, `terlambat`, `mangkir`, `saldo_kasbon`, `potongan_bpjs_kesehatan`, `potongan_bpjs_ketenagakerjaan`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin HR', NULL, NULL, 'admin@tsea.asia', '081380783330', 'admin', '$2y$10$0WWDZ6uOh/HqcfD6Us/g8u1NC5bsDaEQ1JQ3hFddFlRjiks3OoOBe', '2000-04-05', 'Laki-Laki', '2000-04-05', 'Kura Kura Bali SEZ, Serangan, Denpasar Selatan, Bali 80229, Indonesia', NULL, NULL, 12, 12, 6, 16, 9, 'admin', NULL, 1, 1, 1, '3375212601981211', '2311876775523112', '1627789654371789', '2312342432556232', '2312242432556232', '2312342433356232', '8312342433356232', '8312342433356232', '2026-01-01', '2028-10-10', '1255342433356232', 'Rafli Yudistira', 7000000, 800000, 700000, 400000, 450000, 20000, 300000, 200000, 200000, 2000000, 0, 100000, 100000, 200000, 220000, 200000, 200000, NULL, NULL, '2025-12-31 17:32:38', '2025-12-31 17:32:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto_shifts`
--
ALTER TABLE `auto_shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cutis`
--
ALTER TABLE `cutis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cutis_user_approval_foreign` (`user_approval`),
  ADD KEY `cutis_leader_approval_foreign` (`leader_approval`);

--
-- Indexes for table `dinas_luars`
--
ALTER TABLE `dinas_luars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `golongans`
--
ALTER TABLE `golongans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatans_manager_foreign` (`manager`);

--
-- Indexes for table `jenis_kinerjas`
--
ALTER TABLE `jenis_kinerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kasbons`
--
ALTER TABLE `kasbons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontraks`
--
ALTER TABLE `kontraks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kunjungans`
--
ALTER TABLE `kunjungans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_kerjas`
--
ALTER TABLE `laporan_kerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_kinerjas`
--
ALTER TABLE `laporan_kinerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lemburs`
--
ALTER TABLE `lemburs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lemburs_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `lokasis`
--
ALTER TABLE `lokasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lokasis_created_by_foreign` (`created_by`),
  ADD KEY `lokasis_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `mapping_shifts`
--
ALTER TABLE `mapping_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapping_shifts_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `pajaks`
--
ALTER TABLE `pajaks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pajaks_status_id_foreign` (`status_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patrolis`
--
ALTER TABLE `patrolis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai_keluars`
--
ALTER TABLE `pegawai_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_keluars_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `pengajuan_keuangans`
--
ALTER TABLE `pengajuan_keuangans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_keuangans_user_approval_foreign` (`user_approval`);

--
-- Indexes for table `pengajuan_keuangan_items`
--
ALTER TABLE `pengajuan_keuangan_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_ro`
--
ALTER TABLE `pengajuan_ro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penugasans`
--
ALTER TABLE `penugasans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penugasan_items`
--
ALTER TABLE `penugasan_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rapats`
--
ALTER TABLE `rapats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rapat_notulens`
--
ALTER TABLE `rapat_notulens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rapat_pegawais`
--
ALTER TABLE `rapat_pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reimbursements`
--
ALTER TABLE `reimbursements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reimbursements_items`
--
ALTER TABLE `reimbursements_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_cutis`
--
ALTER TABLE `reset_cutis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sips`
--
ALTER TABLE `sips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pajaks`
--
ALTER TABLE `status_pajaks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_ptkps`
--
ALTER TABLE `status_ptkps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target_kinerjas`
--
ALTER TABLE `target_kinerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target_kinerja_teams`
--
ALTER TABLE `target_kinerja_teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `target_kinerja_teams_target_kinerja_id_foreign` (`target_kinerja_id`),
  ADD KEY `target_kinerja_teams_user_id_foreign` (`user_id`),
  ADD KEY `target_kinerja_teams_jabatan_id_foreign` (`jabatan_id`);

--
-- Indexes for table `tunjangans`
--
ALTER TABLE `tunjangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_shifts`
--
ALTER TABLE `auto_shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cutis`
--
ALTER TABLE `cutis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dinas_luars`
--
ALTER TABLE `dinas_luars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `golongans`
--
ALTER TABLE `golongans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_kinerjas`
--
ALTER TABLE `jenis_kinerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kasbons`
--
ALTER TABLE `kasbons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kontraks`
--
ALTER TABLE `kontraks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kunjungans`
--
ALTER TABLE `kunjungans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_kerjas`
--
ALTER TABLE `laporan_kerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_kinerjas`
--
ALTER TABLE `laporan_kinerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lemburs`
--
ALTER TABLE `lemburs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasis`
--
ALTER TABLE `lokasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mapping_shifts`
--
ALTER TABLE `mapping_shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `pajaks`
--
ALTER TABLE `pajaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patrolis`
--
ALTER TABLE `patrolis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pegawai_keluars`
--
ALTER TABLE `pegawai_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_keuangans`
--
ALTER TABLE `pengajuan_keuangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_keuangan_items`
--
ALTER TABLE `pengajuan_keuangan_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_ro`
--
ALTER TABLE `pengajuan_ro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penugasans`
--
ALTER TABLE `penugasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penugasan_items`
--
ALTER TABLE `penugasan_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rapats`
--
ALTER TABLE `rapats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rapat_notulens`
--
ALTER TABLE `rapat_notulens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rapat_pegawais`
--
ALTER TABLE `rapat_pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reimbursements`
--
ALTER TABLE `reimbursements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reimbursements_items`
--
ALTER TABLE `reimbursements_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reset_cutis`
--
ALTER TABLE `reset_cutis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sips`
--
ALTER TABLE `sips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_pajaks`
--
ALTER TABLE `status_pajaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `status_ptkps`
--
ALTER TABLE `status_ptkps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `target_kinerjas`
--
ALTER TABLE `target_kinerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `target_kinerja_teams`
--
ALTER TABLE `target_kinerja_teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tunjangans`
--
ALTER TABLE `tunjangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cutis`
--
ALTER TABLE `cutis`
  ADD CONSTRAINT `cutis_leader_approval_foreign` FOREIGN KEY (`leader_approval`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cutis_user_approval_foreign` FOREIGN KEY (`user_approval`) REFERENCES `users` (`id`);

--
-- Constraints for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD CONSTRAINT `jabatans_manager_foreign` FOREIGN KEY (`manager`) REFERENCES `users` (`id`);

--
-- Constraints for table `lemburs`
--
ALTER TABLE `lemburs`
  ADD CONSTRAINT `lemburs_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `lokasis`
--
ALTER TABLE `lokasis`
  ADD CONSTRAINT `lokasis_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lokasis_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `mapping_shifts`
--
ALTER TABLE `mapping_shifts`
  ADD CONSTRAINT `mapping_shifts_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pajaks`
--
ALTER TABLE `pajaks`
  ADD CONSTRAINT `pajaks_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status_ptkps` (`id`);

--
-- Constraints for table `pegawai_keluars`
--
ALTER TABLE `pegawai_keluars`
  ADD CONSTRAINT `pegawai_keluars_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengajuan_keuangans`
--
ALTER TABLE `pengajuan_keuangans`
  ADD CONSTRAINT `pengajuan_keuangans_user_approval_foreign` FOREIGN KEY (`user_approval`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `target_kinerja_teams`
--
ALTER TABLE `target_kinerja_teams`
  ADD CONSTRAINT `target_kinerja_teams_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`),
  ADD CONSTRAINT `target_kinerja_teams_target_kinerja_id_foreign` FOREIGN KEY (`target_kinerja_id`) REFERENCES `target_kinerjas` (`id`),
  ADD CONSTRAINT `target_kinerja_teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
