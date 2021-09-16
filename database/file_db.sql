-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2019 at 07:05 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_tb`
--

CREATE TABLE `contact_tb` (
  `cont_ID` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `sms` varchar(900) NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_tb`
--

INSERT INTO `contact_tb` (`cont_ID`, `name`, `email`, `subject`, `sms`, `sent_date`, `reply_date`) VALUES
(1, 'dbVBD<v', 'bvjfbvkj@gmail.com', 'jsfvbjb', 'savbajfbvjkfdk', '2019-03-21 17:01:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblchat_message`
--

CREATE TABLE `tblchat_message` (
  `chat_ID` int(6) NOT NULL,
  `to_user_ID` varchar(13) CHARACTER SET latin1 NOT NULL,
  `from_user_ID` varchar(13) CHARACTER SET latin1 NOT NULL,
  `chat_sms` varchar(900) CHARACTER SET latin1 NOT NULL,
  `status` int(11) NOT NULL,
  `last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tblchat_message`
--

INSERT INTO `tblchat_message` (`chat_ID`, `to_user_ID`, `from_user_ID`, `chat_sms`, `status`, `last_time`) VALUES
(1, '12301267/T.18', '13301284/T.18', 'nilikwambia ntakuja uko kesho ila ww huatak kunielewa bhas sitokuja milelel maan tunafikia hatua hatuelewan kwa mishe za kisenge', 0, '2019-03-18 11:29:15'),
(2, '13301284/T.18', '12301267/T.18', 'nilikwambia ntakuja uko kesho ila ww huatak kunielewa bhas sitokuja milelel maan tunafikia hatua hatuelewan kwa mishe za kisenge', 0, '2019-03-18 11:29:47'),
(3, '13301179/T.18', '13301284/T.18', 'habar kijana', 1, '2019-03-18 11:34:19'),
(4, '13201589/T.18', '12301267/T.18', 'Oi kev', 0, '2019-03-18 17:40:39'),
(5, '13301284/T.18', '13201589/T.18', 'oi niaje', 0, '2019-03-18 17:45:45'),
(6, '12301267/T.18', '13201589/T.18', 'oi niaje', 0, '2019-03-18 17:40:49'),
(7, '13201589/T.18', '12301267/T.18', 'Fresh veep', 0, '2019-03-18 17:43:06'),
(8, '13201589/T.18', '12301267/T.18', 'Mida', 0, '2019-03-18 17:53:04'),
(9, '12301267/T.18', '13201589/T.18', 'poa', 0, '2019-03-18 17:53:16'),
(10, '13301284/T.18', '12301267/T.18', 'Admin', 0, '2019-03-18 17:54:04'),
(11, '12301267/T.18', '13301284/T.18', 'oi', 0, '2019-03-21 02:19:35'),
(12, '13301284/T.18', '12301267/T.18', 'Niaje admin', 0, '2019-03-21 09:56:19'),
(13, '12301267/T.18', '13301284/T.18', 'fres', 0, '2019-03-21 13:54:36'),
(14, '12301267/T.18', '13301284/T.18', 'nimekosea', 0, '2019-03-21 13:54:36'),
(15, '12301267/T.18', '13301284/T.18', 'sawa akak', 0, '2019-03-21 13:54:36'),
(16, '13301250/T.18', '13301284/T.18', 'mambo annah', 1, '2019-03-21 10:16:14'),
(17, '13301250/T.18', '13301284/T.18', 'veep ', 1, '2019-03-21 10:17:04'),
(18, '13201589/T.18', '13301284/T.18', 'fresh', 0, '2019-03-21 10:51:53'),
(19, '13301284/T.18', '13201589/T.18', 'popa habar za ww', 0, '2019-03-21 10:52:05'),
(20, '13201589/T.18', '13301284/T.18', 'safi tu sina neno', 0, '2019-03-21 10:52:48'),
(21, '12301267/T.18', '13301284/T.18', 'nimepta tatizo ', 1, '2019-03-21 15:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(255) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `coursename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `course_code`, `coursename`) VALUES
(1, 'CSS 111', 'INTRODUCTION TO COMPUTER STYSTEM'),
(2, 'CSS 114', 'DATABASE MANAGEMENT '),
(3, 'ICT 112', 'HIGH LEVEL PROGRAMMING C#'),
(4, 'CSS 119', 'ELEMENTARY STATISTIC'),
(5, 'COM 101', 'COMMUNICATION SKILLS'),
(6, 'DST 100', 'DEVELOPMENT STUDIES');

-- --------------------------------------------------------

--
-- Table structure for table `tbleducation`
--

CREATE TABLE `tbleducation` (
  `ed_ID` int(11) NOT NULL,
  `regnumber` varchar(13) NOT NULL,
  `position` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfile`
--

CREATE TABLE `tblfile` (
  `fileID` int(20) NOT NULL,
  `filename` varchar(20) NOT NULL,
  `dateUp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `regnumber` varchar(13) NOT NULL,
  `ID` int(255) NOT NULL,
  `read_in` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfile`
--

INSERT INTO `tblfile` (`fileID`, `filename`, `dateUp`, `regnumber`, `ID`, `read_in`) VALUES
(1, 'alll.txt', '2019-03-21 18:43:01', '13301284/T.18', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin_detail`
--

CREATE TABLE `tbllogin_detail` (
  `ID` int(11) NOT NULL,
  `user_ID` varchar(13) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllogin_detail`
--

INSERT INTO `tbllogin_detail` (`ID`, `user_ID`, `last_activity`, `is_type`) VALUES
(1, '13301284/T.18', '2019-03-21 01:03:25', 'no'),
(2, '13301284/T.18', '2019-03-21 01:05:13', 'no'),
(3, '13301284/T.18', '2019-03-21 01:06:58', 'no'),
(4, '13301284/T.18', '2019-03-21 01:07:00', 'no'),
(5, '13301284/T.18', '2019-03-21 01:50:23', ''),
(6, '13301284/T.18', '2019-03-21 02:06:29', 'no'),
(7, '13301284/T.18', '2019-03-21 02:06:53', ''),
(8, '13301284/T.18', '2019-03-21 02:26:28', ''),
(9, '13301284/T.18', '2019-03-21 02:13:36', ''),
(10, '12301267/T.18', '2019-03-21 02:26:27', ''),
(11, '13301284/T.18', '2019-03-21 09:28:49', ''),
(12, '13301284/T.18', '2019-03-21 11:00:35', ''),
(13, '12301267/T.18', '2019-03-21 10:45:21', ''),
(14, '13201589/T.18', '2019-03-21 11:00:48', ''),
(15, '12301267/T.18', '2019-03-21 14:02:18', ''),
(16, '13301284/T.18', '2019-03-21 15:41:11', ''),
(17, '12301267/T.18', '2019-03-21 14:05:41', ''),
(18, '12301267/T.18', '2019-03-21 18:05:42', ''),
(19, '13301284/T.18', '2019-03-21 18:05:42', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblskills`
--

CREATE TABLE `tblskills` (
  `skill_ID` int(100) NOT NULL,
  `regnumber` varchar(13) NOT NULL,
  `skill_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `regnumber` varchar(13) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `typeID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`regnumber`, `fname`, `email`, `username`, `password`, `image`, `typeID`) VALUES
('12301267/T.18', 'Alison Deogratias', 'alison@gmail.com', 'alison', '123456', 'default.jpg', 1),
('13201589/T.18', 'Kelvin Harrison', 'deogbar@gmail.com', 'kelvin', '12345', 'default.jpg', 1),
('13301179/T.18', 'Joshua E Thaditi', 'josh@gmail.com', 'josh', 'josh4', 'default.jpg', 1),
('13301250/T.18', 'Annah A Kweka', 'annah@gmail.com', 'annah', '12345', 'default.jpg', 1),
('13301284/T.18', 'Deogratias Alison', 'deesynertz@gmail.com', 'Admin', '12345', '3b.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `typeID` int(1) NOT NULL,
  `typename` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`typeID`, `typename`) VALUES
(0, 'Admin'),
(1, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_tb`
--
ALTER TABLE `contact_tb`
  ADD PRIMARY KEY (`cont_ID`);

--
-- Indexes for table `tblchat_message`
--
ALTER TABLE `tblchat_message`
  ADD PRIMARY KEY (`chat_ID`),
  ADD KEY `to_user_ID` (`to_user_ID`),
  ADD KEY `from_user_ID` (`from_user_ID`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbleducation`
--
ALTER TABLE `tbleducation`
  ADD PRIMARY KEY (`ed_ID`),
  ADD KEY `regnumber` (`regnumber`);

--
-- Indexes for table `tblfile`
--
ALTER TABLE `tblfile`
  ADD PRIMARY KEY (`fileID`),
  ADD KEY `ID` (`ID`) USING BTREE,
  ADD KEY `regnumber` (`regnumber`) USING BTREE;

--
-- Indexes for table `tbllogin_detail`
--
ALTER TABLE `tbllogin_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `tblskills`
--
ALTER TABLE `tblskills`
  ADD PRIMARY KEY (`skill_ID`),
  ADD KEY `regnumber` (`regnumber`) USING BTREE;

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`regnumber`),
  ADD KEY `typeID` (`typeID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`typeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_tb`
--
ALTER TABLE `contact_tb`
  MODIFY `cont_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblchat_message`
--
ALTER TABLE `tblchat_message`
  MODIFY `chat_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbleducation`
--
ALTER TABLE `tbleducation`
  MODIFY `ed_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblfile`
--
ALTER TABLE `tblfile`
  MODIFY `fileID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbllogin_detail`
--
ALTER TABLE `tbllogin_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblskills`
--
ALTER TABLE `tblskills`
  MODIFY `skill_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `typeID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblchat_message`
--
ALTER TABLE `tblchat_message`
  ADD CONSTRAINT `tblchat_message_ibfk_2` FOREIGN KEY (`to_user_ID`) REFERENCES `tbluser` (`regnumber`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tblchat_message_ibfk_3` FOREIGN KEY (`from_user_ID`) REFERENCES `tbluser` (`regnumber`) ON UPDATE CASCADE;

--
-- Constraints for table `tbleducation`
--
ALTER TABLE `tbleducation`
  ADD CONSTRAINT `tbleducation_ibfk_1` FOREIGN KEY (`regnumber`) REFERENCES `tbluser` (`regnumber`) ON UPDATE CASCADE;

--
-- Constraints for table `tblfile`
--
ALTER TABLE `tblfile`
  ADD CONSTRAINT `tblfile_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `tblcourse` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tblfile_ibfk_2` FOREIGN KEY (`regnumber`) REFERENCES `tbluser` (`regnumber`) ON UPDATE CASCADE;

--
-- Constraints for table `tbllogin_detail`
--
ALTER TABLE `tbllogin_detail`
  ADD CONSTRAINT `tbllogin_detail_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `tbluser` (`regnumber`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbllogin_detail_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `tbluser` (`regnumber`) ON UPDATE CASCADE;

--
-- Constraints for table `tblskills`
--
ALTER TABLE `tblskills`
  ADD CONSTRAINT `tblskills_ibfk_1` FOREIGN KEY (`regnumber`) REFERENCES `tbluser` (`regnumber`) ON UPDATE CASCADE;

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD CONSTRAINT `typeID` FOREIGN KEY (`typeID`) REFERENCES `usertype` (`typeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





