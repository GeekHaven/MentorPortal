-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2018 at 09:43 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mentorPortal`
--

-- --------------------------------------------------------

--
-- Table structure for table `google_users`
--

CREATE TABLE `google_users` (
  `google_id` varchar(100) NOT NULL,
  `google_name` varchar(100) NOT NULL,
  `google_email` varchar(100) NOT NULL,
  `google_link` varchar(100) NOT NULL,
  `google_picture_link` varchar(100) NOT NULL,
  `mentor_name` varchar(100) NOT NULL,
  `selected` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `google_users`
--

INSERT INTO `google_users` (`google_id`, `google_name`, `google_email`, `google_link`, `google_picture_link`, `mentor_name`, `selected`, `timestamp`) VALUES
('108952895078598507658', 'Shreyansh Dwivedi', 'IWM2016501@iiita.ac.in', 'https://plus.google.com/108952895078598507658', 'https://lh4.googleusercontent.com/-DfA8CSRz3Vc/AAAAAAAAAAI/AAAAAAAAAAA/AKxrwcZ7db4ZEIsTAZygMeXZWdaPu', '', 0, '2018-12-26 13:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `google_users_mentors`
--

CREATE TABLE `google_users_mentors` (
  `google_id` varchar(100) NOT NULL,
  `google_name` varchar(100) NOT NULL,
  `google_email` varchar(100) NOT NULL,
  `google_link` varchar(100) NOT NULL,
  `google_picture_link` varchar(100) NOT NULL,
  `max_count` int(11) NOT NULL,
  `full` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `google_users`
--
ALTER TABLE `google_users`
  ADD PRIMARY KEY (`google_id`);

--
-- Indexes for table `google_users_mentors`
--
ALTER TABLE `google_users_mentors`
  ADD PRIMARY KEY (`google_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
