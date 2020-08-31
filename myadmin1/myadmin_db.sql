-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2020 at 02:32 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myadmin1`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `parent_table` enum('todo','ticket','messages','comment','other') DEFAULT 'other',
  `item_id` enum('todo_title','ticket_id','comment_id','message_id','unlisted') DEFAULT 'unlisted',
  `todo_title` varchar(255) DEFAULT NULL,
  `todo_creator` int(11) DEFAULT NULL,
  `todo_create_date` varchar(40) DEFAULT NULL,
  `todo_important` tinyint(1) DEFAULT NULL,
  `todo_finished` tinyint(1) DEFAULT NULL,
  `todo_details` varchar(255) DEFAULT NULL,
  `ticket_creator` int(11) DEFAULT NULL,
  `ticket_supid` int(11) DEFAULT NULL,
  `ticet_maintenance_record_id` int(11) DEFAULT NULL,
  `ticket_device_id` int(11) DEFAULT NULL,
  `ticket_date_create` varchar(30) DEFAULT NULL,
  `comment_ticket_id` int(11) DEFAULT NULL,
  `comment_content` text,
  `comment_image` text,
  `comment_userid` int(11) DEFAULT NULL,
  `comment_date` varchar(40) DEFAULT NULL,
  `commment_ticket_title` varchar(255) DEFAULT NULL,
  `message_subject` varchar(255) DEFAULT NULL,
  `message_body` text,
  `message_image` text,
  `message_sender_id` int(11) DEFAULT NULL,
  `message_reciver_id` int(11) DEFAULT NULL,
  `empty` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='this table for backup comments, todo, tickets, message data ';

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(70) DEFAULT NULL,
  `image` text,
  `creator_id` int(11) NOT NULL,
  `sup_location` text NOT NULL,
  `resigned` enum('yes','no') NOT NULL DEFAULT 'no',
  `job_title` varchar(50) DEFAULT NULL,
  `employee_id` varchar(15) NOT NULL,
  `department` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `location`, `image`, `creator_id`, `sup_location`, `resigned`, `job_title`, `employee_id`, `department`) VALUES
(1, 'Mahmoud Hegazi', 'EEC group sheraton main', '/images/profile.jpg', 1, 'floor1', 'no', NULL, '0', NULL),
(2, 'Ahmed (supervisor) ', 'EEC group sheraton main', '/images/fb.jpg', 1, 'floor1', 'no', NULL, '0', NULL),
(3, 'Madonna', 'EEG Group Main shertaon', '/images/girl.jpg', 1, 'floor1', 'no', NULL, '0', NULL),
(6, 'mazen', 'EEC group sub location ', '/images/fb.jpg', 2, 'floor1', 'no', NULL, '0', NULL),
(7, 'Petter', 'EEC group, Main location', 'images/flower.jpg', 18, 'floor1', 'no', NULL, '0', NULL),
(12, 'Mahmoud', 'data1', './images/edd.jpg', 120, 'floor4', 'no', 'Full stack web developer', 'FFeeCC', 'IT'),
(13, 'New emo', 'uasdij', './images/girl.png', 120, 'sidjifjasd', 'no', 'idajdajdasi0', '41515523', 'jiejef'),
(14, 'iaidu8dua', 'kjadijidjai', './images/68pem.PNG', 120, 'ijdaij', 'no', 'jaidsjiaji', '8484', 'adasawd'),
(15, 'asdmauh', 'jhuasduash', './images/girl.png', 120, 'huahdushau', 'no', 'hauhg7uydgau', '541515', 'ijhdijaiadd'),
(16, 'adsdadd', 'dadadd', './images/shwky.jpg', 120, 'addaa', 'no', 'adddd', '6e55BB', 'it'),
(17, 'dasdsadsdasa', 'adaaasads', './images/profile.jpg', 120, 'adaadad', 'no', 'adaaa', '6e55BB', 'it'),
(18, 'ahmed', 'dishna', './images/mac1.jpg', 120, 'floor1', 'no', 'My first post', '6e55BB', 'it');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL COMMENT 'device for this recored',
  `supplier_id` int(255) DEFAULT NULL COMMENT 'supplier_id',
  `creator_id` int(11) NOT NULL,
  `price` varchar(25) DEFAULT NULL,
  `last_employee_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT 'New Ticket',
  `status` enum('open','pending','closed','reopen') NOT NULL DEFAULT 'open',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `device_id`, `supplier_id`, `creator_id`, `price`, `last_employee_id`, `title`, `status`, `date`) VALUES
(2, 6, 1, 3, '600', 6, 'New Ticket', 'open', '2020-08-19 00:44:51'),
(3, 7, 2, 3, '300', 1, 'New Ticket', 'closed', '2020-08-19 00:44:51'),
(4, 2, 2, 92, '18', 7, 'New Ticket', 'open', '2020-08-19 00:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(20) NOT NULL,
  `body` text NOT NULL,
  `image` text,
  `sender_id` int(11) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `body`, `image`, `sender_id`, `reciver_id`, `sent_date`) VALUES
