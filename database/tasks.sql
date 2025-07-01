-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 01, 2025 at 06:10 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_password` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(11, 'Hashem', 'Hashem@gmail.com', '202cb962ac59075b964b07152d234b70'),
(23, 'hlco', 'hlco@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `user_tasks`
--

DROP TABLE IF EXISTS `user_tasks`;
CREATE TABLE IF NOT EXISTS `user_tasks` (
  `user_id` int NOT NULL,
  `task_id` int NOT NULL AUTO_INCREMENT,
  `task_title` text COLLATE utf8mb4_general_ci NOT NULL,
  `task_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `task_done` tinyint(1) NOT NULL,
  `task_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `task_space` datetime NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
