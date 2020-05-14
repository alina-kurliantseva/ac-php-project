-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2019 at 09:14 PM
-- Server version: 5.6.35
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pictures_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accessibility`
--

CREATE TABLE IF NOT EXISTS `Accessibility` (
  `accessibility_code` varchar(16) NOT NULL,
  `description` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Accessibility`
--

INSERT INTO `Accessibility` (`accessibility_code`, `description`) VALUES
('private', 'accessible only by the owner'),
('shared', 'accessible by the owner and friends');

-- --------------------------------------------------------

--
-- Table structure for table `Album`
--

CREATE TABLE IF NOT EXISTS `Album` (
  `album_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(3000) DEFAULT NULL,
  `date_updated` date NOT NULL,
  `owner_id` varchar(16) NOT NULL,
  `accessibility_code` varchar(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Album`
--

INSERT INTO `Album` (`album_id`, `title`, `description`, `date_updated`, `owner_id`, `accessibility_code`) VALUES
(1, 'Nature Photography', 'Look deep into nature, and then you will understand everything better. - Albert Einstein', '2018-01-09', '1', 'shared'),
(5, 'Lifestyle Photography', 'Photography takes an instant out of time, altering life by holding it still. - Dorothea Lange', '2018-01-09', '1', 'shared'),
(9, 'Friends', '', '2018-01-10', '4', 'shared'),
(33, 'Ottawa', 'ON', '2018-01-11', '1', 'shared'),
(38, '1st Album', '', '2018-01-11', 'gongw', 'shared'),
(40, '2nd Album', 'aaaa', '2018-01-11', 'gongw', 'private'),
(41, 'flowers', 'flowers', '2019-03-04', '25', 'shared'),
(42, 'wedding', 'wedding', '2019-03-04', '25', 'shared'),
(43, 'flowers', 'flowers', '2019-03-05', '45', 'shared'),
(44, 'flowers', '', '2019-03-05', '60', 'shared');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `comment_id` int(11) NOT NULL,
  `author_id` varchar(16) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `comment_text` varchar(3000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`comment_id`, `author_id`, `picture_id`, `comment_text`, `date`) VALUES
(9, '1', 7, '', '2018-01-11 05:00:00'),
(11, '1', 7, 'lots of comments and things to say', '2018-01-11 05:00:00'),
(15, '4', 12, 'Hello', '2018-01-11 05:00:00'),
(25, '1', 22, 'aaaaaaaaaaaaaaaavvvvvvvvvvvvvvvvvv', '2018-01-11 05:00:00'),
(26, '45', 34, 'Hi!', '2019-03-05 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Friendship`
--

CREATE TABLE IF NOT EXISTS `Friendship` (
  `friend_requester_id` varchar(16) NOT NULL,
  `friend_requestee_id` varchar(16) NOT NULL,
  `status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Friendship`
--

INSERT INTO `Friendship` (`friend_requester_id`, `friend_requestee_id`, `status`) VALUES
('1', '2', 'request'),
('1', '2', 'request'),
('1', 'gongw', 'accepted'),
('1', 'gongw', 'accepted'),
('25', '1', 'request');

-- --------------------------------------------------------

--
-- Table structure for table `FriendshipStatus`
--

CREATE TABLE IF NOT EXISTS `FriendshipStatus` (
  `status_code` varchar(16) NOT NULL,
  `description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FriendshipStatus`
--

INSERT INTO `FriendshipStatus` (`status_code`, `description`) VALUES
('accepted', 'a request to become a friend has been accepted'),
('request', 'a request has been sent to become a friend');

-- --------------------------------------------------------

--
-- Table structure for table `Picture`
--

CREATE TABLE IF NOT EXISTS `Picture` (
  `picture_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(3000) DEFAULT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Picture`
--

INSERT INTO `Picture` (`picture_id`, `album_id`, `file_name`, `title`, `description`, `date_added`) VALUES
(1, 1, 'image-1.jpg', 'Ottawa', 'Ottawa, ON, Canada', '2018-01-10'),
(7, 1, 'image-1.jpg', 'Ottawa', 'Ottawa', '2018-01-11'),
(12, 9, 'image-2.jpg', 'pic 1', 'asdf', '2018-01-11'),
(22, 38, 'image-1.jpg', '1st Album pictures', 'aaaaaaaaaa', '2018-01-11'),
(23, 38, 'image-2.jpg', '1st Album pictures', 'aaaaaaaaaa', '2018-01-11'),
(24, 38, 'image-3.jpg', '1st Album pictures', 'aaaaaaaaaa', '2018-01-11'),
(25, 38, 'image-4.jpg', '1st Album pictures', 'aaaaaaaaaa', '2018-01-11'),
(27, 40, 'image-6.jpg', '2nd Album pictures', 'aaaa', '2018-01-11'),
(29, 41, 'wedding-photography-10-sm.jpg', 'flowers', 'flowers', '2019-03-04'),
(30, 41, 'event-photography-4-sm.jpg', 'flowers', 'flowers', '2019-03-04'),
(31, 43, 'event-photography-7-sm.jpg', '', '', '2019-03-05'),
(32, 43, 'event-photography-8-sm.jpg', '', '', '2019-03-05'),
(33, 43, 'event-photography-9-sm.jpg', '', '', '2019-03-05'),
(34, 43, 'event-photography-10-sm.jpg', '', '', '2019-03-05'),
(35, 43, 'event-photography-11-sm.jpg', '', '', '2019-03-05'),
(36, 43, 'event-photography-12-sm.jpg', '', '', '2019-03-05'),
(37, 44, 'event-photography-7-sm.jpg', '', '', '2019-03-05'),
(38, 44, 'event-photography-8-sm.jpg', '', '', '2019-03-05'),
(39, 44, 'event-photography-9-sm.jpg', '', '', '2019-03-05'),
(40, 44, 'event-photography-10-sm.jpg', '', '', '2019-03-05'),
(41, 44, 'event-photography-11-sm.jpg', '', '', '2019-03-05'),
(42, 44, 'event-photography-12-sm.jpg', '', '', '2019-03-05'),
(43, 42, 'event-photography-7-sm.jpg', '', '', '2019-03-05'),
(44, 42, 'event-photography-8-sm.jpg', '', '', '2019-03-05'),
(45, 42, 'event-photography-9-sm.jpg', '', '', '2019-03-05'),
(46, 42, 'event-photography-10-sm.jpg', '', '', '2019-03-05'),
(47, 42, 'event-photography-11-sm.jpg', '', '', '2019-03-05'),
(48, 42, 'event-photography-12-sm.jpg', '', '', '2019-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` varchar(16) NOT NULL,
  `name` varchar(256) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `name`, `phone`, `password`) VALUES
('1', 'ALINA KURLIANTSEVA', '613-700-4510', 'fdb78872eef3ab408317490555bd8b2b049ef985'),
('100', 'ALINA KURLIANTSEVA', '613-700-4510', 'd165a479058f2c4257988843184c53e14720e608'),
('2', 'Tanil Yildir', '613-700-4510', 'fdb78872eef3ab408317490555bd8b2b049ef985'),
('25', 'ALINA KURLIANTSEVA', '613-700-4510', 'd165a479058f2c4257988843184c53e14720e608'),
('3', 'Olena Kurliantseva', '613-700-4510', 'fdb78872eef3ab408317490555bd8b2b049ef985'),
('4', 'Andrea de Boer', '613-700-4510', 'fdb78872eef3ab408317490555bd8b2b049ef985'),
('45', 'ALINA KURLIANTSEVA', '613-700-4510', 'd165a479058f2c4257988843184c53e14720e608'),
('5', 'Juhi Patel', '613-700-4510', 'fdb78872eef3ab408317490555bd8b2b049ef985'),
('60', 'ALINA KURLIANTSEVA', '613-700-4510', 'd165a479058f2c4257988843184c53e14720e608'),
('gongw', 'Wei Gong', '613-700-4510', '70ccd9007338d6d81dd3b6271621b9cf9a97ea00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accessibility`
--
ALTER TABLE `Accessibility`
  ADD KEY `accessibility_code` (`accessibility_code`);

--
-- Indexes for table `Album`
--
ALTER TABLE `Album`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `accessibility_code` (`accessibility_code`);

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `picture_id` (`picture_id`);

--
-- Indexes for table `Friendship`
--
ALTER TABLE `Friendship`
  ADD KEY `friend_requester_id` (`friend_requester_id`),
  ADD KEY `friend_requestee_id` (`friend_requestee_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `FriendshipStatus`
--
ALTER TABLE `FriendshipStatus`
  ADD PRIMARY KEY (`status_code`);

--
-- Indexes for table `Picture`
--
ALTER TABLE `Picture`
  ADD PRIMARY KEY (`picture_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Album`
--
ALTER TABLE `Album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `Picture`
--
ALTER TABLE `Picture`
  MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Album`
--
ALTER TABLE `Album`
  ADD CONSTRAINT `fk_album_accessibility` FOREIGN KEY (`accessibility_code`) REFERENCES `Accessibility` (`accessibility_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_album_user` FOREIGN KEY (`owner_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `fk_comment_picture` FOREIGN KEY (`picture_id`) REFERENCES `Picture` (`picture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`author_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Friendship`
--
ALTER TABLE `Friendship`
  ADD CONSTRAINT `fk_friendship_friendship_status` FOREIGN KEY (`status`) REFERENCES `FriendshipStatus` (`status_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_friendship_user_requestee` FOREIGN KEY (`friend_requestee_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_friendship_user_requester` FOREIGN KEY (`friend_requester_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Picture`
--
ALTER TABLE `Picture`
  ADD CONSTRAINT `fk_picture_album` FOREIGN KEY (`album_id`) REFERENCES `Album` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