(1, 'Welcome this my First Message For you Hello', '', 1, 3, '2020-08-27 13:10:41'),
(2, 'Hello My friend are you ready for meeting', '/images/laptop.jpg', 2, 10, '2020-08-27 13:10:41'),
(3, 'We always can do it', 'none', 3, 1, '2020-08-27 13:10:41'),
(4, 'asdasdasdasdasdasdasdasdasdasdasdasdasdasd', 'asdadsad', 120, 3, '2020-08-27 21:34:37'),
(5, 'Hello and hi', 'aaddas', 3, 120, '2020-08-27 21:36:11'),
(6, 'i love code and php', 'images/girl.jpg', 3, 120, '2020-08-28 11:03:58'),
(7, 'i love code and php', 'images/girl.jpg', 3, 120, '2020-08-28 11:08:54'),
(8, 'i love code and php', 'images/girl.jpg', 3, 120, '2020-08-28 11:09:00'),
(9, 'i love code and php', 'images/girl.jpg', 3, 120, '2020-08-28 11:09:59'),
(10, 'asadddsa', 'asdassd', 119, 120, '2020-08-28 11:18:43'),
(11, 'asadddsa', 'asdassd', 119, 120, '2020-08-28 11:21:06'),
(12, 'asadddsa', 'asdassd', 119, 120, '2020-08-28 11:21:12'),
(13, 'asadddsa', 'asdassd', 3, 120, '2020-08-28 11:35:51'),
(14, 'assa', NULL, 120, 3, '2020-08-30 10:01:11'),
(15, 'assa', NULL, 120, 3, '2020-08-30 10:33:20'),
(16, 'Hello friend', NULL, 120, 3, '2020-08-30 10:34:35'),
(17, 'Thanks God', NULL, 120, 3, '2020-08-30 10:41:23'),
(18, 'Thanks God', NULL, 120, 3, '2020-08-30 10:41:29'),
(19, 'thanks', NULL, 120, 3, '2020-08-30 10:41:56'),
(20, 'hi', NULL, 120, 3, '2020-08-30 10:42:14'),
(21, 'Hello PHP.', NULL, 120, 3, '2020-08-30 10:44:56'),
(22, 'Thank you', NULL, 120, 3, '2020-08-30 10:46:43'),
(23, 'Hello World', NULL, 120, 3, '2020-08-30 10:59:09'),
(24, 'Hello, PHP my Next Main.', NULL, 120, 3, '2020-08-30 10:59:52'),
(25, 'whyu', NULL, 120, 3, '2020-08-30 11:00:07'),
(26, 'Hello and hi', NULL, 120, 3, '2020-08-30 11:02:26'),
(27, 'You can do it easy', NULL, 120, 3, '2020-08-30 11:03:48'),
(28, 'oj', NULL, 120, 3, '2020-08-30 11:04:05'),
(29, 'hh', NULL, 120, 3, '2020-08-30 11:04:53'),
(30, 'assasa', NULL, 120, 3, '2020-08-30 11:05:12'),
(31, 'hh', NULL, 120, 3, '2020-08-30 11:06:22'),
(32, 'asdda', NULL, 120, 3, '2020-08-30 11:06:35'),
(33, 'assa', NULL, 120, 3, '2020-08-30 11:06:52'),
(34, 'wtf', NULL, 120, 3, '2020-08-30 11:07:04'),
(35, 'asa', NULL, 120, 3, '2020-08-30 11:07:32'),
(36, 'aa', NULL, 120, 3, '2020-08-30 11:07:57'),
(37, 'as', NULL, 120, 3, '2020-08-30 11:08:25'),
(38, 'a', NULL, 120, 3, '2020-08-30 11:09:32'),
(39, 'aa', NULL, 120, 3, '2020-08-30 11:10:30'),
(40, 'Hello World', NULL, 120, 3, '2020-08-30 11:15:53'),
(41, 'Thank you', NULL, 120, 3, '2020-08-30 11:15:59'),
(42, 'welcome', NULL, 120, 3, '2020-08-30 11:16:07'),
(43, 'yes', NULL, 120, 3, '2020-08-30 11:16:26'),
(44, 'aa', NULL, 120, 14, '2020-08-30 11:16:54'),
(45, 'Good Job', NULL, 3, 120, '2020-08-30 11:19:23'),
(46, 'hi', NULL, 120, 3, '2020-08-30 11:37:36'),
(47, 'sasa', NULL, 120, 3, '2020-08-30 11:37:54'),
(48, 'aaa', NULL, 120, 3, '2020-08-30 11:38:49'),
(49, 'aa', NULL, 120, 3, '2020-08-30 11:39:06'),
(50, 'aa', NULL, 120, 3, '2020-08-30 11:39:22'),
(51, 'we', NULL, 120, 3, '2020-08-30 11:39:29'),
(52, 'hello and hi', NULL, 120, 3, '2020-08-30 11:40:21'),
(53, 'hello and hi', NULL, 120, 3, '2020-08-30 11:41:10'),
(54, 'zfty', NULL, 120, 3, '2020-08-30 11:52:24'),
(55, 'Thanks god', NULL, 120, 3, '2020-08-30 11:53:21'),
(56, 'ass', NULL, 120, 3, '2020-08-30 11:54:21'),
(57, 'again', NULL, 120, 3, '2020-08-30 11:54:29'),
(58, 'dont', NULL, 120, 3, '2020-08-30 11:55:40'),
(59, 'now what', NULL, 120, 3, '2020-08-30 11:57:24'),
(60, '?', NULL, 120, 3, '2020-08-30 11:57:46'),
(61, 'I love php', NULL, 120, 3, '2020-08-30 12:15:06'),
(62, 'test', NULL, 120, 3, '2020-08-30 12:17:31'),
(63, 'Fuk php', NULL, 120, 3, '2020-08-30 12:18:20'),
(64, 'assaas', NULL, 120, 3, '2020-08-30 12:18:46'),
(65, 'assa', NULL, 120, 3, '2020-08-30 12:18:55'),
(66, 'as', NULL, 120, 3, '2020-08-30 12:20:00'),
(67, 'sasaasassa', NULL, 120, 3, '2020-08-30 12:20:23'),
(68, 'we can\'t', NULL, 120, 3, '2020-08-30 12:24:34'),
(69, 'maybe we can', NULL, 120, 3, '2020-08-30 12:24:48'),
(70, 'c', NULL, 120, 3, '2020-08-30 12:26:16'),
(71, 'why', NULL, 120, 3, '2020-08-30 12:28:41'),
(72, 'ad', NULL, 120, 3, '2020-08-30 12:29:14'),
(73, 'new', NULL, 120, 3, '2020-08-30 12:29:55'),
(74, 'please', NULL, 120, 3, '2020-08-30 12:30:51'),
(75, 'I did it', NULL, 120, 3, '2020-08-30 12:41:58'),
(76, 'PHP Master', NULL, 120, 3, '2020-08-30 12:43:25'),
(77, 'whu', NULL, 120, 3, '2020-08-30 12:44:11'),
(78, 'we can\'t', NULL, 120, 3, '2020-08-30 12:45:57'),
(79, 'no way', NULL, 120, 3, '2020-08-30 12:59:52'),
(80, 'assa', NULL, 120, 3, '2020-08-30 13:00:00'),
(81, 'as', NULL, 120, 3, '2020-08-30 13:00:54'),
(82, 'assd', NULL, 120, 3, '2020-08-30 13:02:07'),
(83, 'asd', NULL, 120, 3, '2020-08-30 13:02:42'),
(84, 'ddd', NULL, 120, 3, '2020-08-30 13:03:20'),
(85, 'yes', NULL, 120, 3, '2020-08-30 13:04:27'),
(86, 'I will do it', NULL, 120, 3, '2020-08-30 13:31:34'),
(87, 'asdas', NULL, 120, 3, '2020-08-30 13:33:12'),
(88, 'asadsdasasddas', NULL, 120, 3, '2020-08-30 13:33:45'),
(89, 'hi', NULL, 120, 3, '2020-08-30 14:26:28'),
(90, 'Please', NULL, 120, 3, '2020-08-30 14:35:08'),
(91, 'OH Finally', NULL, 120, 3, '2020-08-30 14:36:14'),
(92, 'das', NULL, 120, 3, '2020-08-30 14:37:25'),
(93, 'last trial', NULL, 120, 3, '2020-08-30 14:38:14'),
(94, 'asddada', NULL, 120, 3, '2020-08-30 14:38:20'),
(95, 'asdda', NULL, 120, 3, '2020-08-30 14:39:21'),
(96, 'asd', NULL, 120, 3, '2020-08-30 14:39:36'),
(97, 'add', NULL, 120, 3, '2020-08-30 14:39:59'),
(98, 'asd', NULL, 120, 3, '2020-08-30 14:40:26'),
(99, 'dd', NULL, 120, 3, '2020-08-30 14:41:02'),
(100, 'ddd', NULL, 120, 3, '2020-08-30 14:41:12'),
(101, 'iyyu', NULL, 120, 3, '2020-08-30 14:42:01'),
(102, 'ad', NULL, 120, 10, '2020-08-30 14:43:45'),
(103, 'heloo', NULL, 120, 3, '2020-08-30 14:59:31'),
(104, 'a', NULL, 120, 3, '2020-08-30 15:07:35'),
(105, 'do it', NULL, 120, 3, '2020-08-30 15:09:54'),
(106, 'asd', NULL, 120, 3, '2020-08-30 15:10:12'),
(107, 'dd', NULL, 120, 3, '2020-08-30 15:12:05'),
(108, 'dddd', NULL, 120, 3, '2020-08-30 15:12:50'),
(109, 'h', NULL, 120, 3, '2020-08-30 15:14:03'),
(110, 'dd', NULL, 120, 3, '2020-08-30 15:14:07'),
(111, 'd', NULL, 120, 3, '2020-08-30 15:14:44'),
(112, 'd', NULL, 120, 3, '2020-08-30 15:14:47'),
(113, 'd', NULL, 120, 3, '2020-08-30 15:15:10'),
(114, 'dd', NULL, 120, 3, '2020-08-30 15:16:11'),
(115, 'd', NULL, 120, 3, '2020-08-30 15:16:49'),
(116, 'dddd', NULL, 120, 3, '2020-08-30 15:16:53'),
(117, 'd', NULL, 120, 3, '2020-08-30 15:18:50'),
(118, 'dddddddd', NULL, 120, 3, '2020-08-30 15:18:54'),
(119, 'd', NULL, 120, 3, '2020-08-30 15:21:27'),
(120, 'd', NULL, 120, 3, '2020-08-30 15:21:30'),
(121, 'aaaaaaaaaaaaaaaaaaaaaa', NULL, 120, 3, '2020-08-30 15:22:05'),
(122, 'aaaaaaaaaaaa', NULL, 120, 3, '2020-08-30 15:22:07'),
(123, 'ddd', NULL, 120, 3, '2020-08-30 15:22:31'),
(124, 'ddd', NULL, 120, 3, '2020-08-30 15:22:35'),
(125, 'ddd', NULL, 120, 3, '2020-08-30 15:24:04'),
(126, 'finally', NULL, 120, 3, '2020-08-30 15:25:00'),
(127, 'I love PHP again', NULL, 120, 3, '2020-08-30 15:25:43'),
(128, 'omg', NULL, 120, 3, '2020-08-30 15:25:54'),
(129, 'I love udacity', NULL, 120, 3, '2020-08-30 15:27:12'),
(130, 'Thanks udacity Trust me', NULL, 120, 3, '2020-08-30 15:28:13'),
(131, 'Final Test', NULL, 120, 3, '2020-08-30 15:28:48'),
(132, 'Hello World', NULL, 120, 3, '2020-08-31 06:54:59'),
(137, 'Hello', NULL, 120, 3, '2020-08-31 07:11:13'),
(138, 'I did IT Easy thank you', NULL, 3, 120, '2020-08-31 08:14:17'),
(139, 'I did IT Easy thank you', NULL, 3, 120, '2020-08-31 08:14:20'),
(140, 'Thanks Udacity I\'m Ready Google :D', NULL, 120, 3, '2020-08-31 08:15:54'),
(141, 'new', NULL, 120, 3, '2020-08-31 08:39:36'),
(142, 'hello', NULL, 120, 3, '2020-08-31 08:41:43'),
(143, 'again', NULL, 120, 3, '2020-08-31 08:43:02'),
(144, 'hey', NULL, 120, 3, '2020-08-31 08:51:27'),
(145, 'Final Part', NULL, 3, 120, '2020-08-31 08:52:05'),
(146, 'hello guys', NULL, 120, 3, '2020-08-31 08:53:14'),
(147, 'hey', NULL, 120, 3, '2020-08-31 08:56:51'),
(148, 'hey shawky', NULL, 120, 10, '2020-08-31 08:57:45');

