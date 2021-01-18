-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2021 at 02:51 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `postID` int(11) NOT NULL,
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `commentDesc` varchar(500) NOT NULL,
  `commentAuthor` varchar(500) NOT NULL,
  `commentTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `commentID` (`commentID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`postID`, `commentID`, `commentDesc`, `commentAuthor`, `commentTime`) VALUES
(2, 3, 'yuppy', 'qt', '2015-08-22 10:36:50'),
(2, 4, 'nice :-)', 'qt', '2015-08-22 10:36:59'),
(2, 5, 'nice op you are great !!', 'qt', '2015-08-22 10:37:21'),
(6, 7, 'nice :P', 'qt', '2015-08-22 10:41:19'),
(6, 8, 'cuteee :P', 'qt', '2015-08-22 10:55:13'),
(6, 9, 'Very good line The college has well-established Central Learning resource centers like Central library, Central Computer Centre, Entrepreneurship Development Cell, Continuing Education Centre and Physical Education Section. The college also has a very active Training & Placement section. ', 'qt', '2015-08-22 11:05:11'),
(6, 10, 'My comment', 'qt', '2015-08-22 11:14:45'),
(6, 11, '          Really appriciable _/\\_', 'rtkasodariya', '2015-08-22 11:17:38'),
(0, 12, 'dklvn', 'qt', '2015-08-22 11:34:42'),
(6, 13, '          test comment', 'rtkasodariya', '2015-08-23 06:10:05'),
(6, 14, '          opps', 'rtkasodariya', '2015-08-23 14:30:09'),
(6, 15, '          I am witness', 'qt', '2015-08-30 11:36:24'),
(7, 16, '    Thanks', 'qt', '2015-09-02 06:00:32'),
(7, 17, '          Nice Explanation :-)', 'rtkasodariya', '2015-09-02 06:01:13'),
(2, 18, '          Very well... Good start..', 'rtkasodariya', '2015-09-02 06:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `rating` double NOT NULL DEFAULT '0',
  `datePosted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `postTag` varchar(40) DEFAULT NULL,
  `userID` varchar(40) NOT NULL,
  PRIMARY KEY (`postID`),
  UNIQUE KEY `postTitle` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `title`, `content`, `rating`, `datePosted`, `postTag`, `userID`) VALUES
(32, 'Bees', 'The bees decided to have a mutiny against their queen.', 13, '2020-12-24 11:34:45', NULL, '11'),
(34, 'Directions', 'Giving directions that the mountains are to the west only works when you can see them.', 3, '2020-12-24 11:34:39', NULL, '11'),
(35, 'Dark', 'It was getting dark, and we weren’t there yet.', 4, '2020-12-24 11:31:34', NULL, '11'),
(39, 'South Pine', 'The shark-infested South Pine channel was the only way in or out.', 0, '2020-12-23 19:09:17', NULL, '10'),
(40, 'Pie', 'Tom got a small piece of pie.', 0, '2020-12-23 12:54:18', NULL, '10'),
(41, 'Crime', 'The secret ingredient to his wonderful life was crime.', 4, '2020-12-24 11:36:03', NULL, '14'),
(48, 'test', 'test', 0, '2020-12-23 15:15:12', NULL, '13'),
(66, 'Walk', 'He set out for a short walk, but now all he could see were mangroves and water were for miles.\r\n\r\n', 0, '2020-12-23 15:39:53', NULL, '10'),
(70, 'Money$', 'Do you think you\'re living an ordinary life? You are so mistaken it\'s difficult to even explain. The mere fact that you exist makes you extraordinary. The odds of you existing are less than winning the lottery, but here you are. Are you going to let this extraordinary opportunity pass?\r\n\r\nShe\'s asked the question so many times that she barely listened to the answers anymore. The answers were always the same. Well, not exactly the same, but the same in a general sense. A more accurate description was the answers never surprised her. So, she asked for the 10,000th time, &quot;What\'s your favorite animal?&quot; But this time was different. When she heard the young boy\'s answer, she wondered if she had heard him correctly.\r\n\r\nHe sat across from her trying to imagine it was the first time. It wasn\'t. Had it been a hundred? It quite possibly could have been. Two hundred? Probably not. His mind wandered until he caught himself and again tried to imagine it was the first time.', 0, '2020-12-24 11:06:32', NULL, '10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastName` varchar(45) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `firstName`, `password`, `email`, `createdon`, `lastName`) VALUES
(10, 'janje12', 'Nikola', 'nikjan00', 'serbiansolutions@gmail.com', '2020-12-21 19:32:19', 'Jankovic'),
(11, 'test', 'test', 'nikjan00', 'janje12@gmail.com', '2020-12-22 14:15:57', 'test'),
(13, 'Dragon', 'Darko', 'nikjan00', 'daki@gmail.com', '2020-12-23 12:56:53', 'Nikolic'),
(14, 'ivanica', 'Ivan', 'nikjan00', 'ivan@gmail.com', '2020-12-23 13:03:40', 'Ivanovic');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
