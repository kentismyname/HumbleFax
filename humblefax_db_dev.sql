-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 02:57 AM
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
-- Database: `humblefax_db_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `faxes`
--

CREATE TABLE `faxes` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `_from` varchar(255) DEFAULT NULL,
  `_to` varchar(255) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faxes`
--

INSERT INTO `faxes` (`id`, `type`, `_from`, `_to`, `subject`, `sender`, `attachment`, `createdAt`) VALUES
(2, 'Received', 'dsfsdfsdf', 'sdfsdfsd', 'Braces', 'Right Choice  medical', 'file_1729962242.pdf', '2024-10-26 01:03:00'),
(3, 'Sent', '123', '456', 'sdfsdfsdf', 'medical', 'file_1729978344.pdf', '2024-10-26 05:32:00'),
(4, 'Received', 'vbdfbfddfg', 'ew3223', '23efsdf', 'ewrw34rf', 'file_1729979738.pdf', '2024-10-26 05:55:00'),
(5, 'Received', 'fnvghgn', 'fgvjhfghgfvhfvgh', 'vghvfghgvfh', 'ghghfvghfvgh', 'file_1729988050.pdf', '2024-10-10 08:14:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faxes`
--
ALTER TABLE `faxes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faxes`
--
ALTER TABLE `faxes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
