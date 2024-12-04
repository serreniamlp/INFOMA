-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 09:52 PM
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
-- Database: `infoma`
--

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id` int(11) NOT NULL,
  `judul_diskon` varchar(255) NOT NULL,
  `deskripsi_diskon` text DEFAULT NULL,
  `persentase_diskon` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id`, `judul_diskon`, `deskripsi_diskon`, `persentase_diskon`, `created_at`) VALUES
(1, 'Diskon Tahun Baru', 'Diskon spesial untuk seluruh kategori, dalam rangka merayakan tahun baru', 20, '2024-12-04 20:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `username`, `email`, `question`, `created_at`) VALUES
(1, 'disa', 'disa@gmail.com', 'EDEF', '2024-11-24 18:42:26'),
(2, 'disa', 'disa@gmail.com', 'ss', '2024-11-24 19:03:23'),
(3, 'disa', 'disa@gmail.com', 'dwswd', '2024-11-24 19:03:44'),
(4, 'disa', 'disa@gmail.com', 'bjadgiuase', '2024-11-25 01:55:07'),
(5, 'yansha', 'YanshaChi315@gmail.com', 'apakah disa bucin ?', '2024-12-04 17:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `deskripsi`, `created_at`) VALUES
(2, 'Kos Kirana', 'Kosan kualitas dan fasilitas yang sesuai dengan harga', '2024-12-04 20:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `latest_update`
--

CREATE TABLE `latest_update` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latest_update`
--

INSERT INTO `latest_update` (`id`, `judul`, `deskripsi`, `tanggal`, `created_at`) VALUES
(1, 'Kos Abe', 'Kos dengan hargaterjangkau dan tempat yang strategis', '2024-12-03', '2024-12-04 20:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `created_at`, `role`) VALUES
(1, 'yanshaa', 'YanshaChi315@gmail.com', '$2y$10$ZehvVbToct1PG2G6b84Txe9mAr/Ue41v60QZ9J8mL2pNVAc4zxk5K', '081389087406', '2024-11-24 16:58:05', 'user'),
(2, 'rija', 'hbqyfdq@gmail.com', '$2y$10$o56Ub5bad3X62og4gn4d7e2eKHytnorx6iwf5kRXZ06eurzJ5A.Ae', '082233445566', '2024-11-24 17:00:34', 'user'),
(3, 'doin', 'oktaviani97.eugene@lekku.id', '$2y$10$N1SfwxnpundtZVsTL/IhC.CRuxCTwYaaFGPGW/R5dY/nU0xmGGYo.', NULL, '2024-11-24 17:44:01', 'user'),
(4, 'disaa', 'disa@gmail.com', '$2y$10$BuHbJPFYaumZHbAWlsuVKuZ4gTYkBzy/TggUj1L6R5X.CPSsoBBoG', '111111112', '2024-11-24 17:54:07', 'user'),
(11, 'INFOMA', 'infoma@gmail.com', '$2y$10$YI/KQtuNdwYeXWF.LabFIuOmFproXNWTOgsXHFVZoRjCFYkw/8VTG', '122333', '2024-12-04 17:13:14', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latest_update`
--
ALTER TABLE `latest_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `latest_update`
--
ALTER TABLE `latest_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
