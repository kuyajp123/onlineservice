-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 05:53 PM
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
(1, 4, 3, 'Hi', '2024-08-07 07:18:42'),
(2, 6, 3, 'hoi', '2024-08-07 07:29:21'),
(3, 6, 3, 'hoi', '2024-08-07 07:29:21'),
(4, 6, 3, 'all goods', '2024-08-07 07:29:35'),
(5, 1, 4, 'comment', '2024-08-07 10:06:44'),
(6, 5, 4, 'text commnet', '2024-08-07 10:07:13'),
(7, 6, 4, 'd makapag comment sa image haha', '2024-08-07 10:57:33'),
(8, 7, 4, 'bawal parin?', '2024-08-07 11:19:55'),
(9, 7, 4, 'naks pwede na', '2024-08-07 11:20:39'),
(10, 7, 3, 'sarap', '2024-08-07 11:48:49'),
(11, 1, 4, 'eeeyyyy', '2024-08-07 13:20:46');

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
(158, 7, 3, '', '2024-08-08 14:18:04');

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
(1, 3, 'bothrelati', 'bothservic', 'check post eeeeeeeeeeeyyyyyyyyyyy', '', '2024-08-01 11:05:40'),
(4, 4, 'bothrelati', 'bothservic', 'post check ni B', '', '2024-08-03 07:36:47'),
(5, 3, 'bothrelati', 'bothservic', 'text post', '', '2024-08-03 14:30:16'),
(6, 3, 'bothrelati', 'bothservic', 'photo post', 'wallpaperflare-cropped.jpg', '2024-08-06 13:08:55'),
(7, 4, 'bothrelati', 'bothservic', '', 'download.jpg', '2024-08-07 10:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `report_reason` varchar(100) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_reports`
--

INSERT INTO `post_reports` (`report_id`, `post_id`, `user_no`, `report_reason`, `report_date`) VALUES
(1, 7, 3, 'Violence', '2024-08-08 15:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `saves`
--

CREATE TABLE `saves` (
  `save_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `share_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `report_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_no`, `user_ip`, `user_ID`, `email`, `student_no`, `fname`, `lname`, `bday`, `gender`, `coverphoto`, `profilepicture`, `created_at`, `updated_at`, `user_password`, `report_count`) VALUES
(3, '::1', '@test91', 'tmc.test@cvsu.edu.ph', '2022-100-0349', 'A', 'A', '2024-07-24', 'prefered-not-to-say', 'default_coverphoto.jpg', 'FB_IMG_1715253475717.jpg', '2024-07-24 01:12:33', '2024-08-08 15:21:07', '$2y$10$n37x9A2H9vukaGeMNnvMaulCD9ITXIXGWePQDUwkCYeAqiQS9QvZW', 0),
(4, '::1', '@b360', 'tmc.test2@cvsu.edu.ph', '2023-100-0349', 'B', 'B', '2024-07-05', 'Non-binary', 'james-sullivan-x8l63IUeuwQ-unsplash.jpg', 'FB_IMG_1658182051384.jpg', '2024-07-24 07:43:49', '2024-08-02 06:47:46', '$2y$10$VrqB3dKisDYexxK7KGraQuelhI8Pq.3JjcbLC/K/1jZTFdQPql0l.', 0);

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
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `saves`
--
ALTER TABLE `saves`
  ADD PRIMARY KEY (`save_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`share_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_no`),
  ADD UNIQUE KEY `user_ID` (`user_ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `student_no` (`student_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saves`
--
ALTER TABLE `saves`
  MODIFY `save_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `share_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD CONSTRAINT `post_reports_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_reports_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `saves`
--
ALTER TABLE `saves`
  ADD CONSTRAINT `saves_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `saves_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
