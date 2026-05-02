-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2025 at 09:11 PM
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
-- Database: `hoa_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `user_agent` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, '202540617', 'login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 16:01:35'),
(2, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 19:13:24'),
(3, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 19:13:36'),
(4, '202540617', 'Approve Payment', 'Approved payment with ref_no: 123123123 for user_id: 20259770', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 19:22:35'),
(5, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:37:26'),
(6, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:37:32'),
(7, '20257378', 'Update Remittance Status', 'Updated remittance ID 1 to status 1', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:37:39'),
(8, '20257378', 'Update Remittance Status', 'Updated remittance ID 1 to status 1', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:43:43'),
(9, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:44:06'),
(10, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:44:11'),
(11, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:57:26'),
(12, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:59:26'),
(13, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:59:29'),
(14, '20253015', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:59:35'),
(15, '20253015', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 19:59:55'),
(16, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:00:04'),
(17, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:00:24'),
(18, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:00:29'),
(19, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:00:45'),
(20, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:00:52'),
(21, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:05:10'),
(22, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:05:16'),
(23, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:05:34'),
(24, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:05:40'),
(25, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:06:04'),
(26, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-08 20:06:10'),
(27, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 20:06:47'),
(28, '20258758', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 20:06:51'),
(29, '20258758', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 20:25:08'),
(30, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 20:25:12'),
(31, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 20:26:50'),
(32, '20253015', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-08 20:26:54'),
(33, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 15:53:59'),
(34, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:32:55'),
(35, '20258758', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:32:58'),
(36, '20258758', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:35:05'),
(37, '20253015', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:35:09'),
(38, '20253015', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:35:24'),
(39, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:35:30'),
(40, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:36:32'),
(41, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:36:37'),
(42, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:36:53'),
(43, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:37:01'),
(44, '20258758', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 16:41:21'),
(45, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:07:39'),
(46, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:07:44'),
(47, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:08:12'),
(48, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:08:18'),
(49, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:10:23'),
(50, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:10:30'),
(51, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:10:44'),
(52, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:10:56'),
(53, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:11:13'),
(54, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:11:21'),
(55, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:11:47'),
(56, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:11:58'),
(57, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:27:57'),
(58, '20253015', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:28:01'),
(59, '20253015', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:28:22'),
(60, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:28:26'),
(61, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:28:34'),
(62, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:28:39'),
(63, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:28:53'),
(64, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:28:56'),
(65, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:29:01'),
(66, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:29:08'),
(67, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:31:39'),
(68, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:31:44'),
(69, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:42:48'),
(70, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:42:52'),
(71, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:42:56'),
(72, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:43:00'),
(73, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:43:03'),
(74, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:43:07'),
(75, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:43:19'),
(76, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:44:43'),
(77, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:44:51'),
(78, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:44:55'),
(79, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:45:06'),
(80, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:45:10'),
(81, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:46:05'),
(82, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 17:46:08'),
(83, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:06:53'),
(84, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:06:57'),
(85, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:27:12'),
(86, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:27:21'),
(87, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:27:35'),
(88, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:27:40'),
(89, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:30:20'),
(90, '20253015', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:31:33'),
(91, '20253015', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:32:14'),
(92, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:32:18'),
(93, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:33:58'),
(94, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:34:02'),
(95, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:35:45'),
(96, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:35:55'),
(97, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:40:49'),
(98, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:40:53'),
(99, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:42:33'),
(100, '20253351', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:42:38'),
(101, '20253351', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:43:57'),
(102, '20257378', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:44:04'),
(103, '20257378', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:45:31'),
(104, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:45:35'),
(105, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:47:30'),
(106, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Sa', '2025-12-09 18:47:33'),
(107, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-09 20:06:43'),
(108, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-09 20:06:52'),
(109, '20252095', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-09 20:08:33'),
(110, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-09 20:08:39'),
(111, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-09 20:10:45'),
(112, '202540617', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-09 20:10:48'),
(113, '202540617', 'logout', 'User logged out.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-09 20:10:51'),
(114, '20252095', 'Login', 'User logged in successfully.', '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome', '2025-12-09 20:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `reference_number` varchar(150) DEFAULT NULL,
  `acknowledgement_receipt` longblob DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `approval_notes` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `has_release` tinyint(1) DEFAULT 0,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `project_id`, `recipient`, `release_date`, `payment_method`, `reference_number`, `acknowledgement_receipt`, `purpose`, `approval_notes`, `created_by`, `has_release`, `date_created`, `date_updated`) VALUES
(1, 1, 'Dolorem distinctio', '2002-06-18', 'Bank Transfer', '931', 0x313736353232343034325f363933373265366132636333382e706466, 'Dolorem at optio en', 'Temporibus qui labor', 20257378, 1, '2025-12-09 04:00:42', '2025-12-09 04:00:42'),
(2, 2, 'Occaecat quas eu ame', '1986-09-09', 'Bank Transfer', '294', 0x313736353330303038315f363933383537373134313135342e706466, 'Voluptas qui quia ex', 'Magnam quisquam opti', 20257378, 1, '2025-12-10 01:08:01', '2025-12-10 01:08:01'),
(3, 3, 'In nostrud debitis n', '1977-03-21', 'Check', '39', 0x313736353330323536325f363933383631323235323461352e706466, 'Aut labore culpa rep', 'Dolores aliqua Sit', 20257378, 1, '2025-12-10 01:49:22', '2025-12-10 01:49:22'),
(4, 4, 'Omnis ut cupidatat l', '2022-07-23', 'Check', '310', 0x313736353330353332345f363933383662656339313466322e706466, 'Duis aut voluptatem', 'Quia maiores magnam', 20257378, 1, '2025-12-10 02:35:24', '2025-12-10 02:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `court`
--

CREATE TABLE `court` (
  `id` int(11) NOT NULL,
  `renter_name` varchar(100) NOT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `purpose` text NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `no_of_participants` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`id`, `renter_name`, `contact_no`, `purpose`, `amount`, `start_date`, `end_date`, `no_of_participants`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Ali Graves', 2147483647, 'Aut aut eius in in m', 61, '1998-08-01 10:45:00', '2022-05-19 08:25:00', 95, 0, '2025-12-10', '2025-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `court_fees`
--

CREATE TABLE `court_fees` (
  `id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_fees`
--

INSERT INTO `court_fees` (`id`, `court_id`, `amount_paid`, `status`, `is_remitted`, `date_created`, `date_updated`) VALUES
(1, 1, 61, 1, 0, '2025-12-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `fee_assignments`
--

CREATE TABLE `fee_assignments` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_assignments`
--

