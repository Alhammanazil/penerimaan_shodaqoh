-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Feb 2024 pada 10.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `input`
--

CREATE TABLE `input` (
  `kodetrx` int(11) NOT NULL,
  `operator` varchar(255) DEFAULT NULL,
  `Tanggal` date DEFAULT current_timestamp(),
  `gelar1` enum('H','Hj','KH','Dr','dr','drs','R','R.H') DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `gelar2` enum('ST','SE','Alm.','SH','S.Ag') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` int(11) DEFAULT NULL,
  `total_sumbangan` int(11) DEFAULT NULL,
  `total_sumbangan_rp` int(11) DEFAULT NULL,
  `kode_kartu` enum('K','B') DEFAULT NULL,
  `ambil_kartu` text DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `input`
--

INSERT INTO `input` (`kodetrx`, `operator`, `Tanggal`, `gelar1`, `nama`, `gelar2`, `alamat`, `telepon`, `total_sumbangan`, `total_sumbangan_rp`, `kode_kartu`, `ambil_kartu`, `create_at`) VALUES
(9, NULL, '2024-02-26', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-26 14:32:32'),
(10, 'alham', '2024-02-26', 'H', 'hamdan', NULL, 'kudus', 898833563, 2, 200000, 'K', '883045U', '2024-02-26 14:43:28'),
(11, 'test', '2024-02-26', 'H', 'Akbar', '', 'Kudus', 89, 5, 200000, 'K', '332570U', '2024-02-26 15:24:16'),
(12, 'test', '2024-02-26', 'H', 'Akbar', '', 'Kudus', 89, 5, 200000, 'K', '332570U', '2024-02-26 15:24:23'),
(13, 'test', '2024-02-26', 'H', 'Akbar', '', 'Kudus', 89, 5, 200000, 'K', '332570U', '2024-02-26 15:26:47'),
(14, 'test', '2024-02-26', 'H', 'Akbar', '', 'Kudus', 89, 5, 200000, 'K', '332570U', '2024-02-26 15:27:27'),
(15, 'test', '2024-02-26', 'H', 'Akbar', '', 'Kudus', 89, 5, 200000, 'K', '332570U', '2024-02-26 15:28:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `input_detail`
--

CREATE TABLE `input_detail` (
  `kodetrx_detail` int(11) NOT NULL,
  `kodetrx` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `total_jumlah` decimal(10,2) DEFAULT NULL,
  `total_nominal` bigint(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `name`) VALUES
(1, 'admin', 'alham', '$2y$10$1QT3qrTWepeNk4zVBeGy4.W12zU7dREV6lB8/mL2fPKufOGRIT7gC', 'Alham Manazil'),
(7, 'user', 'harry', '$2y$10$cc.TWv3w.gL.yinVm/jP1u0d34xdsRENI7Fzm1h4dR.nFZBDYKJCi', 'Harry Potter'),
(8, 'user', 'Luke', '$2y$10$W1rXpsLKGxgbKr/cwHiLQeX7jw38WUER42mC99vsCtSoBcispiihC', 'Luke Skywalker');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `input`
--
ALTER TABLE `input`
  ADD PRIMARY KEY (`kodetrx`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `input`
--
ALTER TABLE `input`
  MODIFY `kodetrx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
