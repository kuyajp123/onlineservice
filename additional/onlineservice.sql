-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 05:11 PM
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
(16, 109, 55, 689755, 1, '2024-09-03', '2024-09-10');

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
(25, 196, 55, 391605, 2, '2024-09-03', '2024-09-18'),
(26, 202, 50, 619023, 4, '2024-09-03', '2024-09-18'),
(27, 206, 71, 354187, 1, '2024-09-03', '2024-09-18');

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
(17, 71, 'B', 'B', 'tmc.test2@cvsu.edu.ph', '2022-100-0342', 362659, 'nyahahahahaa', NULL, 71, '2024-08-30 01:09:56'),
(18, 73, 'Juan', 'Carlos', 'tmc.test3@cvsu.edu.ph', '0347-283-3432', 759672, 'sorry po', 73, 73, '2024-09-03 12:56:11');

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `poll_id`, `user_no`, `comment_text`, `timestamp`) VALUES
(17, 45, NULL, 50, 'test', '2024-08-23 12:02:19'),
(18, 39, NULL, 50, 'test', '2024-08-23 12:02:25'),
(19, 47, NULL, 50, 'test', '2024-08-23 12:02:33'),
(20, 45, NULL, 50, 'Hi', '2024-08-24 07:54:03'),
(21, 53, NULL, 50, 'Ikaw yan?', '2024-08-24 08:35:06'),
(22, 53, NULL, 55, 'comment', '2024-08-24 14:42:22'),
(23, 49, NULL, 50, 'ssd', '2024-08-25 02:49:10'),
(29, 53, NULL, 50, 'a', '2024-08-27 13:44:03'),
(30, 54, NULL, 50, 'qwe', '2024-08-27 13:44:10'),
(31, 64, NULL, 50, 'asdfasfsdfsdf', '2024-08-28 13:40:33'),
(32, 67, NULL, 50, 'comment', '2024-08-28 14:12:12'),
(33, 67, NULL, 50, 'ljkhlkj', '2024-08-28 14:12:36'),
(34, 67, NULL, 50, 'hello', '2024-08-28 15:32:12'),
(35, 70, NULL, 50, 'qwer', '2024-09-01 00:59:59'),
(36, 66, NULL, 50, 'safsdf', '2024-09-01 03:18:57'),
(37, NULL, 15, 50, 'hi', '2024-09-01 03:20:12'),
(38, 67, NULL, 50, 'low', '2024-09-01 03:20:28'),
(39, NULL, 12, 50, 'asdasd', '2024-09-01 10:02:06'),
(40, 71, NULL, 50, 'aasd', '2024-09-01 16:54:09'),
(41, 51, NULL, 50, 'j;pk', '2024-09-01 17:39:07'),
(42, 48, NULL, 50, '123', '2024-09-01 17:39:24'),
(44, NULL, 18, 73, 'sdfsdfsd', '2024-09-03 13:16:25'),
(45, NULL, 18, 73, 'sssss', '2024-09-03 13:16:31');

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

--
-- Dumping data for table `heart_reactions`
--