INSERT INTO `fee_assignments` (`id`, `user_id`, `fee_type_id`, `amount`, `due_date`, `status`, `date_created`, `date_updated`) VALUES
(1, '20259770', 6, 420, '2026-01-01', 1, '2025-12-08', '2025-12-09'),
(2, '20259770', 7, 63, '2026-01-01', 1, '2025-12-08', '2025-12-09'),
(3, '20259770', 9, 49, '2026-01-01', 1, '2025-12-08', '2025-12-09'),
(4, '20259770', 11, 1, '2026-01-01', 1, '2025-12-08', '2025-12-09'),
(5, '20258758', 6, 420, '2026-01-01', 0, '2025-12-09', '0000-00-00'),
(6, '20258758', 7, 63, '2026-01-01', 0, '2025-12-09', '0000-00-00'),
(7, '20258758', 9, 49, '2026-01-01', 0, '2025-12-09', '0000-00-00'),
(8, '20258758', 11, 1, '2026-01-01', 4, '2025-12-09', '2025-12-10'),
(9, '20259770', 12, 88, '2026-01-01', 0, '2025-12-10', '0000-00-00'),
(10, '20258758', 12, 88, '2026-01-01', 0, '2025-12-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `fee_type`
--

CREATE TABLE `fee_type` (
  `id` int(11) NOT NULL,
  `fee_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `effectivity_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `is_recurring` tinyint(4) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_type`
--

INSERT INTO `fee_type` (`id`, `fee_name`, `description`, `amount`, `effectivity_date`, `status`, `is_recurring`, `created_by`, `date_created`, `date_updated`) VALUES
(6, 'Hayes Ford', 'Minus iure nihil eaq', 420, '1997-02-02', 1, 1, '202540617', '2025-11-27', '0000-00-00'),
(7, 'Dale Dennis', 'Neque aliquam eum fu', 63, '2018-04-21', 1, 1, '202540617', '2025-11-27', '0000-00-00'),
(8, 'Vera Beard', 'Odit ut velit minim', 82, '2000-05-20', 3, 1, '202540617', '2025-11-28', '0000-00-00'),
(9, 'Cyrus Kidd', 'Quisquam eos autem v', 49, '1990-07-30', 1, 1, '202540617', '2025-11-29', '0000-00-00'),
(10, 'Cole Crosby', 'Libero sit eos nos', 93, '2014-06-17', 1, 2, '202540617', '2025-11-29', '0000-00-00'),
(11, 'Skyler Gordon', 'Proident est itaque', 1, '2007-06-03', 1, 1, '202540617', '2025-12-07', '0000-00-00'),
(12, 'Tanner Strickland', 'Sed quia debitis acc', 88, '1976-01-28', 1, 1, '202540617', '2025-12-09', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `financial_summary`
--

CREATE TABLE `financial_summary` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file` longblob DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `has_validated` int(11) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_summary`
--

INSERT INTO `financial_summary` (`id`, `project_id`, `file`, `created_by`, `has_validated`, `date_created`, `date_updated`) VALUES
(1, 1, 0x313736353232343335325f4d41544348494e472e706466, 20253351, 1, '2025-12-09 04:05:52', '2025-12-10 01:23:43'),
(2, 2, 0x313736353330303238395f4d41544348494e472e706466, 20253351, 1, '2025-12-10 01:11:29', '2025-12-10 02:27:49'),
(3, 3, 0x313736353330343835305f4d41544348494e472e706466, 20253351, 1, '2025-12-10 02:27:30', '2025-12-10 02:27:46'),
(4, 4, 0x313736353330353832395f4d41544348494e472e706466, 20253351, 1, '2025-12-10 02:43:49', '2025-12-10 02:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_info`
--

CREATE TABLE `hoa_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `hoa_number` varchar(100) NOT NULL,
  `home_address` varchar(100) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `block` varchar(100) NOT NULL,
  `phase` varchar(100) NOT NULL,
  `village` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_info`
--

INSERT INTO `hoa_info` (`id`, `user_id`, `hoa_number`, `home_address`, `lot`, `block`, `phase`, `village`) VALUES
(1, '202540617', '02', 'Excepturi pariatur0', '310', '653', '145', 'Juliet Holland'),
(47, '20252095', '8', 'Amet sapiente disti', 'Est esse provident', 'Duis ut quia excepte', 'Unde deserunt ut quo', 'Mabuhay Homes 2000'),
(49, '20253015', '968', 'Molestiae et autem r', 'Enim amet dolorem v', 'Perspiciatis porro', 'Sit quaerat quia vel', 'Mabuhay Homes 2000'),
(50, '20257378', '117', 'Deleniti expedita no', 'Ad et est minima ips', 'Sint et iure in pers', 'Doloremque eius sint', 'Mabuhay Homes 2000'),
(51, '20253351', '700', 'Facere odio nihil ex', 'Numquam voluptatibus', 'Ad assumenda in est', 'Nostrud at error tot', 'Mabuhay Homes 2000'),
(63, '20259770', '870', 'Autem nulla fugiat', 'Fuga Sed molestiae', 'Eiusmod quia sint nu', 'Omnis ut ullamco dol', 'Mabuhay Homes 2000'),
(64, '20258758', '284', 'Sit ut aperiam simil', 'Dignissimos perferen', 'Adipisicing ullam om', 'Reprehenderit aut e', 'Mabuhay Homes 2000');

-- --------------------------------------------------------

--
-- Table structure for table `homeowner_fees`
--

CREATE TABLE `homeowner_fees` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `amount_paid` decimal(10,0) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `attachment` blob NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homeowner_fees`
--

INSERT INTO `homeowner_fees` (`id`, `user_id`, `amount_paid`, `payment_method`, `ref_no`, `attachment`, `status`, `remarks`, `is_remitted`, `date_created`, `date_updated`) VALUES
(1, '20259770', 1, 'Cash', '123123123', 0x75706c6f6164732f7061796d656e74732f70726f6f665f36393337323535323666633139382e34363237333838352e706e67, 1, '', 1, '2025-12-08 19:43:43', '2025-12-08 19:43:43'),
(2, '20259770', 49, 'Cash', '123123123', 0x75706c6f6164732f7061796d656e74732f70726f6f665f36393337323535323666633139382e34363237333838352e706e67, 1, '', 1, '2025-12-08 19:43:43', '2025-12-08 19:43:43'),
(3, '20259770', 63, 'Cash', '123123123', 0x75706c6f6164732f7061796d656e74732f70726f6f665f36393337323535323666633139382e34363237333838352e706e67, 1, '', 1, '2025-12-08 19:43:43', '2025-12-08 19:43:43'),
(4, '20259770', 420, 'Cash', '123123123', 0x75706c6f6164732f7061796d656e74732f70726f6f665f36393337323535323666633139382e34363237333838352e706e67, 1, '', 1, '2025-12-08 19:43:43', '2025-12-08 19:43:43'),
(5, '20258758', 1, 'Bank Transfer', '123123', 0x75706c6f6164732f7061796d656e74732f70726f6f665f36393338353234366531313063342e37353139393239342e706e67, 4, '3123123', 0, '2025-12-09 16:45:58', '2025-12-09 16:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `liquidation_expenses_details`
--

CREATE TABLE `liquidation_expenses_details` (
  `id` int(11) NOT NULL,
  `liquidation_id` int(11) NOT NULL,
  `particular` varchar(100) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `total_expenses` int(11) NOT NULL,
  `remaning_budget` int(11) NOT NULL,
  `audit_result` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `expense_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liquidation_expenses_details`
--

INSERT INTO `liquidation_expenses_details` (`id`, `liquidation_id`, `particular`, `amount`, `quantity`, `receipt`, `total_expenses`, `remaning_budget`, `audit_result`, `remarks`, `expense_date`, `date_created`, `date_updated`) VALUES
(1, 1, 'Totam incidunt veli', 80.00, 2, 'liq_1_0_1765224305.pdf', 80, -24, 'Overspent', 'Eum qui adipisicing', '2025-12-09 18:23:12', '2025-12-09 04:05:05', '2025-12-10 02:10:44'),
(2, 2, 'Dignissimos et tenet', 3.00, 2, '', 174, -97, 'Overspent', 'Eum consequat Quisq', '2025-12-09 18:23:12', '2025-12-10 01:08:46', '2025-12-10 02:10:45'),
(3, 2, 'Iste officia id saep', 50.00, 2, '', 174, -97, 'Overspent', 'Eum consequat Quisq', '2025-12-09 18:23:12', '2025-12-10 01:08:46', '2025-12-10 02:10:47'),
(4, 2, 'Reprehenderit Nam te', 96.00, 2, '', 174, -97, 'Overspent', 'Eum consequat Quisq', '2025-12-09 18:23:12', '2025-12-10 01:08:46', '2025-12-10 02:10:48'),
(5, 2, 'Eos laborum cupidit', 25.00, 2, '', 174, -97, 'Overspent', 'Eum consequat Quisq', '2025-12-09 18:23:12', '2025-12-10 01:08:46', '2025-12-10 02:10:49'),
(6, 4, 'Aut id omnis volupta', 31.00, 497, NULL, 201, -119, 'Overspent', 'Commodo debitis sit', '2002-11-13 16:00:00', '2025-12-10 02:23:19', '2025-12-10 02:23:19'),
(7, 4, 'Totam eaque est quos', 44.00, 546, NULL, 201, -119, 'Overspent', 'Commodo debitis sit', '1993-01-24 16:00:00', '2025-12-10 02:23:19', '2025-12-10 02:23:19'),
(8, 4, 'Magnam veniam dolor', 61.00, 810, NULL, 201, -119, 'Overspent', 'Commodo debitis sit', '2018-03-06 16:00:00', '2025-12-10 02:23:19', '2025-12-10 02:23:19'),
(9, 4, 'Adipisci et maxime a', 65.00, 1, NULL, 201, -119, 'Overspent', 'Commodo debitis sit', '2025-12-08 16:00:00', '2025-12-10 02:23:19', '2025-12-10 02:23:19'),
(10, 5, 'In a velit ut delect', 65.00, 1, NULL, 65, -26, 'Overspent', 'Eaque nostrum blandi', '2025-12-08 16:00:00', '2025-12-10 02:40:41', '2025-12-10 02:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `liquidation_of_expenses`
--

CREATE TABLE `liquidation_of_expenses` (
  `id` int(11) NOT NULL,
  `project_resolution_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `total_expenses` decimal(10,2) DEFAULT 0.00,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liquidation_of_expenses`
--

INSERT INTO `liquidation_of_expenses` (`id`, `project_resolution_id`, `status`, `total_expenses`, `date_created`, `date_updated`) VALUES
(1, 1, 1, 80.00, '2025-12-09 04:05:05', '2025-12-09 04:05:22'),
(2, 2, 1, 174.00, '2025-12-10 01:08:46', '2025-12-10 01:11:03'),
(4, 3, 1, 201.00, '2025-12-10 02:23:19', '2025-12-10 02:26:53'),
(5, 4, 1, 65.00, '2025-12-10 02:40:41', '2025-12-10 02:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE `news_feed` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `post_images` blob NOT NULL,
  `project_file` blob NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_feed`
--

INSERT INTO `news_feed` (`id`, `created_by`, `post_title`, `description`, `post_images`, `project_file`, `date_created`, `date_updated`) VALUES
(1, 202540617, 'Autem quas similique', 'Reiciendis aliquam d', 0x2f686f615f73797374656d2f75706c6f6164732f6e657773666565642f313736353232313734315f53637265656e73686f7420323032352d31302d3135203136313834382e706e67, 0x2f686f615f73797374656d2f75706c6f6164732f6e657773666565642f313736353232313734315f4d41544348494e472e706466, '2025-12-09', '2025-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_verification`
--

CREATE TABLE `payment_verification` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `payment_for` varchar(100) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_verification`
--

INSERT INTO `payment_verification` (`id`, `user_id`, `payment_for`, `amount`, `status`, `ref_no`, `date_created`, `date_updated`) VALUES
(1, '20259770', 'Walk-in Payment', 533, 1, '123123123', '2025-12-09', '0000-00-00'),
(2, '20258758', 'Walk-in Payment', 1, 0, '123123', '2025-12-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `remittance`
--

CREATE TABLE `remittance` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `particular` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remittance`
--

INSERT INTO `remittance` (`id`, `user_id`, `particular`, `amount`, `date`, `transaction_type`, `status`, `date_created`, `date_updated`) VALUES
(1, '202540617', 'Today\'s HOA Collected Fee', 533, '2025-12-08', 'Credit', 1, '2025-12-09', '2025-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `resolution`
--

CREATE TABLE `resolution` (
  `id` int(11) NOT NULL,
  `project_resolution_title` varchar(255) NOT NULL,
  `resolution_summary` text NOT NULL,
  `estimated_budget` int(11) DEFAULT 0,
  `target_start_date` date NOT NULL,
  `target_end_date` date NOT NULL,
  `proposed_by` int(11) NOT NULL,
  `project_proposal_document` longblob DEFAULT NULL,
  `upload_signed_resolution` longblob DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `has_financial_summary` tinyint(1) DEFAULT 0,
  `is_budget_released` tinyint(4) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resolution`
--

INSERT INTO `resolution` (`id`, `project_resolution_title`, `resolution_summary`, `estimated_budget`, `target_start_date`, `target_end_date`, `proposed_by`, `project_proposal_document`, `upload_signed_resolution`, `status`, `has_financial_summary`, `is_budget_released`, `created_by`, `date_created`, `date_updated`) VALUES
(1, 'Obcaecati tempor asp', 'Possimus doloremque', 56, '2018-01-10', '1989-01-24', 20253015, 0x70726f706f73616c5f363933373265333535383963662e706466, 0x7369676e65645f363933373265333535386263632e706466, 1, 1, 1, 20253015, '2025-12-09 03:59:49', '2025-12-09 04:05:52'),
(2, 'Ipsum assumenda vel', 'Sunt dolore commodi', 77, '1989-05-13', '1975-02-12', 20253015, 0x70726f706f73616c5f363933383466633938393563612e706466, 0x7369676e65645f363933383466633938393763312e706466, 1, 1, 1, 20253015, '2025-12-10 00:35:21', '2025-12-10 01:11:29'),
(3, 'Consequat Cillum vo', 'Consequuntur volupta', 82, '2022-07-01', '2011-12-12', 20253015, 0x70726f706f73616c5f363933383563326637653432382e706466, 0x7369676e65645f363933383563326637653666332e706466, 1, 1, 1, 20253015, '2025-12-10 01:28:15', '2025-12-10 02:27:30'),
(4, 'Nisi accusamus qui v', 'Ipsum sed vitae cons', 39, '2007-06-29', '1980-12-08', 20253015, 0x70726f706f73616c5f363933383662323165383263312e706466, 0x7369676e65645f363933383662323165383462322e706466, 1, 1, 1, 20253015, '2025-12-10 02:32:01', '2025-12-10 02:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'President'),
(2, 'Secretary'),
(3, 'Admin'),
(4, 'Treasurer'),
(5, 'Auditor'),
(6, 'Home Owner'),
(7, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `id` int(11) NOT NULL,
  `stall_no` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` date DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`id`, `stall_no`, `status`, `remarks`, `date_created`, `date_updated`) VALUES
(1, 0, 1, '', NULL, NULL),
(2, 12, 1, 'Veritatis voluptas e', '2025-11-28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stall_renter`
--

CREATE TABLE `stall_renter` (
  `id` int(11) NOT NULL,
  `renter_name` varchar(100) NOT NULL,
  `contact_no` varchar(11) DEFAULT NULL,
  `stall_id` int(11) NOT NULL,
  `rental_duration` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `contract` blob DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall_renter`
--

INSERT INTO `stall_renter` (`id`, `renter_name`, `contact_no`, `stall_id`, `rental_duration`, `start_date`, `end_date`, `amount`, `contract`, `status`, `remarks`, `date_created`, `date_updated`) VALUES
(1, 'Josiah William', '09567521753', 2, '0', '1987-05-27', '0000-00-00', 89, 0x2f686f615f73797374656d2f75706c6f6164732f636f6e7472616374732f313736353330373336395f4d41544348494e472e706466, 1, 'Active', '2025-12-09 19:19:05', '2025-12-09 19:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `stall_renter_fees`
--

CREATE TABLE `stall_renter_fees` (
  `id` int(11) NOT NULL,
  `stall_renter_id` int(11) NOT NULL,
  `amount_paid` decimal(10,0) NOT NULL,
  `attachment` blob NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall_renter_fees`
--

INSERT INTO `stall_renter_fees` (`id`, `stall_renter_id`, `amount_paid`, `attachment`, `status`, `remarks`, `is_remitted`, `date_created`, `date_updated`) VALUES
(1, 1, 89, 0x75706c6f6164732f6174746163686d656e74732f7374616c6c5f315f7061796d656e745f313736353330383836375f4d41544348494e472e706466, 1, '', 0, '2025-12-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `toda`
--

CREATE TABLE `toda` (
  `id` int(11) NOT NULL,
  `toda_name` varchar(100) NOT NULL,
  `no_of_tricycles` int(11) NOT NULL,
  `representative` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `fee_amount` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL,
  `contract` blob NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toda`
--

INSERT INTO `toda` (`id`, `toda_name`, `no_of_tricycles`, `representative`, `contact_no`, `fee_amount`, `status`, `contract`, `start_date`, `end_date`, `date_created`, `date_updated`) VALUES
(1, 'Drake Coffey', 91, 'Dolor quas ad ipsum', '09567521753', 23, 1, 0x75706c6f6164732f636f6e7472616374732f313736353330393130375f4d41544348494e472e706466, '2009-09-15', '2018-12-09', '2025-12-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `toda_fees`
--

CREATE TABLE `toda_fees` (
  `id` int(11) NOT NULL,
  `toda_id` int(11) NOT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `is_remitted` tinyint(4) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toda_fees`
--

INSERT INTO `toda_fees` (`id`, `toda_id`, `amount_paid`, `status`, `due_date`, `is_remitted`, `date_created`, `date_updated`) VALUES
(7, 1, 23, 1, '2025-12-03', 0, '2025-12-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `particulars` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `name_of_payer` varchar(150) NOT NULL,
  `name_of_receiver` varchar(150) NOT NULL,
  `payment_method` varchar(150) NOT NULL,
  `reference_number` varchar(150) NOT NULL,
  `acknowledgement_receipt` tinyblob NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_first_time` tinyint(4) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expire` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `user_id`, `email_address`, `password`, `is_first_time`, `reset_token`, `reset_token_expire`, `status`, `date_created`, `date_updated`) VALUES
(39, 3, '202540617', 'verovalut@yopmail.com', '$2y$10$SUATxGYafsYqwfoKFbdL0eNBiD6xL.S/Hy3WmAq8CY94lxN3Pd5EG', 0, '', '2025-11-21 19:50:15', 1, '2025-11-05', '2025-11-05'),
(95, 1, '20252095', 'hoa.president@yopmail.com', '$2y$10$6HJXPkNmDY6P/s/uKgaYSOdi6nzWnkdV0fGo1S/PQsVv43qvRBcGi', 0, NULL, NULL, 1, '2025-12-07', '0000-00-00'),
(97, 2, '20253015', 'hoa.secretary@yopmail.com', '$2y$10$Z0frgDW0/r6sQ6rhr3ZYue255H2RMYLduMnO84eu8e9KqMS/PTZN6', 0, NULL, NULL, 1, '2025-12-07', '0000-00-00'),
(98, 4, '20257378', 'hoa.treasurer@yopmail.com', '$2y$10$B/fQj8XbTMNjBF3RvIfW.eFOEIIcA7QXXR3jbsxm0BVYbsH3N.G9G', 0, NULL, NULL, 1, '2025-12-07', '0000-00-00'),
(99, 5, '20253351', 'hoa.auditor@yopmail.com', '$2y$10$2ZTZma5Bg5Gm7qKo8h6lEOwA9nt1b4rAaN378lUmT7SXknYHYdcJe', 0, NULL, NULL, 1, '2025-12-07', '0000-00-00'),
(111, 6, '20259770', 'jyjebi@mailinator.com', '$2y$10$mar1sKp6nukbKQ3gMbLZSeKsyeYXP2y0u1EZ2QtkiEJcaJ7BJAxCi', 1, '5710a596e3c6522c05c41207baa9afef7082c48fca230f1709d8ffd0cddaef56', '2025-12-08 13:12:51', 1, '2025-12-08', '0000-00-00'),
(112, 6, '20258758', 'bagymozi@yopmail.com', '$2y$10$2j9rP1p4mqmiOgPoTFoPHenXyxVKQMpmqntA/LMuR9H.ln8oSNWne', 0, NULL, NULL, 1, '2025-12-09', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `suffix` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `civil_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `phone_number`, `date_of_birth`, `citizenship`, `civil_status`) VALUES
(1, '202540617', 'Mechelle', 'Vielka Farrell', 'Palmerioz', 'Veronica Wheeler', '+639917385959', '2025-11-18', 'Deserunt tempora rep', 'Widowed'),
(43, '20252095', 'Martina', 'Sawyer Jefferson', 'Fletcher', 'Ea iure saepe aut et', '09567521753', '2019-08-17', 'Filipino', 'Single'),
(45, '20253015', 'Noel', 'Kibo Scott', 'Leblanc', 'Omnis qui quia volup', '09565555555', '1984-06-18', 'Filipino', 'Single'),
(46, '20257378', 'Dora', 'Zephania Bates', 'Ball', 'Ut magna consectetur', '09565555555', '1980-08-23', 'Filipino', 'Single'),
(47, '20253351', 'Megan', 'Malcolm Myers', 'Mccall', 'Velit iure ipsam pro', '09112223212', '1990-10-28', 'Filipino', 'Single'),
(59, '20259770', 'Xavier', 'Wesley Allison', 'Jacobson', 'Doloribus alias proi', '09565555555', '2025-02-17', 'Filipino', 'Single'),
(60, '20258758', 'Reese', 'Logan Durham', 'Berger', 'Deleniti in ipsum e', '09565555555', '2016-07-09', 'Filipino', 'Single');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `court`
--
ALTER TABLE `court`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `court_fees`
--
ALTER TABLE `court_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_id` (`court_id`);

--
-- Indexes for table `fee_assignments`
--
ALTER TABLE `fee_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fee_type`
--
ALTER TABLE `fee_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_summary`
--
ALTER TABLE `financial_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_info`
--
ALTER TABLE `hoa_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `homeowner_fees`
--
ALTER TABLE `homeowner_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `liquidation_expenses_details`
--
ALTER TABLE `liquidation_expenses_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liquidation_of_expenses`
--
ALTER TABLE `liquidation_of_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_id` (`fee_id`);

--
-- Indexes for table `payment_verification`
--
ALTER TABLE `payment_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remittance`
--
ALTER TABLE `remittance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resolution`
--
ALTER TABLE `resolution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stall_renter`
--
ALTER TABLE `stall_renter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stall_renter_fees`
--
ALTER TABLE `stall_renter_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stall_renter_id` (`stall_renter_id`);

--
-- Indexes for table `toda`
--
ALTER TABLE `toda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toda_fees`
--
ALTER TABLE `toda_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toda_id` (`toda_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `court_fees`
--
ALTER TABLE `court_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fee_assignments`
--
ALTER TABLE `fee_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fee_type`
--
ALTER TABLE `fee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `financial_summary`
--
ALTER TABLE `financial_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hoa_info`
--
ALTER TABLE `hoa_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `homeowner_fees`
--
ALTER TABLE `homeowner_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `liquidation_expenses_details`
--
ALTER TABLE `liquidation_expenses_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `liquidation_of_expenses`
--
ALTER TABLE `liquidation_of_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_verification`
--
ALTER TABLE `payment_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `remittance`
--
ALTER TABLE `remittance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stall_renter`
--
ALTER TABLE `stall_renter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stall_renter_fees`
--
ALTER TABLE `stall_renter_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toda`
--
ALTER TABLE `toda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toda_fees`
--
ALTER TABLE `toda_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoa_info`
--
ALTER TABLE `hoa_info`
  ADD CONSTRAINT `hoa_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
