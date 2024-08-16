-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 01:50 PM
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
(2, 25, 49, 'hi', '2024-08-13 14:15:34'),
(3, 24, 49, 'hi', '2024-08-14 07:22:56'),
(4, 24, 49, 'yow', '2024-08-14 07:23:06');

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
(31, 27, 48, '', '2024-08-15 09:56:51'),
(64, 24, 48, '', '2024-08-15 09:57:19'),
(65, 25, 48, '', '2024-08-15 09:57:22'),
(66, 23, 48, '', '2024-08-15 09:57:25'),
(71, 27, 49, '', '2024-08-15 13:09:57'),
(74, 25, 49, '', '2024-08-15 13:10:03'),
(78, 23, 49, '', '2024-08-15 13:10:08'),
(80, 26, 49, '', '2024-08-15 13:20:02');

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
  `notification_type` enum('warning','ban') DEFAULT NULL,
  `notification_text` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_no`, `admin_id`, `comment_user_no`, `reaction_user_no`, `post_user_no`, `post_reports_user_no`, `ban_user_no`, `warning_user_no`, `notification_photo`, `notification_caption`, `notification_type`, `notification_text`, `timestamp`) VALUES
(35, 49, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Account Suspension Notification\r\n\r\n            Dear A A,\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.\r\n\r\n            <h2>388584</h2>\r\n\r\n            Details of Suspension:\r\n\r\n            Date: August 16, 2024\r\n            Violation Reason: violate community standards\r\n            Ban Level: 1\r\n            Ban Start Date: August 16, 2024\r\n            Ban End Date: August 23, 2024\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and provide the following reference number for further assistance: 388584.\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 08:03:36'),
(36, 48, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'sova.png', 'pang', 'warning', '\r\n            Subject: Warning: Violation of Community Standards\r\n\r\n            Dear John Paul Naag,\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.\r\n\r\n            <h2>505286</h2>\r\n\r\n            Violation Details:\r\n\r\n            Date: August 16, 2024\r\n            Description: Multiple report counts\r\n            Community Standard Violated: Prohibited content\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and indicate this reference number: 505286 within the next 7 days.\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram Team\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 08:20:28'),
(37, 49, 1, NULL, NULL, NULL, NULL, NULL, NULL, '5a91e8359f415e730c4ed61965ce7023.jpg', 'qwer', 'warning', '\r\n            Subject: Warning: Violation of Community Standards\r\n\r\n            Dear A A,\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.\r\n\r\n            <h2>529135</h2>\r\n\r\n            Violation Details:\r\n\r\n            Date: August 14, 2024\r\n            Description: Multiple report counts\r\n            Community Standard Violated: Other\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and indicate this reference number: 529135 within the next 7 days.\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram Team\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 10:11:10'),
(38, 49, 1, NULL, NULL, NULL, NULL, NULL, NULL, '5a91e8359f415e730c4ed61965ce7023.jpg', 'qwer', 'warning', '\r\n            Subject: Warning: Violation of Community Standards\r\n\r\n            Dear A A,\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.\r\n\r\n            <h2>173339</h2>\r\n\r\n            Violation Details:\r\n\r\n            Date: August 14, 2024\r\n            Description: Multiple report counts\r\n            Community Standard Violated: Other\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and indicate this reference number: 173339 within the next 7 days.\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram Team\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 11:07:58'),
(39, 49, 1, NULL, NULL, NULL, NULL, NULL, NULL, '5a91e8359f415e730c4ed61965ce7023.jpg', 'qwer', 'warning', '\r\n            Subject: Warning: Violation of Community Standards\r\n\r\n            Dear A A,\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.\r\n\r\n            <h2>246579</h2>\r\n\r\n            Violation Details:\r\n\r\n            Date: August 14, 2024\r\n            Description: Multiple report counts\r\n            Community Standard Violated: Other\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and indicate this reference number: 246579 within the next 7 days.\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram Team\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 11:30:28'),
(40, 49, 1, NULL, NULL, NULL, NULL, NULL, NULL, '5a91e8359f415e730c4ed61965ce7023.jpg', 'qwer', 'warning', '\r\n            Subject: Warning: Violation of Community Standards\r\n\r\n            Dear A A,\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.\r\n\r\n            <h2>928629</h2>\r\n\r\n            Violation Details:\r\n\r\n            Date: August 14, 2024\r\n            Description: Multiple report counts\r\n            Community Standard Violated: Other\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and indicate this reference number: 928629 within the next 7 days.\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram Team\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 11:32:00'),
(41, 49, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Cavite_State_University_(CvSU).png', '', 'warning', '\r\n            Subject: Warning: Violation of Community Standards\r\n\r\n            Dear A A,\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.\r\n\r\n            <h2>575852</h2>\r\n\r\n            Violation Details:\r\n\r\n            Date: August 13, 2024\r\n            Description: Multiple report counts\r\n            Community Standard Violated: Pretending to be someone else\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and indicate this reference number: 575852 within the next 7 days.\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram Team\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 11:40:13'),
(42, 49, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Account Suspension Notification\r\n\r\n            Dear A A,\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.\r\n\r\n            <h2>784457</h2>\r\n\r\n            Details of Suspension:\r\n\r\n            Date: August 16, 2024\r\n            Violation Reason: violate community standards\r\n            Ban Level: 2\r\n            Ban Start Date: August 16, 2024\r\n            Ban End Date: September 15, 2024\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and provide the following reference number for further assistance: 784457.\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 11:42:02'),
(43, 49, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Cavite_State_University_(CvSU).png', '', 'warning', '\r\n            Subject: Warning: Violation of Community Standards\r\n\r\n            Dear A A,\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.\r\n\r\n            <h2>223883</h2>\r\n\r\n            Violation Details:\r\n\r\n            Date: August 14, 2024\r\n            Description: Multiple report counts\r\n            Community Standard Violated: Violence\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\">Contact us</a> and indicate this reference number: 223883 within the next 7 days.\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.\r\n\r\n            Thank you for your attention to this matter.\r\n\r\n            Best regards,\r\n            CvSTagram Team\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\">Visit our Facebook page</a>\r\n            ', '2024-08-16 11:42:39');

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
(25, 49, 'bothrelati', 'bothservic', '', 'Cavite_State_University_(CvSU).png', '2024-08-13 11:14:39'),
(26, 48, 'bothrelati', 'bothservic', 'pang', 'sova.png', '2024-08-15 09:56:09'),
(27, 48, 'bothrelati', 'bothservic', 'qwer', '', '2024-08-15 09:56:49');

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
(22, 23, 48, 49, 'Other', '2024-08-14 03:16:12'),
(23, 24, 49, 48, 'Other', '2024-08-14 07:26:26'),
(24, 26, 48, 49, 'Prohibited content', '2024-08-16 04:30:47');

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
(48, '192.168.100.5', '@john_paul206', 'tmc.test2@cvsu.edu.ph', '2022-100-0349', 'John Paul', 'Naag', '2024-08-13', 'prefered-not-to-say', 'default_coverphoto.jpg', 'IMG_20230313_190514.jpg', '2024-08-12 15:30:04', '2024-08-14 07:28:47', '$2y$10$WI8U3eFCMvKvhVScEiOeq.s2hcqNRwLF5R//ERrsKn9N9kJUJ165G', 0),
(49, '::1', '@a900', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 'A', 'A', '2024-08-08', 'Female', '', 'profile.jpg', '2024-08-13 11:02:55', '2024-08-14 07:23:18', '$2y$10$Vk7EzS8cORaYUDBpkZS.OuuXiLORZJHoHrGiNC50GXhk0nbm3S5LW', 0);

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_warnings`
--
ALTER TABLE `user_warnings`
  MODIFY `warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
