-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2021 at 05:25 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arria`
--

-- --------------------------------------------------------

--
-- Table structure for table `kepuasan_konsumen`
--

CREATE TABLE `kepuasan_konsumen` (
  `id` int(11) NOT NULL,
  `tangible` float NOT NULL,
  `empathy` float NOT NULL,
  `responsiveness` float NOT NULL,
  `assurance` float NOT NULL,
  `reliability` float NOT NULL,
  `hasil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kepuasan_konsumen`
--

INSERT INTO `kepuasan_konsumen` (`id`, `tangible`, `empathy`, `responsiveness`, `assurance`, `reliability`, `hasil`) VALUES
(1, 4.6, 4.7, 4.3, 4.7, 4.7, 'puas'),
(2, 4.6, 5, 5, 5, 5, 'puas'),
(3, 3.8, 5, 5, 5, 5, 'puas'),
(4, 4.6, 4.7, 5, 4.3, 5, 'puas'),
(5, 5, 5, 5, 5, 2.7, 'puas'),
(6, 3, 4.3, 5, 3, 5, 'puas'),
(7, 4.4, 4.7, 4.7, 5, 4.7, 'puas'),
(8, 4.2, 2.7, 3.3, 3, 4, 'tidak'),
(9, 4.6, 5, 5, 5, 5, 'puas'),
(10, 5, 3.3, 5, 3, 3, 'puas'),
(11, 3.4, 5, 5, 5, 5, 'puas'),
(12, 4.8, 4.7, 5, 5, 5, 'puas'),
(13, 4.8, 4.7, 5, 5, 5, 'puas'),
(14, 3.4, 4, 4, 4, 4, 'puas'),
(15, 3.6, 5, 5, 5, 5, 'puas'),
(16, 5, 5, 5, 5, 5, 'puas'),
(17, 3.8, 4, 4, 4, 4, 'puas'),
(18, 3.6, 4, 4, 4.3, 4, 'puas'),
(19, 4.2, 5, 5, 5, 5, 'puas'),
(20, 4.6, 5, 5, 5, 5, 'puas'),
(21, 4.8, 5, 3, 5, 5, 'puas'),
(22, 4.2, 3, 5, 5, 3, 'puas'),
(23, 5, 3, 5, 5, 2.7, 'puas'),
(24, 4.8, 5, 5, 5, 5, 'puas'),
(25, 5, 4.3, 5, 5, 5, 'puas'),
(26, 5, 3.7, 5, 4.7, 4.7, 'puas'),
(27, 3.4, 5, 5, 5, 5, 'puas'),
(28, 5, 4.3, 5, 5, 5, 'puas'),
(29, 4.8, 3.7, 5, 5, 5, 'puas'),
(30, 4.4, 3, 2.7, 4, 3.7, 'tidak'),
(31, 4.8, 4.7, 5, 5, 5, 'puas'),
(32, 5, 4.7, 5, 5, 5, 'puas'),
(33, 5, 4.3, 5, 4.7, 5, 'puas'),
(34, 4.4, 5, 4.7, 5, 5, 'puas'),
(35, 4.6, 4.7, 4.7, 5, 5, 'puas'),
(36, 5, 5, 5, 2.7, 5, 'puas'),
(37, 4.8, 4.7, 5, 5, 5, 'puas'),
(38, 3.8, 5, 4.7, 5, 5, 'puas'),
(39, 4.6, 4.3, 4.7, 4.7, 5, 'puas'),
(40, 4.4, 4.3, 4.3, 4.3, 5, 'puas'),
(41, 4.2, 4.7, 4.7, 4.3, 5, 'puas'),
(42, 4.2, 4.3, 4.3, 4.3, 5, 'puas'),
(43, 4.6, 4.3, 4, 4.3, 5, 'puas'),
(44, 3.8, 3, 2.7, 3, 2.3, 'tidak'),
(45, 4.8, 4.7, 4.7, 4.3, 4.7, 'puas'),
(46, 4.8, 4.7, 4.7, 4.3, 4.7, 'puas'),
(47, 5, 4, 4.7, 4.7, 5, 'puas'),
(48, 4, 3, 5, 4.3, 5, 'puas'),
(49, 4.8, 4.7, 4.7, 4.3, 4.7, 'puas'),
(50, 4.8, 5, 5, 5, 5, 'puas'),
(51, 4.8, 4.7, 4.7, 4.3, 4.7, 'puas'),
(52, 5, 5, 5, 5, 3, 'puas'),
(53, 4.4, 4, 4.3, 3, 4, 'puas'),
(54, 5, 5, 5, 5, 5, 'puas'),
(55, 3.6, 3, 2.7, 3, 3.3, 'tidak'),
(56, 4, 5, 5, 4.3, 5, 'puas'),
(57, 4.2, 4, 4, 4.3, 4.7, 'puas'),
(58, 4.6, 3.3, 4, 4, 4, 'puas'),
(59, 4, 4, 4, 4, 4, 'puas'),
(60, 4.4, 4, 4, 4, 4, 'puas'),
(61, 3.4, 3, 3, 3, 2.7, 'tidak'),
(62, 4.4, 4.7, 5, 5, 5, 'puas'),
(63, 4.4, 5, 5, 5, 5, 'puas'),
(64, 3.6, 4, 4, 4, 4, 'puas'),
(65, 4.6, 5, 5, 5, 5, 'puas'),
(66, 3.6, 3.3, 4, 4, 4, 'puas'),
(67, 3.8, 3.7, 3.7, 3, 4, 'puas'),
(68, 4, 4, 4, 3, 4, 'puas'),
(69, 4.4, 4, 4.3, 4, 4, 'puas'),
(70, 4, 4, 3.7, 3.7, 4, 'puas'),
(71, 4.8, 5, 5, 5, 5, 'puas'),
(72, 3.6, 3.3, 4, 4, 4, 'puas'),
(73, 4, 4, 4, 4, 4.3, 'puas'),
(74, 3.8, 4, 4, 4, 4, 'puas'),
(75, 4.2, 4.3, 4.3, 4.3, 4.3, 'puas'),
(76, 4.2, 4, 4.3, 4, 4.3, 'puas'),
(77, 4.2, 4.3, 4.3, 4, 4.3, 'puas'),
(78, 4, 5, 4, 4, 4.7, 'puas'),
(79, 4, 4.3, 4, 4, 4.3, 'puas'),
(80, 2.8, 2.7, 2.3, 3, 4, 'tidak'),
(81, 4, 4.3, 4, 4, 4.3, 'puas'),
(82, 4.2, 4.7, 4.3, 4, 4.3, 'puas'),
(83, 4, 4.3, 4.3, 4, 4.3, 'puas'),
(84, 4.2, 4.3, 4.3, 4, 4, 'puas'),
(85, 4, 5, 4, 4.7, 4.7, 'puas'),
(86, 4.2, 4.7, 5, 4, 5, 'puas'),
(87, 4.6, 5, 5, 5, 4.7, 'puas'),
(88, 4.6, 5, 5, 5, 5, 'puas'),
(89, 4.4, 4, 3.7, 5, 4.3, 'puas'),
(90, 4.4, 4.7, 4.3, 4, 5, 'puas'),
(91, 4.2, 4.7, 4.7, 4.7, 4.7, 'puas'),
(92, 4.4, 4.7, 4.7, 4.7, 4.3, 'puas'),
(93, 3.6, 4.3, 4, 4, 4, 'puas'),
(94, 4, 4, 4.3, 4.3, 4, 'puas'),
(95, 4.2, 4, 4.3, 4, 4, 'puas'),
(96, 4, 4, 4.3, 4, 4.3, 'puas'),
(97, 4.2, 4.3, 4, 4.7, 3.7, 'puas'),
(98, 4.2, 4, 4.3, 4, 4, 'puas'),
(99, 4, 4.3, 4.3, 4, 4.3, 'puas'),
(100, 4, 4, 4, 3, 4, 'puas'),
(101, 4.2, 4, 4, 4, 4.3, 'puas'),
(102, 4, 4.3, 4.3, 4.3, 4.3, 'puas'),
(103, 3.4, 4.3, 4.3, 4, 4.3, 'puas'),
(104, 3.6, 4, 4, 4.3, 4, 'puas'),
(105, 4, 4.3, 4, 4, 4, 'puas'),
(106, 3.8, 4, 4.3, 4, 4, 'puas'),
(107, 3.8, 4.3, 4.3, 5, 4.3, 'puas'),
(108, 5, 5, 5, 3, 5, 'puas'),
(109, 4.2, 4.7, 5, 5, 5, 'puas'),
(110, 3.2, 2.7, 3, 2.7, 3, 'tidak'),
(111, 4.6, 4.7, 4, 4.3, 4.7, 'puas'),
(112, 3.8, 4.3, 4.3, 4.7, 5, 'puas'),
(113, 4.2, 4.3, 4.3, 5, 5, 'puas'),
(114, 4.2, 4.3, 4.7, 4.7, 5, 'puas'),
(115, 2.8, 2.3, 3, 3, 2.7, 'tidak'),
(116, 3.6, 4, 4, 4.3, 4.3, 'puas'),
(117, 4, 4, 4.7, 4.3, 4.7, 'puas'),
(118, 5, 5, 5, 5, 5, 'puas'),
(119, 4, 4, 4, 4, 4, 'puas'),
(120, 4.4, 5, 5, 5, 5, 'puas'),
(121, 5, 5, 5, 5, 5, 'puas'),
(122, 4.8, 5, 5, 5, 5, 'puas'),
(123, 4, 4.3, 3.7, 4.3, 4.3, 'puas'),
(124, 4, 4, 4, 4, 4, 'puas'),
(125, 3.8, 4, 4, 4, 4, 'puas'),
(126, 4.8, 4.3, 4.3, 4, 4, 'puas'),
(127, 3.6, 4.3, 4, 4, 4, 'puas'),
(128, 4, 4.7, 4.3, 4, 4.7, 'puas'),
(129, 3.4, 4.3, 4.3, 4.3, 4.3, 'puas'),
(130, 3.8, 4.3, 4.3, 4, 4.3, 'puas'),
(131, 3.6, 4, 3.7, 4, 3.7, 'puas'),
(132, 4.2, 4, 4, 4.3, 4.3, 'puas'),
(133, 4.2, 4, 4, 4, 4, 'puas'),
(134, 4.2, 4.7, 4.3, 4, 4.3, 'puas'),
(135, 4, 3.7, 4.3, 3.3, 4.7, 'puas'),
(136, 4.4, 4, 4, 4, 3.7, 'puas'),
(137, 4.2, 4.3, 4.3, 3.3, 4.3, 'puas'),
(138, 4, 4.3, 4.3, 4, 4.3, 'puas'),
(139, 4.2, 4.3, 4.3, 3.7, 4, 'puas'),
(140, 3.6, 4.3, 4.3, 3.7, 5, 'puas'),
(141, 4, 4.3, 4, 3.7, 4.3, 'puas'),
(142, 4.2, 4.3, 4, 4, 4.3, 'puas'),
(143, 4, 4.3, 4.3, 4.3, 4.3, 'puas'),
(144, 4.2, 4.3, 4.3, 4, 4.3, 'puas'),
(145, 4, 4.3, 4, 4.3, 4.3, 'puas'),
(146, 3.4, 4.3, 4.3, 4, 4, 'puas'),
(147, 4, 4.3, 4, 4, 4.3, 'puas'),
(148, 4, 4.3, 4.3, 4.3, 4.3, 'puas'),
(149, 3.6, 4.3, 4.3, 4, 4.3, 'puas'),
(150, 4, 4.3, 4.3, 4.3, 4.7, 'puas'),
(151, 4.2, 3.3, 4, 4.3, 4.3, 'puas'),
(152, 4, 5, 4.3, 4, 4.7, 'puas'),
(153, 4.2, 4.3, 4.3, 4, 4.7, 'puas'),
(154, 3.4, 2.3, 3, 3, 3, 'tidak'),
(155, 2.8, 4, 3.3, 3.7, 3.7, 'tidak'),
(156, 4.4, 4, 5, 4, 5, 'puas'),
(157, 5, 5, 4.3, 5, 5, 'puas'),
(158, 4.6, 5, 4.7, 4.7, 5, 'puas'),
(159, 4.2, 4.3, 3.7, 5, 4, 'puas'),
(160, 4.2, 4.3, 4.7, 5, 4, 'puas'),
(161, 4.8, 5, 5, 4.7, 4.7, 'puas'),
(162, 4.8, 4.7, 5, 4, 5, 'puas'),
(163, 4, 5, 4, 4.3, 4.3, 'puas'),
(164, 5, 5, 5, 5, 3, 'puas'),
(165, 4.8, 5, 5, 3, 5, 'puas'),
(166, 4.8, 4.7, 5, 5, 5, 'puas'),
(167, 4.4, 4.3, 4.7, 4.3, 4.3, 'puas'),
(168, 4.8, 5, 5, 5, 5, 'puas'),
(169, 4.2, 4.7, 4.3, 5, 5, 'puas'),
(170, 4.6, 5, 4.7, 5, 5, 'puas'),
(171, 4.6, 4.3, 4.3, 5, 5, 'puas'),
(172, 4.8, 4.7, 4.7, 5, 5, 'puas'),
(173, 4.6, 4.7, 5, 4.3, 4, 'puas'),
(174, 4, 4, 4, 4, 4.3, 'puas'),
(175, 4.8, 4.7, 5, 5, 5, 'puas'),
(176, 5, 5, 5, 5, 5, 'puas'),
(177, 4.8, 5, 3.3, 2.7, 3, 'puas'),
(178, 4.6, 4.7, 5, 5, 5, 'puas'),
(179, 5, 5, 5, 5, 5, 'puas'),
(180, 4.4, 4.3, 3.7, 5, 4.3, 'puas'),
(181, 5, 5, 5, 5, 5, 'puas'),
(182, 4, 4, 4, 4, 4, 'puas'),
(183, 4.6, 4.3, 4.3, 4, 4.3, 'puas'),
(184, 4.8, 4.7, 4.7, 4.7, 5, 'puas'),
(185, 5, 4.7, 5, 5, 4.7, 'puas'),
(186, 4.6, 4.7, 4.3, 5, 5, 'puas'),
(187, 4.8, 3.7, 4.3, 3, 5, 'puas'),
(188, 4.6, 5, 5, 5, 5, 'puas'),
(189, 4.4, 4.7, 4.3, 4.7, 4.7, 'puas'),
(190, 4.8, 5, 5, 5, 5, 'puas'),
(191, 4.2, 4, 4.3, 4.3, 4, 'puas'),
(192, 4.8, 5, 5, 5, 5, 'puas');

-- --------------------------------------------------------

--
-- Table structure for table `manual`
--

CREATE TABLE `manual` (
  `id` int(11) NOT NULL,
  `tangible` float NOT NULL,
  `empathy` float NOT NULL,
  `responsiveness` float NOT NULL,
  `assurance` float NOT NULL,
  `reliability` float NOT NULL,
  `hasil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manual`
--

INSERT INTO `manual` (`id`, `tangible`, `empathy`, `responsiveness`, `assurance`, `reliability`, `hasil`) VALUES
(1, 4.6, 4.7, 4.3, 4.7, 4.7, 'puas'),
(2, 4.6, 5, 5, 5, 5, 'puas'),
(3, 3.8, 5, 5, 5, 5, 'puas'),
(4, 4.2, 2.7, 3.3, 3, 4, 'tidak'),
(5, 3.8, 4, 4, 4, 4, 'puas'),
(6, 3.6, 4, 4, 4.3, 4, 'puas'),
(7, 4.4, 3, 2.7, 4, 3.7, 'tidak'),
(8, 3.8, 3, 2.7, 3, 2.3, 'tidak'),
(9, 4.4, 4.7, 4.3, 4, 5, 'puas'),
(10, 4.2, 4.7, 4.7, 4.7, 4.7, 'puas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kepuasan_konsumen`
--
ALTER TABLE `kepuasan_konsumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual`
--
ALTER TABLE `manual`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kepuasan_konsumen`
--
ALTER TABLE `kepuasan_konsumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `manual`
--
ALTER TABLE `manual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
