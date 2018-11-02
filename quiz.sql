-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 02, 2018 at 12:42 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `answer_name` text NOT NULL,
  `correct_answer` tinyint(1) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `quest_id`, `answer_name`, `correct_answer`) VALUES
(1, 1, 'Pa labo ceļa pusi', 1),
(2, 1, 'Pa kreiso ceļa pusi', 0),
(3, 1, 'Pa vidu brauktuvei', 0),
(4, 1, 'Nav nozīmes', 0),
(5, 2, 'Labajā', 0),
(6, 2, 'Kreisajā', 1),
(7, 3, 'Atļauts', 0),
(8, 3, 'Aizliegts', 1),
(9, 4, 'Dzeltenā', 1),
(10, 4, 'Zaļā', 0),
(11, 4, 'Zilā', 0),
(12, 4, 'Rozā', 0),
(13, 5, '5', 0),
(14, 5, '195', 0),
(15, 5, '1079', 0),
(16, 5, '807', 0),
(17, 6, 'Jā', 1),
(18, 6, 'Nē', 0),
(19, 7, '1', 0),
(20, 7, '2', 1),
(21, 7, '3', 0),
(22, 7, '4', 0),
(23, 7, '5', 0),
(24, 7, '6', 0),
(25, 8, '1', 0),
(29, 8, '2', 0),
(30, 8, '3', 0),
(31, 8, '4', 1),
(32, 9, 'Lietvārdi', 0),
(33, 9, 'Darbības vārds', 1),
(34, 9, 'Īpasības vārdi', 0),
(35, 9, 'Vietniekvārds', 0),
(36, 9, 'Apstākļa vārds', 0),
(37, 9, 'Skaitļa vārds', 0),
(38, 9, 'Apstākļa vārds', 0);

-- --------------------------------------------------------

--
-- Table structure for table `finished_tests`
--

DROP TABLE IF EXISTS `finished_tests`;
CREATE TABLE IF NOT EXISTS `finished_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `total_quest_num` int(11) NOT NULL,
  `correct_quest_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `finished_tests`
--

INSERT INTO `finished_tests` (`id`, `user_id`, `test_id`, `total_quest_num`, `correct_quest_num`) VALUES
(1, 1, 1, 3, 2),
(2, 2, 2, 3, 1),
(3, 3, 3, 3, 0),
(4, 4, 1, 3, 1),
(5, 5, 2, 3, 1),
(6, 6, 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `quest_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `quest_num` int(11) DEFAULT NULL,
  `quest_name` text NOT NULL,
  PRIMARY KEY (`quest_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`quest_id`, `test_id`, `quest_num`, `quest_name`) VALUES
(1, 1, 1, 'Pa kuru ceļa pusi jāpārvietojas automobīlim?'),
(2, 1, 2, 'Kurā pusē mašīnai ir stūre?'),
(3, 1, 3, 'Vai drīks vadīt transporta līdzekli alkohola ietekmē?'),
(4, 2, 1, 'Kādā krāsā ir pikačū?'),
(5, 2, 2, 'Cik pavisam daudz ir dažādu pokemonu?'),
(6, 2, 3, 'Vai Tev patīk pokemoni?'),
(7, 3, 1, 'Cik dzimtes ir Latviašu valodā?'),
(8, 3, 2, 'Cik daudz ir deklināciju locījumi?'),
(9, 3, 3, 'Kurā no vārdšķirām tiek izmantotas konjugācijas?');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` text NOT NULL,
  PRIMARY KEY (`test_id`),
  UNIQUE KEY `test_name` (`test_name`(100))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `test_name`) VALUES
(1, 'CSDD tests'),
(2, 'Pokemonu tests'),
(3, 'Gramatikas tests');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`) VALUES
(1, 'Austris'),
(2, 'Baiba'),
(3, 'Jānis'),
(4, 'Juris'),
(5, 'Bērziņš'),
(6, 'Haralds');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

DROP TABLE IF EXISTS `user_answers`;
CREATE TABLE IF NOT EXISTS `user_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_id`, `test_id`, `quest_id`, `answer_id`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 1, 2, 6),
(3, 1, 1, 3, 7),
(4, 2, 2, 4, 11),
(5, 2, 2, 5, 14),
(6, 2, 2, 6, 17),
(7, 3, 3, 7, 19),
(8, 3, 3, 8, 25),
(9, 3, 3, 9, 32),
(10, 4, 1, 1, 1),
(11, 4, 1, 2, 5),
(12, 4, 1, 3, 7),
(13, 5, 2, 4, 9),
(14, 5, 2, 5, 15),
(15, 5, 2, 6, 18),
(16, 6, 3, 7, 19),
(17, 6, 3, 8, 25),
(18, 6, 3, 9, 32);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
