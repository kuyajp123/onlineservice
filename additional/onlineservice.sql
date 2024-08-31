-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 02:35 PM
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

--
-- Dumping data for table `active_ban`
--

INSERT INTO `active_ban` (`active_ban_id`, `ban_id`, `user_no`, `ban_appeal_id`, `ban_level`, `ban_start_date`, `ban_end_date`) VALUES
(10, 103, 55, 393236, 2, '2024-08-30', '2024-09-29');

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

--
-- Dumping data for table `active_warning`
--

INSERT INTO `active_warning` (`active_warning_id`, `warning_id`, `user_no`, `warn_appeal_id`, `warning_level`, `issue_date`, `reset_date`) VALUES
(20, 189, 71, 362659, 1, '2024-08-30', '2024-09-14'),
(21, 191, 50, 196426, 2, '2024-08-31', '2024-09-15');

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

--
-- Dumping data for table `appeal`
--

INSERT INTO `appeal` (`appeal_id`, `user_no`, `fname`, `lname`, `email`, `student_no`, `appeal_no`, `appeal_message`, `user_ban_no`, `user_warning_no`, `timeStamp`) VALUES
(12, 55, 'A', 'A', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 232342, 'ASDFASDFASDF', 55, NULL, '2024-08-29 23:49:19'),
(13, 50, 'John Paul', 'Naag', 'tmc.johnpaul.naag@cvsu.edu.ph', '2022-100-0349', 261164, 'sorry pu', 50, 50, '2024-08-29 23:53:41'),
(14, 50, 'John Paul', 'Naag', 'tmc.johnpaul.naag@cvsu.edu.ph', '2022-100-0349', 261164, 'bat ako na ba?', 50, 50, '2024-08-30 00:01:31'),
(15, 50, 'John Paul', 'Naag', 'tmc.johnpaul.naag@cvsu.edu.ph', '2022-100-0349', 261164, 'tama ba?', 50, 50, '2024-08-30 00:12:09'),
(16, 55, 'A', 'A', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 946565, 'ako to si aaaaaa', 55, NULL, '2024-08-30 01:07:12'),
(17, 71, 'B', 'B', 'tmc.test2@cvsu.edu.ph', '2022-100-0342', 362659, 'nyahahahahaa', NULL, 71, '2024-08-30 01:09:56');

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
(23, 49, 50, 'ssd', '2024-08-25 02:49:10'),
(29, 53, 50, 'a', '2024-08-27 13:44:03'),
(30, 54, 50, 'qwe', '2024-08-27 13:44:10'),
(31, 64, 50, 'asdfasfsdfsdf', '2024-08-28 13:40:33'),
(32, 67, 50, 'comment', '2024-08-28 14:12:12'),
(33, 67, 50, 'ljkhlkj', '2024-08-28 14:12:36'),
(34, 67, 50, 'hello', '2024-08-28 15:32:12');

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
(145, 50, 50, '', '2024-08-27 13:44:14'),
(147, 64, 50, '', '2024-08-28 13:40:30'),
(150, 66, 50, '', '2024-08-28 14:11:30'),
(152, 67, 50, '', '2024-08-28 15:32:03'),
(154, 68, 55, '', '2024-08-29 00:13:56'),
(157, 70, 71, '', '2024-08-30 01:08:18'),
(158, 70, 50, '', '2024-08-30 01:08:38'),
(159, 65, 50, '', '2024-08-30 03:54:22'),
(160, 54, 50, '', '2024-08-30 03:54:25'),
(162, 67, 71, '', '2024-08-30 06:10:36');

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
(470, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>881873</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 30, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 30, 2024<br>\r\n            Ban End Date: September 6, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 881873.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 22:44:39', 1),
(471, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>261164</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 30, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 30, 2024<br>\r\n            Ban End Date: September 29, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 261164.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 22:49:21', 1),
(472, 55, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear A A,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>796167</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 30, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 30, 2024<br>\r\n            Ban End Date: September 29, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 796167.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 23:41:11', 0),
(473, 55, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear A A,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>946565</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 30, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 3<br>\r\n            Ban Start Date: August 30, 2024<br>\r\n            Ban End Date: Permanent ban<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 946565.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 23:41:43', 0),
(474, 71, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'images (31).jpeg', 'post ko', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear B B,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>362659</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 30, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Misleading or scam<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 362659 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-30 01:09:05', 1),
(475, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>328009</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 30, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Offensive<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 328009 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-30 01:48:23', 1),
(476, 71, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear B B,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>705593</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 30, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 30, 2024<br>\r\n            Ban End Date: September 29, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 705593.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-30 01:55:43', 1),
(477, 55, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear A A,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>393236</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 30, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 30, 2024<br>\r\n            Ban End Date: September 29, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 393236.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-30 03:18:35', 0),
(478, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Welcome to mobile legends', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>958639</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 30, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Misleading or scam<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 958639 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-31 07:49:03', 1),
(479, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Welcome to mobile legends', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>196426</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 30, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Misleading or scam<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 196426 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-31 07:49:11', 1),
(480, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>429845</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 31, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 31, 2024<br>\r\n            Ban End Date: September 30, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 429845.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-31 12:31:23', 1);

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

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `user_no`, `question`, `created_at`) VALUES
(12, 50, 'test poll', '2024-08-31 14:40:57'),
(13, 50, 'test 2 w image', '2024-08-31 14:41:35'),
(14, 71, 'poll ni B', '2024-08-31 19:38:56'),
(15, 50, 'try', '2024-08-31 20:25:42');

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

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`options_id`, `poll_id`, `option_text`, `image_path`) VALUES
(34, 12, 'option 1 without img', ''),
(35, 12, 'option 2 without img', ''),
(36, 13, 'image 1', 'users/user_operation/uploads/66d2bb1f4f8e3.jpg'),
(37, 13, 'image 2', 'users/user_operation/uploads/66d2bb1f50c9e.jpg'),
(38, 14, 'qwer', ''),
(39, 14, 'qwer', 'users/user_operation/uploads/66d300d0d734f.jpg'),
(40, 15, 'try', ''),
(41, 15, 'try', ''),
(42, 15, 'try', ''),
(43, 15, 'try', '');

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

--
-- Dumping data for table `poll_votes`
--

INSERT INTO `poll_votes` (`vote_id`, `poll_id`, `user_no`, `options_id`, `voted_at`) VALUES
(1, 14, 50, 39, '2024-08-31 12:03:36'),
(2, 13, 50, 37, '2024-08-31 12:12:45'),
(3, 14, 71, 39, '2024-08-31 12:15:11'),
(4, 12, 71, 34, '2024-08-31 12:16:25'),
(5, 13, 71, 37, '2024-08-31 12:17:11'),
(6, 12, 50, 34, '2024-08-31 12:25:20'),
(7, 15, 50, 43, '2024-08-31 12:25:50');

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
(54, 50, 'bothrelati', 'bothservic', 'asdf', '', '2024-08-23 14:33:02'),
(63, 71, 'bothrelati', 'bothservic', 'post check ni b', '', '2024-08-28 07:36:56'),
(64, 50, 'bothrelati', 'bothservic', 'qasdfasdfasdf', '', '2024-08-28 13:40:16'),
(65, 50, 'bothrelati', 'bothservic', 'asdfasd', '455035978_1190565572278382_8186029215283454446_n.jpg', '2024-08-28 13:40:42'),
(66, 50, 'bothrelati', 'bothservic', 'caption', '', '2024-08-28 14:10:37'),
(67, 50, 'bothrelati', 'bothservic', 'caption w pic', '450310159_476483778674351_1146708106100650755_n.jpg', '2024-08-28 14:11:16'),
(68, 55, 'bothrelati', 'bothservic', 'asd', '', '2024-08-29 00:00:03'),
(69, 55, 'bothrelati', 'bothservic', 'asdadsdasd', '', '2024-08-29 00:00:31'),
(70, 71, 'bothrelati', 'bothservic', 'post ko', 'images (31).jpeg', '2024-08-30 01:08:17');

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
(64, 67, 50, 55, 'Violence', '2024-08-29 10:58:39'),
(65, 69, 55, 71, 'False news', '2024-08-29 23:40:03'),
(66, 67, 50, 71, 'Offensive', '2024-08-29 23:40:10'),
(67, 53, 55, 71, 'Prohibited content', '2024-08-29 23:40:19'),
(68, 39, 50, 55, 'Misleading or scam', '2024-08-29 23:40:36'),
(69, 51, 50, 55, 'Violence', '2024-08-29 23:40:42'),
(70, 70, 71, 50, 'Misleading or scam', '2024-08-30 01:08:43'),
(71, 70, 71, 50, 'Pretending to be someone else', '2024-08-30 06:05:15');

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
(93, 50, 369210, 1, '2024-08-29', '2024-09-05'),
(94, 50, 786910, 2, '2024-08-29', '2024-09-28'),
(95, 50, 861847, 2, '2024-08-29', '2024-09-28'),
(96, 50, 836947, 3, '2024-08-29', NULL),
(97, 50, 994361, 1, '2024-08-29', '2024-09-05'),
(98, 50, 881873, 1, '2024-08-30', '2024-09-06'),
(99, 50, 261164, 2, '2024-08-30', '2024-09-29'),
(100, 55, 796167, 2, '2024-08-30', '2024-09-29'),
(101, 55, 946565, 3, '2024-08-30', NULL),
(102, 71, 705593, 2, '2024-08-30', '2024-09-29'),
(103, 55, 393236, 2, '2024-08-30', '2024-09-29'),
(104, 50, 429845, 2, '2024-08-31', '2024-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `user_info_visibility`
--

CREATE TABLE `user_info_visibility` (
  `user_no` int(11) NOT NULL,
  `info_name` varchar(50) NOT NULL,
  `is_hidden` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info_visibility`
--

INSERT INTO `user_info_visibility` (`user_no`, `info_name`, `is_hidden`) VALUES
(50, 'bday', 1),
(50, 'gender', 1),
(55, 'bday', 1),
(55, 'gender', 1);

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
(50, '::1', '@qasdfasd311', 'tmc.johnpaul.naag@cvsu.edu.ph', '2022-100-0349', 'John Paul', 'Naag', '2024-08-15', 'prefered-not-to-say', 'default_coverphoto.jpg', 'download.jpg', '2024-08-20 14:22:45', '2024-08-31 11:02:08', '$2y$10$u3x5GLV7hnj17EbT31VF9eHkqagcSB25rsNWnGDiqRjegU/ucagNS'),
(55, '::1', '@a901', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 'A', 'A', '2024-08-14', 'Male', 'default_coverphoto.jpg', 'profile.jpg', '2024-08-21 11:38:53', '2024-08-29 00:53:41', '$2y$10$Y1cbdFPL3NZInFy1JowIPeJ5TkeBYClOCr14g/2w8H72d1E3/fjdC'),
(71, '::1', '@b863', 'tmc.test2@cvsu.edu.ph', '2022-100-0342', 'B', 'B', '2024-08-13', 'other', 'default_coverphoto.jpg', 'profile.jpg', '2024-08-28 07:36:44', '2024-08-28 07:36:44', '$2y$10$3tjbxGe2emjFPoEuvvogIOSc0Qf4OM/rJUPYMwPnFg0oe1B7mo.Xu');

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
(185, 50, 422008, 1, '2024-08-29', '2024-09-13'),
(186, 50, 569352, 2, '2024-08-29', '2024-09-13'),
(187, 50, 919861, 3, '2024-08-29', '2024-09-13'),
(188, 50, 317977, 1, '2024-08-29', '2024-09-13'),
(189, 71, 362659, 1, '2024-08-30', '2024-09-14'),
(190, 50, 328009, 2, '2024-08-30', '2024-09-14'),
(191, 50, 958639, 1, '2024-08-31', '2024-09-15'),
(192, 50, 196426, 2, '2024-08-31', '2024-09-15');

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
  ADD KEY `fk_comments_user_no` (`user_no`);

--
-- Indexes for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  ADD PRIMARY KEY (`reaction_id`),
  ADD KEY `fk_heart_reactions_post_id` (`post_id`),
  ADD KEY `fk_heart_reactions_user_no` (`user_no`);

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
  MODIFY `active_ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `active_warning`
--
ALTER TABLE `active_warning`
  MODIFY `active_warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appeal`
--
ALTER TABLE `appeal`
  MODIFY `appeal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `options_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user_warnings`
--
ALTER TABLE `user_warnings`
  MODIFY `warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

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
  ADD CONSTRAINT `fk_comments_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_user_no` FOREIGN KEY (`user_no`) REFERENCES `user_registration` (`user_no`) ON DELETE CASCADE;

--
-- Constraints for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
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
  ADD CONSTRAINT `notifications_ibfk_8` FOREIGN KEY (`warning_user_no`) REFERENCES `user_warnings` (`user_no`) ON DELETE CASCADE;

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
