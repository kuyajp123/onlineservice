-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 04:41 PM
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

--
-- Dumping data for table `active_warning`
--

INSERT INTO `active_warning` (`active_warning_id`, `warning_id`, `user_no`, `warn_appeal_id`, `warning_level`, `issue_date`, `reset_date`) VALUES
(19, 188, 50, 317977, 1, '2024-08-29', '2024-09-13');

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
(138, 54, 50, '', '2024-08-25 13:49:42'),
(145, 50, 50, '', '2024-08-27 13:44:14'),
(147, 64, 50, '', '2024-08-28 13:40:30'),
(148, 65, 50, '', '2024-08-28 13:40:46'),
(150, 66, 50, '', '2024-08-28 14:11:30'),
(152, 67, 50, '', '2024-08-28 15:32:03'),
(154, 68, 55, '', '2024-08-29 00:13:56');

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
(425, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>310212</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 310212 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 10:59:55', 0),
(426, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>406368</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 406368 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:00:41', 0),
(427, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>528980</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 528980 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:02:36', 0),
(428, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>976976</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 976976 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:03:04', 0),
(429, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>895592</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 895592 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:10:56', 0),
(430, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>701963</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 701963 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:11:44', 0),
(431, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>591617</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 591617 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:12:26', 0),
(432, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>719685</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 719685 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:17:23', 0),
(433, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>156544</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 156544 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:17:40', 0),
(434, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>717745</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 717745 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:25:16', 0),
(435, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>381505</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 381505 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:25:38', 0),
(436, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>318203</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 318203 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:25:59', 0),
(437, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>705875</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 705875 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:26:30', 0),
(438, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>698678</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 698678 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:30:13', 0),
(439, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>208970</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 208970 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:30:27', 0),
(440, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>203539</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 203539 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:33:39', 0),
(441, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>346078</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 346078 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 11:34:09', 0),
(442, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>664787</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 5, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 664787.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:23:38', 0),
(443, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>557402</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 557402.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:24:04', 0),
(444, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>893306</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 3<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: Permanent ban<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 893306.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:24:15', 0),
(445, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>624023</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 5, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 624023.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:24:26', 0),
(446, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>422008</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 422008 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:28:32', 0),
(447, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>569352</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 569352 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:28:50', 0),
(448, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>919861</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 919861 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:29:13', 0);
INSERT INTO `notifications` (`notification_id`, `user_no`, `admin_id`, `comment_user_no`, `reaction_user_no`, `post_user_no`, `post_reports_user_no`, `ban_user_no`, `warning_user_no`, `notification_photo`, `notification_caption`, `notification_type`, `notification_text`, `timestamp`, `is_opened`) VALUES
(449, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>317977</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 29, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Violence<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and indicate this reference number: 317977 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:29:37', 0),
(450, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>573371</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 573371.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:34:34', 0),
(451, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>589752</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 5, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 589752.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:43:37', 0),
(452, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>104059</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 3<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: Permanent ban<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 104059.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 13:45:24', 0),
(453, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>138034</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 138034.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:19:49', 0),
(454, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>271915</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 3<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: Permanent ban<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 271915.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:20:18', 0),
(455, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>812750</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 812750.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:21:25', 0),
(456, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>490428</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 490428.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:23:29', 0),
(457, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n                Subject: Violation of Community Standards<br><br>\r\n\r\n                Dear JOHN PAUL NAAG,<br><br>\r\n\r\n                We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n                <h2>301745</h2>\r\n\r\n                Details of Suspension:<br><br>\r\n\r\n                Date: August 29, 2024<br>\r\n                Violation Reason: Violate community standards<br>\r\n                Ban Level: 2<br>\r\n                Ban Start Date: August 29, 2024<br>\r\n                Ban End Date: September 28, 2024<br><br>\r\n\r\n                We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 301745.<br><br>\r\n\r\n                Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n                Thank you for your attention to this matter.<br><br>\r\n\r\n                Best regards,<br>\r\n                CvSTagram<br>\r\n                <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n                ', '2024-08-29 14:27:01', 0),
(458, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n                Subject: Violation of Community Standards<br><br>\r\n\r\n                Dear JOHN PAUL NAAG,<br><br>\r\n\r\n                We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n                <h2>282679</h2>\r\n\r\n                Details of Suspension:<br><br>\r\n\r\n                Date: August 29, 2024<br>\r\n                Violation Reason: Violate community standards<br>\r\n                Ban Level: 1<br>\r\n                Ban Start Date: August 29, 2024<br>\r\n                Ban End Date: September 5, 2024<br><br>\r\n\r\n                We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 282679.<br><br>\r\n\r\n                Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n                Thank you for your attention to this matter.<br><br>\r\n\r\n                Best regards,<br>\r\n                CvSTagram<br>\r\n                <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n                ', '2024-08-29 14:27:15', 0),
(459, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>780733</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 5, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 780733.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:30:21', 0),
(460, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>813152</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 813152.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:30:35', 0),
(461, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>515992</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 515992.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:30:48', 0),
(462, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>312639</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 3<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: Permanent ban<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 312639.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:31:08', 0),
(463, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>331525</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 5, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 331525.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:31:19', 0),
(464, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>736089</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 736089.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:31:32', 0),
(465, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>369210</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 5, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 369210.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:32:35', 0),
(466, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>786910</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 786910.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:32:58', 0),
(467, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>861847</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 2<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 28, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 861847.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:34:32', 0),
(468, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>836947</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 3<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: Permanent ban<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 836947.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:34:59', 0),
(469, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>994361</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: August 29, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: August 29, 2024<br>\r\n            Ban End Date: September 5, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Contact us</a> and provide the following reference number for further assistance: 994361.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\' style=\'text-decoration: underline; color:#0000EE;\'>Visit our Facebook page</a><br>\r\n            ', '2024-08-29 14:35:42', 0);

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
(69, 55, 'bothrelati', 'bothservic', 'asdadsdasd', '', '2024-08-29 00:00:31');

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
(64, 67, 50, 55, 'Violence', '2024-08-29 10:58:39');

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
(97, 50, 994361, 1, '2024-08-29', '2024-09-05');

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
(50, '::1', '@qasdfasd311', 'tmc.johnpaul.naag@cvsu.edu.ph', '2022-100-0349', 'John Paul', 'Naag', '2024-08-15', 'prefered-not-to-say', 'default_coverphoto.jpg', 'profile.jpg', '2024-08-20 14:22:45', '2024-08-28 15:24:39', '$2y$10$u3x5GLV7hnj17EbT31VF9eHkqagcSB25rsNWnGDiqRjegU/ucagNS'),
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
(188, 50, 317977, 1, '2024-08-29', '2024-09-13');

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
  MODIFY `active_ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `active_warning`
--
ALTER TABLE `active_warning`
  MODIFY `active_warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appeal`
--
ALTER TABLE `appeal`
  MODIFY `appeal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user_warnings`
--
ALTER TABLE `user_warnings`
  MODIFY `warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

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
