-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2024 at 05:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password_hash`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_no`, `comment_text`, `timestamp`) VALUES
(1, 23, 48, 'Inaantok na\'ko 2ll', '2024-08-12 15:51:35'),
(2, 25, 49, 'hi', '2024-08-13 14:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `heart_reactions`
--

CREATE TABLE `heart_reactions` (
  `reaction_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `reaction_type` enum('heart') NOT NULL DEFAULT 'heart',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `heart_reactions`
--

INSERT INTO `heart_reactions` (`reaction_id`, `post_id`, `user_no`, `reaction_type`, `timestamp`) VALUES
(4, 23, 48, '', '2024-08-12 15:42:54'),
(6, 24, 49, '', '2024-08-13 11:14:27'),
(7, 25, 49, '', '2024-08-13 11:14:41'),
(8, 23, 49, '', '2024-08-13 11:15:40'),
(9, 25, 48, '', '2024-08-13 11:44:07'),
(10, 24, 48, '', '2024-08-13 11:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_no` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `notification_type` enum('warning','ban') DEFAULT NULL,
  `notification_text` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_no` int(11) DEFAULT NULL,
  `relation` varchar(10) DEFAULT NULL,
  `services` varchar(10) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `postphoto` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_no`, `relation`, `services`, `caption`, `postphoto`, `timestamp`) VALUES
(23, 48, 'bothrelati', 'bothservic', 'Welcome to CvS tagram', '', '2024-08-12 15:42:25'),
(24, 49, 'bothrelati', 'bothservic', 'qwer', '5a91e8359f415e730c4ed61965ce7023.jpg', '2024-08-13 11:14:25'),
(25, 49, 'bothrelati', 'bothservic', '', 'Cavite_State_University_(CvSU).png', '2024-08-13 11:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `reporter_user_no` int(11) NOT NULL,
  `report_reason` varchar(100) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_reports`
--

INSERT INTO `post_reports` (`report_id`, `post_id`, `user_no`, `reporter_user_no`, `report_reason`, `report_date`) VALUES
(18, 25, 49, 48, 'Pretending to be someone else', '2024-08-13 11:39:43'),
(19, 23, 48, 49, 'Misleading or scam', '2024-08-13 14:13:29'),
(20, 23, 48, 49, 'Spam', '2024-08-13 22:46:40'),
(21, 25, 49, 48, 'Violence', '2024-08-13 22:47:09'),
(22, 23, 48, 49, 'Other', '2024-08-14 03:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `user_no` int(11) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `days` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `user_no`, `date_start`, `date_end`, `start_time`, `end_time`, `days`, `name`, `description`, `color`) VALUES
(8, 48, '2024-08-29', '2024-08-27', '01:00:00', '01:00:00', 'Monday', 'qwer', 'qwer', 'green');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_no` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_ID` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `student_no` varchar(13) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bday` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `coverphoto` varchar(250) NOT NULL,
  `profilepicture` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_password` varchar(255) NOT NULL,
  `is_setup_complete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_no`, `user_ip`, `user_ID`, `email`, `student_no`, `fname`, `lname`, `bday`, `gender`, `coverphoto`, `profilepicture`, `created_at`, `updated_at`, `user_password`, `is_setup_complete`) VALUES
(48, '192.168.100.5', '@john_paul206', 'tmc.test2@cvsu.edu.ph', '2022-100-0349', 'John Paul', 'Naag', '2024-08-13', 'prefered-not-to-say', 'FB_IMG_1718520279758.jpg', 'IMG_20230313_190514.jpg', '2024-08-12 15:30:04', '2024-08-13 12:07:04', '$2y$10$WI8U3eFCMvKvhVScEiOeq.s2hcqNRwLF5R//ERrsKn9N9kJUJ165G', 0),
(49, '::1', '@a900', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 'A', 'A', '2024-08-08', 'Female', '', '', '2024-08-13 11:02:55', '2024-08-13 13:50:15', '$2y$10$Vk7EzS8cORaYUDBpkZS.OuuXiLORZJHoHrGiNC50GXhk0nbm3S5LW', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_restrictions`
--

CREATE TABLE `user_restrictions` (
  `restrictions_id` int(11) NOT NULL,
  `user_no` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `warning_count` int(11) DEFAULT 0,
  `banned` tinyint(1) DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  ADD PRIMARY KEY (`reaction_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_no` (`user_no`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_id` (`user_no`);

--
-- Indexes for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_no` (`user_no`),
  ADD KEY `post_reports_ibfk_3` (`reporter_user_no`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `fk_user_no` (`user_no`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_no`),
  ADD UNIQUE KEY `user_ID` (`user_ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `student_no` (`student_no`);

--
-- Indexes for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  ADD PRIMARY KEY (`restrictions_id`),
  ADD KEY `user_no` (`user_no`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  MODIFY `restrictions_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  ADD CONSTRAINT `heart_reactions_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `heart_reactions_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD CONSTRAINT `post_reports_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_reports_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`),
  ADD CONSTRAINT `post_reports_ibfk_3` FOREIGN KEY (`reporter_user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_user_no` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_restrictions`
--
ALTER TABLE `user_restrictions`
  ADD CONSTRAINT `user_restrictions_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`),
  ADD CONSTRAINT `user_restrictions_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
