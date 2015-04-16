-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2015 at 10:39 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `woms_db`
--
DROP DATABASE IF EXISTS `woms_db`;
CREATE DATABASE IF NOT EXISTS `woms_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `woms_db`;

-- --------------------------------------------------------

--
-- Table structure for table `authority`
--

DROP TABLE IF EXISTS `authority`;
CREATE TABLE IF NOT EXISTS `authority` (
  `authority_code` int(3) NOT NULL,
  `authority_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authority`
--

INSERT INTO `authority` (`authority_code`, `authority_description`) VALUES
(1, 'Administrator'),
(2, 'Support Staff'),
(3, 'Regular User');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(3) NOT NULL,
  `department_id` int(3) NOT NULL,
  `category_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `department_id`, `category_description`) VALUES
(1, 1, 'Internet Outage'),
(2, 1, 'Hardware Issue'),
(3, 1, 'Performance Issue'),
(4, 2, 'Heating Issue'),
(5, 2, 'Lighting Issue'),
(6, 2, 'Spill'),
(7, 3, 'Event Request'),
(8, 3, 'Announcement Request'),
(9, 3, 'Financial Question');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
`comment_id` int(7) NOT NULL,
  `comment_message` varchar(1000) NOT NULL,
  `comment_datetime` datetime NOT NULL,
  `ticket_number` int(11) NOT NULL,
  `user_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(3) NOT NULL,
  `department_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_description`) VALUES
(1, 'Computer Services'),
(2, 'Facilities'),
(3, 'Student Services');

-- --------------------------------------------------------

--
-- Table structure for table `knowledgebase`
--

DROP TABLE IF EXISTS `knowledgebase`;
CREATE TABLE IF NOT EXISTS `knowledgebase` (
  `ticket_number` int(9) NOT NULL,
  `category_id` int(3) NOT NULL,
  `search_term_id` int(5) NOT NULL,
  `knowledge_base_issue` varchar(1000) NOT NULL,
  `knowledge_base_solution` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `searchterm`
--

DROP TABLE IF EXISTS `searchterm`;
CREATE TABLE IF NOT EXISTS `searchterm` (
  `search_term_id` int(5) NOT NULL,
  `search_term_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supportstaff`
--

DROP TABLE IF EXISTS `supportstaff`;
CREATE TABLE IF NOT EXISTS `supportstaff` (
  `user_number` int(7) NOT NULL,
  `department_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
`ticket_number` int(9) NOT NULL,
  `department_id` int(3) NOT NULL,
  `category_id` int(3) NOT NULL,
  `ticket_status_code` int(2) NOT NULL,
  `ticket_priority_code` int(7) NOT NULL,
  `ticket_open_date_time` datetime NOT NULL,
  `ticket_close_date_time` datetime DEFAULT '0000-00-00 00:00:00',
  `ticket_room` varchar(20) NOT NULL,
  `ticket_message` varchar(255) NOT NULL,
  `user_number` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_number`, `department_id`, `category_id`, `ticket_status_code`, `ticket_priority_code`, `ticket_open_date_time`, `ticket_close_date_time`, `ticket_room`, `ticket_message`, `user_number`) VALUES
(1, 1, 1, 1, 1, '2015-02-17 20:30:11', '0000-00-00 00:00:00', '21 c', 'This is the first ticket message.  The error is that the crap you built sucks.  I am tired of this crap, fix it now.', 2),
(2, 2, 4, 1, 0, '2015-02-17 20:30:54', '0000-00-00 00:00:00', '222', 'The room is one fire.  Is this something you guys deal with?', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ticketstatus`
--

DROP TABLE IF EXISTS `ticketstatus`;
CREATE TABLE IF NOT EXISTS `ticketstatus` (
  `ticket_status_code` int(2) NOT NULL,
  `ticket_status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticketstatus`
--

INSERT INTO `ticketstatus` (`ticket_status_code`, `ticket_status_description`) VALUES
(0, 'Closed'),
(1, 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`user_number` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_last_name` varchar(24) NOT NULL,
  `user_first_name` varchar(24) NOT NULL,
  `authority_code` int(3) NOT NULL DEFAULT '3',
  `user_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_number`, `user_email`, `user_password`, `user_last_name`, `user_first_name`, `authority_code`, `user_status`) VALUES
(1, 'admin@woms.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Myers', 'Logan', 1, 1),
(2, 'andrew@woms.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Fesser', 'Andrew', 3, 1),
(3, 'mike@woms.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Reid', 'Mike', 2, 1),
(4, 'guest@facebook.guest', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'Guest', 'Facebook', 3, 1);

INSERT INTO `supportstaff` (`user_number`, `department_id`) VALUES
(3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authority`
--
ALTER TABLE `authority`
 ADD PRIMARY KEY (`authority_code`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `knowledgebase`
--
ALTER TABLE `knowledgebase`
 ADD PRIMARY KEY (`ticket_number`);

--
-- Indexes for table `searchterm`
--
ALTER TABLE `searchterm`
 ADD PRIMARY KEY (`search_term_id`);

--
-- Indexes for table `supportstaff`
--
ALTER TABLE `supportstaff`
 ADD PRIMARY KEY (`user_number`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
 ADD PRIMARY KEY (`ticket_number`);

--
-- Indexes for table `ticketstatus`
--
ALTER TABLE `ticketstatus`
 ADD PRIMARY KEY (`ticket_status_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_number`), ADD UNIQUE KEY `Email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `comment_id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
MODIFY `ticket_number` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_number` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--
-- CREATE the db user
--
GRANT USAGE ON *.* TO womsAdmin@localhost IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON woms_db.* TO womsAdmin@localhost;
FLUSH PRIVILEGES;
