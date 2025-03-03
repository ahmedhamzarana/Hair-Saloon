-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 08:07 AM
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
-- Database: `hairsaloon`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `stylist_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cancelappoint`
--

CREATE TABLE `cancelappoint` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `stylist_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancelappoint`
--

INSERT INTO `cancelappoint` (`id`, `client_id`, `stylist_id`, `service_id`, `time_id`) VALUES
(2, 5, 7, 2, 3),
(3, 5, 7, 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `confirmappoint`
--

CREATE TABLE `confirmappoint` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `stylist_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `price` int(11) DEFAULT 0,
  `totalprice` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmappoint`
--

INSERT INTO `confirmappoint` (`id`, `client_id`, `stylist_id`, `service_id`, `time_id`, `status`, `price`, `totalprice`, `created_at`, `updated_at`) VALUES
(1, 5, 7, 2, 6, 1, 120, 280, '2024-12-29 14:28:45', '2024-12-29 14:28:45'),
(2, 5, 8, 3, 23, 1, 90, 210, '2024-12-27 16:18:57', '2024-12-27 16:18:57'),
(3, 5, 7, 2, 17, 1, 0, 0, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(4, 5, 8, 3, 22, 1, 90, 210, '2024-12-27 16:19:04', '2024-12-27 16:19:04'),
(5, 5, 8, 3, 20, 0, 0, 0, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(7, 5, 8, 3, 21, 0, 0, 0, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(8, 5, 7, 1, 13, 1, 75, 0, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(9, 5, 7, 2, 1, 1, 0, 0, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(10, 5, 7, 2, 4, 1, 0, 0, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(11, 5, 7, 2, 5, 1, 400, 0, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(12, 5, 7, 4, 7, 1, 400, 0, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(13, 10, 7, 1, 15, 1, 75, 175, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(14, 5, 7, 4, 12, 1, 120, 280, '2024-12-27 15:53:27', '2024-12-27 15:55:52'),
(15, 5, 7, 3, 8, 1, 90, 210, '2024-12-27 15:57:05', '2024-12-27 15:57:05'),
(16, 5, 8, 1, 24, 0, 0, 0, '2024-12-27 16:17:49', '2024-12-27 16:17:49'),
(17, 5, 7, 3, 50, 1, 90, 210, '2025-01-04 07:32:15', '2025-01-04 07:32:15'),
(18, 5, 8, 1, 19, 0, 0, 0, '2024-12-31 19:28:26', '2024-12-31 19:28:26'),
(19, 10, 7, 4, 56, 1, 120, 280, '2025-01-04 07:32:23', '2025-01-04 07:32:23'),
(20, 5, 7, 2, 58, 1, 120, 280, '2025-01-05 11:08:05', '2025-01-05 11:08:05'),
(21, 5, 7, 2, 84, 0, 0, 0, '2025-01-04 07:23:48', '2025-01-04 07:23:48'),
(22, 5, 7, 2, 85, 0, 0, 0, '2025-01-05 12:20:27', '2025-01-05 12:20:27'),
(23, 5, 7, 1, 83, 0, 0, 0, '2025-01-05 12:23:13', '2025-01-05 12:23:13'),
(24, 5, 7, 4, 87, 0, 0, 0, '2025-01-07 06:41:48', '2025-01-07 06:41:48'),
(25, 5, 7, 1, 135, 0, 0, 0, '2025-01-07 06:41:51', '2025-01-07 06:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Rohan', 'rohan@gmail.com', 'Hair Cut', 'Great Hair cut');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `min_quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `quantity`, `min_quantity`, `price`, `supplier`) VALUES
(1, 'Shampoo', 10, 5, 500, 'rafayshaikh405@gmail.com'),
(2, 'Scissor', 1, 3, 100, 'Renee@gmail.com'),
(3, 'cream', 208, 5, 150, 'vendor@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `stylist_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `stylist_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(15, 8, 5, 3, 'Great', '2024-12-31 06:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `servicesname` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `servicesname`, `price`, `image`) VALUES
(1, 'Haircut', 250, 'haircut.png'),
(2, 'Manicure', 400, 'stacking.png'),
(3, 'Facial', 300, 'spa.png'),
(4, 'Mustache', 400, 'mustache.png'),
(5, 'Hair Styling', 100, 'beard-trim.png'),
(6, 'Beard', 200, 'beard-trim.png'),
(7, 'Hair  Dye', 1000, 'hair-dyeing.png'),
(13, 'Steaming', 2000, 'stacking.png');

-- --------------------------------------------------------

--
-- Table structure for table `stylists`
--

CREATE TABLE `stylists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `qualification` varchar(50) DEFAULT NULL,
  `salary` bigint(20) DEFAULT NULL,
  `services` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `portfolio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stylists`
--

INSERT INTO `stylists` (`id`, `user_id`, `experience`, `qualification`, `salary`, `services`, `image`, `portfolio`) VALUES
(7, 2, '20 Years', 'graduate', 100000, 2, 'team-4.jpg', 'team-4.jpg'),
(8, 6, '10 Years', 'Intermediate', 5000, 3, 'team-2.jpg', 'team-2.jpg'),
(9, 7, '20', 'matric', 2000, 2, 'team-3.jpg', 'team-3.jpg'),
(10, 8, '1 year', 'matric', 30000, 4, 'team-4.jpg', 'team-4.jpg'),
(13, 9, '12', 'matrics', 43820924, NULL, 'team-2.jpg', 'team-2.jpg'),
(14, 19, '2 years', 'intermediate', 10000, NULL, 'team-3.jpg', 'team-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stylist_services`
--

CREATE TABLE `stylist_services` (
  `stylist_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stylist_services`
--

INSERT INTO `stylist_services` (`stylist_id`, `service_id`) VALUES
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(8, 1),
(8, 2),
(8, 5),
(9, 1),
(9, 3),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(14, 4),
(14, 6),
(14, 7);

-- --------------------------------------------------------

--
-- Table structure for table `stylist_slots`
--

CREATE TABLE `stylist_slots` (
  `id` int(11) NOT NULL,
  `stylist_id` int(11) NOT NULL,
  `slot_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0: Available, 1: Booked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stylist_slots`
--

INSERT INTO `stylist_slots` (`id`, `stylist_id`, `slot_date`, `start_time`, `end_time`, `status`) VALUES
(1, 7, '2024-12-18', '12:00:00', '13:00:00', 1),
(3, 7, '2024-12-17', '12:00:00', '13:00:00', 1),
(4, 7, '2024-12-17', '13:00:00', '14:00:00', 1),
(5, 7, '2024-12-16', '12:00:00', '13:00:00', 1),
(6, 7, '2024-12-16', '13:00:00', '14:00:00', 1),
(7, 7, '2024-12-19', '12:00:00', '13:00:00', 1),
(8, 7, '2024-12-19', '13:00:00', '14:00:00', 1),
(9, 7, '2024-12-20', '12:00:00', '13:00:00', 0),
(10, 7, '2024-12-20', '13:00:00', '14:00:00', 1),
(12, 7, '2024-12-23', '11:43:00', '12:43:00', 1),
(13, 7, '2024-12-23', '12:43:00', '13:43:00', 1),
(14, 7, '2024-12-23', '13:43:00', '14:43:00', 0),
(15, 7, '2024-12-24', '10:44:00', '11:43:00', 1),
(16, 7, '2024-12-24', '11:43:00', '12:43:00', 1),
(17, 7, '2024-12-16', '12:43:00', '13:43:00', 1),
(19, 8, '2024-12-16', '12:00:00', '13:00:00', 1),
(20, 8, '2024-12-16', '13:00:00', '14:00:00', 1),
(21, 8, '2024-12-16', '14:00:00', '15:00:00', 1),
(22, 8, '2024-12-16', '15:00:00', '16:00:00', 1),
(23, 8, '2024-12-18', '16:00:00', '17:00:00', 1),
(24, 8, '2024-12-16', '17:00:00', '18:00:00', 1),
(25, 10, '2024-12-16', '12:00:00', '13:00:00', 0),
(26, 10, '2024-12-16', '13:00:00', '14:00:00', 0),
(27, 10, '2024-12-16', '14:00:00', '15:00:00', 0),
(28, 10, '2024-12-16', '15:00:00', '16:00:00', 1),
(29, 10, '2024-12-16', '16:00:00', '17:00:00', 0),
(30, 10, '2024-12-17', '12:00:00', '13:00:00', 0),
(31, 10, '2024-12-17', '13:00:00', '14:00:00', 0),
(32, 10, '2024-12-17', '14:00:00', '15:00:00', 0),
(33, 10, '2024-12-17', '15:00:00', '16:00:00', 0),
(34, 10, '2024-12-17', '16:00:00', '17:00:00', 0),
(35, 10, '2024-12-18', '12:00:00', '13:00:00', 0),
(36, 10, '2024-12-18', '13:00:00', '14:00:00', 0),
(37, 10, '2024-12-18', '14:00:00', '15:00:00', 0),
(38, 10, '2024-12-18', '15:00:00', '16:00:00', 0),
(39, 10, '2024-12-18', '16:00:00', '17:00:00', 0),
(40, 10, '2024-12-19', '12:00:00', '13:00:00', 0),
(41, 10, '2024-12-19', '13:00:00', '14:00:00', 0),
(42, 10, '2024-12-19', '14:00:00', '15:00:00', 0),
(43, 10, '2024-12-19', '15:00:00', '16:00:00', 0),
(44, 10, '2024-12-19', '16:00:00', '17:00:00', 0),
(45, 10, '2024-12-20', '12:00:00', '13:00:00', 0),
(46, 10, '2024-12-20', '13:00:00', '14:00:00', 0),
(47, 10, '2024-12-20', '14:00:00', '15:00:00', 0),
(48, 10, '2024-12-20', '15:00:00', '16:00:00', 0),
(49, 10, '2024-12-20', '16:00:00', '17:00:00', 0),
(50, 7, '2024-12-27', '13:03:00', '14:03:00', 1),
(51, 7, '2024-12-30', '14:03:00', '15:03:00', 0),
(52, 7, '2024-12-30', '15:03:00', '16:03:00', 0),
(55, 7, '2024-12-31', '15:03:00', '16:03:00', 0),
(56, 7, '2025-01-01', '13:03:00', '14:03:00', 1),
(57, 7, '2025-01-01', '14:03:00', '15:03:00', 1),
(58, 7, '2025-01-01', '15:03:00', '16:03:00', 1),
(59, 7, '2025-01-02', '13:03:00', '14:03:00', 0),
(60, 7, '2025-01-02', '14:03:00', '15:03:00', 1),
(61, 7, '2025-01-02', '15:03:00', '16:03:00', 0),
(62, 9, '2024-12-27', '12:05:00', '13:00:00', 0),
(63, 9, '2024-12-27', '13:00:00', '14:00:00', 0),
(64, 9, '2024-12-27', '14:00:00', '15:00:00', 0),
(65, 9, '2024-12-30', '12:00:00', '13:00:00', 0),
(66, 9, '2024-12-30', '13:00:00', '14:00:00', 0),
(67, 9, '2024-12-30', '14:00:00', '15:00:00', 0),
(68, 9, '2024-12-31', '12:00:00', '13:00:00', 0),
(69, 9, '2024-12-31', '13:00:00', '14:00:00', 0),
(70, 9, '2024-12-31', '14:00:00', '15:00:00', 0),
(71, 9, '2025-01-01', '12:00:00', '13:00:00', 0),
(72, 9, '2025-01-01', '13:00:00', '14:00:00', 0),
(73, 9, '2025-01-01', '14:00:00', '15:00:00', 0),
(74, 9, '2025-01-02', '12:02:00', '13:03:00', 0),
(75, 9, '2025-01-02', '13:00:00', '14:00:00', 0),
(76, 9, '2025-01-02', '14:00:00', '15:00:00', 0),
(77, 9, '2025-01-03', '12:00:00', '13:00:00', 0),
(78, 9, '2025-01-03', '13:00:00', '14:00:00', 0),
(79, 9, '2025-01-03', '14:00:00', '15:00:00', 0),
(80, 7, '2025-01-03', '12:00:00', '13:00:00', 0),
(81, 7, '2025-01-03', '13:00:00', '14:00:00', 0),
(82, 7, '2025-01-03', '14:00:00', '15:00:00', 0),
(83, 7, '2025-01-06', '12:00:00', '13:00:00', 1),
(84, 7, '2025-01-06', '13:00:00', '14:00:00', 1),
(85, 7, '2025-01-06', '14:00:00', '15:00:00', 1),
(86, 7, '2025-01-07', '12:00:00', '13:00:00', 0),
(87, 7, '2025-01-07', '13:00:00', '14:00:00', 1),
(88, 7, '2025-01-07', '14:00:00', '15:00:00', 0),
(89, 7, '2025-01-08', '12:00:00', '13:00:00', 0),
(90, 7, '2025-01-08', '13:00:00', '14:00:00', 0),
(91, 7, '2025-01-08', '14:00:00', '15:00:00', 0),
(92, 7, '2025-01-09', '12:00:00', '13:00:00', 0),
(93, 7, '2025-01-09', '13:00:00', '14:00:00', 0),
(94, 7, '2025-01-09', '14:00:00', '15:00:00', 0),
(97, 7, '2025-01-10', '14:00:00', '15:00:00', 0),
(98, 13, '2025-01-03', '14:16:00', '15:16:00', 0),
(99, 13, '2025-01-03', '15:16:00', '16:16:00', 0),
(100, 13, '2025-01-03', '16:16:00', '17:16:00', 1),
(101, 13, '2025-01-03', '17:16:00', '18:16:00', 0),
(102, 14, '2025-01-06', '10:00:00', '11:00:00', 0),
(103, 14, '2025-01-06', '11:00:00', '12:00:00', 0),
(104, 14, '2025-01-07', '10:00:00', '11:00:00', 0),
(105, 14, '2025-01-07', '11:00:00', '12:00:00', 0),
(106, 14, '2025-01-08', '10:00:00', '11:00:00', 0),
(107, 14, '2025-01-08', '11:00:00', '12:00:00', 0),
(108, 14, '2025-01-09', '10:00:00', '11:00:00', 0),
(109, 14, '2025-01-09', '11:00:00', '12:00:00', 0),
(110, 14, '2025-01-10', '10:00:00', '11:00:00', 0),
(111, 14, '2025-01-10', '11:00:00', '12:00:00', 0),
(112, 14, '2025-01-13', '10:00:00', '11:00:00', 0),
(113, 14, '2025-01-13', '11:00:00', '12:00:00', 0),
(114, 14, '2025-01-14', '10:00:00', '11:00:00', 0),
(115, 14, '2025-01-14', '11:00:00', '12:00:00', 0),
(116, 14, '2025-01-15', '10:00:00', '11:00:00', 0),
(117, 14, '2025-01-15', '11:00:00', '12:00:00', 1),
(118, 7, '2025-01-15', '12:00:00', '13:00:00', 0),
(119, 7, '2025-01-15', '13:00:00', '14:00:00', 0),
(120, 7, '2025-01-15', '14:00:00', '15:00:00', 0),
(121, 7, '2025-01-16', '12:00:00', '13:00:00', 0),
(122, 7, '2025-01-16', '13:00:00', '14:00:00', 0),
(123, 7, '2025-01-16', '14:00:00', '15:00:00', 0),
(124, 7, '2025-01-17', '12:00:00', '13:00:00', 0),
(125, 7, '2025-01-17', '13:00:00', '14:00:00', 0),
(126, 7, '2025-01-17', '14:00:00', '15:00:00', 0),
(127, 7, '2025-01-20', '12:00:00', '13:00:00', 0),
(128, 7, '2025-01-20', '13:00:00', '14:00:00', 0),
(129, 7, '2025-01-20', '14:00:00', '15:00:00', 0),
(130, 7, '2025-01-21', '12:00:00', '13:00:00', 0),
(131, 7, '2025-01-21', '13:00:00', '14:00:00', 0),
(132, 7, '2025-01-21', '14:00:00', '15:00:00', 0),
(133, 7, '2025-01-22', '12:00:00', '13:00:00', 0),
(134, 7, '2025-01-22', '13:00:00', '14:00:00', 0),
(135, 7, '2025-01-22', '14:00:00', '15:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('0','1','2','3') NOT NULL,
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `role`, `img`) VALUES
(1, 'Rohan', '0345900070', 'rohan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '3', 'user.jpg'),
(2, 'rafay', '314838383', 'rafay@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', 'testimonial-3.jpg'),
(4, 'izhaan', '0318383833', 'izhaan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2', 'team-1.jpg'),
(5, 'reyaan', '0318882828', 'rsheikhs573@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', 'team-2jpg'),
(6, 'Hamza', '038387388', 'hamza@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', 'team-4.jpg'),
(7, 'Fuzail', '0318888802', 'fuzail@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', NULL),
(8, 'aman', '03126373773', 'aman@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', NULL),
(9, 'Zohaib', '0318888299', 'zohaib@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', NULL),
(10, 'rijja', '03162627282', 'rijjarohan83@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', NULL),
(15, 'rafaysheikh', '0318277728', 'aptechrafay2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', NULL),
(17, 'rafaysheikh', '03182777283', 'rafayshaikh405@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2', NULL),
(19, 'ali', '03127772632', 'ali@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', 'team-2.jpg'),
(20, 'Muzzammil', '03153307757', 'muzzammil@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', 'team-2jpg'),
(21, 'Parvaiz', '437942309', 'parvaiz@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', 'team-4.jpg'),
(22, 'Kamran', '4890230472309', 'kamran@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', 'testimonial-2'),
(23, 'Junaid', '843947230', 'junaid@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', 'testimonial-3'),
(25, 'Daniyal', '9329843902', 'daniyal@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2', 'about.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `stylist_id` (`stylist_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `time_id` (`time_id`);

--
-- Indexes for table `cancelappoint`
--
ALTER TABLE `cancelappoint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `stylist_id` (`stylist_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `time_id` (`time_id`);

--
-- Indexes for table `confirmappoint`
--
ALTER TABLE `confirmappoint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `stylist_id` (`stylist_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `time_id` (`time_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_name` (`item_name`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stylist_id` (`stylist_id`),
  ADD KEY `fk_reviews_user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stylists`
--
ALTER TABLE `stylists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_services` (`services`);

--
-- Indexes for table `stylist_services`
--
ALTER TABLE `stylist_services`
  ADD PRIMARY KEY (`stylist_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `stylist_slots`
--
ALTER TABLE `stylist_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stylist_id` (`stylist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cancelappoint`
--
ALTER TABLE `cancelappoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `confirmappoint`
--
ALTER TABLE `confirmappoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stylists`
--
ALTER TABLE `stylists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stylist_slots`
--
ALTER TABLE `stylist_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`time_id`) REFERENCES `stylist_slots` (`id`);

--
-- Constraints for table `cancelappoint`
--
ALTER TABLE `cancelappoint`
  ADD CONSTRAINT `cancelappoint_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cancelappoint_ibfk_2` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`),
  ADD CONSTRAINT `cancelappoint_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `cancelappoint_ibfk_4` FOREIGN KEY (`time_id`) REFERENCES `stylist_slots` (`id`);

--
-- Constraints for table `confirmappoint`
--
ALTER TABLE `confirmappoint`
  ADD CONSTRAINT `confirmappoint_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `confirmappoint_ibfk_2` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`),
  ADD CONSTRAINT `confirmappoint_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `confirmappoint_ibfk_4` FOREIGN KEY (`time_id`) REFERENCES `stylist_slots` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stylists`
--
ALTER TABLE `stylists`
  ADD CONSTRAINT `fk_services` FOREIGN KEY (`services`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stylist_services`
--
ALTER TABLE `stylist_services`
  ADD CONSTRAINT `stylist_services_ibfk_1` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`),
  ADD CONSTRAINT `stylist_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `stylist_slots`
--
ALTER TABLE `stylist_slots`
  ADD CONSTRAINT `stylist_slots_ibfk_1` FOREIGN KEY (`stylist_id`) REFERENCES `stylists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
