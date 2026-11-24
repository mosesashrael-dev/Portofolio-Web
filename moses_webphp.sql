-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2026 at 04:48 AM
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
-- Database: `moses_webphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal_kirim` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `nama`, `email`, `pesan`, `tanggal_kirim`) VALUES
(1, 'Moses Ashrael Endrato', 'moses.20246051@student.atmi.ac.id', 'Test Contact', '2026-11-24 03:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `performa`
--

CREATE TABLE `performa` (
  `id` int(11) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `proyek_selesai` int(11) NOT NULL,
  `skor_performa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performa`
--

INSERT INTO `performa` (`id`, `tahun`, `proyek_selesai`, `skor_performa`) VALUES
(1, '2021', 12, 82),
(2, '2022', 19, 88),
(3, '2023', 25, 90),
(4, '2024', 32, 92),
(5, '2025', 40, 95),
(6, '2026', 48, 98);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `layanan` varchar(250) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `layanan`, `keterangan`) VALUES
(1, 'HEADING', 'lorem ipsum dolor sit amet consectetur adipiscing elit amet anim nulla non est qui aliqua blanditiis possimus iusto sit vero tempore molestias cum anim et cum do ut eum assumenda quo adipiscing dolorem proident amet vero eligendi et occaecat aliqua sunt ut quo et nobis in animi deserunt nulla quod proident molestias excepteur adipiscing aliquip consectetur dolores tempore iusto ut'),
(2, 'HEADING', 'lorem ipsum dolor sit amet consectetur adipiscing elit amet anim nulla non est qui aliqua blanditiis possimus iusto sit vero tempore molestias cum anim et cum do ut eum assumenda quo adipiscing dolorem proident amet vero eligendi et occaecat aliqua sunt ut quo et nobis in animi deserunt nulla quod proident molestias excepteur adipiscing aliquip consectetur dolores tempore iusto ut'),
(3, 'HEADING', 'lorem ipsum dolor sit amet consectetur adipiscing elit amet anim nulla non est qui aliqua blanditiis possimus iusto sit vero tempore molestias cum anim et cum do ut eum assumenda quo adipiscing dolorem proident amet vero eligendi et occaecat aliqua sunt ut quo et nobis in animi deserunt nulla quod proident molestias excepteur adipiscing aliquip consectetur dolores tempore iusto ut');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performa`
--
ALTER TABLE `performa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `performa`
--
ALTER TABLE `performa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