-- --------------------------------------------------------

--
-- Table structure for table `mycomment`
--

CREATE TABLE `mycomment` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text,
  `date` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mycomment`
--

INSERT INTO `mycomment` (`id`, `ticket_id`, `title`, `content`, `date`, `user_id`, `image`) VALUES
(1, 2, 'giuo', 'giuooooooo', '2020-08-04', 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `title` enum('new_message','create_ticket','delete_ticket','new_device','closed_ticket','comment_add','user_created','user_removed','new_maintenance','image_updated','blocked_messages','supplier_added','task_added','supplier_deleted','employee_deleted','employee_added','supplier_updated','employee_updated','device_updated','device_deleted','send_message') NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'notification time'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `content`, `reciver_id`, `title`, `date`) VALUES
(1, 'You Have Got, New Message from Mahmoud Hegazy', 3, 'new_message', '2020-08-25 02:59:47'),
(2, 'You Have Got, New Message from Mahmoud Hegazy', 10, 'new_message', '2020-08-25 02:59:47'),
(3, 'New Device has been added Service Tag: FFeeCC', 106, 'new_device', '2020-08-25 02:59:47'),
(5, 'moniradded sucessfully!', 120, 'supplier_added', '2020-08-25 03:11:12'),
(6, 'ahmed added sucessfully!', 120, 'supplier_added', '2020-08-25 03:13:32'),
(7, 'Device id: Ehs451CAdded', 120, 'new_device', '2020-08-25 03:15:20'),
(8, 'Maged added sucessfully!', 120, 'supplier_added', '2020-08-25 03:46:31'),
(9, 'Mohaned added sucessfully!', 120, 'supplier_added', '2020-08-25 08:54:43'),
(10, 'New Device has Added id: 6e55BB', 120, 'new_device', '2020-08-25 09:13:06'),
(11, 'ahmed added sucessfully!', 120, 'supplier_added', '2020-08-25 09:13:54'),
(12, 'ahmed added sucessfully!', 120, 'supplier_added', '2020-08-25 09:14:15'),
(13, 'Hey mmasokdoaNew Task Added.', 120, 'task_added', '2020-08-26 13:24:01'),
(14, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-26 13:24:52'),
(15, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-26 13:27:26'),
(16, 'Mido added sucessfully!', 120, 'supplier_added', '2020-08-26 13:44:27'),
(17, 'Mahmoud added sucessfully!', 120, 'supplier_added', '2020-08-26 13:45:29'),
(18, ' Deleted sucessfully!', 120, 'supplier_deleted', '2020-08-26 14:41:52'),
(19, 'Supplier Deleted sucessfully!', 120, 'supplier_deleted', '2020-08-26 14:43:10'),
(20, 'Employee with id: 5 Deleted sucessfully!', 120, 'employee_deleted', '2020-08-26 15:17:21'),
(21, 'Employee with id: 4 Deleted sucessfully!', 120, 'employee_deleted', '2020-08-26 15:17:25'),
(22, '!Employee Deleted sucessfully ID: 8', 120, 'employee_deleted', '2020-08-26 15:20:23'),
(23, 'mona added sucessfully!', 120, 'supplier_added', '2020-08-27 09:02:06'),
(24, 'ahmed added sucessfully!', 120, 'employee_added', '2020-08-27 09:49:09'),
(25, 'ahmed added sucessfully!', 120, 'employee_added', '2020-08-27 09:49:27'),
(26, '!Employee Deleted sucessfully ID: 10', 120, 'employee_deleted', '2020-08-27 09:49:33'),
(27, '!Employee Deleted sucessfully ID: 9', 120, 'employee_deleted', '2020-08-27 09:51:43'),
(28, 'Haydi added sucessfully!', 120, 'employee_added', '2020-08-27 10:02:37'),
(29, 'mona Updated sucessfully!', 120, 'supplier_updated', '2020-08-27 11:27:53'),
(30, 'Haydi Updated sucessfully!', 120, 'employee_updated', '2020-08-27 12:01:35'),
(31, 'Haydi Updated sucessfully!', 120, 'employee_updated', '2020-08-27 12:01:48'),
(32, 'Device updated sucessfully ID :newtag', 120, 'device_updated', '2020-08-27 13:47:15'),
(33, 'Device updated sucessfully ID :FFeeCC', 120, 'device_updated', '2020-08-27 13:48:24'),
(34, 'Device updated sucessfully ID :FFeeCC', 120, 'device_updated', '2020-08-27 13:49:03'),
(35, 'Device updated sucessfully ID :FFeeCC', 120, 'device_updated', '2020-08-27 13:52:09'),
(36, 'Device updated sucessfully ID :newtag', 120, 'device_updated', '2020-08-27 13:52:31'),
(37, 'New Device has Added id: Wee44', 120, 'new_device', '2020-08-27 13:56:55'),
(38, 'New Device has Added id: 6e55BB', 120, 'new_device', '2020-08-27 13:59:14'),
(39, 'ahmed added sucessfully!', 120, 'supplier_added', '2020-08-27 13:59:33'),
(40, 'ahmed Updated sucessfully!', 120, 'supplier_updated', '2020-08-27 14:00:07'),
(41, 'Device updated sucessfully ID :6e55BB', 120, 'device_updated', '2020-08-27 14:01:08'),
(42, 'New Device has Added id: 6e55BB', 120, 'new_device', '2020-08-27 14:01:37'),
(43, 'New Device has Added id: asd65', 120, 'new_device', '2020-08-27 14:02:27'),
(44, 'New Device has Added id: 6e55BB', 120, 'new_device', '2020-08-27 14:03:23'),
(45, 'Device updated sucessfully ID :6e55BB', 120, 'device_updated', '2020-08-27 23:14:01'),
(46, 'Device Deleted Successfully ID: 47', 120, 'employee_added', '2020-08-27 23:18:21'),
(47, 'Device Deleted Successfully ID: 43', 120, 'employee_added', '2020-08-27 23:19:06'),
(48, 'Device Deleted Successfully ID: 38', 120, 'employee_added', '2020-08-27 23:19:19'),
(49, 'Device Deleted Successfully ID: 17', 120, 'device_deleted', '2020-08-27 23:20:39'),
(50, 'New Device has Added id: EF45223', 120, 'new_device', '2020-08-27 23:22:05'),
(51, 'Mido added sucessfully!', 120, 'supplier_added', '2020-08-27 23:24:30'),
(52, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-27 23:25:27'),
(53, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-28 14:38:09'),
(54, 'Device Deleted Successfully ID: 37', 120, 'device_deleted', '2020-08-28 15:13:22'),
(55, 'Device Deleted Successfully ID: 41', 120, 'device_deleted', '2020-08-28 15:13:29'),
(56, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:13:47'),
(57, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:13:49'),
(58, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:13:50'),
(59, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:13:52'),
(60, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:27'),
(61, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:28'),
(62, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:29'),
(63, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:29'),
(64, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:29'),
(65, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:29'),
(66, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:29'),
(67, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:29'),
(68, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:30'),
(69, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:30'),
(70, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:30'),
(71, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:30'),
(72, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:30'),
(73, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:31'),
(74, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:31'),
(75, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:31'),
(76, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:31'),
(77, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:31'),
(78, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:31'),
(79, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:40'),
(80, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:41'),
(81, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:41'),
(82, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:14:41'),
(83, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:06'),
(84, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:07'),
(85, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:07'),
(86, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:08'),
(87, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:08'),
(88, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:08'),
(89, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:08'),
(90, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:09'),
(91, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:15:19'),
(92, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:28'),
(93, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:28'),
(94, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:29'),
(95, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:30'),
(96, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:30'),
(97, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:30'),
(98, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:39'),
(99, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:39'),
(100, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:40'),
(101, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:40'),
(102, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:40'),
(103, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:40'),
(104, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:40'),
(105, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:40'),
(106, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:41'),
(107, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:41'),
(108, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:41'),
(109, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:41'),
(110, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:41'),
(111, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:41'),
(112, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:42'),
(113, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:42'),
(114, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:42'),
(115, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:42'),
(116, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:42'),
(117, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:52'),
(118, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:16:53'),
(119, 'Device Deleted Successfully ID: 26', 120, 'device_deleted', '2020-08-28 15:16:55'),
(120, 'Device Deleted Successfully ID: 27', 120, 'device_deleted', '2020-08-28 15:16:56'),
(121, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:16'),
(122, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:19'),
(123, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:20'),
(124, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:20'),
(125, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:21'),
(126, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:21'),
(127, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:21'),
(128, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:21'),
(129, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:21'),
(130, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:22'),
(131, 'Device Deleted Successfully ID: 7', 120, 'device_deleted', '2020-08-28 15:17:42'),
(132, 'Device Deleted Successfully ID: 29', 120, 'device_deleted', '2020-08-28 15:18:54'),
(133, 'Device Deleted Successfully ID: 31', 120, 'device_deleted', '2020-08-28 15:18:57'),
(134, 'Device Deleted Successfully ID: 33', 120, 'device_deleted', '2020-08-28 15:27:17'),
(135, 'Device Deleted Successfully ID: 35', 120, 'device_deleted', '2020-08-28 16:40:52'),
(136, 'Device Deleted Successfully ID: 21', 120, 'device_deleted', '2020-08-28 16:41:10'),
(137, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-28 16:41:26'),
(138, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-28 20:57:01'),
(139, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-28 20:57:10'),
(140, '!Employee Deleted sucessfully ID: 11', 120, 'employee_deleted', '2020-08-28 20:59:03'),
(141, 'Mahmoud added sucessfully!', 120, 'employee_added', '2020-08-28 20:59:57'),
(142, 'Mahmoud Updated sucessfully!', 120, 'employee_updated', '2020-08-28 21:00:18'),
(143, 'Mahmoud Updated sucessfully!', 120, 'employee_updated', '2020-08-28 21:00:33'),
(144, 'Maged added sucessfully!', 120, 'supplier_added', '2020-08-28 21:00:52'),
(145, 'Maged Updated sucessfully!', 120, 'supplier_updated', '2020-08-28 21:01:05'),
(146, 'Maged Updated sucessfully!', 120, 'supplier_updated', '2020-08-28 21:01:15'),
(147, 'Device Deleted Successfully ID: 49', 120, 'device_deleted', '2020-08-28 21:01:37'),
(148, 'New Device has Added id: Ehs451C', 120, 'new_device', '2020-08-28 21:02:50'),
(149, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-30 09:17:00'),
(150, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:34:35'),
(151, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:41:23'),
(152, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:41:29'),
(153, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:41:56'),
(154, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:42:14'),
(155, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:44:56'),
(156, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:46:43'),
(157, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:59:09'),
(158, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 12:59:52'),
(159, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:00:07'),
(160, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:02:26'),
(161, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:03:48'),
(162, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:04:05'),
(163, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:04:53'),
(164, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:05:12'),
(165, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:06:22'),
(166, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-30 13:06:29'),
(167, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:06:35'),
(168, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:06:52'),
(169, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:07:04'),
(170, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:07:32'),
(171, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:07:57'),
(172, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:08:25'),
(173, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:09:33'),
(174, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:10:30'),
(175, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:15:53'),
(176, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:15:59'),
(177, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:16:07'),
(178, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:16:26'),
(179, 'You Sent Message To: romany', 120, 'send_message', '2020-08-30 13:16:54'),
(180, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:37:36'),
(181, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:37:54'),
(182, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:38:49'),
(183, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:39:06'),
(184, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:39:22'),
(185, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:39:29'),
(186, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:40:21'),
(187, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:41:10'),
(188, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:52:24'),
(189, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:53:21'),
(190, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:54:21'),
(191, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:54:29'),
(192, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:55:40'),
(193, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:57:24'),
(194, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 13:57:46'),
(195, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:15:06'),
(196, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:17:31'),
(197, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:18:20'),
(198, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:18:46'),
(199, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:18:55'),
(200, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:20:00'),
(201, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:20:23'),
(202, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:24:34'),
(203, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:24:48'),
(204, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:26:16'),
(205, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:28:41'),
(206, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:29:14'),
(207, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:29:55'),
(208, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:30:51'),
(209, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:41:58'),
(210, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:43:25'),
(211, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:44:11'),
(212, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:45:57'),
(213, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 14:59:52'),
(214, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:00:00'),
(215, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:00:54'),
(216, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:02:07'),
(217, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:02:42'),
(218, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:03:20'),
(219, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:04:27'),
(220, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:31:34'),
(221, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:33:12'),
(222, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 15:33:45'),
(223, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:26:28'),
(224, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:35:08'),
(225, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:36:14'),
(226, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:37:25'),
(227, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:38:14'),
(228, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:38:20'),
(229, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:39:21'),
(230, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:39:36'),
(231, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:39:59'),
(232, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:40:26'),
(233, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:41:02'),
(234, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:41:12'),
(235, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:42:01'),
(236, 'You Sent Message To: shawky', 120, 'send_message', '2020-08-30 16:43:45'),
(237, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 16:59:31'),
(238, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:07:35'),
(239, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:09:54'),
(240, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:10:12'),
(241, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:12:05'),
(242, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:12:50'),
(243, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:14:03'),
(244, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:14:07'),
(245, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:14:44'),
(246, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:14:47'),
(247, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:15:10'),
(248, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:16:11'),
(249, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:16:49'),
(250, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:16:53'),
(251, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:18:50'),
(252, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:18:54'),
(253, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:21:27'),
(254, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:21:30'),
(255, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:22:05'),
(256, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:22:07'),
(257, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:22:31'),
(258, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:22:35'),
(259, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:24:04'),
(260, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:25:00'),
(261, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:25:43'),
(262, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:25:54'),
(263, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:27:12'),
(264, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:28:13'),
(265, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-30 17:28:48'),
(266, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-31 08:54:59'),
(267, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:03:11'),
(268, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:03:14'),
(269, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:03:52'),
(270, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:04:35'),
(271, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:06:14'),
(272, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:06:28'),
(273, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:06:30'),
(274, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:07:07'),
(275, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 09:11:00'),
(276, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-31 09:11:13'),
(277, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-31 10:39:36'),
(278, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-31 10:41:43'),
(279, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-31 10:43:02'),
(280, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-31 10:51:27'),
(281, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-31 10:53:14'),
(282, 'You Sent Message To: madonna', 120, 'send_message', '2020-08-31 10:56:51'),
(283, 'You Sent Message To: shawky', 120, 'send_message', '2020-08-31 10:57:45'),
(284, 'New sup added sucessfully!', 120, 'supplier_added', '2020-08-31 12:48:15'),
(285, 'another added sucessfully!', 120, 'supplier_added', '2020-08-31 12:48:42'),
(286, 'final added sucessfully!', 120, 'supplier_added', '2020-08-31 12:48:56'),
(287, 'Supplier Deleted sucessfully!', 120, 'supplier_deleted', '2020-08-31 13:01:48'),
(288, 'Last Supplier added sucessfully!', 120, 'supplier_added', '2020-08-31 13:02:14'),
(289, 'New emo added sucessfully!', 120, 'employee_added', '2020-08-31 13:08:47'),
(290, 'iaidu8dua added sucessfully!', 120, 'employee_added', '2020-08-31 13:09:03'),
(291, 'asdmauh added sucessfully!', 120, 'employee_added', '2020-08-31 13:09:25'),
(292, 'adsdadd added sucessfully!', 120, 'employee_added', '2020-08-31 13:09:39'),
(293, 'dasdsadsdasa added sucessfully!', 120, 'employee_added', '2020-08-31 13:09:52'),
(294, 'New Device has Added id: 6e55BB', 120, 'new_device', '2020-08-31 15:32:04'),
(295, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 16:05:05'),
(296, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 16:05:29'),
(297, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 16:06:16'),
(298, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 16:09:00'),
(299, 'Hey mmasokdoa New Task Added.', 120, 'task_added', '2020-08-31 16:12:40'),
(300, 'New Device has Added id: 6e55BB', 120, 'new_device', '2020-08-31 16:17:10'),
(301, 'ahmed added sucessfully!', 120, 'employee_added', '2020-08-31 16:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sup_id` int(11) NOT NULL COMMENT 'supplier_id',
  `name` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `sup_image` varchar(255) NOT NULL DEFAULT '/images/fb.jpg' COMMENT 'Supplier image',
  `sup_history` text,
  `extra_data` text,
  `added_by` varchar(50) DEFAULT NULL COMMENT 'user who created this supplier'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tables contains suppliers info';

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sup_id`, `name`, `mobile`, `sup_image`, `sup_history`, `extra_data`, `added_by`) VALUES
(1, 'Petter ', '01113722390', 'images/fb.jpg', 'Our top supplier desktop, he is cute and funny supplier, high price ', 'don\'t call him at morning', NULL),
(2, 'Hend', '0123456789', 'images/girl.png', 'She Provide us with laptops, new only', 'send what\'s up message only', NULL),
(4, 'mona2', '01113722390', './images/girl.png', 'awahuda', 'eef', 'mmasokdoa'),
(6, 'mona', '01113722390', './images/pp.jpg', 'Hello world', 'eef', 'mmasokdoa'),
(12, 'mona', '01113722390', './images/profile.jpg', 'Hello world', 'eef', 'mmasokdoa'),
(13, 'ahmed', '01113722390', './images/7.jpg', '7uu6t', 'y', 'mmasokdoa'),
(14, 'Mido', '01254652340', './images/92594783_2628694277241698_4444195011281551360_o.jpg', 'Good Supplier', 'don\'t call him at night', 'mmasokdoa'),
(16, 'New sup', '645454', './images/7.jpg', 'ioajsiojdij', 'add', 'mmasokdoa'),
(17, 'another', '6656664544', './images/92594783_2628694277241698_4444195011281551360_o.jpg', 'moljajdsojdoja', 'don\'t call him tonight', 'mmasokdoa'),
(18, 'final', '654165416541', './images/fb.jpg', 'dsjfijajefd', 'don\'t call him tonight', 'mmasokdoa'),
(19, 'Last Supplier', '4444485', './images/fb.jpg', 'Hello world again', '1545adddd', 'mmasokdoa');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `username`, `password`, `name`) VALUES
(1, 'maninmid', '$2y$10$0iiNHdVuHfJTyen8GawjtemvbrdlGwity1.a7gjicRrj2Sr6G.Mh2', 'mola'),
(2, 'bsam', '$2y$10$Z5mOTbMe9cTkRjB4UAusBeOjYNw8g5zKs1oIDbSkPQcvV8xhOX7Ji', 'fireomon'),
(3, 'nomo', '$2y$10$aPGyr6lG5BhCWxk7tEUBvuQ54XSsddKZck6jwKTfsYf8ADk9fpVE2', 'fonborg');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `important` varchar(1) NOT NULL DEFAULT 'n',
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `title`, `important`, `finished`, `create_date`, `user_id`) VALUES
(1, 'Make coffee', 'y', 1, '2020-08-17 06:50:58', 1),
(2, '1', 'y', 0, '2020-08-17 06:50:58', 12),
(3, 'zft', '0', 0, '2020-08-17 06:50:58', 10),
(4, 'Get feedback on design', '0', 0, '2020-08-17 06:50:58', NULL),
(8, 'final test', 'n', 1, '2020-08-23 10:55:20', 105),
(9, 'thanks god', 'n', 1, '2020-08-23 10:56:12', 105);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(45) NOT NULL,
  `image` text,
  `password` varchar(62) NOT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `user_image` varchar(255) NOT NULL COMMENT 'user image',
  `index_image` varchar(255) DEFAULT NULL COMMENT 'image_path_aside.php'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `image`, `password`, `id`, `username`, `user_image`, `index_image`) VALUES
('Mahmoud Hegazi', '/images/fb.jpg', 'mahmoud123', 1, '102030', '', NULL),
('Ahmed (supervisor) ', '/images/fb.jp', 'ahmed123', 2, '101213', '/get_image', NULL),
('madonna', '/images/girl.png', 'tester123', 3, '121212', '', 'images/girl.png'),
('shawky', '/images/shwky.jpg', 'shwky123', 10, '141414', '', NULL),
('michel', '/images/fb.jpg', 'michel123', 12, '151515', '', NULL),
('mahmoud', '/images/fb.jpg', '7oda123', 13, '161616', '', NULL),
('romany', '/images/fb.jpg', 'romany123', 14, '191919', '', NULL),
('wasas', NULL, '$2y$10$S.czyPh5.HcuuHvagUYUdeeEUf8pWqrjBUtZCbBkmDgc9EpsBeIey', 15, 'a', '', NULL),
('5690855', NULL, '$2y$10$rYwFRP4sNPzG1oGu7I0zBeLHvScWocXzA4B0KI0QmTRrxjsFNjURC', 16, 'Captin Mido', '', NULL),
('12ews', NULL, '$2y$10$oetV.yp4Ik2kxY221WeL..6/dCWqhzX1JT0Z/ucC2m.lXZFtfztBG', 17, 'mido', '', NULL),
('12ews1', NULL, '$2y$10$ZIiDpuePeEZcv1tujQ/wteIicOxPTO4xopNY9fkOlTxjLcO1V7eDW', 18, 'mynames', '', NULL),
('123w', NULL, '$2y$10$zMxTvFhCqaREqWFyb6tFIupvYQuvsDjNCJ54NpKh0gdVp65ZNikwC', 19, 'a', '', NULL),
('12ewsaaa11', NULL, '$2y$10$pH8vpV8DSc5YyixCu2zrd.W4ITfBoss35dgT5NG.2tgq8PreUw2sG', 20, 'a', '', NULL),
('56908551', NULL, '$2y$10$Vtgfa75opxcFn7B.w.0y7eZ2LQvzYG/eazLdkjxvbWcqD5AqknvjS', 21, 'aa', '', NULL),
('56908551', NULL, '$2y$10$.8JKnmKj6fIkx8I0BURrFuFEictJpRg/pO5Y4oGIvdBJOKrjzfcgO', 22, 'aa', '', NULL),
('56908551', NULL, '$2y$10$muH47gvlZW3kNXnJ8QpyBOtxZ0Ls9GxatKBwvhJF2KvDm79Ct1XMG', 23, 'aa', '', NULL),
('56908551', NULL, '$2y$10$rkq44s6MsKNnYU/rTP9m0OsMrUb7KPnIxrm0QEa9mSNEG9Io5dYTW', 24, 'aa', '', NULL),
('56908551333', NULL, '$2y$10$lKy3D3Py602owbMqB5YNTuNAXd81jJ.pl6morpabHlljSF73DlkSK', 25, 'aa', '', NULL),
('noob123', NULL, '$2y$10$JvgK5vuIa332zll02GLo4e2ft/QB6tB6QIcOVkgrHzVIwQBwFeuJS', 26, 'b', '', NULL),
('noob123', NULL, '$2y$10$s.KkQYjNxlkMvyXxk8m/a.g3mJCsJw0zrlqJqYb6aLPTebD1bXeWa', 27, 'b', '', NULL),
('noob123', NULL, '$2y$10$s2d6sBU4x63UPNU.xzx5pOZJVIdJ4v4xRMxBqROW0B4RVsJfYyMaq', 28, 'b', '', NULL),
('noob123', NULL, '$2y$10$G1g083p51hElSUCACCZx8.cb8ZcdiU2EsM9nw/6BHRcOJroiFCn5u', 29, 'b', '', NULL),
('manour', NULL, '$2y$10$ViaqJG6kmtgZkXhOn1xt0O1.6jK5A4JdR.1Py0CPGIR00.67lR0IK', 30, 'molo', '', NULL),
('manour', NULL, '$2y$10$rVLxvZsk4Y9iXhzL0Ae34upZcWBJK/YTU.WR0AvqE7NUFlPxkdw8W', 31, 'molo', '', NULL),
('manour', NULL, '$2y$10$zhIrOvCvPpwq/nZWN.ZcYe1jU5PfgnqWewTUQrPw8Yd9qql19nNxy', 32, 'molo', '', NULL),
('manour', NULL, '$2y$10$ZHK83VPAHuot0OQr9I0z6O7CS6l92uOWI6g9GbPUuOgwvm3GyvUEe', 33, 'molo', '', NULL),
('manour', NULL, '$2y$10$zx4BDkS/LAjLm/ar/0vW6.eIvs8mpd0bOkDjViWLfoN/S6Ay7cY7y', 34, 'molo', '', NULL),
('manour123', NULL, '$2y$10$BJUkAUjFx3yNaWZzUqXJY.RFrWw1qjPNJQVp5MGX9T967qZhw4Oky', 35, 'molo', '', NULL),
('manour123', NULL, '$2y$10$U8mV3YrDFRHodOC3hpwfteeYAKkV7p6SXsxyiKQMzIBTwW0.bJblm', 36, 'molo', '', NULL),
('manour123', NULL, '$2y$10$0YpuiioMCsJBzVW.OzTrwOWgoJpulMte7CaXpq7b6hJENJzjSVaOi', 37, 'molo', '', NULL),
('molo', NULL, '$2y$10$vtHv2.KAoqKkNiiIWCrGL.DxvYkae2qE7B4qExvGwLO7KZeNkcGHG', 38, 'manour123', '', NULL),
('midpo', NULL, '$2y$10$QTzn6rEliWFgBxkOk666Te86oeu1bH7T63TeY1v9bj3vCBFSuzpvq', 39, 'superman', '', NULL),
('omora', NULL, '$2y$10$F6fq8WpdXrc5g1nCHOjk5Oht7WcZhOVsr2YhBO8bIZSJCB/SiOtIO', 40, '126232', '', NULL),
('', NULL, '$2y$10$dEnKCfMvFiCkCNqcx9y3TOu2ZjVlc1bMTKAqN77zdT6YKSpDUWC2.', 41, 'hawiwi', '', NULL),
('', NULL, '$2y$10$GTkH98qUACNdzbKS.VSVlOSwHAopJt6ipCt3zL.Scv3K1AeXD9iIu', 42, 'godisgreat', '', NULL),
('', NULL, '$2y$10$AwgRfjT3eOiqtqdzM9KE7OKJyX7gBQej7FUgPtj/ekV8.LKN5z0uO', 43, 'himon', '', NULL),
('midon', NULL, '123456', 44, '506077', '', NULL),
('', NULL, '$2y$10$ibUzXvUQL7IpHZUltoVFhOuDDWmC38toTlIkYwfkS4EM.W7vyFrVy', 45, 'lovemygod', '', NULL),
('', NULL, '$2y$10$jGzqtWYc3jIFRsy7PbeJPeJ53LSNu3hE8RZVpDSZdMZgiGbrMFLOq', 46, 'My Friend', '', NULL),
('', NULL, '$2y$10$hqQjwvYPu8uvkvzMiWPcbuQKPNb86X7Oby3ESa4rx1Y/9WmfyJj.S', 47, 'godhelp', '', NULL),
('', NULL, '$2y$10$IpvI4LwhZn0wckxakCHsxOiTE87CHA9hcAKh5MFiC73CYX49Z2ddS', 48, 'mloka', '', NULL),
('', NULL, '$2y$10$UshrXazI9xY4JGE22jKYJeQ67ige.AVUD4LzO7aS8c03ToFp1ECf6', 49, 'mloka', '', NULL),
('', NULL, '$2y$10$mLuUjuWQlCWfdejQkhwjyOPjuhYyCuFFQLGVJOyWRVaBhD/pOkADi', 50, 'mloka', '', NULL),
('mloka', NULL, '$2y$10$vzRDpmz6Mo1aigP9LYq.EO7Wx0kuWiJyAhNfN72HKlcF6DqHWhrOW', 51, '', '', NULL),
('thanks god', NULL, '$2y$10$ElOCU7jRNzVq/UOCqfr4ee/0RYZckefIkOXDC3q5B8pxQV2ehm.ce', 52, '', 'theimage', NULL),
('thanks god', NULL, '$2y$10$UQtSwysMuXHDXH9n2CTIEOD1g8InFSOKmpLRTRS0YNdyY.dcr3Ke.', 53, '', '', NULL),
('New Name', NULL, '$2y$10$H.U.KkgMVb65Cp1i8KqPqeEi3lx3/MatIehSwzkvcbKx.7W0GmFoW', 54, '', '', NULL),
('', NULL, '$2y$10$yN9kCm5N572/q8zs0tPIkeUy.9nNbDz5DYtvWKXNJZn0x6AelNgsO', 55, '', '', NULL),
('', NULL, '$2y$10$FRqFYi8ic7l/1eksRnTXX..rpqJjBIKl1VrGGBr2V20ReAOZxIXLi', 56, '', '', NULL),
('mnoseojm', NULL, '$2y$10$qGAQ3S2DjDnxzg3fr2yzs.30MmkGZ0KNJd7ohmcPYz0mzmABNKVw2', 57, '', '', NULL),
('morenames', NULL, '$2y$10$dNRWgGxd.tgpkxpVe8KJBeEotPgRIwfXb0XfRvrvy0VKBIDb/mcrq', 59, '', '', NULL),
('', NULL, '$2y$10$ixG377lXKdH4RhRAGumxi.XBtdhlm9bEQHyLWAxo0oE.vC1XwQANK', 60, '12ews21111', '', NULL),
('awdf', NULL, '$2y$10$YmkLhR8snqtyccL.sEfGI.RKgN8Hvf3BCX7hRVFiLWQXUUaF3VKqq', 61, '12ews211111', '', NULL),
('Mahmoud', NULL, '$2y$10$2CLs065rIfw6.EUYtGDAcO9wVSPbgGdSMLCjmtO7cQ1TDoNmSQWv2', 62, '506070', '', NULL),
('', NULL, '$2y$10$9CvNVmxpa3qehRk9AEdZ5O4zHm9x0xnwW.WXaT2mfDdRsmIGxFoji', 63, '', '', NULL),
('a', NULL, '$2y$10$0nfrI3aAfD/FhSaRJdvOLO4Z66VfmijxUWS1V1oBr8865Z92Aws8i', 64, '12ews211111', '', NULL),
('', NULL, '$2y$10$02AALQFi7f9dNASKV0keeO7XTmHwmZmsmKuzRRg2YgeItvV6hL8iq', 65, '55m55', '', NULL),
('', NULL, '$2y$10$hBkW4mOqopLlqcWSXhw6ouFpVL/1FhbQHt0mmECGD.3xOaGzz6L3G', 66, 'lol1', '', NULL),
('', NULL, '$2y$10$GbdM3OrWDtZwIGf/AafHu.HiLucsFro5wyjmozsdqu2ito/F4XEcO', 67, 'for123', '', NULL),
('Xray', NULL, '$2y$10$FViygPkQ7y5eE3.Wj8W6cu5/akAcypgxkHHkD5Dcb/eV8CWeS6Ch2', 68, '12ews21111', '', NULL),
('The Final User', NULL, '$2y$10$PIV6UYa9OBAvAEzZwhfrhuJzsYHdSnsy9f.vmu3pLL7MDTAGqYtBC', 69, 'thanks123', '', NULL),
('Ilovephp', NULL, '$2y$10$RMjE2sEJbwEZalZVJ0FefOyXZ69qmMJaVqdeGF2Lkw4CXJ2gLXs5a', 70, 'nuser123', '', NULL),
('Mahmoud', NULL, '$2y$10$OJ17YfCZK9IPmyBf8.05EOQ8bOFTMAErFuoR0CQpl4K5AR3DqCj02', 71, 'mshakshak24', '', NULL),
('mido El rwash', NULL, '$2y$10$0ZtQcgtaBx6VLhHeEr601uPuYkD4lYrp4pmRQ4geJH3rTsAW3Tl.O', 72, 'fin123', '', NULL),
('mido', NULL, '$2y$10$Jkn06F9kADqJ9XKQuwq1neHYlo4AjZbvXl/doxfFjICBGJVvo.Vv2', 73, 'newuser123', '', NULL),
('Mido', NULL, '$2y$10$GzMV8d52BHbQd84qd5UZ.ujib0.pEB2PFn15nsUDhWoZnCu/Hqb4y', 74, 'user1', '', NULL),
('mido', NULL, '$2y$10$1I2HLk.fh1nouob01g.sSu/sZrveWndO//UhP2AwNyoXf6ZYGhyUK', 75, 'user1', '', NULL),
('b', NULL, '$2y$10$Vutd.1zi6EWhO7vjKCB/xePUAYCWMJczHuWPxE3VGV84t0Y9JH0ba', 76, 'user1', '', NULL),
('moko1', NULL, '$2y$10$ky8nbxcDe7fs64aGsqlUb./TVisubdJKDmRU1Sa8qOs.e3E8GLyF.', 77, '123456', '', NULL),
('olom1', NULL, '$2y$10$Rl1yghBia.mW4s4uvWBAR.cicYR82yP.g/QNkf6MdHBjz0tiNkmh2', 78, '123456', '', NULL),
('ok', NULL, '$2y$10$HqIldcn9olc6g6.fM3EWfOanJXxQoXWbPhTvagPrU4y4uKmUfm1JK', 79, '123456', '', NULL),
('', NULL, '$2y$10$zF8jkY8trdSmnbiHjY8CTeS7jPgK.4VHmKOx38jPWmPsaqMa1sVsu', 80, 'user1', '', NULL),
('', NULL, '$2y$10$XUcZ0xOOX5Dxm/n2XaV7i.96MlNOhU78KDJeADkkkgNuNZdlwH4QO', 81, '123456', '', NULL),
('11', NULL, '$2y$10$UcTRTHLdpXPDiJM1jBeYzOGNT5ghq/i2slAP6wqmjS/ckmxIxp7fq', 82, '123456', '', NULL),
('123456', NULL, '$2y$10$0JofWrZ05L.fZXAPnHdyqeNam7WK0yjsZ/Sc2FAB50qxknt2saHCu', 83, 'user1', '', NULL),
('a', NULL, '$2y$10$LOB9MuT3RTTPE5MhM0mQbe/W8FeQh21zdQ95riDKpTYZ7BeAlV7uy', 84, '123456', '', NULL),
('myname', NULL, '$2y$10$8HPjkfDb2K2BvuN6D97DyeVTqhsxn7SLbv9OWxquHjEr2y7I.Y9N6', 85, '505050', '', NULL),
('myname', NULL, '$2y$10$ijG8WkMb/e0JyA824HwDOu1Jpxk3UTIpLBD4YRtCrs/zUEbRIJYUu', 86, '505050', '', NULL),
('molom', NULL, '$2y$10$N3uT13PAq7sODuL0BwaPpuqpZhy4vnElqOGWlt2Y8V0lprOPPm6VK', 87, 'klok123', '', NULL),
('molom', NULL, '$2y$10$UM.yqxrv5eLf8I6H6piNoOkBmursABS0xJzrze6MFG/T5Kh/oacFK', 88, 'michel123', '', NULL),
('Mahmoud Man', NULL, '$2y$10$Lx3v4ByG6TvDyh/tDaHdP.vCXZ0pu86GWeE0SNGRnc.jvVvcE3A0y', 89, 'mahmoud123', '', NULL),
('', NULL, '$2y$10$p2xbjaFT3.5yieontTvQNe.lEiDYDSWEaD3zK5uwYs31cq2T.7XlK', 90, 'suermido123', '', NULL),
('mazen', NULL, '$2y$10$Wf3/P/dAFRrqqcLfB8HRK.95tXRZI/fbfQ3WyBbR.ko1RHQMFw5OS', 91, 'holako', '', NULL),
('multitask', NULL, '$2y$10$migKBybrvAyCVweh58Yeg.tMDaSYs9tRykeOUGKyi9VTFzFNmLZnC', 92, 'kol123', '', NULL),
('python', NULL, '$2y$10$YDPeyug78EcaN1vLR75SZeMpo3t/q7LXOoVZ6n8gjJXpCfZ0oPava', 93, '123456', '', NULL),
('myname', NULL, '$2y$10$nF6Iv9N9N93yNgQMZUMqrOn6U0Oni4DEVHwOIcqC6ANzK8eBcTt9a', 94, 'mynameis', '', NULL),
('Mahmoud Hegazi', NULL, '$2y$10$Lc.oTRi.t8fC2BntVXM0JOFHwM8BoxRulbUHfZseiZNVyPO9IvlHW', 95, 'myuser123', '', NULL),
('', NULL, '$2y$10$qTqzMlEFnZA9reX8mWjHauC/xIc8QXCS.79Jh4m82aiEHxhg1Gxbe', 96, 'mynewuser', '', NULL),
('masoadas', NULL, '$2y$10$CrC8P93lXmqbiqBtnThYeuT8Gg3qCKybituVbo/i0.GcLgrKrYaW6', 97, 'asdasadq', '', NULL),
('miasas', NULL, '$2y$10$2LO5b30P5Gi2KX36fQwHvOs/U0Ulp1ON5/.z7ceZVicOsYzeDpXqu', 98, 'adasdkasd', '', NULL),
('asidiqmwq', NULL, '$2y$10$3R2t1GJK6n2.w2LCJ9kRmOceoWWZ41pH89pSRIVC37GvHz6JpQAGm', 99, '123444', '', NULL),
('msandandqw', NULL, '$2y$10$EHj.x3CzmacSPgSmmw3sROF8KX03L4cUUpuUFpRLD8iLBXZNeFvse', 100, '1212121', '', NULL),
('sadadasd', NULL, '$2y$10$LRrrs3STIjsMuI0FKx0mP.EgluNtWPgY1/2MNuE.COuNmp0qaJSoC', 101, 'root11111', '', NULL),
('Mahmoud Magdi', NULL, '$2y$10$BTHAuJ6vLFtz1Tkksl.19.3XdyZMrXvlypBStswSRxQcFDzcCqvhK', 102, 'mido123', '', NULL),
('mohamed', NULL, '$2y$10$sl1FJBsns0N3dDoixHlBEe0MA/QWPraShXB0Uz5E58CnUEN26nu4e', 103, 'name123', '', NULL),
('mahmoud', NULL, '123456', 104, '123456pk', '', NULL),
('mahmoud rwsh', NULL, '$2y$10$lH5G6P6UcS7jqzok5PwYEOUn4WxLkO3TmsdXLROloe5RJ2ykuGiGy', 105, 'manhi', '', NULL),
('hello world', NULL, '$2y$10$JnmbIMbejP3fJP2WigieiuGUxaZN4xwI0SjIGiTCWCapbkyBwHpFy', 106, 'fine12345', '', NULL),
('hend', NULL, '$2y$10$wQze2EM9HtmShKjyx4iB/uj57SShHxP/KEmPBixhdRh1rPk5IuCPK', 107, 'rootmido', '', NULL),
('mario', NULL, '$2y$10$IVrfM.b3j.NwTcQJBwVMdO/5qy.Mldea.aDw4qnjnQYmVLorFitdi', 108, '464561', '', NULL),
('moza', NULL, '$2y$10$zQq.Ax5/iIvrcqi8eJInde1481ASTV0bnf2.7649cu2FTxdWc9FOi', 109, 'newfirl112', '../images/pp.jpg', NULL),
('python', NULL, '$2y$10$yyrRCyTO5b6AnA43lqj.feeAGHXKke.Qbdg8XSGsdaijyb7q4i0qi', 110, 'myhend', '../images/fb.jpg', NULL),
('hend', NULL, '$2y$10$xU0iUE5oBtIVkmnyCm6Age1N8SGti63OHoml5l3baeYwYlxYeevue', 111, 'hend22', '../images/pp.jpg', NULL),
('hend', NULL, '$2y$10$Ln/B7IIEQkhw8XoPP/kE6eLzW36GMpzusZN2GqZJANO.Rtm1W7qam', 112, 'hend33', '../images/pp.jpg', NULL),
('hend', NULL, '$2y$10$h.2hQ8e2xq2bkXBG0BXUmenPggIzWTu8jLJBkS0h158Nmoe2wM.la', 113, 'hend44', '/images/fb.jpg', NULL),
('mahmoud', NULL, '$2y$10$b54fEAwypu8GWq/GYJHVluYu/sgq2Q0JWAoczl4V0rkqDOUNbNbma', 114, 'root1211212', '/images/fb.jpg', NULL),
('mahmoud hegazi', NULL, '$2y$10$nCStrLloPcpneURfzTUareL/wZszjqvVv7PG/V7Ufe7E7qr3gm1Iy', 115, 'noobmido', '/images/fb.jpg', NULL),
('wtf', NULL, '$2y$10$EWNCgVeyOMtuFrepg5CAdulnkQvzbxr2HMg55ZIwPcH0LPs3n0Dc2', 116, 'newuser', '../images/addajax.PNG', NULL),
('mahmoud', NULL, '$2y$10$nvtdJdoVnaTHVfWdvvq2c.ujm7F0Qnw2FGc3iK5/BBP.FDh23Fo8W', 117, '454545454', '/images/fb.jpg', NULL),
('mahmoud', NULL, '$2y$10$HLlpPKnqM2my1QTW7pvZE.4sSqQ7cNJmCx/FWlGUBK9NDn5OrhULe', 118, '844445444', 'images/fb.jpg', NULL),
('mahmoud', NULL, '$2y$10$2cZYjoP45YNj0D5W.61d5OA9IxkvaXTBf43xHphdrRratUwjGsWT.', 119, '1515111as', 'images/fb.jpg', 'images/fb.jpg'),
('mmasokdoa', NULL, '$2y$10$d8pZUXbkR7Pd7.PkJDesfO5IUIGdsg5Q5z1SLjHdob4LIEKW6ZB2e', 120, 'mmasokdoa', '../images/7.jpg', 'images/7.jpg'),
('mido', NULL, '$2y$10$PBa5n9PM3qwsi07nx44s8efH4I.Jp.vU0ft0FZvnMMv7d19vEfDT2', 121, 'miro123', '../images/fb.jpg', 'images/fb.jpg'),
('mahmoud', NULL, '$2y$10$Ye9YZZctWxaY004/GGh.r.3HyBnxzXH.JAfUDlmhrA10QBY2hlF0G', 122, 'superapp123', 'images/fb.jpg', 'images/fb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `workstation`
--

CREATE TABLE `workstation` (
  `id` int(25) NOT NULL,
  `service_tag` varchar(50) NOT NULL,
  `manufacture` varchar(50) DEFAULT NULL COMMENT 'model',
  `purchased_date` date DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `history` text,
  `status` enum('old','new') DEFAULT NULL COMMENT 'new or old',
  `images` varchar(255) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `type` enum('laptop','computer','printer','scanner','camera','projector','tablet','router','accesspoint','other') NOT NULL,
  `creator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='all devices';

