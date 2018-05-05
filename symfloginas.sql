-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2018 at 02:34 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfloginas`
--

-- --------------------------------------------------------

--
-- Table structure for table `uzd`
--

CREATE TABLE `uzd` (
  `id` int(11) NOT NULL,
  `taskname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uzd`
--

INSERT INTO `uzd` (`id`, `taskname`, `username`, `location`, `status`) VALUES
(1, 'pirma', 'user', 'Vilnius', 'nepadaryta');

-- --------------------------------------------------------

--
-- Table structure for table `vart`
--

CREATE TABLE `vart` (
  `id` int(11) NOT NULL,
  `username` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vart`
--

INSERT INTO `vart` (`id`, `username`, `email`, `password`, `usertype`) VALUES
(3, 'admin2', 'admin@admin.com', '$2y$13$vasHbDvTkTWu9.qedsZDaeWldYHkh039RODWgtG2FdXgqaSC5Rh7C', 'ROLE_ADMIN'),
(4, 'user', 'su@su.lt', '$2y$13$CpK.f2mf.Qg2VXQsm6rYtOGFJvLxtW/VDFDVjZSkAUA2wrbd3KzLe', 'ROLE_USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uzd`
--
ALTER TABLE `uzd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vart`
--
ALTER TABLE `vart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6C642F1AF85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_6C642F1AE7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzd`
--
ALTER TABLE `uzd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vart`
--
ALTER TABLE `vart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
