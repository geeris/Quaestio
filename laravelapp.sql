-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2021 at 04:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(255) NOT NULL,
  `text` text NOT NULL,
  `dateAnswered` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `text`, `dateAnswered`) VALUES
(22, 'I am from Australia. It is globally famous for its natural wonders, wide-open spaces, beaches, deserts, \"The Bush\", and \"The Outback\". It is also one of the world\'s most highly urbanised countries; it\'s well known for its attractive mega cities such as Sydney, Melbourne, Brisbane, and Perth.', 1620208805),
(23, 'I only speak English and Dutch.', 1620208890),
(24, 'Okay well I play piano, (I\'m the only one in my family who is musically inclined).\r\nI draw. I love the cold weather, and hate the heat, yet I live in Florida. \r\nI also hate cold showers, I don\'t understand how anyone could sit in that for more than five seconds.', 1620210082),
(25, 'Despite a recent boom in property prices, Hobart still remains the cheapest city to live in Australia. Houses in the Tasmanian capital are roughly 25% cheaper than the national average making it much more affordable than cities like Sydney or Melbourne.', 1620210207),
(26, 'For its beaches, theme parks, natural sceneries, and orange orchards. This East Coast home of Mickey Mouse is known for its natural beauty, such as the Florida Everglades. It is called the Sunshine State for its abundant sunshine and generally warmer subtropical climate.', 1620210388),
(27, 'Finland', 1620210809),
(28, 'Finnish language is known to be a difficult language to learn, particularly to adult immigrants. Migration to Finland will always be intertwined with a challenging path to social inclusion and work opportunities.', 1620210827),
(29, 'Fine', 1620210889);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `colour` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`, `icon`, `colour`) VALUES
(1, 'Female', 'fas fa-venus', 'pink'),
(2, 'Male', 'fas fa-mars', 'blue'),
(3, 'Non-binary', 'fas fa-transgender-alt', 'green');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `icon` varchar(30) DEFAULT NULL,
  `route` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `name`, `icon`, `route`) VALUES
(1, 'Home', 'home', 'home'),
(2, 'Questions', 'question', 'userQuestions'),
(3, 'Profile', 'user', 'user.show'),
(4, 'Logout', 'sign-out', 'logout'),
(5, 'Twitter', 'twitter', 'https://twitter.com/'),
(6, 'Instagram', 'instagram', 'https://www.instagram.com/'),
(7, 'Facebook', 'facebook', 'https://www.facebook.com/'),
(8, 'Author', 'user', 'author'),
(9, 'Documentation', 'file-pdf', ''),
(10, 'Users', 'user', 'user.index'),
(11, 'Starter question', 'question', 'starterQuestion.index'),
(12, 'Notifications', 'bell', 'notifications.index');

-- --------------------------------------------------------

--
-- Table structure for table `menutype`
--

CREATE TABLE `menutype` (
  `id` int(20) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menutype`
--

INSERT INTO `menutype` (`id`, `name`) VALUES
(1, 'userNavigation'),
(2, 'adminNavigation'),
(3, 'socialNavigation'),
(4, 'additionalLinks');

-- --------------------------------------------------------

--
-- Table structure for table `menutype_link`
--

CREATE TABLE `menutype_link` (
  `link_id` int(50) NOT NULL,
  `menutype_id` int(20) NOT NULL,
  `priority` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menutype_link`
--

INSERT INTO `menutype_link` (`link_id`, `menutype_id`, `priority`) VALUES
(1, 1, 5),
(2, 1, 10),
(3, 1, 15),
(4, 1, 20),
(4, 2, 20),
(5, 3, 15),
(6, 3, 5),
(7, 3, 10),
(8, 4, 5),
(9, 4, 10),
(10, 2, 10),
(11, 2, 15),
(12, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(255) NOT NULL,
  `text` text NOT NULL,
  `isStarterPack` bit(1) NOT NULL DEFAULT b'0',
  `isDeleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `text`, `isStarterPack`, `isDeleted`) VALUES
