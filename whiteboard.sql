-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2014 at 12:59 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `whiteboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `whiteboard_img`
--

CREATE TABLE `whiteboard_img` (
`id` int(11) NOT NULL,
  `project` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whiteboard_img`
--

INSERT INTO `whiteboard_img` (`id`, `project`, `photo`, `extension`, `x`, `y`) VALUES
(1, 'nieuwprojectvoorvideo', 'nuffomslag', 'jpg', 0, 0),
(21, 'testuploads', 'Screen Shot 2014-12-13 at 14.37.14', 'png', 424, 648),
(29, 'kak', 'This is some extra data', 'skijt', 200, 200),
(30, 'kak', 'kaka', 'skijt', 200, 200),
(32, '', 'shitman', 'jpg', 200, 200),
(36, 'papapapapa', 'shitman', 'jpg', 983, 34),
(38, 'clear txtarea', 'shitman', 'jpg', 696, 150),
(41, 'papapapapa', 'bacon2', 'jpg', 902, 433),
(42, 'papapapapa', 'kim-van-haelen_th', 'png', 260, 31);

-- --------------------------------------------------------

--
-- Table structure for table `whiteboard_invites`
--

CREATE TABLE `whiteboard_invites` (
`invite_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `invited_user_name` varchar(255) NOT NULL,
  `accepted` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whiteboard_invites`
--

INSERT INTO `whiteboard_invites` (`invite_id`, `project_name`, `invited_user_name`, `accepted`) VALUES
(1, 'inviteTest', 'test@gmail.com', 1),
(2, 'papapapapa', 'matthiasbrodelet@hotmail.com', 1),
(3, 'matthiasznnieuwproject', 'matthiasbrodelet@hotmail.com', 1),
(4, 'matthiasznnieuwproject', 'invite@hot.com', 1),
(5, 'papapapapa', 'invite@hot.com', 1),
(6, 'papapapapa', 'test@gmail.com', 1),
(7, 'matthiasznnieuwproject', 'test@gmail.com', 1),
(11, 'matthiasznnieuwproject', 'grasmachien@hot.com', 1),
(12, 'inviteTest', 'matthiasbrodelet@hotmail.com', 1),
(13, 'testreq', 'test@gmail.com', 1),
(14, 'testreq', 'matthiasbrodelet@hotmail.com', 1),
(15, 'savelocation', 'matthiasbrodelet@hotmail.com', 1),
(17, 'savelocation', 'test@gmail.com', 1),
(18, 'testuploads', 'matthiasbrodelet@hotmail.com', 1),
(19, 'testuploads', 'test@gmail.com', 1),
(20, 'neinnnn', 'matthiasbrodelet@hotmail.com', 1),
(21, 'clear txtarea', 'matthiasbrodelet@hotmail.com', 1),
(22, 'clearproject', 'matthiasbrodelet@hotmail.com', 1),
(23, 'clear txtarea', 'test@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `whiteboard_projects`
--

CREATE TABLE `whiteboard_projects` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whiteboard_projects`
--

INSERT INTO `whiteboard_projects` (`id`, `name`, `photo`, `extension`, `user_id`) VALUES
(10, 'nieuwprojectvoorvideo', 'IMG_1075', 'PNG', 2),
(11, 'inviteTest', 'stijn-depuydt', 'png', 3),
(13, 'papapapapa', 'kim-van-haelen', 'png', 3),
(14, 'matthiasznnieuwproject', 'santa-claus3', 'png', 2),
(15, 'testreq', 'Screen Shot 2014-11-06 at 18.19.03', 'png', 1),
(16, 'savelocation', 'Screen Shot 2014-11-20 at 20.41.01', 'png', 2),
(17, 'testuploads', 'Screen Shot 2014-12-12 at 14.13.09', 'png', 2),
(18, 'neinnnn', 'Screen Shot 2014-10-22 at 17.41.14', 'png', 2),
(19, 'clear txtarea', 'Screen Shot 2014-11-19 at 16.09.51', 'png', 2),
(20, 'clearproject', 'Screen Shot 2014-11-21 at 15.53.19', 'png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `whiteboard_tekst`
--

CREATE TABLE `whiteboard_tekst` (
`id` int(11) NOT NULL,
  `tekst` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whiteboard_tekst`
--

INSERT INTO `whiteboard_tekst` (`id`, `tekst`, `project`, `x`, `y`) VALUES
(1, 'werkt dan', 'hola', 0, 0),
(2, 'neinee', 'hola', 0, 0),
(3, 'fffff', 'aap', 0, 0),
(4, 'fffff', 'aap', 0, 0),
(5, 'nopeeee', 'aap', 0, 0),
(6, 'nopeeee', 'aap', 0, 0),
(7, 'yeesssss', 'hola', 0, 0),
(8, 'nieuwetekstkomterdirectbij', 'hola', 0, 0),
(9, 'komerdanbijNUUUUUUU', 'hola', 0, 0),
(10, 'werktdanNUUU', 'hola', 0, 0),
(11, 'werktdanNUUU', 'hola', 0, 0),
(12, 'werktdanNUUU', 'hola', 0, 0),
(13, 'werktdanNUUU', 'hola', 0, 0),
(14, 'okenumoetdawerken eh', 'hola', 0, 0),
(15, 'okenumoetdawerken eh', 'hola', 0, 0),
(16, 'werktdanNUUUkjazdjahzdazhjaz', 'nieuwprojectvoorvideo', 0, 0),
(17, 'werktdanNUUUkjazdjahzdazhjaz', 'nieuwprojectvoorvideo', 0, 0),
(18, 'hetwerktnutochhopelijk', 'nieuwprojectvoorvideo', 0, 0),
(21, 'okenumoetdawerken eh', 'matthiasznnieuwproject', 99, 129),
(34, 'eerste ajax postit yeeeey', 'testuploads#', 200, 200),
(35, 'biatch', 'testuploads#', 200, 200),
(38, 'tette', 'testuploads', 334, 336),
(42, 'tette', 'neinnnn', 819, 17),
(51, 'tette kop', 'clear%20txtarea', 200, 200),
(52, 'tette kopkkkkk', 'clear%20txtarea', 200, 200),
(73, 'blabla', 'clearproject', 635, 192),
(77, ' apen kak', 'testreq', 357, 155),
(81, 'kjznkjzndkjzendz', 'papapapapa', 1355, 505),
(82, ' hh', 'papapapapa', 488, 514),
(83, 'kakje', 'clear%20txtarea', 200, 200),
(85, 'yolo', 'inviteTest', 877, 172),
(86, ' ', 'inviteTest', 367, 193),
(87, 'tits', 'inviteTest', 804, 531),
(88, ' ', 'inviteTest', 1207, 359),
(89, 'kakske', 'inviteTest', 547, 541),
(90, 'kak', 'papapapapa', 1380, 125),
(91, 'yolo', 'papapapapa', 243, 537);

-- --------------------------------------------------------

--
-- Table structure for table `whiteboard_users`
--

CREATE TABLE `whiteboard_users` (
`id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whiteboard_users`
--

INSERT INTO `whiteboard_users` (`id`, `email`, `password`, `created`) VALUES
(1, 'test@gmail.com', '$2y$12$VsgdC9ZZXz1PpalOCRBzo.dLve1ylf3u.wLEoUI0O18geIbqg2NHa', '2014-11-26 16:42:27'),
(2, 'matthiasbrodelet@hotmail.com', '$2y$12$ABoa3K0V/W3te/ctUSyoZuTtxOth5ssWA7BhyXIEzUNKnJm1rQxX2', '2014-11-30 19:56:42'),
(3, 'invite@hot.com', '$2y$12$HIYILnBeY8zaVNR4b5WsNOBoHXGjQHtlh9MYPFAdn3Np9W.R8g2IG', '2014-12-06 15:09:21'),
(4, 'grasmachien@hot.com', '$2y$12$QsXInk6UQ1ILdE5hhAmQ6.EpNqHNaMAPPxq19kT4jRO0noWJLmxdq', '2014-12-07 23:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `whiteboard_video`
--

CREATE TABLE `whiteboard_video` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whiteboard_video`
--

INSERT INTO `whiteboard_video` (`id`, `name`, `video`, `project`, `x`, `y`) VALUES
(1, 'videoken', 'videoken.mp4', 'hola', 0, 0),
(2, 'videoken', 'videoken.mp4', '', 0, 0),
(3, 'videoken', 'videoken.mp4', '', 0, 0),
(4, 'videoken', 'videoken.mp4', '', 0, 0),
(5, 'videoken', 'videoken.mp4', '', 0, 0),
(6, 'videoken', 'videoken.mp4', '', 0, 0),
(7, 'videoken', 'videoken.mp4', '', 0, 0),
(8, 'jhazjhazjhaze', 'jhazjhazjhaze.mp4', '', 0, 0),
(9, 'lololololool', 'lololololool.mp4', 'nieuwprojectvoorvideo', 0, 0),
(10, 'nqbnqbnbnz', 'nqbnqbnbnz.mp4', 'nieuwprojectvoorvideo', 0, 0),
(11, 'zehjejhezhjezhjee', 'zehjejhezhjezhjee.mp4', 'nieuwprojectvoorvideo', 0, 0),
(18, 'jepla', 'jepla.mp4', 'testuploads', 285, 64),
(23, 'jhzjhze', 'jhzjhze.mp4', 'papapapapa', 641, 25),
(26, 'kjazdkjzjkzda', 'kjazdkjzjkzda.mp4', 'papapapapa', 200, 200),
(27, 'azkjdazjbdjhzad', 'azkjdazjbdjhzad.mp4', 'papapapapa', 886, 644),
(28, 'lololo', 'lololo.mp4', 'papapapapa', 585, 381),
(29, 'papapapapa', 'papapapapa.mp4', 'clearproject', 200, 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `whiteboard_img`
--
ALTER TABLE `whiteboard_img`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whiteboard_invites`
--
ALTER TABLE `whiteboard_invites`
 ADD PRIMARY KEY (`invite_id`);

--
-- Indexes for table `whiteboard_projects`
--
ALTER TABLE `whiteboard_projects`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whiteboard_tekst`
--
ALTER TABLE `whiteboard_tekst`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whiteboard_users`
--
ALTER TABLE `whiteboard_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whiteboard_video`
--
ALTER TABLE `whiteboard_video`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `whiteboard_img`
--
ALTER TABLE `whiteboard_img`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `whiteboard_invites`
--
ALTER TABLE `whiteboard_invites`
MODIFY `invite_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `whiteboard_projects`
--
ALTER TABLE `whiteboard_projects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `whiteboard_tekst`
--
ALTER TABLE `whiteboard_tekst`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `whiteboard_users`
--
ALTER TABLE `whiteboard_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `whiteboard_video`
--
ALTER TABLE `whiteboard_video`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
