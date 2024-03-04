-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Feb 2024 pada 04.49
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
  `create_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`kodetrx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `input_detail` (
  `kodetrx_detail` int(11) NOT NULL,
  `kodetrx` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `total_jumlah` decimal(10,2) DEFAULT NULL,
  `total_nominal` bigint(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`kodetrx_detail`),
  CONSTRAINT `fk_input_detail_input` FOREIGN KEY (`kodetrx`) REFERENCES `input` (`kodetrx`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `input`
--

INSERT INTO `input` (`kodetrx`, `operator`, `Tanggal`, `gelar1`, `nama`, `gelar2`, `alamat`, `telepon`, `total_sumbangan`, `total_sumbangan_rp`, `kode_kartu`, `ambil_kartu`, `create_at`) VALUES
(10, 'alham', '2024-02-26', 'H', 'hamdan', NULL, 'kudus', 898833563, 2, 200000, 'K', '883045U', '2024-02-26 14:43:28'),
(16, 'Alham Manazil', '2024-02-28', 'H', 'Akbar', 'SE', 'Pasuruhan Kidul, Jati, Kudus, Jawa Tengah', 2147483647, 2, 1200000, 'K', '332570U', '2024-02-28 16:13:21'),
(17, 'Alham Manazil', '2024-02-29', '', 'Timoty', '', 'Ploso, Jati, Kudus, Jawa Tengah', 0, 2, 200000, 'K', '332570U', '2024-02-29 10:25:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alamat`
--

CREATE TABLE `tb_alamat` (
  `lengkap` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_alamat`
--

INSERT INTO `tb_alamat` (`lengkap`) VALUES
('Bakalankrapyak, Kaliwungu, Kudus, Jawa Tengah'),
('Prambatan Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Prambatan Lor, Kaliwungu, Kudus, Jawa Tengah'),
('Garung Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Setrokalangan, Kaliwungu, Kudus, Jawa Tengah'),
('Banget, Kaliwungu, Kudus, Jawa Tengah'),
('Blimbing Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Sidorekso, Kaliwungu, Kudus, Jawa Tengah'),
('Gamong, Kaliwungu, Kudus, Jawa Tengah'),
('Kedungdowo, Kaliwungu, Kudus, Jawa Tengah'),
('Garung Lor, Kaliwungu, Kudus, Jawa Tengah'),
('Karangampel, Kaliwungu, Kudus, Jawa Tengah'),
('Mijen, Kaliwungu, Kudus, Jawa Tengah'),
('Kaliwungu, Kaliwungu, Kudus, Jawa Tengah'),
('Papringan, Kaliwungu, Kudus, Jawa Tengah'),
('Purwosari, Kota Kudus, Kudus, Jawa Tengah'),
('Sunggingan, Kota Kudus, Kudus, Jawa Tengah'),
('Panjunan, Kota Kudus, Kudus, Jawa Tengah'),
('Wergu Wetan, Kota Kudus, Kudus, Jawa Tengah'),
('Wergu Kulon, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Kidul, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Norowito, Kota Kudus, Kudus, Jawa Tengah'),
('Kerjasan, Kota Kudus, Kudus, Jawa Tengah'),
('Kajeksan, Kota Kudus, Kudus, Jawa Tengah'),
('Janggalan, Kota Kudus, Kudus, Jawa Tengah'),
('Demangan, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Lor, Kota Kudus, Kudus, Jawa Tengah'),
('Nganguk, Kota Kudus, Kudus, Jawa Tengah'),
('Kramat, Kota Kudus, Kudus, Jawa Tengah'),
('Demaan, Kota Kudus, Kudus, Jawa Tengah'),
('Langgardalem, Kota Kudus, Kudus, Jawa Tengah'),
('Kauman, Kota Kudus, Kudus, Jawa Tengah'),
('Damaran, Kota Kudus, Kudus, Jawa Tengah'),
('Krandon, Kota Kudus, Kudus, Jawa Tengah'),
('Singocandi, Kota Kudus, Kudus, Jawa Tengah'),
('Glantengan, Kota Kudus, Kudus, Jawa Tengah'),
('Kaliputu, Kota Kudus, Kudus, Jawa Tengah');
CREATE TABLE `input_detail` (
  `kodetrx_detail` int(11) NOT NULL,
  `kodetrx` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `total_jumlah` decimal(10,2) DEFAULT NULL,
  `total_nominal` bigint(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `input_detail`
--

INSERT INTO `input_detail` (`kodetrx_detail`, `kodetrx`, `nama_barang`, `total_jumlah`, `total_nominal`, `keterangan`, `create_at`) VALUES
(1, NULL, 'Uang', 0.00, 200000, 'sumbangan uang', '2024-02-27 12:17:25'),
(2, NULL, 'Ayam', 2.00, 0, 'ayam 2 ekor', '2024-02-28 10:40:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alamat`
--

CREATE TABLE `tb_alamat` (
  `lengkap` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_alamat`
--

INSERT INTO `tb_alamat` (`lengkap`) VALUES
('Bakalankrapyak, Kaliwungu, Kudus, Jawa Tengah'),
('Prambatan Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Prambatan Lor, Kaliwungu, Kudus, Jawa Tengah'),
('Garung Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Setrokalangan, Kaliwungu, Kudus, Jawa Tengah'),
('Banget, Kaliwungu, Kudus, Jawa Tengah'),
('Blimbing Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Sidorekso, Kaliwungu, Kudus, Jawa Tengah'),
('Gamong, Kaliwungu, Kudus, Jawa Tengah'),
('Kedungdowo, Kaliwungu, Kudus, Jawa Tengah'),
('Garung Lor, Kaliwungu, Kudus, Jawa Tengah'),
('Karangampel, Kaliwungu, Kudus, Jawa Tengah'),
('Mijen, Kaliwungu, Kudus, Jawa Tengah'),
('Kaliwungu, Kaliwungu, Kudus, Jawa Tengah'),
('Papringan, Kaliwungu, Kudus, Jawa Tengah'),
('Purwosari, Kota Kudus, Kudus, Jawa Tengah'),
('Sunggingan, Kota Kudus, Kudus, Jawa Tengah'),
('Panjunan, Kota Kudus, Kudus, Jawa Tengah'),
('Wergu Wetan, Kota Kudus, Kudus, Jawa Tengah'),
('Wergu Kulon, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Kidul, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Norowito, Kota Kudus, Kudus, Jawa Tengah'),
('Kerjasan, Kota Kudus, Kudus, Jawa Tengah'),
('Kajeksan, Kota Kudus, Kudus, Jawa Tengah'),
('Janggalan, Kota Kudus, Kudus, Jawa Tengah'),
('Demangan, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Lor, Kota Kudus, Kudus, Jawa Tengah'),
('Nganguk, Kota Kudus, Kudus, Jawa Tengah'),
('Kramat, Kota Kudus, Kudus, Jawa Tengah'),
('Demaan, Kota Kudus, Kudus, Jawa Tengah'),
('Langgardalem, Kota Kudus, Kudus, Jawa Tengah'),
('Kauman, Kota Kudus, Kudus, Jawa Tengah'),
('Damaran, Kota Kudus, Kudus, Jawa Tengah'),
('Krandon, Kota Kudus, Kudus, Jawa Tengah'),
('Singocandi, Kota Kudus, Kudus, Jawa Tengah'),
('Glantengan, Kota Kudus, Kudus, Jawa Tengah'),
('Kaliputu, Kota Kudus, Kudus, Jawa Tengah'),
('Barongan, Kota Kudus, Kudus, Jawa Tengah'),
('Burikan, Kota Kudus, Kudus, Jawa Tengah'),
('Rendeng, Kota Kudus, Kudus, Jawa Tengah'),
('Jetiskapuan, Jati, Kudus, Jawa Tengah'),
('Tanjungkarang, Jati, Kudus, Jawa Tengah'),
('Jati Wetan, Jati, Kudus, Jawa Tengah'),
('Pasuruhan Kidul, Jati, Kudus, Jawa Tengah'),
('Pasuruhan Lor, Jati, Kudus, Jawa Tengah'),
('Ploso, Jati, Kudus, Jawa Tengah'),
('Jati Kulon, Jati, Kudus, Jawa Tengah'),
('Getaspejaten, Jati, Kudus, Jawa Tengah'),
('Loram Kulon, Jati, Kudus, Jawa Tengah'),
('Loram Wetan, Jati, Kudus, Jawa Tengah'),
('Bakalankrapyak, Kaliwungu, Kudus, Jawa Tengah'),
('Prambatan Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Prambatan Lor, Kaliwungu, Kudus, Jawa Tengah'),
('Garung Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Setrokalangan, Kaliwungu, Kudus, Jawa Tengah'),
('Banget, Kaliwungu, Kudus, Jawa Tengah'),
('Blimbing Kidul, Kaliwungu, Kudus, Jawa Tengah'),
('Sidorekso, Kaliwungu, Kudus, Jawa Tengah'),
('Gamong, Kaliwungu, Kudus, Jawa Tengah'),
('Kedungdowo, Kaliwungu, Kudus, Jawa Tengah'),
('Garung Lor, Kaliwungu, Kudus, Jawa Tengah'),
('Karangampel, Kaliwungu, Kudus, Jawa Tengah'),
('Mijen, Kaliwungu, Kudus, Jawa Tengah'),
('Kaliwungu, Kaliwungu, Kudus, Jawa Tengah'),
('Papringan, Kaliwungu, Kudus, Jawa Tengah'),
('Purwosari, Kota Kudus, Kudus, Jawa Tengah'),
('Sunggingan, Kota Kudus, Kudus, Jawa Tengah'),
('Panjunan, Kota Kudus, Kudus, Jawa Tengah'),
('Wergu Wetan, Kota Kudus, Kudus, Jawa Tengah'),
('Wergu Kulon, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Kidul, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Norowito, Kota Kudus, Kudus, Jawa Tengah'),
('Kerjasan, Kota Kudus, Kudus, Jawa Tengah'),
('Kajeksan, Kota Kudus, Kudus, Jawa Tengah'),
('Janggalan, Kota Kudus, Kudus, Jawa Tengah'),
('Demangan, Kota Kudus, Kudus, Jawa Tengah'),
('Mlati Lor, Kota Kudus, Kudus, Jawa Tengah'),
('Nganguk, Kota Kudus, Kudus, Jawa Tengah'),
('Kramat, Kota Kudus, Kudus, Jawa Tengah'),
('Demaan, Kota Kudus, Kudus, Jawa Tengah'),
('Langgardalem, Kota Kudus, Kudus, Jawa Tengah'),
('Kauman, Kota Kudus, Kudus, Jawa Tengah'),
('Damaran, Kota Kudus, Kudus, Jawa Tengah'),
('Krandon, Kota Kudus, Kudus, Jawa Tengah'),
('Singocandi, Kota Kudus, Kudus, Jawa Tengah'),
('Glantengan, Kota Kudus, Kudus, Jawa Tengah'),
('Kaliputu, Kota Kudus, Kudus, Jawa Tengah'),
('Barongan, Kota Kudus, Kudus, Jawa Tengah'),
('Burikan, Kota Kudus, Kudus, Jawa Tengah'),
('Rendeng, Kota Kudus, Kudus, Jawa Tengah'),
('Jetiskapuan, Jati, Kudus, Jawa Tengah'),
('Tanjungkarang, Jati, Kudus, Jawa Tengah'),
('Jati Wetan, Jati, Kudus, Jawa Tengah'),
('Pasuruhan Kidul, Jati, Kudus, Jawa Tengah'),
('Pasuruhan Lor, Jati, Kudus, Jawa Tengah'),
('Ploso, Jati, Kudus, Jawa Tengah'),
('Jati Kulon, Jati, Kudus, Jawa Tengah'),
('Getaspejaten, Jati, Kudus, Jawa Tengah'),
('Loram Kulon, Jati, Kudus, Jawa Tengah'),
('Loram Wetan, Jati, Kudus, Jawa Tengah'),
('Jepangpakis, Jati, Kudus, Jawa Tengah'),
('Megawon, Jati, Kudus, Jawa Tengah'),
('Ngembal Kulon, Jati, Kudus, Jawa Tengah'),
('Tumpangkrasak, Jati, Kudus, Jawa Tengah'),
('Wonosoco, Undaan, Kudus, Jawa Tengah'),
('Lambangan, Undaan, Kudus, Jawa Tengah'),
('Kalirejo, Undaan, Kudus, Jawa Tengah'),
('Medini, Undaan, Kudus, Jawa Tengah'),
('Sambung, Undaan, Kudus, Jawa Tengah'),
('Glagahwaru, Undaan, Kudus, Jawa Tengah'),
('Kutuk, Undaan, Kudus, Jawa Tengah'),
('Undaan Kidul, Undaan, Kudus, Jawa Tengah'),
('Undaan Tengah, Undaan, Kudus, Jawa Tengah'),
('Karangrowo, Undaan, Kudus, Jawa Tengah'),
('Larikrejo, Undaan, Kudus, Jawa Tengah'),
('Undaan Lor, Undaan, Kudus, Jawa Tengah'),
('Wates, Undaan, Kudus, Jawa Tengah'),
('Ngemplak, Undaan, Kudus, Jawa Tengah'),
('Terangmas, Undaan, Kudus, Jawa Tengah'),
('Berugenjang, Undaan, Kudus, Jawa Tengah'),
('Gulang, Mejobo, Kudus, Jawa Tengah'),
('Jepang, Mejobo, Kudus, Jawa Tengah'),
('Payaman, Mejobo, Kudus, Jawa Tengah'),
('Kirig, Mejobo, Kudus, Jawa Tengah'),
('Temulus, Mejobo, Kudus, Jawa Tengah'),
('Kesambi, Mejobo, Kudus, Jawa Tengah'),
('Jojo, Mejobo, Kudus, Jawa Tengah'),
('Hadiwarno, Mejobo, Kudus, Jawa Tengah'),
('Mejobo, Mejobo, Kudus, Jawa Tengah'),
('Golantepus, Mejobo, Kudus, Jawa Tengah'),
('Tenggeles, Mejobo, Kudus, Jawa Tengah'),
('Sadang, Jekulo, Kudus, Jawa Tengah'),
('Bulungcangkring, Jekulo, Kudus, Jawa Tengah'),
('Bulung Kulon, Jekulo, Kudus, Jawa Tengah'),
('Sidomulyo, Jekulo, Kudus, Jawa Tengah'),
('Gondoharum, Jekulo, Kudus, Jawa Tengah'),
('Terban, Jekulo, Kudus, Jawa Tengah'),
('Pladen, Jekulo, Kudus, Jawa Tengah'),
('Klaling, Jekulo, Kudus, Jawa Tengah'),
('Jekulo, Jekulo, Kudus, Jawa Tengah'),
('Hadipolo, Jekulo, Kudus, Jawa Tengah'),
('Honggosoco, Jekulo, Kudus, Jawa Tengah'),
('Tanjungrejo, Jekulo, Kudus, Jawa Tengah'),
('Dersalam, Bae, Kudus, Jawa Tengah'),
('Ngembalrejo, Bae, Kudus, Jawa Tengah'),
('Karangbener, Bae, Kudus, Jawa Tengah'),
('Gondangmanis, Bae, Kudus, Jawa Tengah'),
('Pedawang, Bae, Kudus, Jawa Tengah'),
('Bacin, Bae, Kudus, Jawa Tengah'),
('Panjang, Bae, Kudus, Jawa Tengah'),
('Peganjaran, Bae, Kudus, Jawa Tengah'),
('Purworejo, Bae, Kudus, Jawa Tengah'),
('Bae, Bae, Kudus, Jawa Tengah'),
('Gribig, Gebog, Kudus, Jawa Tengah'),
('Klumpit, Gebog, Kudus, Jawa Tengah'),
('Getassrabi, Gebog, Kudus, Jawa Tengah'),
('Padurenan, Gebog, Kudus, Jawa Tengah'),
('Karangmalang, Gebog, Kudus, Jawa Tengah'),
('Besito, Gebog, Kudus, Jawa Tengah'),
('Jurang, Gebog, Kudus, Jawa Tengah'),
('Gondosari, Gebog, Kudus, Jawa Tengah'),
('Kedungsari, Gebog, Kudus, Jawa Tengah'),
('Menawan, Gebog, Kudus, Jawa Tengah'),
('Rahtawu, Gebog, Kudus, Jawa Tengah'),
('Samirejo, Dawe, Kudus, Jawa Tengah'),
('Cendono, Dawe, Kudus, Jawa Tengah'),
('Margorejo, Dawe, Kudus, Jawa Tengah'),
('Rejosari, Dawe, Kudus, Jawa Tengah'),
('Kandangmas, Dawe, Kudus, Jawa Tengah'),
('Glagah Kulon, Dawe, Kudus, Jawa Tengah'),
('Tergo, Dawe, Kudus, Jawa Tengah'),
('Cranggang, Dawe, Kudus, Jawa Tengah'),
('Lau, Dawe, Kudus, Jawa Tengah'),
('Piji, Dawe, Kudus, Jawa Tengah'),
('Puyoh, Dawe, Kudus, Jawa Tengah'),
('Soco, Dawe, Kudus, Jawa Tengah'),
('Ternadi, Dawe, Kudus, Jawa Tengah'),
('Kajar, Dawe, Kudus, Jawa Tengah'),
('Kuwukan, Dawe, Kudus, Jawa Tengah'),
('Dukuhwaringin, Dawe, Kudus, Jawa Tengah'),
('Japan, Dawe, Kudus, Jawa Tengah'),
('Colo, Dawe, Kudus, Jawa Tengah'),
('Kedungmalang, Kedung, Jepara, Jawa Tengah'),
('Kalianyar, Kedung, Jepara, Jawa Tengah'),
('Karangaji, Kedung, Jepara, Jawa Tengah'),
('Tedunan, Kedung, Jepara, Jawa Tengah'),
('Sowan Lor, Kedung, Jepara, Jawa Tengah'),
('Sowan Kidul, Kedung, Jepara, Jawa Tengah'),
('Wanusobo, Kedung, Jepara, Jawa Tengah'),
('Surodadi, Kedung, Jepara, Jawa Tengah'),
('Panggung, Kedung, Jepara, Jawa Tengah'),
('Bulak Baru, Kedung, Jepara, Jawa Tengah'),
('Jondang, Kedung, Jepara, Jawa Tengah'),
('Bugel, Kedung, Jepara, Jawa Tengah'),
('Dongos, Kedung, Jepara, Jawa Tengah'),
('Menganti, Kedung, Jepara, Jawa Tengah'),
('Kerso, Kedung, Jepara, Jawa Tengah'),
('Tanggul Tlare, Kedung, Jepara, Jawa Tengah'),
('Rau, Kedung, Jepara, Jawa Tengah'),
('Sukosono, Kedung, Jepara, Jawa Tengah'),
('Kaliombo, Pecangaan, Jepara, Jawa Tengah'),
('Karangrandu, Pecangaan, Jepara, Jawa Tengah'),
('Gerdu, Pecangaan, Jepara, Jawa Tengah'),
('Pecangaan Kulon, Pecangaan, Jepara, Jawa Tengah'),
('Rengging, Pecangaan, Jepara, Jawa Tengah'),
('Troso, Pecangaan, Jepara, Jawa Tengah'),
('Ngeling, Pecangaan, Jepara, Jawa Tengah'),
('Pulodarat, Pecangaan, Jepara, Jawa Tengah'),
('Lebuawu, Pecangaan, Jepara, Jawa Tengah'),
('Gemulung, Pecangaan, Jepara, Jawa Tengah'),
('Pecangaan Wetan, Pecangaan, Jepara, Jawa Tengah'),
('Krasak, Pecangaan, Jepara, Jawa Tengah'),
('Ujung Pandan, Welahan, Jepara, Jawa Tengah'),
('Karanganyar, Welahan, Jepara, Jawa Tengah'),
('Guwosobokerto, Welahan, Jepara, Jawa Tengah'),
('Kedungsarimulyo, Welahan, Jepara, Jawa Tengah'),
('Bugo, Welahan, Jepara, Jawa Tengah'),
('Welahan, Welahan, Jepara, Jawa Tengah'),
('Gedangan, Welahan, Jepara, Jawa Tengah'),
('Ketilengsingolelo, Welahan, Jepara, Jawa Tengah'),
('Kalipucang Wetan, Welahan, Jepara, Jawa Tengah'),
('Kalipucang Kulon, Welahan, Jepara, Jawa Tengah'),
('Gidangelo, Welahan, Jepara, Jawa Tengah'),
('Kendengsidialit, Welahan, Jepara, Jawa Tengah'),
('Sidigede, Welahan, Jepara, Jawa Tengah'),
('Teluk Wetan, Welahan, Jepara, Jawa Tengah'),
('Brantak Sekarjati, Welahan, Jepara, Jawa Tengah'),
('Mayong Lor, Mayong, Jepara, Jawa Tengah'),
('Tigajuru, Mayong, Jepara, Jawa Tengah'),
('Paren, Mayong, Jepara, Jawa Tengah'),
('Kuanyar, Mayong, Jepara, Jawa Tengah'),
('Pelang, Mayong, Jepara, Jawa Tengah'),
('Sengonbugel, Mayong, Jepara, Jawa Tengah'),
('Jebol, Mayong, Jepara, Jawa Tengah'),
('Singorojo, Mayong, Jepara, Jawa Tengah'),
('Pelemkerep, Mayong, Jepara, Jawa Tengah'),
('Buaran, Mayong, Jepara, Jawa Tengah'),
('Ngroto, Mayong, Jepara, Jawa Tengah'),
('Rajekwesi, Mayong, Jepara, Jawa Tengah'),
('Datar, Mayong, Jepara, Jawa Tengah'),
('Pule, Mayong, Jepara, Jawa Tengah'),
('Bandung, Mayong, Jepara, Jawa Tengah'),
('Bungu, Mayong, Jepara, Jawa Tengah'),
('Pancur, Mayong, Jepara, Jawa Tengah'),
('Mayong Kidul, Mayong, Jepara, Jawa Tengah'),
('Geneng, Batealit, Jepara, Jawa Tengah'),
('Raguklampitan, Batealit, Jepara, Jawa Tengah'),
('Ngasem, Batealit, Jepara, Jawa Tengah'),
('Bawu, Batealit, Jepara, Jawa Tengah'),
('Mindahan, Batealit, Jepara, Jawa Tengah'),
('Somosari, Batealit, Jepara, Jawa Tengah'),
('Batealit, Batealit, Jepara, Jawa Tengah'),
('Bringin, Batealit, Jepara, Jawa Tengah'),
('Bantrung, Batealit, Jepara, Jawa Tengah'),
('Pekalongan, Batealit, Jepara, Jawa Tengah'),
('Mindahan Kidul, Batealit, Jepara, Jawa Tengah'),
('Karangkebagusan, Jepara, Jepara, Jawa Tengah'),
('Demaan, Jepara, Jepara, Jawa Tengah'),
('Potroyudan, Jepara, Jepara, Jawa Tengah'),
('Bapangan, Jepara, Jepara, Jawa Tengah'),
('Saripan, Jepara, Jepara, Jawa Tengah'),
('Panggang, Jepara, Jepara, Jawa Tengah'),
('Kauman, Jepara, Jepara, Jawa Tengah'),
('Bulu, Jepara, Jepara, Jawa Tengah'),
('Jobokuto, Jepara, Jepara, Jawa Tengah'),
('Ujungbatu, Jepara, Jepara, Jawa Tengah'),
('Pengkol, Jepara, Jepara, Jawa Tengah'),
('Mulyoharjo, Jepara, Jepara, Jawa Tengah'),
('Wonorejo, Jepara, Jepara, Jawa Tengah'),
('Kedungcino, Jepara, Jepara, Jawa Tengah'),
('Kuwasen, Jepara, Jepara, Jawa Tengah'),
('Bandengan, Jepara, Jepara, Jawa Tengah'),
('Mororejo, Mlonggo, Jepara, Jawa Tengah'),
('Suwawal, Mlonggo, Jepara, Jawa Tengah'),
('Sinanggul, Mlonggo, Jepara, Jawa Tengah'),
('Jambu, Mlonggo, Jepara, Jawa Tengah'),
('Srobyong, Mlonggo, Jepara, Jawa Tengah'),
('Sekuro, Mlonggo, Jepara, Jawa Tengah'),
('Karanggondang, Mlonggo, Jepara, Jawa Tengah'),
('Jambu Timur, Mlonggo, Jepara, Jawa Tengah'),
('Guyangan, Bangsri, Jepara, Jawa Tengah'),
('Kepuk, Bangsri, Jepara, Jawa Tengah'),
('Papasan, Bangsri, Jepara, Jawa Tengah'),
('Srikandang, Bangsri, Jepara, Jawa Tengah'),
('Tengguli, Bangsri, Jepara, Jawa Tengah'),
('Bangsri, Bangsri, Jepara, Jawa Tengah'),
('Banjaran, Bangsri, Jepara, Jawa Tengah'),
('Wedelan, Bangsri, Jepara, Jawa Tengah'),
('Kedungleper, Bangsri, Jepara, Jawa Tengah'),
('Jerukwangi, Bangsri, Jepara, Jawa Tengah'),
('Bondo, Bangsri, Jepara, Jawa Tengah'),
('Banjaragung, Bangsri, Jepara, Jawa Tengah'),
('Tempur, Keling, Jepara, Jawa Tengah'),
('Damarwulan, Keling, Jepara, Jawa Tengah'),
('Kunir, Keling, Jepara, Jawa Tengah'),
('Watuaji, Keling, Jepara, Jawa Tengah'),
('Klepu, Keling, Jepara, Jawa Tengah'),
('Tunahan, Keling, Jepara, Jawa Tengah'),
('Kaligarang, Keling, Jepara, Jawa Tengah'),
('Keling, Keling, Jepara, Jawa Tengah'),
('Gelang, Keling, Jepara, Jawa Tengah'),
('Jlegong, Keling, Jepara, Jawa Tengah'),
('Kelet, Keling, Jepara, Jawa Tengah'),
('Bumiharjo, Keling, Jepara, Jawa Tengah'),
('Karimunjawa, Karimun Jawa, Jepara, Jawa Tengah'),
('Kemujan, Karimun Jawa, Jepara, Jawa Tengah'),
('Parang, Karimun Jawa, Jepara, Jawa Tengah'),
('Nyamuk, Karimun Jawa, Jepara, Jawa Tengah'),
('Ngabul, Tahunan, Jepara, Jawa Tengah'),
('Langon, Tahunan, Jepara, Jawa Tengah'),
('Sukodono, Tahunan, Jepara, Jawa Tengah'),
('Petekeyan, Tahunan, Jepara, Jawa Tengah'),
('Mangunan, Tahunan, Jepara, Jawa Tengah'),
('Platar, Tahunan, Jepara, Jawa Tengah'),
('Semat, Tahunan, Jepara, Jawa Tengah'),
('Telukawur, Tahunan, Jepara, Jawa Tengah'),
('Demangan, Tahunan, Jepara, Jawa Tengah'),
('Tegalsambi, Tahunan, Jepara, Jawa Tengah'),
('Mantingan, Tahunan, Jepara, Jawa Tengah'),
('Tahunan, Tahunan, Jepara, Jawa Tengah'),
('Kecapi, Tahunan, Jepara, Jawa Tengah'),
('Senenan, Tahunan, Jepara, Jawa Tengah'),
('Krapyak, Tahunan, Jepara, Jawa Tengah'),
('Blimbingrejo, Nalumsari, Jepara, Jawa Tengah'),
('Tunggulpandean, Nalumsari, Jepara, Jawa Tengah'),
('Pringtulis, Nalumsari, Jepara, Jawa Tengah'),
('Jatisari, Nalumsari, Jepara, Jawa Tengah'),
('Gemiring Kidul, Nalumsari, Jepara, Jawa Tengah'),
('Gemiring Lor, Nalumsari, Jepara, Jawa Tengah'),
('Nalumsari, Nalumsari, Jepara, Jawa Tengah'),
('Tritis, Nalumsari, Jepara, Jawa Tengah'),
('Daren, Nalumsari, Jepara, Jawa Tengah'),
('Karangnongko, Nalumsari, Jepara, Jawa Tengah'),
('Ngetuk, Nalumsari, Jepara, Jawa Tengah'),
('Bedanpete, Nalumsari, Jepara, Jawa Tengah'),
('Muryolobo, Nalumsari, Jepara, Jawa Tengah'),
('Bategede, Nalumsari, Jepara, Jawa Tengah'),
('Dorang, Nalumsari, Jepara, Jawa Tengah'),
('Batukali, Kalinyamatan, Jepara, Jawa Tengah'),
('Bandungrejo, Kalinyamatan, Jepara, Jawa Tengah'),
('Banyuputih, Kalinyamatan, Jepara, Jawa Tengah'),
('Pendosawalan, Kalinyamatan, Jepara, Jawa Tengah'),
('Damarjati, Kalinyamatan, Jepara, Jawa Tengah'),
('Purwogondo, Kalinyamatan, Jepara, Jawa Tengah'),
('Margoyoso, Kalinyamatan, Jepara, Jawa Tengah'),
('Sendang, Kalinyamatan, Jepara, Jawa Tengah'),
('Kriyan, Kalinyamatan, Jepara, Jawa Tengah'),
('Robayan, Kalinyamatan, Jepara, Jawa Tengah'),
('Bakalan, Kalinyamatan, Jepara, Jawa Tengah'),
('Manyargading, Kalinyamatan, Jepara, Jawa Tengah'),
('Dudak Awu, Kembang, Jepara, Jawa Tengah'),
('Sumanding, Kembang, Jepara, Jawa Tengah'),
('Bucu, Kembang, Jepara, Jawa Tengah'),
('Cepogo, Kembang, Jepara, Jawa Tengah'),
('Pendem, Kembang, Jepara, Jawa Tengah'),
('Jinggotan, Kembang, Jepara, Jawa Tengah'),
('Dermolo, Kembang, Jepara, Jawa Tengah'),
('Kaliaman, Kembang, Jepara, Jawa Tengah'),
('Tubanan, Kembang, Jepara, Jawa Tengah'),
('Balong, Kembang, Jepara, Jawa Tengah'),
('Kancilan, Kembang, Jepara, Jawa Tengah'),
('Lebak, Pakis Aji, Jepara, Jawa Tengah'),
('Bulungan, Pakis Aji, Jepara, Jawa Tengah'),
('Suwawal Timur, Pakis Aji, Jepara, Jawa Tengah'),
('Kawak, Pakis Aji, Jepara, Jawa Tengah'),
('Tanjung, Pakis Aji, Jepara, Jawa Tengah'),
('Plajan, Pakis Aji, Jepara, Jawa Tengah'),
('Slagi, Pakis Aji, Jepara, Jawa Tengah'),
('Mambak, Pakis Aji, Jepara, Jawa Tengah'),
('Sumberrejo, Donorojo, Jepara, Jawa Tengah'),
('Clering, Donorojo, Jepara, Jawa Tengah'),
('Ujungwatu, Donorojo, Jepara, Jawa Tengah'),
('Banyumanis, Donorojo, Jepara, Jawa Tengah'),
('Tulakan, Donorojo, Jepara, Jawa Tengah'),
('Bandungharjo, Donorojo, Jepara, Jawa Tengah'),
('Blingoh, Donorojo, Jepara, Jawa Tengah'),
('Jugo, Donorojo, Jepara, Jawa Tengah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `minimal_k` int(11) DEFAULT NULL,
  `minimal_b` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `satuan`, `minimal_k`, `minimal_b`) VALUES
(1, 'Uang', 'Rp', 50000, 500000),
(2, 'Kerbau', 'Ekor', 1, NULL),
(3, 'Kambing', 'Ekor', 1, NULL),
(4, 'Ayam', 'Ekor', 1, 10),
(5, 'Beras', 'Kg', 5, 50),
(6, 'Gula', 'Kg', 5, 50),
(7, 'Kecap', 'Btl', 5, 50),
(8, 'Minyak Goreng (ltr)', 'Ltr', 1, 50),
(9, 'Kain Biasa (Meter)', 'Mtr', 5, 45),
(10, 'Permadani', 'Buah', NULL, 1),
(11, 'Vitrage (Kelambu)', 'Mtr', NULL, 5),
(12, 'Kain Primisima (Meter)', 'Mtr', 5, 30),
(13, 'Bawang Merah', 'Kg', 5, 200),
(14, 'Bawang Putih', 'Kg', 5, 200),
(15, 'Garam', 'Kg', 5, 250),
(16, 'Pisang', 'Sisir', NULL, 50),
(17, 'Kelapa', 'Buah', NULL, 50),
(18, 'Masker Medis', 'Bks', 1, 50),
(19, 'Masker Kn95', 'Bks', 1, 50),
(20, 'Hand Sanitizer', 'Bks', 1, 50),
(21, 'Face Shield', 'Bks', 1, 50),
(22, 'Lain-lain', 'Buah', NULL, 50),
(23, 'Daun Jati', 'Ikat', 5, 30),
(24, 'Air Mineral', 'Karton', 1, 25),
(25, 'Rokok (Bks)', 'Bks', 1, 20),
(26, 'Gula Merah', 'Kg', 1, 20),
(27, 'Kopi / Teh', 'Bks', 1, 50),
(28, 'Roti', 'Bks', 1, 50),
(29, 'Pengantar Hewan', '', 1, 50);

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
(8, 'user', 'Luke', '$2y$10$W1rXpsLKGxgbKr/cwHiLQeX7jw38WUER42mC99vsCtSoBcispiihC', 'Luke Skywalker'),
(15, 'admin', 'admin', 'admin', 'admin app'),
(16, 'user', 'jason', '$2y$10$RcPWj8HYbVuDqe6oRzELKez1iP2T3DIEVIThnsVaGLNfIWKloH/ea', 'Jason Barron');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `input`
--
ALTER TABLE `input`
  ADD PRIMARY KEY (`kodetrx`);

--
-- Indeks untuk tabel `input_detail`
--
ALTER TABLE `input_detail`
  ADD PRIMARY KEY (`kodetrx_detail`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

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
  MODIFY `kodetrx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `input_detail`
--
ALTER TABLE `input_detail`
  MODIFY `kodetrx_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
