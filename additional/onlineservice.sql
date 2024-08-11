-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 09:51 AM
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
(1, 7, 19, 'ubos ang comment', '2024-08-09 11:59:50'),
(2, 9, 3, 'HAHAHA', '2024-08-09 12:00:14'),
(3, 6, 3, 'atleast nagana na', '2024-08-09 12:18:06'),
(4, 7, 3, 'mag tira ka naman yah', '2024-08-09 13:37:57'),
(5, 7, 3, 'mag tira ka naman yah', '2024-08-09 13:37:57'),
(6, 7, 19, 'HAHAHAH GAGO', '2024-08-09 13:38:56'),
(7, 7, 3, 'sarap mo yah', '2024-08-09 13:39:14'),
(8, 7, 19, 'Titikman', '2024-08-09 13:39:31'),
(9, 7, 19, 'Ano gawa nyo?', '2024-08-09 13:39:53'),
(10, 7, 3, 'yari kayo mamaya HAHA', '2024-08-09 13:40:00'),
(11, 1, 19, 'Eeeyyyy', '2024-08-09 13:40:33'),
(12, 1, 3, 'HEEEEEEY', '2024-08-09 13:40:44'),
(13, 1, 19, 'Hi po', '2024-08-09 13:40:53'),
(14, 1, 3, 'hello', '2024-08-09 13:41:01'),
(15, 1, 19, 'Kamusta ang buhay buhay?', '2024-08-09 13:41:13'),
(16, 1, 3, 'wala ito kahiga', '2024-08-09 13:41:22'),
(17, 1, 19, 'Komaen kana?', '2024-08-09 13:41:32'),
(18, 1, 3, 'ayyiiieee', '2024-08-09 13:41:49'),
(19, 1, 19, 'text', '2024-08-09 14:33:30'),
(20, 4, 19, 'comment', '2024-08-09 14:35:09'),
(21, 4, 19, 'wew', '2024-08-09 14:46:31'),
(22, 1, 4, 'shheeessh silos', '2024-08-09 14:47:00'),
(23, 5, 4, 'low', '2024-08-09 14:47:07'),
(24, 9, 4, 'haha', '2024-08-09 14:47:32'),
(25, 9, 3, 'nagana pa ba to?', '2024-08-10 00:26:49'),
(26, 7, 3, 'dito?', '2024-08-10 00:27:10'),
(27, 6, 3, 'sa phos photo', '2024-08-10 00:27:19'),
(28, 5, 3, 'e sa text?', '2024-08-10 00:27:27'),
(29, 4, 3, 'comment check ni a', '2024-08-10 00:27:44'),
(30, 1, 3, 'check comment eeeeeeeyyyyyyyyyyyy', '2024-08-10 00:27:56');

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
(18, 6, 3, '', '2024-08-09 14:00:53'),
(56, 7, 3, '', '2024-08-09 14:14:45'),
(57, 9, 3, '', '2024-08-09 14:15:10'),
(58, 9, 19, '', '2024-08-09 14:16:14'),
(62, 4, 3, '', '2024-08-09 14:25:38'),
(63, 4, 4, '', '2024-08-09 14:29:06'),
(64, 5, 4, '', '2024-08-09 14:29:07'),
(65, 7, 4, '', '2024-08-09 14:29:11'),
(66, 7, 19, '', '2024-08-09 14:29:22'),
(67, 5, 19, '', '2024-08-09 14:29:27'),
(68, 4, 19, '', '2024-08-09 14:29:27'),
(69, 1, 3, '', '2024-08-10 00:28:10'),
(70, 4, 32, '', '2024-08-11 00:53:05'),
(71, 1, 32, '', '2024-08-11 00:53:07'),
(72, 7, 32, '', '2024-08-11 00:53:12');

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
(7, 4, 'bothrelati', 'bothservic', '', 'download.jpg', '2024-08-07 10:08:52'),
(9, 19, 'bothrelati', 'bothservic', '', '5a91e8359f415e730c4ed61965ce7023.jpg', '2024-08-09 09:54:01');

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
(1, 9, 19, 4, 'Prohibited content', '2024-08-09 23:09:57'),
(2, 9, 19, 3, 'Offensive', '2024-08-09 23:10:25'),
(3, 7, 4, 3, 'Spam', '2024-08-09 23:10:31'),
(4, 9, 19, 3, 'Sexually inappropriate', '2024-08-09 23:14:42'),
(5, 7, 4, 3, 'Misleading or scam', '2024-08-09 23:15:02'),
(6, 7, 4, 3, 'Violence', '2024-08-09 23:16:14'),
(7, 9, 19, 3, 'Violence', '2024-08-09 23:33:42'),
(8, 9, 19, 3, 'False news', '2024-08-09 23:40:33'),
(9, 9, 19, 3, 'Spam', '2024-08-09 23:50:19'),
(10, 9, 19, 3, 'Offensive', '2024-08-09 23:52:46'),
(11, 7, 4, 3, 'Other', '2024-08-09 23:56:16'),
(12, 9, 19, 3, 'Other', '2024-08-09 23:57:33'),
(13, 9, 19, 3, 'Misleading or scam', '2024-08-09 23:59:41'),
(14, 7, 4, 3, 'False news', '2024-08-10 00:00:16'),
(15, 9, 19, 3, 'Misleading or scam', '2024-08-10 00:11:38'),
(16, 7, 4, 3, 'Sexually inappropriate', '2024-08-10 00:20:29'),
(17, 4, 4, 3, 'Prohibited content', '2024-08-10 00:21:01'),
(21, 4, 4, 19, 'Prohibited content', '2024-08-10 00:24:36'),
(23, 5, 3, 32, 'Offensive', '2024-08-11 00:53:28');

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
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `user_no` int(11) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `user_no`, `schedule_date`, `start_time`, `end_time`, `name`, `description`) VALUES
(1, 3, '2021-07-26', '08:00:00', '09:00:00', 'test', 'this is test');

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
  `is_setup_complete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_no`, `user_ip`, `user_ID`, `email`, `student_no`, `fname`, `lname`, `bday`, `gender`, `coverphoto`, `profilepicture`, `created_at`, `updated_at`, `user_password`, `is_setup_complete`) VALUES
