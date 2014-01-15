-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2014 at 03:28 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpex`
--

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE IF NOT EXISTS `buses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_route` varchar(1) NOT NULL,
  `stop_id` int(11) DEFAULT NULL,
  `stop_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stop_id` (`stop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_route`, `stop_id`, `stop_time`) VALUES
(1, 'A', 1, '00:00:00'),
(2, 'B', 2, '00:00:00'),
(3, 'C', 2, '23:50:00'),
(4, 'A', 1, '10:40:00'),
(5, 'A', 3, '13:50:00'),
(6, 'A', 4, '19:05:00'),
(7, 'B', 5, '09:20:00'),
(8, 'B', 6, '11:35:00'),
(9, 'C', 3, '09:05:00'),
(10, 'A', NULL, '10:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `stops`
--

CREATE TABLE IF NOT EXISTS `stops` (
  `stop_id` int(11) NOT NULL AUTO_INCREMENT,
  `stop_name` varchar(64) NOT NULL,
  PRIMARY KEY (`stop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `stops`
--

INSERT INTO `stops` (`stop_id`, `stop_name`) VALUES
(1, 'Mushroom Kingdom'),
(2, 'Zebes'),
(3, 'Hyrule'),
(4, 'Dreamland'),
(5, 'Kanto'),
(6, 'Johto');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buses`
--
ALTER TABLE `buses`
  ADD CONSTRAINT `buses_ibfk_1` FOREIGN KEY (`stop_id`) REFERENCES `stops` (`stop_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
