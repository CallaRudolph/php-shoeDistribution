-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 22, 2017 at 01:40 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes_test`
--
CREATE DATABASE IF NOT EXISTS `shoes_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shoes_test`;

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(30) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shoes_stores`
--

CREATE TABLE `shoes_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shoe_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shoes_stores`
--

INSERT INTO `shoes_stores` (`id`, `shoe_id`, `store_id`) VALUES
(1, 12, 1),
(2, 13, 2),
(3, 14, 3),
(4, 14, 4),
(6, 17, 16),
(7, 18, 17),
(8, 19, 17),
(9, 31, 19),
(10, 32, 20),
(11, 33, 21),
(12, 33, 22),
(14, 37, 34),
(15, 38, 35),
(16, 39, 35),
(17, 51, 37),
(18, 52, 38),
(19, 53, 39),
(20, 53, 40),
(22, 57, 52),
(23, 58, 53),
(24, 59, 53),
(25, 71, 55),
(26, 72, 56),
(27, 73, 57),
(28, 73, 58),
(30, 77, 70),
(31, 78, 71),
(32, 79, 71),
(33, 91, 73),
(34, 92, 74),
(35, 93, 75),
(36, 93, 76),
(38, 97, 88),
(39, 98, 89),
(40, 99, 89),
(41, 111, 91),
(42, 112, 92),
(43, 113, 93),
(44, 113, 94),
(46, 117, 106),
(47, 118, 107),
(48, 119, 107),
(49, 131, 109),
(50, 132, 110),
(51, 133, 111),
(52, 133, 112),
(54, 137, 124),
(55, 138, 125),
(56, 139, 125),
(57, 151, 127),
(58, 152, 128),
(59, 153, 129),
(60, 153, 130),
(62, 157, 142),
(63, 158, 143),
(64, 159, 143),
(65, 171, 146),
(66, 172, 147),
(67, 173, 148),
(68, 173, 149),
(70, 177, 161),
(71, 178, 162),
(72, 179, 162);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `shoes_stores`
--
ALTER TABLE `shoes_stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT for table `shoes_stores`
--
ALTER TABLE `shoes_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
