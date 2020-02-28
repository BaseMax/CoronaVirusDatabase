-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2020 at 02:56 PM
-- Server version: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corona2`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `totalCase` int(11) NOT NULL,
  `totalDeath` int(11) NOT NULL,
  `totalRecovered` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `totalCase`, `totalDeath`, `totalRecovered`, `datetime`) VALUES
(1, 'mainland china', 78824, 2788, 36268, '2020-02-28 14:38:52'),
(2, 'south korea', 2337, 13, 22, '2020-02-28 14:39:14'),
(3, 'others', 705, 5, 10, '2020-02-28 14:39:14'),
(4, 'italy', 655, 17, 45, '2020-02-28 14:39:14'),
(5, 'iran', 338, 34, 49, '2020-02-28 14:39:14'),
(6, 'japan', 228, 4, 22, '2020-02-28 14:39:14'),
(7, 'hong kong', 94, 2, 30, '2020-02-28 14:39:15'),
(8, 'singapore', 93, 0, 62, '2020-02-28 14:39:15'),
(9, 'us', 60, 0, 6, '2020-02-28 14:39:15'),
(10, 'germany', 48, 0, 16, '2020-02-28 14:39:15'),
(11, 'kuwait', 43, 0, 0, '2020-02-28 14:39:15'),
(12, 'thailand', 41, 0, 28, '2020-02-28 14:39:15'),
(13, 'france', 38, 2, 11, '2020-02-28 14:39:15'),
(14, 'taiwan', 34, 1, 6, '2020-02-28 14:39:15'),
(15, 'bahrain', 33, 0, 0, '2020-02-28 14:39:15'),
(16, 'spain', 25, 0, 2, '2020-02-28 14:39:15'),
(17, 'australia', 23, 0, 11, '2020-02-28 14:39:15'),
(18, 'malaysia', 23, 0, 18, '2020-02-28 14:39:15'),
(19, 'united arab emirates', 19, 0, 5, '2020-02-28 14:39:15'),
(20, 'vietnam', 16, 0, 16, '2020-02-28 14:39:16'),
(21, 'canada', 14, 0, 6, '2020-02-28 14:39:16'),
(22, 'macau', 10, 0, 8, '2020-02-28 14:39:16'),
(23, 'switzerland', 8, 0, 0, '2020-02-28 14:39:16'),
(24, 'sweden', 7, 0, 0, '2020-02-28 14:39:16'),
(25, 'iraq', 7, 0, 0, '2020-02-28 14:39:16'),
(26, 'oman', 4, 0, 0, '2020-02-28 14:39:16'),
(27, 'israel', 3, 0, 1, '2020-02-28 14:39:16'),
(28, 'philippines', 3, 1, 1, '2020-02-28 14:39:16'),
(29, 'croatia', 3, 0, 0, '2020-02-28 14:39:16'),
(30, 'india', 3, 0, 3, '2020-02-28 14:39:16'),
(31, 'austria', 3, 0, 0, '2020-02-28 14:39:16'),
(32, 'greece', 3, 0, 0, '2020-02-28 14:39:17'),
(33, 'lebanon', 2, 0, 0, '2020-02-28 14:39:17'),
(34, 'finland', 2, 0, 1, '2020-02-28 14:39:17'),
(35, 'russia', 2, 0, 2, '2020-02-28 14:39:17'),
(36, 'pakistan', 2, 0, 0, '2020-02-28 14:39:17'),
(37, 'afghanistan', 1, 0, 0, '2020-02-28 14:39:17'),
(38, 'nepal', 1, 0, 1, '2020-02-28 14:39:17'),
(39, 'lithuania', 1, 0, 0, '2020-02-28 14:39:17'),
(40, 'cambodia', 1, 0, 1, '2020-02-28 14:39:17'),
(41, 'georgia', 1, 0, 0, '2020-02-28 14:39:17'),
(42, 'north ireland', 1, 0, 0, '2020-02-28 14:39:17'),
(43, 'nigeria', 1, 0, 0, '2020-02-28 14:39:17'),
(44, 'norway', 1, 0, 0, '2020-02-28 14:39:17'),
(45, 'algeria', 1, 0, 0, '2020-02-28 14:39:17'),
(46, 'belgium', 1, 0, 1, '2020-02-28 14:39:17'),
(47, 'san marino', 1, 0, 0, '2020-02-28 14:39:18'),
(48, 'netherlands', 1, 0, 0, '2020-02-28 14:39:18'),
(49, 'denmark', 1, 0, 0, '2020-02-28 14:39:18'),
(50, 'north macedonia', 1, 0, 0, '2020-02-28 14:39:18'),
(51, 'belarus', 1, 0, 0, '2020-02-28 14:39:18'),
(52, 'new zealand', 1, 0, 0, '2020-02-28 14:39:18'),
(53, 'brazil', 1, 0, 0, '2020-02-28 14:39:18'),
(54, 'romania', 1, 0, 0, '2020-02-28 14:39:18'),
(55, 'estonia', 1, 0, 0, '2020-02-28 14:39:18'),
(56, 'egypt', 1, 0, 1, '2020-02-28 14:39:18'),
(57, 'sri lanka', 1, 0, 1, '2020-02-28 14:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` bigint(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `canView` bit(1) NOT NULL DEFAULT b'1',
  `canFilter` bit(1) NOT NULL DEFAULT b'1',
  `canSearch` bit(1) NOT NULL DEFAULT b'1',
  `getAccess` bit(1) NOT NULL DEFAULT b'0',
  `postAccess` bit(1) NOT NULL DEFAULT b'1',
  `tokenInHeader` bit(1) NOT NULL DEFAULT b'1',
  `canTotal` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token`, `datetime`, `canView`, `canFilter`, `canSearch`, `getAccess`, `postAccess`, `tokenInHeader`, `canTotal`) VALUES
(1, 'd4f5g6df4gd5f6ge4r89rf48', '2020-02-28 14:41:03', b'1', b'1', b'1', b'1', b'1', b'1', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