(3, '::1', '@test91', 'tmc.test@cvsu.edu.ph', '2022-100-0349', 'A', 'A', '2024-08-10', 'prefered-not-to-say', 'default_coverphoto.jpg', 'FB_IMG_1715253475717.jpg', '2024-07-24 01:12:33', '2024-08-10 00:29:23', '$2y$10$n37x9A2H9vukaGeMNnvMaulCD9ITXIXGWePQDUwkCYeAqiQS9QvZW', 0),
(4, '::1', '@b360', 'tmc.test2@cvsu.edu.ph', '2023-100-0349', 'B', 'B', '2024-07-05', 'Female', 'james-sullivan-x8l63IUeuwQ-unsplash.jpg', 'FB_IMG_1658182051384.jpg', '2024-07-24 07:43:49', '2024-08-09 14:54:58', '$2y$10$VrqB3dKisDYexxK7KGraQuelhI8Pq.3JjcbLC/K/1jZTFdQPql0l.', 0),
(19, '::1', '@john_paul171', 'tmc.test3@cvsu.edu.ph', '2024-100-0349', 'John Paul', 'Naag', '2002-06-12', 'Non-binary', 'FB_IMG_1723013803126.jpg', 'images (31).jpeg', '2024-08-09 08:47:41', '2024-08-09 14:51:33', '$2y$10$rdU5S9C1jFOvFfnDQLoG9upAWbHtjsp7Zf3dp8UOjhZ47ZtBmOXuG', 0),
(32, '::1', '@user698', 'tmc.test4@cvsu.edu.ph', '2025-100-0349', 'User', 'User', '2024-08-15', 'Female', '', '', '2024-08-11 00:16:25', '2024-08-11 00:16:25', '$2y$10$dq9mMdHCUWwA0lo7B1UUI.PgxYgJf4saipoXr9QLb6GZjROxZky3C', 0),
(33, '::1', '@q88', 'tmc.test5@cvsu.edu.ph', '2026-100-0349', 'Q', 'Q', '2024-07-31', 'Male', '', '', '2024-08-11 02:07:41', '2024-08-11 02:07:41', '$2y$10$xUBtlutGqZuDZkdbOkLiqOUxdtniWoGZ3Wuftf5oHXzbvLg9.waMa', 0),
(34, '::1', '@c276', 'tmc.test6@cvsu.edu.ph', '2027-100-0349', 'C', 'C', '2024-08-15', 'Male', '', '', '2024-08-11 02:08:13', '2024-08-11 02:08:13', '$2y$10$zJAL.iDhAReDh.D23mBsZulwxSzPui00i6eRVZ5yVkJf5SDzrL4vi', 0),
(35, '::1', '@c437', 'tmc.test7@cvsu.edu.ph', '2028-100-0349', 'C', 'C', '2024-08-15', 'Female', '', '', '2024-08-11 02:10:01', '2024-08-11 02:10:01', '$2y$10$02i5l6nocBtEfgO4Pl4Oiu4VsnunGPqF29pL1QzHQT7kNCFeh4K9C', 0),
(36, '::1', '@c713', 'tmc.test9@cvsu.edu.ph', '2029-100-0349', 'C', 'C', '2024-08-01', 'Female', '', '', '2024-08-11 02:10:24', '2024-08-11 02:10:24', '$2y$10$vFNvQ0XvxaFxGIEuJNNnAe3Rch7X2wVmMvTj5vpuIwrSxFdlng/9C', 0),
(37, '::1', '@c932', 'tmc.test10@cvsu.edu.ph', '2010-100-0349', 'C', 'C', '2024-08-08', 'Female', '', '', '2024-08-11 02:10:39', '2024-08-11 02:10:39', '$2y$10$CJjEhSJxAQPLuat1m79Z0u9svebSZBGJ5bA5qERuAl5RoKvkQRu.e', 0),
(38, '::1', '@c945', 'tmc.test11@cvsu.edu.ph', '2011-100-0349', 'C', 'C', '2024-08-14', 'other', '', '', '2024-08-11 02:10:58', '2024-08-11 02:10:58', '$2y$10$EMPLIzcoko0sTRS7zEIsFOroDBoONqckj/Urtwu8g94AdCJPWcNXG', 0),
(39, '::1', '@v379', 'tmc.test12@cvsu.edu.ph', '2012-100-0349', 'V', 'V', '2024-08-07', 'other', '', '', '2024-08-11 02:11:13', '2024-08-11 02:11:13', '$2y$10$iHTCyToX.BPZImvdWXKVw.76OnQ/lrUNfjhhZTz6wax8lc6Vkq3ka', 0);

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
  ADD KEY `user_no` (`user_no`),
  ADD KEY `post_reports_ibfk_3` (`reporter_user_no`);

--
-- Indexes for table `saves`
--
ALTER TABLE `saves`
  ADD PRIMARY KEY (`save_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
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
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `saves`
--
ALTER TABLE `saves`
  MODIFY `save_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `share_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  ADD CONSTRAINT `post_reports_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`),
  ADD CONSTRAINT `post_reports_ibfk_3` FOREIGN KEY (`reporter_user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `saves`
--
ALTER TABLE `saves`
  ADD CONSTRAINT `saves_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `saves_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

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
