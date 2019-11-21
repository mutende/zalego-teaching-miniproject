-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2019 at 01:11 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zalego`
--

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `id` int(11) NOT NULL,
  `campus` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `courses` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `campus`, `location`, `courses`) VALUES
(1, 'JKUAT', 'Juja', '2');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseId` int(11) NOT NULL,
  `courseName` varchar(65) NOT NULL,
  `courseDuration` int(2) NOT NULL,
  `courseFee` double(8,2) NOT NULL,
  `timeAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseId`, `courseName`, `courseDuration`, `courseFee`, `timeAdded`) VALUES
(1, 'Web Development', 3, 45000.00, '2019-11-20 16:38:51'),
(2, 'Python', 4, 50000.00, '2019-11-20 16:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `courseapplied`
--

CREATE TABLE `courseapplied` (
  `appliedId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `timeApplied` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseapplied`
--

INSERT INTO `courseapplied` (`appliedId`, `courseId`, `studentId`, `timeApplied`, `status`) VALUES
(1, 1, 2, '2019-10-15 14:37:18', 1),
(2, 1, 3, '2019-10-17 08:59:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `token` varchar(1500) NOT NULL,
  `expires` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resetpassword`
--

INSERT INTO `resetpassword` (`id`, `email`, `selector`, `token`, `expires`) VALUES
(1, 'elvis@gmail.com', 'f2434ee5adad6b61', '$2y$10$qHJ1HI90UPecV9afqnW9C.DPwEqHJbDV5p7w7Z9kz90FlY4i8rI8K', '1574277306');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` int(11) NOT NULL,
  `fullName` varchar(65) NOT NULL,
  `regNo` varchar(20) NOT NULL,
  `phoneNo` varchar(14) NOT NULL,
  `email` varchar(65) NOT NULL,
  `timeRegistered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `fullName`, `regNo`, `phoneNo`, `email`, `timeRegistered`) VALUES
(2, 'Ngetich Kip', 'ZA001', '+254708058225', 'ngetich@zalego.com', '2019-10-17 08:58:44'),
(3, 'Alvin Ndolo', 'ZA002', '+254788999003', 'andolo@zalego.com', '2019-10-17 08:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `email` varchar(65) NOT NULL,
  `userName` varchar(65) NOT NULL,
  `type` varchar(15) NOT NULL,
  `password` varchar(65) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `email`, `userName`, `type`, `password`, `status`) VALUES
(1, 'elvis@gmail.com', 'elvis', 'admin', '$2y$10$lOkL1g9z/E57RnkAf98Wm.YrUUaYXjTQvzRGoDlCHa0nT0jYgacWC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `courseapplied`
--
ALTER TABLE `courseapplied`
  ADD PRIMARY KEY (`appliedId`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `regNo` (`regNo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNo` (`phoneNo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courseapplied`
--
ALTER TABLE `courseapplied`
  MODIFY `appliedId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
