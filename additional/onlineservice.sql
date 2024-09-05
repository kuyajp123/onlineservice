-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 07:19 PM
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
-- Table structure for table `active_ban`
--

CREATE TABLE `active_ban` (
  `active_ban_id` int(11) NOT NULL,
  `ban_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `ban_appeal_id` int(11) NOT NULL,
  `ban_level` int(11) NOT NULL,
  `ban_start_date` date NOT NULL,
  `ban_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `active_warning`
--

CREATE TABLE `active_warning` (
  `active_warning_id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `warn_appeal_id` int(11) NOT NULL,
  `warning_level` int(11) NOT NULL DEFAULT 1,
  `issue_date` date NOT NULL,
  `reset_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password_hash`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appeal`
--

CREATE TABLE `appeal` (
  `appeal_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `student_no` varchar(13) NOT NULL,
  `appeal_no` int(11) NOT NULL,
  `appeal_message` text DEFAULT NULL,
  `user_ban_no` int(11) DEFAULT NULL,
  `user_warning_no` int(11) DEFAULT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `user_no` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `heart_reactions`
--

CREATE TABLE `heart_reactions` (
  `reaction_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `user_no` int(11) NOT NULL,
  `reaction_type` enum('heart') NOT NULL DEFAULT 'heart',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_no` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_user_no` int(11) DEFAULT NULL,
  `reaction_user_no` int(11) DEFAULT NULL,
  `post_user_no` int(11) DEFAULT NULL,
  `post_reports_user_no` int(11) DEFAULT NULL,
  `ban_user_no` int(11) DEFAULT NULL,
  `warning_user_no` int(11) DEFAULT NULL,
  `notification_photo` varchar(255) DEFAULT NULL,
  `notification_caption` varchar(255) DEFAULT NULL,
  `notification_type` enum('warning','ban','reaction','comment','Post deleted') DEFAULT NULL,
  `notification_text` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_opened` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `poll_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE `poll_options` (
  `options_id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `option_text` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE `poll_votes` (
  `vote_id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `user_no` int(11) DEFAULT NULL,
  `options_id` int(11) DEFAULT NULL,
  `voted_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `user_no` int(11) NOT NULL,
  `reporter_user_no` int(11) NOT NULL,
  `report_reason` varchar(100) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_bans`
--

CREATE TABLE `user_bans` (
  `ban_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `ban_appeal_id` int(11) NOT NULL,
  `ban_level` int(11) NOT NULL,
  `ban_start_date` date NOT NULL,
  `ban_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info_visibility`
--

CREATE TABLE `user_info_visibility` (
  `user_no` int(11) NOT NULL,
  `info_name` varchar(50) NOT NULL,
  `is_hidden` tinyint(1) DEFAULT NULL
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
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_warnings`
--

CREATE TABLE `user_warnings` (
  `warning_id` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `warn_appeal_id` int(11) NOT NULL,
  `warning_level` int(11) NOT NULL DEFAULT 1,
  `issue_date` date NOT NULL,
  `reset_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_ban`
--
ALTER TABLE `active_ban`
  ADD PRIMARY KEY (`active_ban_id`),
  ADD KEY `ban_id` (`ban_id`,`user_no`);

--
-- Indexes for table `active_warning`
--
ALTER TABLE `active_warning`
  ADD PRIMARY KEY (`active_warning_id`),
  ADD KEY `warning_id` (`warning_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appeal`
--
ALTER TABLE `appeal`
  ADD PRIMARY KEY (`appeal_id`),
  ADD KEY `user_ban_no` (`user_ban_no`),
  ADD KEY `user_warning_no` (`user_warning_no`),
  ADD KEY `fk_appeal_user_no` (`user_no`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comments_post_id` (`post_id`),
  ADD KEY `fk_comments_user_no` (`user_no`),
  ADD KEY `fk_comments_poll` (`poll_id`);

--
-- Indexes for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  ADD PRIMARY KEY (`reaction_id`),
  ADD KEY `fk_heart_reactions_post_id` (`post_id`),
  ADD KEY `fk_heart_reactions_user_no` (`user_no`),
  ADD KEY `fk_heart_reactions_poll` (`poll_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_no` (`user_no`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `comment_user_no` (`comment_user_no`),
  ADD KEY `reaction_user_no` (`reaction_user_no`),
  ADD KEY `post_user_no` (`post_user_no`),
  ADD KEY `post_reports_user_no` (`post_reports_user_no`),
  ADD KEY `ban_user_no` (`ban_user_no`),
  ADD KEY `warning_user_no` (`warning_user_no`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`poll_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`options_id`),
  ADD KEY `poll_id` (`poll_id`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `poll_id` (`poll_id`),
  ADD KEY `user_no` (`user_no`),
  ADD KEY `options_id` (`options_id`);

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
  ADD KEY `post_reports_ibfk_3` (`reporter_user_no`),
  ADD KEY `fk_post_reports_poll_id` (`poll_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `fk_user_no` (`user_no`);

--
-- Indexes for table `user_bans`
--
ALTER TABLE `user_bans`
  ADD PRIMARY KEY (`ban_id`),
  ADD UNIQUE KEY `ban_id` (`ban_id`,`user_no`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `user_info_visibility`
--
ALTER TABLE `user_info_visibility`
  ADD PRIMARY KEY (`user_no`,`info_name`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_no`),
  ADD UNIQUE KEY `user_ID` (`user_ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `student_no` (`student_no`);

--
-- Indexes for table `user_warnings`
--
ALTER TABLE `user_warnings`
  ADD PRIMARY KEY (`warning_id`),
  ADD KEY `user_no` (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_ban`
--
ALTER TABLE `active_ban`
  MODIFY `active_ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `active_warning`
--
ALTER TABLE `active_warning`
  MODIFY `active_warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appeal`
--
ALTER TABLE `appeal`
  MODIFY `appeal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `options_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_warnings`
--
ALTER TABLE `user_warnings`
  MODIFY `warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `active_ban`
--
ALTER TABLE `active_ban`
  ADD CONSTRAINT `active_ban_ibfk_1` FOREIGN KEY (`ban_id`,`user_no`) REFERENCES `user_bans` (`ban_id`, `user_no`) ON DELETE CASCADE;

--
-- Constraints for table `active_warning`
--
ALTER TABLE `active_warning`
  ADD CONSTRAINT `active_warning_ibfk_1` FOREIGN KEY (`warning_id`) REFERENCES `user_warnings` (`warning_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `active_warning_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_warnings` (`user_no`) ON DELETE CASCADE;

--
-- Constraints for table `appeal`
--
ALTER TABLE `appeal`
  ADD CONSTRAINT `appeal_ibfk_1` FOREIGN KEY (`user_ban_no`) REFERENCES `user_bans` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `appeal_ibfk_2` FOREIGN KEY (`user_warning_no`) REFERENCES `user_warnings` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_appeal_user_no` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`),
  ADD CONSTRAINT `fk_comments_poll` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_user_no` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE;

--
-- Constraints for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  ADD CONSTRAINT `fk_heart_reactions_poll` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_heart_reactions_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_heart_reactions_user_no` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `heart_reactions_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `heart_reactions_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`comment_user_no`) REFERENCES `comments` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`reaction_user_no`) REFERENCES `heart_reactions` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_5` FOREIGN KEY (`post_user_no`) REFERENCES `posts` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_6` FOREIGN KEY (`post_reports_user_no`) REFERENCES `post_reports` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_7` FOREIGN KEY (`ban_user_no`) REFERENCES `user_bans` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_8` FOREIGN KEY (`warning_user_no`) REFERENCES `user_warnings` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_9` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE;

--
-- Constraints for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD CONSTRAINT `poll_options_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE;

--
-- Constraints for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD CONSTRAINT `poll_votes_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `poll_votes_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `poll_votes_ibfk_3` FOREIGN KEY (`options_id`) REFERENCES `poll_options` (`options_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD CONSTRAINT `fk_post_reports_poll_id` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_reports_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_reports_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`),
  ADD CONSTRAINT `post_reports_ibfk_3` FOREIGN KEY (`reporter_user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_user_no` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_bans`
--
ALTER TABLE `user_bans`
  ADD CONSTRAINT `user_bans_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE;

--
-- Constraints for table `user_info_visibility`
--
ALTER TABLE `user_info_visibility`
  ADD CONSTRAINT `user_info_visibility_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`);

--
-- Constraints for table `user_warnings`
--
ALTER TABLE `user_warnings`
  ADD CONSTRAINT `user_warnings_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
