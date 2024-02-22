-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2024 pada 10.49
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
  `Tanggal` date DEFAULT curdate(),
  `gelar1` enum('H','Hj','KH','Dr','dr','drs','R','R.H') DEFAULT NULL,
  `gelar2` enum('ST','SE','Alm.','SH','S.Ag') DEFAULT NULL,
  `alamat` int(11) DEFAULT NULL,
  `telepon` int(11) DEFAULT NULL,
  `total_sumbangan` decimal(10,2) DEFAULT NULL,
  `total_sumbangan_rp` bigint(20) DEFAULT NULL,
  `kode_kartu` tinyint(1) DEFAULT NULL,
  `ambil_kartu` text DEFAULT NULL,
  `log` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `input`
--
DELIMITER $$
CREATE TRIGGER `hitungTotalSumbangan` BEFORE INSERT ON `input` FOR EACH ROW BEGIN
    SET NEW.TotalSumbangan = (SELECT SUM(TotalJumlah) FROM InputDetail WHERE TransaksiID = NEW.KodeTrx);
    SET NEW.TotalSumbanganRp = (SELECT SUM(TotalNominalRp) FROM InputDetail WHERE TransaksiID = NEW.KodeTrx);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `input_detail`
--

CREATE TABLE `input_detail` (
  `KodeTrxDetail` int(11) NOT NULL,
  `KodeTrx` int(11) DEFAULT NULL,
  `NamaBarang` varchar(255) DEFAULT NULL,
  `TotalJumlah` decimal(10,2) DEFAULT NULL,
  `TotalNominalRp` bigint(20) DEFAULT NULL,
  `Kas` varchar(50) DEFAULT NULL,
  `NamaSubSumbangan` varchar(255) DEFAULT NULL,
  `AtasNama` varchar(255) DEFAULT NULL,
  `Keterangan` text DEFAULT NULL,
  `Log` text DEFAULT NULL
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
(7, 'user', 'harry', '$2y$10$cc.TWv3w.gL.yinVm/jP1u0d34xdsRENI7Fzm1h4dR.nFZBDYKJCi', 'Harry Potter');

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
  ADD PRIMARY KEY (`KodeTrxDetail`),
  ADD KEY `KodeTrx` (`KodeTrx`);

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
  MODIFY `kodetrx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `input_detail`
--
ALTER TABLE `input_detail`
  MODIFY `KodeTrxDetail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `input_detail`
--
ALTER TABLE `input_detail`
  ADD CONSTRAINT `input_detail_ibfk_1` FOREIGN KEY (`KodeTrx`) REFERENCES `input` (`kodetrx`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
