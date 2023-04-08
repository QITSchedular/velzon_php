-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 10:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanta1`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `extendedProps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `allDay` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `url`, `title`, `start`, `end`, `extendedProps`, `allDay`, `location`, `description`) VALUES
(19, '', 'dfgd', '2023-02-16', 'undefined', 'bg-soft-danger', '!0', 'No Locationxczgdsfgd', 'asddfsd'),
(20, '', 'new ', '2023-02-17', 'undefined', 'bg-soft-danger', '!0', 'No Location', 'Meeting for campaign with sales team'),
(21, '', 'new events', '2023-02-25', 'undefined', 'bg-soft-primary', '!0', 'No Location', 'nothing new'),
(22, '', 'my event', '2023-02-26', 'undefined', 'bg-soft-danger', '!0', 'No Location', 'zdsfdfdfg'),
(23, '', 'new eventd', '2023-02-27 ', ' 2023-02-28', 'bg-soft-warning', '!0', 'No Location', 'sdxcsadadf'),
(24, '', 'edefwedw', '2023-02-28', 'undefined', 'bg-soft-success', '!0', 'sdcfsds', 'dcsdc'),
(25, '', 'my events', '2023-03-01', 'undefined', 'bg-soft-info', '!1', 'nothing', 'dcsdcasx');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatid` int(11) NOT NULL,
  `sender_userid` varchar(255) NOT NULL,
  `reciever_userid` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `id_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatid`, `sender_userid`, `reciever_userid`, `message`, `timestamp`, `status`, `id_deleted`) VALUES
(1, 'emp63bd695', 'emp63bd69c', 'hello', '2023-02-27 10:12:55', 0, 0),
(2, 'emp63bd69c', 'emp63bd695', 'hello', '2023-02-27 12:06:44', 0, 0),
(3, 'emp63bd69c', 'emp63bd695', 'Hey', '2023-02-27 13:04:45', 0, 0),
(4, 'emp63bd69c', 'emp63bd695', 'cxcsxdsdsd', '2023-02-27 13:20:26', 0, 0),
(5, 'emp63bd69c', 'emp63bd695', 'xcxzzxdsds', '2023-02-27 14:23:09', 0, 0),
(6, 'emp63bd69c', 'emp63bd695', 'Hely', '2023-02-28 08:20:24', 0, 0),
(7, 'emp63bd695', 'emp63bd69c', 'Hello', '2023-02-28 08:34:28', 0, 0),
(9, 'emp63bd695', 'emp63bd69c', 'Hey', '2023-02-28 08:35:14', 0, 0),
(10, 'emp63bd695', 'emp63bd69c', 'Hello', '2023-02-28 08:37:46', 0, 0),
(11, 'emp63bd695', 'emp63bd69c', 'My name is vivek', '2023-02-28 08:38:45', 0, 0),
(12, 'emp63bd69c', 'emp63bd695', 'hey', '2023-02-28 08:39:03', 0, 0),
(13, 'emp63bd695', 'emp63bd69c', 'Yes', '2023-02-28 08:39:57', 0, 0),
(14, 'emp63bd695', 'emp63bd69c', 'Hey', '2023-02-28 08:42:25', 0, 0),
(16, 'emp63bd69c', 'emp63bd695', 'Hii', '2023-02-28 08:43:57', 0, 1),
(18, 'emp63bd69c', 'emp63bd695', 'Hry', '2023-02-28 08:50:27', 0, 0),
(19, 'emp63bd69c', 'emp63bd695', 'hey', '2023-02-28 09:02:38', 0, 1),
(22, 'emp63bd695', 'emp63bd69c', 'Helu', '2023-02-28 09:19:23', 1, 1),
(24, 'emp63bd69c', 'emp63bd695', 'Helu', '2023-02-28 09:25:00', 0, 1),
(25, 'emp63bd695', 'emp63bd69c', 'Hey', '2023-02-28 12:28:28', 1, 0),
(26, 'emp63bd695', 'emp63bd69c', 'Hello', '2023-03-01 10:44:37', 1, 0),
(27, 'emp63bd695', 'emp63bd69c', '😋', '2023-03-01 11:14:58', 1, 1),
(28, 'emp63bd695', 'emp63bd69c', '???????????', '2023-03-01 12:26:58', 1, 1),
(29, 'emp63bd695', 'emp63bd69c', '🤗🤗', '2023-03-01 12:39:24', 1, 0),
(30, 'emp63bd695', 'emp63bd69c', 'xcdf', '2023-03-01 13:13:54', 1, 0),
(31, 'emp63bd695', 'emp63bd69c', 'heelo lakhlani', '2023-03-01 13:22:06', 1, 0),
(32, 'emp63bd695', 'emp63bd69c', 'hy', '2023-03-01 13:23:18', 1, 0),
(33, 'emp63bd695', 'emp63bd69c', 'hello', '2023-03-01 13:23:26', 1, 1),
(34, 'emp63bd695', 'emp63bd69c', 'hello', '2023-03-01 13:24:07', 1, 0),
(35, 'emp63bd695', 'emp63bd69c', 'hy', '2023-03-01 13:30:20', 1, 0),
(36, 'emp63bd695', 'emp63bd69c', 'Hey', '2023-03-01 13:43:49', 1, 0),
(37, 'emp63bd695', 'emp63bd69c', 'Hello', '2023-03-01 13:44:27', 1, 0),
(38, 'emp63bd695', 'emp63bd69c', 'Hey', '2023-03-01 13:45:27', 1, 0),
(39, 'emp63bd695', 'emp63bd69c', 'He', '2023-03-01 13:46:04', 1, 1),
(40, 'emp63bd695', 'emp63bd69c', 'Hii', '2023-03-01 13:47:06', 1, 0),
(41, 'emp63bd695', 'emp63bd69c', 'Hey', '2023-03-01 13:48:21', 1, 0),
(42, 'emp63bd695', 'emp63bd69c', 'Hi', '2023-03-01 13:50:59', 1, 0),
(43, 'emp63bd695', 'emp63bd69c', 'Hey', '2023-03-01 13:51:19', 1, 0),
(44, 'emp63ff5e1', 'emp63bd695', 'Hello', '2023-03-01 14:18:00', 0, 0),
(45, 'emp63bd695', 'emp63ff5e1', 'Hey', '2023-03-01 14:18:53', 0, 0),
(46, 'emp63ff5e1', 'emp63bd695', 'dcdcs', '2023-03-01 14:42:57', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_login_details`
--

