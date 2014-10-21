-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2014 at 07:53 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dotaezbe_ezbets`
--
CREATE DATABASE IF NOT EXISTS `dotaezbe_ezbets` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dotaezbe_ezbets`;

-- --------------------------------------------------------

--
-- Table structure for table `bets`
--

CREATE TABLE IF NOT EXISTS `bets` (
  `userid` int(11) NOT NULL,
  `matchid` int(11) NOT NULL,
  `betteamid` int(11) NOT NULL,
  `betamt` decimal(11,2) NOT NULL,
  `net_change` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`userid`,`matchid`,`betteamid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bets`
--

INSERT INTO `bets` (`userid`, `matchid`, `betteamid`, `betamt`, `net_change`) VALUES
(0, 0, 0, '0.00', '5.00'),
(0, 3, 1, '2.00', NULL),
(123, 2, 1, '1.00', '4.95'),
(123, 3, 1, '1.00', '5.00'),
(123, 4, 1, '1.00', '5.00'),
(123, 5, 1, '1.00', '5.00'),
(123, 6, 1, '1.00', '5.00'),
(123, 7, 1, '1.00', '5.00'),
(124, 2, 2, '5.00', '-5.00');

-- --------------------------------------------------------

--
-- Table structure for table `matchs`
--

CREATE TABLE IF NOT EXISTS `matchs` (
  `matchid` int(6) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `tourneyname` varchar(30) DEFAULT NULL,
  `bo` int(2) DEFAULT NULL,
  `teamid1` int(2) DEFAULT NULL,
  `teamid2` int(2) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `result` int(2) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  PRIMARY KEY (`matchid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `matchs`
--

INSERT INTO `matchs` (`matchid`, `description`, `tourneyname`, `bo`, `teamid1`, `teamid2`, `time_start`, `status`, `result`, `type`) VALUES
(1, 'hgh', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0),
(2, NULL, 'esl', 3, 12, 13, '0000-00-00 00:00:00', 1, NULL, NULL),
(3, NULL, NULL, 4, 5, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `teamid` int(5) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(30) NOT NULL,
  `photourl` varchar(100) NOT NULL,
  PRIMARY KEY (`teamid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`teamid`, `teamname`, `photourl`) VALUES
(12, '3', 'hgh'),
(13, 'navi', 'dfcgvhnjm,./'),
(14, 'secret', 'dfcghjmkl;,''.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `currency_total` decimal(10,2) NOT NULL,
  `currency_current` decimal(10,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `currency_total`, `currency_current`) VALUES
('123', 'dsfds', '4.00', '29.85'),
('124', 'sads', '100.00', '100.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