--
-- Dumping data for table `workstation`
--

INSERT INTO `workstation` (`id`, `service_tag`, `manufacture`, `purchased_date`, `supplier_id`, `price`, `history`, `status`, `images`, `model`, `type`, `creator`) VALUES
(2, 'BnbJMQF', 'IOS', '2018-05-12', 2, '28', 'RAM 16, HD, Screen 4 gig HD, keyboard professional, processor i5', 'new', '/images/mac1.jpg', 'Dell', 'laptop', ''),
(3, 'HNKzIQA', 'Lenovo', '2018-05-12', 2, '12', 'RAM 8, HD, Screen 4 gig HD, keyboard professional, processor i17 ', 'old', '/images/laptop', '', 'laptop', ''),
(6, 'DebFJbNQ', 'HP', '2018-05-12', 2, '14', 'RAM 2, HD, Screen 4 gig HD, keyboard professional, processor i17', 'new', '/images/mac1.jpg', '', 'laptop', ''),
(7, 'ZeAFJbNF', 'Dell', '2018-05-12', 1, '4', 'RAM 24, HD, Screen 8HD, keyboard professional, processor i17', 'old', '/images/desktop.jpg', '', 'laptop', ''),
(15, 'EFaC1a', 'bordcuo r', '2018-05-12', 2, '19', 'Very good peace i will delete it', 'old', '/includes/iamges.jpg', 'Dell', 'laptop', ''),
(18, 'newtag', 'dell', '2020-08-27', 1, '20.000,00', '45464a65s56s', 'new', 'zft', 'dell', 'laptop', 'hello world'),
(22, 'FFeeCC', 'I love egypt', '2020-08-22', 1, '9.000.000,00', 'It\'s very good device thanks udacity', 'new', 'images/myimage', 'Dell', 'laptop', 'hello world'),
(30, 'Ehs451C', 'more', '2020-08-07', 1, '2.000,00', 'hello world please work', 'new', 'images', 'Dell', 'laptop', 'hello world'),
(32, 'Ehs451C', 'Superdel', '2020-08-22', 1, '18,00', 'hello world please work', 'new', '../images/pp.jpg', 'dell', 'laptop', 'hello world'),
(34, 'Ehs451C', 'more', '2020-08-06', 1, '2.000,00', 'It\'s very good device thanks udacity', 'old', '../images/mac1.jpg', 'Dell', 'laptop', 'hello world'),
(42, 'Ehs451C', 'Superdel', '2020-08-15', 4, '2.000,00', 'Thanks udacity', 'new', '../images/mac1.jpg', 'Dell', 'computer', 'mmasokdoa'),
(48, 'asd65', 'Mynameis', '2020-08-15', 12, '3.033,00', 'new item', 'new', '../images/laptop.png', 'Dell', 'laptop', 'mmasokdoa'),
(50, 'EF45223', 'More', '2020-08-15', 6, '9.000.000,00', 'It\'s very good device thanks udacity', 'new', './images/images.jpg', 'Dell', 'camera', 'mmasokdoa'),
(51, 'Ehs451C', 'more', '2020-08-22', 14, '2.000,00', 'hello world please work', 'new', './images/the_image.PNG', 'dell', 'tablet', 'mmasokdoa'),
(60, '', NULL, NULL, 13, NULL, NULL, NULL, '', NULL, 'computer', ''),
(61, '6e55BB', 'Mynameis', '2020-08-06', 6, '1.010,00', '45464a65s56s', 'new', './images/desktop.jpg', 'dell', 'printer', 'mmasokdoa'),
(62, '6e55BB', 'Mynameis', '2020-08-15', 13, '1.010,00', 'This is my god help me', 'new', './images/fb.jpg', 'Dell', 'computer', 'mmasokdoa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `device_id` (`device_id`),
  ADD KEY `last_employee_id` (`last_employee_id`),
  ADD KEY `maintenance_ibfk_1` (`creator_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `reciver_id` (`reciver_id`);

--
-- Indexes for table `mycomment`
--
ALTER TABLE `mycomment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reciver_id` (`reciver_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workstation`
--
ALTER TABLE `workstation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `mycomment`
--
ALTER TABLE `mycomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'supplier_id', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `workstation`
--
ALTER TABLE `workstation`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `maintenance_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`sup_id`),
  ADD CONSTRAINT `maintenance_ibfk_4` FOREIGN KEY (`device_id`) REFERENCES `workstation` (`id`),
  ADD CONSTRAINT `maintenance_ibfk_5` FOREIGN KEY (`last_employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`reciver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mycomment`
--
ALTER TABLE `mycomment`
  ADD CONSTRAINT `mycomment_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `maintenance` (`id`),
  ADD CONSTRAINT `mycomment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`reciver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `workstation`
--
ALTER TABLE `workstation`
  ADD CONSTRAINT `workstation_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`sup_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