CREATE TABLE `chat_login_details` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_typing` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chat_login_details`
--

INSERT INTO `chat_login_details` (`id`, `userid`, `last_activity`, `is_typing`) VALUES
(1, 'emp63bd695', '2023-02-27 13:04:21', 'no'),
(2, 'emp63bd69c', '2023-02-28 12:31:49', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `childtb`
--

CREATE TABLE `childtb` (
  `child_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `emp_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `childtb`
--

INSERT INTO `childtb` (`child_id`, `name`, `birthdate`, `age`, `gender`, `emp_code`) VALUES
(6, 'viren', '2023-02-13', 0, 'boy', 'emp63bd69c'),
(7, 'Sawyer Harrell', '2020-09-05', 2, 'boy', 'emp63c659b');

-- --------------------------------------------------------

--
-- Table structure for table `clienttb`
--

CREATE TABLE `clienttb` (
  `ID` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `phone_number1` varchar(255) NOT NULL,
  `phone_number2` varchar(255) NOT NULL,
  `client_nick_name` varchar(255) NOT NULL,
  `billing_rate` float NOT NULL,
  `fax` int(11) NOT NULL,
  `website` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clienttb`
--

INSERT INTO `clienttb` (`ID`, `client_id`, `client_name`, `email`, `address`, `country`, `state`, `city`, `zipcode`, `phone_number1`, `phone_number2`, `client_nick_name`, `billing_rate`, `fax`, `website`, `notes`, `img`) VALUES
(69, 'Client04444417', 'Phillip Mays', 'cydyvyte@mailinator.com', 'Voluptatum mollit es', '', '', '', 388512, '9856321452', '9874521452', 'Judah Montgomery', 25, 421364, 'https://www.pukyby.org', 'Obcaecati incidunt ', 'photo2.jpg'),
(74, 'Client06576216', 'Wing Gomez', 'civycira@mailinator.com', 'Et omnis quo rerum i', '', '', '', 510355, '3541266672', '4112326352', 'Fiona Osborn', 58, 325244, 'https://www.kyrycecuwu.tv', 'Voluptate alias dese', 'img-8.png'),
(76, 'Client07101770', 'Frances Bender', 'qacefeq@mailinator.com', 'Proident nostrud si', '', '', '', 776645, '7611212121', '1421245455', 'Dale Pratt', 3, 854545, 'https://www.winypibacifyn.cc', 'Provident reiciendi', 'img-8.png'),
(80, 'Client12100506', 'Cain Parrish', 'notecyl@mailinator.com', 'Quis assumenda minim', '', '', '', 780665, '4244444444', '8015454454', 'Brynne Myers', 6, 405454, 'https://www.favakudaby.me.uk', 'Suscipit dicta repre', 'img-7.png'),
(82, 'Client12676762', 'viren', 'mojocava@mailinator.com', 'Adipisicing obcaecat', '', '', '', 941154, '1545784544', '9278451245', 'Emily Hahn', 10, 100456, 'https://www.xasuvoxerodyre.me', 'Facilis molestiae cu', '9.png'),
(79, 'Client13176517', 'Rhona Rice', 'texida@mailinator.com', 'Consequatur veniam', '', '', '', 149195, '8456987458', '6654545454', 'Donna Owens', 96, 275455, 'https://www.hedupynisubi.org', 'Ex molestias officii', '9.png'),
(81, 'Client32667711', 'Debra Villarreal', 'regym@mailinator.com', 'Ea voluptatem sint ', '', '', '', 338684, '6652416636', '9225636666', 'Libby Browning', 19, 904125, 'https://www.tenyxofecysoxuh.info', 'Nihil est natus mol', 'img-6.png'),
(26, 'Client53230117', 'Pascale Sutton', 'wacile@mailinator.com', 'Et qui corrupti ea ', 'c_91', 'S_1', 'Ci_1', 622251, '8741254125', '4569874563', 'Courtney Bridges', 12, 181254, 'https://www.wanisu.org', 'Consequat Voluptate', ''),
(78, 'Client62176861', 'Medge Rosa', 'bosivi@mailinator.com', 'Sapiente nulla liber', '', '', '', 604462, '5325412536', '4625426333', 'Leroy Fisher', 95, 584545, 'https://www.kytugubepiboraz.ws', 'Et nostrum id aut in', 'img-7.png'),
(27, 'Client67565245', 'Merritt Patterson', 'qyby@mailinator.com', 'Quam sed placeat ex', 'c_91', '', '', 326811, '4597563214', '9173568956', 'Alden Dejesus', 7845, 254512, 'https://www.satyqu.cc', 'Animi reiciendis qu', ''),
(77, 'Client79840711', 'Hayes Munoz', 'vicu@mailinator.com', 'Dolore quis quo sequ', '', '', '', 912816, '1021212121', '4221212121', 'Eugenia Robles', 14, 985665, 'https://www.fimasibameta.co', 'Velit enim consequat', 'img-3.png');

-- --------------------------------------------------------

--
-- Table structure for table `departmenttb`
--

CREATE TABLE `departmenttb` (
  `dept_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departmenttb`
--

INSERT INTO `departmenttb` (`dept_id`, `name`, `location`) VALUES
(1, 'IT', 'Surat'),
(2, 'HR', 'Surat'),
(3, 'R & D', 'Surat'),
(4, 'Finance', 'Surat');

-- --------------------------------------------------------

--
-- Table structure for table `employeetb`
--

CREATE TABLE `employeetb` (
  `emp_id` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `hiredate` date DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `current_session` varchar(255) NOT NULL,
  `online` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeetb`
--

INSERT INTO `employeetb` (`emp_id`, `emp_code`, `email`, `password`, `firstname`, `middlename`, `lastname`, `role`, `hiredate`, `dept_id`, `current_session`, `online`) VALUES
(2, 'emp63bd695', 'admin@gmail.com', 'Admin@123', 'admin', 'admin', 'admin', 'admin', '0000-00-00', 1, '0', 0),
(3, 'emp63bd69c', 'vivek@gmail.com', 'Vivek@123', 'vivek', 'S', 'Lakhlani', 'manager', '2015-01-01', 1, 'emp63bd695', 1),
(4, 'emp63bd6db', 'vihan@gmail.com', 'Vihan@123', 'vihan', 's', 'L', 'manager', NULL, 2, '0', 0),
(5, 'emp63bd6df', 'abc@gmail.com', 'Abcd@123', 'abc', 'abc', 'abc', 'manager', NULL, 2, '0', 0),
(6, 'emp63bd708', 'gibiholaho@mailinator.com', 'Abc@1234', 'Hammett Pierce', 'Nolan Bradshaw', 'Nasim Phelps', 'manager', NULL, 3, '0', 0),
(8, 'emp63c659b', 'sajepe@mailinator.com', 'Pa$$w0rd!', 'Sandra Myers', 'Wyoming Stanley', 'Justin Estrada', 'user', NULL, 1, '0', 0),
(10, 'emp63e0fb2', 'wenicu@mailinator.com', 'Pa$$w0rd!', 'Marcia Franklin', 'Erin Alford', 'Paul Dillard', 'user', NULL, 4, '0', 0),
(12, 'emp63ff5e1', 'pooja@gmail.com', 'Pooja@123', 'pooja', 'patel', 'sds', 'admin', NULL, 1, 'emp63bd69c', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp_extra_infotb`
--

CREATE TABLE `emp_extra_infotb` (
  `emp_code` varchar(255) NOT NULL,
  `emp_gender` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `spouse_birthdate` date DEFAULT NULL,
  `emp_birthdate` date DEFAULT NULL,
  `anniversary_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_extra_infotb`
--

INSERT INTO `emp_extra_infotb` (`emp_code`, `emp_gender`, `spouse_name`, `spouse_birthdate`, `emp_birthdate`, `anniversary_date`) VALUES
('emp63bd695', NULL, NULL, NULL, '0000-00-00', NULL),
('emp63bd69c', 'male', 'zxzxx', '2023-02-03', '1999-02-27', '2023-02-18'),
('emp63bd6db', NULL, NULL, NULL, NULL, NULL),
('emp63bd6df', NULL, NULL, NULL, NULL, NULL),
('emp63bd708', NULL, NULL, NULL, NULL, NULL),
('emp63c659b', 'female', 'Gray Patel', '1973-11-07', '1992-02-13', '1981-10-04'),
('emp63c659f', NULL, NULL, NULL, NULL, NULL),
('emp63e0fb2', NULL, NULL, NULL, NULL, NULL),
('emp63ff5bd', NULL, NULL, NULL, NULL, NULL),
('emp63ff5e1', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_personal_infotb`
--

CREATE TABLE `emp_personal_infotb` (
  `emp_code` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `home_phoneNO` varchar(255) NOT NULL,
  `work_phoneNO` varchar(255) NOT NULL,
  `personal_phoneNO` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `dept_location` varchar(255) NOT NULL,
  `e_status` varchar(255) NOT NULL,
  `e_manager` varchar(255) NOT NULL,
  `working_day_type` varchar(255) NOT NULL,
  `termination_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_personal_infotb`
--

INSERT INTO `emp_personal_infotb` (`emp_code`, `address`, `state`, `city`, `zip_code`, `country`, `home_phoneNO`, `work_phoneNO`, `personal_phoneNO`, `signature`, `profile_picture`, `job_title`, `dept_location`, `e_status`, `e_manager`, `working_day_type`, `termination_date`) VALUES
('emp63bd695', '', '', 'surat', 395004, 'gujarat', '', '', '1236547896', '', 'avatar-8.jpg', '', '', '', '', '', '0000-00-00'),
('emp63bd69c', '', '', '', 0, '', '', '', '', '', '', 'abc', 'Surat', 'active', 'none', 'fulltime', '0000-00-00'),
('emp63bd6db', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00'),
('emp63bd6df', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00'),
('emp63bd708', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00'),
('emp63c659b', 'surat', '', '', 395004, '', '7845123698', '1254789632', '9874563214', '', '', '', '', '', '', '', '0000-00-00'),
('emp63c659f', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00'),
('emp63e0fb2', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00'),
('emp63ff5bd', '', '', '', 0, '', '', '', '', '', '12.png', '', '', '', '', '', '0000-00-00'),
('emp63ff5e1', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `filetb`
--

CREATE TABLE `filetb` (
  `file_id` int(11) NOT NULL,
  `p_id` varchar(255) NOT NULL,
  `e_id` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `u_date` date NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filetb`
--

INSERT INTO `filetb` (`file_id`, `p_id`, `e_id`, `file_name`, `u_date`, `type`, `size`) VALUES
(69, '20', 'emp63bd695', 'JVR_BOOTCAMP.docx', '2023-02-02', 'docx File', '0.002 MB'),
(70, '20', 'emp63bd695', 'JVR_BOOTCAMP.pdf', '2023-02-02', 'pdf File', '0.009 MB'),
(71, '21', 'emp63bd695', 'Hospital_management_system.pdf', '2023-02-02', 'pdf File', '0.06 MB'),
(72, '22', 'emp63bd695', '2.png', '2023-02-08', 'png File', '0.007 MB'),
(73, '22', 'emp63bd695', '3.png', '2023-02-08', 'png File', '0.006 MB'),
(76, '3', 'emp63bd695', 'Hospital_management_system.pdf', '2023-02-08', 'pdf File', '0.06 MB'),
(77, '', 'emp63bd695', 'Hospital_management_system.pdf', '2023-02-08', 'pdf File', '0.06 MB'),
(78, '20', 'emp63bd695', 'Hospital_management_system.pdf', '2023-02-08', 'pdf File', '0.06 MB'),
(79, '23', 'emp63bd695', 'JVR_BOOTCAMP.docx', '2023-02-09', 'docx File', '0.002 MB'),
(80, '23', 'emp63bd695', 'JVR_BOOTCAMP.pdf', '2023-02-09', 'pdf File', '0.009 MB'),
(81, '24', 'emp63bd695', 'APIs.docx', '2023-02-10', 'docx File', '0.003 MB'),
(82, '25', 'emp63ff5e1', 'img1.jpeg', '2023-03-01', 'jpeg File', '0.002 MB'),
(83, '28', 'emp63bd695', 'no-events.gif', '2023-03-02', 'gif File', '0.015 MB'),
(84, '29', 'emp63bd695', 'loader.gif', '2023-03-02', 'gif File', '0.014 MB');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `emp_code` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `instagram_portfolio` varchar(255) NOT NULL,
  `github_portfolio` varchar(255) NOT NULL,
  `facebook_portfolio` varchar(255) NOT NULL,
  `linkedin_portfolio` varchar(255) NOT NULL,
  `bg_cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`emp_code`, `skills`, `description`, `instagram_portfolio`, `github_portfolio`, `facebook_portfolio`, `linkedin_portfolio`, `bg_cover`) VALUES
('emp63bd695', 'css,html,javascript,python,php', 'hello howare you admin i m vivek lakhlani you are very lucky to join our company Quanta ......', 'https://www.instagram.com', 'https://github.com/viveklakhlani2401', 'https://www.facebook.com', 'https://in.linkedin.com', 'img-9.jpg'),
('emp63ff5e1', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `projecttask`
--

CREATE TABLE `projecttask` (
  `taskId` varchar(255) NOT NULL,
  `taskCode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `assignedBy` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `Priority` varchar(255) NOT NULL,
  `project_code` int(11) NOT NULL,
  `approvetype` varchar(255) NOT NULL DEFAULT 'submitted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projecttask`
--

INSERT INTO `projecttask` (`taskId`, `taskCode`, `name`, `emp_name`, `assignedBy`, `start_date`, `Priority`, `project_code`, `approvetype`) VALUES
('Task63c667', '3_1', 'abc', 'emp63bd6db', 'emp63bd695', '2023-01-12', 'Important', 3, 'submitted');

-- --------------------------------------------------------

--
-- Table structure for table `projecttb`
--

CREATE TABLE `projecttb` (
  `project_id` varchar(255) NOT NULL,
  `project_code` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` varchar(255) NOT NULL,
  `estimate_cost` varchar(255) NOT NULL,
  `project_desc` varchar(255) NOT NULL,
  `project_type` varchar(255) NOT NULL,
  `team_leader` varchar(255) NOT NULL,
  `project_manager` varchar(255) NOT NULL,
  `timesheet_approval` varchar(255) NOT NULL,
  `expense_approval` varchar(255) NOT NULL,
  `fixed_cost` varchar(255) NOT NULL,
  `bill_rate` varchar(255) NOT NULL,
  `bill_type` varchar(255) NOT NULL,
  `bill_rate_type` varchar(255) NOT NULL,
  `attach_name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_dept` varchar(255) NOT NULL,
  `client_contactNo` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projecttb`
--

INSERT INTO `projecttb` (`project_id`, `project_code`, `project_name`, `status`, `start_date`, `end_date`, `duration`, `estimate_cost`, `project_desc`, `project_type`, `team_leader`, `project_manager`, `timesheet_approval`, `expense_approval`, `fixed_cost`, `bill_rate`, `bill_type`, `bill_rate_type`, `attach_name`, `file_name`, `client_id`, `client_dept`, `client_contactNo`, `isActive`) VALUES
('p63bd6e8d0', 3, 'project1', 'started', '2023-01-05', '2023-01-31', '150', '150', 'abcss', 'abc', '', '', 'None', 'None', '', '', '', '', '', 'Hospital_management_system.docx,Hospital_management_system.pdf,', 'Client53230117', 'abc', '', 1),
('p63e4ecb49', 23, 'project2', 'onhold', '2023-02-09', '2023-02-28', '', '', 'sdsdsaas', '', '', '', '', '', '', '', '', '', '', '', 'Client04444417', '', '', 0),
('p63e62cc39', 24, 'timepass', 'completed', '2023-02-02', '2023-02-28', '', '', 'zcxzx', '', '', '', '', '', '', '', '', '', '', '', 'Client32667711', '', '', 0),
('p6400a3b90', 27, '', '', '2023-03-02', '2023-03-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0),
('p6400ac81c', 30, '', '', '2023-03-23', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projectteamtb`
--

CREATE TABLE `projectteamtb` (
  `id` int(11) NOT NULL,
  `project_code` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `isManager` tinyint(1) NOT NULL DEFAULT 0,
  `isTeamLeader` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectteamtb`
--

INSERT INTO `projectteamtb` (`id`, `project_code`, `emp_code`, `isManager`, `isTeamLeader`) VALUES
(78, 3, 'emp63bd69c', 1, 1),
(80, 3, 'emp63bd6db', 1, 0),
(81, 3, 'emp63bd6df', 1, 0),
(82, 23, 'emp63c659b', 0, 0),
(83, 23, 'emp63bd6db', 1, 1),
(84, 23, 'emp63bd6df', 1, 0),
(85, 23, 'emp63bd708', 0, 0),
(87, 24, 'emp63e0fb2', 0, 0),
(88, 24, 'emp63bd708', 1, 1),
(89, 24, 'emp63bd6df', 1, 0),
(90, 24, 'emp63bd6db', 0, 0),
(91, 3, 'emp63bd708', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projectteamtb_temp`
--

CREATE TABLE `projectteamtb_temp` (
  `id` int(11) NOT NULL,
  `project_code` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE `suggestion` (
  `s_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `s_body` varchar(255) NOT NULL,
  `e_id` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `chk_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`s_id`, `title`, `s_body`, `e_id`, `date_time`, `chk_read`) VALUES
('sid63de58a', 'Enim provident culp', 'Lorem doloribus ut e', 'emp63bd695', '2023-03-02 10:41:03', 1),
('sid63de5f5', 'Doloremque proident', 'Alias quisquam culpa', 'emp63bd695', '2023-03-02 10:41:04', 1),
('sid63de5f7', 'Delectus culpa illu', 'Rerum non ducimus l', 'emp63bd695', '2023-03-02 10:41:04', 1),
('sid63fc961', 'nothing', 'saxsdfgdgfdsa', 'emp63bd695', '2023-03-02 10:41:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` varchar(255) NOT NULL,
  `p_id` int(255) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unassigned',
  `sdate` date NOT NULL,
  `priority` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `p_id`, `emp_code`, `title`, `description`, `status`, `sdate`, `priority`) VALUES
('Task07014111', 3, 'emp63bd69c,emp63bd6db', 'Martina', 'Aliquid voluptates r', 'todo', '2023-01-27', 'Important'),
('Task18181618', 3, 'emp63bd6df', 'Bree Curtis', 'Rem earum ex officii', 'inprogress', '2023-01-27', 'Important'),
('Task58688161', 3, 'emp63bd69c,emp63bd6df', 'Riley Stuart', 'Dicta id adipisicin', 'completed', '2023-01-27', 'Important'),
('Task49831191', 3, 'emp63bd69c,emp63bd6df', 'Sophia Hughes', 'Velit vero officia e', 'todo', '2023-01-28', 'Important and urgent'),
('Task10080011', 3, 'emp63bd69c', 'Yolanda Juarez', 'Sit debitis id labo', 'inprogress', '2023-01-27', 'Urgent'),
('Task20271377', 3, 'emp63bd6db', 'vivek', 'dsasdasd', 'todo', '2023-02-02', 'Neither'),
('Task24123462', 3, 'emp63bd69c,emp63c659b,emp63bd6df', 'new task', 'Velit animi quis el', 'unassigned', '2023-02-27', 'Urgent');

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `id` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `p_code` int(11) NOT NULL,
  `p_task` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `submit_date` date NOT NULL DEFAULT current_timestamp(),
  `approve_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatid`);

--
-- Indexes for table `chat_login_details`
--
ALTER TABLE `chat_login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `childtb`
--
ALTER TABLE `childtb`
  ADD PRIMARY KEY (`child_id`),
  ADD KEY `del_child_emp` (`emp_code`);

--
-- Indexes for table `clienttb`
--
ALTER TABLE `clienttb`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `departmenttb`
--
ALTER TABLE `departmenttb`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employeetb`
--
ALTER TABLE `employeetb`
  ADD PRIMARY KEY (`emp_code`),
  ADD UNIQUE KEY `emp_id` (`emp_id`),
  ADD KEY `dfk` (`dept_id`);

--
-- Indexes for table `emp_extra_infotb`
--
ALTER TABLE `emp_extra_infotb`
  ADD KEY `expifk` (`emp_code`);

--
-- Indexes for table `emp_personal_infotb`
--
ALTER TABLE `emp_personal_infotb`
  ADD KEY `del_emp` (`emp_code`);

--
-- Indexes for table `filetb`
--
ALTER TABLE `filetb`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD KEY `frn` (`emp_code`);

--
-- Indexes for table `projecttask`
--
ALTER TABLE `projecttask`
  ADD KEY `del_pro_task` (`project_code`);

--
-- Indexes for table `projecttb`
--
ALTER TABLE `projecttb`
  ADD PRIMARY KEY (`project_code`),
  ADD UNIQUE KEY `project_id` (`project_id`),
  ADD KEY `fkey` (`client_id`);

--
-- Indexes for table `projectteamtb`
--
ALTER TABLE `projectteamtb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_proj` (`project_code`),
  ADD KEY `team_emp` (`emp_code`);

--
-- Indexes for table `projectteamtb_temp`
--
ALTER TABLE `projectteamtb_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `del_emp_pro_temp` (`emp_code`),
  ADD KEY `del_pro_temp_team` (`project_code`);

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `del_sug_emp` (`e_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD KEY `chk_p_id` (`p_id`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `del_timesheet` (`emp_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `chat_login_details`
--
ALTER TABLE `chat_login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `childtb`
--
ALTER TABLE `childtb`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clienttb`
--
ALTER TABLE `clienttb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `employeetb`
--
ALTER TABLE `employeetb`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `filetb`
--
ALTER TABLE `filetb`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `projecttb`
--
ALTER TABLE `projecttb`
  MODIFY `project_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `projectteamtb`
--
ALTER TABLE `projectteamtb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `projectteamtb_temp`
--
ALTER TABLE `projectteamtb_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `frn` FOREIGN KEY (`emp_code`) REFERENCES `employeetb` (`emp_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projectteamtb`
--
ALTER TABLE `projectteamtb`
  ADD CONSTRAINT `del_emp` FOREIGN KEY (`project_code`) REFERENCES `projecttb` (`project_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `chk_p_id` FOREIGN KEY (`p_id`) REFERENCES `projecttb` (`project_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
