-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 08:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemrograman_uas`
--
CREATE DATABASE IF NOT EXISTS `pemrograman_uas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pemrograman_uas`;

-- --------------------------------------------------------

--
-- Table structure for table `pasien_klinik`
--

CREATE TABLE `pasien_klinik` (
  `id` int(11) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin_bayi` enum('Laki-Laki','Perempuan') NOT NULL,
  `status_kehamilan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien_klinik`
--

INSERT INTO `pasien_klinik` (`id`, `nama_ibu`, `tanggal_lahir`, `alamat`, `jenis_kelamin_bayi`, `status_kehamilan`) VALUES
(1, 'elvia', '2004-04-12', 'riau', 'Perempuan', '6bulan'),
(2, 'cella', '2003-12-12', 'karanganyar', 'Perempuan', '7 bulan'),
(3, 'latifah', '2003-11-23', 'solo', 'Perempuan', '9 bulan'),
(4, 'novia', '2004-11-01', 'sumat', 'Laki-Laki', '8 bulan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$i6UjdjcmtRMoo3NXIQPw9.yLDs289y.85MbRAoaDj21EWojFe5zWe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien_klinik`
--
ALTER TABLE `pasien_klinik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien_klinik`
--
ALTER TABLE `pasien_klinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
