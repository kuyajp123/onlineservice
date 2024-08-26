-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 12:34 PM
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
  `user_warning_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appeal`
--

INSERT INTO `appeal` (`appeal_id`, `user_no`, `fname`, `lname`, `email`, `student_no`, `appeal_no`, `appeal_message`, `user_ban_no`, `user_warning_no`) VALUES
(4, 50, 'John Paul', 'Naag', 'tmc.johnpaul.naag@cvsu.edu.ph', '2022-100-0349', 123, 'asdsad', NULL, 50),
(5, 55, 'A', 'A', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 801007, 'asd', 55, NULL),
(6, 55, 'A', 'A', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 801007, 'asd', 55, NULL),
(7, 55, 'A', 'A', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 212, 'asd', 55, NULL);

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
(17, 45, 50, 'test', '2024-08-23 12:02:19'),
(18, 39, 50, 'test', '2024-08-23 12:02:25'),
(19, 47, 50, 'test', '2024-08-23 12:02:33'),
(20, 45, 50, 'Hi', '2024-08-24 07:54:03'),
(21, 53, 50, 'Ikaw yan?', '2024-08-24 08:35:06'),
(22, 53, 55, 'comment', '2024-08-24 14:42:22'),
(23, 49, 50, 'ssd', '2024-08-25 02:49:10');

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
(117, 39, 55, '', '2024-08-23 11:58:05'),
(118, 45, 55, '', '2024-08-23 11:58:06'),
(119, 46, 55, '', '2024-08-23 11:58:08'),
(120, 39, 50, '', '2024-08-23 12:02:14'),
(121, 45, 50, '', '2024-08-23 12:02:15'),
(122, 53, 55, '', '2024-08-23 13:15:03'),
(123, 52, 55, '', '2024-08-23 13:15:05'),
(124, 52, 50, '', '2024-08-24 07:53:11'),
(129, 51, 55, '', '2024-08-24 14:42:28'),
(134, 53, 50, '', '2024-08-25 02:36:47'),
(136, 51, 50, '', '2024-08-25 02:49:01'),
(137, 54, 55, '', '2024-08-25 03:04:03'),
(138, 54, 50, '', '2024-08-25 13:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_no` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `comment_user_no` int(11) DEFAULT NULL,
  `reaction_user_no` int(11) DEFAULT NULL,
  `post_user_no` int(11) DEFAULT NULL,
  `post_reports_user_no` int(11) DEFAULT NULL,
  `ban_user_no` int(11) DEFAULT NULL,
  `warning_user_no` int(11) DEFAULT NULL,
  `notification_photo` varchar(255) DEFAULT NULL,
  `notification_caption` varchar(255) DEFAULT NULL,
  `notification_type` enum('warning','ban','reaction','comment') DEFAULT NULL,
  `notification_text` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_opened` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_no`, `admin_id`, `comment_user_no`, `reaction_user_no`, `post_user_no`, `post_reports_user_no`, `ban_user_no`, `warning_user_no`, `notification_photo`, `notification_caption`, `notification_type`, `notification_text`, `timestamp`, `is_opened`) VALUES