(17, 'In which country do you live? Can you share something interesting about your country?', b'1', b'0'),
(18, 'Can you say something more about yourself?', b'1', b'0'),
(21, 'Which languages do you know?', b'1', b'0'),
(22, 'Where is the cheapest place to live in Australia?', b'0', b'0'),
(23, 'What is Florida known for?', b'0', b'0'),
(24, 'Where are you from?', b'0', b'0'),
(25, 'Is Finnish hard?', b'0', b'0'),
(26, 'How are you?', b'0', b'0'),
(27, 'Hi', b'0', b'0'),
(28, 'What is the best thing about Australia in your opinion?', b'0', b'0'),
(29, 'What kind of music do you listen to?', b'0', b'0'),
(30, 'Do you have any pet?', b'0', b'0'),
(32, 'novo12', b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `question_user`
--

CREATE TABLE `question_user` (
  `question_id` int(255) NOT NULL,
  `userFrom_id` int(100) DEFAULT NULL,
  `userTo_id` int(100) NOT NULL,
  `dateSent` int(50) NOT NULL,
  `answer_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_user`
--

INSERT INTO `question_user` (`question_id`, `userFrom_id`, `userTo_id`, `dateSent`, `answer_id`) VALUES
(17, NULL, 43, 1620168985, 22),
(17, NULL, 44, 1620209852, NULL),
(17, NULL, 45, 1620210476, NULL),
(17, NULL, 47, 1620219706, NULL),
(18, NULL, 43, 1620168985, NULL),
(18, NULL, 44, 1620209852, 24),
(18, NULL, 45, 1620210476, NULL),
(18, NULL, 47, 1620219707, NULL),
(21, NULL, 43, 1620168985, 23),
(21, NULL, 44, 1620209853, NULL),
(21, NULL, 45, 1620210476, NULL),
(21, NULL, 47, 1620219707, NULL),
(22, 44, 43, 1620210015, 25),
(23, 43, 44, 1620210330, 26),
(24, 43, 45, 1620210200, 27),
(25, 43, 45, 1620210582, 28),
(26, 44, 45, 1620210315, 29),
(27, 44, 45, 1620210787, NULL),
(28, 44, 43, 1620211060, NULL),
(29, 44, 43, 1620211109, NULL),
(30, 45, 43, 1620211169, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(100) NOT NULL,
  `question_id` int(255) NOT NULL,
  `reporter_id` int(100) NOT NULL,
  `reporttype_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reporttype`
--

CREATE TABLE `reporttype` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `other` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `image` varchar(70) DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `isReported` bit(1) NOT NULL DEFAULT b'0',
  `isDeleted` bit(1) NOT NULL DEFAULT b'0',
  `createdAt` int(50) NOT NULL,
  `updatedAt` int(50) DEFAULT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `age`, `country`, `image`, `gender_id`, `description`, `isReported`, `isDeleted`, `createdAt`, `updatedAt`, `role_id`) VALUES
(43, 'perica12', 'perica@gmailc.com', '2d0f09a7b23485ee13ddab4ec52b43ca', NULL, NULL, NULL, 'Australia', 'male.png', 2, NULL, b'0', b'0', 1620168985, 1620208921, 1),
(44, 'testjedan', 'test1@gmail.com', '09e6a85c70825561fd3d13da8a625dee', 'Charlotte', NULL, 25, 'Florida', 'female.png', 1, NULL, b'0', b'0', 1620209852, 1620210135, 1),
(45, 'testsecond', 'testsecond@gmail.com', '027a2aa57a9d4a23c8240885c8a97de4', NULL, NULL, NULL, NULL, 'non-binary.png', 3, NULL, b'0', b'0', 1620210476, NULL, 1),
(46, 'geerisquaestio', 'geeris@gmail.com', '64df769b4d13923ac5d5bef8895324ff', NULL, NULL, NULL, NULL, 'female.png', 1, NULL, b'0', b'0', 1620211396, NULL, 2),
(47, 'kokoska1', 'koko@gmail.com', '69792dc96ce0e59fee3f79599e4adbb1', NULL, NULL, NULL, NULL, 'female.png', 1, NULL, b'0', b'0', 1620219706, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menutype`
--
ALTER TABLE `menutype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menutype_link`
--
ALTER TABLE `menutype_link`
  ADD PRIMARY KEY (`link_id`,`menutype_id`),
  ADD KEY `link_id` (`link_id`,`menutype_id`),
  ADD KEY `menutype_id` (`menutype_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_user`
--
ALTER TABLE `question_user`
  ADD PRIMARY KEY (`question_id`,`userTo_id`),
  ADD KEY `question_id` (`question_id`,`userFrom_id`),
  ADD KEY `userTo_id` (`userTo_id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `userFrom_id` (`userFrom_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporttype_id` (`reporttype_id`),
  ADD KEY `reporter_id` (`reporter_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `reporttype`
--
ALTER TABLE `reporttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `gender_id` (`gender_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menutype`
--
ALTER TABLE `menutype`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reporttype`
--
ALTER TABLE `reporttype`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menutype_link`
--
ALTER TABLE `menutype_link`
  ADD CONSTRAINT `menutype_link_ibfk_1` FOREIGN KEY (`menutype_id`) REFERENCES `menutype` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `menutype_link_ibfk_2` FOREIGN KEY (`link_id`) REFERENCES `link` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `question_user`
--
ALTER TABLE `question_user`
  ADD CONSTRAINT `question_user_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `question_user_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `question_user_ibfk_3` FOREIGN KEY (`userFrom_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `question_user_ibfk_4` FOREIGN KEY (`userTo_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`reporttype_id`) REFERENCES `reporttype` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
