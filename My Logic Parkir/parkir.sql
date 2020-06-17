-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2020 pada 11.52
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya`
--

CREATE TABLE `biaya` (
  `biayaMobil` int(11) NOT NULL,
  `biayaMotor` int(11) NOT NULL,
  `biayaBusTruk` int(11) NOT NULL,
  `biayaLainnya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biaya`
--

INSERT INTO `biaya` (`biayaMobil`, `biayaMotor`, `biayaBusTruk`, `biayaLainnya`) VALUES
(10000, 2000, 20000, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkir`
--

CREATE TABLE `parkir` (
  `noPolisi` varchar(10) NOT NULL,
  `kendaraan` varchar(10) NOT NULL,
  `barangLainnya` text,
  `biayaperJam` int(11) NOT NULL,
  `waktuParkir` datetime NOT NULL,
  `waktuKeluar` datetime DEFAULT NULL,
  `biayaTotal` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parkir`
--

INSERT INTO `parkir` (`noPolisi`, `kendaraan`, `barangLainnya`, `biayaperJam`, `waktuParkir`, `waktuKeluar`, `biayaTotal`, `status`) VALUES
('AA12345BA', 'Bus/Truk', 'jaket', 1000, '2018-12-19 07:51:38', NULL, NULL, 1),
('AA12345TP', 'Mobil', '', 10000, '2018-08-13 19:18:37', '2018-12-19 07:41:40', 1127450842, 1),
('AB2312TP', 'Motor', '', 1000, '2018-08-13 19:18:46', '2018-08-13 19:47:37', 803, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `parkir`
--
ALTER TABLE `parkir`
  ADD PRIMARY KEY (`noPolisi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