INSERT INTO `heart_reactions` (`reaction_id`, `post_id`, `poll_id`, `user_no`, `reaction_type`, `timestamp`) VALUES
(248, NULL, 15, 71, 'heart', '2024-09-01 01:55:52'),
(249, NULL, 14, 71, 'heart', '2024-09-01 01:55:59'),
(250, 67, NULL, 71, 'heart', '2024-09-01 01:56:27'),
(251, 66, NULL, 71, 'heart', '2024-09-01 01:56:29'),
(252, 64, NULL, 71, 'heart', '2024-09-01 01:56:35'),
(254, 54, NULL, 71, 'heart', '2024-09-01 01:56:38'),
(257, NULL, 12, 71, 'heart', '2024-09-01 01:57:25'),
(258, NULL, 15, 50, 'heart', '2024-09-01 03:08:35'),
(260, NULL, 13, 50, 'heart', '2024-09-01 03:08:39'),
(262, NULL, 12, 50, 'heart', '2024-09-01 03:08:41'),
(263, 67, NULL, 50, 'heart', '2024-09-01 03:08:44'),
(264, 54, NULL, 50, 'heart', '2024-09-01 03:08:46'),
(265, 52, NULL, 50, 'heart', '2024-09-01 03:08:48'),
(266, 39, NULL, 50, 'heart', '2024-09-01 03:08:51'),
(267, NULL, 14, 50, 'heart', '2024-09-01 10:02:01'),
(274, 71, NULL, 50, 'heart', '2024-09-01 17:33:06'),
(275, 70, NULL, 50, 'heart', '2024-09-01 17:33:55'),
(276, 46, NULL, 50, 'heart', '2024-09-01 17:34:58'),
(278, 51, NULL, 50, 'heart', '2024-09-02 03:34:11'),
(279, NULL, 18, 71, 'heart', '2024-09-03 11:25:16'),
(280, NULL, 13, 71, 'heart', '2024-09-03 11:54:58'),
(281, 73, NULL, 73, 'heart', '2024-09-03 13:16:21'),
(282, NULL, 18, 73, 'heart', '2024-09-03 13:16:22'),
(283, NULL, 19, 73, 'heart', '2024-09-03 13:43:27');

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_no`, `admin_id`, `post_id`, `comment_user_no`, `reaction_user_no`, `post_user_no`, `post_reports_user_no`, `ban_user_no`, `warning_user_no`, `notification_photo`, `notification_caption`, `notification_type`, `notification_text`, `timestamp`, `is_opened`) VALUES
(517, 50, 1, 67, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'Post deleted', '\r\n          <p>Important Notice: Post Termination Due to Community Standards Violation </p>\r\n          <p>Dear John Paul Naag,</p>\r\n          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>\r\n          <p><strong>Reason for Action:</strong> Offensive</p>\r\n          <p><strong>Reported Post Details:</strong></p>\r\n              <p><strong>Photo:</strong></p>\r\n              <img src=\"include/posts_images/450310159_476483778674351_1146708106100650755_n.jpg\" alt=\"Reported Post Photo\">\r\n              <br>\r\n              <p><strong>Caption:</strong> caption w pic</p>\r\n          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href=\"users/t_c.php\">here</a> to better understand our guidelines and ensure future compliance.</p>\r\n          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href=\"users/user_appeal.php\">CVStagram support</a>.</p>\r\n          <p>Thank you for your understanding and cooperation.</p>\r\n          <p>Best regards,<br>\r\n          CVStagram</p>', '2024-09-03 02:02:41', 1),
(518, 50, 1, 67, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'Post deleted', '\r\n          <p>Important Notice: Post Termination Due to Community Standards Violation </p>\r\n          <p>Dear John Paul Naag,</p>\r\n          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>\r\n          <p><strong>Reason for Action:</strong> Offensive</p>\r\n          <p><strong>Reported Post Details:</strong></p>\r\n              <p><strong>Photo:</strong></p>\r\n              <img src=\"include/posts_images/450310159_476483778674351_1146708106100650755_n.jpg\" alt=\"Reported Post Photo\">\r\n              <br><br>\r\n              <p><strong>Caption:</strong> caption w pic</p>\r\n          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href=\"users/t_c.php\">here</a> to better understand our guidelines and ensure future compliance.</p>\r\n          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href=\"users/user_appeal.php\">CVStagram support</a>.</p>\r\n          <p>Thank you for your understanding and cooperation.</p>\r\n          <p>Best regards,<br>\r\n          CVStagram</p>', '2024-09-03 02:04:01', 1),
(519, 50, 1, 39, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Welcome to mobile legends', 'Post deleted', '\r\n          <p>Important Notice: Post Termination Due to Community Standards Violation </p>\r\n          <p>Dear John Paul Naag,</p>\r\n          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>\r\n          <p><strong>Reason for Action:</strong> Misleading or scam</p>\r\n          <p><strong>Reported Post Details:</strong></p>\r\n              <p><strong>Caption:</strong> Welcome to mobile legends</p>\r\n          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href=\"users/t_c.php\">here</a> to better understand our guidelines and ensure future compliance.</p>\r\n          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href=\"users/user_appeal.php\">CVStagram support</a>.</p>\r\n          <p>Thank you for your understanding and cooperation.</p>\r\n          <p>Best regards,<br>\r\n          CVStagram</p>', '2024-09-03 02:04:31', 1),
(520, 50, 1, 51, NULL, NULL, NULL, NULL, NULL, NULL, 'Screenshot 2024-08-02 213541.png', '', 'Post deleted', '\r\n          <p>Important Notice: Post Termination Due to Community Standards Violation </p>\r\n          <p>Dear John Paul Naag,</p>\r\n          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>\r\n          <p><strong>Reason for Action:</strong> Violence</p>\r\n          <p><strong>Reported Post Details:</strong></p>\r\n              <p><strong>Photo:</strong></p>\r\n              <img src=\"include/posts_images/Screenshot 2024-08-02 213541.png\" alt=\"Reported Post Photo\">\r\n              <br><br>\r\n          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href=\"users/t_c.php\">here</a> to better understand our guidelines and ensure future compliance.</p>\r\n          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href=\"users/user_appeal.php\">CVStagram support</a>.</p>\r\n          <p>Thank you for your understanding and cooperation.</p>\r\n          <p>Best regards,<br>\r\n          CVStagram</p>', '2024-09-03 02:04:49', 1),
(521, 50, 1, 51, NULL, NULL, NULL, NULL, NULL, NULL, 'Screenshot 2024-08-02 213541.png', '', 'Post deleted', '\r\n          <p>Important Notice: Post Termination Due to Community Standards Violation </p>\r\n          <p>Dear John Paul Naag,</p>\r\n          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>\r\n          <p><strong>Reason for Action:</strong> Violence</p>\r\n          <p><strong>Reported Post Details:</strong></p>\r\n          <p><strong>Posted On:</strong> August 23, 2024, 6:30 pm</p>\r\n              <p><strong>Photo:</strong></p>\r\n              <img src=\"include/posts_images/Screenshot 2024-08-02 213541.png\" alt=\"Reported Post Photo\">\r\n              <br><br>\r\n          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href=\"users/t_c.php\">here</a> to better understand our guidelines and ensure future compliance.</p>\r\n          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href=\"users/user_appeal.php\">CVStagram support</a>.</p>\r\n          <p>Thank you for your understanding and cooperation.</p>\r\n          <p>Best regards,<br>\r\n          CVStagram</p>', '2024-09-03 02:09:58', 1),
(522, 50, 1, 71, NULL, NULL, NULL, NULL, NULL, NULL, '', 'textpost\r\n', 'Post deleted', '\r\n          <p>Important Notice: Post Termination Due to Community Standards Violation </p>\r\n          <p>Dear John Paul Naag,</p>\r\n          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>\r\n          <p><strong>Reason for Action:</strong> Offensive</p>\r\n          <p><strong>Reported Post Details:</strong></p>\r\n          <p><strong>Posted On:</strong> September 1, 2024 pm30 9:16 pm</p>\r\n              <p><strong>Caption:</strong> textpost\r\n</p>\r\n          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href=\"users/t_c.php\">here</a> to better understand our guidelines and ensure future compliance.</p>\r\n          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href=\"users/user_appeal.php\">CVStagram support</a>.</p>\r\n          <p>Thank you for your understanding and cooperation.</p>\r\n          <p>Best regards,<br>\r\n          CVStagram</p>', '2024-09-03 02:10:34', 1),
(523, 50, 1, 67, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'Post deleted', '\r\n          <p>Important Notice: Post Termination Due to Community Standards Violation </p>\r\n          <p>Dear John Paul Naag,</p>\r\n          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>\r\n          <p><strong>Reason for Action:</strong> Offensive</p>\r\n          <p><strong>Reported Post Details:</strong></p>\r\n          <p><strong>Posted On:</strong> August 28, 2024, 10:11 pm</p>\r\n              <p><strong>Photo:</strong></p>\r\n              <img src=\"include/posts_images/450310159_476483778674351_1146708106100650755_n.jpg\" alt=\"Reported Post Photo\">\r\n              <br><br>\r\n              <p><strong>Caption:</strong> caption w pic</p>\r\n          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href=\"users/t_c.php\">here</a> to better understand our guidelines and ensure future compliance.</p>\r\n          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href=\"users/user_appeal.php\">CVStagram support</a>.</p>\r\n          <p>Thank you for your understanding and cooperation.</p>\r\n          <p>Best regards,<br>\r\n          CVStagram</p>', '2024-09-03 02:11:02', 1),
(524, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '450310159_476483778674351_1146708106100650755_n.jpg', 'caption w pic', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear John Paul Naag,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>619023</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 30, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Offensive<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\'>Contact us</a> and indicate this reference number: 619023 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\'>Visit our Facebook page</a><br>\r\n            ', '2024-09-03 02:12:21', 1),
(525, 50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear JOHN PAUL NAAG,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>335236</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: September 3, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: September 3, 2024<br>\r\n            Ban End Date: September 10, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\"target=\'_blank\'>Contact us</a> and provide the following reference number for further assistance: 335236.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\'>Visit our Facebook page</a><br>\r\n            ', '2024-09-03 02:13:57', 1),
(526, 71, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images (31).jpeg', 'post ko', 'warning', '\r\n            Subject: Warning: Violation of Community Standards<br><br>\r\n\r\n            Dear B B,<br><br>\r\n\r\n            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>\r\n\r\n            <h2>354187</h2>\r\n\r\n            Violation Details:<br><br>\r\n\r\n            Reported Date: August 30, 2024<br>\r\n            Description: Multiple report counts<br>\r\n            Community Standard Violated: Misleading or scam<br><br>\r\n\r\n            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>\r\n\r\n            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>\r\n\r\n            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\'>Contact us</a> and indicate this reference number: 354187 within the next 7 days.<br><br>\r\n\r\n            We value your participation in our community and hope to see you continue to contribute positively.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram Team<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\'>Visit our Facebook page</a><br>\r\n            ', '2024-09-03 12:19:09', 1),
(529, 55, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ban', '\r\n            Subject: Violation of Community Standards<br><br>\r\n\r\n            Dear A A,<br><br>\r\n\r\n            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>\r\n\r\n            <h2>689755</h2>\r\n\r\n            Details of Suspension:<br><br>\r\n\r\n            Date: September 3, 2024<br>\r\n            Violation Reason: Violate community standards<br>\r\n            Ban Level: 1<br>\r\n            Ban Start Date: September 3, 2024<br>\r\n            Ban End Date: September 10, 2024<br><br>\r\n\r\n            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"https://www.facebook.com/CvSUTreceCampus\"target=\'_blank\'>Contact us</a> and provide the following reference number for further assistance: 689755.<br><br>\r\n\r\n            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>\r\n\r\n            Thank you for your attention to this matter.<br><br>\r\n\r\n            Best regards,<br>\r\n            CvSTagram<br>\r\n            <a href=\"https://www.facebook.com/CvSUTreceCampus\" target=\'_blank\'>Visit our Facebook page</a><br>\r\n            ', '2024-09-03 12:46:01', 0),
(531, 71, 1, 72, NULL, NULL, NULL, NULL, NULL, NULL, '', 'qwer', 'Post deleted', '\r\n          <p>Important Notice: Post Termination Due to Community Standards Violation </p>\r\n          <p>Dear B B,</p>\r\n          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>\r\n          <p><strong>Reason for Action:</strong> Other</p>\r\n          <p><strong>Reported Post Details:</strong></p>\r\n          <p><strong>Posted On:</strong> September 3, 2024, 10:45 am</p>\r\n              <p><strong>Caption:</strong> qwer</p>\r\n          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href=\"users/t_c.php\" target=\"_blank\">here</a> to better understand our guidelines and ensure future compliance.</p>\r\n          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href=\"users/user_appeal.php\">CVStagram support</a>.</p>\r\n          <p>Thank you for your understanding and cooperation.</p>\r\n          <p>Best regards,<br>\r\n          CVStagram</p>', '2024-09-03 12:52:15', 1);

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
(15, 50, 'try', '2024-08-31 20:25:42'),
(17, 71, 'id lace color', '2024-09-03 19:23:40'),
(18, 71, 'askjdfglsajdgbflksjadbf;kjasdbfasjdfbsajdbfasjdbf;ajsbdf;jasbdf;jbasdfjbaskdjfbaksdjfbkasjdbfkasjdbfkajsdbfkjabsdfkjbasdfjba;sdjbf;asjdbf;ajsbdf;jabsd;fjbas;djfb;asjbdf;jabsdf;bas;dfjba;sldjfb;jasdbf;jasdbfkjabsdfas', '2024-09-03 19:24:44'),
(19, 73, 'qwer', '2024-09-03 21:17:53');

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
(43, 15, 'try', ''),
(45, 17, 'red', 'users/user_operation/uploads/66d6f1bcc4b3b.png'),
(46, 17, 'green', 'users/user_operation/uploads/66d6f1bcc7d6e.png'),
(47, 17, 'blue', 'users/user_operation/uploads/66d6f1bcc8e65.jpg'),
(48, 18, 'adfsdaf', ''),
(49, 19, 'qwer', 'users/user_operation/uploads/66d70c811a7d1.jpg'),
(50, 19, 'qwer', 'users/user_operation/uploads/66d70c811bb3e.jpg'),
(51, 19, 'qwer', '');

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
(1, 14, 50, 38, '2024-08-31 12:03:36'),
(2, 13, 50, 36, '2024-08-31 12:12:45'),
(3, 14, 71, 39, '2024-08-31 12:15:11'),
(4, 12, 71, 35, '2024-08-31 12:16:25'),
(5, 13, 71, 37, '2024-08-31 12:17:11'),
(6, 12, 50, 34, '2024-08-31 12:25:20'),
(7, 15, 50, 41, '2024-08-31 12:25:50'),
(8, 15, 71, 43, '2024-08-31 13:35:57'),
(10, 17, 71, 45, '2024-09-03 11:24:12'),
(11, 18, 71, 48, '2024-09-03 11:25:02'),
(12, 19, 73, 50, '2024-09-03 13:23:57'),
(13, 17, 73, 47, '2024-09-03 13:47:07'),
(14, 18, 73, 48, '2024-09-03 13:47:35'),
(15, 19, 50, 50, '2024-09-03 14:42:19'),
(16, 17, 50, 47, '2024-09-03 14:42:52');

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

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_no`, `relation`, `services`, `caption`, `postphoto`, `timestamp`, `deleted_at`) VALUES
(39, 50, 'bothrelati', 'bothservic', 'Welcome to mobile legends', '', '2024-08-20 14:50:21', '2024-09-03 02:04:31'),
(45, 55, 'bothrelati', 'bothservic', 'sup', '0wzknw7460n31.jpg', '2024-08-21 11:40:00', NULL),
(46, 50, 'bothrelati', 'bothservic', '', 'Screenshot 2024-08-22 214241.png', '2024-08-23 02:31:20', NULL),
(47, 55, 'bothrelati', 'bothservic', 'hey', '', '2024-08-23 02:35:46', NULL),
(48, 50, 'bothrelati', 'bothservic', 'qwer', 'Screenshot 2024-08-14 074841.png', '2024-08-23 02:36:58', NULL),
(49, 55, 'bothrelati', 'bothservic', '', '451803876_779136454297409_3907025352395061169_n.jpg', '2024-08-23 02:52:30', NULL),
(50, 55, 'bothrelati', 'bothservic', 'post', '', '2024-08-23 10:28:30', NULL),
(51, 50, 'bothrelati', 'bothservic', '', 'Screenshot 2024-08-02 213541.png', '2024-08-23 10:30:49', '2024-09-03 02:09:58'),
(52, 50, 'bothrelati', 'bothservic', 'hello\r\n', '', '2024-08-23 12:01:53', NULL),
(53, 55, 'bothrelati', 'bothservic', 'ako to', '215a1d22-7d9d-4f05-87ec-dd5125a7955a.jfif', '2024-08-23 12:05:03', '2024-09-02 16:14:13'),
(54, 50, 'bothrelati', 'bothservic', 'asdf', '', '2024-08-23 14:33:02', NULL),
(64, 50, 'bothrelati', 'bothservic', 'qasdfasdfasdf', '', '2024-08-28 13:40:16', NULL),
(65, 50, 'bothrelati', 'bothservic', 'asdfasd', '455035978_1190565572278382_8186029215283454446_n.jpg', '2024-08-28 13:40:42', NULL),
(66, 50, 'bothrelati', 'bothservic', 'caption', '', '2024-08-28 14:10:37', NULL),
(67, 50, 'bothrelati', 'bothservic', 'caption w pic', '450310159_476483778674351_1146708106100650755_n.jpg', '2024-08-28 14:11:16', '2024-09-03 02:11:02'),
(68, 55, 'bothrelati', 'bothservic', 'asd', '', '2024-08-29 00:00:03', NULL),
(69, 55, 'bothrelati', 'bothservic', 'asdadsdasd', '', '2024-08-29 00:00:31', '2024-09-02 14:25:04'),
(70, 71, 'bothrelati', 'bothservic', 'post ko', 'images (31).jpeg', '2024-08-30 01:08:17', '2024-09-03 00:49:40'),
(71, 50, 'bothrelati', 'bothservic', 'textpost\r\n', '', '2024-09-01 13:16:14', '2024-09-03 02:10:34'),
(72, 71, 'bothrelati', 'bothservic', 'qwer', '', '2024-09-03 02:45:41', '2024-09-03 12:52:15'),
(73, 73, 'bothrelati', 'bothservic', 'asd', '', '2024-09-03 12:35:21', NULL),
(74, 73, 'bothrelati', 'bothservic', 'qwer', '', '2024-09-03 13:17:19', NULL),
(75, 73, 'bothrelati', 'bothservic', 'asdfasdfasdfasdf', '', '2024-09-03 13:24:57', NULL),
(76, 73, 'bothrelati', 'bothservic', '', '5a91e8359f415e730c4ed61965ce7023.jpg', '2024-09-03 13:25:03', NULL),
(77, 73, 'bothrelati', 'bothservic', '', 'profile.jpg', '2024-09-03 13:25:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
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
(71, 70, 71, 50, 'Pretending to be someone else', '2024-08-30 06:05:15'),
(72, 71, 50, 71, 'Offensive', '2024-09-02 13:06:02'),
(73, 72, 71, 50, 'Other', '2024-09-03 02:47:10'),
(75, 65, 50, 71, 'False news', '2024-09-03 03:04:07'),
(76, 72, 71, 50, 'Offensive', '2024-09-03 10:05:02'),
(77, 66, 50, 71, 'Offensive', '2024-09-03 10:05:31'),
(78, 66, 50, 73, 'False news', '2024-09-03 12:37:55'),
(79, 73, 73, 50, 'Spam', '2024-09-03 12:38:59');

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
(20, 73, '2024-09-15', '2024-09-21', '09:30:00', '01:00:00', 'Thursday', 'itec', 'qwer', 'aqua');

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
(104, 50, 429845, 2, '2024-08-31', '2024-09-30'),
(105, 55, 355020, 1, '2024-09-02', '2024-09-09'),
(106, 55, 103423, 1, '2024-09-02', '2024-09-09'),
(107, 50, 219480, 1, '2024-09-03', '2024-09-10'),
(108, 50, 335236, 1, '2024-09-03', '2024-09-10'),
(109, 55, 689755, 1, '2024-09-03', '2024-09-10'),
(110, 73, 759672, 1, '2024-09-03', '2024-09-10');

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
(55, 'gender', 1),
(73, 'bday', 1),
(73, 'gender', 1);

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
(50, '::1', '@qasdfasd311', 'tmc.johnpaul.naag@cvsu.edu.ph', '2022-100-0349', 'John Paul', 'Naag', '2024-08-15', 'prefered-not-to-say', 'default_coverphoto.jpg', 'FB_IMG_1724824572042.jpg', '2024-08-20 14:22:45', '2024-09-02 04:39:30', '$2y$10$u3x5GLV7hnj17EbT31VF9eHkqagcSB25rsNWnGDiqRjegU/ucagNS'),
(55, '::1', '@a901', 'tmc.test@cvsu.edu.ph', '2022-100-0341', 'A', 'A', '2024-08-14', 'Male', 'default_coverphoto.jpg', 'profile.jpg', '2024-08-21 11:38:53', '2024-08-29 00:53:41', '$2y$10$Y1cbdFPL3NZInFy1JowIPeJ5TkeBYClOCr14g/2w8H72d1E3/fjdC'),
(71, '::1', '@b863', 'tmc.test2@cvsu.edu.ph', '2022-100-0342', 'B', 'B', '2024-08-13', 'other', 'IMG_20201128_182307.jpg', 'FB_IMG_1622006226672.jpg', '2024-08-28 07:36:44', '2024-09-03 10:36:08', '$2y$10$3tjbxGe2emjFPoEuvvogIOSc0Qf4OM/rJUPYMwPnFg0oe1B7mo.Xu'),
(73, '::1', '@john_wick152', 'tmc.test3@cvsu.edu.ph', '0347-283-3432', 'Juan', 'Carlos', '2024-09-11', 'Male', 'default_coverphoto.jpg', 'profile.jpg', '2024-09-03 12:27:13', '2024-09-03 12:36:25', '$2y$10$VpEseqYibiTtqBzap8aCpuF0wHTlBECc4Few3rxEs1jycszFoiekW');

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
(192, 50, 196426, 2, '2024-08-31', '2024-09-15'),
(193, 55, 923734, 1, '2024-09-02', '2024-09-17'),
(194, 55, 159597, 1, '2024-09-02', '2024-09-17'),
(195, 55, 810701, 1, '2024-09-02', '2024-09-17'),
(196, 55, 230586, 1, '2024-09-03', '2024-09-18'),
(197, 55, 391605, 2, '2024-09-03', '2024-09-18'),
(198, 71, 359766, 2, '2024-09-03', '2024-09-18'),
(199, 71, 926014, 3, '2024-09-03', '2024-09-18'),
(200, 71, 240802, 4, '2024-09-03', '2024-09-18'),
(201, 71, 368253, 5, '2024-09-03', '2024-09-18'),
(202, 50, 549239, 1, '2024-09-03', '2024-09-18'),
(203, 50, 147891, 2, '2024-09-03', '2024-09-18'),
(204, 50, 714311, 3, '2024-09-03', '2024-09-18'),
(205, 50, 619023, 4, '2024-09-03', '2024-09-18'),
(206, 71, 354187, 1, '2024-09-03', '2024-09-18'),
(207, 73, 459539, 1, '2024-09-03', '2024-09-18'),
(208, 73, 576661, 2, '2024-09-03', '2024-09-18');

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
  MODIFY `active_ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `active_warning`
--
ALTER TABLE `active_warning`
  MODIFY `active_warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `heart_reactions`
--
ALTER TABLE `heart_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=532;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `options_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_bans`
--
ALTER TABLE `user_bans`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_warnings`
--
ALTER TABLE `user_warnings`
  MODIFY `warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

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
