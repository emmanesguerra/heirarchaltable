-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 05:54 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hierarchaltable`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) UNSIGNED NOT NULL,
  `lft` int(11) UNSIGNED NOT NULL,
  `rgt` int(11) UNSIGNED NOT NULL,
  `lvl` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `lft`, `rgt`, `lvl`, `name`) VALUES
(1, 1, 30, 1, 'Animals'),
(2, 2, 21, 2, 'Dogs'),
(5, 3, 10, 3, 'askal'),
(6, 4, 5, 4, 'askal 1'),
(7, 11, 20, 3, 'german sheperd'),
(8, 22, 29, 2, 'Cats'),
(9, 23, 28, 3, 'Siberian'),
(10, 6, 7, 4, 'askal 2'),
(11, 12, 17, 4, 'gs 1'),
(12, 13, 14, 5, 'gs 1.a'),
(13, 18, 19, 4, 'gs 2'),
(15, 31, 32, 1, 'Cars'),
(16, 24, 25, 4, 'Siberian 1'),
(17, 8, 9, 4, 'askal 3'),
(18, 15, 16, 5, 'gs 1.b'),
(19, 26, 27, 4, 'siberian 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