(329, 55, 1, NULL, NULL, NULL, NULL, NULL, NULL, '0wzknw7460n31.jpg', 'sup', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear A A,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>444724</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 21, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: False news<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 444724 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-25 11:27:14', 0),
(330, 55, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear A A,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>801007</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 25, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 25, 2024<br>\r\n            Ban End Date: September 1, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 801007.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-25 11:27:18', 0),
(331, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Screenshot 2024-08-22 214241.png', '', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>958541</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 23, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Other<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 958541 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-25 11:27:32', 1),
(332, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>343644</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 25, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 25, 2024<br>\r\n            Ban End Date: September 24, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 343644.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-25 11:27:37', 1),
(333, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Screenshot 2024-08-22 214241.png', '', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>796104</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 23, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Other<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 796104 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-25 13:37:22', 1);

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
(39, 50, 'bothrelati', 'bothservic', 'Welcome to mobile legends', '', '2024-08-20 14:50:21'),
(45, 55, 'bothrelati', 'bothservic', 'sup', '0wzknw7460n31.jpg', '2024-08-21 11:40:00'),
(46, 50, 'bothrelati', 'bothservic', '', 'Screenshot 2024-08-22 214241.png', '2024-08-23 02:31:20'),
(47, 55, 'bothrelati', 'bothservic', 'hey', '', '2024-08-23 02:35:46'),
(48, 50, 'bothrelati', 'bothservic', 'qwer', 'Screenshot 2024-08-14 074841.png', '2024-08-23 02:36:58'),
(49, 55, 'bothrelati', 'bothservic', '', '451803876_779136454297409_3907025352395061169_n.jpg', '2024-08-23 02:52:30'),
(50, 55, 'bothrelati', 'bothservic', 'post', '', '2024-08-23 10:28:30'),
(51, 50, 'bothrelati', 'bothservic', '', 'Screenshot 2024-08-02 213541.png', '2024-08-23 10:30:49'),
(52, 50, 'bothrelati', 'bothservic', 'hello\r\n', '', '2024-08-23 12:01:53'),
(53, 55, 'bothrelati', 'bothservic', 'ako to', '215a1d22-7d9d-4f05-87ec-dd5125a7955a.jfif', '2024-08-23 12:05:03'),
(54, 50, 'bothrelati', 'bothservic', 'asdf', '', '2024-08-23 14:33:02');

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
(41, 45, 55, 50, 'False news', '2024-08-21 11:41:11'),
(42, 45, 55, 55, 'Pretending to be someone else', '2024-08-23 02:29:55'),
(43, 48, 50, 55, 'Spam', '2024-08-23 10:25:36'),
(44, 46, 50, 55, 'Other', '2024-08-23 10:28:40'),
(45, 50, 55, 50, 'Violence', '2024-08-23 10:31:02'),
(46, 49, 55, 50, 'False news', '2024-08-23 10:36:24'),
(47, 50, 55, 50, 'Misleading or scam', '2024-08-23 12:01:58'),
(48, 52, 50, 55, 'Misleading or scam', '2024-08-23 12:04:43'),
(49, 51, 50, 55, 'Violence', '2024-08-23 12:05:12'),
(52, 46, 50, 55, 'Pretending to be someone else', '2024-08-24 07:46:12'),
(53, 53, 55, 50, 'False news', '2024-08-24 07:46:56');

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

--
-- Dumping data for table `user_bans`
--

INSERT INTO `user_bans` (`ban_id`, `user_no`, `ban_appeal_id`, `ban_level`, `ban_start_date`, `ban_end_date`) VALUES
(63, 55, 801007, 1, '2024-08-25', '2024-09-01');

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

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_no`, `user_ip`, `user_ID`, `email`, `student_no`, `fname`, `lname`, `bday`, `gender`, `coverphoto`, `profilepicture`, `created_at`, `updated_at`, `user_password`) VALUES
(50, '::1', '@john_paul848', 'tmc.johnpaul.naag@cvsu.edu.ph', '2022-100-0349', 'John Paul', 'Naag', '2024-08-21', 'Male', '', '', '2024-08-20 14:22:45', '2024-08-24 14:24:16', '$2y$10$CoECmi7nRa6mS37cWMGgLuzRnCJ9Uq922TTCiLcmU0N.5zYcVjWbG'),
(55, '::1', '@a901', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 'A', 'A', '2024-08-07', 'Male', 'default_coverphoto.jpg', 'profile.jpg', '2024-08-21 11:38:53', '2024-08-21 11:38:53', '$2y$10$Y1cbdFPL3NZInFy1JowIPeJ5TkeBYClOCr14g/2w8H72d1E3/fjdC');

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
-- Dumping data for table `user_warnings`
--

INSERT INTO `user_warnings` (`warning_id`, `user_no`, `warn_appeal_id`, `warning_level`, `issue_date`, `reset_date`) VALUES
(87, 50, 796104, 1, '2024-08-25', '2024-09-09');

--
-- Indexes for dumped tables
--

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
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `comment_user_no` (`comment_user_no`),
  ADD KEY `reaction_user_no` (`reaction_user_no`),
  ADD KEY `post_user_no` (`post_user_no`),
  ADD KEY `post_reports_user_no` (`post_reports_user_no`),
  ADD KEY `ban_user_no` (`ban_user_no`),
  ADD KEY `warning_user_no` (`warning_user_no`);

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
-- Indexes for table `user_bans`
--
ALTER TABLE `user_bans`
  ADD PRIMARY KEY (`ban_id`),
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
-- Indexes for table `user_warnings`
--
ALTER TABLE `user_warnings`
  ADD PRIMARY KEY (`warning_id`),
  ADD KEY `user_no` (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appeal`
--
ALTER TABLE `appeal`
  MODIFY `appeal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_warnings`
--
ALTER TABLE `user_warnings`
  MODIFY `warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appeal`
--
ALTER TABLE `appeal`
  ADD CONSTRAINT `appeal_ibfk_1` FOREIGN KEY (`user_ban_no`) REFERENCES `user_bans` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `appeal_ibfk_2` FOREIGN KEY (`user_warning_no`) REFERENCES `user_warnings` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_appeal_user_no` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`comment_user_no`) REFERENCES `comments` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`reaction_user_no`) REFERENCES `heart_reactions` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_5` FOREIGN KEY (`post_user_no`) REFERENCES `posts` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_6` FOREIGN KEY (`post_reports_user_no`) REFERENCES `post_reports` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_7` FOREIGN KEY (`ban_user_no`) REFERENCES `user_bans` (`user_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_8` FOREIGN KEY (`warning_user_no`) REFERENCES `user_warnings` (`user_no`) ON DELETE CASCADE;

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
-- Constraints for table `user_bans`
--
ALTER TABLE `user_bans`
  ADD CONSTRAINT `user_bans_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE;

--
-- Constraints for table `user_warnings`
--
ALTER TABLE `user_warnings`
  ADD CONSTRAINT `user_warnings_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
